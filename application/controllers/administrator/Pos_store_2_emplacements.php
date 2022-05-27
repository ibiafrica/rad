<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Store 2 Emplacements Controller
*| --------------------------------------------------------------------------
*| Pos Store 2 Emplacements site
*|
*/
class Pos_store_2_emplacements extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_store_2_emplacements');
	}

	/**
	* show all Pos Store 2 Emplacementss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_store_2_emplacements_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_store_2_emplacementss'] = $this->model_pos_store_2_emplacements->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_store_2_emplacements_counts'] = $this->model_pos_store_2_emplacements->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_store_2_emplacements/index/',
			'total_rows'   => $this->model_pos_store_2_emplacements->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Store 2 Emplacements List');
		$this->render('backend/standart/administrator/pos_store_2_emplacements/pos_store_2_emplacements_list', $this->data);
	}
	
	/**
	* Add new pos_store_2_emplacementss
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_store_2_emplacements_add');

		$this->template->title('Pos Store 2 Emplacements New');
		$this->render('backend/standart/administrator/pos_store_2_emplacements/pos_store_2_emplacements_add', $this->data);
	}

	/**
	* Add New Pos Store 2 Emplacementss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pos_store_2_emplacements_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('emplacement_designation', 'Désignation', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'emplacement_designation' => $this->input->post('emplacement_designation'),
				'emplacement_user_id' => $this->input->post('emplacement_user_id'),
				'emplacement_date_creation' => $this->input->post('emplacement_date_creation'),
				'emplacement_date_modification' => $this->input->post('emplacement_date_modification'),
			];

			
			$save_pos_store_2_emplacements = $this->model_pos_store_2_emplacements->store($save_data);

			if ($save_pos_store_2_emplacements) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_store_2_emplacements;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_store_2_emplacements/edit/' . $save_pos_store_2_emplacements, 'Edit Pos Store 2 Emplacements'),
						anchor('administrator/pos_store_2_emplacements', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_store_2_emplacements/edit/' . $save_pos_store_2_emplacements, 'Edit Pos Store 2 Emplacements')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_store_2_emplacements');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_store_2_emplacements');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Store 2 Emplacementss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pos_store_2_emplacements_update');

		$this->data['pos_store_2_emplacements'] = $this->model_pos_store_2_emplacements->find($id);

		$this->template->title('Pos Store 2 Emplacements Update');
		$this->render('backend/standart/administrator/pos_store_2_emplacements/pos_store_2_emplacements_update', $this->data);
	}

	/**
	* Update Pos Store 2 Emplacementss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_store_2_emplacements_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('emplacement_designation', 'Désignation', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'emplacement_designation' => $this->input->post('emplacement_designation'),
				'emplacement_user_id' => $this->input->post('emplacement_user_id'),
				'emplacement_date_creation' => $this->input->post('emplacement_date_creation'),
				'emplacement_date_modification' => $this->input->post('emplacement_date_modification'),
			];

			
			$save_pos_store_2_emplacements = $this->model_pos_store_2_emplacements->change($id, $save_data);

			if ($save_pos_store_2_emplacements) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_store_2_emplacements', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_store_2_emplacements');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_store_2_emplacements');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Store 2 Emplacementss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_store_2_emplacements_delete');

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
            set_message(cclang('has_been_deleted', 'pos_store_2_emplacements'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_store_2_emplacements'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Store 2 Emplacementss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_store_2_emplacements_view');

		$this->data['pos_store_2_emplacements'] = $this->model_pos_store_2_emplacements->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Store 2 Emplacements Detail');
		$this->render('backend/standart/administrator/pos_store_2_emplacements/pos_store_2_emplacements_view', $this->data);
	}
	
	/**
	* delete Pos Store 2 Emplacementss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pos_store_2_emplacements = $this->model_pos_store_2_emplacements->find($id);

		
		
		return $this->model_pos_store_2_emplacements->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_store_2_emplacements_export');

		$this->model_pos_store_2_emplacements->export('pos_store_2_emplacements', 'pos_store_2_emplacements');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_store_2_emplacements_export');

		$this->model_pos_store_2_emplacements->pdf('pos_store_2_emplacements', 'pos_store_2_emplacements');
	}
}


/* End of file pos_store_2_emplacements.php */
/* Location: ./application/controllers/administrator/Pos Store 2 Emplacements.php */