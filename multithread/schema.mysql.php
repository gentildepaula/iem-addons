<?php
/*

$LastChangedDate: 2012-05-25 04:22:09 -0400 (Fri, 25 May 2012) $
$Rev: 1154 $
$Author: maborak $
$Id: schema.mysql.php 1154 2012-05-25 08:22:09Z maborak $
$HeadURL: svn://source.maborak.com/dev/interspire/email.marketer/addons/multithread/schema.mysql.php $

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
$queries = array();
$queries[]="CREATE TABLE IF NOT EXISTS `%%TABLEPREFIX%%addon_multithread_slots` (
`uid` int(11) NOT NULL AUTO_INCREMENT,
`jobid` int(11) NOT NULL DEFAULT '0',
`lastupdatetime` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`uid`)
) ENGINE=InnoDB";

$queries[]="CREATE TABLE IF NOT EXISTS `%%TABLEPREFIX%%addon_multithread_lock` (
  `uid` int(11) NOT NULL auto_increment,
  `jobid` int(11) NOT NULL default '0',
  `started` int(11) NOT NULL default '0',
  `finished` int(11) NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB";

$queries_no_error=array();
$queries_no_error[]="ALTER TABLE `%%TABLEPREFIX%%jobs` ADD `multithread` INT NOT NULL DEFAULT '0'";
$queries_no_error[]="ALTER TABLE `%%TABLEPREFIX%%queues` ADD `multithread_id` INT NOT NULL DEFAULT '0'";
$queries_no_error[]="ALTER TABLE `%%TABLEPREFIX%%addon_multithread_slots` ADD `emails` INT(11) NOT NULL DEFAULT '0'";
$queries_no_error[]="ALTER TABLE `%%TABLEPREFIX%%addon_multithread_slots` ADD `sent` INT(11) NOT NULL DEFAULT '0'";
$queries_no_error[]="ALTER TABLE `%%TABLEPREFIX%%addon_multithread_slots` ADD `jobid` INT(11) NOT NULL DEFAULT '0'";
$queries_no_error[]="ALTER TABLE `%%TABLEPREFIX%%addon_multithread_slots` ADD `failed` INT(11) NOT NULL DEFAULT '0'";
//$queries_no_error[]="ALTER TABLE `%%TABLEPREFIX%%jobs` ADD INDEX `multithread_idx` ( `multithread_id` )";

