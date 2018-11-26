<!-- Banner Section
================================= -->
<section class="animatedParent animateOnce subbanner subbanner-image subbanner-pattern-03 subbanner-type-2 subbanner-type-2-btn">
    <div class="container">
        <div class="subbanner-content banner-content">
            <div class="skew-effect fadeInLeft animated">
                <span class="fw-normal">Gyakori kérdések
            </div>
            <ol class="breadcrumb text-left fadeInRight animated">
                <li><a href="/">Kezdőoldal</a></li>
                <li><a href="#">Gyakori kérdések</a></li>
            </ol>
        </div>
    </div>

</section>

<!-- // Banner Section
================================= --> 


<section class="top-bottom-spacing promotions grey-bg">
    <div class="container">

        <div class="row marbot10">
            <!-- Left Content -->
            <div class="col-md-9 marbot30-md-xs">


                <div class="clearfix marbot40">
                    <div class="marbot30">
                        <?php echo $this->content; ?>
                    </div>
                    <!-- div toggle one -->
                    <div id="toogle" class="panel-group toogle">
                        <?php if ($this->gyik_rendezett) : ?>
                            <?php foreach ($this->gyik_rendezett as $key => $value) : ?>
                                <div class="marbot30">        
                                    <h3 class="marbot20"><?php echo $key; ?></h3>
                                    <?php foreach ($value as $key2 => $value2) { ?>
                                        <!-- Item 01 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a href="#toogle-<?php echo $value2['gyik_id']; ?>" class="panel-title collapsed" data-toggle="collapse">
                                                    <?php echo $value2['gyik_title']; ?>
                                                </a>
                                            </div>
                                            <div id="toogle-<?php echo $value2['gyik_id']; ?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <?php echo $value2['gyik_description']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Item 01 -->
                                    <?php } ?> 
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>

                    </div>
                    <!-- div toggle one ends -->
                </div>               


            </div>
            <!-- Left Content -->


            <!-- Right Content -->
            <!-- Sidebar -->
            <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 
            <!-- Right Content -->
        </div>
    </div>
</section>

