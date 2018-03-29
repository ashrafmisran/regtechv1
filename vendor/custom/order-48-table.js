var selectedOrder = [];
var selectedReport = [];

// Select tab between order / report
$('#tab-amla-report').find('a').click(function(event) {
    // Set active for clicked tab button
    $('#tab-amla-report').find('a').removeClass('active');
    $(this).addClass('active');
    var tab = $(this).data('tab');

    // Hide previous tab and show clicked tab
    $('.tab-box').addClass('d-none');
    $('.tab-box').removeClass('fade');
    $(tab).addClass('fadeIn');
    $(tab).removeClass('d-none');
})

// Check/Uncheck following the Select/Deselect all checkbox
$('#select-all-orders,#select-all-reports').change(function() {
    var state = $(this).prop('checked');
    var allCheckboxes = $(this).parent().parent().parent().parent().find('.checkbox');
    allCheckboxes.prop('checked', state);

    var table_name = $(this).parent().parent().parent().parent().parent().attr('id');
    var checkbox = $(this).parent().parent().parent().parent().parent().find('.checkbox');

    for (var i = checkbox.length - 1; i >= 0; i--) {

        if (table_name == 'order-tab') {
            check(checkbox[i], selectedOrder);
        } else if (table_name == 'report-tab') {
            check(checkbox[i], selectedReport);
        }

    }

    
})

// Uncheck 'Select all' checkbox if any of the checkboxes is unchecked
$('#order-tab,#report-tab').find('.checkbox').change(function() {
    if (!this.checked) {
        $(this).parent().parent().parent().parent().find('#select-all-orders,#select-all-reports').prop('checked', false)
    }
})

// Enable click on table row to checked/unchecked the checkbox
$('#order-tab,#report-tab').find('tr').click(function() {

    var checkbox = $(this).find('.checkbox');
    checkbox.prop('checked', !checkbox.prop("checked")); // Toggle the check-uncheck
    checkbox.parent().parent().parent().parent().find('#select-all-orders,#select-all-reports').prop('checked', false) // Uncheck select all

    var table_name = $(this).parent().parent().parent().attr('id');
    if (table_name == 'order-tab') {
        check(checkbox, selectedOrder);
    } else if (table_name == 'report-tab') {
        check(checkbox, selectedReport);
    }
})

// Focus on cancel button
$('.modal').on('shown.bs.modal', function (e) {
    $('.focus').trigger('focus')
})

// Generate send email form
$('#modal-reply-order').on('shown.bs.modal', function (event) {
    var replyFrom = $(event.relatedTarget).data('reply-from');
    var replyTo = $(event.relatedTarget).data('reply-to');
    var ccTo = $(event.relatedTarget).data('cc-to');
    var replySubject = $(event.relatedTarget).data('subject');
    var now = new Date();
    var content = 
        '<p>Dear Sir,</p>'+
        '<p>Please find below our reply to the order served under Section 48 of AMLATFPUAA 2001: </p>'+
        '<table style="width:100%">'+
            '<tr>'+
                '<td>Reply to</td>'+
                '<td>Order dated......</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Order Received</td>'+
                '<td>Order dated......</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Bank</td>'+
                '<td>BIMB Securities Sdn Bhd</td>'+
            '</tr>'+
        '</table>'+
        '<p>To provide all account(s) information under the name of the person(s) specified in the Order 48 AMLATFPUAA and any other accounts that this person is authorised to be as either the :</p>'+
        '<ol>'+
            '<li>Signatory; or</li>'+
            '<li>Mandatee</li>'+
        '</ol>'+
        '<table>'+
            '<tr>'+
                '<td>Account Holder</td>'+
                '<td>Account Number</td>'+
                '<td>Branch</td>'+
                '<td>Account Type</td>'+
                '<td>Status<br>Active/Dormant/Closed</td>'+
                '<td>Balance as at '+now.getDate()+'/'+now.getMonth()+'/'+now.getFullYear()+'</td>'+
                '<td>Date Account Open</td>'+
                '<td>Remarks</td>'+
            '</tr>'+
            '<tr>'+
                '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'+
            '</tr>'+
            '<tr>'+
                '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'+
            '</tr>'+
            '<tr>'+
                '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'+
            '</tr>'+
        '</table>'+
        '<p>Thank you.</p>'+
        '<p>FIRST END2END SHARIAH</p>';

    $('#reply-from').val(replyFrom);
    $('#reply-to').val(replyTo);
    $('#reply-cc').val(ccTo);
    $('#reply-subject').val(replySubject);
    tinyMCE.activeEditor.setContent(content);
})

// Push selected row to array function
function check(checkbox, array) {
    if (checkbox.prop('checked')) {
        array.push(checkbox.val());
    } else {
        var index = array.indexOf(checkbox.val());
        array.splice(index, 1);
    }
    console.log(array);
};


function removeFrom(table,array){
    array = array.toString();
    var removeFile = 'remove.php?t='+table+'&id='+array;
    console.log(removeFile);

    // Once clicked 'Confirm delete' button, this PHP file will be loaded and show deleted/failed deletion.
    document.getElementById('notification-box').innerHTML = '<iframe style="border: 0;max-height: 50px;width: 100%;" src="'+removeFile+'"></iframe>';

    // Hide the confirm and cancel buttons and show close button
    $('#order-confirm-btn, #order-cancel-btn').addClass('d-none');
    $('#order-close-btn').removeClass('d-none');


    // Reload page once the modal closed
    $('.modal').on('hidden.bs.modal', function (e) {
        window.location.reload();
    })
}

