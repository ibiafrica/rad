<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSSd -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --> 

</head>
 <body>

<div class="content">

  <div class="row" >
      
      <div class="col-md-12">
      <?php
        $date='';
        $limit='';
        $offset='';
        if(isset($_GET['submit'])){
        $date = $_GET['date'];
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
      }
       ?>
    <!-- <div class="row" style="border:1px solid"> -->
      <div class="col-xs-12" style="border:0px solid" >
        <form method="get">
          <div class="row col-md-12">
            <div class="col-md-3">
              <label>Date</label><input type="date" name="date" value="<?=$date?>" class="form-control" required="required">
            </div>
            <div class="col-md-3">
              <label>Limit</label><input type="number" name="limit" value="<?=$limit?>" class="form-control" required="required">
            </div>
            <div class="col-md-3">
              <label> Offset</label><input type="number" name="offset" value="<?=$offset?>" class="form-control" required="required">
            </div>
            <label> </label><div class="col-md-2">
            <input type="submit" name="submit" value="submit" class="btn btn-primary">
          </div>
        </div>
       </form><br/>

      <div class="row">
      <div class="col-md-12">
        
        <table class="table1 table-striped" style="border:1px solid; width:;font-size: 1em;">

      <?php

      if(isset($_GET['submit'])){
        $date = date('Y-m', strtotime($_GET['date']));
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
     

      //  $variables=$this->db->query('SELECT c.CODE,c.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES FROM hospital_ibi_commandes c WHERE c.DELETED_STATUS_HOSPITAL_IBI_COMMANDES=0 AND DATE_CREATION_HOSPITAL_IBI_COMMANDES LIKE "%2019-07%"');
      $variables = $this->db->query('SET SESSION SQL_BIG_SELECTS = 1');
      $variables = $this->db->query("SELECT c.CODE,c.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES,pt.MOVEMENT_ID,date_format(pt.MOVEMENT_DATE_CREATION, '%Y-%m-%d %H:%i') as DATES
        FROM hospital_ibi_commandes c 
        JOIN labo_exam_movement_to_patient pt ON pt.MOVEMENT_PATIENT_FILE_ID = c.PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES 
        WHERE c.DELETED_STATUS_HOSPITAL_IBI_COMMANDES=0 AND c.DATE_CREATION_HOSPITAL_IBI_COMMANDES LIKE '%".$date."%' LIMIT ".$limit." OFFSET ".$offset."");

        foreach ($variables->result() as $key) {
           
           $code = $key->CODE;

           $patient = $key->PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES;

               $date = $key->DATES;

               $mouvements = $key->MOVEMENT_ID;

              echo 'code => '.$code.'<br/>';
              
              echo 'mouvement => '.$key->MOVEMENT_ID.'+====+'. $date.'<br/>';

              $requete = $this->db->query('SELECT ID_HOSPITAL_IBI_COMMANDES_PRODUITS,REF_PRODUCT_CODEBAR,date_format(p.DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m-%d %H:%i") AS DAT FROM hospital_ibi_commandes_produits p WHERE p.DEPARTMENT="1000003" AND p.DELETED_STATUS_HOSPITAL_IBI_COMMANDES_PRODUITS="0" AND p.REF_COMMAND_CODE="'.$code.'" AND date_format(p.DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS, "%Y-%m-%d %H:%i")="'.$date.'"');
           
            foreach ($requete->result() as $keyss) {

              $commandes_produits = ($keyss->ID_HOSPITAL_IBI_COMMANDES_PRODUITS);

              
               echo 'Sku=> '.$keyss->REF_PRODUCT_CODEBAR. ' Produit => '.$keyss->ID_HOSPITAL_IBI_COMMANDES_PRODUITS.' date =>'.$keyss->DAT.'<br/>';


                $query =  $this->db->query('UPDATE hospital_ibi_commandes_produits SET EXAM_MOVEMENT_ID ="'.$mouvements.'" WHERE ID_HOSPITAL_IBI_COMMANDES_PRODUITS="'. $commandes_produits.'"');

              if ($query) {
                echo 'ok ';
              }

              else{
                echo 'Erreur ';
              }

              
            // }

          }
 
        } 
      }
      ?>

    </table>
      </div>
        
      </div>
      
                       

</div>


 </div>

 </div>

</div>