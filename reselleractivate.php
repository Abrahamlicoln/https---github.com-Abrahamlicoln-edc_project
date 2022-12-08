<?php
session_start();
include 'database_connection.php';
if (!$_GET["succesfullypaid"]) {
    header("Location:dashboard.php");
    exit;
} else {
    $data = $_SESSION['login_in'];
    $customer_id = $data['customer_id'];
    $reference = $_GET["succesfullypaid"];
    $update = "UPDATE customer SET reseller = '1' WHERE customer_id = '$customer_id'";
    $result = mysqli_query($connection, $update);
    if ($result) {
        $_SESSION['added'] = "Set";
        echo '<script>
    window.location.href = "dashboard.php";
            </script>';
    }
}
