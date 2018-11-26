<!-- Banner Section
================================= -->
<section class="animatedParent animateOnce subbanner subbanner-image subbanner-pattern-03 subbanner-type-2 subbanner-type-2-btn">
    <div class="container">
        <div class="subbanner-content banner-content">
            <div class="skew-effect fadeInLeft animated">
                <span class="fw-normal">Képek kezelés előtt és után
            </div>
            <ol class="breadcrumb text-left fadeInRight animated">
                <li><a href="/">Kezdőoldal</a></li>
                <li><a href="#"> Galéria </a></li>
                <li><a href="#">Előtte - utána</a></li>
            </ol>
        </div>
    </div>

</section>

<!-- // Banner Section
================================= --> 
<!-- Before after Section
================================= -->

<!-- Before after Section
================================= -->

<section class="top-bottom-spacing-full grey-bg">
    <div class="container">
        <div class="marbot30">
            <?php echo $this->content; ?>
        </div>

        <div id="portfolio" class="clearfix two-column">

            <?php foreach ($this->photo_gallery as $value) { ?>  
                <div class="element transition laser-eye-surgery" data-category="laser-eye-surgery">
                    <figure>
                        <div class="before-after">
                            <div class="vertical-align">
                                <div class="vertical-top border-right">
                                    <img src="<?php echo $value['photo_filename_1']; ?>" alt=" " title="Előtte" class="image-caption" />
                                </div>
                                <div class="vertical-top">
                                    <img src="<?php echo $value['photo_filename_2']; ?>" alt=" " title="Utána" class="image-caption" />
                                </div>
                            </div>
                        </div>

                        <figcaption>
                            <p class="fontresize"><?php echo $value['photo_caption']; ?></p>
                        </figcaption>
                    </figure>
                </div>
            <?php } ?>

        </div> <!-- #portfolio -->
    </div>
</section>
<!-- // Before after Section
================================= -->

