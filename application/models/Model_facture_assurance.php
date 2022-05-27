<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_facture_assurance extends MY_Model {

	private $primary_key 	= 'ID_FACTURE_ASSURANCE';
	private $table_name 	= 'facture_assurance';
	private $field_search 	= ['NUMERO_FACTURE_ASSURANCE', 'SOCIETE_FACTURE_ASSURANCE', 'FACTURE_ASSURANCE_DATE', 'MONTANT_FACTURE_ASSURANCE', 'STATUS_FACTURE_ASSURANCE', 'TYPE_PATIENT_FACTURE_ASSURANCE', 'DATE_CREATION_FACTURE_ASSURANCE', 'DATE_MOD_FACTURE_ASSURANCE', 'CREATED_BY_FACTURE_ASSURANCE', 'MODIFIED_BY_FACTURE_ASSURANCE'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($date_debut= null,$q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "facture_assurance.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "facture_assurance.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "facture_assurance.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
		if (!empty($date_debut)) {
			$this->db->where('FACTURE_ASSURANCE_DATE="'.$date_debut.'"');
		}
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($date_debut = null,$q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "facture_assurance.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "facture_assurance.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "facture_assurance.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		if (!empty($date_debut)) {
			$this->db->where('FACTURE_ASSURANCE_DATE="'.$date_debut.'"');
		}
        $this->db->limit($limit, $offset);
        $this->db->order_by('facture_assurance.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('hospital_ibi_societes', 'hospital_ibi_societes.ID_SOCIETE = facture_assurance.SOCIETE_FACTURE_ASSURANCE', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('CREATED_BY_FACTURE_ASSURANCE', get_user_data('id'));
        // $this->db->where('MODIFIED_BY_FACTURE_ASSURANCE', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_facture_assurance.php */
/* Location: ./application/models/Model_facture_assurance.php */