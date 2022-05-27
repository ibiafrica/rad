<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_categorie_flux_caisse extends MY_Model {

	private $primary_key 	= 'ID_CATEGORIE';
	private $table_name 	= 'pos_categorie_flux_caisse';
	private $field_search 	= ['NOM_CATEGORIE', 'CREATE_BY_CATEGORIE', 'DATE_CREATE_CATEGORIE'];

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
	                $where .= "pos_categorie_flux_caisse.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_categorie_flux_caisse.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_categorie_flux_caisse.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_CATEGORIE',0);
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
	                $where .= "pos_categorie_flux_caisse.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_categorie_flux_caisse.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_categorie_flux_caisse.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_CATEGORIE',0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_categorie_flux_caisse.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        //$this->db->where('CREATE_BY_CATEGORIE', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_pos_categorie_flux_caisse.php */
/* Location: ./application/models/Model_pos_categorie_flux_caisse.php */