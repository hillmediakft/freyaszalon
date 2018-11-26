var SzolgaltatasCategoryOrder = function () {

    var updateOutput = function (e) {


        var list = e.length ? e : $(e.target),
                output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };


    var ajaxSzolgaltatasCategoryOrder = function (e) {
        console.log(e);
        var list = e.length ? e : $(e.target),
                sort_list = window.JSON.stringify(list.nestable('serialize'));
        console.log(sort_list);
        $.ajax({
            url: 'admin/szolgaltatasok/szolgaltatas_category_sort',
            type: 'POST',
            dataType: 'json',
            data: {
                sort: sort_list
            },
            beforeSend: function () {
                App.blockUI({
                    boxed: true,
                    message: 'Feldolgozás...'
                });
            },
            complete: function (xhr, textStatus) {
                App.unblockUI();
            },
            success: function (result, textStatus, xhr) {
                if (result.status == 'success') {
                    console.log('A sorrend megváltozott!');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(errorThrown);
                console.log("Hiba történt: " + textStatus);
                console.log("Rendszerválasz: " + xhr.responseText);
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {

// activate Nestable for list 1
            $('#nestable_list_3').nestable({
                group: 1
            })
                    .on('change', ajaxSzolgaltatasCategoryOrder);
            // activate Nestable for list 2
            //       $('#nestable_list_3').nestable().on('change', ajaxSzolgaltatasCategoryOrder());





            //      $('#nestable_list_3').nestable();

        }
    };


}();


jQuery(document).ready(function () {
    SzolgaltatasCategoryOrder.init();
});