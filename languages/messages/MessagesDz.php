<?php
/** Dzongkha (ཇོང་ཁ)
 *
 * @ingroup Language
 * @file
 *
 * @author CFynn
 * @author Tenzin
 * @author Ævar Arnfjörð Bjarmason <avarab@gmail.com>
 */

$digitTransformTable = array(
	'0' => '༠', # &#x0f20;
	'1' => '༡', # &#x0f21;
	'2' => '༢', # &#x0f22;
	'3' => '༣', # &#x0f23;
	'4' => '༤', # &#x0f24;
	'5' => '༥', # &#x0f25;
	'6' => '༦', # &#x0f26;
	'7' => '༧', # &#x0f27;
	'8' => '༨', # &#x0f28;
	'9' => '༩', # &#x0f29;
);

$messages = array(
# Dates
'sunday'        => 'འབྲུག་གཟའ་ཟླཝ་',
'monday'        => 'འབྲུག་གཟའ་མིག་དམར་',
'tuesday'       => 'འབྲུག་གཟའ་ལྷགཔ་',
'wednesday'     => 'འབྲུག་གཟའ་ཕུརཔ་',
'thursday'      => 'འབྲུག་གཟའ་པ་སངས་',
'friday'        => 'འབྲུག་གཟའ་སྤེནཔ་',
'saturday'      => 'འབྲུག་གཟའ་ཉིམ་',
'sun'           => 'ཟླཝ།',
'mon'           => 'མིགམ།',
'tue'           => 'ལྷགཔ།',
'wed'           => 'ཕུརཔ།',
'thu'           => 'སྤ་སངས།',
'fri'           => 'སྤེནཔ།',
'sat'           => 'ཉིམ།',
'january'       => 'སྤྱི་ཟླ་དང་པ།',
'february'      => 'སྤྱི་ཟླ་གཉིས་པ།',
'march'         => 'སྤྱི་ཟླ་གསུམ་པ།',
'april'         => 'སྤྱི་ཟླ་བཞི་པ།',
'may_long'      => 'སྤྱི་ཟླ་ལྔ་པ།',
'june'          => 'སྤྱི་ཟླ་དྲུག་པ།',
'july'          => 'སྤྱི་ཟླ་བདུན་པ།',
'august'        => 'སྤྱི་ཟླ་བརྒྱད་པ།',
'september'     => 'སྤྱི་ཟླ་དགུ་པ།',
'october'       => 'སྤྱི་ཟླ་བཅུ་པ།',
'november'      => 'སྤྱི་ཟླ་བཅུ་གཅིག་པ།',
'december'      => 'སྤྱི་ཟླ་བཅུ་གཉིས་པ།',
'january-gen'   => 'སྤྱི་ཟླ་ ༡ པའི་',
'february-gen'  => 'སྤྱི་ཟླ་ ༢ པའི་',
'march-gen'     => 'སྤྱི་ཟླ་ ༣ པའི་',
'april-gen'     => 'སྤྱི་ཟླ་ ༤ པའི་',
'may-gen'       => 'སྤྱི་ཟླ་ ༥ པའི་',
'june-gen'      => 'སྤྱི་ཟླ་ ༦ པའི་',
'july-gen'      => 'སྤྱི་ཟླ་ ༧ པའི་',
'august-gen'    => 'སྤྱི་ཟླ་ ༨ པའི་',
'september-gen' => 'སྤྱི་ཟླ་ ༩ པའི་',
'october-gen'   => 'སྤྱི་ཟླ་ ༡༠ པའི་',
'november-gen'  => 'སྤྱི་ཟླ་ ༡༡ པའི་',
'december-gen'  => 'སྤྱི་ཟླ་ ༡༢ པའི་',
'jan'           => 'ཟླ་༡ པ།',
'feb'           => 'ཟླ་༢ པ།',
'mar'           => 'ཟླ་༣ པ།',
'apr'           => 'ཟླ་༤ པ།',
'may'           => 'ཟླ་༥ པ།',
'jun'           => 'ཟླ་༦ པ།',
'jul'           => 'ཟླ་༧ པ།',
'aug'           => 'ཟླ་༨ པ།',
'sep'           => 'ཟླ་༩ པ།',
'oct'           => 'ཟླ་༡༠ པ།',
'nov'           => 'ཟླ་༡༡ པ།',
'dec'           => 'ཟླ་༡༢ པ།',

# Categories related messages
'category_header'        => 'དབྱེ་རིམ་ "$1" ནང་གི་ཤོག་ལེབ་ཚུ།',
'subcategories'          => 'ཡན་ལག་དབྱེ་རིམ།',
'category-media-header'  => 'དབྱེ་རིམ་ \\"$1\\" ནང་གི་བརྡ་བརྒྱུད།',
'category-empty'         => "''ད་ལྟོ་དབྱེ་རིམ་དེ་ནང་ ཤོག་ལེབ་དང་བརྡ་བརྒྱུད་ག་ནི་ཡང་མིན་འདུག།''",
'listingcontinuesabbrev' => 'འཕྲོ་མཐུད།',

'about'     => 'སྐོར་ལས།',
'newwindow' => '(ཝིན་ཌོ་གསརཔ་ནང་ ཁ་ཕྱེཝ་ཨིན།)',
'cancel'    => 'ཆ་མེད་གཏང་།',
'qbfind'    => 'འཚོལ།',
'qbedit'    => 'ཞུན་དག',
'mytalk'    => 'ངེ་གི་བློ།',

'errorpagetitle'   => 'འཛོལ་བ།',
'returnto'         => '$1 ལུ་ལོག།',
'tagline'          => '{{SITENAME}} ལས།',
'help'             => 'གྲོགས་རམ།',
'search'           => 'འཚོལ་ཞིབ།',
'searchbutton'     => 'འཚོལ་ཞིབ།',
'searcharticle'    => 'འགྱོ།',
'history'          => 'ཤོག་ལེབ་སྤྱོད་ཤུལ།',
'history_short'    => 'སྤྱོད་ཤུལ།',
'printableversion' => 'དཔར་བསྐྲུན་འབད་བཏུབ་པའི་ཐོན་རིམ།',
'permalink'        => 'རྟག་བརྟན་འབྲེལ་ལམ།',
'edit'             => 'ཞུན་དག།',
'editthispage'     => 'ཤོག་ལེབ་འདི་ ཞུན་དག་འབད།',
'delete'           => 'བཏོན་གཏང་།',
'protect'          => 'ཉེན་སྐྱོབ།',
'newpage'          => 'ཤོག་ལེབ་གསརཔ།',
'talkpage'         => 'ཤོག་ལེབ་འདི་གྲོས་བསྡུར་འབད།',
'talkpagelinktext' => 'བློ།',
'personaltools'    => 'རང་དོན་ལག་ཆས།',
'talk'             => 'གྲོས་བསྡུར།',
'views'            => 'མཐོང་སྣང་།',
'toolbox'          => 'ལག་ཆས་སྒྲོམ།',
'redirectedfrom'   => '($1 ལས་ ལོག་བཏང་ཡོདཔ་)',
'redirectpagesub'  => 'ཤོག་ལེབ་སླར་ལོག་འབད།',
'jumpto'           => 'འཕྲོ་མཐུད་འགྱོ་:',
'jumptonavigation' => 'འཛུལ་འགྱོ་',
'jumptosearch'     => 'འཚོལ་ཞིབ།',

# All link text and link target definitions of links into project namespace that get used by other message strings, with the exception of user group pages (see grouppage) and the disambiguation template definition (see disambiguations).
'aboutsite'            => '{{SITENAME}} གི་སྐོར་ལས།',
'aboutpage'            => 'Project:སྐོར་ལས།',
'bugreports'           => 'སྐྱོན་གྱི་སྙན་ཞུ།',
'bugreportspage'       => 'Project:སྐྱོན་གྱི་སྙན་ཞུ།',
'copyrightpage'        => '{{ns:project}}:འདྲ་བཤུས་འབད་ཆ།',
'currentevents'        => 'ད་ལྟོའི་བྱུང་ལས།',
'currentevents-url'    => 'Project:ད་ལྟོའི་བྱུང་ལས།',
'disclaimers'          => 'ཁས་མི་ལེན་པ།',
'disclaimerpage'       => 'Project: སྤྱིར་བཏང་ཁས་མི་ལེན་པ།',
'edithelp'             => 'ཞུན་དག་གྲོགས་རམ།',
'edithelppage'         => 'Help: ཞུན་དག།',
'helppage'             => 'Help:ནང་དོན།',
'mainpage'             => 'མ་ཤོག།',
'mainpage-description' => 'མ་ཤོག།',
'portal'               => 'མི་སྡེའི་སྒོ་ར།',
'portal-url'           => 'Project:མི་སྡེའི་སྒོ་ར།',
'privacy'              => 'སྒེར་གསང་སྲིད་བྱུས།',
'privacypage'          => 'Project:སྒེར་གསང་སྲིད་བྱུས།',

'retrievedfrom'       => '"$1" ལས་ སླར་འདྲེན་འབད་ཡོདཔ།',
'youhavenewmessages'  => 'ཁྱོད་ལུ་ $1 ($2) འདུག།',
'newmessageslink'     => 'འཕྲིན་དོན་གསརཔ།',
'newmessagesdifflink' => 'བསྒྱུར་བཅོས་མཇུག།',
'editsection'         => 'ཞུན་དག།',
'editold'             => 'ཞུན་དག།',
'editsectionhint'     => 'དབྱེ་ཚན་:$1 ཞུན་དག་འབད།',
'toc'                 => 'ནང་དོན།',
'showtoc'             => 'སྟོན།',
'hidetoc'             => 'སྦ།',
'site-rss-feed'       => '$1 ཨར་ཨེསི་ཨེསི་ འབྱུང་ས།',
'site-atom-feed'      => '$1 ཨེ་ཊོམ་ འབྱུང་ས།',
'page-rss-feed'       => '"$1" ཨར་ཨེསི་ཨེསི་འབྱུང་ས།',

# Short words for each namespace, by default used in the namespace tab in monobook
'nstab-user'     => 'ལག་ལེན་པའི་ཤོག་ལེབ།',
'nstab-project'  => 'ལས་འགུལ་ཤོག་ལེབ།',
'nstab-image'    => 'ཡིག་སྣོད།',
'nstab-template' => 'ཊེམ་པེལེཊི།',
'nstab-category' => 'དབྱེ་རིམ།',

# General errors
'badtitle'       => 'མགོ་མིང་བྱང་ཉེས།',
'badtitletext'   => 'ཞུ་བ་འབད་ཡོད་པའི་ཤོག་ལེབ་མགོ་མིང་འདི་ ནུས་མེད་ སྟོངམ་ ཡང་ན་ བདེན་མེད་འབྲེལ་མཐུད་ཅན་གྱི་ནང་ཁུལ་-སྐད་ཡིག་ ཡངན་ ནང་ཁུལ་-ཝི་ཀི་མགོ་མིང་ཨིན་པས། དེ་ནང་ མགོ་མིང་ནང་ལུ་ལག་ལེན་འཐབ་མ་བཏུབ་པའི་ཡིག་འབྲུ་གཅིག་ ཡང་ན་ ལེ་ཤ་ཡོདཔ་འོང་།',
'viewsource'     => 'འབྱུང་ས་སྟོན།',
'viewsourcefor'  => '$1 གི་',
'viewsourcetext' => 'ཁྱོད་ཀྱིས་ ཤོག་ལེབ་འདི་གི་འབྱུང་ས་བལྟ་བཏུབ་པའི་ཁར་ འདྲ་བཤུས་ཡང་རྐྱབ་བཏུབ་ཨིན་:',

# Login and logout pages
'yourname'                => 'ལག་ལེན་པའི་མིང་:',
'yourpassword'            => 'ཆོག་ཡིག:',
'remembermypassword'      => 'གློག་རིག་དེ་གུར་ ངེ་གི་ནང་བསྐྱོད་སེམས་ཁར་བཞག།',
'login'                   => 'ནང་བསྐྱོད།',
'nav-login-createaccount' => 'ནང་བསྐྱོད་འབད་ / རྩིས་ཐོ་གསརཔ་བཟོ།',
'loginprompt'             => '{{SITENAME}} ནང་ལུ་ ནང་བསྐྱོད་འབད་ནིའི་དོན་ལུ་ ཁྱོད་ཀྱིས་ ཀུ་ཀིསི་འདི་ལྕོགས་ཅན་བཟོ་དགོ།',
'userlogin'               => 'ནང་བསྐྱོད་འབད་ / རྩིས་ཐོ་གསརཔ་བཟོ།',
'logout'                  => 'ཕྱིར་བསྐྱོད།',
'userlogout'              => 'ཕྱིར་བསྐྱོད།',
'nologin'                 => 'ནང་བསྐྱོད་མེད་ག? $1',
'nologinlink'             => 'རྩིས་ཐོ་གསརཔ་བཟོ།',
'createaccount'           => 'རྩིས་ཐོ་གསརཔ་བཟོ།',
'gotaccount'              => 'ཧེ་མ་ལས་རྩིས་ཐོ་ཡོད་ག? $1',
'gotaccountlink'          => 'ནང་བསྐྱོད།',
'yourrealname'            => 'མིང་ངོ་མ:',
'prefs-help-realname'     => 'མིང་ངོ་མ་འདི་ གདམ་ཁ་ཅན་ཨིན་རུང་ ཐོ་བཀོད་འབད་བ་ཅིན་ ཁྱོད་རའི་ལཱ་གི་ཁྱད་བརྗོད་ཀྱི་དོན་ལུ་ ལག་ལེན་འཐབ་འོང་།',
'loginsuccesstitle'       => 'ནང་བསྐྱོད་ལེགས་ཤོམ་འབད་ཡོདཔ།',
'loginsuccess'            => "'''ད་འབདན་ཁྱོད་  {{SITENAME}} ནང་ \"\$1\" སྦེ་ ནང་བསྐྱོད་འབད་ཡོདཔ།'''",
'nosuchuser'              => 'མིང་ "$1" བཟུམ་གྱི་ལག་ལེན་པ་མེད།
སྡེབ་དཔྱད་འབད་ ཡང་ན་ རྩིས་ཐོ་གསརཔ་ཅིག་བཟོ།',
'nosuchusershort'         => 'མིང་ "<nowiki>$1</nowiki>" བཟུམ་གྱི་ལག་ལེན་པ་མེད།
སྡེབ་དཔྱད་འབད།',
'nouserspecified'         => 'ལག་ལེན་པའི་མིང་ གསལ་བཀོད་འབད་དགོ།',
'wrongpassword'           => 'མ་བདེན་པའི་ཆོག་ཡིག་བཙུགས་ཡོདཔ། ལོག་འབད་རྩོལ་བསྐྱེད།',
'wrongpasswordempty'      => 'ཆོག་ཡིག་བཙུགས་མི་འདི་སྟོངམ་ཨིན་པས། ལོག་འབད་རྩོལ་བསྐྱེད།',
'passwordtooshort'        => 'ཁྱོད་ཀྱི་ཆོག་ཡིག་འདི་ནུས་མེད་ ཡང་ན་ ཐུང་དྲགས་ནུག།
ཆོག་ཡིག་འདི་ ཡིག་འབྲུ་ཉུང་ཤོས་ $1 དགོ་པའི་ཁར་ ལག་ལེན་པའི་མིང་དང་ཡང་མ་འདྲཝ་ཅིག་སྦེ་དགོཔ་ཨིན།',
'mailmypassword'          => 'གློག་འཕྲིན་ཆོག་ཡིག།',
'passwordremindertitle'   => '{{SITENAME}} གི་དོན་ལུ་ གནས་སྐབས་ཅིག་གི་ཆོག་ཡིག་གསརཔ།',
'passwordremindertext'    => 'མི་གང་རུང་(ཡང་ན་ ཨའི་པི་ཁ་བྱང་ $1 ནང་ལས་ ཁྱོད་བཟུམ་ཅིག་གིས་)
{{SITENAME}} ($4) གི་དོན་ལུ་ ཆོག་ཡིག་གསརཔ་ཅིག་བཏང་ཡོད་པའི་སྐོར་ལས་ཞུ་བ་འབད་ནུག།
ད་ལས་ཕར་ ལག་ལེན་པ་ \\"$2\\" གི་ཆོག་ཡིག་འདི་ \\"$3\\" ཨིན།
ཁྱོད་ཀྱིས་ ད་ལྟོ་ར་ ནང་བསྐྱོད་འབད་དེ་ཆོག་ཡིག་སོར་དགོ།

མི་གཞན་ཅིག་གིས་ཞུ་བ་འབད་ཡོད་པའི་སྐབས་ལུ་ ཡང་ན་ ཁྱོད་རའི་ཆོག་ཡིག་འདི་སེམས་ཁར་དྲན་ཚུགས་རུང་ བསྒྱུར་བཅོས་འབད་དགོ་མ་མནོ་བ་ཅིན་ འཕྲིན་དོན་དེ་སྣང་མེད་བཞག་སྟེ་ ཧེ་མའི་ཆོག་ཡིག་འདི་ར་ལག་ལེན་འཐབ་རུང་བཏུབ།',
'noemail'                 => 'ལག་ལེན་པ་ "$1" གི་དོན་ལུ་ གློག་འཕྲིན་ཁ་བྱང་ཐོ་བཀོད་མ་འབད་བས།',
'passwordsent'            => '"$1" ནང་ཐོ་བཀོད་འབད་ཡོད་མི་ གློག་འཕྲིན་ཁ་བྱང་ནང་ ཆོག་ཡིག་གསརཔ་ཅིག་བཏང་ནུག།
གློག་འཕྲིན་དེ་ཐོབ་ད་ ལོག་སྟེ་ནང་བསྐྱོད་འབད་གནང་།',
'eauthentsent'            => 'ངེས་དཔྱད་གློག་འཕྲིན་འདི་ གདམ་ཁ་བརྐྱབས་ཡོད་པའི་གློག་འཕྲིན་ཁ་བྱང་ལུ་ བཏང་ཡོདཔ།
གཞན་གློག་འཕྲིན་གང་རུང་ རྩིས་ཐོ་ནང་མ་གཏང་པའི་ཧེ་མ་ རྩིས་ཐོ་འདི་ཁྱོད་ར་གི་ཨིན་པའི་ངེས་དཔྱད་འབད་ནི་ལུ་ གློག་འཕྲིན་ནང་གི་བཀོད་རྒྱ་དང་འཁྲིལ་དགོཔ་ཨིན།',

# Edit page toolbar
'bold_sample'     => 'ཚིག་ཡིག་རྒྱགས་པ།',
'bold_tip'        => 'ཚིག་ཡིག་རྒྱགས་པ།',
'italic_sample'   => 'ཨའི་ཊ་ལིཀ་ཚིག་ཡིག།',
'italic_tip'      => 'ཨའི་ཊ་ལིཀ་ཚིག་ཡིག།',
'link_sample'     => 'འབྲེལ་ལམ་མགོ་མིང་།',
'link_tip'        => 'ནང་འཁོད་འབྲེལ་ལམ།',
'extlink_sample'  => 'http://www.example.com འབྲེལ་ལམ མགོ་མིང་།',
'extlink_tip'     => 'ཕྱིའི་འབྲེལ་ལམ་ (http:// prefix སེམས་ཁར་བཞག)',
'headline_sample' => 'གཙོ་དོན་ཚིག་ཡིག།',
'headline_tip'    => 'གནས་རིམ་ ༢ གཙོ་དོན།',
'math_sample'     => 'ནཱ་ལུ་ ཐབས་རྟགས་བཙུགས།',
'math_tip'        => 'ཨང་རྩིས་ཐབས་རྟགས་ (LaTeX)',
'nowiki_sample'   => 'ནཱ་ལུ་ རྩ་སྒྲིག་མ་འབད་བའི་ཚིག་ཡིག་བཙུགས།',
'nowiki_tip'      => 'ཝི་ཀི་རྩ་སྒྲིག་ སྣང་མེད་བཞག།',
'image_tip'       => 'གནས་འདྲེན་ཡིག་སྣོད།',
'media_tip'       => 'ཡིག་སྣོད་ཀྱི་འབྲེལ་ལམ།',
'sig_tip'         => 'དུས་བཀོད་དང་གཅིག་ཁར་ ཁྱོད་རའི་མིང་རྟགས།',
'hr_tip'          => 'ཐད་སྙོམས་གྲལ་ཐིག་ (ཉུང་སུ་སྦེ་ལག་ལེན་འཐབ)',

# Edit pages
'summary'                => 'བཅུད་དོན།',
'subject'                => 'དོན་ཚན་/གཙོ་དོན།',
'minoredit'              => 'འདི་ གལ་གནད་ཆུང་བའི་ཞུན་དག་ཅིག་ཨིན།',
'watchthis'              => 'ཤོག་ལེབ་འདི་ལུ་བལྟ།',
'savearticle'            => 'ཤོག་ལེབ་སྲུངས།',
'preview'                => 'སྔོན་ལྟ།',
'showpreview'            => 'སྔོན་ལྟ་སྟོན།',
'showdiff'               => 'བསྒྱུར་བཅོས་ཚུ་སྟོན།',
'anoneditwarning'        => "'''ཉེན་བརྡ:''' ཁྱོད་ཀྱིས་ ནང་བསྐྱོད་མ་འབད་བས།
ཁྱོད་ཀྱི་ ཨའི་པི་ཁ་བྱང་འདི་ ཤོག་ལེབ་ཀྱི་ཞུན་དག་སྤྱོད་ཤུལ་འདི་ནང་ ཐོ་བཀོད་འབད་དེ་བཞག་འོང་།",
'summary-preview'        => 'བཅུད་དོན་སྔོན་ལྟ།',
'blockedtext'            => "<big>'''ཁྱོད་ཀྱི་ ལག་ལེན་པའི་མིང་ ཡང་ན་ ཨའི་པི་ཁ་བྱང་འདི་ བཀག་དམ་འབད་ཡོདཔ།'''</big>

དེ་ཡང་ $1 གིས་ བཀག་ཡོདཔ། བཀག་དགོ་པའི་རྒྱུ་མཚན་འདི་  ''$2''ཨིན་པས།

* འགག་བསུབ་འགོ་བཙུགས་: $8
* འགག་བསུབ་དུས་ཡོལ་: $6
* རེ་བ་ལྟར་གྱི་འགག་བསུབ་: $7

ཁྱོད་ཀྱིས་ འགག་བསུབ་ཀྱི་སྐོར་ལས་ གྲོས་བསྡུར་འབད་ནི་གི་དོན་ལས་ $1 དང་ཡང་ན་ གཞན་  [[{{MediaWiki:Grouppage-sysop}}|administrator]] དང་འབྲེལ་བ་འཐབ།\\n
ཁྱོད་ཀྱིས་ ཁྱོད་རའི་ [[Special:Preferences|account preferences]] ནང་ ནུས་ལྡན་གློག་འཕྲིན་ཁ་བྱང་ཅིག་ གསལ་བཀོད་མ་འབད་ཚུན་དང་ དེ་ལག་ལེན་འཐབ་ནི་ལས་འགག་བསུབ་མ་འབད་བ་ཅིན་རྐྱངམ་ཅིག་ 'ལག་ལེན་པ་ལུ་ གློག་འཕྲིན་གཏང་' གི་ཁྱད་ཆོས་འདི་ ལག་ལེན་འཐབ་མི་བཏུབ་ཨིན།
ཁྱོད་ཀྱི་ད་ལྟོའི་ཨའི་པི་ཁ་བྱང་འདི་ $3, དང་ འགག་བསུབ་ཨའི་ཌི་འདི་ #$5 ཨིན། དེ་གཉིས་ ཡང་ན་ ག་ཨིན་རུང་ཅིག་ འདྲི་དཔྱད་གང་རུང་གི་གྲངས་སུ་བཙུགས་གནང་།",
'newarticle'             => '(གསརཔ་)',
'newarticletext'         => "ཁྱོད་ཀྱིས་ ཤོག་ལེབ་ཅིག་ལུ་ ད་ཚུན་མེད་པའི་འབྲེལ་མཐུད་འབད་ཡོདཔ།
ཤོག་ལེབ་གསརཔ་བཟོ་ནི་ལུ་ འོག་གི་སྒྲོམ་ནང་ ཡིག་དཔར་རྐྱབས་ (བརྡ་དོན་ཁ་གསལ་གྱི་དོན་ལུ་ [[{{MediaWiki:Helppage}}|help page]] ལུ་བལྟ་)།
གལ་སྲིད་འཛོལ་ཏེ་ཡར་སོང་པ་ཅིན་ '''རྒྱབ་''' ཨེབ་རྟ་ལུ་ ཨེབ་གཏང་འབད།",
'noarticletext'          => 'ད་ལྟོ་ ཤོག་ལེབ་འདི་ནང་ ཚིག་ཡིག་མེདཔ་ཨིནམ་དང་ ཁྱོད་ཀྱིས་ [[Special:Search/{{PAGENAME}}| ཤོག་ལེབ་མགོ་མིང་འདི་ ]] ཤོག་ལེབ་གཞན་ནང་ལས་འཚོལ་བཏུབ་ ཡང་ན་ [{{fullurl:{{FULLPAGENAME}}|action=edit}} ཤོག་ལེབ་འདི་ ཞུན་དག་འབད་བཏུབ།]',
'previewnote'            => '<strong>འདི་ སྔོན་ལྟ་རྐྱངམ་ཅིག་ཨིན་  བསྒྱུར་བཅོས་ཚུ་ ད་ལྟོ་ཚུན་མ་སྲུངས་པས་!</strong>',
'editing'                => '$1 ཞུན་དག་འབད་དོ།',
'editingsection'         => '$1 (དབྱེ་ཚན་)འདི་ ཞུན་དག་འབད་ནི།',
'copyrightwarning'       => '{{SITENAME}} ལུ་ ཕུལ་མི་ཞལ་འདེབས་ཚུ་  $2 གི་འོག་ལུ་ གསར་བཏོན་འབད་ནིའི་ཆ་འཇོག་གྲུབ་ཡོདཔ་(ཁ་གསལ་གྱི་དོན་ལས་ $1 ལུ་བལྟ་)། གལ་སྲིད་ ཁྱོད་རའི་འབྲི་ལཱ་འདི་ ཞུན་དག་དང་ལོག་བཀྲམ་མ་འབད་ནི་ཨིན་པ་ཅིན་ ནཱ་ལུ་མ་ཕུལ།<br />
དེ་མ་ཚད་ཁྱོད་ཀྱིས་ ང་བཅས་ལུ་ དེ་ཁྱོད་རང་གིས་བྲིས་འབྲིཝ་དང་ མི་མང་ཌོ་མཱེན་ ཡང་ན་ རྒྱུ་ཁུངས་སྟོང་མར་ནང་ལས་འདྲ་བཤུས་བརྐྱབས་རྐྱབ་ཨིནམ་སྦེ་ བཤདཔ་ཨིན་པས།
<strong>གནང་བ་མེད་པར་ འདྲ་བཤུས་དབང་ཆ་ཅན་གྱི་ལཱ་མ་ཕུལ་!</strong>',
'longpagewarning'        => '<strong>ཉེན་བརྡ་: ཤོག་ལེབ་འདི་རིང་ཚད་ ཀི་ལོ་བའིཊིསི་ $1 ཡོདཔ་དང་ བརྡ་འཚོལ་ལ་ལོ་ཅིག་ནང་ ཀི་ལོ་བའིཊི་ ༣༢ ལས་ལྷག་སྟེ་ཡོད་པའི་ཤོག་ལེབ་ ཞུན་དག་འབད་ནི་ལུ་དཀའ་ངལ་འབྱུང་དོ་ཡོདཔ་ཨིན།
ཤོག་ལེབ་འདི་ བགོ་བཤའ་རྐྱབ་སྟེ་ཆུང་ཀུ་བཟོ་ནི་ལུ་ཆ་འཇོག་འབད་གནང་།</strong>',
'templatesused'          => 'ཤོག་ལེབ་འདི་གུ་ལག་ལེན་འཐབ་ཡོད་པའི་ཊེམ་པེལེཊི:',
'templatesusedpreview'   => 'སྔོན་ལྟ་འདི་ནང་ལག་ལེན་འཐབ་ཡོད་པའི་ཊེམ་པེལེཊི:',
'template-protected'     => '(ཉེན་སྐྱོབ་འབད་ཡོདཔ།)',
'template-semiprotected' => '(ཉེན་སྐྱོབ་ཕྱེད་ཀ་འབད་ཡོདཔ་)',
'nocreatetext'           => '{{SITENAME}} གིས་ ཤོག་ལེབ་གསརཔ་བཟོ་ནི་ལས་ བཀག་དམ་འབད་ཡོདཔ།
ཁྱོད་ཀྱིས་ ལོག་འགྱོ་ཞིནམ་ལས་ ཡོད་བཞིན་པའི་ཤོག་ལེབ་འདི་ཞུན་དག་འབད་ ཡང་ན་  [[Special:UserLogin|ནང་བསྐྱོད་དང་ ཡངན་ རྩིས་ཐོ་གསརཔ་བཟོ་]].',
'recreate-deleted-warn'  => "'''ཉེན་བརྡ་: ཁྱོད་ཀྱིས་ ཧ་མ་ལས་བཏོན་བཏང་ཡོད་པའི་ཤོག་ལེབ་ཅིག་ ལོག་གསར་བཟོ་འབདཝ་ཨིན་པས།'''

ཁྱོད་ཀྱིས་ ཤོག་ལེབ་འདི་འཕྲོ་མཐུད་དེ་ཞུན་དག་འབད་ནི་གི་འོས་འབབ་ཡོད་མེད་བལྟ་དགོ།
སྟབས་བདེ་ནིའི་དོན་ལས་ ཤོག་ལེབ་ཀྱི་བཏོན་གཏང་ལོག་འདི་ ནཱ་ལུ་བྱིན་ཏེ་ཡོད།:",

# History pages
'viewpagelogs'        => 'ཤོག་ལེབ་འདི་གི་ལོགསི་སྟོན།',
'currentrev'          => 'ད་ལྟོའི་བསྐྱར་ཞིབ།',
'revisionasof'        => '$1 གི་བསྐྱར་ཞིབ།',
'revision-info'       => '$2 གིས་ $1 ཚུན་གྱི་བསྐྱར་ཞིབ།', # Additionally available: $3: revision id
'previousrevision'    => '←བསྐྱར་ཞིབ་རྙིངམ།',
'nextrevision'        => 'བསྐྱར་ཞིབ་གསརཔ་→',
'currentrevisionlink' => 'ད་ལྟོའི་བསྐྱར་ཞིབ།',
'cur'                 => 'ཀཱར།',
'last'                => 'མཇུག།',
'page_first'          => 'དང་པ།',
'page_last'           => 'མཇུག།',
'histlegend'          => 'སེལ་འཐུ་སོར་སོ་: ག་བསྡུར་འབད་ནི་དང་ གཤམ་གྱི་བཙུགས་ལྡེ་ ཡང་ན་ ཨེབ་རྟ་ལུ་ཨེབ་ནི་ལུ་ ཐོན་རིམ་གྱི་རེ་ཌིའོ་སྒྲོམ་ལུ་རྟགས་བཀལ།<br />
འབད་ཤུལ་: (ཀཱར་) = ད་ལྟོའི་ཐོན་རིམ་ལས་སོར་སོ་
(མཇུག་) = ཧེ་མའི་ཐོན་རིམ་ལས་སོར་སོ་ M = ཞུན་དག་ཆུང་ཀུ།',
'histfirst'           => 'རྙིང་ཤོས།',
'histlast'            => 'གསར་ཤོས།',

# Revision feed
'history-feed-item-nocomment' => '$༢ ལུ་ $༡', # user at time

# Diffs
'history-title'           => '"$1" གི་བསྐྱར་ཞིབ་སྤྱོད་ཤུལ།',
'difference'              => '(བསྐྱར་ཞིབ་བར་ནའི་ཁྱད་པར)',
'lineno'                  => 'གྲལ་ཐིག་ $1:',
'compareselectedversions' => 'སེལ་འཐུ་འབད་ཡོད་པའི་ཐོན་རིམ་ཚུ་ ག་བསྡུར་རྐྱབས།',
'editundo'                => 'འབད་བཤོལ།',
'diff-multi'              => '({{PLURAL:$1|བར་ནའི་བསྐྱར་ཞིབ་གཅིག་|$1 བར་ནའི་བསྐྱར་ཞིབ་ཚུ་}} མ་སྟོན་པས།)',

# Search results
'noexactmatch'   => "'''མགོ་མིང་ \"\$1\" ཅན་མའི་ཤོག་ལེབ་མེད།'''
ཁྱོད་ཀྱིས་ [[:\$1|ཤོག་ལེབ་འདི་ གསརཔ་བཟོ་ཚུགས།]]",
'prevn'          => 'ཧེ་མའི་ $1',
'nextn'          => 'ཤུལ་མའི་ $1',
'viewprevnext'   => '($1) ($2) ($3) སྟོན།',
'searchhelp-url' => 'Help:ནང་དོན།',
'powersearch'    => 'མཐོ་རིམ་ཅན་གྱི་འཚོལ་ཞིབ།',

# Preferences page
'preferences'   => 'དགའ་གདམ།',
'mypreferences' => 'ངེ་གི་དགའ་གདམ།',
'retypenew'     => 'ཆོག་ཡིག་གསརཔ་ལོག་ཡིག་དཔར་རྐྱབས:',

'grouppage-sysop' => '{{ns:project}}:བདག་སྐྱོང་པ།',

# User rights log
'rightslog' => 'ལག་ལེན་པའི་དབང་ཆ་དྲན་དེབ།',

# Recent changes
'nchanges'                       => '$1 {{PLURAL:$1|བསྒྱུར་བཅོས་|བསྒྱུར་བཅོས་ཚུ}}',
'recentchanges'                  => 'འཕྲལ་གྱི་བསྒྱུར་བཅོས',
'recentchanges-feed-description' => 'འབྱུང་སའི་ནང་ ཝི་ཀི་ལུ་འཕྲལ་གྱི་བསྒྱུར་བཅོས་འབད་མི་འདི་ རྗེས་འཚོལ་འབད།',
'rcnote'                         => "གཤམ་འཁོད་ཚུ་ $3 ཚུན་ཚོད་ཀྱི་ མཇུག་མཐའ {{PLURAL:$2|ཉིནམ་|'''$2''' ཉིནམ་}} གྱི་ {{PLURAL:$1|བསྒྱུར་བཅོས་ | '''$1''' བསྒྱུར་བཅོས་ཚུ་ }} ཨིན།",
'rcnotefrom'                     => "འོག་གི་ཚུ་ '''$2''' (up to '''$1''' shown) ལས་ཚུར་གྱི་བསྒྱུར་བཅོས་ཨིན།",
'rclistfrom'                     => '$1 ལས་ འགོ་བཟུང་སྟེ་ བསྒྱུར་བཅོས་གསརཔ་ཚུ་སྟོན་',
'rcshowhideminor'                => '$1 གལ་གནད་ཆུང་བའི་ཞུན་དག།',
'rcshowhidebots'                 => '$1 བོཊིསི།',
'rcshowhideliu'                  => '$1 ནང་བསྐྱོད་འབད་ཡོད་པའི་ལག་ལེན་པ་ཚུ་',
'rcshowhideanons'                => '$1 མིང་མེད་ལག་ལེན་པ།',
'rcshowhidepatr'                 => '$1 པེ་ཌོལཊི་ཞུན་དག་ཚུ།',
'rcshowhidemine'                 => '$1 ངེ་གི་ཞུན་དག།',
'rclinks'                        => 'མཇུག་མཐའི་ $1 བསྒྱུར་བཅོས་ཚུ་ ཉིནམ་ $2 ནང་ལུ་སྟོན་<br />$3',
'diff'                           => 'ཁྱད་པར།',
'hist'                           => 'སྤྱོད་ཤུལ',
'hide'                           => 'སྦ།',
'show'                           => 'སྟོན།',
'minoreditletter'                => 'm',
'newpageletter'                  => 'N',
'boteditletter'                  => 'b',

# Recent changes linked
'recentchangeslinked'          => 'འབྲེལ་བ་ཅན་གྱི་བསྒྱུར་བཅོས།',
'recentchangeslinked-title'    => '"$1" དང་འབྲེལ་བ་ཡོད་པའི་བསྒྱུར་བཅོས་ཚུ།',
'recentchangeslinked-noresult' => 'དུས་བཀོད་ཀྱི་སྐབས་ལུ་ འབྲེལ་མཐུད་ཅན་གྱི་ཤོག་ལེབ་ལུ་བསྒྱུར་བཅོས་མེད།',
'recentchangeslinked-summary'  => "དམིགས་བསལ་ཤོག་ལེབ་འདི་གིས་ འབྲེལ་མཐུད་ཅན་གྱི་ཤོག་ལེབ་གུ་ མཇུག་ཀྱི་བསྒྱུར་བཅོས་ཚུ་ ཐོ་བཀོད་འབདཝ་ཨིན།
ཁྱོད་ཀྱི་བལྟ་ཞིབ་ཐོ་ཡིག་གུ་འི་ཤོག་ལེབ་ཚུ་ '''མངོན་གསལ་ཅན་ཨིན།'''",

# Upload
'upload'        => 'ཡིག་སྣོད་སྐྱེལ་བཙུགས་འབད།',
'uploadbtn'     => 'ཡིག་སྣོད་སྐྱེལ་བཙུགས་འབད།',
'uploadlogpage' => 'ལོག་སྐྱེལ་བཙུགས་འབད།',
'uploadedimage' => '"[[$1]]" སྐྱེལ་བཙུགས་འབད་ཡོདཔ།',

# Special:ImageList
'imagelist' => 'ཡིག་སྣོད་ཐོ་ཡིག།',

# Image description page
'filehist'                  => 'ཡིག་སྣོད་སྤྱོད་ཤུལ།',
'filehist-help'             => 'ཡིག་སྣོད་འདི་ དེ་བསྒང་སྟོན་དོ་བཟུམ་སྦེ་ བལྟ་ནི་གི་དོན་ལུ་ ཚེས་གྲངས་/ཆུ་ཚོད་གུ་ ཨེབ་གཏང་འབད།',
'filehist-current'          => 'ད་ལྟོ།',
'filehist-datetime'         => 'ཚེས་གྲངས་/ཆུ་ཚོད།',
'filehist-user'             => 'ལག་ལེན་པ།',
'filehist-dimensions'       => 'རྒྱ་ཚད་',
'filehist-filesize'         => 'པར་སྣོད་ཀྱི་ཚད།',
'filehist-comment'          => 'བསམ་བཀོད།',
'imagelinks'                => 'འབྲེལ་ལམ།',
'linkstoimage'              => 'འོག་གི་ཤོག་ལེབ་ཚུ་ ཡིག་སྣོད་འདི་དང་འབྲེལ་བ་འདུག:',
'nolinkstoimage'            => 'ཡིག་སྣོད་དེ་དང་འབྲེལ་བ་ཡོད་པའི་ཤོག་ལེབ་མིན་འདུག།',
'sharedupload'              => 'ཡིག་སྣོད་འདི་རུབ་སྤྱོད་ཅན་གྱི་སྐྱེལ་བཙུགས་ཅིག་ཨིནམ་ལས་ ལས་འགུལ་གཞན་ཚུ་གིས་ལག་ལེན་འཐབ་འོང་།',
'noimage'                   => 'དེ་བཟུམ་གྱི་པར་སྣོད་མིན་འདུག་  ཁྱོད་ཀྱིས་ $1',
'noimage-linktext'          => 'དེ་ སྐྱེལ་བཙུགས་འབད།',
'uploadnewversion-linktext' => 'ཡིག་སྣོད་དེ་གི་ཐོ་རིམ་གསརཔ་ཅིག་ སྐྱེལ་བཙུགས་འབད།',

# MIME search
'mimesearch' => 'མའིམ་འཚོལ་ཞིབ།',

# List redirects
'listredirects' => 'སླར་ལོག་ཐོ་ཡིག',

# Unused templates
'unusedtemplates' => 'ལག་ལེན་མ་འཐབ་པའི་ཊེམ་པེལེཊིསི་',

# Random page
'randompage' => 'གང་འབྱུང་ཤོག་ལེབ།',

# Random redirect
'randomredirect' => 'གང་འབྱུང་སླར་ལོག།',

# Statistics
'statistics' => 'ཚད་རྩིས།',

'disambiguations' => 'ངེས་པ་ཡོད་པའི་བརྡ་དོན་ཤོག་ལེབ།',

'doubleredirects' => 'སླར་ལོག་གཉིས་ལྡན།',

'brokenredirects' => 'མེདཔ་འགྱོ་ཡོད་པའི་སླར་ལོག',

'withoutinterwiki' => 'སྐད་ཡིག་འབྲེལ་ལམ་མེད་པའི་ཤོག་ལེབ།',

'fewestrevisions' => 'བསྐྱར་ཞིབ་ཉུང་ཤོས་ཨིན་མི་ཤོག་ལེབ།',

# Miscellaneous special pages
'nbytes'                  => '$1 {{PLURAL:$1|བའིཊི|བའིཊིསི}}',
'nlinks'                  => '$1 {{PLURAL:$1|འབྲེལ་ལམ་|འབྲེལ་ལམ་ཚུ་}}',
'nmembers'                => '$1 {{PLURAL:$1|རིགས་|རིགས་ཚུ་}}',
'lonelypages'             => 'རྩ་བའི་ཤོག་ལེབ་མེད་པའི་ཤོག་ལེབ་ཚུ།',
'uncategorizedpages'      => 'དབྱེ་བ་མ་ཕཟོ་བའི་ཤོག་ལེབ།',
'uncategorizedcategories' => 'དབྱེ་ཁག་མ་བཟོ་བའི་དབྱེ་རིམ་',
'uncategorizedimages'     => 'དབྱེ་རིམ་མ་བཟོ་བའི་ཡིག་སྣོད།',
'uncategorizedtemplates'  => 'དབྱེ་རིམ་མ་བཟོ་བའི་ཊེམ་པེལེཊི།',
'unusedcategories'        => 'ལག་ལེན་མ་འཐབ་པའི་དབྱེ་རིམ།',
'unusedimages'            => 'ལག་ལེན་མ་འཐབ་པའི་ཡིག་སྣོད།',
'wantedcategories'        => 'ངེས་མཁོའི་དབྱེ་རིམ།',
'wantedpages'             => 'དགོས་མཁོ་ཡོད་པའི་ཤོག་ལེབ།',
'mostlinked'              => 'ཤོག་ལེབ་ལུ་འབྲེལ་མཐུད་ཆེ་ཤོས་',
'mostlinkedcategories'    => 'དབྱེ་རིམ་ལུ་འབྲེལ་མཐུད་ཆེ་ཤོས་',
'mostlinkedtemplates'     => 'ཊེམ་པེལེཊིསི་ལུ་འབྲེལ་མཐུད་ཆེ་ཤོས་',
'mostcategories'          => 'དབྱེ་རིམ་མང་ཤོས་དང་འབྲེལ་བའི་ཤོག་ལེབ་',
'mostimages'              => 'ཡིག་སྣོད་ལུ་འབྲེལ་མཐུད་ཆེ་ཤོས་',
'mostrevisions'           => 'བསྐྱར་ཞིབ་མང་ཤོས་དང་འབྲེལ་བའི་ཤོག་ལེབ་',
'prefixindex'             => 'སྔོན་ཚིག་ཟུར་ཐོ།',
'shortpages'              => 'ཤོག་ལེབ་ཐུང་ཀུ།',
'longpages'               => 'ཤོག་ལེབ་རིངམོ།',
'deadendpages'            => 'ཤོག་ལེབ་མཇུག་',
'protectedpages'          => 'ཉེན་སྐྱོབ་འབད་ཡོད་པའི་ཤོག་ལེབ།',
'listusers'               => 'ལག་ལེན་པའི་ཐོ་ཡིག།',
'newpages'                => 'ཤོག་ལེབ་གསརཔ།',
'ancientpages'            => 'ཤོག་ལེབ་རྙིང་ཤོས།',
'move'                    => 'སྤོ་བཤུད་འབད།',
'movethispage'            => 'ཤོག་ལེབ་འདི་ སྤོ་བཤུད་འབད།',

# Book sources
'booksources' => 'ཀི་དེབ་འབྱུང་ས།',

# Special:Log
'specialloguserlabel'  => 'ལག་ལེན་པ:',
'speciallogtitlelabel' => 'མགོ་མིང:',
'log'                  => 'ལོགསི།',
'all-logs-page'        => 'ལོག་སི་ཆ་མཉམ།',

# Special:AllPages
'allpages'       => 'ཤོག་ལེབ་ག་ར།',
'alphaindexline' => '$1 ལས་ $2',
'nextpage'       => 'ཤུལ་མའི་ཤོག་ལེབ་ ($1)',
'prevpage'       => 'ཧེ་མའི་ཤོག་ལེབ་ ($1)',
'allpagesfrom'   => 'ཤོག་ལེབ་བཀྲམ་སྟོན་འགོ་བཙུགས་:',
'allarticles'    => 'ཤོག་ལེབ་ག་ར།',
'allpagessubmit' => 'འགྱོ།',
'allpagesprefix' => 'སྔོན་ཚིག་གི་ཐོག་ལས་ཤོག་ལེབ་ཚུ་སྟོན།',

# Special:Categories
'categories' => 'དབྱེ་རིམ།',

# E-mail user
'emailuser' => 'ལག་ལེན་པ་ལུ་ གློག་འཕྲིན་གཏང་',

# Watchlist
'watchlist'         => 'ངེ་གི་བལྟ་ཞིབ་ཐོ་ཡིག།',
'mywatchlist'       => 'ངེ་གི་བལྟ་ཞིབ་ཐོ་ཡིག།',
'watchlistfor'      => "('''$1''' གི་དོན་ལུ་)",
'addedwatch'        => 'བལྟ་ཞིབ་ཐོ་ཡིག་ལུ་ཁ་སྐོང་རྐྱབ་ཅི།',
'addedwatchtext'    => "ཤོག་ལེབ་  \"[[:\$1]]\" འདི་ ཁྱོད་རའི་ [[Special:Watchlist|watchlist]] ལུ་ ཁ་སྐོང་བརྐྱབས་ནུག།\\n
ཤོག་ལེབ་དེ་ལུ་མ་འོངས་བསྒྱུར་བཅོས་དང་ དེ་གི་འབྲེལ་ཡོད་བློ་ཤོག་འདི་ དེ་ཁར་ཐོ་བཀོད་འབད་ནི་དང་ འཇམ་ཏོང་ཏོ་སྦེ་གདམ་ཁ་བརྐྱབ་ཚུགས་ནི་གི་དོན་ལུ་  ཤོག་ལེབ་འདི་ [[Special:RecentChanges|list of recent changes]] ནང་ལུ་ '''མངོན་གསལ་''' སྦེ་འབྱུང་འོང་།",
'removedwatch'      => 'བལྟ་ཞིབ་ཐོ་ཡིག་ནང་ལས་བཏོན་བཀོག་ཡོདཔ།',
'removedwatchtext'  => 'ཤོག་ལེབ་  "[[:$1]]" འདི་ ཁྱོད་རའི་བལྟ་ཞིབ་ཐོ་ཡིག་ནང་ལས་ བཏོན་བཀོག་ནུག།',
'watch'             => 'བལྟ་ཞིབ་འབད།',
'watchthispage'     => 'ཤོག་ལེབ་འདི་ལྟ།',
'unwatch'           => 'བལྟ་བཤོལ།',
'watchlist-details' => '{{PLURAL:$1|$1 ཤོག་ལེབ་|$1 ཤོག་ལེབ་ཚུ་}} ཁག་ཆེ་བའི་བློ་ཤོག་ བལྟ་ཞིབ་མ་འབད་བས།',
'wlshowlast'        => 'མཇུག་གི་ ཆུ་ཚོད་ $1 ཉིནམ་ $2  $3 སྟོན་',

# Displayed when you click the "watch" button and it is in the process of watching
'watching'   => 'བལྟ་ཞིབ་འབད་དོ་་་',
'unwatching' => 'བལྟ་ཞིབ་འབད་བཤོལ་དོ་་་',

# Delete
'deletepage'            => 'ཤོག་ལེབ་བཏོན་གཏང་།',
'historywarning'        => 'ཉེན་བརྡ་: ཁྱོད་ཀྱིས་ བཏོན་བཀོག་ནི་འབད་མི་ཤོག་ལེབ་ནང་སྤྱོད་ཤུལ་འདུག་:',
'confirmdeletetext'     => 'ཁྱོད་ཀྱིས་ ཤོག་ལེབ་དང་དེའི་སྤྱོད་ཤུལ་ བཏོན་གཏང་ནི་འབད་དོ།
ཁྱོད་ཀྱིས་འདི་འབད་ནི་དང་ དེ་འབད་བ་ཅིན་ དེ་གི་འབྲེལ་འབྱུང་ དེ་ལས་ ཁྱོད་ཀྱིས་འབད་མི་འདི་  [[{{MediaWiki:Policy-url}}| སྲིད་བྱུས་]] དང་འཁྲིལ་ཏེ་ཨིན་པའི་ངེས་དཔྱད་འབད་གནང་།',
'actioncomplete'        => 'བྱ་ལས་མཇུག་བསྡུ།',
'deletedtext'           => '"<nowiki>$1</nowiki>" འདི་ བཏོན་བཀོག་ནུག།
འཕྲལ་ཁམས་ལུ་བཏོན་བཀོག་མི་ཐོ་གི་དོན་ལུ་ $2 ལུ་བལྟ།',
'deletedarticle'        => '"[[$1]]" བཏོན་གཏང་ཡོདཔ།',
'dellogpage'            => 'བཏོན་གཏང་ཡོད་པའི་ལོག།',
'deletecomment'         => 'བཏོན་བཏང་དགོ་པའི་རྒྱུ་མཚན་:',
'deleteotherreason'     => 'གཞན་/ཁ་སྐོང་ཅན་གྱི་རྒྱུ་མཚན།',
'deletereasonotherlist' => 'རྒྱུ་མཚན་གཞན།',

# Rollback
'rollbacklink' => 'རྒྱབ་སྒྲིལ།',

# Protect
'protectlogpage'              => 'ཉེན་སྐྱོབ་ལོག།',
'prot_1movedto2'              => '[[$1]] འདི་ [[$2]] ལུ་སྤོ་བཤུད་འབད་ཡོདཔ།',
'protectcomment'              => 'བསམ་བཀོད:',
'protectexpiry'               => 'དུས་ཡོལ:',
'protect_expiry_invalid'      => 'དུས་ཡོལ་དུས་ཚོད་འདི་ ནུས་མེད་ཨིན་པས།',
'protect_expiry_old'          => 'དུས་ཡོལ་དུས་ཚོད་འདི་ཚར་ནུག།',
'protect-unchain'             => 'སྤོ་བཤུད་ཀྱི་གནང་བ་ཕྱེ།',
'protect-text'                => 'ཁྱོད་ཀྱིས་ ནཱ་ལུ་ ཤོག་ལེབ་ <strong><nowiki>$1</nowiki></strong> གི་དོན་ལུ་ ཉེན་སྐྱོབ་གནས་རིམ་འདི་བསྒྱུར་བཅོས་རྐྱབ་བཏུབ།',
'protect-locked-access'       => 'ཁྱོད་ཀྱི་རྩིས་ཐོ་ནང་ ཤོག་ལེབ་ཉེན་སྐྱོབ་གནས་རིམ་བསྒྱུར་བཅོས་འབད་ནིའི་གནང་བ་མིན་འདུག།
ད་ལྟོ་ནཱ་ལུ་ཡོད་པའི་སྒྲིག་སྟངས་འདི་ ཤོག་ལེབ་ <strong>$1</strong> གི་དོན་ལུ་ཨིན་:',
'protect-cascadeon'           => 'འོག་གི་ཀསི་ཀེ་ཌིངཉེན་སྐྱོབ་ཤུགས་ཅན་བཟོ་ཡོད་པའི་ {{PLURAL:$1|ཤོག་ལེབ| ཤོག་ལེབ་་ཚུ་}} གི་གྲངས་སུ་ཚུད་ཡོདཔ་ལས་ ཤོག་ལེབ་འདི་ ད་ལྟོ་ཉེན་སྐྱོབ་འབད་དེ་འདུག།
ཁྱོད་ཀྱིས་ ཤོག་ལེབ་འདི་གི་ཉེན་སྐྱོབ་གནས་རིམ་འདི་ བསྒྱུར་བཅོས་འབད་ཚུགས་རུང་ ཀསི་ཀ་ཌིང་ཉེན་སྐྱོབ་ལུ་མི་གནོད།',
'protect-default'             => '(སྔོན་སྒྲིག།)',
'protect-fallback'            => '"$1" གནང་བ་དགོས།',
'protect-level-autoconfirmed' => 'ཐོ་བཀོད་མ་འབད་བའི་ལག་ལེན་པ་ཚུ་ བཀག།',
'protect-level-sysop'         => 'སི་སོཔསི་རྐྱངམ་ཅིག།',
'protect-summary-cascade'     => 'ཀེསི་ཀེ་ཌིང་།',
'protect-expiring'            => '$1 (UTC) དུས་ཡོལཝ་ཨིན།',
'protect-cascade'             => 'ཤོག་ལེབ་(ཀེསི་ཀེ་ཌིང་ཉེན་སྐྱོབ་) ཀྱི་གྲངས་སུ་ཚུད་མི་ཉེན་སྐྱོབ་ཤོག་ལེབ།',
'protect-cantedit'            => 'ཁྱོད་ལུ་ ཞུན་དག་གི་གནང་བ་མེདཔ་ལས་ ཤོག་ལེབ་འདི་གི་ཉེན་སྐྱོབ་གནས་རིམ་བསྒྱུར་མི་ཚུགས།',
'protect-expiry-options'      => 'ཆུ་ཚོད་ ༢:2 hours,ཉིནམ་ ༡:1 day,ཉིནམ་ ༣:3 days,བདུན་ཕྲག་ ༡:1 week,བདུན་ཕྲག་ ༢:2 weeks,ཟླཝ་ ༡:1 month,ཟླཝ་ ༣:3 months,ཟླཝ་ ༦:6 months,ལོ་ ༡:1 year,ཚད་ལས་འདས་པ་:infinite', # display1:time1,display2:time2,...
'restriction-type'            => 'གནང་བ:',
'restriction-level'           => 'མི་ཆོག་པའི་གནས་རིམ:',

# Undelete
'undeletebtn' => 'བསྐྱར་གསོ།',

# Namespace form on various pages
'namespace'      => 'མིང་:',
'invert'         => 'གནས་ལོག་སེལ་འཐུ།',
'blanknamespace' => '(གཙོ་བོ།)',

# Contributions
'contributions' => 'ལག་ལེན་པའི་ཞལ་འདེབས།',
'mycontris'     => 'ངེ་གི་ཞལ་འདེབས།',
'contribsub2'   => '$1 ($2) གི་དོན་ལུ་',
'uctop'         => '(མགུ་)',
'month'         => 'ཟླཝ་(ཧེ་མ་)ལས་:',
'year'          => 'ལོ་(ཧེ་མ་)ལས་:',

'sp-contributions-newbies-sub' => 'རྩིས་ཐོ་གསརཔ་གི་དོན་ལུ།',
'sp-contributions-blocklog'    => 'སྡེབ་ཚན་ལོག།',

# What links here
'whatlinkshere'       => 'ནཱ་ལུ་ ག་ཅི་འབྲེལ་མཐུད་འོང་ནི་མས།',
'whatlinkshere-title' => '$1 དང་འབྲེལ་མཐུད་ཡོད་པའི་ཤོག་ལེབ།',
'linkshere'           => "འོག་གི་ཤོག་ལེབ་ཚུ་ '''[[:$1]]''' ལུ་ འབྲེལ་མཐུད་འབད་ཨིན:",
'nolinkshere'         => "'''[[:$1]]''' ལུ་ ཤོག་ལེབ་འབྲེལ་མཐུད་མིན་འདུག།",
'isredirect'          => 'སླར་ལོག་ཤོག་ལེབ།',
'istemplate'          => 'གྲངས་ཚུད།',
'whatlinkshere-prev'  => '{{PLURAL:$1|ཧེ་མམ་|ཧེ་མམ་ $1}}',
'whatlinkshere-next'  => '{{PLURAL:$1|ཤུལ་མམ་|ཤུལ་མམ་ $1}}',
'whatlinkshere-links' => '← འབྲེལ་ལམ།',

# Block/unblock
'blockip'       => 'ལག་ལེན་པ་བཀག',
'ipboptions'    => 'ཆུ་ཚོད་ ༢:2 hours,ཉིནམ་ ༡:1 day,ཉིནམ་ ༣:3 days,བདུན་ཕྲག་ ༡:1 week,བདུན་ཕྲག་ ༢:2 weeks,ཟླཝ་ ༡:1 month,ཟླཝ་ ༣:3 months,ཟླཝ་ ༦:6 months,ལོ་ ༡:1 year,ཚད་ལས་འདས་པ་:infinite', # display1:time1,display2:time2,...
'ipblocklist'   => 'བཀག་ཆ་ཅན་གྱི་ ཨའི་པི་ཁ་བྱང་དང་ལག་ལེན་པའི་མིང།',
'blocklink'     => 'བཀག།',
'unblocklink'   => 'བཀག་བཤོལ་',
'contribslink'  => 'ཕན་འདེབས།',
'blocklogpage'  => 'སྡེབ་ཚན་ལོག།',
'blocklogentry' => '[[$1]] འདི་ དུས་ཡོལ་དུས་ཚོད་ $2 $3 ལུ་ འགག་བསུབ་འབད་ཡོདཔ',

# Move page
'movepagetext'     => "འོག་གི་འབྲི་ཤོག་ལག་ལེན་འཐབ་མི་དེ་གིས་ སྤྱོད་ཤུལ་ཆ་མཉམ་ མིང་གསརཔ་ལུ་སྤོ་བཤུད་འབད་དེ་ ཤོག་ལེབ་ཀྱི་བསྐྱར་མིང་བཏགས་འོང་།
མགོ་མིང་རྙིངམ་འདི་ མགོ་མིང་གསརཔ་ནང་ སླར་ལོག་ཤོག་ལེབ་ལུ་འགྱུར་འོང་།
མགོ་མིང་རྙིངམ་གི་འབྲེལ་ལམ་ཚུ་མི་འགྱུར་   སླར་ལོག་གཉིས་ལྡན་དང་མེདཔ་ཐལ་ཡོད་མི་ཚུ་ ཞིབ་དཔྱད་ངེས་གཏན་འབད་དགོ།
ཁྱོད་ཀྱིས་ འབྲེལ་ལམ་ཚུ་རྒྱུན་མ་ཆད་པར་འཕྲོ་མཐུད་དེ་འགྱོ་ནི་ཡོདཔ་བཟོ་དགོ།

མོག་མིང་གསརཔ་ལུ་ ཧེ་མ་ལས་ཤོག་ལེབ་སྟོངམ་ ཡང་ན་ སླར་ལོག་དང་ཞུན་དག་སྤྱོད་ཤུལ་མེད་པ་ཅིན་ ཤོག་ལེབ་འདི་ སྤོ་བཤུད་'''མི་འབདཝ་'''ཨིནམ་ཤེས་དགོ།དེ་ཡང་ ཁྱོད་ཀྱིས་ འཛོལ་བ་འབྱུངམ་ད་ སྔར་ག་ཨིནམ་སྦེ་བསྐྱར་མིང་བཏགས་བཏུབ་རུང་ ཡོད་བཞིན་པའི་ཤོག་ལེབ་འདི་ ཚབ་སྲུང་འབད་མི་བཏུབ་ཨིན།

<b>ཉེན་བརྡ་!</b>
འ་ནི་འདི་ ཤོག་ལེབ་ཀྱི་འགྱུར་བ་སྦོམ་ཨིནམ་དང་ ཁྱོད་ཀྱིས་ འཕྲོ་མཐུད་དེ་མ་འགྱོ་བའི་ཧེ་མ་ དེ་གི་འབྲེལ་འབྱུང་ཧ་གོ་དགོ།",
'movepagetalktext' => "འབྲེལ་ཡོད་བློ་ཤོག་འདི་ '''གཤམ་འཁོད་ཚུ་མེད་པ་ཅིན་''' རང་བཞིན་གྱིས་སྤོ་བཤུད་འབད་འོང་:
*  བློ་ཤོག་སྟོངམ་མིན་པའི་ཤོག་ལེབ་ཅིག་ ཧེ་མ་ལས་མིང་གསརཔ་གི་འོག་ལུ་ཡོད་དགོ་ནི་ ཡང་ན་
* ཁྱོད་ཀྱིས་ འོག་ལུ་སྒྲོམ་འདི་ ཞིབ་དཔྱད་འབད་བཤོལ་ནི།

གནད་དོན་དེ་ནང་ དགོས་འདོད་དང་བསྟུན་ཏེ་ ཁྱོད་ཀྱིས་ ཤོག་ལེབ་འདི་ ལག་ཐོག་ལས་ མཉམ་བསྡོམས་འབད་དགོ།",
'movearticle'      => 'ཤོག་ལེབ་སྤོ་བཤུད་འབད་:',
'newtitle'         => 'མགོ་མིང་གསརཔ་ལུ་:',
'move-watch'       => 'ཤོག་ལེབ་འདི་ལྟ།',
'movepagebtn'      => 'ཤོག་ལེབ་སྤོ་བཤུད་འབད།',
'pagemovedsub'     => 'སྤོ་བཤུད་མཐར་འཁྱོལ་བྱུང་ཡོདཔ།',
'movepage-moved'   => '<big>\'\'\'"$1" འདི་ "$2"\'\'\'</big> ལུ་ སྤོ་བཤུད་འབད་ནུག།', # The two titles are passed in plain text as $3 and $4 to allow additional goodies in the message.
'articleexists'    => 'ཤོག་ལེབ་མིང་འདི་ཧེ་མ་ལས་ཡོདཔ་ཨིནམ་དང་ ཡང་ན་ ཁྱོད་ཀྱིས་གདམ་ཁ་བརྐྱབས་མི་མིང་འདི་ ནུས་མེད་ཨིན་པས།
མིང་གཞན་ཅིག་ གདམ་ཁ་རྐྱབས།',
'talkexists'       => "'''ཤོག་ལེབ་འདི་ལེགས་ཤོམ་པས་སྤོ་བཤུད་འབད་ཡོད་རུང་ གཅིག་ཧེ་མ་ལས་ར་ མགོ་མིང་གསརཔ་གུ་ཡོདཔ་ལས་ བློ་ཤོག་འདི་སྤོ་བཤུད་འབད་མ་ཚུགས།
དེ་ཚུ་ ལག་ཐོག་ལས་མཉམ་བསྡོམས་འབད་གནང་།'''",
'movedto'          => 'ལུ་སྤོ་བཤུད་འབད།',
'movetalk'         => 'འབྲེལ་བ་ཡོད་པའི་ཁ་སླབ་ཤོག་ལེབ་ སྤོ་བཤུད་འབད།',
'1movedto2'        => '[[$1]] འདི་ [[$2]] ལུ་སྤོ་བཤུད་འབད་ཡོདཔ།',
'movelogpage'      => 'ལོག་སྤོ་བཤུད་འབད།',
'movereason'       => 'རྒྱུ་མཚན:',
'revertmove'       => 'རྒྱབ་ལོག།',

# Export
'export' => 'ཤོག་ལེབ་ཕྱིར་འདྲེན་འབད།',

# Namespace 8 related
'allmessages' => 'རིམ་ལུགས་འཕྲིན་དོན།',

# Thumbnails
'thumbnail-more'  => 'ཆེར་བསྐྱེད།',
'thumbnail_error' => 'མཐེ་གཟེར་གསར་བཟོའི་སྐབས་ལུ་འཛོལ་བ་: $1',

# Import log
'importlogpage' => 'ལོག་ ནང་འདྲེན་འབད།',

# Tooltip help for the actions
'tooltip-pt-userpage'             => 'ངེ་གི་ལག་ལེན་པའི་ཤོག་ལེབ།',
'tooltip-pt-mytalk'               => 'ངེ་གི་བློ་ཤོག།',
'tooltip-pt-preferences'          => 'ངེ་གི་དགའ་གདམ།',
'tooltip-pt-watchlist'            => 'ཁྱོད་ཀྱིས་ བསྒྱུར་བཅོས་ཀྱི་དོན་ལས་ ལྟ་རྟོག་འབད་མི་ཤོག་ལེབ་ཐོ་ཡིག།',
'tooltip-pt-mycontris'            => 'ངེ་གི་ཞལ་འདེབས་ཐོ་ཡིག།',
'tooltip-pt-login'                => 'ནང་བསྐྱོད་འབད་ ཡང་ན་ མ་འབད་རུང་བཏུབ།',
'tooltip-pt-logout'               => 'ཕྱིར་བསྐྱོད།',
'tooltip-ca-talk'                 => 'ནང་དོན་ཤོག་ལེབ་ཀྱི་སྐོར་ལས་གྲོས་བསྡུར།',
'tooltip-ca-edit'                 => 'ཁྱོད་ཀྱིས་ ཤོག་ལེབ་འདི་ཞུན་དག་འབད་བཏུབ། དེ་ མ་སྲུང་པའི་ཧེ་མ་ སྔོན་ལྟའི་ཨེབ་རྟ་འདི་ ལག་ལེན་འཐབ་གནང་།',
'tooltip-ca-addsection'           => 'གྲོས་བསྡུར་འདི་ལུ་ བསམ་བཀོད་ཅིག་ཁ་སྐོང་རྐྱབས།',
'tooltip-ca-viewsource'           => 'ཤོག་ལེབ་འདི་ཉེན་སྐྱོབ་ཅན་ཅིག་ཨིན། དེ་གི་འབྱུང་ས་བལྟ་བཏུབ།',
'tooltip-ca-protect'              => 'ཤོག་ལེབ་འདི་ཉེན་སྐྱོབ་འབད།',
'tooltip-ca-delete'               => 'ཤོག་ལེབ་འདི་ བཏོན་བཏང་།',
'tooltip-ca-move'                 => 'ཤོག་ལེབ་འདི་ སྤོ་བཤུད་འབད།',
'tooltip-ca-watch'                => 'ཤོག་ལེབ་འདི་ ཁྱོད་རའི་བལྟ་ཞིབ་ཐོ་ཡིག་ནང་ ཁ་སྐོང་རྐྱབས།',
'tooltip-ca-unwatch'              => 'ཤོག་ལེབ་འདི་ ཁྱོད་རའི་བལྟ་ཞིབ་ཐོ་ཡིག་ནང་ལས་ བཏོན་གཏང་།',
'tooltip-search'                  => '{{SITENAME}} འཚོལ་ཞིབ་འབད།',
'tooltip-n-mainpage'              => 'མ་ཤོག་ལུ་བལྟ་ཞིབ་འབད།',
'tooltip-n-portal'                => 'ལས་འགུལ་གྱི་སྐོར་ལས་   ཁྱོད་ཀྱིས་ ག་ཅི་འབད་ཚུགས་ག་ འཚོལ་ཞིབ་ག་ཏེ་ལས་འབད་ནི་ཨིན་ན་',
'tooltip-n-currentevents'         => 'ད་ལྟོའི་འབྱུང་ལས་གུ་ རྒྱབ་གཞིའི་བརྡ་དོན་འཚོལ།',
'tooltip-n-recentchanges'         => 'ཝི་ཀི་ནང་གི་ཕྲལ་གྱི་བསྒྱུར་བཅོས་ཐོ་ཡིག།',
'tooltip-n-randompage'            => 'རིམ་བྲལ་ཤོག་ལེབ་ཅིག་ མངོན་གསལ་འབད།',
'tooltip-n-help'                  => 'འཚོལ་ཞིབ་འབད་སའི་ས་གནས།',
'tooltip-t-whatlinkshere'         => 'ནཱ་ལུ་ འབྲེལ་མཐུད་འབད་བའི་ཝི་ཀི་ཤོག་ལེབ་ག་ར་གི་ཐོ་ཡིག།',
'tooltip-t-contributions'         => 'ལག་ལེན་པ་འདི་གི་ཞལ་འདེབས་ཐོ་ཡིག་བལྟ།',
'tooltip-t-emailuser'             => 'ལག་ལེན་པ་འདི་ལུ་ གློག་འཕྲིན་གཏང་།',
'tooltip-t-upload'                => 'ཡིག་སྣོད་སྐྱེལ་བཙུགས་འབད།',
'tooltip-t-specialpages'          => 'དམིགས་བསལ་ཤོག་ལེབ་ཚུ་གི་ཐོ་ཡིག།',
'tooltip-ca-nstab-user'           => 'ལག་ལེན་པའི་ཤོག་ལེབ་བལྟ།',
'tooltip-ca-nstab-project'        => 'ལས་འགུལ་ཤོག་ལེབ་བལྟ།',
'tooltip-ca-nstab-image'          => 'ཡིག་སྣོད་ཤོག་ལེབ་འདི་སྟོན།',
'tooltip-ca-nstab-template'       => 'ཊེམ་པེལེཊི་བལྟ།',
'tooltip-ca-nstab-help'           => 'གྲོགས་རམ་ཤོག་ལེབ་ལུ་ལྟ།',
'tooltip-ca-nstab-category'       => 'དབྱེ་རིམ་ཤོག་ལེབ་སྟོན།',
'tooltip-minoredit'               => 'གལ་གནད་ཆུང་བའི་ཞུན་དག་སྦེ་རྟགས་བཀལ།',
'tooltip-save'                    => 'ཁྱོད་ཀྱིས་ བསྒྱུར་བཅོས་བརྐྱབས་མི་ཚུ་སྲུངས།',
'tooltip-preview'                 => 'ཁྱོད་ཀྱི་བསྒྱུར་བཅོས་ཚུ་མ་སྲུང་པའི་ཧེ་མར་  སྔོན་ལྟ་འབད་གནང།',
'tooltip-diff'                    => 'ཁྱོད་ཀྱིས་ ཚིག་ཡིག་ལུ་ ག་ཅི་བསྒྱུར་བཅོས་འབད་ཡི་ག་སྟོན།',
'tooltip-compareselectedversions' => 'ཤོག་ལེབ་འདི་གི་སེལ་འཐུ་འབད་ཡོད་པའི་ཐོན་རིམ་གཉིས་ཀྱི་བར་ནའི་ཁྱད་པར་ཚུ་ བལྟ།',
'tooltip-watch'                   => 'ཤོག་ལེབ་འདི་ ཁྱོད་རའི་བལྟ་ཞིབ་ཐོ་ཡིག་ནང་ ཁ་སྐོང་རྐྱབས།',

# Browsing diffs
'previousdiff' => '← ཧེ་མའི་ཁྱད་པར།',
'nextdiff'     => 'ཤུལ་མམ་གྱི་ཁྱད་པར་ →',

# Media information
'file-info-size'       => '($1 × $2 པིག་སེལ་  ཡིག་སྣོད་ཀྱི་ཚད་: $3 མའིམ་དབྱེ་བ་: $4)',
'file-nohires'         => '<small>ཧུམ་ཆ་ལེགས་ཤོམ་མིན་འདུག།</small>',
'svg-long-desc'        => '(ཨེསི་བི་ཇི་ཡིག་སྣོད་  $1 × $2 པིག་སེལསི་ཆུང་སུ་ཅིག་  ཡིག་སྣོད་ཚད་: $3)',
'show-big-image'       => 'ཧུམ་ཆ་གང་།',
'show-big-image-thumb' => '<small>སྔོན་ལྟའི་ཚད་: $1 × $2 པིག་སེལསི་</small>',

# Special:NewImages
'newimages' => 'ཡིག་སྣོད་གསར་པའི་སྟོན་ཁང་།',

# Bad image list
'bad_image_list' => 'རྩ་སྒྲིག་འདི་གཤམ་འཁོད་ལྟར་:

(གྲལ་ཐིག་ * གིས་འགོ་བཙུགས་པའི) ཐོ་ཡིག་དངོས་གྲངས་ཚུ་རྐྱངམ་ཅིག་ བརྩི་འཇོག་ཡོད།
གྲལ་ཐིག་གུ་གི་འབྲེལ་ལམ་དང་པ་འདི་ ཡིག་སྣོད་བྱང་ཉེས་ཅིག་ལུ་ འབྲེལ་མཐུད་ཡོད་དགོ།
གྲལ་ཐིག་ཅོག་འཐད་མི་གུ་ལུ་ ཤུལ་མའི་འབྲེལ་ལམ་ག་ཅི་ཨིན་རུང་ དེའི་གྲངས་སུ་མི་རྩིས་ དེ་ཡང་ གྱལ་རིམ་ནང་ཡོད་པའི་ཡིག་སྣོད་ཤོགལེབ་ཚུ།',

# Metadata
'metadata'          => 'མེ་ཊ་གནས་སྡུད།',
'metadata-help'     => 'ཡིག་སྣོད་དེ་ནང་ ཌི་ཇི་ཊཱལ་པར་ཆས་དང་ ཡང་ན་ པར་ལེན་འཕྲུལ་ཆས་ནང་ལས་ཁ་སྐོང་འབད་ཡོད་པའི་ གསར་བཟོའི་བརྡ་དོན་ཚུ་ཡོད།
གལ་སྲིད་ ཡིག་སྣོད་འདི་ སྔར་བཞིན་མ་བཞག་པར་ ལེགས་བཅོས་འབད་བ་ཅིན་ ཁ་གསལ་བཀོད་མི་ལ་ལོ་ཅིག་གིས་ལེགས་བཅོས་འབད་ཡོད་མི་ཡིག་སྣོད་ ཆ་ཚང་མི་སྟོན་འོང་།',
'metadata-expand'   => 'རྒྱ་བསྐྱེད་ཅན་གྱི་རྒྱས་བཤད་སྟོན།',
'metadata-collapse' => 'རྒྱ་བསྐྱེད་ཅན་གྱི་རྒྱས་བཤད་ཚུ་སྦ།',
'metadata-fields'   => 'མེ་ཊ་གནས་སྡུད་ཐིག་ཁྲམ་ ཧྲམ་པའི་སྐབས་ལུ་ འཕྲིན་དོན་འདི་ནང་ ཐོ་བཀོད་འབད་་ཡོད་པའི་ ཨི་ཨེགསི་ཨའི་ཨེཕ་ མེ་ཊ༌གནས་སྡུད་འདི་ གཟུགས་བརྙན་ཤོག་ལེབ་བཀྲམ་སྟོན་གུ་ གྲངས་སུ་བཙུགས་འོང་། 
གཞན་ཚུ་ སྔོན་སྒྲིག་གི་ཐོག་ལས་སྦ་འོང་།
* make
* model
* datetimeoriginal
* exposuretime
* fnumber
* focallength', # Do not translate list items

# External editor support
'edit-externally'      => 'ཕྱིའི་གློག་རིམ་ལག་ལེན་འཐབ་ཐོག་ལས་ ཡིག་སྣོད་འདི་ཞུན་དག་འབད།',
'edit-externally-help' => 'བརྡ་དོན་ཁ་གསལ་གྱི་དོན་ལུ་ [http://www.mediawiki.org/wiki/Manual:External_editors setup instructions] ལུ་ལྟ།',

# 'all' in various places, this might be different for inflected languages
'watchlistall2' => 'ཆ་མཉམ།',
'namespacesall' => 'ཆ་མཉམ།',
'monthsall'     => 'ཆ་མཉམ།',

# Watchlist editing tools
'watchlisttools-view' => 'འབྲེལ་བ་ཡོད་པའི་བསྒྱུར་བཅོས་ཚུ་སྟོན།',
'watchlisttools-edit' => 'བལྟ་སྟེ་བལྟ་ཞིབ་ཐོ་ཡིག་ཞུན་དག་འབད།',
'watchlisttools-raw'  => 'རགས་ཙམ་གྱི་བལྟ་ཞིབ་ཐོ་ཡིག་ ཞུན་དག་འབད་',

# Special:Version
'version' => 'ཐོན་རིམ།', # Not used as normal message but as header for the special page itself

# Special:SpecialPages
'specialpages' => 'དམིགས་བསལ་ཤོག་ལེབ།',

);
