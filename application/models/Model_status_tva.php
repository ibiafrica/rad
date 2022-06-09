<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_status_tva extends MY_Model {

	private $primary_key 	= 'ID_TVA';
	private $table_name 	= 'status_tva';
	private $field_search 	= ['TVA_PERCENT', 'TVA_DESCRIPTION', 'TVA_CEREATE_BY', 'TVA_DATE_CREATION'];

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
	                $where .= "status_tva.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "status_tva.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "status_tva.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('TVA_STATUS',0);
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
	                $where .= "status_tva.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "status_tva.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "status_tva.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('TVA_STATUS',0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('status_tva.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        //$this->db->where('TVA_CEREATE_BY', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_status_tva.php */
/* Location: ./application/models/Model_status_tva.php */