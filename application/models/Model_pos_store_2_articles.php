<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_store_2_articles extends MY_Model {

	private $primary_key 	= 'article_id';
	private $table_name 	= 'pos_store_2_articles';
	private $field_search 	= ['article_designation', 'article_categorie_id', 'article_emplacement_id', 'article_part_number', 'article_etiquitte', 'article_code', 'articles_prix_vente', 'articles_prix_vente_promotion', 'articles_date_debut_promotion', 'articles_date_fin_promotion', 'articles_unite', 'articles_description', 'article_date_creation', 'article_date_modification', 'article_user_creator_id', 'articles_image'];

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
	                $where .= "pos_store_2_articles.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_store_2_articles.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_articles.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "pos_store_2_articles.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_store_2_articles.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_articles.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_store_2_articles.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('pos_store_2_categorie', 'pos_store_2_categorie.categorie_id = pos_store_2_articles.article_categorie_id', 'LEFT');
        $this->db->join('pos_store_2_emplacements', 'pos_store_2_emplacements.emplacement_id = pos_store_2_articles.article_emplacement_id', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_pos_store_2_articles.php */
/* Location: ./application/models/Model_pos_store_2_articles.php */