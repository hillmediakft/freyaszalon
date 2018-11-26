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
                <a href="admin/photo_gallery">Előtte-utána képek szerkesztése</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Előtte-utána képek szerkesztése</span></li>
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

            <div class="row">
                <div class="col-lg-12 margin-bottom-20">
                    <a class ='btn btn-default' href='admin/before_after_photo-gallery'><i class='fa fa-arrow-left'></i>  Vissza az előtte-utána galériához</a>
                </div>
            </div>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-film"></i>Új előtte-utána képek szerkesztése</div>
                </div>
                <div class="portlet-body">
                    <!-- croppic -->
                    <div class="row">	
                        <div class="col-md-12">						
                            <div class="space10"></div>
                            <div class="row">
                                <form action="" method="POST" enctype="multipart/form-data" id="edit_photo">	

                                        <div class="col-md-6">
                                            <label class="control-label">Kép feltöltése</label>
                                            <div id="before_after_image_1"></div>	
                                            <input type="hidden" name="img_url_1" id="OutputId_1" >
                                            <input type="hidden" id="old_img_1"  value="<?php echo $this->photo[0]['photo_filename_1']; ?>" name="old_img_1">
                                            <div class="space10"></div>
                                        </div>

                          <!--              <div class="col-md-6">
                                             <label class="control-label">Utána</label>
                                            <div id="before_after_image_2"></div>	
                                            <input type="hidden" name="img_url_2" id="OutputId_2" >
                                            <input type="hidden" id="old_img_2"  value="<?php echo $this->photo[0]['photo_filename_2']; ?>" name="old_img_2">
                                            <div class="space10"></div>
                                        </div> -->
                                  
                                    <div class="clearfix"></div>
                                    <div class="margin-bottom-20"></div>
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <span>Kép kiválasztásához kattintson a felső sarokban található zöld színű, nyilat ábrázoló ikonra. A képet mozgathatja, nagyíthatja, kicsinyítheti és forgathatja. Amikor a képet tetszés szerint beállította, kattintson a zöld körbevágás ikonra. <br>Amennyiben másik képet szeretne kiválasztani, kattintson a piros színű keresztre, majd ismét a zöld nyíl ikonra.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">						

                                        <div class="form-group">
                                            <label for="photo_caption" class="control-label">Cím</label>
                                            <input type="text" name="photo_caption" id="photo_caption" placeholder="Cím" class="form-control input-xlarge" value="<?php echo $this->photo[0]['photo_caption']; ?>"/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="photo_text" class="control-label">Szöveg</label>
                                           <textarea type="text" name="photo_text" id="photo_text" class="form-control"><?php echo $this->photo[0]['photo_text']; ?></textarea>
                                        </div>                                        

                                        <div class="form-group">
                                            <label for="photo_category" class="control-label">Fotó kategória</label>

                                            <select name="photo_category" class="form-control input-xlarge">
                                                <option value="">-- Válasszon --</option>
                                                    <?php foreach ($this->category_list as $value) { ?>
                                                        <option value="<?php echo $value['id']; ?>" <?php echo ($this->photo[0]['photo_category'] == $value['id']) ? 'selected' : ''; ?>><?php echo $value['category_name']; ?></option>
                                                    <?php } ?>    
                                            </select>
                                        </div>
                             <!--           <div class="form-group">
                                            <label>Megjelenés galéria sliderben</label>
                                            <div class="checkbox">
                                                <label>
                                                    <span><input type="checkbox" value="1" name="featured"></span>
                                                    Megjelenik
                                                </label>
                                            </div>
                                        </div>		-->	

                                        <div class="space10"></div>
                                        <button class="btn green submit" type="submit" value="Mentés" name="submit_edit_photo">Mentés <i class="fa fa-check"></i></button>
                                    </div>

                                </form>
                            </div>


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