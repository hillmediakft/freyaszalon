<!-- /.inner title Start ./-->
<section class="inner-titlebg">
    <div class="raster"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bcrumb pull-right hidden-xs">
                        <li><a href="/">Kezdőoldal</a></li>
                        <li><a href="javascript:void()"> Kalkulátor</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- // Banner Section
================================= -->    
<div class="gap"></div>

<!-- /.Services Start ./-->

<section class="services-details">
    <div class="container">
        <div class="row">

            <div class="col-lg-9 col-md-9">
                <div class="calculator-box">
                    <div class="row">




                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="contact-details contact">
                                <h2>Testre szabott kedvezményes csomagok</h2>
                                <p>Amennyiben új kalkulációt szeretne elvégezni, válasszi ki a paramétereket (nem, leadni kívánt súly, fogyás hetékonyságát növelő mozgás) és kattintson a "csomag kalkuláció" gombra!</p>
                                <hr>

                                <div class="signup">					
                                    <form action="csomag-kalkulator" method="post" name="kalkulator" id="kalkulator">
                                        <ul class="row">
                                            <li class="col-lg-3">
                                                <label>Nem*</label>
                                                <select id="gender" class="form-control" name="gender">
                                                    <option value="2">Nő</option>
                                                    <option value="1">Férfi</option>
                                                </select>
                                            </li>
                                            <li class="col-lg-3">
                                                <label>Leadni kívánt súly*</label>
                                                <select id="weight_loss" class="form-control" name="weight_loss">
                                                    <option value="1">5 kg-nál kevesebb</option>
                                                    <option value="2">5 kg-nál több</option>
                                                </select>
                                            </li>
                                            <li class="col-lg-6">
                                                <label>Fogyás hatékonyságát növelő mozgás*</label>
                                                <select id="training" class="form-control" name="training">
                                                    <option value="1">Fogyás hatékonyságát intenzív mozgással növelem</option>
                                                    <option value="2">Fogyás hatékonyságát kímélő mozgással növelem</option>
                                                </select>
                                            </li>
                                        </ul>
                                        <div class="mezes_bodon">
                                            <input type="text" name="mezes_bodon">
                                        </div>
                                        <ul>
                                            <li>
                                                <input type="submit" value="Csomag kalkuláció" name="submit_kalkulator" id="submit_kalkulator">
                                            </li>
                                        </ul>
                                    </form>	
                                </div>


                            </div>

                        </div>
                    </div>



                    <div id="package"></div>




                    <div id="message"></div>

                    <div class="gap"></div>

                    <div id="email_message"></div>			
                </div>
            </div>
                <!-- Sidebar -->
                <?php require('system/site/view/_template/tpl_sidebar_services2.php'); ?> 

        </div>
    </div>
</section>
<!-- /.Services End ./-->

<div class="gap"></div>