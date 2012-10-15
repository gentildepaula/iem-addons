<?php
/*
 * IEM_PATH: admin/com
 */
$installer_addon_name = "Spins";
$files = array();
/*$files[] = array(
    'fuse'=>true,
    'file'=>IEM_PATH . '/../com/ext/interspire_email/email.php',
    'data'=>array(
        array(
            'default;597;i;A1'
        ),
        array(
            'default;1477;i;A2'
        ),
        array(
            'default;776;i;A4'
        ),
        array(
            'default;910;i;A5'
        ),
        array(
            'default;793;r;A4_A'
        ),
        array(
            'default;799;r;A4_B'
        ),
        array(
            'default;802;r;A4_C'
        ),
        array(
            'default;804;r;A4_D'
        ),
        array(
            'default;1575;i;A4_E'
        ),
        array(
            'default;1588;r;A4_F'
        ),
        array(
            'default;1615;r;A4_G'
        )));*/
$files[] = array(
    'fuse'=>true,
    'file'=>IEM_PATH . '/../functions/api/send.php',
    'data'=>array(
        array(
            'default;671;i;1A'
        )
        ));
	$files[] = array(
    'fuse'=>true,
    'file'=>IEM_PATH . '/../functions/api/ss_email.php',
    'data'=>array(
        array(
            'line'=>1292,
            'insert'=>'i',
            'content'=>'2A'),
    	array(
            'line'=>1364,
            'insert'=>'i',
            'content'=>'2B'),
    	array(
            'line'=>985,
            'insert'=>'r',
            'content'=>'2C')));
	$files[] = array(
			'fuse'=>true,
			'file'=>IEM_PATH . '/../com/ext/interspire_email/email.php',
			'data'=>array(
					array(
			            'line'=>1289,
			            'insert'=>'r',
			            'content'=>'3A')
			));
?>