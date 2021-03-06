<?php
/**
 * Implements Special:UserLogin
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup SpecialPage
 */
use MediaWiki\Logger\LoggerFactory;
use Psr\Log\LogLevel;
use MediaWiki\Session\SessionManager;

/**
 * Implements Special:UserLogin
 *
 * @ingroup SpecialPage
 */
class LoginForm extends SpecialPage {
	const SUCCESS = 0;
	const NO_NAME = 1;
	const ILLEGAL = 2;
	const WRONG_PLUGIN_PASS = 3;
	const NOT_EXISTS = 4;
	const WRONG_PASS = 5;
	const EMPTY_PASS = 6;
	const RESET_PASS = 7;
	const ABORTED = 8;
	const CREATE_BLOCKED = 9;
	const THROTTLED = 10;
	const USER_BLOCKED = 11;
	const NEED_TOKEN = 12;
	const WRONG_TOKEN = 13;
	const USER_MIGRATED = 14;

	public static $statusCodes = [
		self::SUCCESS => 'success',
		self::NO_NAME => 'no_name',
		self::ILLEGAL => 'illegal',
		self::WRONG_PLUGIN_PASS => 'wrong_plugin_pass',
		self::NOT_EXISTS => 'not_exists',
		self::WRONG_PASS => 'wrong_pass',
		self::EMPTY_PASS => 'empty_pass',
		self::RESET_PASS => 'reset_pass',
		self::ABORTED => 'aborted',
		self::CREATE_BLOCKED => 'create_blocked',
		self::THROTTLED => 'throttled',
		self::USER_BLOCKED => 'user_blocked',
		self::NEED_TOKEN => 'need_token',
		self::WRONG_TOKEN => 'wrong_token',
		self::USER_MIGRATED => 'user_migrated',
	];

	/**
	 * Valid error and warning messages
	 *
	 * Special:Userlogin can show an error or warning message on the form when
	 * coming from another page. This is done via the ?error= or ?warning= GET
	 * parameters.
	 *
	 * This array is the list of valid message keys. All other values will be
	 * ignored.
	 *
	 * @since 1.24
	 * @var string[]
	 */
	public static $validErrorMessages = [
		'exception-nologin-text',
		'watchlistanontext',
		'changeemail-no-info',
		'resetpass-no-info',
		'confirmemail_needlogin',
		'prefsnologintext2',
	];

	public $mAbortLoginErrorMsg = null;
	/**
	 * @var int How many seconds user is throttled for
	 * @since 1.27
	 */
	public $mThrottleWait = '?';

	protected $mUsername;
	protected $mPassword;
	protected $mRetype;
	protected $mReturnTo;
	protected $mCookieCheck;
	protected $mPosted;
	protected $mAction;
	protected $mCreateaccount;
	protected $mCreateaccountMail;
	protected $mLoginattempt;
	protected $mRemember;
	protected $mEmail;
	protected $mDomain;
	protected $mLanguage;
	protected $mSkipCookieCheck;
	protected $mReturnToQuery;
	protected $mToken;
	protected $mStickHTTPS;
	protected $mType;
	protected $mReason;
	protected $mRealName;
	protected $mEntryError = '';
	protected $mEntryErrorType = 'error';

	private $mTempPasswordUsed;
	private $mLoaded = false;
	private $mSecureLoginUrl;

	/** @var WebRequest */
	private $mOverrideRequest = null;

	/** @var WebRequest Effective request; set at the beginning of load */
	private $mRequest = null;

	/**
	 * @param WebRequest $request
	 */
	public function __construct( $request = null ) {
		global $wgUseMediaWikiUIEverywhere;
		parent::__construct( 'Userlogin' );

		$this->mOverrideRequest = $request;
		// Override UseMediaWikiEverywhere to true, to force login and create form to use mw ui
		$wgUseMediaWikiUIEverywhere = true;
	}

	public function doesWrites() {
		return true;
	}

	/**
	 * Returns an array of all valid error messages.
	 *
	 * @return array
	 */
	public static function getValidErrorMessages() {
		static $messages = null;
		if ( !$messages ) {
			$messages = self::$validErrorMessages;
			Hooks::run( 'LoginFormValidErrorMessages', [ &$messages ] );
		}

		return $messages;
	}

	/**
	 * Loader
	 */
	function load() {
		global $wgAuth, $wgHiddenPrefs, $wgEnableEmail;

		if ( $this->mLoaded ) {
			return;
		}
		$this->mLoaded = true;

		if ( $this->mOverrideRequest === null ) {
			$request = $this->getRequest();
		} else {
			$request = $this->mOverrideRequest;
		}
		$this->mRequest = $request;

		$this->mType = $request->getText( 'type' );
		$this->mUsername = $request->getText( 'wpName' );
		$this->mPassword = $request->getText( 'wpPassword' );
		$this->mRetype = $request->getText( 'wpRetype' );
		$this->mDomain = $request->getText( 'wpDomain' );
		$this->mReason = $request->getText( 'wpReason' );
		$this->mCookieCheck = $request->getVal( 'wpCookieCheck' );
		$this->mPosted = $request->wasPosted();
		$this->mCreateaccountMail = $request->getCheck( 'wpCreateaccountMail' )
			&& $wgEnableEmail;
		$this->mCreateaccount = $request->getCheck( 'wpCreateaccount' ) && !$this->mCreateaccountMail;
		$this->mLoginattempt = $request->getCheck( 'wpLoginattempt' );
		$this->mAction = $request->getVal( 'action' );
		$this->mRemember = $request->getCheck( 'wpRemember' );
		$this->mFromHTTP = $request->getBool( 'fromhttp', false )
			|| $request->getBool( 'wpFromhttp', false );
		$this->mStickHTTPS = ( !$this->mFromHTTP && $request->getProtocol() === 'https' )
			|| $request->getBool( 'wpForceHttps', false );
		$this->mLanguage = $request->getText( 'uselang' );
		$this->mSkipCookieCheck = $request->getCheck( 'wpSkipCookieCheck' );
		$this->mToken = $this->mType == 'signup'
			? $request->getVal( 'wpCreateaccountToken' )
			: $request->getVal( 'wpLoginToken' );
		$this->mReturnTo = $request->getVal( 'returnto', '' );
		$this->mReturnToQuery = $request->getVal( 'returntoquery', '' );

		// Show an error or warning passed on from a previous page
		$entryError = $this->msg( $request->getVal( 'error', '' ) );
		$entryWarning = $this->msg( $request->getVal( 'warning', '' ) );
		// bc: provide login link as a parameter for messages where the translation
		// was not updated
		$loginreqlink = Linker::linkKnown(
			$this->getPageTitle(),
			$this->msg( 'loginreqlink' )->escaped(),
			[],
			[
				'returnto' => $this->mReturnTo,
				'returntoquery' => $this->mReturnToQuery,
				'uselang' => $this->mLanguage,
				'fromhttp' => $this->mFromHTTP ? '1' : '0',
			]
		);

		// Only show valid error or warning messages.
		if ( $entryError->exists()
			&& in_array( $entryError->getKey(), self::getValidErrorMessages() )
		) {
			$this->mEntryErrorType = 'error';
			$this->mEntryError = $entryError->rawParams( $loginreqlink )->parse();

		} elseif ( $entryWarning->exists()
			&& in_array( $entryWarning->getKey(), self::getValidErrorMessages() )
		) {
			$this->mEntryErrorType = 'warning';
			$this->mEntryError = $entryWarning->rawParams( $loginreqlink )->parse();
		}

		if ( $wgEnableEmail ) {
			$this->mEmail = $request->getText( 'wpEmail' );
		} else {
			$this->mEmail = '';
		}
		if ( !in_array( 'realname', $wgHiddenPrefs ) ) {
			$this->mRealName = $request->getText( 'wpRealName' );
		} else {
			$this->mRealName = '';
		}

		if ( !$wgAuth->validDomain( $this->mDomain ) ) {
			$this->mDomain = $wgAuth->getDomain();
		}
		$wgAuth->setDomain( $this->mDomain );

		# 1. When switching accounts, it sucks to get automatically logged out
		# 2. Do not return to PasswordReset after a successful password change
		#    but goto Wiki start page (Main_Page) instead ( bug 33997 )
		$returnToTitle = Title::newFromText( $this->mReturnTo );
		if ( is_object( $returnToTitle )
			&& ( $returnToTitle->isSpecial( 'Userlogout' )
				|| $returnToTitle->isSpecial( 'PasswordReset' ) )
		) {
			$this->mReturnTo = '';
			$this->mReturnToQuery = '';
		}
	}

