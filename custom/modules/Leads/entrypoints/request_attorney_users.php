<?php
    require_once('custom/modules/Leads/utils.php');
    $users = getSpecificRoledUser("attorney");
    echo json_encode($users);
    exit;
?>