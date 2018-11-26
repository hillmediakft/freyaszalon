/**
 Pages oldal
 **/
var PopUpWindows = function () {

    var hideAlert = function () {
        $('div.alert').delay(2500).slideUp(750);
    }

    var deletePopupConfirm = function () {
        $('[id*=delete]').on('click', function (e) {
            e.preventDefault();
            var deleteLink = $(this).attr('href');
            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja a felugró ablakot?", function (result) {
                if (result) {
                    window.location.href = deleteLink;
                }
            });
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            hideAlert();
            deletePopupConfirm();
        }

    };

}();

$(document).ready(function () {
    PopUpWindows.init();





});