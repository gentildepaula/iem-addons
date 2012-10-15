<?php
if (! class_exists('Interspire_Addons', false)) {
    require_once (dirname(dirname(__FILE__)) . '/interspire_addons.php');
}
require_once (dirname(__FILE__) . '/language/language.php');
class Addons_spins extends Interspire_Addons
{
    private $addon_name = "spins";
    public function Install ()
    {
        $tables = $sequences = array();
        if (! $this->isEnabled("installer")) {
            throw new Interspire_Addons_Exception("The Addon (Advanced Addons Installer) is required", Interspire_Addons_Exception::AddonDoesntExist);
        } else {
            $this->Process("installer", "GetApi", "installer")->install($this->addon_name);
        }
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
        } catch (Interspire_Addons_Exception $e) {
            $this->db->RollbackTransaction();
            throw new Exception("Unable to install addon {$this->GetId()} " . $e->getMessage());
        }
        $this->db->CommitTransaction();
        return true;
    }
    public function UnInstall ()
    {
        $tables = $sequences = array();
        if (! $this->isEnabled("installer")) {
            throw new Interspire_Addons_Exception("The Addon (Advanced Addons Installer) is required", Interspire_Addons_Exception::AddonDoesntExist);
        } else {
            $this->Process("installer", "GetApi", "installer")->uninstall($this->addon_name);
        }
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
    public function Enable ()
    {
        //$this->db->Query("INSERT INTO [|PREFIX|]settings_cron_schedule(jobtype, lastrun) VALUES ('" . $this->db->Quote($this->addon_id) . "', 0)");
        try {
            $status = parent::Enable();
        } catch (Interspire_Addons_Exception $e) {
            throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
        }
        return true;
    }
    public function Disable ()
    {
        //$job_check = "SELECT COUNT(jobid) AS jobcount FROM [|PREFIX|]jobs WHERE jobtype='splittest' AND jobstatus NOT IN ('c')";
        try {
            $status = parent::Disable();
        } catch (Interspire_Addons_Exception $e) {
            throw new Interspire_Addons_Exception($e->getMessage(), $e->getCode());
        }
        return true;
    }
    public function Admin_Action_Default ()
    {
    	$db = IEM::getDatabase();
		$api=$this->GetApi();
		//$api->get_random_url();
		$r=$api->url_details();
		//($r);die;
		$this->template_system->Assign('FlashMessages',GetFlashMessages(),false);
		$this->template_system->assign('result',$r);
        $this->template_system->ParseTemplate('main');
    }
	public function Admin_Action_Addurl()
	{
		$db = IEM::getDatabase();
		$api=$this->GetApi();
		if ($_SERVER['REQUEST_METHOD']=="POST")
		{
			if ($_POST['spins_do']=="update")
			{
				$api->url_update($_POST);
				$na=$this->db->NumAffected();
				FlashMessage(GetLang("Addon_spins_urlupdated"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=spins");
			}
			else 
			{
				if ($api->url_add($_POST))
				{
					FlashMessage(GetLang("Addon_spins_urladded"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=spins");
				}
				else
				{
					FlashMessage(GetLang("Addon_spins_urladdedfailed"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=spins");
				}
			}
		}
		else 
		{
			$id=(!empty($_GET['id']))?$_GET['id']:0;
			$f=$api->url_details($id);
			if ($id!=0 && $f['exist']==false)
			{
				FlashMessage(GetLang("Addon_spins_urlnotfound"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=spins");
			}
			$this->template_system->assign('do',($f['exist']==false)?"add":"update");
			$this->template_system->assign('value',$f['data']);
			$this->template_system->ParseTemplate('url_add');
		}
	}
	public function Admin_Action_Editurl()
	{
		$this->Admin_Action_Addurl();
	}
	public function Admin_Action_Deleteurl()
	{
		$db = IEM::getDatabase();
		$api=$this->GetApi();
		$id=(!empty($_GET['id']))?$_GET['id']:0;
		$f=$api->url_details($id);
		if ($id!=0 && $f['exist']==false)
		{
			FlashMessage(GetLang("Addon_spins_urlnotfound"),SS_FLASH_MSG_ERROR,"index.php?Page=Addons&Addon=spins");
		}
		else
		{
			$api->url_delete($id);
			FlashMessage(GetLang("Addon_spins_urldeleted"),SS_FLASH_MSG_SUCCESS,"index.php?Page=Addons&Addon=spins");
		}
	}
    function GetEventListeners ()
    {
        $my_file = "{%IEM_ADDONS_PATH%}/{$this->addon_name}/{$this->addon_name}.php";
        $listeners = array();
        $listeners[] = array(
        	'eventname' => 'IEM_SENDSTUDIOFUNCTIONS_GENERATEMENULINKS' , 
        	'trigger_details' => array(
        		'Addons_spins' , 
        		'SetMenuItems') , 
        	'trigger_file' => $my_file);
        $listeners[] = array('eventname' => 'IEM_USERAPI_GETPERMISSIONTYPES' , 'trigger_details' => array('Interspire_Addons' , 'GetAddonPermissions') , 'trigger_file' => $my_file);
       	return $listeners;
    }
    static function SetMenuItems (EventData_IEM_SENDSTUDIOFUNCTIONS_GENERATEMENULINKS $data)
    {
        $user = &GetUser();
        $self = new self();
        $menuItems = $data->data;
        //$menuItems['tools'][] = array('text' => GetLang('Addon_spins_url_rotator') , 'link' => 'index.php?Page=Addons&Addon=spins' , 'show' => $user->isAdmin() , 'description' => '' , 'image' => 'templates_view.gif');
        $menuItems['newsletter_button'][]=array (
					'text' => GetLang('Addon_spins_url_rotator'),
					'link' => $self->admin_url . '',
					'image' => 'triggeremails_view.gif',
					'show' => $user->isAdmin(),
					'description' => GetLang('Addon_spins_url_rotator_description'),
		);
        $data->data = $menuItems;
    }
    static function RegisterAddonPermissions ()
    {/*$description = self::LoadDescription('mta');
		$perms = array (
			'mta' => array (
				'addon_description' => GetLang('Addon_Mta_Header'),
				'manage' => array('name' => "Manage Mta Groups")
			),
		);
		self::RegisterAddonPermission($perms);*/
	}
    protected function GetApi ($api = 'spins')
    {
        $api = (is_array($api)) ? $api[0] : $api;
        $path = $this->addon_base_directory . $this->addon_id . '/api/' . strtolower($api) . '.php';
        if (! is_file($path)) {
            return false;
        }
        require_once $path;
        $api = Spins_API::Singleton();
        $api->template_system = $this->template_system;
        return $api;
    }
}
