<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_registers extends MY_Model
{
    private $primary_key 	= 'ID_COMMAND';
    // private $table_name     = 'pos_store_2_ibi_commandes'
    private $field_search 	= ['TITRE_COMMAND', 'CODE_COMMAND', 'TITRE_COMMAND', 'REF_CLIENT_COMMAND', 'DATE_CREATION_COMMAND', 'DATE_MOD_COMMAND', 'AUTHOR_COMMAND'];

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
        $store_prefix = $this->uri->segment(4);
        $table_name     = 'pos_store_'.$store_prefix.'_ibi_commandes';
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

        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('STATUT_COMMAND',0);
        $query = $this->db->get($this->table_name());
        
        return $query->num_rows();
    }

    public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = null;
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

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }
        
        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('STATUT_COMMAND',0);
        $this->db->limit($limit, $offset);
        $this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
        $query = $this->db->get($this->table_name());
        
        return $query->result();
    }

    public function join_avaiable()
    {
        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT = '.$this->table_name().'.REF_CLIENT_COMMAND', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable()
    {
        // $this->db->where('AUTHOR', get_user_data('id'));
        
        return $this;
    }
    public function shuffle_code()
    {
        $randomString = '';
        $datemonth=date('m');
        $dateyear=date('Y');
        $maxdate='/'.date('m').'/'.date('Y');

        $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_PROFORMA,'".$maxdate."','') AS UNSIGNED)) as Maxcount from pos_store_1_ibi_proforma p1 WHERE YEAR(p1.DATE_CREATION_PROFORMA)='".$dateyear."' AND MONTH(p1.DATE_CREATION_PROFORMA)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(CODE_PROFORMA,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_2_ibi_proforma p2 WHERE YEAR(p2.DATE_CREATION_PROFORMA)='".$dateyear."' AND MONTH(p2.DATE_CREATION_PROFORMA)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(CODE_PROFORMA,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_3_ibi_proforma p3 WHERE YEAR(p3.DATE_CREATION_PROFORMA)='".$dateyear."' AND MONTH(p3.DATE_CREATION_PROFORMA)='".$datemonth."')t");
            
            
        foreach ($lastid->result_array() as $key => $value) {
            if ($value['Maxcounts']==null) {
                $Countmax="00001";
            } else {
                $Countmax=$value['Maxcounts'];
            }
        }

        $date=date('Y-m-d');
        $annee=date("Y", strtotime($date));
        $mois=date("m", strtotime($date));


        $randomString = $Countmax.'/'.$mois.'/'.$annee;


        return $randomString;
    }
    public function shuffle_code_recu()
    {
        $randomString = '';
        $datemonth=date('m');
        $dateyear=date('Y');
        $maxdate='/'.date('m').'/'.date('Y');

        $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_RECU_PAIEMENT,'".$maxdate."','') AS UNSIGNED)) as Maxcount from pos_ibi_commandes_paiements p1 WHERE YEAR(p1.DATE_CREATION_PAIEMENT)='".$dateyear."' AND MONTH(p1.DATE_CREATION_PAIEMENT)='".$datemonth."')t");
            
        foreach ($lastid->result_array() as $key => $value) {
            if ($value['Maxcounts']==null) {
                $Countmax="00001";
            } else {
                $Countmax=$value['Maxcounts'];
            }
        }

        $date=date('Y-m-d');
        $annee=date("Y", strtotime($date));
        $mois=date("m", strtotime($date));


        $randomString = $Countmax.'/'.$mois.'/'.$annee;


        return $randomString;
    }
    public function generate_invoice()
    {
        $randomString = '';
        $datemonth=date('m');
        $dateyear=date('Y');
        $maxdate='/'.date('m').'/'.date('Y');

        $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,3,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_FACTURE,'".$maxdate."','') AS UNSIGNED)) as Maxcount from pos_ibi_facture f WHERE YEAR(f.DATE_CREATION_FACTURE)='".$dateyear."' AND MONTH(f.DATE_CREATION_FACTURE)='".$datemonth."')t");
            
        foreach ($lastid->result_array() as $key => $value) {
            if ($value['Maxcounts']==null) {
                $Countmax="001";
            } else {
                $Countmax=$value['Maxcounts'];
            }
        }

        $date=date('Y-m-d');
        $annee=date("Y", strtotime($date));
        $mois=date("m", strtotime($date));


        $randomString = $Countmax.'/'.$mois.'/'.$annee;


        return $randomString;
    }
    public function random_code($store)
    {
        $randomString = '';
        $dateyear=date('Y');
        $suffix='CC';

        $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_COMMAND,'".$suffix."','') AS UNSIGNED)) as Maxcount from pos_store_".$store."_ibi_commandes c WHERE YEAR(c.DATE_CREATION_COMMAND)='".$dateyear."')t");
            
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
    public function insert($table, $data)
    {
        $query=$this->db->insert($table, $data);
        return ($query) ? true : false;
    }
    public function insert_last_id($table, $data)
    {
        $query = $this->db->insert($table, $data);
       
        if ($query) {
            return $this->db->insert_id();
        }
    }
    public function insert_batch($table,$data){
      
        $query = $this->db->insert_batch($table, $data);

        return ($query) ? true : false;

    }
    public function getOne($table, $criteres = array())
    {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }
    public function getOneJoin($table, $table1, $criteres1, $table2, $criteres2, $critere=array())
    {
        $this->db->select('comd.*,auth.*,client.*');
        $this->db->from(''.$table.' comd');
        $this->db->join(''.$table1.' auth', $criteres1);
        $this->db->join(''.$table2.' client', $criteres2);
        $this->db->where($critere);

        $query = $this->db->get();
        if ($query) {
            return $query->row_array();
        }
    }
    public function getList($table, $criteres = array())
    {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->result_array();
    }
    public function record_countsome($table, $criteres)
    {
        $this->db->where($criteres);
        $query= $this->db->get($table);
        if ($query) {
            return $query->num_rows();
        }
    }
    public function update($table, $criteres, $data)
    {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }
    public function update_batch($table,$data){
      
        $query = $this->db->update_batch($table, $data);
        
        return ($query) ? true : false;

    }
    public function delete($table, $criteres)
    {
        $this->db->where($criteres);
        $query = $this->db->delete($table);
        return ($query) ? true : false;
    }

    public function get_user_info($table_name,$id,$contrainte){
        $get_info=$this->db->query("select * from ".$table_name." where ".$contrainte."=".$id."");
        if($get_info->num_rows()>0){
            return $get_info->result();
        }
        else{
            return 0;
        }
    }
    
    public function getSommes($table, $criteres = array(), $reste)
    {
        $this->db->select_sum($reste);
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    public function getListFilter($store, $criteres, $criteres1)
    {
        $where = 'DATE_CREATION_COMMAND >="'.$criteres.'" AND DATE_CREATION_COMMAND <="'.$criteres1.'" AND STATUT_COMMAND = 0';
        $this->db->select('com.*,SUM(comp.PRIX_TOTAL_COMMAND_PROD) AS PRIX_TOTAL,SUM(comp.DISCOUNT_AMOUNT_COMMAND_PROD+comp.DISCOUNT_PERCENT_COMMAND_PROD) AS DISCOUNT_MONTANT');
        $this->db->from('pos_store_'.$store.'_ibi_commandes com');
        $this->db->join('pos_store_'.$store.'_ibi_commandes_produits comp', 'comp.REF_COMMAND_CODE_PROD = com.CODE_COMMAND');
        $this->db->where($where);
        $this->db->group_by('comp.REF_COMMAND_CODE_PROD');
      
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        }
    }
    public function getListFilter_count($store, $criteres, $criteres1)
    {
        $where = 'DATE_CREATION_COMMAND >="'.$criteres.'" AND DATE_CREATION_COMMAND <="'.$criteres1.'" AND STATUT_COMMAND = 0';
        $this->db->select('com.*');
        $this->db->from('pos_store_'.$store.'_ibi_commandes com');
        $this->db->join('pos_store_'.$store.'_ibi_commandes_produits comp', 'comp.REF_COMMAND_CODE_PROD = com.CODE_COMMAND');
        $this->db->where($where);
        $this->db->group_by('comp.REF_COMMAND_CODE_PROD');
      
        $query = $this->db->get();

        if ($query) {
            return $query->num_rows();
        }
    }

    public function get_quantite_reserve($store, $critere, $date_search = '')
    {
        $query = $this->db->query('SELECT SUM(QTE_RESERVE) AS QTE_RESERVE,REF_ARTICLE_BARCODE FROM (SELECT cp.REF_PRODUCT_CODEBAR_COMMAND_PROD AS REF_ARTICLE_BARCODE,sum(cp.QUANTITE_COMMAND_PROD) QTE_RESERVE FROM pos_store_'.$store.'_ibi_commandes_produits cp,pos_store_'.$store.'_ibi_requisition R WHERE cp.REF_COMMAND_CODE_PROD=R.REF_COMMAND_REQUISITION AND R.TYPE_REQUISITION = "ibi_order_attente" AND cp.REF_PRODUCT_CODEBAR_COMMAND_PROD = "'.$critere.'" AND R.STATUT_REQUISITION = 1 AND R.DATE_CREATION_REQUISITION LIKE "%'.$date_search.'%" group by REF_PRODUCT_CODEBAR_COMMAND_PROD
                  
                                UNION ALL SELECT pp.REF_PRODUCT_CODEBAR_PROFORMA_PROD AS REF_ARTICLE_BARCODE, sum(pp.QUANTITE_PROFORMA_PROD) QTE_RESERVE FROM pos_store_'.$store.'_ibi_proforma_produits pp,pos_store_'.$store.'_ibi_requisition R1 WHERE pp.REF_PROFORMA_CODE_PROD=R1.REF_COMMAND_REQUISITION AND R1.TYPE_REQUISITION = "ibi_order_proforma" AND pp.REF_PRODUCT_CODEBAR_PROFORMA_PROD = "'.$critere.'" AND R1.STATUT_REQUISITION = 1 AND R1.DATE_CREATION_REQUISITION LIKE "%'.$date_search.'%" group by REF_PRODUCT_CODEBAR_PROFORMA_PROD
                              )t GROUP BY REF_ARTICLE_BARCODE');
        if ($query) {
            return $query->row_array();
        }
    }

    public function get_quantite_reserve1($store, $critere, $date_search = '')
    {
        $query = $this->db->query('SELECT SUM(QTE_RESERVE) AS QTE_RESERVE,REF_ARTICLE_BARCODE FROM (SELECT fp.REF_PRODUCT_CODEBAR_FICHE_PROD AS REF_ARTICLE_BARCODE,sum(fp.QUANTITE_FICHE_PROD+fp.QUANTITE_ADD_FICHE_PROD) QTE_RESERVE FROM pos_store_'.$store.'_ibi_fiche_produits fp,pos_store_'.$store.'_ibi_fiche_travail FT WHERE fp.ID_FICHE=FT.ID_FICHE AND fp.REF_PRODUCT_CODEBAR_FICHE_PROD = "'.$critere.'" group by REF_PRODUCT_CODEBAR_FICHE_PROD)t GROUP BY REF_ARTICLE_BARCODE');
        if ($query) {
            return $query->row_array();
        }
    }
    public function getSituation($criteres, $criteres1)
    {
        $query = $this->db->query('SELECT DATES,NUMERO,MONTANT,entree,TYPE,REF_CODE,STORE FROM (SELECT cp.DATE_CREATION_PAIEMENT AS DATES,cp.MONTANT_PAIEMENT AS MONTANT,cp.NUMERO_RECU_PAIEMENT AS NUMERO,"entree",cp.TYPE_PAIEMENT AS TYPE,cp.REF_COMMAND_CODE_PAIEMENT AS REF_CODE,cp.STORE_BY_PAIEMENT AS STORE FROM pos_ibi_commandes_paiements cp UNION ALL SELECT dp.DATE_CREATION_DEPENSE AS DATES,dp.MONTANT_DEPENSE AS MONTANT,dp.NUMERO_DEPENSE AS NUMERO, "sortie", dp.FOURNITURE_DEPENSE AS TYPE,dp.NUMERO_DEPENSE AS REF_CODE, dp.NUMERO_DEPENSE AS STORE FROM pos_ibi_depense dp)t WHERE DATES >="'.$criteres.'" AND DATES <="'.$criteres1.'" ORDER BY DATES DESC ');

        if ($query) {
            return $query->result();
        }
    }
    public function getSituation_count($criteres, $criteres1)
    {
        $query = $this->db->query('SELECT DATES,NUMERO,MONTANT,entree,TYPE FROM (SELECT cp.DATE_CREATION_PAIEMENT AS DATES,cp.MONTANT_PAIEMENT AS MONTANT,cp.NUMERO_RECU_PAIEMENT AS NUMERO,"entree",cp.TYPE_PAIEMENT AS TYPE FROM pos_ibi_commandes_paiements cp UNION ALL SELECT dp.DATE_CREATION_DEPENSE AS DATES,dp.MONTANT_DEPENSE AS MONTANT,dp.NUMERO_DEPENSE AS NUMERO, "sortie", dp.FOURNITURE_DEPENSE AS TYPE FROM pos_ibi_depense dp)t WHERE DATES >="'.$criteres.'" AND DATES <="'.$criteres1.'" ORDER BY DATES DESC ');

        if ($query) {
            return $query->num_rows();
        }
    }
    public function formatDateAgo($value)
    {
        $time = strtotime($value);
        $d = new \DateTime($value);

        $weekDays = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $months = ['Janvier', 'Février', 'Mars', 'Avril',' Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

        if ($time > strtotime('-2 minutes'))
        {
            return 'Il y a quelques secondes';
        }
        elseif ($time > strtotime('-30 minutes'))
        {
            return 'Il y a ' . floor((strtotime('now') - $time)/60) . ' min';
        }
        elseif ($time > strtotime('today'))
        {
            return $d->format('G:i');
        }
        elseif ($time > strtotime('yesterday'))
        {
            return 'Hier, ' . $d->format('G:i');
        }
        elseif ($time > strtotime('this week'))
        {
            return $weekDays[$d->format('N') - 1] . ', ' . $d->format('G:i');
        }
        else
        {
            return $d->format('j') . ' ' . $months[$d->format('n') - 1] . ', ' . $d->format('G:i');
        }
    }
}

/* End of file Model_registers.php */
/* Location: ./application/models/Model_registers.php */
