/**
 Crew_members oldal
 **/
var Crew_members = function () {

    var hideAlert = function () {
        $('div.alert').delay(2500).slideUp(750);
    }
    
    var deleteCategoryConfirm = function () {
        $('[id*=delete_crew_member_category]').on('click', function (e) {
            e.preventDefault();
            var deleteLink = $(this).attr('href');
            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja a kategóriát?", function (result) {
                if (result) {
                    window.location.href = deleteLink;
                }
            });
        });
    }    


    return {
        //main function to initiate the module
        init: function () {
            deleteCategoryConfirm();
            hideAlert();
        }

    };

}();

$(document).ready(function () {
    Crew_members.init(); // init crew_members page
});