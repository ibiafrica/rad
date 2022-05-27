<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Hospital Ibi Requisition Controller
 *| --------------------------------------------------------------------------
 *| Hospital Ibi Requisition site
 *|
 */
class Rapport_chiffre extends Admin
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
		$fin 	= $this->input->get('fin');

		if (!empty($debut) and !empty($fin)) {
			$req = "WHERE DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS BETWEEN '" . $debut . "' AND '" . $fin . "'";

			$this->data['chiffre'] = $this->model_rm->getRequete('SELECT ID_DEPARTEMENT, DESIGNATION_DEPARTEMENT, ID_ACTES_CATEGORIE, SUM(QUANTITE*PRIX) AS TOTAL, DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS
			FROM departements AS D
			JOIN actes_categorie AS C ON D.ID_DEPARTEMENT=C.DEPARTEMENTS
			JOIN hospital_ibi_commandes_produits AS P ON C.ID_ACTES_CATEGORIE=P.DEPARTMENT
			' . $req . '
			GROUP BY ID_DEPARTEMENT');
		} else {
			$this->data['chiffre'] = array();
		}




		$this->template->title('Hospital rapport chiffre d\'affaires');
		$this->render('backend/standart/administrator/rapport/rapport_chiffre_view', $this->data);
	}
}
