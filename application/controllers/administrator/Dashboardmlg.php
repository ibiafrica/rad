<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Dashboard Controller
 *| --------------------------------------------------------------------------
 *| For see your board
 *|
 */
class Dashboard extends Admin
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('model_rm');
    $this->load->model('Model_dashboard');
  }


  public function index()
  {

    $store = $this->uri->segment(2);
    if (!$this->aauth->is_allowed('dashboard')) {
      redirect('/', 'refresh');
    }

    $year = date('Y');
    $month_now = date('m');
    $date_now = date('Y-m-d');


    $statut_manuel = array('reservation' => 1, 'checkin' => 2, 'checkout' => 3);

    if (!is_null($store)) {
      $all_article = $this->db->query("SELECT DISTINCT(REF_PRODUCT_CODEBAR), COUNT(*) FROM pos_ibi_commandes_produits WHERE REF_PRODUCT_CODEBAR != '' AND MONTH(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS) = '" . $month_now . "' AND STORE_ID_pos_IBI_COMMANDES_PRODUITS = '" . $store . "' GROUP BY REF_PRODUCT_CODEBAR ORDER BY  COUNT(*) DESC LIMIT 10")->result();
    } else {
      $all_article = $this->db->query("SELECT DISTINCT(REF_PRODUCT_CODEBAR), COUNT(*) FROM pos_ibi_commandes_produits WHERE REF_PRODUCT_CODEBAR != '' AND MONTH(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS) = '" . $month_now . "' GROUP BY REF_PRODUCT_CODEBAR ORDER BY  COUNT(*) DESC LIMIT 10")->result();
    }




    $total_art = "";
    $numbers_ = 0;
    $article_s = "";
    $montant = "";
    foreach ($all_article as $article) {
      if (!is_null($store)) {
        $get_cmd_produit = $this->db->query("SELECT SUM(QUANTITE) AS TOTAL_BY_ARTICLE FROM pos_ibi_commandes_produits  WHERE  REF_PRODUCT_CODEBAR = '" . $article->REF_PRODUCT_CODEBAR . "' AND MONTH(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS) = '" . $month_now . "' AND STORE_ID_pos_IBI_COMMANDES_PRODUITS = '" . $store . "' ORDER BY(TOTAL_BY_ARTICLE) DESC")->row_array();
      } else {
        $get_cmd_produit = $this->db->query("SELECT SUM(QUANTITE) AS TOTAL_BY_ARTICLE FROM pos_ibi_commandes_produits  WHERE  REF_PRODUCT_CODEBAR = '" . $article->REF_PRODUCT_CODEBAR . "' AND MONTH(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS) = '" . $month_now . "'  ORDER BY(TOTAL_BY_ARTICLE) DESC")->row_array();
      }

      if (empty($get_cmd_produit)) {
        $numbers_ = 0;
      } else {
        $numbers_ = $get_cmd_produit['TOTAL_BY_ARTICLE'];
      }

      $Q = $this->db->query("SELECT * FROM pos_store_1_ibi_articles WHERE CODEBAR_ARTICLE = '" . $article->REF_PRODUCT_CODEBAR . "' ")->row_array();

      $total_art .= "['" . $Q['DESIGN_ARTICLE'] . "', " . $numbers_ . "],";
      $article_s .= '"' . $Q['DESIGN_ARTICLE'] . '",';
      $montant .= $numbers_ . ",";
    }

    $month_depense_recette = array('Janvier' => '01', 'Février' => '02', 'Mars' => '03', 'Avril' => '04', 'Mai' => '05', 'Juin' => '06', 'Juillet' => '07', 'Août' => '08', 'Septembre' => '09', 'Octobre' => '10', 'Novembre' => '11', 'Décembre' => '12');
    $depense_rec = "";
    $recette_tt = "";

    $tot_rec = "";
    $mois = "";
    $year = date('Y');
    $tot = 0;
    $rec_bs = "";
    foreach ($month_depense_recette as $key => $value) {


      $chiffres_depenser = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS TOT_DEPENSE FROM pos_depenses WHERE MONTH(DATE_CREATE_DEPENSE) = " . $value . " AND YEAR(DATE_CREATE_DEPENSE) = " . $year . " AND STATUT_FLUX =1 ")->row_array();

      $depense_annuelle = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS TOT_DEPENSE FROM pos_depenses WHERE  YEAR(DATE_CREATE_DEPENSE) = " . $year . " ")->row_array();

      $chiffres_recette = $this->db->query("SELECT SUM(MONTANT_PAIEMENT ) AS TOT_REC FROM pos_paiements WHERE MONTH(DATE_CREATION_PAIEMENT) = " . $value . " AND YEAR(DATE_CREATION_PAIEMENT) = " . $year . " ")->row_array();

      $recette_annuelle = $this->db->query("SELECT SUM(QUANTITE * PRIX) AS TOT_REC FROM pos_ibi_commandes_produits WHERE  YEAR(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS) = " . $year . " ")->row_array();


      if (is_null($chiffres_recette['TOT_REC'])) {
        $tot_rec = 0;
      } else {
        $tot_rec = $chiffres_recette['TOT_REC'];
      }

      if (is_null($chiffres_depenser['TOT_DEPENSE'])) {
        $tot = 0;
      } else {
        $tot = $chiffres_depenser['TOT_DEPENSE'];
      }

      $rec_bs .= "['" . $key . "'," . $tot_rec . "],";
      $recette_tt .= $tot_rec . ",";
      $depense_rec .= $tot . ",";
      $mois .= '"' . $key . '",';
    }
    $recette = "";
    if (is_null($recette_annuelle['TOT_REC'])) {
      $recette = 0;
    } else {
      $recette = $recette_annuelle['TOT_REC'];
    }
    $dep = "";
    if (is_null($depense_annuelle['TOT_DEPENSE'])) {
      $dep = 0;
    } else {
      $dep = $depense_annuelle['TOT_DEPENSE'];
    }


    $mode_paie = $this->db->get_where('mode_paiement')->result();
    $counter_md_paie = "";
    foreach ($mode_paie as $mode) {
      $count_paie = $this->db->query("SELECT * FROM pos_paiements WHERE MODE_PAIEMENT = '" . $mode->ID_MODE_PAIEMENT . "' ")->num_rows();
      $counter_md_paie .= "['" . $mode->DESIGNATION_PAIEMENT_MODE . "', " . $count_paie . "],";
      // echo "<pre>";print_r($counter_md_paie);
    }
    $statusFact = "";
    $statutPaie = array('Attente' => 0, 'Payer' => 2, 'Avance' => 1, 'Complementaire' => 11, 'Credit' => 10);
    foreach ($statutPaie as $stat => $key) {
      $countCmd = $this->db->query("SELECT * FROM pos_ibi_commandes WHERE COMMANDE_STATUS = '" . $key . "' ")->num_rows();

      $statusFact .= "['" . $stat . "', " . number_format($countCmd) . "],";
      // var_dump($countCmd);
    }
    // exit;


    $get_bs['mode_paiement'] = $counter_md_paie;
    $get_bs['recette_annuelle_'] = $recette;
    $get_bs['depense_annuelle_'] = $dep;
    $get_bs['status_facture'] = $statusFact;
    $get_bs['month'] = $mois;
    $get_bs['depense_par_mois'] = $depense_rec;
    $get_bs['recette_toute'] = $recette_tt;

    $get_bs['rec_alls'] = $rec_bs;
    $get_bs['montants__'] = $montant;
    $get_bs['articles__'] = $article_s;

    $get_bs['afficher_best_somme'] = $total_art;

    // echo "<pre>"; print_r($get_bs['afficher_best_somme']);exit;

    if ($store == 0) {
      // $this->render('backend/standart/chart',$get_bs);
      $this->render('backend/standart/dashboard_store', $get_bs);
    } else {
      $this->render('backend/standart/dashboard_store', $get_bs);
    }
  }


  public function getService()
  {
    $year = date('Y');
    $month = date('m');
    $date = $this->input->post('dateval');

    $storeList = $this->model_rm->getList('pos_ibi_stores', array('DELETE_STATUS_STORE' => 0));

    if (empty($date)) {
      $req = 'AND date_format(P.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m")="' . $year . '-' . $month . '"';
    } else {
      $req = 'AND date_format(P.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m")="' . $year . '-' . $date . '"';
    }

    $datachiffre = '';
    $dep = $this->model_rm->getList('departements', array('DELETED_STATUS_DEPARTEMENTS' => 0));
    foreach ($dep as $key) {

      $montant = $this->model_rm->getRequeteOne('SELECT SUM(P.PRIX * P.QUANTITE) AS TOTAL, A.DESIGNATION, D.DESIGNATION_DEPARTEMENT, P.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS
          FROM pos_ibi_commandes_produits P
          JOIN actes_categorie A ON A.ID_ACTES_CATEGORIE=P.DEPARTMENT
          JOIN departements D ON D.ID_DEPARTEMENT=A.DEPARTEMENTS
          WHERE D.ID_DEPARTEMENT=' . $key['ID_DEPARTEMENT'] . ' 
          ' . $req . '
          GROUP BY D.ID_DEPARTEMENT')['TOTAL'];

      $montant_st = 0;
      foreach ($storeList as $st) {
        $m = $this->model_rm->getRequeteOne('SELECT SUM(P.PRIX * P.QUANTITE) AS TOTAL, A.DESIGNATION, D.DESIGNATION_DEPARTEMENT, P.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS
          FROM pos_ibi_commandes_produits P
          JOIN actes_categorie A ON A.ID_ACTES_CATEGORIE=P.DEPARTMENT
          JOIN departements D ON D.ID_DEPARTEMENT=A.DEPARTEMENTS
          WHERE D.ID_DEPARTEMENT=' . $key['ID_DEPARTEMENT'] . ' 
          ' . $req . '
          GROUP BY D.ID_DEPARTEMENT')['TOTAL'];


        if ($m > 0) {
          $montant_st += $m;
        }
      }

      if ($montant == '') {
        $montant = 0;
      }
      $montants = $montant + $montant_st;
      $datachiffre .= '["' . $key['DESIGNATION_DEPARTEMENT'] . '", ' . $montants . '],';
    }

    $datachiffre .= '//';
    $datachiffre = str_replace(',//', '', $datachiffre);
    echo '[' . $datachiffre . ']';
  }


  public function getAssurance()
  {

    $year = date('Y');
    $month = date('m');
    $date = $this->input->post('dateval');
    if (empty($date)) {
      $req = 'AND date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m")="' . $year . '-' . $month . '"';
    } else {
      $req = 'AND date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m")="' . $year . '-' . $date . '"';
    }

    $dataAssurance = $this->model_rm->getRequete('SELECT DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, DISCOUNT_PERCENT, (PRIX * QUANTITE) AS PRIX_TOTAL,REF_COMMAND_CODE,NOM_SOCIETE,ID_SOCIETE,
			SUM(DISCOUNT_PERCENT*PRIX * QUANTITE/100) AS VAL
			FROM pos_ibi_commandes_produits CP
			LEFT JOIN hospital_ibi_commandes C ON CP.REF_COMMAND_CODE=C.CODE
			LEFT JOIN patient_file PF ON C.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES=PF.PATIENT_FILE_ID
			LEFT JOIN hospital_ibi_societes S ON S.ID_SOCIETE=PF.REF_SOCIETE
			WHERE PF.REF_SOCIETE!=0 ' . $req . '
			GROUP BY S.ID_SOCIETE');

    $concat = '';
    foreach ($dataAssurance as $key) {
      $concat .= '{"name": "' . $key['NOM_SOCIETE'] . '", "y": ' . $key['VAL'] . ' },';
    }
    $concat .= '//';
    $concat = str_replace(',//', '', $concat);
    if (count($dataAssurance)) {
      echo '[' . $concat . ']';
    } else {
      echo '[]';
    }
  }



  public function days_in_month($month, $year)
  {
    return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
  }


  public function facturation_statut()
  {
    $monthSelect = $this->input->post('date_value');
    $month = $monthSelect;
    if (empty($monthSelect)) {
      $month = date('m');
    }


    $statusFact = "";
    $statutPaie = array('Attente' => 0, 'Payer' => 2, 'Avance' => 1, 'Complementaire' => 11, 'Credit' => 10);
    foreach ($statutPaie as $stat => $key) {
      $countCmd = $this->db->query("SELECT * FROM pos_ibi_commandes WHERE COMMANDE_STATUS = '" . $key . "' AND MONTH(DATE_CREATION_pos_IBI_COMMANDES) = " . $month . " ")->num_rows();

      $statusFact .= '["' . $stat . '", ' . number_format($countCmd) . '],';
    }

    $statusFact = $statusFact . "//";
    $statusFact = str_replace(",//", "", $statusFact);
    echo ("[" . $statusFact . "]");
  }

  public function getChiffreJ()
  {


    $data = [];

    $year = date('Y');
    $month = date('m');
    $date = $this->input->post('dateval');
    $store = $this->input->post('store');
    $storeList = $this->model_rm->getList('pos_ibi_stores', array('DELETE_STATUS_STORE' => 0));


    if (isset($store) and !empty($store)) {
      $tablename = 'pos_ibi_commandes_produits';
      $storeMode = false;
    } else {
      $tablename = 'pos_ibi_commandes_produits';
      $storeMode = true;
    }


    if (empty($date)) {
      $days = $this->days_in_month($month, $year);
    } else {
      $days = $this->days_in_month($date, $year);
    }

    $data['categories'] = [];
    $data['montant'] = [];
    $categories = '';
    $montant = '';
    for ($i = 1; $i <= $days; $i++) {

      strlen($i) == 2 ? $j = $i : $j = '0' . $i;

      if (empty($date)) {
        $req = 'date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="' . $year . '-' . $month . '-' . $j . '"';
      } else {
        $req = 'date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="' . $year . '-' . $date . '-' . $j . '"';
      }

      $datas = $this->model_rm->getRequeteOne('SELECT SUM(QUANTITE * PRIX) AS TOTAL,`DATE_CREATION_pos_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM ' . $tablename . '
    			WHERE ' . $req . '
    			GROUP BY date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")');

      $montant_st = 0;

      if ($storeMode) {

        foreach ($storeList as $st) {
          $m = $this->model_rm->getRequeteOne('SELECT SUM(PRIX * QUANTITE) AS TOTAL,`DATE_CREATION_pos_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM pos_ibi_commandes_produits
          WHERE ' . $req . '
          GROUP BY date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")')['TOTAL'];
          if ($m > 0) {
            $montant_st += $m;
          }
        }
      }



      $montant_st == '' ? $montant_st = 0 : $montant_st = $montant_st;
      $datas['TOTAL'] == '' ? $total = 0 : $total = $datas['TOTAL'];

      $totals = $montant_st + $total;

      $day = date('D', strtotime(date('Y-m-' . $j . '')));
      // var_dump($day);exit;

      array_push($data['categories'], $day . '-' . $j);
      array_push($data['montant'], (int)$totals);
    }


    echo json_encode($data);;
  }


  public function chart()
  {
    if (!$this->aauth->is_allowed('dashboard')) {
      redirect('/', 'refresh');
    }

    $data = [];
    $this->render('backend/standart/chart', $data);
  }


  public function getcat()
  {

    $data = [];

    $year = date('Y');
    $month = date('m');
    $date = $this->input->post('dateval');
    $store = $this->input->post('store');
    $storeList = $this->model_rm->getList('pos_ibi_stores', array('DELETE_STATUS_STORE' => 0));


    if (isset($store) and !empty($store)) {
      $tablename = 'pos_ibi_commandes_produits';
      $storeMode = false;
    } else {
      $tablename = 'pos_ibi_commandes_produits';
      $storeMode = true;
    }


    if (empty($date)) {
      $days = $this->days_in_month($month, $year);
    } else {
      $days = $this->days_in_month($date, $year);
    }

    $data['categories'] = [];
    $data['montant'] = [];
    $categories = '';
    $montant = '';
    for ($i = 1; $i <= $days; $i++) {

      strlen($i) == 2 ? $j = $i : $j = '0' . $i;

      if (empty($date)) {
        $req = 'date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="' . $year . '-' . $month . '-' . $j . '"';
      } else {
        $req = 'date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="' . $year . '-' . $date . '-' . $j . '"';
      }

      $datas = $this->model_rm->getRequeteOne('SELECT SUM(PRIX * QUANTITE) AS TOTAL,`DATE_CREATION_pos_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM ' . $tablename . '
          WHERE ' . $req . '
          GROUP BY date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")');

      $montant_st = 0;

      if ($storeMode) {

        foreach ($storeList as $st) {
          $m = $this->model_rm->getRequeteOne('SELECT SUM(PRIX * QUANTITE) AS TOTAL,`DATE_CREATION_pos_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM pos_ibi_commandes_produits
          WHERE ' . $req . '
          GROUP BY date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")')['TOTAL'];
          if ($m > 0) {
            $montant_st += $m;
          }
        }
      }



      $montant_st == '' ? $montant_st = 0 : $montant_st = $montant_st;
      $datas['TOTAL'] == '' ? $total = 0 : $total = $datas['TOTAL'];

      $totals = $montant_st + $total;

      $day = date('D', strtotime(date('Y-m-' . $j . '')));
      // var_dump($day);exit;

      array_push($data['categories'], $day . '-' . $j);
      array_push($data['montant'], (int)$totals);
    }


    echo json_encode($data);;
  }








  public function getcat_RESERVER()
  {


    $iterasi = $this->input->post('iterasi');
    $mois = $this->input->post('mois');
    $year = date('Y');
    $currentM = date('m');



    if (!empty($mois)) {

      $req = "AND date_format(C.DATE_CREATION_pos_IBI_COMMANDES, '%Y-%m')='" . $year . "-" . $mois . "'  ";
    } else {
      $req = "AND date_format(C.DATE_CREATION_pos_IBI_COMMANDES, '%Y-%m')='" . $year . "-" . $currentM . "'  ";
    }

    $aff_cat = "";
    $i = 1;
    $tableau_categories  = array('Attente' => '0', 'Payer' => '2', 'Avance' => '1', 'Complementaire' => '11', 'Credit' => '10');

    foreach ($tableau_categories as $key => $value) {

      $getsome1 = $this->Model_dashboard->getRequete("      
    SELECT P.REF_COMMAND_CODE AS COD, (P.PRIX * P.QUANTITE) AS PRIX, P.DISCOUNT_PERCENT AS PC FROM  pos_ibi_commandes C
      
      JOIN  pos_ibi_commandes_produits P ON P.REF_COMMAND_CODE= C.CODE
      JOIN pos_store_" . $iterasi . "_ibi_articles A ON A.CODEBAR_ARTICLE= P.REF_PRODUCT_CODEBAR WHERE  C.COMMANDE_STATUS=" . $value . " 

    ");
      $aff_cat .= '{"name": "' . $key . '","y": ' . $i++ . '},';
    }


    // $tableau_categories  = array('Attente'=>'0', 'Payer'=>'2','Avance'=>'1','Complementaire'=>'11', 'Credit'=>'10'); 
    // foreach ($tableau_categories as $key => $value) {
    //          $get_montant_cmd = $this->db->query("SELECT SUM(P.PRIX * QUANTITE) AS PRIX  FROM pos_ibi_commandes C INNER JOIN pos_ibi_commandes_produits P ON P.REF_COMMAND_CODE =C.CODE WHERE COMMANDE_STATUS = ".$value." ")->row_array();
    //        }

    $aff_cat .= '//';
    $aff_cat = str_replace(',//', '', $aff_cat);
    if ($aff_cat == '//') {
      echo  '[ ]';
    } else {


      echo  '[{"colorByPoint": true, "name": "Montant", "data":[' . $get_montant_cmd['PRIX'] . '] } ]';
    }
  }
  public function SommmeMothly_bs()
  {
    $month = $this->input->post('month');
    $year = date('Y');
    $encourMois = date('m');


    if (empty(!$month)) {
      $payement = $this->db->query("SELECT SUM(MONTANT_PAIEMENT) AS MONTANT FROM pos_paiements WHERE MONTH(DATE_CREATION_PAIEMENT) = " . $month . " AND TYPE_FACTURE != 4   ")->row_array();
      $Complementaire = $this->db->query("SELECT SUM(MONTANT_PAIEMENT) AS MONTANT FROM pos_paiements WHERE MONTH(DATE_CREATION_PAIEMENT) = " . $month . " AND TYPE_FACTURE = 4   ")->row_array();
      // var_dump($alls);exit;
    } else {
      $payement = $this->db->query("SELECT SUM(MONTANT_PAIEMENT) AS MONTANT FROM pos_paiements WHERE TYPE_FACTURE != 4 AND MONTH(DATE_CREATION_PAIEMENT) = " . $encourMois . "  ")->row_array();

      $Complementaire = $this->db->query("SELECT SUM(MONTANT_PAIEMENT) AS MONTANT FROM pos_paiements WHERE MONTH(DATE_CREATION_PAIEMENT) = " . $encourMois . " AND TYPE_FACTURE = 4 ")->row_array();
    }

    $compl = $Complementaire['MONTANT'];
    $paie_bs = $payement['MONTANT'];
    $num = "";
    $paiement = "";
    if (is_null($compl)) {
      $num = 0;
    } else {
      $num = $compl;
    }
    if (is_null($paie_bs)) {
      $paiement = 0;
    } else {
      $paiement = $paie_bs;
    }
    $datas['paie_bs'] = $paiement;
    $datas['complementaire_bs'] = $num;
    echo json_encode($datas);
  }








  public function get_all_chiffr_categorie()
  {

    $store = $this->input->post("store");

    $year = date('Y');
    $month = date('m');
    $date = $this->input->post('dateval');
    $store = $this->input->post('store');


    $tableau_categories  = array('Attente' => '0', 'Payer' => '2', 'Avance' => '1', 'Complementaire' => '11', 'Credit' => '10');
    $tablename = "";
    $month_good = "";
    if (empty($date)) {
      $month_good = $month;
    } else {
      $month_good = $date;
    }

    $name_all = "";
    $show = "";
    foreach ($tableau_categories as $key => $value) {

      $datas = $this->model_rm->getRequeteOne("SELECT SUM(P.PRIX * P.QUANTITE) AS PRIX  FROM pos_ibi_commandes C INNER JOIN pos_ibi_commandes_produits P ON P.REF_COMMAND_CODE =C.CODE WHERE MONTH(P.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS)= " . $month_good . " AND C.COMMANDE_STATUS =" . $value . " ");
      $APS = "";
      if (is_null($datas['PRIX'])) {
        $APS = 0;
      } else {
        $APS = $datas['PRIX'];
      }
      $show .= '{ "name": "' . $key . '" ,"y": ' . $APS . ', "drilldown":' . $value . '  },';
    }


    $shows = $show . '@';
    $shows = str_replace(',@', '', $show . '@');
    $response['afficher_categorie_somme'] = $shows;

    echo '[' . $shows . ']';
  }

  public function facture_non_payer()
  {
    $number = 10;
    $numbers = strval($number);

    $facture_nopayer = $this->model_rm->countrows('pos_ibi_commandes', array('COMMANDE_STATUS' => $numbers));
    $facture_payer = $this->model_rm->getRequete_num("SELECT * FROM pos_ibi_commandes WHERE COMMANDE_STATUS != 10  AND COMMANDE_STATUS != 0");


    $response['non_payer'] = $facture_nopayer;
    $response['payer'] = $facture_payer;

    echo json_encode($response);
  }




  public function best_product_ever()
  {


    $all_article = $this->db->query("SELECT DISTINCT(REF_PRODUCT_CODEBAR) FROM pos_ibi_commandes_produits ")->result();

    $total_art = "";
    foreach ($all_article as $article) {
      $get_cmd_produit = $this->db->query("SELECT SUM(PRIX * QUANTITE) AS TOTAL_BY_ARTICLE FROM pos_ibi_commandes_produits WHERE  REF_PRODUCT_CODEBAR != " . $article->REF_PRODUCT_CODEBAR . " ")->row_array();
      // var_dump($article->REF_PRODUCT_CODEBAR .":->: number ->".$get_cmd_produit['TOTAL_BY_ARTICLE']);

      $total_art .= "['" . $article->REF_PRODUCT_CODEBAR . "', " . $get_cmd_produit['TOTAL_BY_ARTICLE'] . "],";
    }

    $bs_all['afficher_best_somme'] = $total_art;
    echo json_encode($bs_all);
  }




  public function depense_recettes_bs()
  {

    $month = $this->input->post('month');
    $year = date('Y');
    $encourMois = date('m');

    if (empty(!$month)) {
      $get_recette = $this->db->query("SELECT SUM(PRIX * QUANTITE) AS TOTAL FROM pos_ibi_commandes_produits WHERE MONTH(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS) = '" . $month . "' ")->row_array();
    } else {
      $get_recette = $this->db->query("SELECT SUM(PRIX * QUANTITE) AS TOTAL FROM pos_ibi_commandes_produits WHERE MONTH(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS) = '" . $encourMois . "' ")->row_array();
    }
    $somme_recette = "";
    if (is_null($get_recette['TOTAL'])) {
      $somme_recette = 0;
    } else {
      $somme_recette = $get_recette['TOTAL'];
    }
    // print_r($somme_recette);exit;

    $categories_depenses = $this->db->query("SELECT * FROM pos_categorie_depense WHERE DELETE_STATUS_CATEGORIE_DEPENSE =0 ")->result();
    $categories = "";
    $somme = "";
    $ASP = "";




    foreach ($categories_depenses as $depense) {
      if (empty(!$month)) {
        $getSomme_by_depense = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS SOMMES FROM pos_depenses WHERE ID_CATEGORIE_DEPENSE = '" . $depense->ID_CATEGORIE_DEPENSE . "' AND MONTH(DATE_CREATE_DEPENSE) ='" . $month . "' ")->row_array();
      } else {

        $getSomme_by_depense = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS SOMMES FROM pos_depenses WHERE ID_CATEGORIE_DEPENSE = '" . $depense->ID_CATEGORIE_DEPENSE . "' AND MONTH(DATE_CREATE_DEPENSE) ='" . $encourMois . "' ")->row_array();
      }

      if (empty($getSomme_by_depense['SOMMES'])) {
        $ASP = 0;
      } else {
        $ASP = $getSomme_by_depense['SOMMES'];
      }
      // $somme .= "{name: '".$depense->NOM_CATEGORIE_DEPENSE."',data: [".$ASP."]},";
      $somme .= '["' . $depense->NOM_CATEGORIE_DEPENSE . '", ' . (int)$ASP . '],';

      $sommes = $somme . '@';
      $sommes = str_replace(',@', '', $somme . '@');

      $categories .= "'" . $depense->NOM_CATEGORIE_DEPENSE . "',";
      $categorie = $categories . '@';
      $categorie = str_replace(',@', '', $categories . '@');
    }

    $response['somme_recettes_view'] = round($somme_recette);
    $response['categorie_text'] = $categorie;
    $response['all_depense'] = '[' . $sommes . ']';

    echo json_encode($response);
  }


  public function caisse_depense_monthly()
  {

    $mois = $this->input->post('month');
    $encourMois = date('m');

    if (empty(!$mois)) {
      $get_sommes = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS SOMME_DEP FROM pos_depenses WHERE MONTH(DATE_CREATE_DEPENSE) = '" . $mois . "' AND ID_CATEGORIE_DEPENSE =4 ")->row_array();
    } else {

      $get_sommes = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS SOMME_DEP FROM pos_depenses WHERE MONTH(DATE_CREATE_DEPENSE) = '" . $encourMois . "' AND ID_CATEGORIE_DEPENSE =4 ")->row_array();
    }

    $ASPH = "";
    if (is_null($get_sommes['SOMME_DEP'])) {
      $ASPH = 0;
    } else {
      $ASPH = $get_sommes['SOMME_DEP'];
    }

    $response['sommes_total'] = (int)$ASPH;
    echo json_encode($response);
  }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/administrator/Dashboard.php */