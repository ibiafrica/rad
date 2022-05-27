<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Clients Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Clients site
*|
*/
class Clients extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_clients');
		$this->load->model('model_registers');
	}

	/**
	* show all Pos Ibi Clientss
	*
	* @var $offset String
	*/
	public function index($store = 0, $offset = 0)
	{
		$this->is_allowed('clients_list');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['clientss'] = $this->model_clients->get($filter, $field, $this->limit_page, $offset);
		$this->data['clients_counts'] = $this->model_clients->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/clients/index/'.$store.'/',
			'total_rows'   => $this->model_clients->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 5,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Liste des clients');
		$this->render('backend/standart/administrator/clients/clients_list', $this->data);
	}
	
	/**
	* Add new clientss
	*
	*/
	public function add($store = 0)
	{
		$this->is_allowed('clients_add');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
		$this->template->title('Nouveau client');
		$this->render('backend/standart/administrator/clients/clients_add', $this->data);
	}
	/**
	* Add New Pos Ibi Clientss
	*
	* @return JSON
	*/
	public function add_save($store)
	{
		if (!$this->is_allowed('clients_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
        
        $this->form_validation->set_rules('REF_GROUP_CLIENT', 'Groupe client', 'trim|required');
		$this->form_validation->set_rules('NOM_CLIENT', 'Nom', 'trim|required');
		$this->form_validation->set_rules('NUMBER_COMPTE_CLIENT', 'Number compte client', 'trim|required');
		$this->form_validation->set_rules('ASSUGETI_TVA_CLIENT', 'Assugeti TVA', 'trim|required');

		if($this->input->post('REF_GROUP_CLIENT') == 12 OR $this->input->post('REF_GROUP_CLIENT') == 13){
		 $this->form_validation->set_rules('STATE_CLIENT', 'Nif client', 'trim|required');
		}

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM_CLIENT' => $this->input->post('NOM_CLIENT'),
				'TEL_CLIENT' => $this->input->post('TEL_CLIENT'),
				'TEL_2_CLIENT' => $this->input->post('TEL_2_CLIENT'),
				'NUMBER_COMPTE_CLIENT' => $this->input->post('NUMBER_COMPTE_CLIENT'),
				'EMAIL_CLIENT' => $this->input->post('EMAIL_CLIENT'),
				'ASSUGETI_TVA_CLIENT' => $this->input->post('ASSUGETI_TVA_CLIENT'),
				'STATE_CLIENT' => $this->input->post('STATE_CLIENT'),
				'COUNTRY_CLIENT' => $this->input->post('COUNTRY_CLIENT'),
				'CITY_CLIENT' => $this->input->post('CITY_CLIENT'),
				'QUARTIER_CLIENT' => $this->input->post('QUARTIER_CLIENT'),
				'ADRESSE_CLIENT' => $this->input->post('ADRESSE_CLIENT'),
				'BP_CLIENT' => $this->input->post('BP_CLIENT'),
				'DATE_CREATION_CLIENT' => date('Y-m-d H:i:s'),
				'REF_GROUP_CLIENT' => $this->input->post('REF_GROUP_CLIENT'),
				'AUTHOR_CLIENT' => get_user_data('id'),			];

			$save_clients = $this->model_clients->store($save_data);

			if ($save_clients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_clients;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/clients/edit/'.$store.'/' . $save_clients, 'Edit Pos Ibi Clients'),
						anchor('administrator/clients/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/clients/edit/'.$store.'/' . $save_clients, 'Edit Pos Ibi Clients')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/clients/index/'.$store.'');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/clients/index/'.$store.'');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Clientss
	*
	* @var $id String
	*/
	public function edit($store = 0,$id)
	{
		$this->is_allowed('clients_update');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

		$this->data['clients'] = $this->model_clients->find($id);

		$this->template->title('Modifier client');
		$this->render('backend/standart/administrator/clients/clients_update', $this->data);
	}

	/**
	* Update Pos Ibi Clientss
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		if (!$this->is_allowed('clients_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('REF_GROUP_CLIENT', 'Groupe client', 'trim|required');
		$this->form_validation->set_rules('NOM_CLIENT', 'Nom', 'trim|required');
		$this->form_validation->set_rules('NUMBER_COMPTE_CLIENT', 'Number compte client', 'trim|required');
		$this->form_validation->set_rules('ASSUGETI_TVA_CLIENT', 'Assugeti TVA', 'trim|required');

		if($this->input->post('REF_GROUP_CLIENT') == 12 OR $this->input->post('REF_GROUP_CLIENT') == 13){
		 $this->form_validation->set_rules('STATE_CLIENT', 'Nif client', 'trim|required');
		}
		
		if ($this->form_validation->run()) {

			$save_data = [
				'NOM_CLIENT' => $this->input->post('NOM_CLIENT'),
				'TEL_CLIENT' => $this->input->post('TEL_CLIENT'),
				'TEL_2_CLIENT' => $this->input->post('TEL_2_CLIENT'),
				'NUMBER_COMPTE_CLIENT' => $this->input->post('NUMBER_COMPTE_CLIENT'),
				'EMAIL_CLIENT' => $this->input->post('EMAIL_CLIENT'),
				'ASSUGETI_TVA_CLIENT' => $this->input->post('ASSUGETI_TVA_CLIENT'),
				'STATE_CLIENT' => $this->input->post('STATE_CLIENT'),
				'COUNTRY_CLIENT' => $this->input->post('COUNTRY_CLIENT'),
				'CITY_CLIENT' => $this->input->post('CITY_CLIENT'),
				'QUARTIER_CLIENT' => $this->input->post('QUARTIER_CLIENT'),
				'ADRESSE_CLIENT' => $this->input->post('ADRESSE_CLIENT'),
				'BP_CLIENT' => $this->input->post('BP_CLIENT'),
				'DATE_MOD_CLIENT' => date('Y-m-d H:i:s'),
				'REF_GROUP_CLIENT' => $this->input->post('REF_GROUP_CLIENT'),
				'AUTHOR_CLIENT' => get_user_data('id'),			];
			
			$save_clients = $this->model_clients->change($id, $save_data);

			if ($save_clients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/clients/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/clients/index/'.$store.'');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/clients/index/'.$store.'');
				}
			}
		} 
		else{
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Clientss
	*
	* @var $id String
	*/
	public function delete($store,$id = null)
	{
		$this->is_allowed('clients_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'clients'), 'success');
        } else {
            set_message(cclang('error_delete', 'clients'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Clientss
	*
	* @var $id String
	*/
	public function view($store = 0, $id_client)
	{
		$this->is_allowed('clients_view');
		if($store == 0){

	        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
				redirect('administrator/store');
	             
	        }
	   $query=$this->db->query('SELECT ID_FILE, NAME_FILE,NUMERO_FILE,REF_CLIENT_FILE,PATH_FILE,NOM_CLIENT,AUTHOR_FILE,DATE_CREATION_FILE  FROM pos_ibi_client_file, pos_ibi_clients WHERE pos_ibi_client_file.REF_CLIENT_FILE=pos_ibi_clients.ID_CLIENT AND REF_CLIENT_FILE='.$id_client);
	    $INFORMATION_CLIENT_FILE=$query->result();

	     $facture=$this->db->query('SELECT NOM_CLIENT,NUMERO_FACTURE,REF_CODE_COMMAND_FACTURE,TYPE_FACTURE,STORE_BY_FACTURE,DATE_CREATION_FACTURE,AUTHOR_FACTURE,	ID_CLIENT,ID_FACTURE,STORE_BY_FACTURE FROM pos_ibi_clients,pos_ibi_facture WHERE  pos_ibi_facture.REF_CLIENT_FACTURE =pos_ibi_clients.ID_CLIENT AND STATUT_FACTURE=0 AND ID_CLIENT='.$id_client );
	    $FACTURE=$facture->result();

	    $proforma=$this->db->query('SELECT REF_CLIENT_PROFORMA,NOM_CLIENT,CODE_PROFORMA,REF_CODE_COMMAND_PROFORMA,TITRE_PROFORMA,TYPE_PROFORMA,TOTAL_PROFORMA,DATE_CREATION_PROFORMA,DATE_MOD_PROFORMA,PAYMENT_TYPE_PROFORMA,ID_PROFORMA,AUTHOR_PROFORMA FROM pos_ibi_clients,pos_store_'.$store.'_ibi_proforma where pos_store_'.$store.'_ibi_proforma.REF_CLIENT_PROFORMA=pos_ibi_clients.ID_CLIENT AND STATUT_PROFORMA=0 AND ID_CLIENT='.$id_client);
	    $PROFORMA=$proforma->result();

		$getone_client=$this->model_clients->getone('pos_ibi_clients',array('ID_CLIENT' =>$id_client, ));

	    $getone_client_pays=$this->model_clients->getone('pays',array('ID' =>$getone_client['COUNTRY_CLIENT'], ));

	    $getone_client_ville=$this->model_clients->getone('ville',array('ID_VILLE' =>$getone_client['CITY_CLIENT'], ));
	    $getone_client_quartier=$this->model_clients->getone('quartier',array('ID_QUARTIER' =>$getone_client['QUARTIER_CLIENT'], ));
   
		
		$this->data['PAYS']= $getone_client_pays;	
		$this->data['VILLE']= $getone_client_ville;	
		$this->data['QUARTIER']= $getone_client_quartier;	
		$this->data['factures']= $FACTURE;	
		$this->data['clients_files'] = $INFORMATION_CLIENT_FILE;
		$this->data['proformas']= $PROFORMA;
		$this->data['clients'] = $this->model_clients->join_avaiable()->filter_avaiable()->find($id_client);

	    $this->template->title('Details du client');
		$this->render('backend/standart/administrator/clients/clients_view', $this->data);
	}
	 /**
	* delete Pos Ibi Clientss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$clients = $this->model_clients->find($id);

		return $this->model_clients->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export($store)
	{
		$this->is_allowed('clients_export');

		$this->model_clients->export('pos_ibi_clients', 'pos_ibi_clients');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf($store)
	{
		$this->is_allowed('clients_export');

		$this->model_clients->pdf('pos_ibi_clients', 'pos_ibi_clients');
	}

}


/* End of file clients.php */
/* Location: ./application/controllers/administrator/Pos Ibi Clients.php */