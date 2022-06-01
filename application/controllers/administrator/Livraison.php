<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Livraison Controller
*| --------------------------------------------------------------------------
*| Livraison site
*|
*/
class Livraison extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_livraison');
		$this->load->model('model_registers');
		$this->load->model('model_rm');
		$this->load->model('model_livraison_detail');
	}

	/**
	* show all Livraisons
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{

		$this->is_allowed('livraison_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['livraisons'] = $this->model_livraison->get($filter, $field, $this->limit_page, $offset);
		$this->data['livraison_counts'] = $this->model_livraison->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/livraison/index/',
			'total_rows'   => $this->model_livraison->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Livraison List');

		// dump($this->data);
		$this->render('backend/standart/administrator/livraison/livraison_list', $this->data);

	}
	
	/**
	* Add new livraisons
	*
	*/
	public function add()
	{
		$this->is_allowed('livraison_add');

		$this->template->title('Livraison New');
		$this->render('backend/standart/administrator/livraison/livraison_add', $this->data);
	}

	public function add_()
	{
		$id_client = $_POST['id_client'];

		$bon_livraison = $this->model_registers->getList('bon_livraison', array('REF_CLIENT_BL'=>$id_client, 'STATUS_BL'=>0));
		$i=0;
		$attente = 'En attente';
		$livrer = 'Livrer';
		foreach($bon_livraison as $bon_l)
		{
			$i++;


			$id_bl = $bon_l['ID_BL'];
			$code_bl = $bon_l['CODE_BL'];
			$ref_client = $bon_l['REF_CLIENT_BL'];
			// $status = $bon_l['STATUS_BL'];
			$date_creation = $bon_l['DATE_CREATION_BL'];

			if($bon_l['STATUS_BL'] == 0){
				$status = 'En attente';
			}else{
				$status = 'Livrer';
			}
			
			$table['tableau'] .= '<table><tr ref_bl="'.$id_bl.'" id="'.$code_bl.'">
			   	<td><input type="checkbox" onclick="CheckUncheckOne(this)" id="checkbox'.$id_bl.'" name="rowSelectCheckBox'.$code_bl.'[]" value="'.$code_bl.'"></td>
			   	<td>'.$code_bl.'</td>
				<td>'.$date_creation.'</div>
			</tr></table>
			';

		// dump($table);

		}

		echo json_encode($table);
	}

	/**
	* Add New Livraisons
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('livraison_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$data = explode(",", $_POST['bl_data']);

		// dump($_POST);
		// return;

		$this->form_validation->set_rules('client', 'CLIENT', 'trim|required|max_length[100]');
		

		if ($this->form_validation->run()) {

			$code_lv = $this->model_livraison->random_code();
		
			$save_data = [
				'CODE_LIV' => $code_lv,
				'CLIENT_LIV' => $this->input->post('client'),
				'DATE_CREATION_LIV' => date('Y-m-d H:m:s'),
				'AUTHOR' => get_user_data('id'),
			];

			
			$save_livraison = $this->model_rm->insert_last_id('livraison', $save_data);
			$status = array('STATUS_BL'=>1);

			for($i=0; $i<count($data); $i++)
			{
				$livraison_detail[] = [
					'REF_ID_L' => $save_livraison,
					'REF_ID_BL' => $data[$i],
				];

				$this->model_rm->update('bon_livraison', array('ID_BL' => $data[$i]), $status);
			}

			$save_details = $this->model_rm->insertArray('livraison_detail', $livraison_detail);


			// dump($save_livraison); die;
			if ($save_livraison) {
				set_message(
					cclang('success_save_data_redirect', [
					anchor('administrator/livraison/edit/' . $save_livraison, 'Edit Livraison')
				]), 'success');

				$this->data['success'] = true;
				$this->data['redirect'] = base_url('administrator/livraison');
			} else {
				$this->data['success'] = false;
				$this->data['message'] = cclang('data_not_change');
				$this->data['redirect'] = base_url('administrator/livraison');
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	public function getDetail($id_l)
	{
		$this->data['livraison'] = $this->model_livraison->join_avaiable()->filter_avaiable()->find($id_l);

		$where = [
			'REF_ID_L' => $id_l,
			'STATUS_DELETE_BLD' => 0
		];

		$this->data['livraison_details'] = $this->model_livraison_detail->get($id_l);

		echo json_encode($this->data);

	}

	
		/**
	* Update view Livraisons
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('livraison_update');

		$this->data['livraison'] = $this->model_livraison->find($id);

		$this->template->title('Livraison Update');
		$this->render('backend/standart/administrator/livraison/livraison_update', $this->data);
	}

	/**
	* Update Livraisons
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('livraison_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('CODE_LIV', 'CODE LIV', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('CLIENT_LIV', 'CLIENT LIV', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('DATE_CREATION_LIV', 'DATE CREATION LIV', 'trim|required');
		$this->form_validation->set_rules('DATE_MOD_LIV', 'DATE MOD LIV', 'trim|required');
		$this->form_validation->set_rules('AUTHOR', 'AUTHOR', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('STATUS_LIV', 'STATUS LIV', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('STATUS_DELETE_LIV', 'STATUS DELETE LIV', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'CODE_LIV' => $this->input->post('CODE_LIV'),
				'CLIENT_LIV' => $this->input->post('CLIENT_LIV'),
				'DATE_CREATION_LIV' => $this->input->post('DATE_CREATION_LIV'),
				'DATE_MOD_LIV' => $this->input->post('DATE_MOD_LIV'),
				'AUTHOR' => $this->input->post('AUTHOR'),
				'STATUS_LIV' => $this->input->post('STATUS_LIV'),
				'STATUS_DELETE_LIV' => $this->input->post('STATUS_DELETE_LIV'),
			];

			
			$save_livraison = $this->model_livraison->change($id, $save_data);

			if ($save_livraison) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/livraison', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/livraison');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/livraison');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Livraisons
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('livraison_delete');

		$this->load->helper('file');

		$remove = $this->_remove($id);

		if ($remove) {
            set_message(cclang('has_been_deleted', 'livraison'), 'success');
        } else {
            set_message(cclang('error_delete', 'livraison'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Livraisons
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('livraison_view');

		$this->data['livraison'] = $this->model_livraison->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Livraison Detail');
		$this->render('backend/standart/administrator/livraison/livraison_view', $this->data);
	}
	
	/**
	* delete Livraisons
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$livraison = $this->model_livraison->find($id);
  
		 $delete_save = array('STATUS_DELETE_LIV' => 1);

		$remove = $this->model_rm->update("livraison",array("ID_LIV"=>$id),$delete_save);

		// $remove = $this->db->update("livraison",$delete_save,array("ID_LIV"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('livraison_export');

		$this->model_livraison->export('livraison', 'livraison');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('livraison_export');

		$this->model_livraison->pdf('livraison', 'livraison');
	}
}


/* End of file livraison.php */
/* Location: ./application/controllers/administrator/Livraison.php */