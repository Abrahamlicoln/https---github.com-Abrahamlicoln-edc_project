=<?php
    session_start();
    include 'database_connection.php';
    $data = $_SESSION['login_in'];
    $customer_id = $data['customer_id'];
    $reference = $_GET["succesfullypaid"];
    $email_address = $data['email_address'];
    $fullname = $data['fullname'];
    $phone_number = $data['phone_number'];
    $plan = $_SESSION['theplan'];
    $mobile = $_SESSION['mobile'];
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
            'network' => 04,
            'mobileno' => $buyer_phone,
            'dataplan' => $mobile,
        ),
        CURLOPT_HTTPHEADER => array(
            "AuthorizationToken: 5fde6b4b4744c5841f7a387bbe8d3cc6", //replace this with your authorization_token
            "cache-control: no-cache"
        ),
    ));
    $response = curl_exec($curl);
    $response = json_decode($response);
    if ($response->success == "true") {
        $insert = "INSERT INTO 9mobiledata(customer_id,subscribe_phone,plan,amount,date) VALUES('$customer_id','$buyer_phone','$plan','$amount',NOW())";
        $result = mysqli_query($connection, $insert);
        echo '<script>
    window.location.href = "success9mobile.php";
            </script>';
    } else {
        echo '<script>
    window.location.href = "error9mobile.php";
            </script>';
    }
    curl_close($curl);
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate 9 Mobile</title>
    <style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #444444;
            width: 70px;
            height: 70px;
            z-index: 999;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .center {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
    </style>

</head>

<body>
    <div id="loader" class="center"></div>

    <script>
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    "#loader").style.visibility = "visible";
            } else {
                document.querySelector(
                    "#loader").style.display = "none";
                document.querySelector(
                    "body").style.visibility = "visible";
            }
        };
    </script>

</body>

</html>