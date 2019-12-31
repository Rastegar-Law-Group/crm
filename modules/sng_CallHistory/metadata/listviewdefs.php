<?php
$module_name = 'sng_CallHistory';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'SRC' => 
  array (
    'type' => 'phone',
    'label' => 'LBL_SRC',
    'width' => '10%',
    'default' => true,
  ),
  'DIRECTION' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_DIRECTION',
    'width' => '10%',
    'default' => true,
  ),
  'DEST' => 
  array (
    'type' => 'phone',
    'label' => 'LBL_DEST',
    'width' => '10%',
    'default' => true,
  ),
  'DURATION' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_DURATION',
    'width' => '10%',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'DATETIME' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_DATETIME',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
);
?>
