<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Hírlevél sablonok<small> kezelése</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="admin/template">Hírlevél sablonok</a></li>
            </ul>
        </div>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div id="message">




                </div>
                <!-- echo out the system feedback (error and success messages) -->
                <?php $this->renderFeedbackMessages(); ?>


                <form class="horizontal-form" id="del_template_form" method="POST" action="admin/newsletter/delete_template">	

                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-user"></i>Hírlevél sablonok</div>

                            <div class="actions">
                                <a href="admin/newsletter/new_template" class="btn blue btn-sm"><i class="fa fa-plus"></i> Új sablon</a>
                                <button class="btn red btn-sm" name="del_template_submit" type="submit"><i class="fa fa-trash"></i> Csoportos törlés</button>
                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="#" class="btn btn-sm default">
                                        <i class="fa fa-wrench"></i> Eszközök <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="#" id="print_template"><i class="fa fa-print"></i> Nyomtat </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="portlet-body">

                            <!-- *************************** template TÁBLA *********************************** -->						

                            <table class="table table-striped table-bordered table-hover" id="template_table">
                                <thead>
                                    <tr class="heading">
                                        <th class="table-checkbox">
                                            <input type="checkbox" class="group-checkable" data-set="#template_table .checkboxes"/>
                                        </th>
                                        <th>Név</th>
                                        <th>Leírás</th>
                                        <th title="Létrehozás dátuma">Létrehozva</th>


                                        <th style="width:120px;"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($this->templates as $value) { ?>

                                        <tr class="odd gradeX">
                                            <td>
                                                <?php if (Session::get('user_role_id') > 0) { ?>
                                                    <input type="checkbox" class="checkboxes" name="template_id_<?php echo $value['template_id']; ?>" value="<?php echo $value['template_id']; ?>"/>
                                                <?php } ?>	
                                            </td>
                                            <td><?php echo $value['name']; ?></td>
                                            <td><?php echo $value['description']; ?></td>
                                            <td><?php echo $value['create_date']; ?></td>




                                            <td>
                                                <div class="actions">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm green" href="#" data-toggle="dropdown" <?php echo (Session::get('user_role_id') <= 0) ? 'disabled' : ''; ?>>
                                                            <i class="fa fa-cogs"></i> Műveletek
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">

                                                            <li>
                                                                <a href="admin/newsletter/edit_template/<?php echo $value['template_id']; ?>"><i class="fa fa-pencil"></i> Szerkeszt</a>
                                                            </li>

                                           <!--                 <li>
                                                                <a href="#" id="show_preview_modal_<?php echo $value['template_id']; ?>_" data-id="<?php echo $value['template_id']; ?>"><i class="fa fa-eye"></i> Előnézet</a>
                                                            </li>   -->                                                         

                                                            
                                                            <li><a href="newsletters/delete_template/<?php echo $value['template_id'];?>" id="delete_template_<?php echo $value['template_id'];     ?>" rel="<?php echo $value['template_id'];?>"> <i class="fa fa-trash"></i> Töröl</a></li>
                                                           

                                              <!--              <li>
                                                                <a id="delete_template_<?php echo $value['template_id']; ?>" rel="<?php echo $value['template_id']; ?>"><i class="fa fa-trash"></i> Töröl</a>
                                                            </li> -->

                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <!--
                                            <td>
                                                    <button type="button" name="submit_template" id="submit_template_<?php //echo $value['template_id'];     ?>" value="<?php //echo $value['template_id'];     ?>" class="btn btn-sm default">Hírlevél elküldése</button>
                                            </td>
                                            -->

                                        </tr>

                                    <?php } ?>	

                                </tbody>
                            </table>	
                        </div>
                    </div>
                </form>	

            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->    




</div>                                                            
<!-- END PAGE CONTENT WRAPPER -->
<div id="loadingDiv"></div>


<!--- *** preview modal **** -->

<!-- Modal -->
<div class="modal fade modal-scroll" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Sablon előnézet</h4>
            </div>
            <div class="modal-body">
                <div id="template_preview"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
