<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Store 2 Sous Categorie Controller
*| --------------------------------------------------------------------------
*| Pos Store 2 Sous Categorie site
*|
*/
class Pos_store_2_sous_categorie extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_store_2_sous_categorie');
	}

	/**
	* show all Pos Store 2 Sous Categories
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_store_2_sous_categorie_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_store_2_sous_categories'] = $this->model_pos_store_2_sous_categorie->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_store_2_sous_categorie_counts'] = $this->model_pos_store_2_sous_categorie->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_store_2_sous_categorie/index/',
			'total_rows'   => $this->model_pos_store_2_sous_categorie->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Store 2 Sous Categorie List');
		$this->render('backend/standart/administrator/pos_store_2_sous_categorie/pos_store_2_sous_categorie_list', $this->data);
	}
	
	/**
	* Add new pos_store_2_sous_categories
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_store_2_sous_categorie_add');

		$this->template->title('Pos Store 2 Sous Categorie New');
		$this->render('backend/standart/administrator/pos_store_2_sous_categorie/pos_store_2_sous_categorie_add', $this->data);
	}

	/**
	* Add New Pos Store 2 Sous Categories
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pos_store_2_sous_categorie_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('sous_categorie_designation', 'Désignation', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'sous_categorie_categorie_id' => $this->input->post('sous_categorie_categorie_id'),
				'sous_categorie_designation' => $this->input->post('sous_categorie_designation'),
				'sous_categorie_user_id' => $this->input->post('sous_categorie_user_id'),
				'sous_categorie_date_creation' => $this->input->post('sous_categorie_date_creation'),
				'sous_categorie_date_modification' => $this->input->post('sous_categorie_date_modification'),
			];

			
			$save_pos_store_2_sous_categorie = $this->model_pos_store_2_sous_categorie->store($save_data);

			if ($save_pos_store_2_sous_categorie) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_store_2_sous_categorie;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_store_2_sous_categorie/edit/' . $save_pos_store_2_sous_categorie, 'Edit Pos Store 2 Sous Categorie'),
						anchor('administrator/pos_store_2_sous_categorie', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_store_2_sous_categorie/edit/' . $save_pos_store_2_sous_categorie, 'Edit Pos Store 2 Sous Categorie')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_store_2_sous_categorie');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_store_2_sous_categorie');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Store 2 Sous Categories
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pos_store_2_sous_categorie_update');

		$this->data['pos_store_2_sous_categorie'] = $this->model_pos_store_2_sous_categorie->find($id);

		$this->template->title('Pos Store 2 Sous Categorie Update');
		$this->render('backend/standart/administrator/pos_store_2_sous_categorie/pos_store_2_sous_categorie_update', $this->data);
	}

	/**
	* Update Pos Store 2 Sous Categories
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_store_2_sous_categorie_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('sous_categorie_designation', 'Désignation', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'sous_categorie_categorie_id' => $this->input->post('sous_categorie_categorie_id'),
				'sous_categorie_designation' => $this->input->post('sous_categorie_designation'),
				'sous_categorie_user_id' => $this->input->post('sous_categorie_user_id'),
				'sous_categorie_date_creation' => $this->input->post('sous_categorie_date_creation'),
				'sous_categorie_date_modification' => $this->input->post('sous_categorie_date_modification'),
			];

			
			$save_pos_store_2_sous_categorie = $this->model_pos_store_2_sous_categorie->change($id, $save_data);

			if ($save_pos_store_2_sous_categorie) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_store_2_sous_categorie', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_store_2_sous_categorie');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_store_2_sous_categorie');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Store 2 Sous Categories
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_store_2_sous_categorie_delete');

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
            set_message(cclang('has_been_deleted', 'pos_store_2_sous_categorie'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_store_2_sous_categorie'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Store 2 Sous Categories
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_store_2_sous_categorie_view');

		$this->data['pos_store_2_sous_categorie'] = $this->model_pos_store_2_sous_categorie->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Store 2 Sous Categorie Detail');
		$this->render('backend/standart/administrator/pos_store_2_sous_categorie/pos_store_2_sous_categorie_view', $this->data);
	}
	
	/**
	* delete Pos Store 2 Sous Categories
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pos_store_2_sous_categorie = $this->model_pos_store_2_sous_categorie->find($id);

		
		
		return $this->model_pos_store_2_sous_categorie->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_store_2_sous_categorie_export');

		$this->model_pos_store_2_sous_categorie->export('pos_store_2_sous_categorie', 'pos_store_2_sous_categorie');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_store_2_sous_categorie_export');

		$this->model_pos_store_2_sous_categorie->pdf('pos_store_2_sous_categorie', 'pos_store_2_sous_categorie');
	}
}


/* End of file pos_store_2_sous_categorie.php */
/* Location: ./application/controllers/administrator/Pos Store 2 Sous Categorie.php */