<?php
session_start();
$_SESSION['migrate'] = "Set";
echo '<script>
            window.setTimeout(function() {
    window.location.href = "dashboard.php";
}, 4000);
            </script>';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Buy NABTEB PIN | Synthesis Cafe</title>
    <!-- MDB icon -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="icon" href="../img/logo.png" type=" image/png" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />

    <link rel="stylesheet" href="css/mdb.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="background-color:#FBFBFB;">








    <?php
    if (isset($_SESSION['migrate'])) {
        echo "
  <script>
  Swal.fire(
  'Information!!!',
  'This Service is Unavailable at the Moment. Please Check back later. ',
  'info'
)
  </script>
  
  ";
        unset($_SESSION['migrate']);
    }
    ?>



    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
</body>

</html>