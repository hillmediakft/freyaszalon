var CsomagKalkulator = function () {

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

        // kalkulátor form
        if ($('#kalkulator').length) {
            $('#kalkulator').submit(function (e) {

                // Prevent form submission
                e.preventDefault();

                var action = $('#kalkulator').attr('action');

                $('#submit_kalkulator')
                        .after('<img src="public/site_assets/images/ajax-loader.gif" class="loader" />')
                        .attr('disabled', 'disabled');

                $.ajax({
                    type: "POST",
                    url: action, //put the url of your php file here
                    data: $('#kalkulator').serialize(),
                    success: function (response) {

                        var json = $.parseJSON(response);

                        $('#package').hide().html(json.offer).slideDown('slow');
                        $('#kalkulator img.loader').fadeOut('slow', function () {
                            $(this).remove()
                        });
                        $('#message').hide().html(json.kontakt_form).slideDown('slow');
                        $('<input>').attr('type', 'hidden').attr('name', 'code').attr('value', json.code).appendTo('#kalkulator_kontakt');
                        $('<input>').attr('type', 'hidden').attr('name', 'offer').attr('value', json.offer).appendTo('#kalkulator_kontakt');
                        $('#submit_kalkulator').removeAttr('disabled');
                        // kalkulátor kontakt form



                        $('#kalkulator_kontakt').bootstrapValidator({
                            excluded: [':disabled'],
                            feedbackIcons: {
                                //            required: 'glyphicon glyphicon-asterisk',
                                valid: 'glyphicon glyphicon-ok',
                                //            invalid: 'glyphicon glyphicon-remove',
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            fields: {
                                name: {
                                    message: 'A név megadása kötelező!',
                                    validators: {
                                        notEmpty: {
                                            message: 'A név nem lehet üres!'
                                        },
                                    }
                                },
                                email: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Az e-mail megadása kötelező!'
                                        },
                                        emailAddress: {
                                            message: 'Az e-mail cím nem megfelelő formátumú!'
                                        }
                                    }
                                }
                            },
                            onSuccess: function (e) {
                                // Prevent form submission
                                e.preventDefault();

                                var action = $('#kalkulator_kontakt').attr('action');

                                $('#submit_kalkulator_kontakt')
                                        .after('<img src="public/site_assets/images/ajax-loader.gif" class="loader" />')
                                        .attr('disabled', 'disabled');

                                $.ajax({
                                    type: "POST",
                                    url: action, //put the url of your php file here
                                    data: $('#kalkulator_kontakt').serialize(),
                                    success: function (result) {

                                        result = $.parseJSON(result);

                                        $('img.loader').fadeOut('slow', function () {
                                            $(this).remove()
                                        });
                                        if (result.status == 'success') {
                                            toastr.success(result.message, result.title)
                                        } else {
                                            toastr.error(result.message, result.title)
                                        }



                                    }
                                });




                            }
                            // on success vége

                        });

                    }
                });

            });
        }


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
    CsomagKalkulator.init();
});