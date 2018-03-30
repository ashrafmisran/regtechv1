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
/*$('#select-all-orders,#select-all-reports').change(function() {
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

    
})*/

// Uncheck 'Select all' checkbox if any of the checkboxes is unchecked
/*$('#order-tab,#report-tab').find('.checkbox').change(function() {
    if (!this.checked) {
        $(this).parent().parent().parent().parent().find('#select-all-orders,#select-all-reports').prop('checked', false)
    }
})*/

// Enable click on table row to checked/unchecked the checkbox
$('#order-tab,#report-tab').find('tr').click(function() {
    var checkbox = $(this).find('.checkbox');
    checkbox.prop('checked', !checkbox.prop("checked")); // Toggle the check-uncheck
    checkbox.parent().parent().parent().parent().find('#select-all-orders,#select-all-reports').prop('checked', false) // Uncheck select all

    var table_name = $(this).parent().parent().parent().attr('id');
    if (table_name == 'order-tab') {
        check(checkbox, selectedOrder);

        /*Followed by updating the
        generate email btn url, using the first*/
        var row = $('#order-tab').find('.checkbox[value="'+selectedOrder[0]+'"]').parent().parent();
        var to                 = row.find('td:nth-child(3)').text(); // Will edit
        var cc                 = row.find('td:nth-child(3)').text(); // Will edit
        var replySubject       = row.find('td:nth-child(3)').text(); // Will edit
        var receivedSubject    = row.find('td:nth-child(3)').text(); // Will edit
        var orderreceiveddate  = row.find('td:nth-child(3)').text();
        var senderName         = row.find('td:nth-child(3)').text(); // Will edit
        var post               = row.find('td:nth-child(3)').text(); // Will edit
        var tel                = row.find('td:nth-child(3)').text(); // Will edit
        var senderEmail        = row.find('td:nth-child(3)').text(); // Will edit
        // Re-format
        
        var generateEmailURL = 'generate-reply-email.php?to='+to+'&cc='+cc+'&subject='+replySubject+'&replyto='+receivedSubject+'&orderreceiveddate='+orderreceiveddate+'&sender='+senderName+'&post='+post+'&tel='+tel+'&email='+senderEmail;

        $('#generate-email-btn').prop('href', generateEmailURL);

        // Disable generate email button if more than 1 order selected or no row selected
        if( typeof selectedOrder[1] !== 'undefined' || typeof selectedOrder[0] == 'undefined' ){
            $('#generate-email-btn').addClass('disabled');
        }else{
            $('#generate-email-btn').removeClass('disabled');
        }

        // Disable process and delete order button if more than 1 order selected or no row selected
        if( typeof selectedOrder[0] == 'undefined' ){
            $('#process-order-btn, #remove-order-btn').addClass('disabled');
        }else{
            $('#process-order-btn, #remove-order-btn').removeClass('disabled');
        }

    } else if (table_name == 'report-tab') {
        check(checkbox, selectedReport);
    }
    
})


// Focus on cancel button
$('.modal').on('shown.bs.modal', function (e) {
    $('.focus').trigger('focus')
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

