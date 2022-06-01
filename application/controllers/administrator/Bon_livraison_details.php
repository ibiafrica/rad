<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Bon Livraison Details Controller
*| --------------------------------------------------------------------------
*| Bon Livraison Details site
*|
*/
class Bon_livraison_details extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_bon_livraison_details');
		$this->load->model('model_rm');
		$this->load->model('model_registers');
	}

	/**
	* show all Bon Livraison Detailss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('bon_livraison_details_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['bon_livraison_detailss'] = $this->model_bon_livraison_details->get($filter, $field, $this->limit_page, $offset);
		$this->data['bon_livraison_details_counts'] = $this->model_bon_livraison_details->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/bon_livraison_details/index/',
			'total_rows'   => $this->model_bon_livraison_details->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Bon Livraison Details List');
		$this->render('backend/standart/administrator/bon_livraison_details/bon_livraison_details_list', $this->data);
	}
	
	/**
	* Add new bon_livraison_detailss
	*
	*/
	public function add()
	{
		$this->is_allowed('bon_livraison_details_add');

		$this->template->title('Bon Livraison Details New');
		$this->render('backend/standart/administrator/bon_livraison_details/bon_livraison_details_add', $this->data);
	}

	/**
	* Add New Bon Livraison Detailss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('bon_livraison_details_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('REF_BON_LIVRAISON', 'REF BON LIVRAISON', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('CODE_PRODUIT_BLD', 'CODE PRODUIT BLD', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('NOM_PRODUIT_BLD', 'NOM PRODUIT BLD', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('PRIX_UNITAIRE_BLD', 'PRIX UNITAIRE BLD', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('QUANTITE_BLD', 'QUANTITE BLD', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('PRIX_TOTAL_BLD', 'PRIX TOTAL BLD', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('STATUS_BLD', 'STATUS BLD', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'REF_BON_LIVRAISON' => $this->input->post('REF_BON_LIVRAISON'),
				'CODE_PRODUIT_BLD' => $this->input->post('CODE_PRODUIT_BLD'),
				'NOM_PRODUIT_BLD' => $this->input->post('NOM_PRODUIT_BLD'),
				'PRIX_UNITAIRE_BLD' => $this->input->post('PRIX_UNITAIRE_BLD'),
				'QUANTITE_BLD' => $this->input->post('QUANTITE_BLD'),
				'PRIX_TOTAL_BLD' => $this->input->post('PRIX_TOTAL_BLD'),
				'STATUS_BLD' => $this->input->post('STATUS_BLD'),
			];

			
			$save_bon_livraison_details = $this->model_bon_livraison_details->store($save_data);

			if ($save_bon_livraison_details) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_bon_livraison_details;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/bon_livraison_details/edit/' . $save_bon_livraison_details, 'Edit Bon Livraison Details'),
						anchor('administrator/bon_livraison_details', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/bon_livraison_details/edit/' . $save_bon_livraison_details, 'Edit Bon Livraison Details')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bon_livraison_details');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bon_livraison_details');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Bon Livraison Detailss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('bon_livraison_details_update');

		$this->data['bon_livraison_details'] = $this->model_bon_livraison_details->find($id);

		$this->template->title('Bon Livraison Details Update');
		$this->render('backend/standart/administrator/bon_livraison_details/bon_livraison_details_update', $this->data);
	}

	/**
	* Update Bon Livraison Detailss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('bon_livraison_details_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('REF_BON_LIVRAISON', 'REF BON LIVRAISON', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('CODE_PRODUIT_BLD', 'CODE PRODUIT BLD', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('NOM_PRODUIT_BLD', 'NOM PRODUIT BLD', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('PRIX_UNITAIRE_BLD', 'PRIX UNITAIRE BLD', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('QUANTITE_BLD', 'QUANTITE BLD', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('PRIX_TOTAL_BLD', 'PRIX TOTAL BLD', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('STATUS_BLD', 'STATUS BLD', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'REF_BON_LIVRAISON' => $this->input->post('REF_BON_LIVRAISON'),
				'CODE_PRODUIT_BLD' => $this->input->post('CODE_PRODUIT_BLD'),
				'NOM_PRODUIT_BLD' => $this->input->post('NOM_PRODUIT_BLD'),
				'PRIX_UNITAIRE_BLD' => $this->input->post('PRIX_UNITAIRE_BLD'),
				'QUANTITE_BLD' => $this->input->post('QUANTITE_BLD'),
				'PRIX_TOTAL_BLD' => $this->input->post('PRIX_TOTAL_BLD'),
				'STATUS_BLD' => $this->input->post('STATUS_BLD'),
			];

			
			$save_bon_livraison_details = $this->model_bon_livraison_details->change($id, $save_data);

			if ($save_bon_livraison_details) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/bon_livraison_details', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bon_livraison_details');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/bon_livraison_details');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Bon Livraison Detailss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('bon_livraison_details_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		$produit = $this->model_registers->getOne('bon_livraison_details', array('ID_BLD'=>$id));
		$store_data = $this->model_registers->getOne('pos_store_1_ibi_articles', array('CODEBAR_ARTICLE'=>$produit->CODE_PRODUIT_BLD));
		$new_stock = $produit->QUANTITE_BLD + $store_data->QUANTITY_ARTICLE;
		$update_stock = $this->model_registers->update('pos_store_1_ibi_articles', array('CODEBAR_ARTICLE'=>$produit->CODE_PRODUIT_BLD), array('QUANTITY_ARTICLE'=>$new_stock));

		$remove = $this->_remove($id);

		if ($remove) {
            set_message(cclang('has_been_deleted', 'bon_livraison_details'), 'success');
        } else {
            set_message(cclang('error_delete', 'bon_livraison_details'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Bon Livraison Detailss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('bon_livraison_details_view');

		$this->data['bon_livraison_details'] = $this->model_bon_livraison_details->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Bon Livraison Details Detail');
		$this->render('backend/standart/administrator/bon_livraison_details/bon_livraison_details_view', $this->data);
	}
	
	/**
	* delete Bon Livraison Detailss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		// $bon_livraison_details = $this->model_bon_livraison_details->find($id);
     
		$delete_save = array('STATUS_DELETE_BLD' => 1 );

		        $remove = $this->model_rm->update("bon_livraison_details",array("ID_BLD"=>$id),$delete_save);
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('bon_livraison_details_export');

		$this->model_bon_livraison_details->export('bon_livraison_details', 'bon_livraison_details');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('bon_livraison_details_export');

		$this->model_bon_livraison_details->pdf('bon_livraison_details', 'bon_livraison_details');
	}
}


/* End of file bon_livraison_details.php */
/* Location: ./application/controllers/administrator/Bon Livraison Details.php */