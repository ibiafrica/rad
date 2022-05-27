<!-- Content Header (Page header) -->
<style>
    @media print {
        table {
            padding: 0;
            font-size: 12px;
        }
    }
</style>
<section class="content-header">
    <h1>
        Impression<i class="fa fa-chevron-right "></i>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2 hidden-print">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header ">


                        </div>
                    </div>


                    <form style="padding:1rem 2rem;" name="form_patients" id="form_patients" action="<?= base_url('administrator/patients/index'); ?>">
                        <div class="table-responsive row">


                            <div class="" style="background-color: #eee;">
                                <h4 class="modal-title" id="exampleModalLabel">Detail de la commande <?= _ent($commande_code); ?></h4>
                            </div>
                            <div class="">
                                <table class="table table-bordered table-condensed">

                                    <thead>
                                        <th>Article</th>
                                        <th>Quantité</th>
                                        <th>Prix Unitaire</th>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $total = 0;
                                        foreach ($patients as $details) : ?>
                                            <tr>
                                                <td><?= $details->NAME; ?></td>
                                                <td style="text-align: right"><?= $details->QUANTITE; ?></td>
                                                <td style="text-align: right"><?= $details->PRIX;
                                                                                $total = ($total + $details->PRIX * $details->QUANTITE) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <br />
                                    <tfoot>
                                        <tr>
                                            <th scope="row" colspan="2">TOTAL</th>

                                            <td style="background-color: #ccc; color:#000; text-align: right">
                                                <strong><?= _ent($total); ?> <small> Fbu</small></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="2">DESCRIPTION</th>

                                            <td><?= ($DESCRIPTION); ?></td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>


                        </div>
                        <hr>

                    </form>

                    <div class="row hidden-print">
                        <div class="col-md-4" style="float:right">
                            <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
                                <button type="button" class="btn btn-success" onclick="window.print()" data-dismiss="modal">imprimer</button>
                            </div>
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
    $('open-opendetails').on('click', function(e) {
        e.stopPropagation();
        console.log("hey")
    });
</script>
<!-- Page script -->
<script>
    $(document).ready(function() {

        $('.remove-data').click(function() {

            var url = $(this).attr('data-href');

            swal({
                    title: "<?= cclang('are_you_sure'); ?>",
                    text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
                    type: "input",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
                    cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    animation: "slide-from-top",
                    inputPlaceholder: "Donnez un commentaire S.V.P."
                },
                function(inputValue) {
                    if (inputValue === false) {
                        return false;
                    }
                    if (inputValue === "") {
                        swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
                        return false;
                    }
                    // document.location.href = url +'?inputValue=' +inputValue;
                    $.ajax({

                        url: url,

                        type: 'POST',
                        data: {
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                            inputValue: inputValue
                        },

                        success: function(data) {
                            document.location.href = url;
                            console.log("success", data);
                        },

                        error: function(error) {
                            console.log('erreur', error.responseText);
                        }


                    })
                    // },
                    // function(isConfirm){
                    //   // if (isConfirm) {
                    //   //    document.location.href = BASE_URL + '/administrator/patients/delete?' + serialize_bulk;      
                    //   // }
                });

            // return false;
        });


        $('#apply').click(function() {

            var bulk = $('#bulk');
            var serialize_bulk = $('#form_patients').serialize();

            if (bulk.val() == 'delete') {
                swal({
                        title: "<?= cclang('are_you_sure'); ?>",
                        text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
                        type: "input",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
                        cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
                        closeOnConfirm: true,
                        closeOnCancel: true,
                        animation: "slide-from-top",
                        inputPlaceholder: "Donnez un commentaire S.V.P."
                    },
                    function(inputValue) {
                        if (inputValue === false) {
                            return false;
                        }
                        if (inputValue === "") {
                            swal.showInputError("Vous devriez ecrire un commentaire SVP.!!!");
                            return false;
                        }
                        document.location.href = url + '?inputValue=' + inputValue;
                    },
                    function(isConfirm) {
                        // if (isConfirm) {
                        //    document.location.href = BASE_URL + '/administrator/patients/delete?' + serialize_bulk;      
                        // }
                    });

                return false;

            } else if (bulk.val() == '') {
                swal({
                    title: "Upss",
                    text: "<?= cclang('please_choose_bulk_action_first'); ?>",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Okay!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                });

                return false;
            }

            return false;

        }); /*end appliy click*/


        //check all
        var checkAll = $('#check_all');
        var checkboxes = $('input.check');

        checkAll.on('ifChecked ifUnchecked', function(event) {
            if (event.type == 'ifChecked') {
                checkboxes.iCheck('check');
            } else {
                checkboxes.iCheck('uncheck');
            }
        });

        checkboxes.on('ifChanged', function(event) {
            if (checkboxes.filter(':checked').length == checkboxes.length) {
                checkAll.prop('checked', 'checked');
            } else {
                checkAll.removeProp('checked');
            }
            checkAll.iCheck('update');
        });

    }); /*end doc ready*/
</script>