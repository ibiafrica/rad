<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Commande Location Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Commande Location site
*|
*/
class pos_ibi_commande_location extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_ibi_commande_location');
	}

	/**
	* show all Pos Ibi Commande Locations
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_ibi_commande_location_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_ibi_commande_locations'] = $this->model_pos_ibi_commande_location->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_ibi_commande_location_counts'] = $this->model_pos_ibi_commande_location->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_ibi_commande_location/index/',
			'total_rows'   => $this->model_pos_ibi_commande_location->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Table List');
		$this->render('backend/standart/administrator/pos_ibi_commande_location/pos_ibi_commande_location_list', $this->data);
	}
	
	/**
	* Add new pos_ibi_commande_locations
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_ibi_commande_location_add');

		$this->template->title('Table New');
		$this->render('backend/standart/administrator/pos_ibi_commande_location/pos_ibi_commande_location_add', $this->data);
	}

	/**
	* Add New Pos Ibi Commande Locations
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pos_ibi_commande_location_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('DESIGNATION', 'Table', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGNATION' => $this->input->post('DESIGNATION'),
				'CREATED_BY' => get_user_data('id'),				'DATE_CREATION' => date('Y-m-d H:i:s'),
			];

			
			$save_pos_ibi_commande_location = $this->model_pos_ibi_commande_location->store($save_data);

			if ($save_pos_ibi_commande_location) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_commande_location;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_ibi_commande_location/edit/' . $save_pos_ibi_commande_location, 'Edit Pos Ibi Commande Location'),
						anchor('administrator/pos_ibi_commande_location', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_ibi_commande_location/edit/' . $save_pos_ibi_commande_location, 'Edit Pos Ibi Commande Location')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_commande_location');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_commande_location');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Commande Locations
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pos_ibi_commande_location_update');

		$this->data['pos_ibi_commande_location'] = $this->model_pos_ibi_commande_location->find($id);

		$this->template->title('Table Update');
		$this->render('backend/standart/administrator/pos_ibi_commande_location/pos_ibi_commande_location_update', $this->data);
	}

	/**
	* Update Pos Ibi Commande Locations
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_ibi_commande_location_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('DESIGNATION', 'Table', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGNATION' => $this->input->post('DESIGNATION'),
			];

			
			$save_pos_ibi_commande_location = $this->model_pos_ibi_commande_location->change($id, $save_data);

			if ($save_pos_ibi_commande_location) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_ibi_commande_location', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_commande_location');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_commande_location');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Commande Locations
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_ibi_commande_location_delete');

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
            set_message(cclang('has_been_deleted', 'pos_ibi_commande_location'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_ibi_commande_location'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Commande Locations
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_ibi_commande_location_view');

		$this->data['pos_ibi_commande_location'] = $this->model_pos_ibi_commande_location->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Table Detail');
		$this->render('backend/standart/administrator/pos_ibi_commande_location/pos_ibi_commande_location_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Commande Locations
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_ibi_commande_location = $this->model_pos_ibi_commande_location->find($id);

		
		         
		 $delete_save = array(
								'DELETE_STATUS' => 1,
								'DELETE_DATE' => date('Y-m-d H:i:s'),
								'DELETE_USER' => get_user_data('id'),
								'DELETE_COMMENT' => $commentValue
							);

		        $remove = $this->db->update("pos_ibi_commande_location",$delete_save,array("ID_COMMANDE_LOCATION"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_ibi_commande_location_export');

		$this->model_pos_ibi_commande_location->export('pos_ibi_commande_location', 'pos_ibi_commande_location');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_ibi_commande_location_export');

		$this->model_pos_ibi_commande_location->pdf('pos_ibi_commande_location', 'pos_ibi_commande_location');
	}
}


/* End of file pos_ibi_commande_location.php */
/* Location: ./application/controllers/administrator/Pos Ibi Commande Location.php */