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
                <span>Oldalak</span>
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
                    <div class="caption"><i class="fa fa-file"></i>Szerkeszthető oldalak</div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="users">
                        <thead>
                            <tr class="heading">
                                <th>Oldal</th>
                                <th>Cím (meta title)</th>
                                <th>URL</th>
                                <th>Címkék</th>
                                <th style="width:0px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->all_pages as $value) { ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $value['page_title']; ?></td>
                                    <td><?php echo $value['page_metatitle']; ?></td>
                                    <td><?php echo $value['page_friendlyurl']; ?></td>
                                    <td><?php echo $value['page_tags']; ?></td>
                                    <td>									
                                        <a class="btn btn-sm grey-steel" href="admin/pages/update/<?php echo $value['page_id']; ?>"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>										
                        </tbody>
                    </table>
                </div> <!-- END PORTLET BODY-->
            </div> <!-- END PORTLET-->

        </div> <!-- END COL-MD-12 -->
    </div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT-->