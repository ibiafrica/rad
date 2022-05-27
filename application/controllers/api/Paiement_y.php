<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Paiement_y extends API
{

  public function __construct()
  {
    parent::__construct();
  }

  public function request_void_post()
  {

    $order_id = $this->input->post('order_id');
    $update_void = $this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_VOID_REQUEST=1 WHERE ID_pos_IBI_COMMANDES="' . $order_id . '"');
    if ($update_void) {
      $this->response([
        'status' => true,
        'message' => 'request void passed'
      ], API::HTTP_OK);
    } else {
      $this->response([
        'status' => false,
        'message' => validation_errors()
      ], API::HTTP_NOT_ACCEPTABLE);
    }
  }




  public function request_split_post()
  {

    $order_id = $this->input->post('order_id');

    $update_split = $this->db->query('UPDATE pos_ibi_commandes SET COMMANDE_SPLIT_REQUEST=1 WHERE ID_pos_IBI_COMMANDES="' . $order_id . '"');

    if ($update_split) {
      $this->response([
        'status' => true,
        'message' => 'request split passed'
      ], API::HTTP_OK);
    } else {
      $this->response([
        'status' => false,
        'message' => validation_errors()
      ], API::HTTP_NOT_ACCEPTABLE);
    }
  }
}

/* End of file User.php */
/* Location: ./application/controllers/api/User.php */