	function getDescription() {
		if ( $this->mType === 'signup' ) {
			return $this->msg( 'createaccount' )->text();
		} else {
			return $this->msg( 'login' )->text();
		}
	}

	/**
	 * @param string|null $subPage
	 */
	public function execute( $subPage ) {
		// Make sure session is persisted
		$session = SessionManager::getGlobalSession();
		$session->persist();

		$this->load();

		// Check for [[Special:Userlogin/signup]]. This affects form display and
		// page title.
		if ( $subPage == 'signup' ) {
			$this->mType = 'signup';
		}
		$this->setHeaders();

		// Make sure it's possible to log in
		if ( $this->mType !== 'signup' && !$session->canSetUser() ) {
			throw new ErrorPageError(
				'cannotloginnow-title',
				'cannotloginnow-text',
				[
					$session->getProvider()->describe( RequestContext::getMain()->getLanguage() )
				]
			);
		}

		/**
		 * In the case where the user is already logged in, and was redirected to
		 * the login form from a page that requires login, do not show the login
		 * page. The use case scenario for this is when a user opens a large number
		 * of tabs, is redirected to the login page on all of them, and then logs
		 * in on one, expecting all the others to work properly.
		 *
		 * However, do show the form if it was visited intentionally (no 'returnto'
		 * is present). People who often switch between several accounts have grown
		 * accustomed to this behavior.
		 */
		if (
			$this->mType !== 'signup' &&
			!$this->mPosted &&
			$this->getUser()->isLoggedIn() &&
			( $this->mReturnTo !== '' || $this->mReturnToQuery !== '' )
		) {
			$this->successfulLogin();
		}

		// If logging in and not on HTTPS, either redirect to it or offer a link.
		global $wgSecureLogin;
		if ( $this->mRequest->getProtocol() !== 'https' ) {
			$title = $this->getFullTitle();
			$query = [
				'returnto' => $this->mReturnTo !== '' ? $this->mReturnTo : null,
				'returntoquery' => $this->mReturnToQuery !== '' ?
					$this->mReturnToQuery : null,
				'title' => null,
				( $this->mEntryErrorType === 'error' ? 'error' : 'warning' ) => $this->mEntryError,
			] + $this->mRequest->getQueryValues();
			$url = $title->getFullURL( $query, false, PROTO_HTTPS );
			if ( $wgSecureLogin
				&& wfCanIPUseHTTPS( $this->getRequest()->getIP() )
				&& !$this->mFromHTTP ) // Avoid infinite redirect
			{
				$url = wfAppendQuery( $url, 'fromhttp=1' );
				$this->getOutput()->redirect( $url );
				// Since we only do this redir to change proto, always vary
				$this->getOutput()->addVaryHeader( 'X-Forwarded-Proto' );

				return;
			} else {
				// A wiki without HTTPS login support should set $wgServer to
				// http://somehost, in which case the secure URL generated
				// above won't actually start with https://
				if ( substr( $url, 0, 8 ) === 'https://' ) {
					$this->mSecureLoginUrl = $url;
				}
			}
		}

		if ( !is_null( $this->mCookieCheck ) ) {
			$this->onCookieRedirectCheck( $this->mCookieCheck );

			return;
		} elseif ( $this->mPosted ) {
			if ( $this->mCreateaccount ) {
				$this->addNewAccount();

				return;
			} elseif ( $this->mCreateaccountMail ) {
				$this->addNewAccountMailPassword();

				return;
			} elseif ( ( 'submitlogin' == $this->mAction ) || $this->mLoginattempt ) {
				$this->processLogin();

				return;
			}
		}
		$this->mainLoginForm( $this->mEntryError, $this->mEntryErrorType );
	}

	/**
	 * @private
	 */
	function addNewAccountMailPassword() {
		if ( $this->mEmail == '' ) {
			$this->mainLoginForm( $this->msg( 'noemailcreate' )->escaped() );

			return;
		}

		$status = $this->addNewAccountInternal();
		LoggerFactory::getInstance( 'authmanager' )->info(
			'Account creation attempt with mailed password',
			[ 'event' => 'accountcreation', 'status' => $status ]
		);
		if ( !$status->isGood() ) {
			$error = $status->getMessage();
			$this->mainLoginForm( $error->toString() );

			return;
		}

		/** @var User $u */
		$u = $status->getValue();

		// Wipe the initial password and mail a temporary one
		$u->setPassword( null );
		$u->saveSettings();
		$result = $this->mailPasswordInternal( $u, false, 'createaccount-title', 'createaccount-text' );

		Hooks::run( 'AddNewAccount', [ $u, true ] );
		$u->addNewUserLogEntry( 'byemail', $this->mReason );

		$out = $this->getOutput();
		$out->setPageTitle( $this->msg( 'accmailtitle' ) );

		if ( !$result->isGood() ) {
			$this->mainLoginForm( $this->msg( 'mailerror', $result->getWikiText() )->text() );
		} else {
			$out->addWikiMsg( 'accmailtext', $u->getName(), $u->getEmail() );
			$this->executeReturnTo( 'success' );
		}
	}

	/**
	 * @private
	 * @return bool
	 */
	function addNewAccount() {
		global $wgContLang, $wgUser, $wgEmailAuthentication, $wgLoginLanguageSelector;

		# Create the account and abort if there's a problem doing so
		$status = $this->addNewAccountInternal();
		LoggerFactory::getInstance( 'authmanager' )->info( 'Account creation attempt', [
			'event' => 'accountcreation',
			'status' => $status,
		] );

		if ( !$status->isGood() ) {
			$error = $status->getMessage();
			$this->mainLoginForm( $error->toString() );

			return false;
		}

		$u = $status->getValue();

		# Only save preferences if the user is not creating an account for someone else.
		if ( $this->getUser()->isAnon() ) {
			# If we showed up language selection links, and one was in use, be
			# smart (and sensible) and save that language as the user's preference
			if ( $wgLoginLanguageSelector && $this->mLanguage ) {
				$u->setOption( 'language', $this->mLanguage );
			} else {

				# Otherwise the user's language preference defaults to $wgContLang,
				# but it may be better to set it to their preferred $wgContLang variant,
				# based on browser preferences or URL parameters.
				$u->setOption( 'language', $wgContLang->getPreferredVariant() );
			}
			if ( $wgContLang->hasVariants() ) {
				$u->setOption( 'variant', $wgContLang->getPreferredVariant() );
			}
		}

		$out = $this->getOutput();

		# Send out an email authentication message if needed
		if ( $wgEmailAuthentication && Sanitizer::validateEmail( $u->getEmail() ) ) {
			$status = $u->sendConfirmationMail();
			if ( $status->isGood() ) {
				$out->addWikiMsg( 'confirmemail_oncreate' );
			} else {
				$out->addWikiText( $status->getWikiText( 'confirmemail_sendfailed' ) );
			}
		}

		# Save settings (including confirmation token)
		$u->saveSettings();

		# If not logged in, assume the new account as the current one and set
		# session cookies then show a "welcome" message or a "need cookies"
		# message as needed
		if ( $this->getUser()->isAnon() ) {
			$u->setCookies();
			$wgUser = $u;
			// This should set it for OutputPage and the Skin
			// which is needed or the personal links will be
			// wrong.
			$this->getContext()->setUser( $u );
			Hooks::run( 'AddNewAccount', [ $u, false ] );
			$u->addNewUserLogEntry( 'create' );
			if ( $this->hasSessionCookie() ) {
				$this->successfulCreation();
			} else {
				$this->cookieRedirectCheck( 'new' );
			}
		} else {
			# Confirm that the account was created
			$out->setPageTitle( $this->msg( 'accountcreated' ) );
			$out->addWikiMsg( 'accountcreatedtext', $u->getName() );
			$out->addReturnTo( $this->getPageTitle() );
			Hooks::run( 'AddNewAccount', [ $u, false ] );
			$u->addNewUserLogEntry( 'create2', $this->mReason );
		}

		return true;
	}

