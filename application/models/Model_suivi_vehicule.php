<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_suivi_vehicule extends MY_Model {

	private $primary_key 	= 'ID_SUIVI';
	private $field_search 	= ['DATE_SUIVI', 'REF_VOITURE_SUIVI', 'CHAUFFEUR_SUIVI', 'DATE_CREATED_SUIVI', 'AUTHOR_CREATED_SUIVI', 'DATE_MODIFIED_SUIVI', 'AUTHOR_MODIFIED_SUIVI'];

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
		$table_name     = 'pos_suivi_vehicule';
		return $table_name;
	 }

	public function count_all($q = null, $field = null, $depart = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {

         $where .= " ". $this->table_name().".".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%' OR CONCAT(pos_voitures.PLAQUE_VOITURE) LIKE '%".$q."%' ";

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

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [], $depart =null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		$depart = $this->uri->segment(2);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
                   $where .= " ". $this->table_name().".".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%' OR CONCAT(pos_voitures.PLAQUE_VOITURE) LIKE '%".$q."%' ";

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

        $this->db->join('aauth_users', 'aauth_users.id = '.$this->table_name().'.AUTHOR_CREATED_SUIVI', 'LEFT');
        $this->db->join('pos_voitures', 'pos_voitures.ID_VOITURE = '.$this->table_name().'.REF_VOITURE_SUIVI', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}