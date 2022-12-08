<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://easyaccess.com.ng/api/wallet_balance.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "AuthorizationToken: 5fde6b4b4744c5841f7a387bbe8d3cc6", //replace this with your authorization_token
        "cache-control: no-cache"
    ),
));
$response = curl_exec($curl);
$response = json_decode($response);
$walletbalance = $response->balance;
curl_close($curl);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
    <title>Check Balance</title>
</head>

<body style="background-color:#5D50A4;">
    <div class="row">
        <div class="col" style="margin-top:260px;">
            <center>
                <h2 style="color:#A1A2D0;">Total Wallet Balance</h2>
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <center>
                <h1 class="text-white fw-bolder" style="font-size:100px;">&#8358;<?php echo number_format($walletbalance); ?></h1>
            </center>
        </div>
    </div>
</body>
<!-- MDB -->
<script type=" text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js">
</script>

</html>