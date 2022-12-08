<?php
include 'database_connection.php';
$input = $_REQUEST['search'];
$input = strval($input);
if ($input !== "") {
    $sql = "SELECT * FROM dstvplantobe WHERE plan_code ='$input'";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        $numRow = mysqli_num_rows($query);
        if ($numRow > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $amount = number_format($row['main_amount']);
                $result = array("$amount");
                $myJSON = json_encode($result);
                echo $myJSON;
            }
        }
    }
}
