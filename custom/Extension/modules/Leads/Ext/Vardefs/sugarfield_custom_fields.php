<?php
    $dictionary['Lead']['fields']['retainer_signed']=array(
        'name' => 'retainer_signed',
        'vname' => 'LBL_RETAINER_SIGNED',
        'type' => 'enum',
        'options' => 'retainer_signed_list',
        'len' => 30,
        'audited' => true,
        'comment' => 'Retainer Signed',
    );
    $dictionary['Lead']['fields']['sign_up_reason']=array(
        'name' => 'sign_up_reason',
        'vname' => 'LBL_SIGN_UP_REASON',
        'type' => 'enum',
        'options' => 'sign_up_reason_list',
        'len' => 30,
        'audited' => true,
        'comment' => 'Sign-Up Reason',
    );
    $dictionary['Lead']['fields']['attorney_targets']=array(
        'name' => 'attorney_targets',
        'vname' => 'LBL_ATTORNEY_TARGETS',
        'type' => 'text',
        'len' => 500,
        'comment' => 'attorney_targets',
    );

    $dictionary['Lead']['fields']['attorney_id'] = array(
        'name' => 'attorney_id',
        'type' => 'id',
        'group' => 'attorney_name',
        'reportable' => false,
        'vname' => 'LBL_ATTORNEY_ID',
    );
    $dictionary['Lead']['fields']['attorney_name'] = array(
        'name' => 'attorney_name',
        'rname' => 'name',
        'source' => 'non-db',
        'vname' => 'LBL_ATTORNEY_NAME',
        'reportable' => false,
        'id_name' => 'attorney_id',
        'type' => 'relate',
        'module' => 'Users',
        'table' => 'users',
        'link' => 'attorney_lead_c',
        'inline_edit' => false,
    );
    $dictionary['Lead']['fields']['attorney_lead_c'] = array(
        'name' => 'attorney_lead_c',
        'type' => 'link',
        'relationship' => 'attorney_lead_c',
        'source' => 'non-db',
        'module' => 'Users',//other side
        'bean_name' => 'User',
        'vname' => 'LBL_ATTORNEY_NAME',
        'id_name' => 'attorney_id',//same side id
    );

    $dictionary['Lead']['fields']['action_date']=array(
        'name' => 'action_date',
        'vname' => 'LBL_ACTION_DATE',
        'type' => 'date',
        'audited' => true,
        'comment' => 'Action date',
        'enable_range_search' => true,
        'inline_edit' => false,
        'readonly' => true,
    );
    $dictionary['Lead']['fields']['status']['inline_edit'] = false;
    $dictionary['Lead']['fields']['status']['readonly'] = true;

?>