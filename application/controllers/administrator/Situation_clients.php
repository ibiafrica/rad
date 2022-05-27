<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Pos Clients Controller
 *| --------------------------------------------------------------------------
 *| Pos Clients site
 *|
 */
class Situation_clients extends Admin
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
	}

	/**
	 * show all Pos Clientss
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->db->query('SET SQL_BIG_SELECTS=1');

		$this->is_allowed('pos_clients_list');

		$du = $this->input->get('du');
		$au = $this->input->get('au');
		$type = $this->input->get('type');
		$req = '';

		// $date_from = "2021-03-05 00:00:00";
		// $date_end = "2021-03-07 23:59:59";

		$client_situation_raw = $this->db->query("SELECT
			PRIX,
			QUANTITE,
			NOM_CLIENT,
			PRENOM,
			ID_CLIENT,
			cp.DISCOUNT_PERCENT,
			 cp.ID_pos_IBI_COMMANDES_PRODUITS,
			MONTANT_PAIEMENT,
			TYPE_FACTURE,
			DESIGNATION_PAIEMENT_MODE,
			 ID_PAIEMENT,
			u.full_name AS RECU_PAR,
			DATE_CREATION_PAIEMENT
		FROM
			pos_ibi_commandes c
		JOIN pos_ibi_commandes_produits cp ON
			cp.pos_IBI_COMMANDES_ID = c.ID_pos_IBI_COMMANDES
		LEFT JOIN pos_clients cl ON
			cl.ID_CLIENT = c.CLIENT_ID_COMMANDE
		LEFT JOIN pos_paiements rp ON
			rp.CLIENT_ID_PAIEMENT = c.CLIENT_ID_COMMANDE
		LEFT JOIN aauth_users u ON
			u.id = rp.CREATED_BY_PAIEMENT
		LEFT JOIN mode_paiement mp ON
			mp.ID_MODE_PAIEMENT = rp.MODE_PAIEMENT
		WHERE
			c.DELETED_STATUS_pos_IBI_COMMANDES = 0 and c.COMMANDE_STATUS != 1
			
		ORDER BY rp.DATE_CREATION_PAIEMENT DESC
		")->result();

		// echo "<pre>"; print_r($client_situation_raw);
		// die;


		$client_situation_refined = [];
		$du_array = [];


		for ($b = 0; $b < sizeof($client_situation_raw); $b++) {
			$current = $client_situation_raw[$b];
			if (!isset($client_situation_refined[$current->ID_CLIENT])) {
				$du_array[$current->ID_CLIENT] = [];

				$client_situation_refined[$current->ID_CLIENT] = array(
					"ID" => $current->ID_CLIENT,
					"PAYMENTS" => [],
					"NOM_CLIENT" => $current->NOM_CLIENT . " " . $current->PRENOM,
					"MONTANT_DU" => 0, "MONTANT_PAID" => 0,
					"HISTORY" => []
				);
			}

			if (!in_array($current->ID_PAIEMENT, $client_situation_refined[$current->ID_CLIENT]["PAYMENTS"])) {
				array_push($client_situation_refined[$current->ID_CLIENT]["PAYMENTS"], $current->ID_PAIEMENT);

				if (!empty($current->MONTANT_PAIEMENT)) {
					array_push(
						$client_situation_refined[$current->ID_CLIENT]['HISTORY'],
						array(
							"DATE" => $current->DATE_CREATION_PAIEMENT,
							"METHODE" => $current->DESIGNATION_PAIEMENT_MODE,
							"AMOUNT" => $current->MONTANT_PAIEMENT, "RECU_PAR" => $current->RECU_PAR
						)
					);
					$client_situation_refined[$current->ID_CLIENT]['MONTANT_PAID'] += $current->MONTANT_PAIEMENT;
				}
			}

			if (!isset($du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS])) {
				$du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS] = [];
				$du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS]['TOTAL'] = [];
				array_push(
					$du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS]['TOTAL'],
					((intval($current->PRIX) * intval($current->QUANTITE)) - ((intval($current->PRIX) * intval($current->QUANTITE)) * intval($current->DISCOUNT_PERCENT) / 100))
				);
				$client_situation_refined[$current->ID_CLIENT]['MONTANT_DU'] += array_sum($du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS]['TOTAL']);
			}
		}
		// echo json_encode(array_values($client_situation_refined));
		// die;
		$this->data['situations'] = array_values($client_situation_refined);

		$this->template->title('Pos situation clients');
		$this->render('backend/standart/administrator/situation_clients/situation_clients', $this->data);
	}


	public function paiements_total()
	{
		$this->db->query('SET SQL_BIG_SELECTS=1');
		$id_client = $this->input->post("id_client");
		$montant_enter = $this->input->post('montant_enter');

		$message = "bs";
		$select_command = $this->db->query("SELECT * FROM pos_paiements WHERE CLIENT_ID_PAIEMENT = '" . $id_client . "' AND DELETED_STATUS_PAIEMENT = 0 ORDER BY MONTANT_PAIEMENT ")->result_array();

		$montant_j = 0;
		$this->data['message'] = "";
		$rest = 0;

		foreach ($select_command as  $value) {
			if ($montant_enter == 0) {
				if ($up) {
					$this->data['message'] = "success";
				}
				// die();
			} elseif ($montant_enter >= $value['MONTANT_PAIEMENT']) {
				$montant_enter =  $montant_enter - $value['MONTANT_PAIEMENT'];
				$datas = array('MONTANT_PAIEMENT' => 0);
				$condition = array('CLIENT_ID_PAIEMENT' => $id_client, 'ID_PAIEMENT' => $value['ID_PAIEMENT']);
				$cond_cmd = array('ID_pos_IBI_COMMANDES' => $value['COMMANDE_ID'], 'COMMANDE_STATUS' => 0);
				$data_cmd  = array('COMMANDE_STATUS' => 2);

				$up = $this->model_rm->update_first('pos_paiements', $condition, $datas);
				$up_cmd = $this->model_rm->update_first_cmd('pos_ibi_commandes', $cond_cmd, $data_cmd);

				// $this->data['message'] = "success";
				if ($up) {
					$this->data['message'] = "success";
				}
			} elseif ($montant_enter < $value['MONTANT_PAIEMENT']) {


				$montant_j = $value['MONTANT_PAIEMENT'] - $montant_enter;
				$datas = array('MONTANT_PAIEMENT' => $montant_j);
				$condition = array('CLIENT_ID_PAIEMENT' => $id_client, 'ID_PAIEMENT' => $value['ID_PAIEMENT']);

				$cond_cmds = array('ID_pos_IBI_COMMANDES' => $value['COMMANDE_ID'], 'COMMANDE_STATUS' => 0);
				$data_cmds  = array('COMMANDE_STATUS' => 3);

				$up = $this->model_rm->update('pos_paiements', $condition, $datas);
				$up_cmd = $this->model_rm->update('pos_ibi_commandes', $cond_cmds, $data_cmds);

				if ($up) {
					$this->data['message'] = "success";
				}

				return $this->data['message'] = "success";
			} else {
			}
		}

		echo json_encode($this->data['message']);
	}

	/**
	 * Add new pos_clientss
	 *
	 */
}


/* End of file pos_clients.php */
/* Location: ./application/controllers/administrator/Pos Clients.php */