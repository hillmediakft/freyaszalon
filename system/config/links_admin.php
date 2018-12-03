<?php

/* ----------------- MODUL LINKEK -------------------- */

$link['bootbox'] = array(
    'js' => ADMIN_ASSETS . 'plugins/bootbox/bootbox.min.js'
);

$link['bootstrap-fileupload'] = array(
    'css' => ADMIN_ASSETS . 'plugins/bootstrap-fileupload/bootstrap-fileupload.css',
    'js' => ADMIN_ASSETS . 'plugins/bootstrap-fileupload/bootstrap-fileupload.js'
);

$link['bootstrap-editable'] = array(
    'css' => ADMIN_ASSETS . 'plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css',
    'js' => ADMIN_ASSETS . 'plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js'
);

$link['ckeditor'] = array(
    'js' => ADMIN_ASSETS . 'plugins/ckeditor/ckeditor.js'
);

$link['croppic'] = array(
    'css' => ADMIN_ASSETS . 'plugins/croppic/croppic.css',
    'js' => ADMIN_ASSETS . 'plugins/croppic/croppic.min.js'
);

$link['datatable'] = array(
    'css' => array(
        ADMIN_ASSETS . 'plugins/datatables/datatables.min.css',
        ADMIN_ASSETS . 'plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'
    ),
    'js' => array(
        ADMIN_ASSETS . 'plugins/datatables/datatables.min.js',
        ADMIN_ASSETS . 'plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
        ADMIN_JS . 'datatable.js',
    )
);

$link['datepicker'] = array(
    'css' => ADMIN_ASSETS . 'plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
    'js' => array(
        ADMIN_ASSETS . 'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
        ADMIN_ASSETS . 'plugins/bootstrap-datepicker/locales/bootstrap-datepicker.hu.min.js'
    )
);

$link['datetimepicker'] = array(
    'css' => ADMIN_ASSETS . 'plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css',
    'js' => array(
        ADMIN_ASSETS . 'plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
        ADMIN_ASSETS . 'plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.hu.js'
    )
);

$link['elfinder'] = array(
    'css' => array(
        ADMIN_ASSETS . 'plugins/elfinder/css/elfinder.min.css',
        ADMIN_ASSETS . 'plugins/elfinder/css/theme.css'
    ),
    'js' => array(
        ADMIN_ASSETS . 'plugins/elfinder/js/elfinder.min.js',
        ADMIN_ASSETS . 'plugins/elfinder/js/i18n/elfinder.hu.js'
    )
);

$link['fancybox'] = array(
    'css' => ADMIN_ASSETS . 'plugins/fancybox/source/jquery.fancybox.css',
    'js' => ADMIN_ASSETS . 'plugins/fancybox/source/jquery.fancybox.pack.js'
);

$link['jquery-ui'] = array(
    'css' => ADMIN_ASSETS . 'plugins/jquery-ui/jquery-ui.min.css',
    'js' => ADMIN_ASSETS . 'plugins/jquery-ui/jquery-ui.min.js'
);

$link['jquery-ui-custom'] = array(
    'css' => ADMIN_ASSETS . 'plugins/jquery-ui-custom/jquery-ui-1.10.3.custom.min.css',
    'js' => ADMIN_ASSETS . 'plugins/jquery-ui-custom/jquery-ui-1.10.3.custom.min.js'
);

$link['mixitup'] = array(
    'js' => ADMIN_ASSETS . 'plugins/jquery-mixitup/jquery.mixitup.min.js'
);

$link['select2'] = array(
    'css' => ADMIN_ASSETS . 'plugins/select2/css/select2.css',
    'js' => ADMIN_ASSETS . 'plugins/select2/js/select2.min.js'
);

$link['validation'] = array(
    'js' => array(
        ADMIN_ASSETS . 'plugins/jquery-validation/jquery.validate.js',
        ADMIN_ASSETS . 'plugins/jquery-validation/additional-methods.min.js',
        ADMIN_ASSETS . 'plugins/jquery-validation/localization/messages_hu.js'
    )
);

$link['vframework'] = array(
    'js' => ADMIN_JS . 'vframework_object.js'
);

$link['kartik-bootstrap-fileinput'] = array(
    'css' => ADMIN_ASSETS . 'plugins/kartik-bootstrap-fileinput/css/fileinput.css',
    'js' => array(
        ADMIN_ASSETS . 'plugins/kartik-bootstrap-fileinput/js/fileinput.js',
        ADMIN_ASSETS . 'plugins/kartik-bootstrap-fileinput/js/fileinput_locale_hu.js'
    )
);

