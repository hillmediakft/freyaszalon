<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="javascript:void()"> Nagy átalakulások</a></li>
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
            <div class="col-md-9">

                <div class="row"> 
                    <div class="panel panel-body marbot30">
                        <?php echo $this->content; ?>
                        <?php echo $this->call_to_action; ?>                      
                    </div>
                </div>

                <?php foreach ($this->nagy_atalakulasok as $value) : ?>
                    <div class="margin-bottom-20">   
                        <div class="row">        
                            <div class="col-md-4">
                                <img src="<?php echo $value['photo_filename_1'] ?>" alt="<?php echo $value['photo_caption'] ?>" class="img-responsive">
                            </div>

                            <div class="col-md-8">
                                <h2><?php echo $value['photo_caption'] ?></h2>
                                <?php echo $value['photo_text'] ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endforeach ?>
            </div>
            <!-- Left Content -->
            <!-- Right Content -->
            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 
            <!-- Right Content -->
        </div>
    </div>
</section>

