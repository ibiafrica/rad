<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Model_r_proforma extends MY_Model
{

    private $primary_key    = 'ID_CLIENT';
    private $table_name     = 'pos_clients';
    private $field_search   = ['NOM_CLIENT', 'PRENOM', 'TEL_CLIENTS', 'DATE_CREATION_CLIENT'];

    private $primary_key_server     = 'id';
    private $table_name_server  = 'aauth_users';
    private $field_search_server    = ['username', 'full_name', 'date_created', 'email'];

    private $primary_key_cmd  = 'ID_pos_IBI_COMMANDES';
    private $table_name_cmd  = 'pos_ibi_commandes';
    private $field_search_cmd  = ['CODE', 'DATE_CREATION_pos_IBI_COMMANDES'];


    public function __construct()
    {
        $config = array(
            'primary_key'   => $this->primary_key,
            'table_name'    => $this->table_name(),
            'field_search'  => $this->field_search,

            'primary_key_server'    => $this->primary_key_server,
            'table_name_server'     => $this->table_name_server(),
            'field_search_server'   => $this->field_search_server,


            'primary_key_cmd'  => $this->primary_key_cmd,
            'table_name_cmd'   => $this->table_name_cmd(),
            'field_search_cmd'   => $this->field_search_cmd,
        );

        parent::__construct($config);
    }



    public function table_name()
    {
        $store_prefix = $this->uri->segment(2);
        $table_name = 'pos_clients';
        return $table_name;
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
                    $where .= "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' OR CONCAT(pos_clients.NOM_CLIENT)
                     LIKE '%" . $q . "%'";
                } else {
                    $where .= "OR " . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_CLIENT', 0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('' . $this->table_name() . '.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name());

        return $query->result();
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
                    $where .= "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' OR CONCAT(pos_clients.NOM_CLIENT) LIKE '%" . $q . "%'";
                } else {
                    $where .= "OR " . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' )";
        }

        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_CLIENT', 0);
        $query = $this->db->get($this->table_name());

        return $query->num_rows();
    }







    public function get_total_header($date_depart1 = null, $date_fin1 = null, $user = null, $shift = null, $q = null, $field = null, $status = null, $limit = 0, $offset = 0, $select_field = [])
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        $this->db->select(' SUM(cp.PRIX_TOTAL) as total');
        $this->db->from('pos_ibi_commandes c,pos_ibi_commandes_produits cp');

        if ($status != '') {
            $this->db->where('c.COMMANDE_STATUS=' . $status);
        }

        if ($shift != '') {
            $this->db->where('c.ID_CASHIER_SHIFT=' . $shift);
        }

        $this->db->where("c.DELETED_STATUS_pos_IBI_COMMANDES", 0);
        $this->db->where("c.CREATED_BY_pos_IBI_COMMANDES", $user);
        $this->db->where("c.ID_pos_IBI_COMMANDES=cp.pos_IBI_COMMANDES_ID");

        $query = $this->db->get();
        return $query->row();
    }



    public function join_avaiable()
    {
        $this->db->join('pos_type_clients client', 'client.ID_TYPE_CLIENT =' . $this->table_name() . '.TYPE_CLIENT_ID', 'LEFT');
        $this->db->join('aauth_users', 'aauth_users.id =' . $this->table_name() . '.CREATED_BY_CLIENT', 'LEFT');
        return $this;
    }



    public function filter_avaiable()
    {
        return $this;
    }



    function insert($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return ($query) ? true : false;
    }

    public function delete($table, $critere = array())
    {
        $this->db->where($critere);
        $query = $this->db->delete($table);
        if ($query) {
            return TRUE;
        }
    }


    function insert_last_id($table, $data)
    {
        $this->db->set($data);
        $query = $this->db->insert($table);

        if ($query) {
            return $this->db->insert_id();
        }
    }

    public function getListes($table, $critere = array())
    {
        $this->db->where($critere);
        $this->db->group_by('TYPE_EXPRESS_ID');
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function getListese($table, $critere = array())
    {
        $this->db->where($critere);
        $this->db->group_by('ID_KILOGRAME');
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function getLists($table, $critere = array())
    {
        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function getOne($table, $critere = array())
    {
        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->row_array();
    }


    public function sans_where($table)
    {

        $query = $this->db->get($table);
        return $query->result();
    }


    public function getList($table, $critere = array())
    {

        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function geter_list($table, $critere = array())
    {

        $rq = $this->db->distinct()
            ->select('NAME')
            ->from('pos_ibi_commandes_produits')
            ->where($critere)
            ->get();
        return $rq->result_array();
    }



    public function countrows($table, $criteres, $critere = array())
    {
        $this->db->where($critere);
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function update($table, $critere = array(), $data = array())
    {
        $this->db->where($critere);
        $query = $this->db->update($table, $data);
        if ($query) {
            return TRUE;
        }
    }

    public function getRequete($requete)
    {
        $query = $this->db->query($requete);
        if ($query) {
            return $query->result();
        }
    }

    public function getRequeteOne($requete)
    {
        $query = $this->db->query($requete);
        if ($query) {
            return $query->row_array();
        }
    }

    public function getListLimit($table, $limit, $cond = array())
    {
        $this->db->limit($limit);
        $this->db->where($cond);
        $query = $this->db->get($table);

        if ($query) {
            return $query->result_array();
        }
    }

    public function sumSommes($table, $criteres)
    {
        $sommes = $this->db->query('SELECT SUM(PRIX_TOTAL) AS sommes_by_cmd FROM pos_ibi_commandes_produits WHERE
      REF_COMMAND_CODE = "' . $criteres . '" ');
        return  $sommes->row_array();
    }

    public function sommesCommande($critere_start, $critere_end, $categorie, $stores)
    {
        $critere1 = $critere_start . " 00:00:00";
        $criteres2 = $critere_end . " 23:59:59";
        if (empty($categorie) and is_null($critere_start)) {
            $request = $this->db->query(' SELECT SUM(PRIX_TOTAL) AS total FROM pos_ibi_commandes CMD INNER JOIN pos_ibi_commandes_produits pro ON pro.REF_COMMAND_CODE = CMD.CODE  ');
        } else if (!is_null($categorie) and empty($critere_start)) {
            $request = $this->db->query(" SELECT SUM(PRIX_TOTAL) AS total FROM pos_ibi_commandes CMD INNER JOIN pos_ibi_commandes_produits pro ON pro.REF_COMMAND_CODE = CMD.CODE WHERE CMD.COMMANDE_STATUS = '" . $categorie . "' ");
        } else if (!empty($categorie) and !is_null($criteres2) and !is_null($critere_start)) {
            $request = $this->db->query(' SELECT SUM(PRIX_TOTAL) AS total FROM pos_ibi_commandes CMD INNER JOIN pos_ibi_commandes_produits pro ON pro.REF_COMMAND_CODE = CMD.CODE WHERE  CMD.COMMANDE_STATUS  = "' . $categorie . '" AND CMD.DATE_CREATION_pos_IBI_COMMANDES >="' . $critere1 . '" AND CMD.DATE_CREATION_pos_IBI_COMMANDES <= "' . $criteres2 . '" ');
        } else {
            $request = $this->db->query(' SELECT SUM(PRIX_TOTAL) AS total FROM pos_ibi_commandes CMD INNER JOIN pos_ibi_commandes_produits pro ON pro.REF_COMMAND_CODE = CMD.CODE WHERE CMD.DATE_CREATION_pos_IBI_COMMANDES >="' . $critere1 . '" AND CMD.DATE_CREATION_pos_IBI_COMMANDES <= "' . $criteres2 . '" 
          ');
        }
        return $request->row_array();
    }

    public function getOneFilter($critere_start, $critere_end, $categorie, $stores)
    {
        $critere1 = $critere_start . " 00:00:00";
        $criteres2 = $critere_end . " 23:59:59";
        if (empty($categorie) and is_null($critere_start)) {
            $request = $this->db->query(' SELECT * FROM pos_ibi_commandes');
        } else if (!is_null($categorie) and empty($critere_start)) {
            $request = $this->db->query(" SELECT * FROM pos_ibi_commandes WHERE COMMANDE_STATUS = '" . $categorie . "' ");
        } else if (!empty($categorie) and !is_null($criteres2) and !is_null($critere_start)) {
            $request = $this->db->query(' SELECT * FROM pos_ibi_commandes WHERE  COMMANDE_STATUS  = "' . $categorie . '" AND DATE_CREATION_pos_IBI_COMMANDES >="' . $critere1 . '" AND DATE_CREATION_pos_IBI_COMMANDES <= "' . $criteres2 . '" ');
        } else {
            $request = $this->db->query(' SELECT * FROM pos_ibi_commandes WHERE DATE_CREATION_pos_IBI_COMMANDES >="' . $critere1 . '" AND DATE_CREATION_pos_IBI_COMMANDES <= "' . $criteres2 . '" 
          ');
        }
        return $request->result();
    }

    public function getAllApprov($critere, $store)
    {

        $request = $this->db->query(' SELECT * FROM pos_store_1_ibi_arrivages WHERE
             DELETE_STATUS_ARRIVAGE = "' . $critere . '" ');
        return $request->result();
    }

    public function getterMyApprovisionnements($criteres)
    {
        $my_request = $this->db->distinct()
            ->select('*')
            ->from('pos_store_detail_arrivage arrivage')
            ->join('pos_ibi_ingredients ingredient', 'ingredient.ID_INGREDIENT = arrivage.ID_INGREDIENT')
            //  ->join('pos_ibi_article_requisition requis', 'requis.CODEBAR_INGREDIENT_REQ = ingredient.CODEBAR_INGREDIENT')
            ->join('aauth_users users', 'users.id = arrivage.CREATE_BY_ARRIVAGE_DETAIL')
            ->where($criteres)
            ->get();
        return $my_request->result();
    }

    public function getPaiementParCommandes($tables)
    {
        $query = $this->db->distinct()
            ->select('*')
            ->from('pos_paiements paie')
            ->join('pos_ibi_commandes cmd', 'cmd.ID_pos_IBI_COMMANDES = paie.COMMANDE_ID')
            ->join('aauth_users user', 'user.id = cmd.CREATED_BY_pos_IBI_COMMANDES')
            ->where('paie.DELETED_STATUS_PAIEMENT !=', 3)
            ->get();
        return $query->result();
    }


    public function getterMyApprovisionnement($critere)
    {
        $request = $this->db->query(' SELECT DISTINCT * FROM pos_store_detail_arrivage arrivage INNER JOIN 
             pos_ibi_ingredients ingr INNER JOIN aauth_users users INNER JOIN pos_ibi_article_requisition req INNER JOIN pos_store_1_ibi_articles_stock_flow flow ON 
             flow.REF_ARTICLE_BARCODE_SF = ingr.CODEBAR_INGREDIENT AND ingr.ID_INGREDIENT = arrivage.ID_INGREDIENT
             AND req.CODEBAR_INGREDIENT_REQ = ingr.CODEBAR_INGREDIENT AND users.id = CREATED_BY_SF WHERE
             flow.ID_ARRIVAGE = "' . $critere . '" ');
        return $request->result();
    }

    function getOneFilters($criteres1, $criteres2, $criteres)
    {

        $req = "";
        if (!empty($criteres)) {
            $req = "and cat.ID_CATEGORIE='" . $criteres . "'";
        }
        $query = $this->db->query('SELECT ar.DESIGN_ARTICLE as DESIGN_ARTICLE,ar.CODEBAR_ARTICLE as CODEBAR_ARTICLE,fl.REF_ARTICLE_BARCODE_SF 
      as codebar_sf,QUANTITE_SF as QUANTITE_SF,UNIT_PRICE_SF as UNIT_PRICE_SF,fl.DATE_CREATION_SF AS DATE_SF,fl.REF_COMMAND_CODE_SF 
      AS REF_CODE,fl.CREATED_BY_SF AS AUTHOR,fl.TYPE_SF FROM pos_store_1_ibi_articles_stock_flow as fl,pos_store_1_ibi_articles 
      as ar ,pos_store_1_ibi_categories as cat  where fl.REF_ARTICLE_BARCODE_SF=ar.CODEBAR_ARTICLE 
      and cat.ID_CATEGORIE=ar.REF_CATEGORIE_ARTICLE ' . $req . '
        AND DATE_CREATION_SF >="' . $criteres1 . '" AND DATE_CREATION_SF <="' . $criteres2 . '" group by CODEBAR_ARTICLE
        ');

        //return ($query->num_rows() < 1) ? null : 
        return $query->result();
    }

    function getOneFilter_count($criteres1, $criteres2, $criteres, $stores)
    {
        $req = "";
        if (!empty($criteres)) {
            $req = "and cat.ID_CATEGORIE='" . $criteres . "'";
        }
        $query = $this->db->query('SELECT ar.DESIGN_ARTICLE as DESIGN_ARTICLE,ar.CODEBAR_ARTICLE as CODEBAR_ARTICLE,fl.REF_ARTICLE_BARCODE_SF 
      as codebar_sf,QUANTITE_SF as QUANTITE_SF,UNIT_PRICE_SF as UNIT_PRICE_SF,fl.DATE_CREATION_SF AS DATE_SF,fl.REF_COMMAND_CODE_SF 
      AS REF_CODE,fl.CREATED_BY_SF AS AUTHOR,fl.TYPE_SF FROM pos_store_' . $stores . '_ibi_articles_stock_flow as fl,pos_store_' . $stores . '_ibi_articles
       as ar ,pos_store_1_ibi_categories as cat  where fl.REF_ARTICLE_BARCODE_SF=ar.CODEBAR_ARTICLE and cat.ID_CATEGORIE=ar.REF_CATEGORIE_ARTICLE  ' . $req . '
        AND DATE_CREATION_SF >="' . $criteres1 . '" AND DATE_CREATION_SF <="' . $criteres2 . '" group by CODEBAR_ARTICLE
        ');
        return $query->num_rows();
    }

    function rapports_docteur($criteres1, $criteres2, $criteres)
    {

        $req = "";
        if (!empty($criteres)) {
            $req = "and p.DOCTOR_ID='" . $criteres . "'";
        }
        $query = $this->db->query('SELECT * FROM patient_file as p,actes as a where p.CONSULTATION=a.ID_ACTES and p.DELETED_STATUS_PATIENT_FILE=0 and p.DOCTOR_ID!=0 and  p.DATE_CREATION_PATIENT_FILE >="' . $criteres1 . '" AND p.DATE_CREATION_PATIENT_FILE <="' . $criteres2 . '" ' . $req . '
        
        ');
        //return ($query->num_rows() < 1) ? null : 
        return $query->result();
    }
    function rapports_docteur_count($criteres1, $criteres2, $criteres)
    {

        $req = "";
        if (!empty($criteres)) {
            $req = "and p.DOCTOR_ID='" . $criteres . "'";
        }
        $query = $this->db->query('SELECT * FROM patient_file as p,actes as a where p.CONSULTATION=a.ID_ACTES and p.DELETED_STATUS_PATIENT_FILE=0 and p.DOCTOR_ID!=0 and  p.DATE_CREATION_PATIENT_FILE >="' . $criteres1 . '" AND p.DATE_CREATION_PATIENT_FILE <="' . $criteres2 . '"  ' . $req . '
        
        ');
        return $query->num_rows();
    }



    function getrapport_hospitalises_p($debut, $fin, $paiement, $facture)
    {
        $req = "";
        if ($facture != -1) {
            $req = "and STATUS_FACTURE='" . $facture . "'";
        }
        if ($paiement != -1) {
            $req = "and TYPE_DE_PAYEMET='" . $paiement . "'";
        }
        if ($facture != -1 && $paiement != -1) {
            $req = "and STATUS_FACTURE='" . $facture . "' and TYPE_DE_PAYEMET='" . $paiement . "'";
        }



        $store = $this->db->query('select *from pos_ibi_stores');
        foreach ($store->result() as $id_store) {

            $i = $id_store->ID_STORE;

            $this->db->query('SET SQL_BIG_SELECTS=1');
            $query1 = $this->db->query('SELECT a.* from ( SELECT * FROM hospital_ibi_commandes as com,patient_file as pf,factures as fa,bed_management as bed WHERE com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES=pf.PATIENT_FILE_ID and pf.PATIENT_FILE_ID=fa.PATIENT_FILE_ID_FACTURE and bed.PATIENT_FILE_ID_BED_MANAGEMENT=com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES and DISCHARGE_TIMESTAMP_BED_MANAGEMENT >="' . $debut . '" and DISCHARGE_TIMESTAMP_BED_MANAGEMENT<="' . $fin . '" and LETTER="H"' . $req . ' UNION SELECT * FROM pos_store_1_ibi_commandes as com,patient_file as pf,factures as fa,bed_management as bed WHERE com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES=pf.PATIENT_FILE_ID and pf.PATIENT_FILE_ID=fa.PATIENT_FILE_ID_FACTURE and bed.PATIENT_FILE_ID_BED_MANAGEMENT=com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES and DISCHARGE_TIMESTAMP_BED_MANAGEMENT >="' . $debut . '" and DISCHARGE_TIMESTAMP_BED_MANAGEMENT<="' . $fin . '" and LETTER="H"' . $req . ' ) a group by PATIENT_FILE_ID_BED_MANAGEMENT');
            return $query1->result();
        }
    }
    // select a.* from (SELECT * FROM hospital_ibi_commandes as com,patient_file as pf,factures as fa,bed_management as bed WHERE com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES=pf.PATIENT_FILE_ID and pf.PATIENT_FILE_ID=fa.PATIENT_FILE_ID_FACTURE and bed.PATIENT_FILE_ID_BED_MANAGEMENT=com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES and DISCHARGE_TIMESTAMP_BED_MANAGEMENT >="2020-10-01" and DISCHARGE_TIMESTAMP_BED_MANAGEMENT<="'.$fin.'" and LETTER="H" UNION SELECT * FROM pos_store_1_ibi_commandes as com,patient_file as pf,factures as fa,bed_management as bed WHERE com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES=pf.PATIENT_FILE_ID and pf.PATIENT_FILE_ID=fa.PATIENT_FILE_ID_FACTURE and bed.PATIENT_FILE_ID_BED_MANAGEMENT=com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES and DISCHARGE_TIMESTAMP_BED_MANAGEMENT >="2020-10-01" and DISCHARGE_TIMESTAMP_BED_MANAGEMENT<="2020-11-12" and LETTER="H") a group by PATIENT_FILE_ID_BED_MANAGEMENT

    public function depense_approvisionnement($table, $date_start, $date_end)
    {

        if (!empty($date_start) and !empty($date_end)) {
            $get_query = $this->db->query(' SELECT * FROM ' . $table . '  WHERE DATE_CREATE_DEPENSE >="' . $date_start .
                ' 00:00:00" AND DATE_CREATE_DEPENSE <= "' . $date_end . ' 23:59:59" 
          ');
        } else {
            $get_query = $this->db->query(' SELECT * FROM ' . $table . ' WHERE DATE_CREATE_DEPENSE >="' . date("Y-m-d") .
                ' 00:00:00" AND DATE_CREATE_DEPENSE <= "' . date("Y-m-d") . ' 23:59:59" ');
        }

        return $get_query->result();
    }


    function getrapport_hospitalises_count_p($debut, $fin, $paiement, $facture)
    {
        $req = "";
        if ($facture != -1) {
            $req = "and STATUS_FACTURE='" . $facture . "'";
        }
        if ($paiement != -1) {
            $req = "and TYPE_DE_PAYEMET='" . $paiement . "'";
        }
        if ($facture != -1 && $paiement != -1) {
            $req = "and STATUS_FACTURE='" . $facture . "' and TYPE_DE_PAYEMET='" . $paiement . "'";
        }
        $store = $this->db->query('select *from pos_ibi_stores');

        foreach ($store->result() as $id_store) {
            $i = $id_store->ID_STORE;
            $this->db->query('SET SQL_BIG_SELECTS=1');
            $query = $this->db->query('SELECT a.* from ( SELECT * FROM hospital_ibi_commandes as com,patient_file as pf,factures as fa,bed_management as bed WHERE com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES=pf.PATIENT_FILE_ID and pf.PATIENT_FILE_ID=fa.PATIENT_FILE_ID_FACTURE and bed.PATIENT_FILE_ID_BED_MANAGEMENT=com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES and DISCHARGE_TIMESTAMP_BED_MANAGEMENT >="' . $debut . '" and DISCHARGE_TIMESTAMP_BED_MANAGEMENT<="' . $fin . '" and LETTER="H"' . $req . ' UNION SELECT * FROM pos_store_1_ibi_commandes as com,patient_file as pf,factures as fa,bed_management as bed WHERE com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES=pf.PATIENT_FILE_ID and pf.PATIENT_FILE_ID=fa.PATIENT_FILE_ID_FACTURE and bed.PATIENT_FILE_ID_BED_MANAGEMENT=com.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES and DISCHARGE_TIMESTAMP_BED_MANAGEMENT >="' . $debut . '" and DISCHARGE_TIMESTAMP_BED_MANAGEMENT<="' . $fin . '" and LETTER="H"' . $req . ' ) a group by PATIENT_FILE_ID_BED_MANAGEMENT');
            return $query->num_rows();
        }
    }


    public function one_bs($table, $critere = array())
    {
        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->row_array();
    }




    public function table_name_server()
    {
        $store_prefix = $this->uri->segment(4);
        $table_name_server = 'aauth_users';

        return $table_name_server;
    }



    public function table_name_cmd()
    {
        $store_prefix = $this->uri->segment(2);
        $table_name_cmd = 'pos_ibi_commandes';
        return $table_name_cmd;
    }


    public function get_server($q = null, $field = null, $limit = 0, $offset = 0, $select_field_server = [])
    {
        $iterasi = 1;
        $num = count($this->field_search_server);
        $where = null;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search_server as $field) {
                if ($iterasi == 1) {
                    $where .= "" . $this->table_name_server() . "." . $field . " LIKE '%" . $q . "%'";
                } else {
                    $where .= "OR " . "" . $this->table_name_server() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name_server() . "." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field_server) and count($select_field_server)) {
            $this->db->select($select_field_server);
        }





        $this->join_server_avaible();
        $this->db->where($where);
        $this->db->where('banned', 0);
        $this->db->where('gpe.group_id', '27');
        $this->db->or_where('gpe.group_id', '28');
        $this->db->or_where('gpe.group_id', '29');
        $this->db->limit($limit, $offset);
        $this->db->order_by('' . $this->table_name_server() . '.' . $this->primary_key_server, "DESC");
        $query = $this->db->get($this->table_name_server());

        return $query->result();
    }



    public function join_server_avaible()
    {
        $this->db->join('aauth_user_to_group gpe', 'gpe.user_id =' . $this->table_name_server() . '.id', 'LEFT');
    }



    public function count_all_cmd($date_depart1 = null, $date_fin1 = null, $shift = null, $q = null, $field = null)
    {
        $URI_USER = $this->uri->segment(3);

        $iterasi = 1;
        $num = count($this->field_search_cmd);
        $where = null;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search_cmd as $field) {
                if ($iterasi == 1) {
                    $where .= "" . $this->table_name_cmd() . "." . $field . " LIKE '%" . $q . "%' OR CONCAT(pos_ibi_commandes.CODE) LIKE '%" . $q . "%'";
                } else {
                    $where .= "OR " . "" . $this->table_name_cmd() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name_cmd() . "." . $field . " LIKE '%" . $q . "%' )";
        }

        $this->filter_avaiable_cmd();
        if ($shift != '') {
            $this->db->where('ID_CASHIER_SHIFT=' . $shift);
        } else {

            if ($date_depart1 != '' && $date_fin1  != '') {

                $date_depart1 = $date_depart1 . ' 00:00:00';
                $date_fin1 = $date_fin1 . ' 23:59:59';
                $this->db->where('pos_ibi_commandes.DATE_CREATION_pos_IBI_COMMANDES BETWEEN "' . $date_depart1 . '" AND "' . $date_fin1 . '"');
            }
        }
        $this->db->where($where);
        $this->db->where("CREATED_BY_pos_IBI_COMMANDES", $URI_USER);
        $this->db->where("DELETED_STATUS_pos_IBI_COMMANDES", 0);
        $query = $this->db->get($this->table_name_cmd());

        return $query->num_rows();
    }

    public function get_cmd($date_depart1 = null, $date_fin1 = null, $shift = null, $status = null, $q = null, $field = null, $limit = 0, $offset = 0, $select_field_cmd = [])
    {

        $URI_USER = $this->uri->segment(3);
        $iterasi = 1;
        $num = count($this->field_search_cmd);
        $where = null;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search_cmd as $field) {
                if ($iterasi == 1) {
                    $where .= "" . $this->table_name_cmd() . "." . $field . " LIKE '%" . $q . "%' OR CONCAT(pos_ibi_commandes.DATE_CREATION_pos_IBI_COMMANDES)
                     LIKE '%" . $q . "%'";
                } else {
                    $where .= "OR " . "" . $this->table_name_cmd() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }
            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name_cmd() . "." . $field . " LIKE '%" . $q . "%' )";
        }
        if (is_array($select_field_cmd) and count($select_field_cmd)) {
            $this->db->select($select_field_cmd);
        }

        if ($status != '') {
            $this->db->where('COMMANDE_STATUS=' . $status);
        }

        if ($shift != '') {
            $this->db->where('ID_CASHIER_SHIFT=' . $shift);
        } else {

            if ($date_depart1 != '' && $date_fin1  != '') {

                $date_depart1 = $date_depart1 . ' 00:00:00';

                $date_fin1 = $date_fin1 . ' 23:59:59';
            } else {

                $date_depart1 = date("Y-m-d") . ' 00:00:00';

                $date_fin1 = date("Y-m-d") . ' 23:59:59';
            }



            $this->db->where('pos_ibi_commandes.DATE_CREATION_pos_IBI_COMMANDES BETWEEN "' . $date_depart1 . '" AND "' . $date_fin1 . '"');
        }



        $this->filter_avaiable_cmd();
        $this->db->where($where);
        $this->db->where("CREATED_BY_pos_IBI_COMMANDES", $URI_USER);
        $this->db->where("DELETED_STATUS_pos_IBI_COMMANDES", 0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('' . $this->table_name_cmd() . '.' . $this->primary_key_cmd, "DESC");
        $query = $this->db->get($this->table_name_cmd());

        return $query->result();
    }




    public function filter_avaiable_cmd()
    {
        return $this;
    }



    //get commande status
    public function get_commande_status_rapport($status, $server)
    {

        $this->db->select('TO_WHOM, ID_pos_IBI_COMMANDES,COMMANDE_STATUS,CODE,CLIENT_ID_COMMANDE, DATE_CREATION_pos_IBI_COMMANDES, CREATED_BY_pos_IBI_COMMANDES, DELETED_STATUS_pos_IBI_COMMANDES,SUM(PRIX_TOTAL) AS PRIX_TOTAL ');
        $this->joins_avaiable();
        $this->db->where('pos_ibi_commandes.COMMANDE_STATUS=' . $status);
        $this->db->where('pos_ibi_commandes.CREATED_BY_pos_IBI_COMMANDES=' . $server);
        $this->db->where("DELETED_STATUS_pos_IBI_COMMANDES", 0);
        $this->db->group_by('pos_IBI_COMMANDES_ID');
        // $this->db->order_by('pos_ibi_commandes.' . $this->primary_key, "DESC");
        $query = $this->db->get('pos_ibi_commandes');

        return $query->result();
    }

    public function joins_avaiable()
    {
        $this->db->join('pos_clients', 'pos_clients.ID_CLIENT = pos_ibi_commandes.CLIENT_ID_COMMANDE', 'LEFT');
        $this->db->join('pos_clients pos_clients1', 'pos_clients1.ID_CLIENT = pos_ibi_commandes.CLIENT_FILE_ID_pos_IBI_COMMANDES', 'LEFT');

        $this->db->join('pos_ibi_commandes_produits', 'pos_ibi_commandes_produits.pos_IBI_COMMANDES_ID = pos_ibi_commandes.ID_pos_IBI_COMMANDES', 'LEFT');

        return $this;
    }



    public function count_all_server($q = null, $field = null)
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = null;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search_server as $field) {
                if ($iterasi == 1) {
                    $where .= "" . $this->table_name_server() . "." . $field . " LIKE '%" . $q . "%'";
                } else {
                    $where .= "OR " . "" . $this->table_name_server() . "." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "" . $this->table_name_server() . "." . $field . " LIKE '%" . $q . "%' )";
        }



        $this->join_server_avaible();
        $this->db->where($where);
        $this->db->where('banned', 0);
        $this->db->where('gpe.group_id', '27');
        $query = $this->db->get($this->table_name_server());

        return $query->num_rows();
    }





    public function filter_avaible_server()
    {

        return $this;
    }



    public function getOneFilter_CMD($critere1, $criteres2, $URI_SERVER, $status)
    {



        if (empty($status) and is_null($critere1)) {
            $request = $this->db->query(' SELECT * FROM pos_ibi_commandes where CREATED_BY_pos_IBI_COMMANDES = "' . $URI_SERVER . '" ');
        } else if (!is_null($status) and empty($critere1)) {
            $request = $this->db->query(" SELECT * FROM pos_ibi_commandes WHERE COMMANDE_STATUS = '" . $status . "' AND 
          CREATED_BY_pos_IBI_COMMANDES = '" . $URI_SERVER . "' ");
        } else if (!is_null($critere1) and !is_null($criteres2) and !is_null($status)) {
            $request = $this->db->query(' SELECT * FROM pos_ibi_commandes WHERE  COMMANDE_STATUS  = "' . $status . '" AND
             CREATED_BY_pos_IBI_COMMANDES = "' . $URI_SERVER . '" AND DATE_CREATION_pos_IBI_COMMANDES >="' . $critere1 . '" AND DATE_CREATION_pos_IBI_COMMANDES <= "' . $criteres2 . '" ');
        } else if (!is_null($critere1) and !is_null($criteres2)) {
            $request = $this->db->query(' SELECT * FROM pos_ibi_commandes WHERE
             CREATED_BY_pos_IBI_COMMANDES = "' . $URI_SERVER . '" AND DATE_CREATION_pos_IBI_COMMANDES >="' . $critere1 . '" AND DATE_CREATION_pos_IBI_COMMANDES <= "' . $criteres2 . '" ');
        } else {
        }

        return $request->result();
    }



    public function rapport_prix_achat_t($critere_start, $critere_end, $cat)
    {
        $critere1 = $critere_start . " 00:00:00";
        $critere2 = $critere_end . " 23:59:59";


        if (empty($critere_start)) {
            $request = $this->db->query('SELECT SUM(article.PRIX_DACHAT_ARTICLE) AS PRIX_A FROM pos_store_1_ibi_articles article INNER JOIN pos_ibi_commandes_produits product ON product.REF_PRODUCT_CODEBAR = article.CODEBAR_ARTICLE ');
        } else {

            $request = $this->db->query('SELECT SUM(article.PRIX_DACHAT_ARTICLE) AS PRIX_A FROM pos_store_1_ibi_articles article INNER JOIN pos_ibi_commandes_produits product ON product.REF_PRODUCT_CODEBAR = article.CODEBAR_ARTICLE WHERE product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS >="' . $critere1 . '" AND product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS <= "' . $critere2 . '" ');
        }

        return $request->row_array();
    }




    public function rapport_prix_qte($critere_start, $critere_end, $cat)
    {
        $critere1 = $critere_start . " 00:00:00";
        $critere2 = $critere_end . " 23:59:59";

        if (empty($critere_start)) {
            $request = $this->db->query('SELECT SUM(article.QUANTITY_ARTICLE) AS QTE FROM pos_store_1_ibi_articles article INNER JOIN pos_ibi_commandes_produits product ON product.REF_PRODUCT_CODEBAR = article.CODEBAR_ARTICLE ');
        } else {

            $request = $this->db->query('SELECT SUM(article.QUANTITY_ARTICLE) AS QTE FROM pos_store_1_ibi_articles article INNER JOIN pos_ibi_commandes_produits product ON product.REF_PRODUCT_CODEBAR = article.CODEBAR_ARTICLE WHERE product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS >="' . $critere1 . '" AND product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS <= "' . $critere2 . '" ');
        }

        return $request->row_array();
    }


    public function rapport_prix_all($critere_start, $critere_end, $cat)
    {
        $critere1 = $critere_start . " 00:00:00";
        $critere2 = $critere_end . " 23:59:59";

        if (empty($critere_start)) {
            $request = $this->db->query('SELECT SUM(article.PRIX_DE_VENTE_ARTICLE) AS PRIX_V FROM pos_store_1_ibi_articles article INNER JOIN pos_ibi_commandes_produits product ON product.REF_PRODUCT_CODEBAR = article.CODEBAR_ARTICLE ');
        } else {

            $request = $this->db->query('SELECT SUM(article.PRIX_DE_VENTE_ARTICLE) AS PRIX_V FROM pos_store_1_ibi_articles article INNER JOIN pos_ibi_commandes_produits product ON product.REF_PRODUCT_CODEBAR = article.CODEBAR_ARTICLE WHERE product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS >="' . $critere1 . '" AND product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS <= "' . $critere2 . '" ');
        }

        return $request->row_array();
    }



    public function rapport_commands($critere_start, $critere_end, $categorie)
    {
        if (!empty($critere_start)) {
            $query = $this->db->distinct()
                ->select("product.REF_PRODUCT_CODEBAR")
                ->from('pos_ibi_commandes_produits product')
                ->where('product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS >=', $critere_start)
                ->where('product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS <=', $critere_end)
                ->get();
            return $query->result();
        } elseif (!is_null($categorie)) {
            $query = $this->db->distinct()
                ->select("product.REF_PRODUCT_CODEBAR")
                ->from('pos_ibi_commandes_produits product')
                ->where('product.DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS', $categorie)
                ->get();
            return $query->result();
        } else if (!is_null($categorie) and !empty($critere_start)) {
            $query = $this->db->distinct()
                ->select("product.REF_PRODUCT_CODEBAR")
                ->from('pos_ibi_commandes_produits product')
                ->where('product.DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS', $categorie)
                ->where('product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS >=', $critere_start)
                ->where('product.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS <=', $critere_end)
                ->get();
            return $query->result();
        } else {

            $query = $this->db->distinct()
                ->select("product.REF_PRODUCT_CODEBAR")
                ->from('pos_ibi_commandes_produits product')
                ->get();
            return $query->result();
        }
    }

    public function sommesDepense($critere_start, $critere_end, $categorie)
    {
        $critere1 = $critere_start . " 00:00:00";
        $criteres2 = $critere_end . " 23:59:59";

        if (empty($categorie) and is_null($critere_start)) {
            $request = $this->db->query(' SELECT SUM(MONTANT_DEPENSE) AS MONTANT FROM pos_depenses  WHERE DELETE_STATUS_DEPENSE =0 ');
        } else if (!is_null($categorie) and empty($critere_start)) {
            $request = $this->db->query(" SELECT SUM(MONTANT_DEPENSE) AS MONTANT FROM pos_depenses WHERE ID_CATEGORIE_DEPENSE = '" . $categorie . "' AND DELETE_STATUS_DEPENSE =0 ");
        } else if (!empty($categorie) and !is_null($criteres2) and !is_null($critere_start)) {
            $request = $this->db->query(' SELECT SUM(MONTANT_DEPENSE) AS MONTANT FROM pos_depenses WHERE  ID_CATEGORIE_DEPENSE  = "' . $categorie . '" AND DATE_CREATE_DEPENSE >="' . $critere1 . '" AND DATE_CREATE_DEPENSE <= "' . $criteres2 . '" AND DELETE_STATUS_DEPENSE =0 ');
        } else {
            $request = $this->db->query(' SELECT SUM(MONTANT_DEPENSE) AS MONTANT FROM pos_depenses WHERE DATE_CREATE_DEPENSE >="' . $critere1 . '" AND DATE_CREATE_DEPENSE <= "' . $criteres2 . '" 
            AND DELETE_STATUS_DEPENSE =0');
        }

        return $request->row_array();
    }

    public function getDepense($critere_start, $critere_end, $categorie)
    {

        if (!empty($critere_start) and !empty($critere_end)) {

            if (!empty($categorie)) {
                $req = 'AND ID_CATEGORIE_DEPENSE=' . $categorie . '';
            } else {
                $req = '';
            }

            $request = $this->db->query(' SELECT * FROM pos_depenses  WHERE DELETE_STATUS_DEPENSE =0 AND  DATE_CREATE_DEPENSE BETWEEN "' . $critere_start . '" AND "' . $critere_end . ' 23:59:59" ');
        }

        // $request = $this->db->query(' SELECT * FROM pos_depenses');

        return isset($request) ? $request->result() : [];
    }

    function getOneFilter_count_CMD($criteres1, $criteres2, $URI_SERVER)
    {
        if (is_null($criteres1)) {
            $query = $this->db->query(' SELECT * FROM pos_ibi_commandes CMD  where CMD.CREATED_BY_pos_IBI_COMMANDES = ' . $URI_SERVER . '  ');
        } else {
            $query = $this->db->query(' SELECT * FROM pos_ibi_commandes CMD  where CMD.CREATED_BY_pos_IBI_COMMANDES = ' . $URI_SERVER . '
              AND DATE_CREATION_pos_IBI_COMMANDES >="' . $criteres1 . '" AND DATE_CREATION_pos_IBI_COMMANDES <="' . $criteres2 . '"  ');
        }

        return $query->num_rows();
    }

    public function my_model_lister($table, $critere = array())
    {
        $this->db->distinct("*");
        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function getRequeter($critere)
    {
        $req = $this->db->query('SELECT  DISTINCT NAME, REF_PRODUCT_CODEBAR, QUANTITE, CREATED_BY_pos_IBI_COMMANDES_PRODUITS,PRIX_TOTAL,DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS FROM pos_ibi_commandes_produits WHERE DATE_CREATION_pos_IBI_COMMANDES_PRODUITS =' . $critere . ' ');
        return $req->result_array();
    }



    public function countrows_bs($table, $critere = array(), $start, $end)
    {

        $betwen = "DATE_CREATION_pos_IBI_COMMANDES BETWEEN '" . $start . "' AND '" . $end . "' ";
        $this->db->where($critere);

        if (!empty($start) and !empty($end)) {
            $this->db->where($betwen);
        }

        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function countrows_bs_($table, $criteres, $date_start, $date_end)
    {
        $start = $date_start . " 00:00:00";
        $end = $date_end . " 23:59:59";

        $betwen = "DATE_CREATION_pos_IBI_COMMANDES BETWEEN '" . $start . "' AND '" . $end . "' ";
        $this->db->where($criteres);
        if (!is_null($date_start) and !is_null($date_end)) {
            $this->db->where($betwen);
        }
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    // public function join_montant($where, $wheres, $date_start, $date_end)
    // {

    //     $start = $date_start . " 00:00:00";
    //     $end = $date_end . " 23:59:59";

    //     $betwen = "cmd.DATE_CREATION_pos_IBI_COMMANDES BETWEEN '" . $start . "' AND '" . $end . "' ";

    //     $this->db->select('SUM(MONTANT_PAIEMENT) AS TOTAL');
    //     $this->db->from('pos_paiements paiement');
    //     $this->db->join('pos_ibi_commandes cmd', 'cmd.ID_pos_IBI_COMMANDES = paiement.COMMANDE_ID');
    //     $this->db->where($where);
    //     $this->db->where($wheres);
    //     if (!is_null($date_start) and !is_null($date_end)) {
    //         $this->db->where($betwen);
    //     }
    //     $req = $this->db->get();
    //     return $req->row_array();
    // }


    public function join_montant_o($where, $wheres, $date_start, $date_end)
    {

        $start = $date_start . " 00:00:00";
        $end = $date_end . " 23:59:59";

        $betwen = "cmd.DATE_CREATION_pos_IBI_COMMANDES BETWEEN '" . $start . "' AND '" . $end . "' ";

        $this->db->select('SUM(MONTANT_PAIEMENT) AS TOTAL');
        $this->db->from('pos_paiements paiement');
        $this->db->join('pos_ibi_commandes cmd', 'cmd.ID_pos_IBI_COMMANDES = paiement.COMMANDE_ID');
        $this->db->where($where);
        $this->db->where($wheres);
        // if(!is_null($date_start) AND !is_null($date_end)){
        //   $this->db->where($betwen); 
        //  }
        $req = $this->db->get();
        return $req->row_array();
    }




    public function countrows_bs_o($table, $criteres, $critere = array(), $date_start, $date_end)
    {
        $start = $date_start . " 00:00:00";
        $end = $date_end . " 23:59:59";

        $betwen = "DATE_CREATION_pos_IBI_COMMANDES BETWEEN '" . $start . "' AND '" . $end . "' ";
        $this->db->where($criteres);
        if (!is_null($date_start) and !is_null($date_end)) {
            $this->db->where($betwen);
        }
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function join_montant($where, $wheres, $date_start, $date_end)
    {

        $start = $date_start . " 00:00:00";
        $end = $date_end . " 23:59:59";

        $betwen = "cmd.DATE_CREATION_pos_IBI_COMMANDES BETWEEN '" . $start . "' AND '" . $end . "' ";


        $this->db->select('SUM(MONTANT_PAIEMENT) AS TOTAL');
        $this->db->from('pos_paiements paiement');
        $this->db->join('pos_ibi_commandes cmd', 'cmd.ID_pos_IBI_COMMANDES = paiement.COMMANDE_ID');
        $this->db->where($where);
        $this->db->where('DELETED_STATUS_pos_IBI_COMMANDES', 0);
        $this->db->where($wheres);
        // if(!is_null($date_start) AND !is_null($date_end)){
        //   $this->db->where($betwen); 
        //  }
        $req = $this->db->get();
        return $req->row_array();
    }
}
