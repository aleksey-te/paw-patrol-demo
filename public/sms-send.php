<?php
exit(1);
if (!isset($_GET['key'])) return;

require('veripass/auth.php');

define("mxtHost", "api.smsglobal.com");
define("mxtPort", "443");
define("mxtProtocol", "https");

define("key", $_GET['key']);
define("secret", $_GET['secret']);

header("Content-Type: application/json");

if (isset($_GET['number'])) {
    $schedule = date("Y-m-d H:m:s");
    //\"scheduledDateTime\": \"$schedule\",
    $body = "{
        \"destination\": \"${_GET['number']}\",
        \"message\": \"Hello! (Just Testing.. looks good though :)\",
        \"origin\": \"Veripass UK\",
        \"sharedPool\": null
    }";
    echo mxtPost("/v2/sms/", $body);
    return;
}

echo mxtGet("/v2/sms/");

function mxtAuth($method, $uri) {
    $time = time();
    $nonce = substr(md5($time),1,8);
    $input = "$time\n$nonce\n$method\n$uri\n". mxtHost ."\n" . mxtPort. "\n\n";
    $hash = hex2bin(hash_hmac('sha256', $input, secret));
    $base64hash = base64_encode($hash);
    return "MAC id=\"" . key . "\", ts=\"$time\", nonce=\"$nonce\", mac=\"$base64hash\"";
}

function mxtGet($uri) {
    $url = mxtProtocol . "://" . mxtHost . $uri;
    $auth = mxtAuth("GET", $uri);
    //echo $url . "  " . $auth;
    return httpGet($url, $auth);
}

function mxtPost($uri, $json) {
    $url = mxtProtocol . "://" . mxtHost . $uri;
    $auth = mxtAuth("POST", $uri);
    return httpPostJson($url, $json, $auth);
}
