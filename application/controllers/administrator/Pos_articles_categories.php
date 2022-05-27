<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Articles Categories Controller
*| --------------------------------------------------------------------------
*| Pos Articles Categories site
*|
*/
class pos_articles_categories extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_articles_categories');
	}

	/**
	* show all Pos Articles Categoriess
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_articles_categories_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$store = $this->uri->segment(2);

		$this->data['pos_articles_categoriess'] = $this->model_pos_articles_categories->get($filter, $field, $this->limit_page=100, $offset);
		$this->data['pos_articles_categories_counts'] = $this->model_pos_articles_categories->count_all($filter, $field);

		$config = [
			'base_url'     => 'categories/'.$store.'/index/',
			'total_rows'   => $this->model_pos_articles_categories->count_all($filter, $field),
			'per_page'     => $this->limit_page=100,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Articles Categories List');
		$this->render('backend/standart/administrator/pos_articles_categories/pos_articles_categories_list', $this->data);
	}
	
	/**
	* Add new pos_articles_categoriess
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_articles_categories_add');

		$this->template->title('Pos Articles Categories New');
		$this->render('backend/standart/administrator/pos_articles_categories/pos_articles_categories_add', $this->data);
	}

	/**
	* Add New Pos Articles Categoriess
	*
	* @return JSON
	*/
	public function add_save()
	{
		$store = $this->input->post('store');
		
	
		if (!$this->is_allowed('pos_articles_categories_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		// $this->form_validation->set_rules('STORE_ID', 'Store', 'trim|required');
		$this->form_validation->set_rules('NOM_CATEGORIE', 'Nom Categorie', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'STORE_ID' => $store,
				'NOM_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				'DATE_CREATION_CATEGORIE' => date('Y-m-d H:i:s'),
				'AUTHOR_CATEGORIE' => get_user_data('id'),
				];

			
			$save_pos_articles_categories = $this->model_pos_articles_categories->store($save_data);

			if ($save_pos_articles_categories) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_articles_categories;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_articles_categories/edit/' . $save_pos_articles_categories, 'Edit Pos Articles Categories'),
						anchor('administrator/pos_articles_categories', ' Go back to list')
					]);
				} else {
					set_message('success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('categories/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('categories/'.$store.'/index');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Articles Categoriess
	*
	* @var $id String
	*/
	public function edit()
	{
		$id=$this->uri->segment(4);
		$store = $this->uri->segment(2);
		$this->is_allowed('pos_articles_categories_update');

		$this->data['pos_articles_categories'] = $this->model_pos_articles_categories->find($id);

		$this->template->title('Pos Articles Categories Update');
		$this->render('backend/standart/administrator/pos_articles_categories/pos_articles_categories_update', $this->data);
	}

	/**
	* Update Pos Articles Categoriess
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		$store = $this->input->post('store');
		if (!$this->is_allowed('pos_articles_categories_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		// $this->form_validation->set_rules('STORE_ID', 'Store', 'trim|required');
		$this->form_validation->set_rules('NOM_CATEGORIE', 'Nom Categorie', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'STORE_ID' => $store,
				'NOM_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				// 'DESCRIPTION_CATEGORIE' => $this->input->post('DESCRIPTION_CATEGORIE'),
				'DATE_CREATION_CATEGORIE' => date('Y-m-d H:i:s'),
				'AUTHOR_CATEGORIE' => get_user_data('id'),			];

			
			$save_pos_articles_categories = $this->model_pos_articles_categories->change($id, $save_data);

			if ($save_pos_articles_categories) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_articles_categories', ' Go back to list')
					]);
				} else {
					set_message('success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('categories/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('categories/'.$store.'/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Articles Categoriess
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_articles_categories_delete');

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
            set_message(cclang('has_been_deleted', 'pos_articles_categories'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_articles_categories'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Articles Categoriess
	*
	* @var $id String
	*/
	public function view($id=null)
	{
		$store = $this->uri->segment(2);
		$id  = $this->uri->segment(4);
		$this->is_allowed('pos_articles_categories_view');

		$this->data['pos_articles_categories'] = $this->model_pos_articles_categories->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Articles Categories Detail');
		$this->render('backend/standart/administrator/pos_articles_categories/pos_articles_categories_view', $this->data);
	}
	
	/**
	* delete Pos Articles Categoriess
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_articles_categories = $this->model_pos_articles_categories->find($id);

		
		         
		 $delete_save = array(
								'DELETE_STATUS_CATEGORIE' => 1,
								
								
							);

		        $remove = $this->db->update("categories",$delete_save,array("ID_CATEGORIE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_articles_categories_export');

		$this->model_pos_articles_categories->export('categories', 'categories');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_articles_categories_export');

		$this->model_pos_articles_categories->pdf('categories', 'categories');
	}
}


/* End of file pos_articles_categories.php */
/* Location: ./application/controllers/administrator/Pos Articles Categories.php */