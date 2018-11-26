<!-- Banner Section
================================= -->
<section class="animatedParent animateOnce subbanner subbanner-image subbanner-pattern-03 subbanner-type-2 subbanner-type-2-btn">
    <div class="container">
        <div class="subbanner-content banner-content">
            <div class="skew-effect fadeInLeft animated">
                <span class="fw-normal">Hírek
            </div>
            <ol class="breadcrumb text-left fadeInRight animated">
                <li><a href="/">Kezdőoldal</a></li>
                <li><a href="#"> Hírek / kategória </a></li>
            </ol>
        </div>
    </div>

</section>

<!-- // Banner Section
================================= --> 


<section class="top-bottom-spacing blog grey-bg">
    <div class="container">
        <div class="row animatedParent animateOnce">

            <div class="col-md-8 marbot40 fadeInLeft animated">
                <!-- Content -->

                <div class="row" id="blog-list">

                    <?php foreach ($this->blog_list as $value) { ?>
                        <div class="col-md-6">
                            <div class="marbot30 blog-item">
                                <img src="<?php echo Config::get("blogphoto.upload_path") . $value['blog_picture']; ?>" alt="<?php echo $value['blog_title']; ?>" class="img-responsive">

                                <div class="panel panel-body marbot0">
                                    <div class="color-light marbot0">                                
                                        <span>
                                            <i class="fa fa-archive"></i>
                                            Kategória: <a href="<?php echo $this->registry->site_url . 'hirek/kategoria/' . $value['blog_category']; ?>"><?php echo $value['category_name']; ?></a>
                                        </span> 
                                        <span>
                                            <i class="fa fa-calendar"></i> <?php echo $value['blog_add_date']; ?>
                                        </span></div>
                                    <div class="main-title text-capitalize marbot15"> <?php echo $value['blog_title']; ?> </div>
                                    <p class="fontresize">  <?php echo Util::sentence_trim($value['blog_body'], 3); ?></p>
                                    <a href="<?php echo $this->registry->site_url . 'hirek/' . $value['blog_slug'] . '/' . $value['blog_id']; ?>" class="btn btn-type1-reverse btn-sm">Tovább</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="text-center">                        
                            <?php echo $this->pagine_links; ?>
                        </nav>
                    </div>
                </div> 



            </div>

            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_blog.php'); ?> 

        </div>
    </div>
</section>

<!-- // Content 
================================================== -->

