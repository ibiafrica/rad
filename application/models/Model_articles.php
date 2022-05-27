<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_articles extends MY_Model
{

  private $primary_key   = 'ID_ARTICLE';
  // private $table_name 	= 'pos_store_2_ibi_articles';
  private $field_search   = ['DESIGN_ARTICLE', 'REF_RAYON_ARTICLE', 'REF_CATEGORIE_ARTICLE', 'REF_SOUS_CATEGORIE_ARTICLE', 'SKU_ARTICLE', 'TYPE_ARTICLE', 'STATUS_ARTICLE', 'STOCK_ENABLED_ARTICLE', 'PRIX_DE_VENTE_ARTICLE', 'SHADOW_PRICE_ARTICLE', 'PRIX_PROMOTIONEL_ARTICLE', 'SPECIAL_PRICE_START_DATE_ARTICLE', 'SPECIAL_PRICE_END_DATE_ARTICLE', 'TAILLE_ARTICLE', 'POIDS_ARTICLE', 'COULEUR_ARTICLE', 'HAUTEUR_ARTICLE', 'LARGEUR_ARTICLE', 'DESCRIPTION_ARTICLE', 'APERCU_ARTICLE', 'CODEBAR_ARTICLE', 'AUTHOR_ARTICLE'];

  public function __construct()
  {
    $config = array(
      'primary_key'   => $this->primary_key,
      'table_name'   => $this->table_name(),
      'field_search'   => $this->field_search,
    );

    parent::__construct($config);
  }
  public function table_name()
  {
    $store_prefix = $this->uri->segment(4);
    $table_name     = 'pos_store_' . $store_prefix . '_ibi_articles';
    return $table_name;
  }

  public function count_all($q = null, $field = null)
  {
    $iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);
    $where1 = NULL;

    if (empty($field)) {
      foreach ($this->field_search as $field) {
        if ($iterasi == 1) {
          $where .= "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
        } else {
          $where .= "OR " . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
          $where .= "OR F.NOM_FAMILLE LIKE '%" . $q . "%' ";
          $where .= "OR C.NOM_CATEGORIE LIKE '%" . $q . "%' ";
        }
        $iterasi++;
      }

      $where = '(' . $where . ')';
    } else {
      if ($field == 'REF_SOUS_CATEGORIE_ARTICLE') {
        $where .= "(C.NOM_CATEGORIE LIKE '%" . $q . "%' )";
      } else if ($field == 'REF_CATEGORIE_ARTICLE') {
        $where .= "(F.NOM_FAMILLE LIKE '%" . $q . "%' )";
      } else if ($field == 'INDISPONIBLE') {
        foreach ($this->field_search as $fieldD) {
          if ($iterasi == 1) {
            $where1 .= "" . $this->table_name() . "." . $fieldD . " LIKE '%" . $q . "%' ";
          } else {
            $where1 .= "OR " . "" . $this->table_name() . "." . $fieldD . " LIKE '%" . $q . "%' ";
            $where1 .= "OR F.NOM_FAMILLE LIKE '%" . $q . "%' ";
            $where1 .= "OR C.NOM_CATEGORIE LIKE '%" . $q . "%' ";
          }
          $iterasi++;
        }
        $where .= "STATUS_ARTICLE = 0 AND (".$where1.") "; 
        // $where .= "" . $this->table_name() . ".CODEBAR_ARTICLE LIKE '%" . $q . "%' ";
      } else {
        $where .= "(" . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' )";
      }
    }

    $this->join_avaiable()->filter_avaiable();
    $this->db->where($where);
    $this->db->where('POSITION_ARTICLE', 0);
    $this->db->where('DELETED_STATUS', 0);
    if($field != 'INDISPONIBLE') {
      $this->db->where('STATUS_ARTICLE', 1);
    }
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
    $where1 = NULL;

    if (empty($field)) {
      foreach ($this->field_search as $field) {
        if ($iterasi == 1) {
          $where .= "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
        } else {
          $where .= "OR " . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
          $where .= "OR F.NOM_FAMILLE LIKE '%" . $q . "%' ";
          $where .= "OR C.NOM_CATEGORIE LIKE '%" . $q . "%' ";
        }
        $iterasi++;
      }

      $where = '(' . $where . ')';
    } else {
      if ($field == 'REF_SOUS_CATEGORIE_ARTICLE') {
        $where .= "(C.NOM_CATEGORIE LIKE '%" . $q . "%' )";
      } else if ($field == 'REF_CATEGORIE_ARTICLE') {
        $where .= "(F.NOM_FAMILLE LIKE '%" . $q . "%' )";
      } else if ($field == 'INDISPONIBLE') {
        foreach ($this->field_search as $fieldD) {
          if ($iterasi == 1) {
            $where1 .= "" . $this->table_name() . "." . $fieldD . " LIKE '%" . $q . "%' ";
          } else {
            $where1 .= "OR " . "" . $this->table_name() . "." . $fieldD . " LIKE '%" . $q . "%' ";
            $where1 .= "OR F.NOM_FAMILLE LIKE '%" . $q . "%' ";
            $where1 .= "OR C.NOM_CATEGORIE LIKE '%" . $q . "%' ";
          }
          $iterasi++;
        }
        $where .= "STATUS_ARTICLE = 0 AND (".$where1.") ";
      } else {
        $where .= "(" . "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' )";
      }
    }

    if (is_array($select_field) and count($select_field)) {
      $this->db->select($select_field);
    }

    $this->join_avaiable()->filter_avaiable();
    $this->db->where($where);
    $this->db->where('POSITION_ARTICLE', 0);
    $this->db->where('DELETED_STATUS', 0);
    if($field != 'INDISPONIBLE') {
      $this->db->where('STATUS_ARTICLE', 1);
    }
    $this->db->limit($limit, $offset);
    $this->db->order_by('' . $this->table_name() . '.QUANTITE_RESTANTE_ARTICLE', "DESC");
    $query = $this->db->get($this->table_name());

    return $query->result();
  }


  public function count_all_semi_fini($q = null, $field = null)
  {
    $iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);

    if (empty($field)) {
      foreach ($this->field_search as $field) {
        if ($iterasi == 1) {
          $where .= "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
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
    $this->db->where('POSITION_ARTICLE', 1);
    $this->db->where('DELETED_STATUS', 0);
    $query = $this->db->get($this->table_name());

    return $query->num_rows();
  }


  public function get_article_semi_fini($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
  {
    $iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);

    if (empty($field)) {
      foreach ($this->field_search as $field) {
        if ($iterasi == 1) {
          $where .= "" . $this->table_name() . "." . $field . " LIKE '%" . $q . "%' ";
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
    $this->db->where('POSITION_ARTICLE', 1);
    $this->db->where('DELETED_STATUS', 0);
    $this->db->limit($limit, $offset);
    $this->db->order_by('' . $this->table_name() . '.QUANTITE_RESTANTE_ARTICLE', "DESC");
    $query = $this->db->get($this->table_name());

    return $query->result();
  }


  public function join_avaiable()
  {
    $this->db->join('pos_store_' . $this->uri->segment(4) . '_ibi_rayons', 'pos_store_' . $this->uri->segment(4) . '_ibi_rayons.ID_RAYON = ' . $this->table_name() . '.REF_RAYON_ARTICLE', 'LEFT');
    $this->db->join('aauth_users', 'aauth_users.id = ' . $this->table_name() . '.AUTHOR_ARTICLE', 'LEFT');
    $this->db->join('pos_store_' . $this->uri->segment(4) . '_famille F', 'F.ID_FAMILLE = pos_store_' . $this->uri->segment(4) . '_ibi_articles.REF_CATEGORIE_ARTICLE', 'LEFT');
    $this->db->join('pos_store_' . $this->uri->segment(4) . '_ibi_categories C', 'C.ID_CATEGORIE = pos_store_' . $this->uri->segment(4) . '_ibi_articles.REF_SOUS_CATEGORIE_ARTICLE', 'LEFT');

    return $this;
  }

  public function filter_avaiable()
  {
    // $this->db->where('AUTHOR_ARTICLE', get_user_data('id'));

    return $this;
  }
  public function generate_barcode($store, $ref_categorie)
  {

    $lastid = $this->db->query("SELECT lpad(max(ID_ARTICLE)+1,6,0) as Maxcount FROM pos_store_" . $store . "_ibi_articles");
    foreach ($lastid->result_array() as $key => $value) {
      if ($value['Maxcount'] == NULL) {
        $Countmax = "000001";
      } else {
        $Countmax = $value['Maxcount'];
      }
    }
    $store_slug_id = $store;
    $pos_store = $this->db->query("SELECT lpad(count(ID_STORE)+1,4,0) as Countstore FROM pos_ibi_stores WHERE ID_STORE<" . $store_slug_id . "")->result_array();
    $CountPosId = $pos_store[0]['Countstore'];


    $categoriePosId = str_pad($ref_categorie, 3, '0', STR_PAD_LEFT);

    $code = $CountPosId . "-" . $categoriePosId . "-" . $Countmax;

    return $code;
  }

  public function get_reserve($store, $q = null, $field = null, $limit = 0, $offset = 0)
  {

    $where = NULL;
    $where1 = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);

    if (empty($field)) {
      $where = '';
      $where1 = '';
    } elseif ($field == 'REF_CODEBAR') {
      $where = " AND CP.REF_PRODUCT_CODEBAR_COMMAND_PROD LIKE '%" . $q . "%' ";
      $where1 = " AND CP.REF_PRODUCT_CODEBAR_PROFORMA_PROD LIKE '%" . $q . "%' ";
    } else {
      $where = " AND " . $field . " LIKE '%" . $q . "%' ";
      $where1 = " AND " . $field . " LIKE '%" . $q . "%' ";
    }

    $query = $this->db->query("SELECT REQ.NUMERO_REQUISITION,REQ.REF_COMMAND_REQUISITION,REQ.REF_CODEBAR,REQ.NAME,REQ.QUANTITE,LIV.Q FROM(SELECT NUMERO_REQUISITION,REF_COMMAND_REQUISITION,REF_PRODUCT_CODEBAR_COMMAND_PROD AS REF_CODEBAR,NAME_COMMAND_PROD AS NAME,QUANTITE_COMMAND_PROD AS QUANTITE
      FROM pos_store_" . $store . "_ibi_requisition R
      JOIN pos_store_" . $store . "_ibi_commandes_produits CP ON CP.REF_COMMAND_CODE_PROD=R.REF_COMMAND_REQUISITION
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_attente' $where) REQ
        
      LEFT JOIN (SELECT NUMERO_REQUISITION,REF_PRODUCT_CODEBAR_LIVR_PRODUIT,SUM(QUANTITE_LIVR_PRODUIT) AS Q
      FROM pos_store_" . $store . "_ibi_requisition R 
      JOIN pos_store_" . $store . "_ibi_livraison_produit LV ON LV.REF_CODE_REQ_LIVR_PROD=R.NUMERO_REQUISITION 
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_attente' GROUP BY R.NUMERO_REQUISITION, LV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT) LIV ON REQ.REF_CODEBAR=LIV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT AND REQ.NUMERO_REQUISITION=LIV.NUMERO_REQUISITION
      
      UNION ALL    

      SELECT REQ.NUMERO_REQUISITION,REQ.REF_COMMAND_REQUISITION,REQ.REF_CODEBAR,REQ.NAME,REQ.QUANTITE,LIV.Q FROM(SELECT NUMERO_REQUISITION,REF_COMMAND_REQUISITION,REF_PRODUCT_CODEBAR_PROFORMA_PROD AS REF_CODEBAR,NAME_PROFORMA_PROD AS NAME,QUANTITE_PROFORMA_PROD AS QUANTITE
      FROM pos_store_" . $store . "_ibi_requisition R
      JOIN pos_store_" . $store . "_ibi_proforma_produits CP ON CP.REF_PROFORMA_CODE_PROD=R.REF_COMMAND_REQUISITION
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_proforma' $where1) REQ
        
      LEFT JOIN (SELECT NUMERO_REQUISITION,REF_PRODUCT_CODEBAR_LIVR_PRODUIT,SUM(QUANTITE_LIVR_PRODUIT) AS Q
      FROM pos_store_" . $store . "_ibi_requisition R 
      JOIN pos_store_" . $store . "_ibi_livraison_produit LV ON LV.REF_CODE_REQ_LIVR_PROD=R.NUMERO_REQUISITION 
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_proforma' GROUP BY R.NUMERO_REQUISITION, LV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT) LIV ON REQ.REF_CODEBAR=LIV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT AND REQ.NUMERO_REQUISITION=LIV.NUMERO_REQUISITION LIMIT 10000 OFFSET $offset");

    return $query->result();
  }

  public function get_reserve_count_all($store, $q = null, $field = null)
  {
    $where = NULL;
    $where1 = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);

    if (empty($field)) {
      $where = '';
      $where1 = '';
    } elseif ($field == 'REF_CODEBAR') {
      $where = " AND CP.REF_PRODUCT_CODEBAR_COMMAND_PROD LIKE '%" . $q . "%' ";
      $where1 = " AND CP.REF_PRODUCT_CODEBAR_PROFORMA_PROD LIKE '%" . $q . "%' ";
    } else {
      $where .= " AND " . $field . " LIKE '%" . $q . "%' ";
      $where1 .= " AND " . $field . " LIKE '%" . $q . "%' ";
    }

    $query = $this->db->query("
      SELECT 
        REF_CODE_REQ_LIVR_PROD,REF_PRODUCT_CODEBAR_PROFORMA_PROD AS CODEBAR,
        SUM(QUANTITE_PROFORMA_PROD) AS QTE,
        SUM(LV.QUANTITE_LIVR_PRODUIT) AS SORTIE
        FROM pos_store_" . $store . "_ibi_requisition R
        JOIN pos_store_" . $store . "_ibi_proforma_produits CP ON CP.REF_PROFORMA_CODE_PROD=R.REF_COMMAND_REQUISITION
        LEFT JOIN (SELECT REF_CODE_REQ_LIVR_PROD,REF_PRODUCT_CODEBAR_LIVR_PRODUIT,SUM(QUANTITE_LIVR_PRODUIT) AS QUANTITE_LIVR_PRODUIT FROM pos_store_" . $store . "_ibi_livraison_produit 
        GROUP BY REF_PRODUCT_CODEBAR_LIVR_PRODUIT,REF_CODE_REQ_LIVR_PROD)LV ON LV.REF_CODE_REQ_LIVR_PROD=R.NUMERO_REQUISITION 
        AND LV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT = CP.REF_PRODUCT_CODEBAR_PROFORMA_PROD
        WHERE R.STATUT_REQUISITION=1 AND YEAR(R.DATE_CREATION_REQUISITION) = '2021'
          AND R.TYPE_REQUISITION='ibi_order_proforma' $where1
                GROUP BY REF_PRODUCT_CODEBAR_PROFORMA_PROD  
                
        UNION ALL

        SELECT 
            REF_CODE_REQ_LIVR_PROD,REF_PRODUCT_CODEBAR_COMMAND_PROD AS CODEBAR,
            SUM(QUANTITE_COMMAND_PROD) AS QTE,
            SUM(LV.QUANTITE_LIVR_PRODUIT) AS SORTIE
            FROM pos_store_" . $store . "_ibi_requisition R
        JOIN pos_store_" . $store . "_ibi_commandes_produits CP ON CP.REF_COMMAND_CODE_PROD=R.REF_COMMAND_REQUISITION
        LEFT JOIN (SELECT REF_CODE_REQ_LIVR_PROD,REF_PRODUCT_CODEBAR_LIVR_PRODUIT,SUM(QUANTITE_LIVR_PRODUIT) AS QUANTITE_LIVR_PRODUIT FROM pos_store_" . $store . "_ibi_livraison_produit 
        GROUP BY REF_PRODUCT_CODEBAR_LIVR_PRODUIT,REF_CODE_REQ_LIVR_PROD)LV ON LV.REF_CODE_REQ_LIVR_PROD=R.NUMERO_REQUISITION 
        AND LV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT = CP.REF_PRODUCT_CODEBAR_COMMAND_PROD
            WHERE R.STATUT_REQUISITION=1 AND YEAR(R.DATE_CREATION_REQUISITION) = '2021' 
            AND R.TYPE_REQUISITION='ibi_order_attente' $where
            GROUP BY REF_PRODUCT_CODEBAR_COMMAND_PROD");

    return $query->num_rows();
  }

  public function get_reserve1($store, $q = null, $field = null, $limit = 0, $offset = 0)
  {

    $where = NULL;
    $where1 = NULL;
    $where2 = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);

    if (empty($field)) {
      $where = '';
      $where1 = '';
      $where2 = '';
      $where3 = '';
    } elseif ($field == 'REF_CODEBAR') {
      $where = " AND CP.REF_PRODUCT_CODEBAR_COMMAND_PROD LIKE '%" . $q . "%' ";
      $where1 = " AND CP.REF_PRODUCT_CODEBAR_PROFORMA_PROD LIKE '%" . $q . "%' ";
      $where2 = " AND fp.REF_PRODUCT_CODEBAR_FICHE_PROD LIKE '%" . $q . "%' ";
      $where3 = " AND BP.REF_PRODUCT_CODEBAR LIKE '%" . $q . "%' ";
    } elseif ($field == 'NUMERO_REQUISITION') {
      $where = " AND " . $field . " LIKE '%" . $q . "%' ";
      $where1 = " AND " . $field . " LIKE '%" . $q . "%' ";
      $where2 = " AND FT.NUMERO_FICHE LIKE '%" . $q . "%' ";
      $where3 = "";
    } else {
      $where = " AND " . $field . " LIKE '%" . $q . "%' ";
      $where1 = " AND " . $field . " LIKE '%" . $q . "%' ";
      $where2 = " AND FT.DEVIS_CODE_FICHE LIKE '%" . $q . "%' ";
      $where3 = "";
    }

    $query = $this->db->query("SELECT REQ.NUMERO_REQUISITION,REQ.REF_COMMAND_REQUISITION,REQ.REF_CODEBAR,REQ.NAME,REQ.QUANTITE,LIV.Q FROM(SELECT NUMERO_REQUISITION,REF_COMMAND_REQUISITION,REF_PRODUCT_CODEBAR_COMMAND_PROD AS REF_CODEBAR,NAME_COMMAND_PROD AS NAME,QUANTITE_COMMAND_PROD AS QUANTITE
      FROM pos_store_" . $store . "_ibi_requisition R
      JOIN pos_store_" . $store . "_ibi_commandes_produits CP ON CP.REF_COMMAND_CODE_PROD=R.REF_COMMAND_REQUISITION
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_attente' $where) REQ
        
      LEFT JOIN (SELECT NUMERO_REQUISITION,REF_PRODUCT_CODEBAR_LIVR_PRODUIT,SUM(QUANTITE_LIVR_PRODUIT) AS Q
      FROM pos_store_" . $store . "_ibi_requisition R 
      JOIN pos_store_" . $store . "_ibi_livraison_produit LV ON LV.REF_CODE_REQ_LIVR_PROD=R.NUMERO_REQUISITION 
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_attente' GROUP BY R.NUMERO_REQUISITION, LV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT) LIV ON REQ.REF_CODEBAR=LIV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT AND REQ.NUMERO_REQUISITION=LIV.NUMERO_REQUISITION
      
      UNION ALL    

      SELECT REQ.NUMERO_REQUISITION,REQ.REF_COMMAND_REQUISITION,REQ.REF_CODEBAR,REQ.NAME,REQ.QUANTITE,LIV.Q FROM(SELECT NUMERO_REQUISITION,REF_COMMAND_REQUISITION,REF_PRODUCT_CODEBAR_PROFORMA_PROD AS REF_CODEBAR,NAME_PROFORMA_PROD AS NAME,QUANTITE_PROFORMA_PROD AS QUANTITE
      FROM pos_store_" . $store . "_ibi_requisition R
      JOIN pos_store_" . $store . "_ibi_proforma_produits CP ON CP.REF_PROFORMA_CODE_PROD=R.REF_COMMAND_REQUISITION
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_proforma' $where1) REQ
        
      LEFT JOIN (SELECT NUMERO_REQUISITION,REF_PRODUCT_CODEBAR_LIVR_PRODUIT,SUM(QUANTITE_LIVR_PRODUIT) AS Q
      FROM pos_store_" . $store . "_ibi_requisition R 
      JOIN pos_store_" . $store . "_ibi_livraison_produit LV ON LV.REF_CODE_REQ_LIVR_PROD=R.NUMERO_REQUISITION 
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_proforma' GROUP BY R.NUMERO_REQUISITION, LV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT) LIV ON REQ.REF_CODEBAR=LIV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT AND REQ.NUMERO_REQUISITION=LIV.NUMERO_REQUISITION
      
      UNION ALL
      
      SELECT FICHE.NUMERO_REQUISITION,FICHE.REF_COMMAND_REQUISITION,FICHE.REF_CODEBAR,FICHE.NAME,FICHE.QUANTITE,LIV.Q FROM(SELECT FT.ID_FICHE,FT.NUMERO_FICHE AS NUMERO_REQUISITION,FT.DEVIS_CODE_FICHE AS REF_COMMAND_REQUISITION,fp.REF_PRODUCT_CODEBAR_FICHE_PROD AS REF_CODEBAR,fp.NAME_FICHE_PROD AS NAME,(fp.QUANTITE_FICHE_PROD+fp.QUANTITE_ADD_FICHE_PROD) AS QUANTITE
      FROM pos_store_" . $store . "_ibi_fiche_produits fp,pos_store_" . $store . "_ibi_fiche_travail FT
      WHERE fp.ID_FICHE = FT.ID_FICHE AND fp.STATUT_FICHE_PROD=1 AND FT.STATUT_FICHE = 0 $where2) FICHE
       
      LEFT JOIN (SELECT REF_CODE,REF_PRODUCT_CODEBAR,SUM(QUANTITE) AS Q
      FROM pos_store_" . $store . "_ibi_fiche_travail FT 
      JOIN pos_store_" . $store . "_ibi_devis_bon_produit BP ON BP.REF_CODE=FT.ID_FICHE WHERE FT.STATUT_FICHE = 0 $where3 GROUP BY FT.ID_FICHE
    ) LIV ON FICHE.REF_CODEBAR=LIV.REF_PRODUCT_CODEBAR AND FICHE.ID_FICHE=LIV.REF_CODE LIMIT $limit OFFSET $offset");

    return $query->result();
  }

  public function get_reserve_count_all1($store, $q = null, $field = null)
  {
    $where = NULL;
    $where1 = NULL;
    $where2 = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);

    if (empty($field)) {
      $where = '';
      $where1 = '';
      $where2 = '';
    } elseif ($field == 'REF_CODEBAR') {
      $where = " AND CP.REF_PRODUCT_CODEBAR_COMMAND_PROD LIKE '%" . $q . "%' ";
      $where1 = " AND CP.REF_PRODUCT_CODEBAR_PROFORMA_PROD LIKE '%" . $q . "%' ";
      $where2 = " AND fp.REF_PRODUCT_CODEBAR_FICHE_PROD LIKE '%" . $q . "%' ";
    } elseif ($field == 'NUMERO_REQUISITION') {
      $where = " AND " . $field . " LIKE '%" . $q . "%' ";
      $where1 = " AND " . $field . " LIKE '%" . $q . "%' ";
      $where2 = " AND FT.NUMERO_FICHE LIKE '%" . $q . "%' ";
    } else {
      $where = " AND " . $field . " LIKE '%" . $q . "%' ";
      $where1 = " AND " . $field . " LIKE '%" . $q . "%' ";
      $where2 = " AND FT.DEVIS_CODE_FICHE LIKE '%" . $q . "%' ";
    }

    $query = $this->db->query("SELECT REQ.NUMERO_REQUISITION,REQ.REF_COMMAND_REQUISITION,REQ.REF_CODEBAR,REQ.NAME,REQ.QUANTITE,LIV.Q FROM(SELECT NUMERO_REQUISITION,REF_COMMAND_REQUISITION,REF_PRODUCT_CODEBAR_COMMAND_PROD AS REF_CODEBAR,NAME_COMMAND_PROD AS NAME,QUANTITE_COMMAND_PROD AS QUANTITE
      FROM pos_store_" . $store . "_ibi_requisition R
      JOIN pos_store_" . $store . "_ibi_commandes_produits CP ON CP.REF_COMMAND_CODE_PROD=R.REF_COMMAND_REQUISITION
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_attente' AND CP.INLINE_COMMAND_PROD=0 $where) REQ
        
      LEFT JOIN (SELECT NUMERO_REQUISITION,REF_PRODUCT_CODEBAR_LIVR_PRODUIT,SUM(QUANTITE_LIVR_PRODUIT) AS Q
      FROM pos_store_" . $store . "_ibi_requisition R 
      JOIN pos_store_" . $store . "_ibi_livraison_produit LV ON LV.REF_CODE_REQ_LIVR_PROD=R.NUMERO_REQUISITION 
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_attente' GROUP BY R.NUMERO_REQUISITION, LV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT) LIV ON REQ.REF_CODEBAR=LIV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT AND REQ.NUMERO_REQUISITION=LIV.NUMERO_REQUISITION
      
      UNION ALL    

      SELECT REQ.NUMERO_REQUISITION,REQ.REF_COMMAND_REQUISITION,REQ.REF_CODEBAR,REQ.NAME,REQ.QUANTITE,LIV.Q FROM(SELECT NUMERO_REQUISITION,REF_COMMAND_REQUISITION,REF_PRODUCT_CODEBAR_PROFORMA_PROD AS REF_CODEBAR,NAME_PROFORMA_PROD AS NAME,QUANTITE_PROFORMA_PROD AS QUANTITE
      FROM pos_store_" . $store . "_ibi_requisition R
      JOIN pos_store_" . $store . "_ibi_proforma_produits CP ON CP.REF_PROFORMA_CODE_PROD=R.REF_COMMAND_REQUISITION
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_proforma' AND CP.INLINE_PROFORMA_PROD=0 $where1) REQ
        
      LEFT JOIN (SELECT NUMERO_REQUISITION,REF_PRODUCT_CODEBAR_LIVR_PRODUIT,SUM(QUANTITE_LIVR_PRODUIT) AS Q
      FROM pos_store_" . $store . "_ibi_requisition R 
      JOIN pos_store_" . $store . "_ibi_livraison_produit LV ON LV.REF_CODE_REQ_LIVR_PROD=R.NUMERO_REQUISITION 
      WHERE R.STATUT_REQUISITION=1 AND R.TYPE_REQUISITION='ibi_order_proforma' GROUP BY R.NUMERO_REQUISITION, LV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT) LIV ON REQ.REF_CODEBAR=LIV.REF_PRODUCT_CODEBAR_LIVR_PRODUIT AND REQ.NUMERO_REQUISITION=LIV.NUMERO_REQUISITION
      
      UNION ALL
      
      SELECT FICHE.NUMERO_REQUISITION,FICHE.REF_COMMAND_REQUISITION,FICHE.REF_CODEBAR,FICHE.NAME,FICHE.QUANTITE,LIV.Q FROM(SELECT FT.ID_FICHE,FT.NUMERO_FICHE AS NUMERO_REQUISITION,FT.DEVIS_CODE_FICHE AS REF_COMMAND_REQUISITION,fp.REF_PRODUCT_CODEBAR_FICHE_PROD AS REF_CODEBAR,fp.NAME_FICHE_PROD AS NAME,(fp.QUANTITE_FICHE_PROD+fp.QUANTITE_ADD_FICHE_PROD) AS QUANTITE
      FROM pos_store_" . $store . "_ibi_fiche_produits fp,pos_store_" . $store . "_ibi_fiche_travail FT
      WHERE fp.ID_FICHE = FT.ID_FICHE AND fp.STATUT_FICHE_PROD=1 $where2) FICHE
       
      LEFT JOIN (SELECT REF_CODE,REF_PRODUCT_CODEBAR,SUM(QUANTITE) AS Q
      FROM pos_store_" . $store . "_ibi_fiche_travail FT 
      JOIN pos_store_" . $store . "_ibi_devis_bon_produit BP ON BP.REF_CODE=FT.ID_FICHE ) LIV ON FICHE.REF_CODEBAR=LIV.REF_PRODUCT_CODEBAR AND FICHE.ID_FICHE=LIV.REF_CODE");

    return $query->num_rows();
  }

  // change the quantity when you approve the quantity
  public function update_qty_fiche_ouv($codebar, $qty)
  {

    $this->db->set('QUANTITE_RESTANTE_ARTICLE', 'QUANTITE_RESTANTE_ARTICLE-' . $qty, FALSE);
    $this->db->where('CODEBAR_ARTICLE', $codebar);
    $this->db->update($this->table_name());
  }
  public function getListFilter($store, $criteres2 = NULL, $criteres = NULL, $criteres1 = NULL)
  {
    $where = "fam.NOM_FAMILLE LIKE '%" . $criteres . "%' ";
    $where1 = "cat.NOM_CATEGORIE LIKE '%" . $criteres1 . "%' AND a.STATUS_ARTICLE = 1 AND a.DELETED_STATUS = 0 AND a.DESIGN_ARTICLE LIKE '%" . $criteres2 . "%'";

    $this->db->select('a.*,fam.NOM_FAMILLE,cat.NOM_CATEGORIE');
    $this->db->from('pos_store_' . $store . '_ibi_articles a');
    $this->db->join('pos_store_' . $store . '_famille fam', 'fam.ID_FAMILLE = a.REF_CATEGORIE_ARTICLE');
    $this->db->join('pos_store_' . $store . '_ibi_categories cat', 'cat.ID_CATEGORIE = a.REF_SOUS_CATEGORIE_ARTICLE');
    $this->db->where($where);
    $this->db->where($where1);

    $query = $this->db->get();

    if ($query) {
      return $query->result();
    }
  }
  public function getListFilter_count($store, $criteres2 = NULL, $criteres = NULL, $criteres1 = NULL)
  {
    $where = "fam.NOM_FAMILLE LIKE '%" . $criteres . "%' ";
    $where1 = "cat.NOM_CATEGORIE LIKE '%" . $criteres1 . "%' AND a.STATUS_ARTICLE = 1 AND a.DELETED_STATUS = 0 AND a.DESIGN_ARTICLE LIKE '%" . $criteres2 . "%'";

    $this->db->select('a.*,fam.NOM_FAMILLE,cat.NOM_CATEGORIE');
    $this->db->from('pos_store_' . $store . '_ibi_articles a');
    $this->db->join('pos_store_' . $store . '_famille fam', 'fam.ID_FAMILLE = a.REF_CATEGORIE_ARTICLE');
    $this->db->join('pos_store_' . $store . '_ibi_categories cat', 'cat.ID_CATEGORIE = a.REF_SOUS_CATEGORIE_ARTICLE');
    $this->db->where($where);
    $this->db->where($where1);

    $query = $this->db->get();

    if ($query) {
      return $query->num_rows();
    }
  }
  public function getMouvFilter($store, $criteres = NULL, $criteres1 = NULL, $limit = 0, $offset = 0)
  {

    $query = $this->db->query('SELECT ARTICLE.DESIGN_ARTICLE, ARTICLE.RESERVE_ARTICLE,ARTICLE.CODEBAR_ARTICLE, FAMILLE.NOM_FAMILLE, ARTICLE.REF_CATEGORIE_ARTICLE,ARTICLE.REF_SOUS_CATEGORIE_ARTICLE,CATEGORIE.NOM_CATEGORIE 
      FROM pos_store_' . $store . '_ibi_articles ARTICLE 
      LEFT JOIN pos_store_' . $store . '_ibi_categories CATEGORIE ON CATEGORIE.ID_CATEGORIE=ARTICLE.REF_SOUS_CATEGORIE_ARTICLE
      LEFT JOIN pos_store_' . $store . '_famille FAMILLE ON FAMILLE.ID_FAMILLE=ARTICLE.REF_CATEGORIE_ARTICLE
      LEFT JOIN pos_store_' . $store . '_ibi_articles_stock_flow FLOW ON FLOW.REF_ARTICLE_BARCODE_SF=ARTICLE.CODEBAR_ARTICLE
      WHERE ARTICLE.CODEBAR_ARTICLE LIKE "%' . $criteres1 . '%" AND ARTICLE.DELETED_STATUS = 0 AND CATEGORIE.NOM_CATEGORIE LIKE "%' . $criteres . '%" GROUP BY CODEBAR_ARTICLE LIMIT ' . $limit . ' OFFSET ' . $offset . ' ');

    if ($query) {
      return $query->result();
    }
  }
  public function getMouvFilter_count($store, $criteres = NULL, $criteres1 = NULL)
  {

    $query = $this->db->query('SELECT ARTICLE.DESIGN_ARTICLE,ARTICLE.CODEBAR_ARTICLE, FAMILLE.NOM_FAMILLE, ARTICLE.REF_CATEGORIE_ARTICLE,ARTICLE.REF_SOUS_CATEGORIE_ARTICLE,CATEGORIE.NOM_CATEGORIE 
        FROM pos_store_' . $store . '_ibi_articles ARTICLE 
        LEFT JOIN pos_store_' . $store . '_ibi_categories CATEGORIE ON CATEGORIE.ID_CATEGORIE=ARTICLE.REF_SOUS_CATEGORIE_ARTICLE
        LEFT JOIN pos_store_' . $store . '_famille FAMILLE ON FAMILLE.ID_FAMILLE=ARTICLE.REF_CATEGORIE_ARTICLE
        WHERE ARTICLE.CODEBAR_ARTICLE LIKE "%' . $criteres1 . '%" AND ARTICLE.DELETED_STATUS = 0 AND CATEGORIE.NOM_CATEGORIE LIKE "%' . $criteres . '%" GROUP BY CODEBAR_ARTICLE');

    if ($query) {
      return $query->num_rows();
    }
  }
  function getOneFilter($store, $criteres1, $criteres2, $criteres)
  {

    $query = $this->db->query('SELECT a.DESIGN_ARTICLE,a.CODEBAR_ARTICLE,asf.REF_ARTICLE_BARCODE_SF,asf.QUANTITE_SF AS QUANTITE,asf.DATE_CREATION_SF AS DATE_SF,asf.REF_COMMAND_CODE_SF AS REF_CODE,asf.TYPE_SF,asf.AUTHOR_SF AS AUTHOR FROM  pos_store_' . $store . '_ibi_articles a LEFT JOIN pos_store_' . $store . '_ibi_articles_stock_flow asf ON asf.REF_ARTICLE_BARCODE_SF=a.CODEBAR_ARTICLE WHERE a.DELETED_STATUS = 0 AND a.ID_ARTICLE=' . $criteres . ' AND DATE_CREATION_SF >="' . $criteres1 . '" AND DATE_CREATION_SF <="' . $criteres2 . '"');

    return ($query->num_rows() < 1) ? null :
      $query->result();
  }
  function getOneFilter_count($store, $criteres1, $criteres2, $criteres)
  {

    $query = $this->db->query('SELECT a.DESIGN_ARTICLE,a.CODEBAR_ARTICLE,asf.REF_ARTICLE_BARCODE_SF,asf.QUANTITE_SF AS QUANTITE,asf.DATE_CREATION_SF AS DATE_SF,asf.REF_COMMAND_CODE_SF AS REF_CODE,asf.TYPE_SF,asf.AUTHOR_SF AS AUTHOR FROM  pos_store_' . $store . '_ibi_articles a LEFT JOIN pos_store_' . $store . '_ibi_articles_stock_flow asf ON asf.REF_ARTICLE_BARCODE_SF=a.CODEBAR_ARTICLE WHERE a.DELETED_STATUS = 0 AND a.ID_ARTICLE=' . $criteres . ' AND DATE_CREATION_SF >="' . $criteres1 . '" AND DATE_CREATION_SF <="' . $criteres2 . '"');
    return $query->num_rows();
  }
}

/* End of file model_articles.php */
/* Location: ./application/models/model_articles.php */