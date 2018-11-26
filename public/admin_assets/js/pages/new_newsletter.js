/**
 New newsletter oldal
 **/
var newNewsletter = function () {


    /*--------------------------------------------------*/

    var loadTemplate = function () {
       $("#template_select").change(function(e) {
            e.preventDefault();
            

            var newsletter_body = $('#newsletter_body') ; 

            //var deleteLink = $(this).attr('href');
            var link = $(this);
            var template_id = link.val();

           

//megjelenítjük a loading animációt
        $('#loadingDiv').html('<img src="public/admin_assets/img/loader.gif">');
        $('#loadingDiv').show();

        //végrehajtjuk az AJAX hívást
        $.ajax({
            type: "POST",
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: {
                template_id: template_id
            },
            // a feldolgozó url-je
            url: "admin/newsletter/load_template_prewiew_AJAX",
            // kész a hívás... utána ez történjen
            complete: function () {
                $('#loadingDiv').hide();
            },
            // itt kapjuk meg (és dolgozzuk fel) a feldolgozó php által visszadott adatot 
            success: function (result) {
                  
                CKEDITOR.instances.newsletter_body.setData(result);
                    
                   

            },
            error: function (result, status, e) {
                alert(e);
            }
        });          
          

        });

    }
    
        var ckeditorInit = function () {
        CKEDITOR.replace('newsletter_body', {customConfig: 'config_newsletter.js'});
    }

    return {
        //main function to initiate the module
        init: function () {
            loadTemplate();
            ckeditorInit();
        }

    };

}();


jQuery(document).ready(function() {    
        newNewsletter.init();
});