$link['autocomplete'] = array(
    'js' => ADMIN_ASSETS . 'plugins/autocomplete/src/jquery.autocomplete.js'
);

$link['portfolio'] = array(
    'css' => ADMIN_ASSETS . 'css/pages/portfolio.css'
);

$link['nestable'] = array(
    'css' => ADMIN_ASSETS . 'plugins/jquery-nestable/jquery.nestable.css',
    'js' => ADMIN_ASSETS . 'plugins/jquery-nestable/jquery.nestable.js'
);

$link['flot'] = array(
    'js' => array(
        ADMIN_ASSETS . 'plugins/flot/jquery.flot.min.js',
        ADMIN_ASSETS . 'plugins/flot/jquery.flot.resize.min.js',
        ADMIN_ASSETS . 'plugins/flot/jquery.flot.pie.min.js',
        ADMIN_ASSETS . 'plugins/flot/jquery.flot.time.min.js',
        ADMIN_ASSETS . 'plugins/flot/jquery.flot.categories.js'
    )
);

/* ----------------- OLDALSPECIFIKUS LINKEK -------------------- */

// blog
$link['blog'] = array('js' => ADMIN_JS . 'pages/blog.js');
$link['blog_insert'] = array('js' => ADMIN_JS . 'pages/blog_insert.js');
$link['blog_update'] = array('js' => ADMIN_JS . 'pages/blog_update.js');
$link['blog_category'] = array('js' => ADMIN_JS . 'pages/blog_category.js');
$link['blog_category_insert'] = array('js' => ADMIN_JS . 'pages/blog_category_insert.js');
$link['blog_category_update'] = array('js' => ADMIN_JS . 'pages/blog_category_update.js');

// content (pl. lábléc stb.)
$link['content'] = array('js' => ADMIN_JS . 'pages/content.js');
$link['edit_content'] = array('js' => ADMIN_JS . 'pages/edit_content.js');

// partnerek
$link['clients'] = array('js' => ADMIN_JS . 'pages/clients.js');
$link['client_insert'] = array('js' => ADMIN_JS . 'pages/client_insert.js');
$link['client_update'] = array('js' => ADMIN_JS . 'pages/client_update.js');

// hírlevél
$link['newsletter_eventsource'] = array('js' => ADMIN_JS . 'pages/newsletter_eventsource.js');
$link['newsletter_insert'] = array('js' => ADMIN_JS . 'pages/newsletter_insert.js');
$link['newsletter_update'] = array('js' => ADMIN_JS . 'pages/newsletter_update.js');
$link['newsletter_stats'] = array('js' => ADMIN_JS . 'pages/newsletter_stats.js');

// oldalak
$link['pages'] = array('js' => ADMIN_JS . 'pages/pages.js');
$link['page_update'] = array('js' => ADMIN_JS . 'pages/page_update.js');

// users
$link['users'] = array('js' => ADMIN_JS . 'pages/users.js');
$link['user_insert'] = array('js' => ADMIN_JS . 'pages/user_insert.js');
$link['user_profile'] = array('js' => ADMIN_JS . 'pages/user_profile.js');

// slider
$link['slider'] = array('js' => ADMIN_JS . 'pages/slider.js');
$link['slider_insert'] = array('js' => ADMIN_JS . 'pages/slider_insert.js');
$link['slider_update'] = array('js' => ADMIN_JS . 'pages/slider_update.js');

// filemanager
$link['filemanager'] = array('js' => ADMIN_JS . 'pages/file_manager.js');

// rólunk mondták
$link['testimonials'] = array('js' => ADMIN_JS . 'pages/testimonials.js');
$link['testimonial_insert'] = array('js' => ADMIN_JS . 'pages/testimonial_insert.js');
$link['testimonial_update'] = array('js' => ADMIN_JS . 'pages/testimonial_update.js');

// Google Maps
$link['google-maps'] = array(
    'js' => array(
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyDsyHr_ERbn8TBSwHRB1mWk28VDByR-oL0',
        ADMIN_ASSETS . 'plugins/gmaps/gmaps.min.js'
    )
);

// logs
$link['logs'] = array('js' => ADMIN_JS . 'pages/logs.js');

