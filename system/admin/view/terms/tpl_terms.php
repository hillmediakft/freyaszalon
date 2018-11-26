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
            <li>Címkék</li>
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

            <form class="horizontal-form" id="del_terms_form" method="POST" action="admin/terms/delete_terms">	

                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-shopping-cart"></i>Címkék listája</div>
                        <div class="actions">
                            <a data-toggle="modal" href="#add_term"   href="admin/terms/new_terms" class="btn blue btn-sm"><i class="fa fa-plus"></i> Új címke</a>
                            <button class="btn red btn-sm" name="delete_terms_submit" value="submit" type="submit"><i class="fa fa-trash"></i> Csoportos törlés</button>

                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- *************************** JOBS TÁBLA *********************************** -->						
                        <table class="table table-striped table-bordered table-hover" id="terms">
                            <thead>
                                <tr class="heading">
                                    <th style="width:1%;">

                                    </th>
                                    <th>Címke</th>
                                    <th style="width:1%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->terms as $value) { ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <?php if (Session::get('user_role_id') < 3) : ?>
                                                <input type="checkbox" class="checkboxes" name="terms_id_<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>"/>
                                            <?php endif; ?>	
                                        </td>
                                        <td><?php echo $value['term']; ?></td>

                                        <td>									
                                            <div class="actions">
                                                <div class="btn-group">
                                                    <a class="btn btn-sm grey-steel" href="#" data-toggle="dropdown" <?php echo ((Session::get('user_role_id') >= 2)) ? 'disabled' : ''; ?>>
                                                        <i class="fa fa-cogs"></i> 

                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <?php if ((Session::get('user_role_id') < 3)) { ?>	
                                                            <li><a data-toggle="modal" href="#edit_term"  href="<?php echo 'admin/terms/update_terms/' . $value['id']; ?>"><i class="fa fa-pencil"></i> Szerkeszt</a></li>
                                                        <?php }; ?>

                                                        <?php if ((Session::get('user_role_id') < 3)) { ?>	
                                                            <li><a href="<?php echo 'admin/terms/delete_term/' . $value['id']; ?>" id="delete_term_<?php echo $value['id']; ?>"> <i class="fa fa-trash"></i> Töröl</a></li>
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
<?php $this->load('tpl_edit_term_modal'); ?>
<?php $this->load('tpl_add_term_modal'); ?>