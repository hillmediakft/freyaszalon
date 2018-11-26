<!-- /.sidebar Start ./-->
<div class="col-lg-3 col-md-3 sidebar"> 

    <!-- /.Services list ./-->
    <div class="services"> <strong class="stitle">Szolgáltatások</strong>
        <div class="panel-group" id="accordion">
            <?php $i = 1; ?>
            <?php foreach ($this->szolgaltatasok_menu as $key => $value) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse<?php echo $i; ?>"><?php echo $key; ?></a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?php foreach ($value as $szolgaltatas) { ?>
                                <ul class="list-type3-small fontresize flaticon-eye8">
                                    <li><a href="szolgaltatasok/<?php echo Util::string_to_slug($key) . '/' . Util::string_to_slug($szolgaltatas['szolgaltatas_title']); ?>"><i class="fa fa-angle-right"></i> <?php echo $szolgaltatas['szolgaltatas_title']; ?></a></li>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                    <?php $i++; ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="gap-30"></div>    

    <div class="gift-card nagy-atalakulasok">
        <p class="gift-card-txt">Nagy átalakulások</p>
        <p class="gift-card-txt"><span style="font-size:14px;">Freya Szalonban alkalmazott módszerekkel <strong>sikeresen fogyott, átalakult</strong> vendégek!</span></p>
        <button onclick="window.location.href = 'nagy-atalakulasok'">Megnézem <i class="fa fa fa-arrow-circle-o-right"></i></button></div>

    <div class="gift-card">
        <h3><i class="fa fa-gift"></i>  Csomag kalkulátor</h3>
        <p class="gift-card-txt"><span style="font-size:14px;">Testre szabott kedvezményes alakformáló csomagok!</span></p>
        <button onclick="window.location.href = 'csomag-kalkulator'">Megnézem <i class="fa fa fa-arrow-circle-o-right"></i></button></div>

    <div class="gift-card email"><img alt="" src="/uploads/images/hirlevel.jpg" />
        <p class="gift-card-txt"><span style="font-size:14px;">Iratkozzon fel hírlevelünkre, hogy mindig időben értesüljön akcióinkról!</span></p>
        <button onclick="window.location.href = 'feliratkozas'">Feliratkozom <i class="fa fa fa-arrow-circle-o-right"></i></button>
    </div>

    <div class="gift-card">
        <h3><i class="fa fa-gift"></i>  Ajándékutalvány</h3>
        <p class="gift-card-txt"><span style="color:#B22222;"><strong><span style="font-size:14px;">Ajándékozzon szépséget, egészséget!</span></strong></span><br />
            Ajándékkártyánk bármekkora összegben igényelhető és szalonunk bármely szolgáltatására igénybe vehető. <span style="color:#800000;"><span style="font-size:14px;">Fejezze ki szeretetét ezzel az ajándékkal!</span></span></p>
        <img alt="" src="/uploads/images/aj-ut.jpg" />
    </div>
    <!-- /.Services list ./-->

    <div class="services-list">
        <!-- /.services list end ./-->
        <div class="gift-card">
            <h3>Egészségpénztár</h3>
            <p class="gift-card-txt"><strong>Az alábbi Egészségpénztárakkal szerződtünk:</strong><br />
                ADOSZT, AXA, Dimenzió, Generali, K&H Medicina, Honvéd, MKB, OTP, Patika, Tempo, Vitamin.<br />
                Egészségpénztár kártyával nem lehet fizetni, viszont <strong>Egészségpénztári számlát tudunk írni, ami visszaigényelhető.</strong></p>
        </div>
    </div>

    <!-- /.services list end ./-->
    <div class="gap-30"></div>

    <!-- /.Categoris list start ./-->
