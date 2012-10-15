<?php
/*

 $LastChangedDate: 2012-08-11 15:53:31 -0400 (Sat, 11 Aug 2012) $
 $Rev: 1219 $
 $Author: maborak $
 $Id: fbl.php 1219 2012-08-11 19:53:31Z maborak $
 $HeadURL: svn://source.maborak.com/release/interspire/email.marketer/addons/fbl/fbl.php $
 
 +--------------------------------------------------------------------------------
 |   Feedback Loops
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
/**
 * Make sure the base Interspire_Addons class is defined.
 */
if (!class_exists('Interspire_Addons', false)) {
	require_once(dirname(dirname(__FILE__)) . '/interspire_addons.php');
}
require_once (dirname(__FILE__) . '/language/language.php');
class Addons_fbl extends Interspire_Addons
{
    private $addon_name = "fbl";
	public function Install()
	{
		$tables = $sequences = array();
    	if (!$this->isEnabled("installer")){throw new Interspire_Addons_Exception("The Addon (Advanced Addons Installer) is required", Interspire_Addons_Exception::AddonDoesntExist);}else{$this->Process("installer", "GetApi", "installer")->install($this->addon_name);}
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
		$result = $this->db->Query ( "SELECT method FROM " . SENDSTUDIO_TABLEPREFIX . "fbl LIMIT 1" );
		if (!$result)
		{
			$result = $this->db->Query ( "ALTER TABLE `" . SENDSTUDIO_TABLEPREFIX . "fbl` ADD `method` INT( 11 ) NOT NULL DEFAULT '1'" );
		}
		$result = $this->db->Query ( "SELECT fbl FROM " . SENDSTUDIO_TABLEPREFIX . "list_subscribers LIMIT 1" );
		if (!$result)
		{
			$result = $this->db->Query ( "ALTER TABLE `" . SENDSTUDIO_TABLEPREFIX . "list_subscribers` ADD `fbl` INT( 11 ) NOT NULL DEFAULT '0'" );
		}
		$result = $this->db->Query ( "SELECT fbl FROM " . SENDSTUDIO_TABLEPREFIX . "list_subscribers_unsubscribe LIMIT 1" );
		if (!$result)
		{
			$result = $this->db->Query ( "ALTER TABLE `" . SENDSTUDIO_TABLEPREFIX . "list_subscribers_unsubscribe` ADD `fbl` INT( 11 ) NOT NULL DEFAULT '0'" );
		}
		$result = $this->db->Query ( "SELECT fbl FROM " . SENDSTUDIO_TABLEPREFIX . "stats_newsletters LIMIT 1" );
		if (!$result)
		{
			$result = $this->db->Query ( "ALTER TABLE `" . SENDSTUDIO_TABLEPREFIX . "stats_newsletters` ADD `fbl` INT( 11 ) NOT NULL DEFAULT '0'" );
		}
		return true;
	}

	/**
	 * UnInstall
	 * Drop tables the addon created.
	 * It includes the schema files (based on the database type) and drops the bits it created.
	 * Once that's done, it calls the parent UnInstall method to do its work.
	 *
	 * @uses Interspire_Addons::UnInstall
	 * @uses Interspire_Addons_Exception
	 *
	 * @return Returns true if the addon was uninstalled successfully.
	 * @throws Throws an Interspire_Addons_Exception::DatabaseError if one of the tables it created couldn't be removed. If the parent::UnInstall method throws an exception, this will
	 * just re-throw that error.
	 */
	public function UnInstall()
	{
		$tables = $sequences = array();
    	if (!$this->isEnabled("installer")){throw new Interspire_Addons_Exception("The Addon (Advanced Addons Installer) is required", Interspire_Addons_Exception::AddonDoesntExist);}else{$this->Process("installer", "GetApi", "installer")->uninstall($this->addon_name);}
		$this->db->StartTransaction();

		try {
			$this->Disable();
		} catch (Interspire_Addons_Exception $e) {
			$this->db->RollbackTransaction();
			throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
		}

		require dirname(__FILE__) . '/schema.' . SENDSTUDIO_DATABASE_TYPE . '.php';
		/*foreach ($tables as $tablename) {
			$query = 'DROP TABLE [|PREFIX|]' . $tablename . ' CASCADE';
			$result = $this->db->Query($query);
			if (!$result) {
				$this->db->RollbackTransaction();
				throw new Interspire_Addons_Exception("There was a problem running query " . $query . ": " . $this->db->GetErrorMsg(), Interspire_Addons_Exception::DatabaseError);
			}
		}*/
	    try {
			$status = parent::UnInstall();
		} catch (Interspire_Addons_Exception $e) {
			$this->db->RollbackTransaction();
			throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
		}

		$this->db->CommitTransaction();

		return true;
	}

