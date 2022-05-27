<?php
defined('BASEPATH') OR exit('No direct script access allowed');


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
	}

	public function index()
	{
		if (!$this->aauth->is_allowed('dashboard')) {
			redirect('/','refresh');
		}
     
     $store=$this->uri->segment(4);



		//$data = [];
	  $data['janvier']=$this->Model_dashboard->Janvier();
      $data['fevrier']=$this->Model_dashboard->Fevrier();
      $data['mars']=$this->Model_dashboard->Mars();
      $data['avril']=$this->Model_dashboard->Avril();
      $data['mai']=$this->Model_dashboard->Mai();
      $data['juin']=$this->Model_dashboard->Juin();
      $data['juillet']=$this->Model_dashboard->Juillet();
      $data['aout']=$this->Model_dashboard->Aout();
      $data['septembre']=$this->Model_dashboard->Septembre();
      $data['octobre']=$this->Model_dashboard->Octobre();
      $data['novembre']=$this->Model_dashboard->Novembre();
      $data['decembre']=$this->Model_dashboard->Decembre();
      //Hospitalise avec bon de commande

      $data['janvier_h_b']=$this->Model_dashboard->Janvier_h_b();
      $data['fevrier_h_b']=$this->Model_dashboard->Fevrier_h_b();
      $data['mars_h_b']=$this->Model_dashboard->Mars_h_b();
      $data['avril_h_b']=$this->Model_dashboard->Avril_h_b();
      $data['mai_h_b']=$this->Model_dashboard->Mai_h_b();
      $data['juin_h_b']=$this->Model_dashboard->Juin_h_b();
      $data['juillet_h_b']=$this->Model_dashboard->Juillet_h_b();
      $data['aout_h_b']=$this->Model_dashboard->Aout_h_b();
      $data['septembre_h_b']=$this->Model_dashboard->Septembre_h_b();
      $data['octobre_h_b']=$this->Model_dashboard->Octobre_h_b();
      $data['novembre_h_b']=$this->Model_dashboard->Novembre_h_b();
      $data['decembre_h_b']=$this->Model_dashboard->Decembre_h_b();

      //Patients Ambulants
        $data['janvier_p']=$this->Model_dashboard->Janvier_p();
      $data['fevrier_p']=$this->Model_dashboard->Fevrier_p();
      $data['mars_p']=$this->Model_dashboard->Mars_p();
      $data['avril_p']=$this->Model_dashboard->Avril_p();
      $data['mai_p']=$this->Model_dashboard->Mai_p();
      $data['juin_p']=$this->Model_dashboard->Juin_p();
      $data['juillet_p']=$this->Model_dashboard->Juillet_p();
      $data['aout_p']=$this->Model_dashboard->Aout_p();
      $data['septembre_p']=$this->Model_dashboard->Septembre_p();
      $data['octobre_p']=$this->Model_dashboard->Octobre_p();
      $data['novembre_p']=$this->Model_dashboard->Novembre_p();
      $data['decembre_p']=$this->Model_dashboard->Decembre_p();
      //Ambulant Avec bon de commande
      $data['janvier_p_b']=$this->Model_dashboard->Janvier_p_b();
      $data['fevrier_p_b']=$this->Model_dashboard->Fevrier_p_b();
      $data['mars_p_b']=$this->Model_dashboard->Mars_p_b();
      $data['avril_p_b']=$this->Model_dashboard->Avril_p_b();
      $data['mai_p_b']=$this->Model_dashboard->Mai_p_b();
      $data['juin_p_b']=$this->Model_dashboard->Juin_p_b();
      $data['juillet_p_b']=$this->Model_dashboard->Juillet_p_b();
      $data['aout_p_b']=$this->Model_dashboard->Aout_p_b();
      $data['septembre_p_b']=$this->Model_dashboard->Septembre_p_b();
      $data['octobre_p_b']=$this->Model_dashboard->Octobre_p_b();
      $data['novembre_p_b']=$this->Model_dashboard->Novembre_p_b();
      $data['decembre_p_b']=$this->Model_dashboard->Decembre_p_b();


     if ($store !='') {
        $this->render('backend/standart/dashboard_store', $data);
     }else{
       $this->render('backend/standart/dashboard', $data);
     }
		
	}

	public function chart()
	{
		if (!$this->aauth->is_allowed('dashboard')) {
			redirect('/','refresh');
		}

		$data = [];
		$this->render('backend/standart/chart', $data);
	}

	public function Recuperer_date_preremption()
	{
	   $store_id = $_GET['store_id'];
        $query=$this->db->query('SELECT * FROM pos_store_'.$store_id.'_ibi_articles WHERE date_format(DATE_PEREMPTION,"%Y-%m") >=  date_format(curdate(),"%Y-%m")')->result();

       echo json_encode($query);
	}  

	public function Recuperer_stock_minimum()
	{
		 $store_id = $_GET['store_id'];
		 // $this->db->select('*');
		 // $this->db->from('pos_store_'.$store_id.'_ibi_articles');
		 // $this->db->where('QUANTITY_ARTICLE<=MINIMUM_QUANTITY_ARTICLE');
		 $query=$this->db->query('SELECT * FROM pos_store_'.$store_id.'_ibi_articles WHERE QUANTITY_ARTICLE <= MINIMUM_QUANTITY_ARTICLE')->result();
		 $requete=$query;
		 echo json_encode($requete);
	}

  public function Recuperer_stock_minimum_compte()
  {
       $store_id = $_GET['store_id'];
     // $this->db->select('*');
     // $this->db->from('pos_store_'.$store_id.'_ibi_articles');
     // $this->db->where('QUANTITY_ARTICLE<=MINIMUM_QUANTITY_ARTICLE');
     $query=$this->db->query('SELECT COUNT(*) AS Min FROM pos_store_'.$store_id.'_ibi_articles WHERE QUANTITY_ARTICLE <= MINIMUM_QUANTITY_ARTICLE')->row();
     $requete=$query->Min;
     echo json_encode($requete);
  }

  public function Recuperer_date_preremption_compte()
  {
     $store_id = $_GET['store_id'];
        $query=$this->db->query('SELECT COUNT(*) as Dt FROM pos_store_'.$store_id.'_ibi_articles WHERE date_format(DATE_PEREMPTION,"%Y-%m") >=  date_format(curdate(),"%Y-%m")')->row();
         echo json_encode($query->Dt);
  }

	public function highchart()
	{

     	  // $store_id = $_GET['store_id'];
       $data=$this->db->get('pos_store_1_ibi_categories')->result();
       echo json_encode($data);

     // $data['highchart']=$this->Model_dashboard->highchart();
      // $data['janvier']=$this->Model_dashboard->Janvier();
      // $data['fevrier']=$this->Model_dashboard->Fevrier();
      // $data['mars']=$this->Model_dashboard->Mars();
      // $data['avril']=$this->Model_dashboard->Avril();
      // $data['mai']=$this->Model_dashboard->Mai();
      // $data['juin']=$this->Model_dashboard->Juin();
      // $data['juillet']=$this->Model_dashboard->Juillet();
      // $data['aout']=$this->Model_dashboard->Aout();
      // $data['septembre']=$this->Model_dashboard->Septembre();
      // $data['octobre']=$this->Model_dashboard->Octobre();
      // $data['novembre']=$this->Model_dashboard->Novembre();
      // $data['decembre']=$this->Model_dashboard->Decembre();

      //Patient ambulant sans bon de commande
      // $data['janvier_p']=$this->Model_dashboard->Janvier_p();
      // $data['fevrier_p']=$this->Model_dashboard->Fevrier_p();
      // $data['mars_p']=$this->Model_dashboard->Mars_p();
      // $data['avril_p']=$this->Model_dashboard->Avril_p();
      // $data['mai_p']=$this->Model_dashboard->Mai_p();
      // $data['juin_p']=$this->Model_dashboard->Juin_p();
      // $data['juillet_p']=$this->Model_dashboard->Juillet_p();
      // $data['aout_p']=$this->Model_dashboard->Aout_p();
      // $data['septembre_p']=$this->Model_dashboard->Septembre_p();
      // $data['octobre_p']=$this->Model_dashboard->Octobre_p();
      // $data['novembre_p']=$this->Model_dashboard->Novembre_p();
      // $data['decembre_p']=$this->Model_dashboard->Decembre_p();
      /////////////////////

      // $data['janvier_p_b']=$this->Model_dashboard->Janvier_h_b();
      // $data['fevrier_p_b']=$this->Model_dashboard->Fevrier_h_b();
      // $data['mars_p_b']=$this->Model_dashboard->Mars_h_b();
      // $data['avril_p_b']=$this->Model_dashboard->Avril_h_b();
      // $data['mai_p_b']=$this->Model_dashboard->Mai_h_b();
      // $data['juin_p_b']=$this->Model_dashboard->Juin_h_b();
      // $data['juillet_p_b']=$this->Model_dashboard->Juillet_h_b();
      // $data['aout_p_b']=$this->Model_dashboard->Aout_h_b();
      // $data['septembre_p_b']=$this->Model_dashboard->Septembre_h_b();
      // $data['octobre_p_b']=$this->Model_dashboard->Octobre_h_b();
      // $data['novembre_p_b']=$this->Model_dashboard->Novembre_h_b();
      // $data['decembre_p_b']=$this->Model_dashboard->Decembre_h_b();

      // echo json_encode($data);		
	}

