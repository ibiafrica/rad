<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Client File Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Client File site
*|
*/
class Clients_file extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_clients');
		$this->load->model('model_clients_file');
	}

	/**
	* show all Pos Ibi Client Files
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('clients_file_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['clients_files'] = $this->model_clients_file->get($filter, $field, $this->limit_page, $offset);
		$this->data['clients_file_counts'] = $this->model_clients_file->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/clients_file/index/',
			'total_rows'   => $this->model_clients_file->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Ibi Client File List');
		$this->render('backend/standart/administrator/clients_file/clients_file_list', $this->data);
	}
	
	/**
	* Add new clients_files
	*
	*/
	public function add()
	{
		$this->is_allowed('clients_list');


	
		$this->render('backend/standart/administrator/clients/clients_list', $this->data);
	}

	/**
	* Add New Pos Ibi Client Files
	*
	* @return JSON
	*/
	public function add_save($store)
	{

		if (!$this->is_allowed('clients_file_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		} 
		$this->form_validation->set_rules('NAME_FILE', 'Nom fichier', 'trim|required');
		$this->form_validation->set_rules('NUMERO_FILE', 'Numero fichier', 'trim|required');
		$this->form_validation->set_rules('REF_CLIENT_FILE', 'Client', 'trim|required');
		$this->form_validation->set_rules('clients_file_PATH_FILE_name', 'Fichier', 'trim|required');
		if ($this->form_validation->run()) {

			$clients_file_PATH_FILE_uuid = $this->input->post('clients_file_PATH_FILE_uuid');
			$clients_file_PATH_FILE_name = $this->input->post('clients_file_PATH_FILE_name');
		
			$save_data = [
				'NAME_FILE' => $this->input->post('NAME_FILE'),
				'NUMERO_FILE' => $this->input->post('NUMERO_FILE'),
				'REF_CLIENT_FILE' => $this->input->post('REF_CLIENT_FILE'),
				'DATE_CREATION_FILE' => date('Y-m-d H:i:s'),
				'AUTHOR_FILE' => get_user_data('id'),
			];
   
			if (!is_dir(FCPATH . '/uploads/clients_file/')) {
				mkdir(FCPATH . '/uploads/clients_file/');
			}

			if (!empty($clients_file_PATH_FILE_name)) {
				$clients_file_PATH_FILE_name_copy = date('YmdHis') . '-' . $clients_file_PATH_FILE_name;

				rename(FCPATH . 'uploads/tmp/' . $clients_file_PATH_FILE_uuid . '/' . $clients_file_PATH_FILE_name, 
						FCPATH . 'uploads/clients_file/' . $clients_file_PATH_FILE_name_copy);

				if (!is_file(FCPATH . '/uploads/clients_file/' . $clients_file_PATH_FILE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

			$save_data['PATH_FILE'] = $clients_file_PATH_FILE_name_copy;
			}
		
			
			$save_clients_file = $this->model_clients->creer('pos_ibi_client_file',$save_data); 
	
			if ($save_clients_file) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_clients_file;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/clients_file/edit/'.$store.'/' . $save_clients_file, 'Edit Pos Ibi Client File'),
						anchor('administrator/clients/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/clients_file/edit/'.$store.'/' . $save_clients_file, 'Edit Pos Ibi Client File')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/clients/index/'.$store.'');
				}
			} 
			else {
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
		else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}


		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Client Files
	*
	* @var $id String
	*/
	public function edit($store = 0, $id)
	{
		$this->is_allowed('clients_file_update');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
		$this->data['clients_file'] = $this->model_clients_file->find($id);

		$this->template->title('Modifier la fiche');
		$this->render('backend/standart/administrator/clients_file/clients_file_update', $this->data);
	}

	/**
	* Update Pos Ibi Client Files
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		if (!$this->is_allowed('clients_file_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NAME_FILE', 'NAME FILE', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('NUMERO_FILE', 'NUMERO FILE', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('REF_CLIENT_FILE', 'REF CLIENT FILE', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('clients_file_PATH_FILE_name', 'PATH FILE', 'trim|required|max_length[200]');
		
		if ($this->form_validation->run()) {
			$clients_file_PATH_FILE_uuid = $this->input->post('clients_file_PATH_FILE_uuid');
			$clients_file_PATH_FILE_name = $this->input->post('clients_file_PATH_FILE_name');
		
			$save_data = [
				'NAME_FILE' => $this->input->post('NAME_FILE'),
				'NUMERO_FILE' => $this->input->post('NUMERO_FILE'),
				'REF_CLIENT_FILE' => $this->input->post('REF_CLIENT_FILE'),
			];

			if (!is_dir(FCPATH . '/uploads/clients_file/')) {
				mkdir(FCPATH . '/uploads/clients_file/');
			}

			if (!empty($clients_file_PATH_FILE_uuid)) {
				$clients_file_PATH_FILE_name_copy = date('YmdHis') . '-' . $clients_file_PATH_FILE_name;

				rename(FCPATH . 'uploads/tmp/' . $clients_file_PATH_FILE_uuid . '/' . $clients_file_PATH_FILE_name, 
						FCPATH . 'uploads/clients_file/' . $clients_file_PATH_FILE_name_copy);

				if (!is_file(FCPATH . '/uploads/clients_file/' . $clients_file_PATH_FILE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['PATH_FILE'] = $clients_file_PATH_FILE_name_copy;
			}
		
			
			$save_clients_file = $this->model_clients_file->change($id, $save_data);

			if ($save_clients_file) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/clients_file', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/clients_file');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/clients_file');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Client Files
	*
	* @var $id String
	*/
	public function delete($store,$id = null)
	{
		$this->is_allowed('clients_file_delete');

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
            set_message(cclang('has_been_deleted', 'clients_file'), 'success');
        } else {
            set_message(cclang('error_delete', 'clients_file'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Client Files
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('clients_file_view');

		$this->data['clients_file'] = $this->model_clients_file->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Ibi Client File Detail');
		$this->render('backend/standart/administrator/clients_file/clients_file_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Client Files
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$clients_file = $this->model_clients_file->find($id);

		if (!empty($clients_file->PATH_FILE)) {
			$path = FCPATH . '/uploads/clients_file/' . $clients_file->PATH_FILE;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_clients_file->remove($id);
	}
	
	/**
	* Upload Image Pos Ibi Client File	* 
	* @return JSON
	*/
	public function upload_PATH_FILE_file()
	{
		if (!$this->is_allowed('clients_file_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'clients_file',
		]);
	}

	/**
	* Delete Image Pos Ibi Client File	* 
	* @return JSON
	*/
	public function delete_PATH_FILE_file($uuid)
	{
		if (!$this->is_allowed('clients_file_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'PATH_FILE', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'clients_file',
            'primary_key'       => 'ID_FILE',
            'upload_path'       => 'uploads/clients_file/'
        ]);
	}

	/**
	* Get Image Pos Ibi Client File	* 
	* @return JSON
	*/
	public function get_PATH_FILE_file($id)
	{
		if (!$this->is_allowed('clients_file_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$clients_file = $this->model_clients_file->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'PATH_FILE', 
            'table_name'        => 'clients_file',
            'primary_key'       => 'ID_FILE',
            'upload_path'       => 'uploads/clients_file/',
            'delete_endpoint'   => 'administrator/clients_file/delete_PATH_FILE_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('clients_file_export');

		$this->model_clients_file->export('clients_file', 'clients_file');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('clients_file_export');

		$this->model_clients_file->pdf('clients_file', 'clients_file');
	}
}


/* End of file clients_file.php */
/* Location: ./application/controllers/administrator/Pos Ibi Client File.php */