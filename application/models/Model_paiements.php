<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_paiements extends MY_Model {

	private $primary_key 	= 'ID_PAIEMENT';
	private $table_name 	= 'pos_ibi_commandes_paiements';
	private $field_search 	= ['REF_COMMAND_CODE_PAIEMENT', 'MONTANT_PAIEMENT', 'AUTHOR_PAIEMENT', 'DATE_CREATION_PAIEMENT', 'PAYMENT_TYPE_PAIEMENT', 'NUMERO_CHEQUE_PAIEMENT', 'NAME_BANQUE_PAIEMENT', 'NUMERO_BORDEREAU_PAIEMENT', 'NUMERO_RECU_PAIEMENT', 'ROLE_PAIEMENT', 'STORE_BY_PAIEMENT'];

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
	                $where .= "pos_ibi_commandes_paiements.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_commandes_paiements.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_commandes_paiements.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "pos_ibi_commandes_paiements.".$field . " LIKE '%" . $q . "%' ";
	                // $where .= "OR " . "pos_ibi_clients.NOM_CLIENT LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_commandes_paiements.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_commandes_paiements.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_ibi_commandes_paiements.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
         $this->db->where('STORE_BY_PAIEMENT', $this->uri->segment(4));
        return $this;
    }

}

/* End of file Model_paiements.php */
/* Location: ./application/models/Model_paiements.php */