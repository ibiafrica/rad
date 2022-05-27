<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends Admin
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_rm');
    }

    public function getSeuil(){
    	$store=$this->input->post('store');
    	$that=$this->model_rm->getRequete('SELECT * FROM (SELECT DESIGN_ARTICLE, CODEBAR_ARTICLE, QUANTITY_ARTICLE, SEUIL_ARTICLE,(QUANTITY_ARTICLE-SEUIL_ARTICLE) AS DIFFERENCE FROM pos_store_'.$store.'_ibi_articles WHERE DELETE_STATUS_ARTICLE=0 ) A
            WHERE A.DIFFERENCE<11');
    	echo json_encode($that);
    }

}