<?php if (($this->pop_up)) : ?>
    <!-- Modal -->
    <div class="modal fade" id="pop-up-window" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $this->pop_up['title']; ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->pop_up['content']; ?>
                </div>

            </div>
        </div>
    </div>
<?php endif ?>
<!-- /. Footer Start ./-->
<section id="footer">
    <section class="footer-mid">
        <div class="footer-midbg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  flickr">
                        <h3>Szolgáltatások</h3>

                        <ul class="recent-posts">
                            <?php foreach ($this->szolgaltatasok_menu as $key => $value) { ?>
                                <li><a href="szolgaltatasok/<?php echo Util::string_to_slug($key); ?>"><?php echo $key; ?></a></li>
                            <?php } ?> 
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 fposts">
                        <h3>A Freya szalonról</h3>
                        <div class="getintouch">
                            <?php echo $this->footer_text; ?>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 feeds">
                        <h3>Sikertörténetek</h3>

                        <div>

                            <ul class="tweets">

                                <?php foreach ($this->footer_nagy_atalakulasok as $value) { ?>
                                    <li>
                                         <a href="nagy-atalakulasok">
                                            <div class="col-lg-8">
                                                <h4><?php echo $value['photo_caption']; ?></h4>
                                            </div>
                                            <div class="col-lg-4"><img alt="" src="<?php echo $value['photo_filename_1']; ?>" /></div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 getintouch">
                        <h3>Kapcsolat</h3>
                        <div class="logo">
                            <a href="/"><div class="logo-home"></div></a>
                        </div>
                        <div>
                            <i class="fa fa-home fa-fw"></i> <?php echo $this->settings['ceg']; ?><br />
                            <i class="fa fa-map-marker fa-fw"></i> <?php echo $this->settings['cim']; ?><br />
                            <i class="fa fa-phone fa-fw"></i> <?php echo Util::call_us($this->settings['tel'], $icon = false, $buton = false) . ' | ' . Util::call_us($this->settings['tel2'], $icon = false, $buton = false);?><br />
                            <i class="fa fa-envelope fa-fw"></i> <?php echo Util::safe_mailto($this->settings['email']); ?><br />
                            <i class="fa fa-clock-o fa-fw"></i> <?php echo $this->settings['opening_hours']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /. Footer Copy rights ./-->

    <section class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"><strong><?php echo $this->settings['ceg']; ?></strong> © <?php echo date('Y'); ?> | <a href="http://www.onlinemarketingguru.hu/weboldal-keszites.html" target="_blank" title="OMG">weboldal készítés</a></div>
            </div>
        </div>
    </section>
</section>


