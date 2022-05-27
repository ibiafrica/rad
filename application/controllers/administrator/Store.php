<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Stores Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Stores site
*|
*/
class Store extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_store');
	}

	/**
	* show all Pos Ibi Storess
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('store_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['stores'] = $this->model_store->get($filter, $field, $this->limit_page, $offset);
		$this->data['store_counts'] = $this->model_store->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/store/index/',
			'total_rows'   => $this->model_store->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Liste des boutiques');
		$this->render('backend/standart/administrator/store/store_list', $this->data);
	}
	
	/**
	* Add new stores
	*
	*/
	public function add()
	{
		$this->is_allowed('store_add');

		$this->template->title('Créer une nouvelle boutique');
		$this->render('backend/standart/administrator/store/store_add', $this->data);
	}

	/**
	* Add New Pos Ibi Storess
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('store_add', false)) {
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
			$store_IMAGE_uuid = $this->input->post('store_IMAGE_uuid');
			$store_IMAGE_name = $this->input->post('store_IMAGE_name');
		
			$save_data = [
				'STATUT_STORE' => $this->input->post('STATUT'),
				'NAME_STORE' => $this->input->post('NAME'),
				'DESCRIPTION_STORE' => $this->input->post('DESCRIPTION'),
				'DATE_CREATION_STORE' => date('Y-m-d H:i:s'),
				'AUTHOR_STORE' => get_user_data('id'),			];

			if (!is_dir(FCPATH . '/uploads/store/')) {
				mkdir(FCPATH . '/uploads/store/');
			}

			if (!empty($store_IMAGE_name)) {
				$store_IMAGE_name_copy = date('YmdHis') . '-' . $store_IMAGE_name;

				rename(FCPATH . 'uploads/tmp/' . $store_IMAGE_uuid . '/' . $store_IMAGE_name, 
						FCPATH . 'uploads/store/' . $store_IMAGE_name_copy);

				if (!is_file(FCPATH . '/uploads/store/' . $store_IMAGE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['IMAGE_STORE'] = $store_IMAGE_name_copy;
			}
		
			
			$save_store = $this->model_store->store($save_data);

			if ($save_store) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_store;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/store/edit/' . $save_store, 'Edit Pos Ibi Stores'),
						anchor('administrator/store', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/store/edit/' . $save_store, 'Edit Pos Ibi Stores')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/store');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/store');
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
		$this->is_allowed('store_update');

		$this->data['store'] = $this->model_store->find($id);

		$this->template->title('Modifier la boutique');
		$this->render('backend/standart/administrator/store/store_update', $this->data);
	}

	/**
	* Update Pos Ibi Storess
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('store_update', false)) {
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
			$store_IMAGE_uuid = $this->input->post('store_IMAGE_uuid');
			$store_IMAGE_name = $this->input->post('store_IMAGE_name');
		
			$save_data = [
				'STATUT_STORE' => $this->input->post('STATUT'),
				'NAME_STORE' => $this->input->post('NAME'),
				'DESCRIPTION_STORE' => $this->input->post('DESCRIPTION'),
				'DATE_MOD_STORE' => date('Y-m-d H:i:s'),
				'AUTHOR_STORE' => get_user_data('id'),			];

			if (!is_dir(FCPATH . '/uploads/store/')) {
				mkdir(FCPATH . '/uploads/store/');
			}

			if (!empty($store_IMAGE_uuid)) {
				$store_IMAGE_name_copy = date('YmdHis') . '-' . $store_IMAGE_name;

				rename(FCPATH . 'uploads/tmp/' . $store_IMAGE_uuid . '/' . $store_IMAGE_name, 
						FCPATH . 'uploads/store/' . $store_IMAGE_name_copy);

				if (!is_file(FCPATH . '/uploads/store/' . $store_IMAGE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['IMAGE_STORE'] = $store_IMAGE_name_copy;
			}

			$save_store = $this->model_store->change($id, $save_data);

			if ($save_store) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/store', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/store');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/store');
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
		$this->is_allowed('store_delete');

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
            set_message(cclang('has_been_deleted', 'store'), 'success');
        } else {
            set_message(cclang('error_delete', 'store'), 'error');
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
		$this->is_allowed('store_view');

		$this->data['store'] = $this->model_store->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Ibi Stores Detail');
		$this->render('backend/standart/administrator/store/store_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Storess
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$store = $this->model_store->find($id);

		if (!empty($store->IMAGE)) {
			$path = FCPATH . '/uploads/store/' . $store->IMAGE;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_store->remove($id);
	}
	
	/**
	* Upload Image Pos Ibi Stores	* 
	* @return JSON
	*/
	public function upload_IMAGE_file()
	{
		if (!$this->is_allowed('store_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'store',
		]);
	}

	/**
	* Delete Image Pos Ibi Stores	* 
	* @return JSON
	*/
	public function delete_IMAGE_file($uuid)
	{
		if (!$this->is_allowed('store_delete', false)) {
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
            'upload_path'       => 'uploads/store/'
        ]);
	}

	/**
	* Get Image Pos Ibi Stores	* 
	* @return JSON
	*/
	public function get_IMAGE_file($id)
	{
		if (!$this->is_allowed('store_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$store = $this->model_store->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'IMAGE_STORE', 
            'table_name'        => 'pos_ibi_stores',
            'primary_key'       => 'ID_STORE',
            'upload_path'       => 'uploads/store/',
            'delete_endpoint'   => 'administrator/store/delete_IMAGE_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('store_export');

		$this->model_store->export('store', 'store');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('store_export');

		$this->model_store->pdf('store', 'store');
	}
}


/* End of file store.php */
/* Location: ./application/controllers/administrator/Pos Ibi Stores.php */