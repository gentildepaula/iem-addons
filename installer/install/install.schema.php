<?php
/*
 * IEM_PATH: admin/com
 */
$installer_addon_name = "Installer";
$files = array();
$files[] = array(
    'fuse'=>false,
    'type'=>'js',
    'file'=>IEM_PATH . '/../includes/js/javascript.js',
    'data'=>array(
        array(
            'line'=>2546,
            'insert'=>'i',
            'content'=>'TRIGGER')));
$files[] = array(
		'fuse'=>false,
		'type'=>'tpl',
		'file'=>IEM_PATH . '/templates/header.tpl',
		'data'=>array(
				array(
						'line'=>23,
						'insert'=>'i',
						'content'=>'JQUERY')));

?>