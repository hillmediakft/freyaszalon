var InsertPhoto = function () {

    /**
     *  Form adatok elküldése
     */
    var sendForm = function () {
        $('#edit_photo').submit(function (e) {
            e.preventDefault();
            currentForm = this;

            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan menti a képet?", function (result) {
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
    
    var multipleSelect = function () {

        // Set the "bootstrap" theme as the default theme for all Select2
        // widgets.
        //
        // @see https://github.com/select2/select2/issues/2927


        $(".select2-multiple").select2({
            theme: "classic"
        });
    }


    return {
        //main function to initiate the module
        init: function () {
            multipleSelect();
            sendForm();
        }
    };


}();


jQuery(document).ready(function () {
    InsertPhoto.init();
});