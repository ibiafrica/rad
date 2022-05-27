<style>
    .ligne {
        display: flex;
        justify-content: space-between;
    }

    .first_table {
        margin-top: 1rem;
        height: 15rem;
    }

    .first_table,
    .second_table,
    .third_table {
        border: 1px solid black;
        display: flex;
        padding-left: 1rem;
        font-size: 1.5rem;
        flex-direction: column;
    }

    .second_table,
    .third_table {
        margin-top: 1.5rem;
        height: 7.5rem;
    }

    .forth_table {
        border: 1px solid black;
        padding-top: 0.3rem;
        padding-left: 0.5rem;
        height: 9rem;
        margin-top: 1.5rem;
    }

    .forth_table td {
        display: block;
    }

    .forth_table td:nth-last-child(1) {
        margin-top: 3rem;
    }

    .tr2 {
        display: inline;
        float: right;
        margin-top: -9rem;
        margin-right: 2rem;
    }

    .tr1 td,
    .tr2 td {
        display: block;
    }

    .equipment {
        margin-top: 2rem;
    }

    .equipment table {
        width: 100%
    }

    .equipment td,
    th {
        border: 1px solid black;
        text-align: left;
        padding: 3px;
    }

    .title {
        display: flex;
    }

    .title img {
        width: 10rem;
        margin-right: 2.5rem;
        color: black;
    }

    .footer {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
        padding-right: 4rem;
    }

    .footer1:nth-last-child(1) {
        margin-top: 3rem;
    }

    .header {
        display: flex;
        justify-content: space-between;
    }

    .presentation2 {
        margin-right: 4rem;
    }

    .number span {
        font-size: 1.7rem;
    }

    @media print {
        .presentation1 {
            width: 50%;
        }

        footer,
        .print {
            display: none;
        }
    }
