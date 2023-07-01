<?php

$trackNumber = $_POST['trackNumber'];

// var_dump($trackNumber);

$obj = new stdClass();
$obj->PageSize = 1000;
$obj->TrackingNumbers = [$trackNumber];
$obj->IncludeHistory = true;
$data = json_encode($obj);

$url = "https://techtms.io/api/v2/trackings/get";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers = array(
    "Accept: application/json",
    "Content-type: application/json",
    "x-account-key: 0124",
    "x-api-key: a24b7d3e-33cb-4e95-9e4b-19d95de04b6a",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);

echo $resp;
?>