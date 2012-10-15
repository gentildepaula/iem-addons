<?php
/*

 $LastChangedDate: 2012-09-17 04:42:22 -0400 (Mon, 17 Sep 2012) $
 $Rev: 1258 $
 $Author: maborak $
 $Id: installer.php 1258 2012-09-17 08:42:22Z maborak $
 $HeadURL: svn://source.maborak.com/dev/interspire/email.marketer/addons/installer/installer.php $
 
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
if (!class_exists('Interspire_Addons', false)) {
	require_once(dirname(dirname(__FILE__)) . '/interspire_addons.php');
}
require_once (dirname(__FILE__) . '/language/language.php');
class Addons_installer extends Interspire_Addons
{
    private $addon_name = "installer";
	public function Install()
	{
		$tables = $sequences = array();
        $this->Process("installer", "GetApi", "installer")->install($this->addon_name);
		$this->db->StartTransaction();

		require dirname(__FILE__) . '/schema.' . SENDSTUDIO_DATABASE_TYPE . '.php';
		foreach ($queries as $query) {
			$qry = str_replace('%%TABLEPREFIX%%', $this->db->TablePrefix, $query);
			$result = $this->db->Query($qry);
			if (!$result) {
				$this->db->RollbackTransaction();
				throw new Interspire_Addons_Exception("There was a problem running query " . $qry . ": " . $this->db->GetErrorMsg(), Interspire_Addons_Exception::DatabaseError);
			}
		}
		$this->enabled = true;
		$this->configured = true;
        try {
			$status = parent::Install();
		} catch (Interspire_Addons_Exception $e) {
			$this->db->RollbackTransaction();
			throw new Exception("Unable to install addon {$this->GetId()} " . $e->getMessage());
		}
		$this->db->CommitTransaction();
		return true;
	}
	public function UnInstall()
	{
		$tables = $sequences = array();
 		$this->Process("installer", "GetApi", "installer")->uninstall($this->addon_name);
		$this->db->StartTransaction();

		try {
			$this->Disable();
		} catch (Interspire_Addons_Exception $e) {
			$this->db->RollbackTransaction();
			throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
		}

		require dirname(__FILE__) . '/schema.' . SENDSTUDIO_DATABASE_TYPE . '.php';
	    try {
			$status = parent::UnInstall();
		} catch (Interspire_Addons_Exception $e) {
			$this->db->RollbackTransaction();
			throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
		}

		$this->db->CommitTransaction();

		return true;
	}
	public function Enable()
	{
		try {
			$status = parent::Enable();
		} catch (Interspire_Addons_Exception $e) {
			throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
		}
		return true;
	}
	public function Disable()
	{
		try {
			$status = parent::Disable();
		} catch (Interspire_Addons_Exception $e) {
			throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
		}
		return true;
	}
	public function Admin_Action_Default()
	{
	    
	}
	function GetEventListeners()
	{
		$my_file = '{%IEM_ADDONS_PATH%}/installer/installer.php';
		$listeners = array();
		$listeners[] =
			array (
				'eventname' => 'IEM_USERAPI_GETPERMISSIONTYPES',
				'trigger_details' => array (
					'Interspire_Addons',
					'GetAddonPermissions',
				),
				'trigger_file' => $my_file
			);
		return $listeners;
	}
	static function RegisterAddonPermissions()
	{
		/*$description = self::LoadDescription('mta');
		$perms = array (
			'mta' => array (
				'addon_description' => GetLang('Addon_Mta_Header'),
				'manage' => array('name' => "Manage Mta Groups")
			),
		);
		self::RegisterAddonPermission($perms);*/
	}
	protected function GetApi($api='Installer')
	{
        $api = (is_array($api)) ? $api[0] : $api;
        $path = $this->addon_base_directory . $this->addon_id . '/api/' . strtolower($api) . '.php';
        if (! is_file($path)) {
            return false;
        }
        require_once $path;
        $api = Installer_API::Singleton();
        $api->template_system=$this->template_system;
        return $api;
	}
}
