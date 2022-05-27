<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_fournisseurs extends MY_Model {

	private $primary_key 	= 'ID';
	private $table_name 	= 'pos_ibi_fournisseurs';
	private $field_search 	= ['NOM', 'BP', 'NUMBER_COMPTE', 'TEL', 'EMAIL', 'AUTHOR', 'DESCRIPTION'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}
	// jdhf

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
	                $where .= "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_ibi_fournisseurs.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('AUTHOR', get_user_data('id'));
        
        return $this;
    }

     public function getrows(array $row)
    {
        return new Customer([
            'nom' => $row["0"],
            'bp' => $row["1"],
            'tel' => $row["2"],
            'email' => $row["3"],
            'description' => $row["4"],
            
        ]);
    }


    public function get_user_info($table_name,$id,$contrainte){
    	$get_info=$this->db->query("select * from ".$table_name." where ".$contrainte."=".$id."");
    	if($get_info->num_rows()>0){
    		return $get_info->result();
    	}
    	else{
    		return 0;
    	}
    }

}

/* End of file model_fournisseurs.php */
/* Location: ./application/models/model_fournisseurs.php */