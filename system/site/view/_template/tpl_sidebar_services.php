<!-- Left Section -->
<div class="col-md-3">
    <div class="clearfix">
        <div class="sidebar-menu marbot40"> 

            <h3 class="text-center sidebar-heading sidebar-before-after"> Szolgáltatások</h3>
            <ul class="nav nav-tabs list-type3">
                <?php foreach ($this->szolgaltatasok_menu as $key => $value) { ?>
                    <li><a href="<?php echo '#' . Util::string_to_slug($key); ?>" data-toggle="tab"><?php echo $key; ?></a></li> 


                <?php } ?>

            </ul>
        </div>

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
<!-- // Left Section -->