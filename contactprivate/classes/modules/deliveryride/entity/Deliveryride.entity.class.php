<?php

class PluginEvents_ModuleDeliveryride_EntityDeliveryride extends Entity
{
	public function getTimeFormat(){
		list($h,$m,$i) = explode(":",$this->_aData['time_start']);
		return $h.":".$m;
	}
	
	public function getUser(){
		if (!isset($this->_aData['user'])){
			$this->_aData['user'] = $this->User_GetUserById($this->_aData['user_id']);
		}
		
		return $this->_aData['user'];
	}
	
	public function getGeoName(){
		if (!isset($this->_aData['geo_name'])){
			$this->_aData['geo_name']= $this->PluginEvents_Deliveryride_getGeoString($this->_aData['geo_data']);
		}
		
		return $this->_aData['geo_name'];		
	}
}

?>
