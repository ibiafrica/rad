<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_store_2_ibi_devis extends MY_Model {

	private $primary_key 	= 'ID_DEVIS';
	private $table_name 	= 'pos_store_2_ibi_devis';
	private $field_search 	= ['TITRE_DEVIS', 'CODE_DEVIS', 'REF_CLIENT_DEVIS', 'TYPE_DEVIS', 'DATE_CREATION_DEVIS', 'DATE_MOD_DEVIS', 'AUTHOR_DEVIS', 'COEFFICIENT_DEVIS', 'TOTAL_DEVIS', 'TOTAL_FINAL_DEVIS', 'TYPE_DELAY_DEVIS', 'TEMPS_DELAY_DEVIS', 'COND_PAID_DEVIS', 'PERCENT_PAID_DEVIS', 'PERCENT_PAID_LIVR_DEVIS', 'VALID_OFFRE_DEVIS', 'STATUT_DEVIS'];

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




         $where .= "  pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";








	            } else {
	                $where .= "OR " . "pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('STATUT_DEVIS','1');
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}
	public function count_all_ibi_devis_liste_attente($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {

 $where .= "  pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";
	            } else {
	                $where .= "OR " . "pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('STATUT_DEVIS','0');
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
                   $where .= "  pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";

	            } else {
	                $where .= "OR " . "pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
       $this->db->where('STATUT_DEVIS','1');
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_store_2_ibi_devis.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function get_ibi_devis_liste_attente($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
 $where .= "  pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";

	            } else {
	                $where .= "OR " . "pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_devis.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
         $this->db->where('STATUT_DEVIS','0');
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_store_2_ibi_devis.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}
    public function join_avaiable() {
        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT = pos_store_2_ibi_devis.REF_CLIENT_DEVIS', 'LEFT');

        $this->db->join('aauth_users', 'aauth_users.id = pos_store_2_ibi_devis.AUTHOR_DEVIS', 'LEFT');
/*
         $this->db->join('pos_store_2_ibi_devis_produits', 'pos_store_2_ibi_devis_produits.REF_DEVIS_CODE_DEVIS_PROD = pos_store_2_ibi_devis.ID_DEVIS', 'LEFT');*/
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }
    
    public function getRequete($id){
      $query=$this->db->query("SELECT * FROM pos_store_2_ibi_devis d,pos_store_2_ibi_devis_produits p WHERE d.ID_DEVIS=p.REF_DEVIS_CODE_DEVIS_PROD AND p.REF_DEVIS_CODE_DEVIS_PROD ='".$id."'");
      if ($query) {
        # code...
         return $query->result_array();
      }
    }
}

/* End of file Model_pos_store_2_ibi_devis.php */
/* Location: ./application/models/Model_pos_store_2_ibi_devis.php */