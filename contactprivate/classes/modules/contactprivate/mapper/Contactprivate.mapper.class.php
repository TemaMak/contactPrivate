<?php

class PluginContactprivate_ModuleContactprivate_MapperContactprivate extends Mapper
{

	public function save($sValue,$iUserId) {
		$sql = "INSERT INTO ".Config::Get('plugin.contactprivate.db.table.user_private_setting')." 
				(
					user_id,
					contact_private_setting
				)
				VALUES(?d,?)
				ON DUPLICATE KEY UPDATE
					contact_private_setting =?
		";
				
		if ($iId=$this->oDb->query(
				$sql,
				$iUserId,
				$sValue,
				$sValue
		))
		{								
			return $iId;
		}
		return false;
	}	

	public function get($iUserId) {
		$sql = "SELECT 
					contact_private_setting	 
				FROM 
					".Config::Get('plugin.contactprivate.db.table.user_private_setting')." 
				WHERE	
					user_id =?d			
				";
		
		$sSetting = null;
		if ($aRows=$this->oDb->select($sql,$iUserId)) {
			foreach ($aRows as $aItem) {
				$sSetting = $aItem['contact_private_setting'];
			}
		}
		return $sSetting;				
	}
	

	
}

?>
