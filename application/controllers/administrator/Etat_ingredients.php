<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Etat Ingredients Controller
*| --------------------------------------------------------------------------
*| Etat Ingredients site
*|
*/
class Etat_ingredients extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_etat_ingredients');
	}

	/**
	* show all Etat Ingredientss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('etat_ingredients_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['etat_ingredientss'] = $this->model_etat_ingredients->get($filter, $field, $this->limit_page, $offset);
		$this->data['etat_ingredients_counts'] = $this->model_etat_ingredients->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/etat_ingredients/index/',
			'total_rows'   => $this->model_etat_ingredients->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Etat Ingredients List');
		$this->render('backend/standart/administrator/etat_ingredients/etat_ingredients_list', $this->data);
	}
	
	/**
	* Add new etat_ingredientss
	*
	*/
	public function add()
	{
		$this->is_allowed('etat_ingredients_add');

		$this->template->title('Etat Ingredients New');
		$this->render('backend/standart/administrator/etat_ingredients/etat_ingredients_add', $this->data);
	}

	/**
	* Add New Etat Ingredientss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('etat_ingredients_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NOM_ETAT', 'NOM ETAT', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM_ETAT' => $this->input->post('NOM_ETAT'),
			];

			
			$save_etat_ingredients = $this->model_etat_ingredients->store($save_data);

			if ($save_etat_ingredients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_etat_ingredients;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/etat_ingredients/edit/' . $save_etat_ingredients, 'Edit Etat Ingredients'),
						anchor('administrator/etat_ingredients', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/etat_ingredients/edit/' . $save_etat_ingredients, 'Edit Etat Ingredients')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/etat_ingredients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/etat_ingredients');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Etat Ingredientss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('etat_ingredients_update');

		$this->data['etat_ingredients'] = $this->model_etat_ingredients->find($id);

		$this->template->title('Etat Ingredients Update');
		$this->render('backend/standart/administrator/etat_ingredients/etat_ingredients_update', $this->data);
	}

	/**
	* Update Etat Ingredientss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('etat_ingredients_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NOM_ETAT', 'NOM ETAT', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM_ETAT' => $this->input->post('NOM_ETAT'),
			];

			
			$save_etat_ingredients = $this->model_etat_ingredients->change($id, $save_data);

			if ($save_etat_ingredients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/etat_ingredients', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/etat_ingredients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/etat_ingredients');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Etat Ingredientss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('etat_ingredients_delete');

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
            set_message(cclang('has_been_deleted', 'etat_ingredients'), 'success');
        } else {
            set_message(cclang('error_delete', 'etat_ingredients'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Etat Ingredientss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('etat_ingredients_view');

		$this->data['etat_ingredients'] = $this->model_etat_ingredients->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Etat Ingredients Detail');
		$this->render('backend/standart/administrator/etat_ingredients/etat_ingredients_view', $this->data);
	}
	
	/**
	* delete Etat Ingredientss
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$etat_ingredients = $this->model_etat_ingredients->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("etat_ingredients",$delete_save,array("ID_ETAT"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('etat_ingredients_export');

		$this->model_etat_ingredients->export('etat_ingredients', 'etat_ingredients');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('etat_ingredients_export');

		$this->model_etat_ingredients->pdf('etat_ingredients', 'etat_ingredients');
	}
}


/* End of file etat_ingredients.php */
/* Location: ./application/controllers/administrator/Etat Ingredients.php */