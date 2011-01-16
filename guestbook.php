<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/guestbook/guestbook.php
Version=100a
Updated=2006-sep-07
Type=Plugin
Author=riptide
Description=A powerfull guestbook for your website
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=guestbook
Part=main
File=guestbook
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]

==================== */

if ( !defined('SED_CODE') OR !defined('SED_PLUG') ) { die("Wrong URL."); }

$db_guestbook = "sed_guestbook";

require_once("plugins/guestbook/inc/guestbook.functions.inc.php");
require_once("plugins/guestbook/inc/php-captcha.inc.php");

//Import the variables
$a  = sed_import('a','G','TXT');
$id  = sed_import('id','G','TXT');
$d  = sed_import('d','G','TXT');
$rtext  = sed_import('rtext','P','TXT');
$ruser  = sed_import('ruser','P','TXT');
$remail = sed_import('remail','P','TXT');
$rwebsite  = sed_import('rwebsite','P','TXT');
$rverify  = sed_import('rverify','P','TXT');
$del  = sed_import('del','P','STX');

//Check the rights
$admin  = sed_auth('plug', 'guestbook', 'A');
$read   = sed_auth('plug', 'guestbook', 'R');
$write  = sed_auth('plug', 'guestbook', 'W');

$t-> assign(array(
	"GUESTBOOK_TITLE" => $L['plu_title'],
        ));
$t->parse("MAIN.GUESTBOOK_TITLE");

