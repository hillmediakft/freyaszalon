<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <!-- 
        <h3 class="page-title">
                Munka <small>hozzáadása</small>
        </h3>
        -->

        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><span>Kolléga hozzáadása</span></li>
            </ul>
        </div>

        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <!-- ÜZENETEK -->
                <div id="message"></div> 
                <?php $this->renderFeedbackMessages(); ?>			

                <form action="" method="POST" id="new_crew_member">	

                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span><!-- ide jön az üzenet--></span>
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button>
                        <span><!-- ide jön az üzenet--></span>
                    </div>	

                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet">

                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>
                                Kolléga hozzáadása
                            </div>
                            <div class="actions">
                                <button class="btn green btn-sm" type="submit"><i class="fa fa-check"></i> Mentés</button>
                                <a class="btn default btn-sm" href="admin/crew_members"><i class="fa fa-close"></i> Mégsem</a>
                                <!-- <button class="btn default btn-sm" name="cancel" type="button"><i class="fa fa-close"></i> Mégsem</button>-->
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div class="space10"></div>							
                            <div class="row">	
                                <div class="col-md-12">



                                    <label>Profilkép</label>

                                    <div id="crew_member_image"></div>	

                                    <input type="hidden" name="img_url" id="OutputId" >

                                    <div class="space10"></div>
                                    <div class="clearfix"></div>
                                    <div class="alert alert-info">
                                        <span class="label label-danger">INFO</span>
                                        <span>Kép kiválasztásához kattintson a felső sarokban található zöld színű, nyilat ábrázoló ikonra. A képet mozgathatja, nagyíthatja, kicsinyítheti és forgathatja. Amikor a képet tetszés szerint beállította, kattintson a zöld körbevágás ikonra. <br>Amennyiben másik képet szeretne kiválasztani, kattintson a piros színű keresztre, majd ismét a zöld nyíl ikonra.</span>
                                    </div>
                                    <div class="space10"></div>                                 

                                    <div class="row">    

                                        <div class="col-md-6">    
                                            <!-- CREW MEMBER VEZETÉKNÉV -->	
                                            <div class="form-group">
                                                <label for="crew_member_name" class="control-label">Név <span class="required">*</span></label>
                                                <input type="text" name="crew_member_name" id="crew_member_name" placeholder="" class="form-control input-xlarge" />
                                            </div>

 <!-- CREW MEMBER MEGNEVEZÉS -->	
                                            <div class="form-group">
                                                <label for="crew_member_title" class="control-label">Megnevezés <span class="required">*</span></label>
                                                <input type="text" name="crew_member_title" id="crew_member_title" placeholder="" class="form-control input-xlarge" />
                                            </div>                                  
                                        </div> 


                                        <div class="col-md-6">   
                                            
<!-- CREW MEMBER TELEFONSZÁM -->	
                                            <div class="form-group">
                                                <label for="crew_member_phone" class="control-label">Telefonszám <span class="required">*</span></label>
                                                <input type="text" name="crew_member_phone" id="crew_member_phone" placeholder="" class="form-control input-xlarge" />
                                            </div>                                             
                                            
                                            <!-- CREW MEMBER EMAIL -->	
                                            <div class="form-group">
                                                <label for="crew_member_email" class="control-label">E-mail cím <span class="required">*</span></label>
                                                <input type="text" name="crew_member_email" id="crew_member_email" placeholder="" class="form-control input-xlarge" />
                                            </div>                                     

                                  




                                        </div>
                                        <div class="col-md-6">
                                            
                                            <!-- CREW MEMBER SZAKTERÜLET -->	
                                            <div class="form-group">
                                                <label for="crew_member_category" class="control-label">Kategória <span class="required">*</span></label>

                                                <select class="form-control input-xlarge" name="crew_member_category" aria-controls="category">
                                                    <option value="">-- válasszon --</option>
                                                    <?php foreach ($this->crew_member_category_list as $value) { ?>
                                                        <option value="<?php echo $value['crew_member_category_id']; ?>"><?php echo $value['crew_member_category_name']; ?></option>
                                                    <?php } ?>    
                                                </select>
                                            </div> 
                                        </div>

                                    </div>





                                    <!-- CREW MEMBER INFO MAGYAR -->	
                                    <div class="form-group">
                                        <label for="crew_member_info_hu" class="control-label">Részletesebb infó</label>
                                        <textarea name="crew_member_info" id="crew_member_info" class="form-control input-xlarge" rows="10"></textarea>
                                        <?php if (isset($ckeditor) && $ckeditor === true) { ?>
                                            <script type="text/javascript">
                                                //CKEDITOR.replace( 'crew_member_description' );
                                                CKEDITOR.replace('crew_member_info', {customConfig: 'config_minimal1.js'});
                                            </script>
                                        <?php } ?>										
                                    </div>



                                    <!-- CREW MEMBER STÁTUSZ -->	
                                    <div class="form-group">
                                        <label for="crew_member_status" class="control-label">Státusz</label>
                                        <select name="crew_member_status" class="form-control input-xlarge">
                                            <option value="0">Inaktív</option>
                                            <option value="1" selected>Aktív</option>
                                        </select>
                                    </div>

                                </div>
                            </div>	

                        </div> <!-- END CREW MEMBERS GROUPS PORTLET BODY-->
                    </div> <!-- END CREW MEMBERS PORTLET-->
                </form>


            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div><!-- END CONTAINER -->