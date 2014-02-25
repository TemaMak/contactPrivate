<?php

class PluginContactprivate_ModuleContactprivate extends Module {

	public function Init() {
		$this->oMapper=Engine::GetMapper(__CLASS__);
		$this->oUserCurrent=$this->User_GetUserCurrent();
	}	
	
	public function Save($sValue,$iUserId){		
		return $this->oMapper->save($sValue,$iUserId);
	}
	
	public function Get($iUserId){
		$sSetting = $this->oMapper->get($iUserId);
		if (!$sSetting){
			$sSetting = Config::Get('plugin.contactprivate.default');
		}
		
		return $sSetting;
	}

}
?>
