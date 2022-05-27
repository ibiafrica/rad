<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rapport_transfert extends Admin
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_rm');
    }

    public function index(){
       $store= $this->uri->segment(2);
       $store_dest= $this->uri->segment(4);
       

       $this->data['store_dest']=$store_dest;
       $this->data['store']=$store;

       $ob=[];

       if ($store_dest) {

       	 $datas=$this->model_rm->getRequete('
          SELECT     
          CAT.ID_CATEGORIE, 
          CAT.NAME_CATEGORIE, 
          ART.CODEBAR_ARTICLE_REQ AS CODE, 
          REQ.CODE_REQ AS CODE_TRANS, 
          ART.ID_REQ AS ID_TRANS_ARTICLE, 
          ART.NOM_ARTICLE_REQ, 
          (ART.QT_ARTICLE_REQ-ART.QT_RETOUR_ARTICLE_REQ) AS QUANTITY, 
          ART.PRIX_ARTICLE_REQ, 
          REQ.DATE_CREATION_REQ 
         FROM `pos_ibi_requisition_trans` REQ
          JOIN pos_ibi_article_requisition_trans ART ON REQ.ID_REQ=ART.ID_REQ
          JOIN pos_store_'.$store.'_ibi_articles A ON A.CODEBAR_ARTICLE= ART.CODEBAR_ARTICLE_REQ
          JOIN pos_store_'.$store.'_categorie_ingredient CAT ON CAT.ID_CATEGORIE=A.REF_CATEGORIE_ARTICLE
          
        WHERE REQ.DESTINATION_STORE_REQ='.$store_dest.' AND REQ.FROM_STORE='.$store.'
        ORDER BY CAT.ID_CATEGORIE DESC ');

       
      
         $result=[];
         
       	 for ($i=0; $i<count($datas); $i++) {
       	 	
          $elem=$datas[$i];


          if (!isset($ob[$elem['NAME_CATEGORIE']])) {
            $ob[$elem['NAME_CATEGORIE']]=array();
            $ob[$elem['NAME_CATEGORIE']]['TOTAL']=0;
          }



          if (!isset($ob[$elem['NAME_CATEGORIE']] ['itm'] [$elem['CODE']])) {
            
            $ob[$elem['NAME_CATEGORIE']] ['itm'] [$elem['CODE']]=
            array(
                'CODE' => $elem['CODE'],
                'NOM_ARTICLE_REQ' => $elem['NOM_ARTICLE_REQ'],
                'QUANTITY' => (int)$elem['QUANTITY'],
                'PRIX_ARTICLE_REQ' => $elem['PRIX_ARTICLE_REQ'],
            );


          }else {
              
           $ob[$elem['NAME_CATEGORIE']] ['itm'] [$elem['CODE']]['QUANTITY']+= (int)$elem['QUANTITY'];

          }
           
          
          $ob[$elem['NAME_CATEGORIE']]['TOTAL']+=(int)$elem['PRIX_ARTICLE_REQ']*(int)$elem['QUANTITY'];
          
       	 }
       }
       

        

        // foreach ($ob as $key => $value) {
           
        // print "<pre>";

        // print_r($value);
        // print "</pre>";
        // }

        // exit();
    
       $this->data['result']=$ob;
    	$this->render('backend/standart/administrator/rapport_transfert/rapport_transfer_view', $this->data);
    }

}