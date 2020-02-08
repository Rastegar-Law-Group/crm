<?php
class LeadsHook{
	/* 
	* Function: visitorAssignment
	* Description: Logic Hook, trigger on before save of Leads, and fill created by for empty createdby records 
	*/
	function visitorAssignment($bean, $event, $arguments){
        if(empty($bean->created_by)){
            $bean->created_by = '62b05615-3fa5-c430-f737-5e3ee881e0a1';
        }
    }
}
?>