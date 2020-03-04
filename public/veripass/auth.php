<?php

function timeBasedHash($arg, $hexSalt, $offsetMinutes = 0)
{
    $salt = hex2bin($hexSalt);
    $utcWholeMinute = mktime(date("H"), date("i") + $offsetMinutes, 0);
    $utc = pack("V", 0) . pack("N", $utcWholeMinute);
    $input = $salt . $utc . $arg;
    return strtoupper(hash('sha256', $input));
}

function signURL($apiKey, $apiSalt, $url)
{
    $path = parse_url($url, PHP_URL_PATH);
    $signature = $apiKey . ":" . timeBasedHash($path, $apiSalt);
    return $url . "&signature=" . urlencode($signature);
}

function verifySignature($apiSalt, $requestSig, $responseSig)
{
    return (timeBasedHash($requestSig, $apiSalt, 0) == $responseSig)
        || (timeBasedHash($requestSig, $apiSalt, -1) == $responseSig)
        || (timeBasedHash($requestSig, $apiSalt, +1) == $responseSig);
}

function verifyResponse($apiKey, $apiSalt, $url, $responseJson)
{
    $requestSig = urlSignature($apiKey, $apiSalt, $url);
    $responseSig = $responseJson->{'server-signature'};
    return verifySignature($apiSalt, $requestSig, $responseSig);
}


function http($ch)
{
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    try {
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception("httpGet error: " . curl_errno($ch) . ",  " . curl_error($ch));
            error_log("httpGet error: " . curl_errno($ch) . ",  " . curl_error($ch));
        } else {
            $info = curl_getinfo($ch);
            error_log($info['http_code'] . ' ' . $info['url']);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $data = substr($response, $header_size);
            if (strpos($header, 'Content-Encoding: gzip') !== false) {
                $data = gzdecode($data);
            }
            if ($info['http_code'] != 200) {
                throw new Exception($data);
            }
        }

        return $data;;
    } finally {
        curl_close($ch);
    }
}

function httpGet($url, $authorization = null)
{
    $header = array(
        'Authorization: ' . $authorization,
        'Accept: application/json');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    return http($ch);
}

function httpPost($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    return http($ch);
}

function httpPostJson($url, $json, $authorization = null)
{
    $header = array(
        'Authorization: ' . $authorization,
        'Content-Type: application/json',
        'Accept: application/json');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_URL, $url);
    return http($ch);
}
