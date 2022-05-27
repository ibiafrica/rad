<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Stores Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Stores site
*|
*/
class Pos_ibi_stores extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_ibi_stores');
	}

	/**
	* show all Pos Ibi Storess
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
			'base_url'     => 'administrator/pos_ibi_stores/index/',
			'total_rows'   => $this->model_pos_ibi_stores->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Ibi Stores List');
		$this->render('backend/standart/administrator/pos_ibi_stores/pos_ibi_stores_list', $this->data);
	}
	
	/**
	* Add new pos_ibi_storess
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_ibi_stores_add');

		$this->template->title('Pos Ibi Stores New');
		$this->render('backend/standart/administrator/pos_ibi_stores/pos_ibi_stores_add', $this->data);
	}

	/**
	* Add New Pos Ibi Storess
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

		$this->form_validation->set_rules('STATUT', 'STATUT', 'trim|required');
		$this->form_validation->set_rules('NAME', 'NAME', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('DESCRIPTION', 'DESCRIPTION', 'trim|max_length[200]');
		

		if ($this->form_validation->run()) {
			$pos_ibi_stores_IMAGE_uuid = $this->input->post('pos_ibi_stores_IMAGE_uuid');
			$pos_ibi_stores_IMAGE_name = $this->input->post('pos_ibi_stores_IMAGE_name');
		
			$save_data = [
				'STATUT' => $this->input->post('STATUT'),
				'NAME' => $this->input->post('NAME'),
				'DESCRIPTION' => $this->input->post('DESCRIPTION'),
				'DATE_CREATION' => date('Y-m-d H:i:s'),
				'AUTHOR' => get_user_data('id'),			];

			if (!is_dir(FCPATH . '/uploads/pos_ibi_stores/')) {
				mkdir(FCPATH . '/uploads/pos_ibi_stores/');
			}

			if (!empty($pos_ibi_stores_IMAGE_name)) {
				$pos_ibi_stores_IMAGE_name_copy = date('YmdHis') . '-' . $pos_ibi_stores_IMAGE_name;

				rename(FCPATH . 'uploads/tmp/' . $pos_ibi_stores_IMAGE_uuid . '/' . $pos_ibi_stores_IMAGE_name, 
						FCPATH . 'uploads/pos_ibi_stores/' . $pos_ibi_stores_IMAGE_name_copy);

				if (!is_file(FCPATH . '/uploads/pos_ibi_stores/' . $pos_ibi_stores_IMAGE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['IMAGE'] = $pos_ibi_stores_IMAGE_name_copy;
			}
		
			
			$save_pos_ibi_stores = $this->model_pos_ibi_stores->store($save_data);

			if ($save_pos_ibi_stores) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_stores;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_ibi_stores/edit/' . $save_pos_ibi_stores, 'Edit Pos Ibi Stores'),
						anchor('administrator/pos_ibi_stores', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_ibi_stores/edit/' . $save_pos_ibi_stores, 'Edit Pos Ibi Stores')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_stores');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_stores');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Storess
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pos_ibi_stores_update');

		$this->data['pos_ibi_stores'] = $this->model_pos_ibi_stores->find($id);

		$this->template->title('Pos Ibi Stores Update');
		$this->render('backend/standart/administrator/pos_ibi_stores/pos_ibi_stores_update', $this->data);
	}

	/**
	* Update Pos Ibi Storess
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
		
		$this->form_validation->set_rules('STATUT', 'STATUT', 'trim|required');
		$this->form_validation->set_rules('NAME', 'NAME', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('DESCRIPTION', 'DESCRIPTION', 'trim|max_length[200]');
		
		if ($this->form_validation->run()) {
			$pos_ibi_stores_IMAGE_uuid = $this->input->post('pos_ibi_stores_IMAGE_uuid');
			$pos_ibi_stores_IMAGE_name = $this->input->post('pos_ibi_stores_IMAGE_name');
		
			$save_data = [
				'STATUT' => $this->input->post('STATUT'),
				'NAME' => $this->input->post('NAME'),
				'DESCRIPTION' => $this->input->post('DESCRIPTION'),
				'DATE_MOD' => date('Y-m-d H:i:s'),
				'AUTHOR' => get_user_data('id'),			];

			if (!is_dir(FCPATH . '/uploads/pos_ibi_stores/')) {
				mkdir(FCPATH . '/uploads/pos_ibi_stores/');
			}

			if (!empty($pos_ibi_stores_IMAGE_uuid)) {
				$pos_ibi_stores_IMAGE_name_copy = date('YmdHis') . '-' . $pos_ibi_stores_IMAGE_name;

				rename(FCPATH . 'uploads/tmp/' . $pos_ibi_stores_IMAGE_uuid . '/' . $pos_ibi_stores_IMAGE_name, 
						FCPATH . 'uploads/pos_ibi_stores/' . $pos_ibi_stores_IMAGE_name_copy);

				if (!is_file(FCPATH . '/uploads/pos_ibi_stores/' . $pos_ibi_stores_IMAGE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['IMAGE'] = $pos_ibi_stores_IMAGE_name_copy;
			}
		
			
			$save_pos_ibi_stores = $this->model_pos_ibi_stores->change($id, $save_data);

			if ($save_pos_ibi_stores) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_ibi_stores', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_stores');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_stores');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Storess
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_ibi_stores_delete');

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
            set_message(cclang('has_been_deleted', 'pos_ibi_stores'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_ibi_stores'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Storess
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_ibi_stores_view');

		$this->data['pos_ibi_stores'] = $this->model_pos_ibi_stores->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Ibi Stores Detail');
		$this->render('backend/standart/administrator/pos_ibi_stores/pos_ibi_stores_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Storess
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pos_ibi_stores = $this->model_pos_ibi_stores->find($id);

		if (!empty($pos_ibi_stores->IMAGE)) {
			$path = FCPATH . '/uploads/pos_ibi_stores/' . $pos_ibi_stores->IMAGE;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_pos_ibi_stores->remove($id);
	}
	
	/**
	* Upload Image Pos Ibi Stores	* 
	* @return JSON
	*/
	public function upload_IMAGE_file()
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
	* Delete Image Pos Ibi Stores	* 
	* @return JSON
	*/
	public function delete_IMAGE_file($uuid)
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
            'field_name'        => 'IMAGE', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'pos_ibi_stores',
            'primary_key'       => 'ID',
            'upload_path'       => 'uploads/pos_ibi_stores/'
        ]);
	}

	/**
	* Get Image Pos Ibi Stores	* 
	* @return JSON
	*/
	public function get_IMAGE_file($id)
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
            'field_name'        => 'IMAGE', 
            'table_name'        => 'pos_ibi_stores',
            'primary_key'       => 'ID',
            'upload_path'       => 'uploads/pos_ibi_stores/',
            'delete_endpoint'   => 'administrator/pos_ibi_stores/delete_IMAGE_file'
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
/* Location: ./application/controllers/administrator/Pos Ibi Stores.php */