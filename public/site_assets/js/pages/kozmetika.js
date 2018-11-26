var Kozmetika = function () {

    var smoothScroll = function () {
        jQuery('a[href^="kozmetika/ungvar-katalin#"]').on('click', function (e) {
            // target element id
            var id = jQuery(this).attr('href');
            id = id.replace("kozmetika/ungvar-katalin", "");
            // prevent standard hash navigation (avoid blinking in IE)
            e.preventDefault();
            // top position relative to the document
            var pos = jQuery(id).offset().top;
            // animated top scrolling
            jQuery('body, html').animate({scrollTop: pos - 100});
        });
    };
    return {
        init: function () {
            smoothScroll();
        }
    };
}();

jQuery(document).ready(function () {
    Kozmetika.init();
});