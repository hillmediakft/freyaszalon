var Blog = function () {
    
    var equalHeights = function () {
        setTimeout(function () {
            $('#blog-list .blog-item').equalHeights();
        }, 200);
    };

    return {
        //main function to initiate the module
        init: function () {
            equalHeights();
        }
    };

}();

jQuery(document).ready(function () {
   Blog.init();
});