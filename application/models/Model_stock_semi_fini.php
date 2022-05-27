<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_stock_semi_fini extends MY_Model {

	private $primary_key 	= 'ID_ARTICLE';
	//private $table_name 	= 'pos_store_3_ibi_article_stock_semi_fini';
	private $field_search 	= ['DESIGN_ARTICLE', 'REF_RAYON_ARTICLE', 'REF_SHIPPING_ARTICLE', 'REF_CATEGORIE_ARTICLE', 'REF_SOUS_CATEGORIE_ARTICLE', 'REF_PROVIDER_ARTICLE', 'REF_TAXE_ARTICLE', 'QUANTITY_ARTICLE', 'SKU_ARTICLE', 'QUANTITE_RESTANTE_ARTICLE', 'QUANTITE_VENDU_ARTICLE', 'DEFECTUEUX_ARTICLE', 'PRIX_DACHAT_ARTICLE', 'FRAIS_ACCESSOIRE_ARTICLE', 'COUT_DACHAT_ARTICLE', 'TAUX_DE_MARGE_ARTICLE', 'PRIX_DE_VENTE_ARTICLE', 'PRIX_DE_VENTE_TTC_ARTICLE', 'SHADOW_PRICE_ARTICLE', 'TAILLE_ARTICLE', 'POIDS_ARTICLE', 'COULEUR_ARTICLE', 'HAUTEUR_ARTICLE', 'LARGEUR_ARTICLE', 'PRIX_PROMOTIONEL_ARTICLE', 'SPECIAL_PRICE_START_DATE_ARTICLE', 'SPECIAL_PRICE_END_DATE_ARTICLE', 'DESCRIPTION_ARTICLE', 'APERCU_ARTICLE', 'CODEBAR_ARTICLE', 'DATE_CREATION_ARTICLE', 'DATE_MOD_ARTICLE', 'AUTHOR_ARTICLE', 'TYPE_ARTICLE', 'STATUS_ARTICLE', 'STOCK_ENABLED_ARTICLE', 'AUTO_BARCODE_ARTICLE', 'BARCODE_TYPE_ARTICLE', 'USE_VARIATION_ARTICLE', 'MINIMUM_QUANTITY_ARTICLE'];

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
		$table_name     = '	pos_store_'.$store_prefix.'_ibi_article_stock_semi_fini ';
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

    public function join_avaiable() {


	$this->db->join('pos_store_'.$this->uri->segment(4).'_ibi_categories', 'pos_store_'.$this->uri->segment(4).'_ibi_categories.ID_CATEGORIE = '.$this->table_name().'.REF_CATEGORIE_ARTICLE', 'LEFT');



		$this->db->join('pos_store_'.$this->uri->segment(4).'_famille', 'pos_store_'.$this->uri->segment(4).'_famille.ID_FAMILLE = '.$this->table_name().'.REF_CATEGORIE_ARTICLE', 'LEFT');


		$this->db->join('aauth_users', 'aauth_users.id = '.$this->table_name().'.AUTHOR_ARTICLE', 'LEFT');





        return $this;
    }

    public function filter_avaiable() {
        //$this->db->where('AUTHOR_ARTICLE', get_user_data('id'));
        
        return $this;
    }

        function getList($table,$criteres = array()) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->result_array();
    }

}

/* End of file Model_pos_store_3_ibi_article_stock_semi_fini.php */
/* Location: ./application/models/Model_pos_store_3_ibi_article_stock_semi_fini.php */