<?php
/*

 $LastChangedDate: 2012-07-22 22:14:15 -0400 (Sun, 22 Jul 2012) $
 $Rev: 1182 $
 $Author: maborak $
 $Id: mta.php 1182 2012-07-23 02:14:15Z maborak $
 
 +--------------------------------------------------------------------------------
 |   Multiple MTA Addon + Reputation/Blacklist IP Monitor
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
define("ADDON_MTA_DEFAULT_SMTP_PORT", 25);
require_once (dirname(__FILE__) . '/language/language.php');
error_reporting("E_ALL");
ini_set("display_errors", 1);

/**
 * Multiple MTA + Reputation / Blacklist IP Monitor
 *
 * @author              Wilmer Choque <maborak@maborak.com>
 * @since               August 21, 2009
 * @package             Addons_mta
 * @subpackage          API
 */
class Addons_mta extends Interspire_Addons
{
	public $addon_name="mta";
	public function Install()
	{
		$tables = $sequences = array();
	    if (! $this->isEnabled("installer"))
        {
            throw new Interspire_Addons_Exception(
            "The Addon (Advanced Addons Installer) is required", 
            Interspire_Addons_Exception::AddonDoesntExist);
        } else
        {
            $this->Process("installer", "GetApi", "installer")->install(
            $this->addon_name);
        }
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
		foreach ($queries_no_error as $query) {
			$qry = str_replace('%%TABLEPREFIX%%', $this->db->TablePrefix, $query);
			$result = $this->db->Query($qry);
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
	    if (! $this->isEnabled("installer"))
        {
            throw new Interspire_Addons_Exception(
            "The Addon (Advanced Addons Installer) is required", 
            Interspire_Addons_Exception::AddonDoesntExist);
        } else
        {
            $this->Process("installer", "GetApi", "installer")->uninstall(
            $this->addon_name);
        }
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
		//echo time();
	}
	public function Admin_Action_Ajax()
	{
		if ($_SERVER['REQUEST_METHOD']=="POST")
		{
			$action=$_POST['do'];
			switch ($action)
			{
				case "mta_stat":
					$mta=(int)((!empty($_POST['mta']))?$_POST['mta']:0);
					$api = $this->GetApi();
					$data=$api->mta_data_get_stats($mta,20,"daily","previous",time());
					echo json_encode($data);
					break;
				case "mta_test":
					$api = $this->GetApi();
					$mta = $api->mta_details_by_uid($_POST['uid']);
					if ($mta['exist'])
					{
						$result=$api->mta_test(array_merge($mta['data'],$_POST),$mta['data']['uid']);
						echo json_encode($result);
						//print_r($result);
					}
					else 
					{
						json_encode(array('msg'=>'mta not found'));
					}
					break;
				case "mta_modify":
					$api = $this->GetApi();
					$mta = $api->mta_details_by_uid($_POST['uid']);
					if ($mta['exist'])
					{
						$result=$api->mta_modify($_POST);
						echo json_encode(array("msg"=>($result)?"Saved":"Failed"));
						//print_r($result);
					}
					else 
					{
						json_encode(array('msg'=>'mta not found'));
					}
					break;
				default:
					echo json_encode(array("msg"=>"invalid request"));
					break;
			}
		}
		else 
		{
			$action=$_GET['do'];
			switch ($action)
			{
				case "mta_blacklist":
					$mta_uid=(int)((!empty($_GET['id']))?$_GET['id']:0);
					$api = $this->GetApi();
					$mta = $api->mta_details_by_uid($mta_uid);
					if ($mta['exist'])
					{
						$bl=$api->mta_data_get_blacklist($mta_uid,time(),"daily");
						$this->template_system->Assign('mta',$mta);
						$this->template_system->Assign('dnsbl',$bl);
						$this->template_system->ParseTemplate('mta_blacklist');
					}
					break;
				default:
					echo json_encode(array("msg"=>"invalid request"));
					break;
			}
		}
	}
	public function Admin_Action_Process()
	{
		if ($_SERVER['REQUEST_METHOD']=="POST")
		{
			$action=(!empty($_POST['do']))?$_POST['do']:"none";
			$data=(!empty($_POST['data']))?$_POST['data']:array();
			switch ($action)
			{
				case "group_assign_user":
					//print_r($_POST);
					$api=$this->GetApi();
					$id=(!empty($data['group_uid']))?$data['group_uid']:0;
					$f=$api->group_details($id,true);
					if ($f['exist']==false)
					{
						FlashMessage(GetLang("Addon_mta_grup_not_exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=manager");
					}
					else
					{
						//echo 4;
						$users=(empty($data['users']))?array():$data['users'];
						$api->group_assign_users($id,$users);
						FlashMessage(GetLang("Addon_mta_group_add_success"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=mta&Action=group&id={$id}");
					}
					break;
				default:
					break;
			}
		}
		else
		{
			$action=$_GET['do'];
		}
	}
	public function Admin_Action_Group()
	{
		$api=$this->GetApi();
		$id=(!empty($_GET['id']))?$_GET['id']:0;
		$f=$api->group_details($id,true);
		if ($id!=0 && $f['exist']==false)
		{
			FlashMessage(GetLang("Addon_mta_grup_not_exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=add_group");
		}
		//print_r($f);
		$mtas=$api->group_mtas($id,false,false,false,false,true);
		$usergroups=$api->get_users_groups();
		foreach ($usergroups as $k=>$v)
		{
			foreach ($v['users'] as $_k=>$_v)
			{
				$usergroups[$k]['users'][$_k]['mta_user_in_group']=(in_array($_v['userid'], $f['data']['users']))?1:0;
			}
		}
		//print_r($usergroups);
		//print_r($api->mta_data_get_daily(1,"send",time()));
		$mta_stats=array();
		foreach ($mtas as $k=>$v)
		{
			//$mta_stats[$v['uid']]=$api->mta_data_get_stats($v['uid'],15,"daily","previous",time());
		}
		//print_r($mta_stats);die;
		//die;
		//$mk1=mktime(14,11,10,2,5,2012);
		//echo $mk1.".- ".date("F j, Y, H:i:s A",$mk1)."<br>";
		//$mk2=mktime(02,11,10,2,5,2012);
		//echo $mk2.".- ".date("F j, Y, H:i:s A",$mk2)."<br>";
		//$this->db->StartTransaction();
		//$api->mta_add_data(2,66,"sent",time());
		//for ($i=0;$i<500;$i++)
		//{
			//$time=time()-(3600*$i*24);
			//$api->mta_add_data(2,rand(5, 10),"reputation",$time);
			//$api->mta_add_data(1,rand(5, 10),"reputation",$time);
			//echo $api->mta_data_get_hourly(1,"send",$time)."<br>";
		//}
		//$this->db->CommitTransaction();
		//die;
		//print_r($mtas);die;
		$gc=count($mtas);
		//print_r($f['data']);die;
		$this->template_system->Assign('group_users',$group_users);
		$this->template_system->Assign('mtas',$mtas);
		//$this->template_system->Assign('mta_stats',json_encode($mta_stats));
		$this->template_system->Assign('gcmtas',$gc);
		$this->template_system->Assign('usergroups',$usergroups);
		$this->template_system->Assign('group',$f['data']);
		$this->template_system->Assign('FlashMessages',GetFlashMessages(),false);
		$this->template_system->ParseTemplate('group');
	}
	public function Admin_Action_Export_Group()
	{
		$api=$this->GetApi();
		$id=(!empty($_GET['id']))?$_GET['id']:0;
		$f=$api->group_details($id,true);
		if ($id!=0 && $f['exist']==false)
		{
			FlashMessage(GetLang("Addon_mta_grup_not_exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=manager");
		}
		$mtas=$api->group_mtas($id);
		$this->template_system->Assign('mtas',$mtas);
		$this->template_system->Assign('groupid',$id);
		$this->template_system->ParseTemplate('group_export');
	}
	public function Admin_Action_Manager()
	{
		$api=$this->GetApi();
		$data=$api->group_info();
		$data_json=json_encode($data);
		//print_r($data_json);die;
		$this->template_system->Assign('groups',$data);
		$this->template_system->Assign('data_json',$data_json);
		$this->template_system->Assign('FlashMessages',GetFlashMessages(),false);
		$this->template_system->ParseTemplate('main');
	}
	public function Admin_Action_Delete_Group()
	{
		$db = IEM::getDatabase();
		$api=$this->GetApi();
		$id=(!empty($_GET['id']))?$_GET['id']:0;
		$f=$api->group_details($id,true);
		if ($id!=0 && $f['exist']==false)
		{
			FlashMessage(GetLang("Addon_mta_group_not_exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=Manager");
		}
		else
		{
			$api->group_delete($id);
			FlashMessage(GetLang("Addon_mta_group_deleted"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=mta&Action=Manager");
		}
	}
	public function Admin_Action_Add_Group()
	{
		$db = IEM::getDatabase();
		$api=$this->GetApi();
		if ($_SERVER['REQUEST_METHOD']=="POST")
		{
			if ($_POST['mta_group_do']=="update")
			{
				$api->group_update($_POST);
				$na=$this->db->NumAffected();
				FlashMessage(GetLang("Addon_mta_group_add_success"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=mta&Action=manager");
			}
			else 
			{
				$ng=$api->group_add($_POST);
				if ($ng)
				{
					FlashMessage(GetLang("Addon_mta_group_add_success"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=mta&Action=group&id=$ng");
				}
				else
				{
					FlashMessage(GetLang("Addon_mta_group_add_failed"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=manager");
				}
			}
		}
		else 
		{
			$id=(!empty($_GET['id']))?$_GET['id']:0;
			$f=$api->group_details($id,true);
			if ($id!=0 && $f['exist']==false)
			{
				FlashMessage(GetLang("Addon_mta_grup_not_exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=Manager");
			}
			$this->template_system->assign('do',($f['exist']==false)?"add":"update");
			$this->template_system->assign('value',$f['data']);
			$this->template_system->ParseTemplate('mta_add_group');
		}
	}
	public function Admin_Action_Add_Mta_Bulk()
	{
		if ($_SERVER['REQUEST_METHOD']=="POST")
		{
			if (!empty($_POST['bulk']) && isset($_POST['mta_group_uid']))
			{
				$group=(int)$_POST['mta_group_uid'];
				$data=trim($_POST['bulk']);
				$mtas=explode(PHP_EOL, $data);
				$api=$this->GetApi();
				foreach ($mtas as $k=>$v)
				{
					$mta=explode("|", trim($v));
					$mta_data=array(
						'hostname' => trim($mta[0]), 
						'username'=> trim($mta[1]),
						'password'=>trim($mta[2]),
						'port'=>(empty($mta['3']))?ADDON_MTA_DEFAULT_SMTP_PORT:$mta[3], 
						'name'=>(empty($mta['4']))?$mta[0]:$mta[4],
						'mail_from'=>$mta[5], 
						'mail_reply'=>$mta[6],
						'mail_bounce'=>$mta[7],
						'mail_test'=>$mta[8],
						'mta_group_uid'=>$group,
					);
					$result=$api->mta_add($mta_data);
				}
				FlashMessage(GetLang("Addon_mta_add_success"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=mta&Action=group&id=".$group);
			}
		}
	}
	public function Admin_Action_Delete_Mta()
	{
		$db = IEM::getDatabase();
		$api=$this->GetApi();
		$id=(!empty($_GET['id']))?$_GET['id']:0;
		$group_id=(!empty($_GET['group_id']))?$_GET['group_id']:0;
		$f=$api->mta_details_by_uid($id);
		if ($f['exist']==false)
		{
			FlashMessage(GetLang("Addon_mta_not_exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=group&id=".$group_id);
		}
		else
		{
			$api->mta_delete($id);
			FlashMessage(GetLang("Addon_mta_mta_deleted"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=mta&Action=group&id=".$group_id);
		}
	}
	public function Admin_Action_sending_errors()
	{
		$api=$this->GetApi();
		$jobid=(!empty($_GET['jobid']))?$_GET['jobid']:0;
		$sending_errors=$api->sending_errors($jobid);
		//print_r($sending_errors);
		//echo time();
		$this->template_system->assign('data',$sending_errors);
		//$this->template_system->Assign('FlashMessages',GetFlashMessages(),false);
		$this->template_system->ParseTemplate('sending_errors');
	}
	public function Admin_Action_Add_Mta()
	{
		$db = IEM::getDatabase();
		$api=$this->GetApi();
		$group_id=(!empty($_GET['group_id']))?$_GET['group_id']:0;
		$id=(!empty($_GET['id']))?$_GET['id']:0;
		$group=$api->group_details($group_id,true);
		//print_r($group);
		$f=$api->mta_details($group_id,$id,true);
		if ($id!=0 && $f['exist']==false)
		{
			FlashMessage(GetLang("Addon_mta_not_exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=group&id=".$group_id);
		}
		if ($_SERVER['REQUEST_METHOD']=="POST")
		{
			if (isset($_POST['test_smtp']))
			{
				if (isset($_POST['uid']))
				{
					$mta=(int)$_POST['uid'];
				}
				else 
				{
					$mta=false;
				}
				$result=$api->mta_test($_POST,$mta);
				FlashMessage($result['msg'],(!$result['success'])?SS_FLASH_MSG_ERROR:SS_FLASH_MSG_SUCCESS,null);
				$group['data']['mta_group_name']=($group['exist']==false)?GetLang("Addon_mta_nongrouped"):$group['data']['mta_group_name'];
				//print_r($group);
				$this->template_system->assign('do',($f['exist']==false)?"add":"update");
				$this->template_system->assign('group',$group['data']);
				$this->template_system->assign('value',$_POST);
				$this->template_system->Assign('FlashMessages',GetFlashMessages());
				$this->template_system->ParseTemplate('mta_add_mta');
			}
			elseif ($_POST['mta_do']=="update")
			{
				$result=$api->mta_update($_POST);
				if ($result)
				{
					FlashMessage(GetLang("Addon_mta_add_success"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=mta&Action=group&id=".$group_id);
				}
				else
				{
					FlashMessage(GetLang("Addon_mta_add_failed"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=group&id=".$group_id);
				}
			}
			else 
			{
				if ($api->mta_add($_POST))
				{
					FlashMessage(GetLang("Addon_mta_add_success"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=mta&Action=group&id=".$group_id);
				}
				else
				{
					FlashMessage(GetLang("Addon_mta_add_failed"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=mta&Action=group&id=".$group_id);
				}
			}
		}
		else 
		{
			$group['data']['mta_group_name']=($group['exist']==false)?GetLang("Addon_mta_nongrouped"):$group['data']['mta_group_name'];
			$this->template_system->assign('do',($f['exist']==false)?"add":"update");
			$this->template_system->assign('group',$group['data']);
			$this->template_system->assign('value',$f['data']);
			$this->template_system->Assign('FlashMessages',GetFlashMessages(),false);
			$this->template_system->ParseTemplate('mta_add_mta');
		}
	}
	function GetEventListeners()
	{
		$my_file = '{%IEM_ADDONS_PATH%}/mta/mta.php';
		$listeners = array();

		$listeners[] =
			array (
				'eventname' => 'IEM_SENDSTUDIOFUNCTIONS_GENERATEMENULINKS',
				'trigger_details' => array (
					'Addons_mta',
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
	
	/**
	 * SetMenuItems
	 * Adds itself to the navigation menu(s).
	 *
	 * If the user has access to "send email campaigns" in the email campaigns menu,
	 * it tries to put "View Split Tests" under that.
	 * If they don't have access to that, then "View Split Tests" goes at the bottom of the email campaigns menu.
	 *
	 * If the user has access to "email campaign stats" in the stats menu,
	 * it tries to put "Split Test Stats" under that.
	 * If they don't, then it goes at the bottom of the stats menu.
	 *
	 * @param EventData_IEM_SENDSTUDIOFUNCTIONS_GENERATEMENULINKS $data The current menu.
	 *
	 * @return Void The current menu is passed in by reference, no need to return anything.
	 *
	 * @uses EventData_IEM_SENDSTUDIOFUNCTIONS_GENERATEMENULINKS
	 */
	static function SetMenuItems(EventData_IEM_SENDSTUDIOFUNCTIONS_GENERATEMENULINKS $data)
	{
		$user = &GetUser();
		$self = new self;
		$menuItems = $data->data;
		$menuItems['newsletter_button'][]=array (
					'text' => "MTA: Manager",
					'link' => $self->admin_url . '&Action=Manager',
					'image' => '../addons/splittest/images/m_splittests.gif',
					'show' => $user->isAdmin(),
					'description' => GetLang('Addon_splittest_Menu_ViewSplitTests_Description'),
		);
		$data->data = $menuItems;
	}

	/**
	 * RegisterAddonPermissions
	 * Registers permissions for this addon to create.
	 * This allows an admin user to finely control which parts of split tests a user can access.
	 *
	 * Creates the following permissions:
	 * - create
	 * - edit
	 * - delete
	 * - send
	 * - stats
	 *
	 * @uses RegisterAddonPermission
	 */
	static function RegisterAddonPermissions()
	{
		$description = self::LoadDescription('mta');
		$perms = array (
			'mta' => array (
				'addon_description' => "MT: Multiple MTA - Addon",
				'sending_errors' => array('name' => "Display sending errors")
			),
		);
		self::RegisterAddonPermission($perms);
	}
    protected function GetApi ($api = 'Mta')
    {
        $api = (is_array($api)) ? $api[0] : $api;
        $path = $this->addon_base_directory . $this->addon_id . '/api/' .
         strtolower($api) . '.php';
        if (! is_file($path))
        {
            return false;
        }
        require_once $path;
        $class = $api . '_API';
        $api = new $class();
        $api->template_system = $this->template_system;
        return $api;
    }
}
