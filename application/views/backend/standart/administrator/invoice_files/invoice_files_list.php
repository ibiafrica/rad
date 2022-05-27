<!-- MODAL -->
<!--MOdal for data importation -->
<div class="modal fade" id="modal_importation" tabindex="-1" role="dialog" aria-labelledby="modal_filter" data-backdrop="true" data-keyboard="true">
   <div class="modal-dialog modal-md" role="document" id="modal_dialog_for_importation">
      <div class="modal-content">
         <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            <h4><i class="fa fa-file-excel-o"></i>
               Data Importation</h4>


            <div class="col-md-12" style="width: 100%;">

               <div class="col-md-4">
                  <!-- <span class="glyphicon glyphicon-import"></span>  -->
                  <a class="btn btn-info btn-md" id="click" style="text-align: left;width: 100%"><span class="glyphicon glyphicon-plus-sign"></span>
                     Choose File
                  </a>
                  <input type="file" class="" id="excelfile" style="display: none;">
                  <!-- <input type="button" id="viewfile" value="Export To Table" onclick="ExportToTable()" /> -->
               </div>

               <div class="col-md-6">

                  <a download="invoicess.csv" href="<?php echo BASE_ASSET . 'import_file_example/invoicess.csv' ?>" class="btn btn-success btn-md" id="btn_download_employee_file"><span class="glyphicon glyphicon-download-alt"></span> Example File</a>

               </div>

            </div>
         </div>

         <div class="modal-body" style="height:100%;overflow-y: auto;">


            <div class="table-responsive">
               <table class="table table-bordered table-striped dataTable" id="exceltable">
                  <thead>
                     <th>Numero de Facture</th>
                     <th>Date de Facture</th>
                     <th>Type de Facture</th>
                     <th>Type de Paiment</th>
                     <th>Nom du Client</th>
                     <th>NIF du Client</th>
                     <th>Adresse du Client</th>
                     <th>TVA</th>
                     <th>Facture Annule</th>
                     <th>Nom de l'article</th>
                     <th>Quantite</th>
                     <th>Prix Unitaire </th>
                     <th>Item CT</th>
                     <th>Item TL</th>
                     <th>Prix HTVA </th>
                     <th>TVA </th>
                     <th>Prix avec TVA</th>
                     <th>Total</th>
                  </thead>

                  <tbody></tbody>

               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary" id="bt_apply_import" style="background-color: #00c0ef;"><span class="glyphicon glyphicon-import"></span> Import</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modal_display" tabindex="-1" role="dialog" aria-labelledby="modal_filter" data-backdrop="true" data-keyboard="true">
   <div class="modal-dialog modal-md" role="document" id="modal_for_display">
      <div class="modal-content">
         <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            <h4><i class="fa fa-file-excel-o"></i>
               </h4>


            <div class="col-md-12" style="width: 100%;">

               <div class="col-md-4">
               </div>


            </div>
         </div>

         <div class="modal-body" id = "modal_body_display" style="height:100%;overflow-y: auto;">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12" id="firstDisplay">
                        
                    </div>
                    <div class="col-md-8 col-sm-12" id="secondDisplay">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable" id="excelSmallTable">
                            <thead>
                                <th>Nom de l'article</th>
                                <th>Quantite</th>
                                <th>P.U </th>
                                <th>Item CT</th>
                                <th>Item TL</th>
                                <th>Prix HTVA </th>
                                <th>TVA </th>
                                <th>Prix ATVA</th>
                            </thead>

                            <tbody></tbody>

                        </table>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" role="dialog" id="login_modal">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"></h4>
            </div>
            <div class="modal-body p-2" id="modal_body" style="min-height: 30vh;">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" required class="form-control" placeholder="Username">
                  <small class="usernameAlert alert alert-danger" hidden></small>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" required class="form-control" placeholder="Password">
                  <small class="passwordAlert alert alert-danger" hidden></small>
                </div>
            </div>
            <div class="alert alert-danger" id="alertMesssage" hidden></div>
            <div class="modal-footer">
                <a class="btn btn-primary" id="save_login">Enregistrer</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="simple_login">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"></h4>
            </div>
            <div class="modal-body p-2" id="modal_body" style="min-height: 30vh;">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username_simple" required class="form-control" placeholder="Username">
                  <small class="usernameAlert alert alert-danger" hidden></small>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password_simple" required class="form-control" placeholder="Password">
                  <small class="passwordAlert alert alert-danger" hidden></small>
                </div>
                <div class="form-group">
                  <label for="nif_simple">NIF</label>
                  <input type="text" name="nif_simple" id="nif_simple" required class="form-control" placeholder="NIF">
                  <small class="nifAlert alert alert-danger" hidden></small>
                </div>
            </div>
            <div class="alert alert-danger" id="alertMesssage_simplew" hidden></div>
            <div class="alert alert-success" id="alertMesssage_simples" hidden></div>
            <div class="modal-footer">
                <a class="btn btn-primary" id="save_login_simple">Enregistrer</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="verify_signature">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"></h4>
            </div>
            <div class="modal-body p-2" id="modal_body" style="min-height: 30vh;">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username_signature" required class="form-control" placeholder="Username">
                  <small class="usernameAlert alert alert-danger" hidden></small>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password_signature" required class="form-control" placeholder="Password">
                  <small class="passwordAlert alert alert-danger" hidden></small>
                </div>
                <div class="form-group">
                  <label for="nif_signature">NIF</label>
                  <input type="text" name="nif_signature" id="nif_signature" required class="form-control" placeholder="NIF">
                  <small class="nifAlert alert alert-danger" hidden></small>
                </div>
                <div class="form-group">
                  <label for="invoice_date">Date de Facture</label>
                  <input type="text" name="invoice_date" id="invoice_date" required class="form-control invoice_date">
                  <small class="invoiceSignature alert alert-danger" hidden></small>
                </div>
                <div class="form-group">
                  <label for="invoice_number">Numero de Facture</label>
                  <input type="text" name="invoice_number" id="invoice_number" required class="form-control" placeholder="Invoice Signature">
                  <small class="invoiceSignature alert alert-danger" hidden></small>
                </div>
            </div>
            <div class="alert alert-danger" id="alertMesssage_signaturew" hidden></div>
            <div class="alert alert-success" id="alertMesssage_signatures" hidden></div>
            <div class="modal-footer">
                <a class="btn btn-primary" id="save_login_signature">Enregistrer</a>
            </div>
        </div>
    </div>
