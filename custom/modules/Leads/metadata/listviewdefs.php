<?php
$listViewDefs ['Leads'] = 
array (
  'NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'orderBy' => 'name',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
      2 => 'salutation',
    ),
  ),
  'PHONE_MOBILE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MOBILE_PHONE',
    'default' => true,
  ),
  'EMAIL1' => 
  array (
    'width' => '16%',
    'label' => 'LBL_LIST_EMAIL_ADDRESS',
    'sortable' => false,
    'customCode' => '{$EMAIL1_LINK}',
    'default' => true,
  ),
  'POTENTIAL_CASE_C' => 
  array (
    'type' => 'text',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_POTENTIAL_CASE',
    'sortable' => false,
    'width' => '10%',
  ),
  'EMPLOYER_NAME_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_EMPLOYER_NAME',
    'width' => '10%',
  ),
  'NUM_EMPLOYEES_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_NUM_EMPLOYEES',
    'width' => '10%',
  ),
  'EMPLOYMENT_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_EMPLOYMENT_STATUS',
    'width' => '10%',
  ),
  'PREFERRED_LANGUAGE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PREFERRED_LANGUAGE',
    'width' => '10%',
  ),
  'MARKETING_SOURCE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_MARKETING_SOURCE',
    'width' => '10%',
  ),
  'AVAIL_FROM_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_AVAIL_FROM',
    'width' => '10%',
  ),
  'AVAIL_TO_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_AVAIL_TO',
    'width' => '10%',
  ),
  'CREATED_BY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CREATED',
    'id' => 'CREATED_BY',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
);
;
?>
