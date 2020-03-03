<?php
    global $current_user, $sugar_config;
    require_once("custom/modules/Opportunities/metadata/listviewdefs.php");
    
    $response = [
        'message' => 'Not Authorized!',
        'status' => -1,
    ];

    if( $current_user->id == $sugar_config['super_attorney'] ){
        if( isset($_REQUEST['attorney']) && $_REQUEST['record'] ){
            $attorneyId = $_REQUEST['attorney'];
            $case = $_REQUEST['record'];
            $attorneyBean = BeanFactory::getBean('Users',$attorneyId);
            $caseBean = BeanFactory::getBean("Opportunities",$case);
            global $db;
            if( $caseBean->id && $attorneyBean->id ){
                $caseBean->assigned_user_id = $attorneyId;
                if( $caseBean->save() ){
                    $response = [
                        "message" => "Primary attorney [".$attorneyBean->full_name ."] has been set to case <a href = '".$sugar_config['site_url']."/index.php?module=Opportunities&action=DetailView&record=".$caseBean->id."'><strong>".$caseBean->name."</strong></a>",
                        "status" => 1,
                    ];

                    $dataArray = [];
                    $oppList = $listViewDefs["Opportunities"];
                    $headArray = [];
                    foreach( $oppList as $llKey => $llVal ){
                        $field = strtolower($llKey);
                        $fieldLabel = translate($llVal['label'], 'Opportunities');
                        $headArray[] = $fieldLabel;
                    }
                    $dataArray[] = $headArray;
                    $filename = $attorneyBean->last_name.'open_cases_'.date('d-F-Y').'.csv';
                    $macro_nv = array();
                    if (!$fp = fopen("upload://$filename", 'w+')){
                        $GLOBALS['log']->fatal("failed because of permissions");
                        return FALSE;
                    } 


                    $query = "select id from opportunities where assigned_user_id = '$attorneyId' and deleted = 0 and date_closed IS NULL";
                    $res = $db->query($query);
                    while ($casesSqlData = $db->fetchByAssoc($res) ){
                        $caseId = $casesSqlData['id'];
                        $casesBean = BeanFactory::getBean('Opportunities',$caseId);
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

                    $emailTemplate = BeanFactory::newBean('EmailTemplates');
                    $emailTemplate->retrieve_by_string_fields(['name' => "[NEW] Attorney Case Assigned by Farzad"]);
                    $emailTemplate->parsed_entities = null;
                    $template_data = $emailTemplate->parse_email_template([
                        "subject" => $emailTemplate->subject,
                        "body_html" => $emailTemplate->body_html,
                        "body" => $emailTemplate->body], 'Opportunities', $caseBean, $macro_nv);
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

                    $mail->AddAttachment("upload/$filename", $filename, 'base64', "text/csv");
                    $emailResult = @$mail->Send();
                    unlink("upload/$filename");


                }
            }
            
        }
    }

    $html = <<<EOD
    <!DOCTYPE html>
        <html>
        <head>
            <title>Rastegar Law Group HTML Signature Generator</title>
            <link rel="icon" href="https://rastegarlawgroup.com/wp-content/uploads/2019/03/Rastegar-Law-Group-Favicon.png" sizes="32x32">
            <style type="text/css">
                * {
                    /*box-shadow: inset 0px 0px 1px black;*/
                    box-sizing: border-box;
                    outline: none;
                    transition: all 0.15s ease-in-out;
                }
                body {
                    margin: 0px;
                    padding: 0px;
                }
                #bg {
                    position: absolute;
                    display: flex;
                    margin: 0px;
                    padding: 0px;
                    overflow: hidden;
                    width: 100%;
                    height: 100%;
                    background-image: linear-gradient(0deg,rgba(64,64,64,0.5) 0%,rgba(64,64,64,0) 100%);
                    background-position: center;
                    background-size: cover;
                    background-repeat: no-repeat;
                }
                #wrapper {
                    display: flex;
                    flex-direction: column;
                    margin: auto;
                    border-radius: 5px;
                    box-shadow: 0px 5px 20px #232E36;
                }
                #maincon {
                    text-align: center;
                    width: 335px;
                    padding: 20px;
                    background-color: #eeeeee;
                    overflow: hidden;			
                    border-radius: 0 0 5px 5px;
                    user-select: none;
                }
                #headertitle {
                    background-color: #B12A2A;
                    font-family: "Rubik", sans-serif;
                    font-size: 100%;
                    padding: 10px;
                    width: 100%;
                    font-weight: 500;
                    color: #FFFFFF;
                    text-align: center;
                    border-radius: 5px 5px 0 0;
                }
                #placeholder {
                    font-family: "Rubik", sans-serif;
                    font-size: 105%;
                    padding-bottom: 25px;
                    width: 100%;
                    text-align: center;
                }
                #okebuton {
                    font-family: "Rubik", sans-serif;*
                    font-size: 100%;
                    font-weight: bold;
                    color: #FFFFFF;
                    background-color: #B12A2A;
                    box-shadow: 0px 5px 20px #d6dee4;
                    padding: 7px 20px;
                    border-radius: 5px;
                    cursor: pointer;
                    width: auto;
                    margin: auto;
                    text-align: center;
                    border: none;
                }
                #okebuton:hover {
                    box-shadow: 0px 5px 20px #aab9c3;
                }
            </style>
        </head>
        <body>
            <div id="bg">
                <div id="wrapper">
                    <div id="headertitle">Case Assign</div>
                    <div id="maincon">
                        <div id="placeholder">{$response['message']}</div>
                        <button id="okebuton" onclick="okClose();">OK</button>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                function okClose() {
                    window.open("https://rastegarlawgroup.com/crm", "_self");
                }
            </script>
        </body>
        </html>
EOD;
echo $html;



?>

