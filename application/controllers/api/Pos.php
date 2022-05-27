<?php
defined('BASEPATH') or exit('No direct script access allowed');

// use \Firebase\JWT\JWT;

class Pos extends API
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
	}


	public function index_get()
	{
		$data = $this->db->get('pos_ibi_stores', array('DELETE_STATUS_STORE' => 0))->result();

		$this->response([
			'status' 	=> true,
			'message' 	=> 'Donnees departements',
			'data'	 	=> $data
		], API::HTTP_OK);
	}


	public function login_post()
	{
		$json = $this->input->post('password');

		$get = $this->db->query('SELECT G.id AS group_id, G.name AS group_name, A.id AS user_id, A.full_name FROM aauth_groups G
			JOIN aauth_user_to_group AG ON AG.group_id=G.id
			JOIN aauth_users A ON A.id=AG.user_id
			WHERE A.pin_code="' . $json . '"')->result();
		if (sizeof($get) > 0) {
			$this->response($get[0], API::HTTP_OK);
		} else {
			$this->response([], API::HTTP_OK);
		}
		exit;
	}

	public function orders_get($id)
	{

		$get = $this->model_rm->getRequete(
			'
			SELECT 
			 CP.REF_PRODUCT_CODEBAR AS article_codebar,
			 A.NATURE_ARTICLE AS article_nature, 
			 A.TYPE_ARTICLE AS article_type, 
			 CL.ID_CLIENT AS client_id,  
			 CL.NOM_CLIENT AS client_name, 
			 CL.PRENOM AS client_prenom, 
			 CP.ID_pos_IBI_COMMANDES_PRODUITS AS cmd_id, 
			 CP.REF_COMMAND_CODE AS code, 
			 CP.DATE_COMMANDE_PRODUITS AS created_at, 
			 CP.DISCOUNT_PERCENT AS discount_percent, 
			 CP.NAME AS prod_name,
			 CP.PRIX AS prod_price, 
			 CP.QUANTITE AS prod_quantity, 
			 AUTH.full_name AS responsable, 
			 CM.TABLE_ID AS table_id, 
			 CM.tva AS tva
			FROM pos_ibi_commandes_produits CP 
			JOIN pos_ibi_commandes CM ON CP.pos_IBI_COMMANDES_ID=CM.ID_pos_IBI_COMMANDES
			LEFT JOIN pos_clients CL ON CL.ID_CLIENT=CM.CLIENT_ID_COMMANDE
			LEFT JOIN pos_store_1_ibi_articles A ON A.ID_ARTICLE=CP.REF_COMMAND_CODE
			LEFT JOIN aauth_users AUTH ON CP.CREATED_BY_pos_IBI_COMMANDES_PRODUITS=AUTH.id 
			WHERE CP.CREATED_BY_pos_IBI_COMMANDES_PRODUITS=' . $id . ''
		);






		$this->response($get, API::HTTP_OK);
	}

	public function stores_articles_get()
	{
		$all_stores = $this->db->query("SELECT r0.`id_store`, r0.`name_store` FROM `pos_ibi_stores` AS r0 WHERE ((r0.`is_pos` = 1) AND (r0.`delete_status_store` = 0))")->result();
		$all_articles = [];
		for ($i = 0; $i < sizeof($all_stores); $i++) {
			$current_store = $all_stores[$i];
			$stores_art =
				$this->db->query("SELECT r2.`design_article`, nature_article,r2.`id_article`, r2.`codebar_article`,
				 r2.`type_article`, r2.`codebar_article`, r2.`ref_categorie_article`, r2.`quantity_article`,
				  r2.`prix_de_vente_article`, r2.`store_id_article` FROM `pos_store_" . $current_store->id_store . "_ibi_articles` as r2 WHERE r2.delete_status_article = 0 and ref_categorie_article != '' and type_article = 0")->result();
			for ($t = 0; $t < sizeof($stores_art); $t++) {
				$crr = $stores_art[$t];
				array_push($all_articles, $crr);
			}
		}
		$this->response($all_articles, API::HTTP_OK);
	}

	public function stores_complete_get()
	{

		$all_stores = $this->db->query("SELECT r0.`id_store`, r0.`name_store` FROM `pos_ibi_stores` AS r0 WHERE ((r0.`is_pos` = 1) AND (r0.`delete_status_store` = 0))")->result();
		$stores_complete = [];
		for ($i = 0; $i < sizeof($all_stores); $i++) {
			$current_store = $all_stores[$i];
			$stores_complete[$current_store->id_store]['categories'] = [];
			$item_cats = $this->db->query("SELECT r0.`id_store`, r0.`name_store`, r2.`design_article`, r2.`id_article`, r2.`codebar_article`, r2.`type_article`, r2.`codebar_article`, r2.`ref_categorie_article`, r2.`quantity_article`, r2.`prix_de_vente_article`, r0.`id_store`, r1.`nom_categorie`, r1.`id_categorie` FROM `pos_ibi_stores` AS r0 INNER JOIN `pos_ibi_articles_categories` AS r1 ON r1.`store_id` = r0.`id_store` INNER JOIN `pos_store_" . $current_store->id_store . "_ibi_articles` AS r2 ON r2.`ref_categorie_article` = r1.`id_categorie` WHERE (r0.`id_store` = $current_store->id_store) and r1.`delete_status_categorie` = 0 and r2.`delete_status_article` = 0")->result();
			for ($r = 0; $r < sizeof($item_cats); $r++) {
				$item = $item_cats[$r];
				if (!isset($stores_complete[$current_store->id_store]['categories'][$item->id_categorie])) {
					$stores_complete[$current_store->id_store]['categories'][$item->id_categorie]['articles'] = [];
					$d =
						array(
							"article_codebar" => $item->codebar_article,
							"article_id" => intval($item->id_article),
							"article_name" => $item->design_article,
							"article_store" => intval($item->id_store),
							"categorie_id" => intval($item->ref_categorie_article),
							"codebar" => $item->codebar_article,
							"price" => $item->prix_de_vente_article,
							"quantity" => intval($item->quantity_article),
							"type" => $item->type_article

						);
					array_push($stores_complete[$current_store->id_store]['categories'][$item->id_categorie]['articles'], $d);
					$stores_complete[$current_store->id_store]['categories'][$item->id_categorie]["categorie_id"] = intval($item->id_categorie);
					$stores_complete[$current_store->id_store]['categories'][$item->id_categorie]["categorie_name"] = $item->nom_categorie;
					$stores_complete[$current_store->id_store]['store_name'] = $item->name_store;
					$stores_complete[$current_store->id_store]['store_id'] = $item->id_store;
				} else {
					$d =
						array(
							"article_codebar" => $item->codebar_article,
							"article_id" => intval($item->id_article),
							"article_name" => $item->design_article,
							"article_store" => intval($item->id_store),
							"categorie_id" => intval($item->ref_categorie_article),
							"codebar" => $item->codebar_article,
							"price" => $item->prix_de_vente_article,
							"quantity" => intval($item->quantity_article),
							"type" => $item->type_article

						);
					array_push($stores_complete[$current_store->id_store]['categories'][$item->id_categorie]['articles'], $d);
				}
			}
		}
		$data_raw = array_values($stores_complete);
		$data_clean = [];
		for ($e = 0; $e < sizeof($data_raw); $e++) {
			$data_clean[$e]['categories'] =
				array_values($data_raw[$e]["categories"]);
			$data_clean[$e]['store_name'] = $data_raw[$e]['store_name'];
			$data_clean[$e]['store_id'] = intval($data_raw[$e]['store_id']);
		}

		$this->response($data_clean, API::HTTP_OK);
	}

	public function create_order_post()
	{
		// $json = file_get_contents('php://input');
		// $order_info = json_decode($json);
		$table_command_prod_name = "pos_ibi_commandes_produits";
		// TODO: should add article nature and prix de vente
		$prods = $this->input->post("products");
		$client_id_commande = $this->input->post('client_id_commande');
		$client_data = $this->db->query("SELECT r0.`nom_client`, r0.`id_client`, 
		r0.`prenom`, r0.`type_client_id`, r0.`tel_clients`, c1.`client_file_id`,
		 c1.`client_file_code`, c1.`discount_food`, c1.`discount_boisson` FROM `pos_clients`
		  AS r0 INNER JOIN `client_file` AS c1 ON c1.`client_id` = r0.`id_client` WHERE 
		  r0.`delete_status_client` = 0 AND r0.`id_client` = $client_id_commande 
		AND c1.`client_file_status` = 0")->result()[0];
		$order_to_save = [
			"CLIENT_FILE_ID" => $client_data->client_file_id,
			"USER_ID" => $this->input->post('user_id'),
			"TABLE_ID" => $this->input->post('table_id'),
			"ID_CLIENT" => $client_id_commande
		];
		$inserted_commande = $this->save_commande("pos_ibi_commandes", $order_to_save);

		for ($i = 0; $i < count($prods); $i++) {
			$myitem = $prods[$i];

			$total_brut = floatval($myitem['sold_quantity'] * $myitem['prix_de_vente_article']);

			$discount = $myitem['article_nature'] == '1' ? $client_data['discount_food'] : $client_data['discount_boisson'];
			$total_with_discount = floatval($total_brut - ($total_brut * ($discount / 100)));

			// GESTION DES QUANTITES

			$table_article = "pos_store_" . $myitem['store_id'] . "_ibi_articles";
			$this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE - ' . $myitem['sold_quantity'], FALSE);
			$this->db->where('ID_ARTICLE', $myitem['article_id']);
			$this->db->update($table_article);

			$dataToSave = array(
				"REF_COMMAND_CODE" => $inserted_commande[1],
				"REF_PRODUCT_CODEBAR" => $myitem['article_codebar'],
				"QUANTITE" => $myitem['sold_quantity'],
				"PRIX" => $myitem['prix_de_vente_article'],
				"PRIX_TOTAL" => $total_brut,
				"pos_IBI_COMMANDES_ID" => $inserted_commande[0],
				"DATE_CREATION_pos_IBI_COMMANDES_PRODUITS" => date("Y-m-d H:i:s"),
				"DATE_COMMANDE_PRODUITS " => date("Y-m-d H:i:s"),
				"NAME" => $myitem['item_name'],
				"STORE_ID_pos_IBI_COMMANDES_PRODUITS" => $myitem['store_id'],
				"DISCOUNT_PERCENT" => $discount,
				"CLIENT_FILE_ID_COMMANDES_PRODUITS" => $client_data['client_file_id'],
				"CREATED_BY_pos_IBI_COMMANDES_PRODUITS" => $this->input->post('user_id')
			);
			$insert = $this->db->insert($table_command_prod_name, $dataToSave);
			if ($insert) {
				$table_article_flow = "pos_store_" . $myitem['STORE_ID_ARTICLE'] . "_ibi_articles_stock_flow";
				$dataArticleFlow = array(
					"REF_COMMAND_CODE_SF" => $inserted_commande[1],
					"QUANTITE_SF" => $myitem['sold_quantity'],
					"DATE_CREATION_SF" => date("Y-m-d H:i:s"),
					"CREATED_BY_SF" => $this->input->post("user_id"),
					"REF_ARTICLE_BARCODE_SF" => $myitem['article_codebar'],
					"UNIT_PRICE_SF" => $myitem['prix_de_vente_article'],
					"TYPE_SF" => "sale",
					"TOTAL_PRICE_SF" => $total_with_discount,
					"REF_PROVIDER_SF" => 0
				);
				$this->db->insert($table_article_flow, $dataArticleFlow);
			}
		}


		// insertion stockflow

	}

	public function save_commande($table_name, $order, $split = FALSE)
	{
		$connected_user = $order['USER_ID'];
		$p_file_id = $order['CLIENT_FILE_ID'];


		// $table_name = "pos_store_2_ibi_commandes";
		$year = date("Y");
		$last = $this->db->select("*")
			->from($table_name)
			->where('YEAR(DATE_CREATION_pos_IBI_COMMANDES)', $year)
			->order_by('ID_pos_IBI_COMMANDES', 'DESC')
			->limit(1)
			->get()->result();
		$code_next = 1;
		$zeros = "0000";

		if (sizeof($last) > 0) {

			$iter = strlen($last[0]->ID_pos_IBI_COMMANDES);

			$code_next = $last[0]->ID_pos_IBI_COMMANDES + 1;
			$zeros = "";
			while ($iter < 5) {
				$zeros = $zeros . "0";
				$iter++;
			}
		}
		$code = $zeros . $code_next . '/' . date('m/y');

		$data = array(
			"CODE" => 'VEN' . $code,
			"TVA" => 0,
			"CLIENT_ID_COMMANDE" => $order['ID_CLIENT'],
			"CLIENT_FILE_ID_pos_IBI_COMMANDES" => $p_file_id,
			"CREATED_BY_pos_IBI_COMMANDES" => $connected_user,
			"TO_WHOM" => $split ? 0 : 1,
			"TABLE_ID" => $order['TABLE_ID']
		);

		$this->db->insert($table_name, $data);
		$last_id = $this->db->insert_id();
		return [$last_id, 'VEN' . $code];
	}

	public function orders_details_get($id)
	{

		$get = $this->model_rm->getList('pos_ibi_commandes_produits', array('pos_IBI_COMMANDES_ID' => $id));
		$result = array();

		foreach ($get as $key) {
			$obj = (object)[];
			$obj->article_codebar = $key['REF_PRODUCT_CODEBAR'];
			$obj->discount = $key['DISCOUNT_PERCENT'];
			$obj->name = $key['NAME'];
			$obj->prix = $key['PRIX'];
			$obj->prod_id = $key['ID_pos_IBI_COMMANDES_PRODUITS'];
			$obj->quantite = $key['QUANTITE'];

			$result["products"][] = $obj;
		}
		$result["success"] = "product list found";

		$this->response($result, API::HTTP_OK);
	}

	public function waiters_get()
	{

		$get = $this->model_rm->getList('aauth_users', array('banned' => 0));
		$result = array();

		foreach ($get as $key) {

			$obj = (object)[];
			$obj->full_name = $key['full_name'];
			$obj->user_id = $key['id'];

			$result[] = $obj;
		}


		$this->response($result, API::HTTP_OK);
	}

	public function clients_get()
	{
		$get = $this->model_rm->getRequete('
			SELECT * 
			FROM pos_clients C
			LEFT JOIN client_file CF ON CF.CLIENT_ID=C.ID_CLIENT
			WHERE CLIENT_FILE_STATUS=0');

		$result = array();

		foreach ($get as $key) {

			$obj = (object)[];
			$obj->client_file_code = $key['CLIENT_FILE_CODE'];
			$obj->client_file_id = $key['CLIENT_FILE_ID'];
			$obj->client_id = $key['CLIENT_ID'];
			$obj->client_name = $key['NOM_CLIENT'];
			$obj->client_prenom = $key['PRENOM'];
			$obj->discount_boisson = $key['DISCOUNT_BOISSON'];
			$obj->discount_food = $key['DISCOUNT_FOOD'];
			$obj->phone_number = $key['TEL_CLIENTS'];
			$obj->type_client = $key['TYPE_CLIENT_ID'];

			$result[] = $obj;
		}


		$this->response($result, API::HTTP_OK);
	}

	public function locations_get()
	{
		$data = $this->db->query("select ID_COMMANDE_LOCATION as location_id, DESIGNATION as location_name from pos_ibi_commande_location")->result();
		$this->response($data, API::HTTP_OK);
	}

	public function request_split_post($order_id)
	{

		$update_split = $this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_SPLIT_REQUEST=1 WHERE ID_pos_IBI_COMMANDES="' . $order_id . '"');

		if ($update_split) {
			$this->response([
				'success' => true,
				'message' => $this->db->last_query()
			], API::HTTP_OK);
		} else {
			$this->response([
				'error' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	public function request_void_post($order_id)
	{
		$update_void = $this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_VOID_REQUEST=1 WHERE ID_pos_IBI_COMMANDES="' . $order_id . '"');
		if ($update_void) {
			$this->response([
				'success' => true,
				'message' => 'request void passed'
			], API::HTTP_OK);
		} else {
			$this->response([
				'error' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	public function orders_split_get($waiter_id)
	{

		$result = $this->db->query("SELECT r0.`id_pos_ibi_commandes` cmd_id, r0.`code`,
		 r0.`date_creation_pos_ibi_commandes` created_at, r0.`created_by_pos_ibi_commandes` created_by,
		  r0.`tva` tva, r0.`table_id`, r1.`id_client` client_id, r1.`nom_client` client_name,
		   a3.`full_name` responsable, r1.`prenom` client_prenom, r2.`name` prod_name,
		    r2.`quantite` prod_quantity, r2.`prix` prod_price, r4.`id_article` article_id,
			 r4.`codebar_article` article_codebar, r2.`id_pos_ibi_commandes_produits` prod_id,
			  r2.`store_id_pos_ibi_commandes_produits` store_id, r2.`discount_percent` discount_percent,
			   r4.`type_article` article_type, r4.`nature_article` article_nature FROM `pos_ibi_commandes` AS r0 INNER JOIN `pos_clients` AS r1 ON r1.`id_client` = r0.`client_id_commande` INNER JOIN `pos_ibi_commandes_produits` AS r2 ON r2.`pos_ibi_commandes_id` = r0.`id_pos_ibi_commandes` INNER JOIN `aauth_users` AS a3 ON a3.`id` = r0.`created_by_pos_ibi_commandes` LEFT OUTER JOIN `pos_store_1_ibi_articles` AS r4 ON r2.`ref_product_codebar` = r4.`codebar_article` WHERE r0.`commande_split_request` = 1 AND r0.`commande_status` = 0 AND r0.`created_by_pos_ibi_commandes` = $waiter_id and r0.`deleted_status_pos_ibi_commandes` = 0 ORDER BY r0.`date_creation_pos_ibi_commandes` DESC ")->result();
		$this->response($result, API::HTTP_OK);
	}

	public function payements_modes_get()
	{

		$result = $this->model_rm->getRequete('
			SELECT 
			 ID_MODE_PAIEMENT AS mode_id,
			 DESIGNATION_PAIEMENT_MODE AS mode_name
			FROM mode_paiement');


		$this->response($result, API::HTTP_OK);
	}

	public function payements_factures_get()
	{

		$result = $this->model_rm->getRequete('
			SELECT 
			 ID_TYPE_FACTURE AS type_id,
			 DESIGNATION_TYPE_FACTURE AS type_name
			FROM type_facture');


		$this->response($result, API::HTTP_OK);
	}

	// from morisho
	public function check_shift_get($cashier_id)
	{
		$data = $this->db->query("SELECT c0.`shift_start` FROM `cashier_shifts` AS c0 WHERE ((c0.`created_by_shift` = $cashier_id) AND (c0.`shift_status` = 0))")->result();
		if (sizeof($data) > 0) {
			$this->response(["success" => 1, "data" => $data], API::HTTP_OK);
		} else {
			$this->response(["error" => 0, API::HTTP_OK]);
		}
	}

	public function check_shift_all_get($target)
	{
		if ($target == "rx") {
			$data = $this->db->query("SELECT c0.`shift_start` FROM `cashier_shifts` AS c0 WHERE (c0.`shift_status` = 0)")->result();
			if (sizeof($data) > 0) {
				$this->response(["success" => 1], API::HTTP_OK);
			} else {
				$this->response(["error" => 0, API::HTTP_OK]);
			}
		}
	}

	public function waiter_order_get($waiter_id, $is_admin = null)
	{
		$today = date('Y-m-d');
		$date = date_create($today);
		$d = date_sub($date, date_interval_create_from_date_string('2 days'));
		$dat = date_format($d, 'Y-m-d');
		$cond = '';
		$status = '';
		if ($is_admin != null) {
			$cond = "(r0.`created_by_pos_ibi_commandes` != '')";
			$status =  "(r0.`commande_status` >= 0)";
		} else {
			$cond = "(r0.`created_by_pos_ibi_commandes` = $waiter_id)";
			$status =  "(r0.`commande_status` >= 0)";
		}
		$data = $this->db->query("SELECT r0.`id_pos_ibi_commandes` AS cmd_id, r0.`commande_status`,r0.`code`,rl.`designation` as table_name,
		 r0.`date_creation_pos_ibi_commandes` as created_at,created_by_pos_ibi_commandes as created_by, r0.`tva`, a4.`full_name` as responsable, r1.`id_client` as client_id, r1.`nom_client` as client_name, r1.`prenom` client_prenom, r2.`name` prod_name, r0.`table_id`, r2.`quantite` prod_quantity, r2.`prix` prod_price, r2.`ID_pos_IBI_COMMANDES_PRODUITS` prod_id,r2.`STORE_ID_pos_IBI_COMMANDES_PRODUITS` store_id,r2.`discount_percent`, r3.`type_article` article_type, r3.`id_article` article_id,r3.`nature_article` article_nature, r3.`codebar_article` 
		 article_codebar FROM `pos_ibi_commandes` AS r0 INNER JOIN `pos_ibi_commande_location` as rl on r0.`table_id` = rl.`id_commande_location` INNER JOIN 
		`pos_clients` AS r1 ON r1.`id_client` = r0.`client_id_commande` INNER JOIN `pos_ibi_commandes_produits` 
		AS r2 ON r2.`pos_ibi_commandes_id` = r0.`id_pos_ibi_commandes` 
		LEFT OUTER JOIN `pos_store_1_ibi_articles` AS r3 ON r2.`ref_product_codebar` = r3.`codebar_article` 
		INNER JOIN `aauth_users` AS a4 ON a4.`id` = r0.`created_by_pos_ibi_commandes`
		 WHERE (((($cond AND (r0.`transfer_status` = 0)) 
		 OR ((r0.`transfer_to` = $waiter_id) AND (r0.`transfer_status` = 1))) AND $status AND r0.`date_creation_pos_ibi_commandes` >= $dat) 
		 AND (r0.`deleted_status_pos_ibi_commandes` = 0)) ORDER BY  r0.`commande_status` ASC,r0.`date_creation_pos_ibi_commandes` 
		 DESC")->result();
		// print_r($this->db->last_query());

		$this->response($data, API::HTTP_OK);
	}


	public function waiter_orders_get()
	{
		$this->db->query("");
	}

	public function update_commande_post()
	{

		$client_id_commande = $this->input->post("client_id_commande");
		$cmd_code = $this->input->post("cmd_code");
		$cmd_id = $this->input->post("cmd_id");
		$is_acc = $this->input->post("is_acc");
		$user_id = $this->input->post("user_id");
		$products = $this->input->post("products");
		$params = json_decode($products);
		$ins = 0;
		$dataAll = [];

		for ($i = 0; $i < count($params); $i++) {

			$elem = $params[$i];

			$check = $this->model_rm->getOne("pos_ibi_commandes_produits", array("pos_IBI_COMMANDES_ID" => $cmd_id, "REF_PRODUCT_CODEBAR" => $elem->article_codebar));
			if (isset($check['QUANTITE'])) {
				$update = $this->model_rm->getUpdate("UPDATE pos_ibi_commandes_produits SET QUANTITE=(QUANTITE+" . $elem->sold_quantity . ") WHERE ID_pos_IBI_COMMANDES_PRODUITS=" . $check['ID_pos_IBI_COMMANDES_PRODUITS'] . "");
			} else {

				$save = array(
					"REF_PRODUCT_CODEBAR" => $elem->article_codebar,
					"NAME" => $elem->item_name,
					"QUANTITE" => $elem->sold_quantity,
					"REF_COMMAND_CODE" => $cmd_code,
					"pos_IBI_COMMANDES_ID" => $cmd_id,
					"PRIX" => $this->model_rm
						->getOne(
							"pos_store_" . $elem->article_store . "_ibi_articles",
							array("ID_ARTICLE" => $elem->item_id)
						)['PRIX_DE_VENTE_ARTICLE'],
					"CREATED_BY_pos_IBI_COMMANDES_PRODUITS" => $user_id,
					"STORE_ID_pos_IBI_COMMANDES_PRODUITS" => $elem->article_store,
					"CLIENT_FILE_ID_COMMANDES_PRODUITS" => $this->model_rm
						->getOne(
							"client_file",
							array("CLIENT_ID" => $client_id_commande, "CLIENT_FILE_STATUS" => 0)
						)['CLIENT_FILE_ID'],
					"DATE_CREATION_pos_IBI_COMMANDES_PRODUITS" => date("Y-m-d H:i:s")
				);
				$dataAll[] = $save;
			}
		}

		if (sizeof($dataAll) > 1) {
			$ins = $this->model_rm->insertArray("pos_ibi_commandes_produits", $dataAll);
		}

		$this->response(array("success" => true), API::HTTP_OK);
	}


	public function generateCode()
	{

		$year = date("Y");
		$last = $this->db->select("*")
			->from("pos_ibi_commandes")
			->where('YEAR(DATE_CREATION_pos_IBI_COMMANDES)', $year)
			->order_by('ID_pos_IBI_COMMANDES', 'DESC')
			->limit(1)
			->get()->result();
		$code_next = 1;
		$zeros = "0000";

		if (sizeof($last) > 0) {

			$iter = strlen($last[0]->ID_pos_IBI_COMMANDES);

			$code_next = $last[0]->ID_pos_IBI_COMMANDES + 1;
			$zeros = "";
			while ($iter < 5) {
				$zeros = $zeros . "0";
				$iter++;
			}
		}
		$code = $zeros . $code_next . '/' . date('m/y');
		return "VEN" . $code;
	}

	public function create_command_post()
	{

		$client_id_commande = $this->input->post("client_id_commande");
		$user_id = $this->input->post("user_id");
		$table_id = $this->input->post("table_id");
		$products = $this->input->post("products");
		$dataAll = [];
		// $data='[{"item_id":14,"sold_quantity":1,"item_name":"ANANAS","store_id":2,"idx":0,"selectedCategory":0,"categorie_id":24,"selectedStore":0,"article_id":14,"article_codebar":"0001-000398","article_store":2},{"item_id":15,"sold_quantity":1,"item_name":"BREAK FAST HAGA","store_id":2,"idx":1,"selectedCategory":0,"categorie_id":24,"selectedStore":0,"article_id":15,"article_codebar":"0001-000290","article_store":2},{"item_id":17,"sold_quantity":1,"item_name":"DANISH PASTRIES","store_id":2,"idx":3,"selectedCategory":0,"categorie_id":24,"selectedStore":0,"article_id":17,"article_codebar":"0001-000292","article_store":2},{"item_id":18,"sold_quantity":1,"item_name":"ZANZI OMELETTE","store_id":2,"idx":4,"selectedCategory":0,"categorie_id":24,"selectedStore":0,"article_id":18,"article_codebar":"0001-000293","article_store":2},{"item_id":16,"sold_quantity":2,"item_name":"FULL BREAK FAST TRAY","store_id":2,"idx":2,"selectedCategory":0,"categorie_id":24,"selectedStore":0,"article_id":16,"article_codebar":"0001-000291","article_store":2}]';
		$datas = json_decode($products);

		$codeCom = $this->generateCode();

		$insComand = $this->model_rm->insert_last_id(
			"pos_ibi_commandes",
			array(
				"CLIENT_ID_COMMANDE" => $client_id_commande,
				"CREATED_BY_pos_IBI_COMMANDES" => $user_id,
				"TABLE_ID" => $table_id ? $table_id : 0,
				"CODE" => $codeCom,
				"CLIENT_FILE_ID_pos_IBI_COMMANDES" => $this->model_rm
					->getOne(
						"client_file",
						array("CLIENT_ID" => $client_id_commande, "CLIENT_FILE_STATUS" => 0)
					)['CLIENT_FILE_ID']
			)
		);

		for ($i = 0; $i < count($datas); $i++) {

			$elem = $datas[$i];
			$save = array(
				"REF_PRODUCT_CODEBAR" => $elem->article_codebar,
				"NAME" => $elem->item_name,
				"QUANTITE" => $elem->sold_quantity,
				"REF_COMMAND_CODE" => $codeCom,
				"pos_IBI_COMMANDES_ID" => $insComand,
				"PRIX" => $this->model_rm
					->getOne(
						"pos_store_" . $elem->article_store . "_ibi_articles",
						array("ID_ARTICLE" => $elem->item_id)
					)['PRIX_DE_VENTE_ARTICLE'],
				"CREATED_BY_pos_IBI_COMMANDES_PRODUITS" => $user_id,
				"STORE_ID_pos_IBI_COMMANDES_PRODUITS" => $elem->article_store,
				"CLIENT_FILE_ID_COMMANDES_PRODUITS" => $this->model_rm
					->getOne(
						"client_file",
						array("CLIENT_ID" => $client_id_commande, "CLIENT_FILE_STATUS" => 0)
					)['CLIENT_FILE_ID'],
				"DATE_CREATION_pos_IBI_COMMANDES_PRODUITS" => date("Y-m-d H:i:s")
			);
			$dataAll[] = $save;

			$flow = array(
				"REF_ARTICLE_BARCODE_SF" => $elem->article_codebar,
				"QUANTITE_SF" => $elem->sold_quantity,
				"REF_COMMAND_CODE_SF" => $codeCom,
				"TYPE_SF" => "sale",
				"UNIT_PRICE_SF" => $this->model_rm
					->getOne(
						"pos_store_" . $elem->article_store . "_ibi_articles",
						array("ID_ARTICLE" => $elem->item_id)
					)['PRIX_DE_VENTE_ARTICLE'],
				"TOTAL_PRICE_SF" => 0,
				"CREATED_BY_SF" => $user_id,

				"DATE_CREATION_SF" => date("Y-m-d H:i:s")
			);

			$ins_flow = $this->model_rm->insert("pos_store_" . $elem->article_store . "_ibi_articles_stock_flow", $flow);
		}

		if ($insComand) {
			$ins = $this->model_rm->insertArray("pos_ibi_commandes_produits", $dataAll);
		}

		if ($ins) {
			$this->response(array("success" => true), API::HTTP_OK);
		} else {
			$this->response(array("success" => false), API::HTTP_OK);
		}

		if ($ins) {
			$this->response(array("success" => true), API::HTTP_OK);
		} else {
			$this->response(array("success" => false), API::HTTP_OK);
		}
	}

	public function confirm_split_post()
	{

		$client_id = $this->input->post("client_id");
		$cmd_id = $this->input->post("cmd_id");
		$created_at = $this->input->post("created_at");
		$created_by = $this->input->post("created_by");

		$products = $this->input->post("products");

		$data = json_decode($products);

		for ($i = 0; $i < count($data); $i++) {
			$elem = $data[$i];

			$set = $this->db->query("UPDATE pos_ibi_commandes_produits SET QUANTITE=(QUANTITE-" . $elem->sold_quantity . ") WHERE ID_pos_IBI_COMMANDES_PRODUITS=" . $elem->prod_id . "");
		}


		$codeCom = $this->generateCode();

		$insComand = $this->model_rm->insert_last_id(
			"pos_ibi_commandes",
			array(
				"CLIENT_ID_COMMANDE" => $client_id,
				"CREATED_BY_pos_IBI_COMMANDES" => $created_by,
				"TABLE_ID" => $this->model_rm->getOne("pos_ibi_commandes", array("ID_pos_IBI_COMMANDES" => $cmd_id))['TABLE_ID'],
				"CODE" => $codeCom,
				"CLIENT_FILE_ID_pos_IBI_COMMANDES" => $this->model_rm
					->getOne(
						"client_file",
						array("CLIENT_ID" => $client_id, "CLIENT_FILE_STATUS" => 0)
					)['CLIENT_FILE_ID']
			)
		);

		$saveAll = [];

		for ($i = 0; $i < count($data); $i++) {
			$d = $data[$i];
			$save = array(
				"REF_PRODUCT_CODEBAR" => $d->article_codebar,
				"NAME" => $this->model_rm->getOne("pos_ibi_commandes_produits", array("ID_pos_IBI_COMMANDES_PRODUITS" => $d->prod_id))["NAME"],
				"QUANTITE" => $d->sold_quantity,
				"REF_COMMAND_CODE" => $codeCom,
				"pos_IBI_COMMANDES_ID" => $insComand,
				"PRIX" => $d->prix,
				"CREATED_BY_pos_IBI_COMMANDES_PRODUITS" => $created_by,
				"STORE_ID_pos_IBI_COMMANDES_PRODUITS" => $d->store_id,
				"CLIENT_FILE_ID_COMMANDES_PRODUITS" => $this->model_rm
					->getOne(
						"client_file",
						array("CLIENT_ID" => $client_id, "CLIENT_FILE_STATUS" => 0)
					)['CLIENT_FILE_ID'],
				"DATE_CREATION_pos_IBI_COMMANDES_PRODUITS" => date("Y-m-d H:i:s")
			);
			$saveAll[] = $save;
		}


		if ($insComand) {
			$ins = $this->model_rm->insertArray("pos_ibi_commandes_produits", $saveAll);
		}

		if ($ins) {
			$this->response(array("success" => true), API::HTTP_OK);
		} else {
			$this->response(array("success" => false), API::HTTP_OK);
		}
	}

	public function paiements_post()
	{

		$client_id = $this->input->post('client_id');
		$command_id = $this->input->post('cmd_id');
		$facture = $this->input->post('facture');
		$amount = $this->input->post('amount');
		$mode = $this->input->post('mode');
		$user_id = $this->input->post('user_id');
		$status_paie = "";

		switch ($facture) {
			case 1:
				$status_paie = 10;
				$amount = 0;
				break;
			case 2:
				$status_paie = 1;
				break;
			case 3:
				$status_paie = 2;
				break;
			case 4:
				$status_paie = 11;
				$amount = 0;
				break;
			default:
				$status_paie = NULL;
				return;
		}

		// get shift
		$shift = 0;
		$shifts = $this->db->query("SELECT * FROM cashier_shifts where shift_status = 0")->result();
		if (sizeof($shifts) > 0) {
			$shift = $shifts[0];

			// update_shift
			$data_update_shift = array('COMMANDE_STATUS' => $status_paie, 'ID_CASHIER_SHIFT' => $shift->ID_SHIFT);

			$this->db->where('ID_pos_IBI_COMMANDES', $command_id);
			$this->db->set($data_update_shift);
			$this->db->update('pos_ibi_commandes');

			// insertion du paiement
			$data_paiement = array('CLIENT_ID_PAIEMENT' => $client_id, 'COMMANDE_ID' => $command_id, 'CREATED_BY_PAIEMENT' => $user_id, 'MONTANT_PAIEMENT' => $amount, "MODE_PAIEMENT" => $mode, 'SHIFT_ID' => $shift->ID_SHIFT, 'TYPE_FACTURE' => $facture);
			$insertion_paiement = $this->db->insert('pos_paiements', $data_paiement);

			// select code cmd et id store
			$get_codeCommande = $this->db->query("SELECT CODE  FROM pos_ibi_commandes WHERE ID_pos_IBI_COMMANDES =" . $command_id . " ")->row();

			$get_id_stores = $this->db->query("SELECT ID_STORE FROM pos_ibi_stores WHERE IS_POS = 1 AND STATUS_STORE ='opened' ")->result();

			// update_flow_product
			foreach ($get_id_stores as $store) {
				// $STORE[] = $store;
				$this->db->query("UPDATE pos_store_" . $store->ID_STORE . "_ibi_articles_stock_flow SET SHIFT_ID_S = " . $shift->ID_SHIFT . " WHERE REF_COMMAND_CODE_SF='" . $get_codeCommande->CODE . "' ");
			}

			$this->response([
				'success' => true,
				'message' => 'end request',
				'data_up' => $this->db->last_query()
			]);
		} else {
			$this->response([
				'error' => true,
				'message' => 'end request',
				'data_up' => $this->db->last_query()
			]);
		}
	}
}
