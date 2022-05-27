<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Pos Flux Caisse Controller
 *| --------------------------------------------------------------------------
 *| Pos Flux Caisse site
 *|
 */
class pos_flux_caisse extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_flux_caisse');
	}

	/**
	 * show all Pos Flux Caisses
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('pos_flux_caisse_list');

		$date_start = $this->input->get('date_start');
		$date_end = $this->input->get('date_end');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_flux_caisses'] = $this->model_pos_flux_caisse->get($date_start, $date_end, $filter, $field, $this->limit_page, $offset);
		$this->data['pos_flux_caisse_counts'] = $this->model_pos_flux_caisse->count_all($date_start, $date_end, $filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_flux_caisse/index/',
			'total_rows'   => $this->model_pos_flux_caisse->count_all($date_start, $date_end, $filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Flux Caisse List');
		$this->render('backend/standart/administrator/pos_flux_caisse/pos_flux_caisse_list', $this->data);
	}

	/**
	 * Add new pos_flux_caisses
	 *
	 */
	public function add()
	{
		$this->is_allowed('pos_flux_caisse_add');

		$this->template->title('Flux Caisse New');
		$this->render('backend/standart/administrator/pos_flux_caisse/pos_flux_caisse_add', $this->data);
	}

	/**
	 * Add New Pos Flux Caisses
	 *
	 * @return JSON
	 */
	public function add_save()
	{
		if (!$this->is_allowed('pos_flux_caisse_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		//this->form_validation->set_rules('NOM_FLUX_CAISSE', 'Nom Flux Caisse', 'trim|required');
		$this->form_validation->set_rules('MONTANT_FLUX_CAISSE', 'Montant', 'trim|required');
		$this->form_validation->set_rules('TYPE_ACTIVITE', 'Type Flux', 'trim|required');
		$this->form_validation->set_rules('CATEGORIE_FLUX', 'Categorie Flux', 'trim|required');

		$GET_SESSION = $this->db->query("SELECT * FROM pos_session WHERE SESSION_STATUS = 0 ")->row_array();


		if ($this->form_validation->run()) {

			$save_data = [
				//'NOM_FLUX_CAISSE' => $this->input->post('DESCRIPTION_FLUX'),
				'MONTANT_FLUX_CAISSE' => $this->input->post('MONTANT_FLUX_CAISSE'),
				'TYPE_FLUX_CAISSE' => $this->input->post('TYPE_ACTIVITE'),
				'CATEGORIE_FLUX' => $this->input->post('CATEGORIE_FLUX'),
				'DESCRIPTION_FLUX' => $this->input->post('DESCRIPTION_FLUX'),
				'FLUX_SESSION_ID' => $GET_SESSION['ID_SESSION'],
				'USER_CREATE_FLUX' => get_user_data('id'),
				'DATE_CREATION_FLUX' => date('Y-m-d H:i:s'),
			];

			//echo '<pre>';print_r($save_data);exit();


			$save_pos_flux_caisse = $this->model_pos_flux_caisse->store($save_data);

			if ($save_pos_flux_caisse) {

				set_message('success');

				$this->data['success'] = true;
				$this->data['redirect'] = base_url('administrator/pos_flux_caisse');
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_flux_caisse');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}



	public function rapport_session_caisse($id)
	{

		$this->data['date'] = $this->db->query('SELECT * FROM pos_session WHERE ID_SESSION=' . $id)->row();


		$result = $this->db->query("
        SELECT * FROM pos_flux_caisse S
        LEFT JOIN pos_activite_flux_caisse ITM ON ITM.ID_ACTIVITE = S.TYPE_FLUX_CAISSE
        LEFT JOIN  pos_categorie_flux_caisse ST ON ST.ID_CATEGORIE=S.CATEGORIE_FLUX
        WHERE S.FLUX_DELETE_STATUS=0  AND S.FLUX_SESSION_ID =" . $id)->result_array();

		$result_paiement = $this->db->query("
        SELECT * FROM pos_paiements P
       WHERE P.DELETED_STATUS_PAIEMENT=0  AND P.ID_SESSION =" . $id)->result_array();

		$obj = [];
		$obj_sortie = [];
		$tab_date = [];
		foreach ($result as $key) {
			$entre_sortie = [
				'type_name' => $key['DESIGN_ACTIVITE'],
				"categorie" => $key['NOM_CATEGORIE'],
				"descript" => $key['DESCRIPTION_FLUX'],
				"montant" => $key['MONTANT_FLUX_CAISSE'],
				"created_at" => $key['DATE_CREATION_FLUX'],
			];

			// if($key['ID_ACTIVITE']==3){
			// 	array_push($obj_sortie,$entre_sortie);
			// }else{
			array_push($obj, $entre_sortie);
			array_push($tab_date, $entre_sortie['created_at']);
			// }


			//dump($obj);

		};

		foreach ($result_paiement as $value) {

			$paiement = [
				'type_name' => 'paiement',
				"categorie" => 'Paiements',
				"descript" => 'Paiement',
				"montant" => $value['MONTANT_PAIEMENT'],
				"created_at" => $value['DATE_CREATION_PAIEMENT'],

			];

			array_push($obj, $paiement);
			array_push($tab_date, $paiement['created_at']);

			//dump($obj);
		} //die;

		array_multisort($tab_date, SORT_DESC, $obj);

		//dump($obj);die;


		$this->data['res'] = $obj;

		//echo '<pre>'; print_r($this->data['res']);exit;


		/*$type_name = $key['ID_ACTIVITE'] > 0 ?  $key['DESIGN_ACTIVITE'] : "Entrées";

      if (!isset($obj[$type_name][$key['ID_FLUX_CAISSE']])) {

        $obj[$type_name][$key['ID_FLUX_CAISSE']] = array(

          "nom" => $key['DESCRIPTION_FLUX'],
          "qt" => $key['NOM_CATEGORIE'],
          "montant" => $key['MONTANT_FLUX_CAISSE'],
        );
      } else {
        $obj[$type_name][$key['ID_FLUX_CAISSE']]['qt']++;
      }*/


		//$this->data['type_de_facture'] = $this->model_r_proforma->sans_where('type_facture');
		$this->template->title('Rapports des sorties');
		$this->render('backend/standart/administrator/pos_session/pos_session_view', $this->data);
	}


	/**
	 * Update view Pos Flux Caisses
	 *
	 * @var $id String
	 */
	public function edit($id)
	{
		$this->is_allowed('pos_flux_caisse_update');

		$this->data['pos_flux_caisse'] = $this->model_pos_flux_caisse->find($id);

		$this->template->title('Flux Caisse Update');
		$this->render('backend/standart/administrator/pos_flux_caisse/pos_flux_caisse_update', $this->data);
	}

	/**
	 * Update Pos Flux Caisses
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_flux_caisse_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		//$this->form_validation->set_rules('NOM_FLUX_CAISSE', 'Nom Flux Caisse', 'trim|required');
		$this->form_validation->set_rules('MONTANT_FLUX_CAISSE_UP', 'Montant', 'trim|required');
		$this->form_validation->set_rules('TYPE_ACTIVITE_UP', 'Type Flux', 'trim|required');
		$this->form_validation->set_rules('CATEGORIE_FLUX_UP', 'Categorie Flux', 'trim|required');

		if ($this->form_validation->run()) {

			$save_data = [
				//'NOM_FLUX_CAISSE' => $this->input->post('NOM_FLUX_CAISSE'),
				'MONTANT_FLUX_CAISSE' => $this->input->post('MONTANT_FLUX_CAISSE_UP'),
				'TYPE_FLUX_CAISSE' => $this->input->post('TYPE_ACTIVITE_UP'),
				'CATEGORIE_FLUX' => $this->input->post('CATEGORIE_FLUX_UP'),
				'DESCRIPTION_FLUX' => $this->input->post('DESCRIPTION_FLUX_UP'),
			];


			$save_pos_flux_caisse = $this->model_pos_flux_caisse->change($id, $save_data);

			if ($save_pos_flux_caisse) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_flux_caisse', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_flux_caisse');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_flux_caisse');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}


	public function get_flux_caisse()
	{
		$ider = $this->input->post('id');
		$get_flux_caisse = $this->db->query('SELECT * FROM pos_flux_caisse WHERE ID_FLUX_CAISSE =' . $ider . ' ')->row_array();

		// var_dump($get_depenses);exit();

		echo json_encode($get_flux_caisse);
	}

	/**
	 * delete Pos Flux Caisses
	 *
	 * @var $id String
	 */
	public function delete($id = null)
	{
		$this->is_allowed('pos_flux_caisse_delete');

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
			set_message(cclang('has_been_deleted', 'pos_flux_caisse'), 'success');
		} else {
			set_message(cclang('error_delete', 'pos_flux_caisse'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Pos Flux Caisses
	 *
	 * @var $id String
	 */
	public function view($id)
	{
		$this->is_allowed('pos_flux_caisse_view');

		$this->data['pos_flux_caisse'] = $this->model_pos_flux_caisse->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Flux Caisse Detail');
		$this->render('backend/standart/administrator/pos_flux_caisse/pos_flux_caisse_view', $this->data);
	}

	/**
	 * delete Pos Flux Caisses
	 *
	 * @var $id String
	 */
	private function _remove($id, $commentValue)
	{
		$pos_flux_caisse = $this->model_pos_flux_caisse->find($id);



		$delete_save = array(
			'FLUX_DELETE_STATUS' => 1,
			'FLUX_DATE_DELETE' => date('Y-m-d H:i:s'),
			'FLUX_DELETE_BY' => get_user_data('id'),
			'DELETED_COMMENT' => $commentValue
		);

		$remove = $this->db->update("pos_flux_caisse", $delete_save, array("ID_FLUX_CAISSE" => $id));
		return $remove;
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('pos_flux_caisse_export');

		$this->model_pos_flux_caisse->export('pos_flux_caisse', 'pos_flux_caisse');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('pos_flux_caisse_export');

		$this->model_pos_flux_caisse->pdf('pos_flux_caisse', 'pos_flux_caisse');
	}
}


/* End of file pos_flux_caisse.php */
/* Location: ./application/controllers/administrator/Pos Flux Caisse.php */