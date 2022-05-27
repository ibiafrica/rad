<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Pos Categorie Depense Controller
 *| --------------------------------------------------------------------------
 *| Pos Categorie Depense site
 *|
 */
class pos_categorie_depense extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_categorie_depense');
	}

	/**
	 * show all Pos Categorie Depenses
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('pos_categorie_depense_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_categorie_depenses'] = $this->model_pos_categorie_depense->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_categorie_depense_counts'] = $this->model_pos_categorie_depense->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_categorie_depense/index/',
			'total_rows'   => $this->model_pos_categorie_depense->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Categorie Depense List');
		$this->render('backend/standart/administrator/pos_categorie_depense/pos_categorie_depense_list', $this->data);
	}

	/**
	 * Add new pos_categorie_depenses
	 *
	 */
	public function add()
	{
		$this->is_allowed('pos_categorie_depense_add');

		$this->template->title('Pos Categorie Depense New');
		$this->render('backend/standart/administrator/pos_categorie_depense/pos_categorie_depense_add', $this->data);
	}

	/**
	 * Add New Pos Categorie Depenses
	 *
	 * @return JSON
	 */
	public function add_save()
	{

		// var_dump($_POST);exit();

		if (!$this->is_allowed('pos_categorie_depense_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}
		$URI = $this->input->post('URI');
		$this->form_validation->set_rules('NOM_CATEGORIE_DEPENSE', 'NOM CATEGORIE DEPENSE', 'trim|required');


		if ($this->form_validation->run()) {

			$save_data = [
				'NOM_CATEGORIE_DEPENSE' => $this->input->post('NOM_CATEGORIE_DEPENSE'),
				'DATE_CREATE_CATEGORIE_DEPENSE' => date('Y-m-d h:i:s'),
				'CREATE_BY_CATEGORIE_DEPENSE' => get_user_data('id')
			];


			$save_pos_categorie_depense = $this->model_pos_categorie_depense->store($save_data);

			if ($save_pos_categorie_depense) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_categorie_depense;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_categorie_depense/edit/' . $save_pos_categorie_depense, 'Edit Pos Categorie Depense'),
						anchor('categorieDepense/index', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('categorieDepense/edit/' . $save_pos_categorie_depense, 'Edit Pos Categorie Depense')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('categorieDepense/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('categorieDepense/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * Update view Pos Categorie Depenses
	 *
	 * @var $id String
	 */
	public function edit($id = 0)
	{

		$ider = $this->uri->segment(3);
		$this->is_allowed('pos_categorie_depense_update');

		$this->data['pos_categorie_depense'] = $this->model_pos_categorie_depense->find($ider);

		$this->template->title('Pos Categorie Depense Update');
		$this->render('backend/standart/administrator/pos_categorie_depense/pos_categorie_depense_update', $this->data);
	}

	/**
	 * Update Pos Categorie Depenses
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_categorie_depense_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}
		$URI = $this->input->post('URI');
		$this->form_validation->set_rules('NOM_CATEGORIE_DEPENSE_UP', 'NOM CATEGORIE DEPENSE', 'trim|required');

		if ($this->form_validation->run()) {

			$save_data = [
				'NOM_CATEGORIE_DEPENSE' => $this->input->post('NOM_CATEGORIE_DEPENSE_UP'),
			];


			$save_pos_categorie_depense = $this->model_pos_categorie_depense->change($id, $save_data);

			if ($save_pos_categorie_depense) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_categorie_depense', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('categorieDepense/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('categorieDepense/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete Pos Categorie Depenses
	 *
	 * @var $id String
	 */
	public function delete($id = null)
	{
		$this->is_allowed('pos_categorie_depense_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;

		$delete_save = array('DELETE_DATE_CATEGORIE_DEPENSE' => date("Y-m-d h:i:s"), "DELETE_STATUS_CATEGORIE_DEPENSE" => 1, "COMMENT_DELETE_CATEGORIE_DEPENSE" => $commentValue);
		if (!empty($id)) {
			$remove = $this->_remove($id, $commentValue);
		} elseif (count($arr_id) > 0) {
			foreach ($arr_id as $id) {
				$remove = $this->db->update("pos_categorie_depense", $delete_save, array("ID_CATEGORIE_DEPENSE" => $id));
			}
		}
		if ($remove) {
			set_message(cclang('has_been_deleted', 'pos_categorie_depense'), 'success');
		} else {
			set_message(cclang('error_delete', 'pos_categorie_depense'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Pos Categorie Depenses
	 *
	 * @var $id String
	 */
	public function view($id = 0)
	{
		$ider = $this->uri->segment(3);
		$this->is_allowed('pos_categorie_depense_view');

		$this->data['pos_categorie_depense'] = $this->model_pos_categorie_depense->join_avaiable()->filter_avaiable()->find($ider);

		$this->template->title('Pos Categorie Depense Detail');
		$this->render('backend/standart/administrator/pos_categorie_depense/pos_categorie_depense_view', $this->data);
	}

	/**
	 * delete Pos Categorie Depenses
	 *
	 * @var $id String
	 */
	private function _remove($id, $commentValue)
	{
		$pos_categorie_depense = $this->model_pos_categorie_depense->find($id);



		$delete_save = array(
			'DELETE_STATUS_CATEGORIE_DEPENSE' => 1,
			'DELETE_DATE_CATEGORIE_DEPENSE' => date('Y-m-d H:i:s'),
			'DELETE_BY_CATEGORIE_DEPENSE' => get_user_data('id'),
			'COMMENT_DELETE_CATEGORIE_DEPENSE' => $commentValue
		);

		$remove = $this->db->update("pos_categorie_depense", $delete_save, array("ID_CATEGORIE_DEPENSE" => $id));
		return $remove;
	}





  public function get_categori_depenses(){

  	$ider = $this->input->post('id');
		$get_depenses_cat = $this->db->query('SELECT * FROM pos_categorie_depense WHERE ID_CATEGORIE_DEPENSE =' . $ider . ' ')->row_array();

		echo json_encode($get_depenses_cat);
  }

	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('pos_categorie_depense_export');

		$this->model_pos_categorie_depense->export('pos_categorie_depense', 'pos_categorie_depense');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('pos_categorie_depense_export');

		$this->model_pos_categorie_depense->pdf('pos_categorie_depense', 'pos_categorie_depense');
	}
}


/* End of file pos_categorie_depense.php */
/* Location: ./application/controllers/administrator/Pos Categorie Depense.php */