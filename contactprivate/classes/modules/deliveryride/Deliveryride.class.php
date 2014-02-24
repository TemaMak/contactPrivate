<?php

class PluginEvents_ModuleDeliveryride extends Module {

	public function Init() {
		$this->oMapper=Engine::GetMapper(__CLASS__);
		$this->oUserCurrent=$this->User_GetUserCurrent();
	}	
	
	public function Save($oRide){
		if ($oRide->getId() > 0){
			//update
			return $this->oMapper->update($oRide);
		} else {
			//insert
			return $this->oMapper->insert($oRide);
		}
	}
	
	public function GetDeliveryRideForEvent($iEventId){
		$aFilter = array('event_ids' => $iEventId);
		return $this->oMapper->GetDeliveryRideByFilter($aFilter,null);
	}
		
	public function getGeoString($sGeoData){			
		list($iCountryId,$iCityId,$iCityRegionId) = explode(";",$sGeoData);
		
		$sGeoString = '';
		
		if ($iCityRegionId && $iCityRegionId != "0"){
			$oCityRegion = $this->PluginCityregion_Cityregion_getCityregionById($iCityRegionId);
			$sGeoString =  $oCityRegion->getName();
		}
			
		if ($iCityId && !$sGeoString && $iCityId != "0"){
			$oCity = $this->Geo_GetCityById($iCityId);
			$sGeoString = $oCity->getName();
		}
			
		if ($iCountryId && !$sGeoString && $iCountryId != "0"){
			$oCountry = $this->Geo_GetCountryById($iCountryId);
			$sGeoString = $oCountry->getName();
		}
							
		return $sGeoString;
	}	
	
	public function getUserDeliveryRideForEvent($iEventId,$iUserId){
		$aFilter = array(
			'event_ids' => $iEventId,
			'user_ids' => $iUserId
		);
		return $this->oMapper->GetDeliveryRideByFilter($aFilter,null);		
	}
	
	public function isAllowAdd($iEventId,$iUserId){
		$aCreatedDiliveryRides = $this->getUserDeliveryRideForEvent($iEventId,$iUserId);		
		if ($aCreatedDiliveryRides){
			return $this->Lang_Get('plugin.events.delivery_ride_alredy_exists_you');
		}
		$sGeoData = $this->PluginEvents_Events_getGeoId();
		
		$aFilter = array('event_ids' => $iEventId, 'geo_data' => $sGeoData);		
		$aCreatedDiliveryRides = $this->oMapper->GetDeliveryRideByFilter($aFilter,null);
		if ($aCreatedDiliveryRides){
			return $this->Lang_Get('plugin.events.delivery_ride_alredy_exists_geo');
		}
		
		list($iCountryId,$iCityId,$iCityRegionId) = explode(";",$sGeoData);
		
		if (!$iCityRegionId && $iCityId){
			$aData = $this->PluginCityregion_Cityregion_getListByCity($iCityId);
			if ($aData){
				return $this->Lang_Get('plugin.events.delivery_ride_alredy_not_all_geo');
			}
		}
		
		if (!$iCityId || !iCountryId){
			return $this->Lang_Get('plugin.events.delivery_ride_alredy_not_all_geo');
		}		
		
		if ($this->oUserCurrent->getRating() < 20){
			return $this->Lang_Get('plugin.events.delivery_ride_alredy_need_more_rating');
		}
	}
	
	public function Delete($oRide){
		return $this->oMapper->delete($oRide);
	}
		
	
}
?>
