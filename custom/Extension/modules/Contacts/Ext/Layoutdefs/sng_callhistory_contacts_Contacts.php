<?php
 // created: 2016-10-24 00:40:32
$layout_defs["Contacts"]["subpanel_setup"]['sng_callhistory_contacts'] = array (
  'order' => 100,
  'module' => 'sng_CallHistory',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SNG_CALLHISTORY_CONTACTS_FROM_SNG_CALLHISTORY_TITLE',
  'get_subpanel_data' => 'sng_callhistory_contacts',
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
