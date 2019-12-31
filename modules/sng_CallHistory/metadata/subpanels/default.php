<?php
$module_name='sng_CallHistory';
$subpanel_layout = array (
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'popup_module' => 'sng_CallHistory',
    ),
  ),
  'where' => '',
  'list_fields' => 
  array (
    'name' => 
    array (
      'vname' => 'LBL_NAME',
      'widget_class' => 'SubPanelDetailViewLink',
      'width' => '45%',
      'default' => true,
    ),
    'datetime' => 
    array (
      'type' => 'datetimecombo',
      'vname' => 'LBL_DATETIME',
      'width' => '10%',
      'default' => true,
    ),
    'direction' => 
    array (
      'type' => 'varchar',
      'vname' => 'LBL_DIRECTION',
      'width' => '10%',
      'default' => true,
    ),
    'status' => 
    array (
      'type' => 'varchar',
      'vname' => 'LBL_STATUS',
      'width' => '10%',
      'default' => true,
    ),
    'src' => 
    array (
      'type' => 'phone',
      'vname' => 'LBL_SRC',
      'width' => '10%',
      'default' => true,
    ),
    'dest' => 
    array (
      'type' => 'phone',
      'vname' => 'LBL_DEST',
      'width' => '10%',
      'default' => true,
    ),
    'assigned_user_name' => 
    array (
      'link' => true,
      'type' => 'relate',
      'vname' => 'LBL_ASSIGNED_TO_NAME',
      'id' => 'ASSIGNED_USER_ID',
      'width' => '10%',
      'default' => true,
      'widget_class' => 'SubPanelDetailViewLink',
      'target_module' => 'Users',
      'target_record_key' => 'assigned_user_id',
    ),
  ),
);