public function getcat()
  {


    $iterasi = $this->input->post('iterasi');
    $mois = $this->input->post('mois');
    $year = date('Y');


    if (!empty($mois)) {

      $req = "AND date_format(F.DATE_CREATION_FACTURE, '%Y-%m')='" . $year . "-0" . $mois . "'  ";
    } else {
      $req = " AND date_format(F.DATE_CREATION_FACTURE, '%Y')= '" . $year . "' ";
    }

    $aff_cat = "";
    $namecat = $this->Model_dashboard->getList("pos_store_".$iterasi."_ibi_categories");
    foreach ($namecat as $key => $value) {

      $getsome1 = $this->Model_dashboard->getRequete("      
      SELECT P.REF_COMMAND_CODE AS COD, P.PRIX_TOTAL AS PRIX, P.DISCOUNT_AMOUNT AS M, P.DISCOUNT_PERCENT AS PC FROM `factures` F 
JOIN pos_store_" . $iterasi . "_ibi_commandes C ON C.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES= F.PATIENT_FILE_ID_FACTURE 
JOIN  pos_store_" . $iterasi . "_ibi_commandes_produits P ON P.REF_COMMAND_CODE= C.CODE
JOIN pos_store_" . $iterasi . "_ibi_articles A ON A.CODEBAR_ARTICLE= P.REF_PRODUCT_CODEBAR WHERE F.STATUS_FACTURE=0 AND F.STORE_ID_FACTURE=" . $iterasi . " AND A.REF_CATEGORIE_ARTICLE=" . $value['ID_CATEGORIE'] . "  

    ");


      $some1 = 0;
      foreach ($getsome1 as $keys) {
        $some1 += $keys['PRIX'] - ($keys['M'] + $keys['PC']);
      }


      // $getsome2 = $this->model_dashboard->getRequete(" SELECT P.PRIX_TOTAL_PROFORMA_PROD AS PRIX , P.DISCOUNT_AMOUNT_PROFORMA_PROD AS M, P.DISCOUNT_PERCENT_PROFORMA_PROD AS PC FROM `pos_ibi_facture` F JOIN  pos_store_" . $iterasi . "_ibi_proforma_produits P ON P.REF_PROFORMA_CODE_PROD= F.REF_CODE_COMMAND_FACTURE JOIN pos_store_" . $iterasi . "_ibi_articles A ON A.CODEBAR_ARTICLE= P.REF_PRODUCT_CODEBAR_PROFORMA_PROD WHERE  F.STATUT_FACTURE=0 AND F.STORE_BY_FACTURE=" . $iterasi . " AND  F.TYPE_FACTURE='is_proforma' " . $req . " AND A.REF_CATEGORIE_ARTICLE=" . $value['ID_FAMILLE'] . " ");

      // $some2 = 0;
      // foreach ($getsome2 as $keys) {
      //   $some2 += $keys['PRIX'] - ($keys['M'] + $keys['PC']);
      // }

      // $SOM = $some1 + $some2;
      $SOM = $some1;
      if ($SOM != 0) {

        $aff_cat .= '{"name": "' . $value['NOM_CATEGORIE'] . '","y": ' . $SOM . '},';
      }
    }

    $aff_cat .= '//';
    $aff_cat = str_replace(',//', '', $aff_cat);
    if ($aff_cat == '//') {
      echo  '[{"colorByPoint": true, "name": "Montant", "data":[{"name": "empty", "y":0}] } ]';
    } else {
      echo  '[{"colorByPoint": true, "name": "Montant", "data":[' . $aff_cat . '] } ]';
    }
  }


  
  public function getService(){
    $year=date('Y');
    $month=date('m');
    $date=$this->input->post('dateval');

        if (empty($date)) {
          $req='AND date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m")="'.$year.'-'.$month.'"';
        }else{
          $req='AND date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m")="'.$year.'-'.$date.'"';
        }

        $datachiffre='';
      $dep=$this->Model_dashboard->getList('departements');
      foreach ($dep as $key) {
       $montant=$this->Model_dashboard->getRequeteOne('SELECT sum(PRIX_TOTAL) AS TOTAL FROM hospital_ibi_commandes_produits WHERE DEPARTMENT='.$key['ID_DEPARTEMENT'].' '.$req.' ')['TOTAL'];  
       if ($montant=='') {
        $montant=0;
       }
         $datachiffre.='["'.$key['DESIGNATION_DEPARTEMENT'].'", '.$montant.'],';
      
      }

    $datachiffre .= '//';
        $datachiffre = str_replace(',//', '', $datachiffre);
        echo '['.$datachiffre.']';
  }


  public function getAssurance(){

        $year=date('Y');
    $month=date('m');
    $date=$this->input->post('dateval');
         if (empty($date)) {
          $req='AND date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m")="'.$year.'-'.$month.'"';
        }else{
          $req='AND date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m")="'.$year.'-'.$date.'"';
        }

        $dataAssurance=$this->Model_dashboard->getRequete('SELECT DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, DISCOUNT_PERCENT, PRIX_TOTAL,REF_COMMAND_CODE,NOM_SOCIETE,ID_SOCIETE,
      SUM(DISCOUNT_PERCENT*PRIX_TOTAL/100) AS VAL
      FROM hospital_ibi_commandes_produits CP
      LEFT JOIN hospital_ibi_commandes C ON CP.REF_COMMAND_CODE=C.CODE
      LEFT JOIN patient_file PF ON C.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES=PF.PATIENT_FILE_ID
      LEFT JOIN hospital_ibi_societes S ON S.ID_SOCIETE=PF.REF_SOCIETE
      WHERE PF.REF_SOCIETE!=0 '.$req.'
      GROUP BY S.ID_SOCIETE');

        $concat='';
        foreach ($dataAssurance as $key) {
          $concat.='{"name": "'.$key['NOM_SOCIETE'].'", "y": '.$key['VAL'].' },';
        }
        $concat.='//';
        $concat = str_replace(',//', '', $concat);
        if (count($dataAssurance)) {
          echo '['.$concat.']';
        }else{
          echo '[]';  
        }
  }



  public function days_in_month($month, $year)
  {
   return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
  }

     public function getChiffreJ(){


        $data=[];
       
    $year=date('Y');
    $month=date('m');
    $date=$this->input->post('dateval');
        
        if (empty($date)) {
          $days=$this->days_in_month($month,$year);
        }else{
          $days=$this->days_in_month($date,$year);
        }

        $data['categories']=[];
         $data['montant']=[];
        $categories='';
        $montant='';
        for ($i=1; $i <=$days ; $i++) { 

         strlen($i)==2? $j=$i : $j='0'.$i;

         if (empty($date)) {
          $req='date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="'.$year.'-'.$month.'-'.$j.'"';
        }else{
          $req='date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="'.$year.'-'.$date.'-'.$j.'"';
        }

         $datas=$this->Model_dashboard->getRequeteOne('SELECT SUM(PRIX_TOTAL) AS TOTAL,`DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM `hospital_ibi_commandes_produits`
      WHERE '.$req.'
      GROUP BY date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")');

         $datas['TOTAL']==''? $total=0 : $total=$datas['TOTAL'];

         $day = date('D', strtotime(date('Y-m-'.$j.'')));
         
         array_push($data['categories'], $day.'-'.$j);
         array_push($data['montant'], (int)$total);

        
        }
        

        echo json_encode($data); ;
  }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/administrator/Dashboard.php */