<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Regisztrált látogatók <small>kezelése</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="#">regisztrált látogatók</a></li>
            </ul>
        </div>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <div id="message"></div> 						

                <form class="horizontal-form" id="del_user_form" method="POST" action="admin/site-users/delete_user">	


                    <!-- echo out the system feedback (error and success messages) -->
                    <?php $this->renderFeedbackMessages(); ?>				


                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-user"></i>Regisztrált látogatók</div>

                            <div class="actions">
                                <button class="btn red btn-sm" name="del_user_submit" type="submit"><i class="fa fa-trash"></i> Csoportos törlés</button>
                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="#" class="btn btn-sm default">
                                        <i class="fa fa-wrench"></i> Eszközök <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="#" id="print_users"><i class="fa fa-print"></i> Nyomtat </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="portlet-body">
                      							
<!-- *************************** REGISZTRÁLT LÁTOGATÓK TÁBLA *********************************** -->						

                            <table class="table table-striped table-bordered table-hover" id="users">
                                <thead>
                                    <tr>
                                        <th class="table-checkbox">
                                            <input type="checkbox" class="group-checkable" data-set="#users .checkboxes"/>
                                        </th>
                                        <th>Név</th>
                                        <th>E-mail</th>
                                      
                                        <th>Státusz</th>
                                        <th style="width:120px"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($all_site_user as $value) { ?>

                                        <tr class="odd gradeX">
                                            <td>
                                                <input type="checkbox" class="checkboxes" name="user_id_<?php echo $value['user_id']; ?>" value="<?php echo $value['user_id']; ?>"/>

                                            </td>

                                            <td><?php echo $value['user_name']; ?></td>

                                            <td><a href="mailto:<?php echo $value['user_email']; ?>"><?php echo $value['user_email']; ?> </a></td>
                                           

                                            <?php if ($value['user_active'] == 1) { ?>
                                                <td><span class="label label-sm label-success">Aktív</span></td>
                                            <?php } ?>
                                            <?php if ($value['user_active'] == 0) { ?>
                                                <td><span class="label label-sm label-danger">Inaktív</span></td>
                                            <?php } ?>
                                            <td>									
                                                <div class="actions">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm green" href="#" data-toggle="dropdown">
                                                            <i class="fa fa-cogs"></i> Műveletek
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">


                                                                <li><a href="<?php echo Active::$site_url . 'site-users/delete_user/' . $value['user_id']; ?>" id="delete_user_<?php echo $value['user_id']; ?>"> <i class="fa fa-trash"></i> Töröl</a></li>


 	
                                                                <?php if ($value['user_active'] == 1) { ?>
                                                                    <li><a rel="<?php echo $value['user_id']; ?>" href="admin/site-users/make_inactive" id="make_inactive_<?php echo $value['user_id']; ?>" data-action="make_inactive"><i class="fa fa-ban"></i> Blokkol</a></li>
                                                            <?php } ?> 
                                                                <?php if ($value['user_active'] == 0) { ?>
                                                                    <li><a rel="<?php echo $value['user_id']; ?>" href="admin/site-users/make_active" id="make_active_<?php echo $value['user_id']; ?>" data-action="make_active"><i class="fa fa-check"></i> Aktivál</a></li>
                                                                <?php } ?>
                                                            	
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>

                                    <?php } ?>	

                                </tbody>
                            </table>	



                        </div>
                    </div>
                </form>					
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>


    </div>
    <!-- END PAGE CONTAINER-->    
</div>                                                            
<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END CONTAINER -->
<div id="loadingDiv"></div>	