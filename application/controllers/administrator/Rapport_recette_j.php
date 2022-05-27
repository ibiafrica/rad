<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Hospital Ibi Requisition Controller
 *| --------------------------------------------------------------------------
 *| Hospital Ibi Requisition site
 *|
 */
class Rapport_recette_j extends Admin
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
	}



	public function index($offset = 0)
	{
		// $this->is_allowed('hospital_ibi_requisition_list');


		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		$typeClient = $this->input->get('typeClient');
		$typePayement = $this->input->get('typePayement');
		$req = '';


		if (!empty($typePayement)) {
			if ($typePayement == 'bon') {

				$req .= ' AND PF.TYPE_DE_PAYEMET=1';
			}

			if ($typePayement == 'cash') {
				$req .= ' AND PF.TYPE_DE_PAYEMET=0';
			}
		}


		if (!empty($typeClient)) {
			if ($typeClient == 'H') {
				$req .= ' AND PF.LETTER="H" OR PF.LETTER="B" ';
			}

			if ($typeClient == 'A') {
				$req .= ' AND PF.LETTER="A" ';
			}
		}


		if (!empty($debut) and !empty($fin)) {


			$this->data['chiffre'] = $this->model_rm->getRequete('SELECT CP.CREATED_BY_HOSPITAL_IBI_COMMANDES_PRODUITS, PF.PATIENT_FILE_CODE, C.CODE, PF.LETTER, PF.TYPE_DE_PAYEMET, CP.PRIX_TOTAL, CP.DATE_COMMANDE_PRODUITS
		FROM hospital_ibi_commandes C
		LEFT JOIN patient_file PF ON PF.PATIENT_FILE_ID=C.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES
		LEFT JOIN hospital_ibi_commandes_produits CP ON CP.REF_COMMAND_CODE=C.CODE
		WHERE CP.DELETED_USER_HOSPITAL_IBI_COMMANDES_PRODUITS=0 AND CP.DATE_COMMANDE_PRODUITS BETWEEN "' . $debut . '" AND "' . $fin . '" ' . $req . ' ');
		} else {
			$this->data['chiffre'] = [];
		}







		$this->template->title('Hospital rapport chiffre d\'affaires');
		$this->render('backend/standart/administrator/rapport/rapport_recette_j_view', $this->data);
	}
}
