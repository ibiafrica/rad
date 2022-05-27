<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Articles Categories Controller
*| --------------------------------------------------------------------------
*| Pos Articles Categories site
*|
*/
class pos_ingredient_categories extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_pos_categories_ingredient');
		$this->load->model('Model_rm');
	}

	/**
	* show all Pos Articles Categoriess
	*
	* @var $offset String
	*/
	public function index($store=0,$offset = 0)
	{
		$this->is_allowed('pos_ingredient_categories_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_ingredient_categoriess'] = $this->Model_pos_categories_ingredient->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_ingredient_categories_counts'] = $this->Model_pos_categories_ingredient->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_ingredient_categories/index/',
			'total_rows'   => $this->Model_pos_categories_ingredient->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Articles Categories List');
		$this->render('backend/standart/administrator/pos_ingredient_categories/pos_ingredient_categories_list', $this->data);
	}
	
	/**
	* Add new pos_ingredient_categoriess
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_ingredient_categories_add');

		$this->template->title('Pos Articles Categories New');
		$this->render('backend/standart/administrator/pos_ingredient_categories/pos_ingredient_categories_add', $this->data);
	}

	/**
	* Add New Pos Articles Categoriess
	*
	* @return JSON
	*/
	public function add_save($store)
	{
		
		if (!$this->is_allowed('pos_ingredient_categories_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$table='pos_store_'.$store.'_categorie_ingredient';

		// $this->form_validation->set_rules('STORE_ID', 'Store', 'trim|required');
		$this->form_validation->set_rules('NOM_CATEGORIE', 'Nom Categorie', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				'DATE_CREATION_CATEGORIE' => date('Y-m-d H:i:s'),
				'CREATED_BY_CATEGORIE' => get_user_data('id'),
				];

			
			$save_pos_ingredient_categories = $this->Model_rm->insert_last_id($table,$save_data);

			if ($save_pos_ingredient_categories) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ingredient_categories;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_ingredient_categories/edit/' . $save_pos_ingredient_categories, 'Edit Pos Articles Categories'),
						anchor('administrator/pos_ingredient_categories', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_ingredient_categories/edit/' . $save_pos_ingredient_categories, 'Edit Pos Articles Categories')
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
	* Update view Pos Articles Categoriess
	*
	* @var $id String
	*/
	public function edit($store,$id)
	{
		/*$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);*/

		$this->is_allowed('pos_ingredient_categories_update');

		$this->data['pos_ingredient_categories'] = $this->Model_pos_categories_ingredient->find($id);



		$this->template->title('Pos Articles Categories Update');
		$this->render('backend/standart/administrator/pos_ingredient_categories/pos_ingredient_categories_update', $this->data);
	}

	/**
	* Update Pos Articles Categoriess
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		
		if (!$this->is_allowed('pos_ingredient_categories_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$table='pos_store_'.$store.'_categorie_ingredient';
		// $this->form_validation->set_rules('STORE_ID', 'Store', 'trim|required');
		$this->form_validation->set_rules('NOM_CATEGORIE', 'Nom Categorie', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				// 'DESCRIPTION_CATEGORIE' => $this->input->post('DESCRIPTION_CATEGORIE'),
				'DATE_CREATION_CATEGORIE' => date('Y-m-d H:i:s'),
				'CREATED_BY_CATEGORIE' => get_user_data('id'),];

			
			$save_pos_ingredient_categories = $this->Model_rm->update($table,array("ID_CATEGORIE"=>$id),$save_data);

			if ($save_pos_ingredient_categories) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_ingredient_categories', ' Go back to list')
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
	* delete Pos Articles Categoriess
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_ingredient_categories_delete');

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
            set_message(cclang('has_been_deleted', 'pos_ingredient_categories'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_ingredient_categories'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Articles Categoriess
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_ingredient_categories_view');

		$this->data['pos_ingredient_categories'] = $this->Model_pos_categories_ingredient->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Articles Categories Detail');
		$this->render('backend/standart/administrator/pos_ingredient_categories/pos_ingredient_categories_view', $this->data);
	}
	
	/**
	* delete Pos Articles Categoriess
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{  
		echo  'pos_store_'.$this->uri->segment(2).'_categorie_ingredient';
		exit();
		$pos_ingredient_categories = $this->Model_pos_categories_ingredient->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("pos_ingredient_categories",$delete_save,array("ID_CATEGORIE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_ingredient_categories_export');

		$this->Model_pos_categories_ingredient->export('pos_ingredient_categories', 'pos_ingredient_categories');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_ingredient_categories_export');

		$this->Model_pos_categories_ingredient->pdf('pos_ingredient_categories', 'pos_ingredient_categories');
	}
}


/* End of file pos_ingredient_categories.php */
/* Location: ./application/controllers/administrator/Pos Articles Categories.php */