<?php

require_once("plugins/textboxer2/inc/textboxer2.lang.php");
require_once("plugins/textboxer2/inc/textboxer2.inc.php");

$tb2DropdownIcons = array(-1,49,1,7,10,15,19,23,35);
$tb2MaxSmilieDropdownHeight = 300;  // Height in px for smilie dropdown
$tb2InitialSmilieLimit = 20;        // Smilies loaded by default to dropdown
$tb2TextareaRows = 12;              // Rows of the textarea

$tb2ParseBBcodes = ($cfg['plugin']['guestbook']['bbcodes'] == 'Yes') ? TRUE : FALSE;
$tb2ParseSmilies = ($cfg['plugin']['guestbook']['smilies'] == 'Yes') ? TRUE : FALSE;
$tb2ParseBR = TRUE;

if ($tb2ParseBBcodes == FALSE AND $tb2ParseSmilies == FALSE)
    {
    $t->assign(array(
            "GUESTBOOK_FORM_TEXT" => "<textarea name=\"rtext\" rows=\"8\" cols=\"64\">".$rtext."</textarea>",
                ));
    }
else
    {
    if ($tb2ParseBBcodes == TRUE AND $tb2ParseSmilies == FALSE)
        {
        $tb2Buttons = array(
            'tb_ieOnlyStart',
                2,
                    'copy',
                    'cut',
                    'paste',
                '}',
            'tb_ieOnlyEnd',

            'bold',
            'underline',
            'italic',

            3,
                'left',
                'center',
                'right',
            '}',

            4,
                'quote',
                'code',
                'list',
                'hr',
                'spacer',
                'ac',
                'p',
            '}',

            5,
                'image',
                'thumb',
                'colleft',
                'colright',
            '}',

            6,
                'url',
    //          'urlp',
                'email',
    //          'emailp',
            '}',

            7,
                'black',
                'grey',
                'sea',
                'blue',
                'sky',
                'green',
                'yellow',
                'orange',
                'red',
                'white',
                'pink',
                'purple',
            '}',

            8,
                'page',
    //          'pagep',
                'user',
    //          'link',
    //          'linkp',
                'flag',
                'pfs',
                'topic',
                'post',
                'pm',
            '}',

    //      1,
    //          'smilies',
    //      '}',
            //'more',
    //      'title',
            'preview'
            );
        }
    elseif ($tb2ParseBBcodes == FALSE AND $tb2ParseSmilies == TRUE)
        {
        $tb2Buttons = array(
            1,
            'smilies',
            '}',
            'preview'
        );
        }

    $t->assign("GUESTBOOK_FORM_TEXT",
        sed_textboxer2('rtext',
        'guestbookentry',
        $rtext,
        $tb2TextareaRows,
        $tb2TextareaCols,
        'guestbook',
        $tb2ParseBBcodes,
        $tb2ParseSmilies,
        $tb2ParseBR,
        $tb2Buttons,
        $tb2DropdownIcons,
        $tb2MaxSmilieDropdownHeight,
        $tb2InitialSmilieLimit).$pfs);

    }

?>
