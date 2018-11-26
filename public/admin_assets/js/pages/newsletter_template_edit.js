/**
 New newsletter oldal
 **/
var editNewsletterTemplate = function () {
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
    editNewsletterTemplate.init();
});