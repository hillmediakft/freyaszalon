var PhotoCategory = function () {

    // üzenet doboz eltüntetése
    var hideAlert = function () {
        $('div.alert').delay(2500).slideUp(750);
    }

    var deleteCategoryConfirm = function () {
        $('[id*=delete_category]').on('click', function (e) {
            e.preventDefault();
            var deleteLink = $(this).attr('href');
            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja a kategóriát?", function (result) {
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
            deleteCategoryConfirm();
        }

    };

}();

jQuery(document).ready(function () {
    PhotoCategory.init();
});