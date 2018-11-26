<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="szolgaltatasok"> Akciók, újdonságok</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- /.inner title Start ./-->
<div class="gap"></div>

<!-- /.Services Start ./-->


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
                
                <?php foreach ($this->promotions as $value) : ?>
                    <div class="margin-bottom-20">   
                        <div class="row">        
                            <div class="col-md-6">
                                <a href="<?php echo 'akciok/' . Util::string_to_slug($value['title']) . '/' . $value['id']; ?>">
                                    <img src="<?php echo $value['picture'] ?>" alt="<?php echo $value['title'] ?>" class="img-responsive">
                                </a>
                            </div>

                            <div class="col-md-6">
                                <h2><?php echo $value['title'] ?></h2>
                                <?php echo $value['text'] ?>
                            </div>
                        </div>
                    </div>
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

