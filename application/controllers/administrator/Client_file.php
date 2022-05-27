<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Client File Controller
*| --------------------------------------------------------------------------
*| Client File site
*|
*/
class Client_file extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_client_file');
	}

	/**
	* show all Client Files
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('client_file_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['client_files'] = $this->model_client_file->get($filter, $field, $this->limit_page, $offset);
		$this->data['client_file_counts'] = $this->model_client_file->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/client_file/index/',
			'total_rows'   => $this->model_client_file->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Client File List');
		$this->render('backend/standart/administrator/client_file/client_file_list', $this->data);
	}
	
	/**
	* Add new client_files
	*
	*/
	public function add()
	{
		$this->is_allowed('client_file_add');

		$this->template->title('Client File New');
		$this->render('backend/standart/administrator/client_file/client_file_add', $this->data);
	}

	/**
	* Add New Client Files
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('client_file_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		

		if ($this->form_validation->run()) {
		
			$save_data = [
			];

			
			$save_client_file = $this->model_client_file->store($save_data);

			if ($save_client_file) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_client_file;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/client_file/edit/' . $save_client_file, 'Edit Client File'),
						anchor('administrator/client_file', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/client_file/edit/' . $save_client_file, 'Edit Client File')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/client_file');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/client_file');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Client Files
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('client_file_update');

		$this->data['client_file'] = $this->model_client_file->find($id);

		$this->template->title('Client File Update');
		$this->render('backend/standart/administrator/client_file/client_file_update', $this->data);
	}

	/**
	* Update Client Files
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('client_file_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('CLIENT_FILE_CODE', 'Code', 'trim|required');
		$this->form_validation->set_rules('CLIENT_ID', 'Client', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'CLIENT_FILE_CODE' => $this->input->post('CLIENT_FILE_CODE'),
				'CLIENT_ID' => $this->input->post('CLIENT_ID'),
				'DATE_CREATION_CLIENT_FILE' => $this->input->post('DATE_CREATION_CLIENT_FILE'),
				'CREATED_BY_CLIENT_FILE' => $this->input->post('CREATED_BY_CLIENT_FILE'),
			];

			
			$save_client_file = $this->model_client_file->change($id, $save_data);

			if ($save_client_file) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/client_file', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/client_file');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/client_file');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Client Files
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('client_file_delete');

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
            set_message(cclang('has_been_deleted', 'client_file'), 'success');
        } else {
            set_message(cclang('error_delete', 'client_file'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Client Files
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('client_file_view');

		$this->data['client_file'] = $this->model_client_file->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Client File Detail');
		$this->render('backend/standart/administrator/client_file/client_file_view', $this->data);
	}
	
	/**
	* delete Client Files
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$client_file = $this->model_client_file->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("client_file",$delete_save,array("CLIENT_FILE_ID"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('client_file_export');

		$this->model_client_file->export('client_file', 'client_file');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('client_file_export');

		$this->model_client_file->pdf('client_file', 'client_file');
	}
}


/* End of file client_file.php */
/* Location: ./application/controllers/administrator/Client File.php */