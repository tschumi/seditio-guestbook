<?php

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/guestbook/inc/guestbook.functions.inc.php
Version=100
Updated=2006-apr-21
Type=Plugin
Author=riptide
Description=Functions for the guestbook
[END_SED]

==================== */

function gb_checkupdaterights($id='0')
	{
	global $db_guestbook, $cfg, $usr, $admin;
	
	if($id > '0')
		{
		$sql = sed_sql_query("SELECT gb_authorid FROM $db_guestbook WHERE gb_id='$id' LIMIT 1 ");
		$row = mysql_fetch_array($sql);
		
        if($row['gb_authorid'] == $usr['id'] && $row['gb_authorid'] > 0 && $cfg['plugin']['guestbook']['editable'] == 'Yes')
            {
            return(TRUE);
            }
        elseif ($admin == TRUE)
        	{
        	return(TRUE);
        	}
        else
            {
            return(FALSE);
            }
		}
	else
		{
		return(FALSE);
		}

	}


?>
