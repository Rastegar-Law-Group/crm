<?php
$viewdefs ['Leads'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="prospect_id" value="{if isset($smarty.request.prospect_id)}{$smarty.request.prospect_id}{else}{$bean->prospect_id}{/if}">',
          1 => '<input type="hidden" name="account_id" value="{if isset($smarty.request.account_id)}{$smarty.request.account_id}{else}{$bean->account_id}{/if}">',
          2 => '<input type="hidden" name="contact_id" value="{if isset($smarty.request.contact_id)}{$smarty.request.contact_id}{else}{$bean->contact_id}{/if}">',
          3 => '<input type="hidden" name="opportunity_id" value="{if isset($smarty.request.opportunity_id)}{$smarty.request.opportunity_id}{else}{$bean->opportunity_id}{/if}">',
        ),
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
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
      'javascript' => '<script type="text/javascript" language="Javascript">function copyAddressRight(form)  {ldelim} form.alt_address_street.value = form.primary_address_street.value;form.alt_address_city.value = form.primary_address_city.value;form.alt_address_state.value = form.primary_address_state.value;form.alt_address_postalcode.value = form.primary_address_postalcode.value;form.alt_address_country.value = form.primary_address_country.value;return true; {rdelim} function copyAddressLeft(form)  {ldelim} form.primary_address_street.value =form.alt_address_street.value;form.primary_address_city.value = form.alt_address_city.value;form.primary_address_state.value = form.alt_address_state.value;form.primary_address_postalcode.value =form.alt_address_postalcode.value;form.primary_address_country.value = form.alt_address_country.value;return true; {rdelim} </script>',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'LBL_CONTACT_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'customCode' => '{html_options name="salutation" id="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name"  id="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
          ),
        ),
        1 => 
        array (
          0 => 'last_name',
        ),
        2 => 
        array (
          0 => 'phone_mobile',
        ),
        3 => 
        array (
          0 => 'email1',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'potential_case_c',
            'studio' => 'visible',
            'label' => 'LBL_POTENTIAL_CASE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'employer_name_c',
            'label' => 'LBL_EMPLOYER_NAME',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'num_employees_c',
            'studio' => 'visible',
            'label' => 'LBL_NUM_EMPLOYEES',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'employment_status_c',
            'studio' => 'visible',
            'label' => 'LBL_EMPLOYMENT_STATUS',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'preferred_language_c',
            'studio' => 'visible',
            'label' => 'LBL_PREFERRED_LANGUAGE',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'marketing_source_c',
            'studio' => 'visible',
            'label' => 'LBL_MARKETING_SOURCE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'avail_from_c',
            'label' => 'LBL_AVAIL_FROM',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'avail_to_c',
            'label' => 'LBL_AVAIL_TO',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'additional_notes_c',
            'studio' => 'visible',
            'label' => 'LBL_ADDITIONAL_NOTES',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'fu_1_c',
            'studio' => 'visible',
            'label' => 'LBL_FU_1',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'fu_2_c',
            'studio' => 'visible',
            'label' => 'LBL_FU_2',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'fu_3_c',
            'studio' => 'visible',
            'label' => 'LBL_FU_3',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'fu_4_c',
            'studio' => 'visible',
            'label' => 'LBL_FU_4',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'retainer_status_c',
            'label' => 'LBL_RETAINER_STATUS',
          ),
        ),
      ),
    ),
  ),
);
;
?>
