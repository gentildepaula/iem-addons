<?php
/*

$LastChangedDate: 2012-09-16 21:12:57 -0400 (Sun, 16 Sep 2012) $
$Rev: 1255 $
$Author: maborak $
$Id: config.php 1255 2012-09-17 01:12:57Z maborak $
$HeadURL: svn://source.maborak.com/dev/interspire/email.marketer/addons/installer/config/config.php $

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
define("INSTALLER_INSTALL_SCHEMA_PATCH",false);  //If its true, the installer will take: installer.schema.IEMVERSION_patch.php 
define("ADDONS_DEBUG",true);
error_reporting("E_ALL");
ini_set("display_errors", 1);
