<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_detail extends MY_Model {

    private $primary_key = ['id_dem_detail'];

    private $field_search 	=['id_dem_detail', 'id_dem_detail', 'article_id_dem_detail', 'created_at_dem_detail', 'modify_by_dem_detail', 'created_by_dem_detail', 'quantity_dem_detail', 'modify_at_dem_detail', 'prix_unitaire_detail'];


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
       $table_name     = 'demand_detail';
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
                    $where .= "OR " . "pos_ibi_clients.NOM_CLIENT LIKE '%" . $q . "%' ";
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
        $this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());
        
		return $query->result();
	}

    public function join_avaiable($store=0) {
        $this->db->join('pos_store_'.$store.'_ibi_articles art', 'art.ID_ARTICLE = '.$this->table_name().'.article_id_dem_detail', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('AUTHOR', get_user_data('id'));
        
        return $this;
    }
    public function shuffle_code(){
            
            $randomString = '';
            $datemonth=date('m');
            $maxdate='/'.date('m').'/'.date('Y');

            $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_PROFORMA,'".$maxdate."','') AS UNSIGNED)) as Maxcount from pos_store_1_ibi_proforma p1 WHERE MONTH(p1.DATE_CREATION_PROFORMA)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(CODE_PROFORMA,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_2_ibi_proforma p2 WHERE MONTH(p2.DATE_CREATION_PROFORMA)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(CODE_PROFORMA,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_3_ibi_proforma p3 WHERE MONTH(p3.DATE_CREATION_PROFORMA)='".$datemonth."')t");
            
            
             foreach ($lastid->result_array() as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="00001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }

            $date=date('Y-m-d');
            $annee=date("Y", strtotime($date));
            $mois=date("m", strtotime($date));


            $randomString = $Countmax.'/'.$mois.'/'.$annee;


        return $randomString;

    }
    function shuffle_code_recu(){

        $randomString = '';
            $datemonth=date('m');
            $maxdate='/'.date('m').'/'.date('Y');

            $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_RECU_PAIEMENT,'".$maxdate."','') AS UNSIGNED)) as Maxcount from pos_ibi_commandes_paiements p1 WHERE MONTH(p1.DATE_CREATION_PAIEMENT)='".$datemonth."')t");
            
             foreach ($lastid->result_array() as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="00001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }

            $date=date('Y-m-d');
            $annee=date("Y", strtotime($date));
            $mois=date("m", strtotime($date));


            $randomString = $Countmax.'/'.$mois.'/'.$annee;


        return $randomString;


    }
    function generate_invoice(){

            $randomString = '';
            $datemonth=date('m');
            $maxdate='/'.date('m').'/'.date('Y');

            $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,3,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_FACTURE,'".$maxdate."','') AS UNSIGNED)) as Maxcount from pos_ibi_facture f WHERE MONTH(f.DATE_CREATION_FACTURE)='".$datemonth."')t");
            
             foreach ($lastid->result_array() as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }

            $date=date('Y-m-d');
            $annee=date("Y", strtotime($date));
            $mois=date("m", strtotime($date));


            $randomString = $Countmax.'/'.$mois.'/'.$annee;


        return $randomString;

    }
    public function random_code($store_prefix)
    {
            $randomString = '';
            $dateyear=date('Y');
            $suffix='CC';

            $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_COMMAND,'".$suffix."','') AS UNSIGNED)) as Maxcount from pos_".$store_prefix."_ibi_commandes c WHERE YEAR(c.DATE_CREATION_COMMAND)='".$dateyear."')t");
            
             foreach ($lastid->result_array() as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="000001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }

            $randomString = $suffix.''.$Countmax;

        return $randomString;

    }
    function insert($table,$data){

    $query=$this->db->insert($table,$data);
    return ($query) ? true : false;

    }
    function insert_last_id($table, $data) {

        $query = $this->db->insert($table, $data);
       
       if ($query) {
            return $this->db->insert_id();
        }

    }
    function getOne($table, $criteres) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }
    public function getOneJoin($table,$table1,$criteres1,$table2,$criteres2,$critere=array())
    {
       $this->db->select('comd.*,auth.*,client.*');
       $this->db->from(''.$table.' comd');
       $this->db->join(''.$table1.' auth',$criteres1);
       $this->db->join(''.$table2.' client',$criteres2);
       $this->db->where($critere);

       $query = $this->db->get();
       if($query){
         return $query->row_array();
       }
    }
    function getList($table,$criteres = array()) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->result_array();
    }
    function record_countsome($table, $criteres)
    {
      $this->db->where($criteres);
       $query= $this->db->get($table);
       if($query)
       {
           return $query->num_rows();
       }
       
    }
    function update($table, $criteres, $data) {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }
    function delete($table,$criteres){
        $this->db->where($criteres);
        $query = $this->db->delete($table);
        return ($query) ? true : false;
    }
    function getSommes($table, $criteres = array(),$reste) {
        $this->db->select_sum($reste);
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    public function getListFilter($store, $criteres, $criteres1)
    {
      $where = 'DATE_CREATION_COMMAND >="'.$criteres.'" AND DATE_CREATION_COMMAND <="'.$criteres1.'"';
      $this->db->select('com.*,SUM(comp.PRIX_TOTAL_COMMAND_PROD) AS PRIX_TOTAL,SUM(comp.DISCOUNT_AMOUNT_COMMAND_PROD+comp.DISCOUNT_PERCENT_COMMAND_PROD) AS DISCOUNT_MONTANT');
      $this->db->from('pos_store_'.$store.'_ibi_commandes com');
      $this->db->join('pos_store_'.$store.'_ibi_commandes_produits comp','comp.REF_COMMAND_CODE_PROD = com.CODE_COMMAND');
      $this->db->where($where);
      $this->db->group_by('comp.REF_COMMAND_CODE_PROD');
      
      $query = $this->db->get();

      if($query){
        return $query->result();
      }
    }
    public function getListFilter_count($store, $criteres, $criteres1)
    {
      $where = 'DATE_CREATION_COMMAND >="'.$criteres.'" AND DATE_CREATION_COMMAND <="'.$criteres1.'"';
      $this->db->select('com.*');
      $this->db->from('pos_store_'.$store.'_ibi_commandes com');
      $this->db->join('pos_store_'.$store.'_ibi_commandes_produits comp','comp.REF_COMMAND_CODE_PROD = com.CODE_COMMAND');
      $this->db->where($where);
      $this->db->group_by('comp.REF_COMMAND_CODE_PROD');
      
      $query = $this->db->get();

      if($query){
        return $query->num_rows();
      }
    }

    public function get_quantite_reserve($store,$critere){

      $query = $this->db->query('SELECT SUM(QTE_RESERVE) AS QTE_RESERVE,REF_ARTICLE_BARCODE FROM (SELECT cp.REF_PRODUCT_CODEBAR_COMMAND_PROD AS REF_ARTICLE_BARCODE,sum(cp.QUANTITE_COMMAND_PROD) QTE_RESERVE FROM pos_store_'.$store.'_ibi_commandes_produits cp,pos_store_'.$store.'_ibi_requisition R WHERE cp.REF_COMMAND_CODE_PROD=R.REF_COMMAND_REQUISITION AND R.TYPE_REQUISITION = "ibi_order_attente" AND cp.REF_PRODUCT_CODEBAR_COMMAND_PROD = "'.$critere.'" AND R.STATUT_REQUISITION = 1 group by REF_PRODUCT_CODEBAR_COMMAND_PROD
                  
                                UNION ALL SELECT pp.REF_PRODUCT_CODEBAR_PROFORMA_PROD AS REF_ARTICLE_BARCODE, sum(pp.QUANTITE_PROFORMA_PROD) QTE_RESERVE FROM pos_store_'.$store.'_ibi_proforma_produits pp,pos_store_'.$store.'_ibi_requisition R1 WHERE pp.REF_PROFORMA_CODE_PROD=R1.REF_COMMAND_REQUISITION AND R1.TYPE_REQUISITION = "ibi_order_proforma" AND pp.REF_PRODUCT_CODEBAR_PROFORMA_PROD = "'.$critere.'" AND R1.STATUT_REQUISITION = 1 group by REF_PRODUCT_CODEBAR_PROFORMA_PROD
                              )t GROUP BY REF_ARTICLE_BARCODE');
      if($query){
        return $query->row_array();
      }
    }
    public function getSituation($criteres,$criteres1){

      $query = $this->db->query('SELECT DATES,NUMERO,MONTANT,entree,TYPE FROM (SELECT cp.DATE_CREATION_PAIEMENT AS DATES,cp.MONTANT_PAIEMENT AS MONTANT,cp.NUMERO_RECU_PAIEMENT AS NUMERO,"entree",cp.TYPE_PAIEMENT AS TYPE FROM pos_ibi_commandes_paiements cp UNION ALL SELECT dp.DATE_CREATION_DEPENSE AS DATES,dp.MONTANT_DEPENSE AS MONTANT,dp.NUMERO_DEPENSE AS NUMERO, "sortie", dp.FOURNITURE_DEPENSE AS TYPE FROM pos_ibi_depense dp)t WHERE DATES >="'.$criteres.'" AND DATES <="'.$criteres1.'" ORDER BY DATES DESC ');

      if($query){
        return $query->result();
      }

    }
    public function getSituation_count($criteres,$criteres1){

      $query = $this->db->query('SELECT DATES,NUMERO,MONTANT,entree,TYPE FROM (SELECT cp.DATE_CREATION_PAIEMENT AS DATES,cp.MONTANT_PAIEMENT AS MONTANT,cp.NUMERO_RECU_PAIEMENT AS NUMERO,"entree",cp.TYPE_PAIEMENT AS TYPE FROM pos_ibi_commandes_paiements cp UNION ALL SELECT dp.DATE_CREATION_DEPENSE AS DATES,dp.MONTANT_DEPENSE AS MONTANT,dp.NUMERO_DEPENSE AS NUMERO, "sortie", dp.FOURNITURE_DEPENSE AS TYPE FROM pos_ibi_depense dp)t WHERE DATES >="'.$criteres.'" AND DATES <="'.$criteres1.'" ORDER BY DATES DESC ');

      if($query){
        return $query->num_rows();
      }

    }

}

/* End of file Model_registers.php */
/* Location: ./application/models/Model_registers.php */