<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Új hírlevél <small>szerkesztése</small>
        </h3>


        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="#">Hírlevél szerkesztése</a></li>
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
                        <div class="caption"><i class="fa fa-film"></i>Hírlevél szerkesztése</div>
                    </div>

                    <div class="portlet-body">


                        <div class="space10"></div>							
                        <div class="row">	
                            <div class="col-md-12">		

                                <form action="" method="POST" id="edit_newsletter">	

                                    <div class="row">
                                        <div class="col-md-6">										

                                            <div class="form-group">
                                                <label for="newsletter_name" class="control-label">Név</label>
                                                <input type="text" name="newsletter_name" id="newsletter_name" value="<?php echo $this->newsletter[0]['newsletter_name']; ?>" placeholder="" class="form-control input-xlarge" />
                                            </div>
                                            <div class="form-group">
                                                <label for="newsletter_subject" class="control-label">Tárgy</label>
                                                <input type="text" name="newsletter_subject" id="newsletter_subject" value="<?php echo $this->newsletter[0]['newsletter_subject']; ?>" placeholder="" class="form-control input-xlarge" />
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
                            <label for="newsletter_body" class="control-label">Tartalom</label>
                            <textarea name="newsletter_body" id="newsletter_body" placeholder="" class="form-control input-xlarge"><?php echo $this->newsletter[0]['newsletter_body']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="newsletter_status">Státusz</label>
                            <select name='newsletter_status' class="form-control input-xlarge">
                                <option value="1" <?php echo ($this->newsletter[0]['newsletter_status'] == 1) ? "selected='selected'" : ''; ?> >Aktív</option>
                                <option value="0" <?php echo ($this->newsletter[0]['newsletter_status'] == 0) ? "selected='selected'" : ''; ?> >Inaktív</option>
                            </select>
                        </div>

                        <div class="space10"></div>
                        <button class="btn green submit" type="submit" value="submit" name="submit_edit_newsletter">Mentés <i class="fa fa-check"></i></button>
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