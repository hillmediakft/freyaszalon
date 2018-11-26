// =============================================================
/* Animation */
// =============================================================
$(window).scroll(function () {
    "use strict";

    $(".animated-area").each(function () {
        if ($(window).height() + $(window).scrollTop() - $(this).offset().top > 0) {
            $(this).trigger("animate-it");
        }
    });
});

$('a[data-rel]').each(function () {
    $(this).attr('rel', $(this).data('rel'));
});


if ($('.animated-area').length) {
    $(".animated-area").on("animate-it", function () {
        var cf = $(this);
        cf.find(".animated").each(function () {
            $(this).css("-webkit-animation-duration", "0.9s");
            $(this).css("-moz-animation-duration", "0.9s");
            $(this).css("-ms-animation-duration", "0.9s");
            $(this).css("animation-duration", "0.9s");
            $(this).css("-webkit-animation-delay", $(this).attr("data-animation-delay"));
            $(this).css("-moz-animation-delay", $(this).attr("data-animation-delay"));
            $(this).css("-ms-animation-delay", $(this).attr("data-animation-delay"));
            $(this).css("animation-delay", $(this).attr("data-animation-delay"));
            $(this).addClass($(this).attr("data-animation"));
        });
    });
}
// JavaScript Document
jQuery(document).ready(function ($) {
    "use strict";


    if ($('#form_contact_').length) {
        $('#form_contact').validate();
    }


    // Nav Bar Dropdown on mouseover
    if ($('.navbar-inner ul >li').length) {
        $(".navbar-inner ul >li").hover(
                function () {
                    $(this).addClass('open');
                },
                function () {
                    $(this).removeClass('open');
                }
        );
    }
//Home Page Mian Image Slider
    if ($('.header-slider').length) {
        $('.header-slider').bxSlider({
            auto: true,
            autoControls: false
        });
    }


//Home Page Quote Slider
    if ($('.quote-slider').length) {
        $('.quote-slider').bxSlider({
            auto: true,
            autoControls: false});
    }


//Home Page Quote Slider
    if ($('.about-slider').length) {
        $('.about-slider').bxSlider({
            auto: true,
            mode: 'fade',
            autoControls: false});
    }


//Product Details Page
    if ($('.pro-slider').length) {
        $('.pro-slider').bxSlider({
            pagerCustom: '#bx-pager'
        });
    }

    if ($('.bxslider').length) {
        $('.bxslider').bxSlider({
            pagerCustom: '#bx-pager'
        });
    }


//Partner Logos
    if ($('.logo-slider').length) {
        $('.logo-slider').bxSlider({
            minSlides: 1,
            maxSlides: 4,
            slideWidth: 263,
            slideMargin: 24
        });
    }

    if ($('.blog-slider').length) {
        $('.blog-slider').bxSlider({
            adaptiveHeight: true,
            mode: 'fade'
        });
    }


// Dropdown Menu Fade
    if ($('.dropdown').length) {
        $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).fadeIn("fast");
                },
                function () {
                    $('.dropdown-menu', this).fadeOut("fast");
                });
    }



    if ($('#map').length) {

        var myLatlng = new google.maps.LatLng(47.205594, 18.459765);
        var map_canvas = document.getElementById('map');
        var map_options = {
            scrollwheel: false,
            center: myLatlng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: true,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            scaleControl: false,
            streetViewControl: true
        }
        var map = new google.maps.Map(map_canvas, map_options);
        map.set('styles', [
            {
                stylers: [
                    {saturation: -100}
                ]
            }, {
                featureType: 'poi.business',
                elementType: 'labels',
                stylers: [
                    {visibility: 'off'}
                ]
            }
        ]);

        var image = {
            url: 'public/site_assets/images/marker.png',
            size: new google.maps.Size(60, 62)

        };
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            icon: image
        });
    }





    /*
     if ($('#map').length) {
     map = new GMaps({
     el: '#map',
     lat: 47.205575,
     lng: 18.459829
     });
     map.addMarker({
     lat: 47.205575,
     lng: 18.459829,
     title: 'Freya szalon',
     infoWindow: {
     content: '<p><i class="fa fa-home"></i> Székesfehérvár Pozsonyi út 116.</p><p><i class="fa fa-phone"></i> (22) 302-532</p><p><i class="fa fa-mobile"></i>  (20) 4971-363</p><p><i class="fa fa-envelope"></i> <a href="mailto:info@freyaszalon.hu"> info@freyaszalon.hu</a></p>'
     }
     });
     }
     */



//Image Gallery Pretty Photo
    if ($('.gallery').length) {
        $("area[rel^='prettyPhoto']").prettyPhoto();
        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed: 'normal', theme: 'light_square', slideshow: 3000, autoplay_slideshow: true});
        $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed: 'fast', slideshow: 10000, hideflash: true});

        $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
            custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
            changepicturecallback: function () {
                initialize();
            }
        });

        $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
            custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
            changepicturecallback: function () {
                _bsap.exec();
            }
        });
    }
//Image Gallery Pretty Photo End

//Sticky Header
    if ($('#header').length) {
        // grab the initial top offset of the navigation 
        var stickyNavTop = $('#header').offset().top;
        // our function that decides weather the navigation bar should have "fixed" css position or not.
        var stickyNav = function () {
            var scrollTop = $(window).scrollTop(); // our current vertical position from the top

            // if we've scrolled more than the navigation, change its position to fixed to stick to top,
            // otherwise change it back to relative
            if (scrollTop > stickyNavTop) {
                $('#header').addClass('sticky');
            } else {
                $('#header').removeClass('sticky');
            }
        };
        stickyNav();
        // and run it again every time you scroll
        $(window).scroll(function () {
            stickyNav();
        });
    }
