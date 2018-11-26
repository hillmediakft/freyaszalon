<!-- Banner Section
================================= -->


<section class="main-slider revolution-slider">

    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
                <?php foreach ($this->slider as $key => $value) { ?>                      
                    <li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="<?php echo Config::get('slider.upload_path') . $this->slider[$key]['picture']; ?>"  data-saveperformance="off"  data-title="<?php echo $this->slider[$key]['title']; ?>">
                        <img src="<?php echo Config::get('slider.upload_path') . $this->slider[$key]['picture']; ?>"  alt="<?php echo $this->slider[$key]['title']; ?>"  data-bgposition="left top" data-bgfit="cover" data-bgrepeat="no-repeat"> 


                        <div class="tp-caption sfl sfb tp-resizeme large_bold_white text-center"
                             data-x="center" data-hoffset="0"
                             data-y="center" data-voffset="-100"
                             data-speed="1500"
                             data-start="500"
                             data-easing="easeOutExpo"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.01"
                             data-endelementdelay="0.3"
                             data-endspeed="1200"
                             data-endeasing="Power4.easeIn"
                             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;"> <?php echo $this->slider[$key]['title']; ?></div>

                        <div class="tp-caption sfr sfb tp-resizeme miami_content_light text-center"
                             data-x="center" data-hoffset="0"
                             data-y="center" data-voffset="-13"
                             data-speed="1500"
                             data-start="1000"
                             data-easing="easeOutExpo"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.01"
                             data-endelementdelay="0.3"
                             data-endspeed="1200"
                             data-endeasing="Power4.easeIn"
                             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;"> <?php echo $this->slider[$key]['text']; ?></div>        

                        <div class="tp-caption sfl sfb tp-resizeme tp-btn"
                             data-x="center" data-hoffset="0"
                             data-y="center" data-voffset="70"
                             data-speed="1500"
                             data-start="1500"
                             data-easing="easeOutExpo"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.01"
                             data-endelementdelay="0.3"
                             data-endspeed="1200"
                             data-endeasing="Power4.easeIn"
                             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;"><div class="text-center"><a href="<?php echo $this->slider[$key]['target_url']; ?>" class="btn btn-type1">Részletek</a></div></div>

                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</section>
<?php //echo $this->content_block_1['content_body'];?>
<!-- // Banner Section 
================================= -->
<!-- Content Section
==================================================  -->
<section class="top-bottom-spacing white-bg">
    <div class="container">
        <div class="row animatedParent animateOnce" data-sequence='300'>
            <div class="hover-content-section">
                <div class="col-md-3 marbot40 fadeInLeft animated" data-id='1'>
                    <div class="box1-cta">
                        <h2><span class="fw-normal">Szolgáltatásaink</h2>
                        <p class="fontresize">	
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nulla libero, rutrum eget vulputate at, dignissim quis orci. Aenean dictum quam et orci porttitor, a ultricies elit sodales.  
                        </p>
                    </div>
                    <a href="#" class="btn btn-type1-reverse transition"> Szolgáltatások </a>
                </div>
              
                <div class="col-md-3 marbot40 fadeInRight animated" data-id='2'>
                    <div class="clearfix text-center">
                        <div class="hover-content cta-content">
                            <div class="">
                                <div class="mask mask-img mask-img-xs transition marbot10 center-block">
                                    <img src="<?php echo SITE_IMAGE; ?>szolgaltatasok_1.jpg" alt=" " class="img-responsive">
                                </div>
                            </div>
                            <h4>Lorem ipsum</h4>
                        </div>
                        <p class="fontresize">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nulla libero, rutrum eget vulputate at, dignissim quis orci. 
                        </p>

                        <a href="#" class="read-more transition">Tovább...</a>
                    </div>
                </div>

             
                <div class="col-md-3 marbot40 fadeInRight animated" data-id='3'>
                    <div class="clearfix text-center">
                        <div class="hover-content cta-content">
                            <div class="">
                                <div class="mask mask-img mask-img-xs transition marbot10 center-block">
                                    <img src="<?php echo SITE_IMAGE; ?>szolgaltatasok_2.jpg" alt=" " class="img-responsive">
                                </div>
                            </div>
                            <h4>Szolgáltatás 2</h4>
                        </div>
                        <p class="fontresize">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nulla libero, rutrum eget vulputate at, dignissim quis orci.   
                        </p>
                        <a href="x" class="read-more transition">Tovább...</a>                </div>
                </div>

          
                <div class="col-md-3 marbot40 fadeInRight animated" data-id='4'>
                    <div class="clearfix text-center">
                        <div class="hover-content cta-content">
                            <div class="">
                                <div class="mask mask-img mask-img-xs transition marbot10 center-block">
                                    <img src="<?php echo SITE_IMAGE; ?>szolgaltatasok_3.jpg" alt=" " class="img-responsive">
                                </div>
                            </div>
                            <h4>Szolgáltatás 3</h4>

                        </div>
                        <p class="fontresize">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nulla libero, rutrum eget vulputate at, dignissim quis orci. 
                        </p>
                        <a href="#" class="read-more transition">Tovább...</a>                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Content Section
================================================== -->

<!-- doctors Section
================================= -->
<section class="white-bg doctors top-bottom-spacing">
    <div class="container">
        <div class="row animatedParent animateOnce">
            <div class="col-md-4 marbot40 fadeInLeft animated">
                <div class="three-column">
                    <div class="marbot30 clearfix">
                        <ul>
                            <?php foreach ($this->crew_members as $value) { ?>
                                <li data-html="true" title="<?php echo $value['crew_member_name']; ?>" data-toggle="tooltip">
                                    <a href="munkatarsaink"><img src="<?php echo $value['crew_member_photo']; ?>" alt="<?php echo $value['crew_member_name']; ?>" class="img-responsive"></a>
                                </li>

                            <?php } ?>
                        </ul>
                    </div>
                    <h3 class="marbot20">Csapatunk</h3>
                    <p class="fontresize">Fusce hendrerit ex eget risus ultrices suscipit. Pellentesque imperdiet vestibulum lorem, id varius erat rutrum quis. Donec non fringilla lacus.  </p>

                    <a href="#" class="read-more transition">Részletek</a>                </div>
            </div>

            <div class="col-md-4 marbot40 fadeInUp animated">
                <div class="doctor-content">
                    <div class="grid image-effect2 marbot30">
                        <a href="#">
                            <figure>
                                <img src="<?php echo SITE_IMAGE; ?>rendelo.jpg" alt=" " class="img-responsive center-block">
                                <figcaption><i class="fa flaticon-link-1 gallery-icon transition"></i></figcaption>
                            </figure>
                        </a>                    
                    </div>
                    <h3 class="marbot20">Rendelőnk</h3>
                    <p class="fontresize">
                        He is an expert in SICS (manual phako), Botox, Ptosis, Oculoplasty, Pterygium, DCR surgeries 
                    </p>
                    <a href="#" class="read-more transition">Részletek</a>              
                </div>    
            </div>

            <div class="col-md-4 marbot40 fadeInRight animated">
                                <div class="doctor-content">
                    <div class="grid image-effect2 marbot30">
                        <a href="#">
                            <figure>
                                <img src="<?php echo SITE_IMAGE; ?>elotte-utana.jpg" alt=" " class="img-responsive center-block">
                                <figcaption><i class="fa flaticon-link-1 gallery-icon transition"></i></figcaption>
                            </figure>
                        </a>                    
                    </div>
                    <h3 class="marbot20">Rendelőnk</h3>
                    <p class="fontresize">
                        He is an expert in SICS (manual phako), Botox, Ptosis, Oculoplasty, Pterygium, DCR surgeries 
                    </p>
                    <a href="#" class="read-more transition">További képek</a>              
                </div>
            </div>
        </div>
    </div>
</section>

<!-- // doctors Section
================================= -->