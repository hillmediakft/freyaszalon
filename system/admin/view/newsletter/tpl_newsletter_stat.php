<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">

    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Elküldött hírlevél <small>statisztikái</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="admin/newsletter">Elküldött hírlevél statisztikái</a></li>
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




                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-bar-chart-o"></i>Kampány statisztikák: <?php echo $this->newsletter_stat['newsletter_name'] . ' | ' . date('Y-m-d H:i', $this->newsletter_stat['sent_date']); ?> </div>

                        <div class="actions">

                            <div class="btn-group">
                                <a class="btn button-sm default" href="admin/newsletter/newsletter_stats"> <i class="fa fa-arrow-left"></i> Vissza az elküldött hírlevelekhez </a>
                            </div>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <!-- *************************** newsletter TÁBLA *********************************** -->						




                        <div class="tabbable-custom ">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab_5_1">
                                        Általános statisztika </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab_5_2">
                                        Megnyitások </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab_5_3">
                                        Kattintások </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab_5_1" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <table class="table table-hover">
                                                <thead>
                                                    <tr class="heading">
                                                        <th colspan="2">Alap adatok</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <td>Kampány címe</td>
                                                        <td><?php echo $this->newsletter_stat['newsletter_name']; ?></td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td>Kampány tárgya</td>
                                                        <td><?php echo $this->newsletter_stat['newsletter_subject']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Küldés időpontja</td>
                                                        <td><?php echo date("Y-m-d H:i", $this->newsletter_stat['sent_date']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Címzettek száma</td>
                                                        <td><?php echo $this->newsletter_stat['recepients']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sikeres / sikertelen küldések száma</td>
                                                        <td><?php echo $this->newsletter_stat['send_success'] . ' / ' . $this->newsletter_stat['send_fail']; ?></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Megnyitások száma</td>
                                                        <td><?php echo $this->newsletter_stat['email_opens'] . '  összes / ' . $this->newsletter_stat['unique_email_opens'] . ' egyedi'; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Megnyitási arány</td>
                                                        <td>
														<?php if($this->newsletter_stat['recepients']) {
															echo number_format(($this->newsletter_stat['unique_email_opens'] / $this->newsletter_stat['recepients'] * 100),2) . '%'; 
														} else { 
															echo 'nincs adat';
														}?>
														</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kattintások száma</td>
                                                        <td><?php echo $this->newsletter_stat['email_clicks'] . '  összes / ' . $this->newsletter_stat['unique_email_clicks'] . ' egyedi'; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Leiratkozások száma</td>
                                                        <td><?php echo $this->newsletter_stat['unsubscribe_count']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="col-md-6 col-lg-6">

                                            <div class="portlet-body">
                                                <h4>Megnyitási arány</h4>
                                                <div id="pie_chart" class="chart">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="tab_5_2" class="tab-pane">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">

                                            <table class="table table-hover">
                                                <thead>
                                                    <tr class="heading">
                                                        <th colspan="2">Megnyitások statisztika</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <td>Elküldött e-mailek</td>
                                                        <td><?php echo $this->newsletter_stat['recepients']; ?></td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td>Összes megnyitás</td>
                                                        <td><?php echo $this->newsletter_stat['email_opens']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Egyedi megnyitások</td>
                                                        <td><?php echo $this->newsletter_stat['unique_email_opens']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Megnyitási arány</td>
                                                        <td><?php if($this->newsletter_stat['recepients']) {
															echo number_format(($this->newsletter_stat['unique_email_opens'] / $this->newsletter_stat['recepients']) * 100, 2) . '%';
															} else { 
															echo 'nincs adat';
															}
															?></td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="col-md-8 col-lg-8">
                                            <div class="portlet-body">
                                                <div id="opens_chart_legendPlaceholder">
                                                </div>
                                                <div id="opens_chart" class="chart">
                                                </div>
                                            </div>  

                                        </div>



                                    </div>
                                </div>
                                <div id="tab_5_3" class="tab-pane">

                                    <div class="row">
                                        <div class="col-md-4 col-lg-4">

                                            <table class="table table-hover">
                                                <thead>
                                                    <tr class="heading">
                                                        <th colspan="2">Kattintások statisztika</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <td>Elküldött e-mailek</td>
                                                        <td><?php echo $this->newsletter_stat['recepients']; ?></td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td>Összes kattintás</td>
                                                        <td><?php echo $this->newsletter_stat['email_clicks']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Egyedi kattintások</td>
                                                        <td><?php echo $this->newsletter_stat['unique_email_clicks']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kattintási arány</td>
                                                        <td><?php if($this->newsletter_stat['recepients']) {
															echo number_format(($this->newsletter_stat['unique_email_clicks'] / $this->newsletter_stat['recepients']) * 100, 2) . '%'; 
															} else { 
															echo 'nincs adat';
															}
															?></td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>                                    

                                        <div class="col-md-8 col-lg-8">
                                            <div class="portlet-body">
                                                <div id="clicks_chart_legendPlaceholder">
                                                </div>
                                                <div id="clicks_chart" class="chart">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>










                    </div>
                </div>





            </div>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->    




</div>                                                            
<!-- END PAGE CONTENT WRAPPER -->

</div><!-- END CONTAINER -->
<div id="loadingDiv"></div>	