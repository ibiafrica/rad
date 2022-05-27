<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_fiche_ouverte_produits extends MY_Model {

	private $primary_key 	= 'ID_FICHE_OUV_PROD';
	//private $table_name 	= 'fiche_ouverte_produits';
	private $field_search 	= ['REF_PRODUCT_CODEBAR', 'REF_FICHE_OUVERTE', 'QUANTITE_FICHE_OUV', 'UNIT_FICHE_OUV', 'PRIX_FICHE_OUV', 'NAME_FICHE_OUV', 'STATUT_FICHE_OUV'];

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
		$table_name     = 'pos_store_'.$store_prefix.'_ibi_fiche_ouverte_produits';
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


	public function update_status($id){
	
		$data=['STATUT_FICHE_OUV'=>1];

		$this->db->where($this->primary_key, $id);

		$this->db->update($this->table_name(), $data);

		return $this->db->affected_rows();
	}

    public function join_avaiable() {
      //  $this->db->join('pos_store_'.$this->uri->segment(4).'_ibi_fiche_ouverte', 'fiche_ouverte.ID = pos_store_'.$this->uri->segment(4).'_ibi_fiche_ouverte_produits.REF_FICHE_OUVERTE', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_fiche_ouverte_produits.php */
/* Location: ./application/models/Model_fiche_ouverte_produits.php */