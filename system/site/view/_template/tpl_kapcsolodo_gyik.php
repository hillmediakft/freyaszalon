<?php if ($this->kapcsolodo_gyik) : ?>
    <h3><i class="fa fa-question-circle fa-2x"></i> Gyakori kérdések</h3>    
    <div id="toogle" class="panel-group toogle">
        <?php foreach ($this->kapcsolodo_gyik as $key => $value) : ?>
            <!-- Item 01 -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#toogle-<?php echo $value['gyik_id']; ?>" class="panel-title collapsed" data-toggle="collapse">
                        <?php echo $value['gyik_title']; ?>
                    </a>
                </div>
                <div id="toogle-<?php echo $value['gyik_id']; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo $value['gyik_description']; ?>
                    </div>
                </div>
            </div>
            <!-- Item 01 -->
        <?php endforeach ?> 
    </div>
    <?php
 endif ?>