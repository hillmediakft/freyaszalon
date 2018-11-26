<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Új sablon <small>létrehozása</small>
        </h3>


        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="#">Új sablon</a></li>
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
                <div class="portlet light bg-inverse">

                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-film"></i>Új sablon</div>
                    </div>

                    <div class="portlet-body">


                        <div class="space10"></div>							
                        <div class="row">	
                            <div class="col-md-12">						
                                <form action="" method="POST" id="add_message">	

                                    <div class="row">
                                        <div class="col-md-6">	
                                            <div class="form-group">
                                                <label for="template_name" class="control-label">Név</label>
                                                <input type="text" name="template_name" id="template_name" placeholder="" class="form-control input-xlarge" />
                                            </div>
                                            <div class="form-group">
                                                <label for="template_description" class="control-label">Leírás</label>
                                                <input type="text" name="template_description" id="template_description" placeholder="" class="form-control input-xlarge" />
                                            </div>

                                        </div>
                                        <div class="col-md-6">	
                                            <h4>A hírlevél szövegébe beilleszthető elemek:</h4>
                                            <ul class="list-unstyled">
                                                <li><span class="badge badhe-sm badge-info">{$name}</span> a címzett neve</li>
                                                <li><span class="badge badhe-sm badge-info">{$unsubscribe}</span> leiratkozási link</li> 
                                                <li><span class="badge badhe-sm badge-info">{$email}</span> a címzett e-mail címe</li>
                                                <li><span class="badge badhe-sm badge-info">{$date}</span> aktuális dátum</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12">	
                                            <div class="alert alert-danger"><i class="fa fa-info-circle fa-2x"></i> A weblapra mutató linkekben az URL-t a következő formátumban kell megadni: <strong>https://freyaszalon.hu</strong> !!! Ha más a formátum pl.: <strong>www.freyaszalon.hu, http://freyaszalon.hu, http://www.freyaszalon.hu</strong>, akkor a rendszer a kattintásokat nem tudja nyilvántartani!</div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>									

                                    <div class="form-group">
                                        <label for="template_body" class="control-label">Tartalom</label>
                                        <textarea name="template_body" id="template_body" placeholder="" class="form-control input-xlarge"></textarea>

                                    </div>


                                    <div class="space10"></div>
                                    <button class="btn green submit" type="submit" value="submit" name="submit_new_template">Mentés <i class="fa fa-check"></i></button>
                                </form>
                            </div>
                        </div>	


                        <div id="message"></div> 


                    </div> <!-- END USER GROUPS PORTLET BODY-->
                </div> <!-- END USER GROUPS PORTLET-->
            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div><!-- END CONTAINER -->