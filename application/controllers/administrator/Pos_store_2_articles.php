<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Store 2 Articles Controller
*| --------------------------------------------------------------------------
*| Pos Store 2 Articles site
*|
*/
class Pos_store_2_articles extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_store_2_articles');
	}

	/**
	* show all Pos Store 2 Articless
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_store_2_articles_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_store_2_articless'] = $this->model_pos_store_2_articles->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_store_2_articles_counts'] = $this->model_pos_store_2_articles->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_store_2_articles/index/',
			'total_rows'   => $this->model_pos_store_2_articles->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Store 2 Articles List');
		$this->render('backend/standart/administrator/pos_store_2_articles/pos_store_2_articles_list', $this->data);
	}
	
	/**
	* Add new pos_store_2_articless
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_store_2_articles_add');

		$this->template->title('Pos Store 2 Articles New');
		$this->render('backend/standart/administrator/pos_store_2_articles/pos_store_2_articles_add', $this->data);
	}

	/**
	* Add New Pos Store 2 Articless
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pos_store_2_articles_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('article_designation', 'Article', 'trim|required');
		$this->form_validation->set_rules('article_emplacement_id', 'Emplacement', 'trim|required');
		$this->form_validation->set_rules('articles_prix_vente', 'Articles Prix Vente', 'trim|required');
		

		if ($this->form_validation->run()) {
			$pos_store_2_articles_articles_image_uuid = $this->input->post('pos_store_2_articles_articles_image_uuid');
			$pos_store_2_articles_articles_image_name = $this->input->post('pos_store_2_articles_articles_image_name');
		
			$save_data = [
				'article_designation' => $this->input->post('article_designation'),
				'article_categorie_id' => $this->input->post('article_categorie_id'),
				'article_emplacement_id' => $this->input->post('article_emplacement_id'),
				'article_part_number' => $this->input->post('article_part_number'),
				'article_etiquitte' => $this->input->post('article_etiquitte'),
				'article_code' => $this->input->post('article_code'),
				'articles_prix_vente' => $this->input->post('articles_prix_vente'),
				'articles_prix_vente_promotion' => $this->input->post('articles_prix_vente_promotion'),
				'articles_date_debut_promotion' => $this->input->post('articles_date_debut_promotion'),
				'articles_date_fin_promotion' => $this->input->post('articles_date_fin_promotion'),
				'articles_unite' => $this->input->post('articles_unite'),
				'articles_description' => $this->input->post('articles_description'),
				'article_date_creation' => $this->input->post('article_date_creation'),
				'article_date_modification' => $this->input->post('article_date_modification'),
				'article_user_creator_id' => $this->input->post('article_user_creator_id'),
			];

			if (!is_dir(FCPATH . '/uploads/pos_store_2_articles/')) {
				mkdir(FCPATH . '/uploads/pos_store_2_articles/');
			}

			if (!empty($pos_store_2_articles_articles_image_name)) {
				$pos_store_2_articles_articles_image_name_copy = date('YmdHis') . '-' . $pos_store_2_articles_articles_image_name;

				rename(FCPATH . 'uploads/tmp/' . $pos_store_2_articles_articles_image_uuid . '/' . $pos_store_2_articles_articles_image_name, 
						FCPATH . 'uploads/pos_store_2_articles/' . $pos_store_2_articles_articles_image_name_copy);

				if (!is_file(FCPATH . '/uploads/pos_store_2_articles/' . $pos_store_2_articles_articles_image_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['articles_image'] = $pos_store_2_articles_articles_image_name_copy;
			}
		
			
			$save_pos_store_2_articles = $this->model_pos_store_2_articles->store($save_data);

			if ($save_pos_store_2_articles) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_store_2_articles;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_store_2_articles/edit/' . $save_pos_store_2_articles, 'Edit Pos Store 2 Articles'),
						anchor('administrator/pos_store_2_articles', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_store_2_articles/edit/' . $save_pos_store_2_articles, 'Edit Pos Store 2 Articles')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_store_2_articles');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_store_2_articles');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Store 2 Articless
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pos_store_2_articles_update');

		$this->data['pos_store_2_articles'] = $this->model_pos_store_2_articles->find($id);

		$this->template->title('Pos Store 2 Articles Update');
		$this->render('backend/standart/administrator/pos_store_2_articles/pos_store_2_articles_update', $this->data);
	}

	/**
	* Update Pos Store 2 Articless
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_store_2_articles_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('article_designation', 'Article', 'trim|required');
		$this->form_validation->set_rules('article_emplacement_id', 'Emplacement', 'trim|required');
		$this->form_validation->set_rules('articles_prix_vente', 'Articles Prix Vente', 'trim|required');
		
		if ($this->form_validation->run()) {
			$pos_store_2_articles_articles_image_uuid = $this->input->post('pos_store_2_articles_articles_image_uuid');
			$pos_store_2_articles_articles_image_name = $this->input->post('pos_store_2_articles_articles_image_name');
		
			$save_data = [
				'article_designation' => $this->input->post('article_designation'),
				'article_categorie_id' => $this->input->post('article_categorie_id'),
				'article_emplacement_id' => $this->input->post('article_emplacement_id'),
				'article_part_number' => $this->input->post('article_part_number'),
				'article_etiquitte' => $this->input->post('article_etiquitte'),
				'article_code' => $this->input->post('article_code'),
				'articles_prix_vente' => $this->input->post('articles_prix_vente'),
				'articles_prix_vente_promotion' => $this->input->post('articles_prix_vente_promotion'),
				'articles_date_debut_promotion' => $this->input->post('articles_date_debut_promotion'),
				'articles_date_fin_promotion' => $this->input->post('articles_date_fin_promotion'),
				'articles_unite' => $this->input->post('articles_unite'),
				'articles_description' => $this->input->post('articles_description'),
				'article_date_creation' => $this->input->post('article_date_creation'),
				'article_date_modification' => $this->input->post('article_date_modification'),
				'article_user_creator_id' => $this->input->post('article_user_creator_id'),
			];

			if (!is_dir(FCPATH . '/uploads/pos_store_2_articles/')) {
				mkdir(FCPATH . '/uploads/pos_store_2_articles/');
			}

			if (!empty($pos_store_2_articles_articles_image_uuid)) {
				$pos_store_2_articles_articles_image_name_copy = date('YmdHis') . '-' . $pos_store_2_articles_articles_image_name;

				rename(FCPATH . 'uploads/tmp/' . $pos_store_2_articles_articles_image_uuid . '/' . $pos_store_2_articles_articles_image_name, 
						FCPATH . 'uploads/pos_store_2_articles/' . $pos_store_2_articles_articles_image_name_copy);

				if (!is_file(FCPATH . '/uploads/pos_store_2_articles/' . $pos_store_2_articles_articles_image_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['articles_image'] = $pos_store_2_articles_articles_image_name_copy;
			}
		
			
			$save_pos_store_2_articles = $this->model_pos_store_2_articles->change($id, $save_data);

			if ($save_pos_store_2_articles) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_store_2_articles', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_store_2_articles');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_store_2_articles');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Store 2 Articless
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_store_2_articles_delete');

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
            set_message(cclang('has_been_deleted', 'pos_store_2_articles'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_store_2_articles'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Store 2 Articless
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_store_2_articles_view');

		$this->data['pos_store_2_articles'] = $this->model_pos_store_2_articles->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Store 2 Articles Detail');
		$this->render('backend/standart/administrator/pos_store_2_articles/pos_store_2_articles_view', $this->data);
	}
	
	/**
	* delete Pos Store 2 Articless
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pos_store_2_articles = $this->model_pos_store_2_articles->find($id);

		if (!empty($pos_store_2_articles->articles_image)) {
			$path = FCPATH . '/uploads/pos_store_2_articles/' . $pos_store_2_articles->articles_image;

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}
		
		
		return $this->model_pos_store_2_articles->remove($id);
	}
	
	/**
	* Upload Image Pos Store 2 Articles	* 
	* @return JSON
	*/
	public function upload_articles_image_file()
	{
		if (!$this->is_allowed('pos_store_2_articles_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'pos_store_2_articles',
		]);
	}

	/**
	* Delete Image Pos Store 2 Articles	* 
	* @return JSON
	*/
	public function delete_articles_image_file($uuid)
	{
		if (!$this->is_allowed('pos_store_2_articles_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'articles_image', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'pos_store_2_articles',
            'primary_key'       => 'article_id',
            'upload_path'       => 'uploads/pos_store_2_articles/'
        ]);
	}

	/**
	* Get Image Pos Store 2 Articles	* 
	* @return JSON
	*/
	public function get_articles_image_file($id)
	{
		if (!$this->is_allowed('pos_store_2_articles_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$pos_store_2_articles = $this->model_pos_store_2_articles->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'articles_image', 
            'table_name'        => 'pos_store_2_articles',
            'primary_key'       => 'article_id',
            'upload_path'       => 'uploads/pos_store_2_articles/',
            'delete_endpoint'   => 'administrator/pos_store_2_articles/delete_articles_image_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_store_2_articles_export');

		$this->model_pos_store_2_articles->export('pos_store_2_articles', 'pos_store_2_articles');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_store_2_articles_export');

		$this->model_pos_store_2_articles->pdf('pos_store_2_articles', 'pos_store_2_articles');
	}
}


/* End of file pos_store_2_articles.php */
/* Location: ./application/controllers/administrator/Pos Store 2 Articles.php */