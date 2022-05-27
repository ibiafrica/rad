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
		$this->load->model('model_rm');
    $this->load->model('Model_dashboard');
	}


	public function index()
	{

    $store=$this->uri->segment(2);
    if (!$this->aauth->is_allowed('dashboard')) {
      redirect('/','refresh');
    }
         
    $year=date('Y');
    $month_now=date('m');
    $date_now =date('Y-m-d');


   $statut_manuel = array('reservation' => 1,'checkin'=>2,'checkout'=>3);
   $checking_store = $this->db->get_where('pos_ibi_stores',['ID_STORE'=>$store])->row_array();
   
   if(!is_null($checking_store)){
      $all_article = $this->db->query("SELECT DISTINCT(REF_PRODUCT_CODEBAR), COUNT(*) AS COUNT_ARTICLE FROM pos_ibi_commandes_produits WHERE REF_PRODUCT_CODEBAR != '' AND STORE_ID_pos_IBI_COMMANDES_PRODUITS = ".$store." GROUP BY REF_PRODUCT_CODEBAR ORDER BY  COUNT_ARTICLE DESC LIMIT 10")->result();
   }else{
     $all_article = $this->db->query("SELECT DISTINCT(REF_PRODUCT_CODEBAR), COUNT(*) AS COUNT_ARTICLE, NAME_PRODUIT AS DESIGNATION FROM pos_ibi_commandes_produits WHERE REF_PRODUCT_CODEBAR != ''  GROUP BY REF_PRODUCT_CODEBAR ORDER BY  COUNT_ARTICLE DESC LIMIT 10")->result();

   }

   $total_art ="";
   $numbers_ = 0;
   $article_s = "";
   $montant ="";
   
   $article_par_boutique = "";
               
    foreach ($all_article as $article) {
    if(!is_null($checking_store)){
       $Q = $this->db->query("SELECT * FROM pos_store_".$store."_ibi_articles WHERE CODEBAR_ARTICLE = '".$article->REF_PRODUCT_CODEBAR."' ")->row_array();
         if(empty($article->COUNT_ARTICLE)){$numbers_ = 0;}else{$numbers_ = $article->COUNT_ARTICLE;}

           $total_art.="['".$Q['DESIGN_ARTICLE']."', ".$numbers_."],"; 
           $article_s .='"'.$Q['DESIGN_ARTICLE'].'",';
           $montant .=$numbers_.",";

           $article_par_boutique .= ' {
                    name: "'.$Q['DESIGN_ARTICLE'].'",
                    y: '.$numbers_.',
                    drilldown: "'.$Q['DESIGN_ARTICLE'].'"
                },
               ';

            }else{
              $Q = $this->db->query("SELECT * FROM pos_store_1_ibi_articles   WHERE CODEBAR_ARTICLE = '".$article->REF_PRODUCT_CODEBAR."' ")->row_array();
                if(empty($article->COUNT_ARTICLE)){$numbers_ = 0;}else{$numbers_ = $article->COUNT_ARTICLE;}

                 $total_art.="['".$article->DESIGNATION."', ".$numbers_."],"; 
                 $article_s .='"'.$article->DESIGNATION.'",';
                 $montant .=$numbers_.",";
            }
        }


      $month_depense_recette = array('Janvier' =>'01', 'Février'=>'02', 'Mars'=>'03', 'Avril'=>'04', 'Mai'=>'05', 'Juin'=>'06', 'Juillet'=>'07', 'Août'=>'08', 'Septembre'=>'09', 'Octobre'=>'10', 'Novembre'=>'11', 'Décembre'=>'12'); 
       $recette_tt = "";

       $tot_rec ="";
       $mois ="";
       $year = date('Y');
        $total_depense =0;
        $rec_bs ="";
       $depense_rec = "";
       foreach ($month_depense_recette as $key => $value) {

         
          $chiffres_depenser = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS TOT_DEPENSE FROM pos_depenses WHERE MONTH(DATE_CREATE_DEPENSE) = '".$value."' AND YEAR(DATE_CREATE_DEPENSE) = '".$year."' AND ID_APPROVISIONNEMENT IS NULL AND ID_REQUISITION IS NULL ")->row_array();

          $chiffres_recette = $this->db->query("SELECT SUM( PRIX_VENDU*QUANTITE ) AS TOT_REC FROM pos_ibi_commandes_produits WHERE MONTH(DATE_COMMANDE_PRODUITS) = ".$value." AND YEAR(DATE_COMMANDE_PRODUITS) = ".$year." ")->row_array();

          (is_null($chiffres_recette['TOT_REC']))?$tot_rec = 0 :$tot_rec = $chiffres_recette['TOT_REC'];
        (empty($chiffres_depenser['TOT_DEPENSE']))?$total_depense = 0 : $total_depense = $chiffres_depenser['TOT_DEPENSE'];

           $recette_tt .= $tot_rec.",";
           $depense_rec.= $total_depense.",";
           $mois.= '"'.$key.'",';
       
           
       }


    $mode_paie =$this->db->get_where('mode_paiement')->result();
    $counter_md_paie ="";
    foreach ($mode_paie as $mode) {
       $count_paie = $this->db->query("SELECT * FROM pos_paiements WHERE MODE_PAIEMENT = '".$mode->ID_MODE_PAIEMENT."' ")->num_rows();
        $counter_md_paie .="['".$mode->DESIGNATION_PAIEMENT_MODE."', ".$count_paie."],"; 

    }
   $statusFact="";
   $statutPaie = array('Attente' => 0,'Payer'=>2,'Avance'=>1,'Complementaire'=>11,'Credit'=>10);
   foreach($statutPaie as $stat => $key){
           $countCmd = $this->db->query("SELECT * FROM pos_ibi_commandes WHERE COMMANDE_STATUS = '".$key."' ")->num_rows();

          $statusFact.="['".$stat."', ".number_format($countCmd)."],";
   }
         
         // echo "<pre>"; print_r($article_par_boutiques);
   // exit;
      
       
      $get_bs['mode_paiement']=$counter_md_paie;
     
      $get_bs['status_facture']=$statusFact;
      $get_bs['month'] = $mois;
      $get_bs['depense_par_mois'] = $depense_rec;
      $get_bs['recette_toute'] = $recette_tt;

      $get_bs['article_par_boutique'] =$article_par_boutique;
      $get_bs['montants__'] = $montant;
      $get_bs['articles__'] = $article_s;

      $get_bs['afficher_best_somme'] =$total_art;

      
     if (is_null($checking_store)) {
       $this->render('backend/standart/dashboard_chart',$get_bs);
     }else{
       $this->render('backend/standart/dashboard_store',$get_bs);
       
     }

		
	}


	public function getService(){
		$year=date('Y');
		$month=date('m');
		$date=$this->input->post('dateval');

    $storeList=$this->model_rm->getList('pos_ibi_stores', array('DELETE_STATUS_STORE'=>0));

       if (empty($date)) {
        	$req='AND date_format(P.DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m")="'.$year.'-'.$month.'"';
        }else{
          $req='AND date_format(P.DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m")="'.$year.'-'.$date.'"';
        }

      $datachiffre='';
	    $dep=$this->model_rm->getList('departements', array('DELETED_STATUS_DEPARTEMENTS'=>0));
	    foreach ($dep as $key) {

       $montant=$this->model_rm->getRequeteOne('SELECT SUM(P.PRIX_VENDU*P.QUANTITE) AS TOTAL, A.DESIGNATION, D.DESIGNATION_DEPARTEMENT, P.DATE_CREATION_POS_IBI_COMMANDES_PRODUITS
          FROM pos_ibi_commandes_produits P
          JOIN actes_categorie A ON A.ID_ACTES_CATEGORIE=P.DEPARTMENT
          JOIN departements D ON D.ID_DEPARTEMENT=A.DEPARTEMENTS
          WHERE D.ID_DEPARTEMENT='.$key['ID_DEPARTEMENT'].' 
          '.$req.'
          GROUP BY D.ID_DEPARTEMENT')['TOTAL'];
      
       $montant_st=0;
       foreach ($storeList as $st) {
         $m=$this->model_rm->getRequeteOne('SELECT SUM(P.PRIX_VENDU*P.QUANTITE) AS TOTAL, A.DESIGNATION, D.DESIGNATION_DEPARTEMENT, P.DATE_CREATION_POS_IBI_COMMANDES_PRODUITS
          FROM pos_ibi_commandes_produits P
          JOIN actes_categorie A ON A.ID_ACTES_CATEGORIE=P.DEPARTMENT
          JOIN departements D ON D.ID_DEPARTEMENT=A.DEPARTEMENTS
          WHERE D.ID_DEPARTEMENT='.$key['ID_DEPARTEMENT'].' 
          '.$req.'
          GROUP BY D.ID_DEPARTEMENT')['TOTAL'];

        
         if ($m>0) {
           $montant_st+=$m;
         }
         
       }
 
	     if ($montant=='') {
	     	$montant=0;
	     }
        $montants=$montant+$montant_st;
         $datachiffre.='["'.$key['DESIGNATION_DEPARTEMENT'].'", '.$montants.'],';
	    
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
        	$req='AND date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m")="'.$year.'-'.$month.'"';
        }else{
          $req='AND date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m")="'.$year.'-'.$date.'"';
        }

        $dataAssurance=$this->model_rm->getRequete('SELECT DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, DISCOUNT_PERCENT, PRIX_VENDU*QUANTITE,REF_COMMAND_CODE,NOM_SOCIETE,ID_SOCIETE,
			SUM(DISCOUNT_PERCENT*PRIX_VENDU*QUANTITE/100) AS VAL
			FROM pos_ibi_commandes_produits CP
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


  public function facturation_statut(){
    $monthSelect=$this->input->post('date_value');
    $month=$monthSelect;
    if(empty($monthSelect)){
       $month=date('m');
    }


   $statusFact="";
   $statutPaie = array('Attente' => 0,'Payer'=>2,'Avance'=>1,'Complementaire'=>11,'Credit'=>10);
   foreach($statutPaie as $stat => $key){
           $countCmd = $this->db->query("SELECT * FROM pos_ibi_commandes WHERE COMMANDE_STATUS = '".$key."' AND MONTH(DATE_CREATION_pos_IBI_COMMANDES) = ".$month." ")->num_rows();

          $statusFact.='["'.$stat.'", '.number_format($countCmd).'],';
   }

   $statusFact=$statusFact."//";
   $statusFact=str_replace(",//", "", $statusFact);
   echo ("[".$statusFact."]");
          
   
  }

     public function getChiffreJ(){


        $data=[];
       
    		$year=date('Y');
    		$month=date('m');
    		$date=$this->input->post('dateval');
        $store=$this->input->post('store');
        $storeList=$this->model_rm->getList('pos_ibi_stores', array('DELETE_STATUS_STORE'=>0));

        
        if (isset($store) AND !empty($store)) {
          $tablename='pos_ibi_commandes_produits';
          $storeMode=false;
        
        }else{
          $tablename='pos_ibi_commandes_produits';
          $storeMode=true;
        }
        
        
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
        	$req='date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="'.$year.'-'.$month.'-'.$j.'"';
        }else{
          $req='date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="'.$year.'-'.$date.'-'.$j.'"';
        }

         $datas=$this->model_rm->getRequeteOne('SELECT SUM(QUANTITE*PRIX_VENDU) AS TOTAL,`DATE_CREATION_POS_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM '.$tablename.'
    			WHERE '.$req.'
    			GROUP BY date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")');

        $montant_st=0;

        if ($storeMode) {

         foreach ($storeList as $st) {
         $m=$this->model_rm->getRequeteOne('SELECT SUM(QUANTITE*PRIX_VENDU) AS TOTAL,`DATE_CREATION_POS_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM pos_ibi_commandes_produits
          WHERE '.$req.'
          GROUP BY date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")')['TOTAL'];
         if ($m>0) {
           $montant_st+=$m;
         }
         
       }

       }
       
       
         if(empty($datas['TOTAL'])){$TOTAL_CONVERT = 0;}else{$TOTAL_CONVERT =$datas['TOTAL'];}

     
         $montant_st==''? $montant_st=0 : $montant_st=$montant_st;
         $TOTAL_CONVERT==''? $total=0 : $total=$datas['TOTAL'];

         $totals=$montant_st+$total;

         $day = date('D', strtotime(date('Y-m-'.$j.'')));
         
         array_push($data['categories'], $day.'-'.$j);
         array_push($data['montant'], (int)$totals);

        
        }
        

        echo json_encode($data); ;
	}


	public function chart()
	{
		if (!$this->aauth->is_allowed('dashboard')) {
			redirect('/','refresh');
		}

		$data = [];
		$this->render('backend/standart/chart', $data);
	}


 public function getcat(){

   $data=[];
       
        $year=date('Y');
        $month=date('m');
        $date=$this->input->post('dateval');
        $store=$this->input->post('store');
        $storeList=$this->model_rm->getList('pos_ibi_stores', array('DELETE_STATUS_STORE'=>0));

        
        if (isset($store) AND !empty($store)) {
          $tablename='pos_ibi_commandes_produits';
          $storeMode=false;
        
        }else{
          $tablename='pos_ibi_commandes_produits';
          $storeMode=true;
        }
        
        
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
          $req='date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="'.$year.'-'.$month.'-'.$j.'"';
        }else{
          $req='date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="'.$year.'-'.$date.'-'.$j.'"';
        }

         $datas=$this->model_rm->getRequeteOne('SELECT SUM(PRIX_VENDU*QUANTITE) AS TOTAL,`DATE_CREATION_POS_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM '.$tablename.'
          WHERE '.$req.'
          GROUP BY date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")');

        $montant_st=0;

        if ($storeMode) {

         foreach ($storeList as $st) {
         $m=$this->model_rm->getRequeteOne('SELECT SUM(PRIX_VENDU*QUANTITE) AS TOTAL,`DATE_CREATION_POS_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM pos_ibi_commandes_produits
          WHERE '.$req.'
          GROUP BY date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")')['TOTAL'];
         if ($m>0) {
           $montant_st+=$m;
         }
         
       }

       }
       
       

         $montant_st==''? $montant_st=0 : $montant_st=$montant_st;
         $datas['TOTAL']==''? $total=0 : $total=$datas['TOTAL'];

         $totals=$montant_st+$total;

         $day = date('D', strtotime(date('Y-m-'.$j.'')));         
         array_push($data['categories'], $day.'-'.$j);
         array_push($data['montant'], (int)$totals);

        
        }
        

        echo json_encode($data); ;


}








  public function getcat_RESERVER()
  {


    $iterasi = $this->input->post('iterasi');
    $mois = $this->input->post('mois');
    $year = date('Y');
    $currentM=date('m');



    if (!empty($mois)) {

      $req = "AND date_format(C.DATE_CREATION_pos_IBI_COMMANDES, '%Y-%m')='".$year."-".$mois."'  ";
    } else {
      $req = "AND date_format(C.DATE_CREATION_pos_IBI_COMMANDES, '%Y-%m')='".$year."-".$currentM."'  ";
    }

    $aff_cat = "";
    $i=1;
    $tableau_categories  = array('Attente'=>'0', 'Payer'=>'2','Avance'=>'1','Complementaire'=>'11', 'Credit'=>'10'); 
    
    foreach ($tableau_categories as $key => $value) {

    $getsome1 = $this->Model_dashboard->getRequete("      
    SELECT P.REF_COMMAND_CODE AS COD, P.PRIX_VENDU*P.QUANTITE AS PRIX, P.DISCOUNT_PERCENT AS PC FROM  pos_ibi_commandes C
      
      JOIN  pos_ibi_commandes_produits P ON P.REF_COMMAND_CODE= C.CODE
      JOIN pos_store_" . $iterasi."_ibi_articles A ON A.CODEBAR_ARTICLE= P.REF_PRODUCT_CODEBAR WHERE  C.COMMANDE_STATUS=" . $value . " 

    ");     
        $aff_cat .= '{"name": "' . $key . '","y": ' . $i++ . '},';
    }

    

    $aff_cat .= '//';
    $aff_cat = str_replace(',//', '', $aff_cat);
    if ($aff_cat == '//') {
      echo  '[ ]';
    } else {
      

      echo  '[{"colorByPoint": true, "name": "Montant", "data":[' . $get_montant_cmd['PRIX_VENDU'] . '] } ]';
      }
    
  }
  public function SommmeMothly_bs(){
     $month = $this->input->post('month');
     $year = date('Y');
     $encourMois = date('m');


     if(empty(!$month)){
         $payement = $this->db->query("SELECT SUM(MONTANT_PAIEMENT) AS MONTANT FROM pos_paiements WHERE MONTH(DATE_CREATION_PAIEMENT) = ".$month." AND TYPE_FACTURE != 4   ")->row_array();
          $Complementaire = $this->db->query("SELECT SUM(MONTANT_PAIEMENT) AS MONTANT FROM pos_paiements WHERE MONTH(DATE_CREATION_PAIEMENT) = ".$month." AND TYPE_FACTURE = 4   ")->row_array();
         // var_dump($alls);exit;
      }
      else{
           $payement = $this->db->query("SELECT SUM(MONTANT_PAIEMENT) AS MONTANT FROM pos_paiements WHERE TYPE_FACTURE != 4 AND MONTH(DATE_CREATION_PAIEMENT) = ".$encourMois."  ")->row_array();

           $Complementaire = $this->db->query("SELECT SUM(MONTANT_PAIEMENT) AS MONTANT FROM pos_paiements WHERE MONTH(DATE_CREATION_PAIEMENT) = ".$encourMois." AND TYPE_FACTURE = 4 ")->row_array();
        
      }

      $compl = $Complementaire['MONTANT'];
      $paie_bs =$payement['MONTANT'];
       $num ="";
       $paiement = "";
       if(is_null($compl)){ $num = 0;}else{ $num = $compl;}
       if(is_null($paie_bs)){$paiement = 0;} else{ $paiement = $paie_bs;}
       $datas['paie_bs'] = $paiement;
       $datas['complementaire_bs'] = $num;
        echo json_encode($datas);

  }








  public function meilleurs_produit_vendu(){

  
     $store = $this->input->post("store");

        $year=date('Y');
        $month=date('m');
        $date=$this->input->post('dateval');
        $store=$this->input->post('store');

      $month_good ="";
     if(empty($date)){
        $month_good =$month;
       }
       else{
        $month_good = $date;
       }

     $articles = $this->db->query("SELECT DISTINCT(REF_PRODUCT_CODEBAR), COUNT(*) AS COUNT_ARTICLE ,NAME_PRODUIT AS DESIGNATION FROM pos_ibi_commandes_produits WHERE REF_PRODUCT_CODEBAR != '' AND STORE_ID_pos_IBI_COMMANDES_PRODUITS = ".$store." AND MONTH(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS) = '".$month_good."'  GROUP BY REF_PRODUCT_CODEBAR ORDER BY  COUNT_ARTICLE DESC LIMIT 10")->result();
                 

    $tablename ="";
    
    $name_all="";
    $data = "";
    foreach ($articles as $value) {
      
          $counter_number = "";
          if(is_null($value->COUNT_ARTICLE)){
            $counter_number =0;
          }
          else{
            $counter_number = $value->COUNT_ARTICLE;
          }
          $data.='{"name":"'.$value->DESIGNATION.'","y":'.$counter_number.',"drilldown":"'.$value->DESIGNATION.'"},';

        }
        $data.='a';
        $data=str_replace(",a", "", $data);
        ($data == 'a') ? $article_vendu = " " : $article_vendu = $data;
        
         
        echo ' ['.$article_vendu.'] ';
        
           

  }

  public function facture_non_payer(){
     $number =10;
     $numbers = strval($number);

     $facture_nopayer = $this->model_rm->countrows('pos_ibi_commandes', array('COMMANDE_STATUS' => $numbers));
     $facture_payer = $this->model_rm->getRequete_num("SELECT * FROM pos_ibi_commandes WHERE COMMANDE_STATUS != 10  AND COMMANDE_STATUS != 0");


     $response['non_payer'] =$facture_nopayer;
     $response['payer'] =$facture_payer;

     echo json_encode($response);

  }


  public function meilleurs_produit_recu(){

   $store =$this->input->post('store');
   $mois = $this->input->post('dateval');
   $annee = date('Y');
   (empty($mois)) ? $mois_mises = date('m') : $mois_mises =$mois;  

   $all_article = $this->db->query("SELECT DISTINCT(REF_ARTICLE_BARCODE_SF), COUNT(*) AS COUNT_ARTICLE FROM pos_store_".$store."_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF != '' AND  MONTH(DATE_CREATION_SF) = '".$mois_mises."'  AND YEAR(DATE_CREATION_SF) = '".$annee."' AND TYPE_SF ='transfert_in' OR 'stock_' GROUP BY REF_ARTICLE_BARCODE_SF ORDER BY  COUNT_ARTICLE DESC LIMIT 10")->result();

     
    $articles_flow ="";
    $counter = "";
    $qte_flows = "";
    foreach ($all_article as $article) {
       (empty($article->COUNT_ARTICLE)) ? $numbers_ = 0 : $numbers_ = $article->COUNT_ARTICLE;
       $article_name = $this->db->get_where('pos_store_'.$store.'_ibi_articles',['CODEBAR_ARTICLE'=>$article->REF_ARTICLE_BARCODE_SF])->row_array();
        
       $getQte = $this->db->query("SELECT SUM(QUANTITE_SF) AS QTE_FLOW FROM pos_store_".$store."_ibi_articles_stock_flow WHERE MONTH(DATE_CREATION_SF) = '".$mois_mises."'  AND YEAR(DATE_CREATION_SF) = '".$annee."' AND REF_ARTICLE_BARCODE_SF = '".$article->REF_ARTICLE_BARCODE_SF."' AND TYPE_SF ='transfert_in' OR 'stock_' ")->row_array();

        (empty($getQte['QTE_FLOW'])) ? $qte_flows = 0 : $qte_flows = $getQte['QTE_FLOW'];

        $articles_flow.='{"name": "'.$article_name['DESIGN_ARTICLE'].'" ,"y": '.$qte_flows.', "drilldown":"'.$article_name['DESIGN_ARTICLE'].'"  },';

        }

     $articles_flows=$articles_flow.'@';
     $articles_flows=str_replace(',@','', $articles_flow.'@');
     ($articles_flows=="@") ? $article_recu = "" : $article_recu = $articles_flows;
     echo ' ['.$article_recu.'] ';
  }


  public function depense_recettes_bs(){
     
     $month = $this->input->post('month');
     $year = date('Y');
     $encourMois = date('m');

        if(empty(!$month)){
            $get_recette = $this->db->query("SELECT SUM(PRIX_VENDU*QUANTITE) AS TOTAL FROM pos_ibi_commandes_produits WHERE MONTH(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS) = '".$month."' ")->row_array();
          } 
          else{
            $get_recette = $this->db->query("SELECT SUM(PRIX_VENDU*QUANTITE) AS TOTAL FROM pos_ibi_commandes_produits WHERE MONTH(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS) = '".$encourMois."' ")->row_array();
          }
        $somme_recette="";
      if (is_null($get_recette['TOTAL'])) {
          $somme_recette = 0;
      }

      else{
        $somme_recette = $get_recette['TOTAL'];
      }

     $categories_depenses = $this->db->query("SELECT * FROM pos_categorie_depense WHERE DELETE_STATUS_CATEGORIE_DEPENSE =0 ")->result();
     $categories ="";
     $somme ="";
     $ASP = "";

     foreach ($categories_depenses as $depense) {
          if(empty(!$month)){
              $getSomme_by_depense = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS SOMMES FROM pos_depenses WHERE ID_CATEGORIE_DEPENSE = '".$depense->ID_CATEGORIE_DEPENSE."' AND MONTH(DATE_CREATE_DEPENSE) ='".$month."' ")->row_array();
 
          }else{

             $getSomme_by_depense = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS SOMMES FROM pos_depenses WHERE ID_CATEGORIE_DEPENSE = '".$depense->ID_CATEGORIE_DEPENSE."' AND MONTH(DATE_CREATE_DEPENSE) ='".$encourMois."' ")->row_array();
          }
          
          if(empty($getSomme_by_depense['SOMMES'])){ $ASP = 0;}else{$ASP =$getSomme_by_depense['SOMMES'];}
          // $somme .= "{name: '".$depense->NOM_CATEGORIE_DEPENSE."',data: [".$ASP."]},";
          $somme .= '["'.$depense->NOM_CATEGORIE_DEPENSE.'", '.(int)$ASP.'],';
          
           $sommes =$somme.'@';
           $sommes = str_replace(',@', '', $somme.'@');

          $categories .= "'".$depense->NOM_CATEGORIE_DEPENSE."',";
          $categorie =$categories.'@';
           $categorie = str_replace(',@', '', $categories.'@');
     }

       $response['somme_recettes_view'] =round($somme_recette);
       $response['categorie_text']= $categorie;
       $response['all_depense']= '['.$sommes.']';

       echo json_encode($response);

  }


  public function caisse_depense_monthly(){

     $mois = $this->input->post('month');
     $encourMois = date('m');

     if(empty(!$mois)){
       $get_sommes = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS SOMME_DEP FROM pos_depenses WHERE MONTH(DATE_CREATE_DEPENSE) = '".$mois."' AND ID_CATEGORIE_DEPENSE =4 ")->row_array();

     }
     else{
    
       $get_sommes = $this->db->query("SELECT SUM(MONTANT_DEPENSE) AS SOMME_DEP FROM pos_depenses WHERE MONTH(DATE_CREATE_DEPENSE) = '".$encourMois."' AND ID_CATEGORIE_DEPENSE =4 ")->row_array();

     }
    
     $ASPH = "";
     if (is_null($get_sommes['SOMME_DEP'])) {$ASPH = 0;} else{$ASPH =$get_sommes['SOMME_DEP'];}

     $response['sommes_total'] = (int)$ASPH;
     echo json_encode($response);

  }







}

/* End of file Dashboard.php */
/* Location: ./application/controllers/administrator/Dashboard.php */