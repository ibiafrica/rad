<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Offline extends Admin
{

    public function __construct()
    {
        parent::__construct();
    }


      public function post_commandes_from_local()
    {
        $commandes = json_decode($this->input->post("commandes"));
        $produits = json_decode($this->input->post("produits"));
        $paiements = json_decode($this->input->post("payments"));
        $shifts = json_decode($this->input->post("shifts"));
        $array_shift = $this->input->post("shiftsList");
        $flux_caisses = json_decode($this->input->post("flux"));

        $commandes_code_list = $this->input->post("codeList");

        //Delete all if present
        $this->db->query("DELETE FROM pos_ibi_commandes where CODE IN $commandes_code_list");
        $this->db->query("DELETE FROM pos_ibi_commandes_produits where REF_COMMAND_CODE IN $commandes_code_list");
        $this->db->query("DELETE FROM pos_paiements where COMMANDE_CODE IN $commandes_code_list");
        $this->db->query("DELETE FROM pos_session where ID_SESSION IN $array_shift");
        $this->db->query("DELETE FROM pos_flux_caisse where 1");

        // clean the stockflow too
        $stores = $this->db->query("SELECT * from pos_ibi_stores where IS_POS = 1 AND DELETE_STATUS_STORE = 0 and STATUS_STORE = 'opened'")->result();

        for ($i = 0; $i < sizeof($stores); $i++) {
            $current_store = $stores[$i];
            $table_store_flow = "pos_store_" . $current_store->ID_STORE . "_ibi_articles_stock_flow";
            $table_article = "pos_store_" . $current_store->ID_STORE . "_ibi_articles";
            $articles = $this->db->query("SELECT REF_ARTICLE_BARCODE_SF, QUANTITE_SF FROM $table_store_flow WHERE REF_COMMAND_CODE_SF IN $commandes_code_list")->result();
            for ($r = 0; $r < sizeof($articles); $r++) {
                $curr_article = $articles[$r];
                $qt = $curr_article->QUANTITE_SF;
                $cd = $curr_article->REF_ARTICLE_BARCODE_SF;
                $this->db->query("UPDATE $table_article set QUANTITY_ARTICLE = (QUANTITY_ARTICLE +$qt) WHERE CODEBAR_ARTICLE = '$cd'");
            }
            $this->db->query("DELETE FROM $table_store_flow where REF_COMMAND_CODE_SF IN $commandes_code_list");
        }
        $commandes_inserted = 0;
        $produits_inserted = 0;
        $paiements_inserted = 0;
        $flux_inserted = 0;
        $shifts_inserted = 0;

        if (sizeof($commandes) > 0) {
            $commandes_inserted = $this->db->insert_batch("pos_ibi_commandes", $commandes);
        }
        if (sizeof($produits) > 0) {
            $produits_inserted = $this->db->insert_batch("pos_ibi_commandes_produits", $produits);
        }
        if (sizeof($paiements) > 0) {
            $paiements_inserted = $this->db->insert_batch('pos_paiements', $paiements);
        }
        if (sizeof($shifts) > 0) {
            $shifts_inserted = $this->db->insert_batch("pos_session", $shifts);
        }
        if (count($flux_caisses) > 0) {
            $flux = $this->db->insert_batch("pos_flux_caisse", $flux_caisses);
        }

        if ($produits_inserted > 0) {
            for ($p = 0; $p < sizeof($produits); $p++) {
                $curr_prod = $produits[$p];
                $qty = $curr_prod->quantite;
                $bar = $curr_prod->ref_product_codebar;
                $code = $curr_prod->ref_command_code;
                $table_article = "pos_store_" . $curr_prod->store_id_pos_ibi_commandes_produits . "_ibi_articles";
                $table_flow = "pos_store_" . $curr_prod->store_id_pos_ibi_commandes_produits . "_ibi_articles_stock_flow";
                $this->db->query("UPDATE $table_article SET QUANTITY_ARTICLE = (QUANTITY_ARTICLE - $qty) WHERE CODEBAR_ARTICLE = '$bar'");
                $cmd = $this->db->query("SELECT * FROM pos_ibi_commandes WHERE CODE = '$code'")->result()[0];
                $dataArticleFlow = array(
                    "REF_COMMAND_CODE_SF" => $curr_prod->ref_command_code,
                    "QUANTITE_SF" => $curr_prod->quantite,
                    "DATE_CREATION_SF" => $curr_prod->date_creation_pos_ibi_commandes_produits,
                    "CREATED_BY_SF" => $curr_prod->created_by_pos_ibi_commandes_produits,
                    "SHIFT_ID_S" => 0,
                    "REF_ARTICLE_BARCODE_SF" => $curr_prod->ref_product_codebar,
                    "UNIT_PRICE_SF" => $curr_prod->prix_vendu,
                    "TYPE_SF" => "sale",
                    "TOTAL_PRICE_SF" => $curr_prod->prix_vendu * $curr_prod->quantite,
                    "REF_PROVIDER_SF" => 0
                );
                $this->db->insert($table_flow, $dataArticleFlow);
            }
        }
        echo json_encode(array("commandes" => $commandes_inserted, "produits" => $produits_inserted, "paiements" => $paiements_inserted, "flux" => $flux_inserted, "shifts" => $shifts_inserted));
        exit;
    }

    public function get_users()
    {
        $users = $this->db->query("SELECT full_name, pin_code, id, g.group_id as group_id FROM aauth_users  JOIN  aauth_user_to_group g ON aauth_users.id = g.user_id WHERE banned = 0 GROUP BY id")->result();
        $user_reqts = "INSERT INTO users(user_id,full_name,pin_code, group_id) VALUES ";
        for ($i = 0; $i < sizeof($users); $i++) {
            $current_user = $users[$i];
            if ($i == sizeof($users) - 1) {
                $user_reqts .= "('$current_user->id', '$current_user->full_name', '$current_user->pin_code','$current_user->group_id')";
            } else {
                $user_reqts .= "('$current_user->id', '$current_user->full_name', '$current_user->pin_code', '$current_user->group_id'),";
            }
        }
        echo $user_reqts;
        exit;
    }

    private function construct_insert($table_name, $fields, $db_data)
    {
        $array_chunk_data = array_chunk($db_data, 50);
        $requetes = "";
        $ii = 1;
        for ($t = 0; $t < sizeof($array_chunk_data); $t++) {
            $mydata = $array_chunk_data[$t];
            $x = 0;
            $v = 0;

            $val_to_insert = "(";
            $values = "(";
            $columns = "(";
            while ($x < sizeof($fields)) {
                if ($x == (sizeof($fields) - 1)) {
                    $columns .= strtolower($fields[$x]) . ")";
                } else {
                    $columns .= strtolower($fields[$x]) . ",";
                }
                $x++;
            }
            while ($v < sizeof($mydata)) {
                $f = 0;
                if (true) {
                    while ($f  < sizeof($fields)) {
                        $field = strtoupper($fields[$f]);
                        // echo $field;

                        $val = $mydata[$v]->$field;

                        if (($val != 0 && $val != "0" && (intval($val) != 0))) {
                            if ($field == 'ARTICLE_ID') {
                                $val = $ii++;
                            }
                            if (in_array($field, [
                                'CODEBAR_ARTICLE', "DESIGN_ARTICLE", "NAME",
                                'DATE_CREATION_PAIEMENT', "DATE_CREATION_PAIEMENT", "REF_PRODUCT_CODEBAR", "REF_COMMAND_CODE",
                                "DATE_CREATION_COMMANDE", "CODE", "SHIFT_START", "CODE_FACTURE", "DATE_CREATION_POS_IBI_COMMANDES", "SHIFT_END", "INSERTED_AT_SHIFT", "UPDATED_AT_SHIFT",
                                "DATE_CREATION_Pos_IBI_COMMANDES", "DATE_PAIEMENT_COMMANDE",
                                strtoupper("date_creation_pos_ibi_commandes_produits")
                            ])) {
                                if (preg_match("/'/i", $val)) {
                                    $val = str_replace("'", "", $val);
                                }
                                $val = "'$val'";
                            }
                            if ($f == (sizeof($fields) - 1)) {
                                $values .=  $val . "),(";
                            } else {
                                $values .=  $val . ",";
                            }
                        } else {
                            // val is string 
                            if (in_array($field, [
                                'CODEBAR_ARTICLE', "DESIGN_ARTICLE", "NAME",
                                'DATE_CREATION_PAIEMENT', "DATE_CREATION_PAIEMENT", "CODE_FACTURE", "REF_PRODUCT_CODEBAR", "REF_COMMAND_CODE",
                                "DATE_CREATION_COMMANDE", "CODE", "DATE_CREATION_POS_IBI_COMMANDES", "DATE_CREATION_Pos_IBI_COMMANDES", "SHIFT_START", "SHIFT_END", "INSERTED_AT_SHIFT", "UPDATED_AT_SHIFT",
                                "DATE_PAIEMENT_COMMANDE",
                                strtoupper("date_creation_pos_ibi_commandes_produits")
                            ]) || is_string($val)) {
                                if (preg_match("/'/i", $val)) {
                                    $val = str_replace("'", "", $val);
                                }
                                $val = "'$val'";
                            }
                            // if (is_string($val)) {
                            //     $val = "'$val'";
                            // }
                            if ($f == (sizeof($fields) - 1)) {
                                $values .= $val . "),(";
                            } else {
                                $values .= $val . ",";
                            }
                        }
                        $f++;
                    }
                }
                $v++;
            }

            $values = substr_replace(trim($values), "", -2);
            $statement = "INSERT INTO $table_name$columns VALUES $values ;";
            $requetes .= $statement;
        }
        return $requetes;
    }

    private function all_pos_stores()
    {
        $stores = $this->db->query("SELECT * from pos_ibi_stores where IS_POS = 1 AND DELETE_STATUS_STORE = 0 and STATUS_STORE = 'opened'")->result();
        return $stores;
    }

    public function get_stores()
    {
        $stores = $this->all_pos_stores();
        $stores_q = $this->construct_insert("stores", ["ID_STORE", "NAME_STORE"], $stores);
        echo $stores_q;
        exit;
    }

    public function get_categories()
    {
        $categories = $this->db->query("SELECT ID_CATEGORIE,STORE_ID,NOM_CATEGORIE FROM categories WHERE DELETE_STATUS_CATEGORIE = 0")->result();
        $insert = $this->construct_insert("categories", ["ID_CATEGORIE", "STORE_ID", "NOM_CATEGORIE"], $categories);
        echo $insert;
        exit;
    }


    public function get_articles()
    {
        $stores = $this->all_pos_stores();
        $articles = [];
        for ($i = 0; $i < sizeof($stores); $i++) {
            $current_store = $stores[$i];
            $table = "pos_store_" . $current_store->ID_STORE . "_ibi_articles";
            array_push($articles, $this->db->query("SELECT ID_ARTICLE AS ARTICLE_ID,DESIGN_ARTICLE, REF_CATEGORIE_ARTICLE, QUANTITY_ARTICLE as QUANTITE_ARTICLE, PRIX_DE_VENTE_ARTICLE,0 as PRIX_VENTE_CLIENT_ARTICLE,CODEBAR_ARTICLE,STORE_ID_ARTICLE 
            FROM $table
             where DELETE_STATUS_ARTICLE = 0 and PRIX_DE_VENTE_ARTICLE IS NOT NULL
             AND REF_CATEGORIE_ARTICLE IS NOT NULL")->result());
        }
        $articles = array_merge(...$articles);

        $insert = $this->construct_insert("articles", ["ARTICLE_ID", "DESIGN_ARTICLE", "QUANTITE_ARTICLE", "REF_CATEGORIE_ARTICLE", "PRIX_DE_VENTE_ARTICLE", "PRIX_VENTE_CLIENT_ARTICLE", "CODEBAR_ARTICLE", "STORE_ID_ARTICLE"], $articles);
        echo $insert;
        exit;
    }

    public function get_modes()
    {
        $insert = $this->construct_insert("modes", ["ID_MODE_PAIEMENT", "DESIGNATION_PAIEMENT_MODE"], $this->db->query("SELECT ID_MODE_PAIEMENT,DESIGNATION_PAIEMENT_MODE FROM mode_paiement")->result());
        echo $insert;
        exit;
    }
    public function get_types()
    {
        $insert = $this->construct_insert("types", ["ID_TYPE_FACTURE", "DESIGNATION_TYPE_FACTURE"], $this->db->query("SELECT ID_TYPE_FACTURE,DESIGNATION_TYPE_FACTURE FROM type_facture")->result());
        echo $insert;
        exit;
    }

    public function get_commandes()
    {
        $today = date('Y-m-d');
        $date = date_create($today);
        $d = date_sub($date, date_interval_create_from_date_string('4 days'));
        $dat = date_format($d, 'Y-m-d');
        // TODO: Add date limit when fetching orders

        $insert = $this->construct_insert(
            "commandes",
            [
                "ID_POS_IBI_COMMANDES",
                "COMMANDE_STATUS",
                "CODE_FACTURE",
                "CODE", "PRINT_COUNT", "CLIENT_ID_COMMANDE", "CREATED_BY_POS_IBI_COMMANDES",
                "DATE_PAIEMENT_COMMANDE", "DATE_CREATION_POS_IBI_COMMANDES", "FROM_CLOUD"
            ],
            $this->db->query("SELECT ID_POS_IBI_COMMANDES,COMMANDE_STATUS,1 AS FROM_CLOUD,
         CODE,
         PRINT_COUNT,CODE_FACTURE,CLIENT_ID_COMMANDE,CREATED_BY_POS_IBI_COMMANDES,
         DATE_PAIEMENT_COMMANDE,DATE_CREATION_POS_IBI_COMMANDES
         FROM pos_ibi_commandes where DELETED_STATUS_POS_IBI_COMMANDES = 0 AND DATE_CREATION_POS_IBI_COMMANDES >= '$dat' AND CLIENT_ID_COMMANDE != ''")->result()
        );

        echo $insert;
        exit;
    }

    public function get_produits()
    {
        $today = date('Y-m-d');
        $date = date_create($today);
        $d = date_sub($date, date_interval_create_from_date_string('4 days'));
        $dat = date_format($d, 'Y-m-d');
        $insert = $this->construct_insert(
            "produits",
            [
                "ID_POS_IBI_COMMANDES_PRODUITS",
                "POS_IBI_COMMANDES_ID",
                "REF_PRODUCT_CODEBAR",
                "REF_COMMAND_CODE",
                "QUANTITE", "PRIX_NORMAL", "PRIX_CLIENT", "PRIX_VENDU", "NAME_PRODUIT", "DATE_CREATION_POS_IBI_COMMANDES_PRODUITS",
                "CREATED_BY_POS_IBI_COMMANDES_PRODUITS",
                "STORE_ID_POS_IBI_COMMANDES_PRODUITS",

            ],
            $this->db->query("SELECT ID_POS_IBI_COMMANDES_PRODUITS,
            POS_IBI_COMMANDES_ID,
         REF_PRODUCT_CODEBAR,REF_COMMAND_CODE,
         QUANTITE,
         PRIX_NORMAL,PRIX_CLIENT,PRIX_VENDU,NAME_PRODUIT,DATE_CREATION_POS_IBI_COMMANDES_PRODUITS,CREATED_BY_POS_IBI_COMMANDES_PRODUITS,
         STORE_ID_POS_IBI_COMMANDES_PRODUITS
         FROM pos_ibi_commandes_produits where DELETED_STATUS_POS_IBI_COMMANDES_PRODUITS = 0 AND DATE_CREATION_POS_IBI_COMMANDES_PRODUITS >= '$dat'")->result()
        );
        echo $insert;
        exit;
    }

    public function get_paiements()
    {
        $today = date('Y-m-d');
        $date = date_create($today);
        $d = date_sub($date, date_interval_create_from_date_string('1 days'));
        $dat = date_format($d, 'Y-m-d');
        $insert = $this->construct_insert("paiements", [
            "ID_PAIEMENT", "COMMANDE_ID", "MONTANT_PAIEMENT",
            "MODE_PAIEMENT", "TYPE_FACTURE",
            "SHIFT_ID", "CLIENT_ID_PAIEMENT", "DATE_CREATION_PAIEMENT",
            "CREATED_BY_PAIEMENT", "DATE_CREATION_COMMANDE"
        ], $this->db->query("SELECT 
        ID_PAIEMENT,
        COMMANDE_ID,
         MONTANT_PAIEMENT,MODE_PAIEMENT,TYPE_FACTURE,SHIFT_ID,CLIENT_ID_PAIEMENT,
         DATE_CREATION_PAIEMENT,CREATED_BY_PAIEMENT,DATE_CREATION_COMMANDE
        FROM Pos_paiements where DATE_CREATION_PAIEMENT >= '$dat'")->result());
        echo $insert;
        exit;
    }

    public function get_clients()
    {
        $insert = $this->construct_insert("clients", ["ID_CLIENT", "NOM_CLIENT", "PRENOM_CLIENT"], $this->db->query("SELECT ID_CLIENT, NOM_CLIENT,'' AS PRENOM_CLIENT FROM pos_clients WHERE DELETE_STATUS_CLIENT = 0")->result());
        echo $insert;
        exit;
    }

    public function get_shifts()
    {
        $insert = $this->construct_insert("shifts", ["ID_SHIFT", "SHIFT_START", "SHIFT_END", "SHIFT_STATUS", "CREATED_BY_SHIFT", "INSERTED_AT_SHIFT", "UPDATED_AT_SHIFT", "FROM_CLOUD"], $this->db->query("SELECT *, 1 AS FROM_CLOUD FROM cashier_shifts ORDER BY INSERTED_AT_SHIFT DESC LIMIT 3")->result());
        echo $insert;
        exit;
    }

    public function get_tables()
    {
        $insert = $this->construct_insert("tables", ["ID_COMMANDE_LOCATION", "DESIGNATION", "DELETE_STATUS"], $this->db->query("SELECT ID_COMMANDE_LOCATION,DESIGNATION,DELETE_STATUS FROM Pos_ibi_commande_location")->result());
        echo $insert;
        exit;
    }
}
