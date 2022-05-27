<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_store_2_ibi_proforma extends MY_Model {

	private $primary_key 	= 'ID_PROFORMA';
	private $table_name 	= 'pos_store_2_ibi_proforma';
	private $field_search 	= ['TITRE_PROFORMA', 'CODE_PROFORMA', 'REF_CLIENT_PROFORMA', 'TYPE_PROFORMA', 'DATE_CREATION_PROFORMA', 'DATE_MOD_PROFORMA', 'PAYMENT_TYPE_PROFORMA', 'AUTHOR_PROFORMA', 'SOMME_PERCU_PROFORMA', 'TOTAL_PROFORMA', 'DISCOUNT_TYPE_PROFORMA', 'TVA_PROFORMA', 'GROUP_DISCOUNT_PROFORMA', 'REF_SHIPPING_ADDRESS_PROFORMA', 'SHIPPING_AMOUNT_PROFORMA', 'TYPE_DELAY_PROFORMA', 'TEMPS_DELAY_PROFORMA', 'COND_PAID_PROFORMA', 'PERCENT_PAID_PROFORMA', 'PERCENT_PAID_LIVR_PROFORMA', 'VALID_OFFRE_PROFORMA'];

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
	               // $where .= "pos_store_2_ibi_proforma.".$field . " LIKE '%" . $q . "%' ";

     $where .= "  pos_store_2_ibi_proforma.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'";
    $this->db->where('TYPE_PROFORMA','ibi_proforma_dv');


	            } else {
	                $where .= "OR " . "pos_store_2_ibi_proforma.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_proforma.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
          $this->db->where('TYPE_PROFORMA','ibi_proforma_dv');
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
	                //$where .= "pos_store_2_ibi_proforma.".$field . " LIKE '%" . $q . "%' ";

                  $where .= "  pos_store_2_ibi_proforma.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'";

	            } else {
	                $where .= "OR " . "pos_store_2_ibi_proforma.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_proforma.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('TYPE_PROFORMA','ibi_proforma_dv');
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_store_2_ibi_proforma.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT = pos_store_2_ibi_proforma.REF_CLIENT_PROFORMA', 'LEFT');

        $this->db->join('aauth_users', 'aauth_users.id = pos_store_2_ibi_proforma.AUTHOR_PROFORMA', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_pos_store_2_ibi_proforma.php */
/* Location: ./application/models/Model_pos_store_2_ibi_proforma.php */