<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Pos Session Controller
 *| --------------------------------------------------------------------------
 *| Pos Session site
 *|
 */
class pos_session extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_session');
	}

	/**
	 * show all Pos Sessions
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('pos_session_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_sessions'] = $this->model_pos_session->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_session_counts'] = count($this->data['pos_sessions']);


		$config = [
			'base_url'     => 'administrator/pos_session/index/',
			'total_rows'   => $this->data['pos_session_counts'],
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Session List');
		$this->render('backend/standart/administrator/pos_session/pos_session_list', $this->data);
	}

	/**
	 * Add new pos_sessions
	 *
	 */
	public function add()
	{
		$this->is_allowed('pos_session_add');

		$this->template->title('Session New');
		$this->render('backend/standart/administrator/pos_session/pos_session_add', $this->data);
	}

	/**
	 * Add New Pos Sessions
	 *
	 * @return JSON
	 */
	public function add_save()
	{
		if (!$this->is_allowed('pos_session_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('start_date', 'Début de la session', 'trim|required');

		if ($this->form_validation->run()) {

			$save_data = [
				'SESSION_START' => $this->input->post('start_date'),
				'SESSION_END' => '0000-00-00 00:00:00',
				'SESSION_STATUS' => $this->input->post('status'),
				'SESSION_CREATED_BY' => get_user_data('id'),
			];

			//print_r($save_data);exit;

			$this->db->set('SESSION_STATUS', 1);
			$this->db->set('SESSION_END', date('Y-m-d H:i:s'));
			$this->db->where('SESSION_STATUS', 0);
			$this->db->update('pos_session');


			$save_pos_session = $this->model_pos_session->store($save_data);

			if ($save_pos_session) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_session;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_session/edit/' . $save_pos_session, 'Edit Pos Session'),
						anchor('administrator/pos_session', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/pos_session/edit/' . $save_pos_session, 'Edit Pos Session')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_session');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_session');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * Update view Pos Sessions
	 *
	 * @var $id String
	 */
	public function edit($id)
	{
		$this->is_allowed('pos_session_update');

		$this->data['pos_session'] = $this->model_pos_session->find($id);

		$this->template->title('Session Update');
		$this->render('backend/standart/administrator/pos_session/pos_session_update', $this->data);
	}

	/**
	 * Update Pos Sessions
	 *
	 * @var $id String
	 */
	public function edit_save()
	{
		$id = $this->input->post('id');

		$save_data = [
			'SESSION_END' => $this->input->post('end_date'),
			'SESSION_STATUS' => $this->input->post('status'),
		];

		$save_pos_session = $this->model_pos_session->change($id, $save_data);
	}

	/**
	 * delete Pos Sessions
	 *
	 * @var $id String
	 */
	public function delete($id = null)
	{
		$this->is_allowed('pos_session_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id, $commentValue);
		} elseif (count($arr_id) > 0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id, $commentValue);
			}
		}

		if ($remove) {
			set_message(cclang('has_been_deleted', 'pos_session'), 'success');
		} else {
			set_message(cclang('error_delete', 'pos_session'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Pos Sessions
	 *
	 * @var $id String
	 */
	public function view($id)
	{
		$this->is_allowed('pos_session_view');

		$this->data['pos_session'] = $this->model_pos_session->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Session Detail');
		$this->render('backend/standart/administrator/pos_session/pos_session_view', $this->data);
	}

	/**
	 * delete Pos Sessions
	 *
	 * @var $id String
	 */
	private function _remove($id, $commentValue)
	{
		$pos_session = $this->model_pos_session->find($id);



		$delete_save = array(
			'DELETED_STATUS_' => 1,
			'DELETED_DATE_' => date('Y-m-d H:i:s'),
			'DELETED_USER_' => get_user_data('id'),
			'DELETED_COMMENT_' => $commentValue
		);

		$remove = $this->db->update("pos_session", $delete_save, array("ID_SESSION" => $id));
		return $remove;
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('pos_session_export');

		$this->model_pos_session->export('pos_session', 'pos_session');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('pos_session_export');

		$this->model_pos_session->pdf('pos_session', 'pos_session');
	}
}


/* End of file pos_session.php */
/* Location: ./application/controllers/administrator/Pos Session.php */