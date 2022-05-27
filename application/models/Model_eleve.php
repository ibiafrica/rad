<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_eleve extends MY_Model {

	private $primary_key 	= 'id';
	private $table_name 	= 'eleve';
	private $field_search 	= ['nom', 'age', 'classe', 'created_by'];

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
	                $where .= "eleve.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "eleve.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "eleve.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "eleve.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "eleve.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "eleve.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('eleve.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('blog', 'blog.id = eleve.classe', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        $this->db->where('created_by', get_user_data('id'));
        //$this->db->where('modified_by', get_user_data('id'));
        
        return $this;
    }

     //Recuperer les identifiants de l'utilisateur

    public function get_user_info($table_name,$id,$contrainte){
    	$get_info=$this->db->query("select * from ".$table_name." where ".$contrainte."=".$id."");
    	if($get_info->num_rows()>0){
    		return $get_info->result();
    	}
    	else{
    		return null;
    	}
    }

}

/* End of file Model_eleve.php */
/* Location: ./application/models/Model_eleve.php */