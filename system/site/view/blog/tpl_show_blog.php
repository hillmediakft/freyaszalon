<!-- Banner Section
================================= -->
<section class="animatedParent animateOnce subbanner subbanner-image subbanner-pattern-03 subbanner-type-2 subbanner-type-2-btn">
    <div class="container">
        <div class="subbanner-content banner-content">
            <div class="skew-effect fadeInLeft animated">
                <span class="fw-normal"><?php echo $this->blog['blog_title']; ?>
            </div>
            <ol class="breadcrumb text-left fadeInRight animated">
                <li><a href="/">Kezdőoldal</a></li>
                <li><a href="hirek"> Hírek</a></li>
            </ol>
        </div>
    </div>

</section>

<!-- // Banner Section
================================= --> 

<section class="top-bottom-spacing blog grey-bg">
    <div class="container">
        <div class="row marbot10 animatedParent animateOnce">

            <div class="col-md-8 fadeInLeft animated">
                <!-- Content -->
                <div class="clearfix">
                    <img src="<?php echo Config::get("blogphoto.upload_path") . $this->blog['blog_picture']; ?>"  alt=" " class="img-responsive">                        
                    <div class="panel panel-body marbot30">
                        <h3><?php echo $this->blog['blog_title']; ?></h3>

                        <ul class="list-inline blog-tags marbot30 color-light">
                            <li> <i class="fa fa-calendar"></i> <?php echo $this->blog['blog_add_date']; ?> </li>
                            <li> <i class="fa fa-archive"></i>
                                Kategória: <a href="<?php echo $this->registry->site_url . 'hirek/kategoria/' . $this->blog['blog_category']; ?>"><?php echo $this->blog['category_name']; ?> </li>
                        </ul>
                        <?php echo $this->blog['blog_body']; ?>
                    </div>
                </div>

                <!-- Kapcsolódó szolgáltatások - szolgáltatások a kategóriában -->
                <?php require('system/site/view/_template/tpl_kapcsolodo_szolgaltatasok.php'); ?>              
                <!-- Content -->
            </div>

            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_blog.php'); ?> 

        </div>
    </div>
</section>