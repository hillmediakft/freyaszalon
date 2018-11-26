<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="akciok"> Akciók, újdonságok</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- /.inner title Start ./-->
<div class="gap"></div>



<!-- Content 
================================================== -->

<section class="services-details margin-bottom-30">
    <div class="container">
        <div class="row">
            <!-- Left Content -->
            <div class="col-md-9">

                <div class="row">

                    <div class="col-md-5 margin-top-20">
                        <img class="img-responsive" src="<?php echo $this->promotion['picture'] ?>" alt="<?php echo $this->promotion['title'] ?>" />
                    </div>
                    <div class="col-md-7">

                        <h1><?php echo $this->promotion['title']; ?></h1>

                        <div class="margin-bottom-30">
                            <span><time><i class="fa fa-calendar"></i> <?php echo $this->promotion['created'] ?></time> | </span> 
                            <span><i class="fa fa-eye"></i> <?php echo $this->promotion['clicks'] ?></span>
                        </div>
                        <div class="margin-bottom-30">
                            <?php echo $this->promotion['text']; ?>
                        </div>
                        <div class="margin-bottom-30">
                            <a href="akciok">
                                <button>Vissza az akciókhoz <i class="fa fa fa-arrow-circle-o-right"></i></button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Left Content -->


            <!-- Right Content -->
            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 
            <!-- Right Content -->
        </div>
    </div>
</section>

<!-- // Content 
================================================== -->
