<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_factures extends MY_Model {

	private $primary_key 	= 'ID_FACTURE';
	private $table_name 	= 'factures';
	private $field_search 	= ['PATIENT_FILE_ID_FACTURE', 'NUMERO_FACTURE', 'STORE_ID_FACTURE', 'DATE_CREATION_FACTURE', 'CREATED_BY_FACTURE'];

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
	                $where .= "factures.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "factures.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "factures.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "factures.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "factures.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "factures.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->where("DELETED_STATUS_FACTURE=0");
        $this->db->limit($limit, $offset);
        $this->db->order_by('factures.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('patient_file', 'patient_file.PATIENT_FILE_ID = factures.PATIENT_FILE_ID_FACTURE AND patient_file.DELETED_STATUS_PATIENT_FILE=0');
		$this->db->join('hospital_ibi_societes', 'hospital_ibi_societes.ID_SOCIETE = patient_file.REF_SOCIETE', 'LEFT');
		$this->db->join('patients', 'patients.ID_PATIENT = patient_file.PATIENT_ID', 'LEFT');
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('CREATED_BY_FACTURE', get_user_data('id'));
        // $this->db->where('MODIFIED_BY_FACTURE', get_user_data('id'));
        
        return $this;
	}
	 
		public function get_one_only($id)
	{
		$this->join_avaiable()->filter_avaiable(); 
		$this->db->where('DELETED_STATUS_FACTURE=0');
		$this->db->where($this->primary_key.'='.$id); 
		$query = $this->db->get($this->table_name);

		return $query->row();
	}

}

/* End of file Model_factures.php */
/* Location: ./application/models/Model_factures.php */