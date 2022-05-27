<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pays Controller
*| --------------------------------------------------------------------------
*| Pays site
*|
*/
class Pays extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pays');
	}

	/**
	* show all Payss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pays_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['payss'] = $this->model_pays->get($filter, $field, $this->limit_page, $offset);
		$this->data['pays_counts'] = $this->model_pays->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pays/index/',
			'total_rows'   => $this->model_pays->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pays List');
		$this->render('backend/standart/administrator/pays/pays_list', $this->data);
	}
	
	/**
	* Add new payss
	*
	*/
	public function add()
	{
		$this->is_allowed('pays_add');

		$this->template->title('Pays New');
		$this->render('backend/standart/administrator/pays/pays_add', $this->data);
	}

	/**
	* Add New Payss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pays_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NOM_PAYS', 'NOM PAYS', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM_PAYS' => $this->input->post('NOM_PAYS'),
			];

			
			$save_pays = $this->model_pays->store($save_data);

			if ($save_pays) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pays;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pays/edit/' . $save_pays, 'Edit Pays'),
						anchor('administrator/pays', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pays/edit/' . $save_pays, 'Edit Pays')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pays');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pays');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Payss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pays_update');

		$this->data['pays'] = $this->model_pays->find($id);

		$this->template->title('Pays Update');
		$this->render('backend/standart/administrator/pays/pays_update', $this->data);
	}

	/**
	* Update Payss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pays_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NOM_PAYS', 'NOM PAYS', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM_PAYS' => $this->input->post('NOM_PAYS'),
			];

			
			$save_pays = $this->model_pays->change($id, $save_data);

			if ($save_pays) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pays', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pays');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pays');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Payss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pays_delete');

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
            set_message(cclang('has_been_deleted', 'pays'), 'success');
        } else {
            set_message(cclang('error_delete', 'pays'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Payss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pays_view');

		$this->data['pays'] = $this->model_pays->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pays Detail');
		$this->render('backend/standart/administrator/pays/pays_view', $this->data);
	}
	
	/**
	* delete Payss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pays = $this->model_pays->find($id);

		
		
		return $this->model_pays->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pays_export');

		$this->model_pays->export('pays', 'pays');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pays_export');

		$this->model_pays->pdf('pays', 'pays');
	}
}


/* End of file pays.php */
/* Location: ./application/controllers/administrator/Pays.php */