// fotó galéria
$link['photo_gallery'] = array('js' => ADMIN_JS . 'pages/photo_gallery.js');
$link['photo_gallery_insert'] = array('js' => ADMIN_JS . 'pages/photo_gallery_insert.js');
$link['photo_gallery_update'] = array('js' => ADMIN_JS . 'pages/photo_gallery_update.js');
$link['photo_category'] = array('js' => ADMIN_JS . 'pages/photo_category.js');
$link['photo_category_insert'] = array('js' => ADMIN_JS . 'pages/photo_category_insert.js');
$link['photo_category_update'] = array('js' => ADMIN_JS . 'pages/photo_category_update.js');
$link['new_before_after_photo'] = array('js' => ADMIN_JS . 'pages/new_before_after_photo.js');
$link['edit_before_after_photo'] = array('js' => ADMIN_JS . 'pages/edit_before_after_photo.js');

// akciók (promotions)
$link['promotions'] = array('js' => ADMIN_JS . 'pages/promotions.js');
$link['new_promotion'] = array('js' => ADMIN_JS . 'pages/new_promotion.js');
$link['edit_promotion'] = array('js' => ADMIN_JS . 'pages/edit_promotion.js');

// munkatársank (crew_members)
$link['crew_members'] = array('js' => ADMIN_JS . 'pages/crew_members.js');
$link['new_crew_member'] = array('js' => ADMIN_JS . 'pages/new_crew_member.js');
$link['edit_crew_member'] = array('js' => ADMIN_JS . 'pages/edit_crew_member.js');
$link['crew_members_category'] = array('js' => ADMIN_JS . 'pages/crew_members_category.js');

// szolgáltatások
$link['szolgaltatasok'] = array('js' => ADMIN_JS . 'pages/szolgaltatasok.js');
$link['uj_szolgaltatas'] = array('js' => ADMIN_JS . 'pages/uj_szolgaltatas.js');
$link['szolgaltatas_update'] = array('js' => ADMIN_JS . 'pages/szolgaltatas_update.js');
$link['szolgaltatasok_category'] = array('js' => ADMIN_JS . 'pages/szolgaltatasok_category.js');
$link['szolgaltatas_category_insert_update'] = array('js' => ADMIN_JS . 'pages/szolgaltatas_category_insert_update.js');
$link['szolgaltatas_order'] = array('js' => ADMIN_JS . 'pages/szolgaltatas_order.js');
$link['szolgaltatas_category_order'] = array('js' => ADMIN_JS . 'pages/szolgaltatas_category_order.js');

// GYIK
$link['gyik'] = array('js' => ADMIN_JS . 'pages/gyik.js');
$link['new_gyik'] = array('js' => ADMIN_JS . 'pages/new_gyik.js');
$link['gyik_category'] = array('js' => ADMIN_JS . 'pages/gyik_category.js');
$link['edit_gyik'] = array('js' => ADMIN_JS . 'pages/edit_gyik.js');

// CÍMKÉK
$link['terms'] = array('js' => ADMIN_JS . 'pages/terms.js');

// KEDVEZMÉNYES CSOMAGOK
$link['offers'] = array('js' => ADMIN_JS . 'pages/offers.js');
$link['edit_offer'] = array('js' => ADMIN_JS . 'pages/edit_offer.js');

// FELUGRÓ ABLAKOK
$link['pop_up_windows'] = array('js' => ADMIN_JS . 'pages/pop_up_windows.js');
$link['new_pop_up_window'] = array('js' => ADMIN_JS . 'pages/new_pop_up_window.js');
$link['edit_pop_up_window'] = array('js' => ADMIN_JS . 'pages/edit_pop_up_window.js');

// FELIRATKOZOTTAK
$link['site_users'] = array('js' => ADMIN_JS . 'pages/site_users.js');
$link['new_pop_up_window'] = array('js' => ADMIN_JS . 'pages/new_pop_up_window.js');
$link['edit_pop_up_window'] = array('js' => ADMIN_JS . 'pages/edit_pop_up_window.js');

// HÍRLEVÉL
$link['newsletter_eventsource'] = array('js' => ADMIN_JS . 'pages/newsletter_eventsource.js');
$link['new_newsletter'] = array('js' => ADMIN_JS . 'pages/new_newsletter.js');
$link['edit_newsletter'] = array('js' => ADMIN_JS . 'pages/edit_newsletter.js');
$link['newsletter_stat'] = array('js' => ADMIN_JS . 'pages/newsletter_stat.js');
$link['newsletter_stats'] = array('js' => ADMIN_JS . 'pages/newsletter_stats.js');
$link['newsletter_templates'] = array('js' => ADMIN_JS . 'pages/newsletter_templates.js');
$link['newsletter_template_edit'] = array('js' => ADMIN_JS . 'pages/newsletter_template_edit.js');
$link['newsletter_template_new'] = array('js' => ADMIN_JS . 'pages/newsletter_template_new.js');

return $link;
?>