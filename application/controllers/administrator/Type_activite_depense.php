<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Type Activite Depense Controller
*| --------------------------------------------------------------------------
*| Type Activite Depense site
*|
*/
class Type_activite_depense extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_type_activite_depense');
	}

	/**
	* show all Type Activite Depenses
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('type_activite_depense_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['type_activite_depenses'] = $this->model_type_activite_depense->get($filter, $field, $this->limit_page, $offset);
		$this->data['type_activite_depense_counts'] = $this->model_type_activite_depense->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/type_activite_depense/index/',
			'total_rows'   => $this->model_type_activite_depense->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Type Activite Depense List');
		$this->render('backend/standart/administrator/type_activite_depense/type_activite_depense_list', $this->data);
	}
	
	/**
	* Add new type_activite_depenses
	*
	*/
	public function add()
	{
		$this->is_allowed('type_activite_depense_add');

		$this->template->title('Type Activite Depense New');
		$this->render('backend/standart/administrator/type_activite_depense/type_activite_depense_add', $this->data);
	}

	/**
	* Add New Type Activite Depenses
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('type_activite_depense_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('DESIGN_ACTIVITE', 'ACTIVITE', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGN_ACTIVITE' => $this->input->post('DESIGN_ACTIVITE'),
				'CREATE_BY' => get_user_data('id'),				'DATE_CREATE' => date('Y-m-d H:i:s'),
			];

			
			$save_type_activite_depense = $this->model_type_activite_depense->store($save_data);

			if ($save_type_activite_depense) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_type_activite_depense;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/type_activite_depense/edit/' . $save_type_activite_depense, 'Edit Type Activite Depense'),
						anchor('administrator/type_activite_depense', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/type_activite_depense/edit/' . $save_type_activite_depense, 'Edit Type Activite Depense')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/type_activite_depense');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/type_activite_depense');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Type Activite Depenses
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('type_activite_depense_update');

		$this->data['type_activite_depense'] = $this->model_type_activite_depense->find($id);

		$this->template->title('Type Activite Depense Update');
		$this->render('backend/standart/administrator/type_activite_depense/type_activite_depense_update', $this->data);
	}

	/**
	* Update Type Activite Depenses
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('type_activite_depense_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('DESIGN_ACTIVITE', 'ACTIVITE', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGN_ACTIVITE' => $this->input->post('DESIGN_ACTIVITE'),
				'CREATE_BY' => get_user_data('id'),			];

			
			$save_type_activite_depense = $this->model_type_activite_depense->change($id, $save_data);

			if ($save_type_activite_depense) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/type_activite_depense', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/type_activite_depense');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/type_activite_depense');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Type Activite Depenses
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('type_activite_depense_delete');

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
            set_message(cclang('has_been_deleted', 'type_activite_depense'), 'success');
        } else {
            set_message(cclang('error_delete', 'type_activite_depense'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Type Activite Depenses
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('type_activite_depense_view');

		$this->data['type_activite_depense'] = $this->model_type_activite_depense->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Type Activite Depense Detail');
		$this->render('backend/standart/administrator/type_activite_depense/type_activite_depense_view', $this->data);
	}
	
	/**
	* delete Type Activite Depenses
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$type_activite_depense = $this->model_type_activite_depense->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("type_activite_depense",$delete_save,array("ID_ACTIVITE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('type_activite_depense_export');

		$this->model_type_activite_depense->export('type_activite_depense', 'type_activite_depense');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('type_activite_depense_export');

		$this->model_type_activite_depense->pdf('type_activite_depense', 'type_activite_depense');
	}
}


/* End of file type_activite_depense.php */
/* Location: ./application/controllers/administrator/Type Activite Depense.php */