if ($a == "send")
	{
	if ($cfg['plugin']['guestbook']['verify'] == 'Yes' && $usr['id'] == '0')
		{
		if (!PhpCaptcha::Validate($rverify))
            {
            $error_string .= $L['plu_notverified']."<br>";
            }
		}
	
	if ($ruser == "")
		{
        $error_string .= $L['plu_noname']."<br>";
        }

	if ($remail != "")
		{
		$error_string .= (strlen($remail) < 4 || !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$",$remail)) ? $L['plu_emailnotvalid']."<br />" : "";
		}

	if ($rwebsite != "")
		{
		$error_string .= (!eregi("[[:alpha:]]+://",$rwebsite)) ? $L['plu_websitenotvalid']."<br />" : "";
		}

	$error_string .= (strlen($rtext) < $cfg['plugin']['guestbook']['minchars']) ? $L['plu_entrytooshort']."<br>" : "";
	$error_string .= (strlen($rtext) > $cfg['plugin']['guestbook']['maxchars']) ? $L['plu_entrytoolong']."<br>" : "";

	if ($cfg['plugin']['guestbook']['multiposting'] == 'No')
	    {
        $num = sed_sql_numrows(sed_sql_query("SELECT gb_author FROM $db_guestbook WHERE (gb_author='$ruser')"));

        if ($num > 0)
            {
            $error_string .= $L['plu_nameinuse']."<br>";
            }
        }

    if ($usr['id'] == 0)
    	{
    	$num = sed_sql_numrows(sed_sql_query("SELECT user_name FROM $db_users WHERE user_name='$ruser'"));

    	if ($num > 0)
            {
            $error_string .= $L['plu_nameregistered']."<br>";
            }
    	}

    if ($write == FALSE)
    	{
        $error_string .= $L['plu_regonly']."<br>";
    	}

	if ($error_string == "")
		{
		$ruser = sed_sql_prep($ruser);
		$rtext = sed_sql_prep($rtext);
		$rdate = $sys['now_offset'];
		$rwebsite = ($rwebsite != "http://") ? sed_sql_prep($rwebsite) : '';

		$sql = sed_sql_query("INSERT INTO $db_guestbook (gb_author, gb_authorid, gb_text, gb_date, gb_email, gb_website) VALUES ('$ruser', '".$usr['id']."', '$rtext', '".$rdate."', '$remail', '$rwebsite')");
		
		header("Location: plug.php?e=guestbook");
		exit;
		}
	}
	
if ($a == "update" && $id != "")
	{
	$update = gb_checkupdaterights($id);

	if ($del == TRUE && $update == TRUE)
		{
		$sql = sed_sql_query("DELETE FROM $db_guestbook WHERE gb_id='$id' ");
		header("Location: plug.php?e=guestbook");
		exit;
		}
	
	if($update == FALSE)
		{
		$error_string .= $L['plu_noupdaterights']."<br>";
		}
	
	if ($ruser == "")
		{
        $error_string .= $L['plu_noname']."<br>";
        }
	
	if ($remail != "")
		{
		$error_string .= (strlen($remail) < 4 || !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$",$remail)) ? $L['plu_emailnotvalid']."<br />" : "";
		}

	if ($rwebsite != "")
		{
		$error_string .= (!eregi("[[:alpha:]]+://",$rwebsite)) ? $L['plu_websitenotvalid']."<br />" : "";
		}

	$error_string .= (strlen($rtext) < $cfg['plugin']['guestbook']['minchars']) ? $L['plu_entrytooshort']."<br>" : "";
	$error_string .= (strlen($rtext) > $cfg['plugin']['guestbook']['maxchars']) ? $L['plu_entrytoolong']."<br>" : "";

	if ($error_string == "")
		{
		$ruser = sed_sql_prep($ruser);
		$rtext = sed_sql_prep($rtext);
		$rdate = $sys['now_offset'];
		$rwebsite = ($rwebsite != "http://") ? sed_sql_prep($rwebsite) : '';
		
		$sql = sed_sql_query("UPDATE $db_guestbook SET gb_author='$ruser', gb_text='$rtext', gb_email='$remail', gb_website='$rwebsite' WHERE gb_id='$id' ");
		
		header("Location: plug.php?e=guestbook");
		exit;
		}
	}

if (isset($error_string))
	{
	$t->assign("GUESTBOOK_ERROR_BODY",$error_string);
	$t->parse("MAIN.GUESTBOOK_ERROR");
	}

if ($a == "sign" OR $a == "send")
	{
   	$bbcodes = ($cfg['plugin']['guestbook']['bbcodes'] == 'Yes') ? sed_build_bbcodes("guestbookentry", "rtext", $L['BBcodes']) : '';
	$smilies = ($cfg['plugin']['guestbook']['smilies'] == 'Yes') ? sed_build_smilies("guestbookentry", "rtext", $L['Smilies']) : '';

    $name = ($usr['id'] == 0) ? "<input type=\"text\" name=\"ruser\" value=\"".$ruser."\">" : "<input type=\"text\" name=\"ruser\" value=\"".$usr['name']."\" readonly>";
    $email = "<input type=\"text\" name=\"remail\" value=\"".$remail."\">";
    $website = ($rwebsite == "") ? "<input type=\"text\" name=\"rwebsite\" value=\"http://\">" : "<input type=\"text\" name=\"rwebsite\" value=\"".$rwebsite."\">";

	$t->assign(array(
		"GUESTBOOK_FORM_SEND" => "plug.php?e=guestbook&amp;a=send",
		"GUESTBOOK_FORM_INTROTEXT" => $L['plu_addnewentry'],
		"GUESTBOOK_FORM_AUTHOR_TITLE" => $L['plu_form_name'],
		"GUESTBOOK_FORM_AUTHOR" => $name,
		"GUESTBOOK_FORM_EMAIL_TITLE" => $L['plu_form_email'],
		"GUESTBOOK_FORM_EMAIL" => $email,
		"GUESTBOOK_FORM_WEBSITE_TITLE" => $L['plu_form_website'],
		"GUESTBOOK_FORM_WEBSITE" => $website,
		"GUESTBOOK_FORM_TEXT_TITLE" => $L['plu_form_text'],
		"GUESTBOOK_FORM_SEND_BUTTON" => $L['plu_form_send'],
			));
				
	if ($cfg['plugin']['guestbook']['textboxer'] == "None")
		{
		$t->assign(array(
			"GUESTBOOK_FORM_TEXT" => "<textarea name=\"rtext\" rows=\"8\" cols=\"64\">".$rtext."</textarea><br />".$bbcodes."&nbsp;&nbsp;".$smilies."&nbsp;&nbsp;",
					));
		}
	
	if ($cfg['plugin']['guestbook']['textboxer'] == "V2")
        {
        require_once("plugins/guestbook/inc/guestbook.textboxer.inc.php");
        }

	if ($cfg['plugin']['guestbook']['verify'] == 'Yes' && $usr['id'] == '0')
		{
        $verifyimg = "<img src='plugins/guestbook/inc/captcha.php' width='200' height='60' alt=''>";
        $verifyinput = "<input name=\"rverify\" type=\"text\" id=\"rverify\" size=\"10\" maxlength=\"10\">";
        
		$t->assign(array(
            "GUESTBOOK_FORM_VERIFYIMG" => $verifyimg,
            "GUESTBOOK_FORM_VERIFICATION_TITLE" => $L['plu_form_verification'],
            "GUESTBOOK_FORM_VERIFYINPUT" => $verifyinput,
			));
                
        $t->parse("MAIN.GUESTBOOK_FORM_ADD.VERIFY");
        }
        
    $t->parse("MAIN.GUESTBOOK_FORM_ADD");	
	}
	
if ($a == "edit" OR $a == "update")
	{
	$update = gb_checkupdaterights($id);
	
	if($update == FALSE)
		{
		header("Location: plug.php?e=guestbook");
		exit;
		}
	
	$sql = sed_sql_query("SELECT * from $db_guestbook WHERE gb_id='$id' ");
	$row = mysql_fetch_array($sql);
	
	$ruser = sed_cc($row['gb_author']);
	$ruserid = sed_cc($row['gb_authorid']);
	$remail = sed_cc($row['gb_email']);
	$rwebsite = sed_cc($row['gb_website']);
	$rtext = sed_cc($row['gb_text']);
	
   	$bbcodes = ($cfg['plugin']['guestbook']['bbcodes'] == 'Yes') ? sed_build_bbcodes("guestbookentry", "rtext", $L['BBcodes']) : '';
	$smilies = ($cfg['plugin']['guestbook']['smilies'] == 'Yes') ? sed_build_smilies("guestbookentry", "rtext", $L['Smilies']) : '';

    $name = ($admin == TRUE) ? "<input type=\"text\" name=\"ruser\" value=\"".$ruser."\">" : "<input type=\"text\" name=\"ruser\" value=\"".$ruser."\" readonly>";
    $email = "<input type=\"text\" name=\"remail\" value=\"".$remail."\">";
    $website = ($rwebsite == "") ? "<input type=\"text\" name=\"rwebsite\" value=\"http://\">" : "<input type=\"text\" name=\"rwebsite\" value=\"".$rwebsite."\">";
	$delete = "<input type=\"checkbox\" name=\"del\" value=\"TRUE\">";

	$t->assign(array(
		"GUESTBOOK_FORM_SEND" => "plug.php?e=guestbook&amp;a=update&amp;id=".$id."",
		"GUESTBOOK_FORM_INTROTEXT" => $L['plu_editentry'],
		"GUESTBOOK_FORM_AUTHOR_TITLE" => $L['plu_form_name'],
		"GUESTBOOK_FORM_AUTHOR" => $name,
		"GUESTBOOK_FORM_EMAIL_TITLE" => $L['plu_form_email'],
		"GUESTBOOK_FORM_EMAIL" => $email,
		"GUESTBOOK_FORM_WEBSITE_TITLE" => $L['plu_form_website'],
		"GUESTBOOK_FORM_WEBSITE" => $website,
		"GUESTBOOK_FORM_TEXT_TITLE" => $L['plu_form_text'],
		"GUESTBOOK_FORM_DELETE_TITLE" => $L['plu_form_delete'],
		"GUESTBOOK_FORM_DELETE" => $delete,
		"GUESTBOOK_FORM_UPDATE_BUTTON" => $L['plu_form_update'],
			));
			
	if ($cfg['plugin']['guestbook']['textboxer'] == "None")
		{
		$t->assign(array(
			"GUESTBOOK_FORM_TEXT" => "<textarea name=\"rtext\" rows=\"8\" cols=\"64\">".$rtext."</textarea><br />".$bbcodes."&nbsp;&nbsp;".$smilies."&nbsp;&nbsp;",
					));
		}
	
	if ($cfg['plugin']['guestbook']['textboxer'] == "V2")
        {
        require_once("plugins/guestbook/inc/guestbook.textboxer.inc.php");
        }	
			
	$t->parse("MAIN.GUESTBOOK_FORM_EDIT");
	}

if ($a == "")
	{
	if ($write == FALSE)
		{
		$gb_signguestbook = $L['plu_regonly'];
		}
	else
		{
		$gb_signguestbook = "<a href=\"plug.php?e=guestbook&amp;a=sign\">".$L['plu_signguestbook']."</a>";
        }

    $t->assign(array(
            "GUESTBOOK_SIGNGUESTBOOK" => $gb_signguestbook,
                ));
        $t->parse("MAIN.GUESTBOOK_SIGNGUESTBOOK");

	if (empty($d)) { $d = '0'; }

    $sql = sed_sql_query("SELECT * from $db_guestbook ORDER BY gb_id DESC LIMIT $d, ".$cfg['plugin']['guestbook']['maxposts']."");
	$sql1 = sed_sql_query("SELECT COUNT(*) FROM $db_guestbook ");

    $totalentries = mysql_result($sql1,0,"COUNT(*)");

    $totalpages = (ceil($totalentries / $cfg['plugin']['guestbook']['maxposts']) != 0) ? ceil($totalentries / $cfg['plugin']['guestbook']['maxposts']) : "1";
    $currentpage= ceil ($d / $cfg['plugin']['guestbook']['maxposts'])+1;

    unset($pageprev, $pagenext);

    if ($d > 0)
        {
        $prevpage = $d - $cfg['plugin']['guestbook']['maxposts'];
        if ($prevpage < 0)
            { $prevpage = 0; }
        $pageprev = "<a href=\"plug.php?e=guestbook&amp;d=$prevpage\">$sed_img_left ".$L['plu_previous']."</a>";
        }

    if (($d + $cfg['plugin']['guestbook']['maxposts']) < $totalentries)
        {
        $nextpage = $d + $cfg['plugin']['guestbook']['maxposts'];
        $pagenext = "<a href=\"plug.php?e=guestbook&amp;d=$nextpage\">".$L['plu_next']." $sed_img_right</a>";
        }


    $t-> assign(array(
    "GUESTBOOK_CURRENTPAGE" => $currentpage,
    "GUESTBOOK_TOTALPAGES" => $totalpages,
    "GUESTBOOK_PAGEPREV" => $pageprev,
    "GUESTBOOK_PAGENEXT" => $pagenext,
            ));
    $t->parse("MAIN.GUESTBOOK_PREVNEXT");

    $i=0;
    if ($totalentries > 0)
        {
        while ($row = mysql_fetch_array($sql) AND $i < $cfg['plugin']['guestbook']['maxposts'])
            {
            $gb_id = $row["gb_id"];
            $gb_author = stripslashes($row["gb_author"]);
            $gb_authorid = $row["gb_authorid"];
            $gb_text = stripslashes($row["gb_text"]);
            $gb_date = date($cfg['plugin']['guestbook']['formatdate'],$row["gb_date"] + $usr['timezone'] * 3600);
            $gb_time = date($cfg['plugin']['guestbook']['formattime'],$row["gb_date"] + $usr['timezone'] * 3600);
            $gb_email = stripslashes($row["gb_email"]);
            $gb_website = stripslashes($row["gb_website"]);

            $bbcodes = ($cfg['plugin']['guestbook']['bbcodes'] == 'Yes') ? "TRUE" : '';
            $smilies = ($cfg['plugin']['guestbook']['smilies'] == 'Yes') ? "TRUE" : '';

            $update = gb_checkupdaterights($gb_id);
            
            if($update == TRUE)
            	{
            	$gb_edit = "<a href='plug.php?e=guestbook&amp;a=edit&amp;id=".$gb_id."'><img src=\"plugins/guestbook/img/edit.gif\" alt=\"".$L['plu_edit']."\" /></a>&nbsp;&nbsp;";
            	}
            else
            	{
            	$gb_edit = "";
            	}
            	
            $gb_authorlink = ($cfg['plugin']['guestbook']['authorlink'] == "Yes") ? sed_build_user($gb_authorid, $gb_author) : $gb_author;
            $gb_email      = ($gb_email != "") ? "<a href='mailto:".$gb_email."'><img src=\"plugins/guestbook/img/email.gif\" alt=\"".$L['plu_email']."\" /></a>&nbsp;&nbsp;" : '';
            $gb_website    = ($gb_website != "") ? "<a href='".$gb_website."' target='_blank'><img src=\"plugins/guestbook/img/website.gif\" alt=\"".$L['plu_website']."\" /></a>" : '';

            $t-> assign(array(
                "GUESTBOOK_ROW_ID" => $gb_id,
                "GUESTBOOK_ROW_AUTHOR" => $gb_authorlink,
                "GUESTBOOK_ROW_AUTHORID" => $gb_authorid,
                "GUESTBOOK_ROW_TEXT" => sed_parse($gb_text, $bbcodes, $smilies, 1),
                "GUESTBOOK_ROW_DATE" => $gb_date,
                "GUESTBOOK_ROW_TIME" => $gb_time,
                "GUESTBOOK_ROW_EMAIL" => $gb_email,
                "GUESTBOOK_ROW_WEBSITE" => $gb_website,
                "GUESTBOOK_ROW_EDIT" => $gb_edit,
                ));
            $t->parse("MAIN.GUESTBOOK_ROW");
            $i++;
            }
        }
        else
        {
        $t-> assign(array(
        "GUESTBOOK_EMPTYTEXT" => $L['plu_noentriesyet'],
                ));
        $t->parse("MAIN.GUESTBOOK_EMPTY");
        }
	}



?>
