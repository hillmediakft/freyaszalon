/**
 EditPromotion oldal
 **/
var EditPromotion = function () {


    var updatePromotionConfirm = function () {
        $('#update_promotion_form').submit(function (e) {
            e.preventDefault();
            currentForm = this;
            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan menti a módosításokat?", function (result) {
                if (result) {
                    // a submit() nem küldi el a gomb name értékét, ezért be kell rakni egy hidden elemet
                    $('#update_promotion_form').append($("<input>").attr("type", "hidden").attr("name", "submit_update_promotion").val("submit_update_promotion"));
                    currentForm.submit();
                }
            });
        });
    }

    var hideAlert = function () {
        $('div.alert').delay(2500).slideUp(750);
    }

    var ckeditorInit = function () {
        CKEDITOR.replace('promotion_text', {customConfig: 'config_custom3.js'});
    }


    return {
        //main function to initiate the module
        init: function () {
            updatePromotionConfirm();
            hideAlert();
            ckeditorInit();
        }

    };

}();

$(document).ready(function () {
    EditPromotion.init();
});