	/**
	 * Make a new user account using the loaded data.
	 * @private
	 * @throws PermissionsError|ReadOnlyError
	 * @return Status
	 */
	public function addNewAccountInternal() {
		global $wgAuth, $wgAccountCreationThrottle, $wgEmailConfirmToEdit;

		// If the user passes an invalid domain, something is fishy
		if ( !$wgAuth->validDomain( $this->mDomain ) ) {
			return Status::newFatal( 'wrongpassword' );
		}

		// If we are not allowing users to login locally, we should be checking
		// to see if the user is actually able to authenticate to the authenti-
		// cation server before they create an account (otherwise, they can
		// create a local account and login as any domain user). We only need
		// to check this for domains that aren't local.
		if ( 'local' != $this->mDomain && $this->mDomain != '' ) {
			if (
				!$wgAuth->canCreateAccounts() &&
				(
					!$wgAuth->userExists( $this->mUsername ) ||
					!$wgAuth->authenticate( $this->mUsername, $this->mPassword )
				)
			) {
				return Status::newFatal( 'wrongpassword' );
			}
		}

		if ( wfReadOnly() ) {
			throw new ReadOnlyError;
		}

		# Request forgery checks.
		$token = self::getCreateaccountToken();
		if ( $token->wasNew() ) {
			return Status::newFatal( 'nocookiesfornew' );
		}

		# The user didn't pass a createaccount token
		if ( !$this->mToken ) {
			return Status::newFatal( 'sessionfailure' );
		}

		# Validate the createaccount token
		if ( !$token->match( $this->mToken ) ) {
			return Status::newFatal( 'sessionfailure' );
		}

		# Check permissions
		$currentUser = $this->getUser();
		$creationBlock = $currentUser->isBlockedFromCreateAccount();
		if ( !$currentUser->isAllowed( 'createaccount' ) ) {
			throw new PermissionsError( 'createaccount' );
		} elseif ( $creationBlock instanceof Block ) {
			// Throws an ErrorPageError.
			$this->userBlockedMessage( $creationBlock );

			// This should never be reached.
			return false;
		}

		# Include checks that will include GlobalBlocking (Bug 38333)
		$permErrors = $this->getPageTitle()->getUserPermissionsErrors(
			'createaccount',
			$currentUser,
			true
		);

		if ( count( $permErrors ) ) {
			throw new PermissionsError( 'createaccount', $permErrors );
		}

		$ip = $this->getRequest()->getIP();
		if ( $currentUser->isDnsBlacklisted( $ip, true /* check $wgProxyWhitelist */ ) ) {
			return Status::newFatal( 'sorbs_create_account_reason' );
		}

		# Now create a dummy user ($u) and check if it is valid
		$u = User::newFromName( $this->mUsername, 'creatable' );
		if ( !$u ) {
			return Status::newFatal( 'noname' );
		}

		$cache = ObjectCache::getLocalClusterInstance();
		# Make sure the user does not exist already
		$lock = $cache->getScopedLock( $cache->makeGlobalKey( 'account', md5( $this->mUsername ) ) );
		if ( !$lock ) {
			return Status::newFatal( 'usernameinprogress' );
		} elseif ( $u->idForName( User::READ_LOCKING ) ) {
			return Status::newFatal( 'userexists' );
		}

		if ( $this->mCreateaccountMail ) {
			# do not force a password for account creation by email
			# set invalid password, it will be replaced later by a random generated password
			$this->mPassword = null;
		} else {
			if ( $this->mPassword !== $this->mRetype ) {
				return Status::newFatal( 'badretype' );
			}

			# check for password validity, return a fatal Status if invalid
			$validity = $u->checkPasswordValidity( $this->mPassword, 'create' );
			if ( !$validity->isGood() ) {
				$validity->ok = false; // make sure this Status is fatal
				return $validity;
			}
		}

		# if you need a confirmed email address to edit, then obviously you
		# need an email address.
		if ( $wgEmailConfirmToEdit && strval( $this->mEmail ) === '' ) {
			return Status::newFatal( 'noemailtitle' );
		}

		if ( strval( $this->mEmail ) !== '' && !Sanitizer::validateEmail( $this->mEmail ) ) {
			return Status::newFatal( 'invalidemailaddress' );
		}

		# Set some additional data so the AbortNewAccount hook can be used for
		# more than just username validation
		$u->setEmail( $this->mEmail );
		$u->setRealName( $this->mRealName );

		$abortError = '';
		$abortStatus = null;
		if ( !Hooks::run( 'AbortNewAccount', [ $u, &$abortError, &$abortStatus ] ) ) {
			// Hook point to add extra creation throttles and blocks
			wfDebug( "LoginForm::addNewAccountInternal: a hook blocked creation\n" );
			if ( $abortStatus === null ) {
				// Report back the old string as a raw message status.
				// This will report the error back as 'createaccount-hook-aborted'
				// with the given string as the message.
				// To return a different error code, return a Status object.
				$abortError = new Message( 'createaccount-hook-aborted', [ $abortError ] );
				$abortError->text();

				return Status::newFatal( $abortError );
			} else {
				// For MediaWiki 1.23+ and updated hooks, return the Status object
				// returned from the hook.
				return $abortStatus;
			}
		}

		// Hook point to check for exempt from account creation throttle
		if ( !Hooks::run( 'ExemptFromAccountCreationThrottle', [ $ip ] ) ) {
			wfDebug( "LoginForm::exemptFromAccountCreationThrottle: a hook " .
				"allowed account creation w/o throttle\n" );
		} else {
			if ( ( $wgAccountCreationThrottle && $currentUser->isPingLimitable() ) ) {
				$key = wfGlobalCacheKey( 'acctcreate', 'ip', $ip );
				$value = $cache->get( $key );
				if ( !$value ) {
					$cache->set( $key, 0, $cache::TTL_DAY );
				}
				if ( $value >= $wgAccountCreationThrottle ) {
					return Status::newFatal( 'acct_creation_throttle_hit', $wgAccountCreationThrottle );
				}
				$cache->incr( $key );
			}
		}

		if ( !$wgAuth->addUser( $u, $this->mPassword, $this->mEmail, $this->mRealName ) ) {
			return Status::newFatal( 'externaldberror' );
		}

		self::clearCreateaccountToken();

		return $this->initUser( $u, false );
	}

	/**
	 * Actually add a user to the database.
	 * Give it a User object that has been initialised with a name.
	 *
	 * @param User $u
	 * @param bool $autocreate True if this is an autocreation via auth plugin
	 * @return Status Status object, with the User object in the value member on success
	 * @private
	 */
	function initUser( $u, $autocreate ) {
		global $wgAuth;

		$status = $u->addToDatabase();
		if ( !$status->isOK() ) {
			return $status;
		}

		if ( $wgAuth->allowPasswordChange() ) {
			$u->setPassword( $this->mPassword );
		}

		$u->setEmail( $this->mEmail );
		$u->setRealName( $this->mRealName );
		$u->setToken();

		Hooks::run( 'LocalUserCreated', [ $u, $autocreate ] );
		$oldUser = $u;
		$wgAuth->initUser( $u, $autocreate );
		if ( $oldUser !== $u ) {
			wfWarn( get_class( $wgAuth ) . '::initUser() replaced the user object' );
		}

		$u->saveSettings();

		// Update user count
		DeferredUpdates::addUpdate( new SiteStatsUpdate( 0, 0, 0, 0, 1 ) );

		// Watch user's userpage and talk page
		$u->addWatch( $u->getUserPage(), User::IGNORE_USER_RIGHTS );

		return Status::newGood( $u );
	}

