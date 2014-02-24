<?php

class PluginContactprivate_HookContactprivate extends Hook
{

    /**
     * Register hooks
     */
    public function RegisterHook()
    {
        $this->AddHook('template_form_settings_profile_end', 'showContactPrivateSetting');
    }

    public function showContactPrivateSetting($aParams)
    {        
    	$oTopic = $aParams['oTopic'];
    	
    	//$this->Viewer_Assign('aSubscribeUsers',$aSubscribeUsers);
    	//$this->Viewer_Assign('iSubscribeCount',count($aSubscribeUsers));
    	//$this->Viewer_Assign('iElseCount',$result['else_count']);
    	//$this->Viewer_Assign('iSelf',$result['self']);
    	//$aParams['iSelf'] = $result['self'];
    	return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'contact_private_setting.tpl');    	
    	
    	return 'hello';
    }

}
