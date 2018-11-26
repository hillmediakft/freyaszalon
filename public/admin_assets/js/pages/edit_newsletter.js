/**
 New newsletter oldal
 **/
var editNewsletter = function () {
        var ckeditorInit = function () {
        CKEDITOR.replace('newsletter_body', {customConfig: 'config_newsletter.js'});
    }
    return {
        //main function to initiate the module
        init: function () {
            ckeditorInit();
        }
    };
}();
jQuery(document).ready(function() {    
        editNewsletter.init();
});