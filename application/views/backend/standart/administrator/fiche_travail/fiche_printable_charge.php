
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
            font-weight: 500;
        }
        .second_table, .third_table{
            margin-top: 1rem;
            height: 6rem;
        }
        .second_g_table table{
            font-weight: 500;
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
            padding: 1px;
        }
        .equipment td {
            font-weight: 500;
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
            font-weight: 500;
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
        .page table {
            width: 100%;
            height: 100%;
        }
        .page table td, .page table th{
            border: 2px solid black;
            padding: 1px;
            text-align: center;
            font-size: 1.7rem;
        }
        @media print {
            .presentation1 {
                width: 50%;
            }
            footer, .print {
                display: none;
            }
            div.page1 { page-break-after:always; }
        }
    </style>
    <section class="content">
        <button class="btn btn-primary print">Imprimer</button>
    <div class="page1">
    <section class="paper_all">
        <div class="header">
            <div class="title">
                <img src="<?= BASE_ASSET; ?>/img/logo_gts_fait_j.png">
                <h3>Fiche de travail SAV</h3>
            </div>
            <div class="number">
                <h3>N° <span><?= $fiche_travail['NUMERO_FICHE'] ?></span></h3>
            </div>
        </div>
        <div class="ligne">
            <div class="presentation1">
                <?php
                echo '<h5>Nom du client : <strong>'.$client['NOM_CLIENT'].' '.$client['PRENOM_CLIENT'].'</strong></h5>'; ?>
                <h5>Fiche de prise en charge N° : <strong><?= $fiche_travail['DEVIS_CODE_FICHE'] ?></strong></h5>
                <h5>Departement : <strong><?php 
                $code = $fiche_travail['DEVIS_CODE_FICHE'];
                $depart = $this->db->get_where('pos_store_'.$this->uri->segment(4).'_ibi_prise_charge', array('NUMERO_PRISE_CHARGE' => $code))->row();
                echo isset($depart->DEPARTEMENT_PRISE_CHARGE) ? $depart->DEPARTEMENT_PRISE_CHARGE : '';
                 ?></strong></h5>
            </div>
            <div class="presentation2">
                <?php
                 // if($depart->DATE_SERVICE_PRISE_CHARGE == 0) {
                    $date_prise = $depart->DATE_CREATION_PRISE_CHARGE;
                 ?>
                <h5>Date de PC : <?= date('Y-m-d H:i:s', strtotime($date_prise)) ?></h5>
                <h5>Date de fin : <?php 
                    if($depart->TYPE_TEMPS_PRISE_CHARGE == 2) {
                        $date_value = $depart->TEMPS_VALUE_PRISE_CHARGE * 7;
                        $date_ms = new DateTime($date_prise);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $date_estime->format('Y-m-d');
                    } else {
                        $date_value = $depart->TEMPS_VALUE_PRISE_CHARGE;
                        $date_ms = new DateTime($date_prise);
                        $date_estime = $date_ms->modify("+$date_value days");
                        echo $date_estime->format('Y-m-d');
                    }

                 ?></h5>
                 <h5>Date D.T : <?= $fiche_travail['DATE_CREATION_FICHE'] ?></h5>
                 <h5>Date de C.T : <?= $fiche_travail['DATE_APPROBAT'] ?></h5>
            </div>
        </div>
        <div>
            <h4>Description : <strong><?= $fiche_travail['TITRE_FICHE'] ?></strong></h4>
        </div>
        <div class="equipment">
            <table>
                <thead>
                    <th width="80">CODE ARTICLE</th>
                    <th width="250">MATERIEL</th>
                    <th width="10">QUANTITE</th>
                    <th width="10">UNITE</th>
                    <th width="80">OBSERVATION</th>
                </thead>
                <tbody>
                    <?php 
                        foreach ($fiche_travail_prods as $value) {  
                      ?>
                      <tr>
                        <td><?= $value['REF_PRODUCT_CODEBAR_FICHE_PROD'] ?></td>
                        <td>
                          <?=$value['NAME_FICHE_PROD']?>
                        </td>
                        <td>
                          <?=$value['QUANTITE_FICHE_PROD']?>
                        </td>
                        <td>
                          <?=$value['UNIT_FICHE_PROD']?>
                        </td>
                        <td>
                        </td>
                      </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="forth_table">
            <table>
                <tr class="tr5">
                    <td>Details/Observations/Notices : <?= $fiche_travail['DETAILS_FICHE'] ?></td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <div class="footer1">
                <p>Etabli par : <?php $user_id = _ent($fiche_travail['AUTHOR_FICHE']);
                $user_req = $this->db->get_where('aauth_users', array('id' => $user_id))->row();
                echo $user = isset($user_req->full_name) ? $user_req->full_name : '';
                 ?></p>
                <p>Signature : </p>
            </div>
            <div class="footer2">
            </div>
        </div>
    </section>
    </div>
    <div class="page">
                                    <section id="items">
                                      
                                      <table cellpadding="0" cellspacing="0">

                                              <thead>
                                                <tr>
                                                  <th style="width: 80px;height: 35px;"><b>Date</b></th>
                                                  <th>Désignation</th>
                                                 <!--  <th>Code Article</th> -->
                                                  <th style="width: 100px;"><b>Quantite</b></th>
                                                  <th style="width: 100px;"><b>Aprouvé par</b></th>
                                                  <th style="width: 80px;"><b>Magasin</b></th>
                                                  <th style="width: 80px;"><b>Reçu par</b></th>
                                                </tr>
                                              </thead>

                                            
                                                      <tbody>
                                                        <tr style="height: 24px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr> 
                                                        <tr style="height: 24px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                        <tr style="height: 24px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                         
                                                        </tr>
                                                        <tr style="height: 24px;">
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                        </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td> 
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                          <tr style="height: 24px;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                          </tr>
                                                      </tbody>
                                        
                                      </table>  
                                    </section> 
                                </div>
    </section>
<script type="text/javascript">
    const print = document.querySelector('.print');
    print.addEventListener('click', function() {
        window.print();
    })
</script>