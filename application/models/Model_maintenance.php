<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_maintenance extends MY_Model {

	private $primary_key 	= 'ID_PRISE_CHARGE';
	private $field_search 	= ['DEPARTEMENT_PRISE_CHARGE', 'NUMERO_PRISE_CHARGE', 'TYPE_INTER_PRISE_CHARGE', 'DATE_CREATION_PRISE_CHARGE', 'DATE_MODIFIED_PRISE_CHARGE', 'AUTHOR_PRISE_CHARGE', 'MODIFIED_BY_PRISE_CHARGE'];

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
		$store_prefix = $this->uri->segment(4);
		$table_name     = 'pos_store_'.$store_prefix.'_ibi_prise_charge';
		return $table_name;
	 }

	public function count_all($q = null, $field = null, $department = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		$depart = isset($department) ? $department : $this->uri->segment(2);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
                   $where .= " ". $this->table_name().".".$field . " LIKE '%" . $q . "%' AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%' AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' ";

	            } else {

					$where .= "OR " . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {

			$where .= "(" . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' )";
        }

        // $where .= "AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%'";
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name());

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $department =null , $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		$depart = isset($department) ? $department : $this->uri->segment(2);

		// print_r($depart);die();

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
                   $where .= " ". $this->table_name().".".$field . " LIKE '%" . $q . "%' 
				   AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' 
				   OR CONCAT(aauth_users.full_name) LIKE '%".$q."%' AND 
				   ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' 
				   OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' AND 
				   ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' ";

	            } else {

					$where .= "OR " . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {

			$where .= "(" . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }

        // $where .= "AND ".$this->table_name().".DEPARTEMENT_PRISE_CHARGE LIKE '%".$depart."%'";
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}

	public function join_avaiable() {
        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT ='. $this->table_name().'.REF_CLIENT_PRISE_CHARGE', 'LEFT');

        $this->db->join('aauth_users', 'aauth_users.id = '.$this->table_name().'.AUTHOR_PRISE_CHARGE', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

    public function shuffle_code_for_maintenance($store, $str = null){
            
		$prefix='FPC';
		$prefix_ch = $str.''.$prefix;

		$lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_PRISE_CHARGE,'".$prefix_ch."','') AS UNSIGNED)) as Maxcount from pos_store_".$store."_ibi_prise_charge)t");
		
		
		 foreach ($lastid->result_array() as $key => $value) {
			
			if($value['Maxcounts']==NULL){
				$Countmax="000001";
			}else{
				$Countmax=$value['Maxcounts'];
			}
		 }



		$randomString = $prefix_ch.$Countmax.'-'.date('Y');


		return $randomString;

   	}

   public function shuffle_code_for_maintenance_fiche($store){
            
		$prefix='FTC';

		$lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_FICHE,'".$prefix."','') AS UNSIGNED)) as Maxcount from pos_store_".$store."_ibi_fiche_travail)t");
		
		
		 foreach ($lastid->result_array() as $key => $value) {
			
			if($value['Maxcounts']==NULL){
				$Countmax="000001";
			}else{
				$Countmax=$value['Maxcounts'];
			}
		 }



		$randomString = $prefix.$Countmax.'-'.date('Y');


		return $randomString;

   }

}
