var Elerhetoseg = function () {

    var initToastr = function () {
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "2000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    };

    var contactForm = function () {
        $form = $('#contact_form');
        $('#contact_form').validate(
                {
                    rules: {
                        name: {
                            minlength: 2,
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        message: {
                            minlength: 2,
                            required: true
                        }
                    },
                    highlight: function (element) {
                        jQuery(element).closest('.control-group').removeClass('success').addClass('error');
                    },
                    success: function (element) {

                    },
                    submitHandler: function (form) {
                        // do other stuff for a valid form
                        $('#submit_button').addClass('button-loading');
                        //     $('#submit_contact_office').attr('disabled', 'disabled');
                        $.ajax({
                            type: $form.attr('method'),
                            url: $form.attr('action'),
                            data: $form.serialize(),
                            datatype: 'json',
                            beforeSend: function () {
                                //$('#submit-button').addClass('disabled');
                                $('#submit-button').addClass('button-loading');
                            },
                            success: function (result) {
                                result = $.parseJSON(result);
                                //$('#submit-button').removeClass('disabled');
                                $('#submit-button').removeClass('button-loading');
                                $('#contact_form').find('input[type=text], textarea').val('');
                                if (result.status == 'success') {
                                    toastr.success(result.message, result.title)
                                } else {
                                    toastr.error(result.message, result.title)
                                }
                            }
                        });
                    }
                });

    }



    return {
        //main function to initiate the module
        init: function () {
            initToastr();
            contactForm();

        }
    };

}();


jQuery(document).ready(function () {
    Elerhetoseg.init();
});