</div>
<section class="content-header">

   <h1>

   Upload

   </h1>

   <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>

      <li class="active">Upload</li>

   </ol>

</section>

<div class="trdata"></div>
<div id="data_print"></div>

<!-- Main content -->

<section class="content">

    <div class="row">



        <div class="col-md-12">

                <div class="box box-warning">

                    <div class="box-body ">

                    <!-- Widget: user widget style 1 -->

                        <div class="box box-widget widget-user-2">

                                <!-- Add the bg color to the header using any of the bg-* classes -->

                                <div class="widget-user-header ">

                                    <div class="row pull-right">

                                        <a class="btn btn-flat btn-success" title="Check NIF" id="btn_check_tin"><i class="fa fa-check"></i> Check NIF</a>

                                        <a class="btn btn-flat btn-success" title="Voir la facture" id="btn_invoice_signature"><i class="fa fa-circle-check"></i> Voir la facture</a>

                                        <a class="btn btn-flat btn-success" title="Import" id="bt_display_import"><i class="fa fa-file-excel-o"></i> Importer</a>


                                    </div>
                                    <br>

                                    <!-- /.widget-user-image -->
                                </div>
                                <form action="<?= base_url('administrator/invoice_files/index') ?>">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">Date debut</span>
                                                <input type="date" class="form-control" name="date_debut" value="<?= isset($_GET['date_debut']) ? $_GET['date_debut'] : ''; ?>" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">Date fin</span>
                                                <input type="date" class="form-control" name="date_fin" value="<?= isset($_GET['date_fin']) ? $_GET['date_fin'] : '' ?>" />
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-default"><i class="fa fa-refresh"></i>Charger
                                        </button>
                                    </div>
                                </form>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped dataTable" id="invoiceSaved">
                                        <thead>
                                            <th>Numero de Facture</th>
                                            <th>Signature de la facture</th>
                                            <th>Date d'enregistrement</th>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach($invoices as $invoice) { ?>
                                                <tr>
                                                    <td><?= $invoice->invoice_number; ?></td>
                                                    <td><?= $invoice->invoice_signature; ?></td>
                                                    <td><?= $invoice->date_creation; ?></td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>

                                <div class="col-md-4">

                                </div>

                        </div>

                    </div>

                    <!--/box body -->

                </div>
            <!--/box -->
        </div>

    </div>

