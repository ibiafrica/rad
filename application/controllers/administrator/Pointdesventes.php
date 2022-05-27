<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pointdesventes extends Admin
{

    public function __construct()
    {
        parent::__construct();
    }


    public function delete($store = "", $id = null, $zero = 1)
    {
        if ($zero == 0) {
            // $this->is_allowed('hospital_ibi_articles_delete');

            $this->load->helper('file');

            $arr_id = $this->input->get('id');
            $remove = false;
            $inputValue = $this->input->post('inputValue');
            $remove = $this->db->query('update pos_ibi_commandes set DELETED_STATUS_pos_IBI_COMMANDES=1,DELETED_COMMENT_pos_IBI_COMMANDES="oui",DELETED_USER_pos_IBI_COMMANDES=' . get_user_data('id') . ',DELETED_DATE_pos_IBI_COMMANDES="' . date('Y-m-d H:i:s') . '" where ID_pos_IBI_COMMANDES=' . $id . '');
            if ($remove) {
                $order = $this->db->select('*')->from('pos_ibi_commandes')
                    ->where('ID_pos_IBI_COMMANDES', $id)
                    ->get()->result()[0];

                $products = $this->db->select('*')->from('pos_ibi_commandes_produits')
                    ->where('pos_IBI_COMMANDES_ID', $id)
                    ->get()->result();
                if (sizeof($products) > 0) {
                    for ($rr = 0; $rr < sizeof($products); $rr++) {
                        $myitem = $products[$rr];
                        $table_article = "pos_store" . "_" . $myitem->STORE_ID_pos_IBI_COMMANDES_PRODUITS . "_ibi_articles";
                        $table_article_flow = "pos_store" . "_" . $myitem->STORE_ID_pos_IBI_COMMANDES_PRODUITS . "_ibi_articles_stock_flow";
                        $connected_user = get_user_data('idf');
                        $total_with_discount = $myitem->PRIX_TOTAL - (($myitem->DISCOUNT_PERCENT * $myitem->PRIX_TOTAL) / 100);
                        $this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE + ' . $myitem->QUANTITE, FALSE);
                        $this->db->where("CODEBAR_ARTICLE", $myitem->REF_PRODUCT_CODEBAR);
                        $is_update = $this->db->update($table_article);
                        $dataArticleFlow = array(
                            "REF_COMMAND_CODE_SF" => $order->CODE,
                            "QUANTITE_SF" => $myitem->QUANTITE,
                            "DATE_CREATION_SF" => date("Y-m-d H:i:s"),
                            "CREATED_BY_SF" => $connected_user,
                            "REF_ARTICLE_BARCODE_SF" => $myitem->REF_PRODUCT_CODEBAR,
                            "TYPE_SF" => "sale_stock_in",
                            "UNIT_PRICE_SF" =>  $myitem->PRIX,
                            "TOTAL_PRICE_SF" => $total_with_discount,
                            "REF_PROVIDER_SF" => 0
                        );
                        $this->db->insert($table_article_flow, $dataArticleFlow);
                    }
                    $this->db->query('update pos_ibi_commandes_produits set DELETED_STATUS_pos_IBI_COMMANDES_PRODUITS=1, DELETED_COMMENT_pos_IBI_COMMANDES_PRODUITS ="cfr command comment",DELETED_USER_pos_IBI_COMMANDES_PRODUITS=' . get_user_data('id') . ',DELETED_DATE_pos_IBI_COMMANDES_PRODUITS="' . date('Y-m-d H:i:s') . '" where pos_IBI_COMMANDES_ID=' . $id . '');
                }

                set_message(cclang('has_been_deleted', 'articles'), 'success');
            }

            redirect(base_url('administrator/pos_ibi_commandes/void_to_request'));
        } else {
            set_message(cclang('error_delete', 'articles'), 'error');
            redirect(base_url('administrator/pos_ibi_commandes/void_to_request'));
        }
    }

    public function index($offset = 0)
    {

        $offset = $this->uri->segment(4);
        $filter = $this->input->get('q');
        $field  = $this->input->get('f');
        $is_shift_open = false;
        $shift = $this->db->select("*")->from("cashier_shifts")->where("SHIFT_STATUS", 0)->get()->result();
        if (sizeof($shift) > 0) {
            $is_shift_open = TRUE;
        }
        $good_clients = $this->db->select("NOM_CLIENT,PRENOM, ID_CLIENT, CLIENT_FILE_ID, CLIENT_FILE_CODE")
            ->from("pos_clients")->join("client_file", "client_file.CLIENT_ID = ID_CLIENT")
            ->where("NOM_CLIENT LIKE '%$filter%'")

            ->where("DELETE_STATUS_CLIENT = 0")->order_by("ID_CLIENT", "asc")->get()->result();
        $this->data['clients_all'] = $good_clients;
        $this->data['clients_counts'] = sizeof($good_clients);
        $this->data['is_shifts_open'] = $is_shift_open;

        $config = [
            'base_url'     => 'administrator/pointdesventes/index/',
            'total_rows'   => "120",
            'per_page'     => 100,
            'uri_segment'  => 4,
        ];


        $this->data['pagination'] = $this->pagination($config);
        // $this->data['pagination'] = $this->pagination($config6);
        $this->template->title('Liste des Clients');


        $this->render('backend/standart/administrator/stores/liste_clients', $this->data);
    }

    public function ventes($client_id = 0, $cmd_id = 0, $type = 0)
    {
        if ($client_id == 0) {
            $cmd = $this->db->select("ID_pos_IBI_COMMANDES,CLIENT_ID_COMMANDE, CODE, TVA, DATE_CREATION_pos_IBI_COMMANDES")
                ->from("pos_ibi_commandes")
                ->where("ID_pos_IBI_COMMANDES", $cmd_id)
                ->get()->result()[0];

            $prods = $this->db->select("*")
                ->from("pos_ibi_commandes_produits")
                ->where("pos_IBI_COMMANDES_ID", $cmd->ID_pos_IBI_COMMANDES)
                ->get()->result();

            $good_client = $this->db->select("NOM_CLIENT, PRENOM, ID_CLIENT, CLIENT_FILE_ID, CLIENT_FILE_CODE,DISCOUNT_BOISSON,DISCOUNT_FOOD")
                ->from("pos_clients")->join("client_file", "client_file.CLIENT_ID = ID_CLIENT")
                ->where("DELETE_STATUS_CLIENT = 0 and ID_CLIENT = $cmd->CLIENT_ID_COMMANDE")->get()->result();

            $this->data["client_data"] = json_encode($good_client[0]);
            $this->data["client_id"] = $client_id;
            $this->data['commandInfo'] = json_encode($cmd);
            $this->data['type'] = json_encode($type);
            $this->data['prods'] = json_encode($prods);

            $this->load->view("backend/standart/administrator/stores/welcome", $this->data);
        } else {
            $good_client = $this->db->select("NOM_CLIENT, PRENOM, ID_CLIENT, CLIENT_FILE_ID, CLIENT_FILE_CODE,DISCOUNT_BOISSON,DISCOUNT_FOOD")
                ->from("pos_clients")->join("client_file", "client_file.CLIENT_ID = ID_CLIENT")
                ->where("DELETE_STATUS_CLIENT = 0 and ID_CLIENT = $client_id")->get()->result();
            $this->data["client_data"] = json_encode($good_client[0]);
            $this->data["client_id"] = $client_id;
            $this->data['commandInfo'] = json_encode("");
            $this->data['type'] = json_encode(6);
            $this->data['prods'] = json_encode([]);
            $this->load->view("backend/standart/administrator/stores/welcome", $this->data);
        }
    }

    public function update_commande($cmd_id, $type)
    {
        $this->ventes(0, $cmd_id, $type);
    }

    public function retrait_command()
    {
        $order = $this->input->post('order');
        $table_command_prod_name = "pos_ibi_commandes_produits";
        $table_command_name = "pos_ibi_commandes";
        $cmd_inserted = false;
        $inserted_commande = 0;
        $req = '';
        $connected_user = CI_Controller::get_instance()->session->userdata('id');
        $i = 0;
        $shift = $this->db->select("ID_SHIFT")->from("cashier_shifts")->where("SHIFT_STATUS", 0)->get()->result()[0];

        for ($i = 0; $i < count($order['oldItems']); $i++) {
            $myitem1 = $order['oldItems'][$i];
            $total_brut = 0;
            $discount = $myitem1['discount'];
            if ($myitem1['removedQuantity'] > 0) {

                $total_brut = floatval($myitem1['removedQuantity'] * $myitem1['PRIX_DE_VENTE_ARTICLE']);
                $discount = $myitem1['discount'];
                $total_with_discount = floatval($total_brut - ($total_brut * ($discount / 100)));
                $prix = floatval($myitem1['removedQuantity'] * floatval($myitem1['PRIX_DE_VENTE_ARTICLE']));
                $this->db->set('QUANTITE', 'QUANTITE -' . $myitem1['removedQuantity'], FALSE);
                $this->db->set('PRIX_TOTAL', 'PRIX_TOTAL -' . $prix, FALSE);
                $this->db->set('DATE_MOD_pos_IBI_COMMANDES_PRODUITS', date("Y-m-d H:i:s"));
                $this->db->where('STORE_ID_pos_IBI_COMMANDES_PRODUITS', $myitem1['STORE_ID_ARTICLE']);
                $this->db->where("ID_pos_IBI_COMMANDES_PRODUITS", $myitem1['commandProduitId']);
                $this->db->update($table_command_prod_name);

                if (!$cmd_inserted) {
                    $order['ID_CLIENT'] = 1;
                    $order['ID_CLIENT_FILE'] = 1;
                    $order['ID_SHIFT'] = $shift->ID_SHIFT;
                    $inserted_commande = $this->save_commande($table_command_name, $order, TRUE);
                    $cmd_inserted = true;
                }
                $dataToSave = array(
                    "REF_COMMAND_CODE" => $inserted_commande[1],
                    "REF_PRODUCT_CODEBAR" => $myitem1['CODEBAR_ARTICLE'],
                    "QUANTITE" => $myitem1['removedQuantity'],
                    "PRIX" => $myitem1['PRIX_DE_VENTE_ARTICLE'],
                    "PRIX_TOTAL" => $total_brut,
                    "pos_IBI_COMMANDES_ID" => $inserted_commande[0],
                    "DATE_CREATION_pos_IBI_COMMANDES_PRODUITS" => $order['dateCreation'],
                    "DATE_COMMANDE_PRODUITS " => $order['dateCreation'],
                    "NAME" => $myitem1['DESIGN_ARTICLE'],
                    "STORE_ID_pos_IBI_COMMANDES_PRODUITS" => $myitem1['STORE_ID_ARTICLE'],
                    "DISCOUNT_PERCENT" => $myitem1['discount'],
                    "CLIENT_FILE_ID_COMMANDES_PRODUITS" => $order['ID_CLIENT_FILE'],
                    "CREATED_BY_pos_IBI_COMMANDES_PRODUITS" => $connected_user
                );
                $this->db->insert($table_command_prod_name, $dataToSave);
                $req = $this->db->last_query();
            }
            // $this->db->set('QUANTITE_VENDU', 'QUANTITE_VENDU -' . $myitem['quantity'], FALSE);
            // }

            // for ($i1 = 0; $i1 < count($order['fromDelete']); $i1++) {
            //     $to_remove = $order['fromDelete'][$i1];
            //     $this->db->where(array(
            //         'STORE_ID_HOSPITAL_IBI_COMMANDES_PRODUITS' => $order['store'],
            //         "HOSPITAL_IBI_COMMANDES_ID" => $order['commandId'],
            //         "REF_PRODUCT_CODEBAR" => $to_remove['CODEBAR_ARTICLE']
            //     ));
            //     $this->db->delete($table_command_prod_name);
            //     // print_r($this->db->last_query());
        }
        echo json_encode(array(
            'id' => "here good!",
            "success" => 'true',
            "debug" => false,
        ));

        exit;
    }

    public function load_articles($store_prefix, $store_id)
    {
        return $this->get_all_articles($store_prefix, 0, 12);
    }

    public function get_all_articles($store_prefix, $store_id = 0, $chunk = 1)
    {
        $stores = $this->db->select("ID_STORE")->from("pos_ibi_stores")
            ->where("STATUS_STORE", "opened")
            ->where("IS_POS", 1)->get()->result();
        $art = [];
        $tab_cat = "pos_ibi_articles_categories";
        $cat[0] =
            $this->db->select("NOM_CATEGORIE, ID_CATEGORIE, STORE_ID")
            ->from($tab_cat)->where('DELETE_STATUS_CATEGORIE', 0)->get()->result();

        for ($d = 0; $d < sizeof($stores); $d++) {
            $table_name = $store_prefix . "_" . $stores[$d]->ID_STORE . "_ibi_articles";

            $articles = $this->get_all_aticles_from_store($table_name);

            if (!empty($articles)) {
                $size = count($articles);
                if ($chunk != 0) {
                    array_push($art, $articles);
                } else {
                    if (isset(array_chunk($articles, 100)[$chunk])) {
                        array_push($art, array_chunk($articles, 100)[$chunk]);
                    }
                }
            } else {
                array_push($art, []);
            }
        }



        for ($s = 0; $s < sizeof($stores); $s++) {
            $current = $stores[$s];
            $current->categories["list"] = [];

            for ($c = 0; $c < sizeof($cat[0]); $c++) {
                if (intval($cat[0][$c]->STORE_ID) == intval($current->ID_STORE)) {
                    array_push($current->categories["list"], $cat[0][$c]);
                    for ($a = 0; $a < sizeof($art); $a++) {
                        // for ($a1 = 0; $a1 < sizeof($art[$a]); $a1++) {
                        //     if (intval($art[$a][$a1]->REF_CATEGORIE_ARTICLE) == intval($cat[0][$c]->ID_CATEGORIE)) {
                        //         // array_push($current->categories["list"][$c]["articles"], $art[$a][$a1]);
                        //     }
                        // }
                    }
                }
            }
        }

        echo json_encode(array(
            "articles" => $art,
            "stores" => $stores,
            "success" => true,
            "size" => $size
        ));
        exit;
    }
    public function get_all_aticles_from_store($table_name)
    {
        $article_count = $this->db->count_all_results($table_name);
        $articles_from_db = [];

        if (sizeof($articles_from_db) < $article_count) {
            $sel = $this->db->query("SELECT ID_ARTICLE,DESIGN_ARTICLE, NATURE_ARTICLE,STORE_ID_ARTICLE,CODEBAR_ARTICLE, REF_CATEGORIE_ARTICLE, 
            PRIX_DE_VENTE_ARTICLE, NATURE_ARTICLE, ETAT_TVA, IF(NATURE_ARTICLE = 1 OR NATURE_ARTICLE = 2,100, QUANTITY_ARTICLE) QUANTITY_ARTICLE FROM $table_name
            WHERE IS_INGREDIENT = 0 and REF_CATEGORIE_ARTICLE != '' and DELETE_STATUS_ARTICLE = 0")->result();
            $articles_from_db = $sel;
            return $articles_from_db;
        } else {
            $articles_from_db;
        }
    }


    public function get_all_stores()
    {
        $stores = $this->db->select('NAME_STORE, ID_STORE')->from("pos_ibi_stores")->where("STATUS_STORE", "opened")
            ->where("IS_POS", 1)
            ->where("DELETE_STATUS_STORE", 0)->get()->result();
        echo json_encode($stores);
        exit;
    }
    public function get_all_commande()
    {

        $users = $this->db->get('pos_ibi_ingredients')->result();
        $user_arr = [];

        foreach ($users as $user) {
            unset($user->pass);
            $user_arr[] = $user;
        }

        $data['user'] = $user_arr;

        echo json_encode([
            'status'     => true,
            'message'     => 'donnees ingredients',
            'data'         => $data
        ]);
    }
    public function adjustArticleQty($table_article, $myitem, $target, $operation)
    {
        // TODO: can check before reduce the qty if the qty is enough

        if ($operation == "moins") {
            $this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE - ' . $myitem[$target], FALSE);
            $this->db->where("CODEBAR_ARTICLE", $myitem['REF_PRODUCT_CODEBAR']);
            $is_update = $this->db->update($table_article);
            return $is_update;
        } else {
            $this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE + ' . $myitem[$target], FALSE);
            $this->db->where("CODEBAR_ARTICLE", $myitem['REF_PRODUCT_CODEBAR']);
            $is_update = $this->db->update($table_article);
            return $is_update;
        }
    }


    public function adjustStockFlow($table_article, $myitem, $order, $connected_user, $table_article_flow, $operation)
    {

        $op_name = "";
        $qty = 0;
        if ($operation == "delete_in") {
            $op_name = "sale_stock_in";
            $qty =  $myitem['QUANTITE'];
            $this->adjustArticleQty($table_article, $myitem, 'QUANTITE', 'plus', true);
        } else if ($operation == "in") {
            $op_name = "sale_stock_in";
            $qty =  $myitem['removedQuantity'];
            $this->adjustArticleQty($table_article, $myitem, 'removedQuantity', 'plus');
        } else {
            if (!isset($myitem['addedQuantity']) or $myitem['addedQuantity'] == 0) {
                $qty = $myitem['quantity'];
                $this->adjustArticleQty($table_article, $myitem, 'quantity', 'moins');
            } else {
                $qty =  $myitem['addedQuantity'];
                $this->adjustArticleQty($table_article, $myitem, 'addedQuantity', 'moins');
            }
            $op_name = "sale";
        }
    }
    public function save_order($prex = "", $cmd_id = 0, $type = 1)
    {

        $order = $this->input->post('order');

        $table_command_name = "pos_ibi_commandes";
        $table_command_prod_name = "pos_ibi_commandes_produits";
        $connected_user = CI_Controller::get_instance()->session->userdata('id');

        $shift = $this->db->select("ID_SHIFT")->from("cashier_shifts")->where("SHIFT_STATUS", 0)->get()->result()[0];

        $next_patient_file = null;
        $type_de_payment = 0;
        $ref_group = 1;
        $inserted_commande = [];
        $cmd = "";
        $prods = [];
        $cmd_prods = [];
        if ($cmd_id != 0 and $type == 1) {
            $prods = $this->db->select("REF_PRODUCT_CODEBAR,REF_COMMAND_CODE")
                ->from("pos_ibi_commandes_produits")->where("pos_IBI_COMMANDES_ID", $cmd_id)
                ->get()->result();
            $cmd = $prods[0]->REF_COMMAND_CODE;
        } else {
        }

        for ($f = 0; $f < sizeof($prods); $f++) {
            array_push($cmd_prods, $prods[$f]->REF_PRODUCT_CODEBAR);
        }


        for ($i = 0; $i < count($order['items']); $i++) {
            $myitem = $order['items'][$i];

            $total_brut = floatval($myitem['quantity'] * $myitem['PRIX_DE_VENTE_ARTICLE']);

            $discount = $myitem['NATURE_ARTICLE'] == '1' ? $order['DISCOUNT_FOOD'] : $order['DISCOUNT_BOISSON'];
            $total_with_discount = floatval($total_brut - ($total_brut * ($discount / 100)));

            // GESTION DES QUANTITES

            $table_article = "pos_store_" . $myitem['STORE_ID_ARTICLE'] . "_ibi_articles";
            $this->db->set('QUANTITY_ARTICLE', 'QUANTITY_ARTICLE - ' . $myitem['quantity'], FALSE);
            $this->db->where('ID_ARTICLE', $myitem['ID_ARTICLE']);
            $this->db->update($table_article);

            // GESTION MODIFIER COMMANDE

            if ($cmd_id != 0) {
                if ($type == 1) {
                    if (in_array($myitem['CODEBAR_ARTICLE'], $cmd_prods)) {
                        $this->db->set('QUANTITE', 'QUANTITE + ' . $myitem['quantity'], FALSE);
                        $this->db->set('PRIX_TOTAL', 'PRIX_TOTAL + ' . ($myitem['quantity'] * $myitem['PRIX_DE_VENTE_ARTICLE']), false);
                        $this->db->where('pos_IBI_COMMANDES_ID', $cmd_id);
                        $this->db->where('REF_PRODUCT_CODEBAR', $myitem['CODEBAR_ARTICLE']);
                        $updated = $this->db->update($table_command_prod_name);
                        if ($updated) {
                            $table_article_flow = "pos_store_" . $myitem['STORE_ID_ARTICLE'] . "_ibi_articles_stock_flow";
                            $dataArticleFlow = array(
                                "REF_COMMAND_CODE_SF" => $cmd,
                                "QUANTITE_SF" => $myitem['quantity'],
                                "DATE_CREATION_SF" => date("Y-m-d H:i:s"),
                                "CREATED_BY_SF" => $connected_user,
                                "SHIFT_ID_S" => $shift->ID_SHIFT,
                                "REF_ARTICLE_BARCODE_SF" => $myitem['CODEBAR_ARTICLE'],
                                "UNIT_PRICE_SF" => $myitem['PRIX_DE_VENTE_ARTICLE'],
                                "TYPE_SF" => "sale",
                                "TOTAL_PRICE_SF" => $total_with_discount,
                                "REF_PROVIDER_SF" => 0
                            );
                            $this->db->insert($table_article_flow, $dataArticleFlow);
                        }
                    } else {
                        $dataToSave = array(
                            "REF_COMMAND_CODE" => $cmd,
                            "REF_PRODUCT_CODEBAR" => $myitem['CODEBAR_ARTICLE'],
                            "QUANTITE" => $myitem['quantity'],
                            "PRIX" => $myitem['PRIX_DE_VENTE_ARTICLE'],
                            "PRIX_TOTAL" => $total_brut,
                            "pos_IBI_COMMANDES_ID" => $cmd_id,
                            "DATE_CREATION_pos_IBI_COMMANDES_PRODUITS" => date("Y-m-d H:i:s"),
                            "DATE_COMMANDE_PRODUITS " => date("Y-m-d H:i:s"),
                            "NAME" => $myitem['DESIGN_ARTICLE'],
                            "STORE_ID_pos_IBI_COMMANDES_PRODUITS" => $myitem['STORE_ID_ARTICLE'],
                            "DISCOUNT_PERCENT" => $myitem['discount'],
                            "CLIENT_FILE_ID_COMMANDES_PRODUITS" => $order['CLIENT_FILE_ID'],
                            "CREATED_BY_pos_IBI_COMMANDES_PRODUITS" => $connected_user
                        );

                        $insert = $this->db->insert($table_command_prod_name, $dataToSave);
                        if ($insert) {
                            $table_article_flow = "pos_store_" . $myitem['STORE_ID_ARTICLE'] . "_ibi_articles_stock_flow";
                            $dataArticleFlow = array(
                                "REF_COMMAND_CODE_SF" => $cmd,
                                "QUANTITE_SF" => $myitem['quantity'],
                                "DATE_CREATION_SF" => date("Y-m-d H:i:s"),
                                "SHIFT_ID_S" => $shift->ID_SHIFT,
                                "CREATED_BY_SF" => $connected_user,
                                "REF_ARTICLE_BARCODE_SF" => $myitem['CODEBAR_ARTICLE'],
                                "UNIT_PRICE_SF" => $myitem['PRIX_DE_VENTE_ARTICLE'],
                                "TYPE_SF" => "sale",
                                "TOTAL_PRICE_SF" => $total_with_discount,
                                "REF_PROVIDER_SF" => 0
                            );
                            $this->db->insert($table_article_flow, $dataArticleFlow);
                        }
                    }
                } else {
                }
            } else {
                if (sizeof($inserted_commande) == 0) {
                    $order['ID_SHIFT'] = $shift->ID_SHIFT;
                    $inserted_commande = $this->save_commande($table_command_name, $order);
                }

                $dataToSave = array(
                    "REF_COMMAND_CODE" => $inserted_commande[1],
                    "REF_PRODUCT_CODEBAR" => $myitem['CODEBAR_ARTICLE'],
                    "QUANTITE" => $myitem['quantity'],
                    "PRIX" => $myitem['PRIX_DE_VENTE_ARTICLE'],
                    "PRIX_TOTAL" => $total_brut,
                    "pos_IBI_COMMANDES_ID" => $inserted_commande[0],
                    "DATE_CREATION_pos_IBI_COMMANDES_PRODUITS" => date("Y-m-d H:i:s"),
                    "DATE_COMMANDE_PRODUITS " => date("Y-m-d H:i:s"),
                    "NAME" => $myitem['DESIGN_ARTICLE'],
                    "STORE_ID_pos_IBI_COMMANDES_PRODUITS" => $myitem['STORE_ID_ARTICLE'],
                    "DISCOUNT_PERCENT" => $myitem['discount'],
                    "CLIENT_FILE_ID_COMMANDES_PRODUITS" => $order['CLIENT_FILE_ID'],
                    "CREATED_BY_pos_IBI_COMMANDES_PRODUITS" => $connected_user
                );
                // insertion stockflow
                $insert = $this->db->insert($table_command_prod_name, $dataToSave);
                if ($insert) {
                    $table_article_flow = "pos_store_" . $myitem['STORE_ID_ARTICLE'] . "_ibi_articles_stock_flow";
                    $dataArticleFlow = array(
                        "REF_COMMAND_CODE_SF" => $inserted_commande[1],
                        "QUANTITE_SF" => $myitem['quantity'],
                        "DATE_CREATION_SF" => date("Y-m-d H:i:s"),
                        "SHIFT_ID_S" => $shift->ID_SHIFT,
                        "CREATED_BY_SF" => $connected_user,
                        "REF_ARTICLE_BARCODE_SF" => $myitem['CODEBAR_ARTICLE'],
                        "UNIT_PRICE_SF" => $myitem['PRIX_DE_VENTE_ARTICLE'],
                        "TOTAL_PRICE_SF" => $total_with_discount,
                        "TYPE_SF" => "sale",
                        "REF_PROVIDER_SF" => 0
                    );
                    $this->db->insert($table_article_flow, $dataArticleFlow);
                }
            }
        }



        echo json_encode(array(
            "status" => "ok"
        ));
        exit;
    }


    public function save_commande($table_name, $order, $split = FALSE)
    {
        $connected_user = CI_Controller::get_instance()->session->userdata('id');
        $p_file_id = empty($order['CLIENT_FILE_ID']) ? $order['CLIENT_FILE_ID'] : $order['CLIENT_FILE_ID'];
        $this->db->select("*");
        $this->db->from('aauth_users');
        $this->db->where("id", $connected_user);
        $res = $this->db->get()->result();

        // $table_name = "pos_store_2_ibi_commandes";
        $year = date("Y");
        $last = $this->db->select("*")
            ->from($table_name)
            ->where('YEAR(DATE_CREATION_pos_IBI_COMMANDES)', $year)
            ->order_by('ID_pos_IBI_COMMANDES', 'DESC')
            ->limit(1)
            ->get()->result();
        $code_next = 1;
        $zeros = "0000";

        if (sizeof($last) > 0) {

            $iter = strlen($last[0]->ID_pos_IBI_COMMANDES);

            $code_next = $last[0]->ID_pos_IBI_COMMANDES + 1;
            $zeros = "";
            while ($iter < 5) {
                $zeros = $zeros . "0";
                $iter++;
            }
        }
        $code = $zeros . $code_next . '/' . date('m/y');

        $data = array(
            "CODE" => 'MC' . $code,
            "CLIENT_ID_COMMANDE" => $order['ID_CLIENT'],
            "ID_CASHIER_SHIFT" => $order['ID_SHIFT'],
            "CLIENT_FILE_ID_pos_IBI_COMMANDES" => $p_file_id,
            "STORE_ID_COMMADES" => 0,
            "TABLE_ID" => $order['tableid'],
            "CREATED_BY_pos_IBI_COMMANDES" => $connected_user,
            "DATE_CREATION_pos_IBI_COMMANDES" => date("Y-m-d H:i:s"),
            "DATE_MOD_pos_IBI_COMMANDES" => date("Y-m-d H:i:s"),
            "TO_WHOM" => $split ? 0 : 1
        );

        $this->db->insert($table_name, $data);
        $last_id = $this->db->insert_id();


        return [$last_id, 'MC' . $code];
    }
}
