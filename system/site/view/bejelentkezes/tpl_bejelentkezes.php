<!-- Banner Section
================================= -->
<section class="animatedParent animateOnce subbanner subbanner-image subbanner-pattern-03 subbanner-type-2 subbanner-type-2-btn">
    <div class="container">
        <div class="subbanner-content banner-content">
            <div class="skew-effect fadeInLeft animated">
                <span class="fw-normal">Bejelentkezés
            </div>
            <ol class="breadcrumb text-left fadeInRight animated">
                <li><a href="/">Kezdőoldal</a></li>
                <li><a href="#">Bejelentkezés</a></li>
            </ol>
        </div>
    </div>

</section>

<!-- // Banner Section
================================= -->    




<!-- Services Section
================================================== -->

<section class="top-bottom-spacing grey-bg">
    <div class="container">
        <div class="row">
            <div class="clearfix">
                <!-- Section 1 -->
                <div class="col-md-4">


                    <div class="heading marbot40">
                        <h2>Jelentkezzen be kezelésre!</h2>
                        <?php echo $this->content; ?>


                    </div>

                    <div class="appointment-sidebar panel panel-body panel-grey bottom-right marbot40">
                        <ul class="cont-det">
                            <li class="border-seperator">
                                <h4>Bejelentkezés</h4>
                                <a href="#" class="reverse fw-500">
                                    <i class="fa fa-fw flaticon-clock location-icon color-light"></i> <?php echo $this->settings['tel']; ?>
                                </a>
                            </li>
                            <li class="border-seperator">
                                <h4>Rendelő</h4>
                                <a href="#" class="reverse fw-500">
                                    <i class="fa fa-fw flaticon-medical-21 location-icon color-light"></i> <?php echo $this->settings['cim']; ?>
                                </a>
                            </li>
                            <li>
                                <h4>E-mail</h4>
                                <a href="#" class="reverse fw-500">
                                    <i class="fa fa-fw fa-envelope location-icon color-light"></i> <?php echo $this->settings['email']; ?>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- // Section 1 -->

                <!-- Section 2 -->
                <div class="col-md-8">
                    <form id="appointment-form" class="appointment panel panel-body marbot40 panel-grey" method="post" action="send_email/init/appointment">
                        <h3>Kérjen időpontot</h3>
                        <p>Lorem ipsum dolem...</p>
                        <!-- Form Section -->
                        <div class="row clearfix">
                            <div class="clearfix">
                                <div class="col-md-6">
                                    <div class="clearfix form-group">
                                        <label>Név</label>
                                        <input name="name" type="text" id="tname" class="validate['required'] textbox1" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="clearfix form-group">
                                        <label for="lastname">E-mail cím</label>
                                        <input name="email" type="text" class="form-control" id="email" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <label for="emailid">Telefonszám</label>
                                        <input name="phone" type="text" class="form-control" id="phone" placeholder="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="clearfix marbot20">
                                            <label for="date-time">Időpont választás</label>
                                            <div id="datetimepicker" class="input-group date form_datetime" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
                                                <input name="dt" type="text" value="" id="date-time" readonly>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>                
                                            </div>
                                            <input type="hidden" id="dtp_input1" value="" />
                                        </div>
                                    </div> 
                                </div>
                            </div>


                        </div>


                        <div class="row clearfix marbot30">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Üzenet <small>(Kérjük írje le, hogy milyen problémával kapcsolatban keresné fel rendelőnket.)</small></label>
                                    <textarea name="message" class="form-control" rows="4" id="message"> </textarea>
                                </div>
                            </div>

                            <div class="col-md-3"> 

                            </div>
                        </div>

                        <input type="text" name="mezes_bodon" id="mezes_bodon">

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <button id="submit-button" type="submit" class="btn btn-type1-reverse">Küldés</button>
                            </div>
                        </div>
                        <!-- // Form Section -->
                    </form>
                    <div id="post_message"><p class="fontresize"> </p></div>

                </div>
                <!-- // Section 2 -->

            </div>
        </div>
    </div>
</section>

<!-- // appointment form Section
================================================== -->                        


</div>
</div>
</div>
</section>



