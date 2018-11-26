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
            <li><span>Új akció</span></li>
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
                        <div class="caption"><i class="fa fa-plus"></i>Új akció</div>
                    </div>

                    <div class="portlet-body">
                        <div class="space10"></div>							
                        <div class="row">	
                            <div class="col-md-12">						
                                <form action="" method="POST" id="new_promotion" enctype="multipart/form-data">	

                                    <!-- bootstrap file upload -->
                                    <div class="form-group">
                                        <label class="control-label">Akció kép</label>
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo ADMIN_IMAGE . 'no_user_image.jpg'; ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn default btn-file"><span class="fileupload-new">Kiválasztás</span><span class="fileupload-exists">Módosít</span><input id="uploadprofile" class="img" type="file" name="upload_promotion_picture"></span>
                                                <a href="#" class="btn btn-warning fileupload-exists" data-dismiss="fileupload">Töröl</a>
                                            </div>
                                        </div>


                                        <div class="space10"></div>
                                        <div class="clearfix"></div>
                                        <div class="controls">
                                            <div class="note note-info">
                                               Kattintson a kiválasztás gombra! Ha másik képet szeretne kiválasztani, kattintson a módosít gombra! Ha mégsem kívánja a kiválasztott képet feltölteni, kattintson a töröl gombra!
                                           </div>
                                        </div>
                                        <div class="space10"></div>
                                        <div class="space10"></div>
                                    </div>
                                    <!-- bootstrap file upload END -->


                                    <div class="form-group">
                                        <label for="promotion_title" class="control-label">Akció cím</label>
                                        <input type="text" name="promotion_title" id="promotion_title" placeholder="" class="form-control input-xlarge" />
                                    </div>
                                    <div class="form-group">
                                        <label for="promotion_text" class="control-label">Akció szöveg</label>
                                        <!--<input type="text" name="slider_text" id="slider_text" placeholder="A slide szövege" class="form-control input-xlarge" />
                                        -->
                                        <textarea name="promotion_text" id="promotion_text" placeholder="" class="form-control input-xlarge"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="promotion_status">Akció státusz</label>
                                        <select name='promotion_status' class="form-control input-xlarge">
                                            <option value="1">Aktív</option>
                                            <option value="0">Inaktív</option>
                                        </select>
                                    </div>

                                    <div class="space10"></div>
                                    <button class="btn green submit" type="submit" value="submit" name="submit_new_promotion">Mentés <i class="fa fa-check"></i></button>
                                </form>
                            </div>
                        </div>	


                        <div id="message"></div> 


                    </div> <!-- END USER GROUPS PORTLET BODY-->
                </div> <!-- END USER GROUPS PORTLET-->
            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
