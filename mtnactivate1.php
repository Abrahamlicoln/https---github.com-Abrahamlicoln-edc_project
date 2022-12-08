<?php
session_start();
include 'database_connection.php';
$data = $_SESSION['login_in'];
$customer_id = $data['customer_id'];
$email_address = $data['email_address'];
$fullname = $data['fullname'];
$phone_number = $data['phone_number'];
$plan = $_SESSION['theplan'];
$mtn = $_SESSION['mtn'];
$amount = $_SESSION['new_amount'];
$buyer_phone = $_SESSION['buyer_phone'];

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://easyaccess.com.ng/api/data.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array(
        'network' => 01,
        'mobileno' => $buyer_phone,
        'dataplan' => $mtn,
    ),
    CURLOPT_HTTPHEADER => array(
        "AuthorizationToken: 5fde6b4b4744c5841f7a387bbe8d3cc6", //replace this with your authorization_token
        "cache-control: no-cache"
    ),
));

$select = "SELECT * FROM customer_wallet WHERE customer_id='" . $data['customer_id'] . "'";
$result = mysqli_query($connection, $select);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $wallet_balance = $row['wallet_balance'];
        if ($wallet_balance < $amount) {
            echo "Less Than";
        } else {
            $response = curl_exec($curl);
            $response = json_decode($response);
            if ($response->success == "true") {
                $insert = "INSERT INTO mtndata(customer_id,subscribe_phone,plan,amount,date) VALUES('$customer_id','$buyer_phone','$plan','$amount',NOW())";
                $result = mysqli_query($connection, $insert);
                $select = "SELECT * FROM customer_wallet WHERE customer_id='" . $data['customer_id'] . "'";
                $result = mysqli_query($connection, $select);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $wallet_balance = $row['wallet_balance'];
                        if ($wallet_balance >= $amount) {
                            $new_amount = $wallet_balance - $amount;
                            $update = "UPDATE customer_wallet SET wallet_balance = '$new_amount' WHERE customer_id='" . $data['customer_id'] . "'";
                            $result = mysqli_query($connection, $update);
                            echo "Success";
                        }
                    }
                }
            } else {
                echo "error";
            }
            curl_close($curl);
        }
    }
}
