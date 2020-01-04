<?php

require_once('modules/ACLRoles/ACLRole.php');

/*
    * function: getSpecificRoledUser
    * params: name of role
    * return: list of all activated users related to this role
    * author: Farjad Ahmad - (farjadahmad3@gmail.com)
    * date: 01-Jan-2020
*/
function getSpecificRoledUser($role){
    $dataArray = [];
    $roleBean = BeanFactory::newBean('ACLRoles');
    $roleBean->retrieve_by_string_fields(['name' => $role]);
    if( !empty($roleBean->id) ){
        $roleBean->load_relationship('users');
        $users = $roleBean->users->getBeans();
        foreach( $users as $user ){
            $dataArray[$user->id] = $user->full_name;
        }   
    }
    return $dataArray;
}

/*
    * function: addRequestAtttorneyApprovalButton
    * params: Lead bean
    * return: button or null, as action on detailView. 
    * author: Farjad Ahmad - (farjadahmad3@gmail.com)
    * date: 01-Jan-2020
*/
function addRequestAtttorneyApprovalButton($bean){
    global $current_user;
    $button = '';
    $intakeRoledUsers = getSpecificRoledUser('Intake');
    if( $bean->assigned_user_id == $current_user->id 
        && array_key_exists( $current_user->id , $intakeRoledUsers) 
        && $bean->status != 'Accepted'
    ){
        $button = '<input title="Request for Attorney Approval on Conversion" class="button" onclick="requestAtttorneyApprovalPopup()" name="request_atttorney_approval_btn" id="request_atttorney_approval_btn" value="Request for Attorney Approval on Conversion" type="button">';
    }
    return $button;
}

/*
    * function: addApproveCaseConversionButton
    * params: Lead bean
    * return: button or null, as action on detailView. 
    * author: Farjad Ahmad - (farjadahmad3@gmail.com)
    * date: 01-Jan-2020
*/
function addApproveCaseConversionButton($bean){
    global $current_user;
    $button = '';
    $attorneyRoledUsers = getSpecificRoledUser('attorney');
    $attorneytargets = json_decode(html_entity_decode($bean->attorney_targets));
    if( array_key_exists( $current_user->id , $attorneyRoledUsers )
        && in_array( $current_user->id , $attorneytargets )
        && $bean->status != 'Accepted'
        && $bean->status != 'Rejected'
    ){
        $button = '<input title="Approve Case Conversion" class="button" onclick="approveCaseConversion()" name="approve_case_conversion_btn" id="approve_case_conversion_btn" value="Approve Case Conversion" type="button">';
    }
    return $button;
}

/*
    * function: addRejectCaseConversionButton
    * params: Lead bean
    * return: button or null, as action on detailView. 
    * author: Farjad Ahmad - (farjadahmad3@gmail.com)
    * date: 01-Jan-2020
*/
function addRejectCaseConversionButton($bean){
    global $current_user;
    $button = '';
    $attorneyRoledUsers = getSpecificRoledUser('attorney');
    $attorneytargets = json_decode(html_entity_decode($bean->attorney_targets));
    if( array_key_exists( $current_user->id , $attorneyRoledUsers )
        && in_array( $current_user->id , $attorneytargets )
        && $bean->status != 'Accepted'
        && $bean->status != 'Rejected'
    ){
        $button = '<input title="Reject Case Conversion" class="button" onclick="rejectCaseConversion()" name="reject_case_conversion_btn" id="reject_case_conversion_btn" value="Reject Case Conversion" type="button">';
    }
    return $button;
}

/*
    * function: submitAttorneyApproveRequest
    * params: Lead Id, Selected Attorney roled user Id
    * return:  
    * author: Farjad Ahmad - (farjadahmad3@gmail.com)
    * date: 02-Jan-2020
*/
function submitAttorneyApproveRequest($record,$attorneyId){
    $GLOBALS['log']->fatal("submitAttorneyApproveRequest");
    $GLOBALS['log']->fatal(print_r(["record" => $record, "attorney" => $attorneyId],true));
    
    $leadBean = BeanFactory::getBean('Leads',$record);
    $leadBean->status = 'SubmittedForApproval';
    $attorneytargets = [];
    if( !empty($leadBean->attorneytargets) ){
        $attorneytargets = json_decode($leadBean->attorney_targets);
    }
    $attorneytargets[] = $attorneyId;
    $leadBean->attorney_targets = json_encode($attorneytargets);
    $leadBean->save();

    // Send Email Here
    return ['status' => 1]; 
}


?>