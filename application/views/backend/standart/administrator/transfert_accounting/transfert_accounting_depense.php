<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<!-- Content Header (Page header) -->
<!-- <section class="content-header">
    <h1>
        Transfert produits
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Transfert produits</li>
    </ol>
</section> -->

<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">

                    <form name="form_transfert_accounting" id="form_transfert_accounting" method="POST"
                        action="<?= base_url('administrator/transfert_accounting/insert_depense'); ?>">


                        <div class="row pull-center">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <h3>Dépense en attente de transfert</h3>
                            </div>


                            <button type="submit" class="btn btn-flat" name="name" id="name" value="Transférer"
                                title="<?= cclang('Transférer'); ?>">
                                Transférer
                            </button>
                        </div>


                    </form>
                    <?php


        // SHOW ERRORS
         error_reporting(E_ALL);
        ini_set('display_errors', 'On');



        $i = 0; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped table-condensed" width="80%">
                            <th>JOURNAL DATE</th>
                            <th>LIBELLE</th>
                            <th>RECU</th>
                            <th>MONTANT</th>

                            <?php
        $piece_no = 0;

        foreach ($depenses as $row):
            
?>

                            <tr>
                                <td><?php echo date("Y-m-d", strtotime($row->DATE_CREATION_DEPENSE)); ?>
                                </td>
                                <td><?php echo $row->DESCRIPTION_DEPENSE; ?>
                                </td>
                                <td><?php echo $row->NUMERO_DEPENSE; ?>
                                </td>
                                <td><?php echo $row->MONTANT_DEPENSE; ?>
                                </td>
                            </tr>


                            <?php  endforeach;
     ?>
                        </table>
                    </div>
                </div>
                <!--/box -->
            </div>
        </div>

    </div>
</section>

</body>

</html>
