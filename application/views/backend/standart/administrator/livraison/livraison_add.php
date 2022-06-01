
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
    function domo(){
     
       // Binding keys
       $('*').bind('keydown', 'Ctrl+s', function assets() {
          $('#btn_save').trigger('click');
           return false;
       });
    
       $('*').bind('keydown', 'Ctrl+x', function assets() {
          $('#btn_cancel').trigger('click');
           return false;
       });
    
      $('*').bind('keydown', 'Ctrl+d', function assets() {
          $('.btn_save_back').trigger('click');
           return false;
       });
        
    }
    
    jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Livraison        <small><?= cclang('new', ['Livraison']); ?> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/livraison'); ?>">Livraison</a></li>
        <li class="active"><?= cclang('new'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <?= form_open('', [
                            'name'    => 'form_livraison', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_livraison', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                            <div class="row">
                              <div class="col-md-12">
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="id_fiche" class="col-sm-2 control-label">Nom du client
                                        </label>
                                        <div class="col-sm-10">
                                            <select id="id_client" name="client" class="form-control chosen chosen-select-deselect">
                                                <option value=""></option>
                                                <?php 
                                                    $clients = $this->db->query("SELECT ID_CLIENT, NOM_CLIENT FROM clients INNER JOIN bon_livraison ON clients.ID_CLIENT = bon_livraison.REF_CLIENT_BL GROUP BY clients.ID_CLIENT");
                                                    foreach ($clients->result() as $client) {
                                                    ?>
                                              <option value="<?=$client->ID_CLIENT ?>"><?= $client->NOM_CLIENT ?></option>
                                                <?php  
                                                  } ?> 
                                          </select>
                                          
                                            <small class="info help-block">
                                            </small>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                              <div class="box">
                                <div class="box-header" style="text-align: center">Liste des articles</div>
                                <div class="box-body no-padding">
                                    <table class="table table-bordered table-striped" id="tableId">
                                        <thead>
                                            <tr>
                                                <td width="30"></td>
                                                <td width="">Code bon livraison</td>
                                                <!-- <td>Status</td> -->
                                                <td width="">Date creation</td>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id='test'>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                                                
                        <br>
                        <div class="message"></div>
                        <div class="row-fluid col-md-7">
                           <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">
                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>
                            </button>
                            <a class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">
                            <i class="ion ion-ios-list-outline" ></i> <?= cclang('save_and_go_the_list_button'); ?>
                            </a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">
                            <i class="fa fa-undo" ></i> <?= cclang('cancel_button'); ?>
                            </a>
                            <span class="loading loading-hide">
                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                            <i><?= cclang('loading_saving_data'); ?></i>
                            </span>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<!-- Page script -->
<script>

  var articleTable = [];

  function getRidOfTheComma(data){
      var toReturn = "";
      var toFilter = data.split("");
      const toMakeString = toFilter.filter(element => element !== ",");
      const times = toMakeString.length;
      for(i=0; i<times; i++){
          toReturn += toMakeString[i];
      }
      return toReturn;
  }

  function stringToNumber(data){
      var toReturn = 0;
      var toMakeInt = "";
      if(data === ""){
          return toReturn;
      } else {
          toMakeInt = getRidOfTheComma(data);
          toReturn = parseFloat(toMakeInt);
          return toReturn;
      }
  }

  let bl_data = [];
  function CheckUncheckOne(data){

    const ref_bl = $(data).closest('tr').attr("ref_bl");

    bl_data.push(bl=ref_bl);

    const initial = $(data).closest('tr').find('td div input').val();

    console.log(bl_data)
    return bl_data;
    // const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    // const quantRestArticle = stringToNumber($(data).closest('tr').find("td.quantRestArticle").text());
   
    // if(initial <= 0){
    //   alert("La quantité restante du produit sur cette fiche est épuiser.")
    //   return document.getElementById("checkbox"+ref_bl+"").checked = false;
    // }
    // if(initial > quantRestArticle){
    //   alert("La quantité restante du produit dans le stock n'est pas suffisante. Veuillez ajuster la quantité en stock.")
    //   return document.getElementById("checkbox"+refproduit+"").checked = false;
    // }
  }

  function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);
    var my_interval = setInterval(function() {
    $('.' + btn_id).attr('disabled', false);
      clearInterval(my_interval);
    }, period);
  }

    $(document).ready(function(){

      // $(document).ready(function(){
                   
        $('#btn_cancel').click(function(){
          swal({
              title: "Etes-vous sûr",
              text: "Les données que vous supprimez ne peuvent pas être restaurées!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Oui!",
              cancelButtonText: "Non!",
              closeOnConfirm: true,
              closeOnCancel: true
            },
            function(isConfirm){
              if (isConfirm) {
                window.location.href = BASE_URL + 'administrator/livraison';
              }
            });
      
          return false;
        }); /*end btn cancel*/
                 
        $('.btn_save').click(function(){
      
                avoid_multi_click_btn('btn_save', 25000);
      
                $('.message').fadeOut();
      
                swal({
                  title: "Etes-vous sur de vouloir",
                  text: "Effectuer une sortie des articles de la fiche ?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "oui sortez-le",
                  cancelButtonText: "no annuler plx",
                  closeOnConfirm: true,
                  closeOnCancel: true
                },
              function(isConfirm){
                if (isConfirm) {
                  
                  var form_bon_sortie = $('#form_livraison');
                  var data_post = form_bon_sortie.serializeArray();
                  // var save_type = $(this).attr('data-stype');
                  var save_type = "back";

                  data_post.push({name: 'bl_data', value: bl_data})
                  data_post.push({name: 'save_type', value: save_type});
                  // data_post.push.apply(data_post, bl_data);

                  // console.log(data_post);
                  // return

      
                  avoid_multi_click_btn('btn_save', 25000);
              
                  $('.loading').show();
              
                  $.ajax({
                    url: BASE_URL + '/administrator/livraison/add_save',
                    type: 'POST',
                    dataType: 'json',
                    data: data_post,
                  })
                  .done(function(res) {
                    if(res.success) {
                      
                      if (save_type == 'back') {
                        window.location.href = res.redirect;
                        return;
                      }
              
                      $('.message').printMessage({message : res.message});
                      $('.message').fadeIn();
                      resetForm();
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
      
                }/*end click pop*/
              });
          
              return false;
        });

      $('#id_client').on('change',function(){ 
            var id_client=$('#id_client').val();

            // console.log(id_client)
            $.ajax({
                url: BASE_URL + '/administrator/livraison/add_',
                method:'POST',
                data:{id_client:id_client},
                dataType:'json',

                success:function(data){ 
                  $('#test').html(data.tableau);
                  // console.log(data)
                }
            });
      });
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "<?= cclang('are_you_sure'); ?>",
            text: "<?= cclang('data_to_be_deleted_can_not_be_restored'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = BASE_URL + 'administrator/livraison';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      
       
 
       
    
    
    }); /*end doc ready*/
</script>
<!-- <script>
  let tbl_all = [];
  function getCode(th)
  {
    let data_code = th.getAttribute('data');
    // console.log(data_code)
    tbl_all.push(data_code)

    console.table(tbl_all)
  }
</script> -->