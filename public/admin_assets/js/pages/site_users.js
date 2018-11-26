/**
 SiteUsers oldal
 **/
var Users = function () {


    var usersTable = function () {
        var grid = new Datatable();

        grid.init({
            src: $("#users"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            loadingMessage: 'Betöltés...',
            dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                "columnDefs": [
                    {"name": "chechbox", "searchable": false, "orderable": false, "targets": 0},
                    {"name": "user_id", "searchable": false, "orderable": true, "targets": 1},
                    {"name": "user_name", "searchable": true, "orderable": true, "targets": 2},
                    {"name": "user_email", "searchable": true, "orderable": true, "targets": 3},
                    {"name": "user_active", "searchable": true, "orderable": true, "targets": 4},
                    {"name": "menu", "searchable": false, "orderable": false, "targets": 5}

                ],
                "columns": [
                    {"data": "checkbox"},
                    {"data": "user_id"},
                    {"data": "user_name"},
                    {"data": "user_email"},
                    {"data": "user_active"},
                    {"data": "menu"}
                ],
                "lengthMenu": [
                    [10, 20, 50, 100, 150],
                    [10, 20, 50, 100, 150] // change per page values here 
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "admin/site-users/ajax_get_site_users", // ajax source
                },
                "order": [
                    [1, "asc"]
                ] // set first column as a default sort by asc
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Válasszon csoportműveletet!',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Nem jelölt ki semmit!',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }



    var deleteOneUserConfirm = function () {

        $("#users").on('click', '[id*=delete_user]', function (e) {


            e.preventDefault();



            var deleteLink = $(this).attr('href');
            var userName = $(this).closest("tr").find('td:nth-child(4)').text();

            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja " + userName + " felhasználót?", function (result) {
                if (result) {
                    window.location.href = deleteLink;
                }
            });
        });

    }



    var hideAlert = function () {
        $('div.alert').delay(2500).slideUp(750);
    }


    var makeActiveConfirm = function () {
        $("#users").on('click', '[id*=make_active], [id*=make_inactive]', function (e) {


            e.preventDefault();

            var action = $(this).attr('data-action');
            var userId = $(this).attr('rel');
            var url = $(this).attr('href');
            var elem = this;
            var userName = $(this).closest("tr").find('td:nth-child(4)').text();

            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan módosítani akarja " + userName + " státuszát?", function (result) {
                if (result) {
                    makeActive(userId, action, url, elem);
                }
            });
        });
    }

    var makeActive = function (userId, action, url, elem) {
        App.blockUI({
            message: 'Feldolgozás...',
            boxed: true
        });
        $.ajax({
            type: "POST",
            data: {id: userId,
                action: action
            },
            datatype: 'json',
            url: url,
            complete: function () {
                $('#loadingDiv').hide();
            },
            success: function (response) {

                App.unblockUI();
                var json = $.parseJSON(response);

                console.log(json.status);
                $('#message').show();

                if (json.status === 'make_inactive_success') {
                    $(elem).html('<i class="fa fa-check"></i> Aktivál');
                    $(elem).attr('data-action', 'make_active');
                    $(elem).attr('href', 'admin/site-users/make_active');
                    $(elem).closest('td').prev().html('<span class="label label-sm label-danger">Inaktív</span>');

                    $('#message').html(json.message).delay(2000).fadeOut();

                } else if (json.status === 'make_active_success') {
                    $(elem).html('<i class="fa fa-ban"></i> Blokkol');
                    $(elem).attr('data-action', 'make_inactive');
                    $(elem).attr('href', 'admin/site-users/make_inactive');
                    $(elem).closest('td').prev().html('<span class="label label-sm label-success">Aktív</span>');

                    $('#message').html(json.message).delay(2000).fadeOut();
                } else if (json.status === 'error') {

                    $('#message').html(json.message).delay(2000).fadeOut();
                }

            },
            error: function (result, status, e) {
                alert(e);
            }
        });

    }


    /*	
     var printTable = function () {
     $('#print_users').on('click', function (e) {
     e.preventDefault();
     var divToPrint = document.getElementById("users");
     console.log(divToPrint);
     //		divToPrint = $('#users tr').find('th:last, td:last').remove();
     newWin = window.open("");
     newWin.document.write(divToPrint.outerHTML);
     newWin.print();
     newWin.close();
     })
     
     }
     
     */

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            usersTable();
            deleteOneUserConfirm();
            hideAlert();
            makeActiveConfirm();
        }

    };

}();

$(document).ready(function () {
    Users.init(); // init users page
});