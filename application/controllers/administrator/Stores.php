<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| pos Ibi Stores Controller
 *| --------------------------------------------------------------------------
 *| pos Ibi Stores site
 *|
 */
class stores extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_ibi_stores');
		$this->load->model('model_rm');
	}



	/**
	 * show all pos Ibi Storess
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('pos_ibi_stores_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_ibi_storess'] = $this->model_pos_ibi_stores->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_ibi_stores_counts'] = $this->model_pos_ibi_stores->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/stores/index/',
			'total_rows'   => $this->model_pos_ibi_stores->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Liste');
		$this->render('backend/standart/administrator/pos_ibi_stores/pos_ibi_stores_list', $this->data);
	}

	/**
	 * Add new pos_ibi_storess
	 *
	 */
	public function add()
	{
		$this->is_allowed('pos_ibi_stores_add');

		$this->template->title('Nouveau');
		$this->render('backend/standart/administrator/pos_ibi_stores/pos_ibi_stores_add', $this->data);
	}

	/**
	 * Add New pos Ibi Storess
	 *
	 * @return JSON
	 */
	public function add_save()
	{


		if (!$this->is_allowed('pos_ibi_stores_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('STATUS_STORE', 'Etat', 'trim|required');
		$this->form_validation->set_rules('NAME_STORE', 'Nom', 'trim|required|max_length[50]');


		if ($this->form_validation->run()) {
			$pos_ibi_stores_IMAGE_STORE_uuid = $this->input->post('pos_ibi_stores_IMAGE_STORE_uuid');
			$pos_ibi_stores_IMAGE_STORE_name = $this->input->post('pos_ibi_stores_IMAGE_STORE_name');

			$save_data = [
				'STATUS_STORE' => $this->input->post('STATUS_STORE'),
				'NAME_STORE' => $this->input->post('NAME_STORE'),
				'DESCRIPTION_STORE' => $this->input->post('DESCRIPTION_STORE'),
				'DATE_CREATION_STORE' => date('Y-m-d H:i:s'),
				'CREATED_BY_STORE' => get_user_data('id'),
			];

			if (!is_dir(FCPATH . '/uploads/pos_ibi_stores/')) {
				mkdir(FCPATH . '/uploads/pos_ibi_stores/');
			}

			if (!empty($pos_ibi_stores_IMAGE_STORE_name)) {
				$pos_ibi_stores_IMAGE_STORE_name_copy = date('YmdHis') . '-' . $pos_ibi_stores_IMAGE_STORE_name;


				rename(
					FCPATH . 'uploads/tmp/' . $pos_ibi_stores_IMAGE_STORE_uuid . '/' . $pos_ibi_stores_IMAGE_STORE_name,
					FCPATH . 'uploads/pos_ibi_stores/' . $pos_ibi_stores_IMAGE_STORE_name_copy
				);

				if (!is_file(FCPATH . '/uploads/pos_ibi_stores/' . $pos_ibi_stores_IMAGE_STORE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
					]);
					exit;
				}

				$save_data['IMAGE_STORE'] = $pos_ibi_stores_IMAGE_STORE_name_copy;
			}


			$save_pos_ibi_stores = $this->model_pos_ibi_stores->store($save_data);


			if ($save_pos_ibi_stores) {

				$store_id = $save_pos_ibi_stores;

				$create_flow = $this->model_rm->getUpdate('  

	          CREATE TABLE IF NOT EXISTS  pos_store_' . $store_id . '_ibi_articles_stock_flow (

	      `ID_SF` int(11) NOT NULL AUTO_INCREMENT,
			  `REF_ARTICLE_BARCODE_SF` varchar(50) DEFAULT NULL,
			  `QUANTITE_SF` decimal(11,3) DEFAULT NULL,
			  `REF_COMMAND_CODE_SF` varchar(50) DEFAULT NULL,
			  `REF_SHIPPING_SF` int(11) DEFAULT NULL,
			  `SHIFT_ID_S` int(11) NOT NULL DEFAULT "0",
			  `TYPE_SF` varchar(200) DEFAULT NULL,
			  `PRIX_ACHAT_SF` float DEFAULT NULL,
			  `UNIT_PRICE_SF` float DEFAULT NULL,
			  `TOTAL_PRICE_SF` float DEFAULT NULL,
			  `REF_PROVIDER_SF` int(11) DEFAULT NULL,
			  `DESCRIPTION_SF` text,
			  `DATE_CREATION_SF` datetime DEFAULT NULL,
			  `DATE_MOD_SF` datetime DEFAULT NULL,
			  `CREATED_BY_SF` int(11) DEFAULT NULL,
			  `MODIFIED_BY_SF` int(11) DEFAULT NULL,
			  `DELETE_STATUS_SF` int(11) DEFAULT NULL,
			  `DELETE_DATE_SF` datetime DEFAULT NULL,
			  `DELETE_BY_SF` int(11) DEFAULT NULL,
			  `DELETE_COMMENT_SF` text,
			  `ID_ARRIVAGE` int(11) DEFAULT NULL,
	           PRIMARY KEY (`ID_SF`)

	          )');
				}



			if ($create_flow) {

			  $create_article = $this->model_rm->getUpdate('

              CREATE TABLE IF NOT EXISTS pos_store_' . $store_id . '_ibi_articles (
              `ID_ARTICLE` int NOT NULL  AUTO_INCREMENT,
              `DESIGN_ARTICLE` varchar(200) DEFAULT NULL,
						  `TYPE_ARTICLE` int(11) NOT NULL DEFAULT "0",
						  `NATURE_ARTICLE` smallint(6) DEFAULT NULL,
						  `CODEBAR_ARTICLE` varchar(50) DEFAULT NULL,
						  `REF_RAYON_ARTICLE` int(11) DEFAULT NULL,
						  `REF_CATEGORIE_ARTICLE` int(11) DEFAULT NULL,
						  `REF_ID_FAMILLE_ARTICLE` int(11) DEFAULT NULL,
						  `QUANTITY_ARTICLE` int(11) DEFAULT "0",
						  `PRIX_DACHAT_ARTICLE` float DEFAULT NULL,
						  `PRIX_DE_REVIENS_ARTICLE` decimal(10,0) DEFAULT NULL,
						  `PRIX_DE_VENTE_ARTICLE` decimal(10,0) DEFAULT NULL,
						  `RIX_VENTE_CLIENT_ARTICLE` int(10) DEFAULT "0",
						  `PRIX_DE_VENTE_VIP_ARTICLE` decimal(10,0) NOT NULL DEFAULT "0",
						  `TAILLE_ARTICLE` varchar(200) DEFAULT NULL,
						  `POIDS_ARTICLE` varchar(200) DEFAULT NULL,
						  `COULEUR_ARTICLE` varchar(200) DEFAULT NULL,
						  `HAUTEUR_ARTICLE` varchar(200) DEFAULT NULL,
						  `LARGEUR_ARTICLE` varchar(200) DEFAULT NULL,
						  `APERCU_ARTICLE` varchar(200) DEFAULT NULL,
						  `UNITE_ARTICLE` varchar(50) DEFAULT NULL,
						  `PRIX_PROMOTIONEL_ARTICLE` decimal(10,0) DEFAULT NULL,
						  `QTE_DECOUPAGE_ARTICLE` varchar(230) DEFAULT NULL,
						  `MARGE_ARTICLE` decimal(10,0) DEFAULT NULL,
						  `SPECIAL_PRICE_START_DATE_ARTICLE` datetime DEFAULT NULL,
						  `SPECIAL_PRICE_END_DATE_ARTICLE` datetime DEFAULT NULL,
						  `DESCRIPTION_ARTICLE` text,
						  `MINIMUM_QUANTITY_ARTICLE` float DEFAULT NULL,
						  `ETAT_INGREDIENT_ARTICLE` varchar(50) DEFAULT NULL,
						  `NOMBRE_UNITAIRE` int(11) NOT NULL DEFAULT "0",
						  `TYPE_INGREDIENT` int(11) NOT NULL DEFAULT "0",
						  `NOMBRE_INGREDIENT_TRANSFORMER` varchar(200) DEFAULT NULL,
						  `TRANSFORMER_BY` int(11) DEFAULT NULL,
						  `APPROVISIONNER_ARTICLE_BY` int(11) DEFAULT NULL,
						  `ETAT_TVA` float DEFAULT "0",
						  `STATUT_ARTICLE` int(11) NOT NULL DEFAULT "0",
						  `DATE_CREATION_ARTICLE` datetime DEFAULT NULL,
						  `DATE_MOD_ARTICLE` datetime DEFAULT NULL,
						  `CREATED_BY_ARTICLE` int(11) DEFAULT NULL,
						  `MODIFIED_BY_ARTICLE` int(11) DEFAULT NULL,
						  `DELETE_STATUS_ARTICLE` int(11) DEFAULT "0",
						  `DELETE_DATE_ARTICLE` datetime DEFAULT NULL,
						  `DELETE_BY_ARTICLE` int(11) DEFAULT NULL,
						  `DELETE_COMMENT_ARTICLE` text,
						  `STORE_ID_ARTICLE` int(11) NOT NULL,
						  `IS_INGREDIENT` int(11) NOT NULL DEFAULT "0",
						  `SEUIL_ARTICLE` int(11) NOT NULL DEFAULT "0",
						  `MARQUE` varchar(250) DEFAULT NULL,
						  `REF_SOUS_CATEGORIE_ARTICLE` int(11) NOT NULL DEFAULT "0",
						  `TAUX_DE_MARGE_ARTICLE` int(11) DEFAULT NULL,
						  `PRIX_VENTE_CLIENT_ARTICLE` int(11) DEFAULT NULL,
              PRIMARY KEY (`ID_ARTICLE`)

  
            )');
			}


			if ($create_article) {
			  $create_arrivage = $this->model_rm->getUpdate('
                              
              CREATE TABLE IF NOT EXISTS pos_store_' . $store_id . '_ibi_arrivages (
              `ID_ARRIVAGE` int NOT NULL AUTO_INCREMENT,
              `TITRE_ARRIVAGE` varchar(50) DEFAULT NULL,
						  `CODE_ARRIVAGE` varchar(200) DEFAULT NULL,
						  `DESCRIPTION_ARRIVAGE` text,
						  `VALUE_ARRIVAGE` decimal(10,0) DEFAULT NULL,
						  `ITEMS_ARRIVAGE` decimal(10,0) DEFAULT NULL,
						  `MONTANT_PAYER_FOURNISSEUR` double DEFAULT NULL,
						  `STATUS_ARRIVAGE` int(5) NOT NULL DEFAULT '0',
						  `TYPE_ARRIVAGE` varchar(20) DEFAULT NULL,
						  `TYPE_APPROVISIONNEMENT` varchar(100) NOT NULL,
						  `ID_REQUISITION` int(11) DEFAULT NULL,
						  `REF_PROVIDERS_ARRIVAGE` int(11) DEFAULT NULL,
						  `DATE_CREATION_ARRIVAGE` datetime DEFAULT NULL,
						  `DATE_MOD_ARRIVAGE` datetime DEFAULT NULL,
						  `CREATED_BY_ARRIVAGE` int(11) DEFAULT NULL,
						  `MODIFIED_BY_ARRIVAGE` int(11) DEFAULT NULL,
						  `DELETE_STATUS_ARRIVAGE` int(11) DEFAULT '0',
						  `DELETE_DATE_ARRIVAGE` datetime DEFAULT NULL,
						  `DELETE_BY_ARRIVAGE` int(11) DEFAULT NULL,
						  `DELETE_COMMENT_ARRIVAGE` text,
                PRIMARY KEY (`ID_ARRIVAGE`)

              )  ');
			}


			if ($create_arrivage) {

				
			}

			if ($create_arrivage) {
				$inventaire = $this->model_rm->getUpdate('

				CREATE TABLE IF NOT EXISTS pos_store_'.$store_id.'_ibi_inventaires (
					   ID_INVENTAIRE int NOT NULL AUTO_INCREMENT,
					  `TITRE_INVENTAIRE` varchar(50) NOT NULL,
					  `DESCRIPTION_INVENTAIRE` text NOT NULL,
					  `VALUE_INVENTAIRE` decimal(10,0) NOT NULL,
					  `ITEMS_INVENTAIRE` decimal(10,0) NOT NULL,
					  `TYPE_INVENTAIRE` varchar(20) NOT NULL,
					  `REF_PROVIDERS_INVENTAIRE` int(11) NOT NULL,
					  `STATUS_APPROV` int(11) NOT NULL,
					  `DATE_CREATION_INVENTAIRE` datetime NOT NULL,
					  `DATE_MOD_INVENTAIRE` datetime NOT NULL,
					  `CREATED_BY_INVENTAIRE` int(11) NOT NULL,
					  `MODIFIED_BY_INVENTAIRE` int(11) NOT NULL,
					  `DELETE_STATUS_INVENTAIRE` int(11) NOT NULL,
					  `DELETE_DATE_INVENTAIRE` datetime NOT NULL,
					  `DELETE_BY_INVENTAIRE` int(11) NOT NULL,
					  `DELETE_COMMENT_INVENTAIRE` text NOT NULL,
					   PRIMARY KEY (`ID_INVENTAIRE`)
					)

				 ');
			}

			if ($inventaire) {
				$inventaire_item = $this->model_rm->getUpdate('
				
				CREATE TABLE IF NOT EXISTS pos_store_'.$store_id.'_ibi_inventaires_items (
				  ID_IVI int NOT NULL AUTO_INCREMENT,
				  `DESIGN_IVI` varchar(200) NOT NULL,
				  `PRIX_ACHAT_IVI` double DEFAULT NULL,
				  `QUANTITY_THEORIQUE_IVI` float NOT NULL,
				  `QUANTITY_PHYSIQUE_IVI` float NOT NULL,
				  `DIFF` float NOT NULL,
				  `REF_PROVIDER_IVI` int(11) NOT NULL,
				  `REF_IVI` int(11) NOT NULL,
				  `BARCODE_IVI` varchar(200) NOT NULL,
				  `DATE_CREATION_IVI` datetime NOT NULL,
				  `DATE_MOD_IVI` datetime NOT NULL,
				  `CREATED_BY_IVI` int(11) NOT NULL,
				  `MODIFIED_BY_IVI` int(11) NOT NULL,
				  `DELETE_STATUS_IVI` int(11) NOT NULL,
				  `DELETE_DATE_IVI` datetime NOT NULL,
				  `DELETE_BY_IVI` int(11) NOT NULL,
				  `DELETE_COMMENT_IVI` text,
				  `DATE_PEREMPTION` varchar(11) NOT NULL,
				  `STATUS_VALIDATION` int(11) NOT NULL,
				  PRIMARY KEY (`ID_IVI`)
				)
          	');
			}

				$category = $this->model_rm->getUpdate('
                
                CREATE TABLE  IF NOT EXISTS pos_store_'.$store_id.'_ibi_categories (
				  ID_CATEGORIE int NOT NULL AUTO_INCREMENT,
				  `NOM_CATEGORIE` varchar(200) NOT NULL,
				  `DESCRIPTION_CATEGORIE` text NOT NULL,
				  `PARENT_REF_ID_CATEGORIE` int(11) NOT NULL,
				  `DATE_CREATION_CATEGORIE` datetime NOT NULL,
				  `DATE_MOD_CATEGORIE` datetime NOT NULL,
				  `CREATED_BY_CATEGORIE` int(11) NOT NULL,
				  `MODIFIED_BY_CATEGORIE` int(11) NOT NULL,
				  `DELETE_STATUS_CATEGORIE` int(11) NOT NULL,
				  `DELETE_DATE_CATEGORIE` datetime NOT NULL,
				  `DELETE_BY_CATEGORIE` int(11) NOT NULL,
				  `DELETE_COMMENT_CATEGORIE` text NOT NULL,
				   PRIMARY KEY (`ID_CATEGORIE`)
				)');


				$sortie_item = $this->model_rm->getUpdate('
                  CREATE TABLE IF NOT EXISTS pos_store_'.$store_id.'_ibi_sortie_items (
				  ID_SORTIE_ITM int NOT NULL AUTO_INCREMENT,
				  `REF_CODE_SORTIE` varchar(100) NOT NULL,
				  `PRODUCT_NAME_SORTIE_ITM` varchar(255) NOT NULL,
				  `QTE_SORTIE_ITM` float NOT NULL,
				  `PRIX_SORTIE_ITM` double NOT NULL,
				  `PRIX_TOTAL_SORTIE_ITM` double NOT NULL,
				  `REF_CODE_BAR_SORTIE_ITM` varchar(100) NOT NULL,
				  `CREATED_BY_SORTIE_ITM` int(11) NOT NULL,
				  `MODIFY_BY_SORTIE_ITM` int(11) NOT NULL,
				  `DATE_CREATION_SORTIE_ITM` datetime NOT NULL,
				  `DATE_MOD_SORTIE_ITM` datetime NOT NULL,
				  `DELETED_BY_SORTIE_ITM` int(11) NOT NULL,
				  `DELETED_COMMENT_SORTIE_ITM` varchar(255) NOT NULL,
				  `DELETED_STATUS_SORTIE_ITM` int(11) NOT NULL,
				  `DELETED_DATE_SORTIE_ITM` datetime NOT NULL,
				  `TYPES` varchar(50) NOT NULL,
				  PRIMARY KEY (`ID_SORTIE_ITM`)
				)
                ');

                $sortie = $this->model_rm->getUpdate('
                  CREATE TABLE IF NOT EXISTS pos_store_'.$store_id.'_ibi_sortie (
				  ID_SORTIE int(11) NOT NULL AUTO_INCREMENT,
				  `CODE_SORTIE` varchar(50) NOT NULL,
				  `TITRE_SORTIE` varchar(255) NOT NULL,
				  `DESCRIPTION_SORTIE` varchar(255) NOT NULL,
				  `MONTANT_SORTIE` double NOT NULL,
				  `QTE_ASORTIE` double NOT NULL,
				  `STATUS_SORTIE` int(11) NOT NULL,
				  `DESTINATION_SORTIE` int(11) NOT NULL,
				  `DATE_CREATION_SORTIE` datetime NOT NULL,
				  `DATE_MOD_SORTIE` datetime NOT NULL,
				  `CREATED_BY_SORTIE` int(11) NOT NULL,
				  `MODIFY_BY_SORTIE` int(11) NOT NULL,
				  `DELETE_STATUS_SORTIE` int(11) NOT NULL,
				  `DELETED_BY_SORTIE` int(11) NOT NULL,
				  `DETEDE_DATE_SORTIE` datetime NOT NULL,
				  `DELETE_COMMENT_SORTIE` varchar(255) NOT NULL,
				  PRIMARY KEY (`ID_SORTIE`)
				)
                ');

                $categorie_ingredient=$this->model_rm->getUpdate('
			    	CREATE TABLE IF NOT EXISTS pos_store_'.$store_id.'_categorie_ingredient (
				  ID_CATEGORIE int(11) NOT NULL AUTO_INCREMENT,
				  `NAME_CATEGORIE` varchar(255) NOT NULL,
				  `DESCRIPTION_CATEGORIE` varchar(255) NOT NULL,
				  `DATE_CREATION_CATEGORIE` datetime NOT NULL,
				  `DATE_MOD_CATEGORIE` datetime NOT NULL,
				  `CREATED_BY_CATEGORIE` int(11) NOT NULL,
				  `MODIFY_BY_CATEGORIE` int(11) NOT NULL,
				  `DELETE_STATUS_CATEGORIE` int(11) NOT NULL DEFAULT "0",
				  `DELETED_BY_CATEGORIE` int(11) NOT NULL,
				  PRIMARY KEY (`ID_CATEGORIE`)
				)
                	');




			if ($save_pos_ibi_stores) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_stores;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/stores/edit/' . $save_pos_ibi_stores, 'Edit pos Ibi Stores'),
						anchor('administrator/stores', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/stores/edit/' . $save_pos_ibi_stores, 'Edit pos Ibi Stores')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/stores');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/stores');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * Update view pos Ibi Storess
	 *
	 * @var $id String
	 */
	public function edit($id)
	{
		$this->is_allowed('pos_ibi_stores_update');

		$this->data['pos_ibi_stores'] = $this->model_pos_ibi_stores->find($id);

		$this->template->title('pos Ibi Stores Update');
		$this->render('backend/standart/administrator/pos_ibi_stores/pos_ibi_stores_update', $this->data);
	}

	/**
	 * Update pos Ibi Storess
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_ibi_stores_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('STATUS_STORE', 'Etat', 'trim|required');
		$this->form_validation->set_rules('NAME_STORE', 'Nom', 'trim|required|max_length[50]');

		if ($this->form_validation->run()) {
			$pos_ibi_stores_IMAGE_STORE_uuid = $this->input->post('pos_ibi_stores_IMAGE_STORE_uuid');
			$pos_ibi_stores_IMAGE_STORE_name = $this->input->post('pos_ibi_stores_IMAGE_STORE_name');

			$save_data = [
				'STATUS_STORE' => $this->input->post('STATUS_STORE'),
				'NAME_STORE' => $this->input->post('NAME_STORE'),
				'DESCRIPTION_STORE' => $this->input->post('DESCRIPTION_STORE'),
				'DATE_MOD_STORE' => date('Y-m-d H:i:s'),
				'MODIFIED_BY_STORE' => get_user_data('id'),
			];

			// if (!is_dir(FCPATH . '/uploads/pos_ibi_stores/')) {
			// 	mkdir(FCPATH . '/uploads/pos_ibi_stores/');
			// }

			// if (!empty($pos_ibi_stores_IMAGE_STORE_uuid)) {
			// 	$pos_ibi_stores_IMAGE_STORE_name_copy = date('YmdHis') . '-' . $pos_ibi_stores_IMAGE_STORE_name;

			// 	rename(
			// 		FCPATH . 'uploads/tmp/' . $pos_ibi_stores_IMAGE_STORE_uuid . '/' . $pos_ibi_stores_IMAGE_STORE_name,
			// 		FCPATH . 'uploads/pos_ibi_stores/' . $pos_ibi_stores_IMAGE_STORE_name_copy
			// 	);

			// 	if (!is_file(FCPATH . '/uploads/pos_ibi_stores/' . $pos_ibi_stores_IMAGE_STORE_name_copy)) {
			// 		echo json_encode([
			// 			'success' => false,
			// 			'message' => 'Error uploading file'
			// 		]);
			// 		exit;
			// 	}

			// 	$save_data['IMAGE_STORE'] = $pos_ibi_stores_IMAGE_STORE_name_copy;
			// }


			$save_pos_ibi_stores = $this->model_pos_ibi_stores->change($id, $save_data);

			if ($save_pos_ibi_stores) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/stores', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/stores/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/stores/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete pos Ibi Storess
	 *
	 * @var $id String
	 */
	public function delete($id = null)
	{
		$this->is_allowed('pos_ibi_stores_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$CommentValue = $this->input->get('inputValue');

		$remove = false;

		if (!empty($id)) {

			$delete_save = array(
				'DELETE_STATUS_STORE' => 1,
				'DELETE_DATE_STORE' => date('Y-m-d H:i:s'),
				'DELETE_BY_STORE' => get_user_data('id'),
				'DELETE_COMMENT_STORE' => $CommentValue
			);

			$remove = $this->model_pos_ibi_stores->update("pos_ibi_stores", array("ID_STORE" => $id), $delete_save);
			// $remove = $this->_remove($id);
		} elseif (count($arr_id) > 0) {
			foreach ($arr_id as $id) {
				// $remove = $this->_remove($id);
			}
		}

		if ($remove) {
			set_message(cclang('has_been_deleted', 'pos_ibi_stores'), 'success');
		} else {
			set_message(cclang('error_delete', 'pos_ibi_stores'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view pos Ibi Storess
	 *
	 * @var $id String
	 */
	public function view($id)
	{
		$this->is_allowed('pos_ibi_stores_view');

		$this->data['pos_ibi_stores'] = $this->model_pos_ibi_stores->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('pos Ibi Stores Detail');
		$this->render('backend/standart/administrator/pos_ibi_stores/pos_ibi_stores_view', $this->data);
	}

	/**
	 * delete pos Ibi Storess
	 *
	 * @var $id String
	 */
	private function _remove($id)
	{
		$pos_ibi_stores = $this->model_pos_ibi_stores->find($id);

		if (!empty($pos_ibi_stores->IMAGE_STORE)) {
			$path = FCPATH . '/uploads/pos_ibi_stores/' . $pos_ibi_stores->IMAGE_STORE;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}


		return $this->model_pos_ibi_stores->remove($id);
	}

	/**
	 * Upload Image pos Ibi Stores	* 
	 * @return JSON
	 */
	public function upload_IMAGE_STORE_file()
	{
		if (!$this->is_allowed('pos_ibi_stores_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'pos_ibi_stores',
		]);
	}

	/**
	 * Delete Image pos Ibi Stores	* 
	 * @return JSON
	 */
	public function delete_IMAGE_STORE_file($uuid)
	{
		if (!$this->is_allowed('pos_ibi_stores_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		echo $this->delete_file([
			'uuid'              => $uuid,
			'delete_by'         => $this->input->get('by'),
			'field_name'        => 'IMAGE_STORE',
			'upload_path_tmp'   => './uploads/tmp/',
			'table_name'        => 'pos_ibi_stores',
			'primary_key'       => 'ID_STORE',
			'upload_path'       => 'uploads/pos_ibi_stores/'
		]);
	}

	/**
	 * Get Image pos Ibi Stores	* 
	 * @return JSON
	 */
	public function get_IMAGE_STORE_file($id)
	{
		if (!$this->is_allowed('pos_ibi_stores_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
			]);
			exit;
		}

		$pos_ibi_stores = $this->model_pos_ibi_stores->find($id);

		echo $this->get_file([
			'uuid'              => $id,
			'delete_by'         => 'id',
			'field_name'        => 'IMAGE_STORE',
			'table_name'        => 'pos_ibi_stores',
			'primary_key'       => 'ID_STORE',
			'upload_path'       => 'uploads/pos_ibi_stores/',
			'delete_endpoint'   => 'administrator/stores/delete_IMAGE_STORE_file'
		]);
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('pos_ibi_stores_export');

		$this->model_pos_ibi_stores->export('pos_ibi_stores', 'pos_ibi_stores');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('pos_ibi_stores_export');

		$this->model_pos_ibi_stores->pdf('pos_ibi_stores', 'pos_ibi_stores');
	}
}


/* End of file pos_ibi_stores.php */
/* Location: ./application/controllers/administrator/pos Ibi Stores.php */