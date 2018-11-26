/**
 New newsletter oldal
 **/
var newNewsletterTemplate = function () {
    var ckeditorInit = function () {
        CKEDITOR.replace('template_body', {customConfig: 'config_newsletter.js'});
    }
    return {
        //main function to initiate the module
        init: function () {
            ckeditorInit();
        }
    };
}();
jQuery(document).ready(function () {
    newNewsletterTemplate.init();
});