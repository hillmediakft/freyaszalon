/**
 EditOffer oldal
 **/
var EditOffer = function () {


    var updateOfferConfirm = function () {
        $('#update_offer_form').submit(function (e) {
            e.preventDefault();
            currentForm = this;
            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan menti a módosításokat?", function (result) {
                if (result) {
                    // a submit() nem küldi el a gomb name értékét, ezért be kell rakni egy hidden elemet
                    $('#update_offer_form').append($("<input>").attr("type", "hidden").attr("name", "submit_update_offer").val("submit_update_offer"));
                    currentForm.submit();
                }
            });
        });
    }

    var hideAlert = function () {
        $('div.alert').delay(2500).slideUp(750);
    }

    var ckeditorInit = function () {
        CKEDITOR.replace('offer_package', {customConfig: 'config_custom2.js'});
        //   CKEDITOR.replace('offer_package');
    }

    return {

        //main function to initiate the module
        init: function () {
            updateOfferConfirm();
            hideAlert();
            ckeditorInit();
        }
    };
}();

$(document).ready(function () {
    EditOffer.init();
});