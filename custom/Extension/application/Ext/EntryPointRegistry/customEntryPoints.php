<?php

$entry_point_registry['approveCaseConversion'] = array(
    'file' => 'custom/modules/Leads/entrypoints/approve_case_conversion.php',
    'auth' => true,
);

$entry_point_registry['rejectCaseConversion'] = array(
    'file' => 'custom/modules/Leads/entrypoints/reject_case_conversion.php',
    'auth' => true,
);

$entry_point_registry['requestAttorneyUsers'] = array(
    'file' => 'custom/modules/Leads/entrypoints/request_attorney_users.php',
    'auth' => true,
);

$entry_point_registry['submitAtttorneyApprovalRequest'] = array(
    'file' => 'custom/modules/Leads/entrypoints/submit_atttorney_approval_request.php',
    'auth' => true,
);

$entry_point_registry['assignAttorneyToCase'] = array(
    'file' => 'custom/modules/Opportunities/entrypoints/assign_attorney_to_case.php',
    'auth' => true,
);

