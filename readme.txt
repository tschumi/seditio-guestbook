Features :

This is a powerfull guestbook plugin for your website.

People who want to leave an entry in your guestbook can enter their name, email, website and of course their message (email and website are optional).

If you want to allow your unregistered guests to post to your guestbook also, they can enter any name they want - if it isen't registered by another member. If they use a allready registered name, an error message will inform them. To avoid spam, you can enable the CAPTCHA* verify for guests.

If you want allow only registered members to sign your guestbook, a notification and a link to register will apear instead of the "Sign guestbook" link.

You could also choose, if registered users could edit their own posts.

Installation :

1 : Unpack and upload the files into the folder : /plugins/guestbook/

2 : Go into the administration panel, then tab "Plugins", click the name of the new plugin, and at bottom of the plugin properties, select "Install all".

3 : Then in the same page, check if this plugin require new tags in the skin files (.TPL).
If yes, then open the skin file(s) with a text editor, and add the tag(s).

4 : Some extended plugins have their own configuration entries, available by clicking the number near "Configuration" in the plugin properties, or go directly to the main configuration tab, section "Plugins".

5 : Some extended plugins require their own SQL-Tables. After making a backup of your DB, insert the new tables of the .sql file into your DB (IE with phpMyAdmin)

Notes :

Don't forget to insert the new table into your DB (guestbook.sql).

If you want to allow your guests to submit entries to your guestbook, you have to give them write permission.

It's shipped with an english and a german language file, if you're using another language you have to translate it yourself.

Adjust the settings in the configuration panel :

- Maximum posts per page (Default: 10)
- Display author as link to user details (Default: Yes)
- Guest must verify with a CAPTCHA to prevent spam (Default: Yes)
- Minimum chars per post (Default: 2)
- Maximum chars per post (Default: 1000)
- Textboxer support (Default: V2)
- Dateformat (Default:
- Timeformat (Default:
- Allow multiposting (Default: Yes)
- Allow registered members to edit their own entry (Default: Yes)
- Allow bbcodes (Default: Yes)
- Allow smilies (Default: Yes)

After the installation the link for the plugin will be: http://www.yoursite.com/plug.php?e=guestbook

Big thanks to :

- Edward Eliot for his genius PhpCaptcha class
- famfamfam.com for the cool Silk icon set

Copyrights :

- PhpCaptcha is licensed under the Free BSD license.
- The icons on the buttons are licensed under Creative Commons Attribution 2.5 license.

History :

v100 (first version for Seditio)
- ported to Seditio
- nearly recoded the whole thing and optimized the code
- new: now users can edit their own entry (optional)
- new: administrators can edit all entries (not just delete them)
- new: now there are buttons for email, website and edit
- new: there are icons for user, date, time
- new: if guests are allowed to submit an entry (optional) they have to pass a CAPTCHA* verify to prevent spam (optional)**
- new: you can edit the date/time format in the config panel
- new: all words are translated (no hardcoded words in the tpl), so you could use it on multilanguage sites
- fixed: a problem with the textboxer if you have allowed BBcode but no smilies
- fixed: a few tiny things i diden't remember

* CAPTCHA: Completely Automated Public Turing-Test to Tell Computers and Humans Apart
** Idea to integrate the CAPTCHA into the guestbook by schneebi 