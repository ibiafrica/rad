<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_POS_ibi_commandes extends MY_Model
{

	private $primary_key 	= 'ID_POS_IBI_COMMANDES';
	private $table_name 	= 'pos_ibi_commandes';
	private $field_search 	= ['COMMANDE_STATUS', 'CODE', 'CLIENT_ID_COMMANDE', 'DATE_CREATION_POS_IBI_COMMANDES', 'STATUS_OBR', 'CREATED_BY_POS_IBI_COMMANDES', 'DELETED_STATUS_POS_IBI_COMMANDES'];

	private $primary_key_facture 	= 'ID_FACT_RESERVER';
	private $table_name_facture 	= 'facturer_reserver';
	private $field_search_facture 	= ['CODE_FACT_RESERVER', 'MONTANT_FACT_RESERVER', 'DATE_FACT_RESERVER'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
			'table_name' 	=> $this->table_name,
			'field_search' 	=> $this->field_search,

			'primary_key_facture' 	=> $this->primary_key_facture,
			'table_name_facture' 	=> $this->table_name_facture,
			'field_search_facture' 	=> $this->field_search_facture,
		);



		parent::__construct($config);
	}

	public function count_all($debut = null, $fin = null, $shift = null, $type = null, $q = null, $status = null, $field = null)
	{
		if ($type=='') {
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' ";
					// $where .= "AND pos_ibi_commandes.COMMANDE_STATUS ='".$status."'";

				}
				$iterasi++;
			}

			$where .= "AND pos_ibi_commandes.COMMANDE_STATUS ='" . $status . "'";
			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->where("DELETED_STATUS_POS_IBI_COMMANDES", 0);
		if ($shift != '') {
			$this->db->where('pos_ibi_commandes.ID_CASHIER_SHIFT=' . $shift);
		} else {
			if ($debut != '' && $fin  != '') {

				$debut = $debut . ' 00:00:00';
				$fin = $fin . ' 23:59:59';
				$this->db->where('pos_ibi_commandes.DATE_CREATION_POS_IBI_COMMANDES BETWEEN "' . $debut . '" AND "' . $fin . '"');
			}
		}

		// $this->db->limit($limit, $offset);
		//$this->db->group_by('POS_IBI_COMMANDES_ID');
		$this->db->order_by('pos_ibi_commandes.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}
	else{

      $iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		// if (is_array($select_field) AND count($select_field)) {
		$this->db->select(' * ');
		$this->db->from('pos_ibi_commandes c,pos_store_1_ibi_articles_stock_flow f,pos_store_1_ibi_articles art,categories ca');
	
		if ($status != '') {
			$this->db->where('c.COMMANDE_STATUS=' . $status);
		}

		if ($shift != '') {
			$this->db->where('c.ID_CASHIER_SHIFT=' . $shift);
		}

		if ($debut != '' && $fin  != '') {

			$debut = $debut . ' 00:00:00';
			$fin = $fin . ' 23:59:59';
			$this->db->where('f.DATE_CREATION_SF BETWEEN "' . $debut . '" AND "' . $fin . '"');
		}

		$this->db->where("c.DELETED_STATUS_POS_IBI_COMMANDES", 0);
		$this->db->where("c.CODE=f.REF_COMMAND_CODE_SF");
		$this->db->where("f.REF_ARTICLE_BARCODE_SF=art.CODEBAR_ARTICLE");
		$this->db->where("art.REF_CATEGORIE_ARTICLE=ca.ID_CATEGORIE");


		$querys = $this->db->get();
		return $querys->row();
	   }

	}

	public function get($debut = null, $fin = null, $shift = null,$type = null, $q = null, $field = null, $status = null, $limit = 0, $offset = 0, $select_field = [])
	{
		if ($type=='') {
			
		
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' )";
		}

		// if (is_array($select_field) AND count($select_field)) {
		$this->db->select('TABLE_ID, ID_POS_IBI_COMMANDES,PRINT_COUNT,COMMANDE_STATUS,CODE,STATUS_OBR,CLIENT_ID_COMMANDE, DATE_CREATION_POS_IBI_COMMANDES, CREATED_BY_POS_IBI_COMMANDES, DELETED_STATUS_POS_IBI_COMMANDES, ');
		//  }

		if ($status != '') {
			$this->db->where('pos_ibi_commandes.COMMANDE_STATUS=' . $status);
		}

		if ($shift != '') {
			$this->db->where('pos_ibi_commandes.ID_CASHIER_SHIFT=' . $shift);
		} else {
			if ($debut != '' && $fin  != '') {

				$debut = $debut . ' 00:00:00';
				$fin = $fin . ' 23:59:59';
				$this->db->where('pos_ibi_commandes.DATE_CREATION_POS_IBI_COMMANDES BETWEEN "' . $debut . '" AND "' . $fin . '"');
			}
		}




		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->where("DELETED_STATUS_POS_IBI_COMMANDES", 0);
		$this->db->limit($limit, $offset);
		// $this->db->group_by('POS_IBI_COMMANDES_ID');
		$this->db->order_by('pos_ibi_commandes.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);
		// var_dump($query->result());
		// exit;

		return $query->result();

	}elseif ($type=1) {

   $iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		// if (is_array($select_field) AND count($select_field)) {
		$this->db->select(' * ');
		$this->db->from('pos_ibi_commandes c,pos_store_1_ibi_articles_stock_flow f,pos_store_1_ibi_articles art,categories ca');
	
		if ($status != '') {
			$this->db->where('c.COMMANDE_STATUS=' . $status);
		}

		if ($shift != '') {
			$this->db->where('c.ID_CASHIER_SHIFT=' . $shift);
		}

		if ($debut != '' && $fin  != '') {

			$debut = $debut . ' 00:00:00';
			$fin = $fin . ' 23:59:59';
			$this->db->where('c.DATE_CREATION_POS_IBI_COMMANDES BETWEEN "' . $debut . '" AND "' . $fin . '"');
		}

		$this->db->where("c.DELETED_STATUS_POS_IBI_COMMANDES", 0);
		$this->db->where("c.CODE=f.REF_COMMAND_CODE_SF");
		$this->db->where("f.REF_ARTICLE_BARCODE_SF=art.CODEBAR_ARTICLE");
		$this->db->where("art.REF_CATEGORIE_ARTICLE=ca.ID_CATEGORIE");
		$this->db->order_by("c.DATE_CREATION_POS_IBI_COMMANDES", "DESC");

		//$this->db->limit($limit=10000, $offset);



		$querys = $this->db->get();


		return $querys->result();
		//dump($this->db->last_query());die;
	   }


      //$queryss->result();

	   //dump($this->db->last_query());
	}




	public function get_total_header($debut = null, $fin = null, $shift = null, $q = null, $field = null, $status = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		// if (is_array($select_field) AND count($select_field)) {
		$this->db->select(' SUM(cp.PRIX_TOTAL) as total');
		$this->db->from('pos_ibi_commandes c,pos_ibi_commandes_produits cp');
		// $$this->db->wherw
		// cp.POS_IBI_COMMANDES_ID=c.ID_POS_IBI_COMMANDES AND c.COMMANDE_STATUS=2');
		//  }

		if ($status != '') {
			$this->db->where('c.COMMANDE_STATUS=' . $status);
		}

		if ($shift != '') {
			$this->db->where('c.ID_CASHIER_SHIFT=' . $shift);
		}

		if ($debut != '' && $fin  != '') {

			$debut = $debut . ' 00:00:00';
			$fin = $fin . ' 23:59:59';
			$this->db->where('pos_ibi_commandes.DATE_CREATION_POS_IBI_COMMANDES BETWEEN "' . $debut . '" AND "' . $fin . '"');
		}

		//$this->join_avaiable_to_header()->filter_avaiable();
		//$this->db->where($where);
		$this->db->where("c.DELETED_STATUS_POS_IBI_COMMANDES", 0);
		$this->db->where("c.ID_POS_IBI_COMMANDES=cp.POS_IBI_COMMANDES_ID");
		// $this->db->limit($limit, $offset);
		// $this->db->group_by('c.ID_POS_IBI_COMMANDES');
		// $this->db->order_by('c.' . $this->primary_key, "DESC");
		$query = $this->db->get();
		return $query->row();
	}



	public function count_all_void_request($debut = null, $fin = null, $shift = null, $q = null, $status = null, $field = null)
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' ";
					// $where .= "AND pos_ibi_commandes.COMMANDE_STATUS ='".$status."'";

				}
				$iterasi++;
			}

			$where .= "AND pos_ibi_commandes.COMMANDE_STATUS ='" . $status . "'";
			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);

		if ($status != '') {
			$this->db->where('pos_ibi_commandes.COMMANDE_STATUS=' . $status);
		}

		if ($shift != '') {
			$this->db->where('pos_ibi_commandes.ID_CASHIER_SHIFT=' . $shift);
		}

		if ($debut != '' && $fin  != '') {

			$this->db->where('pos_ibi_commandes.DATE_CREATION_POS_IBI_COMMANDES BETWEEN "' . $debut . '" AND "' . $fin . '"');
		}
		//$this->db->where("DELETED_STATUS_POS_IBI_COMMANDES", 0);
		//$this->db->where("COMMANDE_VOID_REQUEST=", 1);
		$this->db->where("COMMANDE_STATUS=", 0);

		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get_void_request($debut = null, $fin = null, $shift = null, $q = null, $field = null, $status = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' )";
		}

		// if (is_array($select_field) AND count($select_field)) {
		$this->db->select('ID_POS_IBI_COMMANDES,COMMANDE_STATUS,CODE,CLIENT_ID_COMMANDE,DELETED_DATE_POS_IBI_COMMANDES,DELETED_USER_POS_IBI_COMMANDES, DATE_CREATION_POS_IBI_COMMANDES, CREATED_BY_POS_IBI_COMMANDES,DELETED_COMMENT_POS_IBI_COMMANDES, DELETED_STATUS_POS_IBI_COMMANDES');
		//  }


		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);

		if ($status != '') {
			$this->db->where('pos_ibi_commandes.COMMANDE_STATUS=' . $status);
		}

		if ($shift != '') {
			$this->db->where('pos_ibi_commandes.ID_CASHIER_SHIFT=' . $shift);
		}

		if ($debut != '' && $fin  != '') {

			$this->db->where('pos_ibi_commandes.DATE_CREATION_POS_IBI_COMMANDES BETWEEN "' . $debut . '" AND "' . $fin . '"');
		}
		//$this->db->where("DELETED_STATUS_POS_IBI_COMMANDES", 0);
		//$this->db->where("COMMANDE_VOID_REQUEST=", 1);
		$this->db->where("COMMANDE_STATUS=", 0);
		$this->db->limit($limit, $offset);
		//$this->db->group_by('POS_IBI_COMMANDES_ID');
		$this->db->order_by('pos_ibi_commandes.DATE_CREATION_POS_IBI_COMMANDES', "DESC");
		$query = $this->db->get($this->table_name);
		// var_dump($query->result());
		// exit;

		return $query->result();
	}



	public function count_facture_imprimer($debut = null, $fin = null, $shift = null, $q = null, $field = null)
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' ";
					// $where .= "AND pos_ibi_commandes.COMMANDE_STATUS ='".$status."'";

				}
				$iterasi++;
			}

			// $where .= "AND pos_ibi_commandes.COMMANDE_STATUS ='" . $status . "'";
			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		//$this->db->where("DELETED_STATUS_POS_IBI_COMMANDES", 0);
		//$this->db->where("COMMANDE_VOID_REQUEST=", 0);
		$this->db->where("COMMANDE_STATUS=", 0);
		$this->db->where("PRINT_COUNT >", 0);
		if ($debut != '' && $fin  != '') {

			$debut = $debut . ' 00:00:00';
			$fin = $fin . ' 23:59:59';
			$this->db->where('pos_ibi_commandes.DATE_CREATION_POS_IBI_COMMANDES BETWEEN "' . $debut . '" AND "' . $fin . '"');
		}
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}



	public function get_facture_imprimer($debut = null, $fin = null, $shift = null, $q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_ibi_commandes." . $field . " LIKE '%" . $q . "%' )";
		}

		// if (is_array($select_field) AND count($select_field)) {
		$this->db->select('TO_WHOM, ID_POS_IBI_COMMANDES,COMMANDE_STATUS,CODE,CLIENT_ID_COMMANDE,DELETED_DATE_POS_IBI_COMMANDES,DELETED_USER_POS_IBI_COMMANDES, DATE_CREATION_POS_IBI_COMMANDES, CREATED_BY_POS_IBI_COMMANDES, DELETED_STATUS_POS_IBI_COMMANDES');
		//  }

		// if ($status != '') {
		// 	$this->db->where('pos_ibi_commandes.COMMANDE_STATUS=' . $status);
		// }

		if ($shift != '') {
			$this->db->where('pos_ibi_commandes.ID_CASHIER_SHIFT=' . $shift);
		}

		if ($debut != '' && $fin  != '') {

			$debut = $debut . ' 00:00:00';
			$fin = $fin . ' 23:59:59';
			$this->db->where('pos_ibi_commandes.DATE_CREATION_POS_IBI_COMMANDES BETWEEN "' . $debut . '" AND "' . $fin . '"');
		}


		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		//$this->db->where("DELETED_STATUS_POS_IBI_COMMANDES", 0);
		//$this->db->where("COMMANDE_VOID_REQUEST=", 0);
		$this->db->where("COMMANDE_STATUS=", 0);
		$this->db->where("PRINT_COUNT >", 0);
		$this->db->limit($limit, $offset);
		//$this->db->group_by('POS_IBI_COMMANDES_ID');
		$this->db->order_by('pos_ibi_commandes.DATE_CREATION_POS_IBI_COMMANDES', "DESC");
		$query = $this->db->get($this->table_name);
		// var_dump($query->result());
		// exit;

		return $query->result();
	}

	//get commande status
	public function get_commande_status_rapport($status)
	{

		$this->db->select('TO_WHOM, ID_POS_IBI_COMMANDES,COMMANDE_STATUS,CODE,CLIENT_ID_COMMANDE, DATE_CREATION_POS_IBI_COMMANDES, CREATED_BY_POS_IBI_COMMANDES, DELETED_STATUS_POS_IBI_COMMANDES, ');
		$this->join_avaiable()->filter_avaiable();
		$this->db->where('pos_ibi_commandes.COMMANDE_STATUS=' . $status);
		$this->db->where("DELETED_STATUS_POS_IBI_COMMANDES", 0);
		$this->db->group_by('POS_IBI_COMMANDES_ID');
		$this->db->order_by('pos_ibi_commandes.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}




	public function join_avaiable()
	{
		$this->db->join('pos_clients', 'pos_clients.ID_CLIENT = pos_ibi_commandes.CLIENT_ID_COMMANDE', 'LEFT');
		// $this->db->join('pos_clients pos_clients1', 'pos_clients1.ID_CLIENT = pos_ibi_commandes.CLIENT_FILE_ID_POS_IBI_COMMANDES', 'LEFT');

		$this->db->join('aauth_users', 'aauth_users.id = pos_ibi_commandes.CREATED_BY_POS_IBI_COMMANDES', 'LEFT');

		return $this;
	}


	public function join_avaiables()
	{
		$this->db->join('pos_clients', 'pos_clients.ID_CLIENT = pos_ibi_commandes.CLIENT_ID_COMMANDE', 'LEFT');
		// $this->db->join('pos_clients pos_clients1', 'pos_clients1.ID_CLIENT = pos_ibi_commandes.CLIENT_FILE_ID_POS_IBI_COMMANDES', 'LEFT');

		$this->db->join('aauth_users', 'aauth_users.id = pos_ibi_commandes.CREATED_BY_POS_IBI_COMMANDES', 'LEFT');

		return $this;
	}

	public function join_avaiable_to_header()
	{

		$this->db->join('pos_ibi_commandes_produits', 'pos_ibi_commandes_produits.POS_IBI_COMMANDES_ID = pos_ibi_commandes.ID_POS_IBI_COMMANDES', 'LEFT');

		return $this;
	}


	public function filter_avaiable()
	{

		return $this;
	}



	public function Detail_commande($id)
	{
		# code...
		$commande = $this->db->query('SELECT c.* FROM pos_ibi_commandes c WHERE  c.ID_POS_IBI_COMMANDES=' . $id . ' ')->result();
		return $commande;
	}

	public function Commande_paiement($commande_id)
	{
		$getCommande = $this->db->query("SELECT * FROM pos_ibi_commandes where ID_POS_IBI_COMMANDES = $commande_id")->result()[0];
		$paiement = $this->db->query("SELECT c.*,cp.*,m.* FROM pos_ibi_commandes c,pos_paiements cp,mode_paiement m WHERE cp.COMMANDE_CODE=c.CODE AND m.ID_MODE_PAIEMENT=cp.MODE_PAIEMENT AND c.CODE='$getCommande->CODE'")->result();
		return $paiement;
	}

	public function Commande_status($cmd)
	{
		$status = $this->db->get_where('pos_ibi_commandes', array('ID_POS_IBI_COMMANDES' => $cmd))->row()->COMMANDE_STATUS;
		return $status;
	}


	public function Commande_paiement_count_montant($commande_id)
	{
		# code...
		$paiement = $this->db->query('SELECT SUM(MONTANT_PAIEMENT) as Total FROM `pos_paiements` WHERE COMMANDE_ID=' . $commande_id . ' AND STATUT_ANNULATION =0 ')->row();
		return $paiement;
	}

	public function Commande_paiement_count_montant_total($commande_id)
	{
		# code...
		$paiement = $this->db->query('SELECT SUM(cp.PRIX_TOTAL) as prix_total FROM pos_ibi_commandes_produits cp WHERE cp.POS_IBI_COMMANDES_ID=' . $commande_id . '
  ')->row();
		return $paiement;
	}

	public function Commande_paiement_count_montant_total_res($commande_id)
	{
		# code...
		$paiement = $this->db->query('SELECT SUM(cp.MONTANT_PAIEMENT) as prix_total_res FROM pos_paiements cp WHERE cp.COMMANDE_ID=' . $commande_id . ' AND cp.STATUT_ANNULATION =0
  ')->row();
		return $paiement;
	}


	public function get_total_product($product_ids, $store_id)
	{

		// $recuperer_profil_client=$this->db->get_where('autotec_ibi_clients',array('ID'=>$client_id))->row();

		$this->db->SELECT("a.* ");
		$this->db->FROM("pos_store_" . $store_id . "_ibi_articles a");
		$this->db->where('a.ID_ARTICLE', $product_ids);
		$product_information = $this->db->get()->row();

		$data2 = array(
			'PRIX_DE_VENTE_ARTICLE' => $product_information->PRIX_DE_VENTE_ARTICLE,
			'DESIGN_ARTICLE' 	=> $product_information->DESIGN_ARTICLE,
			'ID_ARTICLE' => $product_information->ID_ARTICLE,
			'CODEBAR_ARTICLE' => $product_information->CODEBAR_ARTICLE,
			'QUANTITY_ARTICLE' => $product_information->QUANTITY_ARTICLE,
		);
		return $data2;
	}



	public function suppression($table, $critere = array())
	{
		$this->db->where($critere);
		$query = $this->db->delete($table);
		if ($query) {
			return TRUE;
		}
	}


	public function modification($table, $critere = array(), $data = array())
	{
		$this->db->where($critere);
		$query = $this->db->update($table, $data);
		if ($query) {
			return TRUE;
		}
	}



	public function count_all_facture($q = null, $field = null)
	{
		$iterasi = 1;
		$num = count($this->field_search_facture);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search_facture as $field) {
				if ($iterasi == 1) {
					$where .= "facturer_reserver." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "facturer_reserver." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "facturer_reserver." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable_facture()->filter_avaiable_facture();
		$this->db->where($where);
		$this->db->where('DELETE_STATUS', 0);
		$query = $this->db->get($this->table_name_facture);

		return $query->num_rows();
	}




	public function get_facture($q = null, $field = null, $limit = 0, $offset = 0, $select_field_facture = [])
	{
		$iterasi = 1;
		$num = count($this->field_search_facture);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search_facture as $field) {
				if ($iterasi == 1) {
					$where .= "facturer_reserver." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "facturer_reserver." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "facturer_reserver." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field_facture) and count($select_field_facture)) {
			$this->db->select($select_field_facture);
		}

		$this->join_avaiable_facture()->filter_avaiable_facture();
		$this->db->where($where);
		$this->db->where('DELETE_STATUS', 0);
		$this->db->limit($limit, $offset);
		$this->db->order_by('facturer_reserver.' . $this->primary_key_facture, "DESC");
		$query = $this->db->get($this->table_name_facture);

		return $query->result();
	}

	public function join_avaiable_facture()
	{
		$this->db->join('pos_clients', 'pos_clients.ID_CLIENT = facturer_reserver.ID_CLIENT', 'LEFT');
		$this->db->join('pos_ibi_commandes', 'pos_ibi_commandes.ID_POS_IBI_COMMANDES = facturer_reserver.ID_FACTURE', 'LEFT');
		$this->db->join('aauth_users', 'aauth_users.id = facturer_reserver.CREATE_BY_FACT_RESERVER', 'LEFT');

		return $this;
	}

	public function filter_avaiable_facture()
	{

		return $this;
	}


	function RESERVATION($table, $data)
	{
		$query = $this->db->insert($table, $data);
		return ($query) ? true : false;
	}
}

/* End of file Model_POS_ibi_commandes.php */
/* Location: ./application/models/Model_POS_ibi_commandes.php */