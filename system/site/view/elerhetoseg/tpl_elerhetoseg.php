<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="elerhetoseg"> Elérhetőségeink</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- /.inner title Start ./-->
<div class="gap"></div>



<section class="services-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="contact-details contact">
                            <?php echo $this->content; ?>


                            <hr />
                            <address>
                                <ul>
                                    <li><strong class="title"><i class="fa fa-home"></i> <?php echo $this->settings['ceg']; ?></strong></li>
                                    <li><strong class="title"><i class="fa fa-map-marker"></i> <?php echo $this->settings['cim']; ?></strong></li>
                                    <li><strong class="title"><i class="fa fa-mobile"></i> <?php echo Util::call_us($this->settings['tel'], $icon = false, $buton = false) . ' | ' . Util::call_us($this->settings['tel2'], $icon = false, $buton = false);?></strong></li>
                                    <li><strong class="title"><i class="fa fa-envelope"></i> <?php echo $this->settings['email']; ?></strong></li>
                                </ul>

                                <hr />
                                <ul>
                                    <li><strong class="title"><i class="fa fa-calendar"></i> Nyitva tartás:</strong></li>
                                    <li><strong class="title"><i class="fa fa-clock-o"></i> <?php echo $this->nyitva_tartas; ?></strong></li>
                                </ul>
                            </address>                            



                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="contact register signup">
                            <h2>Küldjön üzenetet</h2>

                            <div id="email_message"></div>   

                            <form method="post" action="send_email/init/contact" id="contact_form">
                                <div class="form-group">
                                    <label>Név*</label>
                                    <input type="text" class="form-control" placeholder="Teljes név" name="name">
                                </div>
                                <div class="form-group">
                                    <label>E-mail cím*</label>
                                    <input type="text" class="form-control" placeholder="E-mail cím" name="email">
                                </div>
                                <input type="text" name="mezes_bodon" id="mezes_bodon">

                                <div class="form-group">
                                    <label>Üzenet*</label>
                                    <textarea name="message" rows="4"></textarea>
                                </div>
								  <button type="submit" name="submit_contact_email" id="submit-button"> Küldés </button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="google-map">
                    <div id="map"></div>
                </div>
            </div>
            <!-- /.details End ./--> 
            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 
        </div>
    </div>
</section>
<!-- /.Services End ./-->
<div class="gap"></div>




