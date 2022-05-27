<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Articles familles Controller
*| --------------------------------------------------------------------------
*| Pos Articles familles site
*|
*/
class pos_famille extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_pos_famille');
		$this->load->model('Model_rm');
	}

	/**
	* show all Pos Articles familless
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_famille_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_familles'] = $this->Model_pos_famille->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_famille_counts'] = $this->Model_pos_famille->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_famille/index/',
			'total_rows'   => $this->Model_pos_famille->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Articles familles List');
		$this->render('backend/standart/administrator/pos_famille/pos_famille_list', $this->data);
	}
	
	/**
	* Add new pos_familles
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_famille_add');

		$this->template->title('Pos Articles familles New');
		$this->render('backend/standart/administrator/pos_famille/pos_famille_add', $this->data);
	}

	/**
	* Add New Pos Articles familless
	*
	* @return JSON
	*/
	public function add_save($store)
	{
		
		if (!$this->is_allowed('pos_famille_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$table='pos_article_famille';

		// $this->form_validation->set_rules('STORE_ID', 'Store', 'trim|required');
		$this->form_validation->set_rules('NOM_FAMILLE', 'Nom famille', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_FAMILLE' => $this->input->post('NOM_FAMILLE'),
				'DATE_CREATION_FAMILLE' => date('Y-m-d H:i:s'),
				'CREATED_BY_FAMILLE' => get_user_data('id'),
				];

			
			$save_pos_famille = $this->Model_rm->insert_last_id($table,$save_data);

			if ($save_pos_famille) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_famille;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_famille/edit/' . $save_pos_famille, 'Edit Pos Articles familles'),
						anchor('administrator/pos_famille', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_famille/edit/' . $save_pos_famille, 'Edit Pos Articles familles')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('famille/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('famille/'.$store.'/index');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Articles familless
	*
	* @var $id String
	*/
	public function edit()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

		$this->is_allowed('pos_famille_update');

		$this->data['pos_famille'] = $this->Model_pos_famille->find($id);



		$this->template->title('Pos Articles familles Update');
		$this->render('backend/standart/administrator/pos_famille/pos_famille_update', $this->data);
	}

	/**
	* Update Pos Articles familless
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		
		if (!$this->is_allowed('pos_famille_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$table='pos_article_famille';
		// $this->form_validation->set_rules('STORE_ID', 'Store', 'trim|required');
		$this->form_validation->set_rules('NOM_FAMILLE', 'Nom famille', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_FAMILLE' => $this->input->post('NOM_FAMILLE'),
				// 'DESCRIPTION_FAMILLE' => $this->input->post('DESCRIPTION_FAMILLE'),
				'DATE_MOD_FAMILLE' => date('Y-m-d H:i:s'),
				'MODIFIED_BY_FAMILLE' => get_user_data('id'),];

			
			$save_pos_famille = $this->Model_rm->update($table,array("ID_FAMILLE"=>$id),$save_data);

			if ($save_pos_famille) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_famille', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('famille/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('famille/'.$store.'/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Articles familless
	*
	* @var $id String
	*/
	public function delete($store, $id = null)
	{
		$this->is_allowed('pos_famille_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;

		

		if (!empty($id)) {
			$remove = $this->_remove($id,$store);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id,$commentValue);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'pos_famille'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_famille'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Articles familless
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_famille_view');

		$this->data['pos_famille'] = $this->Model_pos_famille->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Pos Articles familles Detail');
		$this->render('backend/standart/administrator/pos_famille/pos_famille_view', $this->data);
	}
	
	/**
	* delete Pos Articles familless
	*
	* @var $id String
	*/
	private function _remove($id ,$store)
	{  
		$table='pos_article_famille';
			         
		 $delete_save = array(
								'DELETE_STATUS_FAMILLE' => 1,
								'DELETED_BY_FAMILLE' => get_user_data('id')
							);

		        $remove = $this->db->update($table,$delete_save,array("ID_FAMILLE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_famille_export');

		$this->Model_pos_famille->export('pos_famille', 'pos_famille');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_famille_export');

		$this->Model_pos_famille->pdf('pos_famille', 'pos_famille');
	}
}


/* End of file pos_famille.php */
/* Location: ./application/controllers/administrator/Pos Articles familles.php */