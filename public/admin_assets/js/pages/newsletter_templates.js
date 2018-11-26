/**
 Template Templates oldal
 **/
var Template = function () {

    var templateTable = function () {

        var table = $('#template_table');
        // begin first table


        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "_START_ - _END_ elem _TOTAL_ elemből",
                "infoEmpty": "Nincs megjeleníthető adat!",
                "infoFiltered": "(Szűrve _MAX_ elemből)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "Nincs egyező elem"
            },
            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            // "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columns": [{
                    "orderable": false
                }, {
                    "orderable": true
                }, {
                    "orderable": true
                }, {
                    "orderable": true
                }, {
                    "orderable": false
                }],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "language": {
                "search": "Keresés: ",
                "lengthMenu": "  _MENU_ elem/oldal",
                "paginate": {
                    "previous": "Előző",
                    "next": "Következő",
                    "last": "Utolsó",
                    "first": "Első"
                }
            },
            "columnDefs": [{// set default column settings
                    'orderable': false,
                    'targets': [0]
                }, {
                    "searchable": false,
                    "targets": [0]
                }]
 //           "order": [
 //               [2, "desc"]
//            ] // set column as a default sort by asc


        });

        var tableWrapper = jQuery('#template_table_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-sm input-inline"); // modify table per page dropdown
    }

    var deleteOneTemplateConfirm = function () {
        $('[id*=delete_template]').on('click', function (e) {
            e.preventDefault();
            //var deleteLink = $(this).attr('href');
            var templateName = $(this).closest("tr").find('td:nth-child(2)').text();

            // az <a> html elemet hozzárendeljük a link nevű változóhoz
            var link = $(this);
          

            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja a <strong>" + templateName + "</strong> sablont?", function (result) {
                if (result) {
                    //window.location.href = deleteLink;

                    // paraméter az <a> elem amire klikkeltünk
                    delete_template_AJAX(link);
                }
            });
        });

    }

    var deleteTemplateTableConfirm = function () {
        $('#del_template_form').submit(function (e) {
            e.preventDefault();
            currentForm = this;
            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja a kijelölt sablonokat?", function (result) {
                if (result) {
                    // a submit() nem küldi el a gomb name értékét, ezért be kell rakni egy hidden elemet
                    $('#del_template_form').append($("<input>").attr("type", "hidden").attr("name", "delete_template").val("submit_delete_template"));
                    currentForm.submit();
                }
            });
        });
    }




    var enableDisableButtons = function () {

        var deleteUserSubmit = $('button[name="del_template_submit"]');
        var checkAll = $('input.group-checkable');
        var checkboxes = $('input.checkboxes');

        deleteUserSubmit.attr('disabled', true);

        checkboxes.change(function () {
            $(this).closest("tr").find('.btn-group a').attr('disabled', $(this).is(':checked'));
            deleteUserSubmit.attr('disabled', !checkboxes.is(':checked'));
        });
        checkAll.change(function () {
            checkboxes.closest("tr").find('.btn-group a').attr('disabled', $(this).is(':checked'));
            deleteUserSubmit.attr('disabled', !checkboxes.is(':checked'));
        });

    }


    var hideAlert = function () {
        $('div.alert').delay(2500).slideUp(750);
    }


    var printTable = function () {
        $('#print_template').on('click', function (e) {
            e.preventDefault();
            var divToPrint = document.getElementById("template_table");
            console.log(divToPrint);
//		divToPrint = $('#template_table tr').find('th:last, td:last').remove();
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        })
    }


    /**
     *	Egy hírlevél törlése
     *
     */
    var delete_template_AJAX = function (link) {
       // $('a[id*=delete_template]').click(function(event){
        // event.preventDefault();    

        //a link rel attribútumának értékét változóhoz rendeljük (ez tartalmazza az id-t)
        var template_id = link.attr('rel');

        // a del_tr változóhoz rendeljük a html táblázat törlendő sorát
        var del_tr = link.closest("tr");

        //üzenet elem
        var message = $('#message');

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
            url: "admin/newsletter/delete_template_AJAX",
            // kész a hívás... utána ez történjen
            complete: function () {
                $('#loadingDiv').hide();
            },
            // itt kapjuk meg (és dolgozzuk fel) a feldolgozó php által visszadott adatot 
            success: function (result) {
                //JSON string elemeinek elhelyezése egy objektumba
                var response = $.parseJSON(result);

                if (response.status == 'success') {
                    message.append('<div class="alert alert-success">' + response.message + '</div>');
                    $('#message > div').delay(2500).slideUp(750, function () {
                        $(this).remove();
                    });
                    del_tr.remove();
                }

                if (response.status == 'error') {
                    message.append('<div class="alert alert-danger">' + response.message + '</div>');
                    $('#message > div').delay(2500).slideUp(750, function () {
                        $(this).remove();
                    });
                }

            },
            error: function (result, status, e) {
                alert(e);
            }
        });

     //   });


    }
    /*--------------------------------------------------*/

    var showTemplateModal = function () {
        $('[id*=show_preview_modal]').on('click', function (e) {
            e.preventDefault();
            
           
            var preview_wrapper = $('#template_preview') ; 
            // a preview_wrapper "kiürítése, ha vaolt már betöltött sablon
            preview_wrapper.empty();
            //var deleteLink = $(this).attr('href');
            var link = $(this);
            var template_id = link.attr('data-id');
           

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
                    $('#preview_modal').modal('show');
                    preview_wrapper.append(result);
                    
                   

            },
            error: function (result, status, e) {
                alert(e);
            }
        });          
          

        });

    }

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            showTemplateModal();
            templateTable();
            deleteOneTemplateConfirm();
            deleteTemplateTableConfirm();
            enableDisableButtons();
            hideAlert();
            printTable();
            //submit_template_AJAX_2;
            //startTask();

        }

    };

}();

$(document).ready(function () {
    Template.init(); // init Template page

});