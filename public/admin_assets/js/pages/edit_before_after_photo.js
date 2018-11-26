var newBeforeAfterPhoto = function () {

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
            bootbox.confirm("Biztosan menti a módosításokat?", function (result) {
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
    
    var cropBeforeAftertPhoto = function () {
        var photo_1 = $('#before_after_image_1');
        console.log('hello');
        photo_1.css("width", '400px').css("height", '550px');
        var cropperOptions = {
            //kérés a user_img_upload metódusnak "upload" paraméterrel
            uploadUrl: 'admin/before_after_photo_gallery/before_after_img_upload/upload',
            //kérés a user_img_upload metódusnak "crop" paraméterrel
            cropUrl: 'admin/before_after_photo_gallery/before_after_img_upload/crop',
            outputUrlId: 'OutputId_1',
            modal: false,
            doubleZoomControls: false,
            rotateControls: false,
            loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
        }
        var cropperHeader = new Croppic('before_after_image_1', cropperOptions);

        var photo_2 = $('#before_after_image_2');
        console.log('hello');
        photo_2.css("width", '400px').css("height", '500px');
        var cropperOptions = {
            //kérés a user_img_upload metódusnak "upload" paraméterrel
            uploadUrl: 'admin/before_after_photo_gallery/before_after_img_upload/upload',
            //kérés a user_img_upload metódusnak "crop" paraméterrel
            cropUrl: 'admin/before_after_photo_gallery/before_after_img_upload/crop',
            outputUrlId: 'OutputId_2',
            modal: false,
            doubleZoomControls: false,
            rotateControls: false,
            loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
        }
        var cropperHeader = new Croppic('before_after_image_2', cropperOptions);
    }

    /**
     *	User placeholder kép megjelenítés 
     */
    var handleOldImg = function () {
        var oldImg_1 = $('#old_img_1').val();
        $('#before_after_image_1').css('background-image', 'url(' + oldImg_1 + ')');
        var oldImg_2 = $('#old_img_2').val();
        $('#before_after_image_2').css('background-image', 'url(' + oldImg_2 + ')');
    }


    var hideAlert = function () {
        $('div.alert.alert-success, div.alert.alert-danger').delay(3000).slideUp(750);
    }

    var ckeditorInit = function () {
        CKEDITOR.replace('photo_text', {customConfig: 'config_custom3.js?v2'});
    }


    return {
//main method to initiate page
        init: function () {
            sendForm();
            cropBeforeAftertPhoto();
            hideAlert();
            handleOldImg();
            ckeditorInit();
        },
    };
}();
$(document).ready(function () {
    newBeforeAfterPhoto.init(); // init users page
});