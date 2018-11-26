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
            <li><span>Kedvezményes csomagok</span></li>
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
                    <div class="caption"><i class="fa fa-file"></i>Ajánlatok</div>

                </div>
                <div class="portlet-body">


                    <table class="table table-striped table-bordered table-hover" id="content">
                        <thead>
                            <tr class="heading">
                                <th style="width:50px">#id</th>
                                <th style="width:50px">Kód</th>
                                <th>Leírás</th>
                                <th>Ajánlat</th>
                                <th style="width:110px"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($this->all_offers as $value) { ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $value['id']; ?></td>
                                    <td><?php echo $value['code']; ?></td>
                                    <td><?php echo $value['title']; ?></td>
                                    <td><?php echo $value['package']; ?></td>

                                    <td>
                                        <div class="actions">
                                            <div class="btn-group">
                                                <a class="btn btn-sm green" href="#" data-toggle="dropdown">
                                                    <i class="fa fa-cogs"></i> Műveletek
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="admin/offers/edit/<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Szerkeszt</a></li>

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