</section>

<!-- /.content -->

<script>
    var token = '';
    var rapportList = [];
    $(document).ready(function() {

        // $('#simple_login').modal('show')


        $(document).on("change", "#excelfile", function() {
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv)$/;
            // console.log($("#excelfile").val().toLowerCase())
            if (regex.test($("#excelfile").val().toLowerCase())) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var rows = e.target.result.split("\n");
                    var tableRow = "";
                    //let errors = 0;


                    for (i = 1; i < rows.length; i++) {

                        // console.log("uri indani bro");

                        if (rows[i] !== "") {
                            var uploadRow = rows[i].split(",");
                            var count = uploadRow.length;
                            if (count !== 8) {
                                //errors += 1;
                                tableRow += "<tr class='not'>";
                                for (j = 0; j < uploadRow.length; j++) {
                                    let display = uploadRow[j] == "" ? "" : uploadRow[j];
                                    tableRow += "<td class='tdfine'>" + display + "</td>";
                                }
                                tableRow += "</tr>";
                            }
                        }
                    }
                    $("#exceltable tbody").html(tableRow);

                }
                reader.readAsText($("#excelfile")[0].files[0]);
                
            } else {
                alert("Inserez un fichier csv valide");
            }
        });

        $(document).on('dblclick', '#modal_importation tbody tr td', function(e) {
            const tr = $(e.target).parent();
            // console.log(tr)
        });

        //capture the close event on the modal

        $("#modal_importation").on("hidden.bs.modal", function() {
            window.location.reload();
        });


        //click to browser for the file

        $(document).on('click', '#click', function() {


        $('#excelfile').click();

        });

        $(".invoice_date").datetimepicker({
            // maxDate: new Date(),
            // maxDateTime: new Date().getTime(),
            format: "Y-m-d H:i:s",
            autoclose: true,
            todayBtn: true,
            startDate: "Y-m-d H:i:s",
            step: 1
        });

        $(document).on('click', '#btn_check_tin', function() {
            local("simple");
            $('#simple_login').modal('show')
            $('#invoice_signature').val('');
            $('#nif_simple').parent().attr('hidden', false);
            $('#invoice_signature').parent().attr('hidden', true);
        })

        $(document).on('click', '#bt_apply_import', function() {

            local();
            $('#login_modal').modal('show');

        }); //('click', '#bt_apply_import', function()

        $(document).on('click', '#btn_invoice_signature', function() {
            local("simple");
            $('#verify_signature').modal('show');
        })
        

        $(document).on('click', '#save_login', function() {
            let username = $('#username').val();
            let password = $('#password').val();
            if(username.length == 0 || password.length == 0) {
                $('#alertMesssage').html('Veuillez completer tous les champs');
                $('#alertMesssage').removeAttr('hidden');
                return;
            }
            $('#save_login').attr('disabled', true);
            $.ajax({
                url: BASE_URL + '/administrator/invoice_files/login_request',
                type: "POST",
                data: {username: username, password: password},
                dataType: 'json',
                success: function(res) {
                    if(res.success == true) {
                        if(res.contribuable == null) {
                            $('#alertMesssage').html('Enregistrez d\'abord vos donnees en tant que vendeur');
                            $('#alertMesssage').attr('hidden', false);
                            $('#save_login').attr('disabled', false);
                            return;
                        }
                        window.localStorage.setItem('loginData', JSON.stringify({username: username, password: password}))
                        btn_import(res.contribuable, res.username);
                    } else {
                        $('#alertMesssage').html('Reessayez plus tard ou verifiez si vous avez fait entrer les donnees en tant que vendeur en cliquant sur l\'onglet Contribuable');
                        $('#alertMesssage').attr('hidden', false);
                        $('#save_login').attr('disabled', false);
                    }
                }

            }); //end of ajax
            
            // btn_import();
        })


        //display popup for data importation
        $(document).on('click', '#bt_display_import', function() {

            var modal_importation = document.getElementById('modal_dialog_for_importation');

            modal_importation.style.width = '90%';

            $('#modal_importation').modal('show');

            $('#excelfile').val('');

        });
            $('#modal_importation').on('hidden.bs.modal', function(e) {
            $('#modal_importation .modal-body #exceltable tbody').html('');
        })

        $(document).on('click', '#save_login_simple', function() {
            let username = $('#username_simple').val();
            let password = $('#password_simple').val();
            let nif = $('#nif_simple').val();
            let loginData = {"username": username, "password": password};
            if(nif != '') {
                checkNIF(loginData, nif)
            } else {
                $('#alertMesssage_simplew').html('Remplissez tous les champs');
                $('#alertMesssage_simplew').attr('hidden', false);
                $('#save_login_simple').attr('disabled', false);
            }            

        })
        $(document).on('click', '#save_login_signature', function() {
            let username = $('#username_signature').val();
            let password = $('#password_signature').val();
            let invoice_number = $('#invoice_number').val();
            let nif = $('#nif_signature').val();
            let invoice_date = $('#invoice_date').val();
            let loginData = {"username": username, "password": password};
            let signature = nif +'/' + username +'/'+ rangeDate(invoice_date) + '/'+invoice_number;
            if(nif != '' && invoice_date != '' && invoice_number != '' && username != '' && password != '') {
                getInvoice(loginData, signature);
            } else {
                $('#alertMesssage_signaturew').html('Remplissez tous les champs');
                $('#alertMesssage_signaturew').attr('hidden', false);
                $('#save_login_signature').attr('disabled', false);
            }            

        })

    }); /*end doc ready*/
    function local(simple = null) {
        let login = JSON.parse(localStorage.getItem('loginData'));
        if(simple) {
            if(login) {
                $('#username_simple').val(login.username);
                $('#password_simple').val(login.password);
            }
        } else {
            if(login) {
                $('#username_simple').val(login.username);
                $('#password_simple').val(login.password);
            }
        }
    }
    function verifyLocal(username, password) {
        let login = JSON.parse(localStorage.getItem('loginData'));
        if(login) {
            if(username != local.username || password != local.password) {
                localStorage.removeItem('loginData');
                localStorage.setItem('loginData', JSON.stringify({username: username, password: password}))
            }else {
                return;
            }
        }
    }
    function connectToApi(username, password, contribuable) {
        let tokeen = ''
        // console.log('username: ', username, 'password: ', password)
        $.ajax({
            url: 'http://41.79.226.28:8345/ebms_api/login',
            type: "POST",
            data: JSON.stringify({"username": username, "password": password}),
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded',
            // method: 'POST',
            success: function(res) {
                token = res.result.token;
                getInvoice(token)
                console.log(token)
                $('#save_login').attr('disabled', false);
            },
            error: function(res) {
                console.log(res)
                $('#alertMesssage').html(res.responseJSON.msg);
                $('#alertMesssage').attr('hidden', false);
                $('#save_login').attr('disabled', false);
            }
        })
    }
    function checkNIF(login, nif) {
        $.ajax({
            url: 'https://smallapi-2022.herokuapp.com/check',
            type: "POST",
            data: {
                loginData: JSON.stringify(login), 
                nif: nif
            },
            dataType: 'json',
            success: function(ress) {
                verifyLocal(login.username, login.password);
                let reponse = '';
                for(let name of ress.taxpayer) {
                    reponse += `<p>${name.tp_name}</p>`
                }
                $('#alertMesssage_simples').html(reponse);
                $('#alertMesssage_simples').attr('hidden', false);
                $('#save_login_simple').attr('disabled', false);
            },
            error: function(err) {
                // console.log()
                $('#alertMesssage_simple').html(err.responseText);
                $('#alertMesssage_simple').attr('hidden', false);
                $('#save_login_simple').attr('disabled', false);
            }

        }); //end of ajax
    }
    function getInvoice(login, signature) {
        $.ajax({
            url: 'https://smallapi-2022.herokuapp.com/getInvoice',
            type: "POST",
            data: {loginData: JSON.stringify(login), signature: signature},
            dataType: 'json',
            success: function(ress) {
                // console.log(ress)
                verifyLocal(login.username, login.password);
                if(ress.length > 0) {
                    let display = '';
                    let tr = '';
                    var modal_importation = document.getElementById('modal_for_display');
                    modal_importation.style.width = '70%';
                    $('#modal_display').modal('show');
                    for(let i = 0; i < ress.length; i++) {
                        let element = ress[i];
                        display += `<div class="row">
                            <div class="col-md-6"><strong>Nom du client: </strong></div>
                            <div class="col-md-6">${element.customer_name}</div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6"><strong>Numero NIF: </strong></div>
                            <div class="col-md-6">${element.customer_TIN}</div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6"><strong>Banque du client: </strong></div>
                            <div class="col-md-6">${element.customer_bank}</div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6"><strong>Assujeti au TVA: </strong></div>
                            <div class="col-md-6">${element.vat_customer_payer == "1" ? "Oui" : "non"}</div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6"><strong>Numero de la facture:</strong> </div>
                            <div class="col-md-6">${element.invoice_number}</div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6"><strong>Date de la facture: </strong></div>
                            <div class="col-md-6">${element.invoice_date}</div>
                        </div><br>`;
                        for(let t = 0; t < element.invoice_items.length; t++) {
                            let el = element.invoice_items[t];
                            tr += `<tr>
                                <td>${el.item_designation}</td><td>${el.item_quantity}</td><td>${el.item_price}</td>
                                <td>${el.item_ct}</td><td>${el.item_tl}</td><td>${el.item_price_nvat}</td><td>${el.vat}</td>
                                <td>${el.item_price_wvat}</td>
                            </tr>`
                        }
                    }
                    $('#modal_display #modal_body_display #firstDisplay').html(display);
                    $('#modal_display #modal_body_display #secondDisplay tbody').html(tr);
                    $('#simple_login').modal('hide');
                }
            },
            error: function(err) {
                $('#alertMesssage').html(err.responseText);
                $('#alertMesssage').attr('hidden', false);
                $('#save_login').attr('disabled', false);
            }

        }); //end of ajax
    }
    function btn_import(contribuableData, numberSerie) {

        var paymentType = [];
        var invoice_number = [];
        var invoice_type = [];
        var invoice_date = [];
        var customerName = [];
        var customerTIN = [];
        var customerAddress = [];
        var tvaCheck = []; 
        var cancelledInvoice = [];
        var invoiceSignatureDate = [];
        var itemDesignation = [];
        var itemQuantity = [];
        var itemPrice = [];
        var itemCT = [];
        var itemTL = [];
        var itemPriceNvat = [];
        var vat = [];
        var itemPriceWVAT = [];
        var itemTotalAmount = [];

        var table = [
            [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], []
        ];

        $('#exceltable tbody').find('tr').each(function(rowIndex, r) {


            var i = 0;
            $(this).find('td').each(function(colIndex, c) {

                table[i].push(c.textContent);

                i++;

            }); //end find('td')


        }); //end each tr

            invoice_number = table[0];
            invoice_date = table[1];
            invoice_type = table[2];
            paymentType = table[3];
            customerName = table[4];
            customerTIN = table[5];
            customerAddress = table[6];
            tvaCheck = table[7];
            cancelledInvoice = table[8];
            // invoiceSignatureDate = table[9];
            itemDesignation = table[9];
            itemQuantity = table[10];
            itemPrice = table[11];
            itemCT = table[12];
            itemTL = table[13];
            itemPriceNvat = table[14];
            vat = table[15];
            itemPriceWVAT = table[16];
            itemTotalAmount = table[17];

        let dataaa = {};
        let invoices_item = {};
        let nif_vendeur = contribuableData["tp_TIN"]
        for(let t = 0; t < invoice_number.length; t++) {
            // console.log(itemDesignation[t])
            if(invoices_item[invoice_number[t]] == null) {
                invoices_item[invoice_number[t]] = [];
            }
            (invoices_item[invoice_number[t]]).push({
                "item_designation": itemDesignation[t], 
                "item_quantity": itemQuantity[t], 
                "item_price": itemPrice[t], 
                "item_ct": itemCT[t], 
                "item_tl": itemTL[t],
                "item_price_nvat": itemPriceNvat[t],
                "vat": vat[t],
                "item_price_wvat": itemPriceWVAT[t],
                "item_total_amount": `${parseInt(itemTotalAmount[t])}`
            });
            let facture = invoice_number[t].substr(0, invoice_number[t].length - 5);
            let signature = nif_vendeur +'/' + numberSerie +'/'+ rangeDate(invoice_date[t]) + '/'+invoice_number[t]
            dataaa[invoice_number[t]] = {
                invoice_number: invoice_number[t],
                invoice_date: invoice_date[t],
                payment_type: paymentType[t].toUpperCase() == "BANQUE" ? "2" : "1",
                customer_name: customerName[t],
                customer_TIN: customerTIN[t],
                customer_address : customerAddress[t],
                vat_customer_payer: tvaCheck[t].toUpperCase() == 'OUI' ? "1" : "0",
                cancelled_invoice_ref: cancelledInvoice[t],
                invoice_signature_date: invoice_date[t],
                invoice_signature: signature,
                invoice_items: invoices_item[invoice_number[t]] == null ? null : Object.values(invoices_item[invoice_number[t]]), 
                ...contribuableData
            }
        }
        let data = Object.values(dataaa);
        addInvoice(data, )
    }
    function addZero(i) {
        if (i < 10) {i = "0" + i}
        return i;
    }
    function rangeDate(d) {
        var dateParse = new Date(d);
        var month = addZero(dateParse.getMonth() + 1);
        var day = addZero(dateParse.getDate());
        var hours = addZero(dateParse.getHours());
        var minutes = addZero(dateParse.getMinutes());
        var seconds = addZero(dateParse.getSeconds());
        
        var datee = dateParse.getFullYear()+''+ month +''+ day +''+ hours +''+ minutes +''+ seconds;
        // console.log(datee)
        return datee;
    }
    function addInvoice(data, t = 0) {
        console.log(data[t]);
        let loginData = window.localStorage.getItem('loginData');
        $.ajax({
            url: 'https://smallapi-2022.herokuapp.com/request',
            type: "POST",
            data: {data: JSON.stringify(data[t]), loginData: loginData},
            dataType: 'json',
            success: function(ress) {
                console.log(ress)
                addInvoiceInDb(data[t]);
                tt = t + 1;
                if(tt < data.length) {
                    addInvoice(data, tt);
                } else {
                    if(ress) {
                        $('#alertMesssage').append(`<p>L'envoi est termine</p><br>`);
                        $('#alertMesssage').attr('hidden', false);
                    }
                }
                $('#alertMesssage').append(`<p>${data[t].invoice_number} - ${ress.msg}</p><br>`);
                $('#alertMesssage').attr('hidden', false);
            },
            error: function(err) {
                tt = t + 1;
                // addInvoiceCancelledInDb(data[t]);
                if(tt < data.length) {
                    addInvoice(data, tt);
                } else {
                    $('#save_login').attr('disabled', false);
                }
                $('#alertMesssage').append(`<p>${err.responseText}</p><br>`);
                $('#alertMesssage').attr('hidden', false);
            }

        }); //end of ajax
    }
    function addInvoiceInDb(data) {
        $.ajax({
            url: BASE_URL + '/administrator/invoice_files/addInvoice',
            type: "POST",
            data: {data: data},
            dataType: 'json',
            success: function(ress) {
                console.log('ok');
            },
            error: function(err) {
            }

        }); //end of ajax
    }
    function addInvoiceCancelledInDb(data) {
        $.ajax({
            url: BASE_URL + '/administrator/invoice_files/addInvoiceCancelled',
            type: "POST",
            data: {data: data},
            dataType: 'json',
            success: function(ress) {
                console.log('ok');
            },
            error: function(err) {
            }

        }); //end of ajax
    }
    function rapportData(data, success) {
        data['success'] = success;
        rapportList.push(data);
    }
</script>