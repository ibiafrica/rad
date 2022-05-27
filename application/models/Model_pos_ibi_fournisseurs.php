<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_ibi_fournisseurs extends MY_Model {

	private $primary_key 	= 'ID_FOURNISSEUR';
	private $table_name 	= 'pos_ibi_fournisseurs';
	private $field_search 	= ['NOM_FOURNISSEUR', 'BP_FOURNISSEUR', 'TEL_FOURNISSEUR', 'EMAIL_FOURNISSEUR', 'DATE_CREATION_FOURNISSEUR', 'CREATED_BY_FOURNISSEUR'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}


  public function joinIngredientFounisseur($conditions){
	   $request = $this->db->distinct()
							->select('*')
							->from("pos_ibi_fournisseurs fournisseur")
							->join('pos_store_1_ibi_articles_stock_flow flow','flow.REF_PROVIDER_SF = fournisseur.ID_FOURNISSEUR')
							->join('pos_ibi_ingredients ingredient','ingredient.CODEBAR_INGREDIENT = flow.REF_ARTICLE_BARCODE_SF')

							->where($conditions)
							// ->group_by("DATE_CREATION_SF","MONTHS")
							->order_by("ID_FOURNISSEUR","DESC")
							->get();
						return $request->result();
				    
  }


  public function getRequete($requete){
      $query=$this->db->query($requete);
      if ($query) {
         return $query->result();
      }
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
	                $where .= "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable("")->filter_avaiable();
		        $this->db->where('DELETE_STATUS_FOURNISSEUR',0);
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}



   public function TB_fourn()
    {
        $store_prefix= $this->uri->segment(2);
        $table_name='pos_ibi_fournisseurs';
        return $table_name;
    }



	public function get($type,$q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_fournisseurs.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
	    $this->db->select('NOM_FOURNISSEUR, ID_FOURNISSEUR,BP_FOURNISSEUR,TEL_FOURNISSEUR,EMAIL_FOURNISSEUR,DATE_CREATION_FOURNISSEUR,username,  SUM(RESTE_PF) RESTE_PF, SUM(PAYER_PF) AS PAYER_PF', FALSE);
	    
		$this->join_avaiable($type)->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_FOURNISSEUR',0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_ibi_fournisseurs.'.$this->primary_key, "DESC");
        $this->db->group_by("pos_ibi_fournisseurs.ID_FOURNISSEUR");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable($t) {
        
        $this->db->join('aauth_users', 'aauth_users.id ='.$this->TB_fourn().'.CREATED_BY_FOURNISSEUR', 'LEFT');
        $this->db->join('pos_ibi_payement_fournisseur', 'pos_ibi_payement_fournisseur.FOURNISSEUR_ID ='.$this->TB_fourn().'.ID_FOURNISSEUR', 'LEFT');

        if ($t=='deb') {
          $this->db->having('SUM(RESTE_PF)>0');
        }

        if ($t=='red') {
          $this->db->having('SUM(RESTE_PF)<0');
        }
        

        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('CREATED_BY_FOURNISSEUR', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_pos_ibi_fournisseurs.php */
/* Location: ./application/models/Model_pos_ibi_fournisseurs.php */