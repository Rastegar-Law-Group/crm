<?php
    require_once('custom/modules/Leads/utils.php');
    $response = submitAttorneyApproveRequest($_REQUEST['record'],$_REQUEST['attorney']);
    echo json_encode($response);
    exit;
?>