	/**
	 * Internally authenticate the login request.
	 *
	 * This may create a local account as a side effect if the
	 * authentication plugin allows transparent local account
	 * creation.
	 * @return int
	 */
	public function authenticateUserData() {
		global $wgUser, $wgAuth;

		$this->load();

		if ( $this->mUsername == '' ) {
			return self::NO_NAME;
		}

		// We require a login token to prevent login CSRF
		// Handle part of this before incrementing the throttle so
		// token-less login attempts don't count towards the throttle
		// but wrong-token attempts do.

		// If the user doesn't have a login token yet, set one.
		$token = self::getLoginToken();
		if ( $token->wasNew() ) {
			return self::NEED_TOKEN;
		}
		// If the user didn't pass a login token, tell them we need one
		if ( !$this->mToken ) {
			return self::NEED_TOKEN;
		}

		$throttleCount = self::incrementLoginThrottle( $this->mUsername );
		if ( $throttleCount ) {
			$this->mThrottleWait = $throttleCount['wait'];
			return self::THROTTLED;
		}

		// Validate the login token
		if ( !$token->match( $this->mToken ) ) {
			return self::WRONG_TOKEN;
		}

		// Load the current user now, and check to see if we're logging in as
		// the same name. This is necessary because loading the current user
		// (say by calling getName()) calls the UserLoadFromSession hook, which
		// potentially creates the user in the database. Until we load $wgUser,
		// checking for user existence using User::newFromName($name)->getId() below
		// will effectively be using stale data.
		if ( $this->getUser()->getName() === $this->mUsername ) {
			wfDebug( __METHOD__ . ": already logged in as {$this->mUsername}\n" );

			return self::SUCCESS;
		}

		$u = User::newFromName( $this->mUsername );
		if ( $u === false ) {
			return self::ILLEGAL;
		}

		$msg = null;
		// Give extensions a way to indicate the username has been updated,
		// rather than telling the user the account doesn't exist.
		if ( !Hooks::run( 'LoginUserMigrated', [ $u, &$msg ] ) ) {
			$this->mAbortLoginErrorMsg = $msg;
			return self::USER_MIGRATED;
		}

		if ( !User::isUsableName( $u->getName() ) ) {
			return self::ILLEGAL;
		}

		$isAutoCreated = false;
		if ( $u->getId() == 0 ) {
			$status = $this->attemptAutoCreate( $u );
			if ( $status !== self::SUCCESS ) {
				return $status;
			} else {
				$isAutoCreated = true;
			}
		} else {
			$u->load();
		}

		// Give general extensions, such as a captcha, a chance to abort logins
		$abort = self::ABORTED;
		if ( !Hooks::run( 'AbortLogin', [ $u, $this->mPassword, &$abort, &$msg ] ) ) {
			if ( !in_array( $abort, array_keys( self::$statusCodes ), true ) ) {
				throw new Exception( 'Invalid status code returned from AbortLogin hook: ' . $abort );
			}
			$this->mAbortLoginErrorMsg = $msg;
			return $abort;
		}

		global $wgBlockDisablesLogin;
		if ( !$u->checkPassword( $this->mPassword ) ) {
			if ( $u->checkTemporaryPassword( $this->mPassword ) ) {
				/**
				 * The e-mailed temporary password should not be used for actu-
				 * al logins; that's a very sloppy habit, and insecure if an
				 * attacker has a few seconds to click "search" on someone's
				 * open mail reader.
				 *
				 * Allow it to be used only to reset the password a single time
				 * to a new value, which won't be in the user's e-mail ar-
				 * chives.
				 *
				 * For backwards compatibility, we'll still recognize it at the
				 * login form to minimize surprises for people who have been
				 * logging in with a temporary password for some time.
				 *
				 * As a side-effect, we can authenticate the user's e-mail ad-
				 * dress if it's not already done, since the temporary password
				 * was sent via e-mail.
				 */
				if ( !$u->isEmailConfirmed() && !wfReadOnly() ) {
					$u->confirmEmail();
					$u->saveSettings();
				}

				// At this point we just return an appropriate code/ indicating
				// that the UI should show a password reset form; bot inter-
				// faces etc will probably just fail cleanly here.
				$this->mAbortLoginErrorMsg = 'resetpass-temp-emailed';
				$this->mTempPasswordUsed = true;
				$retval = self::RESET_PASS;
			} else {
				$retval = ( $this->mPassword == '' ) ? self::EMPTY_PASS : self::WRONG_PASS;
			}
		} elseif ( $wgBlockDisablesLogin && $u->isBlocked() ) {
			// If we've enabled it, make it so that a blocked user cannot login
			$retval = self::USER_BLOCKED;
		} elseif ( $this->checkUserPasswordExpired( $u ) == 'hard' ) {
			// Force reset now, without logging in
			$retval = self::RESET_PASS;
			$this->mAbortLoginErrorMsg = 'resetpass-expired';
		} else {
			Hooks::run( 'UserLoggedIn', [ $u ] );
			$oldUser = $u;
			$wgAuth->updateUser( $u );
			if ( $oldUser !== $u ) {
				wfWarn( get_class( $wgAuth ) . '::updateUser() replaced the user object' );
			}
			$wgUser = $u;
			// This should set it for OutputPage and the Skin
			// which is needed or the personal links will be
			// wrong.
			$this->getContext()->setUser( $u );

			// Please reset throttle for successful logins, thanks!
			self::clearLoginThrottle( $this->mUsername );

			if ( $isAutoCreated ) {
				// Must be run after $wgUser is set, for correct new user log
				Hooks::run( 'AuthPluginAutoCreate', [ $u ] );
			}

			$retval = self::SUCCESS;
		}
		Hooks::run( 'LoginAuthenticateAudit', [ $u, $this->mPassword, $retval ] );

		return $retval;
	}

	/**
	 * Increment the login attempt throttle hit count for the (username,current IP)
	 * tuple unless the throttle was already reached.
	 *
	 * @since 1.27 Return value changed.
	 * @param string $username The user name
	 * @return bool|array false if below limit or an array if above limit
	 *   Array contains keys wait, count, and throttleIndex
	 */
	public static function incrementLoginThrottle( $username ) {
		global $wgPasswordAttemptThrottle, $wgRequest;
		$username = User::getCanonicalName( $username, 'usable' ) ?: $username;

		$throttleCount = 0;
		if ( is_array( $wgPasswordAttemptThrottle ) ) {
			$throttleConfig = $wgPasswordAttemptThrottle;
			if ( isset( $wgPasswordAttemptThrottle['count'] ) ) {
				// old style. Convert for backwards compat.
				$throttleConfig = [ $wgPasswordAttemptThrottle ];
			}
			foreach ( $throttleConfig as $index => $specificThrottle ) {
				if ( isset( $specificThrottle['allIPs'] ) ) {
					$ip = 'All';
				} else {
					$ip = $wgRequest->getIP();
				}
				$throttleKey = wfGlobalCacheKey( 'password-throttle',
					$index, $ip, md5( $username )
				);
				$count = $specificThrottle['count'];
				$period = $specificThrottle['seconds'];

				$cache = ObjectCache::getLocalClusterInstance();
				$throttleCount = $cache->get( $throttleKey );
				if ( !$throttleCount ) {
					$cache->add( $throttleKey, 1, $period ); // start counter
				} elseif ( $throttleCount < $count ) {
					$cache->incr( $throttleKey );
				} elseif ( $throttleCount >= $count ) {
					$logMsg = 'Login attempt rejected because logins to '
						. '{acct} from IP {ip} have been throttled for '
						. '{period} seconds due to {count} failed attempts';
					// If we are hitting a throttle for >= 50 attempts,
					// it is much more likely to be an attack than someone
					// simply forgetting their password, so log it at a
					// higher level.
					$level = $count >= 50 ? LogLevel::WARNING : LogLevel::INFO;
					// It should be noted that once the throttle is hit,
					// every attempt to login will generate the log message
					// until the throttle expires, not just the attempt that
					// puts the throttle over the top.
					LoggerFactory::getInstance( 'password-throttle' )->log(
						$level,
						$logMsg,
						[
							'ip' => $ip,
							'period' => $period,
							'acct' => $username,
							'count' => $count,
							'throttleIdentifier' => $index,
							'method' => __METHOD__
						]
					);

					return [
						'throttleIndex' => $index,
						'wait' => $period,
						'count' => $count
					];
				}
			}
		}
		return false;
	}

