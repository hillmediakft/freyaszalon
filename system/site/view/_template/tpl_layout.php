<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title><?php echo $this->title; ?></title>
        <base href="<?php echo BASE_URL; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1"><![endif]-->
        <meta name="description" content="<?php echo $this->description; ?>">
        <meta name="keywords" content="<?php echo $this->keywords; ?>">


        <!-- Bootstrap core CSS -->
        <link href="<?php echo SITE_CSS; ?>bootstrap.min.css" rel="stylesheet">
        <!-- custom CSS here -->
        <link rel="stylesheet" href="<?php echo Util::auto_version(SITE_CSS . 'styles.css'); ?>">

        <!-- Bx-Slider -->

        <link href="<?php echo SITE_ASSETS; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo SITE_CSS; ?>jquery-ui.css" rel="stylesheet">


        <!-- Toastr CSS -->
        <link href="<?php echo SITE_ASSETS; ?>plugins/toastr/toastr.css" rel="stylesheet">

        <link rel="shortcut icon" href="<?php echo SITE_IMAGE; ?>favicon.ico?v=1" type="image/x-icon">       

        <!-- OLDALSPECIFIKUS CSS LINKEK -->
        <?php $this->get_css_link(); ?>


        <?php if (ENV == "production") { ?>
            <script>
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-502177-34']);
                _gaq.push(['_trackPageview']);

                (function () {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();
            </script>			
        <?php } ?>  

<?php if (ENV == "production") { ?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '1530626433921867'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=1530626433921867&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->		
 <?php } ?>  
    
	</head>


    <body>

        <!--PRELOADER-->
        <section id="jSplash">
            <div class="sk-spinner sk-spinner-three-bounce">
                <div class="sk-bounce1"></div>
                <div class="sk-bounce2"></div>
                <div class="sk-bounce3"></div>
            </div>
        </section>




        <div id="fb-root"></div>
        <?php if (ENV == "production") { ?>
                                                     <!--       <script>(function (d, s, id) {
                                                                    var js, fjs = d.getElementsByTagName(s)[0];
                                                                    if (d.getElementById(id))
                                                                        return;
                                                                    js = d.createElement(s);
                                                                    js.id = id;
                                                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
                                                                    fjs.parentNode.insertBefore(js, fjs);
                                                                }(document, 'script', 'facebook-jssdk'));</script> -->
        <?php } ?>
        <!-- Wrapper 
=============================-->
        <!-- /. Main Container start ./-->
        <div class="wrapper boxed inner"> 

            <!-- Header Section
            =============================-->     

            <?php $this->load('tpl_head'); ?>

            <?php $this->load('content'); ?>

            <?php $this->load('tpl_foot'); ?>

        </div>



        <!-- Common Scripts -->
        <!-- JavaScript --> 
        <script src="<?php echo SITE_JS; ?>jquery-1.10.2.js"></script><!-- Main Jquery File --> 
        <script src="<?php echo SITE_JS; ?>modernizr.custom.39665.js"></script><!-- Modernizer --> 
        <script src="<?php echo SITE_JS; ?>bootstrap.min.js"></script><!-- Bootstrap --> 
        <script src="<?php echo SITE_JS; ?>jquery.easing.1.3.js"></script><!-- Easing --> 
        <script src="<?php echo SITE_JS; ?>jquery.prettyPhoto.js"></script><!-- Pretty Box --> 
        <!-- TOASTR -->
        <script type="text/javascript" src="<?php echo SITE_ASSETS; ?>plugins/toastr/toastr.min.js"></script>


        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54ce95b307a4e457" async="async"></script>

        <!-- Equalheights -->
        <script type="text/javascript" src="<?php echo SITE_ASSETS; ?>plugins/equalheights/jquery.equalheights.min.js"></script>

        <!-- Custom General JS -->
        <script src="<?php echo Util::auto_version(SITE_JS . 'custom.js'); ?>"></script>
        <!-- //  Custom General JS -->      

        <script type="text/javascript">
                /* <![CDATA[ */
                var google_conversion_id = 933421111;
                var google_custom_params = window.google_tag_params;
                var google_remarketing_only = true;
                /* ]]> */
        </script>        


        <script>
            if (document.cookie.indexOf("freya") >= 0) {
                // They've been here before.
            } else {
                document.cookie = "freya=true";
                launchWindow('#dialog');
            }
        </script>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsyHr_ERbn8TBSwHRB1mWk28VDByR-oL0"></script>       

        <?php $this->get_js_link(); ?>

 <!--       <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script> -->
        <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/933421111/?value=0&amp;guid=ON&amp;script=0"/>
        </div>
        </noscript>

    </body>
</html>  