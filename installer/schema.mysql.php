<?php
/*

$LastChangedDate: 2012-05-25 04:18:02 -0400 (Fri, 25 May 2012) $
$Rev: 1153 $
$Author: maborak $
$Id: schema.mysql.php 1153 2012-05-25 08:18:02Z maborak $
$HeadURL: svn://source.maborak.com/dev/interspire/email.marketer/addons/installer/schema.mysql.php $

+--------------------------------------------------------------------------------
|   Addons: Installer
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
// the actual queries we're going to run.
$queries = array();
$queries[]="
CREATE TABLE IF NOT EXISTS %%TABLEPREFIX%%addon_installer (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `addon` varchar(255) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '0',
  `installed` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
)";