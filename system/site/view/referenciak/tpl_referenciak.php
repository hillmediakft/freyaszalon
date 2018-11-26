<div class="main">
    <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                 <?php echo $content; ?>
                <div class="row references">
                   
                    <?php foreach($movies as $value) { ?>
                        <div class="col-md-6">
                            <div class="product-item">
                        <div class="col-md-4 col-sm-4 col-xs-12">

                            <img src="<?php echo $value['reference_poster']; ?>" class="img-responsive thumbnail" alt="">  
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td style="width:15px"><?php echo $this->registry->language['referenciak_cim'];?></td>
                                        <td><?php echo $value['reference_title']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->registry->language['referenciak_ev'];?></td>
                                        <td><?php echo $value['reference_year']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->registry->language['referenciak_mufaj'];?></td>
                                        <td><?php echo $value['reference_genre']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->registry->language['referenciak_rendezo'];?></td>
                                        <td><?php echo $value['reference_director']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->registry->language['referenciak_szereplok'];?></td>
                                        <td><?php echo $value['reference_actors']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>IMDb</td>
                                        <td><?php echo '<a href="http://www.imdb.com/title/' . $value['reference_imdb_id'] . '">' . 'http://www.imdb.com/title/' . $value['reference_imdb_id'] . '</a>'; ?></td>
                                    </tr>
                                </tbody>
                            </table>   
                        </div>
                        </div>  
                    </div> <!-- END COL-md-6 -->

                    <?php } ?>

                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
<div id="loadingDiv"></div>
