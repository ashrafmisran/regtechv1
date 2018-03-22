<?php include 'connect.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- DateRange -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>

    <!-- FontAwesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>


    <title>Compliance Review Processor</title>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <?php include 'main.php'; ?>
    <?php include 'footer.php'; ?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, Popper.js, Momment.js then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Daterange -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        $(function() {

            $('.rangepicker').daterangepicker({
                "locale": {
                  "format": "DD/MM/YYYY"
                },
                "showDropdowns": true,
                "showWeekNumbers": true,
                "autoApply": true,
                "ranges": {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "opens": "left"
            }, function(start, end, label) {
              console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
            
            $('.singledatepicker').daterangepicker({
                "locale": {
                  "format": "DD/MM/YYYY"
                },
                "singleDatePicker":true,
                "showDropdowns": true,
                "showWeekNumbers": true,
                "autoApply": true,
                "opens": "left"
            })
        });
    </script>

    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>

    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>

    <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var set = {
      RTL520125: {
        date: [10,11,12,13,14,15,16],
        deposit: [0,12,5,5,6,8,15],
        withdraw: [0,9,4,0,0,5,2],
        balance: [0,3,4,9,15,18,31],
      },
      RTL520126: {
        date: [11,12,13,14,15,16],
        deposit: [],
        withdraw: []
      },
      RTL520127: {
        date: [11,12,13,14,15,16],
        deposit: [],
        withdraw: []
      }
    }

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            // Set the client acc no and time period
            labels: set['RTL520125']['date'],
            datasets: [/*{
                // Threshold
                label: 'Threshold',
                type: 'line',
                data: [10, 10, 10, 10, 10, 10, 10],
                borderWidth: 2,
                backgroundColor: 'rgba(0,0,0,0)'
            },*/{
                // Trust balance
                label: 'Trust Balance',
                type: 'line',
                data: set['RTL520125']['balance'],
                borderWidth: 2,
                borderColor: 'blue',
                pointHitRadius:80,
                //steppedLine: 'before',
                showLines: false
            },{
                // Deposit
                label: 'Deposit',
                data: set['RTL520125']['deposit'],
                borderWidth: 5,
                backgroundColor: 'rgba(0,166,78,0.6)',
                type: 'bar'
            },{
                // Withdraw
                label: 'Withdrawal',
                data: set['RTL520125']['withdraw'],
                borderWidth: 5,
                backgroundColor: 'rgba(226,195,116,0.6)',
                type: 'bar'
            },{
                // Settlement
                label: 'Settlement',
                data: set['RTL520125']['deposit'],
                borderWidth: 5,
                backgroundColor: 'rgba(67,102,175,0.6)',
                type: 'bar'
            },{
                // Sales proceed
                label: 'Sales proceed',
                data: set['RTL520125']['withdraw'],
                borderWidth: 5,
                backgroundColor: 'rgba(226,58,68,0.6)',
                type: 'bar'
            }]
        },
        options: {
            animation: {
                duration: 0, // general animation time
            },
            title: {
                display: false,
                text: 'Trust Account for Account No RTL520125',
                fontSize: 20
            },
            elements:{
                line:{
                  tension:0
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:false
                    }
                }]
            }
        }
    });


    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.dtable').DataTable({
          "order": [[ 0, "asc" ]],
          "scrollX": true
        });
      })
    </script>
  </body>
</html>