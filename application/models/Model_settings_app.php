<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_settings_app extends MY_Model {

	private $primary_key 	= 'ID_SETTING';
	private $table_name 	= 'settings_app';
	private $field_search 	= ['NOM_ENTREPRISE', 'NIF_ENTREPRISE', 'RC_ENTREPRISE', 'QUARTIER_ENTREPRISE', 'AVENUE_ENTREPRISE'];

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
	                $where .= "settings_app.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "settings_app.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "settings_app.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "settings_app.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "settings_app.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "settings_app.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('settings_app.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        $this->db->where('CREATED_BY', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_settings_app.php */
/* Location: ./application/models/Model_settings_app.php */