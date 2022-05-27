<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_devis extends MY_Model {

	private $primary_key 	= 'ID_DEVIS';
	//private $table_name 	= 'pos_store_2_ibi_devis';
	private $field_search 	= ['TITRE_DEVIS', 'CODE_DEVIS', 'REF_CLIENT_DEVIS', 'TYPE_DEVIS', 'DATE_CREATION_DEVIS', 'DATE_MOD_DEVIS', 'AUTHOR_DEVIS', 'COEFFICIENT_DEVIS', 'TOTAL_DEVIS', 'TOTAL_FINAL_DEVIS', 'TYPE_DELAY_DEVIS', 'TEMPS_DELAY_DEVIS', 'COND_PAID_DEVIS', 'PERCENT_PAID_DEVIS', 'PERCENT_PAID_LIVR_DEVIS', 'VALID_OFFRE_DEVIS', 'STATUT_DEVIS'];

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
		$table_name     = 'pos_store_'.$store_prefix.'_ibi_devis';
		return $table_name;
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

         $where .= " ". $this->table_name().".".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";

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
	public function count_devis_liste_attente($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {

					$where .= " ". $this->table_name().".".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";
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
        $this->db->where('STATUT_DEVIS','0');
		$query = $this->db->get($this->table_name());

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
                   $where .= " ". $this->table_name().".".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";

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

	public function devis_liste_attente($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
					
					$where .= " ". $this->table_name().".".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";
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
         $this->db->where('STATUT_DEVIS','0');
		$this->db->limit($limit, $offset);
		$this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}
    public function join_avaiable() {
        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT ='. $this->table_name().'.REF_CLIENT_DEVIS', 'LEFT');

        $this->db->join('aauth_users', 'aauth_users.id = '.$this->table_name().'.AUTHOR_DEVIS', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }
    
     public function getListDev($store, $id){
   		$query=$this->db->query("SELECT * FROM pos_store_".$store."_ibi_devis d,pos_store_".$store."_ibi_devis_produits p WHERE d.ID_DEVIS=p.ID_DEVIS AND p.ID_DEVIS ='".$id."'");
	       if ($query) {
	         return $query->result();
	   }
	 }
	 

	 
	 public function shuffle_code_for_dev($store){
            
		$prefix = 'DEV';

		$dateyear = date('Y');

		$lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_DEVIS,'".$prefix."','') AS UNSIGNED)) as Maxcount from pos_store_".$store."_ibi_devis WHERE YEAR(DATE_CREATION_DEVIS)='".$dateyear."')t");
		
		
		 foreach ($lastid->result_array() as $key => $value) {
			
			if($value['Maxcounts']==NULL){
				$Countmax="000001";
			}else{
				$Countmax=$value['Maxcounts'];
			}
		 }



		$randomString = $prefix.$Countmax.'-'.$dateyear;


	return $randomString;

   }


   public function shuffle_code_for_fiche($store){
            
	$prefix = 'FT';

	$dateyear = date('Y');

	$lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) AS Maxcounts FROM (SELECT MAX(CAST(REPLACE(NUMERO_FICHE,'".$prefix."','') AS UNSIGNED)) AS Maxcount FROM pos_store_".$store."_ibi_fiche_travail WHERE YEAR(DATE_CREATION_FICHE)='".$dateyear."')t");
	
	
	 foreach ($lastid->result_array() as $key => $value) {
		
		if($value['Maxcounts']==NULL){
			$Countmax="000001";
		}else{
			$Countmax=$value['Maxcounts'];
		}
	 }



	$randomString = $prefix.$Countmax.'-'.$dateyear;


	return $randomString;

	}
}

/* End of file Model_pos_store_2_ibi_devis.php */
/* Location: ./application/models/Model_pos_store_2_ibi_devis.php */