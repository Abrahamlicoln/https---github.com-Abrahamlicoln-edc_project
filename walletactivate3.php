
<?php
ob_start();
session_start();
include 'database_connection.php';
$data = $_SESSION['login_in'];
$customer_id = $data['customer_id'];
$email_address = $data['email_address'];
$fullname = $data['fullname'];
$phone_number = $data['phone_number'];
$nabteb_pin = $_SESSION['nabteb_pin'];
$amount = $_SESSION['amount'];
$buyer_phone = $_SESSION['buyer_phone'];
$quantity = $_SESSION['quantity'];
$quantity = intval($quantity);
$new_amount = $amount * $quantity;
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
    $insert = "INSERT INTO purchase_id(customer_id,buyer_phone,card_type,serial_number,pin,payment_status,amount,transaction_id,date_purchase) VALUES('$customer_id','$buyer_phone','$nabteb_pin','$serial_number','$pin','Successful','$new_amount','$reference',NOW())";
    $result = mysqli_query($connection, $insert);
    $_SESSION['succeed'] = "Set";
    $message = "Dear" . $buyer_phone . " Your NABTEB RESULT CHECKER PIN is " . $pin . " and your Serial Number is " . $serial_number;
    $main_response = array();
    $headers = array('Content-Type: application/x-www-form-urlencoded');
    $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create';
    $arr_params = [
        'from' => 'SYNTHESIS C',
        'to' => $buyer_phone,
        'body' => $message,

        'append_sender' => 2, // Choose your Append Sender ID Option:
        //1 for none,
        // 2 for Hosted SIM Only
        // and 3 for all

        'api_token' => 'AcsZ1x1wNGgkIQieXPq54utCuRqE4NgsZUuxn04kJHYy9d58e8sr9wkTfZ8o', //Todo: Replace with your API Token

        'dnd' => 4, //Choose your preferred DND Management Option:
        // 1 for Get a refund,
        // 2 for Direct hosted SIM,
        // 3 for Hosted SIM Only,
        // 4 for Dual-Backup and
        // 5 for Dual-Dispatch
    ];
    if (is_array($arr_params)) {
        $final_url_data = http_build_query($arr_params, '', '&');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $final_url_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $main_response['body'] = curl_exec($ch);
    $main_response['code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo '<script>
    window.location.href = "nabteb.php";
            </script>';
} else {
    $_SESSION['main_error'] = "set";
}
curl_close($curl);
