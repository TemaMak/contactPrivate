<?php

class PluginContactprivate_ModuleUser extends PluginContactprivate_Inherit_ModuleUser
{

    /**
     * Vote for image
     * 
     * @param ModuleUser_EntityUser $oUser
     * @param PluginLsgallery_ModuleImage_EntityImage $oImage
     * @param int $iValue
     * @return int
     */
	public function getUserFieldsValues($iUserId, $bOnlyNoEmpty = true, $aType=array('')) {
    	$sSetting = $this->PluginContactprivate_Contactprivate_Get($iUserId);
    	$bShow = false;
    	
    	if ($this->oUserCurrent && $this->oUserCurrent->getId() == $iUserId){
    	$bShow = true;
    	} else {
    	    switch($sSetting){
	    		case "all":
	    			$bShow = true;
	    			break;
	    		case "registered":
	    			if ($this->oUserCurrent){
	    				$bShow = true;
	    			}    			
	    			break;   
	    		case "friends":
	    			if ($this->oUserCurrent){
		    			$data = $this->GetFriendsByArraySolid($iUserId,$this->oUserCurrent->getId());
		    			if ($data){
		    				$oFriend = reset($data);
		    				if ($oFriend->getStatusFrom() == self::USER_FRIEND_ACCEPT || $oFriend->getStatusFrom() == self::USER_FRIEND_OFFER){
		    					$bShow = true;
		    				}		    				
		    			}    	
	    			}		
	    			break;	    			 			
    		}    	
    	}
    	

    	if ($bShow){
    		return parent::getUserFieldsValues($iUserId, $bOnlyNoEmpty, $aType);
    	} else {
    		return null;
    	}
    	
    	
    }

}
