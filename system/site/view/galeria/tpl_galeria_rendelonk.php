<!-- Banner Section
================================= -->
<section class="animatedParent animateOnce subbanner subbanner-image subbanner-pattern-03 subbanner-type-2 subbanner-type-2-btn">
    <div class="container">
        <div class="subbanner-content banner-content">
            <div class="skew-effect fadeInLeft animated">
                <span class="fw-normal">Rendelőnk
            </div>
            <ol class="breadcrumb text-left fadeInRight animated">
                <li><a href="/">Kezdőoldal</a></li>
                <li><a href="#"> Galéria </a></li>
                <li><a href="#">Rendelőnk</a></li>
            </ol>
        </div>
    </div>

</section>

<!-- // Banner Section
================================= --> 
<!-- Before after Section
================================= -->

<section class="top-bottom-spacing grey-bg">
    <div class="container">
        <div class="marbot30">
            <?php echo $this->content; ?>
        </div>
        <div class="row">
            <div id="portfolio" class="clearfix marbot30 my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
                <?php $i = 0; ?>       
                <?php foreach ($this->photo_gallery as $value) { ?>  
                    <div class="col-md-4">
                        <div class="grid image-effect2">    
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                <a href="<?php echo $value['photo_filename']; ?>" itemprop="contentUrl" data-size="1000x667" data-index="<?php echo $i++; ?>">
                                    <img src="<?php echo Util::thumb_path($value['photo_filename']); ?>" height="auto" width="100%" itemprop="thumbnail" alt="<?php echo $value['photo_caption']; ?>">
                                    <figcaption><i class="fa flaticon-shape gallery-icon transition"></i></figcaption>
                                </a>

                            </figure>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- // Before after Section
================================= -->
