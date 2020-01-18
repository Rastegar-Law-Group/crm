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
        && $bean->status != 'Approved'
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
        && $bean->status == 'SubmittedForApproval'
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
        && $bean->status == 'SubmittedForApproval'
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
    $leadBean = BeanFactory::getBean('Leads',$record);
    $leadBean->status = 'SubmittedForApproval';
    $attorneytargets = [];
    if( !empty($leadBean->attorneytargets) ){
        $attorneytargets = json_decode($leadBean->attorney_targets);
    }
    $attorneytargets[] = $attorneyId;
    $leadBean->attorney_targets = json_encode($attorneytargets);
    $leadBean->save();

    sendEmail(["name" => "[NEW] Attorney Approve Request","attorney" => $attorneyId,"lead" => $record]);
    return ['status' => 1]; 
}

function sendEmail($template){
    require_once("include/SugarPHPMailer.php");
    global $sugar_config;
    $macro_nv = array();
    $emailTemplate = BeanFactory::newBean('EmailTemplates');
    $emailTemplate->retrieve_by_string_fields(['name' => $template["name"]]);
    $emailTemplate->parsed_entities = null;
    $emailRecepients = "";
    $template_data = [];
    if( $template["name"] == "[NEW] Attorney Approve Request" ){
        $focus = BeanFactory::getBean('Leads',$template["lead"]);
        $template_data = $emailTemplate->parse_email_template([
            "subject" => $emailTemplate->subject,
            "body_html" => $emailTemplate->body_html,
            "body" => $emailTemplate->body], 'Leads', $focus, $macro_nv);

        $attorneyBean = BeanFactory::getBean('Users',$template["attorney"]);
        $rejectLink = "<a href = '".$sugar_config['site_url']."/index.php?entryPoint=rejectCaseConversion&record=".$focus->id."'>Deny Lead</a>";
        $approveLink = "<a href = '".$sugar_config['site_url']."/index.php?entryPoint=approveCaseConversion&record=".$focus->id."'>Approve Lead</a>";
        
        $template_data["body_html"] = str_replace("##attorney##",$attorneyBean->name,$template_data["body_html"]);
        $template_data["body_html"] = str_replace("##reject_link##",$rejectLink,$template_data["body_html"]);
        $template_data["body_html"] = str_replace("##approve_link##",$approveLink,$template_data["body_html"]);
        $emailRecepients = $attorneyBean->email1;
    }

    if( $template["name"] == "[NEW] Notify Farzad on New Case Creation" ){
        $focus = BeanFactory::getBean('Opportunities',$template["opportunity"],['disable_row_level_security' => true]);
        $template_data = $emailTemplate->parse_email_template([
            "subject" => $emailTemplate->subject,
            "body_html" => $emailTemplate->body_html,
            "body" => $emailTemplate->body], 'Opportunities', $focus, $macro_nv);
        $oppLink = "<a href = '".$sugar_config['site_url']."/index.php?module=Opportunities&action=DetailView&record=".$focus->id."'>Case Link</a>";
        $template_data["body_html"] = str_replace("##URL##",$oppLink,$template_data["body_html"]);
        $focusUser = BeanFactory::getBean('Users',$focus->assigned_user_id); 
        $template_data["body_html"] = str_replace("##assigned_user##",$focusUser->full_name,$template_data["body_html"]);
        $template_data["subject"] = str_replace("##assigned_user##",$focusUser->full_name,$template_data["subject"]);
        $focusUser = BeanFactory::getBean('Users',$focus->created_by); 
        $template_data["body_html"] = str_replace("##created_by##",$focusUser->full_name,$template_data["body_html"]);
        
        $farzandUser = BeanFactory::getBean('Users','5645287b-108f-ff0e-85a4-5cfb163f39fb');
        //$farjadUser = BeanFactory::getBean('Users','59b089ae-777a-d7a1-58c9-5e099deb5a16');
        $emailRecepients = $farjadUser->email1;
    }
    $emailObj = new Email();
    $defaults = $emailObj->getSystemDefaultEmail();

    $mail = new SugarPHPMailer();
    $mail->setMailerForSystem();
    $mail->From = $defaults['email'];
    $mail->FromName = $defaults['name'];
    $mail->ContentType = "text/html";
    
    $mail->Subject = $template_data["subject"];
    $mail->Body = from_html($template_data["body_html"]);
    $mail->AddAddress($emailRecepients);
    $emailResult = @$mail->Send();
}

function AttorneyApproveRejectRequest($record,$type){
    $leadBean = BeanFactory::getBean('Leads',$record);
    global $current_user;
    if( $leadBean->status == 'SubmittedForApproval' && $type == 'approve' ){
        $oppBean = BeanFactory::newBean('Opportunities');
        $oppBean->name = $leadBean->first_name ." ". $leadBean->last_name ." v. ".$leadBean->employer_name_c;   
        $oppBean->assigned_user_id = $current_user->id;
        $oppBean->save();
        $oppBean->created_by = $leadBean->assigned_user_id;
        $oppBean->save();
        $leadBean->attorney_id = $current_user->id;
        $leadBean->status = 'Approved';
        $leadBean->action_date = date('Y-m-d');
        $leadBean->converted = 1;
        $leadBean->opportunity_id = $oppBean->id;
        $leadBean->save();
        sendEmail(["name" => "[NEW] Notify Farzad on New Case Creation","opportunity" => $oppBean->id]);
        return [
            'status' => 1, 
            'message' => 'Lead has been approved', 
        ];
    }elseif( $leadBean->status == 'SubmittedForApproval' && $type == 'reject' ){
        $leadBean->attorney_id = $current_user->id;
        $leadBean->action_date = date('Y-m-d');
        $leadBean->status = 'Rejected';
        $leadBean->save();
        return [
            'status' => 1, 
            'message' => 'Lead has been rejected', 
        ];
    }elseif( $leadBean->status == 'Approved' ){
        return [
            'status' => -1, 
            'message' => 'Lead is already approved by attorney '.$leadBean->attorney_name, 
        ];
    }elseif( $leadBean->status == 'Rejected' ){
        return [
            'status' => -1, 
            'message' => 'Lead is already rejected by attorney '.$leadBean->attorney_name, 
        ];
    }else{
        return [
            'status' => -11, 
            'message' => 'This is an error!', 
        ];
    }
}

?>