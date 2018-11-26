/**
 Terms oldal
 **/
var Terms = function () {

    var termsTable = function () {

        var table = $('#terms');
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

            "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

            "columns": [{
                    "orderable": false
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
            "pageLength": 15,
            "pagingType": "bootstrap_full_number",
            "language": {
                "search": "Keresés: ",
                "lengthMenu": "  _MENU_ elem/oldal",
                "sInfo": "_START_ - _END_ / _TOTAL_ elem",
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
                }],
            "order": [
                [1, "asc"]
            ] // set column as a default sort by asc


        });

        var tableWrapper = jQuery('#terms_wrapper');

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

    var deleteOneTermConfirm = function () {
        $('[id*=delete_term]').on('click', function (e) {
            e.preventDefault();
            var deleteLink = $(this).attr('href');
            var termsName = $(this).closest("tr").find('td:nth-child(2)').text();

            bootbox.setDefaults({
                locale: "hu",
            });

            bootbox.confirm("Biztosan törölni akarja a '"+termsName+"' címkét?", function (result) {
                if (result) {
                    window.location.href = deleteLink;
                }
            });

        });
    }

    var deleteTermsConfirm = function () {
        $('#del_terms_form').submit(function (e) {
            e.preventDefault();
            currentForm = this;
            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja a kijelölt címkét/címkéket?", function (result) {
                if (result) {
                    // a submit() nem küldi el a gomb name értékét, ezért be kell rakni egy hidden elemet
                    //$('#del_terms_form').append($("<input>").attr("type", "hidden").attr("name", "delete_terms_submit").val("submit"));
                    currentForm.submit();
                }
            });
        });
    }


    var hideAlert = function () {
        $('div.alert').delay(2500).slideUp(750);
    }


    var makeActive = function (termsId, action, url, elem) {
        //console.log(elem);
        $.ajax({
            type: "POST",
            data: {
                id: termsId,
                action: action
            },
            url: url,
            dataType: "json",
            beforeSend: function () {
                $('#loadingDiv').html('<img src="public/admin_assets/img/loader.gif">');
                $('#loadingDiv').show();
            },
            complete: function () {
                $('#loadingDiv').hide();
            },
            success: function (result) {
                if (result.status == 'success') {

                    if (action == 'make_inactive') {
                        $(elem).html('<i class="fa fa-check"></i> Aktivál');
                        $(elem).attr('data-action', 'make_active');
                        //$(elem).attr('href', 'admin/terms/make_active');
                        $(elem).closest('td').prev().html('<span class="label label-sm label-danger">Inaktív</span>');
                        $("#ajax_message").html('<div class="alert alert-success">A termék inaktív státuszba került!</div>');
                        hideAlert();
                    } else if (action == 'make_active') {
                        $(elem).html('<i class="fa fa-ban"></i> Blokkol');
                        $(elem).attr('data-action', 'make_inactive');
                        //$(elem).attr('href', 'admin/terms/make_inactive');
                        $(elem).closest('td').prev().html('<span class="label label-sm label-success">Aktív</span>');
                        $("#ajax_message").html('<div class="alert alert-success">A termék aktív státuszba került!</div>');
                        hideAlert();
                    }

                } else {
                    console.log('Hiba: az adatbázis művelet nem történt meg!');
                    $("#ajax_message").html('<div class="alert alert-success">Adatbázis hiba! A termék státusza nem változott meg!</div>');
                    hideAlert();
                }
            },
            error: function (result, status, e) {
                alert(e);
            }
        });

    }
    
     var submitEditForm = function () {
        $('#update_term_form').submit(function (e) {
            e.preventDefault();
            form = this;
                App.blockUI({
                    boxed: true,
                    message: 'Feldolgozás...'
                });
                setTimeout(function () {
                    form.submit();
                }, 1000);
        });
    }   
    
     var submitAddForm = function () {
        $('#add_term_form').submit(function (e) {
            e.preventDefault();
            form = this;
                App.blockUI({
                    boxed: true,
                    message: 'Feldolgozás...'
                });
                setTimeout(function () {
                    form.submit();
                }, 1000);
        });
    }     

    var populateModal = function () {
        $('#edit_term').on('show.bs.modal', function (e) {
            term = $(e.relatedTarget).parents('tr').find('td:nth-child(2)').html();
            id = $(e.relatedTarget).parents('tr').find('td:first-child input.checkboxes').val();
            $('#update_term_form input#term').val(term);
             $('#update_term_form input#term_id').val(id);
            console.log(id);
        })

    }
            
    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            populateModal();
            termsTable();
            deleteOneTermConfirm();
            deleteTermsConfirm();
            hideAlert();
            submitEditForm();
            submitAddForm();
        }

    };

}();

$(document).ready(function () {
    Terms.init(); // init terms page
});