<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Hospital Store 1 Ibi Rayons Controller
*| --------------------------------------------------------------------------
*| Hospital Store 1 Ibi Rayons site
*|
*/
class Rayons extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_hospital_ibi_rayons');
	}
   //model rayon
	/**
	* show all Hospital Store 1 Ibi Rayonss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$offset = $this->uri->segment(4);
		$store =$this->uri->segment(2);
		$this->is_allowed('hospital_ibi_rayons_list');
	if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['rayonss'] = $this->model_hospital_ibi_rayons->get($filter, $field, $this->limit_page, $offset);
		$this->data['rayons_counts'] = $this->model_hospital_ibi_rayons->count_all($filter, $field);

		$config = [
			'base_url'     => 'rayons/'.$store.'/index',
			'total_rows'   => $this->model_hospital_ibi_rayons->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);
$boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;

		$this->template->title('Rayons List');
		$this->render('backend/standart/administrator/hospital_ibi_rayons/hospital_ibi_rayons_list', $this->data);
	}
	
	/**
	* Add new pos_store_1_ibi_rayonss
	*
	*/
	public function add()
	{
		$store =$this->uri->segment(2);
		$this->is_allowed('hospital_ibi_rayons_add');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }
$boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;

		$this->template->title('Rayons New');
		$this->render('backend/standart/administrator/hospital_ibi_rayons/hospital_ibi_rayons_add', $this->data);
	}

	/**
	* Add New Hospital Store 1 Ibi Rayonss
	*
	* @return JSON
	*/
	public function add_save($store)
	{
		//$store =$this->uri->segment(2);
		$table='pos_store_'.$store.'_ibi_rayons';
		if (!$this->is_allowed('hospital_ibi_rayons_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('TITRE_RAYON', 'TITRE RAYON', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'TITRE_RAYON' => $this->input->post('TITRE_RAYON'),
				'DESCRIPTION_RAYON' => $this->input->post('DESCRIPTION_RAYON'),
				'DATE_CREATION_RAYON' => date('Y-m-d H:i:s'),
				'CREATED_BY_RAYON' => get_user_data('id'),			];

			
			$save_rayons = $this->db->insert($table,$save_data);

			if ($save_rayons) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_rayons;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('rayons/'.$store.'/edit/'  . $save_rayons, 'Edit Hospital Store 1 Ibi Rayons'),
						anchor('rayons/'.$store.'/index', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('rayons/edit/'.$store.'/' . $save_rayons, 'Edit Hospital Store 1 Ibi Rayons')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('rayons/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('rayons/'.$store.'/index');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Hospital Store 1 Ibi Rayonss
	*
	* @var $id String
	*/
	public function edit()
	{
		$store =$this->uri->segment(2);
		$id =$this->uri->segment(4);
		$this->is_allowed('hospital_ibi_rayons_update');

		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }


		$this->data['rayons'] = $this->model_hospital_ibi_rayons->find($id);
$boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;

		$this->template->title('Rayons Update');
		$this->render('backend/standart/administrator/hospital_ibi_rayons/hospital_ibi_rayons_update', $this->data);
	}

	/**
	* Update Hospital Store 1 Ibi Rayonss
	*
	* @var $id String
	*/
	public function edit_save()
	{
		$store =$this->uri->segment(2);
		$id =$this->uri->segment(4);
		if (!$this->is_allowed('hospital_ibi_rayons_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('TITRE_RAYON', 'TITRE RAYON', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'TITRE_RAYON' => $this->input->post('TITRE_RAYON'),
				'DESCRIPTION_RAYON' => $this->input->post('DESCRIPTION_RAYON'),
				'DATE_MOD_RAYON' => date('Y-m-d H:i:s'),
				'MODIFIED_BY_RAYON' => get_user_data('id'),			];

			
			$save_rayons = $this->model_hospital_ibi_rayons->change($id, $save_data);

			if ($save_rayons) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('rayons/'.$store.'/index/', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('rayons/'.$store.'/index/');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('rayons/'.$store.'/index/');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Hospital Store 1 Ibi Rayonss
	*
	* @var $id String
	*/
	public function delete($store,$id = null)
	{
		$this->is_allowed('hospital_ibi_rayons_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;
     $inputValue=$this->input->post('inputValue');
		// if (!empty($id)) {
		// 	$remove = $this->_remove($id);
		// } elseif (count($arr_id) >0) {
		// 	foreach ($arr_id as $id) {
		// 		$remove = $this->_remove($id);
		// 	}
		// }
$remove=$this->db->query('update pos_store_'.$store.'_ibi_rayons set DELETE_STATUS_RAYON=1,DELETE_COMMENT_RAYON="'.$inputValue.'",DELETE_DATE_RAYON="'.date('Y-m-d H:i:s').'",DELETE_BY_RAYON='.get_user_data('id').'  WHERE ID_RAYON='.$id);

		if ($remove) {
            set_message(cclang('has_been_deleted', 'rayons'), 'success');
        } else {
            set_message(cclang('error_delete', 'rayons'), 'error');
        }

		redirect_back();
	}
//supprimer rayon
		/**
	* View view Hospital Store 1 Ibi Rayonss
	*
	* @var $id String
	*/
	public function view()
	{
		
		$store =$this->uri->segment(2);
		$id =$this->uri->segment(4);

		$this->is_allowed('hospital_ibi_rayons_view');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }

		$this->data['rayons'] = $this->model_hospital_ibi_rayons->join_avaiable()->filter_avaiable()->find($id);
$boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;

		$this->template->title('Rayons Detail');
		$this->render('backend/standart/administrator/hospital_ibi_rayons/hospital_ibi_rayons_view', $this->data);
	}
	
	/**
	* delete Hospital Store 1 Ibi Rayonss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pos_store_1_ibi_rayons = $this->model_hospital_ibi_rayons->find($id);

		
		
		return $this->model_hospital_ibi_rayons->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export($store)
	{
		$this->is_allowed('hospital_ibi_rayons_export');

		$this->model_hospital_ibi_rayons->export('pos_store_'.$store.'_ibi_rayons', 'pos_store_'.$store.'_ibi_rayons');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf($store)
	{
		$this->is_allowed('hospital_ibi_rayons_export');

		$this->model_hospital_ibi_rayons->pdf('pos_store_'.$store.'_ibi_rayons', 'pos_store_'.$store.'_ibi_rayons');
	}
}


/* End of file pos_store_1_ibi_rayons.php */
/* Location: ./application/controllers/administrator/Hospital Store 1 Ibi Rayons.php */