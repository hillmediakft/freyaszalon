<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <!-- <h3 class="page-title">Munkák <small>listája</small></h3> -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="admin/crew_members">Kollégák listája</a></li>
            </ul>
        </div>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->
 <div class="margin-bottom-20"></div>

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <!-- RÉSZLETEK MEGJELENÍTÉSE MODAL -->	
                <div class="modal" id="ajax_modal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" id="modal_container"></div>
                    </div>
                </div>	
                <!-- RÉSZLETEK MEGJELENÍTÉSE MODAL END -->	

                <div id="ajax_message"></div> 						
                <!-- echo out the system feedback (error and success messages) -->
                <?php $this->renderFeedbackMessages(); ?>				

                <form class="horizontal-form" id="del_crew_member_form" method="POST" action="admin/crew_members/delete_crew_member">	

                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-male"></i>Kollégák listája</div>
                            <div class="actions">
                                <a href="admin/crew_members/new_crew_member" class="btn blue btn-sm"><i class="fa fa-plus"></i> Új kolléga hozzáadása</a>
                                <button class="btn red btn-sm" name="delete_crew_member_submit" value="submit" type="submit"><i class="fa fa-trash"></i> Csoportos törlés</button>
 
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- *************************** JOBS TÁBLA *********************************** -->						
                            <table class="table table-striped table-bordered table-hover" id="crew_members">
                                <thead>
                                    <tr class="heading">
                                        <th class="table-checkbox">
                                            <input type="checkbox" class="group-checkable" data-set="#crew_member .checkboxes"/>
                                        </th>
                                        <th>Kép</th>
                                        <th>Név</th>
                                        <th>Kategória</th>
                                        <th>Telefon</th>
                                        <th>E-mail</th>
                                        <th>Info</th>
                                        <th style="max-width:50px;">Státusz</th>
                                        <th style="width:1%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($this->all_crew_member as $value) { ?>
                                        <tr class="odd gradeX">
                                            <td>
                                                <?php if (Session::get('user_role_id') < 3) : ?>
                                                    <input type="checkbox" class="checkboxes" name="crew_member_id_<?php echo $value['crew_member_id']; ?>" value="<?php echo $value['crew_member_id']; ?>"/>
                                                <?php endif; ?>	
                                            </td>
                                            <td><img src="<?php echo (!empty($value['crew_member_photo'])) ? $value['crew_member_photo'] : 'uploads/crew_photo/crew_placeholder.png';?>" width="60" height="60"/></td>
                                            <td><?php echo $value['crew_member_name']; ?></td>
                                            <td><?php echo $value['crew_member_category_name']; ?></td>
                                            <td><?php echo $value['crew_member_phone']; ?></td>
                                            <td><?php echo $value['crew_member_email']; ?></td>
                                            <td><?php echo $value['crew_member_info']; ?></td>
                                            <?php if ($value['crew_member_status'] == 1) { ?>
                                                <td><span class="label label-sm label-success">Aktív</span></td>
                                            <?php } ?>
                                            <?php if ($value['crew_member_status'] == 0) { ?>
                                                <td><span class="label label-sm label-danger">Inaktív</span></td>
                                            <?php } ?>
                                            <td>									
                                                <div class="actions">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm grey-steel" href="#" data-toggle="dropdown" <?php echo ((Session::get('user_role_id') >= 2)) ? 'disabled' : ''; ?>>
                                                            <i class="fa fa-cogs"></i> 
                                                            
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="<?php echo 'admin/crew_members/view_crew_member/' . $value['crew_member_id']; ?>"><i class="fa fa-eye"></i> Részletek</a></li>
                                                            <!-- <li><a href="javascript:void(0)" class="modal_trigger" rel="<?php //echo $value['crew_member_id'];  ?>"><i class="fa fa-eye"></i> Részletek</a></li>	-->	

                                                            <?php if ((Session::get('user_role_id') < 3)) { ?>	
                                                                <li><a href="<?php echo 'admin/crew_members/update_crew_member/' . $value['crew_member_id']; ?>"><i class="fa fa-pencil"></i> Szerkeszt</a></li>
                                                            <?php }; ?>

                                                            <?php if ((Session::get('user_role_id') < 3)) { ?>	
                                                                <li><a href="<?php echo 'admin/crew_members/delete_crew_member/' . $value['crew_member_id']; ?>" id="delete_crew_member_<?php echo $value['crew_member_id']; ?>"> <i class="fa fa-trash"></i> Töröl</a></li>
                                                            <?php }; ?>

                                                            <?php if ((Session::get('user_role_id') < 3)) { ?>		
                                                                <?php if ($value['crew_member_status'] == 1) { ?>
                                                                    <li><a rel="<?php echo $value['crew_member_id']; ?>" href="admin/crew_members/change_status" id="make_inactive_<?php echo $value['crew_member_id']; ?>" data-action="make_inactive"><i class="fa fa-ban"></i> Blokkol</a></li>
                                                                <?php } ?>
                                                                <?php if ($value['crew_member_status'] == 0) { ?>
                                                                    <li><a rel="<?php echo $value['crew_member_id']; ?>" href="admin/crew_members/change_status" id="make_active_<?php echo $value['crew_member_id']; ?>" data-action="make_active"><i class="fa fa-check"></i> Aktivál</a></li>
                                                                <?php } ?>
                                                            <?php }; ?>	
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>	
                                </tbody>
                            </table>	
                        </div> <!-- END PORTLET BODY -->
                    </div> <!-- END PORTLET -->

                </form>					

            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->    
</div>                                                            
<!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END CONTAINER -->
<div id="loadingDiv" style="display:none;"></div>	