<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="szolgaltatasok"> szolgáltatások</a></li>
                        <li><a href="javascript:void();"> <?php echo $this->szolgaltatas['szolgaltatas_list_name']; ?></a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- /.inner title Start ./-->
<div class="gap"></div>

<!-- /.Services Start ./-->

<!-- // Banner Section
================================= --> 
<section class="services-details margin-bottom-30">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <!-- /.details ./-->
                    <div class="col-lg-7"> 
                        <h1> <?php echo $this->szolgaltatas['szolgaltatas_title']; ?></h1>
                        <h4><?php echo $this->szolgaltatas['szolgaltatas_info']; ?></h4>
                        <div class="gap-20"></div>  

                        <div class="">
                            <?php foreach ($this->munkatars as $munkatars) : ?>
                                <div class="crew-member-box">    
                                     <div class="col-md-3">
                                        <img src="<?php echo $munkatars['crew_member_photo']; ?>" alt="<?php echo $munkatars['crew_member_name']; ?>" title="<?php echo $munkatars['crew_member_name']; ?>">
                                    </div>
                                    <div class="col-md-9">
                                        <h4><?php echo $munkatars['crew_member_name']; ?></h4>
                                        <span><?php echo $munkatars['crew_member_title']; ?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>                        

                    </div>
                    <div class="col-lg-5">
                        <img class="margin-top-20" src="<?php echo Config::get('szolgaltatasphoto.upload_path') . $this->szolgaltatas['szolgaltatas_photo']; ?>" alt="<?php echo $this->szolgaltatas['szolgaltatas_title']; ?>">
                    </div>
                </div>

                <hr>
                <?php echo $this->szolgaltatas['szolgaltatas_description']; ?>

                <?php // echo $this->call_to_action; ?>   
<!-- Kapcsolódó képek -->
                <?php require('system/site/view/szolgaltatasok/tpl_call_to_action.php'); ?>   
                <!-- Kapcsolódó képek -->
                <?php require('system/site/view/_template/tpl_kapcsolodo_kepek.php'); ?>    

                <!-- Kapcsolódó szolgáltatások - szolgáltatások a kategóriában -->
                <?php require('system/site/view/szolgaltatasok/tpl_kapcsolodo_szolgaltatasok.php'); ?> 

            </div>
            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 

        </div>
    </div>
</section>
  <?php require('system/site/view/szolgaltatasok/tpl_email_modal.php'); ?> 