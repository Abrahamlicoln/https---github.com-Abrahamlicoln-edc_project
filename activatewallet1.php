<?php
ob_start();
session_start();
include 'database_connection.php';
$data = $_SESSION['login_in'];
$customer_id = $data['customer_id'];
$email_address = $data['email_address'];
$fullname = $data['fullname'];
$phone_number = $data['phone_number'];
$waec_pin = $_SESSION['waec_pin'];
$amount = $_SESSION['amount'];
$buyer_phone = $_SESSION['buyer_phone'];
$quantity = $_SESSION['quantity'];
$quantity = intval($quantity);
$reference = "wallet_transaction";
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://easyaccess.com.ng/api/waec_v2.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array(
        'no_of_pins' => 1,
    ),
    CURLOPT_HTTPHEADER => array(
        "AuthorizationToken: 5fde6b4b4744c5841f7a387bbe8d3cc6", //replace this with your authorization_token
        "cache-control: no-cache"
    ),
));
$response = curl_exec($curl);
$response = json_decode($response);
if ($response->success == "true") {
    $serial_num = $response->pin;
    $serial_num = str_replace("<=>", ",", $serial_num);
    $serial_num = preg_split("/\,/", $serial_num);
    $pin = $serial_num['0'];
    $serial_number = $serial_num['1'];
    $insert = "INSERT INTO purchase_id(customer_id,buyer_phone,card_type,serial_number,pin,payment_status,amount,transaction_id,date_purchase) VALUES('$customer_id','$buyer_phone','$waec_pin','$serial_number','$pin','Successful','$new_amount','$reference',NOW())";
    $result = mysqli_query($connection, $insert);
    $_SESSION['succeed'] = "Set";
    echo '<script>
    window.location.href = "waec.php";
            </script>';
}
curl_close($curl);
