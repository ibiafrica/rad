<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_ibi_inventaires extends MY_Model {

	private $primary_key 	= 'ID_INVENTAIRE';
	//private $table_name 	= 'pos_store_1_ibi_inventaires';
	private $field_search 	= ['TITRE_INVENTAIRE', 'DESCRIPTION_INVENTAIRE', 'VALUE_INVENTAIRE', 'ITEMS_INVENTAIRE', 'TYPE_INVENTAIRE', 'REF_PROVIDERS_INVENTAIRE', 'DATE_CREATION_INVENTAIRE', 'CREATED_BY_INVENTAIRE'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name(),
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}
		public function table_name(){
       $store_prefix = $this->uri->segment(2);
       $table_name     = 'pos_store_'.$store_prefix.'_ibi_inventaires';
       return $table_name;
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
	                $where .= "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name());

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
	                $where .= "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('pos_ibi_fournisseurs', 'pos_ibi_fournisseurs.ID_FOURNISSEUR = '.$this->table_name().'.REF_PROVIDERS_INVENTAIRE', 'LEFT');
         $this->db->join('aauth_users', 'aauth_users.id ='.$this->table_name().'.CREATED_BY_INVENTAIRE', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('CREATED_BY_INVENTAIRE', get_user_data('id'));
        // $this->db->where('MODIFIED_BY_INVENTAIRE', get_user_data('id'));
        
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

}

/* End of file Model_pos_store_1_ibi_inventaires.php */
/* Location: ./application/models/Model_pos_store_1_ibi_inventaires.php */