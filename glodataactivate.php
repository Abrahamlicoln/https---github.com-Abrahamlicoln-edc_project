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
    $email_address = $data['email_address'];
    $fullname = $data['fullname'];
    $phone_number = $data['phone_number'];
    $plan = $_SESSION['theplan'];
    $glo = $_SESSION['glo'];
    $amount = $_SESSION['amount'];
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
            'network' => 02,
            'mobileno' => $buyer_phone,
            'dataplan' => $glo,
        ),
        CURLOPT_HTTPHEADER => array(
            "AuthorizationToken: 5fde6b4b4744c5841f7a387bbe8d3cc6", //replace this with your authorization_token
            "cache-control: no-cache"
        ),
    ));
    $response = curl_exec($curl);
    $response = json_decode($response);
    if ($response->success == "true") {
        $insert = "INSERT INTO glodata(customer_id,subscribe_phone,plan,amount,date) VALUES('$customer_id','$buyer_phone','$plan','$amount',NOW())";
        $result = mysqli_query($connection, $insert);
        //     echo '<script>
        // window.location.href = "successglo.php";
        //         </script>';
    } else {
        //     echo '<script>
        // window.location.href = "errorglo.php";
        //         </script>';
    }
    curl_close($curl);
}
