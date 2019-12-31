<?php
// created: 2016-10-24 00:40:32
$dictionary["sng_callhistory_accounts"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'sng_callhistory_accounts' => 
    array (
      'lhs_module' => 'sng_CallHistory',
      'lhs_table' => 'sng_callhistory',
      'lhs_key' => 'id',
      'rhs_module' => 'Accounts',
      'rhs_table' => 'accounts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'sng_callhistory_accounts_c',
      'join_key_lhs' => 'sng_callhistory_accountssng_callhistory_ida',
      'join_key_rhs' => 'sng_callhistory_accountsaccounts_idb',
    ),
  ),
  'table' => 'sng_callhistory_accounts_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'sng_callhistory_accountssng_callhistory_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'sng_callhistory_accountsaccounts_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'sng_callhistory_accountsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'sng_callhistory_accounts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'sng_callhistory_accountssng_callhistory_ida',
        1 => 'sng_callhistory_accountsaccounts_idb',
      ),
    ),
  ),
);