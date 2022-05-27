
    <style>
        .ligne {
            display: flex;
            justify-content: space-between;
        }
        .first_table {
            margin-top: 1rem;
        }
        .first_table, .second_table, .third_table {
            border: 1px solid black;
            display: flex;
            padding-left: 1rem;
            font-size: 1.5rem;
            flex-direction: column;
        }
        .second_table, .third_table{
            margin-top: 1rem;
            height: 6rem;
        }
        .second_g_table table{
            border: 1px solid black;
            margin-top: 1rem;
            width: 100%;
        }
        .second_g_table tr {
            /*border: 1px solid;*/
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            width: 100%;
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
            height: 12rem;
            margin-top: 2rem;
        }
        .forth_table td{
            display: block;
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
                <img src="<?= BASE_ASSET; ?>/img/logo_gts.png">
                <h3>Fiche de travail SAV</h3>
            </div>
            <div class="number">
                <h3>N° <span><?= $prise_charge['NUMERO_PRISE_CHARGE'] ?></span></h3>
            </div>
        </div>
        <div class="ligne">
            <div class="presentation1">
                <?php $client_id = _ent($prise_charge['REF_CLIENT_PRISE_CHARGE']);
                $client_req = $this->db->get_where('pos_ibi_clients', array('ID_CLIENT' => $client_id))->row();
                echo '<h5>Nom du client : <strong>'. $client_name = isset($client_req->NOM_CLIENT) ? $client_req->NOM_CLIENT : '' .'</strong></h5>'; ?>
                <h5>Fiche de prise en charge N° : <strong><?= $prise_charge['NUMERO_PRISE_CHARGE'] ?></strong></h5>
                <h5>Departement : <strong><?= $prise_charge['DEPARTEMENT_PRISE_CHARGE'] ?></strong></h5>
            </div>
            <div class="presentation2">
                <h5>Date de prise en charge: <?= date('Y-m-d', strtotime($prise_charge['DATE_CREATION_PRISE_CHARGE'])) ?></h5>
                <h5>Date de fin: <?php 
                    if($prise_charge['TYPE_TEMPS_PRISE_CHARGE'] == 2) {
                        $date_value = $prise_charge['TEMPS_VALUE_PRISE_CHARGE'] * 7;
                        $date_ms = new DateTime($prise_charge['DATE_SERVICE_PRISE_CHARGE']);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $date_estime->format('Y-m-d');
                    } else {
                        $date_value = $prise_charge['TEMPS_VALUE_PRISE_CHARGE'];
                        $date_ms = new DateTime($prise_charge['DATE_SERVICE_PRISE_CHARGE']);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $date_estime->format('Y-m-d');
                    }

                 ?></h5>
            </div>
        </div>
        <div>
            <h5>Description : </h5>
        </div>
        <div class="equipment">
            <table>
                <thead>
                    <th width="10">CODE ARTICLE</th>
                    <th width="200">MATERIEL</th>
                    <th width="80">QUANTITE</th>
                    <th width="80">UNITE</th>
                    <th width="80">OBSERVATION</th>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                        foreach ($prise_equipements as $key => $value) {  
                      ?>
                      <tr>
                        <td><?= $value['CODE_ARTICLE_CHARGE_GARAGE'] ?></td>
                        <td>
                          <?php
                          $article_name = '';
                          $query_article = $this->db->query("SELECT * FROM pos_store_".$this->uri->segment(4)."_ibi_articles WHERE CODEBAR_ARTICLE LIKE '%".$value['CODE_ARTICLE_CHARGE_GARAGE']."%' ");
                          foreach($query_article->result() as $art) {
                            echo $article_name = $art->DESIGN_ARTICLE;
                            $unite = $art->POIDS_ARTICLE;
                          }

                          $value['CODE_ARTICLE_CHARGE_GARAGE']?>
                        </td>
                        <td>
                          <?=$value['QUANTITY_CHARGE_GARAGE']?>
                        </td>
                        <td>
                          <?=$unite?>
                        </td>
                      </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="forth_table">
            <table>
                <tr class="tr5">
                    <td><strong>Details/Observations :</strong> <?= $prise_charge['OBSERVATION_PRISE_CHARGE'] ?></td>
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