<!-- BEGIN CONTENT -->
    <div class="page-content">



        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">


                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-list"></i>Ingatlan adatai</div>
                        <div class="actions">
                            <a href="admin/property/update/<?php echo $this->property_data['id']; ?>" class="btn grey-steel btn-sm"><i class="fa fa-edit"></i> Adatok szerkesztése</a>
                            <a href="admin/property" class="btn blue-madison btn-sm"><i class="fa fa-arrow-left"></i> Vissza az ingatlanokhoz</a>

                        </div>
                    </div>
                    <div class="portlet-body">

                        <!-- **************** INGATLAN RÉSZLETEK ********************* --> 
                        <div class="row">			
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearfix">

                                <p class="well well-sm">Ingatlan adatok</p>

                                <div class="span12">
                                    <h4><?php echo $this->property_data['ingatlan_nev']; ?></h4>
                                </div>
                                <table class="table table-striped table-bordered table-condensed table-hover ">

                                    <thead>
                                        <tr class="heading">
                                            <th colspan=2>Alap adatok</th>


                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>Azonosító:</td>
                                            <td><?php echo $this->property_data['id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Rögzítés / módosítás dátuma:</td>
                                            <td><?php echo date('Y-m-d H:i', $this->property_data['hozzaadas_datum']) . ' / ' . date('Y-m-d H:i', $this->property_data['modositas_datum']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Referens:</td>
                                            <td><?php echo $this->property_data['user_first_name'] . ' ' . $this->property_data['user_last_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ingatlan státusza:</td>
                                            <td><?php echo ($this->property_data['status']) ? '<span class="label label-success">Aktív</span>' : '<span class="label label-danger">Inaktív</span>'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ügylet típusa:</td>
                                            <td><?php echo ($this->property_data['tipus'] == '1') ? '<span class="label label-default">Eladó</span>' : '<span class="label label-primary">Kiadó</span>'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kategória:</td>
                                            <td><?php echo $this->property_data['kat_nev']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Állapot:</td>
                                            <td><?php echo $this->property_data['all_leiras']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kiemelt ajánlat:</td>
                                            <td><?php echo ($this->property_data['kiemeles']) ? '<i class="fa fa-check-square"></i>' : '<i class="fa fa-minus-square"></i>'; ?></td>
                                        </tr>

                                    </tbody>
                                </table>



                                <table class="table table-striped table-bordered table-condensed table-hover ">
                                    <thead>
                                        <tr class="heading">
                                            <th colspan=2>Elhelyezkedés és megjelenítés</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        if ($this->property_data['city_name'] != 'Budapest') {

                                            echo '<tr>';
                                            echo '<td>Megye:</td>';
                                            echo '<td>';
                                            echo $this->property_data['county_name'];
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        ?>


                                        <tr>
                                            <td>Város:</td>
                                            <td><?php echo $this->property_data['city_name']; ?></td>
                                        </tr>


                                        <?php
                                        if ($this->property_data['kerulet']) {

                                            echo '<tr>';
                                            echo '<td>Kerület:</td>';
                                            echo '<td>';
                                            echo $this->property_data['kerulet'] . '.';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                        <tr>
                                            <td>Irányítószám:</td>
                                            <td>
                                                <?php echo $this->property_data['iranyitoszam']; ?>
                                        </tr> 



                                        <tr>
                                            <td>Cím:</td>
                                            <td>
                                                <?php
                                                echo $this->property_data['utca'] . '&nbsp';
                                                echo $this->property_data['hazszam'];
                                                ?>
                                        </tr> 
                                        <tr>
                                            <td>Megjelenítés térképen:</td>
                                            <td><?php echo ($this->property_data['terkep']) ? '<i class="fa fa-check-square"></i>' : '<i class="fa fa-minus-square"></i>'; ?></td>
                                        </tr> 
                                        <tr>
                                            <td>Utca megjelenítés:</td>
                                            <td><?php echo ($this->property_data['utca_megjelenites']) ? '<i class="fa fa-check-square"></i>' : '<i class="fa fa-minus-square"></i>'; ?></td>
                                        </tr> 
                                        <tr>
                                            <td>Házszám megjelenítés:</td>
                                            <td><?php echo ($this->property_data['hazszam_megjelenites']) ? '<i class="fa fa-check-square"></i>' : '<i class="fa fa-minus-square"></i>'; ?></td>
                                        </tr>
                                    </tbody>
                                </table>



                                <table class="table table-striped table-bordered table-condensed table-hover ">
                                    <thead>
                                        <tr class="heading">
                                            <th colspan=2>Leírás és információk</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Megnevezés:</td>
                                            <td><?php echo $this->property_data['ingatlan_nev']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Leírás:</td>
                                            <td><?php echo $this->property_data['leiras']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo ($this->property_data['tipus'] == '1') ? 'Eladási ár:' : 'Bérleti díj:';
                                                ?>
                                            </td>
                                            <td><b><?php echo ($this->property_data['tipus'] == '1') ? number_format($this->property_data['ar_elado'], 0, ',', '.') . ' Ft' : number_format($this->property_data['ar_kiado'], 0, ',', '.') . ' Ft'; ?></b></td>
                                        </tr>


                                        <tr>
                                            <td>Alapterület:</td>
                                            <td>
                                                <?php echo $this->property_data['alapterulet'] . ' m&sup2;'; ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>Szobaszám:</td>
                                            <td><?php echo $this->property_data['szobaszam']; ?>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>Közös költség:</td>
                                            <td><?php echo (isset($this->property_data['kozos_koltseg'])) ? $this->property_data['kozos_koltseg'] . ' Ft' : 'n.a.'; ?>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>Átlagos rezsi:</td>
                                            <td><?php echo (isset($this->property_data['rezsi'])) ? $this->property_data['rezsi'] . ' Ft' : 'n.a.'; ?>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td>Emelet:</td>
                                            <td><?php echo (isset($this->property_data['emelet'])) ? $this->property_data['emelet'] . '. emelet' : '-'; ?>
                                            </td>
                                        </tr>

                                        <?php
                                        if ($this->property_data['emelet']) {

                                            echo '<tr>';
                                            echo '<td>Épület szintjei:</td>';
                                            echo '<td>';
                                            echo ($this->property_data['epulet_szintjei']) ? $this->property_data['epulet_szintjei'] . ' emelet' : 'n.a.';
                                            ;
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        ?>





                                    </tbody>
                                </table>

                                <table class="table table-striped table-bordered table-condensed table-hover ">
                                    <thead>
                                        <tr class="heading">
                                            <th colspan=2>Jellemzők</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>Állapot:</td>
                                            <td><?php echo ($this->property_data['all_leiras']) ? $this->property_data['all_leiras'] : 'n.a.'; ?></td>
                                        </tr>                                        

                                        <tr>
                                            <td>Fűtés:</td>
                                            <td><?php echo ($this->property_data['futes_leiras']) ? $this->property_data['futes_leiras'] : 'n.a.'; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Parkolás:</td>
                                            <td><?php echo ($this->property_data['parkolas_leiras']) ? $this->property_data['parkolas_leiras'] : 'n.a.'; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Kilátás:</td>
                                            <td><?php echo ($this->property_data['kilatas_leiras']) ? $this->property_data['kilatas_leiras'] : 'n.a.'; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Energetika:</td>
                                            <td><?php echo ($this->property_data['energetika_leiras']) ? $this->property_data['energetika_leiras'] : 'n.a.'; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Kert:</td>
                                            <td><?php echo ($this->property_data['kert_leiras']) ? $this->property_data['kert_leiras'] : 'n.a.'; ?></td>
                                        </tr>                                        

                                        <tr>
                                            <td>Lift:</td>
                                            <td><?php echo ($this->property_data['lift'] == 1) ? '<i class="fa fa-check-square"></i>' : '<i class="fa fa-minus-square"></i>'; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Bútorozott:</td>
                                            <td><?php echo ($this->property_data['butor'] == 1) ? '<i class="fa fa-check-square"></i>' : '<i class="fa fa-minus-square"></i>'; ?></td>
                                        </tr>


                                    </tbody>
                                </table>


                                <table class="table table-striped table-bordered table-condensed table-hover ">
                                    <thead>
                                        <tr class="heading">
                                            <th colspan=2>Extrák</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan=2>
                                                <?php
                                                echo ($this->property_data['erkely']) ? 'erkély, ' : '';
                                                echo ($this->property_data['terasz']) ? 'terasz, ' : '';
                                                echo ($this->property_data['medence']) ? 'medence, ' : '';
                                                echo ($this->property_data['szauna']) ? 'szauna, ' : '';
                                                echo ($this->property_data['jacuzzi']) ? 'jacuzzi, ' : '';
                                                echo ($this->property_data['kandallo']) ? 'kandalló, ' : '';
                                                echo ($this->property_data['riaszto']) ? 'riasztó, ' : '';
                                                echo ($this->property_data['klima']) ? 'klíma, ' : '';
                                                echo ($this->property_data['ontozorendszer']) ? 'öntözőrendszer, ' : '';
                                                echo ($this->property_data['automata_kapu']) ? 'automata kapu, ' : '';
                                                echo ($this->property_data['elektromos_redony']) ? 'elektromos redőny, ' : '';
                                                echo ($this->property_data['konditerem']) ? 'konditerem ' : '';
                                                ?>	

                                            </td></tr>
                                    </tbody>
                                </table>

                                <!-- ************* MÁSODIK OSZLOP KÉPEKKEL ÉS DOKUMENTUMOKKAL ******** -->                        

                            </div><!-- end of col-6 -->

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearfix margin-bottom-10">
                                <p class="well well-sm">Feltöltött képek</p>

                                <?php foreach ($this->photos as $img) { ?>
                                    <div class="col-lg-6 margin-bottom-10">
                                        <a class="fancybox" href="<?php echo Config::get('ingatlan_photo.upload_path') . $img; ?>" rel="image-group">	
                                            <img class="img-thumbnail" src="<?php echo Util::small_path(Config::get('ingatlan_photo.upload_path') . '/' . $img); ?>" alt="">



                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearfix">
                                <p class="well well-sm">Feltöltött dokumentumok</p>

                                <?php
                                if (!empty($this->docs)) {
                                    foreach ($this->docs as $doc) {

                                        echo '<div class="col-lg-6 margin-bottom-20">';
                                        echo '<a target="_blank" href="' . Config::get('ingatlan_doc.upload_path') . $doc . '">';
                                        echo '<i class="fa fa-file"></i> ' . $doc . '</a>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p>Az ingatlanhoz nincs dokumentum feltöltve!</p>';
                                }
                                ?>




                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearfix ">
                                <p class="well well-sm">Ingatlan adatlap</p>
                                <p class="margin-bottom-20">
                                    <a id="generate_pdf" class="print-datasheet" href="ingatlanok/adatlap_nyomtatas/<?php echo $this->property_data['id']; ?>"><i class="fa fa-print"></i> Adatlap nyomtatás</a>
                                </p>



                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearfix">
                                <p class="well well-sm">Tulajdonos adatai</p>

                                <table class="table table-striped table-bordered table-condensed table-hover ">
                                    <thead>
                                        <tr class="heading">
                                            <th colspan=2>Név, elérhetőségek, feljegyzések</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Név:</td>
                                            <td><?php echo $this->property_data['tulaj_nev']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Telefonszám:</td>
                                            <td><?php echo '+' . preg_replace("/-/", " ", $this->property_data['tulaj_tel']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>E-mail:</td>
                                            <td><?php echo $this->property_data['tulaj_email']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cím:</td>
                                            <td><?php echo $this->property_data['tulaj_cim']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Feljegyzések:</td>
                                            <td>
                                                <?php echo $this->property_data['tulaj_notes']; ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>





                        </div> <!-- end of row -->	


                    </div> <!-- END PORTLET BODY -->
                </div> <!-- END PORTLET -->



            </div>
        </div>
    </div> <!-- END PAGE CONTENT-->