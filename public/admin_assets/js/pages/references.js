/**
references oldal
**/
var References = function () {

	var hideAlert = function () {
		$('div.alert-success').delay( 2500 ).slideUp( 750 );						 		
	}

	var deleteReferenceConfirm = function () {
			$('[id*=delete]').on('click', function(e){
                e.preventDefault();
				var deleteLink = $(this).attr('href');
				bootbox.setDefaults({
					locale: "hu", 
				});
				bootbox.confirm("Biztosan törölni akarja a referenciát?", function(result) {
					if (result) {
						window.location.href = deleteLink; 	
					}
                }); 
            });			
	}	
	
	var printPage = function () {
			$('[id*=print]').on('click', function(e){
                e.preventDefault();
				window.print();
            });			
	}	

    return {

        //main function to initiate the module
        init: function () {
			deleteReferenceConfirm();
			hideAlert();
			printPage();
        }

    };

}();

$(document).ready(function() {    
	Metronic.init(); // init metronic core componets
	Layout.init(); // init layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	References.init();
	



	
});