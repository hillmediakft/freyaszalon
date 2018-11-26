<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="javascript:void()"> Feliratkozás</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Banner Section
================================= -->    
<div class="gap"></div>
<!-- /.Services Start ./-->
<section class="services-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    <div id="message">
                        <?php $this->renderFeedbackMessages(); ?>
                    </div>
                    <div class="col-lg-5"><img src="<?php echo SITE_IMAGE ?>newsletter.jpg" alt=""></div>
                    <!-- /.details ./-->
                    <div class="col-lg-7"> 
                        <!-- /. sign up ./ -->
                        <div class="register signup">
                            <strong class="title"><i class="fa fa-envelope"></i> Hírlevél feliratkozás</strong>
                            <p>Iratkozzon fel hírlevelünkre, hogy késedelem nélkül értesülhessen akcióinkról!</p>
                            <form id="signup_form" action="" method="post" novalidate="novalidate">
                                <label>Név *</label>
                                <input class="required" type="text" placeholder="Teljes név" name="name">
                                <label>E-mail cím*</label>
                                <input class="required email" type="text" placeholder="E-mail" name="email">
                                <input type="submit" name="register_newsletter" value="Feliratkozok">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 

        </div>
    </div>
</section>
<!-- /.Services End ./-->
<div class="gap"></div>