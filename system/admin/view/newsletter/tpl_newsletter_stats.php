<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Elküldött <small>hírlevelek</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="admin/newsletter">Elküldött hírlevelek</a></li>
            </ul>
        </div>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->

                <!-- echo out the system feedback (error and success messages) -->
                <?php $this->renderFeedbackMessages(); ?>


                <form class="horizontal-form" id="del_newsletter_form" method="POST" action="admin/newsletter/delete_newsletter">	

                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-user"></i>Hírlevél küldés statisztikák</div>

                            <div class="actions">

                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="#" class="btn btn-sm default">
                                        <i class="fa fa-wrench"></i> Eszközök <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="#" id="print_newsletter"><i class="fa fa-print"></i> Nyomtat </a>
                                        </li>
                                        <!--        <li>
                                                    <a href="#" id="export_newsletter"><i class="fa fa-file-excel-o"></i> Export CSV </a>
                                                </li> -->
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="portlet-body">

                            <!-- *************************** newsletter TÁBLA *********************************** -->						

                            <table class="table table-striped table-bordered table-hover" id="newsletter_table">
                                <thead>
                                    <tr class="heading">
                                        <th>Cím</th>
                                        <th>Tárgy</th>
                                        <th>Időpont</th>
                                        <th>Címzett</th>
                                        <th>Elküldve <a class="popovers" data-placement="top" data-trigger="hover" data-original-title="Elküldött hírlevelek száma" data-content="Sikeres küldések / sikertelen küldések" data-container="body" href="javascript:;"> <i class="fa fa-info-circle"></i> </a></th>
                                        <th>Megnyitás <a class="popovers" data-placement="top" data-trigger="hover" data-original-title="E-mail megnyitások száma" data-content="Összes megnyitás / egyedi megnyitás" data-container="body" href="javascript:;"> <i class="fa fa-info-circle"></i> </a></th>
                                        <th>Kattintás <a class="popovers" data-placement="top" data-trigger="hover" data-original-title="Link kattintások száma" data-content="Az e-mailben található linkekre történt kattintások száma. Összes kattintás / egyedi kattintás" data-container="body" href="javascript:;"> <i class="fa fa-info-circle"></i> </a></th>
                                        <th>Leiratkozás</th>
                                        <th>Státusz</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($this->newsletters as $value) { ?>

                                        <tr class="odd gradeX">

                                            <td><?php echo $value['newsletter_name']; ?></td>
                                            <td><?php echo $value['newsletter_subject']; ?></td>
                                            <td><?php echo date('Y-m-d H:i', $value['sent_date']); ?></td>
                                            <td><?php echo $value['recepients']; ?></td>
                                            <td><?php echo $value['send_success'] . ' / ' . $value['send_fail']; ?></td>
                                            <td><?php echo ($value['email_opens'] != 0) ? $value['email_opens'] : '0';?> / <?php echo ($value['unique_email_opens'] != 0) ? $value['unique_email_opens'] : '0';?></td>
                                            <td><?php echo ($value['email_clicks'] != 0) ? $value['email_clicks'] : '0';?> / <?php echo ($value['unique_email_clicks'] != 0) ? $value['unique_email_clicks'] : '0'; ?></td>
                                            <td><?php echo ($value['unsubscribe_count'] != 0) ? $value['unsubscribe_count'] : '0'; ?></td>
                                            <td><?php echo ($value['progress_status'] == 2) ? '<span class="label label-sm label-success">Elküldve</span>' : '<span class="label label-sm label-warning">Részleges</span>'; ?></td>

                                            <td>
                                                <div class="actions">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm grey-steel" href="#" data-toggle="dropdown" <?php echo (Session::get('user_role_id') <= 0) ? 'disabled' : ''; ?>>
                                                            <i class="fa fa-cogs"></i>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">

                                                            <li>
                                                                <a href="admin/newsletter/newsletter_stat/<?php echo $value['statid']; ?>"><i class="fa fa-bar-chart-o"></i> Statisztika</a>
                                                            </li>


                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <!--
                                            <td>
                                                    <button type="button" name="submit_newsletter" id="submit_newsletter_<?php //echo $value['newsletter_id'];    ?>" value="<?php //echo $value['newsletter_id'];    ?>" class="btn btn-sm default">Hírlevél elküldése</button>
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

</div><!-- END CONTAINER -->
<div id="loadingDiv"></div>	