	/**
	 * Enable
	 * This enables the split test addon to work, including displaying in the menu(s), adding it's own permissions etc.
	 * It adds an entry to the settings_cron_schedule table
	 * so if necessary, the addon can be run via cron instead of the web interface.
	 *
 	 * @uses Interspire_Addons::Enable
	 * @uses Interspire_Addons_Exception
	 *
	 * @return Returns true if the addon was enabled successfully.
	 * @throws If the parent::Enable method throws an exception, this will just re-throw that error.
	 */
	public function Enable()
	{
		//$this->db->Query("INSERT INTO [|PREFIX|]settings_cron_schedule(jobtype, lastrun) VALUES ('" . $this->db->Quote($this->addon_id) . "', 0)");
		try {
			$status = parent::Enable();
		} catch (Interspire_Addons_Exception $e) {
			throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
		}
		return true;
	}

	/**
	 * Disable
	 * This disables the split test addon from the control panel.
	 * Before it does it, it checks for any non-complete split test sending jobs
	 * If any are found, the addon cannot be disabled.
	 *
	 * If that's ok, it deletes itself from the settings_cron_schedule table and any other settings it created (config_settings table).
	 *
  	 * @uses Interspire_Addons::Disable
	 * @uses Interspire_Addons_Exception
	 *
	 * @return Returns true if the addon was disabled successfully and there are no pending/in progress split test sends.
	 * @throws If the parent::Disable method throws an exception, this will just re-throw that error.
	 */
	public function Disable()
	{
		//$job_check = "SELECT COUNT(jobid) AS jobcount FROM [|PREFIX|]jobs WHERE jobtype='splittest' AND jobstatus NOT IN ('c')";
		try {
			$status = parent::Disable();
		} catch (Interspire_Addons_Exception $e) {
			throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
		}
		return true;
	}
	public function Admin_Action_Default()
	{
		$db = IEM::getDatabase();
		$query = "SELECT * FROM " . SENDSTUDIO_TABLEPREFIX . "fbl";
		$result = $db->Query($query);
		$r=array();
		$api=$this->GetApi();
		$method_label=array("None","Normal","Email","Unsubscribe Link");
		while ($row = $db->Fetch($result)) {
			$connection=$api->connect($row);
			$row['status']=$connection['error'];
			$row['complaints']=$api->count_fbl($connection);
			$row['type']=($row['type']==1)?"IMAP":"POP3";
			$row['method_label']=$method_label[$row['method']];
			$r[]=$row;
			$api->disconnect($connection);
		}
		$this->template_system->Assign('FlashMessages',GetFlashMessages(),false);
		$this->template_system->assign('result',$r);
		$this->template_system->ParseTemplate('main');
	}
	public function Admin_Action_Add()
	{
		$db = IEM::getDatabase();
		$api=$this->GetApi();
		if ($_SERVER['REQUEST_METHOD']=="POST")
		{
			if (!empty($_POST['fbl_test']))
			{
				$data=array(
				'name'=>$_POST['fbl_name'],
				'hostname'=>trim($_POST['fbl_hostname']),
				'username'=>$_POST['fbl_username'],
				'password'=>$_POST['fbl_password'],
				'port'=>$_POST['fbl_port'],
				'type'=>$_POST['fbl_type'],
				'method'=>$_POST['fbl_method'],
				'uid'=>$_POST['fbl_uid'],
				'advanced'=>$_POST['fbl_advanced'],
				);
				$res=$api->connect($data);
				if ($res['error'])
				{
					FlashMessage("Mail Server connection Failed: ".$res['error'],SS_FLASH_MSG_ERROR);
				}
				else 
				{
					FlashMessage("Mail Server logged succesfully!, <b>".$api->count_fbl($res)."</b> complaints to process",SS_FLASH_MSG_SUCCESS);
				}
				$this->template_system->Assign('FlashMessages',GetFlashMessages(),false);
				$this->template_system->assign('do',$_POST['fbl_do']);
				$this->template_system->assign('value',$data);
				$this->template_system->ParseTemplate('fbl_add');
				return;
			}
			if ($_POST['fbl_do']=="update")
			{
				$api->update($_POST);
				$na=$this->db->NumAffected();
				FlashMessage(GetLang("Addon_fbl_Updated"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=fbl");
			}
			else 
			{
				if ($api->add($_POST))
				{
					FlashMessage(GetLang("Addon_fbl_New_Added"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=fbl");
				}
				else
				{
					FlashMessage(GetLang("Addon_fbl_New_Added_Failed"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=fbl");
				}
			}
		}
		else 
		{
			$id=(!empty($_GET['id']))?$_GET['id']:0;
			$f=$api->fbl_details($id,true);
			if ($id!=0 && $f['exist']==false)
			{
				FlashMessage(GetLang("Addon_fbl_Not_Exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=fbl");
			}
			$this->template_system->assign('do',($f['exist']==false)?"add":"update");
			$this->template_system->assign('value',$f['data']);
			$this->template_system->ParseTemplate('fbl_add');
		}
	}
	public function Admin_Action_Process()
	{
		$id=(!empty($_GET['id']))?$_GET['id']:0;
		$api=$this->GetApi();
		$f=$api->fbl_details($id,true);
		if ($id!=0 && $f['exist']==false)
		{
			FlashMessage(GetLang("Addon_fbl_Not_Exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=fbl");
		}
		else
		{
			$con=$api->connect($f['data']);
			$total=$api->count_fbl($con);
			$pinfo=$api->process($con,800);
			$api->disconnect($con);
			FlashMessage(sprintf(GetLang("Addon_fbl_Processed"),$pinfo['processed'],$total),SS_FLASH_MSG_SUCCESS);
			$this->template_system->assign('value',$f['data']);
			$this->template_system->Assign('FlashMessages',GetFlashMessages(),false);
			$this->template_system->ParseTemplate('fbl_process');
		}
	}
	public function Admin_Action_Delete()
	{
		$db = IEM::getDatabase();
		$api=$this->GetApi();
		$id=(!empty($_GET['id']))?$_GET['id']:0;
		$f=$api->fbl_details($id,true);
		if ($id!=0 && $f['exist']==false)
		{
			FlashMessage(GetLang("Addon_fbl_Not_Exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=fbl");
		}
		else
		{
			$api->delete($id);
			FlashMessage(GetLang("Addon_fbl_Deleted"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=fbl");
		}
	}
	public function Admin_Action_Export()
	{
	    $statid=(isset($_GET['statid']))?(int)$_GET['statid']:0;
	    $query="SELECT b.emailaddress, b.fbl, b.unsubscribed FROM " . SENDSTUDIO_TABLEPREFIX . "list_subscribers_unsubscribe a LEFT JOIN " . SENDSTUDIO_TABLEPREFIX . "list_subscribers b ON a.subscriberid=b.subscriberid WHERE a.statid={$statid} AND a.fbl=1 GROUP BY a.subscriberid";
	    $result = $this->db->Query($query);
	    $filename="complaints_in_stat_{$statid}.csv";
	    header("Cache-Control: must-revalidate");
		header("Pragma: must-revalidate");
		header("Content-type: application/vnd.ms-excel");		
		header ( 'Content-Disposition: attachment; filename="' . $filename . '"' );
	    while ($row=$this->db->Fetch($result))
	    {
	        echo $row['emailaddress'].PHP_EOL;
	    }
	}
    public function Admin_Action_ExportList()
	{
	    $listid=(isset($_GET['listid']))?(int)$_GET['listid']:0;
	    $query="SELECT b.emailaddress, b.fbl, b.unsubscribed FROM " . SENDSTUDIO_TABLEPREFIX . "list_subscribers_unsubscribe a LEFT JOIN " . SENDSTUDIO_TABLEPREFIX . "list_subscribers b ON a.subscriberid=b.subscriberid WHERE a.listid={$listid} AND a.fbl=1 GROUP BY a.subscriberid";
	    $result = $this->db->Query($query);
	    $filename="complaints_in_contact_list_{$listid}.csv";
	    header("Cache-Control: must-revalidate");
		header("Pragma: must-revalidate");
		header("Content-type: application/vnd.ms-excel");		
		header ( 'Content-Disposition: attachment; filename="' . $filename . '"' );
	    while ($row=$this->db->Fetch($result))
	    {
	        echo $row['emailaddress'].PHP_EOL;
	    }
	}
	public function Admin_Action_Edit()
	{
		$this->Admin_Action_Add();
	}
	public function Admin_Action_Manager()
	{
		$this->template_system->ParseTemplate('main');
	}
	function GetEventListeners()
	{
		$my_file = '{%IEM_ADDONS_PATH%}/fbl/fbl.php';
		$listeners = array();

		$listeners[] =
			array (
				'eventname' => 'IEM_SENDSTUDIOFUNCTIONS_GENERATEMENULINKS',
				'trigger_details' => array (
					'Addons_fbl',
					'SetMenuItems',
				),
				'trigger_file' => $my_file
			);

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
	static function SetMenuItems(EventData_IEM_SENDSTUDIOFUNCTIONS_GENERATEMENULINKS $data)
	{
		$user = &GetUser();
		$self = new self;
		$menuItems = $data->data;
		$menuItems['contact_button'][]=array (
					'text' => "Feedback Loops",
					'link' => $self->admin_url . '',
					'image' => '../addons/splittest/images/m_splittests.gif',
					'show' => $user->isAdmin(),
					'description' => GetLang('Addon_fbl_Menu_Description'),
		);
		$data->data = $menuItems;
	}
	static function RegisterAddonPermissions()
	{
		$description = self::LoadDescription('fbl');
		$perms = array (
			'fbl' => array (
				'addon_description' => "MT: Feedback Loops - Addon",
				'exportlist' => array('name' => "Export Contact Lists Complaints"),
				'export' => array('name' => "Export Campaign Complaints")
			)
		);
		self::RegisterAddonPermission($perms);
	}
    protected function GetApi($api = 'Fbl')
    {
        $api = (is_array($api)) ? $api[0] : $api;
        $path = $this->addon_base_directory . $this->addon_id . '/api/' . strtolower($api) . '.php';
        if (! is_file($path)) {
            return false;
        }
        require_once $path;
        $class = $api . '_API';
        $api = new $class();
        $api->template_system=$this->template_system;
        return $api;
    }
}
