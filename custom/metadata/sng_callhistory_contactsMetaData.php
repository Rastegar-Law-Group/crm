<?php
// created: 2016-10-24 00:40:32
$dictionary["sng_callhistory_contacts"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'sng_callhistory_contacts' => 
    array (
      'lhs_module' => 'sng_CallHistory',
      'lhs_table' => 'sng_callhistory',
      'lhs_key' => 'id',
      'rhs_module' => 'Contacts',
      'rhs_table' => 'contacts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'sng_callhistory_contacts_c',
      'join_key_lhs' => 'sng_callhistory_contactssng_callhistory_ida',
      'join_key_rhs' => 'sng_callhistory_contactscontacts_idb',
    ),
  ),
  'table' => 'sng_callhistory_contacts_c',
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
      'name' => 'sng_callhistory_contactssng_callhistory_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'sng_callhistory_contactscontacts_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'sng_callhistory_contactsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'sng_callhistory_contacts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'sng_callhistory_contactssng_callhistory_ida',
        1 => 'sng_callhistory_contactscontacts_idb',
      ),
    ),
  ),
);