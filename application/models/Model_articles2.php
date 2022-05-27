<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_articles extends MY_Model {

	private $primary_key 	= 'ID_ARTICLE';
	// private $table_name 	= 'pos_store_2_ibi_articles';
	private $field_search 	= ['DESIGN_ARTICLE', 'REF_RAYON_ARTICLE', 'REF_CATEGORIE_ARTICLE', 'REF_SOUS_CATEGORIE_ARTICLE', 'SKU_ARTICLE', 'TYPE_ARTICLE', 'STATUS_ARTICLE', 'STOCK_ENABLED_ARTICLE', 'PRIX_DE_VENTE_ARTICLE', 'SHADOW_PRICE_ARTICLE', 'PRIX_PROMOTIONEL_ARTICLE', 'SPECIAL_PRICE_START_DATE_ARTICLE', 'SPECIAL_PRICE_END_DATE_ARTICLE', 'TAILLE_ARTICLE', 'POIDS_ARTICLE', 'COULEUR_ARTICLE', 'HAUTEUR_ARTICLE', 'LARGEUR_ARTICLE', 'DESCRIPTION_ARTICLE', 'APERCU_ARTICLE', 'CODEBAR_ARTICLE', 'AUTHOR_ARTICLE'];

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
       $table_name     = 'pos_store_'.$store_prefix.'_ibi_articles';
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
        $this->db->where('POSITION_ARTICLE',0);
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
        $this->db->where('POSITION_ARTICLE',0);
        $this->db->limit($limit, $offset);
        $this->db->order_by(''.$this->table_name().'.QUANTITE_RESTANTE_ARTICLE', "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}


public function count_all_semi_fini($q = null, $field = null)
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
        $this->db->where('POSITION_ARTICLE',1);
		$query = $this->db->get($this->table_name());

		return $query->num_rows();
	}


	public function get_article_semi_fini($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
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
        $this->db->where('POSITION_ARTICLE',1);
        $this->db->limit($limit, $offset);
        $this->db->order_by(''.$this->table_name().'.QUANTITE_RESTANTE_ARTICLE', "DESC");
		    $query = $this->db->get($this->table_name());

		    return $query->result();
	   }


	    public function join_avaiable() {
        $this->db->join('pos_store_'.$this->uri->segment(4).'_ibi_rayons', 'pos_store_'.$this->uri->segment(4).'_ibi_rayons.ID_RAYON = '.$this->table_name().'.REF_RAYON_ARTICLE', 'LEFT');
        // $this->db->join('pos_store_'.$this->uri->segment(4).'_ibi_articles', 'pos_store_'.$this->uri->segment(4).'_ibi_famille.ID_FAMILLE = '.$this->table_name().'.REF_CATEGORIE_ARTICLE', 'LEFT');

         $this->db->join('pos_store_'.$this->uri->segment(4).'_famille', 'pos_store_'.$this->uri->segment(4).'_famille.ID_FAMILLE = pos_store_'.$this->uri->segment(4).'_ibi_articles.REF_CATEGORIE_ARTICLE', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('AUTHOR_ARTICLE', get_user_data('id'));
        
        return $this;
    }
     public function generate_barcode($store,$ref_categorie){
        
        $lastid = $this->db->query("SELECT lpad(max(ID_ARTICLE)+1,6,0) as Maxcount FROM pos_store_".$store."_ibi_articles");
                         foreach ($lastid->result_array() as $key => $value) {
                            if($value['Maxcount']==NULL){
                                $Countmax="000001";
                            }else{
                                $Countmax=$value['Maxcount'];
                            }
                         }
                         $store_slug_id = $store;
                         $pos_store = $this->db->query("SELECT lpad(count(ID_STORE)+1,4,0) as Countstore FROM pos_ibi_stores WHERE ID_STORE<".$store_slug_id."")->result_array();
                         $CountPosId=$pos_store[0]['Countstore'];
                       
        
        $categoriePosId = str_pad($ref_categorie, 3, '0', STR_PAD_LEFT);
      
        $code = $CountPosId."-".$categoriePosId."-".$Countmax;
     
        return $code;
    	
	}
	
		// change the quantity when you approve the quantity
	public function update_qty_fiche_ouv($codebar,$qty)
	{
		 
		$this->db->set('QUANTITE_RESTANTE_ARTICLE','QUANTITE_RESTANTE_ARTICLE-'.$qty,FALSE);
		$this->db->where('CODEBAR_ARTICLE', $codebar);
		$this->db->update($this->table_name());
	}
	public function getListFilter($store, $criteres2 = NULL, $criteres = NULL, $criteres1 = NULL)
    {
      $where = "a.DESIGN_ARTICLE LIKE '%" . $criteres2 . "%' ";
      $where1 = "cat.NOM_CATEGORIE LIKE '%" . $criteres1 . "%' OR fam.NOM_FAMILLE LIKE '%" . $criteres . "%'";

      $this->db->select('a.*,fam.NOM_FAMILLE,cat.NOM_CATEGORIE');
      $this->db->from('pos_store_'.$store.'_ibi_articles a');
      $this->db->join('pos_store_'.$store.'_famille fam','fam.ID_FAMILLE = a.REF_CATEGORIE_ARTICLE', 'LEFT');
      $this->db->join('pos_store_'.$store.'_ibi_categories cat','cat.ID_CATEGORIE = a.REF_SOUS_CATEGORIE_ARTICLE', 'LEFT');
      $this->db->where($where);
      $this->db->where($where1);
      
      $query = $this->db->get();

      if($query){
        return $query->result();
      }
    }
    public function getListFilter_count($store, $criteres2 = NULL, $criteres = NULL, $criteres1 = NULL)
    {
      $where = "a.DESIGN_ARTICLE LIKE '%" . $criteres2 . "%' ";
      $where1 = "cat.NOM_CATEGORIE LIKE '%" . $criteres1 . "%' OR fam.NOM_FAMILLE LIKE '%" . $criteres . "%'";

      $this->db->select('a.*,fam.NOM_FAMILLE,cat.NOM_CATEGORIE');
      $this->db->from('pos_store_'.$store.'_ibi_articles a');
      $this->db->join('pos_store_'.$store.'_famille fam','fam.ID_FAMILLE = a.REF_CATEGORIE_ARTICLE', 'LEFT');
      $this->db->join('pos_store_'.$store.'_ibi_categories cat','cat.ID_CATEGORIE = a.REF_SOUS_CATEGORIE_ARTICLE', 'LEFT');
      $this->db->where($where);
      $this->db->where($where1);
      
      $query = $this->db->get();

      if($query){
        return $query->num_rows();
      }
    }
    public function getMouvFilter($store, $criteres = NULL, $criteres1 = NULL) {

      $query = $this->db->query('SELECT ARTICLE.DESIGN_ARTICLE,ARTICLE.CODEBAR_ARTICLE,ARTICLE.REF_SOUS_CATEGORIE_ARTICLE,CATEGORIE.NOM_CATEGORIE,FAMILLE.NOM_FAMILLE FROM (SELECT a.DESIGN_ARTICLE,a.CODEBAR_ARTICLE,a.REF_SOUS_CATEGORIE_ARTICLE FROM pos_store_'.$store.'_ibi_articles a WHERE a.DESIGN_ARTICLE LIKE "%'.$criteres1.'%" ORDER BY a.DESIGN_ARTICLE) ARTICLE
        LEFT JOIN (SELECT ID_CATEGORIE, NOM_CATEGORIE FROM (SELECT cat.ID_CATEGORIE,cat.NOM_CATEGORIE FROM pos_store_'.$store.'_ibi_categories cat,pos_store_'.$store.'_ibi_articles A WHERE cat.ID_CATEGORIE=A.REF_SOUS_CATEGORIE_ARTICLE )t )CATEGORIE ON ARTICLE.REF_SOUS_CATEGORIE_ARTICLE=CATEGORIE.ID_CATEGORIE
        LEFT JOIN (SELECT ID_FAMILLE, NOM_FAMILLE FROM (SELECT fam.ID_FAMILLE,fam.NOM_FAMILLE FROM pos_store_'.$store.'_ibi_famille fam,pos_store_'.$store.'_ibi_articles A WHERE fam.ID_CATEGORIE=A.REF_CATEGORIE_ARTICLE )t )FAMILLE ON ARTICLE.REF_CATEGORIE_ARTICLE=FAMILLE.ID_FAMILLE WHERE ARTICLE.DESIGN_ARTICLE LIKE "%'.$criteres1.'%" AND CATEGORIE.NOM_CATEGORIE LIKE "%'.$criteres.'%" GROUP BY CODEBAR_ARTICLE');

      if($query){
        return $query->result();
      }
    }
    public function getMouvFilter_count($store, $criteres = NULL, $criteres1 = NULL) {

      $query = $this->db->query('SELECT ARTICLE.DESIGN_ARTICLE,ARTICLE.CODEBAR_ARTICLE,ARTICLE.REF_SOUS_CATEGORIE_ARTICLE,CATEGORIE.NOM_CATEGORIE FROM (SELECT a.DESIGN_ARTICLE,a.CODEBAR_ARTICLE,a.REF_SOUS_CATEGORIE_ARTICLE FROM pos_store_'.$store.'_ibi_articles a WHERE a.DESIGN_ARTICLE LIKE "%'.$criteres1.'%" ORDER BY a.DESIGN_ARTICLE) ARTICLE
        LEFT JOIN (SELECT ID_CATEGORIE, NOM_CATEGORIE FROM (SELECT cat.ID_CATEGORIE,cat.NOM_CATEGORIE FROM pos_store_'.$store.'_ibi_categories cat,pos_store_'.$store.'_ibi_articles A WHERE cat.ID_CATEGORIE=A.REF_SOUS_CATEGORIE_ARTICLE )t )CATEGORIE ON ARTICLE.REF_SOUS_CATEGORIE_ARTICLE=CATEGORIE.ID_CATEGORIE WHERE ARTICLE.DESIGN_ARTICLE LIKE "%'.$criteres1.'%" AND CATEGORIE.NOM_CATEGORIE LIKE "%'.$criteres.'%" GROUP BY CODEBAR_ARTICLE');

      if($query){
        return $query->num_rows();
      }
    }
    function getOneFilter($store, $criteres1, $criteres2, $criteres) {

      $query = $this->db->query('SELECT a.DESIGN_ARTICLE,a.CODEBAR_ARTICLE,asf.REF_ARTICLE_BARCODE_SF,asf.QUANTITE_SF AS QUANTITE,asf.DATE_CREATION_SF AS DATE_SF,asf.REF_COMMAND_CODE_SF AS REF_CODE,asf.TYPE_SF,asf.AUTHOR_SF AS AUTHOR FROM  pos_store_'.$store.'_ibi_articles a LEFT JOIN pos_store_'.$store.'_ibi_articles_stock_flow asf ON asf.REF_ARTICLE_BARCODE_SF=a.CODEBAR_ARTICLE WHERE a.ID_ARTICLE='.$criteres.' AND DATE_CREATION_SF >="'.$criteres1.'" AND DATE_CREATION_SF <="'.$criteres2.'"');
     
        return ($query->num_rows() < 1) ? null : 
        $query->result();
    }
    function getOneFilter_count($store, $criteres1, $criteres2, $criteres) {

    	$query = $this->db->query('SELECT a.DESIGN_ARTICLE,a.CODEBAR_ARTICLE,asf.REF_ARTICLE_BARCODE_SF,asf.QUANTITE_SF AS QUANTITE,asf.DATE_CREATION_SF AS DATE_SF,asf.REF_COMMAND_CODE_SF AS REF_CODE,asf.TYPE_SF,asf.AUTHOR_SF AS AUTHOR FROM  pos_store_'.$store.'_ibi_articles a LEFT JOIN pos_store_'.$store.'_ibi_articles_stock_flow asf ON asf.REF_ARTICLE_BARCODE_SF=a.CODEBAR_ARTICLE WHERE a.ID_ARTICLE='.$criteres.' AND DATE_CREATION_SF >="'.$criteres1.'" AND DATE_CREATION_SF <="'.$criteres2.'"');
        return $query->num_rows();
    }
}

/* End of file model_articles.php */
/* Location: ./application/models/model_articles.php */