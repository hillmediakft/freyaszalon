<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="szolgaltatasok"> szolgáltatások</a></li>
                        <li><a href="javascript:void();"> <?php echo $this->szolgaltatas_kategoria_name; ?></a></li>
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
                        <div class="pro-title margin-bottom-30">
                            <h1><?php echo $this->szolgaltatas_kategoria_name; ?></h1>
                            <p><?php echo $this->szolgaltatas_kategoria_desc; ?></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                   <?php if(count($this->szolgaltatasok) > 0) : ?>
                        <?php foreach ($this->szolgaltatasok as $value) { ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 margin-bottom-20">
                                <ul class="pro-box">
                                    <li class="pro">
                                        <div class="block-image"> <img class="img-responsive" src="<?php echo Config::get('szolgaltatasphoto.upload_path') . $value['szolgaltatas_photo']; ?>" alt="<?php echo $value['szolgaltatas_list_name']; ?>">
                                            <div class="img-overlay-3-up pat-override"></div>
                                            <div class="img-overlay-3-down pat-override"></div>
                                            <ol class="static-style">
                                                <li class="white-rounded"><a href="szolgaltatasok/<?php echo Util::string_to_slug($value['szolgaltatas_list_name']) . '/' . Util::string_to_slug($value['szolgaltatas_title']); ?>"><i class="fa fa-link"></i></a> </li>
                                            </ol>
                                        </div>
                                    <li><h4><a href="szolgaltatasok/<?php echo Util::string_to_slug($value['szolgaltatas_list_name']) . '/' . Util::string_to_slug($value['szolgaltatas_title']); ?>"><?php echo $value['szolgaltatas_title']; ?></a></li>
                                </ul>
                            </div>
                        <?php } ?>
                      <?php endif ?>
					   <?php if(count($this->szolgaltatasok) == 0) : ?>
					   <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Nem találhatók szolgáltatások a kategóriában!</div>
					   <?php endif ?>
                    </div>
                    <div class="gap-20"></div>                



                </div>
                <!-- Sidebar -->
                <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 

            </div>
        </div>
</section>

