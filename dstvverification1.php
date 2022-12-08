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
    $customer_name = $_SESSION['customer_name'];
    $smart_card_number = $_SESSION['smart_card'];
    $plan_selected = $_SESSION['plan_selected'];
    $buyer_phone = $_SESSION['buyer_phone'];
    $plan = $_SESSION['plan_name'];
    $main_ammount = $_SESSION['main_ammount'];
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
            'company' => 02,
            'iucno' => $smart_card_number,
            'package' => $plan_selected,
        ),
        CURLOPT_HTTPHEADER => array(
            "AuthorizationToken: 904cc8b30fb06707862323030783481b", //replace this with your authorization_token
            "cache-control: no-cache"
        ),
    ));
    $response = curl_exec($curl);
    $response = json_decode($response);
    if ($response->status == "true") {
        $insert = "INSERT INTO dstvpurchase(customer_id,smart_card,subscriber_phone,subscription_type,amount,date_purchased) VALUES('$customer_id','$smart_card_number','$buyer_phone','$plan','$main_ammount',NOW())";
        $result = mysqli_query($connection, $insert);
        $_SESSION['dstvsuccess'] = "Set";
        echo '<script>
    window.location.href = "dstv.php";
            </script>';
    } else {
        $_SESSION['dstverror'] = "Set";
        echo '<script>
    window.location.href = "dstv.php";
            </script>';
    }
    curl_close($curl);
}
