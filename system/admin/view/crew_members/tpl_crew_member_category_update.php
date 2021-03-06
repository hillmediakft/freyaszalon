<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <!-- 
        <h3 class="page-title">
                Munka kategória <small>módosítása</small>
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
                    <a href="admin/crew_members">Munkakör kategóriák listája</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><span>Kategória módosítása</span></li>
            </ul>
        </div>
 <div class="margin-bottom-20"></div>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <!-- ÜZENETEK -->
                <div id="message"></div> 
                <?php $this->renderFeedbackMessages(); ?>			

                <form action="" method="POST" id="crew_member_category_form" enctype="multipart/form-data">

                    <!-- ÜZENETEK 2 -->
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
                                <i class="fa fa-film"></i> 
                                Kategória módosítása
                            </div>
                            <div class="actions">
                                <button class="btn green btn-sm" type="submit"><i class="fa fa-check"></i> Kategória módosítása</button>
                                <a href="admin/crew_members/category" class="btn default btn-sm"><i class="fa fa-close"></i> Mégsem</a>
                                <!-- <button class="btn default btn-sm" name="cancel" type="button">Mégsem</button>-->
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="space10"></div>							
                            <div class="row">	
                                <div class="col-md-12">						
                                    <div class="form-group">
                                        <label for="crew_member_category_name" class="control-label">Kategória neve <span class="required">*</span></label>
                                        <input type="text" name="crew_member_category_name" id="crew_member_list_name" value="<?php echo $this->category_content[0]['crew_member_category_name'] ?>" class="form-control input-xlarge" />
                                    </div>
                                    <!-- régi kategória neve-->
                                    <input type="hidden" name="old_category" value="<?php echo $this->category_content[0]['crew_member_category_name']; ?>">
                                </div>
                            </div>	

                        </div> <!-- END USER GROUPS PORTLET BODY-->
                    </div> <!-- END USER GROUPS PORTLET-->

                </form>

            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div> <!-- END CONTAINER -->	