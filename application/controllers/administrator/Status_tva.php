<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Status Tva Controller
*| --------------------------------------------------------------------------
*| Status Tva site
*|
*/
class Status_tva extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_status_tva');
	}

	/**
	* show all Status Tvas
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('status_tva_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['status_tvas'] = $this->model_status_tva->get($filter, $field, $this->limit_page, $offset);
		$this->data['status_tva_counts'] = $this->model_status_tva->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/status_tva/index/',
			'total_rows'   => $this->model_status_tva->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Status Tva List');
		$this->render('backend/standart/administrator/status_tva/status_tva_list', $this->data);
	}
	
	/**
	* Add new status_tvas
	*
	*/
	public function add()
	{
		$this->is_allowed('status_tva_add');

		$this->template->title('Status Tva New');
		$this->render('backend/standart/administrator/status_tva/status_tva_add', $this->data);
	}

	/**
	* Add New Status Tvas
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('status_tva_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('TVA_PERCENT', 'TVA PERCENT', 'trim|required');
		//$this->form_validation->set_rules('TYPE_TVA', 'TYPE TVA', 'trim|required');
		
		$tva=0;

		if ($this->form_validation->run()) {

			$type = $this->input->post('TYPE_TVA');

			if ($type==0) {
				
				$tva = 100/100+($this->input->post('TVA_PERCENT')/100);
			}else{
				$tva = 100/100+($this->input->post('TVA_PERCENT')/100);
			}
		
			$save_data = [
				'TVA_PERCENT' => $tva,
				//'TYPE_TVA' => $this->input->post('TYPE_TVA'),
				'TVA_DESCRIPTION' => $this->input->post('TVA_DESCRIPTION'),
				'TVA_CEREATE_BY' => get_user_data('id'),				
				'TVA_DATE_CREATION' => date('Y-m-d H:i:s'),
			];

			
			$save_status_tva = $this->model_status_tva->store($save_data);

			if ($save_status_tva) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_status_tva;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/status_tva/edit/' . $save_status_tva, 'Edit Status Tva'),
						anchor('administrator/status_tva', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/status_tva/edit/' . $save_status_tva, 'Edit Status Tva')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_tva');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_tva');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Status Tvas
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('status_tva_update');

		$this->data['status_tva'] = $this->model_status_tva->find($id);

		$this->template->title('Status Tva Update');
		$this->render('backend/standart/administrator/status_tva/status_tva_update', $this->data);
	}

	/**
	* Update Status Tvas
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('status_tva_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('TVA_PERCENT', 'TVA PERCENT', 'trim|required');
		//$this->form_validation->set_rules('TYPE_TVA', 'TYPE TVA', 'trim|required');

		$tva=0;
		
		if ($this->form_validation->run()) {

			$type = $this->input->post('TYPE_TVA');

			if ($type==0) {
				
				$tva = 100/100+($this->input->post('TVA_PERCENT')/100);
			}else{
				$tva = 100/100+($this->input->post('TVA_PERCENT')/100);
			}
		
			$save_data = [
				'TVA_PERCENT' => $tva,
				//'TYPE_TVA' => $this->input->post('TYPE_TVA'),
				'TVA_DESCRIPTION' => $this->input->post('TVA_DESCRIPTION'),
							];

			
			$save_status_tva = $this->model_status_tva->change($id, $save_data);

			if ($save_status_tva) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/status_tva', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/status_tva');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/status_tva');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Status Tvas
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('status_tva_delete');

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
            set_message(cclang('has_been_deleted', 'status_tva'), 'success');
        } else {
            set_message(cclang('error_delete', 'status_tva'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Status Tvas
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('status_tva_view');

		$this->data['status_tva'] = $this->model_status_tva->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Status Tva Detail');
		$this->render('backend/standart/administrator/status_tva/status_tva_view', $this->data);
	}
	
	/**
	* delete Status Tvas
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$status_tva = $this->model_status_tva->find($id);

		
		         
		 $delete_save = array(
								'TVA_STATUS' => 1
								
							);

		        $remove = $this->db->update("status_tva",$delete_save,array("ID_TVA"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('status_tva_export');

		$this->model_status_tva->export('status_tva', 'status_tva');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('status_tva_export');

		$this->model_status_tva->pdf('status_tva', 'status_tva');
	}
}


/* End of file status_tva.php */
/* Location: ./application/controllers/administrator/Status Tva.php */