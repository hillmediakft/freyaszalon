var EditContent = function () {

	var updateContentConfirm = function () {
        $('#update_content_form').submit(function(e){
            e.preventDefault();
            var currentForm = this;
            bootbox.setDefaults({
                locale: "hu", 
            });
            bootbox.confirm("Biztosan meni a módosításokat?", function(result) {
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
	
	var hideAlert = function () {
		$('div.alert').delay( 2500 ).slideUp( 750 );						 		
	};	
	
        var ckeditorInit = function () {
        CKEDITOR.replace('content_body', {customConfig: 'config_custom3.js?v2'});
    }	

    return {

        //main function to initiate the module
        init: function () {
			updateContentConfirm();
			hideAlert();
			ckeditorInit();
        }

    };

}();

$(document).ready(function() {    
	EditContent.init();
});