	/**
	 * Increment the login attempt throttle hit count for the (username,current IP)
	 * tuple unless the throttle was already reached.
	 *
	 * @deprecated Use LoginForm::incrementLoginThrottle instead
	 * @param string $username The user name
	 * @return bool|int true if above throttle, or 0 (prior to 1.27, returned current count)
	 */
	public static function incLoginThrottle( $username ) {
		wfDeprecated( __METHOD__, "1.27" );
		$res = self::incrementLoginThrottle( $username );
		return is_array( $res ) ? true : 0;
	}

	/**
	 * Clear the login attempt throttle hit count for the (username,current IP) tuple.
	 * @param string $username The user name
	 * @return void
	 */
	public static function clearLoginThrottle( $username ) {
		global $wgRequest, $wgPasswordAttemptThrottle;
		$username = User::getCanonicalName( $username, 'usable' ) ?: $username;

		if ( is_array( $wgPasswordAttemptThrottle ) ) {
			$throttleConfig = $wgPasswordAttemptThrottle;
			if ( isset( $wgPasswordAttemptThrottle['count'] ) ) {
				// old style. Convert for backwards compat.
				$throttleConfig = [ $wgPasswordAttemptThrottle ];
			}
			foreach ( $throttleConfig as $index => $specificThrottle ) {
				if ( isset( $specificThrottle['allIPs'] ) ) {
					$ip = 'All';
				} else {
					$ip = $wgRequest->getIP();
				}
				$throttleKey = wfGlobalCacheKey( 'password-throttle', $index,
					$ip, md5( $username )
				);
				ObjectCache::getLocalClusterInstance()->delete( $throttleKey );
			}
		}
	}

	/**
	 * Attempt to automatically create a user on login. Only succeeds if there
	 * is an external authentication method which allows it.
	 *
	 * @param User $user
	 *
	 * @return int Status code
	 */
	function attemptAutoCreate( $user ) {
		global $wgAuth;

		if ( $this->getUser()->isBlockedFromCreateAccount() ) {
			wfDebug( __METHOD__ . ": user is blocked from account creation\n" );

			return self::CREATE_BLOCKED;
		}

		if ( !$wgAuth->autoCreate() ) {
			return self::NOT_EXISTS;
		}

		if ( !$wgAuth->userExists( $user->getName() ) ) {
			wfDebug( __METHOD__ . ": user does not exist\n" );

			return self::NOT_EXISTS;
		}

		if ( !$wgAuth->authenticate( $user->getName(), $this->mPassword ) ) {
			wfDebug( __METHOD__ . ": \$wgAuth->authenticate() returned false, aborting\n" );

			return self::WRONG_PLUGIN_PASS;
		}

		$abortError = '';
		if ( !Hooks::run( 'AbortAutoAccount', [ $user, &$abortError ] ) ) {
			// Hook point to add extra creation throttles and blocks
			wfDebug( "LoginForm::attemptAutoCreate: a hook blocked creation: $abortError\n" );
			$this->mAbortLoginErrorMsg = $abortError;

			return self::ABORTED;
		}

		wfDebug( __METHOD__ . ": creating account\n" );
		$status = $this->initUser( $user, true );

		if ( !$status->isOK() ) {
			$errors = $status->getErrorsByType( 'error' );
			$this->mAbortLoginErrorMsg = $errors[0]['message'];

			return self::ABORTED;
		}

		return self::SUCCESS;
	}

	function processLogin() {
		global $wgLang, $wgSecureLogin, $wgInvalidPasswordReset;

		$authRes = $this->authenticateUserData();
		switch ( $authRes ) {
			case self::SUCCESS:
				# We've verified now, update the real record
				$user = $this->getUser();
				$user->touch();

				if ( $user->requiresHTTPS() ) {
					$this->mStickHTTPS = true;
				}

				if ( $wgSecureLogin && !$this->mStickHTTPS ) {
					$user->setCookies( $this->mRequest, false, $this->mRemember );
				} else {
					$user->setCookies( $this->mRequest, null, $this->mRemember );
				}
				self::clearLoginToken();

				// Reset the throttle
				self::clearLoginThrottle( $this->mUsername );

				$request = $this->getRequest();
				if ( $this->hasSessionCookie() || $this->mSkipCookieCheck ) {
					/* Replace the language object to provide user interface in
					 * correct language immediately on this first page load.
					 */
					$code = $request->getVal( 'uselang', $user->getOption( 'language' ) );
					$userLang = Language::factory( $code );
					$wgLang = $userLang;
					RequestContext::getMain()->setLanguage( $userLang );
					$this->getContext()->setLanguage( $userLang );
					// Reset SessionID on Successful login (bug 40995)
					$this->renewSessionId();
					if ( $this->checkUserPasswordExpired( $this->getUser() ) == 'soft' ) {
						$this->resetLoginForm( $this->msg( 'resetpass-expired-soft' ) );
					} elseif ( $wgInvalidPasswordReset
						&& !$user->isValidPassword( $this->mPassword )
					) {
						$status = $user->checkPasswordValidity(
							$this->mPassword,
							'login'
						);
						$this->resetLoginForm(
							$status->getMessage( 'resetpass-validity-soft' )
						);
					} else {
						$this->successfulLogin();
					}
				} else {
					$this->cookieRedirectCheck( 'login' );
				}
				break;

			case self::NEED_TOKEN:
				$error = $this->mAbortLoginErrorMsg ?: 'nocookiesforlogin';
				$this->mainLoginForm( $this->msg( $error )->parse() );
				break;
			case self::WRONG_TOKEN:
				$error = $this->mAbortLoginErrorMsg ?: 'sessionfailure';
				$this->mainLoginForm( $this->msg( $error )->text() );
				break;
			case self::NO_NAME:
			case self::ILLEGAL:
				$error = $this->mAbortLoginErrorMsg ?: 'noname';
				$this->mainLoginForm( $this->msg( $error )->text() );
				break;
			case self::WRONG_PLUGIN_PASS:
				$error = $this->mAbortLoginErrorMsg ?: 'wrongpassword';
				$this->mainLoginForm( $this->msg( $error )->text() );
				break;
			case self::NOT_EXISTS:
				if ( $this->getUser()->isAllowed( 'createaccount' ) ) {
					$error = $this->mAbortLoginErrorMsg ?: 'nosuchuser';
					$this->mainLoginForm( $this->msg( $error,
						wfEscapeWikiText( $this->mUsername ) )->parse() );
				} else {
					$error = $this->mAbortLoginErrorMsg ?: 'nosuchusershort';
					$this->mainLoginForm( $this->msg( $error,
						wfEscapeWikiText( $this->mUsername ) )->text() );
				}
				break;
			case self::WRONG_PASS:
				$error = $this->mAbortLoginErrorMsg ?: 'wrongpassword';
				$this->mainLoginForm( $this->msg( $error )->text() );
				break;
			case self::EMPTY_PASS:
				$error = $this->mAbortLoginErrorMsg ?: 'wrongpasswordempty';
				$this->mainLoginForm( $this->msg( $error )->text() );
				break;
			case self::RESET_PASS:
				$error = $this->mAbortLoginErrorMsg ?: 'resetpass_announce';
				$this->resetLoginForm( $this->msg( $error ) );
				break;
			case self::CREATE_BLOCKED:
				$this->userBlockedMessage( $this->getUser()->isBlockedFromCreateAccount() );
				break;
			case self::THROTTLED:
				$error = $this->mAbortLoginErrorMsg ?: 'login-throttled';
				$this->mainLoginForm( $this->msg( $error )
					->durationParams( $this->mThrottleWait )->text()
				);
				break;
			case self::USER_BLOCKED:
				$error = $this->mAbortLoginErrorMsg ?: 'login-userblocked';
				$this->mainLoginForm( $this->msg( $error, $this->mUsername )->escaped() );
				break;
			case self::ABORTED:
				$error = $this->mAbortLoginErrorMsg ?: 'login-abort-generic';
				$this->mainLoginForm( $this->msg( $error,
						wfEscapeWikiText( $this->mUsername ) )->text() );
				break;
			case self::USER_MIGRATED:
				$error = $this->mAbortLoginErrorMsg ?: 'login-migrated-generic';
				$params = [];
				if ( is_array( $error ) ) {
					$error = array_shift( $this->mAbortLoginErrorMsg );
					$params = $this->mAbortLoginErrorMsg;
				}
				$this->mainLoginForm( $this->msg( $error, $params )->text() );
				break;
			default:
				throw new MWException( 'Unhandled case value' );
		}

		LoggerFactory::getInstance( 'authmanager' )->info( 'Login attempt', [
			'event' => 'login',
			'successful' => $authRes === self::SUCCESS,
			'status' => LoginForm::$statusCodes[$authRes],
		] );
	}

