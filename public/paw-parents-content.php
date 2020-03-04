<section>
    <div class="spacer"></div>

    <article class="col12 section_pawparents">
        <div class="wrap-content">
            <section>
                <article class="col12 font-strong">
                    <div>
                        <section class="col12">
                            <div class="section-heading interiors text-center">
                                <img class="img-responsive" src="assets/images/paw-parents.png" style="margin: 0 auto;" alt="PAW Parents">
                                <p>PAW Parents is PAW Patrol's official newsletter and your #1 source for official PAW Patrol news! Stay up to date on amazing PAW Patrol tours, get amazing downloadable activities for your little ones and be the first to hear about upcoming PAW Patrol coupons and sales!</p>
                            </div>
                        </section>
                    </div>

                    <div class="clearfix"></div><br>

                    <h3 class="text-center">Why Join?</h3>
                    <div>
                        <section class="col4">
                            <div class="feature-box">
                                <div class="col3 text-center">
                                    <div class="icon-parents" style="background: url('assets/images/icons/icon_parents_question.jpg') center center; background-size: 100%;"></div>
                                </div>

                                <div class="col9 text-left">
                                    <div class="feature-text">
                                        <h3>Secret Sales</h3>
                                        Get access to Secret sales, special offers, giveaways and more!
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </section>

                        <section class="col4">
                            <div class="feature-box">
                                <div class="col3 text-center">
                                    <div class="icon-parents" style="background: url('assets/images/icons/icon_parents_tour.jpg') center center; background-size: 100%;"></div>
                                </div>
                                <div class="col9 text-left">
                                    <div class="feature-text">
                                        <h3>Event Info</h3>
                                        Get the latest news on PAW Patrol Tours and Events!
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </section>

                        <section class="col4">
                            <div class="feature-box">
                                <div class="col3 text-center">
                                    <div class="icon-parents" style="background: url('assets/images/icons/icon_parents_mail.jpg') center center; background-size: 100%;"></div>
                                </div>
                                <div class="col9 text-left">
                                    <div class="feature-text">
                                        <h3>Amazing Activities</h3>
                                        Get fun PAW Patrol activities delivered right your email.
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </section>
                    </div>

                    <div class="spacer-md"></div>

                    <div class="btn-strong" id="join-mom-patrol">
                        Join PAW Parents
                    </div>
                    <?php if (isset($_GET['signup']) || isset($_SESSION['step'])) { ?>
                        <script>
                            $(document).ready(function () {
                                $('#mompatrol').css('display', 'block');
                            });
                        </script>
                    <?php } ?>
                </article>
            </section>

            <section>
                <article class="col12">
                    <div id="mompatrol">
                        <div class="success">
                            <h3>Thank You for Registering.</h3>
                            <p>Please check your E-mail to confirm your registration.</p>
                            <img src="assets/images/success.png">
                        </div>

                        <!-- Begin MailChimp Signup Form -->
                        <div id="mc_embed_signup">
                            <?php
                            if (array_key_exists("vpr-demo", $_GET)) {
                                include "vpr-demo.php";
                            } else  if (array_key_exists('online', $_SESSION) && ($_SESSION['online'] == true)) {
                                include "continue.php";
                            } else if ($_SESSION["signup"] == "under13") {
                                include "child.php";
                            } else {
                                include "start.php";
                            }
                            ?>
                        </div>
                        <!--End mc_embed_signup-->
                    </div>
                </article>
            </section>
        </div>
    </article>

    <div class="spacer-md"></div>

</section>