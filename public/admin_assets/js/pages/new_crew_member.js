var newCrewMember = function () {

    var cropCrewMemberPhoto = function () {
        var memberPhoto = $('#crew_member_image');
        memberPhoto.css("width", '502px').css("height", '502px');
        var cropperOptions = {
            //kérés a user_img_upload metódusnak "upload" paraméterrel
            uploadUrl: 'admin/crew_members/crew_member_img_upload/upload',
            //kérés a user_img_upload metódusnak "crop" paraméterrel
            cropUrl: 'admin/crew_members/crew_member_img_upload/crop',
            outputUrlId: 'OutputId',
            modal: false,
            doubleZoomControls: false,
            rotateControls: false,
            loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
        }
        var cropperHeader = new Croppic('crew_member_image', cropperOptions);
    }


    var hideAlert = function () {
        $('div.alert alert-success, div.alert alert-danger').delay(3000).slideUp(750);
    }

    var ckeditorInit = function () {
        CKEDITOR.replace('crew_member_info', {customConfig: 'config_custom1.js'});
        //	CKEDITOR.replace( 'promotion_text');							
    }


    return {
//main method to initiate page
        init: function () {
            cropCrewMemberPhoto();
            hideAlert();
            ckeditorInit();
        },
    };
}();
$(document).ready(function () {
    newCrewMember.init(); // init users page
});