	/**
	 * Show the Special:ChangePassword form, with custom message
	 * @param Message $msg
	 */
	protected function resetLoginForm( Message $msg ) {
		// Allow hooks to explain this password reset in more detail
		Hooks::run( 'LoginPasswordResetMessage', [ &$msg, $this->mUsername ] );
		$reset = new SpecialChangePassword();
		$derivative = new DerivativeContext( $this->getContext() );
		$derivative->setTitle( $reset->getPageTitle() );
		$reset->setContext( $derivative );
		if ( !$this->mTempPasswordUsed ) {
			$reset->setOldPasswordMessage( 'oldpassword' );
		}
		$reset->setChangeMessage( $msg );
		$reset->execute( null );
	}

	/**
	 * @param User $u
	 * @param bool $throttle
	 * @param string $emailTitle Message name of email title
	 * @param string $emailText Message name of email text
	 * @return Status
	 */
	function mailPasswordInternal( $u, $throttle = true, $emailTitle = 'passwordremindertitle',
		$emailText = 'passwordremindertext'
	) {
		global $wgNewPasswordExpiry, $wgMinimalPasswordLength;

		if ( $u->getEmail() == '' ) {
			return Status::newFatal( 'noemail', $u->getName() );
		}
		$ip = $this->getRequest()->getIP();
		if ( !$ip ) {
			return Status::newFatal( 'badipaddress' );
		}

		$currentUser = $this->getUser();
		Hooks::run( 'User::mailPasswordInternal', [ &$currentUser, &$ip, &$u ] );

		$np = PasswordFactory::generateRandomPasswordString( $wgMinimalPasswordLength );
		$u->setNewpassword( $np, $throttle );
		$u->saveSettings();
		$userLanguage = $u->getOption( 'language' );

		$mainPage = Title::newMainPage();
		$mainPageUrl = $mainPage->getCanonicalURL();

		$m = $this->msg( $emailText, $ip, $u->getName(), $np, '<' . $mainPageUrl . '>',
			round( $wgNewPasswordExpiry / 86400 ) )->inLanguage( $userLanguage )->text();
		$result = $u->sendMail( $this->msg( $emailTitle )->inLanguage( $userLanguage )->text(), $m );

		return $result;
	}

	/**
	 * Run any hooks registered for logins, then HTTP redirect to
	 * $this->mReturnTo (or Main Page if that's undefined).  Formerly we had a
	 * nice message here, but that's really not as useful as just being sent to
	 * wherever you logged in from.  It should be clear that the action was
	 * successful, given the lack of error messages plus the appearance of your
	 * name in the upper right.
	 *
	 * @private
	 */
	function successfulLogin() {
		# Run any hooks; display injected HTML if any, else redirect
		$currentUser = $this->getUser();
		$injected_html = '';
		Hooks::run( 'UserLoginComplete', [ &$currentUser, &$injected_html ] );

		if ( $injected_html !== '' ) {
			$this->displaySuccessfulAction( 'success', $this->msg( 'loginsuccesstitle' ),
				'loginsuccess', $injected_html );
		} else {
			$this->executeReturnTo( 'successredirect' );
		}
	}

	/**
	 * Run any hooks registered for logins, then display a message welcoming
	 * the user.
	 *
	 * @private
	 */
	function successfulCreation() {
		# Run any hooks; display injected HTML
		$currentUser = $this->getUser();
		$injected_html = '';
		$welcome_creation_msg = 'welcomecreation-msg';

		Hooks::run( 'UserLoginComplete', [ &$currentUser, &$injected_html ] );

		/**
		 * Let any extensions change what message is shown.
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/BeforeWelcomeCreation
		 * @since 1.18
		 */
		Hooks::run( 'BeforeWelcomeCreation', [ &$welcome_creation_msg, &$injected_html ] );

		$this->displaySuccessfulAction(
			'signup',
			$this->msg( 'welcomeuser', $this->getUser()->getName() ),
			$welcome_creation_msg, $injected_html
		);
	}

	/**
	 * Display a "successful action" page.
	 *
	 * @param string $type Condition of return to; see `executeReturnTo`
	 * @param string|Message $title Page's title
	 * @param string $msgname
	 * @param string $injected_html
	 */
	private function displaySuccessfulAction( $type, $title, $msgname, $injected_html ) {
		$out = $this->getOutput();
		$out->setPageTitle( $title );
		if ( $msgname ) {
			$out->addWikiMsg( $msgname, wfEscapeWikiText( $this->getUser()->getName() ) );
		}

		$out->addHTML( $injected_html );

		$this->executeReturnTo( $type );
	}

	/**
	 * Output a message that informs the user that they cannot create an account because
	 * there is a block on them or their IP which prevents account creation.  Note that
	 * User::isBlockedFromCreateAccount(), which gets this block, ignores the 'hardblock'
	 * setting on blocks (bug 13611).
	 * @param Block $block The block causing this error
	 * @throws ErrorPageError
	 */
	function userBlockedMessage( Block $block ) {
		# Let's be nice about this, it's likely that this feature will be used
		# for blocking large numbers of innocent people, e.g. range blocks on
		# schools. Don't blame it on the user. There's a small chance that it
		# really is the user's fault, i.e. the username is blocked and they
		# haven't bothered to log out before trying to create an account to
		# evade it, but we'll leave that to their guilty conscience to figure
		# out.
		$errorParams = [
			$block->getTarget(),
			$block->mReason ? $block->mReason : $this->msg( 'blockednoreason' )->text(),
			$block->getByName()
		];

		if ( $block->getType() === Block::TYPE_RANGE ) {
			$errorMessage = 'cantcreateaccount-range-text';
			$errorParams[] = $this->getRequest()->getIP();
		} else {
			$errorMessage = 'cantcreateaccount-text';
		}

		throw new ErrorPageError(
			'cantcreateaccounttitle',
			$errorMessage,
			$errorParams
		);
	}

	/**
	 * Add a "return to" link or redirect to it.
	 * Extensions can use this to reuse the "return to" logic after
	 * inject steps (such as redirection) into the login process.
	 *
	 * @param string $type One of the following:
	 *    - error: display a return to link ignoring $wgRedirectOnLogin
	 *    - signup: display a return to link using $wgRedirectOnLogin if needed
	 *    - success: display a return to link using $wgRedirectOnLogin if needed
	 *    - successredirect: send an HTTP redirect using $wgRedirectOnLogin if needed
	 * @param string $returnTo
	 * @param array|string $returnToQuery
	 * @param bool $stickHTTPs Keep redirect link on HTTPs
	 * @since 1.22
	 */
	public function showReturnToPage(
		$type, $returnTo = '', $returnToQuery = '', $stickHTTPs = false
	) {
		$this->mReturnTo = $returnTo;
		$this->mReturnToQuery = $returnToQuery;
		$this->mStickHTTPS = $stickHTTPs;
		$this->executeReturnTo( $type );
	}

