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
	}

	public function index()
	{
		if (!$this->aauth->is_allowed('dashboard')) {
			redirect('/','refresh');
		}
         $data = [];
         $year=date('Y');



         //CHIFFRES D'AFFAIRES PAR MOIS
        $chiffres_mois='';
		for ($i=1; $i <=12 ; $i++) { 
            if (strlen($i)==2) {
                $j='';
            }else{
                $j=0;
            } 
        $getdata=$this->model_rm->getRequeteOne("SELECT sum(TOTAL)as nbre FROM hospital_ibi_commandes WHERE date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES, '%Y-%m')='".$year."-".$j.$i."' ");
          $nombre= $getdata['nbre'];
          if (empty($nombre)) {
          	$nombre=0;
          }
          $chiffres_mois .= "". $nombre.",";
        }
		$data['chiffres_mois']=$chiffres_mois;


		
		$this->render('backend/standart/chart', $data);
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
	    $dep=$this->model_rm->getList('departements');
	    foreach ($dep as $key) {
	     $montant=$this->model_rm->getRequeteOne('SELECT sum(PRIX_TOTAL) AS TOTAL FROM hospital_ibi_commandes_produits WHERE DEPARTMENT='.$key['ID_DEPARTEMENT'].' '.$req.' ')['TOTAL'];	
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

        $dataAssurance=$this->model_rm->getRequete('SELECT DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, DISCOUNT_PERCENT, PRIX_TOTAL,REF_COMMAND_CODE,NOM_SOCIETE,ID_SOCIETE,
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

         $datas=$this->model_rm->getRequeteOne('SELECT SUM(PRIX_TOTAL) AS TOTAL,`DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS`, DAYNAME(date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")) as dat FROM `hospital_ibi_commandes_produits`
			WHERE '.$req.'
			GROUP BY date_format(DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m-%d")');

         $datas['TOTAL']==''? $total=0 : $total=$datas['TOTAL'];

         $day = date('D', strtotime(date('Y-m-'.$j.'')));
         
         array_push($data['categories'], $day.'-'.$j);
         array_push($data['montant'], (int)$total);

        
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
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/administrator/Dashboard.php */