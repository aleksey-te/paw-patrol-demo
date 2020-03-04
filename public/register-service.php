<?php
require("veripass/auth.php");
require("veripass/credentials.php");

if (isset($_GET['endpoint'])) $server = $_GET['endpoint'];

date_default_timezone_set("Europe/London");

if (isset($_GET["sign"])) {
    $url = urldecode($_GET["sign"]);
    $requestSig = timeBasedHash(parse_url($url, PHP_URL_PATH), $apiSalt);
    header('Content-Type: application/json');
    echo "{ \"url\": \"$url\", \"signature\": \"" . $apiKey . ":". $requestSig . "\" }";
} else if (isset($_GET['verify'])) {
    //header('Content-Type: application/json');
    $requestSig = $_GET['request'];
    $responseSig = $_GET['verify'];
    echo verifySignature($apiSalt, $requestSig, $responseSig) ? "true" : "false";
} else {
    $url = "$server/v1/p/register/content";
    $signedUrl = signURL($apiKey, $apiSalt, $url);
    $json = <<<EOT
{
    "service": "$service",
    "consentType": "ACCESS",
    "consentAge": 13,
    "description": "${urlencode($description)}",
    "infoUrl": "https://thefa.com",
    "iconUrl": "https://cdn.thefa.com/thefawebsite/assets/images/the-fa-logo.svg"
}
EOT;
    header('Content-Type: application/json');
    echo httpPostJson($url, $json);
}