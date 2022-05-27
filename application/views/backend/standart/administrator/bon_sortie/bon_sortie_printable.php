<?php
/**
 * Starting Cache
 * Cache should be manually restarted
**/
$demandeur = @$order['order'][0]['DEMANDEUR'];
use Carbon\Carbon;

if (! $order_cache = $cache->get($order[ 'order' ][0][ 'ID' ]) || @$_GET[ 'refresh' ] == 'true') {
    ob_start();
}
?>
<?php if( @$_GET[ 'ignore_header' ] != 'true' ):?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        <?php echo sprintf(__('Order ID : %s &mdash; Ibi Shop Receipt', 'ibi'), $order[ 'order' ][0][ 'NUMERO_BON' ]);?>
    </title>
    <link rel="stylesheet" media="all" href="<?php echo css_url('ibi') . '/bootstrap.min.css';?>" />
    <script>
        function myFunction() {
            window.print();
        }
</script>
</head>
<?php endif;?>
<body>
  <?php global $Options;?>
    <?php if (@$order[ 'order' ][0][ 'NUMERO_BON' ] != null):?>
    <div class="container-fluid">
        <div class="row">
            <div class="well col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row order-details">
 
               <div class="row">
                <div  class="col-lg-4 col-xs-4 col-sm-4 col-md-4">
                    <img style="" src="http://production.ibi-africa.com/quotation/logo_GTS_Red.png" width="90%" height="45px">
                </div>
                    <div class="col-lg-4 col-xs-4 col-sm-4 col-md-4">
                        <h3 class="text-right">
                           Bon de sortie Numéro <?php echo @$order[ 'order' ][0][ 'NUMERO_BON' ];?>
                        </h3>
                    </div>
                    <div class="col-lg-4 col-xs-4 col-sm-4 col-md-4">
                        <h3 class="text-center">
                           Date<br/> 
                           <p class="text-center"><?php echo @$order[ 'order' ][0][ 'DATE_CREATION' ];?></p>
                           </h3>
                    </div>
                    </div>

                
            </div>
               
                <div class="row">
                     <div class="text-center">
                    <h3><?php _e('Bon de sortie', 'ibi');?></h3>
                </div>
                    </span>
                    <table class="table" border="1" style="width:97%;">
                        <thead>
                            <tr>
                                <th class="col-md-6 " style="width: 43%;">
                                    <?php _e('Nature de l\'article', 'ibi');?>
                                </th>
                                <th class="col-md-1 text-center" style="width:7%;">
                                    <?php _e('Quantite', 'ibi');?>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php foreach ($order[ 'products' ] as $_produit) { 
                                 ?>
                            <tr>
                                <td class="text-left" width="30%">
                                    <?php echo $_produit[ 'NAME_B' ];?>
                                </td>
                                <td class="text-center" width="12%">
                                    <?php echo $_produit[ 'QTE_ADDED' ];?>
                                </td>
                            </tr>
                         <?php   }?>
                        </tbody>
                    </table>
                    <!-- <div class=" container-fluid hideOnPrint"> -->
                    <div class="hideOnPrint">
                        <div class="row hideOnPrint">
                            <div class="col-lg-12" align="center">
                            <button class="btn btn-success btn-lg" onclick="myFunction()">Imprimer</button>
                            <a href="<?php echo site_url(array( 'dashboard',store_slug(), 'ibi', 'bonsortie', '' ));?>" class="btn btn-success btn-lg">
                                <?php _e('Revenir à la liste de bon de sortie', 'ibi');?>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else:?>
    <div class="container-fluid">
        <?php echo tendoo_error(__('Une erreur s\'est produite durant l\'affichage de ce bon de sortie. Le bon de sortie concerné semble ne pas être valide ou ne dispose d\'aucun produit.', 'ibi'));?>
    </div>
    <div class="container-fluid hideOnPrint">
        <div class="row hideOnPrint">
            <div class="col-lg-12">
                <a href="<?php echo site_url(array( 'dashboard',store_slug(), 'ibi', 'bonsortie', '' ));?>" class="btn btn-success btn-lg btn-block">
                    <?php _e('Revenir à la liste de bon de sortie', 'ibi');?>
                </a>
            </div>
        </div>
    </div>





    <?php endif;?>
    <style media="screen, print">
        @media print {
            * {
                font-family: "Arial", Helvetica, sans-serif;
                ;
                font-weight:lighter;
                font-size: 14px;
            }


            /*body {
    content:url(C:\wamp64\www\rad\Radmetals-logo.png);
  }
    body {
        background:url(C:\wamp64\www\rad\Radmetals-logo.png) no-repeat;
        }*/
            .hideOnPrint {
                display: none !important;
            }
            td,
            th {
                font-size: 9px;
            }
            .order-details,
            p {
                font-size: 9px;
                font-weight: 800;
            }
            .order-details h2 {
                font-size: 9px;
                font-weight: 800;
            }
            h3 {
                font-size: 9px;
                font-weight: 800;
            }
            h4 {
                font-size: 9px;
                font-weight: 800;
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
            font-weight:lighter;
            line-height:9px;

            /*padding: 0px -4px 0px -10px;*/
            /*margin-top: 0px;
            margin-bottom: 0px;
            padding-top: 0px;*/
        }

    
         .text-right,.text-center,.text-left{
            font-size: 8px;
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
         font-size: 8px;
         font-weight:lighter;      
              
        }

        .table{
            font-size: 9px;
            margin-left:6px;
            border:1px solid #000;
        }


        .col-md-1{padding: 0px;}

        /*.row, .order-details{margin-top: 0px;}*/

        .well, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12{
        padding-top: 1px;}
    </style>  
</body>
<?php
if (! $cache->get($order[ 'order' ][0][ 'ID' ]) || @$_GET[ 'refresh' ] == 'true') {
    $cache->save($order[ 'order' ][0][ 'ID' ], ob_get_contents(), 999999999); // long time
}


















