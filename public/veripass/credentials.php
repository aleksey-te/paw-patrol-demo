<?php

$ini = parse_ini_file("../credentials.ini");

if ($_SERVER['HTTP_HOST'] == "localhost:8053") {
    $ini['apiServer'] = "host.docker.internal:8882";
    $ini['apiServerJS'] = "local-api.veripass.uk:8882";
    $ini['vprServer'] = "local-api.veripass.uk:8883";
    $ini['ssl'] = "disabled";
} else if ($_SERVER['HTTP_HOST'] == "fa-demo.veripass.uk") {
    $ini['apiServer'] = "api.veripass.uk";
    $ini['apiServerJS'] = $ini['apiServer'];
    $ini['vprServer'] = $ini['apiServerJS'];
    $ini['ssl'] = "enabled";
} else if ($_SERVER['HTTP_HOST'] == "demo.site") {
    $ini['apiServer'] = "api.veripass.uk";
    $ini['apiServerJS'] = $ini['apiServer'];
    $ini['vprServer'] = $ini['apiServerJS'];
    $ini['ssl'] = "enabled";
}

$server = $ini['apiServer'];
$apiKey = $ini['apiKey'];
$apiSalt = $ini['apiSalt'];
$service = "demo";
$description = "FA Demo";
$ws = $ini['ssl']=="enabled" ? "wss" : "ws";
$ht = $ini['ssl']=="enabled" ? "https" : "http";

?>