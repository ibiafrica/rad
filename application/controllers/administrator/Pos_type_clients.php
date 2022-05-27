<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Type Clients Controller
*| --------------------------------------------------------------------------
*| Pos Type Clients site
*|
*/
class pos_type_clients extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_type_clients');
	}

	/**
	* show all Pos Type Clientss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_type_clients_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_type_clientss'] = $this->model_pos_type_clients->get($filter, $field, $this->limit_page, $offset);

		$this->data['pos_type_clients_counts'] = $this->model_pos_type_clients->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_type_clients/index/',
			'total_rows'   => $this->model_pos_type_clients->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Type Clients List');
		$this->render('backend/standart/administrator/pos_type_clients/pos_type_clients_list', $this->data);
	}
	
	/**
	* Add new pos_type_clientss
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_type_clients_add');

		$this->template->title('Pos Type Clients New');
		$this->render('backend/standart/administrator/pos_type_clients/pos_type_clients_add', $this->data);
	}

	/**
	* Add New Pos Type Clientss
	*
	* @return JSON
	*/
	public function add_save()
	{

		// var_dump($_POST);exit();
		if (!$this->is_allowed('pos_type_clients_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('DESIGN_TYPE_CLIENT', 'Designation', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGN_TYPE_CLIENT' => $this->input->post('DESIGN_TYPE_CLIENT'),
				'CREATED_BY_TYPE_CLIENT' =>get_user_data('id')
			];

			
			$save_pos_type_clients = $this->model_pos_type_clients->store($save_data);

			if ($save_pos_type_clients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_type_clients;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_type_clients/edit/' . $save_pos_type_clients, 'Edit Pos Type Clients'),
						anchor('administrator/pos_type_clients', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_type_clients/edit/' . $save_pos_type_clients, 'Edit Pos Type Clients')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_type_clients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_type_clients');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Type Clientss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pos_type_clients_update');

		$this->data['pos_type_clients'] = $this->model_pos_type_clients->find($id);

		$this->template->title('Pos Type Clients Update');
		$this->render('backend/standart/administrator/pos_type_clients/pos_type_clients_update', $this->data);
	}

	/**
	* Update Pos Type Clientss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_type_clients_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('DESIGN_TYPE_CLIENT_UP', 'Designation', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGN_TYPE_CLIENT' => $this->input->post('DESIGN_TYPE_CLIENT_UP'),
			];

			
			$save_pos_type_clients = $this->model_pos_type_clients->change($id, $save_data);

			if ($save_pos_type_clients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_type_clients', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_type_clients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_type_clients');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Type Clientss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_type_clients_delete');

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
            set_message(cclang('has_been_deleted', 'pos_type_clients'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_type_clients'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Type Clientss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_type_clients_view');

		$this->data['pos_type_clients'] = $this->model_pos_type_clients->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Type Clients Detail');
		$this->render('backend/standart/administrator/pos_type_clients/pos_type_clients_view', $this->data);
	}
	
	/**
	* delete Pos Type Clientss
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_type_clients = $this->model_pos_type_clients->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("pos_type_clients",$delete_save,array("ID_TYPE_CLIENT"=>$id));
		return $remove;
	}
	



	public function get_type_client(){

			$ider = $this->input->post('id');
		    $get_type = $this->db->query('SELECT * FROM pos_type_clients WHERE ID_TYPE_CLIENT =' . $ider . ' ')->row_array();


		echo json_encode($get_type);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_type_clients_export');

		$this->model_pos_type_clients->export('pos_type_clients', 'pos_type_clients');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_type_clients_export');

		$this->model_pos_type_clients->pdf('pos_type_clients', 'pos_type_clients');
	}
}


/* End of file pos_type_clients.php */
/* Location: ./application/controllers/administrator/Pos Type Clients.php */