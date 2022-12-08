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
    $account_number = $_SESSION['account_number'];
    $main_ammount = $_SESSION['main_ammount'];
    $phone_number = $_SESSION['phone_number'];
    $bonquet = $_SESSION['bonquet'];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://easyaccess.com.ng/api/paytv.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array(
            'company' => 03,
            'iucno' => $account_number,
            'package' => $bonquet,
        ),
        CURLOPT_HTTPHEADER => array(
            "AuthorizationToken: 5fde6b4b4744c5841f7a387bbe8d3cc6", //replace this with your authorization_token
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);
    if ($response->status == "true") {
        $insert = "INSERT INTO startimespurchase(customer_id,smart_card,subscriber_phone,subscription_type,amount,date_purchased) VALUES('$customer_id','$account_number','$phone_number','$bonquet','$main_ammount',NOW())";
        $result = mysqli_query($connection, $insert);
        $_SESSION['main_success'] = "Set";
        echo '<script>
    window.location.href = "startime.php";
            </script>';
    } else {
        $_SESSION['main_error'] = "Set";
        echo '<script>
    window.location.href = "startime.php";
            </script>';
    }
    curl_close($curl);
}
