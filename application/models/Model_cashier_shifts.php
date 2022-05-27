<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cashier_shifts extends MY_Model {

	private $primary_key 	= 'ID_SHIFT';
	private $table_name 	= 'cashier_shifts';
	private $field_search 	= ['SHIFT_START', 'SHIFT_END', 'SHIFT_STATUS', 'CREATED_BY_SHIFT'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($status,$q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "cashier_shifts.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "cashier_shifts.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "cashier_shifts.".$field . " LIKE '%" . $q . "%' )";
        }


	$this->db->select('*');


		if($status !=''){
        $this->db->where('cashier_shifts.SHIFT_STATUS='.$status);

	   }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($status,$q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "cashier_shifts.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "cashier_shifts.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "cashier_shifts.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('cashier_shifts.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
       // $this->db->where('CREATED_BY_SHIFT', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_cashier_shifts.php */
/* Location: ./application/models/Model_cashier_shifts.php */