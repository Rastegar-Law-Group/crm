<?php
 // created: 2016-10-24 00:40:32
$layout_defs["sng_CallHistory"]["subpanel_setup"]['sng_callhistory_calls'] = array (
  'order' => 100,
  'module' => 'Calls',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SNG_CALLHISTORY_CALLS_FROM_CALLS_TITLE',
  'get_subpanel_data' => 'sng_callhistory_calls',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
