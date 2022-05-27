<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Hospital Store 1 Ibi Articles Controller
 *| --------------------------------------------------------------------------
 *| Hospital Store 1 Ibi Articles site
 *|
 */

function get_sum($v1, $v2)
{
  return $v1 + intval($v2->MONTANT);
}
class Rapports extends Admin
{
  public function __construct()
  {
    parent::__construct();

    //model 
    $this->load->model('model_r_proforma');
    $this->load->model('model_rm');
  }



  //mvt stock
  ///function to manager mvt stock
  public function get_rapport_articles_shift($shift_id, $store, $cat = 0, $combined = false)
  {
    $past = false;
    $articles = [];

    $article_table = "pos_store_" . $store . "_ibi_articles";

    $flow = "pos_store_" . $store . "_ibi_articles_stock_flow";
    $cat_query = 0;

    if ($cat == 0 || $cat == 3) {
      $cat_query = "";
    } else {
      $cat_query = " AND WHERE art.REF_CATEGORIE_ARTICLE = $cat";
    }


    $this->db->query("SET SQL_BIG_SELECTS=1");
    $all_articles = $this->db->query("
			SELECT		
				`ID_ARTICLE`,
				`DESIGN_ARTICLE`,
				`CODEBAR_ARTICLE`,
				 `DESCRIPTION_ARTICLE`,
				`PRIX_DACHAT_ARTICLE`,
        `PRIX_DE_VENTE_ARTICLE`,
				DATE_CREATION_SF,			 
				`QUANTITY_ARTICLE`,
				`TYPE_SF`,
				`QUANTITE_SF`
			FROM
				$article_table art
		  LEFT JOIN(
				SELECT
					REF_ARTICLE_BARCODE_SF,
					TYPE_SF,
					DATE_CREATION_SF,
					QUANTITE_SF
				FROM
					$flow
				WHERE
					SHIFT_ID_S = '$shift_id'
			) flow
			ON
				flow.REF_ARTICLE_BARCODE_SF = `art`.`CODEBAR_ARTICLE`
      WHERE art.DELETE_STATUS_ARTICLE = 0
			$cat_query
			ORDER BY
				art.DESIGN_ARTICLE")
      ->result();
    // print_r($this->db->last_query());
    // die;

    $stock_value = 0;
    $deff_value = 0;
    $value_exp = 0;

    for ($ll = 0; $ll < sizeof($all_articles); $ll++) {
      $deff = 0;
      $current = $all_articles[$ll];
      // if ($current->CODEBAR_ARTICLE == 'B0001376') {
      // 	print_r($current);
      // 	break;
      // 	die;
      // }

      if (!isset($articles[$current->CODEBAR_ARTICLE])) {
        $articles[$current->CODEBAR_ARTICLE] = [];

        $articles[$current->CODEBAR_ARTICLE]['NAME'] = $current->DESIGN_ARTICLE;
        $articles[$current->CODEBAR_ARTICLE]['CODE'] =  $current->CODEBAR_ARTICLE;
        $articles[$current->CODEBAR_ARTICLE]['INIT'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['IN'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['VEN'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['OUT'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['DEFF'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['SUPP'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['EXP'] = '';
        $articles[$current->CODEBAR_ARTICLE]['EXP_VAL'] = false; //not yet expired
        $articles[$current->CODEBAR_ARTICLE]['ACTU'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['PRIX'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['PRIX_VENTE'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['VALUE'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['VALUE_EXP'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['SHOW_EXP'] = true;
        $articles[$current->CODEBAR_ARTICLE]['DEFF_TOTAL'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['EXIST_NEXT_YEAR'] = false;
      }


      if (!empty(trim($current->TYPE_SF))) {
        if ($combined == TRUE) {
          switch (trim($current->TYPE_SF)) {
            case 'sale':
              $articles[$current->CODEBAR_ARTICLE]['VEN'] += intval($current->QUANTITE_SF);
              break;
            case 'sale_stock_in':
              $articles[$current->CODEBAR_ARTICLE]['VEN'] -= intval($current->QUANTITE_SF);
              break;
            case 'inventory':
              $articles[$current->CODEBAR_ARTICLE]['INIT'] += intval($current->QUANTITE_SF);
              break;
            case 'stock_in':
              $articles[$current->CODEBAR_ARTICLE]['IN'] += intval($current->QUANTITE_SF);
              break;
            case 'stock_out':
              $articles[$current->CODEBAR_ARTICLE]['OUT'] += intval($current->QUANTITE_SF);
              break;
            case 'deffectueux':
              $articles[$current->CODEBAR_ARTICLE]['DEFF'] += intval($current->QUANTITE_SF);
              $deff = (intval($current->QUANTITE_SF) * intval($current->PRIX_DACHAT_ARTICLE));
              $articles[$current->CODEBAR_ARTICLE]['DEFF_TOTAL'] += $deff;
              break;
            case 'suppression':
              $articles[$current->CODEBAR_ARTICLE]['SUPP']  += intval($current->QUANTITE_SF);
              break;
            case null:
              $v = 4;
            default:
              "ok";
          }
        } else {
          switch (trim($current->TYPE_SF)) {
            case 'sale':

              $articles[$current->CODEBAR_ARTICLE]['VEN'] += intval($current->QUANTITE_SF);
              break;
            case 'sale_stock_in':
              $articles[$current->CODEBAR_ARTICLE]['VEN'] -= intval($current->QUANTITE_SF);
              break;
            case 'inventory':
              $articles[$current->CODEBAR_ARTICLE]['INIT'] += intval($current->QUANTITE_SF);
              break;
            case 'stock_in':
            case 'transfert_in':
              $articles[$current->CODEBAR_ARTICLE]['IN'] += intval($current->QUANTITE_SF);
              break;
            case 'stock_out':
            case 'transfert_out':
              $articles[$current->CODEBAR_ARTICLE]['OUT'] += intval($current->QUANTITE_SF);
              break;
            case 'deffectueux':
              $articles[$current->CODEBAR_ARTICLE]['DEFF'] += intval($current->QUANTITE_SF);
              $deff = (intval($current->QUANTITE_SF) * intval($current->PRIX_DACHAT_ARTICLE));
              $articles[$current->CODEBAR_ARTICLE]['DEFF_TOTAL'] += $deff;
              break;
            case 'suppression':
              $articles[$current->CODEBAR_ARTICLE]['SUPP']  += intval($current->QUANTITE_SF);
              break;
            case null:
              $v = 4;
            default:
              "ok";
          }
        }
      } else {
      }

      if ($past == TRUE) {
      } else {
        // We nullify any activity that happens before the 1st of the new year
        // we my have later on a good solution
        switch (trim($current->TYPE_SF)) {
          case 'sale':
            if (explode(" ", $current->DATE_CREATION_SF)[0] < date("Y") . "-01-01") {
              $articles[$current->CODEBAR_ARTICLE]['VEN'] -= intval($current->QUANTITE_SF);
            }
            break;
          case 'sale_stock_in':
            if (explode(" ", $current->DATE_CREATION_SF)[0] < date("Y") . "-01-01") {
              $articles[$current->CODEBAR_ARTICLE]['VEN'] += intval($current->QUANTITE_SF);
            }
            break;
          case 'stock_out':
            if (explode(" ", $current->DATE_CREATION_SF)[0] < date("Y") . "-01-01") {
              $articles[$current->CODEBAR_ARTICLE]['OUT'] -= intval($current->QUANTITE_SF);
            }
            break;
          default:
            $f = "";
            break;
        }
      }

      $actu =
        $past == TRUE ? intval($current->QUANTITY_THEORIQUE_IVI) : intval($current->QUANTITY_ARTICLE);

      $exp_v = 0;
      $stok_v = 0;

      $articles[$current->CODEBAR_ARTICLE]['ACTU'] = $actu;
      $articles[$current->CODEBAR_ARTICLE]['PRIX'] = intval($current->PRIX_DACHAT_ARTICLE);
      $articles[$current->CODEBAR_ARTICLE]['PRIX_VENTE'] = intval($current->PRIX_DE_VENTE_ARTICLE);
      // $articles[$current->CODEBAR_ARTICLE]['VALUE'] = $current->PRIX_DACHAT_ARTICLE;
      if ($articles[$current->CODEBAR_ARTICLE]['EXP_VAL'] === TRUE) {
        $articles[$current->CODEBAR_ARTICLE]['SHOW_EXP'] = false;
        $articles[$current->CODEBAR_ARTICLE]['VALUE'] = 0;
        if ($articles[$current->CODEBAR_ARTICLE]['VALUE_EXP'] == 0) {
          $exp_v =
            $actu * intval($current->PRIX_DACHAT_ARTICLE);
          $articles[$current->CODEBAR_ARTICLE]['VALUE_EXP'] =
            $actu * intval($current->PRIX_DACHAT_ARTICLE);
        }
      } else {
        $articles[$current->CODEBAR_ARTICLE]['VALUE_EXP'] = 0;
        if ($articles[$current->CODEBAR_ARTICLE]['VALUE'] == 0) {
          $stok_v =
            $actu * intval($current->PRIX_DACHAT_ARTICLE);
          $articles[$current->CODEBAR_ARTICLE]['VALUE'] =
            $actu * intval($current->PRIX_DACHAT_ARTICLE);
        }

        $articles[$current->CODEBAR_ARTICLE]['SHOW_EXP'] = true;
        // $articles[$current->CODEBAR_ARTICLE]['EXP'] = "2022-01-01";
      }
      $stock_value += $stok_v;
      $deff_value += $deff;
      $value_exp += $exp_v;
    }

    if ($combined == TRUE) {

      $data =  [
        "store" => $store,
        "past" => $past,
        "val" => $stock_value,
        "deff" => $deff_value,
        "val_exp" => $value_exp,
        "show_perm" => FALSE,

        "data" => $articles
      ];
      return $data;
    } else {
      $data =  [
        "past" => $past,
        "val" => $stock_value,
        "deff" => $deff_value,
        "val_exp" => $value_exp,
        "show_perm" => FALSE,

        "data" => array_values($articles)
      ];
      return $data;
    }
  }

  public function get_rapport_articles($date_depart1, $date_fin1, $store, $cat = 0, $combined = false)
  {
    $past = false;
    $articles = [];
    $select_depart_year = "";
    $true_date_depart = $date_depart1;
    $date_fin1 = $date_fin1;
    $date_qty = $date_fin1;
    $date_flow = $date_fin1;
    $date_depart1 = $date_depart1;

    // print_r($date_depart1); exit();
    $article_table = "pos_store_" . $store . "_ibi_articles";
    $inventaire_item = "pos_store_" . $store . "_ibi_inventaires_items";
    $flow = "pos_store_" . $store . "_ibi_articles_stock_flow";
    $cat_query = 0;

    if ($cat == 0 || $cat == 3) {
      $cat_query = "";
    } else {
      $cat_query = " AND WHERE art.REF_CATEGORIE_ARTICLE = $cat";
    }


    $this->db->query("SET SQL_BIG_SELECTS=1");
    $all_articles = $this->db->query("
			SELECT
				`QUANTITY_THEORIQUE_IVI`,
				`ID_ARTICLE`,
				`DESIGN_ARTICLE`,
				`CODEBAR_ARTICLE`,
				 `DESCRIPTION_ARTICLE`,
				`PRIX_DACHAT_ARTICLE`,
        `PRIX_DE_VENTE_ARTICLE`,
				DATE_CREATION_SF,			 
				`QUANTITY_ARTICLE`,
				`TYPE_SF`,
				`QUANTITE_SF`,
				`DATE_CREATION_IVI`
			FROM
				$article_table art
			LEFT JOIN $inventaire_item `inv` ON
				`inv`.`BARCODE_IVI` = art.CODEBAR_ARTICLE AND inv.DATE_CREATION_IVI > '$date_depart1' AND `inv`.`DATE_CREATION_IVI` <= '$date_qty'
			LEFT JOIN(
				SELECT
					REF_ARTICLE_BARCODE_SF,
					TYPE_SF,
					DATE_CREATION_SF,
					QUANTITE_SF
				FROM
					$flow
				WHERE
					DATE_CREATION_SF > '$date_depart1' AND DATE_CREATION_SF <= '$date_flow'
			) flow
			ON
				flow.REF_ARTICLE_BARCODE_SF = `art`.`CODEBAR_ARTICLE`
      WHERE art.DELETE_STATUS_ARTICLE = 0
			$cat_query
			ORDER BY
				art.DESIGN_ARTICLE")
      ->result();

    $stock_value = 0;
    $deff_value = 0;
    $value_exp = 0;

    for ($ll = 0; $ll < sizeof($all_articles); $ll++) {
      $deff = 0;
      $current = $all_articles[$ll];
      // if ($current->CODEBAR_ARTICLE == 'B0001376') {
      // 	print_r($current);
      // 	break;
      // 	die;
      // }

      if (!isset($articles[$current->CODEBAR_ARTICLE])) {
        $articles[$current->CODEBAR_ARTICLE] = [];

        $articles[$current->CODEBAR_ARTICLE]['NAME'] = $current->DESIGN_ARTICLE;
        $articles[$current->CODEBAR_ARTICLE]['CODE'] =  $current->CODEBAR_ARTICLE;
        $articles[$current->CODEBAR_ARTICLE]['INIT'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['IN'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['VEN'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['OUT'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['DEFF'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['SUPP'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['EXP'] = '';
        $articles[$current->CODEBAR_ARTICLE]['EXP_VAL'] = false; //not yet expired
        $articles[$current->CODEBAR_ARTICLE]['ACTU'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['PRIX'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['PRIX_VENTE'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['VALUE'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['VALUE_EXP'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['SHOW_EXP'] = true;
        $articles[$current->CODEBAR_ARTICLE]['DEFF_TOTAL'] = 0;
        $articles[$current->CODEBAR_ARTICLE]['EXIST_NEXT_YEAR'] = false;
      }


      if (!empty(trim($current->TYPE_SF))) {
        if ($combined == TRUE) {
          switch (trim($current->TYPE_SF)) {
            case 'sale':
              $articles[$current->CODEBAR_ARTICLE]['VEN'] += intval($current->QUANTITE_SF);
              break;
            case 'sale_stock_in':
              $articles[$current->CODEBAR_ARTICLE]['VEN'] -= intval($current->QUANTITE_SF);
              break;
            case 'inventory':
              $articles[$current->CODEBAR_ARTICLE]['INIT'] += intval($current->QUANTITE_SF);
              break;
            case 'stock_in':
              $articles[$current->CODEBAR_ARTICLE]['IN'] += intval($current->QUANTITE_SF);
              break;
            case 'stock_out':
              $articles[$current->CODEBAR_ARTICLE]['OUT'] += intval($current->QUANTITE_SF);
              break;
            case 'deffectueux':
              $articles[$current->CODEBAR_ARTICLE]['DEFF'] += intval($current->QUANTITE_SF);
              $deff = (intval($current->QUANTITE_SF) * intval($current->PRIX_DACHAT_ARTICLE));
              $articles[$current->CODEBAR_ARTICLE]['DEFF_TOTAL'] += $deff;
              break;
            case 'suppression':
              $articles[$current->CODEBAR_ARTICLE]['SUPP']  += intval($current->QUANTITE_SF);
              break;
            case null:
              $v = 4;
            default:
              "ok";
          }
        } else {
          switch (trim($current->TYPE_SF)) {
            case 'sale':

              $articles[$current->CODEBAR_ARTICLE]['VEN'] += intval($current->QUANTITE_SF);
              break;
            case 'sale_stock_in':
              $articles[$current->CODEBAR_ARTICLE]['VEN'] -= intval($current->QUANTITE_SF);
              break;
            case 'inventory':
              $articles[$current->CODEBAR_ARTICLE]['INIT'] += intval($current->QUANTITE_SF);
              break;
            case 'stock_in':
            case 'transfert_in':
              $articles[$current->CODEBAR_ARTICLE]['IN'] += intval($current->QUANTITE_SF);
              break;
            case 'stock_out':
            case 'transfert_out':
              $articles[$current->CODEBAR_ARTICLE]['OUT'] += intval($current->QUANTITE_SF);
              break;
            case 'deffectueux':
              $articles[$current->CODEBAR_ARTICLE]['DEFF'] += intval($current->QUANTITE_SF);
              $deff = (intval($current->QUANTITE_SF) * intval($current->PRIX_DACHAT_ARTICLE));
              $articles[$current->CODEBAR_ARTICLE]['DEFF_TOTAL'] += $deff;
              break;
            case 'suppression':
              $articles[$current->CODEBAR_ARTICLE]['SUPP']  += intval($current->QUANTITE_SF);
              break;
            case null:
              $v = 4;
            default:
              "ok";
          }
        }
      } else {
      }

      if ($past == TRUE) {
      } else {
        // We nullify any activity that happens before the 1st of the new year
        // we my have later on a good solution
        switch (trim($current->TYPE_SF)) {
          case 'sale':
            if (explode(" ", $current->DATE_CREATION_SF)[0] < date("Y") . "-01-01") {
              $articles[$current->CODEBAR_ARTICLE]['VEN'] -= intval($current->QUANTITE_SF);
            }
            break;
          case 'sale_stock_in':
            if (explode(" ", $current->DATE_CREATION_SF)[0] < date("Y") . "-01-01") {
              $articles[$current->CODEBAR_ARTICLE]['VEN'] += intval($current->QUANTITE_SF);
            }
            break;
          case 'stock_out':
            if (explode(" ", $current->DATE_CREATION_SF)[0] < date("Y") . "-01-01") {
              $articles[$current->CODEBAR_ARTICLE]['OUT'] -= intval($current->QUANTITE_SF);
            }
            break;
          default:
            $f = "";
            break;
        }
      }

      $actu =
        $past == TRUE ? intval($current->QUANTITY_THEORIQUE_IVI) : intval($current->QUANTITY_ARTICLE);

      $exp_v = 0;
      $stok_v = 0;

      $articles[$current->CODEBAR_ARTICLE]['ACTU'] = $actu;
      $articles[$current->CODEBAR_ARTICLE]['PRIX'] = intval($current->PRIX_DACHAT_ARTICLE);
      $articles[$current->CODEBAR_ARTICLE]['PRIX_VENTE'] = intval($current->PRIX_DE_VENTE_ARTICLE);
      // $articles[$current->CODEBAR_ARTICLE]['VALUE'] = $current->PRIX_DACHAT_ARTICLE;
      if ($articles[$current->CODEBAR_ARTICLE]['EXP_VAL'] === TRUE) {
        $articles[$current->CODEBAR_ARTICLE]['SHOW_EXP'] = false;
        $articles[$current->CODEBAR_ARTICLE]['VALUE'] = 0;
        if ($articles[$current->CODEBAR_ARTICLE]['VALUE_EXP'] == 0) {
          $exp_v =
            $actu * intval($current->PRIX_DACHAT_ARTICLE);
          $articles[$current->CODEBAR_ARTICLE]['VALUE_EXP'] =
            $actu * intval($current->PRIX_DACHAT_ARTICLE);
        }
      } else {
        $articles[$current->CODEBAR_ARTICLE]['VALUE_EXP'] = 0;
        if ($articles[$current->CODEBAR_ARTICLE]['VALUE'] == 0) {
          $stok_v =
            $actu * intval($current->PRIX_DACHAT_ARTICLE);
          $articles[$current->CODEBAR_ARTICLE]['VALUE'] =
            $actu * intval($current->PRIX_DACHAT_ARTICLE);
        }

        $articles[$current->CODEBAR_ARTICLE]['SHOW_EXP'] = true;
        // $articles[$current->CODEBAR_ARTICLE]['EXP'] = "2022-01-01";
      }
      $stock_value += $stok_v;
      $deff_value += $deff;
      $value_exp += $exp_v;
    }

    if ($combined == TRUE) {

      $data =  [
        "store" => $store,
        "past" => $past,
        "val" => $stock_value,
        "deff" => $deff_value,
        "val_exp" => $value_exp,
        "show_perm" => FALSE,
        "from" => $true_date_depart,
        "to" => explode(" ", $date_fin1)[0],
        "data" => $articles
      ];
      return $data;
    } else {
      $data =  [
        "past" => $past,
        "val" => $stock_value,
        "deff" => $deff_value,
        "val_exp" => $value_exp,
        "show_perm" => FALSE,
        "from" => $true_date_depart,
        "to" => explode(" ", $date_fin1)[0],
        "data" => array_values($articles)
      ];
      return $data;
    }
  }


  public function mouvement_de_stock_store($index = "", $fetch = FALSE)
  {
    //$this->is_allowed('pos_ibi_articles_add');

    $store = $this->uri->segment(2);
    if ($store == 0) {
      set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
      redirect('administrator/stores');
    }
    $id = 0;
    $id = $this->input->get('categorie');
    $date_depart1 = "";
    $date_fin1 = "";
    $articles = [];

    $date_d = $this->input->get('date_depart');
    $date_f = $this->input->get('date_fin');
    if (isset($date_d) && isset($date_f)) {
      $date_depart1 = $date_d;
      $date_fin1 = $date_f;
      $articles = $this->get_rapport_articles($date_depart1, $date_fin1, $store, $id);
    }
    if (empty($date_depart1) and empty($data_fin1)) {
      $date_depart1 = date("Y-m-d 00:00:00");
      $date_fin1 = date("Y-m-d H:i:s");
      $articles = $this->get_rapport_articles($date_depart1, $date_fin1, $store, $id);
    }
    if ($fetch) {
      $articles = $this->get_rapport_articles($date_depart1, $date_fin1, $store, $id);
    }



    // getting all the articles through the main store


    // $all_stores = $this->db->select("ID_STORE")->from("pos_ibi_stores")->where("STATUS_STORE", "opened")->get()->result();
    // print_r($all_stores);
    // die;

    // $cat = $this->db->query('SELECT * FROM pos_ibi_articles_categories  WHERE STORE_ID = "'.$store.'" AND DELETE_STATUS_CATEGORIE=0')->result();
    // echo "<pre>";
    // var_dump($cat);exit();

    $this->data['categorie'] = [];
    $this->data['articles'] = $articles;

    //  $this->model_r_proforma->getOneFilter_store($date_depart, $date_fin, $id);
    $this->data['articles_counts'] = 0;
    $this->data['date_depart'] =
      empty($articles["from"]) ? "" : $articles["from"];;
    //$this->data['date_fin'] = empty($articles["to"]) ? "" : $articles["to"];
    $this->data['du'] = empty($articles["from"]) ? "" : $articles["from"];
    //$this->data['au'] = empty($articles["to"]) ? "" : $articles["to"];
    $this->data['date_fin'] = $date_fin1;
    $this->data['au'] = $date_fin1;

    
    $this->template->title('Rapports');
    $this->render('backend/standart/administrator/pos_ibi_articles/mouvement_de_stock_store', $this->data);
  }

  public function recette_par_shift($offset = 0)
  {


    $dateStart = $this->input->get('date_start');
    $dateEnd = $this->input->get('date_end');


     $dateEnds='';
     $dateStarts='';

    if($dateStart=="" or $dateEnd==""){
       $dateStarts = date('Y-m-d 00:00:00');
       $dateEnds = date('Y-m-d H:i:s');
    }else{ $dateStarts = $dateStart; $dateEnds=$dateEnd;}
    // $last_date = $this->db->get_where('cashier_shifts', array('SHIFT_STATUS' => 1),1,DESC)->row_array();
    $last_date = $this->db->query("SELECT INSERTED_AT_SHIFT FROM cashier_shifts WHERE SHIFT_STATUS = 1 ORDER BY ID_SHIFT DESC ")->row_array();

    $ElemtWhere = "SHIFT_STATUS=1";
    $dateWhere = "SHIFT_STATUS =1 AND INSERTED_AT_SHIFT BETWEEN '" . $dateStarts . "' AND '" . $dateEnds . "' ";

    $whereAll = "";
    if ($dateStart == "") {
      $whereAll = $dateWhere;
    } else {
      $whereAll = $dateWhere;
    }

    // $count = $this->db->get_where('cashier_shifts', array('SHIFT_STATUS' => 1))->num_rows();
    $count=$this->db->query('SELECT * FROM cashier_shifts WHERE '.$whereAll.' ORDER BY ID_SHIFT DESC ')->num_rows();

    $shift=$this->db->query('SELECT * FROM cashier_shifts WHERE '.$whereAll.' ORDER BY ID_SHIFT DESC  ')->result();



    $config = [
      'base_url'     => 'administrator/rapports/recette_par_shift/',
      'total_rows'   => $count,
      'per_page'     => 5000,
      'uri_segment'  => 4,
    ];

    if ($dateEnd == "" or $dateStart=="") {
      $this->data['dateEnd'] = date('Y-m-d H:i:s');
      $this->data['dateStart'] = $dateStarts;
    } else {
      $this->data['dateEnd'] = $dateEnd;
      $this->data['dateStart'] = $this->input->get('date_start');
    }


    $this->data['shift'] = $shift;
    // var_dump($this->data['shift']);exit();

    $this->data['pagination'] = $this->pagination($config);
    $this->render('backend/standart/administrator/pos_ibi_articles/recette_journaliere_view', $this->data);
  }

  public function recette_journaliere_shift($shift, $fetch = FALSE)
  {

    $this->db->query('SET SQL_BIG_SELECTS=1');

    $is_shift_done = false;


    $stores = $this->db->select("NAME_STORE, ID_STORE")->from("pos_ibi_stores")
      ->where("DELETE_STATUS_STORE = 0 AND ID_STORE > 1")->get()->result();
    $selected_shift = '';

    if (true) {
      $selected_shift = $this->db->select("*")->from("cashier_shifts")->where("ID_SHIFT", $shift)->get()->result()[0];
      $this->data['selected_shift'] = $selected_shift;
    } else {
      $selected_shift = $this->db->select("*")->from("cashier_shifts")->where("SHIFT_STATUS", 1)->order_by("ID_SHIFT", "DESC")->limit(1)->get()->row();

      $shift = $selected_shift->ID_SHIFT;
      $this->data['selected_shift'] = $selected_shift;
    }


    $depenses_approvisionner = $this->db->select("SUM(MONTANT_DEPENSE) as MONTANT")
      ->from("pos_depenses")
      ->where('ID_CATEGORIE_DEPENSE ', 1)
      ->where('DELETE_STATUS_DEPENSE ', 0)
      ->where("ID_SHIFT", $shift)
      ->group_by('ID_CATEGORIE_DEPENSE')->get()->result();

    $depenses_approvisionner = array_reduce($depenses_approvisionner, 'get_sum', 0);
    $this->data['approvisionnement'] = $depenses_approvisionner;

    // $shift = 5;

    $shift_list = $this->db->select("*")->from("cashier_shifts")->where("SHIFT_STATUS", 1)->order_by("ID_SHIFT", "DESC")->get()->result();


    $this->data['shift_list'] = $shift_list;
    $this->data['categorie'] = [];
    $articles = [];
    for ($b = 0; $b < sizeof($stores); $b++) {
      $store = $stores[$b];
      $id = 0;
      $id = $this->input->get('categorie');
      $date_depart1 = "";
      $date_fin1 = "";
      $store_articles = [];

      if (true) {

        $depenses_caisse = $this->db->select("SUM(MONTANT_DEPENSE) as MONTANT")
          ->from("pos_depenses")
          ->where('ID_CATEGORIE_DEPENSE >', 3)
          ->where('DELETE_STATUS_DEPENSE ', 0)
          ->where("ID_SHIFT", $shift)
          ->group_by('ID_CATEGORIE_DEPENSE')->get()->result();

        $montant_depenses = array_reduce($depenses_caisse, 'get_sum', 0);
        $this->data['depenses'] = $montant_depenses;
        $store_articles = $this->get_rapport_articles_shift($selected_shift->ID_SHIFT, $store->ID_STORE, $id);
      }
      if ($fetch) {
        // $store_articles = $this->get_rapport_articles_shift($date_depart1, $date_fin1, $store->ID_STORE, $id);
      }

      array_push($articles, array("store" => $store_articles, "store_name" => $store->NAME_STORE));
    }

    $this->data['articles'] = $articles;


    $recette_credit =
      $this->db->select("SUM(cp.QUANTITE * cp.PRIX_VENDU) as MONTANT_TO_PAY")
      ->from("pos_ibi_commandes c")
      ->join("pos_ibi_commandes_produits cp", "cp.pos_IBI_COMMANDES_ID = c.ID_pos_IBI_COMMANDES")
      ->where("COMMANDE_STATUS", 10)
      ->where('c.DELETED_STATUS_pos_IBI_COMMANDES', 0)
      ->where("ID_CASHIER_SHIFT", $shift)
      ->group_by('COMMANDE_STATUS')->get()->result();


    if (sizeof($recette_credit) > 0) {
      $this->data['recette_credit'] = $recette_credit[0]->MONTANT_TO_PAY;
    } else {
      $this->data['recette_credit'] = 0;
    }
    $recette_cash_advance =
      $this->db->select("SUM(MONTANT_PAIEMENT) as MONTANT, TYPE_FACTURE")
      ->from("pos_paiements")
      ->where_in('TYPE_FACTURE', ["2", "3"])
      ->where("SHIFT_ID", $shift)
      ->where("STATUT_ANNULATION",0)
      ->group_by('TYPE_FACTURE')->get()->result();
    if (sizeof($recette_cash_advance) > 0) {
      $this->data['recette_cash_advance'] = array_reduce($recette_cash_advance, 'get_sum', 0);
    } else {
      $this->data['recette_cash_advance'] = 0;
    }
    //  $this->model_r_proforma->getOneFilter_store($date_depart, $date_fin, $id);
    $this->data['articles_counts'] = 0;
    $this->data['date_depart'] =
      empty($articles[0]['store']["from"]) ? "" : $articles[0]['store']["from"];
    $this->data['date_fin'] = empty($articles[0]['store']["to"]) ? "" : $articles[0]['store']["to"];
    $this->data['du'] = empty($articles[0]['store']["from"]) ? "" : $articles[0]['store']["from"];
    $this->data['au'] = empty($articles[0]['store']["to"]) ? "" : $articles[0]['store']["to"];
    $this->data['is_shift'] = true;

    $this->template->title('Rapports Journaliere');
    $this->render('backend/standart/administrator/pos_ibi_articles/recette_journaliere', $this->data);
  }
  public function recette_journaliere($index = "", $fetch = '')
  {
    //$this->is_allowed('pos_ibi_articles_add');
    // getting all the stores

    $this->db->query('SET SQL_BIG_SELECTS=1');

    $stores = $this->db->select("NAME_STORE, ID_STORE")->from("pos_ibi_stores")
      ->where("DELETE_STATUS_STORE = 0")->get()->result();

    $this->data['categorie'] = [];
    $articles = [];
    for ($b = 0; $b < sizeof($stores); $b++) {
      $store = $stores[$b];

      $id = 0;
      $id = $this->input->get('categorie');
      $date_depart1 = "";
      $date_fin1 = "";
      $store_articles = [];

      $date_d = $this->input->get('date_depart');
      $date_f = $this->input->get('date_fin');
      if (isset($date_d) && isset($date_f)) {
        $date_depart1 = $date_d;
        $date_fin1 = $date_f;
      //print_r($date_depart1.'/'.$date_fin1); exit();
        $depenses_caisse = $this->db->select("SUM(MONTANT_DEPENSE) as MONTANT")
          ->from("pos_depenses")
          ->where('ID_CATEGORIE_DEPENSE >', 3)
          ->where('DELETE_STATUS_DEPENSE ', 0)
          ->where("DATE_CREATE_DEPENSE BETWEEN '$date_depart1' AND '$date_fin1'")
          ->group_by('ID_CATEGORIE_DEPENSE')->get()->result();

        $montant_depenses = array_reduce($depenses_caisse, 'get_sum', 0);
        $this->data['depenses'] = $montant_depenses;

        $depenses_approvisionner = $this->db->select("SUM(MONTANT_DEPENSE) as MONTANT")
          ->from("pos_depenses")
          ->where('ID_CATEGORIE_DEPENSE', 1)
          ->where('DELETE_STATUS_DEPENSE ', 0)
          ->where("DATE_CREATE_DEPENSE BETWEEN '$date_depart1' AND '$date_fin1'")
          ->group_by('ID_CATEGORIE_DEPENSE')->get()->result();

        $depenses_approvisionner = array_reduce($depenses_approvisionner, 'get_sum', 0);
        $this->data['approvisionnement'] = $depenses_approvisionner;
        $store_articles = $this->get_rapport_articles($date_depart1, $date_fin1, $store->ID_STORE, $id);
      }
      if (empty($date_depart1) and empty($data_fin1)) {
        $date_depart1 = date("Y-m-d 00:00:00");
        $date_fin1 = date("Y-m-d H:i:s");
        $depenses_caisse = $this->db->select("SUM(MONTANT_DEPENSE) as MONTANT")
          ->from("pos_depenses")
          ->where('ID_CATEGORIE_DEPENSE >', 3)
          ->where('DELETE_STATUS_DEPENSE ', 0)
          ->where("DATE_CREATE_DEPENSE BETWEEN '$date_depart1' AND '$date_fin1'")
          ->group_by('ID_CATEGORIE_DEPENSE')->get()->result();

        $montant_depenses = array_reduce($depenses_caisse, 'get_sum', 0);
        $this->data['depenses'] = $montant_depenses;

        $depenses_approvisionner = $this->db->select("SUM(MONTANT_DEPENSE) as MONTANT")
          ->from("pos_depenses")
          ->where('ID_CATEGORIE_DEPENSE ', 1)
          ->where('DELETE_STATUS_DEPENSE ', 0)
          ->where("DATE_CREATE_DEPENSE BETWEEN '$date_depart1' AND '$date_fin1'")
          ->group_by('ID_CATEGORIE_DEPENSE')->get()->result();

        $depenses_approvisionner = array_reduce($depenses_approvisionner, 'get_sum', 0);
        $this->data['approvisionnement'] = $depenses_approvisionner;
        $store_articles = $this->get_rapport_articles($date_depart1, $date_fin1, $store->ID_STORE, $id);
      }
      if ($fetch) {
        $store_articles = $this->get_rapport_articles($date_depart1, $date_fin1, $store->ID_STORE, $id);
      }

      array_push($articles, array("store" => $store_articles, "store_name" => $store->NAME_STORE));
    }

    $this->data['articles'] = $articles;


    $recette_credit =
      $this->db->select("SUM(cp.QUANTITE * cp.PRIX_VENDU) as MONTANT_TO_PAY")
      ->from("pos_ibi_commandes c")
      ->join("pos_ibi_commandes_produits cp", "cp.pos_IBI_COMMANDES_ID = c.ID_pos_IBI_COMMANDES")
      ->where("COMMANDE_STATUS", 10)
      ->where('c.DELETED_STATUS_pos_IBI_COMMANDES', 0)
      ->where("DATE_PAIEMENT_COMMANDE BETWEEN '$date_depart1' AND '$date_fin1'")
      ->group_by('COMMANDE_STATUS')->get()->result();


    if (sizeof($recette_credit) > 0) {
      $this->data['recette_credit'] = $recette_credit[0]->MONTANT_TO_PAY;
    } else {
      $this->data['recette_credit'] = 0;
    }
    $recette_cash_advance =
      $this->db->select("SUM(MONTANT_PAIEMENT) as MONTANT, TYPE_FACTURE")
      ->from("pos_paiements")
      ->where_in('TYPE_FACTURE', ["2", "3"])
      ->where("STATUT_ANNULATION",0)
      ->where("DATE_CREATION_PAIEMENT BETWEEN '$date_depart1' AND '$date_fin1'")
      ->group_by('TYPE_FACTURE')->get()->result();
    if (sizeof($recette_cash_advance) > 0) {
      $this->data['recette_cash_advance'] = array_reduce($recette_cash_advance, 'get_sum', 0);
    } else {
      $this->data['recette_cash_advance'] = 0;
    }
    //  $this->model_r_proforma->getOneFilter_store($date_depart, $date_fin, $id);
    $this->data['articles_counts'] = 0;
    $this->data['date_depart'] =
      empty($articles[0]['store']["from"]) ? "" : $articles[0]['store']["from"];
    $this->data['date_fin'] = $date_f;
    $this->data['du'] = empty($articles[0]['store']["from"]) ? "" : $articles[0]['store']["from"];
    //$this->data['au'] = empty($articles[0]['store']["to"]) ? "" : $articles[0]['store']["to"];
    $this->data['au'] = $date_f;

   //var_dump($this->data['au']);exit();

    $this->template->title('Rapports Journaliere');
    $this->render('backend/standart/administrator/pos_ibi_articles/recette_journaliere', $this->data);
  }


  public function view_detail_commande($index = "")
  {
    $ID_COMMAND = $this->uri->segment(3);

    $this->data['PRODUCT_COMMAND'] = $this->db->query("SELECT * FROM pos_ibi_commandes_produits WHERE DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS=0 AND
	   pos_IBI_COMMANDES_ID = $ID_COMMAND")->result();

    $this->template->title('Rapport details');
    $this->render('backend/standart/administrator/pos_ibi_articles/rapports_detail_commande', $this->data);
  }

  public function rapports_approvisionnements()
  {
    $STORE = $this->uri->segment(2);
    $critere = 0;
    $this->data['APPROVISIONNEMENT'] = $this->model_r_proforma->getAllApprov($critere, $STORE);

    $this->template->title('Rapports_Montant approvisionner');
    $this->render('backend/standart/administrator/pos_ibi_articles/rapports_montant_approvisionner', $this->data);
  }

  public function rapports_montant_detail()
  {

    $STORES = $this->uri->segment(2);
    $critere = $this->uri->segment(4);
    $criteres = array('STATUS_ARRIVAGE_DETAIL !=' => 0, 'ID_APPOVISIONNEMENT' => $critere);


    $this->data['APPROVISIONNEMENT_DET'] = $this->model_r_proforma->getRequete('select * from 
    (SELECT ID_INGREDIENT AS ID,
        UNITE_INGREDIENT AS UNITE, 
        CODEBAR_INGREDIENT AS CODEBAR,
  		 DESIGN_INGREDIENT AS NOM_ART, 
  		 QUANTITY_INGREDIENT AS QTE,
  		 PRIX_DACHAT_INGREDIENT AS PRIX,
  		"ingredient" AS TYPES
  		FROM `pos_ibi_ingredients`  WHERE DELETE_STATUS_INGREDIENT =0 
        UNION ALL SELECT ID_ARTICLE AS ID,
         UNITE_ARTICLE AS UNITE,
         CODEBAR_ARTICLE AS CODEBAR,
		 DESIGN_ARTICLE AS NOM_ART, 
		 QUANTITY_ARTICLE AS QTE,
		 PRIX_DACHAT_ARTICLE AS PRIX,
		"article" AS TYPES
        FROM pos_store_' . $STORES . '_ibi_articles  WHERE TYPE_ARTICLE=0) MY_REQ

          INNER JOIN pos_store_detail_arrivage
		  INNER JOIN pos_store_2_ibi_articles_stock_flow
          INNER JOIN aauth_users 

           ON aauth_users.id = pos_store_detail_arrivage.CREATE_BY_ARRIVAGE_DETAIL      
		        AND pos_store_detail_arrivage.CODE_BAR = MY_REQ.CODEBAR
			AND pos_store_2_ibi_articles_stock_flow.REF_ARTICLE_BARCODE_SF = MY_REQ.CODEBAR
        
           WHERE pos_store_detail_arrivage.ID_APPOVISIONNEMENT = "' . $critere . '"

         ');

    $this->template->title('Rapports_Montant approvisionner Details');
    $this->render('backend/standart/administrator/rapport/rapports_montant_approvisionner_detail', $this->data);
  }

  public function rapports_paiements()
  {
    $this->data['PAIEMENT'] = $this->model_r_proforma->getPaiementParCommandes('pos_paiements');
    $this->template->title('Rapports de paiement par commandes');
    $this->render('backend/standart/administrator/rapport/rapports_paiement_commandes', $this->data);
  }

  public function rapports_clients($offset = 0)
  {

    $offset = $this->uri->segment(4);
    $store = $this->uri->segment(2);
    $this->is_allowed('rapports_clients');
    if ($store == 0) {
      set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
      redirect('administrator/stores');
    }

    $filter = $this->input->get('q');
    $field  = $this->input->get('f');

    $this->data['clients'] = $this->model_r_proforma->get($filter, $field, $this->limit_page, $offset);
    $this->data['client_count'] = $this->model_r_proforma->count_all($filter, $field);
    $config = [
      'base_url'     => 'rapports/' . $store . '/rapports_clients',
      'total_rows'   => $this->model_r_proforma->count_all($filter, $field),
      'per_page'     => $this->limit_page,
      'uri_segment'  => 4,
    ];

    $this->data['pagination'] = $this->pagination($config);
    $this->template->title('Rapports des clients');
    $this->render('backend/standart/administrator/rapport/rapports_clients', $this->data);
  }

  public function detail_rapport_cmd()
  {
    $this->template->title('Rapports des clients');
    $this->render('backend/standart/administrator/rapport/detail_rapport_cmdClient', $this->data);
  }


  public function view_detail_cmd()
  {

    $this->template->title('Detail commandes');
    $this->render('backend/standart/administrator/rapport/By_Details_commmandes', $this->data);
  }


  public function serveurs($offset = 0)
  {

    // $store=$this->uri->segment(2);
    // $offset = $this->uri->segment(4);
    $filter = $this->input->get('q');
    $field   = $this->input->get('f');

    $offset = $this->uri->segment(3);

    $this->data['visitors'] = $this->model_r_proforma->get_server($filter, $field, $this->limit_page = 400, $offset);
    $this->data['visitor_count'] = $this->model_r_proforma->count_all_server($filter, $field);

    $config = [
      'base_url'     => 'rapports/serveurs/',
      'total_rows'   => $this->model_r_proforma->count_all_server($filter, $field),
      'per_page'     => 400,
      'uri_segment'  => 4,
    ];

    $this->data['pagination'] = $this->pagination($config);
    $this->template->title('Detail Serveurs');
    $this->render('backend/standart/administrator/rapport/detail_serveurs', $this->data);
  }



  //   public function commande_serveurs(){
  //       $date_depart1 = $this->input->get('date_depart');
  //       $date_fin1 = $this->input->get('date_fin');
  //       $status_command = $this->input->get('status_command');
  //       $stores= $this->uri->segment(2);
  //       $URI_SERVER= $this->uri->segment(4);

  //       $date_depart = $date_depart1.' 00:00:00';
  //       $date_fin = $date_fin1.' H:i:s';

  //       $this->data['type_de_facture'] = $this->model_r_proforma->sans_where('type_facture');
  //       $this->data['CMD'] = $this->model_r_proforma->getOneFilter_CMD($date_depart1,$date_fin1,$URI_SERVER,$status_command);

  //       $this->data['date_depart'] = $date_depart;
  //       $this->data['date_fin'] = $date_fin;
  //       $this->data['du'] = $date_depart1;
  //       $this->data['au'] = $date_fin1;

  //   $this->template->title('Commandes selon les serveurs');
  //   $this->render('backend/standart/administrator/rapport/commande_by_server', $this->data); 

  // }





  public function commande_serveurs($offset = 0)
  {
    $status_command = $this->input->get('status_command');
    $URI_SERVER = $this->uri->segment(3);
    $status   = $this->input->get('status');
    $shift = $this->input->get('shift');

    if ($shift != '') {
      $date_depart = '';
      $date_fin = '';
    } else {
      $date_depart = $this->input->get('DEBUT');
      $date_fin = $this->input->get('FIN');
    }
    //$offset = $this->uri->segment(4);
    $user = $this->uri->segment(3);

    $filter = $this->input->get('q');
    $user = $this->input->get('user');
    $field  = $this->input->get('f');
    // var_dump($field);exit;


    // $this->data['type_de_facture'] = $this->model_r_proforma->sans_where('type_facture');
    // $this->data['pos_ibi_commandess'] = $this->model_r_proforma->getOneFilter_CMD($date_depart1,$date_fin1,$URI_SERVER,$status_command);
    $commandes = $this->model_r_proforma->get_cmd($date_depart, $date_fin, $shift, $status, $filter, $field, $this->limit_page = 400, $offset);

    $this->data['pos_ibi_commandess'] = $commandes;
    $this->data['pos_ibi_commandes_counts'] = $this->model_r_proforma->count_all_cmd($date_depart, $date_fin, $shift, $filter, $field);
    $total_headers = $this->model_r_proforma->get_total_header($date_depart, $date_fin, $URI_SERVER, $shift, $filter, $field, $status, 400, $offset);



    for ($c = 0; $c < sizeof($commandes); $c++) {
      $current_c = $commandes[$c];
      $bons = [];
      $prods = $this->db->select("*")
        ->from("pos_ibi_commandes_produits cp")
        ->join("pos_ibi_stores st", "st.ID_STORE = cp.STORE_ID_pos_IBI_COMMANDES_PRODUITS")
        ->where("cp.pos_IBI_COMMANDES_ID", $current_c->ID_pos_IBI_COMMANDES)
        ->where("cp.DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS",0)
        ->where("cp.QUANTITE >", 0)
        ->get()->result();

      $current_c->PRODUCTS = $prods;
      for ($cp = 0; $cp < sizeof($prods); $cp++) {
        if (!isset($bons[$prods[$cp]->STORE_ID_pos_IBI_COMMANDES_PRODUITS])) {
          $bons[$prods[$cp]->STORE_ID_pos_IBI_COMMANDES_PRODUITS] = [];
          // $bons[$prods[$cp]->STORE_ID_pos_IBI_COMMANDES_PRODUITS][0]['STOCK'] = $prods[$cp]->NAME_STORE;
          // $bons[$prods[$cp]->STORE_ID_pos_IBI_COMMANDES_PRODUITS][0]['VENTE'] = $prods[$cp]->REF_COMMAND_CODE;
        }
        array_push($bons[$prods[$cp]->STORE_ID_pos_IBI_COMMANDES_PRODUITS], $prods[$cp]);
      }
      $current_c->BON = array_values($bons);
    }

    $config = [
      'base_url'     => 'rapports/commande_serveurs/' . $this->uri->segment(3) . '/',
      'total_rows'   => $this->model_r_proforma->count_all_cmd($shift, $filter, $field),
      'per_page'     => $this->limit_page = 400,
      'uri_segment'  => 4,
    ];


    $this->data['du'] = $date_depart;
    $this->data['au'] = $date_fin;
    $this->data['statut'] = $status;

    $this->template->title('Commandes selon les serveurs');
    $this->render('backend/standart/administrator/rapport/serveur_with_commande', $this->data);
  }


  public function det_pdf_detail_by_server_status()
  {
    $status = $this->uri->segment(5);
    $server = $this->uri->segment(4);
    $header = $this->db->get_where('pos_ibi_commandes', array('CREATED_BY_pos_IBI_COMMANDES' => $server))->row();
    $commandes = $this->model_r_proforma->get_commande_status_rapport($status, $server);

    $this->template->title('Pos Ibi Commandes List');
    $this->data['commande'] = $commandes;
    $this->data['header'] = $header;
    //$this->data['totalss']=$header;
    $this->render('backend/standart/administrator/rapport/rapport_pdf_by_statut', $this->data);
  }


  function rapport_ventes()
  {
    $date_start = $this->input->get('date_start');
    $date_end = $this->input->get('date_end');
    $categorie = $this->input->get('type_facture');

     if (empty($date_start) and empty($date_fin)) {
     
      $date_depart = date('Y-m-d 00:00:00');
      $date_fin = date('Y-m-d H:i:s');
    }

    $this->data['status'] = $categorie;
    $this->data['getterOner'] = $this->model_r_proforma->rapport_commands($date_start, $date_end, $categorie);


    $all_prix = $this->model_r_proforma->rapport_prix_all($date_start, $date_end, $categorie);
    $this->data['prix_de_vente'] = $all_prix['PRIX_V'];

    $all_prixs = $this->model_r_proforma->rapport_prix_achat_t($date_start, $date_end, $categorie);
    $this->data['prix_de_achat_t'] = $all_prixs['PRIX_A'];

    $all_prix_final = $this->model_r_proforma->rapport_prix_qte($date_start, $date_end, $categorie);
    $this->data['prix_Qte_fin'] = $all_prix_final['QTE'];

    $this->data['somme_bs'] = $this->data['prix_Qte_fin'] * $all_prixs['PRIX_A'];



    $this->data['type_de_facture'] = $this->model_r_proforma->sans_where('type_facture');
    $this->template->title('Rapports des Ventes');
    $this->render('backend/standart/administrator/rapport/rapports_ventes', $this->data);
  }


  public function rapport_tva($index = "", $fetch = FALSE)
  {

    $date_d = $this->input->get('date_depart');
    $date_f = $this->input->get('date_fin');

    if (!empty($date_d) && !empty($date_f)) {
      
       $date_depart = $date_d;
       $date_fin = $date_f; 
        
    } else {
      $date_depart = date('Y-m-d 00:00:00');
      $date_fin = date('Y-m-d H:i:s');
    }


    $date_depart_ = $date_depart;
    $date_fin_ = $date_fin;


    $result = $this->db->query("
        SELECT S.CODE,S.DATE_PAIEMENT_COMMANDE,S.TVA ,S.MONTANT_PAYE,S.CREATED_BY_pos_IBI_COMMANDES,S.COMMANDE_STATUS, S.MONTANT_DU,S.ISVIP FROM pos_ibi_commandes S
        LEFT JOIN pos_paiements ITM ON S.ID_pos_IBI_COMMANDES = ITM.COMMANDE_ID 
        
        WHERE ITM.DELETED_STATUS_PAIEMENT=0 AND S.DELETED_STATUS_pos_IBI_COMMANDES=0 AND S.COMMANDE_STATUS!=0  AND S.   DATE_PAIEMENT_COMMANDE BETWEEN '" . $date_depart_ . "' AND '" . $date_fin_ . "' ");

    if ( $result->num_rows() >0) {

      $this->data['res'] = $result->result();
     
    }

     /*$resultat = $this->db->query("
        SELECT SUM(S.TVA) AS SOMME_TVA FROM pos_ibi_commandes S
        LEFT JOIN pos_paiements ITM ON S.ID_pos_IBI_COMMANDES = ITM.COMMANDE_ID 
        
        WHERE ITM.DELETED_STATUS_PAIEMENT=0 AND S.DELETED_STATUS_pos_IBI_COMMANDES=0 AND S.COMMANDE_STATUS!=0  AND S.COMMANDE_STATUS!=11 AND S.DATE_PAIEMENT_COMMANDE BETWEEN '" . $date_depart_ . "' AND '" . $date_fin_ . "' ");


     $resultat_tva = $this->db->query("
        SELECT SUM(S.TVA) AS SOMME_TVA_CREDIT FROM pos_ibi_commandes S
        LEFT JOIN pos_paiements ITM ON S.ID_pos_IBI_COMMANDES = ITM.COMMANDE_ID 
        
        WHERE ITM.DELETED_STATUS_PAIEMENT=0 AND S.DELETED_STATUS_pos_IBI_COMMANDES=0 AND S.COMMANDE_STATUS=10 AND S.DATE_PAIEMENT_COMMANDE BETWEEN '" . $date_depart_ . "' AND '" . $date_fin_ . "' ");


     $resultat_credit = $this->db->query("
        SELECT SUM(S.MONTANT_DU-S.TVA) AS SOMME_CREDITS FROM pos_ibi_commandes S
        LEFT JOIN pos_paiements ITM ON S.ID_pos_IBI_COMMANDES = ITM.COMMANDE_ID 
        
        WHERE ITM.DELETED_STATUS_PAIEMENT=0 AND S.DELETED_STATUS_pos_IBI_COMMANDES=0 AND S.COMMANDE_STATUS=10 AND S.DATE_PAIEMENT_COMMANDE BETWEEN '" . $date_depart_ . "' AND '" . $date_fin_ . "' ");

     $resultat_complementarys = $this->db->query("
        SELECT SUM(S.MONTANT_DU-S.TVA) AS SOMME_COMPLEMENTARYS FROM pos_ibi_commandes S
        LEFT JOIN pos_paiements ITM ON S.ID_pos_IBI_COMMANDES = ITM.COMMANDE_ID 
        
        WHERE ITM.DELETED_STATUS_PAIEMENT=0 AND S.DELETED_STATUS_pos_IBI_COMMANDES=0 AND S.COMMANDE_STATUS=11 AND S.DATE_PAIEMENT_COMMANDE BETWEEN '" . $date_depart_ . "' AND '" . $date_fin_ . "' ");

    
      $this->data['somme_tva'] = $resultat->row()->SOMME_TVA;
    
      $this->data['somme_tva_credit'] = $resultat_tva->row()->SOMME_TVA_CREDIT;

      $this->data['somme_credit'] = $resultat_credit->row()->SOMME_CREDITS;

      $this->data['somme_complementarys'] = $resultat_complementarys->row()->SOMME_COMPLEMENTARYS;*/


  //print_r($this->data['somme_credit']);exit;
     

    $this->data['date_depart'] = $date_depart_;
    $this->data['date_fin'] = $date_fin_;



    //$this->data['type_de_facture'] = $this->model_r_proforma->sans_where('type_facture');
    $this->template->title('Rapports tva');
    $this->render('backend/standart/administrator/rapport/rapports_tva', $this->data);
  }


  public function rapport_sorties($index = "", $fetch = FALSE)
  {

    $date_d = $this->input->get('date_depart');
    $date_f = $this->input->get('date_fin');

    if (isset($date_d) && isset($date_f)) {
      $date_depart = $date_d;
      $date_fin = $date_f;
    } else {
      $date_depart = date('Y-m-d 00:00:00');
      $date_fin = date('Y-m-d H:i:s');
    }

    $date_depart_ = $date_depart;
    $date_fin_ = $date_fin;


    $result = $this->db->query("
        SELECT *FROM pos_store_1_ibi_sortie S
        LEFT JOIN pos_store_1_ibi_sortie_items ITM ON S.CODE_SORTIE = ITM.REF_CODE_SORTIE
        LEFT JOIN  pos_ibi_stores ST ON S.DESTINATION_SORTIE=ST.ID_STORE
        WHERE S.DELETE_STATUS_SORTIE=0  AND S.DATE_CREATION_SORTIE BETWEEN '" . $date_depart_ . "' AND '" . $date_fin_ . "' ")->result_array();



    $obj = [];
    foreach ($result as $key) {
      $name_store = $key['ID_STORE'] > 0 ?  $key['NAME_STORE'] : "AUTRES EMPLACEMENTS";

      if (!isset($obj[$name_store][$key['REF_CODE_BAR_SORTIE_ITM']])) {

        $obj[$name_store][$key['REF_CODE_BAR_SORTIE_ITM']] = array(

          "nom" => $key['PRODUCT_NAME_SORTIE_ITM'],
          "qt" => $key['QTE_SORTIE_ITM'],
          "montant" => $key['PRIX_SORTIE_ITM'],
        );
      } else {
        $obj[$name_store][$key['REF_CODE_BAR_SORTIE_ITM']]['qt']++;
      }
    }




    $this->data['res'] = $obj;


    $this->data['date_depart'] = $date_depart;
    $this->data['date_fin'] = $date_fin;



    //$this->data['type_de_facture'] = $this->model_r_proforma->sans_where('type_facture');
    $this->template->title('Rapports des sorties');
    $this->render('backend/standart/administrator/rapport/rapports_sorties', $this->data);
  }


  function getcommandData()
  {

    $selecter_date = $this->input->post('selecter_date');
    $add_beggin = $selecter_date;
    $end_timeDays = $selecter_date;

    $get_command = $this->db->query(" SELECT DISTINCT NAME FROM pos_ibi_commandes_produits WHERE DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS=0 AND DATE_PAIEMENT_COMMANDE_PRODUITS BETWEEN '" . $add_beggin . "' AND '" . $end_timeDays . "' ")->result_array();


    $date_show = "";
    $N = 0;
    foreach ($get_command as $dt) :
      $codebar = $this->model_r_proforma->getOne('pos_ibi_commandes_produits', array('NAME' => $dt['NAME'], 'DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS'=>0));

      if ($dt)
        $N++;
      $date_show .= '
                <tr>
                  <td>  ' . $N . '</td>
                   <td> ' . $dt["NAME"] . ' </td>
                   <td class="text-center"> ' .
        $nombr = $this->db->query("SELECT * FROM pos_ibi_commandes_produits WHERE DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS=0 AND DATE_PAIEMENT_COMMANDE_PRODUITS BETWEEN '" . $add_beggin . "' 
                         	AND '" . $end_timeDays . "' AND NAME = '" . $dt["NAME"] . "'  ")->num_rows()

        . '</td>

                    <td> 
                         ' . $codebar['REF_COMMAND_CODE'] . ';
                    </td>
                    <td> </td>
                    <td> </td>
                  
                </tr>

       	   ';
    endforeach;
    $s['showAll'] = $date_show;

    echo json_encode($s);
  }

  public function depenseRapports()
  {
    $date_start = $this->input->get('date_start');
    $date_end = $this->input->get('date_end');
    $categorie = $this->input->get('type_categorie');

     if (empty($date_start) and empty($date_end)) {
      $date_end = date("Y-m-d H:i:s");
      $date_start = date("Y-m-d 00:00:00");
    }

    $this->data['getter_depense'] = $this->model_r_proforma->getDepense($date_start, $date_end, $categorie);


    $this->data['categorie'] = $categorie;
    $this->data['date_start'] = $date_start;
    $this->data['date_end'] = $date_end;

    $this->template->title('Rapports de depense');
    $this->render('backend/standart/administrator/rapport/rapportDepense', $this->data);
  }



  public function rapport_condenser()
  {

    $date_start = $this->input->get('date_depart');
    $date_end = $this->input->get('date_fin');

    $this->data["start"] = $date_start;
    $this->data["end"] = $date_end;

    if (empty($date_start) and empty($date_end)) {
      $end = date("Y-m-d H:i:s");
      $start = date("Y-m-d 00:00:00");
    } else {
      $end = $date_end;
      $start = $date_start;
    }




    // FACTURES PAYEES
    $this->data['payer_all'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(p.MONTANT_PAIEMENT) as TOTAL 
      FROM pos_paiements p 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=p.COMMANDE_ID 
      WHERE c.DELETED_STATUS_pos_IBI_COMMANDES=0 AND c.COMMANDE_STATUS=2 AND p.STATUT_ANNULATION=0
      AND c.DATE_PAIEMENT_COMMANDE BETWEEN '" . $start . "' AND '" . $end . "'

      "
    );

    $this->data['count_paie'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 2
      ),
      $start,
      $end
    );

    $somm  = 0;
    if (is_null($date_start)) {
      $getProduct_cmd = $this->db->query("SELECT PRIX_VENDU,QUANTITE FROM pos_ibi_commandes_produits produit INNER JOIN pos_ibi_commandes cmd ON cmd.ID_pos_IBI_COMMANDES = produit.pos_IBI_COMMANDES_ID WHERE cmd.COMMANDE_STATUS = 1 AND cmd.DELETED_STATUS_pos_IBI_COMMANDES =0 ")->result();
    } else {
      $getProduct_cmd = $this->db->query("SELECT PRIX_VENDU,QUANTITE FROM pos_ibi_commandes_produits produit INNER JOIN pos_ibi_commandes cmd ON cmd.ID_pos_IBI_COMMANDES = produit.pos_IBI_COMMANDES_ID WHERE cmd.COMMANDE_STATUS = 1 AND cmd.DELETED_STATUS_pos_IBI_COMMANDES =0 AND DATE_PAIEMENT_COMMANDE BETWEEN '" . $date_start . "' AND '" . $date_end . "' ")->result();
    }


    foreach ($getProduct_cmd as $k) {
      $somm += $k->PRIX_VENDU * $k->QUANTITE;
    }


    $this->data['sommeImpay'] = $somm;


    //FACTURES IMPAYEES
    $this->data['impayer'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(pr.QUANTITE*pr.PRIX_VENDU) AS TOTAL 
      FROM pos_ibi_commandes_produits pr 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=pr.pos_IBI_COMMANDES_ID 
      WHERE c.COMMANDE_STATUS=10 AND c.DELETED_STATUS_pos_IBI_COMMANDES=0 
      AND c.DATE_PAIEMENT_COMMANDE BETWEEN '" . $start . "' AND '" . $end . "'"
    );


    $this->data['count_impayer'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 10
      ),
      $start,
      $end
    );




    //FACTURES COMPLEMENTARY
    $this->data['complementary'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(pr.QUANTITE*pr.PRIX_VENDU) AS TOTAL 
      FROM pos_ibi_commandes_produits pr 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=pr.pos_IBI_COMMANDES_ID 
      WHERE c.COMMANDE_STATUS=11 AND c.DELETED_STATUS_pos_IBI_COMMANDES=0 
      AND c.DATE_PAIEMENT_COMMANDE BETWEEN '" . $start . "' AND '" . $end . "'"
    );


    $this->data['count_complementary'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 11
      ),
      $start,
      $end
    );



    //FACTURES EN AVANCE
    $this->data['avance'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(p.MONTANT_PAIEMENT) as TOTAL 
      FROM pos_paiements p 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=p.COMMANDE_ID 
      WHERE c.DELETED_STATUS_pos_IBI_COMMANDES=0 AND c.COMMANDE_STATUS=1 AND p.STATUT_ANNULATION=0 
      AND c.DATE_PAIEMENT_COMMANDE BETWEEN '" . $start . "' AND '" . $end . "'"
    );

    $this->data['count_avance'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 1
      ),
      $start,
      $end
    );


    //RESTE SUR AVANCE
    $this->data['reste'] = (int) $this->model_rm->getRequeteOne(
      "
      SELECT SUM(pr.QUANTITE*pr.PRIX_VENDU) AS TOTAL 
      FROM pos_ibi_commandes_produits pr 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=pr.pos_IBI_COMMANDES_ID 
      WHERE c.COMMANDE_STATUS=1 AND c.DELETED_STATUS_pos_IBI_COMMANDES=0
      AND c.DATE_PAIEMENT_COMMANDE BETWEEN '" . $start . "' AND '" . $end . "' "
    )['TOTAL'] - (int)$this->data['avance']['TOTAL'];



    //FACTURES EN ATTENTE
    $this->data['attente'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(pr.QUANTITE*pr.PRIX_VENDU) AS TOTAL 
      FROM pos_ibi_commandes_produits pr 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=pr.pos_IBI_COMMANDES_ID 
      WHERE c.COMMANDE_STATUS=0 AND c.DELETED_STATUS_pos_IBI_COMMANDES=0 
      AND c.DATE_PAIEMENT_COMMANDE BETWEEN '" . $start . "' AND '" . $end . "'"
    );


    $this->data['count_attente'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 0
      ),
      $start,
      $end
    );





    //PAIEMENTS
    $res = $this->model_rm->getRequete(
      "SELECT *FROM pos_paiements p 
      JOIN mode_paiement m on p.MODE_PAIEMENT=m.ID_MODE_PAIEMENT 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=p.COMMANDE_ID
      WHERE c.DELETED_STATUS_pos_IBI_COMMANDES=0 AND p.STATUT_ANNULATION=0
      AND c.DATE_PAIEMENT_COMMANDE BETWEEN '" . $start . "' AND '" . $end . "' "
    );

    $result = [];
    foreach ($res as $key) {
      $keyWord = $key['DESIGNATION_PAIEMENT_MODE'];
      if (!isset($result[$keyWord])) {
        $result[$keyWord] = array("TOTAL" => $key['MONTANT_PAIEMENT'], "MODE" => $keyWord);
      } else {
        $result[$keyWord]['TOTAL'] += $key['MONTANT_PAIEMENT'];
      }
    }

    $this->data['paiement'] = $result;
    $this->template->title('Rapports condenser');
    $this->render('backend/standart/administrator/rapport/rapport_condenser', $this->data);
  }





  public function rapport_caisse()
  {

    $date_depart = $this->input->get('date_depart');
    $date_fin = $this->input->get('date_fin');

     if (empty($date_depart) and empty($date_fin)) {
     $date_depart = date("Y-m-d 00:00:00");
     $date_fin = date("Y-m-d H:i:s");
    }


    $this->data['get_depenses'] = $this->model_r_proforma->depense_approvisionnement('pos_depenses', $date_depart, $date_fin);

    $this->template->title('Rapports caisse');
    $this->render('backend/standart/administrator/rapport/rapport_caisse', $this->data);
  }



  public function shift_rapports()
  {
    $dateStart = $this->input->get('date_start');
    $dateEnd = $this->input->get('date_end');

     if (empty($dateStart) and empty($dateEnd)) {
     $dateStart = date("Y-m-d 00:00:00");
     $dateEnd = date("Y-m-d H:i:s");
    }
    // $last_date = $this->db->get_where('cashier_shifts', array('SHIFT_STATUS' => 1),1,DESC)->row_array();
    $last_date = $this->db->query(" SELECT INSERTED_AT_SHIFT FROM cashier_shifts WHERE SHIFT_STATUS = 1 ORDER BY ID_SHIFT DESC ")->row_array();

    $ElemtWhere = "SHIFT_STATUS=1";
    $dateWhere = "SHIFT_STATUS =1 AND INSERTED_AT_SHIFT BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' ";

    $whereAll = "";
    if ($dateStart == "") {
      $whereAll = $dateWhere;
    } else {
      $whereAll = $dateWhere;
    }

    $count = $this->db->get_where('cashier_shifts', $whereAll)->num_rows();

    $shift = $this->db->get_where('cashier_shifts', $whereAll)->result();

    $config = [
      'base_url'     => 'administrator/rapports/shift_rapports/',
      'total_rows'   => $count,
      'per_page'     => 100,
      'uri_segment'  => 4,
    ];

    if ($dateEnd == "" or $dateStart == "") {
      $this->data['dateEnd'] = date('Y-m-d H:i:s');
      $this->data['dateStart'] = date('Y-m-d 00:00:00');
    } else {
      $this->data['dateEnd'] = $dateEnd;
      $this->data['dateStart'] = $dateStart;
    }

  //var_dump($this->data['dateEnd']);exit();

    $this->data['shift'] = $shift;
    $this->data['pagination'] = $this->pagination($config);
    $this->render('backend/standart/administrator/rapport/shift_closer', $this->data);
  }


  public function rapport_par_shift()
  {
    $dateStart = $this->input->get('date_start');
    $dateEnd = $this->input->get('date_end');

     if (empty($dateStart) and empty($dateEnd)) {
     $dateStart = date("Y-m-d 00:00:00");
     $dateEnd = date("Y-m-d H:i:s");
    }
    // $last_date = $this->db->get_where('cashier_shifts', array('SHIFT_STATUS' => 1),1,DESC)->row_array();
    $last_date = $this->db->query(" SELECT INSERTED_AT_SHIFT FROM cashier_shifts WHERE SHIFT_STATUS = 1 ORDER BY ID_SHIFT DESC ")->row_array();

    $ElemtWhere = "SHIFT_STATUS=1";
    $dateWhere = "SHIFT_STATUS =1 AND INSERTED_AT_SHIFT BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' ";

    $whereAll = "";
    if ($dateStart == "") {
      $whereAll = $dateWhere;
    } else {
      $whereAll = $dateWhere;
    }

    $count = $this->db->get_where('cashier_shifts', $whereAll)->num_rows();

    $shift = $this->db->get_where('cashier_shifts', $whereAll)->result();

    $config = [
      'base_url'     => 'administrator/rapports/rapport_par_shift/',
      'total_rows'   => $count,
      'per_page'     => 100,
      'uri_segment'  => 4,
    ];

    if ($dateEnd == "" or $dateStart == "") {
      $this->data['dateEnd'] = date('Y-m-d H:i:s');
      $this->data['dateStart'] = date('Y-m-d 00:00:00');
    } else {
      $this->data['dateEnd'] = $dateEnd;
      $this->data['dateStart'] = $dateStart;
    }

  //var_dump($this->data['dateEnd']);exit();

    $this->data['shift'] = $shift;
    $this->data['pagination'] = $this->pagination($config);
    $this->render('backend/standart/administrator/rapport/rapport_par_shift', $this->data);
  }


  public function get_list_shift($offset = null)
  {

    $dateStart = $this->input->get('date_start');
    $dateEnd = $this->input->get('date_end');
    if (empty($dateStart) and empty($dateEnd)) {
     $dateStart = date("Y-m-d 00:00:00");
     $dateEnd = date("Y-m-d H:i:s");
    }
    // $last_date = $this->db->get_where('cashier_shifts', array('SHIFT_STATUS' => 1),1,DESC)->row_array();
    $last_date = $this->db->query(" SELECT INSERTED_AT_SHIFT FROM cashier_shifts WHERE SHIFT_STATUS = 1 ORDER BY ID_SHIFT DESC ")->row_array();

    $ElemtWhere = "SHIFT_STATUS=1";
    $dateWhere = "SHIFT_STATUS =1 AND INSERTED_AT_SHIFT BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' ";

    $whereAll = "";
    if ($dateStart == "") {
      $whereAll = $dateWhere;
    } else {
      $whereAll = $dateWhere;
    }

    $count = $this->db->get_where('cashier_shifts', $whereAll)->num_rows();

    $shift = $this->db->select('*')->from('cashier_shifts')->where($whereAll)->order_by('ID_SHIFT', 'DESC')->get()->result();

    $config = [
      'base_url'     => 'administrator/rapports/get_list_shift/',
      'total_rows'   => $count,
      'per_page'     => 100,
      'uri_segment'  => 4,
    ];

    if ($dateEnd == "" or $dateStart=="") {
      $this->data['dateEnd'] = date('Y-m-d H:i:s');
      $this->data['dateStart'] = date('Y-m-d 00:00:00');
    } else {
      $this->data['dateEnd'] = $dateEnd;
      $this->data['dateStart'] = $dateStart;
    }

     //var_dump($this->data['dateEnd']);exit();

    $this->data['shift'] = $shift;
    $this->data['pagination'] = $this->pagination($config);
    $this->render('backend/standart/administrator/rapport/get_list_shift', $this->data);
  }


  public function get_shift_close($offset = null)
  {

    $dateStart = $this->input->get('date_start');
    $dateEnd = $this->input->get('date_end');
    if (empty($dateStart) and empty($dateEnd)) {
     $dateStart = date("Y-m-d 00:00:00");
     $dateEnd = date("Y-m-d H:i:s");
    }
    // $last_date = $this->db->get_where('cashier_shifts', array('SHIFT_STATUS' => 1),1,DESC)->row_array();
    $last_date = $this->db->query(" SELECT INSERTED_AT_SHIFT FROM cashier_shifts WHERE SHIFT_STATUS = 1 ORDER BY ID_SHIFT DESC ")->row_array();

    $ElemtWhere = "SHIFT_STATUS=1";
    $dateWhere = "SHIFT_STATUS =1 AND INSERTED_AT_SHIFT BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "' ";

    $whereAll = "";
    if ($dateStart == "") {
      $whereAll = $dateWhere;
    } else {
      $whereAll = $dateWhere;
    }

    $count = $this->db->get_where('cashier_shifts', $whereAll)->num_rows();

    $shift = $this->db->select('*')->from('cashier_shifts')->where($whereAll)->order_by('ID_SHIFT', 'DESC')->get()->result();

    $config = [
      'base_url'     => 'administrator/rapports/get_shift_close/',
      'total_rows'   => $count,
      'per_page'     => 100,
      'uri_segment'  => 4,
    ];

    if ($dateEnd == "" or $dateStart=="") {
      $this->data['dateEnd'] = date('Y-m-d H:i:s');
      $this->data['dateStart'] = date('Y-m-d 00:00:00');
    } else {
      $this->data['dateEnd'] = $dateEnd;
      $this->data['dateStart'] = $dateStart;
    }

     //var_dump($this->data['dateEnd']);exit();

    $this->data['shift'] = $shift;
    $this->data['pagination'] = $this->pagination($config);
    $this->render('backend/standart/administrator/pos_ibi_articles/get_shift_close', $this->data);
  }
  public function recette_condense_shift()
  {



    $start = "";
    $end = "";
    // FACTURES PAYEES
    $this->data['payer_all'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(p.MONTANT_PAIEMENT) as TOTAL 
      FROM pos_paiements p 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=p.COMMANDE_ID 
      WHERE c.DELETED_STATUS_pos_IBI_COMMANDES=0 AND p.STATUT_ANNULATION=0 AND c.COMMANDE_STATUS=2
      AND c.ID_CASHIER_SHIFT=" . $this->uri->segment(4) . "

      "
    );

    $this->data['count_paie'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 2,
        "ID_CASHIER_SHIFT" => $this->uri->segment(4)
      ),
      $start,
      $end
    );




    //FACTURES IMPAYEES
    $this->data['impayer'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(pr.QUANTITE*pr.PRIX_VENDU) AS TOTAL 
      FROM pos_ibi_commandes_produits pr 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=pr.pos_IBI_COMMANDES_ID 
      WHERE c.COMMANDE_STATUS=10 AND c.DELETED_STATUS_pos_IBI_COMMANDES=0 
      AND c.ID_CASHIER_SHIFT=" . $this->uri->segment(4) . " "
    );


    $this->data['count_impayer'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 10,
        "ID_CASHIER_SHIFT" => $this->uri->segment(4)
      ),
      $start,
      $end
    );


    //FACTURES COMPLEMENTARY
    $this->data['complementary'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(pr.QUANTITE*pr.PRIX) AS TOTAL 
      FROM pos_ibi_commandes_produits pr 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=pr.pos_IBI_COMMANDES_ID 
      WHERE c.COMMANDE_STATUS=11 AND c.DELETED_STATUS_pos_IBI_COMMANDES=0 
      AND c.ID_CASHIER_SHIFT=" . $this->uri->segment(4) . " "
    );


    $this->data['count_complementary'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 11,
        "ID_CASHIER_SHIFT" => $this->uri->segment(4)
      ),
      $start,
      $end
    );



    //FACTURES EN AVANCE
    $this->data['avance'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(p.MONTANT_PAIEMENT) as TOTAL 
      FROM pos_paiements p 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=p.COMMANDE_ID 
      WHERE c.DELETED_STATUS_pos_IBI_COMMANDES=0 AND p.STATUT_ANNULATION=0 AND  c.COMMANDE_STATUS=1 
      AND c.ID_CASHIER_SHIFT=" . $this->uri->segment(4) . " "
    );

    $this->data['count_avance'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 1,
        "ID_CASHIER_SHIFT" => $this->uri->segment(4)
      ),
      $start,
      $end
    );


    //RESTE SUR AVANCE
    $this->data['reste'] = (int) $this->model_rm->getRequeteOne(
      "
      SELECT SUM(pr.QUANTITE*pr.PRIX_VENDU) AS TOTAL 
      FROM pos_ibi_commandes_produits pr 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=pr.pos_IBI_COMMANDES_ID 
      WHERE c.COMMANDE_STATUS=1 AND c.DELETED_STATUS_pos_IBI_COMMANDES=0
      AND c.ID_CASHIER_SHIFT=" . $this->uri->segment(4) . " "
    )['TOTAL'] - (int)$this->data['avance']['TOTAL'];



    //FACTURES EN ATTENTE
    $this->data['attente'] = $this->model_rm->getRequeteOne(
      "
      SELECT SUM(pr.QUANTITE*pr.PRIX_VENDU) AS TOTAL 
      FROM pos_ibi_commandes_produits pr 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=pr.pos_IBI_COMMANDES_ID 
      WHERE c.COMMANDE_STATUS=0 AND c.DELETED_STATUS_pos_IBI_COMMANDES=0 
      AND c.ID_CASHIER_SHIFT=" . $this->uri->segment(4) . " "
    );


    $this->data['count_attente'] = $this->model_r_proforma->countrows_bs(
      "pos_ibi_commandes",
      array(
        "DELETED_STATUS_pos_IBI_COMMANDES" => 0,
        "COMMANDE_STATUS" => 0,
        "ID_CASHIER_SHIFT" => $this->uri->segment(4)
      ),
      $start,
      $end
    );





    //PAIEMENTS
    $res = $this->model_rm->getRequete(
      "SELECT * FROM pos_paiements p 
      JOIN mode_paiement m on p.MODE_PAIEMENT=m.ID_MODE_PAIEMENT 
      JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES=p.COMMANDE_ID
      WHERE c.DELETED_STATUS_pos_IBI_COMMANDES=0 AND p.STATUT_ANNULATION=0
      AND c.ID_CASHIER_SHIFT=" . $this->uri->segment(4) . " "
    );

    $result = [];
    foreach ($res as $key) {
      $keyWord = $key['DESIGNATION_PAIEMENT_MODE'];
      if (!isset($result[$keyWord])) {
        $result[$keyWord] = array("TOTAL" => $key['MONTANT_PAIEMENT'], "MODE" => $keyWord);
      } else {
        $result[$keyWord]['TOTAL'] += $key['MONTANT_PAIEMENT'];
      }
    }

    $this->data['paiement'] = $result;
    $this->render('backend/standart/administrator/rapport/get_shift_condenser', $this->data);
  }
}
