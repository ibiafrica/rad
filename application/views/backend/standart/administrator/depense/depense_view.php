<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">
<!-- Fine Uploader jQuery JS file
    ====================================================================== -->
<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>
<?php $this->load->view('core_template/fine_upload'); ?>
<script>
function myFunction() {
  window.print();
}
</script>
<style type="text/css">
  @media print {
    @page {                
    size: A4 !important;
    margin: 1mm !important;
  }


.widget-user-username,.img-circle{
  display: none !important;
}
 #cadre_agauche{
   width: 35% !important;
   float: left;
   margin-left: 10% !important;
 }



  #cadre_adroit{
   width: 30% !important;
  float: left !important;
  margin-left: 15% !important;

 }
 #datee{
  float: right !important;
  margin-right: 40px;
 }
 #lo{
  float: left !important;
 }
hr{
    display: none !important;
}
title{
    display: none !important;
}


 .btn,.main-footer,#form_bon_requisitionx,#heure{
  display: none !important;
 }
 table tr th{
 border:1px solid black !important;
background-color: #ccc !important;
text-align: center !important;
}
 .table,.table-bordered,.table-striped tr td{
 border:0px solid black !important;
 }
 .list-group-item{
  border:1px solid black !important;
   padding: 1% !important;
 }
 .list-group{
  box-shadow: 0px !important;
  border:0px solid black !important;
 }
 .cadre{
  width: 90% !important;
  margin-left: 4% !important;
  border:2px solid black !important;
  padding: 20px 20px 20px 20px;
}
}
.cadre{
  width: 90% !important;
  margin-left: 4% !important;
  border:2px solid black !important;
  padding: 20px 20px 20px 20px;
}


</style>
<section class="content-header">

   <h1>

      Bon de dépense caisse détail

   </h1>

   <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>

      <li class="active">Bon dépense caisse détail</li>

   </ol>

