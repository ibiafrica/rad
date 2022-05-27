<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_ibi_clients extends MY_Model {

	private $primary_key 	= 'ID_CLIENT';
	private $table_name 	= 'pos_ibi_clients';
	private $field_search 	= ['NOM_CLIENT', 'TEL_CLIENT', 'TEL_2_CLIENT', 'EMAIL_CLIENT', 'ASSUGETI_TVA_CLIENT', 'STATE_CLIENT', 'COUNTRY_CLIENT', 'CITY_CLIENT', 'QUARTIER_CLIENT', 'ADRESSE_CLIENT', 'BP_CLIENT', 'DATE_CREATION_CLIENT', 'REF_GROUP_CLIENT', 'FILES_CLIENT'];

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
	                $where .= "pos_ibi_clients.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_clients.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_clients.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "pos_ibi_clients.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_clients.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_clients.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_ibi_clients.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('pays', 'pays.ID_PAYS = pos_ibi_clients.COUNTRY_CLIENT', 'LEFT');
        $this->db->join('ville', 'ville.ID_VILLE = pos_ibi_clients.CITY_CLIENT', 'LEFT');
        $this->db->join('quartier', 'quartier.ID_QUARTIER = pos_ibi_clients.QUARTIER_CLIENT', 'LEFT');
        $this->db->join('pos_ibi_clients_groups', 'pos_ibi_clients_groups.ID_GROUP = pos_ibi_clients.REF_GROUP_CLIENT', 'LEFT');
        $this->db->join('files', 'files.ID_FILE = pos_ibi_clients.FILES_CLIENT', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        $this->db->where('AUTHOR_CLIENT', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_pos_ibi_clients.php */
/* Location: ./application/models/Model_pos_ibi_clients.php */