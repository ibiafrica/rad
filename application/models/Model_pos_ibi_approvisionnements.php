<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_pos_ibi_approvisionnements extends MY_Model
{
    private $primary_key 	= 'ID_ARRIVAGE';
    // private $table_name 	= 'pos_ibi_arrivages';
    private $field_search 	=['TITRE_ARRIVAGE', 'VALUE_ARRIVAGE', 'REF_PROVIDERS_ARRIVAGE', 'DATE_CREATION_ARRIVAGE', 'DATE_MOD_ARRIVAGE', 'CREATED_BY_ARRIVAGE'];

    public function __construct()
    {
        $config = array(
            'primary_key' 	=> $this->primary_key,
            'table_name' 	=> $this->table_name(),
            'field_search' 	=> $this->field_search,
        );

        parent::__construct($config);
    }
    public function table_name()
    {
        $store_prefix= $this->uri->segment(2);
        $table_name='pos_store_'.$store_prefix.'_ibi_arrivages';
        return $table_name;
    }

    public function count_all($q = null, $field = null)
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = null;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search as $field) {
                if ($iterasi == 1) {
                    $where .= "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' OR CONCAT(pos_ibi_fournisseurs.NOM_FOURNISSEUR) LIKE '%" . $q . "%'";
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
        $this->db->where('DELETE_STATUS_ARRIVAGE !=', 1);
        $query = $this->db->get($this->table_name());

        return $query->num_rows();
    }

     function get($critere=null, $critere1=null, $q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = null;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search as $field) {
                if ($iterasi == 1) {
                    $where .= "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' OR CONCAT(pos_ibi_fournisseurs.NOM_FOURNISSEUR) LIKE '%" . $q . "%'";
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

        if(empty($critere)){
            $this->join_avaiable()->filter_avaiable();
            $this->db->where($where);
            $this->db->where('DELETE_STATUS_ARRIVAGE !=', 1);
        }
        else{

        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_ARRIVAGE', 0);
        $this->db->where('DATE_CREATION_ARRIVAGE >=',$critere);
        $this->db->where('DATE_CREATION_ARRIVAGE <=',$critere1);
        }


        $this->db->limit($limit, $offset);
        $this->db->order_by(''.$this->table_name().'.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name());

        return $query->result();
    }
    
    public function join_avaiable()
    {
        $this->db->join('pos_ibi_fournisseurs', 'pos_ibi_fournisseurs.ID_FOURNISSEUR ='.$this->table_name().'.REF_PROVIDERS_ARRIVAGE', 'LEFT');
        $this->db->join('aauth_users', 'aauth_users.id ='.$this->table_name().'.CREATED_BY_ARRIVAGE', 'LEFT');
        return $this;
    }

    public function filter_avaiable()
    {
        // $this->db->where('AUTHOR', get_user_data('id'));
        
        return $this;
    }


	public function arrivageAll($prefix,$critere){
        $req = $this->db->distinct()
                     ->select('*')
		             ->from('pos_store_detail_arrivage')
		             ->join('pos_store_'.$prefix.'_ibi_arrivages','pos_store_'.$prefix.'_ibi_arrivages.ID_ARRIVAGE=pos_store_detail_arrivage.ID_APPOVISIONNEMENT')
                     ->join('pos_ibi_ingredients','pos_ibi_ingredients.ID_INGREDIENT=pos_store_detail_arrivage.ID_INGREDIENT')
                    //  ->join('pos_ibi_fournisseurs','pos_ibi_fournisseurs.ID_FOURNISSEUR=pos_store_detail_arrivage.ID_FOURNISSEUR')
                    ->join('aauth_users','aauth_users.id=pos_store_detail_arrivage.CREATE_BY_ARRIVAGE_DETAIL','LEFT')
                     ->where($critere)
		             ->order_by('ID_ARRIVAGE_DETAIL','DESC')
		             ->get();
		      return $req->result_array();

    }





public function getRequete($requete){
      $query=$this->db->query($requete);
      if ($query) {
         return $query->result_array();
      }
    }
    


    public function get_many($prefixe,$critere){
        $request = $this->db->distinct()
                   ->select('*')
                   ->from("pos_store_detail_arrivage arriv_det")
                   ->join("pos_ibi_ingredients ingredient","ingredient.ID_INGREDIENT = arriv_det.ID_INGREDIENT")
                    ->where($critere)
                    ->get();
                return $request->result_array();
                }















    public function get_prints_articles($prefix,$critere){

        $query = $this->db->distinct()
                        ->select('*')
                        ->from('pos_store_'.$prefix.'_ibi_articles_stock_flow arriv')
                        ->join(" pos_store_".$prefix."_ibi_articles ingr","ingr.CODEBAR_ARTICLE = arriv.REF_ARTICLE_BARCODE_SF")
                        ->where($critere)
                        ->get();
            return $query->result_array();
    }


    public function count_all_produit($prefix, $id)
    {
        $this->db->select('artfl.ID_SF');
        $this->db->from('pos_store_'.$prefix.'_ibi_arrivages arriv');
        $this->db->join('pos_store_'.$prefix.'_ibi_articles_stock_flow artfl', 'arriv.ID_ARRIVAGE=artfl.REF_SHIPPING_SF', 'LEFT');
        $this->db->where('arriv.ID_ARRIVAGE', $id);
        $this->db->where('DELETE_STATUS_SF', 0);
        $query=$this->db->get();
        return $query->num_rows();
    }


    

     function getOne($table, $criteres){
    	$this->db->where($criteres);
    	$query = $this->db->get($table);
    	return $query->row_array();
    }

    
    function update($table, $criteres=array(), $data=array()) {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }
    function insert($table,$data){
	    $query=$this->db->insert($table,$data);
	    return ($query) ? true : false;
    }




    function insert_approvisionnemt($table,$data){
        $query=$this->db->insert($table,$data);
        $lastId = $this->db->insert_id();
	    return ($lastId) ? true : false;
    }


    function insert_last_id($table, $data)
	{
		$this->db->set($data);
		$query = $this->db->insert($table);
		if ($query) {
			return $this->db->insert_id();
		}
	 }
	function getList($table, $critere = array())
	{
		$this->db->where($critere);
		$query = $this->db->get($table);
		return $query->result();
    }
    
    	function margeCalculator($criteres){
		$critere = 'INTER_X_MARGE <= '.$criteres.' AND INTER_Y_MARGE >='.$criteres.' AND DELETE_STATUS_MARGE = 0';
		$this->db->where($critere);
		$query = $this->db->get('pos_ibi_marge');
		$pourcentage = 0;
		foreach ($query->result() as $key => $value) {
		 	$pourcentage = $value->POURCENTAGE_MARGE;
		 }
		$margeBeneficiaire = round($criteres + ($criteres * $pourcentage) / 100);
		return $margeBeneficiaire;
    }
    

    function getListerRequisition($table, $critere)
	{
		$this->db->where($critere);
		$query = $this->db->get($table);
		return $query->result();
    }



        function ApprovOne($table, $critere)
	{
		$this->db->where($critere);
		$query = $this->db->get($table);
		return $query->row();
    }




    public function getBoutique($requete){
        $query=$this->db->query($requete);
        if ($query) {
           return $query->result_array();
        }
      }


      public function registerApprov($tableApprov,$save_data){
        $query=$this->db->insert($tableApprov,$save_data);
        if ($query) {
        return $query;
        }else{
            return false;
        }
    }


      public function register($table,$save_data){
        $query=$this->db->insert($table,$save_data);
        // $lastId = $this->db->insert_id();
        if ($query) {
        return $query;
        }else{
            return false;
        }
    }


    public function insert_detail($table,$data){
        $query=$this->db->insert($table,$data);
        $lastId = $this->db->insert_id();
        if ($query) {
        return $query;
        }else{
            return false;
        }
    }



}
