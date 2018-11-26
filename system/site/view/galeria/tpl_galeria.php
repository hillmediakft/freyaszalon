<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="javascript:void();"> Képgaléria</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- /.inner title Start ./-->
<div class="gap"></div>



<section class="gallery image-gallery">
    <div class="container">
        <div class="row">
            <h1>Képek a Freya Szalonról</h1>
            <hr>

            <div class="gallery-items">

                <!-- BEGIN FILTER -->
                <div class="margin-top-10">
                    <ul class="mix-filter">
                        <li class="filter" data-filter="all">
                            Összes
                        </li>
                        <?php foreach ($this->category_list as $value) { ?>
                            <li class="filter" data-filter="category_<?php echo $value['id']; ?>">
                                <?php echo $value['category_name']; ?>
                            </li>

                        <?php } ?>
                    </ul>
                    <div class="row mix-grid">
                        <?php foreach ($this->photo_gallery as $value) { ?>						
                            <div class="col-md-4 col-sm-4 mix category_<?php echo $value['photo_category']; ?>">
                                <a href="<?php echo $value['photo_filename']; ?>" data-rel="prettyPhoto[gallery1]"><img style="width: 100%" class="imgholder" src="<?php echo Util::thumb_path($value['photo_filename']); ?>" alt="<?php echo $value['photo_caption']; ?>" />
                                    <div class="ghover"> <span class="pluss"><i class="fa fa-plus"></i></span>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>										
                    </div>
                </div>
                <!-- END FILTER -->               

            </div>              




            <hr>
            <div class="gap-20"></div>


        </div>
    </div>
</section>
<!-- /.Services End ./-->



