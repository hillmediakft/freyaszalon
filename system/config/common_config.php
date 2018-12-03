<?php

//log fileok adatai
$config['log'] = array(
    'error' => 'logs_error.log',
    'notice' => 'logs_notice.log'
);

$config['email'] = array(
    'password_reset' => array(
        'admin_url' => BASE_URL . 'admin/login/verifypasswordreset',
        'site_url' => BASE_URL . 'users/verifypasswordreset',
        'subject' => 'Új jelszó kérése.',
        'link' => 'Kattints a linkre a jelszó reseteléséhez.'
    ),
    'verification' => array(
        'site_url' => BASE_URL . 'felhasznalok/ellenorzes',
        'subject' => 'Regisztráció hitelesítése.',
        'link' => 'Kattints erre a linkre a regisztrációd aktiválásához.'
    ),
    'verification_newsletter' => array(
        'site_url' => BASE_URL . 'felhasznalok/ellenorzes_hirlevel',
        'subject' => 'Hírlevélre feliratkozás hitelesítése.',
        'link' => 'Kattints erre a linkre a feliratkozás aktiválásához.'
    ),
    'from_email' => 'info@freyaszalon.hu',
    'from_name' => 'Freya szalon',
    'server' => array(
        'phpmailer_debug_mode' => 1,
        'use_smtp' => true,
        'smtp_host' => 'mail.dr-losonczy.hu',
        'smtp_auth' => true,
        'smtp_username' => 'noreply@dr-losonczy.hu',
        'smtp_password' => 'S8xOSfnsi',
        'smtp_port' => 587,
        'smtp_encryption' => 'tls'
    )
);

$config['login'] = array(
    'facebook_login' => false,
    'facebook_login_app_id' => 'xxx',
    'facebook_login_app_secret' => 'xxx',
    'facebook_login_path' => 'login/loginWithFacebook',
    'facebook_register_path' => 'login/registerWithFacebook',
    'use_gravatar' => false,
    'avatar_size' => 44,
    'avatar_jpeg_quality' => 85,
    'avatar_default_image' => 'default.jpg',
    'avatar_path' => ''
);

$config['cookie'] = array(
    'runtime' => 1209600,
    'domain' => '.localhost'
);

$config['slider'] = array(
    'width' => 1400,
//    'height' => 450,
    'thumb_width' => 200,
    'upload_path' => UPLOADS . 'slider_photo/'
);

$config['photogallery'] = array(
    'width' => 800,
    'thumb_width' => 320,
    'upload_path' => UPLOADS . 'photo_gallery/'
);

$config['hash_cost_factor'] = 10;
$config['language_default'] = 'hu';
$config['allowed_languages'] = array('hu', 'en', 'de', 'ru');
$config['reg_email_verify'] = true;

$config['location'] = array(
    'pest' => array(1, 2, 3, 4, 5, 6, 7),
    'buda' => array(8, 9, 10, 11, 12, 13, 14, 15, 16),
    'kozpont' => array(17, 18, 19, 20, 21, 22, 23)
);

$config['user'] = array(
    'width' => 600,
    'height' => 200,
    //'thumb_width' => 80,
    'upload_path' => UPLOADS . 'user_photo/',
    'default_photo' => 'user_placeholder.png'
);

$config['ingatlan_photo'] = array(
    'width' => 800,
    'height' => 600, //csak akkor van hatása, ha az y_ratio false
    'thumb_width' => 80,
    'small_width' => 400,
    'y_ratio' => true, // ha true, akkor megtartja az eredeti képarányt, ha false, akkor a height érték lép életbe az átméretezésnél
    'upload_path' => UPLOADS . 'ingatlan_photo/',
    //'default_photo' => 'default.jpg',
    'placeholder' => ADMIN_ASSETS . 'img/placeholder_323x242.jpg'
);

$config['ingatlan_doc'] = array(
    'upload_path' => UPLOADS . 'ingatlan_doc/'
);

$config['beforeafterphoto'] = array(
    'width' => 400,
    'height' => 400,
    'thumb_width' => 20,
    'upload_path' => UPLOADS . 'before_after_photo/',
    'default_photo' => 'before_after_placeholder.png'
);

$config['clientphoto'] = array(
    'width' => 150,
    'height' => 100,
    'thumb_width' => 150,
    'upload_path' => UPLOADS . 'client_photo/',
    'default_photo' => 'client_placeholder.png'
);

$config['session'] = array(
    'expire_time_admin' => 3600,
    'expire_time_site' => 3600
        // 'last_activity_name_admin' => 'user_last_activity', // A $_SESSION['last_activity'] elem fogja tárolni az utolsó aktivitás idejét
        // 'last_activity_name_site' => 'user_site_last_activity' // A $_SESSION['last_activity'] elem fogja tárolni az utolsó aktivitás idejét
);
$config['blogphoto'] = array(
    'width' => 600,
    'height' => 400,
    'thumb_width' => 150,
    'upload_path' => UPLOADS . 'blog_photo/',
);

$config['crew_member'] = array(
    'width' => 600,
    'height' => 200,
    'thumb_width' => 80,
    'upload_path' => UPLOADS . 'crew_photo/',
    'default_photo' => 'crew_placeholder.png'
);

$config['szolgaltatasphoto'] = array(
    'width' => 800,
    'height' => 600,
    'thumb_width' => 400,
    'upload_path' => UPLOADS . 'szolgaltatas_photo/',
    'default_photo' => 'default.jpg'
);

$config['szolgaltatascategoryphoto'] = array(
    'width' => 400,
    'height' => 300,
    'thumb_width' => 80,
    'upload_path' => UPLOADS . 'szolgaltatas_category_photo/',
    'default_photo' => 'default.jpg'
);

$config['content_types'] = array(
    "blog" => 1,
    "oldal" => 2,
    "kep" => 3,
    "szolgaltatas" => 4,
    "gyik" => 5,
    "elotte-utana-kep" => 6
);

// Hírlevél küldés - script végrehajtás időlimit (másodpercben!)
$config['newsletter_send_timelimit'] = 3;
?>