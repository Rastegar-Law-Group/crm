<?php
    require_once('custom/modules/Leads/utils.php');
    $response = AttorneyApproveRejectRequest($_REQUEST['record'],"reject");
    echo json_encode($response);
    exit;
?>