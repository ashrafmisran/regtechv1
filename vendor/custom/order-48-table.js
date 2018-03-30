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



// Enable click on table row to checked/unchecked the checkbox
$('#order-tab,#report-tab').find('tr').click(function() {
    var checkbox = $(this).find('.checkbox');
    checkbox.prop('checked', !checkbox.prop("checked")); // Toggle the check-uncheck
    checkbox.parent().parent().parent().parent().find('#select-all-orders,#select-all-reports').prop('checked', false) // Uncheck select all

    var table_name = $(this).parent().parent().parent().attr('id');
    if (table_name == 'order-tab') {
        check(checkbox, selectedOrder);

        /*Followed by updating the
        generate email btn url*/
        var row = $('#order-tab').find('.checkbox[value="'+selectedOrder[0]+'"]').parent().parent();
        var subject            = row.find('td:nth-child(5)').text();
        var orderreceiveddate  = row.find('td:nth-child(6)').text();
        var to                 = row.find('td:nth-child(10)').text();
        var cc                 = row.find('td:nth-child(11)').text();
        // Re-format
        
        var generateEmailURL = 'generate-reply-email.php?to='+to+'&cc='+cc+'&subject='+subject+'&orderreceiveddate='+orderreceiveddate;

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

// Set value for order ID from received email date
function updateId(){
    var date   = $('#email-received-date').val();
        date   = date.substring(8,10)+date.substring(3,5)+date.substring(0,2);
    var now    = new Date();
    var start  = new Date();
        start.setHours(6);
        start.setMinutes(0);
        start.setSeconds(0);

    seconds  = (now-start)/1000;
    var unic = seconds.toString(16).toUpperCase();

    id = 'ORD-'+date+'-'+unic;
    $('#order-id').val(id);
}


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

