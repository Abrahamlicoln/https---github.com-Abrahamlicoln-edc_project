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
    $amount = $_SESSION['amount_wallet'];
    $amount = intval($amount);
    $select = "SELECT * FROM customer_wallet WHERE customer_id = '" . $customer_id . "'";
    $result = mysqli_query($connection, $select);
    if ($numRow = mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $current_balance = $row['wallet_balance'];
            $newbalance = $amount + $current_balance;
            $update = "UPDATE customer_wallet SET wallet_balance = '$newbalance' WHERE customer_id = '" . $customer_id . "'";
            $result = mysqli_query($connection, $update);
            echo '<script>
    window.location.href = "main_confirmation.php.php";
            </script>';
        }
    } else {
        $insert = "INSERT INTO customer_wallet(customer_id,wallet_balance) VALUES('" . $customer_id . "','$amount')";
        $result = mysqli_query($connection, $insert);
        echo '<script>
    window.location.href = "main_confirmation.php";
            </script>';
    }
}
