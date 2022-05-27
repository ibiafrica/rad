<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_approvisionnement extends MY_Model
{

	private $primary_key 	= 'ID_APPROVISIONNEMENT';
	// private $table_name 	= 'approvisionnement';
	private $field_search 	=['ID_TYPE_APPROVISIONNEMENT', 'CODE_APPROVISIONNEMENT', 'MONTAT_APPROVISIONNEMENT', 'ID_FOURNISSEUR_APPROVISIONNEMENT', 'DATE_CREATION_APPROVISIONNEMENT', 'DATE_MOD_APPROVISIONNEMENT', 'AUTHOR_APPROVISIONNEMENT'];

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
     $store_prefix= $this->uri->segment(4);
     $table_name='pos_store_'.$store_prefix.'_ibi_approvisionnement';
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
					$where .= "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$query = $this->db->get($this->table_name());

		return $query->num_rows();
	}
	 public function count_all_produit($prefix,$id)
	{
		$this->db->select('artfl.ID_SF');
		$this->db->from('pos_store_'.$prefix.'_ibi_approvisionnement app');
		$this->db->join('pos_store_'.$prefix.'_ibi_articles_stock_flow artfl','app.ID_APPROVISIONNEMENT=artfl.REF_SHIPPING_SF');
		$this->db->where('app.ID_APPROVISIONNEMENT',$id);
		$query=$this->db->get();
		return $query->num_rows();
	}

	public function getList_approv($prefix,$id_approvisionnement)
	{
		$this->db->select('app.ID_APPROVISIONNEMENT,app.ID_TYPE_APPROVISIONNEMENT, artfl.QUANTITE_SF,artfl.UNIT_PRICE_SF,artfl.TOTAL_PRICE_SF,	artfl.REF_ARTICLE_BARCODE_SF,cl.DESIGN_ARTICLE,artfl.ID_SF,artfl.TYPE_SF, typ.DESIGN_TYPE_APPROVISIONNEMENT
			,app.ID_FOURNISSEUR_APPROVISIONNEMENT,typ.DESCRIPTION_TYPE_APPROVISIONNEMENT');
		$this->db->from('pos_store_'.$prefix.'_ibi_articles_stock_flow artfl');
		$this->db->join('pos_store_'.$prefix.'_ibi_approvisionnement app','app.ID_APPROVISIONNEMENT=artfl.REF_SHIPPING_SF');
		$this->db->join('pos_store_'.$prefix.'_ibi_articles cl','cl.CODEBAR_ARTICLE
		   	=artfl.REF_ARTICLE_BARCODE_SF');
		$this->db->join('pos_store_'.$prefix.'_ibi_type_approvisionnement typ','typ.ID_TYPE_APPROVISIONNEMENT=app.ID_TYPE_APPROVISIONNEMENT');
		$this->db->join('pos_ibi_fournisseurs f','f.ID=app.ID_FOURNISSEUR_APPROVISIONNEMENT','LEFT');
		$this->db->where('app.ID_APPROVISIONNEMENT',$id_approvisionnement);
	   	$query=$this->db->get();
	   	return $query->result();
	 }

	public function get_produit($prefix,$id)
	{
		$this->db->distinct();
		$this->db->select('app.ID_APPROVISIONNEMENT,art.DESIGN_ARTICLE,app.DATE_CREATION_APPROVISIONNEMENT,app.DATE_MOD_APPROVISIONNEMENT,app.MONTAT_APPROVISIONNEMENT,f.NOM,aut.username,artfl.REF_PROVIDER_SF, artfl.UNIT_PRICE_SF,artfl.TOTAL_PRICE_SF,artfl.QUANTITE_SF,artfl.DATE_CREATION_SF,artfl.ID_SF,artfl.REF_ARTICLE_BARCODE_SF,artfl.TYPE_SF,artfl.AUTHOR_SF');
		$this->db->from('pos_store_'.$prefix.'_ibi_approvisionnement app');
		$this->db->join('pos_store_'.$prefix.'_ibi_articles_stock_flow artfl','app.ID_APPROVISIONNEMENT=artfl.REF_SHIPPING_SF');
		$this->db->join('pos_ibi_fournisseurs f','f.ID=app.ID_FOURNISSEUR_APPROVISIONNEMENT','LEFT');
		$this->db->join('aauth_users aut','aut.ID=artfl.AUTHOR_SF','LEFT');
		$this->db->join('pos_store_'.$prefix.'_ibi_articles art','art.CODEBAR_ARTICLE=artfl.REF_ARTICLE_BARCODE_SF','LEFT');
		$this->db->where('app.ID_APPROVISIONNEMENT',$id);
		 $query=$this->db->get()->result_array();
		 return $query;

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
					$where .= "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by(''.$this->table_name().'.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}
	public function join_avaiable() {
        $this->db->join('pos_store_'.$this->uri->segment(4).'_ibi_type_approvisionnement', 'pos_store_'.$this->uri->segment(4).'_ibi_type_approvisionnement.ID_TYPE_APPROVISIONNEMENT = '.$this->table_name().'.ID_TYPE_APPROVISIONNEMENT','LEFT');
        $this->db->join('pos_ibi_fournisseurs','pos_ibi_fournisseurs.ID ='.$this->table_name().'.ID_FOURNISSEUR_APPROVISIONNEMENT','LEFT');
        $this->db->join('aauth_users', 'aauth_users.id ='.$this->table_name().'.AUTHOR_APPROVISIONNEMENT','LEFT');
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('AUTHOR', get_user_data('id'));
        
        return $this;
    }

    function shuffle_code_approv($store){

    	$randomString = '';

        $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_APPROVISIONNEMENT,'APP','') AS UNSIGNED)) as Maxcount from pos_store_".$store."_ibi_approvisionnement p1)t");
        
         foreach ($lastid->result_array() as $key => $value) {
            
            if($value['Maxcounts']==NULL){
                $Countmax="00001";
            }else{
                $Countmax=$value['Maxcounts'];
            }
         }

        $randomString = 'APP'.$Countmax;

        return $randomString;


    }

	function creer($table, $data)
	{
		$query = $this->db->insert($table,$data);
		return ($query) ? true : false;
	}
	public function getone($table, $array = array())
	{
		$this->db->where($array);
        $query = $this->db->get($table);

		if ($query) {
			return $query->row_array();
		}
	}
	function insert_last_id($table, $data)
	{
		$this->db->set($data);
		$query = $this->db->insert($table);

		if ($query) {
			return $this->db->insert_id();
		}
	 }
	public	function getList($table, $critere =array())
	{
		$this->db->where($critere);
		$qry = $this->db->get($table);
		return $qry->result();
	}

	public function getListFilter($store, $criteres)
    {
       $this->db->select('app.CODE_APPROVISIONNEMENT,art.DESIGN_ARTICLE,f.NOM,artfl.UNIT_PRICE_SF,artfl.TOTAL_PRICE_SF,artfl.QUANTITE_SF,artfl.DATE_CREATION_SF,artfl.ID_SF,artfl.REF_ARTICLE_BARCODE_SF,artfl.TYPE_SF,artfl.REF_PROVIDER_SF,aut.username');
	   $this->db->from('pos_store_'.$store.'_ibi_approvisionnement app');
	   $this->db->join('pos_store_'.$store.'_ibi_articles_stock_flow artfl','app.ID_APPROVISIONNEMENT=artfl.REF_SHIPPING_SF');
	   $this->db->join('pos_ibi_fournisseurs f','f.ID=app.ID_FOURNISSEUR_APPROVISIONNEMENT','LEFT');
	   $this->db->join('aauth_users aut','aut.ID=artfl.REF_PROVIDER_SF','LEFT');
	   $this->db->join('pos_store_'.$store.'_ibi_articles art','art.CODEBAR_ARTICLE=artfl.REF_ARTICLE_BARCODE_SF','LEFT');
	   $this->db->where('app.ID_TYPE_APPROVISIONNEMENT',$criteres);

      $query = $this->db->get();

      if($query){
        return $query->result_array();
      }
    }
    public function getListFilter_count($store, $criteres)
    {
      $this->db->select('app.CODE_APPROVISIONNEMENT,art.DESIGN_ARTICLE,f.NOM,artfl.UNIT_PRICE_SF,artfl.TOTAL_PRICE_SF,artfl.QUANTITE_SF,artfl.DATE_CREATION_SF,artfl.ID_SF,artfl.REF_ARTICLE_BARCODE_SF,artfl.TYPE_SF,artfl.REF_PROVIDER_SF,aut.username');
	  $this->db->from('pos_store_'.$store.'_ibi_approvisionnement app');
	  $this->db->join('pos_store_'.$store.'_ibi_articles_stock_flow artfl','app.ID_APPROVISIONNEMENT=artfl.REF_SHIPPING_SF');
	  $this->db->join('pos_ibi_fournisseurs f','f.ID=app.ID_FOURNISSEUR_APPROVISIONNEMENT','LEFT');
	  $this->db->join('aauth_users aut','aut.ID=artfl.REF_PROVIDER_SF','LEFT');
	  $this->db->join('pos_store_'.$store.'_ibi_articles art','art.CODEBAR_ARTICLE=artfl.REF_ARTICLE_BARCODE_SF','LEFT');
	  $this->db->where('app.ID_TYPE_APPROVISIONNEMENT',$criteres);
      
      $query = $this->db->get();

      if($query){
        return $query->num_rows();
      }
    }

}

