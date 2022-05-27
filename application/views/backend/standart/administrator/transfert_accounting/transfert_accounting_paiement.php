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
                        action="<?= base_url('administrator/transfert_accounting/insert_paiement'); ?>">


                        <div class="row pull-center">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <h3>Paiement en attente de transfert</h3>
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
                            <th>RECU</th>
                            <th>CODE</th>
                            <th>MONTANT</th>

                            <?php
        $piece_no = 0;

        foreach ($paiements as $row):
            
            $year=get_accounting_settings('ANNEE');

        //     $piece_query = $this->db->query("SELECT max(NO_PIECE) AS PIECE_NO FROM acct_ecriture_$year WHERE JOURNAL_ID=$row->JOURNAL_ID");


        // if ($piece_query->num_rows()>0) {
        //     foreach ($piece_query->result() as $last_piece) {
        //         $piece_no=$last_piece->PIECE_NO;
        //     }
        // } ?>

                            <tr>
                                <td><?php echo date("Y-m-d", strtotime($row->DATE_CREATION_PAIEMENT)); ?>
                                </td>
                                <td><?php echo $row->NUMERO_RECU_PAIEMENT; ?>
                                </td>
                                <td><?php echo $row->REF_COMMAND_CODE_PAIEMENT; ?>
                                </td>
                                <td><?php echo $row->MONTANT_PAIEMENT; ?>
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
