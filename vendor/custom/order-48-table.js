
        var selectedOrder = [];
        var selectedReport = [];

        // Select tab between order / report
        $('#tab-amla-report').find('a').click( function(event){
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
        $('#select-all-orders,#select-all-reports').change(function (){
            var allCheckboxes = $(this).parent().parent().parent().parent().find('.checkbox');
            allCheckboxes.prop('checked', !allCheckboxes.prop("checked") );
        })

        // Uncheck 'Select all' checkbox if any of the checkboxes is unchecked
        $('#order-tab,#report-tab').find('.checkbox').change(function(){
            if(!this.checked){
                $(this).parent().parent().parent().parent().find('#select-all-orders,#select-all-reports').prop('checked',false)
            }
        })

        // Enable click on table row to checked/unchecked the checkbox
        $('#order-tab,#report-tab').find('tr').click(function(){
            
            var checkbox = $(this).find('.checkbox');
            checkbox.prop('checked', !checkbox.prop("checked") ); // Toggle the check-uncheck
            checkbox.parent().parent().parent().parent().find('#select-all-orders,#select-all-reports').prop('checked',false) // Uncheck select all
            
            var table_name = $(this).parent().parent().parent().attr('id');
            if (table_name == 'order-tab') {
                check(checkbox,selectedOrder);
            }else if(table_name == 'report-tab') {
                check(checkbox,selectedReport);
            }
        })


        function check(checkbox,array){
            if ( checkbox.prop('checked') ) {
                array.push(checkbox.val());
            }else{
                var index = array.indexOf(checkbox.val());
                array.splice(index,1);
            }
            console.log(array);
        };
  