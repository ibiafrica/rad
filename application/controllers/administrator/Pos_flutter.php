<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pos_flutter extends Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login($pass)
    {
        $data = $this->db->query("SELECT a0.`full_name`, a0.`id`, a1.`group_id`, a2.`name` FROM `aauth_users` AS a0 INNER JOIN `aauth_user_to_group` AS a1 ON a1.`user_id` = a0.`id` INNER JOIN `aauth_groups` AS a2 ON a2.`id` = a1.`group_id` WHERE ((a0.`pin_code` = $pass) AND (a0.`banned` = 0))")->result();
        echo json_encode($data);
        exit;
    }

    public function stores()
    {
        $data = $this->db->query("SELECT r0.`id_store`, r0.`name_store` FROM `pos_ibi_stores` AS r0 WHERE ((r0.`is_pos` = 1) AND (r0.`delete_status_store` = 0))")->result();
        echo json_encode($data);
        exit;
    }

    public function stores_complete()
    {
        $all_stores = $this->db->query("SELECT r0.`id_store`, r0.`name_store` FROM `pos_ibi_stores` AS r0 WHERE ((r0.`is_pos` = 1) AND (r0.`delete_status_store` = 0))")->result();
        for ($r = 0; $r < sizeof($all_stores); $r++) {
            $current_store = $all_stores;
        }
    }
}
