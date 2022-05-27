
    <style>
        .ligne {
            display: flex;
            justify-content: space-between;
        }
        .first_table {
            margin-top: 1rem;
            height: 9rem;
        }
        .first_table, .second_table, .third_table {
            border: 1px solid black;
            display: flex;
            padding-left: 1rem;
            font-size: 1.5rem;
            flex-direction: column;
        }
        .second_table, .third_table, .forth_table {
            margin-top: 1rem;
            height: 8rem;
        }
        .second_g_table table{
            border: 1px solid black;
            margin-top: 1rem;
            width: 100%;
            max-height: 5rem;
        }
        .second_g_table tr {
            /*border: 1px solid;*/
            display: flex;
            justify-content: space-between;
            flex-direction: row;
        }
        .second_g_table tr td{
            border-right: 1px solid;
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .forth_table{
            border: 1px solid black;
            padding-top: 0.3rem;
            padding-left: 0.5rem;
        }
        .forth_table td{
            display: block;
        }
        .forth_table td:nth-last-child(1) {
            margin-top: 2.5rem;
        }
        .tr2 {
            display: inline;
            float: right;
            margin-top: -7rem;
            margin-right: 2rem;
        }
        .tr1 td, .tr2 td{
            display: block;
        }
        .equipment table{
            margin-top: 1rem;
            width: 100%
        }
        .equipment td, th {
            border: 1px solid black;
            text-align: left;
            padding: 3px;
        }
        .equipment {
            margin-top: 2rem;
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
            padding-right: 3rem;
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
        .number span{
            font-size: 1.7rem;
        }
        @media print {
            .presentation1 {
                width: 50%;
            }
            footer, .print {
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
                echo '<h5>Nom du client : '. $client_name = isset($client_req->NOM_CLIENT) ? $client_req->NOM_CLIENT : '' .'</h5>';
                echo '<h5>Adresse : '. $client_addresse = isset($client_req->ADRESSE_CLIENT) ? $client_req->ADRESSE_CLIENT : '' .'</h5>';
                echo '<h5>Email : '. $client_email = isset($client_req->EMAIL_CLIENT) ? $client_req->EMAIL_CLIENT : '' .'</h5>';
                echo '<h5>Telephone : '. $client_phone = isset($client_req->TEL_CLIENT) ? $client_req->TEL_CLIENT : '' .'</h5>'; ?>
            </div>
            <div class="presentation2">
                <h5>Date : <?= date('Y-m-d H:i:s', strtotime($prise_charge['DATE_CREATION_PRISE_CHARGE'])) ?></h5>
                <h5>Departement : <?= $prise_charge['DEPARTEMENT_PRISE_CHARGE'] ?></h5>
                <h5>Chauffeur: <?= $prise_charge['NOM_CHAUFFEUR_CHARGE'] ?></h5>
                <h5>Numero: <?= $prise_charge['NUMBER_CHAUFFEUR_CHARGE'] ?></h5>
            </div>
        </div>
        <div class="first_table">
            <table>
                <tr class="tr1">
                    <td>Type d'intervention : <?= $prise_charge['TYPE_INTER_PRISE_CHARGE'] ?></td>
                    <?php $type_inter = $this->db->query('SELECT * from pos_ibi_type_intervention LIMIT 0, 3');
                    if($type_inter->num_rows() > 0) {
                        foreach($type_inter->result() as $inter) {
                            $style = '';
                            $iconOui = '';
                            $iconNon = '';
                            $icon = '';
                            $type_maint = '';
                            if($prise_charge['TYPE_PRISE_CHARGE'] == $inter->ID_TYPE_INTER) {
                                // $style = 'style= "color: red"';
                                if($prise_charge['VALUE_TYPE_PRISE_CHARGE'] == 'oui') {
                                    $iconOui = '<i class="fa fa-check"></i>';
                                } else if($prise_charge['VALUE_TYPE_PRISE_CHARGE'] == 'non') {
                                    $iconNon = '<i class="fa fa-check"></i>';
                                    if($prise_charge['TYPE_PRISE_CHARGE'] == 4) {
                                        $type_maint = '<span>'.$prise_charge['TYPE_MAINTENANCE'].'</span>';
                                    }
                                } else {
                                    $icon = '';
                                }
                            } else {
                                $icon = '<i class="fa fa-close"></i>';
                            }
                            echo '<td> <p '.$style.' style="padding: 0px;margin:0px;width:40%; display: flex; justify-content: space-between;" id="'.$inter->ID_TYPE_INTER.'""><span>'.$inter->NOM_TYPE_INTER.' : </span><span><span>Oui '.$iconOui.'</span>   -  <span>non '.$iconNon.' '.$icon.'</span></span></p></td>';
                        }
                    }?>
                </tr>
                <tr class="tr2">
                    <td>N° de Contrat/bon de commande/facture :  <?= $prise_charge['NUM_FACTURE_PRISE_CHARGE'] ?></td>
                    <!-- <td>Date mise en service : <?php //$prise_charge['DATE_SERVICE_PRISE_CHARGE'] ?></td> -->
                </tr>
            </table>
        </div>
        <div class="second_g_table">
            <table>
                <tr class="tr3">
                    <td>N° de plaque : <p><?= $prise_charge['NUM_PLAQUE_CHARGE'] ?></p></td>
                    <td>Kms/heure : <p><?= $prise_charge['KM_PAR_HEURE_CHARGE'] ?></p></td>
                    <td>Niveau Carburant : <p><center>
                        <?php $essence_entree = $prise_charge['CARBURANT_CHARGE'];
                        $first_pic = 30;
                        if ($essence_entree == 0) {

                             ?>

                                <img width="<?php //$first_pic ?>%" style="width: 110px; height: 30px;" src="<?= BASE_ASSET; ?>/gauge_pic/empty.png"> 

                             <?php

                           }elseif ($essence_entree == 10) {

                            ?>

                               <img width="<?php //$first_pic ?>%" style="width: 110px; height: 30px;" src="<?= BASE_ASSET; ?>gauge_pic/un_huitime.png"> 

                           <?php

                           }elseif ($essence_entree == 30) {

                            ?>

                               <img width="<?php //$first_pic ?>%" style="width: 110px; height: 30px;" src="<?= BASE_ASSET; ?>gauge_pic/quarter.png"> 

                           <?php

                           }elseif ($essence_entree == 40) {

                            ?>

                               <img width="<?php //$first_pic ?>%" style="width: 110px; height: 30px;" src="<?= BASE_ASSET; ?>gauge_pic/troix_huitieme.png"> 

                           <?php

                           }elseif ($essence_entree == 50) {

                            ?>

                               <img width="<?php //$first_pic ?>%" style="width: 110px; height: 30px;" src="<?= BASE_ASSET; ?>gauge_pic/half.png"> 

                           <?php

                           }elseif ($essence_entree == 60) {

                            ?>

                               <img width="<?php //$first_pic ?>%" style="width: 110px; height: 30px;" src="<?= BASE_ASSET; ?>gauge_pic/cinq_huitieme.png"> 

                           <?php

                           }elseif ($essence_entree == 70) {

                            ?>

                               <img width="<?php //$first_pic ?>%" style="width: 110px; height: 30px;" src="<?= BASE_ASSET; ?>gauge_pic/three-quarter.png"> 

                           <?php

                           }elseif ($essence_entree == 80) {

                            ?>

                               <img width="<?php //$first_pic ?>%" style="width: 110px; height: 30px;" src="<?= BASE_ASSET; ?>gauge_pic/sept_huitieme.png"> 

                           <?php

                           }elseif ($essence_entree == 100) {

                            ?>

                               <img width="<?php //$first_pic ?>%" style="width: 20px; height: 20px;" src="<?= BASE_ASSET; ?>gauge_pic/full.png"> 

                           <?php

                        }

                         ?></center></p>
                    </td>
                    <td>Niveau huile : <p><strong>
                        <input type="range" name="NIVEAU_HUILE_CHARGE" class="active bold" min="0" disabled max="100" value="<?= set_value('NIVEAU_HUILE_CHARGE',$prise_charge['NIVEAU_HUILE_CHARGE']); ?>" id="NIVEAU_HUILE_CHARGE" step="10" oninput="document.getElementById('Range').textContent=value" />
                                          <span id="Range"><?= $prise_charge['NIVEAU_HUILE_CHARGE'] ?></span>
                        <?php //$prise_charge['NIVEAU_HUILE_CHARGE'] ?></strong></p></td>
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
            <h4>Matériels nécessaires: </h4>
            <table>
                <thead>
                    <th width="10">N°</th>
                    <th width="100">Codebarre</th>
                    <th width="200">Equipements</th>
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
                          $article_name = '';
                          $query_article = $this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles WHERE CODEBAR_ARTICLE LIKE '%".$value['CODE_ARTICLE_CHARGE_EQ']."%' ");
                          foreach($query_article->result() as $art) {
                            echo $article_name = $art->DESIGN_ARTICLE;
                          }

                          $value['CODE_ARTICLE_CHARGE_EQ']?>
                        </td>
                        <td>
                          <?=$value['QUANTITY_CHARGE_EQ']?>
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
                    <td>Estimation Temps : <?php if($prise_charge['TYPE_TEMPS_PRISE_CHARGE'] == 2) {
                        $date_value = $prise_charge['TEMPS_VALUE_PRISE_CHARGE'] * 7;
                        $date_ms = new DateTime($prise_charge['DATE_CREATION_PRISE_CHARGE']);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $prise_charge['TEMPS_VALUE_PRISE_CHARGE'].' semaines' ;
                    } else {
                        $date_value = $prise_charge['TEMPS_VALUE_PRISE_CHARGE'];
                        $date_ms = new DateTime($prise_charge['DATE_CREATION_PRISE_CHARGE']);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $prise_charge['TEMPS_VALUE_PRISE_CHARGE'].' jours';
                    } ?></td>
                </tr>
            </table>
        </div>
        <div class="avis" style="font-size: 13px;padding: 0px; font-display: initial;">
            <small>
                La GTS décline toutes responsabilités pour des objets volés ou détériorées laissés dans le véhicule. Dès la sortie du véhicule, aucune réclamation ne sera admise, le client est donc prié de bien vérifier dès la réception de celui-ci. Au cas où les pièces nécessaires à la réparation du véhicule ne sont pas disponible ou sont en commande, le client reprendra son véhicule. Tout véhicule n'ayant pas été retiré endéans la semaine qui suit la fin des travaux sera automatiquement taxé des frais de gardiennage qui s'élèvent à 5 000FBU par jour. Les risques de terrorisme, guerre et climatique ne sont pas imputable à GTS.
            </small>
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