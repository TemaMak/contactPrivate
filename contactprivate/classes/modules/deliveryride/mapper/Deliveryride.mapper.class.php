<?php

class PluginEvents_ModuleDeliveryride_MapperDeliveryride extends Mapper
{

	public function insert($oRide) {
		$sql = "INSERT INTO ".Config::Get('db.table.delivery_ride')." 
			(event_id,
			geo_data,
			user_id,
			time_start,			
			start_place,
			start_place_url,
			description,
			distance,
			level,
			speed		
			)
			VALUES(?d,  ?,	?d,	?,	?,  ?, ?, ?d, ?d, ?d)
		";
				
		if ($iId=$this->oDb->query(
				$sql,
				$oRide->getEventID(),
				$oRide->getGeoData(),
				$oRide->getUserId(),
				$oRide->getTimeStart(),
				$oRide->getStartPlace(),
				$oRide->getStartPlaceUrl(),
				$oRide->getDescription(),
				$oRide->getDistance(),
				$oRide->getLevel(),
				$oRide->getSpeed()
		))
		{								
			return $iId;
		}
		return false;
	}	

	public function update($oRide) {
			$sql =  "UPDATE  ".Config::Get('db.table.delivery_ride'). " 
				SET  time_start =?,			
					start_place =?,
					start_place_url =?,
					description =?,
					distance =?,
					speed =?
				WHERE id = ?d
			";
			return $this->oDb->query(
				$sql,
				$oRide->getTimeStart(),
				$oRide->getStartPlace(),
				$oRide->getStartPlaceUrl(),
				$oRide->getDescription(),
				$oRide->getDistance(),
				$oRide->getSpeed(),
				$oRide->getId()
			);		
			
	}
	
	public function GetDeliveryRideByFilter($aFilter,$aOrder){
	
		$where = "WHERE 1=1 ";
				
		if (!empty($aFilter['event_ids'])){
			if (is_array($aFilter['event_ids'])){
				$where .=
				" AND event_id IN (".implode(",",$aFilter['event_ids']).") ";
			} else{
				$where .=
				" AND event_id =".$aFilter['event_ids']." ";
			}
		}
			
		if (!empty($aFilter['user_ids'])){
			if (is_array($aFilter['user_ids'])){
				$where .=
				" AND user_id IN (".implode(",",$aFilter['user_ids']).") ";
			} else{
				$where .=
				" AND user_id =".$aFilter['user_ids']." ";
			}
		}		
		
		if (!empty($aFilter['geo_data'])){
			$where .=
			" AND geo_data ='".$aFilter['geo_data']."' ";			
		}
		
		$order = '';
			
		if (!empty($aOrder)){
			$order = 'ORDER BY ';
			$oderString=array();
			foreach($aOrder as $field => $direction){
				$oderString[] = $field.' '.$direction;
			}
			$order .= implode(',',$oderString);
		}
			
			
		$sql = "SELECT
					dr.*,
					es.name as speed_name
				FROM
					".Config::Get('db.table.delivery_ride')." dr
				LEFT JOIN ".Config::Get('db.table.events_speed')." AS es ON dr.speed=es.id						
					".$where."
				GROUP BY id
					".$order."
				";
			
		$aRides=array();
		if ($aRows=$this->oDb->select($sql)) {
			foreach ($aRows as $aRide) {
				$aRides[]=Engine::GetEntity('PluginEvents_Deliveryride_Deliveryride',$aRide);
			}
		}
		return $aRides;
	}
	
	public function delete($iRideId) {
		$sql = "DELETE FROM ".Config::Get('db.table.delivery_ride')." 
				WHERE id = ?d
		";
				
		if ($iId=$this->oDb->query(
				$sql,
				$iRideId
		))
		{								
			return $iId;
		}
		return false;
	}
	
}

?>
