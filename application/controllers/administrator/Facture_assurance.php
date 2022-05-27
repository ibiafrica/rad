<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Facture Assurance Controller
*| --------------------------------------------------------------------------
*| Facture Assurance site
*|
*/
class Facture_assurance extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_facture_assurance');
		$this->load->model('model_departements');
	}

	/**
	* show all Facture Assurances
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{ 
		$offset = $offset/10*100;
		$this->is_allowed('facture_assurance_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$date_debut = $this->input->get('date_debut');

		// if ($date_debut) {
		// 	$this->data['facture_assurances'] = $this->model_facture_assurance->get($date_debut,$filter, $field, $this->limit_page, $offset);
		// 	$this->data['facture_assurance_counts'] = $this->model_facture_assurance->count_all($filter, $field);
		// }else {	
			$this->data['facture_assurances'] = $this->model_facture_assurance->get($date_debut,$filter, $field, 100, $offset);
			$this->data['facture_assurance_counts'] = $this->model_facture_assurance->count_all($date_debut,$filter, $field);
		// }


		$config = [
			'base_url'     => 'administrator/facture_assurance/index/',
			'total_rows'   => $this->model_facture_assurance->count_all($filter, $field),
			'per_page'     => 100,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Facture Assurance List');
		$this->render('backend/standart/administrator/facture_assurance/facture_assurance_list', $this->data);
	}
	
	/**
	* Add new facture_assurances
	*
	*/
	public function add()
	{
		$this->is_allowed('facture_assurance_add');

		$this->template->title('Facture Assurance New');
		$this->render('backend/standart/administrator/facture_assurance/facture_assurance_add', $this->data);
	}

	/**
	* Add New Facture Assurances
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('facture_assurance_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NUMERO_FACTURE_ASSURANCE', 'Numéro', 'trim|required');
		$this->form_validation->set_rules('SOCIETE_FACTURE_ASSURANCE', 'Société', 'trim|required');
		$this->form_validation->set_rules('MONTANT_FACTURE_ASSURANCE', 'Montant', 'trim|required');
		$this->form_validation->set_rules('STATUS_FACTURE_ASSURANCE[]', 'Status', 'trim|required');
		$this->form_validation->set_rules('TYPE_PATIENT_FACTURE_ASSURANCE', 'Type De Patient', 'trim|required|max_length[3]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NUMERO_FACTURE_ASSURANCE' => $this->input->post('NUMERO_FACTURE_ASSURANCE'),
				'SOCIETE_FACTURE_ASSURANCE' => $this->input->post('SOCIETE_FACTURE_ASSURANCE'),
				'FACTURE_ASSURANCE_DATE' => $this->input->post('FACTURE_ASSURANCE_DATE'),
				'MONTANT_FACTURE_ASSURANCE' => $this->input->post('MONTANT_FACTURE_ASSURANCE'),
				'STATUS_FACTURE_ASSURANCE' => implode(',', (array) $this->input->post('STATUS_FACTURE_ASSURANCE')),
				'TYPE_PATIENT_FACTURE_ASSURANCE' => $this->input->post('TYPE_PATIENT_FACTURE_ASSURANCE'),
				'DATE_CREATION_FACTURE_ASSURANCE' => date('Y-m-d H:i:s'),
				'CREATED_BY_FACTURE_ASSURANCE' => get_user_data('id'),			];

			
			$save_facture_assurance = $this->model_facture_assurance->store($save_data);

			if ($save_facture_assurance) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_facture_assurance;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/facture_assurance/edit/' . $save_facture_assurance, 'Edit Facture Assurance'),
						anchor('administrator/facture_assurance', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/facture_assurance/edit/' . $save_facture_assurance, 'Edit Facture Assurance')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/facture_assurance');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/facture_assurance');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Facture Assurances
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('facture_assurance_update');

		$this->data['facture_assurance'] = $this->model_facture_assurance->find($id);

		$this->template->title('Facture Assurance Update');
		$this->render('backend/standart/administrator/facture_assurance/facture_assurance_update', $this->data);
	}

	/**
	* Update Facture Assurances
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('facture_assurance_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NUMERO_FACTURE_ASSURANCE', 'Numéro', 'trim|required');
		$this->form_validation->set_rules('SOCIETE_FACTURE_ASSURANCE', 'Société', 'trim|required');
		$this->form_validation->set_rules('MONTANT_FACTURE_ASSURANCE', 'Montant', 'trim|required');
		$this->form_validation->set_rules('STATUS_FACTURE_ASSURANCE[]', 'Status', 'trim|required');
		$this->form_validation->set_rules('TYPE_PATIENT_FACTURE_ASSURANCE', 'Type De Patient', 'trim|required|max_length[3]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NUMERO_FACTURE_ASSURANCE' => $this->input->post('NUMERO_FACTURE_ASSURANCE'),
				'SOCIETE_FACTURE_ASSURANCE' => $this->input->post('SOCIETE_FACTURE_ASSURANCE'),
				'FACTURE_ASSURANCE_DATE' => $this->input->post('FACTURE_ASSURANCE_DATE'),
				'MONTANT_FACTURE_ASSURANCE' => $this->input->post('MONTANT_FACTURE_ASSURANCE'),
				'STATUS_FACTURE_ASSURANCE' => implode(',', (array) $this->input->post('STATUS_FACTURE_ASSURANCE')),
				'TYPE_PATIENT_FACTURE_ASSURANCE' => $this->input->post('TYPE_PATIENT_FACTURE_ASSURANCE'),
				'DATE_MOD_FACTURE_ASSURANCE' => date('Y-m-d H:i:s'),
				'MODIFIED_BY_FACTURE_ASSURANCE' => get_user_data('id'),			];

			
			$save_facture_assurance = $this->model_facture_assurance->change($id, $save_data);

			if ($save_facture_assurance) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/facture_assurance', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/facture_assurance');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/facture_assurance');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Facture Assurances
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('facture_assurance_delete');

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
            set_message(cclang('has_been_deleted', 'facture_assurance'), 'success');
        } else {
            set_message(cclang('error_delete', 'facture_assurance'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Facture Assurances
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('facture_assurance_view');

		$this->data['facture_assurance'] = $this->model_facture_assurance->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Facture Assurance Detail');
		$this->render('backend/standart/administrator/facture_assurance/facture_assurance_view', $this->data);
	}
	
	/**
	* delete Facture Assurances
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$facture_assurance = $this->model_facture_assurance->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_FACTURE_ASSURANCE' => 1,
								'DELETED_DATE_FACTURE_ASSURANCE' => date('Y-m-d H:i:s'),
								'DELETED_USER_FACTURE_ASSURANCE' => get_user_data('id'),
								'DELETED_COMMENT_FACTURE_ASSURANCE' => $commentValue
							);

		        $remove = $this->db->update("facture_assurance",$delete_save,array("ID_FACTURE_ASSURANCE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('facture_assurance_export');

		$this->model_facture_assurance->export('facture_assurance', 'facture_assurance');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('facture_assurance_export');

		$this->model_facture_assurance->pdf('facture_assurance', 'facture_assurance');
	}

	public function payer($id)
	{
		 $delete_save = array(
			                   'STATUS_FACTURE_ASSURANCE' => 1,
								'DATE_MOD_FACTURE_ASSURANCE' => date('Y-m-d H:i:s'),
								'MODIFIED_BY_FACTURE_ASSURANCE' => get_user_data('id') ,
							);

				$remove = $this->db->update("facture_assurance",$delete_save,array("ID_FACTURE_ASSURANCE"=>$id));
				
			if ($remove) {
				set_message('PAYEMENT AVEC SUCCESS', 'success');
			} else {
				set_message('ECHEC DE PAYEMENT', 'error');
			}

			redirect_back();
	}
}


/* End of file facture_assurance.php */
/* Location: ./application/controllers/administrator/Facture Assurance.php */