<?php if ($this->kapcsolodo_kepek) : ?>
    <hr>
    <h2 class="margin-bottom-20"><i class="fa fa-picture-o"></i> Kapcsolódó képek</h2>
    <div class="gallery image-gallery">


        <div class="gallery-items">
            <!-- BEGIN FILTER -->
            <div class="margin-top-10">
                <div class="row">
                    <?php foreach ($this->kapcsolodo_kepek as $value) : ?>						
                        <div class="col-md-4 col-sm-4">
                            <a href="<?php echo $value['photo_filename']; ?>" data-rel="prettyPhoto[gallery1]"><img style="width: 100%" class="imgholder" src="<?php echo Util::thumb_path($value['photo_filename']); ?>" alt="<?php echo $value['photo_caption']; ?>" />
                            </a>
                        </div>
                    <?php endforeach ?>										
                </div>
            </div>
            <!-- END FILTER -->               
        </div>  
    </div>

    <?php
 endif ?>