<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transfert_items extends MY_Model {

	private $primary_key 	= 'ID';
	//private $table_name 	= 'pos_store_3_ibi_transfert_items';
	private $field_search 	= ['DESIGN', 'QUANTITY', 'UNIT_PRICE', 'TOTAL_PRICE', 'REF_ITEM', 'DATE_CREATION', 'REF_TRANSFER', 'BARCODE', 'USER_ID', 'FICHE_TRAVAIL'];

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
       $table_name     = 'pos_store_'.$store_prefix.'_ibi_transfert_items';
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
              // $where .= "pos_store_".$this->uri->segment(4)."_ibi_transfert_items.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_store_".$this->uri->segment(4)."_famille.NOM_FAMILLE) LIKE '%".$q."%' OR CONCAT(pos_ibi_categories.NOM_CATEGORIE) LIKE '%".$q."%' ";
              //$where .= "pos_store_".$this->uri->segment(4)."_ibi_transfert_items.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%' ";
              $where .= "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
	            
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
              $where .= "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
              //$where .= "pos_store_".$this->uri->segment(4)."_ibi_transfert_items.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_store_".$this->uri->segment(4)."_famille.NOM_FAMILLE) LIKE '%".$q."%' OR CONCAT(pos_ibi_categories.NOM_CATEGORIE) LIKE '%".$q."%' ";

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
        
     $this->db->join('pos_store_'.$this->uri->segment(4).'_ibi_categories', 'pos_store_'.$this->uri->segment(4).'_ibi_categories.ID_CATEGORIE = '.$this->table_name().'.REF_ITEM', 'LEFT');
     $this->db->join('pos_ibi_stores', 'pos_ibi_stores.ID_STORE = '.$this->table_name().'.REF_TRANSFER', 'LEFT');
      $this->db->join('aauth_users', 'aauth_users.id = '.$this->table_name().'.USER_ID', 'LEFT');
     $this->db->join('pos_store_'.$this->uri->segment(4).'_famille', 'pos_store_'.$this->uri->segment(4).'_famille.ID_FAMILLE = '.$this->table_name().'.FAMILLE', 'LEFT');

        return $this;
    }

    public function filter_avaiable() {
       // $this->db->where('USER_ID', get_user_data('id'));
        
        return $this;
    }
}

/* End of file Model_transfert_items.php */
/* Location: ./application/models/Model_transfert_items.php */