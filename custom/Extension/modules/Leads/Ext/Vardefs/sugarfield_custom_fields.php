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
?>