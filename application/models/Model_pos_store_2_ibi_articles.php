<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_store_2_ibi_articles extends MY_Model {

	private $primary_key 	= 'ID_ARTICLE';
	private $table_name 	= 'pos_store_2_ibi_articles';
	private $field_search 	= ['DESIGN_ARTICLE', 'REF_RAYON_ARTICLE', 'REF_CATEGORIE_ARTICLE', 'REF_SOUS_CATEGORIE_ARTICLE', 'SKU_ARTICLE', 'TYPE_ARTICLE', 'STATUS_ARTICLE', 'STOCK_ENABLED_ARTICLE', 'PRIX_DE_VENTE_ARTICLE', 'SHADOW_PRICE_ARTICLE', 'PRIX_PROMOTIONEL_ARTICLE', 'SPECIAL_PRICE_START_DATE_ARTICLE', 'SPECIAL_PRICE_END_DATE_ARTICLE', 'TAILLE_ARTICLE', 'POIDS_ARTICLE', 'COULEUR_ARTICLE', 'HAUTEUR_ARTICLE', 'LARGEUR_ARTICLE', 'DESCRIPTION_ARTICLE', 'APERCU_ARTICLE', 'AUTHOR_ARTICLE'];

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
	                $where .= "pos_store_2_ibi_articles.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_store_2_ibi_articles.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_articles.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "pos_store_2_ibi_articles.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_store_2_ibi_articles.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_2_ibi_articles.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_store_2_ibi_articles.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('pos_store_2_ibi_rayons', 'pos_store_2_ibi_rayons.ID_RAYON = pos_store_2_ibi_articles.REF_RAYON_ARTICLE', 'LEFT');
        $this->db->join('pos_ibi_categories', 'pos_ibi_categories.ID_CATEGORIE = pos_store_2_ibi_articles.REF_CATEGORIE_ARTICLE', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        $this->db->where('AUTHOR_ARTICLE', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_pos_store_2_ibi_articles.php */
/* Location: ./application/models/Model_pos_store_2_ibi_articles.php */