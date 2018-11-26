<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="javascript:void();"> szolgáltatások</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- /.inner title Start ./-->
<div class="gap"></div>

<!-- /.Services Start ./-->

<section class="services-details margin-bottom-30">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                    <div class="pro-title">
                        <h1>Szolgáltatások</h1>

                    </div>
                    </div>
                    
                <?php foreach ($this->szolgaltatas_kategoriak as $value) { ?>
                    <div class="col-lg-4 col-md-4 col-sm-3 margin-bottom-20">
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
                <div class="gap-20"></div>                



            </div>
            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 

        </div>
    </div>
</section>


