<?php

defined('BASEPATH') or exit('No direct script access allowed');





/**

 *| --------------------------------------------------------------------------

 *| Pos Ibi Fournisseurs Controller

 *| --------------------------------------------------------------------------

 *| Pos Ibi Fournisseurs site

 *|

 */

class pos_ibi_fournisseurs extends Admin

{



	public function __construct()

	{

		parent::__construct();



		$this->load->model('model_pos_ibi_fournisseurs');

		$this->load->model('model_rm');

	}



	/**

	 * show all Pos Ibi Fournisseurss

	 *

	 * @var $offset String

	 */





	public function getHistory($idF = 0)

	{



		$operation = $this->input->post('action');

		$modep = $this->input->post('modep');

		$total = $this->input->post('total');

		$montantp = $this->input->post('montantp');

		$name = $this->input->post('name');

		$id = $this->input->post('id');

		$ref = $this->input->post('ref');

		$banque = $this->input->post('banque');



		if ($operation == 'payer') {

			// $idD = $this->model_rm->insert_last_id('pos_depenses', array(

			// 	'NOM_DEPENSE' => 'payement fournisseur ' . $name,

			// 	'MONTANT_DEPENSE' => $montantp,

			// 	'DESCRIPTION_DEPENSE' => 'payement fournisseur ' . $name,

			// 	'ID_CATEGORIE_DEPENSE' => 3,

			// 	'CREATE_BY_DEPENSE' => get_user_data('id'),

			// 	'DATE_CREATE_DEPENSE' => date('Y-m-d H:i:s'),



			// ));



			$this->model_rm->insert('pos_ibi_payement_fournisseur', array(

				'MONTANT_PF' => 0,

				'TYPE_PAYEMENT_PF' => $modep,

				'PAYER_PF' => $montantp,

				'RESTE_PF' => -$montantp,

				'REFERENCE_PF' => $ref ? $ref : "",

				// 'BANQUE_PF'=>$banque ? $banque : "",

				'DATE_CREATION_PF' => date('Y-m-d H:i:s'),

				'CREATED_BY_PF' => get_user_data('id'),

				'FOURNISSEUR_ID' => $idF,

				'APPROVISIONNEMENT_REF' => 0

			));

		}



		if ($operation == 'modify') {

			$this->model_rm->update(

				'pos_ibi_payement_fournisseur',

				array('ID_PF' => $id),

				array(

					'TYPE_PAYEMENT_PF' => $modep,

					'PAYER_PF' => $montantp,

					'RESTE_PF' => $total - $montantp,

					'REFERENCE_PF' => $ref ? $ref : "",

					// 'BANQUE_PF'=>$banque ? $banque : "",

				)

			);

		}



		$table = '<table class="table table-bordered table-striped dataTable">

                     <thead>

                        <tr class="">

                           <th>Charges </th>

                           <th>Montant payé </th>

                           <th>Reste </th>

                           <th>payement</th>

                           

                           <th>Reference</th>

                           <th>Auteur</th>

                           <th>Date Creation</th>

                           <th>Action</th>

                        </tr>

                     </thead>

                  ';







		$req = $this->db->query('SELECT * FROM pos_ibi_payement_fournisseur P LEFT JOIN aauth_users A ON A.id=P.CREATED_BY_PF WHERE P.FOURNISSEUR_ID=' . $idF . '')->result_array();



		$reste = 0;

		foreach ($req as $frn) {

			$reste = $reste + $frn['RESTE_PF'];



			$frn['MONTANT_PF'] == 0 ? $tot = '-----' : $tot = $frn['MONTANT_PF'];

			$table .=

				'<tr>

                  	  

                  	  <td>' . $tot . '</td>

                  	  <td>' . $frn['PAYER_PF'] . '</td>

                  	  <td>' . $reste . '</td>

                  	  <td>' . $frn['TYPE_PAYEMENT_PF'] . '</td>

                  	 

                  	  <td>' . $frn['REFERENCE_PF'] . '</td>

                  	  <td>' . $frn['username'] . '</td>

                  	  <td>' . $frn['DATE_CREATION_PF'] . '</td>

                  	  <td><button

                  	   ref="' . $frn['REFERENCE_PF'] . '"

                  	   total="' . $frn['MONTANT_PF'] . '"

                  	   id="' . $frn['ID_PF'] . '"

                  	   montant="' . $frn['PAYER_PF'] . '"

                  	   payement="' . $frn['TYPE_PAYEMENT_PF'] . '"

                  	   class="btn btn-xs btn-success modify" title="modifier"> <i class="fa fa-edit"></i></button> </td>

                  	</tr>';

		}



		$table .= '</table>';

		echo $table;

	}



