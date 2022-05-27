<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
       bon de sortie
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script>
        function myFunction() {
            window.print();
        }
    </script>
</head>
<body>
    <?php if ($this->uri->segment(5) != null){ ?>
    <div  class="container">
        <div class="row">
            <div style="color: #000!important;background-color: #F5F5F5;"class="well col-xs-12 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
            <div class="row order-details">
               <div class="row">
                <div style="margin-top: 2% !important;" class="col-lg-4 col-xs-4 col-sm-4 col-md-8">
                    <img style="" src="https://gts.ibi-africa.com/images/logo_GTS_Red.png" width="70%" height="80px">
                </div>
                    <div style="font-size: 8px !important;margin-top: 2% !important;"  class="col-lg-4 col-xs-4 col-sm-4 col-md-4">
                        <h5 class="text-right">
                          Bon de sortie Numéro <?php echo $bon_sortie['NUMERO_BON'];?>
                        </h5>
                    </div>
                    <div style="font-size: 8px !important;margin-top: 2% !important;" class="col-lg-4 col-xs-4 col-sm-4 col-md-4">
                        <h5 class="text-center">
                           Date<br/> 
                           <p class="text-center"><?php echo $bon_sortie['DATE_CREATION'];?></p>
                        </h5>
                    </div>
                </div> 
            </div>
               
                <div class="row">
                     <div style="font-size: 14px !important;text-align: center !important;" class="text-center">
                    <h3>Bon de sortie</h3>
                </div>
                    </span>

                    <table style="margin-left: 1.5%; width:97%;color: #000 !important;">
                        <thead>
                            <tr>
                                <th style="font-size: 14px !important;color: #000 !important;border:1px solid black !important ;padding: 2% !important;">
                                    Nature de l'article
                                </th>
                                <th style="font-size: 14px !important;text-align: center; padding: 2% !important;border:1px solid black !important;">
                                    Quantité
                                </th>
                                <th style="font-size: 14px !important;text-align: center; padding: 2% !important;border:1px solid black !important;">
                                    Retour
                                </th>
                            </tr>
                        </thead>
                        <tbody> 
                        <?php
                        foreach ($bon_sortie_produits as $bon_produit) {

                            $store = $this->uri->segment(4);

                            $quantReturn = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE_SF) AS QUANTITE_SF FROM pos_store_'.$bon_produit['STORE'].'_ibi_articles_stock_flow sf, pos_store_'.$store.'_ibi_devis_bon db WHERE db.NUMERO_BON=sf.REF_COMMAND_CODE_SF AND sf.REF_ARTICLE_BARCODE_SF="'.$bon_produit['REF_PRODUCT_CODEBAR'].'" AND db.ID='.$bon_produit['REF_NUM_BON'].' AND sf.TYPE_SF="stock_return" AND sf.ACTION_STORE_SF='.$store.'');

                            if($quantReturn['QUANTITE_SF'] == ''){
                                $quantReturn['QUANTITE_SF'] = 0;
                            }
                        ?>
                  
                            <tr>
                                <td style="font-size: 14px !important;padding: 2% !important;border:1px solid black !important "class="text-left" width="30%">
                                    <?php echo $bon_produit['NAME'];?>
                                </td>
                                <td style="font-size: 14px !important;padding: 2% !important;border:1px solid black !important " class="text-center" width="12%">
                                    <?php echo $bon_produit['QUANTITE'];?>
                                </td>
                                <td style="font-size: 14px !important;padding: 2% !important;border:1px solid black !important " class="text-center" width="12%">
                                    <?php echo $quantReturn['QUANTITE_SF'];?>
                                </td>
                            </tr>
                         <?php } ?>
                        </tbody>
                    </table>

                    <div class="hideOnPrint">
                        <div class="row hideOnPrint">
                            <div class="col-lg-12" align="center">
                            <button class="btn btn-success btn-lg" onclick="myFunction()">Imprimer</button>
                            <a href="<?=  site_url('administrator/bon_sortie/index/'.$this->uri->segment(4)); ?>" class="btn btn-success btn-lg">
                                Revenir à la liste de bon de sortie
                            </a>
                            </div>
                        </div>
                    </div>
                    <br> <br> <br>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="container-fluid">
        Une erreur s'est produite durant l'affichage de ce bon de sortie. Le bon de sortie concerné semble ne pas être valide ou ne dispose d'aucun produit.
    </div>
    <div class="container-fluid hideOnPrint">
        <div class="row hideOnPrint">
            <div class="col-lg-12">
                <a href="<?=  site_url('administrator/bon_sortie/index/'.$this->uri->segment(4)); ?>" class="btn btn-success btn-lg">
                                Revenir à la liste de bon de sortie
                            </a>
            </div>
        </div>
    </div>
 



    <?php }?>
    <style media="screen, print">
        @media print {
            * {
                font-family: "Arial", Helvetica, sans-serif;
                ;
                ffont-weight:lighter;
                ffont-size: 20px;
            }

            .hideOnPrint {
                display: none !important;
            }
            td,
            th {
                ffont-size: 12px;
            }
            .order-details,
            p {
               ffont-size: 12px;
                ffont-weight: 800;
            }
            .order-details h2 {
                ffont-size: 12px;
                ffont-weight: 800;
            }
            h3d {
                ffont-size: 12px;
                ffont-weight: 800;
            }
            h4d {
                fffont-size: 11px;
                ffont-weight: 800;
            }

           /* .container-fluid{
           font-size: 8px;
           font-weight:lighter;

        }*/
        }
    </style>
    <style>
        
        .container-fluid{
            width:105mm ;
            height:148mm;
            #border: 1px solid;
            padding-bottom:0px;
            ffont-weight:lighter;
            line-height:9px;

            /*padding: 0px -4px 0px -10px;*/
            /*margin-top: 0px;
            margin-bottom: 0px;
            padding-top: 0px;*/
        }

    
         .text-right,.text-center,.text-left{
            ffont-size: 8px;
            font-weight:normal;
            margin-top: 0px; 
        }

        .order-details{margin-left:2px;}
        /*.col-lg-4 col-xs-4 col-sm-4 col-md-4*/
        .col-xs-6,.col-sm-6,.col-md-6,.col-lg-6{
            #width: 51%;
            padding-right:7px;
            padding-left:3px;

        }

        /*well,.col-xs-12,.col-sm-12,.col-md-12, .col-lg-12{
            margin-bottom: 2px;
        }*/
        
        .col-xs-6,.col-sm-6,.col-md-6,.col-lg-6{

         margin-top:0px;
         ffont-size: 8px;
         ffont-weight:lighter;      
              
        }

        .table{
            ffont-size: 12px;
            margin-left:6px;
            border:1px solid #000;
        }


        .col-md-1{padding: 0px;}

        /*.row, .order-details{margin-top: 0px;}*/

        .well, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12{
        padding-top: 1px;}
    </style>  
</body>


















