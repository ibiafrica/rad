<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_ibi_stores extends MY_Model {

	private $primary_key 	= 'ID_STORE';
	private $table_name 	= ' 	pos_ibi_stores';
	private $field_search 	= ['STATUS_STORE', 'NAME_STORE', 'IMAGE_STORE', 'DESCRIPTION_STORE', 'DATE_CREATION_STORE', 'DATE_MOD_STORE', 'CREATED_BY_STORE', 'MODIFIED_BY_STORE'];

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
	                $where .= " 	pos_ibi_stores.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . " 	pos_ibi_stores.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . " 	pos_ibi_stores.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_STORE', 0);
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
	                $where .= " 	pos_ibi_stores.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . " 	pos_ibi_stores.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . " 	pos_ibi_stores.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_STORE', 0);
        $this->db->limit($limit, $offset);
        $this->db->order_by(' 	pos_ibi_stores.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('CREATED_BY_STORE', get_user_data('id'));
        // $this->db->where('MODIFIED_BY_STORE', get_user_data('id'));
        
        return $this;
    }
    function getOne($table, $criteres){
    	$this->db->where($criteres);
    	$query = $this->db->get($table);
    	return $query->row_array();
    }
    function update($table, $criteres, $data) {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }
    function insert($table,$data){
	    $query=$this->db->insert($table,$data);
	    return ($query) ? true : false;
    }
    function insert_last_id($table, $data)
	{
		$this->db->set($data);
		$query = $this->db->insert($table);
		if ($query) {
			return $this->db->insert_id();
		}
	 }
	function getList($table, $critere = array())
	{
		$this->db->where($critere);
		$query = $this->db->get($table);
		return $query->result();
	}
	function margeCalculator($criteres){
		$critere = 'INTER_X_MARGE <= '.$criteres.' AND INTER_Y_MARGE >='.$criteres.' AND DELETE_STATUS_MARGE = 0';
		$this->db->where($critere);
		$query = $this->db->get('hospital_ibi_marge');
		$pourcentage = 0;
		foreach ($query->result() as $key => $value) {
		 	$pourcentage = $value->POURCENTAGE_MARGE;
		 }
		$margeBeneficiaire = round($criteres + ($criteres * $pourcentage) / 100);
		return $margeBeneficiaire;
	}

}

/* End of file Model_ 	pos_ibi_stores.php */
/* Location: ./application/models/Model_ 	pos_ibi_stores.php */