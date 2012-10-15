<?php
/*
 * IEM_PATH: admin/com
 */
$installer_addon_name = "Multiple MTA";
$files = array();
$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/send_step3.tpl',
    'data'=>array(
        array(
            'line'=>189,
            'insert'=>'i',
            'content'=>'1A')));
$files[] = array(
    'fuse'=>true,
    'type'=>'php',
    'file'=>IEM_PATH . '/../functions/send.php',
    'data'=>array(
        array(
            'line'=>940,
            'insert'=>'i',
            'content'=>'2A'),
        array(
            'line'=>332,
            'insert'=>'i',
            'content'=>'2B')
    ));
$files[] = array(
    'fuse'=>true,
    'type'=>'php',
    'file'=>IEM_PATH . '/../functions/api/send.php',
    'data'=>array(
        array(
            'line'=>671,
            'insert'=>'i',
            'content'=>'3A')
	));
	
$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/send_step4_cron.tpl',
    'data'=>array(
        array(
            'line'=>29,
            'insert'=>'i',
            'content'=>'4A')));

$files[] = array(
    'fuse'=>true,
    'type'=>'php',
    'file'=>IEM_PATH . '/../functions/api/jobs_send.php',
    'data'=>array(
        array(
            'line'=>338,
            'insert'=>'i',
            'content'=>'5A'),
        array(
            'line'=>359,
            'insert'=>'i',
            'content'=>'5B'),
        array(
            'line'=>392,
            'insert'=>'i',
            'content'=>'5B')
	));
$files[] = array(
    'fuse'=>true,
	'type'=>'php',
    'file'=>IEM_PATH . '/../functions/schedule.php',
    'data'=>array(
		array(
            'line'=>262,
            'insert'=>'i',
            'content'=>'6A')
 ));

        
$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/schedule_manage.tpl',
    'data'=>array(
        array(
            'line'=>192,
            'insert'=>'i',
            'content'=>'6B')));
        
 $files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/schedule_manage_row.tpl',
    'data'=>array(
        array(
            'line'=>20,
            'insert'=>'i',
            'content'=>'6C')));
?>