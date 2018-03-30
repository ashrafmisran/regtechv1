<?php session_start(); 
    $_SESSION['user']['fullname']       = 'Muhammad Ashraf bin Misran';
    $_SESSION['user']['position']       = 'Compliance Executive';
    $_SESSION['user']['phone']          = '603-2613 1626';
    $_SESSION['user']['email']          = 'm.ashraf@bimbsec.com.my';
?>
<?php include 'connect.php'; ?>
<?php include 'vendor/autoload.php'; ?>
<?php include 'function.php'; ?>
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

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">

    <title>CGD</title>

    <!-- TinyMCE -->
    <script src="vendor/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea.tinymce' });</script>

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
                "opens": "right"
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
                "opens": "right"
            })
        });
    </script>

    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>

    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="vendor/custom/chart.js"></script>

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" src="vendor/custom/select2.js"></script>

    <!-- Tab for AMLA -->
    <script type="text/javascript" src="vendor/custom/order-48-table.js"></script>


    <script type="text/javascript">
      $(document).ready(function() {
        $('.dtable').DataTable({
          "order": [[ 0, "asc" ]],
          "scrollX": true
        });
      })

      function get_suggestion(){
        alert('Suggestion')
      }
      // Tooltip for entering the form
      $('#upload-form *').tooltip();
    </script>
  </body>
</html>
