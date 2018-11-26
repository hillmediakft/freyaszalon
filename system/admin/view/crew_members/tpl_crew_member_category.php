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
                <span>Munkatársak kategóriák</span>
            </li>
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
                    <div class="caption"><i class="fa fa-list"></i>Munkakör kategóriák</div>

                    <div class="actions">
                        <a href="admin/crew_members/category_insert" class="btn blue btn-sm"><i class="fa fa-plus"></i> Új kategória</a>

                    </div>

                </div>
                <div class="portlet-body">




                    <table class="table table-striped table-bordered table-hover" id="job_category">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Szolgáltatás kategória elnevezése</th>
                                <th>Munkatársak száma a kategóriában</th>
                                <th style="width: 1%;"></th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($this->all_crew_member_category as $value) { ?>

                                <tr class="odd gradeX">

                                    <td><?php echo $value['crew_member_category_id']; ?></td>
                                    <td><?php echo $value['crew_member_category_name']; ?></td>
                                    <?php
                                    // megszámoljuk, hogy az éppen aktuális kategóriának mennyi eleme van a jobs tábla job_category_id oszlopában
                                    $counter = 0;
                                    foreach ($this->crew_members_counter as $v) {
                                        if ($value['crew_member_category_id'] == $v['crew_member_category']) {
                                            $counter++;
                                        }
                                    }
                                    ?>
                                    <td><?php echo $counter; ?></td>

                                    <td>									
                                        <div class="actions">
                                            <div class="btn-group">
                                                <a class="btn btn-sm grey-steel" href="#" data-toggle="dropdown" <?php echo (Session::get('user_role_id') <= 2) ? '' : 'disabled'; ?>>
                                                    <i class="fa fa-cogs"></i> Műveletek
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">

                                                    <li><a href="admin/crew_members/category_update/<?php echo $value['crew_member_category_id']; ?>"><i class="fa fa-pencil"></i> Szerkeszt</a></li>
                                                    <li><a id="delete_crew_member_category" href="admin/crew_members/delete_category/<?php echo $value['crew_member_category_id']; ?>"><i class="fa fa-trash"></i> Töröl</a></li>
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