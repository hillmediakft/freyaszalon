<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <!-- 
        <h3 class="page-title">
                Szolgáltatás <small>hozzáadása</small>
        </h3>
        -->

        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><span>Szolgáltatás hozzáadása</span></li>
            </ul>
        </div>

        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <!-- ÜZENETEK -->
                <div id="message">
                    <?php $this->renderFeedbackMessages(); ?>			
                </div> 

                <form action="" method="POST" id="update_szolgaltatas" enctype="multipart/form-data">	

                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span><!-- ide jön az üzenet--></span>
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button>
                        <span><!-- ide jön az üzenet--></span>
                    </div>	

                    <!-- ÚJ SZOLGÁLTATÁS PORTLET-->
                    <div class="portlet light bg-inverse">

                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>
                                Szolgáltatás szerkesztése
                            </div>
                            <div class="actions">
                                <button class="btn green btn-sm" type="submit"><i class="fa fa-check"></i> Mentés</button>
                                <a class="btn default btn-sm" href="admin/szolgaltatasok"><i class="fa fa-close"></i> Mégsem</a>
                                <!-- <button class="btn default btn-sm" name="cancel" type="button"><i class="fa fa-close"></i> Mégsem</button>-->
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <div class="space10"></div>				
                            <div class="form-body">			
                                <div class="row">	
                                    <div class="col-md-12">					 
                                        <h3 class="form-section">Kezdőkép</h3>

                                        <div class="col-md-12 well well-sm">
                                            <div class="col-md-6">    



                                                <!-- bootstrap file upload -->
                                                <div class="form-group">
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="width: 400px; height: 300px;"><img src="<?php echo Config::get('szolgaltatasphoto.upload_path') . $this->actual_szolgaltatas[0]['szolgaltatas_photo']; ?>" alt=""/></div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
                                                        <div>
                                                            <span class="btn default btn-file"><span class="fileupload-new">Kiválasztás</span><span class="fileupload-exists">Módosít</span><input id="upload_szolgaltatas_photo" class="img" type="file" name="upload_szolgaltatas_photo"></span>
                                                            <a href="#" class="btn btn-warning fileupload-exists" data-dismiss="fileupload">Töröl</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="clearfix"></div>
                                                <div class="controls">
                                                    <div class="alert alert-info"><i class="fa fa-info-circle"></i> Kattintson a kiválasztás gombra! Ha másik képet szeretne kiválasztani, kattintson a módosít gombra! Ha mégsem kívánja a kiválasztott képet feltölteni, kattintson a töröl gombra!</div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- bootstrap file upload END -->


                                        <h3 class="form-section">Megnevezés és leírás</h3>
                                        <!-- SZOLGÁLTATÁS MEGNEVEZÉSE -->	
                                        <div class="form-group">
                                            <label for="szolgaltatas_title" class="control-label">Megnevezés <span class="required">*</span></label>
                                            <input type="text" name="szolgaltatas_title" id="szolgaltatas_title" value="<?php echo $this->actual_szolgaltatas[0]['szolgaltatas_title']; ?>" class="form-control input-xlarge" />
                                        </div>
                                        <!-- SZOLGÁLTATÁS LEÍRÁSA -->	
                                        <div class="form-group">
                                            <label for="szolgaltatas_description" class="control-label">Leírás</label>
                                            <textarea name="szolgaltatas_description" id="szolgaltatas_description" placeholder="" class="form-control input-xlarge" rows="10"><?php echo $this->actual_szolgaltatas[0]['szolgaltatas_description']; ?></textarea>
                                        </div>

                                        <!-- SZOLGÁLTATÁS EXTRA INFO -->	
                                        <div class="form-group">
                                            <label for="szolgaltatas_info" class="control-label">Bevezető szöveg</label>
                                            <textarea name="szolgaltatas_info" id="szolgaltatas_info" placeholder="" class="form-control" rows="10"><?php echo $this->actual_szolgaltatas[0]['szolgaltatas_info']; ?></textarea>
                                        </div>

                                        <h3 class="form-section">Kategória</h3>	                                        
                                        <!-- SZOLGÁLTATÁS STÁTUSZ -->	
                                        <div class="form-group">
                                            <label for="szolgaltatas_category_id" class="control-label">Szolgáltatás kategória</label>
                                            <select name="szolgaltatas_category_id" class="form-control input-xlarge">
                                                <option value="">-- Válasszon --</option>
                                                <?php foreach ($this->category_list as $value) { ?>
                                                    <option value="<?php echo $value['szolgaltatas_list_id']; ?>" <?php echo ($value['szolgaltatas_list_id'] == $this->actual_szolgaltatas[0]['szolgaltatas_category_id']) ? 'selected' : ''; ?>><?php echo $value['szolgaltatas_list_name']; ?></option>

                                                <?php } ?>

                                            </select>
                                        </div> 
                                        
                                         <h3 class="form-section">Címkék</h3>	                                        
                                        <!-- SZOLGÁLTATÁS STÁTUSZ -->	
                                        <div class="form-group">
                                            <select name="tags[]" id="tags" class="form-control input-xlarge select2-multiple" multiple>
                                                <?php foreach ($this->terms as $term) { ?>
                                                    <option value="<?php echo $term['id']; ?>" <?php echo (in_array($term['id'], $this->terms_by_content_id)) ? 'selected' : '';?>><?php echo $term['term']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>  
                                        
                                        
                                        <h3 class="form-section">Szolgáltatást nyújtó munkatársa</h3>	                                                                              <!-- SZOLGÁLTATÁS STÁTUSZ -->	
                                        <div class="form-group">
                                            <select name="crew_members[]" id="crew_members" class="form-control input-xlarge select2-multiple" multiple>
                                                <?php foreach ($this->crew_members as $crew_member) { ?>
                                                    <option value="<?php echo $crew_member['crew_member_id']; ?>" <?php echo (in_array($crew_member['crew_member_id'], $this->service_crew_members)) ? 'selected' : '';?>><?php echo $crew_member['crew_member_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>                                        
                                                                               
                                      

                                        <h3 class="form-section">Státusz</h3>	                                        
                                        <!-- SZOLGÁLTATÁS STÁTUSZ -->	
                                        <div class="form-group">
                                            <label for="szolgaltatas_status" class="control-label">Szolgáltatás státusz</label>
                                            <select name="szolgaltatas_status" class="form-control input-xlarge">
                                                <option value="1" <?php echo ($this->actual_szolgaltatas[0]['szolgaltatas_status'] == 1) ? 'selected' : ''; ?>>Aktív</option>
                                                <option value="0" <?php echo ($this->actual_szolgaltatas[0]['szolgaltatas_status'] == 0) ? 'selected' : ''; ?>>Inaktív</option>
                                            </select>
                                        </div>

                                        <!-- régi kép neve-->
                                        <input type="hidden" name="old_img" value="<?php echo $this->actual_szolgaltatas[0]['szolgaltatas_photo']; ?>">

                                    </div>
                                </div>	
                            </div> <!-- END FORM BODY -->

                        </div> <!-- END USER GROUPS PORTLET BODY-->
                    </div> <!-- END USER GROUPS PORTLET-->
                </form>


            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div><!-- END CONTAINER -->
<div id="loadingDiv" style="display:none;"><img src="public/admin_assets/img/loader.gif"></div>