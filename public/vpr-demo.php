<div class="content negative-space clearfix">
    <?php
    if (array_key_exists('age', $_POST)) {?>
        <h3>VPR Token Parameters</h3>
        <ul>
            <li>age = <b><?php echo $_POST['age']?></b></li>
            <li>verified = <b><?php echo $_POST['verified']?></b></li>
            <li>freshness = <b><?php echo gmdate("M d Y H:i:s", $_POST['utc'] / 1000);?></b></li>
            <li></li>
        </ul>
        <br/>
        <h3>Custom Parmeters</h3>
        <ul>
            <li>device MAC = <b><?php echo $_GET['device_mac']?></b></li>
        </ul>
    <?php } else { ?>
        <iframe frameBorder="0" width="360px" height="400px"
            src="<?php echo $ht . "://" . $ini['vprServer'] . signURL($apiKey, $apiSalt, "/v2/p/vpr/iframe?ttl=60&return=" . urlencode("//{$_SERVER['HTTP_HOST']}?vpr-demo&device_mac=00:0a:95:9d:68:16")) ?>"></iframe>
    <?php } ?>

</div>