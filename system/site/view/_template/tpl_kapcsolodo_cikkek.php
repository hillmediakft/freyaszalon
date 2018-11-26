<?php if ($this->kapcsolodo_cikkek) : ?>
    <h3><i class="fa fa-file-text-o fa-2x"></i> Kapcsolódó cikkek</h3>
    <div class="row">
        <?php foreach ($this->kapcsolodo_cikkek as $key => $value) : ?>
            <div class="col-md-6">
                <div class="clearfix marbot30">
                    <a href="hirek/<?php echo $value['blog_slug'] . '/' . $value['blog_id']; ?>">
                        <div class="related-content-box related-content-box-small clearfix">

                            <div class="media-body transition visible-block-sm-xs">
                                <h3 class="marbot10"><?php echo $value['blog_title']; ?></h3>
                            </div>

                            <div class="media-right visible-block-sm-xs">
                                <img src="<?php echo Util::thumb_path(Config::get("blogphoto.upload_path") . $value['blog_picture']); ?>" alt=" " class="img-responsive">
                            </div>
                        </div>                        
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>