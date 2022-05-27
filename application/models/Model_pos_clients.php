<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_pos_clients extends MY_Model
{

	private $primary_key 	= 'ID_CLIENT';
	private $table_name 	= 'pos_clients';
	private $field_search 	= ['TYPE_CLIENT_ID', 'NOM_CLIENT', 'PRENOM', 'TEL_CLIENTS', 'DATE_CREATION_CLIENT'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
			'table_name' 	=> $this->table_name,
			'field_search' 	=> $this->field_search,
		);

		parent::__construct($config);
	}

	public function count_all($q = null, $field = null)
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_clients." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_clients." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_clients." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_clients." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_clients." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_clients." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->where('DELETE_STATUS_CLIENT', 0);
		$this->db->limit($limit, $offset);
		$this->db->order_by('pos_clients.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable()
	{
		$this->db->join('pos_type_clients', 'pos_type_clients.ID_TYPE_CLIENT = pos_clients.TYPE_CLIENT_ID', 'LEFT');
		$this->db->join('client_file', 'client_file.CLIENT_ID = pos_clients.ID_CLIENT and client_file.CLIENT_FILE_STATUS = 0', 'LEFT');

		return $this;
	}

	public function filter_avaiable()
	{
		// $this->db->where('CREATED_BY_CLIENT', get_user_data('id'));

		return $this;
	}

	public function update_client($id)
	{
		$data = $this->db->query("SELECT c.*,cf.* FROM client_file cf,pos_clients c WHERE c.ID_CLIENT=cf.CLIENT_ID AND c.ID_CLIENT='" . $id . "' ")->row();

		return $data;
	}


      public function update($table,$critere = array(),$data = array()){
        $this->db->where($critere);
        $query = $this->db->update($table,$data);
        if($query){
        return TRUE;
       }
    }

	public function Cient_commande($id, $status)
	{

		$this->db->select('c.ID_pos_IBI_COMMANDES,c.COMMANDE_STATUS,CODE,c.CLIENT_ID_COMMANDE, c.DATE_CREATION_pos_IBI_COMMANDES, c.CREATED_BY_pos_IBI_COMMANDES, c.DELETED_STATUS_pos_IBI_COMMANDES,SUM(cp.PRIX_TOTAL) AS PRIX_TOTAL ');
		$this->db->from('pos_ibi_commandes c,pos_ibi_commandes_produits cp');

		if ($status != '') {
			$this->db->where('c.COMMANDE_STATUS=' . $status);
		}
		$this->db->where('c.CLIENT_ID_COMMANDE', $id);
		$this->db->where('c.ID_pos_IBI_COMMANDES=cp.pos_IBI_COMMANDES_ID');
		$this->db->group_by('c.ID_pos_IBI_COMMANDES');
		// $this->db->order_by('pos_ibi_commandes.pos_IBI_COMMANDES_ID','DESC');
		$query = $this->db->get();
		return $query->result();
	}


	public function Commande_status($cmd)
	{
		$status = $this->db->get_where('pos_ibi_commandes', array('ID_pos_IBI_COMMANDES' => $cmd))->row()->COMMANDE_STATUS;
		return $status;
	}


	public function join_avaiables()
	{
		$this->db->join('pos_ibi_commandes_produits', 'pos_ibi_commandes_produits.pos_IBI_COMMANDES_ID = pos_ibi_commandes.ID_pos_IBI_COMMANDES', 'LEFT');
		return $this;
	}

	public function filter_avaiables()
	{

		return $this;
	}


	public function Commande_paiement($commande_id)
	{
		# code...
		$paiement = $this->db->query('SELECT c.*,cp.*,m.* FROM pos_ibi_commandes c,pos_paiements cp,mode_paiement m WHERE cp.COMMANDE_ID=c.ID_pos_IBI_COMMANDES AND m.ID_MODE_PAIEMENT=cp.MODE_PAIEMENT AND c.ID_pos_IBI_COMMANDES=' . $commande_id . ' ')->result();
		return $paiement;
	}


	public function Commande_paiement_count_montant($commande_id)
	{
		# code...
		$paiement = $this->db->query('SELECT SUM(MONTANT_PAIEMENT) as Total FROM `pos_paiements` WHERE COMMANDE_ID=' . $commande_id . ' ')->row();
		return $paiement;
	}

	public function Commande_paiement_count_montant_total($commande_id)
	{
		# code...
		$paiement = $this->db->query('SELECT SUM(cp.PRIX_TOTAL) as prix_total FROM pos_ibi_commandes_produits cp WHERE cp.pos_IBI_COMMANDES_ID=' . $commande_id . '
  ')->row();
		return $paiement;
	}

	public function Commande_paiement_count_montant_total_res($commande_id)
	{
		# code...
		$paiement = $this->db->query('SELECT SUM(cp.MONTANT_PAIEMENT) as prix_total_res FROM pos_paiements cp WHERE cp.COMMANDE_ID=' . $commande_id . '
  ')->row();
		return $paiement;
	}




	public function get_commande_produits($id)
	{
		$requete = $this->db->query("SELECT cp.* FROM pos_ibi_commandes_produits cp WHERE cp.pos_IBI_COMMANDES_ID='" . $id . "' ")->result();

		return $requete;
	}
}

/* End of file Model_pos_clients.php */
/* Location: ./application/models/Model_pos_clients.php */