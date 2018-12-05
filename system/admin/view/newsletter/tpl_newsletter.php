<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Hírlevél <small>kezelése</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="admin/newsletter">Hírlevél</a></li>
            </ul>
        </div>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->

                <div id="ajax_message"></div>
                <!-- echo out the system feedback (error and success messages) -->
                <?php $this->renderFeedbackMessages(); ?>


                <form class="horizontal-form" id="del_newsletter_form" method="POST" action="admin/newsletter/delete_newsletter">	

                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-user"></i>Hírlevelek</div>

                            <div class="actions">
                                <a href="admin/newsletter/new_newsletter" class="btn blue btn-sm"><i class="fa fa-plus"></i> Új hírlevél</a>
                                <button class="btn red btn-sm" name="delete_newsletter" type="submit"><i class="fa fa-trash"></i> Csoportos törlés</button>
                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="#" class="btn btn-sm default">
                                        <i class="fa fa-wrench"></i> Eszközök <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="#" id="print_newsletter"><i class="fa fa-print"></i> Nyomtat </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="portlet-body">

                            <!-- *************************** newsletter TÁBLA *********************************** -->						

                            <table class="table table-striped table-bordered table-hover" id="newsletter_table">
                                <thead>
                                    <tr class="heading">
                                        <th class="table-checkbox" style="width:0px;">
                                            <input type="checkbox" class="group-checkable" data-set="#newsletter_table .checkboxes"/>
                                        </th>
                                        <th>Név</th>
                                        <th>Tárgy</th>
                                        <th title="Létrehozás dátuma">Létrehozva</th>
                                        <th title="Utolsó küldés dátuma">Küldés dátuma</th>
                                        <th>Státusz</th>
                                        <th style="width:0px;"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($this->newsletters as $value) { ?>

                                        <tr class="odd gradeX">
                                            <td>
                                                <?php if (Session::get('user_role_id') > 0 && empty($value['sent_date'])) { ?>
                                                    <input type="checkbox" class="checkboxes" name="newsletter_id_<?php echo $value['newsletter_id']; ?>" value="<?php echo $value['newsletter_id']; ?>"/>
                                                <?php } ?>	
                                            </td>
                                            <td><?php echo $value['newsletter_name']; ?></td>
                                            <td><?php echo $value['newsletter_subject']; ?></td>
                                            <td><?php echo $value['newsletter_create_date']; ?></td>
                                            <td><?php echo (empty($value['sent_date'])) ? '<span class="label label-sm label-info">Nincs dátum</span>' : date('Y-m-d H:i', $value['sent_date']); ?></td>

                                            <td>
                                                <?php 
                                                    if ($value['progress_status'] == 0) {
                                                        echo '<span class="label label-sm label-default">Nincs elküldve</span>';
                                                    } elseif ($value['progress_status'] == 1) {
                                                        echo '<span class="label label-sm label-danger">Folyamatban</span>';
                                                    } elseif ($value['progress_status'] == 2) {
                                                        echo '<span class="label label-sm label-success">Elküldve</span>';
                                                    }
                                                ?>
                                            </td>

                                            <td>
                                                <div class="actions">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm grey-steel" href="#" data-toggle="dropdown" <?php echo (Session::get('user_role_id') <= 0) ? 'disabled' : ''; ?>>
                                                            <i class="fa fa-cogs"></i> Műveletek
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">


                                                            <?php if ($value['progress_status'] == 1 || $value['progress_status'] == 2) { ?>
                                                                <li>
                                                                    <a class="show_preview_modal" data-id="<?php echo $value['newsletter_id']; ?>"><i class="fa fa-eye"></i> Megtekintés</a>
                                                                </li>
                                                                <li>
                                                                    <a href="admin/newsletter/newsletter_stat/<?php echo $value['statid']; ?>"><i class="fa fa-bar-chart-o"></i> Statisztika</a>
                                                                </li>
                                                            <?php } else { ?> 

                                                                <li>
                                                                    <a id="send_test_email_<?php echo $value['newsletter_id']; ?>" data-id="<?php echo $value['newsletter_id']; ?>" data-subject="<?php echo $value['newsletter_subject']; ?>"><i class="fa fa-arrow-circle-o-right"></i> Teszt e-mail elküldése</a>
                                                                </li>
                                                                <li>
                                                                    <a id="submit_newsletter_<?php echo $value['newsletter_id']; ?>" rel="<?php echo $value['newsletter_id']; ?>" data-statid="<?php echo $value['statid']; ?>"><i class="fa fa-envelope"></i> Hírlevél elküldés időpontja</a>
                                                                </li>
                                                                <li>
                                                                    <a href="admin/newsletter/edit_newsletter/<?php echo $value['newsletter_id']; ?>"><i class="fa fa-pencil"></i> Szerkeszt</a>
                                                                </li>
                                                                <!--
                                                                <li><a href="<?php //echo $this->registry->site_url . 'newsletter/delete_newsletter/' . $value['newsletter_id'];      ?>" id="delete_newsletter_<?php //echo $value['newsletter_id'];      ?>" rel="<?php //echo $value['newsletter_id'];      ?>"> <i class="fa fa-trash"></i> Töröl</a></li>
                                                                -->
                                                                <li>
                                                                    <a id="delete_newsletter_<?php echo $value['newsletter_id']; ?>" rel="<?php echo $value['newsletter_id']; ?>"><i class="fa fa-trash"></i> Töröl</a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <!--
                                            <td>
                                                    <button type="button" name="submit_newsletter" id="submit_newsletter_<?php //echo $value['newsletter_id'];      ?>" value="<?php //echo $value['newsletter_id'];      ?>" class="btn btn-sm default">Hírlevél elküldése</button>
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


<!-- KÜLDÉS ÉS DATEPICKER MODAL -->
<div id="datepicker_modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Válassza ki a hírlevél küldésének időpontját</h4>
                <p>A hírlevél küldése automatikusan fog elindulni a megadott időpontban.</p>
            </div>
            <div class="modal-body">

                <form action="#" class="form-horizontal" id="datetime_form">
                   
                    <div class="form-group">
                        <label class="control-label col-md-4">Időpont megadása</label>
                        <div class="col-md-8">
                            <div class="input-group date form_datetime input-large">
                                <input type="text" size="16" readonly class="form-control" id="datetime_data">
                                <span class="input-group-btn">
                                    <button class="btn default date-set" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button class="btn grey-salsa btn-outline" data-dismiss="modal" aria-hidden="true">Bezárás</button>
                <button class="btn green btn-primary" id="datetime_send_button">Rendben</button>
            </div>
        </div>
    </div>
</div>

<!--- *** preview modal **** -->
<div class="modal fade" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Hírlevél nézet</h4>
            </div>
            <div class="modal-body">
                <iframe id="newsletter_preview" srcdoc="" style="border:0; width:100%; height:600px;"></iframe>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>
            </div>
        </div>
    </div>
</div>


<div id="loadingDiv"></div>

<?php include 'system/admin/view/newsletter/modal_send_newsletter.php'; ?>

<?php include 'system/admin/view/newsletter/modal_send_test_newsletter.php'; ?>