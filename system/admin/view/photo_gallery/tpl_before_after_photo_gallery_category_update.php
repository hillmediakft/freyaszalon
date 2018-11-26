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
                <a href="admin/before_after_before_after_photo_gallery">Előtte -utána képgaléria</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><a href="admin/before_after_before_after_photo_gallery/category">Előtte - utána kategóriák</a></li>
            <li><i class="fa fa-angle-right"></i> Előtte - utána kategória módosítása</li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>

        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <!-- echo out the system feedback (error and success messages) -->
                <?php $this->renderFeedbackMessages(); ?>			

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet">

                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-film"></i>Kategória módosítása</div>
                    </div>

                    <div class="portlet-body">

                        <div class="space10"></div>							
                        <div class="row">	
                            <div class="col-md-12">						
                                <form action="" method="POST" id="category_update_form">


                                    <div class="form-group">
                                        <label for="category_name" class="control-label">Kategória neve</label>
                                        <input type="text" name="category_name" id="category_name" value="<?php echo $this->category_content[0]['category_name'] ?>" class="form-control input-xlarge" />
                                    </div>


                                    <!-- régi kategória neve-->
                                    <input type="hidden" name="old_category" value="<?php echo $this->category_content[0]['category_name']; ?>">

                                    <div class="space10"></div>
                                    <button class="btn green submit" type="submit">Kategória módosítása <i class="fa fa-check"></i></button>

                                </form>
                            </div>
                        </div>	

                        <div id="message"></div> 

                    </div> <!-- END USER GROUPS PORTLET BODY-->
                </div> <!-- END USER GROUPS PORTLET-->
            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div> <!-- END CONTAINER -->	

