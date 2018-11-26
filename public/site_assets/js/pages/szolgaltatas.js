var Szolgaltatas = function () {
    $pic = $('.my-gallery');

    var initPhotoSwipeFromDOM = function () {
        $('.my-gallery').each(function () {
            items = getItems();
        });
    };

    var getItems = function () {
        var items = [];
        $pic.find('a').each(function () {
            var $href = $(this).attr('href'),
                    $size = $(this).data('size').split('x'),
                    $width = $size[0],
                    $height = $size[1];
            var item = {
                src: $href,
                w: $width,
                h: $height
            }
            items.push(item);
        });
        return items;
    }

    var $pswp = $('.pswp')[0];
    $pic.on('click', 'figure', function (event) {
        event.preventDefault();

        var $index = $(this).index();
        var options = {
            index: $index,
            bgOpacity: 0.7,
            showHideOpacity: true,
            shareButtons: [
                {id: 'facebook', label: 'Megosztás a Facebook-on', url: 'https://www.facebook.com/sharer/sharer.php?u={{url}}'},
                {id: 'twitter', label: 'Tweet', url: 'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'},
                {id: 'pinterest', label: 'Pin it', url: 'http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}'},
                {id: 'download', label: 'Letöltés', url: '{{raw_image_url}}', download: true}
            ],
        }

        // Initialize PhotoSwipe
        var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
        lightBox.init();
    });


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
                                $('#email-modal').modal('hide');
                            }
                        });
                    }
                });

    }


    return {
        //main function to initiate the module
        init: function () {
            initPhotoSwipeFromDOM();
            initToastr();
            contactForm();
        }
    };

}();

jQuery(document).ready(function () {
    Szolgaltatas.init();
});