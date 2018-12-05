var Newsletter = function () {

    /**
     * Táblázat beállítások
     */
    var newsletterTable = function () {

        var table = $('#newsletter_table');

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

            //           "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columns": [{
                    "orderable": false
                }, {
                    "orderable": true
                }, {
                    "orderable": true
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
                [10, 50, 100, -1],
                [10, 50, 100, "Összes"] // change per page values here
            ],
            // set the initial value
            "pageLength": 50,
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
                }],
            "order": [
                [4, "desc"]
            ] // set column as a default sort by asc


        });

        var tableWrapper = jQuery('#newsletter_table_wrapper');

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

    /**
     * Egy elem törlése kérdés
     */
    var deleteOneNewsletterConfirm = function () {
        $('[id*=delete_newsletter]').on('click', function (e) {
            e.preventDefault();
            //var deleteLink = $(this).attr('href');
            var newsletterName = $(this).closest("tr").find('td:nth-child(2)').text();

            // az <a> html elemet hozzárendeljük a link nevű változóhoz
            var link = $(this);

            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja a <strong>" + newsletterName + "</strong> hírlevelet?", function (result) {
                if (result) {
                    //window.location.href = deleteLink;

                    // paraméter az <a> elem amire klikkeltünk
                    delete_newsletter_AJAX(link);
                }
            });
        });

    }

    /**
     * Csoportos törlés kérdés
     */
    var deleteNewsletterTableConfirm = function () {
        $('#del_newsletter_form').submit(function (e) {
            e.preventDefault();
            currentForm = this;
            bootbox.setDefaults({
                locale: "hu",
            });
            bootbox.confirm("Biztosan törölni akarja a kijelölt hírleveleket?", function (result) {
                if (result) {
                    // a submit() nem küldi el a gomb name értékét, ezért be kell rakni egy hidden elemet
                    $('#del_newsletter_form').append($("<input>").attr("type", "hidden").attr("name", "delete_newsletter").val("submit_delete_newsletter"));
                    currentForm.submit();
                }
            });
        });
    }


    /**
     * Hírlevél küldés kérdés
     */
    var submitNewsletterConfirm = function () {
        $('[id*=submit_newsletter]').on('click', function (e) {
            e.preventDefault();

            var newsletterName = $(this).closest("tr").find('td:nth-child(2)').text();

            // az <a> html elemet hozzárendeljük a link nevű változóhoz
            var link = $(this);
            var newsletter_id = link.attr('rel');

            bootbox.setDefaults({locale: "hu"});
            bootbox.confirm("Biztosan el akarja küldeni a <strong>" + newsletterName + "</strong> hírlevelet?", function (result) {
                if (result) {
                    // Küldés időlimittel
                    submit_newsletter_AJAX(newsletter_id);						

                    // hírlevél küldés folyamat modal megjelenítése
                    //$('#newsletter_box').modal('show');
                    //startTask(newsletter_id);
                }
            });
        });
    }
    
    /**
     * DatetimePicker beállítása
     */
    var handleDatetimePicker = function () {

        if (!jQuery().datetimepicker) {
            return;
        }

        $(".form_datetime").datetimepicker({
            autoclose: true,
            todayBtn: true,
            todayHighlight: true,
            language: "hu",
            startDate: new Date(),
            isRTL: App.isRTL(),
            format: "yyyy-mm-dd hh:ii",
            pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
        });

        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }
    

    /**
     * Hírlevél küldés modal - naptárral
     */
    var submitNewsletterConfirmModal = function () {

        var newsletter_id;
        var statid;

        // Ha ráklikkel a hírlevél küldése gombra a megjelenő menüben
        $('[id*=submit_newsletter]').on('click', function (e) {
            e.preventDefault();

            //var newsletterName = $(this).closest("tr").find('td:nth-child(2)').text();
            // az <a> html elemet hozzárendeljük a link nevű változóhoz
            var link = $(this);

            // Ha a link már disabled
            if(link.hasClass('disabled-link')) {
                return false;
            }

            newsletter_id = link.attr('rel');
            statid = link.attr('data-statid');

            // Modal megjelenítése
            $('#datepicker_modal').modal('show');

        });

        // Idő adat elküldése és modal bezárása
        $('#datetime_send_button').on('click', function (e) {

            var date = $('#datetime_data').val()

            // Ha nem üres az input mező
            if (date != "") {

                // Adatok beírása az adatbázisba
                $.ajax({
                    url: 'admin/newsletter/sendNewletterRegister',
                    type: 'POST',
                    dataType: 'json',
                    //contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    data: {
                        newsletter_id: newsletter_id,
                        statid: statid,                                
                        date: date
                    },
                
                    beforeSend: function() {
                        // Küldő gomb disabled
                        $('#datetime_send_button').attr('disabled', true);
                        App.blockUI({
                            boxed: true,
                            message: 'Feldolgozás...'
                        });
                    },
                    complete: function(){
                        App.unblockUI();
                    },
                    // itt kapjuk meg (és dolgozzuk fel) a feldolgozó php által visszadott adatot 
                    success: function(result){
                        
                        if(result.status == 'success'){

                            // A link osztályát disabled-re állítjuk
                            $('#submit_newsletter_' + newsletter_id).addClass('disabled-link');
                            
                            // Modal bezárása
                            $('#datepicker_modal').modal('hide');

                            // Amikor teljesen bezáródik a modal
                            $('#datepicker_modal').on('hidden.bs.modal', function (e) {
                                // Küldő gomb enabled
                                //$('#datetime_send_button').attr('disabled', false);
                                
                                // Frissítjük az oldalt egy redirect-el
                                window.location.href = "admin/newsletter";
                            });


                        }

                        if(result.status == 'error'){
                    
                        }
                    },
                    error: function(result, status, e){
                        console.log(e);
                    } 
                });

            } else {
                console.log('ures');
            }

        });

    }

    /**
     * Hírlevél nézet modal
     */
    var showNewsletterBodyModal = function () {
        $('#newsletter_table').on('click', '.show_preview_modal', function (e) {
            e.preventDefault();
                       
            var preview_wrapper = $('#newsletter_preview'); 
            // a preview_wrapper "kiürítése, ha vaolt már betöltött sablon
            //preview_wrapper.empty();
            
            //var deleteLink = $(this).attr('href');
            var link = $(this);
            var newsletter_id = link.attr('data-id');
           
            //végrehajtjuk az AJAX hívást
            $.ajax({
                type: "POST",
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                data: {
                    newsletter_id: newsletter_id
                },
                // a feldolgozó url-je
                url: "admin/newsletter/preview",
                // kész a hívás... utána ez történjen
                beforeSend: function() {
                    App.blockUI({
                        boxed: true,
                        message: 'Feldolgozás...'
                    });
                },
                complete: function () {
                    App.unblockUI();
                },
                // itt kapjuk meg (és dolgozzuk fel) a feldolgozó php által visszadott adatot 
                success: function (result) {

                        $('#preview_modal').modal('show');
                        //preview_wrapper.append(result);
                        preview_wrapper.prop('srcdoc', result);
                },
                error: function (result, status, e) {
                    console.log(e);
                }
            });          
        });
    }


    /**
     * Gomb enable disable
     */
    var enableDisableButtons = function () {

        var deleteUserSubmit = $('button[name="del_newsletter_submit"]');
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
        $('#print_newsletter').on('click', function (e) {
            e.preventDefault();
            var divToPrint = document.getElementById("newsletter_table");
            console.log(divToPrint);
//		divToPrint = $('#newsletter_table tr').find('th:last, td:last').remove();
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        })
    }


    /**
     *	Hírlevél törlése
     *
     */
    var delete_newsletter_AJAX = function (link) {
        //$('a[id*=delete_newsletter]').click(function(event){
        //event.preventDefault();    


        //a link rel attribútumának értékét változóhoz rendeljük (ez tartalmazza az id-t)
        var newsletter_id = link.attr('rel');

        // a del_tr változóhoz rendeljük a html táblázat törlendő sorát
        var del_tr = link.closest("tr");

        //üzenet elem
        var message = $('#message-box');

        App.blockUI({
            boxed: true,
            message: 'Feldolgozás...'
        });
        //végrehajtjuk az AJAX hívást
        $.ajax({
            type: "POST",
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: {
                newsletter_id: newsletter_id
            },
            // a feldolgozó url-je
            url: "admin/newsletter/delete_newsletter",
            // kész a hívás... utána ez történjen
            complete: function () {
                App.unblockUI();
            },
            // itt kapjuk meg (és dolgozzuk fel) a feldolgozó php által visszadott adatot 
            success: function (response) {
                //JSON string elemeinek elhelyezése egy objektumba
                var response = $.parseJSON(response);
 

                if (response.status == 'success') {
                    App.alert({
                        type: 'success',
                        //icon: 'warning',
                        message: response.message,
                        container: $('#ajax_message'),
                        closeInSeconds: 3,
                        place: 'prepend'
                    });
                    console.log(del_tr);
                    del_tr.remove();
                }

                if (response.status == 'error') {
                    App.alert({
                        type: 'danger',
                        //icon: 'warning',
                        message: response.message,
                        container: $('#ajax_message'),
                        closeInSeconds: 3,
                        place: 'prepend'
                    });
                }

            },
            error: function (response, status, e) {
                alert(e);
            }
        });
    }

    /*--------------------------------------------------*/

    /**
     *	Hírlevél küldés AJAX - IDŐLIMITES KÜLDÉS!
     *
     */
    var submit_newsletter_AJAX = function (newsletter_id) {

        //var lastsent = $(this).closest("tr").find('td:nth-child(5)').text();
        //var lastsent = link.closest("tr").find('td:nth-child(5)');
        //var data = "newsletter_id="+newsletter_id;

        //végrehajtjuk az AJAX hívást
        $.ajax({
            type: "POST",
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: {
                newsletter_id: newsletter_id
            },
            // a feldolgozó url-je
            url: "admin/newsletter/send_newsletter_timelimit",
            dataType: "json",
            beforeSend: function () {
                App.blockUI({
                    boxed: true,
                    message: 'Email küldés folyamatban...',
                    overlayColor: '#000000'
                });
            },
            // kész a hívás... utána ez történjen
            complete: function () {
                App.unblockUI();
            },
            // itt kapjuk meg (és dolgozzuk fel) a feldolgozó php által visszadott adatot 
            success: function (result) {
                console.log(result.status);

            },
            error: function (result, status, e) {
                console.log(e);
            }
        });

    }



    /*---------------EVENTSOURCE-----------------*/

    var es;

    var startTask = function (newsletter_id) {


        var progress_bar = document.getElementById('progress_bar');
        var progress_pc = document.getElementById('progress_pc');
        var message_done = document.getElementById('message_done');
        var message_box = document.getElementById('message');
        // bootstrap modal
        var bootstrap_progress_bar = $("#bootstrap_progress_bar");
        var bootstrap_progress_bar_value = $("#bootstrap_progress_bar").attr("aria-valuenow");
        var bootstrap_progress_bar_max = $("#bootstrap_progress_bar").attr("aria-valuemax");

        // progress bar, progress pc és message elemek nullázása
        bootstrap_progress_bar.attr("aria-valuenow", '0');
        bootstrap_progress_bar.width('0%');
        progress_pc.innerHTML = "0%";
        message_box.innerHTML = 'E-mail küldés folyamatban...<br>';

        message_box.style.display = 'block';
        // progress_bar.style.display = 'block';

        // EventSource objektum létrehozása
        es = new EventSource('admin/newsletter/send_newsletter?newsletter_id=' + newsletter_id);

        // Ha egy üzenet érkezik
        es.addEventListener('message', function (e) {

            var result = JSON.parse(e.data);
            addLog(result.message);

            if (e.lastEventId == 'CLOSE') {
                addLog('<p><strong>Hírlevelek küldése kész</strong></p>');
                es.close();
                // progress_bar.value = progress_bar.max; //max out the progress bar
                
                // bootstrap modal verzió
                bootstrap_progress_bar.attr("aria-valuenow", bootstrap_progress_bar_max); //max out the progress bar

            } else {
                // progress_bar.value = result.progress;
                bootstrap_progress_bar.attr("aria-valuenow", result.progress);
                bootstrap_progress_bar.width(result.progress + '%');
                progress_pc.innerHTML = result.progress + "%";
                // progress_pc.style.width = (Math.floor(progress_bar.clientWidth * (result.progress / 100)) + 15) + 'px';
            }
        });

        es.addEventListener('error', function (e) {
            addLog('Hiba történt' + e);
            console.log(e);
            es.close();
        });
    }

    var stopTask = function () {
        es.close();
        addLog('Folyamat megszakítva!');
    }

    var addLog = function (message) {
        var message_box = document.getElementById('message');
        message_box.innerHTML += message + '<br>';
        message_box.scrollTop = message_box.scrollHeight;
    }


    /*-----------------END EVENTSOURCE-----------------*/


    var sendTestEmail = function () {
        $('[id*=send_test_email]').on('click', function (e) {
            e.preventDefault();

            $('#test-email').modal('show');
            $('#test_email_message').empty();
            //var deleteLink = $(this).attr('href');
            var newsletterName = $(this).closest("tr").find('td:nth-child(2)').text();

            // az <a> html elemet hozzárendeljük a link nevű változóhoz
            var link = $(this);
            var newsletter_id = link.attr('data-id');
            $('#test-email').find('#newsletter_id').val(newsletter_id);
            //megjelenítjük a loading animációt


            $('#test_email').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    data: $('#test_email').serialize(),
                    // a feldolgozó url-je
                    url: "admin/newsletter/send_test_newsletter_AJAX",
                    // kész a hívás... utána ez történjen
                    complete: function () {

                    },
                    // itt kapjuk meg (és dolgozzuk fel) a feldolgozó php által visszadott adatot 
                    success: function (result) {
                        $('#test_email_message').hide().html(result).slideDown('slow');

                    },
                    error: function (result, status, e) {
                        console.log(e);
                    }
                });

            });


        });

    }





    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            newsletterTable();
            deleteOneNewsletterConfirm();
            deleteNewsletterTableConfirm();
            
            // submitNewsletterConfirm();
            submitNewsletterConfirmModal();
            showNewsletterBodyModal();

            enableDisableButtons();
            hideAlert();
            printTable();
            sendTestEmail();

            handleDatetimePicker();
        }

    };

}();

$(document).ready(function () {
    Newsletter.init(); // init Newsletter page

});