	public function index($offset = 0)

	{

		$this->is_allowed('pos_ibi_fournisseurs_list');



		$filter = $this->input->get('q');

		$field     = $this->input->get('f');

		$type = $this->input->get('TYPE_FOURNISSEUR');



		$this->data['myFournisseurs'] = $this->model_pos_ibi_fournisseurs->get($type, $filter, $field, $this->limit_page, $offset);



		$this->data['pos_ibi_fournisseurs_counts'] = $this->model_pos_ibi_fournisseurs->count_all($type, $filter, $field);





		// $this->data['myFournisseurs'] = $this->db->query("SELECT * FROM pos_ibi_fournisseurs

		// INNER JOIN aauth_users ON aauth_users.id = pos_ibi_fournisseurs.CREATED_BY_FOURNISSEUR  WHERE DELETE_STATUS_FOURNISSEUR = 0

		// ORDER BY ID_FOURNISSEUR DESC")->result();



		// echo "<pre>";

		// print_r($this->data['myFournisseurs']);exit;



		$config = [

			'base_url'     => 'administrator/pos_ibi_fournisseurs/index/',

			'total_rows'   => $this->model_pos_ibi_fournisseurs->count_all($type, $filter, $field),

			'per_page'     => $this->limit_page,

			'uri_segment'  => 4,

		];



		$this->data['pagination'] = $this->pagination($config);



		$this->template->title('Pos Ibi Fournisseurs List');

		$this->render('backend/standart/administrator/pos_ibi_fournisseurs/pos_ibi_fournisseurs_list', $this->data);

	}



	public function getStat($idF)