</style>
<section class="paper_all">
    <div class="header">
        <div class="title">
            <img src="<?= BASE_ASSET; ?>/img/logo_gts_fait_j.png">
            <h3>Fiche de Prise en Charge</h3>
        </div>
        <div class="number">
            <h3>N° <span><?= $prise_charge['NUMERO_PRISE_CHARGE'] ?></span></h3>
        </div>
    </div>
    <div class="ligne">
        <div class="presentation1">
            <?php $client_id = _ent($prise_charge['REF_CLIENT_PRISE_CHARGE']);
            $client_req = $this->db->get_where('pos_ibi_clients', array('ID_CLIENT' => $client_id))->row();
            echo '<h5>Nom du client : ' . $client_name = isset($client_req->NOM_CLIENT) ? $client_req->NOM_CLIENT : '' . '</h5>';
            echo '<h5>Adresse : ' . $client_addresse = isset($client_req->ADRESSE_CLIENT) ? $client_req->ADRESSE_CLIENT : '' . '</h5>';
            echo '<h5>Email : ' . $client_email = isset($client_req->EMAIL_CLIENT) ? $client_req->EMAIL_CLIENT : '' . '</h5>';
            echo '<h5>Telephone : ' . $client_phone = isset($client_req->TEL_CLIENT) ? $client_req->TEL_CLIENT : '' . '</h5>'; ?>
        </div>
        <div class="presentation2">
            <h5>Date : <?= date('Y-m-d H:i:s', strtotime($prise_charge['DATE_CREATION_PRISE_CHARGE'])) ?></h5>
            <h5>Departement : <?= $prise_charge['DEPARTEMENT_PRISE_CHARGE'] ?></h5>
        </div>
    </div>
    <div class="first_table">
        <table>
            <tr class="tr1">
                <td>Type d'intervention : <?= $prise_charge['TYPE_INTER_PRISE_CHARGE'] ?></td>
                <?php $type_inter = $this->db->query('SELECT * from pos_ibi_type_intervention');
                if ($type_inter->num_rows() > 0) {
                    foreach ($type_inter->result() as $inter) {
                        $style = '';
                        $iconOui = '';
                        $iconNon = '';
                        $icon = '';
                        $type_maint = '';
                        if ($prise_charge['TYPE_PRISE_CHARGE'] == $inter->ID_TYPE_INTER) {
                            // $style = 'style= "color: red"';
                            if ($prise_charge['VALUE_TYPE_PRISE_CHARGE'] == 'oui') {
                                $iconOui = '<i class="fa fa-check"></i>';
                            } else if ($prise_charge['VALUE_TYPE_PRISE_CHARGE'] == 'non') {
                                $iconNon = '<i class="fa fa-check"></i>';
                                if ($prise_charge['TYPE_PRISE_CHARGE'] == 4) {
                                    $type_maint = '<span>' . $prise_charge['TYPE_MAINTENANCE'] . '</span>';
                                }
                            } else {
                                $icon = '';
                            }
                        } else {
                            // $style= 'style= "color: blue"';
                        }
                        echo '<td> <p ' . $style . ' style="padding: 0px;margin:0px;width:25%; display: flex; justify-content: space-between;" id="' . $inter->ID_TYPE_INTER . '""><span>' . $inter->NOM_TYPE_INTER . ' : </span><span><span>Oui ' . $iconOui . '</span>   -  <span>non ' . $iconNon . '</span></span></p></td>';
                    }
                } ?>
            </tr>
            <tr class="tr2">
                <td>N° de Facture/Contrat : <?= $prise_charge['NUM_FACTURE_PRISE_CHARGE'] ?></td>
                <td>Date mise en service : <?= $prise_charge['DATE_SERVICE_PRISE_CHARGE'] ?></td>
            </tr>
        </table>
    </div>
    <div class="second_table">
        <table>
            <tr class="tr3">
                <td>Inspection : <?= $prise_charge['INSPECTION_PRISE_CHARGE'] ?></td>
            </tr>
        </table>
    </div>
    <div class="third_table">
        <table>
            <tr class="tr4">
                <td>Action a mener : <?= $prise_charge['ACTION_PRISE_CHARGE'] ?></td>
            </tr>
        </table>
    </div>
    <div class="equipment">
        <h5>Liste d'équipements: </h5>
        <table>
            <thead>
                <th width="10">N°</th>
                <th width="100">Codebarre</th>
                <th width="200">Equipements</th>
                <th width="80">N° de serie</th>
                <th width="80">Quantité</th>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($prise_equipements as $key => $value) {
                ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $value['CODE_ARTICLE_CHARGE_EQ'] ?></td>
                        <td>
                            <?php
                            $code = $value['CODE_ARTICLE_CHARGE_EQ'];
                            $article_name = '';
                            $ref = '';
                            $query_article = $this->db->query("SELECT * FROM pos_store_" . $this->uri->segment(4) . "_ibi_articles WHERE CODEBAR_ARTICLE LIKE '%" . $value['CODE_ARTICLE_CHARGE_EQ'] . "%' ");
                            foreach ($query_article->result() as $art) {
                                $ref = $art->SKU_ARTICLE;
                                echo $article_name = $art->DESIGN_ARTICLE;
                            }
                            ?>
                        </td>
                        <td>
                            <?= $ref ?>
                        </td>
                        <td>
                            <?= $value['QUANTITY_CHARGE_EQ'] ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="forth_table">
        <table>
            <tr class="tr5">
                <td>Observations speciales : <?= $prise_charge['OBSERVATION_PRISE_CHARGE'] ?></td>
                <td>Estimation Temps : <?php if ($prise_charge['TYPE_TEMPS_PRISE_CHARGE'] == 2) {
                                            $date_value = $prise_charge['TEMPS_VALUE_PRISE_CHARGE'] * 7;
                                            $date_ms = new DateTime($prise_charge['DATE_CREATION_PRISE_CHARGE']);
                                            $date_estime = $date_ms->modify("+$date_value days");
                                            echo $prise_charge['TEMPS_VALUE_PRISE_CHARGE'] . ' semaines';
                                        } else {
                                            $date_value = $prise_charge['TEMPS_VALUE_PRISE_CHARGE'];
                                            $date_ms = new DateTime($prise_charge['DATE_CREATION_PRISE_CHARGE']);
                                            $date_estime = $date_ms->modify("+$date_value days");
                                            echo $prise_charge['TEMPS_VALUE_PRISE_CHARGE'] . ' jours';
                                        } ?></td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <div class="footer1">
            <p>Etabli par : <?php $user_id = _ent($prise_charge['AUTHOR_PRISE_CHARGE']);
                            $user_req = $this->db->get_where('aauth_users', array('id' => $user_id))->row();
                            echo $user = isset($user_req->full_name) ? $user_req->full_name : '';
                            ?></p>
            <p>Signature : </p>
        </div>
        <div class="footer2">
            <p>Client : <?= $client_name ?></p>
            <p>Lu et approuve</p>
            <p>Signature : </p>
            <p>Décharge : </p>
        </div>
    </div>
</section>
<button class="btn btn-primary print">Impression</button>
<script type="text/javascript">
    const print = document.querySelector('.print');
    print.addEventListener('click', function() {
        window.print();
    })
</script>