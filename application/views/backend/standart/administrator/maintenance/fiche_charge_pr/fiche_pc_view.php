
<style>
    img {
        width: 12rem;
        height: 5.3rem;
    }
    .presentation_title {
        font-weight: 800;
        font-size: 2rem;
        margin-top: 2rem;
    }
    .presentation_number {
        font-weight: 800;
        font-size: 1.5rem;
        margin-top: 2rem;
        padding-top: 2rem;
    }
    .first_title, .second_title, .third_title {
        background-color: #634E45;
        font-size: 1.5rem;
        font-weight: 600;
    }
    .fourth_info td{
        height: 20rem !important;
    }
    .info {
        height: 9rem !important;
    }
    @media print {
        @page{ size: a4 portrait; margin: 5mm 5mm 5mm 5mm; padding: 0;}
        .paper_all {
            page-break-before: always;
        }
        .first_title, .second_title, .third_title {
            background-color: #634E45 !important;
        }
        .fourth_info td{
            height: 17.5rem !important;
        }
        footer, .print {
            display: none;
        }
    }
</style>
    <?php $client_id = _ent($prise_charge['REF_CLIENT_PRISE_CHARGE']);
                $client_req = $this->db->get_where('pos_ibi_clients', array('ID_CLIENT' => $client_id))->row(); ?>
                
<section class="paper_all">
    <div class="table-responsive"> 
        <table class="table table-bordered table-striped dataTable" id="fpc_table">
            <tbody>
                <tr>
                    <td class="presentation_img"><center><img src="<?= BASE_ASSET; ?>/img/logo_gts_fait_j.png"></center></td>
                    <td class="presentation_title text-center">FICHE DE PRISE EN CHARGE OPERATIONS</td>
                    <td class="presentation_number">N°: <?= $prise_charge['NUMERO_PRISE_CHARGE'] ?></td>
                </tr>
                <tr>
                    <td class="first_info">Date</td><td colspan="2"><?= date('d-m-Y',strtotime($prise_charge['DATE_CREATION_PRISE_CHARGE'])); ?></td>
                </tr>
                <tr>
                    <td class="first_info">Client</td><td colspan="2"><?= isset($client_req->NOM_CLIENT) ? $client_req->NOM_CLIENT : ''; ?></td>
                </tr>
                <tr>
                    <td class="first_info">Personne de contact</td><td colspan="2"><?= $prise_charge['PERSONNE_CONTACT_PRISE_CHARGE'] ?></td>
                </tr>
                <tr>
                    <td class="first_info">Téléphone</td><td colspan="2"><?= $prise_charge['TELEPHONE_PRISE_CHARGE'] ?></td>
                </tr>
                <tr>
                    <td class="first_info">Adresse</td><td colspan="2"><?= isset($client_req->ADRESSE_CLIENT) ? $client_req->ADRESSE_CLIENT : ''; ?></td>
                </tr>
                <tr>
                    <td class="first_info">NIF</td><td colspan="2"><?= $prise_charge['NIF_PRISE_CHARGE'] ?></td>
                </tr>
                <tr>
                    <td class="first_info">Type de demande</td><td colspan="2"><?= $prise_charge['TYPE_DEMANDE_PRISE_CHARGE'] ?></td>
                </tr>
                <tr class="first_title text-center">
                    <td colspan="3">Détails nécessaires</td>
                </tr>
                <tr>
                    <td class="second_info">Type d'Article</td><td colspan="2"><?= $prise_charge['TYPE_ARTICLE_PRISE_CHARGE'] ?></td>
                </tr>
                <tr>
                    <td class="second_info">Quantités demandées</td><td colspan="2"><?= $prise_charge['QUANTITY_PRISE_CHARGE'] ?></td>
                </tr>
                <tr>
                    <td class="second_info">Matériel</td><td colspan="2"><?= $prise_charge['MATERIEL_PRISE_CHARGE'] ?></td>
                </tr>
                <tr>
                    <td class="second_info">Dimension</td><td colspan="2"><?= $prise_charge['DIMENSION_PRISE_CHARGE'] ?></td>
                </tr>
                <tr>
                    <td class="second_info">Visite nécessaire</td><td colspan="2"><?= $prise_charge['VALUE_TYPE_PRISE_CHARGE'] ?></td>
                </tr>
                <tr>
                    <td class="second_info">Date de visite</td><td colspan="2"><?= date('d-m-Y',strtotime($prise_charge['DATE_VISITE_PRISE_CHARGE'])) ?></td>
                </tr>
                <tr>
                    <td class="second_info info">Infos supplémentaires</td><td colspan="2"><?= $prise_charge['INFO_PRISE_CHARGE'] ?></td>
                </tr>
                <tr class="second_title text-center">
                    <td colspan="3">Détails de Travail</td>
                </tr>
                <tr>
                    <td class="third_info">Délais de fabrication</td><td colspan="2"><?php
                    $type_fab = $prise_charge['TYPE_TEMPS_FAB_PRISE_CHARGE'];
                    $temps = $prise_charge['TEMPS_VALUE_FAB_PRISE_CHARGE'];
                    $plural = ($temps <= 1) ? '':'s' ;
                    if($type_fab == 1) {
                        echo $temps .' jour'.$plural;
                    }else if($type_fab == 2){
                        echo $temps .'semaine'.$plural;
                    }else {
                        echo '';
                    }
                     ?></td>
                </tr>
                <tr>
                    <td class="third_info">Délais de livraison</td><td colspan="2"><?php
                    $type_fab = $prise_charge['TYPE_TEMPS_LIV_PRISE_CHARGE'];
                    $temps = $prise_charge['TEMPS_VALUE_LIV_PRISE_CHARGE'];
                    $plural = ($temps <= 1) ? '':'s' ;
                    if($type_fab == 1) {
                        echo $temps .' jour'.$plural;
                    }else if($type_fab == 2){
                        echo $temps .' semaine'.$plural;
                    }else {
                        echo '';
                    }
                     ?></td>
                </tr>
                <tr>
                    <td class="third_info">Date de début</td><td colspan="2"><?= date('d-m-Y',strtotime($prise_charge['DATE_DEB_PRISE_CHARGE'])) ?></td>
                </tr>
                <tr>
                    <td class="second_info">Date de livraison</td><td colspan="2"><?= date('d-m-Y',strtotime($prise_charge['DATE_LIV_PRISE_CHARGE'])) ?></td>
                </tr>
                <tr class="third_title text-center">
                    <td colspan="3">Croquis</td>
                </tr>
                <tr class="fourth_info">
                    <td  colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
    <button class="btn btn-primary print">Impression</button>
<script type="text/javascript">
    const print = document.querySelector('.print');
    print.addEventListener('click', function() {
        window.print();
    })
</script>