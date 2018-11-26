<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <!-- 
                <h3 class="page-title">
                        Munka <small>részletek</small>
                </h3>
        -->	

        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="admin/crew_members">Kollégák listája</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="admin/crew_members/view_crew_member">Kolléga adatai</a>
                </li>
            </ul>
        </div>

        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <!-- echo out the system feedback (error and success messages) -->
                <?php $this->renderFeedbackMessages(); ?>			

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet">

                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-cogs"></i>Kolléga adatai</div>
                                                   <div class="actions">
                                <a href="admin/crew_members/update_crew_member/<?php echo $content[0]['crew_member_id'];?>" class="btn green btn-sm"><i class="fa fa-pencil"></i> Adatok módosítása</a>
                                <a href="admin/crew_members" class="btn default btn-sm"><i class="fa fa-close"></i> Vissza a kollégák listájához</a>
                                <!-- <button class="btn default btn-sm" name="cancel" type="button">Mégsem</button>-->
                            </div> 
                    </div>

                    <div class="portlet-body">
                        <div class="space10"></div>							
                        <div class="row">
                            <div class="col-md-6">		

                                <dl class="dl-horizontal">
		<dt style="font-size:100%; color:grey;">Azonosító szám:</dt>
		<dd>#<?php echo $content[0]['crew_member_id'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
		<dt style="font-size:100%; color:grey;">Név:</dt>
		<dd><?php echo $content[0]['crew_member_name'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>                
                
                <dt style="font-size:100%; color:grey;">Kép:</dt>
		<dd><img src="<?php echo $content[0]['crew_member_photo'];?>"></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>

		<dt style="font-size:100%; color:grey;">Szakterületek:</dt>
		<dd><?php echo $content[0]['crew_member_specialty'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>

		<dt style="font-size:100%; color:grey;">Telefonszám:</dt>
		<dd><?php echo $content[0]['crew_member_phone'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
<dt style="font-size:100%; color:grey;">E-mail:</dt>
		<dd><?php echo $content[0]['crew_member_email'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
                <dt style="font-size:100%; color:grey;">Info:</dt>
		<dd><?php echo $content[0]['crew_member_info'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
               
		<dt style="font-size:100%; color:grey;">Státusz:</dt>
		<dd><?php echo ($content[0]['crew_member_status'] == 1) ? 'Aktív' : 'Inaktív';?></dd>
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