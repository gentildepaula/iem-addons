<?php
/*

$LastChangedDate: 2012-05-25 11:28:16 -0400 (Fri, 25 May 2012) $
$Rev: 1157 $
$Author: maborak $
$Id: install.schema.php 1157 2012-05-25 15:28:16Z maborak $
$HeadURL: svn://source.maborak.com/dev/interspire/email.marketer/addons/multithread/install/install.schema.php $

+--------------------------------------------------------------------------------
|   Addons: Multithread
|   Copyright (C) 2012 Maborak Technologies <maborak@maborak.com>
+--------------------------------------------------------------------------------

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
/*
 * IEM_PATH: admin/com
 */
$installer_addon_name = "Multi-Thread";
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
            'line'=>945,
            'insert'=>'i',
            'content'=>'2A'),
        array(
            'line'=>332,
            'insert'=>'i',
            'content'=>'2B')
    ));

$files[] = array(
		'fuse'=>true,
		'type'=>'tpl',
		'file'=>IEM_PATH . '/templates/send_step4_cron.tpl',
		'data'=>array(
				array(
						'line'=>29,
						'insert'=>'i',
						'content'=>'3A')));

$files[] = array(
		'fuse'=>true,
		'type'=>'php',
		'file'=>IEM_PATH . '/../functions/api/jobs_send.php',
		'data'=>array(
				array(
						'line'=>52,
						'insert'=>'i',
						'content'=>'4A'),
				array(
						'line'=>161,
						'insert'=>'i',
						'content'=>'4B'),
				array(
						'line'=>323,
						'insert'=>'i',
						'content'=>'4C'),
				array(
						'line'=>320,
						'insert'=>'i',
						'content'=>'4CA'),
				array(
						'line'=>365,
						'insert'=>'r',
						'content'=>'4D'),
				array(
						'line'=>407,
						'insert'=>'i',
						'content'=>'4E'),
				array(
						'line'=>398,
						'insert'=>'i',
						'content'=>'4F')
));

$files[] = array(
		'fuse'=>true,
		'type'=>'php',
		'file'=>IEM_PATH . '/../functions/api/api.php',
		'data'=>array(
				array(
						'line'=>950,
						'insert'=>'i',
						'content'=>'5A')
		));
$files[] = array(
		'fuse'=>true,
		'type'=>'php',
		'file'=>IEM_PATH . '/../functions/api/send.php',
		'data'=>array(
				array('line'=>"565,567",'type'=>'comment'),
				array('line'=>"706,708",'type'=>'comment'),
				array('line'=>681,'insert'=>'r','content'=>"6A"),
				array('line'=>720,'insert'=>'i','content'=>"6B")
		));
$files[] = array(
		'fuse'=>true,
		'type'=>'php',
		'file'=>IEM_PATH . '/init-legacy.php',
		'data'=>array(
				array(
						'line'=>552,
						'insert'=>'i',
						'content'=>'7A')
		));
?>