//Sticky Header End

    if ($('#duration').length) {
        if ($('#duration').length) {
            $('#duration').timepicker();
        }
    }
    if ($('div.alert').length) {
        $('div.alert').delay(5500).slideUp(750);
    }


// képgaléria mixitup
    if ($('.mix-grid').length) {
        $('.mix-grid').mixitup();
    }


// kalkulátor form
/*    if ($('#kalkulator').length) {
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
                                success: function (response) {

                                    $('img.loader').fadeOut('slow', function () {
                                        $(this).remove()
                                    });
                                    $('#email_message').hide().html(response).slideDown('slow');
                                    $('#submit_kalkulator_kontakt').removeAttr('disabled');
                                    $('#email_message').delay(3000).slideUp('slow');

                                }
                            });




                        }
                        // on success vége

                    });

                }
            });

        });
    } */

    /*	
     // kalkulátor kontakt form
     if($('#kalkulator_kontakt').length){
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
     
     onSuccess: function(e) {
     // Prevent form submission
     e.preventDefault();
     
     var action = $('#kalkulator_kontakt').attr('action');
     
     $('#submit_kalkulator_kontakt')
     .after('<img src="public/site_assets/images/ajax-loader.gif" class="loader" />')
     .attr('disabled','disabled');
     
     $.ajax({
     type:"POST",
     url: action,   //put the url of your php file here
     data: $('#kalkulator_kontakt').serialize(),
     success: function(response){
     
     var json = $.parseJSON(response);
     
     console.log(json.status);
     
     
     $('#package').hide().html(data).slideDown('slow');
     $('#kalkulator img.loader').fadeOut('slow',function(){$(this).remove()});
     document.getElementById('message').innerHTML = data;
     $('#message').hide().slideDown('slow');
     $('#submit_kalkulator').removeAttr('disabled');
     $('#message').addClass('mt20');
     $('#message').delay( 2500 ).slideUp( 750 );
     
     
     }
     });	
     
     
     
     
     }
     // on success vége
     
     });
     }	
     
     */
    if ($('#contact_form_fffff').length) {


        $('#contact_form').bootstrapValidator({
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
                        }
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
                },
                message: {
                    validators: {
                        notEmpty: {
                            message: 'Az üzenet megadása kötelező!'
                        }
                    }
                }
            },
            onSuccess: function (e) {
                // Prevent form submission
                e.preventDefault();

                var action = $('#contact_form').attr('action');

                $('#submit_contact_email')
                        .after('<img src="public/site_assets/images/ajax-loader.gif" class="loader" />')
                        .attr('disabled', 'disabled');

                $.ajax({
                    type: "POST",
                    url: action, //put the url of your php file here
                    data: $('#contact_form').serialize(),
                    success: function (response) {

                        $('img.loader').fadeOut('slow', function () {
                            $(this).remove()
                        });
                        $('#email_message').hide().html(response).slideDown('slow');
                        $('#submit_contact_email').removeAttr('disabled');
                        $('#email_message').delay(3000).slideUp('slow');

                    }
                });




            }
            // on success vége

        });
    }



});

$(window).on('load', function () {
    if ($('.selectpicker').length) {
        $('.selectpicker').selectpicker({
            'selectedText': 'cat'
        });
    }
});

$(window).on('load', function () {

    if (document.cookie.indexOf("freya-pop-up") >= 0) {

    } else {
        if ($('#pop-up-window').length) {
            document.cookie = "freya-pop-up=true";
            $('#pop-up-window').modal('show');
        }
    }

});
/************ COOKIE CONSENT ****************/
var dropCookie = true;                      // false disables the Cookie, allowing you to style the banner
var cookieDuration = 14;                    // Number of days before the cookie expires, and the banner reappears
var cookieName = 'cookieConsent';        // Name of our cookie
var cookieValue = 'on';                     // Value of cookie
 
function createDiv(){
    var bodytag = document.getElementsByTagName('body')[0];
    var div = document.createElement('div');
    div.setAttribute('id','cookie-law');
    div.innerHTML = '<p>Weboldalunk a jobb felhasználói élmény biztosítása érdekében sütiket (cookie) használ. A Weboldal használatával Ön beleegyezik a sütik használatába. <a class="cookie-banner btn btn-primary" href="javascript:void(0);" onclick="removeMe();"><span>Értem</span></a></p>';    
 // Be advised the Close Banner 'X' link requires jQuery
     
    // bodytag.appendChild(div); // Adds the Cookie Law Banner just before the closing </body> tag
    // or
    bodytag.insertBefore(div,bodytag.firstChild); // Adds the Cookie Law Banner just after the opening <body> tag
     
    document.getElementsByTagName('body')[0].className+=' cookiebanner'; //Adds a class tothe <body> tag when the banner is visible
     
    createCookie(window.cookieName,window.cookieValue, window.cookieDuration); // Create the cookie
}
 
 
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000)); 
        var expires = "; expires="+date.toGMTString(); 
    }
    else var expires = "";
    if(window.dropCookie) { 
        document.cookie = name+"="+value+expires+"; path=/"; 
    }
}
 
function checkCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
 
function eraseCookie(name) {
    createCookie(name,"",-1);
}
 
window.onload = function(){
    if(checkCookie(window.cookieName) !== window.cookieValue){
        createDiv(); 
    }
};

function removeMe(){
	var element = document.getElementById('cookie-law');
	element.parentNode.removeChild(element);
}

