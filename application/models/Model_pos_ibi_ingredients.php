
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_ibi_ingredients extends MY_Model {

	private $primary_key 	= 'ID_ARTICLE';
	public $table_name 	= "pos_store_1_ibi_articles";
	private $field_search 	= ['DESIGN_ARTICLE', 'CODEBAR_ARTICLE', 'QUANTITY_ARTICLE', 'PRIX_DACHAT_ARTICLE', 'ETAT_INGREDIENT_ARTICLE', 'UNITE_ARTICLE', 'MINIMUM_QUANTITY_ARTICLE', 'DATE_CREATION_ARTICLE', 'CREATED_BY_ARTICLE'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}


 public function table_name_ingredient()
    {
        $store_prefix= $this->uri->segment(2);
        $table_name='pos_store_'.$store_prefix.'_ibi_articles';
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
                    $where .= "pos_store_".$this->uri->segment(2)."_ibi_articles." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "pos_store_".$this->uri->segment(2)."_ibi_articles." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }


            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "".$this->table_name_ingredient()."." . $field . " LIKE '%" . $q . "%' )";
        }

        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('IS_INGREDIENT', 1);
        $query = $this->db->get($this->table_name_ingredient());

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
	                $where .= "pos_store_".$this->uri->segment(2)."_ibi_articles.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_store_".$this->uri->segment(2)."_ibi_articles.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_store_".$this->uri->segment(2)."_ibi_articles.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by(' '.$this->table_name_ingredient().'.'.$this->primary_key, "DESC");
        // $this->db->order_by(''.$this->table_name().'.' . $this->primary_key, "DESC");

		$query = $this->db->get($this->table_name_ingredient());

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('etat_ingredients', 'etat_ingredients.NOM_ETAT ='.$this->table_name_ingredient().'.ETAT_INGREDIENT_ARTICLE', 'LEFT');
        $this->db->join('unite_ingredients', 'unite_ingredients.NOM_UNITE ='.$this->table_name_ingredient().'.UNITE_ARTICLE', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
		$show =1;
        $this->db->where('IS_INGREDIENT', $show);
        $this->db->where('DELETE_STATUS_ARTICLE',0);
        
        return $this;
	}
	

    public function My_id_for_user($table,$critere = array()){
        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->row_array();
    }




		public function INSERTION_DB($table,$data){
			$query=$this->db->insert($table,$data);
			if ($query) {
            return true;
			}else{
				return false;
			}
		}




	  function up($table,$condition,$data){
			$this->db->where($condition);
			$query=$this->db->update($table, $data);
			if ($query) {
            return true;
			}else{
				return false;
			}
	  }



			function one_off_article($table,$condition){
			$this->db->select('*');
			$this->db->where($condition);
			$query=$this->db->get($table);
			if ($query) {
            return $query->row_array();
			}
		}

	function all_in_article($table,$condition){
			$this->db->select('*');
			$this->db->where($condition);
			$query=$this->db->get($table);
			if ($query) {
            return $query->result();
			}
		}




}

/* End of file Model_pos_ibi_ingredients.php */
/* Location: ./application/models/Model_pos_ibi_ingredients.php */
