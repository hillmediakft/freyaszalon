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
            <li><span>Akció szerkesztése</span></li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->
    
<div class="margin-bottom-20"></div>  

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-edit"></i>Akció szerkesztése</div>
                    </div>
                    <div class="portlet-body">
                        <div class="space10"></div>							
                        <div class="row">	
                            <div class="col-md-12">						
                                <form action="" method="POST" id="update_promotion_form" enctype="multipart/form-data">	
                                    <!-- bootstrap file upload -->
                                    <div class="form-group">
                                        <label class="control-label">Akció kép</label>
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 420px"><img src="<?php echo $this->promotion[0]['picture']; ?>" alt=""/></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 420px; line-height: 20px;"></div>
                                            <div>
                                                <span class="btn default btn-file"><span class="fileupload-new">Kiválasztás</span><span class="fileupload-exists">Módosít</span><input id="uploadprofile" class="img" type="file" name="update_promotion_picture"></span>
                                                <a href="#" class="btn btn-warning fileupload-exists" data-dismiss="fileupload">Töröl</a>
                                            </div>
                                        </div>
<div class="note note-info">
                                               Kattintson a kiválasztás gombra! Ha másik képet szeretne kiválasztani, kattintson a módosít gombra! Ha mégsem kívánja a kiválasztott képet feltölteni, kattintson a töröl gombra!
                                           </div>

                                        <div class="space10"></div>
                                        <div class="clearfix"></div>
                                        <div class="controls">
                                           
                                        </div>
                                        <div class="space10"></div>
                                        <div class="space10"></div>
                                    </div>
                                    <!-- bootstrap file upload END -->


                                    <div class="form-group">
                                        <label for="promotion_title" class="control-label">akció cím</label>
                                        <input type="text" name="promotion_title" id="promotion_title" class="form-control input-xlarge" value="<?php echo $this->promotion[0]['title']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="promotion_text" class="control-label">Akció szöveg</label>

                                        <textarea type="text" name="promotion_text" id="promotion_text" class="form-control"><?php echo $this->promotion[0]['text']; ?></textarea>

                                    </div>

                                    <!--Státusz beállítása-->
                                    <div class="form-group">
                                        <label for="promotion_status">Akció státusz</label>
                                        <select name='promotion_status' class="form-control input-xlarge">
                                            <option value="1" <?php echo ($this->promotion[0]['active'] == 1) ? 'selected' : ''; ?>>Aktív</option>
                                            <option value="0" <?php echo ($this->promotion[0]['active'] == 0) ? 'selected' : ''; ?>>Inaktív</option>
                                        </select>
                                    </div>


                                    <!-- régi kép elérési útja-->
                                    <input type="hidden" name="old_img" id="old_img" value="<?php echo $this->promotion[0]['picture']; ?>">				


                                    <div class="space10"></div>
                                    <button class="btn green submit" type="submit" value="submit" name="submit_update_promotion">Mentés <i class="fa fa-check"></i></button>
                                </form>
                            </div>
                        </div>	


                        <div id="message"></div> 






                    </div> <!-- END USER GROUPS PORTLET BODY-->
                </div> <!-- END USER GROUPS PORTLET-->
            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    