	{



		$data = $this->model_rm->getRequete('

			SELECT 

			  ART.DESIGN_ARTICLE, 

			  A.CODE_ARRIVAGE, 

			  A.TITRE_ARRIVAGE, 

			  AD.CODE_BAR, 

			  SUM(AD.QUANTITE_ARRIVAGE_DETAIL) AS QTE, 

			  SUM(AD.PRIX_UNITAIRE*AD.QUANTITE_ARRIVAGE_DETAIL) AS TOTAL,

			  AD.QUANTITE_ARRIVAGE_DETAIL, AD.PRIX_UNITAIRE 

			FROM pos_store_detail_arrivage AD

			JOIN pos_store_1_ibi_arrivages A ON A.ID_ARRIVAGE=AD.ID_APPOVISIONNEMENT

			LEFT JOIN pos_store_1_ibi_articles ART ON ART.CODEBAR_ARTICLE=AD.CODE_BAR

			WHERE AD.ID_FOURNISSEUR=' . $idF . '

			GROUP BY AD.CODE_BAR

			ORDER BY QTE DESC

			LIMIT 10');



		$result = [];



		foreach ($data as $key) {

			$obj = (object)[];

			$obj->name = $key['DESIGN_ARTICLE'];

			$obj->y = (int)$key['QTE'];

			$obj->x = (int)$key['TOTAL'];



			$result[] = $obj;

		}



		echo json_encode($result);

	}



	/**

	 * Add new pos_ibi_fournisseurss

	 *

	 */

	public function add()

	{

		$this->is_allowed('pos_ibi_fournisseurs_add');



		$this->template->title('Pos Ibi Fournisseurs New');

		$this->render('backend/standart/administrator/pos_ibi_fournisseurs/pos_ibi_fournisseurs_add', $this->data);

	}



	/**

	 * Add New Pos Ibi Fournisseurss

	 *

	 * @return JSON

	 */

	public function add_save()

	{

		if (!$this->is_allowed('pos_ibi_fournisseurs_add', false)) {

			echo json_encode([

				'success' => false,

				'message' => cclang('sorry_you_do_not_have_permission_to_access')

			]);

			exit;

		}

		$tva = 0;

		$tva_fournisseur = $this->input->post('tva_fournisseur');

		if (empty($tva_fournisseur)) {

			$tva = 0;

		} else {

			$tva = $tva_fournisseur;

		}





		$this->form_validation->set_rules('NOM_FOURNISSEUR', 'NOM FOURNISSEUR', 'trim|required');

		$this->form_validation->set_rules('BP_FOURNISSEUR', 'BP FOURNISSEUR', 'trim|required');

		$this->form_validation->set_rules('TEL_FOURNISSEUR', 'TEL FOURNISSEUR', 'trim|required');





		if ($this->form_validation->run()) {



			$save_data = [

				'NOM_FOURNISSEUR' => $this->input->post('NOM_FOURNISSEUR'),

				'BP_FOURNISSEUR' => $this->input->post('BP_FOURNISSEUR'),

				'TEL_FOURNISSEUR' => $this->input->post('TEL_FOURNISSEUR'),

				'TVA_FOURNISSEUR' => $tva,

				'EMAIL_FOURNISSEUR' => $this->input->post('EMAIL_FOURNISSEUR'),

				'CREATED_BY_FOURNISSEUR' => get_user_data('id')



			];





			$save_pos_ibi_fournisseurs = $this->model_pos_ibi_fournisseurs->store($save_data);



			if ($save_pos_ibi_fournisseurs) {

				if ($this->input->post('save_type') == 'stay') {

					$this->data['success'] = true;

					$this->data['id']        = $save_pos_ibi_fournisseurs;

					$this->data['message'] = cclang('success_save_data_stay', [

						anchor('administrator/pos_ibi_fournisseurs/edit/' . $save_pos_ibi_fournisseurs, 'Edit Fournisseurs'),

						anchor('administrator/pos_ibi_fournisseurs', ' Go back to list')

					]);

				} else {

					set_message(

						cclang('success_save_data_redirect', [

							anchor('administrator/pos_ibi_fournisseurs/edit/' . $save_pos_ibi_fournisseurs, 'Edit Pos Ibi Fournisseurs')

						]),

						'success'

					);



					$this->data['success'] = true;

					$this->data['redirect'] = base_url('administrator/pos_ibi_fournisseurs');

				}

			} else {

				if ($this->input->post('save_type') == 'stay') {

					$this->data['success'] = false;

					$this->data['message'] = cclang('data_not_change');

				} else {

					$this->data['success'] = false;

					$this->data['message'] = cclang('data_not_change');

					$this->data['redirect'] = base_url('administrator/pos_ibi_fournisseurs');

				}

			}

		} else {

			$this->data['success'] = false;

			$this->data['message'] = validation_errors();

		}



		echo json_encode($this->data);

	}



	/**

	 * Update view Pos Ibi Fournisseurss

	 *

	 * @var $id String

	 */

	public function edit($id)

	{

		$this->is_allowed('pos_ibi_fournisseurs_update');



		$this->data['pos_ibi_fournisseurs'] = $this->model_pos_ibi_fournisseurs->find($id);



		$this->template->title('Pos Ibi Fournisseurs Update');

		$this->render('backend/standart/administrator/pos_ibi_fournisseurs/pos_ibi_fournisseurs_update', $this->data);

	}



	/**

	 * Update Pos Ibi Fournisseurss

	 *

	 * @var $id String

	 */

	public function edit_save($id)

	{

		if (!$this->is_allowed('pos_ibi_fournisseurs_update', false)) {

			echo json_encode([

				'success' => false,

				'message' => cclang('sorry_you_do_not_have_permission_to_access')

			]);

			exit;

		}



		$tva = 0;

		$tva_fournisseur = $this->input->post('tva_fournisseur_up');

		if (empty($tva_fournisseur)) {

			$tva = 0;

		} else {

			$tva = $tva_fournisseur;

		}



		$this->form_validation->set_rules('NOM_FOURNISSEUR_UP', 'NOM FOURNISSEUR', 'trim|required');

		$this->form_validation->set_rules('BP_FOURNISSEUR_UP', 'BP FOURNISSEUR', 'trim|required');

		$this->form_validation->set_rules('TEL_FOURNISSEUR_UP', 'TEL FOURNISSEUR', 'trim|required');



		if ($this->form_validation->run()) {



			$save_data = [

				'NOM_FOURNISSEUR' => $this->input->post('NOM_FOURNISSEUR_UP'),

				'BP_FOURNISSEUR' => $this->input->post('BP_FOURNISSEUR_UP'),

				'TEL_FOURNISSEUR' => $this->input->post('TEL_FOURNISSEUR_UP'),

				'TVA_FOURNISSEUR' => $tva,

				'EMAIL_FOURNISSEUR' => $this->input->post('EMAIL_FOURNISSEUR_UP'),

			];





			$save_pos_ibi_fournisseurs = $this->model_pos_ibi_fournisseurs->change($id, $save_data);



			if ($save_pos_ibi_fournisseurs) {

				if ($this->input->post('save_type') == 'stay') {

					$this->data['success'] = true;

					$this->data['id']        = $id;

					$this->data['message'] = cclang('success_update_data_stay', [

						anchor('administrator/pos_ibi_fournisseurs', ' Go back to list')

					]);

				} else {

					set_message(

						cclang('success_update_data_redirect', []),

						'success'

					);



					$this->data['success'] = true;

					$this->data['redirect'] = base_url('administrator/pos_ibi_fournisseurs');

				}

			} else {

				if ($this->input->post('save_type') == 'stay') {

					$this->data['success'] = false;

					$this->data['message'] = cclang('data_not_change');

				} else {

					$this->data['success'] = false;

					$this->data['message'] = cclang('data_not_change');

					$this->data['redirect'] = base_url('administrator/pos_ibi_fournisseurs');

				}

			}

		} else {

			$this->data['success'] = false;

			$this->data['message'] = validation_errors();

		}



		echo json_encode($this->data);

	}



	/**

	 * delete Pos Ibi Fournisseurss

	 *

	 * @var $id String

	 */



	public function get_fournisseur()

	{



		$id = $this->input->post('id');

		$get_fournisseur = $this->db->query("SELECT * FROM pos_ibi_fournisseurs WHERE ID_FOURNISSEUR ='" . $id . "' ")->row_array();



		// var_dump($get_fournisseur);exit();





		echo json_encode($get_fournisseur);

	}

	public function delete($id = null)

	{

		$this->is_allowed('pos_ibi_fournisseurs_delete');



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

			set_message(cclang('has_been_deleted', 'pos_ibi_fournisseurs'), 'success');

		} else {

			set_message(cclang('error_delete', 'pos_ibi_fournisseurs'), 'error');

		}



		redirect_back();

	}



