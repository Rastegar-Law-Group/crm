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
            for (var key in response) {
                modalBody += `<p><input type="radio" name="attorneys_avail" value="${key}"/> ${response[key]}</p>`; 
            }
            modalContent(
                "Request Atttorney Approval",
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
                modalContent(
                    "Request Atttorney Approval",
                    `Lead Approval Request has been submitted to selected Attorney`,
                    `<button type="Cancel" onclick="closeModal()" value="Cancel">Cancel</button>`
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
        url:`index.php?entryPoint=approveCaseConversion&record=${record}`,
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
        url:`index.php?entryPoint=rejectCaseConversion&record=${record}`,
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
    $('#modalBody').html(body);
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
                    '<div class="modal-content">'+
                        '<div class="modal-header">'+
                            '<span id="modalClose" class="close">&times;</span>'+
                        '<h2 id="modalHeader"> </h2>'+
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