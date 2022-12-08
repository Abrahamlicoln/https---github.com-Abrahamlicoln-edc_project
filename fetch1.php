<?php
include 'database_connection.php';
$input = $_REQUEST['search'];
if ($input !== "") {
    $sql = "SELECT * FROM glo WHERE plan_type ='$input'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        $numRow = mysqli_num_rows($query);
        while ($row = mysqli_fetch_assoc($query)) {
            $amount = $row['main_amount'];
            $amount = number_format($amount);
            $result = array("$amount");
            $myJSON = json_encode($result);
            echo $myJSON;
        }
    }
}
