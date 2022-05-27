<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Vinotheque extends Admin
{

	public function __construct()
	{
		parent::__construct();

	
			$this->load->model(['model_rm','model_vinotheque']);
	}




	    public function mouvement_de_stock($movement_stock = false){

		    
	        $end = $this->input->get('end');
	    	  $store = $this->uri->segment(2);
		    	$start = $this->input->get('start');
	        $categorie = $this->input->get('categorie_article');


	        if($start == "" or $end ==""){
	         	$this->data['start']  = date('Y-m-d 00:00:00');
	            $this->data['end']  = date('Y-m-d 23:59:59');

	         }else{
	         	$this->data['start']  = $start;
	            $this->data['end']  = $end;
	        }

	        if(!empty($categorie)){
	        	$requete = "AND REF_CATEGORIE_ARTICLE = ".$categorie." ";
	        }else {
	        	$requete = "";
	        }




		    $article_table = "pos_store_".$store."_ibi_articles";  
		    $inventaire_item = "pos_store_" . $store . "_ibi_inventaires_items";
		    $flow = "pos_store_" . $store . "_ibi_articles_stock_flow";

			$this->db->query("SET SQL_BIG_SELECTS=1");
		    $mv_stock_data = $this->db->query(" SELECT QUANTITY_THEORIQUE_IVI,ID_ARTICLE,DESIGN_ARTICLE,
		        CODEBAR_ARTICLE, DESCRIPTION_ARTICLE,PRIX_DACHAT_ARTICLE,ID_SF,PRIX_DE_VENTE_ARTICLE,
		        DATE_CREATION_SF, QUANTITY_ARTICLE,NATURE_ARTICLE,TYPE_SF,QUANTITE_SF,DATE_CREATION_IVI
		        ,UNIT_PRICE_SF,TOTAL_PRICE_SF
		      
		      FROM $article_table art LEFT JOIN $inventaire_item `inv` 
		      ON  `inv`.`BARCODE_IVI` = art.CODEBAR_ARTICLE AND inv.DATE_CREATION_IVI > '".$this->data['start']."' 
		      AND `inv`.`DATE_CREATION_IVI` <= '".$this->data['end']."'
		      LEFT JOIN(
		        SELECT ID_SF,REF_ARTICLE_BARCODE_SF,TYPE_SF,DATE_CREATION_SF,QUANTITE_SF,TOTAL_PRICE_SF,UNIT_PRICE_SF
		      FROM $flow flow
		        WHERE DATE_CREATION_SF > '".$this->data['start']."' AND DATE_CREATION_SF <= '".$this->data['end']."' 

		      ) flow ON flow.REF_ARTICLE_BARCODE_SF = `art`.`CODEBAR_ARTICLE`
		      WHERE art.DELETE_STATUS_ARTICLE = 0 $requete  GROUP BY flow.ID_SF
		      ORDER BY art.DESIGN_ARTICLE")
		      ->result();


		      $this->data['mouvement_de_stock'] = $mv_stock_data;

		      $this->template->title('Rapport de stock');
          $this->render('backend/standart/administrator/vinotheque/mouvement_de_stock', $this->data);

		}






		public function rapport_detail(){


      $end = $this->input->get('end');
	    $store = $this->uri->segment(2);
			$start = $this->input->get('start');
	    $format = $this->input->get('format');

	    //print_r($format.'/'.$start.'/'.$end);exit;


          if($start == "" or $end ==""){
	         	$this->data['start']  = date('Y-m-d 00:00:00');
	            $this->data['end']  = date('Y-m-d 23:59:59');

	         }else{
	         	$this->data['start']  = $start;
	            $this->data['end']  = $end;
	        }

	      $getdata_commande = $this->db->query(" SELECT ID_pos_IBI_COMMANDES as ID,
	      	  CODE, DATE_CREATION_pos_IBI_COMMANDES as DAT,CLIENT_FILE_ID_pos_IBI_COMMANDES 
	      	  AS FILE FROM pos_ibi_commandes WHERE DELETED_STATUS_pos_IBI_COMMANDES = 0 AND 
	      	  DATE_CREATION_pos_IBI_COMMANDES BETWEEN '".$this->data['start']."' AND '".$this->data['end']."' ");
           
      
        $array_commande_push =[];
	       foreach ($getdata_commande->result() as $itms_cmmd) { 
	      	$command_data = [$itms_cmmd->DAT,$itms_cmmd->CODE,$itms_cmmd->ID,];
	      	$commandes_product = $this->model_rm->getRequeteResult("SELECT ID_pos_IBI_COMMANDES_PRODUITS AS ID,NAME,QUANTITE,PRIX FROM pos_ibi_commandes_produits WHERE 
	      		pos_IBI_COMMANDES_ID = ".$itms_cmmd->ID." ");

	      	array_push($array_commande_push, ['commande_data'=>$command_data,'commandes_product'=>$commandes_product]);
	      }

 	         // -----------  start condenser---

            $getdata_mode_paie = $this->model_rm->getRequeteResult('select ID_MODE_PAIEMENT as id, DESIGNATION_PAIEMENT_MODE as designation from mode_paiement');
             $array_paiement_push = [];
             foreach ($getdata_mode_paie as $mode) {
             	   $mode_paie = [$mode->designation];
             	   $get_data_paiement = $this->db->query('SELECT SUM(MONTANT_PAIEMENT) AS MONTANT, COUNT(MODE_PAIEMENT) AS COUNTER FROM pos_paiements WHERE DELETED_STATUS_PAIEMENT=0 AND STATUT_ANNULATION=0 AND MODE_PAIEMENT = "'.$mode->designation.'" AND DATE_CREATION_PAIEMENT BETWEEN "'.$this->data['start'].'" AND "'.$this->data['end'].'" ')->row_array();

               array_push($array_paiement_push,['mode_paie'=>$mode_paie,'current_somme'=>$get_data_paiement['MONTANT'],'current_counter'=>$get_data_paiement['COUNTER']]);
              }   

            //---------- end  condenser

            // --------start vente par staff -->

              $select_agent_paid = $this->model_rm->getRequeteResult('SELECT CREATED_BY_PAIEMENT AS ID_STAFF ,COUNT(*) AS COUNTER,full_name AS STAFF_NOM FROM pos_paiements p INNER JOIN aauth_users u ON u.id = p.CREATED_BY_PAIEMENT WHERE DELETED_STATUS_PAIEMENT=0 AND STATUT_ANNULATION=0 AND DATE_CREATION_PAIEMENT BETWEEN "'.$this->data["start"].'" AND "'.$this->data["end"].'" GROUP BY  p.CREATED_BY_PAIEMENT DESC  '); 

               $data_staff_array = [];
               foreach ($select_agent_paid as $items) {
               	   $data_staff = [$items->STAFF_NOM,$items->ID_STAFF];
                   $amount = $this->model_rm->getRequeteOne('SELECT SUM(MONTANT_PAIEMENT) AS AMOUNT FROM pos_paiements WHERE DELETED_STATUS_PAIEMENT=0 AND STATUT_ANNULATION=0 AND  CREATED_BY_PAIEMENT = '.$items->ID_STAFF.' AND DATE_CREATION_PAIEMENT BETWEEN "'.$this->data["start"].'" AND "'.$this->data["end"].'" ')['AMOUNT'];
                   array_push($data_staff_array, ['user_staff'=>$data_staff,'amount'=>$amount]); 
                }

           $this->data['data_staff_user']= $data_staff_array;                
           //------------- end vente par staff -->

           $this->data['data_commande']=$array_commande_push;
           $this->data['count_commandes'] = $getdata_commande->num_rows();
           $this->data['paiement_data'] = $array_paiement_push;
          
		    $this->template->title('Rapports detaillées');
        $this->render('backend/standart/administrator/vinotheque/rapport_detail', $this->data);	
		}




		public function recette_journaliere(){

			    $end = $this->input->get('end');
	    	  $store = $this->uri->segment(2);
		    	$start = $this->input->get('start');
	        $categorie = $this->input->get('categorie_article');

	        if($start == "" or $end ==""){
	         	$this->data['start']  = date('Y-m-d 00:00:00');
	            $this->data['end']  = date('Y-m-d 23:59:59');

	         }else{
	         	$this->data['start']  = $start;
	            $this->data['end']  = $end;
	        }

			  $this->template->title('Recette Journaliere');
        $this->render('backend/standart/administrator/vinotheque/recette_journaliere', $this->data);
		}


  public function jours_du_mois($month, $year)
  {
    return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
  }

		public function getdata_fullcalendar_recette(){
			  $date = '11';


        $year=date('Y');
        $month=date('m');
        $store=$this->uri->segment(2);
        $storeList=$this->model_rm->getList('pos_ibi_stores', array('DELETE_STATUS_STORE'=>0));

        $data['categories']=[];
        $data['montant']=[];
        $categories='';
        $montant='';

      if (isset($store) AND !empty($store)) {
          $tablename='pos_ibi_commandes_produits';
          $storeMode=false;
        
        }else{
          $tablename='pos_ibi_commandes_produits';
          $storeMode=true;
        }

        if(empty($date)) {
          $days=$this->jours_du_mois($month,$year);
        }else{
          $days=$this->jours_du_mois($date,$year);
        }


    
        for ($i=1; $i <=$days ; $i++) { 

         strlen($i)==2? $j=$i : $j='0'.$i;

         if (empty($date)) {
          $req='date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="'.$year.'-'.$month.'-'.$j.'"';
          $req_command='date_format(DATE_CREATION_pos_IBI_COMMANDES, "%Y-%m-%d")="'.$year.'-'.$month.'-'.$j.'"';
          $req_paie='date_format(DATE_CREATION_PAIEMENT, "%Y-%m-%d")="'.$year.'-'.$month.'-'.$j.'"';
          $req_depense='date_format(DATE_CREATE_DEPENSE, "%Y-%m-%d")="'.$year.'-'.$month.'-'.$j.'"';


        }else{
          $req='date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")="'.$year.'-'.$date.'-'.$j.'"';
          $req_command='date_format(DATE_CREATION_pos_IBI_COMMANDES, "%Y-%m-%d")="'.$year.'-'.$date.'-'.$j.'"';
          $req_paie='date_format(DATE_CREATION_PAIEMENT, "%Y-%m-%d")="'.$year.'-'.$date.'-'.$j.'"';
          $req_depense='date_format(DATE_CREATE_DEPENSE, "%Y-%m-%d")="'.$year.'-'.$date.'-'.$j.'"';


        }

        $chiffre_affaires = $this->model_rm->getRequeteOne('SELECT SUM(MONTANT_PAIEMENT) AS PAIE FROM pos_paiements 
        WHERE '.$req_paie.' GROUP BY date_format(DATE_CREATION_PAIEMENT, "%Y-%m-%d")');

         $sum_depense = $this->model_rm->getRequeteOne('SELECT SUM(MONTANT_DEPENSE) AS TOTAL FROM pos_depenses WHERE '.$req_depense.'  GROUP BY date_format(DATE_CREATE_DEPENSE, "%Y-%m-%d") ');

         (empty($sum_depense['TOTAL'])) ? $depense = 0 :  $depense = $sum_depense['TOTAL'];
         (empty($chiffre_affaires['PAIE'])) ? $ch_affaire = 0 :  $ch_affaire = $chiffre_affaires['PAIE'];

         
         $count_command = $this->model_rm->getRequeteCount("SELECT * FROM pos_ibi_commandes WHERE ".$req_command." 
         	GROUP BY date_format(DATE_CREATION_pos_IBI_COMMANDES, '%Y-%m-%d')");

         $datas=$this->model_rm->getRequeteOne('SELECT SUM(QUANTITE*PRIX) AS TOTAL,`DATE_CREATION_pos_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat,pos_IBI_COMMANDES_ID as ID FROM '.$tablename.'
          WHERE '.$req.'
          GROUP BY date_format(DATE_CREATION_pos_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")');

        $montant_st=0;

       
        (empty($datas['TOTAL'])) ? $TOTAL_CONVERT = 0 : $TOTAL_CONVERT =$datas['TOTAL'];

         $montant_st==''? $montant_st=0 : $montant_st=$montant_st;
         $TOTAL_CONVERT==''? $total=0 : $total=$datas['TOTAL'];

         $totals=$montant_st+$total;

         $day = date('D', strtotime(date('Y-m-'.$j.'')));
         (empty($datas['ID'])) ? $id_calendar = $i : $id_calendar = $datas['ID'];


          $data_calendar[] = [
          	'id'=>''.$id_calendar.'',
          	'nbre_command' =>number_format($count_command),
          	'chiffre_affaires'=>number_format($ch_affaire),
          	'chiffre_affaires_net'=>number_format($ch_affaire-$depense),
          	'total' => number_format((int)$totals),
            'title'=>"Recette journaliere:->".(int)$totals,
            'start' => $year."-".$date."-".$j,
            'end' => $year."-".$date."-".$j
           ];
        
        }
        
          echo json_encode($data_calendar);
          exit;

			
		}


   public function getCommandSomm($status_command,$date_start,$date_end){
   	$current_cmd = [];
   	$sum_command = $this->model_rm->getRequeteResult('SELECT SUM(p.QUANTITE*p.PRIX) AS TOTAL FROM pos_ibi_commandes c LEFT JOIN pos_ibi_commandes_produits p ON p.pos_IBI_COMMANDES_ID = c.ID_pos_IBI_COMMANDES WHERE c.DATE_CREATION_pos_IBI_COMMANDES BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND c.COMMANDE_STATUS = '.$status_command.' ');

	   $counter_command = $this->model_rm->getRequeteResult('SELECT COUNT(*) AS COUNTER  FROM pos_ibi_commandes  WHERE DATE_CREATION_pos_IBI_COMMANDES BETWEEN "'.$date_start.'" AND "'.$date_end.'"  AND COMMANDE_STATUS = '.$status_command.' ');

	   $data_commande =array_merge($counter_command,$sum_command);

   	return $data_commande;
   }


   public function getDataBilan($details_bilan,$date_start,$date_end){
   	// $details_bilan=0 recette
   	// $details_bilan=1 depense
   	if($details_bilan==0){
       $sum_data_bilan = $this->model_rm->getRequeteOne('SELECT SUM(MONTANT_PAIEMENT) AS TOTAL FROM pos_paiements WHERE DATE_CREATION_PAIEMENT BETWEEN "'.$date_start.'" AND "'.$date_end.'" ')['TOTAL'];
   	}else if($details_bilan==1){
       $sum_data_bilan = $this->model_rm->getRequeteOne('SELECT SUM(MONTANT_DEPENSE) AS TOTAL FROM pos_depenses WHERE DATE_CREATE_DEPENSE BETWEEN "'.$date_start.'" AND "'.$date_end.'" ')['TOTAL'];

   	 }else{
   	 	$sum_data_bilan = ($this->model_rm->getRequeteOne('SELECT SUM(MONTANT_PAIEMENT) AS TOTAL FROM pos_paiements WHERE DATE_CREATION_PAIEMENT BETWEEN "'.$date_start.'" AND "'.$date_end.'" ')['TOTAL'] - $this->model_rm->getRequeteOne('SELECT SUM(MONTANT_DEPENSE) AS TOTAL FROM pos_depenses WHERE DATE_CREATE_DEPENSE BETWEEN "'.$date_start.'" AND "'.$date_end.'" ')['TOTAL']);
   	 }


   	 return $sum_data_bilan;
   }


		public function condenser_by_date(){

			  $date_start = $this->uri->segment(4)." 00:00:00";
			  $date_end = $this->uri->segment(4)." 23:59:59";
        
        $command_push_current = [];
        $array_status_commandes = ['Commandes Cash'=>2,'Commandes Avance'=>1,'Commandes Devis'=>0];
        foreach ($array_status_commandes as $key => $status_command) {
           // function one by one command
        	$somme_commande = $this->getCommandSomm($status_command,$date_start,$date_end);

        	array_push($command_push_current, ['designation'=>$key,'counter_commande'=>$somme_commande[0],'sum_command'=>$somme_commande[1]]);
        }
         
         $mode_paiement = $this->model_rm->getRequeteResult('SELECT * FROM mode_paiement');
         $mode_push_paid = [];
         foreach ($mode_paiement as $mode) {
         	 $on_mode_detail = [$mode->DESIGNATION_PAIEMENT_MODE];
         	 $sum_paie = $this->model_rm->getRequeteOne('SELECT SUM(MONTANT_PAIEMENT) AS PAIE FROM pos_paiements 
         	 	WHERE MODE_PAIEMENT = "'.$mode->DESIGNATION_PAIEMENT_MODE.'" AND DATE_CREATION_PAIEMENT BETWEEN 
         	 	 "'.$date_start.'" AND "'.$date_end.'" ')['PAIE'];

          	array_push($mode_push_paid, ['designation'=>$on_mode_detail,'sommation_mode'=>$sum_paie]);
         }


         $array_bilan = ['Recettes (+)'=>0,'Dépenses (-)'=>1,'Chiffre d\'affaire net (*)'=>2];
         $bilan_array_push =[];
         foreach ($array_bilan as $key => $details_bilan) {
         	 $somme_bilan = $this->getDataBilan($details_bilan,$date_start,$date_end); 
         	
           array_push($bilan_array_push, ['designation'=>$key,'sommation_sum'=>$somme_bilan]);
         }
         
        
         $this->data['command_manager'] =$command_push_current;
         $this->data['mode_paie_manager'] = $mode_push_paid;
         $this->data['bilan_tresorie']=$bilan_array_push;

			  $this->template->title('Rapport journalier détaillé');
        $this->render('backend/standart/administrator/vinotheque/condenser_journalier', $this->data);

		}



	}

