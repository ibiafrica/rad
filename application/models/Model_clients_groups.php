<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_clients_groups extends MY_Model {

	private $primary_key 	= 'ID_GROUP';
	private $table_name 	= 'pos_ibi_clients_groups';
	private $field_search 	= ['NAME_GROUP', 'DESCRIPTION_GROUP', 'DISCOUNT_TYPE_GROUP', 'DISCOUNT_PERCENT_GROUP', 'DISCOUNT_AMOUNT_GROUP', 'DISCOUNT_ENABLE_SCHEDULE_GROUP', 'DISCOUNT_START_GROUP', 'DISCOUNT_END_GROUP', 'AUTHOR_GROUP'];

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
	                $where .= "pos_ibi_clients_groups.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_clients_groups.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_clients_groups.".$field . " LIKE '%" . $q . "%' )";
        }

		// $this->join_avaiable()->filter_avaiable();
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
	                $where .= "pos_ibi_clients_groups.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_clients_groups.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_clients_groups.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_ibi_clients_groups.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('remise', 'remise.ID = pos_ibi_clients_groups.DISCOUNT_TYPE_GROUP', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('AUTHOR_GROUP', get_user_data('id'));
        
        return $this;
    }

}

/* End of file model_clients_groups.php */
/* Location: ./application/models/model_clients_groups.php */