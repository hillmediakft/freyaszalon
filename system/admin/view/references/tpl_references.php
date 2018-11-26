<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Refrenciák <small>szerkesztése</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="#">Referenciák szerkesztése</a></li>
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
                        <div class="caption"><i class="fa fa-file"></i>Referenciák</div>
                        <div class="actions">
                            <a class="btn blue" href="admin/references/new_reference">
                                            Új referencia hozzáadása <i class="fa fa-plus-circle"></i>
                                        </a>
                        </div>    
                    </div>
                    <div class="portlet-body">

 						
                        <table class="table table-striped table-bordered table-hover" id="content">
                            <thead>
                                <tr class="heading">
                                    <th>#id</th>
                                    <th style="width: 100px">Poster</th>
                                    <th>Cím</th>
                                    <th>Év</th>
                                    <th>Rendező</th>
                                    <th>Szereplők</th>
                                    <th>IMDb id</th>
                                    <th style="width:110px"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($all_reference as $value) { ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $value['reference_id']; ?></td>
                                        <td><img src="<?php echo $value['reference_poster']; ?>" class="img-responsive"></td>
                                        <td><?php echo $value['reference_title']; ?></td>
                                        <td><?php echo $value['reference_year']; ?></td>
                                        <td><?php echo $value['reference_director']; ?></td>
                                        <td><?php echo $value['reference_actors']; ?></td>
                                        <td><?php echo $value['reference_imdb_id']; ?></td>
                                       

                                        <td>
                                            <div class="actions">
                                                <div class="btn-group">
                                                    <a class="btn btn-sm grey-steel" href="#" data-toggle="dropdown">
                                                        <i class="fa fa-cogs"></i> Műveletek
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">

                                                        <li><a href="admin/references/delete/<?php echo $value['reference_id']; ?>" id="delete_<?php echo $value['reference_id']; ?>"><i class="fa fa-trash"></i> Töröl</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                <?php } ?>					

                            </tbody>
                        </table>
                    </div> <!-- END USER GROUPS PORTLET BODY-->
                </div> <!-- END USER GROUPS PORTLET-->
            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div> <!-- END CONTAINER -->