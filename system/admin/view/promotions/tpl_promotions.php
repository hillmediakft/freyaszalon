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
            <li><span>Akciók kezelése</span></li>
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
                    <div class="caption"><i class="fa fa-tags"></i>Akciók kezelése</div>
                    <div class="actions">
                        <a class="btn blue-steel btn-sm" href="admin/promotions/new_promotion"><i class="fa fa-plus"></i> Új akció hozzáadása</a>
                    </div>
                </div>

                <div class="portlet-body">

                    <div id="loadingDiv"></div>

                    <div id="message"></div> 

                    <table class="table table-hover slider_list">
                        <thead>
                            <tr class="heading">
                                <th style="width: 250px">Kép</th>
                                <th>Akció címe</th>
                                <th>Akció szövege</th>
                                <th>Létrehozás</th>
                                <th><i class="fa fa-eye"></i></th>
                                <th>Státusz</th>
                                <th style="width: 120px"></th>
                            </tr>
                        </thead>
                        <tbody id="promotions_list">						

                            <?php foreach ($this->promotions as $value) { ?>
                                <tr id="promotion_<?php echo $value['id']; ?>" class="odd gradeX">

                                    <td><img src="<?php echo Util::thumb_path($value['picture']); ?>"></td>
                                    <td><?php echo $value['title']; ?></td>
                                    <td><?php echo Util::sentence_trim($value['text'], 1); ?></td>
                                    <td><?php echo $value['created']; ?></td>
                                    <td><?php echo $value['clicks']; ?></td>

                                    <?php if ($value['active'] == 1) { ?>
                                        <td><span class="label label-sm label-success"><?php echo 'Aktív'; ?></span></td>
                                    <?php } ?>
                                    <?php if ($value['active'] == 0) { ?>
                                        <td><span class="label label-sm label-danger"><?php echo 'Inaktív'; ?></span></td>
                                    <?php } ?>
                                    <td>									
                                        <div class="actions">
                                            <div class="btn-group">
                                                <a class="btn btn-sm grey-steel" href="#" data-toggle="dropdown">
                                                    <i class="fa fa-cogs"></i> Műveletek
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="admin/promotions/edit/<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Szerkeszt</a></li>
                                                    <li><a href="admin/promotions/delete/<?php echo $value['id']; ?>" id="delete_<?php echo $value['id']; ?>"><i class="fa fa-trash"></i> Töröl</a></li>


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
