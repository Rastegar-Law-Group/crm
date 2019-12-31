<?php
$module_name = 'sng_CallHistory';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'datetime',
            'label' => 'LBL_DATETIME',
          ),
          1 => 
          array (
            'name' => 'linkedid',
            'label' => 'LBL_LINKEDID',
          ),
        ),
        2 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'direction',
            'label' => 'LBL_DIRECTION',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'src',
            'label' => 'LBL_SRC',
          ),
          1 => 
          array (
            'name' => 'dest',
            'label' => 'LBL_DEST',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'label' => 'LBL_STATUS',
          ),
          1 => 
          array (
            'name' => 'duration',
            'label' => 'LBL_DURATION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'recording',
            'label' => 'LBL_RECORDING',
          ),
        ),
      ),
    ),
  ),
);
?>