	/**
	 * Add a "return to" link or redirect to it.
	 *
	 * @param string $type One of the following:
	 *    - error: display a return to link ignoring $wgRedirectOnLogin
	 *    - signup: display a return to link using $wgRedirectOnLogin if needed
	 *    - success: display a return to link using $wgRedirectOnLogin if needed
	 *    - successredirect: send an HTTP redirect using $wgRedirectOnLogin if needed
	 */
	private function executeReturnTo( $type ) {
		global $wgRedirectOnLogin, $wgSecureLogin;

		if ( $type != 'error' && $wgRedirectOnLogin !== null ) {
			$returnTo = $wgRedirectOnLogin;
			$returnToQuery = [];
		} else {
			$returnTo = $this->mReturnTo;
			$returnToQuery = wfCgiToArray( $this->mReturnToQuery );
		}

		// Allow modification of redirect behavior
		Hooks::run( 'PostLoginRedirect', [ &$returnTo, &$returnToQuery, &$type ] );

		$returnToTitle = Title::newFromText( $returnTo );
		if ( !$returnToTitle ) {
			$returnToTitle = Title::newMainPage();
		}

		if ( $wgSecureLogin && !$this->mStickHTTPS ) {
			$options = [ 'http' ];
			$proto = PROTO_HTTP;
		} elseif ( $wgSecureLogin ) {
			$options = [ 'https' ];
			$proto = PROTO_HTTPS;
		} else {
			$options = [];
			$proto = PROTO_RELATIVE;
		}

		if ( $type == 'successredirect' ) {
			$redirectUrl = $returnToTitle->getFullURL( $returnToQuery, false, $proto );
			$this->getOutput()->redirect( $redirectUrl );
		} else {
			$this->getOutput()->addReturnTo( $returnToTitle, $returnToQuery, null, $options );
		}
	}

	/**
	 * @param string $msg
	 * @param string $msgtype
	 * @throws ErrorPageError
	 * @throws Exception
	 * @throws FatalError
	 * @throws MWException
	 * @throws PermissionsError
	 * @throws ReadOnlyError
	 * @private
	 */
	function mainLoginForm( $msg, $msgtype = 'error' ) {
		global $wgEnableEmail, $wgEnableUserEmail;
		global $wgHiddenPrefs, $wgLoginLanguageSelector;
		global $wgAuth, $wgEmailConfirmToEdit;
		global $wgSecureLogin, $wgPasswordResetRoutes;
		global $wgExtendedLoginCookieExpiration, $wgCookieExpiration;

		$titleObj = $this->getPageTitle();
		$user = $this->getUser();
		$out = $this->getOutput();

		if ( $this->mType == 'signup' ) {
			// Block signup here if in readonly. Keeps user from
			// going through the process (filling out data, etc)
			// and being informed later.
			$permErrors = $titleObj->getUserPermissionsErrors( 'createaccount', $user, true );
			if ( count( $permErrors ) ) {
				throw new PermissionsError( 'createaccount', $permErrors );
			} elseif ( $user->isBlockedFromCreateAccount() ) {
				$this->userBlockedMessage( $user->isBlockedFromCreateAccount() );

				return;
			} elseif ( wfReadOnly() ) {
				throw new ReadOnlyError;
			}
		}

		// Pre-fill username (if not creating an account, bug 44775).
		if ( $this->mUsername == '' && $this->mType != 'signup' ) {
			if ( $user->isLoggedIn() ) {
				$this->mUsername = $user->getName();
			} else {
				$this->mUsername = $this->getRequest()->getSession()->suggestLoginUsername();
			}
		}

		// Generic styles and scripts for both login and signup form
		$out->addModuleStyles( [
			'mediawiki.ui',
			'mediawiki.ui.button',
			'mediawiki.ui.checkbox',
			'mediawiki.ui.input',
			'mediawiki.special.userlogin.common.styles'
		] );

		if ( $this->mType == 'signup' ) {
			// Additional styles and scripts for signup form
			$out->addModules( [
				'mediawiki.special.userlogin.signup.js'
			] );
			$out->addModuleStyles( [
				'mediawiki.special.userlogin.signup.styles'
			] );

			$template = new UsercreateTemplate( $this->getConfig() );

			// Must match number of benefits defined in messages
			$template->set( 'benefitCount', 3 );

			$q = 'action=submitlogin&type=signup';
			$linkq = 'type=login';
		} else {
			// Additional styles for login form
			$out->addModuleStyles( [
				'mediawiki.special.userlogin.login.styles'
			] );

			$template = new UserloginTemplate( $this->getConfig() );

			$q = 'action=submitlogin&type=login';
			$linkq = 'type=signup';
		}

		if ( $this->mReturnTo !== '' ) {
			$returnto = '&returnto=' . wfUrlencode( $this->mReturnTo );
			if ( $this->mReturnToQuery !== '' ) {
				$returnto .= '&returntoquery=' .
					wfUrlencode( $this->mReturnToQuery );
			}
			$q .= $returnto;
			$linkq .= $returnto;
		}

		# Don't show a "create account" link if the user can't.
		if ( $this->showCreateOrLoginLink( $user ) ) {
			# Pass any language selection on to the mode switch link
			if ( $wgLoginLanguageSelector && $this->mLanguage ) {
				$linkq .= '&uselang=' . $this->mLanguage;
			}
			// Supply URL, login template creates the button.
			$template->set( 'createOrLoginHref', $titleObj->getLocalURL( $linkq ) );
		} else {
			$template->set( 'link', '' );
		}

		$resetLink = $this->mType == 'signup'
			? null
			: is_array( $wgPasswordResetRoutes ) && in_array( true, array_values( $wgPasswordResetRoutes ) );

		$template->set( 'header', '' );
		$template->set( 'formheader', '' );
		$template->set( 'skin', $this->getSkin() );
		$template->set( 'name', $this->mUsername );
		$template->set( 'password', $this->mPassword );
		$template->set( 'retype', $this->mRetype );
		$template->set( 'createemailset', $this->mCreateaccountMail );
		$template->set( 'email', $this->mEmail );
		$template->set( 'realname', $this->mRealName );
		$template->set( 'domain', $this->mDomain );
		$template->set( 'reason', $this->mReason );

		$template->set( 'action', $titleObj->getLocalURL( $q ) );
		$template->set( 'message', $msg );
		$template->set( 'messagetype', $msgtype );
		$template->set( 'createemail', $wgEnableEmail && $user->isLoggedIn() );
		$template->set( 'userealname', !in_array( 'realname', $wgHiddenPrefs ) );
		$template->set( 'useemail', $wgEnableEmail );
		$template->set( 'emailrequired', $wgEmailConfirmToEdit );
		$template->set( 'emailothers', $wgEnableUserEmail );
		$template->set( 'canreset', $wgAuth->allowPasswordChange() );
		$template->set( 'resetlink', $resetLink );
		$template->set( 'canremember', $wgExtendedLoginCookieExpiration === null ?
			( $wgCookieExpiration > 0 ) :
			( $wgExtendedLoginCookieExpiration > 0 ) );
		$template->set( 'usereason', $user->isLoggedIn() );
		$template->set( 'remember', $this->mRemember );
		$template->set( 'cansecurelogin', ( $wgSecureLogin === true ) );
		$template->set( 'stickhttps', (int)$this->mStickHTTPS );
		$template->set( 'loggedin', $user->isLoggedIn() );
		$template->set( 'loggedinuser', $user->getName() );

		if ( $this->mType == 'signup' ) {
			$template->set( 'token', self::getCreateaccountToken()->toString() );
		} else {
			$template->set( 'token', self::getLoginToken()->toString() );
		}

		# Prepare language selection links as needed
		if ( $wgLoginLanguageSelector ) {
			$template->set( 'languages', $this->makeLanguageSelector() );
			if ( $this->mLanguage ) {
				$template->set( 'uselang', $this->mLanguage );
			}
		}

		$template->set( 'secureLoginUrl', $this->mSecureLoginUrl );
		// Use signupend-https for HTTPS requests if it's not blank, signupend otherwise
		$usingHTTPS = $this->mRequest->getProtocol() == 'https';
		$signupendHTTPS = $this->msg( 'signupend-https' );
		if ( $usingHTTPS && !$signupendHTTPS->isBlank() ) {
			$template->set( 'signupend', $signupendHTTPS->parse() );
		} else {
			$template->set( 'signupend', $this->msg( 'signupend' )->parse() );
		}

		// If using HTTPS coming from HTTP, then the 'fromhttp' parameter must be preserved
		if ( $usingHTTPS ) {
			$template->set( 'fromhttp', $this->mFromHTTP );
		}

		// Give authentication and captcha plugins a chance to modify the form
		$wgAuth->modifyUITemplate( $template, $this->mType );
		if ( $this->mType == 'signup' ) {
			Hooks::run( 'UserCreateForm', [ &$template ] );
		} else {
			Hooks::run( 'UserLoginForm', [ &$template ] );
		}

		$out->disallowUserJs(); // just in case...
		$out->addTemplate( $template );
	}

