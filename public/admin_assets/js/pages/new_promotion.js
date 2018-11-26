$(document).ready(function () {

    // üzenet doboz eltüntetése
    function hideAlert() {
        $('div.alert').delay(2500).slideUp(750);
    }

    var ckeditorInit = function () {
        CKEDITOR.replace('promotion_text', {customConfig: 'config_custom3.js'});
    }


    hideAlert();
    ckeditorInit();

});