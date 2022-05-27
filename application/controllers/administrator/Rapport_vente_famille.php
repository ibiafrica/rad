<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rapport_vente_famille extends Admin
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


       $start=$this->input->get('start');
       $end=$this->input->get('end');

       if (empty($start) AND empty($end)) {
         $start=date('Y-m-d H:i:s');
         $end=date('Y-m-d H:i:s');
         

       }

       $this->data['start']=$start; 
       $this->data['end']=$end; 

 
      
        $inv=$this->model_rm->getRequete('SELECT F.NAME_FAMILLE,`REF_ARTICLE_BARCODE_SF`,`TYPE_SF`,`QUANTITE_SF`, ART.PRIX_DACHAT_ARTICLE, (QUANTITE_SF*ART.PRIX_DACHAT_ARTICLE) AS TOT,`DATE_CREATION_SF`
          FROM pos_store_1_ibi_articles_stock_flow FLOW
          JOIN pos_store_1_ibi_articles ART ON FLOW.REF_ARTICLE_BARCODE_SF=ART.CODEBAR_ARTICLE
          JOIN pos_article_famille F ON F.ID_FAMILLE= ART.REF_ID_FAMILLE_ARTICLE
          WHERE FLOW.DATE_CREATION_SF BETWEEN "'.$start.'" AND "'.$end.'"
          ORDER BY F.NAME_FAMILLE');

        $result=[];

        $result['TOT_COMPLEMENTARY']=0;

        $result['TOT_ALL']=0;

        for ($i=0; $i <count($inv) ; $i++) { 

         $elem=$inv[$i];

         $inventaire=0;
         $approv=0;

         if ($elem['TYPE_SF']=='inventory') {
           $inventaire=$elem['TOT'];
         }

         if ($elem['TYPE_SF']=='stock_in') {
           $approv=$elem['TOT'];
         }

         // if () {
         //   # code...
         // }

         if (!isset($result['item'][$elem['NAME_FAMILLE']])) {
            $result['item'][$elem['NAME_FAMILLE']]=array(
              "INVENTAIRE"=>$inventaire,
              "APPROV"=>$approv,
              "CONSUPTION"=>0,

            );

          }else{
            $result['item'][$elem['NAME_FAMILLE']]['INVENTAIRE']+=$inventaire;
            $result['item'][$elem['NAME_FAMILLE']]['APPROV']+=$approv;
          }
          
        }

      
       $ob=[];
       $datas=[];
       $stores=$this->model_rm->getList('pos_ibi_stores',array('STATUS_STORE'=>'opened'));
        
        foreach ($stores as $key ) {

         if ($key['ID_STORE']!=1) {
           
         $datas[]=$this->model_rm->getRequete("SELECT FLOW.DATE_CREATION_SF, F.NAME_FAMILLE,`REF_ARTICLE_BARCODE_SF`,`TYPE_SF`,`QUANTITE_SF`, ART.PRIX_DACHAT_ARTICLE, (QUANTITE_SF*ART.PRIX_DACHAT_ARTICLE) AS TOT,`DATE_CREATION_SF`
          FROM pos_store_".$key['ID_STORE']."_ibi_articles_stock_flow FLOW
          JOIN pos_store_1_ibi_articles ART ON FLOW.REF_ARTICLE_BARCODE_SF=ART.CODEBAR_ARTICLE
          JOIN pos_article_famille F ON F.ID_FAMILLE= ART.REF_ID_FAMILLE_ARTICLE
          WHERE  FLOW.DATE_CREATION_SF BETWEEN  '".$start."'  AND '".$end."'
          AND (TYPE_SF='sale' OR TYPE_SF='sale_stock_in')
          ORDER BY F.NAME_FAMILLE");

         }

        }

  


        for ($i=0; $i <count($datas) ; $i++) { 

          $array=$datas[$i];

          for ($j=0; $j < count($array); $j++) { 

             $current=$array[$j];

              if (!isset($result['item'][$current['NAME_FAMILLE']]['INVENTAIRE'])) {
               $result['item'][$current['NAME_FAMILLE']]['INVENTAIRE']=0;
             }

             if (!isset($result['item'][$current['NAME_FAMILLE']]['APPROV'])) {
               $result['item'][$current['NAME_FAMILLE']]['APPROV']=0;
             }
               
               if (!isset($result['item'][$current['NAME_FAMILLE']]['CONSUPTION'])) {
                 $result['item'][$current['NAME_FAMILLE']]['CONSUPTION']=0;
               }

             if ($current['TYPE_SF']=="sale" OR $current['TYPE_SF']=="sale_complimentary") {

              $result['item'][$current['NAME_FAMILLE']]['CONSUPTION'] +=$current['TOT'];
              $result['TOT_ALL']+=$current['TOT'];

              if ($current['TYPE_SF']=="sale_complimentary") {
                $result['TOT_COMPLEMENTARY']+=$current['TOT'];
              }

               
             }else{
               
                $result['item'][$current['NAME_FAMILLE']]['CONSUPTION']-=$current['TOT'];
                $result['TOT_ALL']-=$current['TOT'];

             }

            
             
           }  
         
        }

        
        // print "<pre>";

        // print_r($result);
        // print "</pre>";  

        // exit();

      if (!isset($result['item'])) {
        $result['item']=[];
      }
    
      $this->data['result']=$result;
      $this->render('backend/standart/administrator/rapport_vente/rapport_vente_view', $this->data);
    }

}