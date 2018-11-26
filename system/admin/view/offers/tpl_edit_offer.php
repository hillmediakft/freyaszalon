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
            <li><span>Csomag szerkesztése</span></li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>  


    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12 margin-bottom-20">
                    <a class ='btn btn-default' href='admin/offers'><i class='fa fa-arrow-left'></i>  Vissza az ajánlatokhoz</a>
                </div>
            </div>	

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet">

                <div class="portlet-body">


                    <h2 class='cim1'>Ajánlat szerkesztése</h2>
                    <br />
                    <form action='' name='update_offer_form' id='update_offer_form' method='POST'>

                        <input type="hidden" name="offer_id" id="offer_id" value="<?php echo $this->data_arr[0]['id'] ?>">

                        <div class="form-group">
                            <label for="offer_code">Kód</label>	
                            <input type="text" name="offer_code" class="form-control input-large" value="<?php echo $this->data_arr[0]['code']; ?>" disabled="" />
                        </div>

                        <div class="form-group">
                            <label for="offer_title">Megnevezés</label>	
                            <input type='text' name='offer_title' class='form-control input-large' value="<?php echo $this->data_arr[0]['title']; ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="offer_package">Ajánlat</label>
                            <textarea type='text' name='offer_package' class='form-control'><?php echo $this->data_arr[0]['package'] ?></textarea>
                        </div>


                        <input class="btn green submit" type="submit" name="submit_update_offer" value="Mentés">

                    </form>									

                </div> <!-- END USER GROUPS PORTLET BODY-->
            </div> <!-- END USER GROUPS PORTLET-->
        </div> <!-- END COL-MD-12 -->
    </div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div> <!-- END CONTAINER -->