	/**
	 * Whether the login/create account form should display a link to the
	 * other form (in addition to whatever the skin provides).
	 *
	 * @param User $user
	 * @return bool
	 */
	private function showCreateOrLoginLink( &$user ) {
		if ( $this->mType == 'signup' ) {
			return true;
		} elseif ( $user->isAllowed( 'createaccount' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Check if a session cookie is present.
	 *
	 * This will not pick up a cookie set during _this_ request, but is meant
	 * to ensure that the client is returning the cookie which was set on a
	 * previous pass through the system.
	 *
	 * @private
	 * @return bool
	 */
	function hasSessionCookie() {
		global $wgDisableCookieCheck, $wgInitialSessionId;

		return $wgDisableCookieCheck || (
			$wgInitialSessionId &&
			$this->getRequest()->getSession()->getId() === (string)$wgInitialSessionId
		);
	}

	/**
	 * Get the login token from the current session
	 * @since 1.27 returns a MediaWiki\Session\Token instead of a string
	 * @return MediaWiki\Session\Token
	 */
	public static function getLoginToken() {
		global $wgRequest;
		return $wgRequest->getSession()->getToken( '', 'login' );
	}

	/**
	 * Formerly randomly generated a login token that would be returned by
	 * $this->getLoginToken().
	 *
	 * Since 1.27, this is a no-op. The token is generated as necessary by
	 * $this->getLoginToken().
	 *
	 * @deprecated since 1.27
	 */
	public static function setLoginToken() {
		wfDeprecated( __METHOD__, '1.27' );
	}

	/**
	 * Remove any login token attached to the current session
	 */
	public static function clearLoginToken() {
		global $wgRequest;
		$wgRequest->getSession()->resetToken( 'login' );
	}

	/**
	 * Get the createaccount token from the current session
	 * @since 1.27 returns a MediaWiki\Session\Token instead of a string
	 * @return MediaWiki\Session\Token
	 */
	public static function getCreateaccountToken() {
		global $wgRequest;
		return $wgRequest->getSession()->getToken( '', 'createaccount' );
	}

	/**
	 * Formerly randomly generated a createaccount token that would be returned
	 * by $this->getCreateaccountToken().
	 *
	 * Since 1.27, this is a no-op. The token is generated as necessary by
	 * $this->getCreateaccountToken().
	 *
	 * @deprecated since 1.27
	 */
	public static function setCreateaccountToken() {
		wfDeprecated( __METHOD__, '1.27' );
	}

	/**
	 * Remove any createaccount token attached to the current session
	 */
	public static function clearCreateaccountToken() {
		global $wgRequest;
		$wgRequest->getSession()->resetToken( 'createaccount' );
	}

	/**
	 * Renew the user's session id, using strong entropy
	 */
	private function renewSessionId() {
		global $wgSecureLogin, $wgCookieSecure;
		if ( $wgSecureLogin && !$this->mStickHTTPS ) {
			$wgCookieSecure = false;
		}

		SessionManager::getGlobalSession()->resetId();
	}

	/**
	 * @param string $type
	 * @private
	 */
	function cookieRedirectCheck( $type ) {
		$titleObj = SpecialPage::getTitleFor( 'Userlogin' );
		$query = [ 'wpCookieCheck' => $type ];
		if ( $this->mReturnTo !== '' ) {
			$query['returnto'] = $this->mReturnTo;
			$query['returntoquery'] = $this->mReturnToQuery;
		}
		$check = $titleObj->getFullURL( $query );

		$this->getOutput()->redirect( $check );
	}

	/**
	 * @param string $type
	 * @private
	 */
	function onCookieRedirectCheck( $type ) {
		if ( !$this->hasSessionCookie() ) {
			if ( $type == 'new' ) {
				$this->mainLoginForm( $this->msg( 'nocookiesnew' )->parse() );
			} elseif ( $type == 'login' ) {
				$this->mainLoginForm( $this->msg( 'nocookieslogin' )->parse() );
			} else {
				# shouldn't happen
				$this->mainLoginForm( $this->msg( 'error' )->text() );
			}
		} else {
			$this->successfulLogin();
		}
	}

	/**
	 * Produce a bar of links which allow the user to select another language
	 * during login/registration but retain "returnto"
	 *
	 * @return string
	 */
	function makeLanguageSelector() {
		$msg = $this->msg( 'loginlanguagelinks' )->inContentLanguage();
		if ( $msg->isBlank() ) {
			return '';
		}
		$langs = explode( "\n", $msg->text() );
		$links = [];
		foreach ( $langs as $lang ) {
			$lang = trim( $lang, '* ' );
			$parts = explode( '|', $lang );
			if ( count( $parts ) >= 2 ) {
				$links[] = $this->makeLanguageSelectorLink( $parts[0], trim( $parts[1] ) );
			}
		}

		return count( $links ) > 0 ? $this->msg( 'loginlanguagelabel' )->rawParams(
			$this->getLanguage()->pipeList( $links ) )->escaped() : '';
	}

	/**
	 * Create a language selector link for a particular language
	 * Links back to this page preserving type and returnto
	 *
	 * @param string $text Link text
	 * @param string $lang Language code
	 * @return string
	 */
	function makeLanguageSelectorLink( $text, $lang ) {
		if ( $this->getLanguage()->getCode() == $lang ) {
			// no link for currently used language
			return htmlspecialchars( $text );
		}
		$query = [ 'uselang' => $lang ];
		if ( $this->mType == 'signup' ) {
			$query['type'] = 'signup';
		}
		if ( $this->mReturnTo !== '' ) {
			$query['returnto'] = $this->mReturnTo;
			$query['returntoquery'] = $this->mReturnToQuery;
		}

		$attr = [];
		$targetLanguage = Language::factory( $lang );
		$attr['lang'] = $attr['hreflang'] = $targetLanguage->getHtmlCode();

		return Linker::linkKnown(
			$this->getPageTitle(),
			htmlspecialchars( $text ),
			$attr,
			$query
		);
	}

	protected function getGroupName() {
		return 'login';
	}

	/**
	 * Private function to check password expiration, until AuthManager comes
	 * along to handle that.
	 * @param User $user
	 * @return string|bool
	 */
	private function checkUserPasswordExpired( User $user ) {
		global $wgPasswordExpireGrace;
		$dbr = wfGetDB( DB_SLAVE );
		$ts = $dbr->selectField( 'user', 'user_password_expires', [ 'user_id' => $user->getId() ] );

		$expired = false;
		$now = wfTimestamp();
		$expUnix = wfTimestamp( TS_UNIX, $ts );
		if ( $ts !== null && $expUnix < $now ) {
			$expired = ( $expUnix + $wgPasswordExpireGrace < $now ) ? 'hard' : 'soft';
		}
		return $expired;
	}

	protected function getSubpagesForPrefixSearch() {
		return [ 'signup' ];
	}
}
