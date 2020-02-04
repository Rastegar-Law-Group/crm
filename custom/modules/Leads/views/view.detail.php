<?php
require_once('modules/Leads/views/view.detail.php');
require_once('custom/modules/Leads/utils.php');

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class CustomLeadsViewDetail extends LeadsViewDetail
{
    public function display()
    {
        echo '<link rel="stylesheet" type="text/css" href="custom/modules/Leads/css/lead_conversion.css">';
        $this->dv->ss->assign("request_atttorney_approval", addRequestAtttorneyApprovalButton($this->bean));
        $this->dv->ss->assign("approve_case_conversion", addApproveCaseConversionButton($this->bean));
        $this->dv->ss->assign("reject_case_conversion", addRejectCaseConversionButton($this->bean));
        parent::display();
    }
}