	/**

	 * View view Pos Ibi Fournisseurss

	 *

	 * @var $id String

	 */

	public function view($id)

	{

		$this->is_allowed('pos_ibi_fournisseurs_view');



		$this->data['fournisseur'] = $this->model_pos_ibi_fournisseurs->find($id);



		$this->template->title('Pos Ibi Fournisseurs Detail');

		$this->render('backend/standart/administrator/pos_ibi_fournisseurs/pos_ibi_fournisseurs_view', $this->data);

	}



	/**

	 * delete Pos Ibi Fournisseurss

	 *

	 * @var $id String

	 */

	private function _remove($id, $commentValue)

	{

		$pos_ibi_fournisseurs = $this->model_pos_ibi_fournisseurs->find($id);







		$delete_save = array(

			'DELETE_STATUS_FOURNISSEUR' => 1,

			'DELETE_DATE_FOURNISSEUR' => date('Y-m-d H:i:s'),

			'DELETE_BY_FOURNISSEUR' => get_user_data('id'),

			'DELETE_COMMENT_FOURNISSEUR' => $commentValue

		);



		$remove = $this->db->update("pos_ibi_fournisseurs", $delete_save, array("ID_FOURNISSEUR" => $id));

		return $remove;

	}





	/**

	 * Export to excel

	 *

	 * @return Files Excel .xls

	 */

	public function export()

	{

		$this->is_allowed('pos_ibi_fournisseurs_export');



		$this->model_pos_ibi_fournisseurs->export('pos_ibi_fournisseurs', 'pos_ibi_fournisseurs');

	}



	/**

	 * Export to PDF

	 *

	 * @return Files PDF .pdf

	 */

	public function export_pdf()

	{

		$this->is_allowed('pos_ibi_fournisseurs_export');



		$this->model_pos_ibi_fournisseurs->pdf('pos_ibi_fournisseurs', 'pos_ibi_fournisseurs');

	}







	public function rapports($id_fournisseur)

