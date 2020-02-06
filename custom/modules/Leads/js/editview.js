$( document ).ready(function() {
    caseTypeTrigger($('#case_type').val());
    $('#case_type').change(function () {
        caseTypeTrigger(this.value);
    });
});
function caseTypeTrigger(caseType) {
    if(caseType=='Employer'){
        $('#employer_name_c').show();
        $("[data-label='LBL_EMPLOYER_NAME']").parent('div').show();

        $('#num_employees_c').show();
        $("[data-label='LBL_NUM_EMPLOYEES']").parent('div').show();

        $('#employment_status_c').show();
        $("[data-label='LBL_EMPLOYMENT_STATUS']").parent('div').show();

        $('#landlord_name_c').hide();
        $("[data-label='LBL_LANDLORD_NAME']").parent('div').hide();

        $('#rent_amt_c').hide();
        $("[data-label='LBL_RENT_AMT']").parent('div').hide();

        $('#latefee_amt_c').hide();
        $("[data-label='LBL_LATEFEE_AMT']").parent('div').hide();
    }
    else if (caseType=='Landlord'){
        $('#landlord_name_c').show();
        $("[data-label='LBL_LANDLORD_NAME']").parent('div').show();

        $('#rent_amt_c').show();
        $("[data-label='LBL_RENT_AMT']").parent('div').show();

        $('#latefee_amt_c').show();
        $("[data-label='LBL_LATEFEE_AMT']").parent('div').show();

        $('#employer_name_c').hide();
        $("[data-label='LBL_EMPLOYER_NAME']").parent('div').hide();

        $('#num_employees_c').hide();
        $("[data-label='LBL_NUM_EMPLOYEES']").parent('div').hide();

        $('#employment_status_c').hide();
        $("[data-label='LBL_EMPLOYMENT_STATUS']").parent('div').hide();
    }
}
