<?php
    require_once('custom/modules/Leads/utils.php');
    $response = AttorneyApproveRejectRequest($_REQUEST['record'],"approve");
    echo json_encode($response);
    exit;
?>