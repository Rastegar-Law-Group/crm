function requestAtttorneyApprovalPopup(){
    $( "body" ).trigger( "click" );
    SUGAR.ajaxUI.showLoadingPanel();
    $.ajax({
        url:"index.php?entryPoint=requestAttorneyUsers",
        async: "false",
        success:function(data) {
            SUGAR.ajaxUI.hideLoadingPanel();
            response = JSON.parse(data);
            modalBody = '';
            modalBody += '<p style="font-size: 15px;">Choose an attorney to submit the Approval Request for this lead:</p>';
            for (var key in response) {
                modalBody += `<p style="font-size: 15px;"><input type="radio" name="attorneys_avail" value="${key}" style="margin-right: 3px; margin-bottom: 4px;"/> ${response[key]}</p>`; 
            }
            modalContent(
                "Request Attorney Approval",
                modalBody,
                `<button type="submit" onclick="submitApprovalRequest()" value="Submit">Submit</button>
                <button type="Cancel" onclick="closeModal()" value="Cancel">Cancel</button>`
            );
        },error:function(e){
            console.log("Error in AJAX CALL at line 85 custom/modules/leads/js/lead_conversion.js");
        }
    });
}

function submitApprovalRequest(){
    var selectedAttorney = $("input:radio[name=attorneys_avail]:checked").val();
    var record = $("input:hidden[name=record]").val();
    if(selectedAttorney){
        closeModal();
        SUGAR.ajaxUI.showLoadingPanel();
        $.ajax({
            url:`index.php?entryPoint=submitAtttorneyApprovalRequest&attorney=${selectedAttorney}&record=${record}`,
            async: "false",
            success:function(data) {
                SUGAR.ajaxUI.hideLoadingPanel();
                $('#mainModal').addClass('reload');
                modalContentSuccess(
                    "Approval Submitted",
                    `This lead has been successfully submitted for`,
                    `Approval Request to the selected Attorney.`,
                    `<button type="Cancel" onclick="closeModal()" value="Cancel">Close</button>`
                );
            },error:function(e){
                console.log("Error in AJAX CALL at function:submitApprovalRequest custom/modules/leads/js/lead_conversion.js");
            }
        });
    }else{
        closeModal();
    }
}

function approveCaseConversion(){
    var record = $("input:hidden[name=record]").val();
    $( "body" ).trigger( "click" );
    SUGAR.ajaxUI.showLoadingPanel();
    $.ajax({
        url:`index.php?entryPoint=approveCaseConversion&record=${record}&req_type=AJAX`,
        async: "false",
        success:function(data) {
            SUGAR.ajaxUI.hideLoadingPanel();
            $('#mainModal').addClass('reload');
            response = JSON.parse(data);
            modalContent(
                "Case Approved",
                response.message,
                `<button type="Cancel" onclick="closeModal()" value="Cancel">Cancel</button>`
            );
        },error:function(e){
            console.log("Error in AJAX CALL at function:approveCaseConversion custom/modules/leads/js/lead_conversion.js");
        }
    });
}

function rejectCaseConversion(){
    var record = $("input:hidden[name=record]").val();
    $( "body" ).trigger( "click" );
    SUGAR.ajaxUI.showLoadingPanel();
    $.ajax({
        url:`index.php?entryPoint=rejectCaseConversion&record=${record}&req_type=AJAX`,
        async: "false",
        success:function(data) {
            SUGAR.ajaxUI.hideLoadingPanel();
            $('#mainModal').addClass('reload');
            response = JSON.parse(data);
            modalContent(
                "Case Rejected",
                response.message,
                `<button type="Cancel" onclick="closeModal()" value="Cancel">Cancel</button>`
            );
        },error:function(e){
            console.log("Error in AJAX CALL at function:rejectCaseConversion custom/modules/leads/js/lead_conversion.js");
        }
    });
}

function modalContent(header,body,footer){
    $('#modalHeader').html(header);
    $('#modalBody').html('<p style="font-size: 15px; line-height: 22px; text-align: center;">'+body+'</p>');
    $("#modalHeader" ).trigger( "click" );
    $('#modalFooter').html(footer);
    $('#mainModal').css('display','block');
}

function modalContentSuccess(header,body1,body2,footer){
    $('#modalHeader').html(header);
    $('#modalBody').html('<p style="font-size: 15px;">'+body1+'<br/>'+body2+'</p>');
    $("#modalHeader" ).trigger( "click" );
    $('#modalFooter').html(footer);
    $('#mainModal').css('display','block');
}

function closeModal(){
    $('#mainModal').css('display','none');
    if($('#mainModal').hasClass('reload')){
        window.location.reload();
    }
}

function addModalHTML(){
    var modalHtml= '<div id="mainModal" class="modal">  '+
                    '<div class="modal-content" style="border-radius: 5px;">'+
                        '<div class="modal-header">'+
                            '<span id="modalClose" class="close">&times;</span>'+
                        '<h2 id="modalHeader" style="font-size: 24px;"> </h2>'+
                    '</div>'+
                    '<div id="modalBody" class="modal-body">'+
                        '<p>Some text in the Modal Body</p>'+
                        '<p>Some other text...</p>'+
                    '</div>'+
                    '<div id="modalFooter" class="modal-footer">'+
                    '</div>'+
                '</div></div>';
    $('body').append(modalHtml);
    
    $('#modalClose').click(function(){
         closeModal();
    });
}

function showHideAttorneyResponsibleFields(){
    if( $('#status').val() != "Approved" && $('#status').val() != "Rejected" ){
        $('#attorney_id').parent().parent().parent().remove();
    }
}

$( document ).ready(function() {
    addModalHTML();
    //showHideAttorneyResponsibleFields();
});