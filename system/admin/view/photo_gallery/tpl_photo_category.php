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
            <li>
                <a href="admin/photo_gallery">Képgaléria</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><a href="admin/photo_gallery/category">Kategóriák</a></li>
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
                    <div class="caption"><i class="fa fa-cogs"></i>Képgaléria kategóriák</div>
                    <div class="actions">
                        <a href="admin/photo_gallery/category_insert" class="btn blue btn-sm"><i class="fa fa-plus"></i> Új kategória</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="photo_category">
                        <thead>
                            <tr class="heading">
                                <th style="width:1%;">#id</th>
                                <th>Kategória neve</th>
                                <th>Képek száma</th>
                                <th style="width:1%;"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($this->all_photo_category as $value) { ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $value['id']; ?></td>
                                    <td><?php echo $value['category_name']; ?></td>
                                    <td><?php echo (isset($this->no_of_photos[$value['id']])) ? $this->no_of_photos[$value['id']] : '0'; ?>
                                    </td>

                                    <td>									
                                        <div class="actions">
                                            <div class="btn-group">
                                                <a class="btn btn-sm grey-steel" href="#" data-toggle="dropdown" <?php echo (Session::get('user_role_id') <= 2) ? '' : 'disabled'; ?>>
                                                    <i class="fa fa-cogs"></i> Műveletek
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <?php if (Session::get('user_role_id') <= 2) { ?>	
                                                        <li><a href="admin/photo_gallery/category_update/<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Szerkeszt</a></li>
                                                    <?php } ?>

                                                    <?php if (Session::get('user_role_id') <= 2 && !isset($no_of_photos[$value['id']])) { ?>
                                                        <li><a href="admin/photo_gallery/delete_category/<?php echo $value['id']; ?>" id="delete_category<?php echo $value['id']; ?>"><i class="fa fa-trash"></i> Törlés</a></li>  
                                                        <?php } ?>


                                                </ul>
                                            </div>
                                        </div>
                                    </td>

                                </tr>

                            <?php } ?>	

                        </tbody>
                    </table>


                </div> <!-- END USER GROUPS PORTLET BODY-->
            </div> <!-- END USER GROUPS PORTLET-->




        </div> <!-- END COL-MD-12 -->
    </div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div> <!-- END CONTAINER -->

