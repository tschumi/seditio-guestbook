<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/guestbook/guestbook.setup.php
Version=100
Updated=2006-apr-21
Type=Plugin
Author=riptide
Description=Setup for the guestbook
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=guestbook
Name=Guestbook
Description=Guestbook
Version=100
Date=2006/04/21
Author=riptide
Copyright=This plugin can be used for free.<br />PhpCaptcha is licensed under the Free BSD license.<br />The icons on the buttons are licensed under <a href="http://creativecommons.org/licenses/by/2.5/">Creative Commons Attribution 2.5 license</a>.
Notes=The <a href="http://www.ejeliot.com/pages/2">PhpCaptcha class</a> is made by Edward Eliot.<br />The icons for the buttons are from the <a href="http://www.famfamfam.com/lab/icons/silk/">SILK ICONS</a> made by famfamfam.com
SQL=
Auth_guests=R
Lock_guests=12345A
Auth_members=RW
Lock_members=12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
maxposts=01:string::10:Max posts per page
authorlink=10:select:Yes,No:Yes:Display author as link to user details
verify=11:select:Yes,No:Yes:Guest must verify with a CAPTCHA to prevent spam
minchars=12:string::2:Min chars per post
maxchars=02:string::1000:Max chars per post
textboxer=03:select:None,V2:V2:Textboxer support
formatdate=04:string::d.m.Y:Dateformat
formattime=05:string::H&#58;i:Timeformat
multiposting=06:select:Yes,No:Yes:Allow multiposting
editable=07:select:Yes,No:Yes:Allow registered members to edit their own entry
bbcodes=08:select:Yes,No:Yes:Allow bbcodes
smilies=09:select:Yes,No:Yes:Allow smilies
[END_SED_EXTPLUGIN_CONFIG]

==================== */

if ( !defined('SED_CODE') ) { die("Wrong URL."); }

?>
