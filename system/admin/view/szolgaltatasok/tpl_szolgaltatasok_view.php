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
                <i class="fa fa-cogs"></i>
                <a href="admin/szolgaltatasok">szolgáltatások</a> 
                <i class="fa fa-angle-right"></i>
            </li>
            <li>Szolgáltatás részletek</li>
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
                        <div class="caption"><i class="fa fa-cogs"></i>Szolgáltatás részletek</div>
                                                   <div class="actions">
                                <a href="admin/szolgaltatasok/update_szolgaltatas/<?php echo $this->content[0]['szolgaltatas_id'];?>" class="btn green btn-sm"><i class="fa fa-pencil"></i> Szolgáltatás szerkesztése</a>
                                <a href="admin/szolgaltatasok" class="btn default btn-sm"><i class="fa fa-close"></i> Vissza a szolgáltatások listájához</a>
                                <!-- <button class="btn default btn-sm" name="cancel" type="button">Mégsem</button>-->
                            </div> 
                    </div>

                    <div class="portlet-body">
                        <div class="space10"></div>							
                        <div class="row">
                            <div class="col-md-8">		

                                <dl class="dl-horizontal">
		<dt style="font-size:100%; color:grey;">Azonosító szám:</dt>
		<dd>#<?php echo $this->content[0]['szolgaltatas_id'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
		<dt style="font-size:100%; color:grey;">Megnevezés:</dt>
		<dd><?php echo $this->content[0]['szolgaltatas_title'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
                <dt style="font-size:100%; color:grey;">Kategória:</dt>
		<dd><?php echo $this->content[0]['szolgaltatas_list_name'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
                <dt style="font-size:100%; color:grey;">Megtekintések száma:</dt>
		<dd><?php echo $this->content[0]['megtekintes'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
                <dt style="font-size:100%; color:grey;">Kezdő kép:</dt>
		<dd><img src="<?php echo Util::thumb_path(Config::get('szolgaltatasphoto.upload_path') . $this->content[0]['szolgaltatas_photo']);?>"></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>

		<dt style="font-size:100%; color:grey;">Leírás:</dt>
		<dd><?php echo $this->content[0]['szolgaltatas_description'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
                <dt style="font-size:100%; color:grey;">Extra infó:</dt>
		<dd><?php echo $this->content[0]['szolgaltatas_info'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
		              
		<dt style="font-size:100%; color:grey;">Státusz:</dt>
		<dd><?php echo ($this->content[0]['szolgaltatas_status'] == 1) ? '<span class="label label-sm label-success">Aktív</span>' : '<span class="label label-sm label-danger">Inaktív</span>';?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>


	</dl>										
                            </div>
                        </div>	


                    </div> <!-- END USER GROUPS PORTLET BODY-->
                </div> <!-- END USER GROUPS PORTLET-->
            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div><!-- END CONTAINER -->