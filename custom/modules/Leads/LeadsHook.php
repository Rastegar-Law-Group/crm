<?php
class LeadsHook{
	/* 
	* Function: visitorAssignment
	* Description: Logic Hook, trigger on before save of Leads, and fill created by for empty createdby records 
	*/
	function visitorAssignment($bean, $event, $arguments){
        if(empty($bean->created_by)){
            $bean->created_by = '238ae03a-778d-9c28-5265-5e3ee4b14168';
        }
    }
}
?>