<?php
$key = "";
$secret = "";

$host = "https://api.kucoin.com";
$params = array();

// ENDPOINT
$endpoint = "/v1/KCS-BTC/order"; //

// NONCE
$mt = explode(' ', microtime());
$nonce = $mt[1].substr($mt[0], 2, 3);

// QUERY
$query = "amount=10&price=0.000000001&type=BUY";

$auth = $endpoint . "/" . $nonce . "/" . $query;
$hmac = hash_hmac('sha256', base64_encode($auth), $secret);

$headers = array(
  "Content-Type:application/json;charset=UTF-8",
  "KC-API-KEY: $key",
  "KC-API-NONCE: $nonce",
  "KC-API-SIGNATURE: $hmac"
);


$url = $host . $endpoint. '?'. $query;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url)
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; KuCoin API PHP client; '.php_uname('s').'; PHP/'.phpversion().')');
curl_setopt($ch, CURLOPT_ENCODING , '');
$res = curl_exec($ch);

var_dump($res);
