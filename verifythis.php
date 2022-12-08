<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "lookup.php",
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
