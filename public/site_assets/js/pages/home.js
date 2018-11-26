var Home = function () {
    var preLoader = function () {

    };
    
    var equalHeights = function () {
        setTimeout(function () {
            $('#equalheight-home #crew-block').equalHeights();
        }, 200);
    };    

    return {
        //main function to initiate the module
        init: function () {
            preLoader();
            equalHeights();
        }
    };

}();

jQuery(document).ready(function () {
    Home.init();
});