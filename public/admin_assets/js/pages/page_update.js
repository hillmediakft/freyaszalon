var Page_update = function () {

    var updatePageConfirm = function () {
        $('#page_update_form').submit(function (e) {
            e.preventDefault();

            var currentForm = this;

            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan menti a módosításokat?", function (result) {
                if (result) {

                    App.blockUI({
                        boxed: true,
                        message: 'Feldolgozás...'
                    });

                    setTimeout(function () {
                        currentForm.submit();
                    }, 300);
                }
            });
        });
    };
    
        var ckeditorInit = function () {
        CKEDITOR.replace('page_body', {customConfig: 'config_custom3.js'});
    }

    return {

        //main function to initiate the module
        init: function () {
            updatePageConfirm();
            vframework.hideAlert();
            ckeditorInit();

        }

    };

}();

$(document).ready(function () {
    Page_update.init();
});