<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_pos_depenses extends MY_Model
{

	private $primary_key 	= 'ID_DEPENSE';
	private $table_name 	= 'pos_depenses';
	private $field_search 	= ['NOM_DEPENSE', 'MONTANT_DEPENSE', 'DESCRIPTION_DEPENSE', 'CREATE_BY_DEPENSE', 'DATE_CREATE_DEPENSE'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
			'table_name' 	=> $this->table_name,
			'field_search' 	=> $this->field_search,
		);

		parent::__construct($config);
	}

	public function count_all($date_start, $date_end, $q = null, $field = null)
	{

		$cat_search = $this->input->get('CATEGORIE_DEPENSE_UP');

		$critere_start = $date_start . " 00:00:00";
		$critere_end = $date_end . " 23:59:59";
		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_depenses." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_depenses." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_depenses." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->where('DELETE_STATUS_DEPENSE', 0);
		if (!empty($date_start) AND !empty($date_end)) {
			
					$this->db->where('DATE_CREATE_DEPENSE >=', $critere_start);
					$this->db->where('DATE_CREATE_DEPENSE <=', $critere_end);
			}

		if (!empty($cat_search)) {
			$this->db->where('ID_CATEGORIE_DEPENSE',$cat_search);
		}
		$query = $this->db->get($this->table_name);
		return $query->num_rows();
	}

	public function get($date_start, $date_end, $q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{

		$cat_search = $this->input->get('CATEGORIE_DEPENSE_UP');



		$critere_start = $date_start . " 00:00:00";
		$critere_end = $date_end . " 23:59:59";

		//print_r($select_field);die;

		$iterasi = 1;
		$num = count($this->field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($this->field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_depenses." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_depenses." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_depenses." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->where('DELETE_STATUS_DEPENSE', 0);

		if (!empty($date_start) AND !empty($date_end)) {
			
					$this->db->where('DATE_CREATE_DEPENSE >=', $critere_start);
					$this->db->where('DATE_CREATE_DEPENSE <=', $critere_end);
			}

		if (!empty($cat_search)) {
			$this->db->where('ID_CATEGORIE_DEPENSE',$cat_search);
		}

		$this->db->limit($limit, $offset);
		
		$this->db->order_by('pos_depenses.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable()
	{

		return $this;
	}

	public function filter_avaiable()
	{

		return $this;
	}


	public function impression_depense_pdf($table, $title)
	{
		$date_start = $this->uri->segment(4);
		$date_end = $this->uri->segment(5);


		$critere_start = $date_start . " 00:00:00";
		$critere_end = $date_end . " 23:59:59";


		$this->load->library('HtmlPdf');

		$config = array(
			'orientation' => 'p',
			'format' => 'a4',
			'marges' => array(5, 5, 5, 5)
		);

		$this->pdf = new HtmlPdf($config);

		if (empty($date_start) or empty($date_end)) {
			if ($this->uri->segment(3) == "index") {
				$this->db->where('ID_CATEGORIE_DEPENSE !=', 3);
				$this->db->where('ID_CATEGORIE_DEPENSE !=', 1);
			} else if ($this->uri->segment(3) == "dette_envers_tiers") {
				$this->db->where('ID_CATEGORIE_DEPENSE', 3);
			} else {
				$this->db->where('ID_CATEGORIE_DEPENSE', 1);
				// $this->db->where('ID_REQUISITION IS NOT NULL')->or_where("ID_APPROVISIONNEMENT IS NOT NULL");
			}
		} else {

			if ($this->uri->segment(3) == "index") {
				$this->db->where('ID_CATEGORIE_DEPENSE !=', 3);
				$this->db->where('ID_CATEGORIE_DEPENSE !=', 1);
				$this->db->where('DATE_CREATE_DEPENSE >=', $critere_start);
				$this->db->where('DATE_CREATE_DEPENSE <=', $critere_end);
			} else if ($this->uri->segment(3) == "dette_envers_tiers") {
				$this->db->where('ID_CATEGORIE_DEPENSE', 3);
				$this->db->where('DATE_CREATE_DEPENSE >=', $critere_start);
				$this->db->where('DATE_CREATE_DEPENSE <=', $critere_end);
			} else if ($this->uri->segment(3) == "paiement_comptant") {
				// $this->db->where('ID_APPROVISIONNEMENT IS NOT NULL')->or_where("ID_REQUISITION IS NOT NULL");
				$this->db->where('ID_CATEGORIE_DEPENSE', 1);
				$this->db->where('DATE_CREATE_DEPENSE >=', $critere_start);
				$this->db->where('DATE_CREATE_DEPENSE <=', $critere_end);
			} else {
				//    $this->db->where('DATE_CREATE_DEPENSE >=',$critere_start);
				//    $this->db->where('ID_CATEGORIE_DEPENSE',0);
				// $this->db->where('DATE_CREATE_DEPENSE <=',$critere_end);
				//    $this->db->where('ID_REQUISITION IS NOT NULL')->or_where("ID_APPROVISIONNEMENT IS NOT NULL");
			}
		}
		// $this->db->join('pos_categorie_depense','pos_categorie_depense.ID_CATEGORIE_DEPENSE = pos_depenses.ID_CATEGORIE_DEPENSE');
		$result = $this->db->get($table);
		$fields = $result->list_fields();

		$content = $this->pdf->loadHtmlPdf('core_template/pdf/pdf', [
			'results' => $result->result(),
			'fields' => $fields,
			'title' => $title
		], TRUE);

		$this->pdf->initialize($config);
		$this->pdf->pdf->SetDisplayMode('fullpage');
		$this->pdf->writeHTML($content);
		$this->pdf->Output($table . '.pdf', 'H');
	}
}

/* End of file Model_pos_depenses.php */
/* Location: ./application/models/Model_pos_depenses.php */