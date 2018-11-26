var Csapatunk = function () {

    var equalHeights = function () {
        setTimeout(function () {
            $('#equalheight-crew div#crew-block').equalHeights();
        }, 200);
    };

    return {
        init: function () {
            equalHeights();
        }
    };
}();

jQuery(document).ready(function () {
    Csapatunk.init();
});