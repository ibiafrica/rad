<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Store 2 Categorie Ingredient Controller
*| --------------------------------------------------------------------------
*| Pos Store 2 Categorie Ingredient site
*|
*/
class pos_categorie_ingredient extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_categorie_ingredient');
	}

	/**
	* show all Pos Store 2 Categorie Ingredients
	*
	* @var $offset String
	*/
	public function index($store=0,$offset = 0)
	{
		$this->is_allowed('pos_categorie_ingredient_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_categorie_ingredients'] = $this->model_pos_categorie_ingredient->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_categorie_ingredient_counts'] = $this->model_pos_categorie_ingredient->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_categorie_ingredient/index/',
			'total_rows'   => $this->model_pos_categorie_ingredient->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Categorie Ingredient List');
		$this->render('backend/standart/administrator/pos_categorie_ingredient/pos_categorie_ingredient_list', $this->data);
	}
	
	/**
	* Add new pos_categorie_ingredients
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_categorie_ingredient_add');

		$this->template->title('Categorie Ingredient New');
		$this->render('backend/standart/administrator/pos_categorie_ingredient/pos_categorie_ingredient_add', $this->data);
	}

	/**
	* Add New Pos Store 2 Categorie Ingredients
	*
	* @return JSON
	*/
	public function add_save($store=0)
	{
		if (!$this->is_allowed('pos_categorie_ingredient_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NAME_CATEGORIE', 'Nom', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_CATEGORIE' => $this->input->post('NAME_CATEGORIE'),
				'DESCRIPTION_CATEGORIE' => $this->input->post('DESCRIPTION_CATEGORIE'),
				'DATE_CREATION_CATEGORIE' => date('Y-m-d H:i:s'),
				'CREATED_BY_CATEGORIE' => get_user_data('id'),				'MODIFY_BY_CATEGORIE' => get_user_data('id'),			];

			
			$save_pos_categorie_ingredient = $this->model_pos_categorie_ingredient->store($save_data);

			if ($save_pos_categorie_ingredient) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_categorie_ingredient;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_categorie_ingredient/edit/' . $save_pos_categorie_ingredient, 'Edit Pos Store 2 Categorie Ingredient'),
						anchor('administrator/pos_categorie_ingredient', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_categorie_ingredient/edit/' . $save_pos_categorie_ingredient, 'Edit Pos Store 2 Categorie Ingredient')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('categorie_ingredient/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('categorie_ingredient/'.$store.'/index');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Store 2 Categorie Ingredients
	*
	* @var $id String
	*/
	public function edit()

	
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);
		$this->is_allowed('pos_categorie_ingredient_update');

		$this->data['pos_categorie_ingredient'] = $this->model_pos_categorie_ingredient->find($id);

		$this->template->title('Categorie Ingredient Update');
		$this->render('backend/standart/administrator/pos_categorie_ingredient/pos_categorie_ingredient_update', $this->data);
	}

	/**
	* Update Pos Store 2 Categorie Ingredients
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		if (!$this->is_allowed('pos_categorie_ingredient_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NAME_CATEGORIE', 'Nom', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_CATEGORIE' => $this->input->post('NAME_CATEGORIE'),
				'DESCRIPTION_CATEGORIE' => $this->input->post('DESCRIPTION_CATEGORIE'),
				'DATE_MOD_CATEGORIE' => date('Y-m-d H:i:s'),
				'MODIFY_BY_CATEGORIE' => get_user_data('id'),			];

			
			$save_pos_categorie_ingredient = $this->model_pos_categorie_ingredient->change($id, $save_data);

			if ($save_pos_categorie_ingredient) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_categorie_ingredient', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('categorie_ingredient/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('categorie_ingredient/'.$store.'/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Store 2 Categorie Ingredients
	*
	* @var $id String
	*/
	public function delete()
	{
		$this->is_allowed('pos_categorie_ingredient_delete');

		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

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
            set_message(cclang('has_been_deleted', 'pos_categorie_ingredient'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_categorie_ingredient'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Store 2 Categorie Ingredients
	*
	* @var $id String
	*/
	public function view()
	{
		$this->is_allowed('pos_categorie_ingredient_view');
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

		$this->data['pos_categorie_ingredient'] = $this->model_pos_categorie_ingredient->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Categorie Ingredient Detail');
		$this->render('backend/standart/administrator/pos_categorie_ingredient/pos_categorie_ingredient_view', $this->data);
	}
	
	/**
	* delete Pos Store 2 Categorie Ingredients
	*
	* @var $id String
	*/
	private function _remove()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

		$pos_categorie_ingredient = $this->model_pos_categorie_ingredient->find($id);


		        $remove = $this->db->query("DELETE FROM pos_store_2_categorie_ingredient WHERE ID_CATEGORIE=".$id);
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_categorie_ingredient_export');

		$this->model_pos_categorie_ingredient->export('pos_store_2_categorie_ingredient', 'pos_categorie_ingredient');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_categorie_ingredient_export');

		$this->model_pos_categorie_ingredient->pdf('pos_store_2_categorie_ingredient', 'pos_categorie_ingredient');
	}
}


/* End of file pos_categorie_ingredient.php */
/* Location: ./application/controllers/administrator/Pos Store 2 Categorie Ingredient.php */