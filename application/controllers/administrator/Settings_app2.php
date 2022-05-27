<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Settings App Controller
*| --------------------------------------------------------------------------
*| Settings App site
*|
*/
class Settings_app extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_settings_app');
	}

	/**
	* show all Settings Apps
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('settings_app_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['settings_apps'] = $this->model_settings_app->get($filter, $field, $this->limit_page, $offset);
		$this->data['settings_app_counts'] = $this->model_settings_app->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/settings_app/index/',
			'total_rows'   => $this->model_settings_app->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Settings App List');
		$this->render('backend/standart/administrator/settings_app/settings_app_list', $this->data);
	}
	
	/**
	* Add new settings_apps
	*
	*/
	public function add()
	{
		$this->is_allowed('settings_app_add');

		$this->template->title('Settings App New');
		$this->render('backend/standart/administrator/settings_app/settings_app_add', $this->data);
	}

	/**
	* Add New Settings Apps
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('settings_app_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NOM_ENTREPRISE', 'NOM ENTREPRISE', 'trim|required');
		$this->form_validation->set_rules('NIF_ENTREPRISE', 'NIF ENTREPRISE', 'trim|required');
		$this->form_validation->set_rules('RC_ENTREPRISE', 'RC ENTREPRISE', 'trim|required');
		$this->form_validation->set_rules('COMMUNE_ENTREPRISE', 'COMMUNE ENTREPRISE', 'trim|required');
		

		if ($this->form_validation->run()) {
			$settings_app_LOGO_ENTREPRISE_uuid = $this->input->post('settings_app_LOGO_ENTREPRISE_uuid');
			$settings_app_LOGO_ENTREPRISE_name = $this->input->post('settings_app_LOGO_ENTREPRISE_name');
		
			$save_data = [
				'NOM_ENTREPRISE' => $this->input->post('NOM_ENTREPRISE'),
				'NIF_ENTREPRISE' => $this->input->post('NIF_ENTREPRISE'),
				'RC_ENTREPRISE' => $this->input->post('RC_ENTREPRISE'),
				'COMMUNE_ENTREPRISE' => $this->input->post('COMMUNE_ENTREPRISE'),
				'QUARTIER_ENTREPRISE' => $this->input->post('QUARTIER_ENTREPRISE'),
				'AVENUE_ENTREPRISE' => $this->input->post('AVENUE_ENTREPRISE'),
				'RUE_ENTREPRISE' => $this->input->post('RUE_ENTREPRISE'),
				'TELEPHONE_ENTREPRISE' => $this->input->post('TELEPHONE_ENTREPRISE'),
				'EMAIL_ENTREPRISE' => $this->input->post('EMAIL_ENTREPRISE'),
				'BP_ENTREPRISE' => $this->input->post('BP_ENTREPRISE'),
				'CREATED_BY' => get_user_data('id'),				'DATE_CREATION' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/settings_app/')) {
				mkdir(FCPATH . '/uploads/settings_app/');
			}

			if (!empty($settings_app_LOGO_ENTREPRISE_name)) {
				$settings_app_LOGO_ENTREPRISE_name_copy = date('YmdHis') . '-' . $settings_app_LOGO_ENTREPRISE_name;

				rename(FCPATH . 'uploads/tmp/' . $settings_app_LOGO_ENTREPRISE_uuid . '/' . $settings_app_LOGO_ENTREPRISE_name, 
						FCPATH . 'uploads/settings_app/' . $settings_app_LOGO_ENTREPRISE_name_copy);

				if (!is_file(FCPATH . '/uploads/settings_app/' . $settings_app_LOGO_ENTREPRISE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['LOGO_ENTREPRISE'] = $settings_app_LOGO_ENTREPRISE_name_copy;
			}
		
			
			$save_settings_app = $this->model_settings_app->store($save_data);

			if ($save_settings_app) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_settings_app;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/settings_app/edit/' . $save_settings_app, 'Edit Settings App'),
						anchor('administrator/settings_app', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/settings_app/edit/' . $save_settings_app, 'Edit Settings App')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/settings_app');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/settings_app');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Settings Apps
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('settings_app_update');

		$this->data['settings_app'] = $this->model_settings_app->find($id);

		$this->template->title('Settings App Update');
		$this->render('backend/standart/administrator/settings_app/settings_app_update', $this->data);
	}

	/**
	* Update Settings Apps
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('settings_app_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NOM_ENTREPRISE', 'NOM ENTREPRISE', 'trim|required');
		$this->form_validation->set_rules('NIF_ENTREPRISE', 'NIF ENTREPRISE', 'trim|required');
		$this->form_validation->set_rules('RC_ENTREPRISE', 'RC ENTREPRISE', 'trim|required');
		$this->form_validation->set_rules('COMMUNE_ENTREPRISE', 'COMMUNE ENTREPRISE', 'trim|required');
		
		if ($this->form_validation->run()) {
			$settings_app_LOGO_ENTREPRISE_uuid = $this->input->post('settings_app_LOGO_ENTREPRISE_uuid');
			$settings_app_LOGO_ENTREPRISE_name = $this->input->post('settings_app_LOGO_ENTREPRISE_name');
		
			$save_data = [
				'NOM_ENTREPRISE' => $this->input->post('NOM_ENTREPRISE'),
				'NIF_ENTREPRISE' => $this->input->post('NIF_ENTREPRISE'),
				'RC_ENTREPRISE' => $this->input->post('RC_ENTREPRISE'),
				'COMMUNE_ENTREPRISE' => $this->input->post('COMMUNE_ENTREPRISE'),
				'QUARTIER_ENTREPRISE' => $this->input->post('QUARTIER_ENTREPRISE'),
				'AVENUE_ENTREPRISE' => $this->input->post('AVENUE_ENTREPRISE'),
				'RUE_ENTREPRISE' => $this->input->post('RUE_ENTREPRISE'),
				'TELEPHONE_ENTREPRISE' => $this->input->post('TELEPHONE_ENTREPRISE'),
				'EMAIL_ENTREPRISE' => $this->input->post('EMAIL_ENTREPRISE'),
				'BP_ENTREPRISE' => $this->input->post('BP_ENTREPRISE'),
				'CREATED_BY' => get_user_data('id'),				'DATE_CREATION' => date('Y-m-d H:i:s'),
			];

			if (!is_dir(FCPATH . '/uploads/settings_app/')) {
				mkdir(FCPATH . '/uploads/settings_app/');
			}

			if (!empty($settings_app_LOGO_ENTREPRISE_uuid)) {
				$settings_app_LOGO_ENTREPRISE_name_copy = date('YmdHis') . '-' . $settings_app_LOGO_ENTREPRISE_name;

				rename(FCPATH . 'uploads/tmp/' . $settings_app_LOGO_ENTREPRISE_uuid . '/' . $settings_app_LOGO_ENTREPRISE_name, 
						FCPATH . 'uploads/settings_app/' . $settings_app_LOGO_ENTREPRISE_name_copy);

				if (!is_file(FCPATH . '/uploads/settings_app/' . $settings_app_LOGO_ENTREPRISE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['LOGO_ENTREPRISE'] = $settings_app_LOGO_ENTREPRISE_name_copy;
			}
		
			
			$save_settings_app = $this->model_settings_app->change($id, $save_data);

			if ($save_settings_app) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/settings_app', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/settings_app');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/settings_app');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Settings Apps
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('settings_app_delete');

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
            set_message(cclang('has_been_deleted', 'settings_app'), 'success');
        } else {
            set_message(cclang('error_delete', 'settings_app'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Settings Apps
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('settings_app_view');

		$this->data['settings_app'] = $this->model_settings_app->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Settings App Detail');
		$this->render('backend/standart/administrator/settings_app/settings_app_view', $this->data);
	}
	
	/**
	* delete Settings Apps
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$settings_app = $this->model_settings_app->find($id);

		if (!empty($settings_app->LOGO_ENTREPRISE)) {
			$path = FCPATH . '/uploads/settings_app/' . $settings_app->LOGO_ENTREPRISE;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("settings_app",$delete_save,array("ID_SETTING"=>$id));
		return $remove;
	}
	
	/**
	* Upload Image Settings App	* 
	* @return JSON
	*/
	public function upload_LOGO_ENTREPRISE_file()
	{
		if (!$this->is_allowed('settings_app_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'settings_app',
		]);
	}

	/**
	* Delete Image Settings App	* 
	* @return JSON
	*/
	public function delete_LOGO_ENTREPRISE_file($uuid)
	{
		if (!$this->is_allowed('settings_app_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'LOGO_ENTREPRISE', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'settings_app',
            'primary_key'       => 'ID_SETTING',
            'upload_path'       => 'uploads/settings_app/'
        ]);
	}

	/**
	* Get Image Settings App	* 
	* @return JSON
	*/
	public function get_LOGO_ENTREPRISE_file($id)
	{
		if (!$this->is_allowed('settings_app_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$settings_app = $this->model_settings_app->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'LOGO_ENTREPRISE', 
            'table_name'        => 'settings_app',
            'primary_key'       => 'ID_SETTING',
            'upload_path'       => 'uploads/settings_app/',
            'delete_endpoint'   => 'administrator/settings_app/delete_LOGO_ENTREPRISE_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('settings_app_export');

		$this->model_settings_app->export('settings_app', 'settings_app');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('settings_app_export');

		$this->model_settings_app->pdf('settings_app', 'settings_app');
	}
}


/* End of file settings_app.php */
/* Location: ./application/controllers/administrator/Settings App.php */