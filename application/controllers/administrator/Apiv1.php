<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Apiv1 extends Admin
{
    public function post_commandes_from_local()
    {
        $commandes = json_decode($this->input->post("commandes"));
        $produits = json_decode($this->input->post("produits"));
        $paiements = json_decode($this->input->post("payments"));
        $shifts = json_decode($this->input->post("shifts"));
        $array_shift = $this->input->post("shiftsList");
        $commandes_code_list = $this->input->post("codeList");

        //Delete all if present
        $this->db->query("DELETE FROM pos_ibi_commandes where CODE IN $commandes_code_list");
        $this->db->query("DELETE FROM pos_ibi_commandes_produits where REF_COMMAND_CODE IN $commandes_code_list");
        $this->db->query("DELETE FROM pos_paiements where COMMANDE_CODE IN $commandes_code_list");
        $this->db->query("DELETE FROM pos_session where ID_SESSION IN $array_shift");

        // clean the stockflow too
        // $stores = $this->db->query("SELECT * from Pos_ibi_stores where IS_POS = 1 AND DELETE_STATUS_STORE = 0 and STATUS_STORE = 'opened'")->result();

        // for ($i = 0; $i < sizeof($stores); $i++) {
        //     $current_store = $stores[$i];
        //     $table_store_flow = "Pos_store_" . $current_store->ID_STORE . "_ibi_articles_stock_flow";
        //     $table_article = "Pos_store_" . $current_store->ID_STORE . "_ibi_articles";
        //     $articles = $this->db->query("SELECT REF_ARTICLE_BARCODE_SF, QUANTITE_SF FROM $table_store_flow WHERE REF_COMMAND_CODE_SF IN $commandes_code_list")->result();
        //     for ($r = 0; $r < sizeof($articles); $r++) {
        //         $curr_article = $articles[$r];
        //         $qt = $curr_article->QUANTITE_SF;
        //         $cd = $curr_article->REF_ARTICLE_BARCODE_SF;
        //         $this->db->query("UPDATE $table_article set QUANTITY_ARTICLE = (QUANTITY_ARTICLE +$qt) WHERE CODEBAR_ARTICLE = '$cd'");
        //     }
        //     $this->db->query("DELETE FROM $table_store_flow where REF_COMMAND_CODE_SF IN $commandes_code_list");
        // }
        $commandes_inserted = 0;
        $produits_inserted = 0;
        $paiements_inserted = 0;
        $sessions = 0;

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
            $sessions = $this->db->insert_batch("pos_session", $shifts);
        }

        // if ($produits_inserted > 0) {
        //     for ($p = 0; $p < sizeof($produits); $p++) {
        //         $curr_prod = $produits[$p];
        //         $qty = $curr_prod->quantite;
        //         $bar = $curr_prod->ref_product_codebar;
        //         $code = $curr_prod->ref_command_code;
        //         $table_article = "Pos_store_" . $curr_prod->store_id_Pos_ibi_commandes_produits . "_ibi_articles";
        //         $table_flow = "Pos_store_" . $curr_prod->store_id_Pos_ibi_commandes_produits . "_ibi_articles_stock_flow";
        //         $this->db->query("UPDATE $table_article SET QUANTITY_ARTICLE = (QUANTITY_ARTICLE - $qty) WHERE CODEBAR_ARTICLE = '$bar'");
        //         $cmd = $this->db->query("SELECT * FROM Pos_ibi_commandes WHERE CODE = '$code'")->result()[0];
        //         $dataArticleFlow = array(
        //             "REF_COMMAND_CODE_SF" => $curr_prod->ref_command_code,
        //             "QUANTITE_SF" => $curr_prod->quantite,
        //             "DATE_CREATION_SF" => $curr_prod->date_creation_Pos_ibi_commandes_produits,
        //             "CREATED_BY_SF" => $curr_prod->created_by_Pos_ibi_commandes_produits,
        //             "SHIFT_ID_S" => $cmd->ID_CASHIER_SHIFT,
        //             "REF_ARTICLE_BARCODE_SF" => $curr_prod->ref_product_codebar,
        //             "UNIT_PRICE_SF" => $curr_prod->prix,
        //             "TYPE_SF" => "sale",
        //             "TOTAL_PRICE_SF" => $curr_prod->prix * $curr_prod->quantite,
        //             "REF_PROVIDER_SF" => 0
        //         );
        //         $this->db->insert($table_flow, $dataArticleFlow);
        //     }
        // }
        echo json_encode(array("commandes" => $commandes_inserted, "produits" => $produits_inserted, "paiements" => $paiements_inserted, "sessions" => $sessions));
        exit;
    }

    public function get_one_user()
    {
        $pin = $this->input->get("pin");

        $user_info = $this->db->query("SELECT id as user_id, full_name, group_id FROM aauth_users as u join aauth_user_to_group as gp on gp.user_id = u.id where u.banned = 0 and pin_code = ?", [$pin])->result();
        echo json_encode($user_info);
        exit;
    }

    public function get_stores($isJson = false)
    {
        $all_stores = $this->db->query("SELECT * FROM pos_ibi_stores where DELETE_STATUS_STORE = 0 and IS_POS = 1 AND STATUS_STORE = 'opened'")->result();
        if ($isJson) {
        } else {
            return $all_stores;
        }
    }
    // public function 
}
