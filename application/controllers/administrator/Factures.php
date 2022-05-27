<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Factures Controller
*| --------------------------------------------------------------------------
*| Factures site
*|
*/ 
class Factures extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_factures');
		$this->load->model('model_departements');
		$this->load->model('model_hospital_ibi_commandes');
		$this->load->model('model_patient_file');
	}

	/**
	* show all Facturess
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('factures_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['facturess'] = $this->model_factures->get($filter, $field, $this->limit_page, $offset);
		$this->data['factures_counts'] = $this->model_factures->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/factures/index/',
			'total_rows'   => $this->model_factures->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Factures List');
		$this->render('backend/standart/administrator/factures/factures_list', $this->data);
	}
	
	/**
	* Add new facturess
	*
	*/
	public function add()
	{
		$this->is_allowed('factures_add');

		$this->template->title('Factures New');
		$this->render('backend/standart/administrator/factures/factures_add', $this->data);
	}

	/**
	* Add New Facturess
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('factures_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('PATIENT_FILE_ID_FACTURE', 'Fiche Du Patient', 'trim|required');
		$this->form_validation->set_rules('NUMERO_FACTURE', 'Numéro Facture', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'PATIENT_FILE_ID_FACTURE' => $this->input->post('PATIENT_FILE_ID_FACTURE'),
				'NUMERO_FACTURE' => $this->input->post('NUMERO_FACTURE'),
				'DATE_CREATION_FACTURE' => date('Y-m-d H:i:s'),
				'CREATED_BY_FACTURE' => get_user_data('id'),			];

			
			$save_factures = $this->model_factures->store($save_data);

			if ($save_factures) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_factures;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/factures/edit/' . $save_factures, 'Edit Factures'),
						anchor('administrator/factures', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/factures/edit/' . $save_factures, 'Edit Factures')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/factures');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/factures');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Facturess
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('factures_update');

		$this->data['factures'] = $this->model_factures->get_one_only($id); 
		$this->template->title('Mise a Jour');
		$this->render('backend/standart/administrator/factures/factures_update', $this->data);
	}

	/**
	* Update Facturess
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('factures_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$consultation = $this->input->post('CONSULTATION');
		$actes =  $this->input->post('ACTES');
		$medicaments = $this->input->post('MEDICAMENTS');
		$sejour = $this->input->post('SEJOUR');
		$laboratoire = $this->input->post('LABORATOIRE');

		$REF_SOCITES = $this->input->post("REF_SOCIETE"); 
		$TYPE_DE_PAYEMET = $this->input->post("TYPE_DE_PAYEMET");
		$BON_DE_COMMANDE = $this->input->post("BON_DE_COMMANDE");

		$this->form_validation->set_rules(
			'TYPE_DE_PAYEMET',
			'TYPE_DE_PAYEMET',
			'trim|required',
			array(
				'required'  => "VOUS DEVEZ DONNER LE TYPE DE PAIMENT."
			)
		);



		if ($TYPE_DE_PAYEMET > 0) {
				if ($consultation > 1 || $actes >1 || $medicaments >1 || $sejour >1 || $laboratoire >1) {
						$this->form_validation->set_rules(
							'BON_DE_COMMANDE',
							'BON_DE_COMMANDE',
							'trim|required',
							array(
								'required'   => 'VOUS DEVEZ DONNER LE NUMERO DU BON DE COMMANDE.'
							)
						);

						$this->form_validation->set_rules(
							'REF_SOCIETE',
							'REF_SOCIETE',
							'trim|required',
							array(
								'required'      => 'VOUS DEVEZ DONNER LA SOCIETE.'
							)
						);

						$this->form_validation->set_rules(
							'TYPE_DE_PAYEMET',
							'TYPE_DE_PAYEMET',
							'trim|required',
							array(
								'required'      => "VOUS DEVEZ DONNER LE NUMERO DU BON DE COMMANDE."
							)
						);
					} else {
						$this->form_validation->set_rules(
							'erreur',
							'erreur',
							'trim|required',
							array(
								'required'      => 'VOUS DEVEZ SELECTIONNER UN ASSURANCE S.V.P .'
							)
						);
					}
			}

		if ($TYPE_DE_PAYEMET == 0 && ($consultation > 1 || $actes >1 || $medicaments >1 || $sejour >1 || $laboratoire >1  || $REF_SOCITES != '' || $BON_DE_COMMANDE != '')) {
				$this->form_validation->set_rules(
					'erreur',
					'erreur',
					'trim|required',
					array(
						'required'   => 'EST-IL  CASH OU BON DE COMMANDE???... VEUILLEZ CHOISIR LE TYPE BON OU CHOISISSEZ SEULEMENT LE CASH SANS BON DE COMMANDE,SANS SOCIETE ET  SANS LE NUMERO DE BON. ET SANS AUCUN POURCENTAGE'
					)
				);
			}

		if ($this->form_validation->run()) {
		 
			$id_patient_file = $this->input->post('patient_file_id');

			$MODIFIED_BY_FACTURE = $this->input->post('MODIFIED_BY_FACTURE');
			$DATE_MOD_FACTURE = $this->input->post('DATE_MOD_FACTURE');
		   
			if($MODIFIED_BY_FACTURE == '' || $MODIFIED_BY_FACTURE == null){ 
				$MODIFIED_BY_FACTURE = get_user_data('id');
			}else{
				$MODIFIED_BY_FACTURE = $MODIFIED_BY_FACTURE.','.get_user_data('id');
			}


		   if($DATE_MOD_FACTURE == '' || $DATE_MOD_FACTURE == null){
				$DATE_MOD_FACTURE = date('Y-m-d H:i:s'); 
			}else{
				$DATE_MOD_FACTURE = $DATE_MOD_FACTURE.','.date('Y-m-d H:i:s'); 
			}

			$save_data_patient_file = [ 
				'BON_DE_COMMANDE' => $this->input->post('BON_DE_COMMANDE'),
				'PATIENT_FILE_STATUS' => $this->input->post('PATIENT_FILE_STATUS'),
				'TYPE_DE_PAYEMET' => $this->input->post('TYPE_DE_PAYEMET'),
				'REF_SOCIETE' => $this->input->post('REF_SOCIETE'),
				'DOCTOR_ID' => $this->input->post('DOCTOR_ID'),
				'DEPARTEMENT_ID' => $this->input->post('DEPARTEMENT_ID'),
				'CONSULTATION' => $this->input->post('CONSULTATION'),
				'ACTES' => $this->input->post('ACTES'),
				'MEDICAMENTS' => $this->input->post('MEDICAMENTS'),
				'LABORATOIRE' => $this->input->post('LABORATOIRE'),
				'SEJOUR' => $this->input->post('SEJOUR'),
				'MEDICAMENT_MATER' => $this->input->post('MEDICAMENT_MATER'),
				'DATE_MOD_PATIENT_FILE' => date('Y-m-d H:i:s'),
				'MODIFIED_BY_PATIENT_FILE' => get_user_data('id'),
			];

			 

			$save_data = [
				// 'PATIENT_FILE_ID_FACTURE' => $this->input->post('PATIENT_FILE_ID_FACTURE'),
				// 'NUMERO_FACTURE' => $this->input->post('NUMERO_FACTURE'),
				// 'STORE_ID_FACTURE' => $this->input->post('STORE_ID_FACTURE'),
				'DATE_MOD_FACTURE' => $DATE_MOD_FACTURE,
				'MODIFIED_BY_FACTURE' => $MODIFIED_BY_FACTURE,
			];

			$save_patient_file = $this->model_patient_file->change($id_patient_file, $save_data_patient_file);
 
			$save_factures = $this->model_factures->change($id, $save_data);

			$indexliste = $this->input->post('indexliste');
			if (isset($indexliste)) {
               $lienRetour = '/index/'.$indexliste.'?';	
			}else {
               $lienRetour = '/index/'.$indexliste.'';	
			}
			if ($save_factures) {
				
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/factures'.$lienRetour, ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/factures'.$lienRetour);
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/factures'.$lienRetour);
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Facturess
	*
	* @var $id String
	*/
	public function delete($id = null)
	{ 
		$this->is_allowed('factures_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id,$commentValue);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id,$commentValue);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'factures'), 'success');
        } else {
            set_message(cclang('error_delete', 'factures'), 'error');
        }

		redirect('administrator/factures/index');
	}

		/**
	* View view Facturess
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('factures_view');

		$this->data['factures'] = $this->model_factures->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Factures Detail');
		$this->render('backend/standart/administrator/factures/factures_view', $this->data);
	}
	
	/**
	* delete Facturess
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$factures = $this->model_factures->find($id);
		
        $date_creation = date("Y-m-d H:i:s") ;
		$user = get_user_data('id'); 
		
		$patient_file_id = $factures->PATIENT_FILE_ID_FACTURE;		
		
							//   parcours de tous les storer pour changer les statut
                      $getStore = $this->db->query("SELECT * FROM pos_ibi_stores");
                       $nbre_strore = $getStore->num_rows();
                       if ($nbre_strore > 0) 
                       {
                       	  foreach ($getStore->result() as $key) 
                       	  {
                       	  	  $ids = $key->ID_STORE;		         
							  $delete_save_store = array(
													'DELETED_STATUS_HOSPITAL_IBI_COMMANDES' => 1,
													'DELETED_DATE_HOSPITAL_IBI_COMMANDES' => $date_creation,
													'DELETED_USER_HOSPITAL_IBI_COMMANDES' => get_user_data('id'),
													'DELETED_COMMENT_HOSPITAL_IBI_COMMANDES' => $commentValue
												);

							$remove_store = $this->db->update("pos_store_".$ids."_ibi_commandes",$delete_save_store,array("PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES"=>$patient_file_id));
							
							//get code for storer

							$get_store_code  = $this->db->query("select * from pos_store_".$ids."_ibi_commandes WHERE PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES='".$patient_file_id."'")->result();
							foreach ($get_store_code as $key_store_code) {
							
							 $get_info_article = $this->db->query("select * from pos_store_".$ids."_ibi_commandes_produits where REF_COMMAND_CODE='".$key_store_code->CODE."' ");

								if ($get_info_article->num_rows() >0) {
									
									foreach ($get_info_article->result() as $key) {
										$code_bar_article = $key->REF_PRODUCT_CODEBAR;
										$quantite = $key->QUANTITE;
										$name = $key->NAME;
										$update3 = $this->db->query("update pos_store_".$ids."_ibi_articles set  QUANTITY_ARTICLE=QUANTITY_ARTICLE+'".$quantite."' where CODEBAR_ARTICLE='".$code_bar_article."'");
									
										$stock_flow_table_articles = "pos_store_".$ids."_ibi_articles_stock_flow";
										$data_stock_flow_articles = [
											'DELETE_STATUS_SF' => 1,
											'DELETE_DATE_SF' => $date_creation,
											'DELETE_BY_SF' => get_user_data('id'),
											'DELETE_COMMENT_SF' => $commentValue,
										];
										$update_stock_flow = $this->db->update($stock_flow_table_articles,$data_stock_flow_articles,array("REF_ARTICLE_BARCODE_SF"=>$code_bar_article,"REF_COMMAND_CODE_SF"=>$key_store_code->CODE,"DATE_CREATION_SF"=>$key->DATE_COMMANDE_PRODUITS));
 
									
									}
                             
								}

								 $delete_save_c_p_store = array(
								'DELETED_STATUS_HOSPITAL_IBI_COMMANDES_PRODUITS' => 1,
								'DELETED_DATE_HOSPITAL_IBI_COMMANDES_PRODUITS' => $date_creation,
								'DELETED_USER_HOSPITAL_IBI_COMMANDES_PRODUITS' => get_user_data('id'),
								'DELETED_COMMENT_HOSPITAL_IBI_COMMANDES_PRODUITS' => $commentValue
								);

								
							$remove_C_P_store = $this->db->update("pos_store_".$ids."_ibi_commandes_produits",$delete_save_c_p_store,array("ID_HOSPITAL_IBI_COMMANDES_PRODUITS"=>$hospital_ibi_commandes_produits->ID_HOSPITAL_IBI_COMMANDES_PRODUITS));

	                       }
	
						}
	        		}
		         
					$delete_save = array(
											'DELETED_STATUS_HOSPITAL_IBI_COMMANDES' => 1,
											'DELETED_DATE_HOSPITAL_IBI_COMMANDES' => $date_creation,
											'DELETED_USER_HOSPITAL_IBI_COMMANDES' => get_user_data('id'),
											'DELETED_COMMENT_HOSPITAL_IBI_COMMANDES' => $commentValue
					);

					$remove_commandes = $this->db->update("hospital_ibi_commandes",$delete_save,array("PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES"=>$patient_file_id));

				
							  

                     $update4 = $this->db->query("update labo_exam_movement_to_patient set MOVEMENT_STATUS_DELETE=1, MOVEMENT_DELETE_BY='".$user."', MOVEMENT_DELETE_DATE='".$date_creation."',MOVEMENT_DELETE_COMMENT='".$commentValue."' where MOVEMENT_PATIENT_FILE_ID='".$patient_file_id."'");
				  
				   $get_commandes_codes = $this->db->query("select * from hospital_ibi_commandes where PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES=".$patient_file_id)->result();
		  			foreach ($get_commandes_codes as $hospital_ibi_commandes) {
					
					 $get_all_produits = $this->db->query("select * from hospital_ibi_commandes_produits where REF_COMMAND_CODE='".$hospital_ibi_commandes->CODE."'");
					 foreach ($get_all_produits->result() as $hospital_ibi_commandes_produits) {
						   $delete_save_c_p = array(
								'DELETED_STATUS_HOSPITAL_IBI_COMMANDES_PRODUITS' => 1,
								'DELETED_DATE_HOSPITAL_IBI_COMMANDES_PRODUITS' => $date_creation,
								'DELETED_USER_HOSPITAL_IBI_COMMANDES_PRODUITS' => get_user_data('id'),
								'DELETED_COMMENT_HOSPITAL_IBI_COMMANDES_PRODUITS' => $commentValue
										);

								$store_id = $hospital_ibi_commandes_produits->STORE_ID_HOSPITAL_IBI_COMMANDES_PRODUITS;
								if ($store_id > 0) {
									// update articles
									$article_table = "pos_store_".$store_id."_ibi_articles";
									
									$update_Articles = $this->db->query("UPDATE ".$article_table." SET QUANTITY_ARTICLE=QUANTITY_ARTICLE+".$hospital_ibi_commandes_produits->QUANTITE.",DATE_MOD_ARTICLE= '" .$date_creation."',MODIFIED_BY_ARTICLE = '".get_user_data('id')."' WHERE CODEBAR_ARTICLE = '".$hospital_ibi_commandes_produits->REF_PRODUCT_CODEBAR."' ");

								// update stock_flow table
									$stock_flow_table = "pos_store_".$store_id."_ibi_articles_stock_flow";
									$data_stock_flow = [
										'DELETE_STATUS_SF' => 1,
										'DELETE_DATE_SF' => $date_creation,
										'DELETE_BY_SF' => get_user_data('id'),
										'DELETE_COMMENT_SF' => $commentValue,
									];
									$update_stock_flow = $this->db->update($stock_flow_table,$data_stock_flow,array("REF_ARTICLE_BARCODE_SF"=>$hospital_ibi_commandes_produits->REF_PRODUCT_CODEBAR,"REF_COMMAND_CODE_SF"=>$hospital_ibi_commandes_produits->REF_COMMAND_CODE,"DATE_CREATION_SF"=>$hospital_ibi_commandes_produits->DATE_COMMANDE_PRODUITS));
 
								}
							$remove_C_P = $this->db->update("hospital_ibi_commandes_produits",$delete_save_c_p,array("ID_HOSPITAL_IBI_COMMANDES_PRODUITS"=>$hospital_ibi_commandes_produits->ID_HOSPITAL_IBI_COMMANDES_PRODUITS));
		
					 }
				}

					 
				
		         	$delete_save_patient_file = array(
								'DELETED_STATUS_PATIENT_FILE' => 1,
								'DELETED_DATE_PATIENT_FILE' => $date_creation,
								'DELETED_USER_PATIENT_FILE' => get_user_data('id'),
								'DELETED_COMMENT_PATIENT_FILE' => $commentValue
							);

		        $update = $this->db->update("patient_file",$delete_save_patient_file,array("PATIENT_FILE_ID"=>$patient_file_id));
		
				     
				$delete_save = array(
										'DELETED_STATUS_FACTURE' => 1,
										'DELETED_DATE_FACTURE' => $date_creation,
										'DELETED_USER_FACTURE' => $user,
										'DELETED_COMMENT_FACTURE' => $commentValue
									);

				$remove = $this->db->update("factures",$delete_save,array("ID_FACTURE"=>$id));

		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('factures_export');

		$this->model_factures->export('factures', 'factures');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('factures_export');
		$this->model_factures->pdf('factures', 'factures');
	}

	
	public function view_retirer_lit($id)
	{
		$this->is_allowed('factures_view');

		$this->data['factures'] = $this->model_factures->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Facturation Detail');
		$this->render('backend/standart/administrator/factures/factures_view_retirer_lit/'.$id, $this->data);

	}

	
	    public function view_detail_facture($id)
		{
				$this->is_allowed('factures_view');
				$this->data['factures'] = $this->model_factures->join_avaiable()->filter_avaiable()->find($id);
                 
				$this->template->title('Facture separee');
				$this->render('backend/standart/administrator/factures/factures_view_client_assurance', $this->data);
	
		}
		
		
	public function verifier($departement_id = null)
	{
		$this->is_allowed('factures_update');

		$this->load->helper('file');
 
		$facture_id = $this->input->get('facture_id');
		$arr_id = $this->input->get('departement_id');
		$patient_file_id = $this->input->get('patient_file_id');
		print_r($arr_id);
		$verified = false;

		if (!empty($departement_id)) {
			$verified = $this->_verifier_categorie($departement_id,$patient_file_id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $departement_id) {
				$verified = $this->_verifier_categorie($departement_id,$patient_file_id);
			}
		} 

		if ($verified) {
            set_message('Bien verifier'.$verified, 'success');
        } else {
            set_message('Echec de verification'.$verified, 'error');
        }

		redirect('administrator/factures/view/'.$facture_id);
	}


	public function _verifier_categorie($departement_id, $patient_file_id)
	{
		 $verification_data = array(
				'VERIFICATION' => 1,
				'VERIFIED_BY' => get_user_data('id')
		  );

		$get_boutique = $this->db->query("SELECT * FROM pos_ibi_stores ");
		$table_name = array();
		$table_name[] = 'hospital_ibi_commandes_produits';
		if ($get_boutique->num_rows() >0) {
			foreach ($get_boutique->result() as $key_boutiques) {
				$table_name[] = 'pos_store_'.$key_boutiques->ID_STORE.'_ibi_commandes_produits';
			}
		}

			$table_name_commandes = array();
			$table_name_commandes[] = 'hospital_ibi_commandes';
			if ($get_boutique->num_rows() >0) {
				foreach ($get_boutique->result() as $key_boutiques) {
					$table_name_commandes[] = 'pos_store_'.$key_boutiques->ID_STORE.'_ibi_commandes';	 
				}
			}
		
		$mise_ajours = 0;
		for ($i=0; $i < count($table_name); $i++) { 
				 $query = 'UPDATE '.$table_name[$i].' SET VERIFICATION=1,VERIFIED_BY ='.get_user_data('id').' WHERE DEPARTMENT='.$departement_id.' AND REF_COMMAND_CODE IN (SELECT CODE FROM '.$table_name_commandes[$i].' WHERE PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES='.$patient_file_id.' );';	 
		        $mise_ajours = $mise_ajours+$this->db->query($query);
		}
		
        return $mise_ajours;
	}

	
}


/* End of file factures.php */
/* Location: ./application/controllers/administrator/Factures.php */