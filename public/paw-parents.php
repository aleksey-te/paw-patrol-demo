<?php

require("veripass/auth.php");
require("veripass/credentials.php");

if (isset($_GET['sign'])) {
    echo signURL($apiKey, $apiSalt, urldecode($_GET['sign']));
    exit(0);
}

session_start();
if (array_key_exists("signup", $_GET) && $_GET["signup"] == "cancel") {
    session_destroy();
    // TODO
    // replace for windows/linus
    // windows header('Location: /public');
    // linux header('Location: /');
    header('Location: /');
    exit;
}

if (array_key_exists('veripass-token', $_POST)) {
    $_SESSION['veripass-token'] = $_POST['veripass-token'];
}

if (array_key_exists('veripass-token', $_SESSION)) {
    $url = "$ht://$server/v2/p/consent?token={$_SESSION['veripass-token']}";
    try {
        $signedUrl = signURL($apiKey, $apiSalt, $url);
        $response = httpGet($signedUrl);
        $cr = json_decode($response);
        $_SESSION['veripass-receipt']=$cr;
        $_SESSION['ts'] = $cr->{"updatedUTC"} / 1000;
        $_SESSION['status'] = $cr->{"status"};
        $_SESSION['verification'] = $cr->{"verification"};
        if ($_SESSION['status'] == "APPROVED") {
            $_SESSION['online'] = true;
        } else {
            $_SESSION['online'] = false;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if (array_key_exists('status', $_GET)) {
    header("Content-Type: text/plain");
    echo (($_GET["status"] == $_SESSION['status'].$_SESSION['verification']) ? "unchanged" : "changed");
    exit;
}


if (array_key_exists("signup", $_GET)) {
    $_SESSION['step'] = 1;
    $_SESSION["signup"] = $_GET["signup"];
    if ($_POST['step'] == 1) {
        $_SESSION['username'] = $_POST["username"];
        $_SESSION['step'] = 2;
    } else if ($_SESSION['status']) {
        $_SESSION['step'] = 3;
    }
}

?><!DOCTYPE html>
<html>
<?php include "head.php"; ?>
<body>
    <?php include "fa-header.php"; ?>
    <main class="body-content" id="main-content">
        <?php include 'paw-parents-content.php'; ?>
    </main>
    <?php include "fa-footer.php"; ?>
</body>
</html>