</section>
<div class="row">
  <div class="cadre">
    <div class="row">
      <div id="lo"class="col-md-3">
        <img  src="https://gts.ibi-africa.com/images/logo_GTS_Red.png" alt="logo">
      </div>
      <div id="datee" style='font-size: 1.2em;margin-top: 2%; font-family: "Times New Roman", Times, serif;' class="col-md-3 col-md-offset-5">
                 <span >Date&nbsp;: le&nbsp;
                  <?php $origDate = $depense->DATE_CREATION_DEPENSE; 
                    $newDate = date("d/m/Y", strtotime($origDate));
                    echo $newDate; ?>
                 </span>
      </div>
    </div>
    <div class="row">
      <div style='text-align: center;font-weight: bold;font-size: 1.2em;font-family: "Times New Roman", Times, serif;' class="col-md-12">
             BON DE DEPENSE CAISSE
      </div>
    </div>
    <div class="row">    
        <div id="datee" style='font-weight: bold;font-size: 1.2em;font-family: "Times New Roman", Times, serif' class="col-md-3 col-md-offset-8">
          <span >BDC&nbsp;&#8470;&nbsp;: <?=$depense->NUMERO_DEPENSE?></span>
        </div>
    </div>

    <?php 
      $total = 0;
      $somme = $this->db->query('select sum(MONTANT_DEPENSE) as somme from pos_ibi_depense where NUMERO_DEPENSE = '.$depense->NUMERO_DEPENSE.'')->result();
      foreach($somme as $somme) {
        $total += $somme->somme;
      }
      $comment = $depense->DESCRIPTION_DEPENSE;

      $fourniture = $this->model_registers->getOne('pos_ibi_fourniture',array('ID_FOURNITURE'=>$depense->FOURNITURE_DEPENSE));
      $description=$fourniture['NOM_FOURNITURE'];
      $gestion_caisse = $this->model_registers->getOne('aauth_users',array('id'=>$depense->AUTHOR_DEPENSE));

      function convertNumberToWord($num = false)
                      {
                          $num = str_replace(array(',', ' '), '' , trim($num));
                          if(! $num) {
                              return false;
                          }
                          $num = (int) $num;
                          $words = array();
                          $list1 = array('', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze',
                              'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf'
                          );

                          $list5 = array('', '', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze',
                              'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf'
                          );
                          $list2 = array('', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'septante', 'quatre-vingts', 'nonante', 'cent');
                          $list3 = array('', 'mille', 'million', 'milliard', 'billion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
                              'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
                              'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
                          );
                          $num_length = strlen($num);
                          $levels = (int) (($num_length + 2) / 3);
                          $max_length = $levels * 3;
                          $num = substr('00' . $num, -$max_length);
                          $num_levels = str_split($num, 3);
                          for ($i = 0; $i < count($num_levels); $i++) {
                              $levels--;
                              $hundreds = (int) ($num_levels[$i] / 100);
                              $hundreds = ($hundreds ? ' ' . $list5[$hundreds] . ' cent' . ' ' : '');
                              $tens = (int) ($num_levels[$i] % 100);
                              $singles = '';
                              if ( $tens < 20 ) {
                                  $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
                              } else {
                                  $tens = (int)($tens / 10);
                                  $tens = ' ' . $list2[$tens] . ' ';
                                  $singles = (int) ($num_levels[$i] % 10);
                                  $singles = ' ' . $list1[$singles] . ' ';
                              }
                              $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
                          } //end for loop
                          $commas = count($words);
                          if ($commas > 1) {
                              $commas = $commas - 1;
                          }
                          return implode(' ', $words);
                      }


    ?>
    <div class="row">
      <div style='padding: 0px 20px 0px 0px !important;  margin-left: 6% !important; margin-top: 3%;font-size: 1.2em;font-family: "Times New Roman", Times, serif;'class="col-md-8">
               Mme/Mlle/Mr&nbsp;:&nbsp; <strong> <?php echo $gestion_caisse['full_name']; ?></strong>&nbsp;&nbsp; peut Faire sortir de la Caisse de GENERAL TRADING SERVICE (GTS) la somme de <strong></strong><?php echo convertNumberToWord($total).' '.'francs burundais';?><br>pour&nbsp;:&nbsp; <strong><?php if($comment != ''){ echo $comment;}else{ echo $description;} ?></strong>
      </div>
    </div>
    <div class="row">
        <div style='margin-left: 5% !important;margin-top: 2%; font-size: 1.2em;font-family: "Times New Roman", Times, serif;' class="col-md-8 ">En chiffre&nbsp;:&nbsp;<strong><?php echo number_format($total,0," "," ").'&nbsp;&nbsp;FBu';?></strong>
        </div>
    </div>
    <div class="row" style='font-size: 1.2em;font-family: "Times New Roman", Times, serif;'>
               <div id="cadre_agauche" style="text-align: center; margin-left: 7%;margin-top: 7%;" class="col-md-3">
                        <ul style="border: 1px solid black; border-radius: 6px;" class="list-group">
                          <li class="list-group-item">
                           <strong>Gestionnaire de la caisse:</strong>
                          </li>
                          
                          <li id="signature" class="list-group-item"><?php echo $gestion_caisse['full_name']; ?><br><br><br></li>
                        </ul>
                  </div>
                  <div id="cadre_adroit" style="text-align: center; margin-top: 7%;" class="col-md-3 col-md-offset-3">
                        <ul style="border: 1px solid black; border-radius: 6px;"class="list-group">
                          <li class="list-group-item">
                           <strong>Par Acquit:</strong>
                          </li>
                          <li id="signature" class="list-group-item"><?php echo ucfirst($depense->ACQUIT_DEPENSE); ?><br><br><br></li>
                        </ul>
                  </div>
           </div>
         </div> <!-- fin cadre -->
   </div> <!-- fin row -->
   <div style="margin-left: 4% !important;">
    <button class="btn btn-flat btn-primary" onclick="myFunction()">
      <i class="glyphicon glyphicon-print"></i> Imprimer
    </button>
  </div>


  <div class="table-responsive" style="margin-left: 4% !important;"> 
    <table class="table table-bordered table-striped dataTable">
       <thead>
          <tr class="">
           
           
             <th>Nom du fiche</th>
             <th>N° du fiche</th>
             <th>Fichier de depense</th>
             <th>Date</th>
             <th>Par</th>
             <th>Action</th>
          </tr>
       </thead>
      <tbody id="tbody_depense">
         <?php foreach($depense_file as $depense_file): 
          $auth_user = $this->model_registers->getOne('aauth_users',array('id'=>$depense_file->AUTHOR_FILE));
          ?>
          <tr>
          
             <td><?= _ent($depense_file->NAME_FILE);?></td>
             <td><?= _ent($depense_file->NUMERO_FILE); ?></td> 
             <td> <?php if (is_image($depense_file->PATH_FILE)): ?>

                <a class="fancybox" rel="group" href="<?= BASE_URL . 'uploads/depense_file/' . $depense_file->PATH_FILE; ?>">
                  <img src="<?= BASE_URL . 'uploads/depense_file/' . $depense_file->PATH_FILE; ?>" class="image-responsive" alt="image depense" title="depense file" width="40px">
                </a>
                <?php else: ?>
                <label>
                 <a href="<?= BASE_URL . 'uploads/depense_file/' . $depense_file->PATH_FILE; ?>">
                    <img src="<?= get_icon_file($depense_file->PATH_FILE); ?>" class="image-responsive" alt="image depense" title="<?= $depense_file->PATH_FILE; ?>" width="40px">
                  </a>
                 </label>
                <?php endif; ?>
              </td> 
              <td><?= _ent($depense_file->DATE_CREATION_FILE); ?></td> 
              <td><?= $auth_user['username']; ?></td> 
            
             <td width="200">
                <?php is_allowed('depense_file_delete', function() use ($depense_file){?>
                <a href="javascript:void(0);" data-href="<?= site_url('administrator/depense/delete_files/'.$this->uri->segment(4).'/' . $depense_file->ID_FILE); ?>" title="Supprimer la fiche" class="btn btn-danger remove-data btn-xs"><i class="fa fa-close"></i></a>
                 <?php }) ?>
                <?php is_allowed('depense_file_update', function() use ($depense_file){?>
                  <button type="button" class="btn btn-default btn-xs" title="Editer la fiche" onclick="appel_modal(this.id)" id="<?=$depense_file->ID_FILE?>"><i class="fa fa-edit"></i></button>
                <?php }) ?>

              </td>
            </tr>

    <!-- Modal -->
     <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
         <?= form_open('', [
                            'name'    => 'form_depense_file', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_depense_file', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
        <div class="modal-content">
          <div class="modal-header" >
              <h4> Modification du fiche depense</h4> 
          </div>
         <div class="modal-body">
              <div class="form-group">
                <label for="NAME_FILE" class="col-sm-4 control-label">Nom de la fiche 
                  <i class="required">*</i> 
                </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="NAME_FILE" placeholder="Nom de la fiche" name="NAME_FILE" value="<?= set_value('NAME_FILE', $depense_file->NAME_FILE); ?>">
                </div>
              </div>
              <hr>
               <div class="form-group">
                <label for="NUMERO_FILE" class="col-sm-4 control-label">Numéro de la fiche 
                  <i class="required">*</i> 
                </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="NUMERO_FILE" placeholder="Numéro de la fiche" name="NUMERO_FILE" value="<?= set_value('NUMERO_FILE', $depense_file->NUMERO_FILE); ?>">
                </div>
              </div>

                  <input type="hidden" name="REF_DEPENSE_FILE" id="REF_DEPENSE_FILE" value="">
                    <div class="form-group " style="height:300px;">
                            <label for="PATH_FILE" class="col-sm-4 control-label">
                            <i class="required"></i>
                            </label>
                            <div class="col-sm-5">
                                <div id="depense_file_PATH_FILE_galery"></div>
                                <input class="data_file" name="depense_file_PATH_FILE_uuid" id="depense_file_PATH_FILE_uuid" type="hidden" value="<?= set_value('depense_file_PATH_FILE_uuid'); ?>">
                                <input class="data_file" name="depense_file_PATH_FILE_name" id="depense_file_PATH_FILE_name" type="hidden" value="<?= set_value('depense_file_PATH_FILE_name', $depense_file->PATH_FILE); ?>">
                               </div>
                        </div>                      
          </div>
            <div class="message"></div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-secondary" id="close">Fermer</button>
            <a class="btn btn-flat btn-primary btn_save" id="btn_save" data-stype='back' title="Enregistrer">
            <i class="fa fa-save"></i> Enregistrer </a>
            <span class="loading loading-hide">
              <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
              <i><?= cclang('loading_saving_data'); ?></i>
            </span>  
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </div> 
    <!-- Modal -->
         <?php endforeach; ?>
        
     </tbody>
  </table>
</div>
<script type="text/javascript">
     function appel_modal(data){
        $('#REF_DEPENSE_FILE').val(data);
        $("#myModal").modal();
      }
         $(document).ready(function(){
              $('#close').on('click',function(){

            $('#NAME_FILE').val("");
            $('#REF_DEPENSE_FILE').val("");
            $('#NUMERO_FILE').val("");
            $('#IMAGE').val("");
            $('#depense_file_PATH_FILE_name').val("");
            $('#depense_file_PATH_FILE_uuid').val("");
            $("#myModal").modal('hide');
     });

    $('.btn_save').click(function(){
        $('.message').fadeOut();
                    
        var form_depense_file = $('#form_depense_file'); 
        var data_post = form_depense_file.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/depense/edit_file/<?=$this->uri->segment(4);?>/<?=$this->uri->segment(5);?>',

          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id_PATH_FILE = $('#depense_file_PATH_FILE_galery').find('li').attr('qq-file-id');
            
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            resetForm();
            if (typeof id_PATH_FILE !== 'undefined') {
                    $('#depense_file_PATH_FILE_galery').fineUploader('deleteFile', id_PATH_FILE);
                }
            $('.chosen option').prop('selected', false).trigger('chosen:updated');
                
          } else {
            $('.message').printMessage({message : res.message, type : 'warning'});
          }
    
        })
     
        .fail(function() {
          $('.message').printMessage({message : 'Error save data', type : 'warning'});
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({ scrollTop: $(document).height() }, 2000);
        });
    
        return false;
      }); /*end btn save*/

     var params = {};
       params[csrf] = token;
     const REF_DEPENSE_FILE = $('#REF_DEPENSE_FILE').val();
       $('#depense_file_PATH_FILE_galery').fineUploader({
          template: 'qq-template-gallery',
          request: {
              endpoint: BASE_URL + '/administrator/depense/upload_PATH_FILE_file',
              params : params
          },
          deleteFile: {
              enabled: true, 
              endpoint: BASE_URL + '/administrator/depense/delete_PATH_FILE_file',
          },
          thumbnails: {
              placeholders: {
                  waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',
                  notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'
              }
          },
           session : {
             endpoint: BASE_URL + 'administrator/depense/get_PATH_FILE_file/'+REF_DEPENSE_FILE,
             refreshOnRequest:true
           },
          multiple : false,
          validation: {
              allowedExtensions: ["*"],
              sizeLimit : 0,
                        },
          showMessage: function(msg) {
              toastr['error'](msg);
          },
          callbacks: {
              onComplete : function(id, name, xhr) {
                if (xhr.success) {
                   var uuid = $('#depense_file_PATH_FILE_galery').fineUploader('getUuid', id);
                   $('#depense_file_PATH_FILE_uuid').val(uuid);
                   $('#depense_file_PATH_FILE_name').val(xhr.uploadName);
                } else {
                   toastr['error'](xhr.error);
                }
              },
              onSubmit : function(id, name) {
                  var uuid = $('#depense_file_PATH_FILE_uuid').val();
                  $.get(BASE_URL + '/administrator/depense/delete_PATH_FILE_file/' + uuid);
              },
              onDeleteComplete : function(id, xhr, isError) {
                if (isError == false) {
                  $('#depense_file_PATH_FILE_uuid').val('');
                  $('#depense_file_PATH_FILE_name').val('');
                }
              }
          }
      }); /*end PATH_FILE galery*/
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "<?= cclang('are_you_sure'); ?>",
          text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "<?= cclang('yes_delete_it'); ?>",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            document.location.href = url;            
          }
        });

      return false;
    });

  }); /*end doc ready*/
</script>


   