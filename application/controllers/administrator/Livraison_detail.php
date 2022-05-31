<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Livraison Detail Controller
*| --------------------------------------------------------------------------
*| Livraison Detail site
*|
*/
class Livraison_detail extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_livraison_detail');
	}

	/**
	* show all Livraison Details
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('livraison_detail_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['livraison_details'] = $this->model_livraison_detail->get($filter, $field, $this->limit_page, $offset);
		$this->data['livraison_detail_counts'] = $this->model_livraison_detail->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/livraison_detail/index/',
			'total_rows'   => $this->model_livraison_detail->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Livraison Detail List');
		$this->render('backend/standart/administrator/livraison_detail/livraison_detail_list', $this->data);
	}
	
	/**
	* Add new livraison_details
	*
	*/
	public function add()
	{
		$this->is_allowed('livraison_detail_add');

		$this->template->title('Livraison Detail New');
		$this->render('backend/standart/administrator/livraison_detail/livraison_detail_add', $this->data);
	}

	/**
	* Add New Livraison Details
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('livraison_detail_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('REF_ID_L', 'REF ID L', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('REF_ID_BL', 'REF ID BL', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'REF_ID_L' => $this->input->post('REF_ID_L'),
				'REF_ID_BL' => $this->input->post('REF_ID_BL'),
			];

			
			$save_livraison_detail = $this->model_livraison_detail->store($save_data);

			if ($save_livraison_detail) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_livraison_detail;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/livraison_detail/edit/' . $save_livraison_detail, 'Edit Livraison Detail'),
						anchor('administrator/livraison_detail', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/livraison_detail/edit/' . $save_livraison_detail, 'Edit Livraison Detail')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/livraison_detail');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/livraison_detail');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Livraison Details
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('livraison_detail_update');

		$this->data['livraison_detail'] = $this->model_livraison_detail->find($id);

		$this->template->title('Livraison Detail Update');
		$this->render('backend/standart/administrator/livraison_detail/livraison_detail_update', $this->data);
	}

	/**
	* Update Livraison Details
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('livraison_detail_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('REF_ID_L', 'REF ID L', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('REF_ID_BL', 'REF ID BL', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'REF_ID_L' => $this->input->post('REF_ID_L'),
				'REF_ID_BL' => $this->input->post('REF_ID_BL'),
			];

			
			$save_livraison_detail = $this->model_livraison_detail->change($id, $save_data);

			if ($save_livraison_detail) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/livraison_detail', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/livraison_detail');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/livraison_detail');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Livraison Details
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('livraison_detail_delete');

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
            set_message(cclang('has_been_deleted', 'livraison_detail'), 'success');
        } else {
            set_message(cclang('error_delete', 'livraison_detail'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Livraison Details
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('livraison_detail_view');

		$this->data['livraison_detail'] = $this->model_livraison_detail->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Livraison Detail Detail');
		$this->render('backend/standart/administrator/livraison_detail/livraison_detail_view', $this->data);
	}
	
	/**
	* delete Livraison Details
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$livraison_detail = $this->model_livraison_detail->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("livraison_detail",$delete_save,array("ID_LVD"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('livraison_detail_export');

		$this->model_livraison_detail->export('livraison_detail', 'livraison_detail');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('livraison_detail_export');

		$this->model_livraison_detail->pdf('livraison_detail', 'livraison_detail');
	}
}


/* End of file livraison_detail.php */
/* Location: ./application/controllers/administrator/Livraison Detail.php */