<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Type Ajustement Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Type Ajustement site
*|
*/
class pos_ibi_type_ajustement extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_ibi_type_ajustement');
	}

	/**
	* show all Pos Ibi Type Ajustements
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_ibi_type_ajustement_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_ibi_type_ajustements'] = $this->model_pos_ibi_type_ajustement->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_ibi_type_ajustement_counts'] = $this->model_pos_ibi_type_ajustement->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_ibi_type_ajustement/index/',
			'total_rows'   => $this->model_pos_ibi_type_ajustement->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Ajustement List');
		$this->render('backend/standart/administrator/pos_ibi_type_ajustement/pos_ibi_type_ajustement_list', $this->data);
	}
	
	/**
	* Add new pos_ibi_type_ajustements
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_ibi_type_ajustement_add');

		$this->template->title('Ajustement New');
		$this->render('backend/standart/administrator/pos_ibi_type_ajustement/pos_ibi_type_ajustement_add', $this->data);
	}

	/**
	* Add New Pos Ibi Type Ajustements
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pos_ibi_type_ajustement_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('AJUSTEMENT_NAME', 'Ajustement', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'AJUSTEMENT_NAME' => $this->input->post('AJUSTEMENT_NAME'),
				'DESCRIPTION_AJUSTEMENT' => $this->input->post('DESCRIPTION_AJUSTEMENT'),
				'DATE_CREATION_AJUSTEMENT' => date('Y-m-d H:i:s'),
				'CREATE_BY_AJUSTEMENT' => get_user_data('id'),			];

			
			$save_pos_ibi_type_ajustement = $this->model_pos_ibi_type_ajustement->store($save_data);

			if ($save_pos_ibi_type_ajustement) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_type_ajustement;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_ibi_type_ajustement/edit/' . $save_pos_ibi_type_ajustement, 'Edit Pos Ibi Type Ajustement'),
						anchor('administrator/pos_ibi_type_ajustement', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_ibi_type_ajustement/edit/' . $save_pos_ibi_type_ajustement, 'Edit Pos Ibi Type Ajustement')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_type_ajustement');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_type_ajustement');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Type Ajustements
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pos_ibi_type_ajustement_update');

		$this->data['pos_ibi_type_ajustement'] = $this->model_pos_ibi_type_ajustement->find($id);

		$this->template->title('Ajustement Update');
		$this->render('backend/standart/administrator/pos_ibi_type_ajustement/pos_ibi_type_ajustement_update', $this->data);
	}

	/**
	* Update Pos Ibi Type Ajustements
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_ibi_type_ajustement_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('AJUSTEMENT_NAME', 'Ajustement', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'AJUSTEMENT_NAME' => $this->input->post('AJUSTEMENT_NAME'),
				'DESCRIPTION_AJUSTEMENT' => $this->input->post('DESCRIPTION_AJUSTEMENT'),
				'DATE_CREATION_AJUSTEMENT' => date('Y-m-d H:i:s'),
				'CREATE_BY_AJUSTEMENT' => get_user_data('id'),			];

			
			$save_pos_ibi_type_ajustement = $this->model_pos_ibi_type_ajustement->change($id, $save_data);

			if ($save_pos_ibi_type_ajustement) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_ibi_type_ajustement', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_type_ajustement');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_type_ajustement');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Type Ajustements
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_ibi_type_ajustement_delete');

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
            set_message(cclang('has_been_deleted', 'pos_ibi_type_ajustement'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_ibi_type_ajustement'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Type Ajustements
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_ibi_type_ajustement_view');

		$this->data['pos_ibi_type_ajustement'] = $this->model_pos_ibi_type_ajustement->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Ajustement Detail');
		$this->render('backend/standart/administrator/pos_ibi_type_ajustement/pos_ibi_type_ajustement_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Type Ajustements
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_ibi_type_ajustement = $this->model_pos_ibi_type_ajustement->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS' => 1,
								'DELETED_DATE' => date('Y-m-d H:i:s'),
								'DELETED_USER' => get_user_data('id'),
								
							);

		        $remove = $this->db->update("pos_ibi_type_ajustement",$delete_save,array("AJUSTEMENT_ID"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_ibi_type_ajustement_export');

		$this->model_pos_ibi_type_ajustement->export('pos_ibi_type_ajustement', 'pos_ibi_type_ajustement');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_ibi_type_ajustement_export');

		$this->model_pos_ibi_type_ajustement->pdf('pos_ibi_type_ajustement', 'pos_ibi_type_ajustement');
	}
}


/* End of file pos_ibi_type_ajustement.php */
/* Location: ./application/controllers/administrator/Pos Ibi Type Ajustement.php */