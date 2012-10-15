<?php
/*
+--------------------------------------------------------------------------
|   Social Network
|   ========================================
|   Copyright Maborak Technologies 2006-2010. All rights reserved.
|   ========================================
|   Web: http://www.maborak.com
|   Email: sales (at) maborak (dot) com
|	License Type: Social Network is NOT Open Source Software and Limitations Apply 
+---------------------------------------------------------------------------
*/
/**
 * Social Network
 *
 * @package Interspire_Addons
 * @subpackage Addons_splittest
 */
/**
 * Make sure the base Interspire_Addons class is defined.
 */
if (! class_exists('Interspire_Addons', false)) {
    require_once (dirname(dirname(__FILE__)) . '/interspire_addons.php');
}
require_once (dirname(__FILE__) . '/language/language.php');
/**
 * This class handles most things for split testing
 * including extra user permissions, menu items (under 'email campaigns' and also in 'stats')
 * and of course processing everything.
 *
 * If you go into a particular area (eg 'sending' a split test campaign), then extra files are included.
 * This helps keep memory usage and processing time to a reasonable limit.
 *
 * @uses Interspire_Addons
 * @uses Interspire_Addons_Exception
 * @uses Addons_splittest_Send
 */
class Addons_social extends Interspire_Addons
{
    private $addon_name = "social";
    public function Install()
    {
        $tables = $sequences = array();
        if (!$this->isEnabled("installer")){throw new Interspire_Addons_Exception("The Addon (Advanced Addons Installer) is required", Interspire_Addons_Exception::AddonDoesntExist);}else{$this->Process("installer", "GetApi", "installer")->install($this->addon_name);}
        $this->db->StartTransaction();
        require dirname(__FILE__) . '/schema.' . SENDSTUDIO_DATABASE_TYPE . '.php';
        foreach ($queries as $query) {
            $qry = str_replace('%%TABLEPREFIX%%', $this->db->TablePrefix, $query);
            $result = $this->db->Query($qry);
            if (! $result) {
                $this->db->RollbackTransaction();
                throw new Interspire_Addons_Exception("There was a problem running query " . $qry . ": " . $this->db->GetErrorMsg(), Interspire_Addons_Exception::DatabaseError);
            }
        }
        $this->enabled = true;
        $this->configured = true;
        try {
            $status = parent::Install();
        }
        catch (Interspire_Addons_Exception $e) {
            $this->db->RollbackTransaction();
            throw new Exception("Unable to install addon {$this->GetId()} " . $e->getMessage());
        }
        $this->db->CommitTransaction();
        $result = $this->db->Query("SELECT share FROM " . SENDSTUDIO_TABLEPREFIX . "stats_emailopens LIMIT 1");
        if (! $result) {
            $result = $this->db->Query("ALTER TABLE `" . SENDSTUDIO_TABLEPREFIX . "stats_emailopens` ADD `share` VARCHAR( 255 ) NOT NULL DEFAULT 'n'");
        }
        $result = $this->db->Query("SELECT share FROM " . SENDSTUDIO_TABLEPREFIX . "users LIMIT 1");
        if (! $result) {
            $result = $this->db->Query("ALTER TABLE `" . SENDSTUDIO_TABLEPREFIX . "users` ADD `share` INT NOT NULL DEFAULT '0'");
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
        }
        catch (Interspire_Addons_Exception $e) {
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
        }
        catch (Interspire_Addons_Exception $e) {
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
        }
        catch (Interspire_Addons_Exception $e) {
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
        }
        catch (Interspire_Addons_Exception $e) {
            throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
        }
        return true;
    }
    public function Admin_Action_Default()
    {
        $db = IEM::getDatabase();
    }
    public function Admin_Action_Manage()
    {
    	$api = $this->GetApi();
        $query = "SELECT * FROM " . SENDSTUDIO_TABLEPREFIX . "share";
        $ssf = new SendStudio_Functions ( );
		$result = $this->db->Query($query);
		$r=array();
		while ($row = $this->db->Fetch($result)) {
		    $query = "SELECT COUNT(*) as total FROM " . SENDSTUDIO_TABLEPREFIX . "users WHERE share={$row['uid']}";
		    $rc = $this->db->Query($query);
		    $ut=$this->db->Fetch($rc);
		    $row['users']=$ut['total'];
			$r[]=$row;
		}
        $query = "SELECT * FROM " . SENDSTUDIO_TABLEPREFIX . "users";
		$result = $this->db->Query($query);
		$users=array();
		while ($row = $this->db->Fetch($result)) {
			$users[]=$row;
		}
		$this->template_system->Assign('shares',$r,false);
		$this->template_system->Assign('users',$users,false);
		$this->template_system->Assign('FlashMessages',GetFlashMessages(),false);
		$this->template_system->Assign('new_share',$ssf->GetHTMLEditor ( '', false, 'share', 'exact', 250, "99%" ));
		$this->template_system->ParseTemplate('manage');
    }
    public function Admin_Action_Show()
    {
        $emails = array();
        $statid = $this->db->Quote(@$_GET['statid']);
        $rst = @$_GET['rst'];
        $share = $this->db->Quote($rst);
        $last = $this->db->Query("SELECT l.emailaddress, FROM_UNIXTIME(o.opentime,'%d %M, %h:%i:%s %Y') as date FROM " . SENDSTUDIO_TABLEPREFIX . "list_subscribers l, " . SENDSTUDIO_TABLEPREFIX . "stats_emailopens o WHERE l.subscriberid=o.subscriberid AND o.statid IN({$statid}) AND o.share='{$share}' LIMIT 1000");
        while ($row = $this->db->Fetch($last)) {
            $emails[] = $row;
        }
        $this->template_system->assign('title_show', sprintf(GetLang('Addon_social_show_title'), $this->GetApi()->rs[$rst]));
        $this->template_system->assign('emails', $emails);
        $this->template_system->ParseTemplate('show');
    }
    public function Admin_Action_Edit()
    {
        $ssf = new SendStudio_Functions ( );
        if ($_SERVER['REQUEST_METHOD']=="POST")
        {
            $id=isset($_POST['share_id'])?$_POST['share_id']:0;
            if ($id==0)
            {
		        $name=isset($_POST['share_name'])?$_POST['share_name']:rand();
		        $html=isset($_POST['share_html'])?$_POST['share_html']:rand();
		        $users=isset($_POST['share_users'])?$_POST['share_users']:array();
		        $users=is_array($users)?$users:array();
		        $result = $this->db->InsertQuery ( "share", array ('name' => $name, 'html' => $html ) );
		        $lid=$this->db->LastId();
		        foreach ($users as $k=>$v)
		        {
		            $result = $this->db->UpdateQuery ( "users", array ('share' => $lid ),"`userid`=" . $this->db->Quote($v) );
		        }
		        FlashMessage(GetLang("Addon_social_template_added_ok"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=social&Action=manage");
            }
            else
            {
                $name=isset($_POST['share_name'])?$_POST['share_name']:rand();
		        $html=isset($_POST['share_html'])?$_POST['share_html']:'';
		        $users=isset($_POST['share_users'])?$_POST['share_users']:array();
		        $lid=$id;
		        $result = $this->db->UpdateQuery ( "users", array ('share' => 0 ),"`share`=" . $this->db->Quote($lid) );
		        $users=is_array($users)?$users:array();
                foreach ($users as $k=>$v)
		        {
		            $result = $this->db->UpdateQuery ( "users", array ('share' => $lid ),"`userid`=" . $this->db->Quote($v) );
		        }
		        $result = $this->db->UpdateQuery ( "share", array ('name' => $name, 'html' => $html ),"`uid`=" . $this->db->Quote($id) );
		        FlashMessage(GetLang("Addon_social_template_updated_ok"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=social&Action=manage");
            }
        }
        else
        {
            $uid=isset($_GET['id'])?$_GET['id']:0;
            $uid=$this->db->Quote($uid);
            $last = $this->db->Query("SELECT * FROM " . SENDSTUDIO_TABLEPREFIX . "share WHERE uid={$uid} LIMIT 1");
            $share = $this->db->Fetch($last);
            if ($share)
            {
                $query = "SELECT * FROM " . SENDSTUDIO_TABLEPREFIX . "users";
        		$result = $this->db->Query($query);
        		$users=array();
        		while ($row = $this->db->Fetch($result)) {
        			$users[]=$row;
        		}
        		$this->template_system->Assign('shares',$r,false);
        		$this->template_system->Assign('users',$users,false);
                $this->template_system->assign('name',$share['name']);
                $this->template_system->assign('uid',$share['uid']);
                $this->template_system->assign('html',$ssf->GetHTMLEditor ( $share['html'], false, 'share', 'exact', 250, "99%" ));
                $this->template_system->ParseTemplate('edit');
            }
            else
            {
                FlashMessage(GetLang("Addon_social_error_template"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=social&Action=manage");
            }
        }
        //FlashMessage(GetLang("Addon_fbl_Not_Exist"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=social&Action=manage");
    }
    public function Admin_Action_Delete()
    {
            $uid=isset($_GET['id'])?$_GET['id']:0;
            $last = $this->db->Query("SELECT * FROM " . SENDSTUDIO_TABLEPREFIX . "share WHERE uid=".$this->db->Quote($uid)." LIMIT 1");
            $share = $this->db->Fetch($last);
            if ($share)
            {
                $r=$this->db->DeleteQuery ( "share", "WHERE `uid`=" . $this->db->Quote($uid), 1 );
                $result = $this->db->UpdateQuery ( "users", array ('share' => 0 ),"`share`=" . $this->db->Quote($uid) );
                FlashMessage(GetLang("Addon_social_deleted_ok"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=social&Action=manage");
            }
            else
            {
                FlashMessage(GetLang("Addon_social_error_template"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=social&Action=manage");
            }
    }
    function GetEventListeners()
    {
        $my_file = "{%IEM_ADDONS_PATH%}/{$this->addon_name}/{$this->addon_name}.php";
        //$my_file = "{%IEM_ADDONS_PATH%}/social/social.php";
		$listeners = array();

		$listeners[] =
			array (
				'eventname' => 'IEM_SENDSTUDIOFUNCTIONS_GENERATETEXTMENULINKS',
				'trigger_details' => array (
					'Addons_social',
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
	static function SetMenuItems(EventData_IEM_SENDSTUDIOFUNCTIONS_GENERATETEXTMENULINKS $data)
	{
		$user = &GetUser();
		$self = new self;
		$menuItems = $data->data;
		$menuItems['templates'][]=array (
				'text' => GetLang('Addon_social_social_network'),
				'link' => 'index.php?Page=Addons&Addon=social&Action=manage',
				'show' => $user->isAdmin(),
				'description' => '',
				'image' => 'templates_view.gif',
		);
		$data->data = $menuItems;
	}
    static function RegisterAddonPermissions()
    { /*$description = self::LoadDescription('mta');
		$perms = array (
			'mta' => array (
				'addon_description' => GetLang('Addon_Mta_Header'),
				'manage' => array('name' => "Manage Mta Groups")
			),
		);
		self::RegisterAddonPermission($perms);*/
    }
    protected function GetApi($api = 'Social')
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
