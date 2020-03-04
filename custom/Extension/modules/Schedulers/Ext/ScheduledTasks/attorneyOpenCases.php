<?php

$job_strings[] = 'attorneyOpenCases';

function attorneyOpenCases(){
    require_once("custom/include/utils.php");
    require_once("custom/modules/Opportunities/metadata/listviewdefs.php");
    global $db, $mod_strings;
    $attorneyRoledUsers = getSpecificRoledUser('attorney');

    $sampleCaseBean = BeanFactory::newBean('Opportunities');
    $oppList = $listViewDefs["Opportunities"];
    $headArray = [];
    foreach( $oppList as $llKey => $llVal ){
        $field = strtolower($llKey);
        $fieldLabel = translate($llVal['label'], 'Opportunities');
        $headArray[] = $fieldLabel;
    }
    // below line is for testing only
    //$attorneyRoledUsers = ["59b089ae-777a-d7a1-58c9-5e099deb5a16" => "Farjad Ahmad"];
    
    foreach( $attorneyRoledUsers as $attorneyKey => $attorneyName ){
        $dataArray = [];
        $dataArray [] = $headArray;
        $dataExsists = false;
        $filename = 'open_cases_'.date("F").'.csv';
        $attorneyBean = BeanFactory::getBean('Users',$attorneyKey);
        $macro_nv = array();
        if (!$fp = fopen("upload://$filename", 'w+')) return FALSE;

        $query = "select id from opportunities where assigned_user_id = '$attorneyKey' and deleted = 0 and date_closed IS NULL";
        $res = $db->query($query);
        while ($casesSqlData = $db->fetchByAssoc($res) ){
            $caseId = $casesSqlData['id'];
            $casesBean = BeanFactory::getBean('Opportunities',$caseId);
            $dataExsists = true;
            $tempData = [];
            foreach( $oppList as $llKey => $llVal ){
                $field = strtolower($llKey);
                 $tempData[] = $casesBean->$field;
            }
            $dataArray [] = $tempData;
        }
        foreach ($dataArray as $line) fputcsv($fp, $line);

        // Place stream pointer at beginning
        rewind($fp);
        if($dataExsists){
            $emailTemplate = BeanFactory::newBean('EmailTemplates');
            $emailTemplate->retrieve_by_string_fields(['name' => "[NEW] Attorney Open Cases Scheduler"]);
            $emailTemplate->parsed_entities = null;
            $template_data = $emailTemplate->parse_email_template([
                "subject" => $emailTemplate->subject,
                "body_html" => $emailTemplate->body_html,
                "body" => $emailTemplate->body], 'Users', $attorneyBean, $macro_nv);
            $emailObj = new Email();
            $defaults = $emailObj->getSystemDefaultEmail();
            $mail = new SugarPHPMailer();
            $mail->setMailerForSystem();
            $mail->From = $defaults['email'];
            $mail->FromName = $defaults['name'];
            $mail->ContentType = "text/html";
            
            $mail->Subject = $template_data["subject"];
            $mail->Body = from_html($template_data["body_html"]);
            $mail->AddAddress($attorneyBean->email1);
            //testing line below
            //$mail->AddAddress("farjadahmad3@gmail.com"); 
            
            $mail->AddAttachment("upload/$filename", $filename, 'base64', "text/csv");
            $emailResult = @$mail->Send();
        
        }
        unlink("upload/$filename");
        return true;
    }
}

?>