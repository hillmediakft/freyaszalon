<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="admin/home">Kezdőoldal</a> 
                <i class="fa fa-angle-right"></i>
            </li>
            <li>Előtte-utána képgaléria</li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">

            <!-- echo out the system feedback (error and success messages) -->
            <?php $this->renderFeedbackMessages(); ?>	

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-picture-o"></i>Előtte-utána képek kezelése</div>
                    <div class="actions">
                        <a href="admin/before_after_photo_gallery/new_photo" class="btn blue btn-sm"><i class="fa fa-plus"></i> Új képek feltöltése</a>
                    </div>
                </div>
                <div class="portlet-body">

                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <div class="col-md-12">

                            <!-- BEGIN FILTER -->
                            <div class="margin-top-10">
                                <ul class="mix-filter">

                                    <li class="filter" data-filter="all">
                                        Összes
                                    </li>
                                    <?php foreach ($this->photo_categories as $value) { ?>
                                        <li class="filter" data-filter="category_<?php echo $value['id']; ?>">
                                            <?php echo $value['category_name']; ?>
                                        </li>

                                    <?php } ?>
                                </ul>
                                <div class="row mix-grid">


                                    <?php foreach ($this->all_photos as $value) { ?>						


                                        <div class="col-md-3 col-sm-4 mix category_<?php echo $value['photo_category']; ?>">
                                            <div class="mix-inner">
                                                <div class="photo_slider_label"><?php echo ($value['featured'] == 1) ? '<span class="label label-info">Kiemelt</span>' : ''; ?></div>
                                                <img class="img-responsive" src="<?php echo $value['photo_filename_1']; ?>" alt="">
                                             
                                                <div class="mix-details">
                                                    <h6><?php echo $value['photo_caption']; ?></h6>
                                                    <a title="kép törlése" id="delete_photo<?php echo $value['photo_id']; ?>"class="mix-delete" href="admin/before_after_photo-gallery/delete/<?php echo $value['photo_id']; ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <a title="kép szerkesztése" class="mix-edit" href="admin/before_after_photo-gallery/edit/<?php echo $value['photo_id']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a class="mix-preview fancybox-button" href="<?php echo $value['photo_filename_1']; ?>" title="" data-rel="fancybox-button">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>



                                    <?php } ?>										


                                </div>
                            </div>
                            <!-- END FILTER -->

                        </div>
                    </div>
                    <!-- END PAGE CONTENT-->






                </div> <!-- END PHOTO GALLERY PORTLET BODY-->
            </div> <!-- END PHOTO GALLERY PORTLET-->
        </div> <!-- END COL-MD-12 -->
    </div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div> <!-- END CONTAINER -->

