<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Unite Ingredients Controller
*| --------------------------------------------------------------------------
*| Unite Ingredients site
*|
*/
class Unite_ingredients extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_unite_ingredients');
	}

	/**
	* show all Unite Ingredientss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('unite_ingredients_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['unite_ingredientss'] = $this->model_unite_ingredients->get($filter, $field, $this->limit_page, $offset);
		$this->data['unite_ingredients_counts'] = $this->model_unite_ingredients->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/unite_ingredients/index/',
			'total_rows'   => $this->model_unite_ingredients->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Unite Ingredients List');
		$this->render('backend/standart/administrator/unite_ingredients/unite_ingredients_list', $this->data);
	}
	
	/**
	* Add new unite_ingredientss
	*
	*/
	public function add()
	{
		$this->is_allowed('unite_ingredients_add');

		$this->template->title('Unite Ingredients New');
		$this->render('backend/standart/administrator/unite_ingredients/unite_ingredients_add', $this->data);
	}

	/**
	* Add New Unite Ingredientss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('unite_ingredients_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NOM_UNITE', 'NOM UNITE', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM_UNITE' => $this->input->post('NOM_UNITE'),
			];

			
			$save_unite_ingredients = $this->model_unite_ingredients->store($save_data);

			if ($save_unite_ingredients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_unite_ingredients;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/unite_ingredients/edit/' . $save_unite_ingredients, 'Edit Unite Ingredients'),
						anchor('administrator/unite_ingredients', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/unite_ingredients/edit/' . $save_unite_ingredients, 'Edit Unite Ingredients')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/unite_ingredients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/unite_ingredients');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Unite Ingredientss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('unite_ingredients_update');

		$this->data['unite_ingredients'] = $this->model_unite_ingredients->find($id);

		$this->template->title('Unite Ingredients Update');
		$this->render('backend/standart/administrator/unite_ingredients/unite_ingredients_update', $this->data);
	}

	/**
	* Update Unite Ingredientss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('unite_ingredients_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NOM_UNITE', 'NOM UNITE', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM_UNITE' => $this->input->post('NOM_UNITE'),
			];

			
			$save_unite_ingredients = $this->model_unite_ingredients->change($id, $save_data);

			if ($save_unite_ingredients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/unite_ingredients', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/unite_ingredients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/unite_ingredients');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Unite Ingredientss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('unite_ingredients_delete');

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
            set_message(cclang('has_been_deleted', 'unite_ingredients'), 'success');
        } else {
            set_message(cclang('error_delete', 'unite_ingredients'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Unite Ingredientss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('unite_ingredients_view');

		$this->data['unite_ingredients'] = $this->model_unite_ingredients->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Unite Ingredients Detail');
		$this->render('backend/standart/administrator/unite_ingredients/unite_ingredients_view', $this->data);
	}
	
	/**
	* delete Unite Ingredientss
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$unite_ingredients = $this->model_unite_ingredients->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_UNITY' => 1,
								'DELETED_DATE_UNITY' => date('Y-m-d H:i:s'),
								'DELETED_USER_UNITY' => get_user_data('id'),
								'DELETED_COMMENT_UNITY' => $commentValue
							);

		        $remove = $this->db->update("unite_ingredients",$delete_save,array("ID_UNITE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('unite_ingredients_export');

		$this->model_unite_ingredients->export('unite_ingredients', 'unite_ingredients');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('unite_ingredients_export');

		$this->model_unite_ingredients->pdf('unite_ingredients', 'unite_ingredients');
	}
}


/* End of file unite_ingredients.php */
/* Location: ./application/controllers/administrator/Unite Ingredients.php */