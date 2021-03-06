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
			<li><span>Fotó feltöltése</span></li>
		</ul>
	</div>
	<!-- END PAGE TITLE & BREADCRUMB-->
	<!-- END PAGE HEADER-->

	<div class="margin-bottom-20"></div>

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-12 margin-bottom-20">
                        <a class ='btn btn-default' href='admin/photo-gallery'><i class='fa fa-arrow-left'></i>  Vissza a galériához</a>
                    </div>
                </div>

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-film"></i>Új fotó feltöltése</div>
                        <!--
                        <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                        </div>
                        -->
                    </div>
                    <div class="portlet-body">
                        <!-- croppic -->
                        <div class="row">	
                            <div class="col-md-12">						
                                <div class="space10"></div>
                                <div class="row">
                                    <form action="" method="POST" enctype="multipart/form-data" id="new_photo">	


                                        <div class="col-md-6">
                                            <label class="control-label">Kép feltöltése</label>					


                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 400px; height: 300px;"><img src="<?php echo ADMIN_IMAGE . 'placeholder-400x300.jpg'; ?>" /></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
                                                <div>
                                                    <span class="btn btn-file green"><span class="fileupload-new">Kiválasztás</span><span class="fileupload-exists">Módosít</span><input id="uploadprofile" class="img" type="file" name="upload_gallery_photo"></span>
                                                    <a href="#" class="btn btn-warning" data-dismiss="fileupload">Töröl</a>
                                                </div>
                                            </div>
                                            <div class="space10"></div>
                                            <div class="clearfix"></div>
                                            <div class="controls">
                                                <span class="label label-danger">INFO</span>
                                                <span>Kattintson a kiválasztás gombra! Ha másik képet szeretne kiválasztani, kattintson a módosít gombra! Ha mégsem kívánja a kiválasztott képet feltölteni, kattintson a töröl gombra!</span>
                                            </div>
                                        </div>				


                                        <div class="col-md-6">						

                                            <div class="form-group">
                                                <label for="photo_caption" class="control-label">Fotó felirat</label>
                                                <input type="text" name="photo_caption" id="photo_caption" placeholder="A fotóhoz tartozó szöveges információ" class="form-control input-xlarge" />
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="photo_category" class="control-label">Fotó kategória</label>

                                                <select name="photo_category" class="form-control input-xlarge">
                                                    <option value="">-- Válasszon --</option>
                                                    <?php foreach ($this->category_list as $value) { ?>                                                    
                                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['category_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            
                                         
                                        <!-- SZOLGÁLTATÁS STÁTUSZ -->	
                                        <div class="form-group">
                                            <div>Címkék</div>
                                            <select name="tags[]" id="tags" class="form-control input-xlarge select2-multiple" multiple>
                                                <?php foreach ($this->terms as $term) { ?>
                                                    <option value="<?php echo $term['id']; ?>"><?php echo $term['term']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>                                             
                                            
                                            <div class="form-group">
                                                <label>Megjelenés galéria sliderben</label>
                                                <div class="checkbox">
                                                    <label>

                                                        <span><input type="checkbox" value="1" name="photo_slider"></span>

                                                        Megjelenik
                                                    </label>
                                                </div>
                                            </div>			

                                            <div class="space10"></div>
                                            <button class="btn green submit" type="submit" value="Mentés" name="submit_new_photo">Mentés <i class="fa fa-check"></i></button>
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