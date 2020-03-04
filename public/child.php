<div class="content negative-space clearfix">

        <?php if (array_key_exists('step', $_SESSION) && ($_SESSION['step'] == 1)) { ?>
            <form id="main_form" class="form form_small" method="post">
                <input type="hidden" name="step" value="1"/>
                <div class="clearfix form-group">
                    <div class="left-col">
                        <div class="form-header">
                            <h3 class="form-title">Sign Up</h3>
                            <p class="form-subtitle">Set up your account!</p>
                        </div>
                    </div>
                    <div class="right-col">
                        <div class="form-group">
                            <label for="">Chose your Username</label>
                            <input type="text" name="username" placeholder="Ben" class="form-control"
                                   value="<?php echo $_SESSION['username'] ?>">
                        </div>
                    </div>
                </div>
                <!--<div class="form-group col3">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" class="form-control"
                           value="<?php /*echo $_SESSION['password'] */?>">
                </div>
                <div class="form-group col3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_repeat" placeholder="••••••••" class="form-control"
                           value="<?php /*echo $_SESSION['password_repeat'] */?>">
                </div>-->
                <div class="clearfix">
                    <ul class="error">
                        <?php

                        if (in_array("username", $_POST) && !$_POST['username']) {
                            $error .= "<li>Username is a required field.</li>";
                        }
                        ?>
                    </ul>
                </div>
                <hr>
                <div class="clearfix">
                    <div class="form-group form-group_between">

                        <a href="?signup=cancel" class="btn-small btn-inline">Cancel</a>
                        <button type="submit" class="btn-small btn-inline btn-green">Continue</button>
                    </div>
                </div>
            </form>
        <?php } ?>


        <?php if (array_key_exists('step', $_SESSION) && ($_SESSION['step'] == 2)) { ?>
            <div class="form form_center clearfix">
                <div class="form-content">
                    <div class="form-header">
                        <h1 class="form-title">One Last Thing</h1>
                        <p class="form-subtitle">We need your parent’s consent before we let you in. <br>
                            Just follow the instructions below</p>
                    </div>
                    <iframe
                            frameBorder="0"
                            width="360px"
                            height="400px"
                            src="<?php echo $ht . "://" . $ini['apiServerJS'] . signURL($apiKey, $apiSalt, "/v2/p/iframe?ttl=600&service=demo&username={$_SESSION['username']}&return=" . urlencode("//{$_SERVER['HTTP_HOST']}/paw-parents.php?signup=under13")) ?>"></iframe>
                </div>
            </div>
        <?php } ?>


        <?php if (array_key_exists('step', $_SESSION) && ($_SESSION['step'] == 3)) { ?>
            <script>
                var xmlHttp = new XMLHttpRequest();
                var x = function () {
                    xmlHttp.onreadystatechange = function () {
                        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                            if (xmlHttp.responseText == "unchanged") {
                                setTimeout(x, 2000);
                            } else {
                                window.location = "/";
                            }
                        }
                    }
                    xmlHttp.open("GET", "?status=<?php echo $_SESSION['status'].$_SESSION['verification'];?>", true);
                    xmlHttp.send(null);
                }
                x();

            </script>

            <div class="form clearfix">
                <div class="left-col">
                    <?php if ($_SESSION['status'] == "PENDING") { ?>
                        <h1>Almost there!</h1>
                        <p>
                            Waiting for your parents consent to use the Paw Patrol Demo Web App.
                            <br/><br/>
                            Do not close this window!
                        </p>
                    <?php } ?>
                    <?php if ($_SESSION['status'] == "REJECTED") { ?>
                        <h1>Sorry!</h1>
                        <p>
                            Your parents didn't give consent this time so we can't let you in.
                        </p>
                    <?php } ?>
                    <?php if ($_SESSION['status'] == "APPROVED") { ?>
                        <h1>Yay, you’re allowed!</h1>
                        <p>
                            You’ll be in in just a few seconds. If nothing happens,
                            <a href="TODO:">click here</a>.
                        </p>
                    <?php } ?>
                </div>
                <div class="right-col">
                    <div class="veripass-process-wrapper">
                        <?php if ($_SESSION['status'] == "PENDING") { ?>
                            <div class="lds-ellipsis">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['status'] == "REJECTED") { ?>
                            <img src="./assets/images/face-frown.svg" />
                        <?php } ?>
                        <?php if ($_SESSION['status'] == "APPROVED") { ?>
                            <img src="./assets/images/face-smile.svg" />
                        <?php } ?>
                    </div>
                    <form style="display: none">
                        Username: <b><?php echo $_SESSION['username']; ?></b>
                        <?php if ($_SESSION['status']) { ?>
                            <div class="consent-request-status">
                                <sup><?php echo $_SESSION['veripass-receipt'] -> {'token'}?></sup>
                                <?php
                                echo "<em>" . (date('D, d M Y H:i:s', $_SESSION['ts'])) . "</em><br/>";
                                echo "Parent Confirmation: <em>{$_SESSION['status']}</em><br/>";
                                echo "Verification Status: <em>{$_SESSION['verification']}</em><br/>";
                                ?>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
            <hr/>
            <a href="?signup=cancel" class="btn-small btn-inline">Cancel</a>
        <?php } ?>


        <!-- <a class="btn btn-veripass lgmax" href="javascript:checkConsent(true);" title="-->
        <?php //echo $server; ?>
        <!--">Request Parental-->
        <!-- Consent <span class="arrow">&#9658;</span></a>-->

</div>