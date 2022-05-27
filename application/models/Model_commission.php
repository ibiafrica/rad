<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_commission extends MY_Model
{

	private $primary_key 	= 'ID_COMMISSION';
	//private $table_name 	= 'pos_store_1_ibi_commission';
	private $field_search 	= ['REF_COMMAND_CODE_COMMISSION', 'STATUT_COMMISSION', 'MONTANT_COMMISSION', 'SELLER', 'APPROUVED_BY_COMMISSION', 'CREATED_BY_COMMISSION', 'DATE_CREATION_COMMISSION', 'TYPE_COMMISSION'];

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
		$table_name     = 'pos_store_'.$store_prefix.'_ibi_commission';
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
					$where .= "". $this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "". $this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "". $this->table_name()."." . $field . " LIKE '%" . $q . "%' )";
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
					$where .= "". $this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "". $this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "". $this->table_name()."." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}

	function getData($table,$criteres = array()) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->result_array();
    }


	public function show_details($commande)
	{
		$store_prefix = $this->uri->segment(4);

		$query = $this->db->query("SELECT * FROM pos_store_'.$store_prefix.'_ibi_commandes_produits where REF_COMMAND_CODE_PROD='$commande'");




		//$products=$this->data['commandess'] ;


		$output = '<div class="modal-header">
		<h3>Détails de la commission</h3>
	 </div>
	 <div class="modal-body">
		<div class="row">
		   <div class="col-sm-12"><table><table cellspacing="0" cellpadding="0" border="0" id="flex1" class="table table-striped">
		   <thead class="thead-light">
			   <tr>
			   <th>Description</th><th>Quantité</th><th>Prix</th><th>Prix total</th>
			   </tr>
		   </thead>
		   <tbody>';

		foreach ($query->result() as $product) {



			$output .= '<tr>
            <td>' . $product->NAME_COMMAND_PROD . '</td>
            <td>' . $product->QUANTITE_COMMAND_PROD . '</td>
            <td>' . $product->PRIX_COMMAND_PROD . '</td>
            <td>' . $product->PRIX_TOTAL_COMMAND_PROD . '</td>
           </tr> ';
		}
		$output .= '</tbody></table></div>
		</div>
	 </div>
	 <div class="modal-footer"><button type="button" data-dismiss="modal">close</button></div>';
		echo $output;
	}

	public function insert($table, $data)
	{

		$query = $this->db->insert($table, $data);
		return ($query) ? true : false;
	}

	public function update($table, $criteres, $data)
	{
		$this->db->where($criteres);
		$query = $this->db->update($table, $data);
		return ($query) ? true : false;
	}

	public function approve($id){

		$data=
		['STATUT_COMMISSION'=>1,
		'APPROUVED_BY_COMMISSION'=>get_user_data('id'),
		];

		$this->db->where($this->primary_key, $id);

		$query=$this->db->update($this->table_name(), $data);

		return ($query) ? true : false;

	}

	public function join_avaiable()
	{

		return $this;
	}



	public function filter_avaiable()
	{
		// $this->db->where('CREATED_BY_COMMISSION', get_user_data('id'));

		return $this;
	}
}

/* End of file Model_commission.php */
/* Location: ./application/models/Model_commission.php */