	{



		$this->is_allowed('pos_clients_update');

		$date_from = "2021-03-05 00:00:00";

		$date_end = "2021-03-07 23:59:59";

		// $$this->render('backend/standart/administrator/pos_clients/pos_clients_history', $this->data);

		$date_f = $this->input->get('date_from');

		$date_e = $this->input->get('date_end');

		$combined_raw = [];



		// ! must add date peremption to all the stores for this to work

		if (isset($date_from) && isset($date_end)) {

			$date_from = $date_f . " 00:00:00";

			$date_end = $date_e . " 23:59:59";

		}

		if (empty($date_f) and empty($data_e)) {

			$date_from = date("Y") . "-03-01 00:00:00";

			$date_end = date("Y-m-d") . " 23:59:59";

		}



		$cl = $this->db->select("*")

			->from("pos_ibi_fournisseurs")

			->where("ID_FOURNISSEUR", $id_fournisseur)

			->get()->result()[0];



		$flow_and_articles = $this->db->query("SELECT

    REF_ARTICLE_BARCODE_SF,

    QUANTITE_SF,

    REF_COMMAND_CODE_SF,

    UNIT_PRICE_SF,

    u.full_name AS NOM_RESPONSABLE,

    DATE_CREATION_SF, ar.TITRE_ARRIVAGE as TITRE,

    c.ID_ARRIVAGE AS ARRIVAGE_ID,

    DESIGN_ARTICLE

FROM

    pos_store_1_ibi_articles_stock_flow AS c

JOIN pos_store_1_ibi_arrivages AS cp

ON

    c.ID_ARRIVAGE = cp.ID_ARRIVAGE AND cp.DELETE_STATUS_ARRIVAGE = 0

JOIN pos_store_1_ibi_articles a ON

    a.CODEBAR_ARTICLE = c.REF_ARTICLE_BARCODE_SF

JOIN pos_store_1_ibi_arrivages ar ON

	ar.ID_ARRIVAGE = c.ID_ARRIVAGE

JOIN aauth_users u ON

    u.id = c.CREATED_BY_SF

    WHERE

    c.REF_PROVIDER_SF = $id_fournisseur and c.TYPE_SF = 'stock_in' AND ar.DELETE_STATUS_ARRIVAGE = 0 AND c.DATE_CREATION_SF BETWEEN '$date_from' AND '$date_end'

ORDER BY

    c.DATE_CREATION_SF

DESC")

			->result();



		$fournisseur_data = [];

		$tots = 0;

		if (sizeof($flow_and_articles) > 0) {



			for ($c = 0; $c < sizeof($flow_and_articles); $c++) {

				$current_cmd = $flow_and_articles[$c];

				$date_refined = explode(" ", $current_cmd->DATE_CREATION_SF)[0];

				if (!isset($fournisseur_data[$date_refined])) {

					$fournisseur_data[$date_refined] = [];

					$fournisseur_data[$date_refined]['TOTAL'] = 0;

					$fournisseur_data[$date_refined]['CMDS'] = [];

				}



				if (!isset($fournisseur_data[$date_refined]['CMDS'][$current_cmd->ARRIVAGE_ID])) {

					$fournisseur_data[$date_refined]['CMDS'][$current_cmd->ARRIVAGE_ID] = [];

					// array_push($fournisseur_data[$date_refined], $current_cmd);

				}

				$tots += intval($current_cmd->QUANTITE_SF) * intval($current_cmd->UNIT_PRICE_SF);

				$fournisseur_data[$date_refined]['TOTAL'] += intval($current_cmd->QUANTITE_SF) * intval($current_cmd->UNIT_PRICE_SF);

				array_push($fournisseur_data[$date_refined]['CMDS'][$current_cmd->ARRIVAGE_ID], $current_cmd);

			}

		}



		$real_data = array_values($fournisseur_data);

		for ($r = 0; $r < sizeof($real_data); $r++) {

			$real_data[$r]['CMDS'] = array_values($real_data[$r]['CMDS']);

		}

		$this->data['date_from'] = $date_from;

		$this->data['date_end'] = $date_end;

		$this->data['fournisseur'] = $cl;

		$this->data['details'] = $real_data;

		$this->data['TOTALY'] = $tots;

		// echo json_encode($this->data);

		// die;

		$this->template->title('Pos Ibi Fournisseurs Historiques');

		$this->render('backend/standart/administrator/pos_ibi_fournisseurs/pos_ibi_fournisseurs_rapports', $this->data);

	}

}





/* End of file pos_ibi_fournisseurs.php */

/* Location: ./application/controllers/administrator/Pos Ibi Fournisseurs.php */