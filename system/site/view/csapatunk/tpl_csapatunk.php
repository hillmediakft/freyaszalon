<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="javascript:void()"> Csapatunk</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- // Banner Section
================================= -->    
<div class="gap"></div>


<section class="top-bottom-spacing grey-bg">
    <div class="container">
        <div class="row">
            <div class="clearfix">
                <div class="col-md-9">



                    <div class="row">
                        <div class="clearfix">
                            <!-- Section 1 -->
                            <div class="col-md-12 marbot10">
                                <h1>
                                    <span class="fw-normal">Munkatársaink</span>
                                </h1>
                                <?php echo $this->content; ?>
                            </div>

                        </div>
                    </div>

                    <div class="gap"></div>                   

                    <div class="row team2 gallery" id="equalheight-crew">

                        <?php foreach ($this->crew_members as $value) { ?>  
                            <div class="col-sm-4 cp_load fadeInUp" id="crew-block">
                                <ul>
                                    <li>

                                        <div class="block-image">
                                            <a href="munkatars/<?php echo Util::string_to_slug($value['crew_member_name']) . '/' . $value['crew_member_id']; ?>">
                                                <img class="img-responsive" src="<?php echo $value['crew_member_photo']; ?>"" alt="">
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <h3><a href="munkatars/<?php echo Util::string_to_slug($value['crew_member_name']) . '/' . $value['crew_member_id']; ?>"><?php echo $value['crew_member_name']; ?></a></h3>
                                        <span><?php echo $value['crew_member_title']; ?></span>
                                        <hr>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?> 


                    </div>

                </div>
                <!-- Sidebar -->
                <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 
            </div>
        </div>
    </div>
</section>

