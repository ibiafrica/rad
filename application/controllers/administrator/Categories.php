<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Hospital Store 1 Ibi Categories Controller
 *| --------------------------------------------------------------------------
 *| Hospital Store 1 Ibi Categories site
 *|
 */
class Categories extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_hospital_store_1_ibi_categories');
	}

	/**
	 * show all Hospital Store 1 Ibi Categoriess
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{

       $offset = $this->uri->segment(4);
       $store = $this->uri->segment(2);

		$this->is_allowed('hospital_ibi_categories_list');
		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}
		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_store_1_ibi_categoriess'] = $this->model_hospital_store_1_ibi_categories->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_store_1_ibi_categories_counts'] = $this->model_hospital_store_1_ibi_categories->count_all($filter, $field);

		$config = [
			'base_url'     => 'categories/'.$store.'/index',
			'total_rows'   => $this->model_hospital_store_1_ibi_categories->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->template->title('Categories List');
		$this->render('backend/standart/administrator/hospital_ibi_categoriess/hospital_ibi_categories_list', $this->data);
	}

	/**
	 * Add new pos_store_1_ibi_categoriess
	 *
	 */
	public function add()
	{

		$store = $this->uri->segment(2);
		$this->is_allowed('hospital_ibi_categories_add');
		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}
		$this->template->title('Categories New');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->render('backend/standart/administrator/hospital_ibi_categories/hospital_ibi_categories_add', $this->data);
	}

	/**
	 * Add New Hospital Store 1 Ibi Categoriess
	 *
	 * @return JSON
	 */
	public function add_save($store)
	{
		  //$store = $this->uri->segment(2);
		if (!$this->is_allowed('hospital_ibi_categories_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('NOM_CATEGORIE', 'NOM CATEGORIE', 'trim|required');


		if ($this->form_validation->run()) {

			$save_data = [
				'NOM_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				'DESCRIPTION_CATEGORIE' => $this->input->post('DESCRIPTION_CATEGORIE'),
				'PARENT_REF_ID_CATEGORIE' => $this->input->post('PARENT_REF_ID_CATEGORIE'),
				'DATE_CREATION_CATEGORIE' => date('Y-m-d H:i:s'),
				'CREATED_BY_CATEGORIE' => get_user_data('id'),
			];


			$save_pos_store_1_ibi_categories = $this->model_pos_store_1_ibi_categories->store($save_data);

			if ($save_pos_store_1_ibi_categories) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_store_1_ibi_categories;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('categories/' . $store . '/edit/' . $save_pos_store_1_ibi_categories, 'Edit Hospital Store 1 Ibi Categories'),
						anchor('categories', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('categories/' . $store . '/edit/' . $save_pos_store_1_ibi_categories, 'Edit Hospital Store 1 Ibi Categories')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('categories/' . $store . '/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('categories/' . $store . '/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * Update view Hospital Store 1 Ibi Categoriess
	 *
	 * @var $id String
	 */
	public function edit()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);
		$this->is_allowed('hospital_ibi_categories_update');
		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}
		$this->data['pos_store_1_ibi_categories'] = $this->model_pos_store_1_ibi_categories->find($id);

		$this->template->title('Categories Update');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->render('backend/standart/administrator/hospital_ibi_categories/hospital_ibi_categories_update', $this->data);
	}

	/**
	 * Update Hospital Store 1 Ibi Categoriess
	 *
	 * @var $id String
	 */
	public function edit_save()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

		if (!$this->is_allowed('hospital_ibi_categories_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('NOM_CATEGORIE', 'NOM CATEGORIE', 'trim|required');

		if ($this->form_validation->run()) {

			$save_data = [
				'NOM_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				'DESCRIPTION_CATEGORIE' => $this->input->post('DESCRIPTION_CATEGORIE'),
				'PARENT_REF_ID_CATEGORIE' => $this->input->post('PARENT_REF_ID_CATEGORIE'),
				'DATE_MOD_CATEGORIE' => date('Y-m-d H:i:s'),
				'MODIFIED_BY_CATEGORIE' => get_user_data('id'),
			];


			$save_pos_store_1_ibi_categories = $this->model_pos_store_1_ibi_categories->change($id, $save_data);

			if ($save_pos_store_1_ibi_categories) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('categories/'.$store .'/index', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('categories/'.$store .'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('categories/'.$store .'/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete Hospital Store 1 Ibi Categoriess
	 *
	 * @var $id String
	 */
	public function delete($store, $id = null)
	{
		$this->is_allowed('hospital_ibi_categories_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;
		$inputValue = $this->input->post('inputValue');

		// if (!empty($id)) {
		// 	$remove = $this->_remove($id);
		// } elseif (count($arr_id) >0) {
		// 	foreach ($arr_id as $id) {
		// 		$remove = $this->_remove($id);
		// 	}
		// }
		$remove = $this->db->query('update pos_store_1_ibi_categories set DELETE_STATUS_CATEGORIE=1,DELETE_COMMENT_CATEGORIE="' . $inputValue . '",DELETE_DATE_CATEGORIE="' . date('Y-m-d H:i:s') . '",DELETE_BY_CATEGORIE=' . get_user_data('id') . '  WHERE ID_CATEGORIE=' . $id);

		if ($remove) {
			set_message(cclang('has_been_deleted', 'categories'), 'success');
		} else {
			set_message(cclang('error_delete', 'categories'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Hospital Store 1 Ibi Categoriess
	 *
	 * @var $id String
	 */
	public function view()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

		$this->is_allowed('hospital_ibi_categories_view');

		$this->data['pos_store_1_ibi_categories'] = $this->model_pos_store_1_ibi_categories->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Categories Detail');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->render('backend/standart/administrator/hospital_ibi_categories/hospital_ibi_categories_view', $this->data);
	}

	/**
	 * delete Hospital Store 1 Ibi Categoriess
	 *
	 * @var $id String
	 */
	private function _remove($id)
	{
		$pos_store_1_ibi_categories = $this->model_pos_store_1_ibi_categories->find($id);



		return $this->model_pos_store_1_ibi_categories->remove($id);
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export($store)
	{
		$this->is_allowed('hospital_ibi_categories_export');

		$this->model_pos_store_1_ibi_categories->export('pos_store_1_ibi_categories', 'pos_store_1_ibi_categories');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf($store)
	{
		$this->is_allowed('hospital_ibi_categories_export');

		$this->model_pos_store_1_ibi_categories->pdf('pos_store_1_ibi_categories', 'pos_store_1_ibi_categories');
	}
}


/* End of file pos_store_1_ibi_categories.php */
/* Location: ./application/controllers/administrator/Hospital Store 1 Ibi Categories.php */