<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_fiche_travail extends MY_Model {

	private $primary_key 	= 'ID_FICHE';
	//private $table_name 	= 'pos_store_2_ibi_fiche_travail';
	private $field_search 	= ['TITRE_FICHE', 'DEVIS_CODE_FICHE', 'NUMERO_FICHE', 'REF_CLIENT_FICHE', 'TYPE_DEVIS_FICHE', 'DATE_CREATION_FICHE', 'DATE_MOD_FICHE', 'AUTHOR_FICHE', 'REF_CATEGORIE_FICHE', 'TOTAL_FICHE', 'STATUT_FICHE'];

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
		$table_name     = 'pos_store_'.$store_prefix.'_ibi_fiche_travail';
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


	                //$where .= "pos_store_2_ibi_fiche_travail.".$field . " LIKE '%" . $q . "%' ";

           
         $where .= "  pos_store_".$this->uri->segment(4)."_ibi_fiche_travail.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";


	            } else {
	                $where .= "OR " . "pos_store_".$this->uri->segment(4)."_ibi_fiche_travail.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_".$this->uri->segment(4)."_ibi_fiche_travail.".$field . " LIKE '%" . $q . "%' )";
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
	                //$where .= "pos_store_2_ibi_fiche_travail.".$field . " LIKE '%" . $q . "%' ";


               $where .= "  pos_store_".$this->uri->segment(4)."_ibi_fiche_travail.".$field . " LIKE '%" . $q . "%' OR CONCAT(aauth_users.full_name) LIKE '%".$q."%'  OR CONCAT(pos_ibi_clients.NOM_CLIENT) LIKE '%".$q."%' ";

	            } else {
	                $where .= "OR " . "pos_store_".$this->uri->segment(4)."_ibi_fiche_travail.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_".$this->uri->segment(4)."_ibi_fiche_travail.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_store_'.$this->uri->segment(4).'_ibi_fiche_travail.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT = pos_store_'.$this->uri->segment(4).'_ibi_fiche_travail.REF_CLIENT_FICHE', 'LEFT');





$this->db->join('aauth_users', 'aauth_users.id = pos_store_'.$this->uri->segment(4).'_ibi_fiche_travail.AUTHOR_FICHE', 'LEFT');

        //$this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT = pos_store_2_ibi_fiche_travail.REF_CLIENT_FICHE', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        //$this->db->where('AUTHOR_FICHE', get_user_data('id'));
        
        return $this;
    }
    

}

/* End of file Model_pos_store_2_ibi_fiche_travail.php */
/* Location: ./application/models/Model_pos_store_2_ibi_fiche_travail.php */