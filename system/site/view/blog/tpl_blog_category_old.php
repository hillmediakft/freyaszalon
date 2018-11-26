<div class="pagecrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-4">
                <h5 class="medium">Blog <?php echo $this->registry->language['blog_kategoria'] . ': ' . $category_name; ?></h5>
            </div>
            <div class="col-xs-8">
                <div class="location pull-right">
                    <a href="<?php echo $this->registry->site_url; ?>"><?php echo $this->registry->language['menu_home']; ?></a> / <a href="<?php echo $this->registry->site_url; ?>blog;"><?php echo $this->registry->language['menu_blog']; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="blog-wrapper blog-thumb col-md-9 main-el">


            <?php if (!empty($blog_list)): ?> 
                <?php foreach ($blog_list as $value) { ?>            

                <div class="element row">
                    <div class="col-sm-5">
                        <div class="image">
                            <a href="<?php echo $this->registry->site_url . 'blog/' . $value['blog_slug_hu'] . '/' . $value['blog_id']; ?>">
                                <div class="overlay">
                                    <i class="fa fa-share md"></i>
                                </div>
                            </a>
                            <img src="<?php echo $value['blog_picture']; ?>" class="img-responsive img-thumbnail" alt="<?php echo $value['blog_title_' . $this->registry->lang]; ?>">
                        </div>
                    </div>

                    <div class="col-md-7 col-sm-7">
                        <div class="body">
                            <h3><a href="<?php echo $this->registry->site_url . 'blog/' . $value['blog_slug_hu'] . '/' . $value['blog_id']; ?>"><?php echo $value['blog_title_' . $this->registry->lang]; ?></a></h3>
                            <p class="italic post-links">
                                <span>
                                    <i class="fa fa-archive"></i>
                                    <?php echo $this->registry->language['blog_kategoria']; ?>: <a href="<?php echo $this->registry->site_url . 'blog/kategoria/' . $value['blog_category']; ?>"><?php echo $value['category_name_' . $this->registry->lang]; ?></a>
                                </span> 
                                <span>
                                    <i class="fa fa-calendar"></i> <?php echo $value['blog_add_date']; ?>
                                </span>
                            </p>
                            <p class="text">
                                <?php echo Util::substr_word($value['blog_body_' . $this->registry->lang], 300); ?>
                                <span class="read-link main-text-color">
                                    <a href="<?php echo $this->registry->site_url . 'blog/' . $value['blog_slug_hu'] . '/' . $value['blog_id']; ?>"> 
                                        [...] 
                                    </a>
                                 
                                </span> 
                            </p>

                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="sep-line"></div>
                    </div>
                </div>
            
            
                <?php } ?>
            <?php endif ?>

            <?php if (empty($content)): ?>
                <div class="alert alert-info"><p><i class="fa fa-exclamation-triangle"></i> <?php echo $this->registry->language['blog_nincs_bejegyzes']; ?></p></div>
            <?php endif ?>

        </div>                    
        <?php require('system/site/view/_template/tpl_sidebar_blog.php'); ?>                    
    </div>
</div>               