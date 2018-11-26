<div class="heading-container">
    <div class="heading-standar">
        <div class="heading-wrap">
            <div class="container">
                <div class="page-title">
                    <h1>Keresés</h1>
                </div>
            </div>
            <div class="page-breadcrumb">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a class="home" href="/"><span>Kezdőlap</span></a></li>
                        <li>fodrászat</li>
                        <li>Keresés</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-container">
    <div class="container">
        <div class="row">
            <div class="col-md-9 main-wrap">
                <div class="main-content">
                    <div class="row">
                        <div class="column col-md-12">
                            <h3>Találatok a következő kifejezésre:<br> <?php echo $this->keyword . ' (' . count($this->result_list) . ')'; ?></h3>
                            <?php if (count($this->result_list) > 0) : ?> 
                                <ul class="no-bullet">
                                    <?php foreach ($this->result_list as $key => $value) { ?> 
                                        <li> 
                                            <i class="fa fa-link"></i> <?php echo $value['title']; ?>
                                            <br>
                                            <a href="<?php echo $value['link']; ?>">
                                                <?php echo $value['link']; ?>
                                            </a>
                                        </li> 
                                    <?php } ?>
                                </ul>
                            <?php endif ?>
                            <?php if (count($this->result_list) == 0) : ?>
                                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Nincs találat</div>
                            <?php endif ?> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- SIDEBAR -->
            <?php include SITE . '/view/_template/tpl_sidebar.php'; ?>
            <!-- END SIDEBAR-->            
        </div>
    </div>
</div>                
<?php include SITE . '/view/_template/tpl_nyitvatartas.php'; ?>