<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_livraison_detail extends MY_Model {

	private $primary_key 	= 'ID_LVD';
	private $table_name 	= 'livraison_detail';
	private $field_search 	= ['REF_ID_L', 'REF_ID_BL'];

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
	                $where .= "livraison_detail.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "livraison_detail.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "livraison_detail.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($id)
	{
		$this->join_avaiable()->filter_avaiable();
		$this->db->where('REF_ID_L', $id);
        $this->db->order_by('livraison_detail.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
		$this->db->join('livraison', 'livraison.ID_LIV = '.$this->table_name.'.REF_ID_L', 'LEFT');
		$this->db->join('bon_livraison', 'bon_livraison.ID_BL = '.$this->table_name.'.REF_ID_BL', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_livraison_detail.php */
/* Location: ./application/models/Model_livraison_detail.php */