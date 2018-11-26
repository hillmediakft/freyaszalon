<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="csapatunk"> Csapatunk</a></li>
                        <li><a href="javascript:void();"> <?php echo $this->colleague['crew_member_name']; ?></a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- /.inner title Start ./-->
<div class="gap"></div>


<!-- // Banner Section
================================= --> 

<section class="services-details margin-bottom-30">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-lg-4 team2">
                        <img src="<?php echo $this->colleague['crew_member_photo']; ?>" alt="<?php echo $this->colleague['crew_member_name']; ?>">
                    </div>

                    <div class="col-lg-8"> 
                        <h1> <?php echo $this->colleague['crew_member_name']; ?></h1>
                        <h4><?php echo $this->colleague['crew_member_title']; ?></h4>
                        <?php echo $this->colleague['crew_member_info']; ?>
                    </div>

                </div>
                <div class="gap-20"></div>                
            </div>
            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 

        </div>
    </div>
</section>



