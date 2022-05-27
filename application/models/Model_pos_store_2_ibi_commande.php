<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_store_2_ibi_commande extends MY_Model {

	private $primary_key 	= 'commande_id';
	private $table_name 	= 'pos_store_2_ibi_commande';
	private $field_search 	= ['commande_numero', 'commande_client_id', 'commande_user_id', 'commande_categorie_id', 'delai', 'validite', 'a_la_commande', 'a_la_livraison', 'commande_date', 'commande_date_modification'];

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

	                $where .= "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' ";


	            } else {
	                $where .= "OR " . "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('commande_status',0);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function count_all_approuver($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {

	                $where .= "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' ";


	            } else {
	                $where .= "OR " . "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('commande_status',1);
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
	                $where .= "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('commande_status',0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_store_2_ibi_commande.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}


	public function get_approuver($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_commande.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('commande_status',1);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_store_2_ibi_commande.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}


    public function join_avaiable() {
        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT = pos_store_2_ibi_commande.commande_client_id', 'LEFT');

        $this->db->join('pos_ibi_categories', 'pos_ibi_categories.ID_CATEGORIE = pos_store_2_ibi_commande.commande_categorie_id', 'LEFT');


      /*   $this->db->join('pos_store_2_ibi_commande_detail', 'pos_store_2_ibi_commande_detail.id_commandes = pos_store_2_ibi_commande.commande_id', 'LEFT');*/

          $this->db->join('aauth_users', 'aauth_users.id = pos_store_2_ibi_commande.commande_user_id', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        //$this->db->where('commande_user_id', get_user_data('id'));
        
        return $this;
    }



    public function getRequete($id,$table,$champs){
      $query=$this->db->query("SELECT * FROM ".$table." WHERE ".$champs."='".$id."'");
      if ($query) {
        # code...
         return $query->result_array();
      }
    }

    public function sd($id){
      $query=$this->db->query("SELECT * FROM pos_store_2_ibi_commande WHERE commande_id='".$id."'");
      if ($query) {
        # code...
         return $query->result_array();
      }
    }



    public function create($table, $data) {

        $query = $this->db->insert($table, $data);
        return ($query) ? true : false;

    }

    public function insert_last_id($table, $data) {

        $query = $this->db->insert($table, $data);
       
       if ($query) {
            return $this->db->insert_id();
        }

    }
   public function update($table, $criteres, $data) {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }
}

/* End of file Model_pos_store_2_ibi_commande.php */
/* Location: ./application/models/Model_pos_store_2_ibi_commande.php */