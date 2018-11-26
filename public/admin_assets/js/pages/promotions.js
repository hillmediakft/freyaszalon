/**
Akciók oldal
**/
var Promotions = function () {

// sortable list ajax hívás után is működni fog

	var promotionOrder = function() {
		$('tbody#promotions_list').sortable({
			distance: 10,
			cursor: "move",
			axis: "y",
			revert: true,
			opacity: 0.7,
			tolerance: "pointer",
			containment: "parent",
			update: function(event, ui){
			$('#loadingDiv').html('<img src="public/admin_assets/img/loader.gif">');
			$('#loadingDiv').show();
			// a slider_id elemekből képez egy tömböt
			data: $(this).sortable("serialize"),
			
				$.ajax({
					url: "admin/promotions/order",
					type: 'POST',
					data: {
						order	: $( this ).sortable( "serialize"),
						action 	: 'update_promotions_order'
					},
					success: function(msg) {
						console.log(msg);
						$('#loadingDiv').hide();
						$('#message').html(msg).delay(2000).fadeOut();
					}
				});
						   
			} 
					
		});
	}	
	
	// üzenet doboz eltüntetése
	var hideAlert = function () {
		$('div.alert').delay( 2500 ).slideUp( 750 );						 		
	}
	
	var deletePromotionConfirm = function () {
		$('[id*=delete]').on('click', function(e){
               e.preventDefault();
			var deleteLink = $(this).attr('href');
			bootbox.setDefaults({
				locale: "hu", 
			});
			bootbox.confirm("Biztosan törölni akarja az akciót?", function(result) {
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
            
            promotionOrder();
			hideAlert();
			printPage();
			deletePromotionConfirm();
        }

    };

}();
	
	
$(document).ready(function () {
    Promotions.init();
});

