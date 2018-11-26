<section class="main-slider">
    <div class="slider">
        <ul class="header-slider">

            <?php foreach ($this->slider as $value) { ?>
                <li>
                    <div class="slider-text">
                        <h1><?php echo $value['title']; ?></h1>
                        <p><?php echo $value['text']; ?></p>
                    </div>
                    <span><img src="<?php echo Config::get('slider.upload_path') . $value['picture']; ?>" alt=""></span>
                </li>
            <?php } ?>
        </ul>
    </div>
</section>


<section class="margin-bottom-30 margin-top-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="welcome">
                    <?php echo $this->home_block_1; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<hr>
<!-- /. Welcome end ./-->
<section id="paralax" class="margin-bottom-30 margin-top-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 home-block-2">
                <?php echo $this->home_block_2; ?>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>
<hr>

<section class="margin-bottom-30 margin-top-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class="main-title">Szolgáltatások</h2>
                <h4 class="sub-title"><?php echo $this->home_szolgaltatasok; ?></h4>
            </div>
        </div>
        <div class="gallery">
            <div class="row">
                <?php foreach ($this->szolgaltatas_kategoriak as $value) { ?>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <ul class="pro-box">
                            <li class="pro">
                                <div class="block-image"> 
                                    <img class="img-responsive" src="<?php echo Config::get('szolgaltatascategoryphoto.upload_path') . $value['szolgaltatas_list_photo']; ?>" alt="<?php echo $value['szolgaltatas_list_name']; ?>">
                                    <div class="img-overlay-3-up pat-override"></div>
                                    <div class="img-overlay-3-down pat-override"></div>
                                    <ol class="static-style">
                                        <li class="white-rounded"><a href="szolgaltatasok/kategoria/<?php echo Util::string_to_slug($value['szolgaltatas_list_name']); ?>"><i class="fa fa-link"></i></a> </li>
                                    </ol>
                                </div>
                            <li><h4><a href="szolgaltatasok/kategoria/<?php echo Util::string_to_slug($value['szolgaltatas_list_name']); ?>"><?php echo $value['szolgaltatas_list_name']; ?></a></li>
                        </ul>
                    </div>
                <?php } ?>

            </div>
            <!-- /.Products row end ./-->
        </div>
    </div>
</section>

<div class="clearfix"></div>
<hr>




<!-- About Logos Start -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <div class="partner-logos" >
                <h2 class="main-title">Csapatunk</h2>

                <ul class="logo-slider" id="equalheight-home">
                    <?php foreach ($this->crew_members as $value) { ?>
                            <li>
                                <ul class="pro-box" id="crew-block">
                                    <li class="pro">
                                        <div class="block-image"> <img class="img-responsive" src="<?php echo $value['crew_member_photo']; ?>" alt="">
                                            <div class="img-overlay-3-up pat-override"></div>
                                            <div class="img-overlay-3-down pat-override"></div>
                                            <ol class="static-style">
                                                <li class="white-rounded"><a href="munkatars/<?php echo Util::string_to_slug($value['crew_member_name']) . '/' . $value['crew_member_id']; ?>"><i class="fa fa-link"></i></a> </li>
                                            </ol>
                                        </div>
                                    <li>
                                        <h4><a href="munkatars/<?php echo Util::string_to_slug($value['crew_member_name']) . '/' . $value['crew_member_id']; ?>"><?php echo $value['crew_member_name']; ?></a></h4>
                                    </li>
                                    <li><?php echo $value['crew_member_category_name']; ?></li>
                                </ul>
                            </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- About Logos End --> 






<div class="gap-50"></div>




<section id="paralax">
    <div class="container">
        <?php echo $this->home_block_3; ?>
    </div>
</section>
<!-- /. More Services End ./-->

<section class="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6"><strong>Miért minket válasszon?</strong>

                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" href="#collapseOne"><?php echo $this->home_accordion1_cim; ?></a></h4>
                        </div>

                        <div class="panel-collapse collapse in" id="collapseOne">
                            <div class="panel-body"><?php echo $this->home_accordion1_szoveg; ?></div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo"><?php echo $this->home_accordion2_cim; ?></a></h4>
                        </div>

                        <div class="panel-collapse collapse" id="collapseTwo">
                            <div class="panel-body"><?php echo $this->home_accordion2_szoveg; ?></div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseThree"><?php echo $this->home_accordion3_cim; ?></a></h4>
                        </div>

                        <div class="panel-collapse collapse" id="collapseThree">
                            <div class="panel-body"><?php echo $this->home_accordion3_szoveg; ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6"><strong>Bemutatkozó videó</strong><iframe allowfullscreen="" frameborder="0" height="315" src="https://www.youtube.com/embed/KpXjDyPbA-U" width="560"></iframe></div>
        </div>
    </div>
</section>


<section class="quote-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="quote-slider">

                    <?php foreach ($this->nagy_atalakulasok as $value) { ?>
                        <li>
                            <div class="col-lg-9">
                                <p><i class="fa fa-quote-left"></i><?php echo Util::substr_word($value['photo_text'], 250) . '...'; ?></p>
                                <h4><?php echo $value['photo_caption']; ?></h4>
                            </div>
                            <div class="col-lg-3"><img alt="" src="<?php echo $value['photo_filename_1']; ?>" /></div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    (function (e, a) {
        var t, r = e.getElementsByTagName("head")[0], c = e.location.protocol;
        t = e.createElement("script");
        t.type = "text/javascript";
        t.charset = "utf-8";
        t.async = !0;
        t.defer = !0;
        t.src = c + "//front.optimonk.com/public/" + a + "/js/preload.js";
        r.appendChild(t);
    })(document, "7176");
</script>


