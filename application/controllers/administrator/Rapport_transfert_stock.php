<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rapport_transfert_stock extends Admin
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_rm');
    }

    public function index($store_dest=0){

        $start=$this->input->get('start');
        $end=$this->input->get('end'); 

       if (empty($start) AND empty($end)) {
         $start=date('Y-m-d H:i:s');
         $end=date('Y-m-d H:i:s');
       }else{
        $start=$start;
        $end=$end;
       }
       
       $this->data['start']=date( "Y-m-d H:i:s", strtotime($start));
       $this->data['end']=date( "Y-m-d H:i:s", strtotime($end));

       $req=' AND REQ.DATE_CREATION_REQ BETWEEN "'.$start.'" AND "'.$end.'"';
       $this->data['store_dest']=$store_dest;
       $this->data['store']=null;

       $ob=[];
       $result=[];

       if ($store_dest) {
       	 $requete=$this->model_rm->getRequete('
          SELECT       
          ART.CODEBAR_ARTICLE_REQ AS CODE, 
          REQ.CODE_REQ AS CODE_TRANS, 
          ART.ID_REQ AS ID_TRANS_ARTICLE, 
          ART.NOM_ARTICLE_REQ, 
          SUM(ART.QT_ARTICLE_REQ-ART.QT_RETOUR_ARTICLE_REQ) AS QT,
          A.PRIX_DACHAT_ARTICLE AS TOT,
          REQ.DATE_CREATION_REQ,
          CAT.NOM_CATEGORIE
          
         FROM `pos_ibi_requisition_trans` REQ
          JOIN pos_ibi_article_requisition_trans ART ON REQ.ID_REQ=ART.ID_REQ
          JOIN pos_store_2_ibi_articles A ON A.CODEBAR_ARTICLE=ART.CODEBAR_ARTICLE_REQ
          LEFT JOIN pos_ibi_articles_categories CAT ON CAT.ID_CATEGORIE=A.REF_CATEGORIE_ARTICLE
         WHERE REQ.DESTINATION_STORE_REQ=2 AND REQ.FROM_STORE='.$store_dest.' AND ART.STATUS_PROD_REQ=1
         '.$req.'
         GROUP BY ART.CODEBAR_ARTICLE_REQ ');

       
         
       	for ($i=0; $i<count($requete); $i++) {
       	 	
         $elem=$requete[$i];
         $name= empty($elem['NOM_CATEGORIE'])? "inconnues" : $elem['NOM_CATEGORIE'];
          if (!isset($result[$name]['TOTAL'])) {
             $result[$name]['TOTAL']=0;

          }

          
               $result[$name]['items'][]=array(
                "CODE"=>$elem['CODE'],
                "NOM"=>$elem['NOM_ARTICLE_REQ'],
                "QTE"=>$elem['QT'],
                "PRIX"=>$elem['TOT'],
                "TOT_G"=>$elem['TOT']*$elem['QT']
            );  
        

         $result[$name]['TOTAL']+=$elem['TOT']*$elem['QT'];
          
       	 }
       }
       

        

        // foreach ($ob as $key => $value) {
           
        // print "<pre>";

        // print_r($result);
        // print "</pre>";
        // }

        // exit();
    
        $this->data['result']=$result;
    	$this->render('backend/standart/administrator/rapport_transfert/rapport_transfert_stock_view', $this->data);
    }

}