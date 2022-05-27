<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Clients Groups Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Clients Groups site
*|
*/
class Clients_groups extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_clients_groups');
		$this->load->model('model_fournisseurs');
	}

	/**
	* show all Pos Ibi Clients Groupss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('clients_groups_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['clients_groupss'] = $this->model_clients_groups->get($filter, $field, $this->limit_page, $offset);
		$this->data['clients_groups_counts'] = $this->model_clients_groups->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/clients_groups/index/',
			'total_rows'   => $this->model_clients_groups->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Groups List');
		$this->render('backend/standart/administrator/clients_groups/clients_groups_list', $this->data);
	}
	
	/**
	* Add new clients_groupss
	*
	*/
	public function add()
	{
		$this->is_allowed('clients_groups_add');

		$this->template->title('Groups New');
		$this->render('backend/standart/administrator/clients_groups/clients_groups_add', $this->data);
	}

	/**
	* Add New Pos Ibi Clients Groupss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('clients_groups_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NAME_GROUP', 'Nom', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_GROUP' => $this->input->post('NAME_GROUP'),
				'DESCRIPTION_GROUP' => $this->input->post('DESCRIPTION_GROUP'),
				'DATE_CREATION_GROUP' => date('Y-m-d H:i:s'),
				'DISCOUNT_TYPE_GROUP' => $this->input->post('DISCOUNT_TYPE_GROUP'),
				'DISCOUNT_PERCENT_GROUP' => $this->input->post('DISCOUNT_PERCENT_GROUP'),
				'DISCOUNT_AMOUNT_GROUP' => $this->input->post('DISCOUNT_AMOUNT_GROUP'),
				'DISCOUNT_ENABLE_SCHEDULE_GROUP' => $this->input->post('DISCOUNT_ENABLE_SCHEDULE_GROUP'),
				'DISCOUNT_START_GROUP' => $this->input->post('DISCOUNT_START_GROUP'),
				'DISCOUNT_END_GROUP' => $this->input->post('DISCOUNT_END_GROUP'),
				'AUTHOR_GROUP' => get_user_data('id'),			];

			
			$save_clients_groups = $this->model_clients_groups->store($save_data);

			if ($save_clients_groups) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_clients_groups;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/clients_groups/edit/' . $save_clients_groups, 'Edit Pos Ibi Clients Groups'),
						anchor('administrator/clients_groups', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/clients_groups/edit/' . $save_clients_groups, 'Edit Pos Ibi Clients Groups')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/clients_groups');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/clients_groups');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Clients Groupss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('clients_groups_update');

		$this->data['clients_groups'] = $this->model_clients_groups->find($id);

		$this->template->title('Groups Update');
		$this->render('backend/standart/administrator/clients_groups/clients_groups_update', $this->data);
	}

	/**
	* Update Pos Ibi Clients Groupss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('clients_groups_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NAME_GROUP', 'Nom', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_GROUP' => $this->input->post('NAME_GROUP'),
				'DESCRIPTION_GROUP' => $this->input->post('DESCRIPTION_GROUP'),
				'DATE_MODIFICATION_GROUP' => date('Y-m-d H:i:s'),
				'DISCOUNT_TYPE_GROUP' => $this->input->post('DISCOUNT_TYPE_GROUP'),
				'DISCOUNT_PERCENT_GROUP' => $this->input->post('DISCOUNT_PERCENT_GROUP'),
				'DISCOUNT_AMOUNT_GROUP' => $this->input->post('DISCOUNT_AMOUNT_GROUP'),
				'DISCOUNT_ENABLE_SCHEDULE_GROUP' => $this->input->post('DISCOUNT_ENABLE_SCHEDULE_GROUP'),
				'DISCOUNT_START_GROUP' => $this->input->post('DISCOUNT_START_GROUP'),
				'DISCOUNT_END_GROUP' => $this->input->post('DISCOUNT_END_GROUP'),
				'AUTHOR_GROUP' => get_user_data('id'),			];

			
			$save_clients_groups = $this->model_clients_groups->change($id, $save_data);

			if ($save_clients_groups) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/clients_groups', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/clients_groups');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/clients_groups');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Clients Groupss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('clients_groups_delete');

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
            set_message(cclang('has_been_deleted', 'clients_groups'), 'success');
        } else {
            set_message(cclang('error_delete', 'clients_groups'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Clients Groupss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('clients_groups_view');

		$this->data['clients_groups'] = $this->model_clients_groups->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Groups Detail');
		$this->render('backend/standart/administrator/clients_groups/clients_groups_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Clients Groupss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$clients_groups = $this->model_clients_groups->find($id);

		
		
		return $this->model_clients_groups->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('clients_groups_export');

		$this->model_clients_groups->export('Pos_ibi_clients_groups', 'clients_groups');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('clients_groups_export');

		$this->model_clients_groups->pdf('Pos_ibi_clients_groups', 'clients_groups');
	}
}


/* End of file clients_groups.php */
/* Location: ./application/controllers/administrator/Pos Ibi Clients Groups.php */