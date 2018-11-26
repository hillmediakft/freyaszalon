<?php

$link['bx_slider'] = array(
    'css' => SITE_CSS . 'jquery.bxslider.css',
    'js' => SITE_JS . 'jquery.bxslider.min.js'
);

// Google Maps
$link['jquery-validation'] = array(
    'js' => array(
        SITE_ASSETS . 'plugins/jquery-validation/jquery.validate.min.js',
        SITE_ASSETS . 'plugins/jquery-validation/localization/messages_hu.min.js'
    )
);

$link['bootstrap-validator'] = array('js' => SITE_JS . 'bootstrapValidator.min.js');

$link['mixitup'] = array('js' => SITE_JS . 'jquery.mixitup.min.js');
$link['portfolio'] = array('css' => SITE_CSS . 'portfolio.css');

$link['fancybox'] = array('css' => SITE_ASSETS . 'plugins/fancybox/source/jquery.fancybox.css');
// Google Maps
$link['gmaps'] = array('js' => SITE_ASSETS . 'plugins/gmaps/gmaps.min.js');

// Google Maps
$link['google-maps'] = array(
    'js' => array(
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyDsyHr_ERbn8TBSwHRB1mWk28VDByR-oL0'
    )
);

$link['home'] = array('js' => SITE_JS . 'pages/home.js');
$link['blog'] = array('js' => SITE_JS . 'pages/blog.js');
$link['gmaps'] = array('js' => SITE_JS . 'gmaps.js');
$link['elerhetoseg'] = array('js' => SITE_JS . 'pages/elerhetoseg.js');
$link['galeria'] = array('js' => SITE_JS . 'pages/galeria.js');
$link['csapatunk'] = array('js' => SITE_JS . 'pages/csapatunk.js');
$link['bejelentkezes'] = array('js' => SITE_JS . 'pages/bejelentkezes.js');
$link['szolgaltatas'] = array('js' => SITE_JS . 'pages/szolgaltatas.js');
$link['csomag-kalkulator'] = array('js' => SITE_JS . 'pages/csomag-kalkulator.js');

return $link;
?>