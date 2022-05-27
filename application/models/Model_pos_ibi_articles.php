<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_pos_ibi_articles extends MY_Model
{

    private $primary_key     = 'ID_ARTICLE';
    //private $table_name   = 'pos_store_1_ibi_articles';
    private $field_search     = ['DESIGN_ARTICLE', 'CODEBAR_ARTICLE', 'REF_CATEGORIE_ARTICLE', 'QUANTITY_ARTICLE', 'PRIX_DACHAT_ARTICLE', 'PRIX_DE_VENTE_ARTICLE', 'DESCRIPTION_ARTICLE', 'MINIMUM_QUANTITY_ARTICLE', 'DATE_CREATION_ARTICLE', 'DATE_MOD_ARTICLE', 'CREATED_BY_ARTICLE', 'MODIFIED_BY_ARTICLE'];

    public function __construct()
    {
        $config = array(
            'primary_key'     => $this->primary_key,
            'table_name'     => $this->table_name(),
            'field_search'     => $this->field_search,
        );

        parent::__construct($config);
    }
    public function table_name()
    {
        $store_prefix = $this->uri->segment(2);
        $table_name     = 'pos_store_'.$store_prefix.'_ibi_articles';
        return $table_name;
    }



    public function table_name_plat(){
        $table_name = 'pos_store_2_ibi_articles';
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
                    $where .= "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' OR CONCAT(`categories`.`NOM_CATEGORIE`)  LIKE '%" . $q . "%'";
                } else {
                    $where .= "OR " . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }
            //joining
            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' )";
        }

        $this->join_avaiable()->filter_avaiable();

             $this->db->where('DELETE_STATUS_ARTICLE',0);

             if($this->uri->segment(2)==2){
             $this->db->where('STORE_ID_ARTICLE',$this->uri->segment(2));   
            }
            
             $this->db->where($where);

        $query = $this->db->get($this->table_name());

        return $query->num_rows();
    }
    public function filter_avaiable()
    {
        return $this;
    }


    public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
        $field = $this->scurity($field);
        $uri = $this->uri->segment(2);


        if (empty($field)) {
            foreach ($this->field_search as $field) {
                if ($iterasi == 1) {
                    $where .= "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' OR CONCAT(`categories`.`NOM_CATEGORIE`) LIKE '%" . $q . "%'";
                } else {
                    $where .= "OR " . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }
            //filtrage
            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->join_avaiable()->filter_avaiable();

        $this->db->where($where);
        $this->db->where('DELETE_STATUS_ARTICLE',0);
        if($this->uri->segment(2)==2){
             $this->db->where('STORE_ID_ARTICLE',$this->uri->segment(2));   
            }
        $this->db->limit($limit, $offset);
        $this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
        $query = $this->db->get($this->table_name());

        return $query->result();
    }


    public function count_all_depot($type_articles,$q = null, $field = null)
  {
    $iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
    $field = $this->scurity($field);

        if (empty($field)) {
          foreach ($this->field_search as $field) {
              if ($iterasi == 1) {
                  $where .= "".$this->table_name().".".$field . " LIKE '%" . $q . "%' OR CONCAT(categories.NOM_CATEGORIE)  LIKE '%" . $q . "%'";
              } else {
                  $where .= "OR " . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
              }
              $iterasi++;
          }
//joining
          $where = '('.$where.')';
        } else {
          $where .= "(" . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' )";
        }
    
    $this->join_avaiable_depot()->filter_avaiable_depot();

if(is_null($type_articles)){
          $this->db->where('DELETE_STATUS_ARTICLE','0');
          $this->db->where($where);
         }
         else{
             $this->db->where('DELETE_STATUS_ARTICLE','0');
             $this->db->where('IS_INGREDIENT',$type_articles);
             $this->db->where($where);
         }

    $query = $this->db->get($this->table_name());

    return $query->num_rows();
  }

  

    public function count_all_plats($store, $q = null, $field = null)
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search as $field) {
                if ($iterasi == 1) {

                    $where .= "" . $this->table_name_plat() . "." . $field . " LIKE '%" . $q . "%' ";


                } else {
                    $where .= "OR " . "" . $this->table_name_plat() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }
            //joining
            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name_plat() . "." . $field . " LIKE '%" . $q . "%' )";
        }

        $this->join_avaiable_plat()->filter_avaiable_plat();
        // $this->db->where('DELETE_STATUS_ARTICLE', '0');
        $this->db->where('IS_INGREDIENT=', '0');
        $this->db->where('TYPE_ARTICLE=', '2');

        $this->db->where($where);
        $query = $this->db->get($this->table_name());

        return $query->num_rows();
    }



    public function get_plats($store, $q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search as $field) {
                if ($iterasi == 1) {
                    $where .= "" . $this->table_name_plat() . "." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "" . $this->table_name_plat() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }
            //filtrage
            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name_plat() . "." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->join_avaiable_plat()->filter_avaiable_plat();
        // $this->db->where('DELETE_STATUS_ARTICLE', '0');
        // $this->db->where('IS_INGREDIENT=', '0');
        $this->db->where('TYPE_ARTICLE=', '2');
        $this->db->where('NATURE_ARTICLE','2');
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by("ID_ARTICLE", "DESC");
        $query = $this->db->get('pos_store_2_ibi_articles');

        return $query->result_array();
    }

  public function join_avaiable_plat()
    {
        $this->db->join('pos_ibi_articles_details D', 'D.ARTICLE_ID = ' . $this->table_name_plat() . '.ID_ARTICLE', 'LEFT');

        return $this;
    }



        public function filter_avaiable_plat()
    {

        return $this;
    }


    public function join_avaiable()
    {
        $this->db->join('categories', 'categories.ID_CATEGORIE = ' . $this->table_name() . '.REF_CATEGORIE_ARTICLE', 'LEFT');

        return $this;
    }


    public function get_depot($type_articles,$q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
  {
    $iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
    $field = $this->scurity($field);
    $uri = $this->uri->segment(2);
    // var_dump($uri);exit;


   // var_dump($type_articles);exit;
        if (empty($field)) {
          foreach ($this->field_search as $field) {
              if ($iterasi == 1) {
                  $where .= "".$this->table_name().".".$field . " LIKE '%" . $q . "%' OR CONCAT(categories.NOM_CATEGORIE) LIKE '%" . $q . "%'";
              } else {
                  $where .= "OR " . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
              }
              $iterasi++;
          }
//filtrage
          $where = '('.$where.')';
        } else {
          $where .= "(" . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
          $this->db->select($select_field);
        }
    
    $this->join_avaiable_depot()->filter_avaiable_depot();
       
         if(is_null($type_articles)){
          $this->db->where('DELETE_STATUS_ARTICLE','0');
          $this->db->where($where);
         }
         else{
             $this->db->where('DELETE_STATUS_ARTICLE','0');
             $this->db->where('IS_INGREDIENT',$type_articles);
             $this->db->where($where);
         }

        $this->db->limit($limit, $offset);
        $this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
    $query = $this->db->get($this->table_name());

    return $query->result();
  }



    public function join_avaiable_depot()
    {
        $this->db->join('categories', 'categories.ID_CATEGORIE = ' . $this->table_name() . '.REF_CATEGORIE_ARTICLE', 'LEFT');

        return $this;
    }

    public function filter_avaiable_depot()
    {
        // $this->db->where('CREATED_BY_ARTICLE', get_user_data('id'));
        // $this->db->where('MODIFIED_BY_ARTICLE', get_user_data('id'));

        return $this;
    }




    public function generate_barcode($store, $ref_categorie)
    {

        $lastid = $this->db->query("SELECT lpad(max(ID_INGREDIENT)+1,6,0) as Maxcount FROM pos_" . $store . "_ibi_ingredients");
        foreach ($lastid->result_array() as $key => $value) {
            if ($value['Maxcount'] == NULL) {
                $Countmax = "000001";
            } else {
                $Countmax = $value['Maxcount'];
            }
        }
        $store_slug_id = $store;
        $pos_store = $this->db->query("SELECT lpad(count(ID_INGREDIENT)+1,4,0) as Countstore FROM pos_ibi_stores WHERE ID_STORE<" . $store_slug_id . "")->result_array();
        $CountPosId = $pos_store[0]['Countstore'];


        $categoriePosId = str_pad($ref_categorie, 3, '0', STR_PAD_LEFT);

        $code = $CountPosId . "-" . $categoriePosId . "-" . $Countmax;

        return $code;
    }

    function getOneFilter($store, $criteres1, $criteres2, $criteres)
    {

        $query = $this->db->query('SELECT ar.DESIGN_ARTICLE as DESIGN_ARTICLE,ar.CODEBAR_ARTICLE as CODEBAR_ARTICLE,fl.REF_COMMAND_CODE_SF as REF_COMMAND_CODE_SF,fl.REF_ARTICLE_BARCODE_SF as codebar_sf,QUANTITE_SF as QUANTITE,fl.DATE_CREATION_SF AS DATE_SF,fl.REF_COMMAND_CODE_SF AS REF_CODE,fl.CREATED_BY_SF AS AUTHOR,fl.TYPE_SF FROM pos_store_' . $store . '_ibi_articles_stock_flow as fl LEFT JOIN pos_store_' . $store . '_ibi_articles as ar  ON fl.REF_ARTICLE_BARCODE_SF=ar.CODEBAR_ARTICLE WHERE ar.ID_ARTICLE=' . $criteres . ' AND DATE_CREATION_SF >="' . $criteres1 . '" AND DATE_CREATION_SF <="' . $criteres2 . '" order by DATE_CREATION_SF desc');

        //return ($query->num_rows() < 1) ? null : 
        return $query->result();
    }
    function getOneFilter_count($store, $criteres1, $criteres2, $criteres)
    {

        $query = $this->db->query('SELECT ar.DESIGN_ARTICLE as DESIGN_ARTICLE,ar.CODEBAR_ARTICLE as CODEBAR_ARTICLE,fl.REF_COMMAND_CODE_SF as REF_COMMAND_CODE_SF,fl.REF_ARTICLE_BARCODE_SF as codebar_sf,QUANTITE_SF as QUANTITE,fl.DATE_CREATION_SF AS DATE_SF,fl.REF_COMMAND_CODE_SF AS REF_CODE,fl.CREATED_BY_SF AS AUTHOR,fl.TYPE_SF FROM pos_store_' . $store . '_ibi_articles_stock_flow as fl LEFT JOIN pos_store_' . $store . '_ibi_articles as ar ON fl.REF_ARTICLE_BARCODE_SF=ar.CODEBAR_ARTICLE WHERE ar.ID_ARTICLE=' . $criteres . ' AND  DATE_CREATION_SF >="' . $criteres1 . '" AND DATE_CREATION_SF <="' . $criteres2 . '" order by DATE_CREATION_SF desc');
        return $query->num_rows();
    }

    function getOneFilter_ap($store, $criteres1, $criteres2, $criteres)
    {

        $query = $this->db->query('SELECT ar.DESIGN_ARTICLE as DESIGN_ARTICLE,ar.CODEBAR_ARTICLE as CODEBAR_ARTICLE,fl.REF_ARTICLE_BARCODE_SF as codebar_sf,QUANTITE_SF as QUANTITE,fl.DATE_CREATION_SF AS DATE_SF,fl.UNIT_PRICE_SF,fl.TOTAL_PRICE_SF,fl.REF_COMMAND_CODE_SF AS REF_CODE,fl.CREATED_BY_SF AS AUTHOR,fl.TYPE_SF FROM pos_store_' . $store . '_ibi_articles_stock_flow as fl LEFT JOIN pos_store_' . $store . '_ibi_articles as ar  ON fl.REF_ARTICLE_BARCODE_SF=ar.CODEBAR_ARTICLE WHERE ar.ID_ARTICLE=' . $criteres . ' AND DATE_CREATION_SF >="' . $criteres1 . '" AND DATE_CREATION_SF <="' . $criteres2 . '" and fl.TYPE_SF="stock_in" ');

        //return ($query->num_rows() < 1) ? null : 
        return $query->result();
    }
    function getOneFilter_count_ap($store, $criteres1, $criteres2, $criteres)
    {

        $query = $this->db->query('SELECT ar.DESIGN_ARTICLE as DESIGN_ARTICLE,ar.CODEBAR_ARTICLE as CODEBAR_ARTICLE,fl.REF_ARTICLE_BARCODE_SF as codebar_sf,QUANTITE_SF as QUANTITE,fl.DATE_CREATION_SF AS DATE_SF,fl.UNIT_PRICE_SF,fl.TOTAL_PRICE_SF,fl.REF_COMMAND_CODE_SF AS REF_CODE,fl.CREATED_BY_SF AS AUTHOR,fl.TYPE_SF FROM pos_store_' . $store . '_ibi_articles_stock_flow as fl LEFT JOIN pos_store_' . $store . '_ibi_articles as ar ON fl.REF_ARTICLE_BARCODE_SF=ar.CODEBAR_ARTICLE WHERE ar.ID_ARTICLE=' . $criteres . ' AND  DATE_CREATION_SF >="' . $criteres1 . '" AND DATE_CREATION_SF <="' . $criteres2 . '" and fl.TYPE_SF="stock_in" ');
        return $query->num_rows();
    }

  public function Get_ingredient()
  {
    # code...
  }

  public function get_total_product($product_id)
  {
      # code...
          $requete = $this->db->get_where(' pos_store_2_ibi_articles',array('ID_ARTICLE'=>$product_id,'IS_INGREDIENT'=>1))->row_array();
          return $requete;
  }

 
     public function trouver_article($store,$id)
      {
         $this->db->SELECT("i.*,d.INGREDIENT_QUANTITY,d.PRIX_DACHAT_ARTICLE_DETAIL");
         $this->db->FROM("pos_ibi_articles_details d,pos_store_".$store."_ibi_articles i");
         $this->db->WHERE("i.ID_ARTICLE=d.INGREDIENT_ID  AND   d.ARTICLE_ID=$id");
            $my_response = $this->db->get();
            if ($my_response->num_rows() > 0){
                return $my_response->result();  
            }else{
                return false;
            }
      }

}
//nturubika rothshild david
/* End of file Model_pos_store_1_ibi_articles.php */
/* Location: ./application/models/Model_pos_store_1_ibi_articles.php */