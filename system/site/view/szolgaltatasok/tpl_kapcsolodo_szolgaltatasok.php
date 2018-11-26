<?php if ($this->kapcsolodo_szolgaltatasok) : ?>
    <hr>
    <h2 class="margin-bottom-20"><i class="fa fa-cogs"></i> További <?php echo $this->szolgaltatas['szolgaltatas_list_name']; ?> szolgáltatások</h2>
    <div class="gallery">
        <?php foreach ($this->kapcsolodo_szolgaltatasok as $key => $value) : ?>

            <div class="margin-bottom-20">   
                <div class="row">        
                    <div class="col-md-3">
                        <a href="szolgaltatasok/<?php echo Util::string_to_slug($value['szolgaltatas_list_name']) . '/' . Util::string_to_slug($value['szolgaltatas_title']); ?>">
                            <img src="<?php echo Util::thumb_path(Config::get("szolgaltatasphoto.upload_path") . $value['szolgaltatas_photo']); ?>" alt="" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-md-9">
                        <a href="szolgaltatasok/<?php echo Util::string_to_slug($value['szolgaltatas_list_name']) . '/' . Util::string_to_slug($value['szolgaltatas_title']); ?>">
                            <h3><?php echo $value['szolgaltatas_title']; ?></h3>
                        </a>
                        <?php echo Util::substr_word($value['szolgaltatas_info'], 300) . '...'; ?>
                    </div>
                </div>
            </div>  
        <?php endforeach ?>
    </div>
    <?php endif ?>