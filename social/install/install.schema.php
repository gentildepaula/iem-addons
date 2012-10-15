<?php
/*
 * IEM_PATH: admin/com
 */
$installer_addon_name = "Social Network";
$files = array();
$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/header.tpl',
    'data'=>array(
        array(
        	'geostats;23;i;JQPLOT_EMPTY',
        	'default;23;i;JQPLOT'
        ))
);
$files[] = array(
    'fuse'=>true,
    'file'=>IEM_PATH . '/../../display.php',
    'data'=>array(
        array(
            'line'=>221,
            'insert'=>'i',
            'content'=>'1')));
$files[] = array(
    'fuse'=>true,
    'file'=>IEM_PATH . '/../functions/stats.php',
    'data'=>array(
        array(
            'default;758;i;2'
        )));
$files[] = array(
    'fuse'=>true,
    'file'=>IEM_PATH . '/../functions/api/ss_email.php',
    'data'=>array(
        array(
            'line'=>1000,
            'insert'=>'i',
            'content'=>'4A'),
        array(
            'line'=>774,
            'insert'=>'i',
            'content'=>'4B'),
        array(
            'line'=>386,
            'insert'=>'i',
            'content'=>'4B')/*,
        array(
            'line'=>395,
            'insert'=>'i',
            'content'=>'EMAIL2'),
        array(
            'line'=>774,
            'insert'=>'i',
            'content'=>'EMAIL2')*/));

$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/stats_newsletters_step3.tpl',
    'data'=>array(
        array(
            'line'=>20,
            'insert'=>'i',
            'content'=>'TEMPLATE_1'),
        array(
            'line'=>152,
            'insert'=>'i',
            'content'=>'TEMPLATE_2')));
$files[] = array(
    'fuse'=>true,
    'type'=>'php',
    'file'=>IEM_PATH . '/../functions/api/stats.php',
    'data'=>array(
        array(
            'line'=>2826,
            'insert'=>'i',
            'content'=>'API_STATS_1'),
        array(
            'line'=>2880,
            'insert'=>'i',
            'content'=>'API_STATS_2')));
?>