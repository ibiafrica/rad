<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_facturation extends MY_Model {

	private $primary_key 	= 'ID_FACTURE';
	private $table_name 	= 'pos_ibi_facture';
	private $field_search 	= ['NUMERO_FACTURE', 'REF_CODE_COMMAND_FACTURE', 'STORE_BY_FACTURE', 'DATE_CREATION_FACTURE', 'REF_CLIENT_FACTURE', 'AUTHOR_FACTURE', 'STATUT_FACTURE'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		$store = $this->uri->segment(4);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "pos_ibi_facture.".$field . " LIKE '%" . $q . "%' ";
	                $where .= "OR " . "pos_ibi_clients.NOM_CLIENT LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_facture.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	if($field == 'STATUT_FACTURE') {
        		$where .= "(" . "pos_ibi_facture.REF_CODE_COMMAND_FACTURE NOT IN (SELECT P.REF_COMMAND_CODE_PAIEMENT FROM pos_ibi_commandes_paiements P) AND pos_ibi_facture.REF_CODE_COMMAND_FACTURE NOT IN (SELECT PR.CODE_PROFORMA from pos_store_".$store."_ibi_proforma PR WHERE PR.PAYMENT_TYPE_PROFORMA = 'ibi_order_comptant')
				OR pos_ibi_facture.REF_CODE_COMMAND_FACTURE IN (SELECT PP.REF_COMMAND_CODE_PAIEMENT FROM pos_ibi_commandes_paiements PP WHERE PP.MONTANT_PAIEMENT = 0) AND pos_ibi_facture.REF_CODE_COMMAND_FACTURE NOT IN (SELECT PR.CODE_PROFORMA from pos_store_".$store."_ibi_proforma PR WHERE PR.PAYMENT_TYPE_PROFORMA = 'ibi_order_comptant'))";
        	}else {
        		$where .= "(" . "pos_ibi_facture.".$field . " LIKE '%" . $q . "%' )";
        	}
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);
		$store = $this->uri->segment(4);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "pos_ibi_facture.".$field . " LIKE '%" . $q . "%' ";
	                $where .= "OR " . "pos_ibi_clients.NOM_CLIENT LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_facture.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	if($field == 'STATUT_FACTURE') {
        		$where .= "(" . "pos_ibi_facture.REF_CODE_COMMAND_FACTURE NOT IN (SELECT P.REF_COMMAND_CODE_PAIEMENT FROM pos_ibi_commandes_paiements P) AND pos_ibi_facture.REF_CODE_COMMAND_FACTURE NOT IN (SELECT PR.CODE_PROFORMA from pos_store_".$store."_ibi_proforma PR WHERE PR.PAYMENT_TYPE_PROFORMA = 'ibi_order_comptant')
				OR pos_ibi_facture.REF_CODE_COMMAND_FACTURE IN (SELECT PP.REF_COMMAND_CODE_PAIEMENT FROM pos_ibi_commandes_paiements PP WHERE PP.MONTANT_PAIEMENT = 0) AND pos_ibi_facture.REF_CODE_COMMAND_FACTURE NOT IN (SELECT PR.CODE_PROFORMA from pos_store_".$store."_ibi_proforma PR WHERE PR.PAYMENT_TYPE_PROFORMA = 'ibi_order_comptant'))";
        	}else {
        		$where .= "(" . "pos_ibi_facture.".$field . " LIKE '%" . $q . "%' )";
        	}
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_ibi_facture.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT = pos_ibi_facture.REF_CLIENT_FACTURE', 'LEFT');
        return $this;
    }

    public function filter_avaiable() {
         $this->db->where('STORE_BY_FACTURE', $this->uri->segment(4));
        return $this;
    }
    public function getListFilter($store,$criteres1,$criteres2) {

    	$query = $this->db->query('SELECT * from pos_ibi_facture WHERE DATE_CREATION_FACTURE >="'.$criteres1.'" AND DATE_CREATION_FACTURE <="'.$criteres2.'" AND STORE_BY_FACTURE = '.$store.' AND STATUT_FACTURE = 0');
        return $query->result();
    }
    public function getListFilter_count($store,$criteres1,$criteres2) {

    	$query = $this->db->query('SELECT * from pos_ibi_facture WHERE DATE_CREATION_FACTURE >="'.$criteres1.'" AND DATE_CREATION_FACTURE <="'.$criteres2.'" AND STORE_BY_FACTURE = '.$store.' AND STATUT_FACTURE = 0');
        return $query->num_rows();
    }
    public function getListReport($store,$criteres,$criteres1)
    {
      $this->db->query('SET SQL_BIG_SELECTS=1');
	  $query = $this->db->query('SELECT fact.NUMERO_FACTURE,fact.REF_CODE_COMMAND_FACTURE,
	  fact.TYPE_FACTURE,fact.AUTHOR_FACTURE,fact.DATE_CREATION_FACTURE,fact.REF_CLIENT_FACTURE 
	  FROM pos_ibi_facture fact WHERE STORE_BY_FACTURE='.$store.' AND 
	  DATE_CREATION_FACTURE >="'.$criteres.'" AND DATE_CREATION_FACTURE <="'.$criteres1.'" 
	  AND STATUT_FACTURE=0');
    //   $query = $this->db->query('SELECT DISTINCT FACTURE.NUMERO_FACTURE,FACTURE.REF_CODE_COMMAND_FACTURE,FACTURE.TYPE_FACTURE,FACTURE.AUTHOR_FACTURE,FACTURE.DATE_CREATION_FACTURE,FACTURE.REF_CLIENT_FACTURE,CPROD.REF_PRODUCT_CODEBAR_COMMAND_PROD,PPROD.REF_PRODUCT_CODEBAR_PROFORMA_PROD,CPROD.NAME_COMMAND_PROD,PPROD.NAME_PROFORMA_PROD,CPROD.QUANTITE_COMMAND_PROD,PPROD.QUANTITE_PROFORMA_PROD,CPROD.PRIX_COMMAND_PROD,PPROD.PRIX_PROFORMA_PROD,CPROD.PRIX_TOTAL_COMMAND_PROD,PPROD.PRIX_TOTAL_PROFORMA_PROD,CPROD.DISCOUNT_PERCENT_COMMAND_PROD,PPROD.DISCOUNT_PERCENT_PROFORMA_PROD,CPROD.DISCOUNT_AMOUNT_COMMAND_PROD,PPROD.DISCOUNT_AMOUNT_PROFORMA_PROD FROM (SELECT fact.NUMERO_FACTURE,fact.REF_CODE_COMMAND_FACTURE,fact.TYPE_FACTURE,fact.AUTHOR_FACTURE,fact.DATE_CREATION_FACTURE,fact.REF_CLIENT_FACTURE FROM pos_ibi_facture fact WHERE STORE_BY_FACTURE='.$store.' AND DATE_CREATION_FACTURE >="'.$criteres.'" AND DATE_CREATION_FACTURE <="'.$criteres1.'" AND STATUT_FACTURE=0 ) FACTURE

    // 		LEFT JOIN (SELECT REF_PRODUCT_CODEBAR_COMMAND_PROD,REF_COMMAND_CODE_PROD,NAME_COMMAND_PROD,QUANTITE_COMMAND_PROD,PRIX_COMMAND_PROD,PRIX_TOTAL_COMMAND_PROD,DISCOUNT_AMOUNT_COMMAND_PROD,DISCOUNT_PERCENT_COMMAND_PROD FROM (SELECT CP.REF_PRODUCT_CODEBAR_COMMAND_PROD,CP.REF_COMMAND_CODE_PROD,CP.NAME_COMMAND_PROD,CP.QUANTITE_COMMAND_PROD,CP.PRIX_COMMAND_PROD,CP.PRIX_TOTAL_COMMAND_PROD,CP.DISCOUNT_AMOUNT_COMMAND_PROD,CP.DISCOUNT_PERCENT_COMMAND_PROD FROM pos_store_'.$store.'_ibi_commandes_produits CP,pos_ibi_facture F WHERE CP.REF_COMMAND_CODE_PROD=F.REF_CODE_COMMAND_FACTURE AND F.TYPE_FACTURE="is_commande" AND F.STATUT_FACTURE=0 )t )CPROD ON FACTURE.REF_CODE_COMMAND_FACTURE=CPROD.REF_COMMAND_CODE_PROD
            
    //         LEFT JOIN (SELECT REF_PRODUCT_CODEBAR_PROFORMA_PROD,REF_PROFORMA_CODE_PROD,NAME_PROFORMA_PROD,QUANTITE_PROFORMA_PROD,PRIX_PROFORMA_PROD,PRIX_TOTAL_PROFORMA_PROD,DISCOUNT_AMOUNT_PROFORMA_PROD,DISCOUNT_PERCENT_PROFORMA_PROD FROM (SELECT PP.REF_PRODUCT_CODEBAR_PROFORMA_PROD,PP.REF_PROFORMA_CODE_PROD,PP.NAME_PROFORMA_PROD,PP.QUANTITE_PROFORMA_PROD,PP.PRIX_PROFORMA_PROD,PP.PRIX_TOTAL_PROFORMA_PROD,PP.DISCOUNT_AMOUNT_PROFORMA_PROD,PP.DISCOUNT_PERCENT_PROFORMA_PROD FROM pos_store_'.$store.'_ibi_proforma_produits PP,pos_ibi_facture F1 WHERE PP.REF_PROFORMA_CODE_PROD=F1.REF_CODE_COMMAND_FACTURE AND F1.TYPE_FACTURE="is_proforma" AND F1.STATUT_FACTURE=0 )t )PPROD ON FACTURE.REF_CODE_COMMAND_FACTURE=PPROD.REF_PROFORMA_CODE_PROD');
       
	      if($query){
	        return $query->result();
	      }
    }
     public function getListReport_count($store,$criteres,$criteres1)
    {
      $this->db->query('SET SQL_BIG_SELECTS=1');
      $query = $this->db->query('SELECT FACTURE.NUMERO_FACTURE,FACTURE.REF_CODE_COMMAND_FACTURE,FACTURE.TYPE_FACTURE,FACTURE.AUTHOR_FACTURE,FACTURE.DATE_CREATION_FACTURE,FACTURE.REF_CLIENT_FACTURE,CPROD.REF_PRODUCT_CODEBAR_COMMAND_PROD,PPROD.REF_PRODUCT_CODEBAR_PROFORMA_PROD,CPROD.NAME_COMMAND_PROD,PPROD.NAME_PROFORMA_PROD,CPROD.QUANTITE_COMMAND_PROD,PPROD.QUANTITE_PROFORMA_PROD,CPROD.PRIX_COMMAND_PROD,PPROD.PRIX_PROFORMA_PROD,CPROD.PRIX_TOTAL_COMMAND_PROD,PPROD.PRIX_TOTAL_PROFORMA_PROD,CPROD.DISCOUNT_PERCENT_COMMAND_PROD,PPROD.DISCOUNT_PERCENT_PROFORMA_PROD,CPROD.DISCOUNT_AMOUNT_COMMAND_PROD,PPROD.DISCOUNT_AMOUNT_PROFORMA_PROD FROM (SELECT fact.NUMERO_FACTURE,fact.REF_CODE_COMMAND_FACTURE,fact.TYPE_FACTURE,fact.AUTHOR_FACTURE,fact.DATE_CREATION_FACTURE,fact.REF_CLIENT_FACTURE FROM pos_ibi_facture fact WHERE STORE_BY_FACTURE='.$store.' AND DATE_CREATION_FACTURE >="'.$criteres.'" AND DATE_CREATION_FACTURE <="'.$criteres1.'" AND STATUT_FACTURE=0 ) FACTURE

    		LEFT JOIN (SELECT REF_PRODUCT_CODEBAR_COMMAND_PROD,REF_COMMAND_CODE_PROD,NAME_COMMAND_PROD,QUANTITE_COMMAND_PROD,PRIX_COMMAND_PROD,PRIX_TOTAL_COMMAND_PROD,DISCOUNT_AMOUNT_COMMAND_PROD,DISCOUNT_PERCENT_COMMAND_PROD FROM (SELECT CP.REF_PRODUCT_CODEBAR_COMMAND_PROD,CP.REF_COMMAND_CODE_PROD,CP.NAME_COMMAND_PROD,CP.QUANTITE_COMMAND_PROD,CP.PRIX_COMMAND_PROD,CP.PRIX_TOTAL_COMMAND_PROD,CP.DISCOUNT_AMOUNT_COMMAND_PROD,CP.DISCOUNT_PERCENT_COMMAND_PROD FROM pos_store_'.$store.'_ibi_commandes_produits CP,pos_ibi_facture F WHERE CP.REF_COMMAND_CODE_PROD=F.REF_CODE_COMMAND_FACTURE AND F.TYPE_FACTURE="is_commande" AND F.STATUT_FACTURE=0 )t )CPROD ON FACTURE.REF_CODE_COMMAND_FACTURE=CPROD.REF_COMMAND_CODE_PROD
            
            LEFT JOIN (SELECT REF_PRODUCT_CODEBAR_PROFORMA_PROD,REF_PROFORMA_CODE_PROD,NAME_PROFORMA_PROD,QUANTITE_PROFORMA_PROD,PRIX_PROFORMA_PROD,PRIX_TOTAL_PROFORMA_PROD,DISCOUNT_AMOUNT_PROFORMA_PROD,DISCOUNT_PERCENT_PROFORMA_PROD FROM (SELECT PP.REF_PRODUCT_CODEBAR_PROFORMA_PROD,PP.REF_PROFORMA_CODE_PROD,PP.NAME_PROFORMA_PROD,PP.QUANTITE_PROFORMA_PROD,PP.PRIX_PROFORMA_PROD,PP.PRIX_TOTAL_PROFORMA_PROD,PP.DISCOUNT_AMOUNT_PROFORMA_PROD,PP.DISCOUNT_PERCENT_PROFORMA_PROD FROM pos_store_'.$store.'_ibi_proforma_produits PP,pos_ibi_facture F1 WHERE PP.REF_PROFORMA_CODE_PROD=F1.REF_CODE_COMMAND_FACTURE AND F1.TYPE_FACTURE="is_proforma" AND F1.STATUT_FACTURE=0 )t )PPROD ON FACTURE.REF_CODE_COMMAND_FACTURE=PPROD.REF_PROFORMA_CODE_PROD');
       
	      if($query){
	        return $query->num_rows();
	      }
    }
    public function get_not_paid($store, $critere1, $critere2) {
    	$query = $this->db->query('SELECT * FROM pos_ibi_facture F, pos_ibi_commandes_paiements PA 
				WHERE F.REF_CODE_COMMAND_FACTURE LIKE "%'.$critere2.'%" AND F.REF_CODE_COMMAND_FACTURE NOT IN (SELECT P.REF_COMMAND_CODE_PAIEMENT FROM pos_ibi_commandes_paiements P) AND F.STORE_BY_FACTURE = '.$store.' AND F.NUMERO_FACTURE LIKE "%'.$critere1.'%" AND YEAR(F.DATE_CREATION_FACTURE) LIKE "%2021%" AND F.REF_CODE_COMMAND_FACTURE NOT IN (SELECT PR.CODE_PROFORMA from pos_store_'.$store.'_ibi_proforma PR WHERE PR.PAYMENT_TYPE_PROFORMA = "ibi_order_comptant")
				OR F.REF_CODE_COMMAND_FACTURE LIKE "%'.$critere2.'%" AND F.REF_CODE_COMMAND_FACTURE IN (SELECT PP.REF_COMMAND_CODE_PAIEMENT FROM pos_ibi_commandes_paiements PP WHERE PP.MONTANT_PAIEMENT = 0) AND F.STORE_BY_FACTURE = '.$store.' AND F.NUMERO_FACTURE LIKE "%'.$critere1.'%" AND YEAR(F.DATE_CREATION_FACTURE) LIKE "%2021%" AND F.REF_CODE_COMMAND_FACTURE NOT IN (SELECT PR.CODE_PROFORMA from pos_store_'.$store.'_ibi_proforma PR WHERE PR.PAYMENT_TYPE_PROFORMA = "ibi_order_comptant") GROUP BY F.NUMERO_FACTURE ORDER BY F.ID_FACTURE DESC');
    	if($query){
	        return $query->result();
	     }
    }
    public function count_not_paid($store, $critere1, $critere2) {
    	$query = $this->db->query('SELECT * FROM pos_ibi_facture F, pos_ibi_commandes_paiements PA 
				WHERE F.REF_CODE_COMMAND_FACTURE LIKE "%'.$critere2.'%" AND F.REF_CODE_COMMAND_FACTURE NOT IN (SELECT P.REF_COMMAND_CODE_PAIEMENT FROM pos_ibi_commandes_paiements P) AND F.STORE_BY_FACTURE = '.$store.' AND F.NUMERO_FACTURE LIKE "%'.$critere1.'%" AND YEAR(F.DATE_CREATION_FACTURE) LIKE "%2021%" AND F.REF_CODE_COMMAND_FACTURE NOT IN (SELECT PR.CODE_PROFORMA from pos_store_'.$store.'_ibi_proforma PR WHERE PR.PAYMENT_TYPE_PROFORMA = "ibi_order_comptant") 
				OR F.REF_CODE_COMMAND_FACTURE LIKE "%'.$critere2.'%" AND F.REF_CODE_COMMAND_FACTURE IN (SELECT PP.REF_COMMAND_CODE_PAIEMENT FROM pos_ibi_commandes_paiements PP WHERE PP.MONTANT_PAIEMENT = 0) AND F.STORE_BY_FACTURE = '.$store.' AND F.NUMERO_FACTURE LIKE "%'.$critere1.'%" AND YEAR(F.DATE_CREATION_FACTURE) LIKE "%2021%" AND F.REF_CODE_COMMAND_FACTURE NOT IN (SELECT PR.CODE_PROFORMA from pos_store_'.$store.'_ibi_proforma PR WHERE PR.PAYMENT_TYPE_PROFORMA = "ibi_order_comptant") GROUP BY F.NUMERO_FACTURE ORDER BY F.ID_FACTURE DESC');
    	if($query){
	        return $query->num_rows();
	     }
    }
}

/* End of file Model_facturation.php */
/* Location: ./application/models/Model_facturation.php */