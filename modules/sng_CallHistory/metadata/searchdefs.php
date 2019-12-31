<?php
$module_name = 'sng_CallHistory';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'linkedid' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_LINKEDID',
        'width' => '10%',
        'default' => true,
        'name' => 'linkedid',
      ),
      'src' => 
      array (
        'type' => 'phone',
        'label' => 'LBL_SRC',
        'width' => '10%',
        'default' => true,
        'name' => 'src',
      ),
      'dest' => 
      array (
        'type' => 'phone',
        'label' => 'LBL_DEST',
        'width' => '10%',
        'default' => true,
        'name' => 'dest',
      ),
    ),
    'advanced_search' => 
    array (
      'uniqueid' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_UNIQUEID',
        'width' => '10%',
        'default' => true,
        'name' => 'uniqueid',
      ),
      'src' => 
      array (
        'type' => 'phone',
        'label' => 'LBL_SRC',
        'width' => '10%',
        'default' => true,
        'name' => 'src',
      ),
      'dest' => 
      array (
        'type' => 'phone',
        'label' => 'LBL_DEST',
        'width' => '10%',
        'default' => true,
        'name' => 'dest',
      ),
      'description' => 
      array (
        'type' => 'text',
        'label' => 'LBL_DESCRIPTION',
        'sortable' => false,
        'width' => '10%',
        'default' => true,
        'name' => 'description',
      ),
      'linkedid' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_LINKEDID',
        'width' => '10%',
        'default' => true,
        'name' => 'linkedid',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
