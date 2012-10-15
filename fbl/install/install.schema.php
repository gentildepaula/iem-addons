<?php
/*
 * IEM_PATH: admin/com
 */
$installer_addon_name = "Feedback Loops";
$files = array();
$files[] = array(
    'fuse'=>true,
    'file'=>IEM_PATH . '/../functions/stats.php',
    'data'=>array(
        array(
            'default;590;i;FBL_COUNT'
        ),
        array(
            'default;754;i;FBL_COUNT2'
        )));
$files[] = array(
    'fuse'=>true,
    'file'=>IEM_PATH . '/../functions/lists.php',
    'data'=>array(
        array(
            'default;333;i;FBL_COUNT3'
        )));
$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/lists_manage.tpl',
    'data'=>array(
        array(
            'line'=>71,
            'insert'=>'i',
            'content'=>'FBL4')));
$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/lists_manage_row.tpl',
    'data'=>array(
        array(
            'line'=>12,
            'insert'=>'i',
            'content'=>'FBL5')));

$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/stats_newsletter_manage.tpl',
    'data'=>array(
        array(
            'line'=>67,
            'insert'=>'i',
            'content'=>'FBL1')));
$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/stats_newsletter_manage_row.tpl',
    'data'=>array(
        array(
            'line'=>26,
            'insert'=>'i',
            'content'=>'FBL2')));
$files[] = array(
    'fuse'=>true,
    'type'=>'tpl',
    'file'=>IEM_PATH . '/templates/stats_newsletters_step3.tpl',
    'data'=>array(
        array(
            'line'=>135,
            'insert'=>'i',
            'content'=>'FBL3')));
/*$files[] = array(
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
            'content'=>'TEMPLATE_2')));*/
?>