<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Departement extends API
{

	public function __construct()
	{
		parent::__construct();
	}

public function get_all_tables_get()
	{

		$tables = $this->db->query("SELECT * FROM `pos_ibi_commande_location` WHERE DELETE_STATUS = 0")->result();

		$this->response([
			'status' 	=> true,
			'message' 	=> 'List des tables',
			'data'	 	=> $tables
		], API::HTTP_OK);
	}


	public function index_get()
	{
		$departement = $this->db->get_where('pos_ibi_stores', array('DELETE_STATUS_STORE' => 0))->result();
		$departement_arr = [];

		foreach ($departement as $dep) {
			$departement_arr[] = $dep;
		}

		$data['departements'] = $departement_arr;

		$this->response([
			'status' 	=> true,
			'message' 	=> 'Donnees departements',
			'data'	 	=> $data
		], API::HTTP_OK);
	}


	public function categorie_get()
	{

		$store = $this->db->get_where('pos_ibi_stores', array('DELETE_STATUS_STORE' => 0))->result();
		$categorie = "";
		foreach ($store as $key) {
			$store_id = $key->ID_STORE;
			$categorie .= "SELECT s.*,cat.* FROM pos_ibi_articles_categories cat,pos_ibi_stores s where cat.STORE_ID=" . $store_id . " AND cat.STORE_ID=s.ID_STORE ";
			$categorie .= " UNION ALL ";
		}

		$categorie .= '@';
		$categorie = str_replace('UNION ALL @', '', $categorie);

		$donnees = $this->db->query($categorie)->result();
		$categorie_arr = [];

		if ($donnees) {

			foreach ($donnees as $cat) {

				$categorie_arr[] = [
					'ID_CATEGORIE' => $cat->ID_CATEGORIE,
					'NOM_CATEGORIE' => $cat->NOM_CATEGORIE,
					'DESCRIPTION_CATEGORIE' => $cat->DESCRIPTION_CATEGORIE,
					'PARENT_REF_ID_CATEGORIE' => $cat->PARENT_REF_ID_CATEGORIE,
					'DATE_CREATION_CATEGORIE' => $cat->DATE_CREATION_CATEGORIE,
					'CREATED_BY_CATEGORIE' => $cat->CREATED_BY_CATEGORIE,
					'STORES' => [
						'ID_STORE' => $cat->ID_STORE,
						'STATUS_STORE' => $cat->STATUS_STORE,
						'NAME_STORE' => $cat->NAME_STORE,
						'DESCRIPTION_STORE' => $cat->DESCRIPTION_STORE,
						'DATE_CREATION_STORE' => $cat->DATE_CREATION_STORE,
						'CREATED_BY_STORE' => $cat->CREATED_BY_STORE,
					]
				];
			}

			$data['categorie'] = $categorie_arr;
			$this->response([
				'status' => true,
				'message' => 'donnees des categorie',
				'data' => $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	//Recuperation des tous les articles par stores
	public function articles_get()
	{
		$store = $this->db->get_where('pos_ibi_stores', array('DELETE_STATUS_STORE' => 0))->result();
		$articles = "";
		foreach ($store as $key) {
			$store_id = $key->ID_STORE;
			$articles .= "SELECT * FROM pos_store_" . $store_id . "_ibi_articles WHERE IS_INGREDIENT=0";
			$articles .= " UNION ALL ";
		}

		$articles .= '@';
		$articles = str_replace('UNION ALL @', '', $articles);

		$donnee = $this->db->query($articles)->result();
		$articles_arr = [];
		foreach ($donnee as $art) {
			$articles_arr[] = $art;
		}

		$data['articles'] = $articles_arr;
		$this->response([
			'status' => true,
			'message' => 'donnees des articles',
			'data' => $data
		], API::HTTP_OK);
	}


	// //Articles categorie
	public function store_categorie_get($store)
	{
		$store = $this->db->query('SELECT s.*,cat.* FROM  pos_ibi_stores s, pos_ibi_articles_categories cat WHERE cat.STORE_ID=s.ID_STORE AND ID_STORE=' . $store);

		$store_arr = [];
		$categorie_arr = [];
		$data = [];

		if ($store->num_rows() > 0) {

			foreach ($store->result() as $t) {
				$data['ID_STORE'] = $t->ID_STORE;
				$data['STATUS_STORE'] = $t->STATUS_STORE;
				$data['NAME_STORE'] = $t->NAME_STORE;
				$data['DESCRIPTION_STORE'] = $t->DESCRIPTION_STORE;
				$data['DATE_CREATION_STORE'] = $t->DATE_CREATION_STORE;
				$data['CREATED_BY_STORE'] = $t->DESCRIPTION_STORE;
				$data[] = [
					'categorie' => [
						'ID_CATEGORIE' => $t->ID_CATEGORIE,
						'NOM_CATEGORIE' => $t->NOM_CATEGORIE,
						'DESCRIPTION_CATEGORIE' => $t->DESCRIPTION_CATEGORIE,
						'PARENT_REF_ID_CATEGORIE' => $t->PARENT_REF_ID_CATEGORIE,
						'DATE_CREATION_CATEGORIE' => $t->DATE_CREATION_CATEGORIE,
						'CREATED_BY_CATEGORIE' => $t->CREATED_BY_CATEGORIE,
					]
				];
			}
		}

		$this->response([
			'status' => true,
			'message' => 'donnees categorie store',
			'data' => $data
		], API::HTTP_OK);
	}


	// 		//Articles categorie
	public function article_categorie_get($store, $categorie)
	{

		$categorie = $this->db->query('SELECT art.*,cat.* FROM  pos_store_' . $store . '_ibi_articles art, pos_ibi_articles_categories cat WHERE cat.ID_CATEGORIE=art.REF_CATEGORIE_ARTICLE AND cat.STORE_ID=' . $store . ' AND ID_CATEGORIE=' . $categorie);

		$store_arr = [];
		$categorie_arr = [];
		$data = [];

		if ($categorie->num_rows() > 0) {

			foreach ($categorie->result() as $t) {
				$data['ID_CATEGORIE'] = $t->ID_CATEGORIE;
				$data['NOM_CATEGORIE'] = $t->NOM_CATEGORIE;
				$data['STORE_ID'] = $t->STORE_ID;
				$data['DESCRIPTION_CATEGORIE'] = $t->DESCRIPTION_CATEGORIE;
				$data['PARENT_REF_ID_CATEGORIE'] = $t->PARENT_REF_ID_CATEGORIE;
				$data['DATE_CREATION_CATEGORIE'] = $t->DATE_CREATION_CATEGORIE;
				$data['CREATED_BY_CATEGORIE'] = $t->CREATED_BY_CATEGORIE;
				$data['DELETE_STATUS_CATEGORIE'] = $t->DELETE_STATUS_CATEGORIE;
				$data[] = [
					'articles' => [
						'ID_ARTICLE' => $t->ID_ARTICLE,
						'DESIGN_ARTICLE' => $t->DESIGN_ARTICLE,						   'TYPE_ARTICLE' => $t->TYPE_ARTICLE,
						'CODEBAR_ARTICLE' => $t->CODEBAR_ARTICLE,	 					   'QUANTITY_ARTICLE' => $t->QUANTITY_ARTICLE,
						'PRIX_DE_VENTE_ARTICLE' => $t->PRIX_DE_VENTE_ARTICLE,						   'PRIX_DACHAT_ARTICLE' => $t->PRIX_DACHAT_ARTICLE,
						'UNITE_ARTICLE' => $t->UNITE_ARTICLE,						   'MARGE_ARTICLE' => $t->MARGE_ARTICLE,
						'DATE_CREATION_ARTICLE' => $t->DATE_CREATION_ARTICLE,						   'DELETE_STATUS_ARTICLE' => $t->DELETE_STATUS_ARTICLE,
						'DELETE_BY_ARTICLE' => $t->DELETE_BY_ARTICLE,
					]
				];
			}
		}

		$this->response([
			'status' => true,
			'message' => 'donnees des articles',
			'data' => $data
		], API::HTTP_OK);
	}



	// 		//Articles categorie
	public function article_store_get($store)
	{

		$categorie = $this->db->query('SELECT * FROM  pos_store_' . $store . '_ibi_articles  WHERE IS_INGREDIENT=0');

		$store_arr = [];
		$categorie_arr = [];
		$data = [];

		if ($categorie->num_rows() > 0) {

			foreach ($categorie->result() as $t) {
				$data[] = $t;
			}
		}

		$this->response([
			'status' => true,
			'message' => 'donnees des articles',
			'data' => $data
		], API::HTTP_OK);
	}



	public function get_all_store_get()
	{
		$store = $this->db->get_where('pos_ibi_stores', array('DELETE_STATUS_STORE' => 0))->result();
		$articles = "";
		$store_arr = [];
		$all_data = [];
		foreach ($store as $key) {
			$store_id = $key->ID_STORE;
			$articles .= "SELECT cat.*,art.* FROM pos_ibi_articles_categories cat,pos_store_" . $store_id . "_ibi_articles art WHERE  art.REF_CATEGORIE_ARTICLE=cat.ID_CATEGORIE AND art.IS_INGREDIENT=0 ";
			$articles .= " UNION ALL ";
		}

		$articles .= '@';
		$articles = str_replace('UNION ALL @', '', $articles);

		$donnee = $this->db->query($articles)->result();
		$articles_arr = [];
		foreach ($donnee as $art) {
			//$articles_arr['store'];
			$articles_arr[] = [
				$articles_arr[] = [
					'articles' => [
						'ID_ARTICLE' => $art->ID_ARTICLE,
						'DESIGN_ARTICLE' => $art->DESIGN_ARTICLE,						   'REF_CATEGORIE_ARTICLE' => $art->REF_CATEGORIE_ARTICLE,						   'TYPE_ARTICLE' => $art->TYPE_ARTICLE,
						'CODEBAR_ARTICLE' => $art->CODEBAR_ARTICLE,						   'QUANTITY_ARTICLE' => $art->QUANTITY_ARTICLE,
						'PRIX_DE_VENTE_ARTICLE' => $art->PRIX_DE_VENTE_ARTICLE,						   'PRIX_DACHAT_ARTICLE' => $art->PRIX_DACHAT_ARTICLE,
						'UNITE_ARTICLE' => $art->UNITE_ARTICLE,						   'MARGE_ARTICLE' => $art->MARGE_ARTICLE,
						'DATE_CREATION_ARTICLE' => $art->DATE_CREATION_ARTICLE,						   'DELETE_STATUS_ARTICLE' => $art->DELETE_STATUS_ARTICLE,
						'DELETE_BY_ARTICLE' => $art->DELETE_BY_ARTICLE,
					]
				]
			];
		}

		$data = [
			'categorie' => $articles_arr,
			'article' => [
				'articles' => $articles_arr
			]
		];
		//$data['store']=$all_data;	
		$data['categorie'] = $articles_arr;
		$this->response([
			'status' => true,
			'message' => 'donnees des articles',
			'data' => $data
			// 'data'=>'donneee'
		], API::HTTP_OK);
	}

	public function get_order_post()
	{
		# code...
		$order = $_POST['order'];
		$this->response([
			'status' => true,
			'message' => 'donnees des articles',
			'data' => 1
			// 'data'=>'donneee'
		], API::HTTP_OK);
	}


	//Commande pour touts les status
	public function get_all_commande_status_get($status = 0)
	{

		$commande_data = [];
		if ($status == 1) {
			$Commande = $this->db->get_where('pos_ibi_commandes', array('	COMMANDE_STATUS' => $status))->result();
			foreach ($Commande as $k) {
				$commande_data[] = $k;
			}
		} elseif ($status == 2) {

			$Commande = $this->db->get_where('pos_ibi_commandes', array('	COMMANDE_STATUS' => $status))->result();
			foreach ($Commande as $k) {
				$commande_data[] = $k;
			}
		} elseif ($status == 3) {

			$Commande = $this->db->get_where('pos_ibi_commandes', array('COMMANDE_STATUS' => $status))->result();
			foreach ($Commande as $k) {
				$commande_data[] = $k;
			}
		} elseif ($status == 4) {
			$Commande = $this->db->get_where('pos_ibi_commandes', array('COMMANDE_STATUS' => $status))->result();
			foreach ($Commande as $k) {
				$commande_data[] = $k;
			}
		} else {
			$Commande = $this->db->get_where('pos_ibi_commandes', array('	COMMANDE_STATUS' => 0))->result();
			foreach ($Commande as $k) {
				$commande_data[] = $k;
			}
		}


		$data = $commande_data;
		$this->response([
			'status' => true,
			'message' => 'commande recuperer avec success',
			'donnees' => $data
		], API::HTTP_OK);
	}

	public function get_commande_get($id_user)
	{

		$commande_data = [];

		$Commande = $this->db->query('SELECT c.*,u.* FROM pos_ibi_commandes c,aauth_users u WHERE c.CREATED_BY_POS_IBI_COMMANDES=u.id AND c.CREATED_BY_POS_IBI_COMMANDES=' . $id_user . '')->result();

		foreach ($Commande as $k) {
			$commande_data[] = $k;
		}

		$data = $commande_data;
		$this->response([
			'status' => true,
			'message' => 'commande recuperer avec success',
			'donnees' => $data
		], API::HTTP_OK);
	}

	public function get_all_commande_get($date_creation = null)
	{
		//   var_dump($date_creation);
		//   exit;
		$data = date('Y-m-d');

		$good_date = date_sub(date_create($data), date_interval_create_from_date_string('4 days'));
		//   if ($date_creation !=null) {
		// 	   $commande = $this->db->query('SELECT c.*,u.*,cl.* FROM pos_ibi_commandes c,aauth_users u,pos_clients cl WHERE  c.CREATED_BY_POS_IBI_COMMANDES=u.id AND cl.ID_CLIENT=c.CLIENT_ID_COMMANDE AND DATE_FORMAT(c.DATE_CREATION_POS_IBI_COMMANDES,"%Y-%m-%d")="'.$date_creation.'" ORDER BY ID_POS_IBI_COMMANDES DESC')->result();
		//   } else {
		$commande = $this->db->query('SELECT c.*,u.*,cl.* FROM pos_ibi_commandes c,aauth_users u,pos_clients cl WHERE  c.CREATED_BY_POS_IBI_COMMANDES=u.id AND cl.ID_CLIENT=c.CLIENT_ID_COMMANDE and c.DELETED_STATUS_POS_IBI_COMMANDES = 0 AND c.COMMANDE_STATUS = 0 and DATE_FORMAT(c.DATE_CREATION_POS_IBI_COMMANDES,"%Y-%m-%d")>"' . $good_date . '" ORDER BY ID_POS_IBI_COMMANDES DESC')->result();
		//   }

		//   $commande = $this->db->query('SELECT c.*,u.*,cl.* FROM pos_ibi_commandes c,aauth_users u,pos_clients cl WHERE  c.CREATED_BY_POS_IBI_COMMANDES=u.id AND cl.ID_CLIENT=c.CLIENT_ID_COMMANDE AND DATE_FORMAT(c.DATE_CREATION_POS_IBI_COMMANDES,"%Y-%m-%d")="'.$date_creation.'" ORDER BY ID_POS_IBI_COMMANDES DESC')->result();

		$commande_data = [];

		if ($commande) {
			foreach ($commande as $t) {

				$commande_produits = $this->db->get_where('pos_ibi_commandes_produits', array('pos_IBI_COMMANDES_ID' => $t->ID_POS_IBI_COMMANDES))->result();
				$commande_produit_data = [];
				foreach ($commande_produits as $v) {
					# code...
					$commande_produit_data[] = [
						'NAME' => $v->NAME,
						'ID_POS_IBI_COMMANDES_PRODUITS' => $v->ID_POS_IBI_COMMANDES_PRODUITS,
						'pos_IBI_COMMANDES_ID' => $v->pos_IBI_COMMANDES_ID,
						'REF_PRODUCT_CODEBAR' => $v->REF_PRODUCT_CODEBAR,
						'REF_COMMAND_CODE' => $v->REF_COMMAND_CODE,
						'QUANTITE' => $v->QUANTITE,
						'PRIX' => $v->PRIX_VENDU,
						'PRIX_TOTAL' => ($v->PRIX_VENDU*$v->QUANTITE),
						"STORE_ID_ARTICLES" => $v->STORE_ID_POS_IBI_COMMANDES_PRODUITS,
						'DISCOUNT_PERCENT' => $v->DISCOUNT_PERCENT,
						'DATE_COMMANDE_PRODUITS' => $v->DATE_COMMANDE_PRODUITS,

					];
				}

				$listes_paiement_data = "";
				$resultat_paiement = $this->db->query('SELECT SUM(MONTANT_PAIEMENT) as montant_payer FROM  pos_paiements WHERE COMMANDE_ID=' . $t->ID_POS_IBI_COMMANDES)->result();

				foreach ($resultat_paiement as $p) {
					# code...
					$listes_paiement_data = $p->montant_payer;
				}

				$commande_data[] = [
					'ID_POS_IBI_COMMANDES' => $t->ID_POS_IBI_COMMANDES,
					'ID_CASHIER_SHIFT' => $t->ID_CASHIER_SHIFT,
					'COMMANDE_STATUS' => $t->COMMANDE_STATUS,
					'COMMANDE_VOID_REQUEST' => $t->COMMANDE_VOID_REQUEST,
					'COMMANDE_SPLIT_REQUEST' => $t->COMMANDE_SPLIT_REQUEST,
					'CODE' => $t->CODE,
					'TABLE_ID' => $t->TABLE_ID,
					'TRANSFER_TO' => $t->TRANSFER_TO,
					'TRANSFER_STATUS' => $t->TRANSFER_STATUS,
					'TRANSFER_ACCEPTED_AT' => $t->TRANSFER_ACCEPTED_AT,
					'CLIENT_ID_COMMANDE' => $t->CLIENT_ID_COMMANDE,
					'CLIENT_FILE_ID_POS_IBI_COMMANDES' => $t->CLIENT_FILE_ID_POS_IBI_COMMANDES,
					'DATE_CREATION_POS_IBI_COMMANDES' => $t->DATE_CREATION_POS_IBI_COMMANDES,
					'CREATED_BY_POS_IBI_COMMANDES' => $t->CREATED_BY_POS_IBI_COMMANDES,
					'DELETED_STATUS_POS_IBI_COMMANDES' => $t->DELETED_STATUS_POS_IBI_COMMANDES,
					'PRODUITS' => $commande_produit_data,
					'CLIENT' => [
						'ID_CLIENT' => $t->ID_CLIENT,
						'TYPE_CLIENT_ID' => $t->TYPE_CLIENT_ID,
						'NOM_CLIENT' => $t->NOM_CLIENT,
						'PRENOM' => $t->PRENOM
					],
					'PAIEMENT' => intval($listes_paiement_data),
					'USER' => [
						'id' => $t->id,
						'email' => $t->email,
						'username' => $t->username,
						'full_name' => $t->full_name,
						'pin_code' => $t->pin_code,
						'boutique' => $t->boutique,
						'ip_address' => $t->ip_address,
						'avatar' => $t->avatar,
						'oauth_uid' => $t->oauth_uid
					]
				];
			}

			$data = $commande_data;
			$this->response([
				'status' => true,
				'message' => 'commande recuperer avec success',
				'donnees' => $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => true,
				'd' => $data,
				'message' => 'commande Pas des donnees',
				'donnees' => []
			], API::HTTP_OK);
		}
	}




	//Function la creation de la methode de paiement
	public function mode_paiement_add_post()
	{

		//  var_dump($_POST);
		//  exit;
		$designation = $this->input->post('designation');
		$description = $this->input->post('description');
		$data = [
			'DESIGNATION_PAIEMENT_MODE' => $designation,
			'DESCRIPTION_PAIEMENT_MODE' => $description,
			'CREATED_BY_PAIEMENT_MODE' => get_user_data('id')
		];

		$query = $this->db->insert('mode_paiement', $data);
		if ($query) {
			$this->response([
				'status' => true,
				'message' => 'Mode de paiement Ajouter avec success',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	public function mode_paiement_list_get()
	{
		$query = $this->db->get('mode_paiement')->result();
		$donnee_arr = [];
		if ($query) {
			foreach ($query as $k) {
				$donnee_arr[] = $k;
			}
			$data = $donnee_arr;
			$this->response([
				'status' => true,
				'message' => 'Mode de paiement Recuperer avec success',
				'donnee' => $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => true,
				'message' => 'Mode de paiement Ajouter avec success',
				'donnee' => []
			], API::HTTP_OK);
		}
	}

	//Fonction de la suppression 
	public function mode_paiement_delete_post()
	{
		$id = $this->input->post('id');
		//  var_dump($_POST);
		//  exit;
		$this->db->where('ID_PAIEMENT', $id);
		$query = $this->db->delete('mode_paiement');

		if ($query) {
			$this->response([
				'status' => true,
				'message' => 'Mode de paiement Supprimer avec success'
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}


	public function mode_paiement_update_post()
	{
		$id = $this->input->post('id');
		$designation = $this->input->post('designation');
		$description = $this->input->post('description');
		$data = [
			'DESIGNATION_PAIEMENT_MODE' => $designation,
			'DESCRIPTION_PAIEMENT_MODE' => $description,
			'CREATED_BY_PAIEMENT_MODE' => get_user_data('id')
		];

		$this->db->where('ID_PAIEMENT', $id);
		$this->db->set($data);
		$query = $this->db->update('mode_paiement');

		if ($query) {
			$this->response([
				'status' => true,
				'message' => 'Mode de paiement Modifier  avec success'
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	//Crud paiements lists
	public function paiement_list_get()
	{
		//  $requete = $this->db->order_by('ID_PAIEMENT','DESC')->get('pos_paiements')->result();
		$requete = $this->db->query('SELECT p.*,m.* FROM pos_paiements p,mode_paiement m WHERE m.ID_MODE_PAIEMENT=p.MODE_PAIEMENT ORDER BY ID_PAIEMENT DESC')->result();

		$donnee_arr = [];

		if ($requete) {

			foreach ($requete as $k) {
				# code...
				$donnee_arr[] = [
					'ID_PAIEMENT' => $k->ID_PAIEMENT,
					'COMMANDE_ID' => $k->COMMANDE_ID,
					'MONTANT_PAIEMENT' => $k->MONTANT_PAIEMENT,
					'MONTANT_CASH' => $k->MONTANT_CASH,
					'MONTANT_V' => $k->MONTANT_V,
					'MODE_PAIEMENT' => $k->MODE_PAIEMENT,
					'DATE_CREATION_PAIEMENT' => $k->DATE_CREATION_PAIEMENT,
					'CREATED_BY_PAIEMENT' => $k->CREATED_BY_PAIEMENT,
					'DELETED_STATUS_PAIEMENT' => $k->DELETED_STATUS_PAIEMENT,
					'DELETED_COMMENT_PAIEMENT' => $k->DELETED_COMMENT_PAIEMENT,
					'MODE_PAIEMENT' => [
						'ID_MODE_PAIEMENT' => $k->ID_MODE_PAIEMENT,
						'DESIGNATION_PAIEMENT_MODE' => $k->DESIGNATION_PAIEMENT_MODE,
						'DESCRIPTION_PAIEMENT_MODE' => $k->DESCRIPTION_PAIEMENT_MODE,
						'CREATED_BY_PAIEMENT_MODE' => $k->CREATED_BY_PAIEMENT_MODE,
					]
				];
			}

			$data = $donnee_arr;
			$this->response([
				'status' => true,
				'message' => 'Mode de paiement Modifier  avec success',
				'donnees' => $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'donnees' => []
			], API::HTTP_OK);
		}
	}

	public function paiement_add_web_post()
	{


		$donnee_recus = $_POST['paiement'];
		$commande_id = $_POST['commande_id'];
		$user_id = $_POST['user_id'];
		$type_facture = $_POST['type_facture'];

		$get_client = $this->db->get_where('pos_ibi_commandes', array('ID_POS_IBI_COMMANDES' => $commande_id))->row();

		//Modification de status de la commande 
		$query = $this->db->query('SELECT SUM(MONTANT_PAIEMENT) as total FROM `pos_paiements` WHERE COMMANDE_ID=' . $commande_id . '')->row();
		$total = $query->total;

		$total_paiements = $this->db->query('SELECT SUM(PRIX_VENDU * QUANTITE) as Total FROM `pos_ibi_commandes_produits` WHERE pos_IBI_COMMANDES_ID=' . $commande_id . '')->row();
		$total_paiement = $total_paiements->Total;

		// $commande_info = $this->db->query("SELECT * FROM pos_ibi_commandes WHERE ");
		if ($type_facture == 1) {
			# code...
			$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=10 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
		}

		if ($type_facture == 2) {
			$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=1 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
		}

		if ($type_facture == 3) {
			$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=2 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
		}

		if ($type_facture == 4) {
			$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=11 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
		}


		for ($i = 0; $i < count($donnee_recus); $i++) {
			$paiement = $donnee_recus[$i];
			$p = $paiement['paiement'];

			for ($i = 0; $i < count($p); $i++) {
				$data = $p[$i];
				$pdata = $data;

				$detection_paiement = $total + $pdata['montant'];
				// var_dump($detection_paiement);
				// var_dump($total_paiement);

				// exit;

				if ($total_paiement == $detection_paiement) {

					$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=2 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
				}

				$session=0;

				$sessions = $this->db->query('SELECT ID_SESSION FROM pos_session WHERE SESSION_STATUS=0');

				if ($sessions->num_rows() > 0) {
					
					$session= $sessions->row()->ID_SESSION;
				}

				$shift=0;

				$shifts = $this->db->query('SELECT ID_SHIFT FROM `cashier_shifts` WHERE SHIFT_STATUS=0');
				if ($shifts->num_rows() > 0) {
					
					$shif= $shifts->row()->ID_SHIFT;
				}

				$data = [
					'COMMANDE_ID' => $commande_id,
					'SHIFT_ID' => $shift,
					'ID_SESSION' => $session,
					'COMMANDE_CODE' => $get_client->CODE,
					'MODE_PAIEMENT' => $pdata['mode'],
					'CLIENT_ID_PAIEMENT' => $get_client->CLIENT_ID_COMMANDE,
					'MONTANT_PAIEMENT' => $pdata['montant'],
					'TYPE_FACTURE' => $type_facture,
					'DATE_CREATION_PAIEMENT' => date('Y-m-d H:m:s'),
					'CREATED_BY_PAIEMENT' => $user_id
				];

				$requete = $this->db->insert('pos_paiements', $data);
				// 			if ($requete) {
				// 	  $this->response([
				// 		 'statut'=>true,
				// 		 'status'=>'ok'
				// 	 ],API::HTTP_OK);
				// } else {

				// 	  $this->response([
				// 			'status' => false,
				// 			'message' => validation_errors()
				// 		], API::HTTP_NOT_ACCEPTABLE);
				// }


			}
		}
		exit;
	}



	public function paiement_add_web_credit_post()
	{

		$commande_id = $_POST['commande_id'];
		$user_id = $_POST['user_id'];
		$type_facture = $_POST['type_facture'];

		if ($type_facture == 1) {
			# code...
			$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=10 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
		}
	}







	public function paiement_add_post()
	{



		$orders = $_POST['paiement'];

		$donnee_recus = json_decode($orders, true);


		$commande_id = $_POST['commande_id'];
		$user_id = $_POST['user_id'];
		$type_facture = $_POST['type_facture'];

		// var_dump($type_facture);
		// exit;

		$get_client = $this->db->get_where('pos_ibi_commandes', array('ID_POS_IBI_COMMANDES' => $commande_id))->row();

		//Modification de status de la commande 
		$query = $this->db->query('SELECT SUM(MONTANT_PAIEMENT) as total FROM `pos_paiements` WHERE COMMANDE_ID=' . $commande_id . '')->row();
		$total = $query->total;

		$total_paiements = $this->db->query('SELECT SUM(PRIX_VENDU*QUANTITE) as Total FROM `pos_ibi_commandes_produits` WHERE pos_IBI_COMMANDES_ID=' . $commande_id . '')->row();
		$total_paiement = $total_paiements->Total;


		if ($type_facture == 1) {
			# code...
			$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=10 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
		}

		if ($type_facture == 2) {
			$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=1 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
		}

		if ($type_facture == 3) {
			$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=2 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
		}

		if ($type_facture == 4) {
			$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=11 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
		}



		$paiements = $donnee_recus['paiement'];
		$ok = false;
		// exit;
		foreach ($paiements as $k) {
			$paiement = $k;
			$pdata = $paiement;

			$detection_paiement = $total + $pdata['montant'];

			if ($total_paiement == $detection_paiement) {
				$this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_STATUS=2 WHERE ID_POS_IBI_COMMANDES="' . $commande_id . '"');
			}

			$session = $this->db->query('SELECT ID_SESSION FROM pos_session WHERE SESSION_STATUS=0')->row()->ID_SESSION;

			$shift = $this->db->query('SELECT ID_SHIFT FROM `cashier_shifts` WHERE SHIFT_STATUS=0')->row()->ID_SHIFT;

			$data = [
				'COMMANDE_ID' => $commande_id,
				'SHIFT_ID' => $shift,
				'ID_SESSION' => $session,
				'MODE_PAIEMENT' => $pdata['mode'],
				'MONTANT_PAIEMENT' => $pdata['montant'],
				'CLIENT_ID_PAIEMENT' => $get_client->CLIENT_ID_COMMANDE,
				'TYPE_FACTURE' => $type_facture,
				'DATE_CREATION_PAIEMENT' => date('Y-m-d H:m:s'),
				'CREATED_BY_PAIEMENT' => $user_id
			];

			$requete = $this->db->insert('pos_paiements', $data);
			$ok = $requete;
			//	echo json_encode($data);

		}

		if ($ok) {
			$this->response([
				'statut' => true,
				'status' => 'ok'
			], API::HTTP_OK);
		} else {

			$this->response([
				'statut' => false,
				'status' => 'failed'
			], API::HTTP_NOT_ACCEPTABLE);
		}

		exit;
	}




	public function paiement_update_post()
	{

		$store_id = $this->input->post('store');
		$id = $this->input->post('id');
		$montant = $this->input->post('montant');
		$user_id = $this->input->post('user_id');
		$type_paiement = $this->input->post('type_paiement');
		$data = [
			'STORE_ID_PAIEMENT' => $store_id,
			'MONTANT_PAIEMENT' => $montant,
			'PAYMENT_TYPE_PAIEMENT' => $type_paiement,
			'DATE_CREATION_PAIEMENT' => date('Y-m-d H:m:s'),
			'CREATED_BY_PAIEMENT' => $user_id
		];

		$this->db->where('ID_PAIEMENT', $id);
		$this->db->set($data);
		$query = $this->db->update('pos_paiements');

		if ($query) {
			$this->response([
				'status' => true,
				'message' => 'Enregistrer avec success'
			], API::HTTP_OK);
		} else {

			$this->response([
				'status' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}


	public function paiement_delete_post()
	{

		$store_id = $this->input->post('store');
		$id = $this->input->post('id');


		$this->db->where('ID_PAIEMENT', $id);
		$this->db->where('STORE_ID_PAIEMENT', $store_id);
		$this->db->set('DELETED_STATUS_PAIEMENT', $id);
		$query = $this->db->update('pos_paiements');

		if ($query) {
			$this->response([
				'statut' => true,
				'status' => 'ok'
			], API::HTTP_OK);
		} else {

			$this->response([
				'status' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}


	//Fonction des shifts

	public function shift_add_post()
	{
		// $shift_start = $this->input->post('shift_start');
		// $shift_end = $this->input->post('shift_end');
		$created_by_shift = $this->input->post('created_by_shift');
		$data = [
			'SHIFT_START' => date('Y-m-d H:m:s'),
			'CREATED_BY_SHIFT' => $created_by_shift,
		];

		$this->db->set('SHIFT_STATUS', 1);
		$this->db->set('SHIFT_END', date('Y-m-s'));
		$this->db->where('SHIFT_STATUS', 0);
		$this->db->update('cashier_shifts');
		$query = $this->db->insert('cashier_shifts', $data);
		$insert_id = $this->db->insert_id();

		if ($query) {
			$this->response([
				'status' => 'ok',
				'id' => $insert_id,
				'message' => 'Enregistrer avec success'
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	//Update shift status

	public function shift_update_post()
	{
		$id = $this->input->post('id');
		$created_by_shift = $this->input->post('created_by_shift');

		$data = [
			'SHIFT_END' => date('Y-m-d H:m:s'),
			'SHIFT_STATUS' => 1,
			'CREATED_BY_SHIFT' => $created_by_shift,
		];


		$this->db->where('ID_SHIFT', $id);
		$this->db->set($data);
		$query = $this->db->update('cashier_shifts');
		if ($query) {
			$this->response([
				'status' => 'ok',
				'message' => 'Enregistrer avec success'
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	public function get_all_users_get()
	{
		# code...
		$query = $this->db->query('SELECT u.*,g.id as ID_GROUP,g.name as NAME_GROUP,g.definition as DEFINITION FROM aauth_users u,aauth_groups g,aauth_user_to_group ug WHERE  u.id=ug.user_id AND g.id=ug.group_id')->result();
		$data_arr = [];

		if ($query) {
			foreach ($query as $k) {
				$data_arr[] = [
					'id' => $k->id,
					'email' => $k->email,
					'oauth_uid' => $k->oauth_uid,
					'oauth_provider' => $k->oauth_provider,
					'pass' => $k->pass,
					'username' => $k->username,
					'full_name' => $k->full_name,
					'pin_code' => $k->pin_code,
					'avatar' => $k->avatar,
					'boutique' => $k->boutique,
					'store_allowed' => $k->STORE_ALLOWED,
					'GROUP' => [
						'group_id' => $k->ID_GROUP,
						'name' => $k->NAME_GROUP,
						'defainition' => $k->DEFINITION
					]
				];
			}
			$data = $data_arr;
			$this->response([
				'status' => true,
				'message' => 'Donnees recuperer  avec success',
				'donnee' => $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => true,
				'message' => 'Donnees recuperer  avec success',
				'donnee' => []
			], API::HTTP_OK);
		}
	}


	public function get_all_clients_get()
	{
		# code...
		$query = $this->db->query('SELECT cl.*,clf.* FROM  pos_clients cl,client_file clf  GROUP BY cl.ID_CLIENT ')->result();
		$data_arr = [];

		//   var_dump($query);
		//   exit;

		if ($query) {
			foreach ($query as $k) {
				$data_arr[] = [
					'ID_CLIENT' => $k->ID_CLIENT,
					'TYPE_CLIENT_ID' => $k->TYPE_CLIENT_ID,
					'NOM_CLIENT' => $k->NOM_CLIENT,
					'PRENOM' => $k->PRENOM,
					'TEL_CLIENTS' => $k->TEL_CLIENTS,
					'DATE_CREATION_CLIENT' => $k->DATE_CREATION_CLIENT,
					'CREATED_BY_CLIENT' => $k->CREATED_BY_CLIENT,
					'DELETE_STATUS_CLIENT' => $k->DELETE_STATUS_CLIENT,
					'DELETE_COMMENT_CLIENT' => $k->DELETE_COMMENT_CLIENT,
					'DATE_MOD_CLIENT' => $k->DATE_MOD_CLIENT,
					'DELETE_BY_CLIENT' => $k->DELETE_BY_CLIENT,
					'MODIFIED_BY_CLIENT' => $k->MODIFIED_BY_CLIENT,
					'FICHE_CLIENTS' => [
						'CLIENT_FILE_ID' => $k->CLIENT_FILE_ID,
						'CLIENT_FILE_CODE' => $k->CLIENT_FILE_CODE,
						'CLIENT_ID' => $k->CLIENT_ID,
						'CLIENT_FILE_STATUS' => $k->CLIENT_FILE_STATUS,
						'DISCOUNT_BOISSON' => $k->DISCOUNT_BOISSON,
						'DISCOUNT_FOOD' => $k->DISCOUNT_FOOD,
						'DATE_CREATION_CLIENT_FILE' => $k->DATE_CREATION_CLIENT_FILE,
						'CREATED_BY_CLIENT_FILE' => $k->CREATED_BY_CLIENT_FILE
					]
				];
			}
			$data = $data_arr;
			$this->response([
				'status' => true,
				'message' => 'Donnees recuperer avec success',
				'donnee' => $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => true,
				'message' => 'Donnees recuperer avec success',
				'donnee' => []
			], API::HTTP_OK);
		}
	}

	public function product_add_commande_post()
	{
		# code...
		$orders = $_POST['order'];
		//   echo json_encode($_POST['order']);
		//   exit;
		$order = json_decode($orders, true);
		//  $order=$this->input->post('order');
		$commande_id = $order['commande_id'];

		$ok = false;

		// $produit_id =[];
		for ($i = 0; $i < count($order['items']); $i++) {
			# code...
			$myItems = $order['items'][$i];
			$produit_id = $myItems['CODEBAR_ARTICLE'];
			$produits = $this->db->get_where('pos_ibi_commandes_produits', array('pos_IBI_COMMANDES_ID' => $commande_id, 'REF_PRODUCT_CODEBAR' => $myItems['CODEBAR_ARTICLE']));


			if ($produits->num_rows() > 0) {
				foreach ($produits->result() as $k) {
					$codebar_find = $k->REF_PRODUCT_CODEBAR;
					//   if ($codebar_find==$myItems['code_bar']) {
					$calcul_quantite = $k->QUANTITE + $myItems['quantity'];
					if ($myItems['quantity'] != 0) {
						# code...
						$query = $this->db->query('UPDATE pos_ibi_commandes_produits SET QUANTITE=' . $calcul_quantite . ',PRIX_TOTAL=' . $calcul_quantite * $k->PRIX_VENDU . '
							  
							    WHERE REF_PRODUCT_CODEBAR="' . $myItems["CODEBAR_ARTICLE"] . '" AND pos_IBI_COMMANDES_ID=' . $commande_id . '');
						$this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE - ' . $myItems['quantity'], FALSE);
						$this->db->where('CODEBAR_ARTICLE', $myItems["CODEBAR_ARTICLE"]);
						$this->db->update('pos_store_' . $myItems['store_id'] . '_ibi_articles');
						$ok = $query;
					}


					//   $this->db->query('UPDATE pos_store_'.$myItems['store'].'_ibi_articles SET  QUANTITY_ARTICLE- ');





				}
			} else {

				$shift = $this->db->query('SELECT ID_SHIFT FROM `cashier_shifts` WHERE SHIFT_STATUS=0')->row()->ID_SHIFT;
				$commande_code = $this->db->get_where('pos_ibi_commandes', array('ID_POS_IBI_COMMANDES' => $commande_id))->row();
				$code_commande = $commande_code->CODE;
				$donnee = [
					'QUANTITE' => $myItems['quantity'],
					'pos_IBI_COMMANDES_ID' => $commande_id,
					'REF_PRODUCT_CODEBAR' => $myItems['CODEBAR_ARTICLE'],
					'REF_COMMAND_CODE' => $code_commande,
					'SHIFT_ID' => $shift,
					'STORE_ID_POS_IBI_COMMANDES_PRODUITS' => $myItems['store_id'],
					'PRIX' => $myItems['PRIX_DE_VENTE_ARTICLE'],
					'PRIX_TOTAL' => $myItems['PRIX_DE_VENTE_ARTICLE'] * $myItems['quantity'],
					'NAME' => $myItems['DESIGN_ARTICLE'],
					'DATE_CREATION_POS_IBI_COMMANDES_PRODUITS' => date('Y-m-d')
				];


				$this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE - ' . $myItems['quantity'], FALSE);
				$this->db->where('CODEBAR_ARTICLE', $myItems["CODEBAR_ARTICLE"]);
				$this->db->update('pos_store_' . $myItems['store_id'] . '_ibi_articles');

				$ok = $this->db->insert('pos_ibi_commandes_produits', $donnee);
				// $this->db->insert('pos_ibi_commandes_produits',$donnee);




			}
		}


		if ($ok) {
			$this->response([
				'statut' => true,
				'status' => 'ok'
			], API::HTTP_OK);
		} else {

			$this->response([
				'statut' => false,
				'status' => 'failed'
			], API::HTTP_NOT_ACCEPTABLE);
		}




		// echo json_encode($_POST);
	}



	public function retrait_commande_post()
	{
		$orders = $_POST['order'];
		$order = json_decode($orders, true);

		$table_command_prod_name = "pos_ibi_commandes_produits";
		$table_command_name = "pos_ibi_commandes";
		$cmd_inserted = false;
		$inserted_commande = 0;
		$req = '';
		$connected_user = CI_Controller::get_instance()->session->userdata('id');
		$i = 0;
		//Shift 
		$shift = $this->db->query('SELECT ID_SHIFT FROM `cashier_shifts` WHERE SHIFT_STATUS=0')->row()->ID_SHIFT;

		for ($i = 0; $i < count($order['items']); $i++) {


			$myitem1 = $order['items'][$i];
			$total_brut = 0;
			$discount = $myitem1['discount'];
			if ($myitem1['quantity'] > 0) {
				if (!$cmd_inserted) {

					// 		  var_dump($order['items']);
					//   exit;
					$order['ID_CLIENT'] = $order['ID_CLIENT'];
					$inserted_commande = $this->save_commande($table_command_name, $order);
					$cmd_inserted = true;
				}

				$total_brut = floatval($myitem1['quantity'] * $myitem1['PRIX_DE_VENTE_ARTICLE']);
				$discount = $myitem1['discount'];
				$total_with_discount = floatval($total_brut - ($total_brut * ($discount / 100)));
				$prix = floatval($myitem1['quantity'] * floatval($myitem1['PRIX_DE_VENTE_ARTICLE']));
				$this->db->set('QUANTITE', 'QUANTITE -' . $myitem1['quantity'], FALSE);
				$this->db->set('PRIX_TOTAL', 'PRIX_TOTAL -' . $prix, FALSE);
				$this->db->set('DATE_MOD_POS_IBI_COMMANDES_PRODUITS', date("Y-m-d H:i:s"));
				$this->db->where('STORE_ID_POS_IBI_COMMANDES_PRODUITS', $myitem1['store_id']);
				$this->db->where("ID_POS_IBI_COMMANDES_PRODUITS", $order['commande_id']);
				$this->db->update($table_command_prod_name);
				$dataToSave = array(
					"REF_COMMAND_CODE" => $inserted_commande[1],
					"REF_PRODUCT_CODEBAR" => $myitem1['CODEBAR_ARTICLE'],
					"QUANTITE" => $myitem1['quantity'],
					"PRIX" => $myitem1['PRIX_DE_VENTE_ARTICLE'],
					"PRIX_TOTAL" => $total_brut,
					'SHIFT_ID' => $shift,
					"pos_IBI_COMMANDES_ID" => $inserted_commande[0],
					// "DATE_CREATION_POS_IBI_COMMANDES_PRODUITS" => $order['dateCreation'],
					"DATE_CREATION_POS_IBI_COMMANDES_PRODUITS" => date('Y-m-d'),
					// "DATE_COMMANDE_PRODUITS " => $order['dateCreation'],
					"DATE_COMMANDE_PRODUITS " => date('Y-m-d'),
					"NAME" => $myitem1['DESIGN_ARTICLE'],
					"STORE_ID_POS_IBI_COMMANDES_PRODUITS" => $myitem1['store_id'],
					"DISCOUNT_PERCENT" => $myitem1['discount'],
					"CLIENT_FILE_ID_COMMANDES_PRODUITS" => $order['client_file_id'],
					"CREATED_BY_POS_IBI_COMMANDES_PRODUITS" => 1
				);

				$this->db->insert($table_command_prod_name, $dataToSave);
				$req = $this->db->last_query();
			}
		}
		echo json_encode(array(
			// 'id' => "here good!",
			"status" => 'ok',
		));

		exit;
	}



	public function product_acc_add_commande_post()
	{
		# code...
		$order = $this->input->post('order');
		$commande_id = $order['commande_id'];

		// $produit_id =[];
		for ($i = 0; $i < count($order['items']); $i++) {
			# code...
			$myItems = $order['items'][$i];
			$produit_id = $myItems['code_bar'];
			$produits = $this->db->get_where('pos_ibi_commandes_produits', array('pos_IBI_COMMANDES_ID' => $commande_id, 'REF_PRODUCT_CODEBAR' => $myItems['code_bar']));


			if ($produits->num_rows() > 0) {
				foreach ($produits->result() as $k) {
					$codebar_find = $k->REF_PRODUCT_CODEBAR;
					//   if ($codebar_find==$myItems['code_bar']) {
					$calcul_quantite = $k->QUANTITE + $myItems['product_qty'];
					$query = $this->db->query('UPDATE pos_ibi_commandes_produits SET QUANTITE=' . $calcul_quantite . ',PRIX_TOTAL=' . $calcul_quantite * $k->PRIX . '
							  
							    WHERE REF_PRODUCT_CODEBAR="' . $myItems["code_bar"] . '" AND pos_IBI_COMMANDES_ID=' . $commande_id . '');
				}
			} else {
				$commande_code = $this->db->get_where('pos_ibi_commandes', array('ID_POS_IBI_COMMANDES' => $commande_id))->row();
				$code_commande = $commande_code->CODE;
				$donnee = [
					'QUANTITE' => $myItems['product_id'],
					'pos_IBI_COMMANDES_ID' => $commande_id,
					'REF_PRODUCT_CODEBAR' => $myItems['code_bar'],
					'REF_COMMAND_CODE' => $code_commande,
					'PRIX' => $myItems['prix'],
					'PRIX_TOTAL' => $myItems['prix'] * $myItems['product_qty'],
					'NAME' => $myItems['design'],
					'DATE_CREATION_POS_IBI_COMMANDES_PRODUITS' => date('Y-m-d')
				];

				$this->db->insert('pos_ibi_commandes_produits', $donnee);
			}
		}




		// echo json_encode($_POST);
	}


	public function Rappor_chiffre_affaire_get()
	{
		# code...
		$commande_attente = $this->db->get_where('pos_ibi_commandes', array('COMMANDE_STATUS' => 0))->result();

		$commande_avance = $this->db->get_where('pos_ibi_commandes', array('COMMANDE_STATUS' => 1))->result();

		$commande_payer = $this->db->get_where('pos_ibi_commandes', array('COMMANDE_STATUS' => 0))->result();
		$year = date('Y');
		$chiffre_commade_en_avance = [];
		$chiffre_commade_payer = [];
		$chiffre_commade_credit = [];
		$chiffre_commade_attente = [];
		$donnee = [];

		# code...







		// foreach ($commande_payer as $k) {
		# code...
		for ($i = 1; $i <= 12; $i++) {
			if (strlen($i) == 2) {
				$j = '';
			} else {
				$j = 0;
			}

			$attente = $this->db->query("SELECT SUM(p.PRIX_VENDU*p.QUANTITE) as total FROM pos_ibi_commandes_produits p,pos_ibi_commandes c where p.pos_IBI_COMMANDES_ID=c.ID_POS_IBI_COMMANDES AND c.COMMANDE_STATUS=0 AND  date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, '%Y-%m')='" . $year . "-" . $j . $i . "' ");


			foreach ($attente->result() as $k) {
				# code...
				if (empty($k->total)) {
					$chiffre_commade_attente[] = 0;
				} else {
					$chiffre_commade_attente[] = intval($k->total);
				}
			}


			# code...
			$commande_av = $this->db->query("SELECT SUM(p.PRIX_VENDU*p.QUANTITE) as total FROM pos_ibi_commandes_produits p,pos_ibi_commandes c where p.pos_IBI_COMMANDES_ID=c.ID_POS_IBI_COMMANDES AND c.COMMANDE_STATUS=1 AND  date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, '%Y-%m')='" . $year . "-" . $j . $i . "' ");

			foreach ($commande_av->result() as $k) {
				# code...
				if (empty($k->total)) {
					$chiffre_commade_en_avance[] = 0;
				} else {
					$chiffre_commade_en_avance[] = intval($k->total);
				}
			}


			$commande_payer = $this->db->query("SELECT SUM(p.PRIX_VENDU*p.QUANTITE) as total FROM pos_ibi_commandes_produits p,pos_ibi_commandes c where p.pos_IBI_COMMANDES_ID=c.ID_POS_IBI_COMMANDES AND c.COMMANDE_STATUS=2 AND  date_format(DATE_CREATION_POS_IBI_COMMANDES_PRODUITS, '%Y-%m')='" . $year . "-" . $j . $i . "' ");

			//	}


			foreach ($commande_payer->result() as $k) {
				# code...
				if (empty($k->total)) {
					$chiffre_commade_payer[] = 0;
				} else {
					$chiffre_commade_payer[] = intval($k->total);
				}
			}
		}

		$donnee[] = [
			'name' => 'Avance',
			'data' => $chiffre_commade_en_avance
		];

		$donnee[] = [
			'name' => 'Credit',
			'data' => $chiffre_commade_attente
		];

		$donnee[] = [
			'name' => 'Payer',
			'data' => $chiffre_commade_payer
		];


		$this->response([
			'series' => $donnee
		]);
	}



	public function type_facture_get()
	{
		# code...
		$query = $this->db->get('type_facture')->result();
		$data_arr = [];
		if ($query) {
			foreach ($query as $k) {
				$data_arr[] = $k;
			}
			$data = $data_arr;
			$this->response([
				'status' => true,
				'message' => 'Donnees recuperer  avec success',
				'donnee' => $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' => true,
				'message' => 'Donnees recuperer  avec success',
				'donnee' => []
			], API::HTTP_OK);
		}
	}




	public function adjustArticleQty($table_article, $myitem, $target, $operation)
	{
		// TODO: can check before reduce the qty if the qty is enough

		if ($operation == "moins") {
			$this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE - ' . $myitem[$target], FALSE);
			$this->db->where("CODEBAR_ARTICLE", $myitem['REF_PRODUCT_CODEBAR']);
			$is_update = $this->db->update($table_article);
			return $is_update;
		} else {
			$this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE + ' . $myitem[$target], FALSE);
			$this->db->where("CODEBAR_ARTICLE", $myitem['REF_PRODUCT_CODEBAR']);
			$is_update = $this->db->update($table_article);
			return $is_update;
		}
	}


	public function adjustStockFlow($table_article, $myitem, $order, $connected_user, $table_article_flow, $operation)
	{

		$op_name = "";
		$qty = 0;
		if ($operation == "delete_in") {
			$op_name = "sale_stock_in";
			$qty =  $myitem['QUANTITE'];
			$this->adjustArticleQty($table_article, $myitem, 'QUANTITE', 'plus', true);
		} else if ($operation == "in") {
			$op_name = "sale_stock_in";
			$qty =  $myitem['removedQuantity'];
			$this->adjustArticleQty($table_article, $myitem, 'removedQuantity', 'plus');
		} else {
			if (!isset($myitem['addedQuantity']) or $myitem['addedQuantity'] == 0) {
				$qty = $myitem['quantity'];
				$this->adjustArticleQty($table_article, $myitem, 'quantity', 'moins');
			} else {
				$qty =  $myitem['addedQuantity'];
				$this->adjustArticleQty($table_article, $myitem, 'addedQuantity', 'moins');
			}
			$op_name = "sale";
		}
	}




	public function save_order_post()
	{

		$orders = $_POST['order'];
		$order = json_decode($orders, true);

		// var_dump($_POST['order']);
		// exit;


		$table_command_name = "pos_ibi_commandes";
		$table_command_prod_name = "pos_ibi_commandes_produits";
		$connected_user = CI_Controller::get_instance()->session->userdata('id');
		$next_patient_file = null;
		$type_de_payment = 0;
		$ref_group = 1;



		$inserted_commande = $this->save_commande($table_command_name, $order);
		//SHift check 
		$shift = $this->db->query('SELECT ID_SHIFT FROM `cashier_shifts` WHERE SHIFT_STATUS=0')->row()->ID_SHIFT;

		for ($i = 0; $i < count($order['items']); $i++) {
			$myitem = $order['items'][$i];

			$total_brut = floatval($myitem['quantity'] * $myitem['PRIX_DE_VENTE_ARTICLE']);
			$total_with_discount = "";


			$table_article = "pos_store_" . $myitem['store_id'] . "_ibi_articles";
			$this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE - ' . $myitem['quantity'], FALSE);
			$this->db->where('ID_ARTICLE', $myitem['ID_ARTICLE']);
			$this->db->update($table_article);

			$dataToSave = array(
				"REF_COMMAND_CODE" => $inserted_commande[1],
				"REF_PRODUCT_CODEBAR" => $myitem['CODEBAR_ARTICLE'],
				"QUANTITE" => $myitem['quantity'],
				"SHIFT_ID" => $shift,
				"PRIX" => $myitem['PRIX_DE_VENTE_ARTICLE'],
				"PRIX_TOTAL" => $total_brut,
				"pos_IBI_COMMANDES_ID" => $inserted_commande[0],
				"DATE_CREATION_POS_IBI_COMMANDES_PRODUITS" => date("Y-m-d H:i:s"),
				"DATE_COMMANDE_PRODUITS " => date("Y-m-d H:i:s"),
				"NAME" => $myitem['DESIGN_ARTICLE'],
				"STORE_ID_POS_IBI_COMMANDES_PRODUITS" => $myitem['store_id'],
			);

			$insert = $this->db->insert($table_command_prod_name, $dataToSave);

			if ($insert) {
				// $table_article ="pos_store_".$myitem['store_id']."_ibi_articles";
				$table_article_flow = "pos_store_" . $myitem['store_id'] . "_ibi_articles_stock_flow";
				$dataArticleFlow = array(
					"REF_COMMAND_CODE_SF" => $inserted_commande[1],
					"QUANTITE_SF" => $myitem['quantity'],
					"DATE_CREATION_SF" => date("Y-m-d H:i:s"),
					"SHIFT_ID_S" => $shift,
					"CREATED_BY_SF" => $order['CREATED_BY'],
					"REF_ARTICLE_BARCODE_SF" => $myitem['CODEBAR_ARTICLE'],
					"UNIT_PRICE_SF" => $myitem['PRIX_DE_VENTE_ARTICLE'],
					"TOTAL_PRICE_SF" => $total_with_discount,
					"REF_PROVIDER_SF" => 0
				);
				$this->db->insert($table_article_flow, $dataArticleFlow);
			}
		}

		echo json_encode(array(
			"status" => "ok"
		));
		exit;
	}


	// public function delete()
	// {

	//         //$store=$this->input->post('store');
	//         $id = $this->input->post('ID_COMMANDE');
	//         $user = $this->input->post('USER');


	//         $remove = false;
	//         $remove = $this->db->query('update pos_ibi_commandes SET DELETED_STATUS_POS_IBI_COMMANDES=1,DELETED_DATE_POS_IBI_COMMANDES="' .date('Y-m-d'). '", DELETED_USER_POS_IBI_COMMANDES="' .$user .'" WHERE ID_POS_IBI_COMMANDES="' . $id .'"' );

	//         if ($remove) {
	//             $order = $this->db->select('*')->from('pos_ibi_commandes')
	//                 ->where('ID_POS_IBI_COMMANDES', $id)
	//                 ->get()->result()[0];


	//             $products = $this->db->select('*')->from('pos_ibi_commandes_produits')
	//                 ->where('pos_IBI_COMMANDES_ID', $id)
	//                 ->get()->result_array();

	//                 //       var_dump($products);
	//                 // exit;
	//             if (sizeof($products) > 0) {
	//                 for ($rr = 0; $rr < sizeof($products); $rr++) {
	//                     $myitem = $products[$rr];

	//                 }

	//             }

	//             set_message(cclang('has_been_deleted', 'articles'), 'success');
	//         }

	//         echo json_encode(array("done" => true));
	//         exit;

	// }

	public function save_commande($table_name, $order)
	{
		$connected_user = CI_Controller::get_instance()->session->userdata('id');
		$p_file_id = empty($order['client_file_id']) ? $order['client_file_id'] : $order['client_file_id'];
		$this->db->select("*");
		$this->db->from('aauth_users');
		$this->db->where("id", $connected_user);
		$res = $this->db->get()->result();

		// $table_name = "pos_store_2_ibi_commandes";
		$year = date("Y");
		$last = $this->db->select("*")
			->from($table_name)
			->where('YEAR(DATE_CREATION_POS_IBI_COMMANDES)', $year)
			->order_by('ID_POS_IBI_COMMANDES', 'DESC')
			->limit(1)
			->get()->result();
		$code_next = 1;
		$zeros = "0000";

		if (sizeof($last) > 0) {

			$iter = strlen($last[0]->ID_POS_IBI_COMMANDES);

			$code_next = $last[0]->ID_POS_IBI_COMMANDES + 1;
			$zeros = "";
			while ($iter < 5) {
				$zeros = $zeros . "0";
				$iter++;
			}
		}
		$code = $zeros . $code_next . '/' . date('m/y');
		$shift = $this->db->query('SELECT ID_SHIFT FROM `cashier_shifts` WHERE SHIFT_STATUS=0')->row()->ID_SHIFT;

		$data = array(
			"CODE" => 'VEN' . $code,
			"CLIENT_ID_COMMANDE" => $order['ID_CLIENT'],
			"TABLE_ID" => $order['TABLE_ID'],
			"CLIENT_FILE_ID_POS_IBI_COMMANDES" => $p_file_id,
			"ID_CASHIER_SHIFT" => $shift,
			"CREATED_BY_POS_IBI_COMMANDES" => $order['CREATED_BY'],
			"DATE_CREATION_POS_IBI_COMMANDES" => date("Y-m-d H:i:s"),
			"DATE_MOD_POS_IBI_COMMANDES" => date("Y-m-d H:i:s")
		);

		//Detection de quantite des ingredients

		$this->db->insert($table_name, $data);
		$last_id = $this->db->insert_id();
		return [$last_id, 'VEN' . $code];
	}


	public function save_commande_s($table_name, $order)
	{
		$connected_user = CI_Controller::get_instance()->session->userdata('id');
		$p_file_id = empty($order['client_file_id']) ? $order['client_file_id'] : $order['client_file_id'];
		$this->db->select("*");
		$this->db->from('aauth_users');
		$this->db->where("id", $connected_user);
		$res = $this->db->get()->result();

		// $table_name = "pos_store_2_ibi_commandes";
		$year = date("Y");
		$last = $this->db->select("*")
			->from($table_name)
			->where('YEAR(DATE_CREATION_POS_IBI_COMMANDES)', $year)
			->order_by('ID_POS_IBI_COMMANDES', 'DESC')
			->limit(1)
			->get()->result();
		$code_next = 1;
		$zeros = "0000";

		if (sizeof($last) > 0) {

			$iter = strlen($last[0]->ID_POS_IBI_COMMANDES);

			$code_next = $last[0]->ID_POS_IBI_COMMANDES + 1;
			$zeros = "";
			while ($iter < 5) {
				$zeros = $zeros . "0";
				$iter++;
			}
		}
		$code = $zeros . $code_next . '/' . date('m/y');
		$shift = $this->db->query('SELECT ID_SHIFT FROM `cashier_shifts` WHERE SHIFT_STATUS=0')->row()->ID_SHIFT;

		$data = array(
			"CODE" => 'VEN' . $code,
			"CLIENT_ID_COMMANDE" => $order['ID_CLIENT'],
			"CLIENT_FILE_ID_POS_IBI_COMMANDES" => $p_file_id,
			"ID_CASHIER_SHIFT" => $shift,
			"CREATED_BY_POS_IBI_COMMANDES" => $order['CREATED_BY'],
			"DATE_CREATION_POS_IBI_COMMANDES" => date("Y-m-d H:i:s"),
			"DATE_MOD_POS_IBI_COMMANDES" => date("Y-m-d H:i:s")
		);

		//Detection de quantite des ingredients

		for ($i = 0; $i < count($order['items']); $i++) {
			$myitem = $order['items'][$i];

			$this->db->query('SELECT art.QUANTITY_ARTICLE AS qty
							FROM  pos_store_' . $myitem['store_id'] . '_ibi_articles art
							WHERE art.ID_ARTICLE="' . $myitem['ID_ARTICLE'] . '" 
							');
		}

		$this->db->insert($table_name, $data);
		$last_id = $this->db->insert_id();
		return [$last_id, 'VEN' . $code];
	}


	public function check_shift_get()
	{
		$shift = $this->db->query('SELECT * FROM cashier_shifts WHERE SHIFT_STATUS=0');

		if ($shift->num_rows() > 0) {
			$this->response([
				'status' => true,
				'id' => $shift->row()->ID_SHIFT
			]);
		} else {
			$this->response([
				'status' => false,
			]);
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/api/User.php */