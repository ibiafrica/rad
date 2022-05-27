<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Categories Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Categories site
*|
*/
class Pos_ibi_categories extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_ibi_categories');
	}
// js
	/**
	* show all Pos Ibi Categoriess
	*
	* @var $offset String
	*/
	public function index($store=0)

	{
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

		$offset = $this->uri->segment(5);
		if ($offset == '' || $offset == null) {
			 $offset = 0;
		}

		$this->is_allowed('pos_ibi_categories_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');


		$this->data['pos_ibi_categoriess'] = $this->model_pos_ibi_categories->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_ibi_categories_counts'] = $this->model_pos_ibi_categories->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_ibi_categories/index/'.$this->uri->segment(4).'/',
			'total_rows'   => $this->model_pos_ibi_categories->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 5,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Categories List');
		$this->render('backend/standart/administrator/pos_ibi_categories/pos_ibi_categories_list', $this->data);
	}



	
	/**
	* Add new pos_ibi_categoriess
	*
	*/
	public function add($store=0)
	{
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
		$this->is_allowed('pos_ibi_categories_add');

		$this->template->title('Categories New');
		$this->render('backend/standart/administrator/pos_ibi_categories/pos_ibi_categories_add', $this->data);
	}

	/**
	* Add New Pos Ibi Categoriess
	*
	* @return JSON
	*/
	public function add_save($store=0)
	{
		if (!$this->is_allowed('pos_ibi_categories_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}


		$this->form_validation->set_rules('NOM_CATEGORIE', 'Nom ', 'trim|required');
		$this->form_validation->set_rules('DESCRIPTION_CATEGORIE', 'Description', 'trim|required');
		$this->form_validation->set_rules('pos_ibi_categories_THUMB_CATEGORIE_name', 'Apercu', 'trim|required');
		

		if ($this->form_validation->run()) {
			$pos_ibi_categories_THUMB_CATEGORIE_uuid = $this->input->post('pos_ibi_categories_THUMB_CATEGORIE_uuid');
			$pos_ibi_categories_THUMB_CATEGORIE_name = $this->input->post('pos_ibi_categories_THUMB_CATEGORIE_name');
		
			$save_data = [
				'NOM_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				'DESCRIPTION_CATEGORIE' => $this->input->post('DESCRIPTION_CATEGORIE'),
				'DATE_CREATION_CATEGORIE' => date('Y-m-d H:i:s'),
				'PARENT_REF_ID_CATEGORIE' => $this->input->post('PARENT_REF_ID_CATEGORIE'),
			];

			if (!is_dir(FCPATH . '/uploads/pos_ibi_categories/')) {
				mkdir(FCPATH . '/uploads/pos_ibi_categories/');
			}

			if (!empty($pos_ibi_categories_THUMB_CATEGORIE_name)) {
				$pos_ibi_categories_THUMB_CATEGORIE_name_copy = date('YmdHis') . '-' . $pos_ibi_categories_THUMB_CATEGORIE_name;

				rename(FCPATH . 'uploads/tmp/' . $pos_ibi_categories_THUMB_CATEGORIE_uuid . '/' . $pos_ibi_categories_THUMB_CATEGORIE_name, 
						FCPATH . 'uploads/pos_ibi_categories/' . $pos_ibi_categories_THUMB_CATEGORIE_name_copy);

				if (!is_file(FCPATH . '/uploads/pos_ibi_categories/' . $pos_ibi_categories_THUMB_CATEGORIE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['THUMB_CATEGORIE'] = $pos_ibi_categories_THUMB_CATEGORIE_name_copy;
			}
		
			
			$save_pos_ibi_categories = $this->model_pos_ibi_categories->store($save_data);

			if ($save_pos_ibi_categories) {
				$uri = $this->uri->segment(4);

				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_categories;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_ibi_categories/edit/' . $save_pos_ibi_categories, 'Edit Pos Ibi Categories'),
						anchor('administrator/pos_ibi_categories/index/'.$uri, ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_ibi_categories/edit/' . $save_pos_ibi_categories, 'Edit Pos Ibi Categories')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_categories/index/'.$uri);
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_categories');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Categoriess
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$id=$this->uri->segment(5);
		$this->is_allowed('pos_ibi_categories_update');

		$this->data['pos_ibi_categories'] = $this->model_pos_ibi_categories->find($id);

		$this->template->title('Categories Update');
		$this->render('backend/standart/administrator/pos_ibi_categories/pos_ibi_categories_update', $this->data);
	}

	/**
	* Update Pos Ibi Categoriess
	*
	* @var $id String
	*/
	public function edit_save($id,$store=0)
	{
		if (!$this->is_allowed('pos_ibi_categories_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		$id=$this->uri->segment(5);
		$sto=$this->uri->segment(4);
		$this->form_validation->set_rules('NOM_CATEGORIE', 'Nom ', 'trim|required');
		$this->form_validation->set_rules('DESCRIPTION_CATEGORIE', 'Description', 'trim|required');
		$this->form_validation->set_rules('pos_ibi_categories_THUMB_CATEGORIE_name', 'Apercu', 'trim|required');
		
		if ($this->form_validation->run()) {
			$pos_ibi_categories_THUMB_CATEGORIE_uuid = $this->input->post('pos_ibi_categories_THUMB_CATEGORIE_uuid');
			$pos_ibi_categories_THUMB_CATEGORIE_name = $this->input->post('pos_ibi_categories_THUMB_CATEGORIE_name');
		
			$save_data = [
				'NOM_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				'DESCRIPTION_CATEGORIE' => $this->input->post('DESCRIPTION_CATEGORIE'),
				'DATE_MOD_CATEGORIE' => date('Y-m-d H:i:s'),
				'PARENT_REF_ID_CATEGORIE' => $this->input->post('PARENT_REF_ID_CATEGORIE'),
			];

			if (!is_dir(FCPATH . '/uploads/pos_ibi_categories/')) {
				mkdir(FCPATH . '/uploads/pos_ibi_categories/');
			}

			if (!empty($pos_ibi_categories_THUMB_CATEGORIE_uuid)) {
				$pos_ibi_categories_THUMB_CATEGORIE_name_copy = date('YmdHis') . '-' . $pos_ibi_categories_THUMB_CATEGORIE_name;

				rename(FCPATH . 'uploads/tmp/' . $pos_ibi_categories_THUMB_CATEGORIE_uuid . '/' . $pos_ibi_categories_THUMB_CATEGORIE_name, 
						FCPATH . 'uploads/pos_ibi_categories/' . $pos_ibi_categories_THUMB_CATEGORIE_name_copy);

				if (!is_file(FCPATH . '/uploads/pos_ibi_categories/' . $pos_ibi_categories_THUMB_CATEGORIE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['THUMB_CATEGORIE'] = $pos_ibi_categories_THUMB_CATEGORIE_name_copy;
			}
		
			
			$save_pos_ibi_categories = $this->model_pos_ibi_categories->change($id, $save_data);

			if ($save_pos_ibi_categories) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_ibi_categories', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_categories/index/'.$sto.'/');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_categories/index'.$store.'/');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Categoriess
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_ibi_categories_delete');

		$this->load->helper('file');
		$id=$this->uri->segment(5);
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
            set_message(cclang('has_been_deleted', 'pos_ibi_categories'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_ibi_categories'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Categoriess
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_ibi_categories_view');

		$this->data['pos_ibi_categories'] = $this->model_pos_ibi_categories->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Categories Detail');
		$this->render('backend/standart/administrator/pos_ibi_categories/pos_ibi_categories_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Categoriess
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pos_ibi_categories = $this->model_pos_ibi_categories->find($id);

		if (!empty($pos_ibi_categories->THUMB_CATEGORIE)) {
			$path = FCPATH . '/uploads/pos_ibi_categories/' . $pos_ibi_categories->THUMB_CATEGORIE;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_pos_ibi_categories->remove($id);
	}
	
	/**
	* Upload Image Pos Ibi Categories	* 
	* @return JSON
	*/
	public function upload_THUMB_CATEGORIE_file()
	{
		if (!$this->is_allowed('pos_ibi_categories_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'pos_ibi_categories',
		]);
	}

	/**
	* Delete Image Pos Ibi Categories	* 
	* @return JSON
	*/
	public function delete_THUMB_CATEGORIE_file($uuid)
	{
		if (!$this->is_allowed('pos_ibi_categories_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'THUMB_CATEGORIE', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'pos_ibi_categories',
            'primary_key'       => 'ID_CATEGORIE',
            'upload_path'       => 'uploads/pos_ibi_categories/'
        ]);
	}

	/**
	* Get Image Pos Ibi Categories	* 
	* @return JSON
	*/
	public function get_THUMB_CATEGORIE_file($id)
	{
		if (!$this->is_allowed('pos_ibi_categories_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$pos_ibi_categories = $this->model_pos_ibi_categories->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'THUMB_CATEGORIE', 
            'table_name'        => 'pos_ibi_categories',
            'primary_key'       => 'ID_CATEGORIE',
            'upload_path'       => 'uploads/pos_ibi_categories/',
            'delete_endpoint'   => 'administrator/pos_ibi_categories/delete_THUMB_CATEGORIE_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_ibi_categories_export');

		$this->model_pos_ibi_categories->export('pos_ibi_categories', 'pos_ibi_categories');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_ibi_categories_export');

		$this->model_pos_ibi_categories->pdf('pos_ibi_categories', 'pos_ibi_categories');
	}
}


/* End of file pos_ibi_categories.php */
/* Location: ./application/controllers/administrator/Pos Ibi Categories.php */