<?php if ($this->kapcsolodo_szolgaltatasok) : ?>
    <h3><i class="fa fa-file-text-o fa-2x"></i> Kapcsolódó szolgáltatások</h3>
    <div class="row">
        <?php foreach ($this->kapcsolodo_szolgaltatasok as $key => $value) : ?>
            <div class="col-md-6">
                <div class="clearfix marbot30">
                    <a href="szolgaltatasok/<?php echo Util::string_to_slug($value['szolgaltatas_list_name']) . '/' . Util::string_to_slug($value['szolgaltatas_title']); ?>">
                        <div class="related-content-box related-content-box-small clearfix">

                            <div class="media-body transition visible-block-sm-xs">
                                <h3 class="marbot10"><?php echo $value['szolgaltatas_title']; ?></h3>
                            </div>

                            <div class="media-right visible-block-sm-xs">
                                <img src="<?php echo Util::thumb_path(Config::get("szolgaltatasphoto.upload_path") . $value['szolgaltatas_photo']); ?>" alt=" " class="img-responsive">
                            </div>
                        </div>                        
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>   