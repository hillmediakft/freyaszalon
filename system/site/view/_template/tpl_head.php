<!-- /. topbar start ./-->
<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 topnav"><span><i class="fa fa-phone"></i> Bejelentkezés: <?php echo Util::call_us($this->settings['tel'], $icon = true, $buton = false) . '|' . Util::call_us($this->settings['tel2'], $icon = true, $buton = false);?> </span></div>
            <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">

                <div class="hlinks pull-right">
                    <ul>
                        <li><a href="https://www.facebook.com/www.freyaszalon.hu/?ref=hl" target="_blank"><i class="fa fa-facebook"></i>  Facebook oldalunk</a></li>
                        <li><i class="fa fa-home"></i> <?php echo $this->settings['cim']; ?></li>
                        <li><i class="fa fa-envelope"></i>  <?php echo $this->settings['email']; ?></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. topbar end ./--> 

<!-- /. Header Start ./-->
<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="logo"><a href="/"><strong class="logo-home"> Freya Szalon</strong></a></div>
            </div>
            <div class="col-lg-9 col-md-9"> 
                <!-- Collect the nav links, forms, and other content for toggling --> 

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="home-menu">
                    <div class="navbar mm">
                        <div>
                            <nav class="navbar navbar-default" role="navigation"> 
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                </div>
                                <div id="navbar-collapse-1" class="collapse navbar-collapse pull-right">
                                    <ul class="nav navbar-nav">
                                        <li class="<?php $this->menu_active('home', null, 'selected'); ?>"><a data-target="#" href="/">A szalon</a></li>

                                        <!-- Classic list -->
                                        <li class="dropdown <?php $this->menu_active('szolgaltatasok', null, 'selected'); ?>"><a href="szolgaltatasok" class="dropdown-toggle">Szolgáltatások<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li> 
                                                    <!-- Content container to add padding -->
                                                    <div class="mm-content">
                                                        <div class="row">
                                                            <ul class="col-sm-4 list-unstyled">
                                                                <?php foreach ($this->szolgaltatasok_menu as $key => $value) { ?>
                                                                    <li><a href="szolgaltatasok/kategoria/<?php echo Util::string_to_slug($key); ?>"><?php echo $key; ?></a></li>
                                                                <?php } ?> 
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>

                                        <!-- Akciók -->
                                        <li class="<?php $this->menu_active('akciok', null, 'selected'); ?>"><a href="akciok">Akciók</a>
                                        </li>

                                        <!-- Galéria -->
                                        <li class="<?php $this->menu_active('kepgaleria', null, 'selected'); ?>"><a href="kepgaleria">Galéria</a>
                                        </li>

                                        <!-- Árlista -->
                                        <li class="<?php $this->menu_active('arak', null, 'selected'); ?>"><a href="arak">Árlista</a>
                                        </li>

                                        <!-- CSapatunk -->
                                        <li class="<?php $this->menu_active('csapatunk', null, 'selected'); ?>"><a href="csapatunk">Csapatunk</a>
                                        </li>					  

                                        <!-- Elérhetőség -->
                                        <li class="<?php $this->menu_active('elerhetoseg', null, 'selected'); ?>"><a href="elerhetoseg">Elérhetőség</a>
                                        </li>          

                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
        </div>
    </div>
</header>
<!-- /. Header End ./--> 