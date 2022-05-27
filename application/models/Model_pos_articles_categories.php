<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_articles_categories extends MY_Model {

	private $primary_key 	= 'ID_CATEGORIE';
	private $table_name 	= 'categories';
	private $field_search 	= ['STORE_ID', 'NOM_CATEGORIE', 'DESCRIPTION_CATEGORIE', 'DATE_CREATION_CATEGORIE', 'AUTHOR_CATEGORIE'];

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
		$store = $this->uri->segment(2);
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "categories.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "categories.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "categories.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_CATEGORIE',0);
        $this->db->where('STORE_ID',$store);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
		$store = $this->uri->segment(2);
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "categories.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "categories.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "categories.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_CATEGORIE',0);
		  $this->db->where('STORE_ID',$store);
        $this->db->limit($limit, $offset);
        $this->db->order_by('categories.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('pos_ibi_stores', 'pos_ibi_stores.ID_STORE = categories.STORE_ID', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
       // $this->db->where('CREATED_BY_CATEGORIE', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_pos_articles_categories.php */
/* Location: ./application/models/Model_pos_articles_categories.php */