<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_outillages extends MY_Model {

	private $primary_key 	= 'ID_OUTILLAGE';
	// private $table_name 	= 'pos_store_3_ibi_outillages';
	private $field_search 	= ['DESIGN_OUTILLAGE', 'REF_RAYON_OUTILLAGE', 'REF_CATEGORIE_OUTILLAGE', 'REF_SOUS_CATEGORIE_OUTILLAGE', 'SKU_OUTILLAGE', 'STATUS_OUTILLAGE', 'PRIX_DE_VENTE_OUTILLAGE', 'DESCRIPTION_OUTILLAGE', 'APERCU_OUTILLAGE', 'CODEBAR_OUTILLAGE', 'AUTHOR_OUTILLAGE'];

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
       $table_name     = 'pos_store_'.$store_prefix.'_ibi_outillages';
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
    $this->db->order_by(''.$this->table_name().'.QUANTITE_RESTANTE_OUTILLAGE', "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}



  public function join_avaiable() 
  {
    $this->db->join('pos_store_'.$this->uri->segment(4).'_ibi_rayons', 'pos_store_'.$this->uri->segment(4).'_ibi_rayons.ID_RAYON = '.$this->table_name().'.REF_RAYON_OUTILLAGE', 'LEFT');
    $this->db->join('aauth_users', 'aauth_users.id = '.$this->table_name().'.AUTHOR_OUTILLAGE', 'LEFT');
    $this->db->join('pos_store_'.$this->uri->segment(4).'_famille', 'pos_store_'.$this->uri->segment(4).'_famille.ID_FAMILLE = pos_store_'.$this->uri->segment(4).'_ibi_outillages.REF_CATEGORIE_OUTILLAGE', 'LEFT');
    
    return $this;
  }

    public function filter_avaiable() {
        // $this->db->where('AUTHOR_OUTILLAGE', get_user_data('id'));
        
        return $this;
    }
     public function generate_barcode($store,$ref_categorie){
        
        $lastid = $this->db->query("SELECT lpad(max(ID_OUTILLAGE)+1,6,0) as Maxcount FROM pos_store_".$store."_ibi_outillages");
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

  public function random_code($store)
  {
      $randomString = '';
      $dateyear=date('Y');
      $suffix='OUT';

      $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_OUTILS,'".$suffix."','') AS UNSIGNED)) as Maxcount from pos_store_".$store."_ibi_outils outils WHERE YEAR(outils.DATE_CREATION_OUTILS)='".$dateyear."')t");
          
      foreach ($lastid->result_array() as $key => $value) {
          if ($value['Maxcounts']==null) {
              $Countmax="000001";
          } else {
              $Countmax=$value['Maxcounts'];
          }
      }

      $randomString = $suffix.''.$Countmax.'-'.$dateyear;

      return $randomString;
  }

  public function count_all_exit($q = null, $field = null)
  {
    $field_search   = ['TITRE_OUTILS', 'CODE_OUTILS', 'DATE_CREATION_OUTILS', 'AUTHOR_OUTILS'];

    $iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);
    $store = 3;

        if (empty($field)) {
          foreach ($field_search as $field) {
              if ($iterasi == 1) {
                  $where .= "pos_store_".$store."_ibi_outils.".$field . " LIKE '%" . $q . "%' ";
              } else {
                  $where .= "OR " . "pos_store_".$store."_ibi_outils.".$field . " LIKE '%" . $q . "%' ";
              }
              $iterasi++;
          }

          $where = '('.$where.')';
        } else {
          $where .= "(" . "pos_store_".$store."_ibi_outils.".$field . " LIKE '%" . $q . "%' )";
        }

    $this->join_avaiable_exit($store)->filter_avaiable();
    $this->db->where($where);
    $query = $this->db->get("pos_store_".$store."_ibi_outils");

    return $query->num_rows();
  }

  
  public function get_exit($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
  {
    $field_search   = ['TITRE_OUTILS', 'CODE_OUTILS', 'DATE_CREATION_OUTILS', 'AUTHOR_OUTILS'];

    $iterasi = 1;
    $num = count($field_search);
    $where = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);
    $store = 3;

        if (empty($field)) {
          foreach ($field_search as $field) {
              if ($iterasi == 1) {
                  $where .= "pos_store_".$store."_ibi_outils.".$field . " LIKE '%" . $q . "%' ";
              } else {
                  $where .= "OR " . "pos_store_".$store."_ibi_outils.".$field . " LIKE '%" . $q . "%' ";
              }
              $iterasi++;
          }

          $where = '('.$where.')';
        } else {
          $where .= "(" . "pos_store_".$store."_ibi_outils.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
          $this->db->select($select_field);
        }
    
    $this->join_avaiable_exit($store)->filter_avaiable();
    $this->db->where($where);
    $this->db->limit($limit, $offset);
    $query = $this->db->get("pos_store_".$store."_ibi_outils");
 
    return $query->result();
  }

  public function join_avaiable_exit($store) 
  {
    $this->db->join('aauth_users', 'aauth_users.id = pos_store_'.$store.'_ibi_outils.AUTHOR_OUTILS', 'LEFT');
    
    return $this;
  }
 
  
}

/* End of file model_outillages.php */
/* Location: ./application/models/model_outillages.php */