<?php

class PluginContactprivate_HookContactprivate extends Hook
{

    /**
     * Register hooks
     */
    public function RegisterHook(){
        $this->AddHook('template_form_settings_profile_end', 'showContactPrivateSetting');
        $this->AddHook('settings_profile_save_before', 'saveContactPrivateSetting');        
    }

    public function showContactPrivateSetting($aParams) {            	
    	$sSetting = $this->PluginContactprivate_Contactprivate_Get($this->User_GetUserCurrent()->getId());
    	$this->Viewer_Assign('sUserContactPrivateSetting',$sSetting);
    	return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'contact_private_setting.tpl');    	    
    }

    public function saveContactPrivateSetting(){
    	$sValue= getRequest('contact_private_setting');
    	$this->PluginContactprivate_Contactprivate_Save($sValue,$this->User_GetUserCurrent()->getId());
    }
    
}
