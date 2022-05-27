


<style>


    .container {
        position: relative;
        height: 1em;
    }

    select {
        position: absolute;
    }

    .btn {
        border-radius: 0px !important;
    }

    .form-control {
      border-radius: 0px !important;
    }
</style>


<?php $stores =$this->uri->segment(2); ?>

<section class="content-header">
    <h1>
        Control stock <small> ajout control du stock
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="<?= site_url('control_stock/'.$stores.'/index'); ?>">Control</a>
        </li>
        <li class="active">add
        </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">

                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                            <form class="form-horizontal" name="form_hospital_ibi_articles" id="form_hospital_ibi_articles" action="<?= base_url('control_stock/'.$stores.'/add'); ?>">

                                <div class="widget-user-header jumbotron ">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="col-md-1"></div>


                                           <div class="col-md-4">
                                          <label for="opening_start">DATE DU CONTROL PRECEDENT <i class="fa fa-calendar"></i></label>
                                          <?php if ($last_control) : ?>
                                            <input readonly autocomplete="off" type="text" class="form-control dateTimePicker_add" id="opening_start" name="opening_start" value="<?= $date_opening ?>">
                                          <?php else : ?>
                                            <input autocomplete="off" type="text" class="form-control dateTimePicker_add" id="opening_start" value="<?= $date_opening ?>">
                                          <?php endif; ?>
                                        </div>

                                        <div class="col-md-4">
                                          <label for="opening_close"> DATE ACTUELLE DU CONTROL <i class="fa fa-calendar"></i></label>
                                          <?php if ($last_control) : ?>
                                            <input autocomplete="off" type="text" class="form-control dateTimePicker_add" id="opening_close" name="opening_close" value="<?= $date_close ?>">
                                          <?php else : ?>
                                            <input readonly autocomplete="off" type="text" class="form-control dateTimePicker_add" id="opening_close" name="opening_close" value="<?= $date_close ?>">
                                          <?php endif; ?>
                                        </div>    

                                           <div class="col-md-3">
                                               <br>
                                              <button type="submit" name="name" class="btn btn-default"><i class="fa fa-refresh"></i>
                                                </button>

                                                <a href="<?= site_url('control_stock/'.$stores.'/print_controle'); ?>" class="btn btn-default"><i class="fa fa-row">Imprimer articles</i></a>
                                                 <!--  -->
                                           </div>
                                         </div>
                                     </div>

                                    
                                </div> 
                            </form>


                           <div class="row">
                            
                            <div class="table-responsive"> 
                             <table class="table table-responsive table-hover table-bordered" id="headerTable">
                                <thead>
                                    
                                    <tr style="background-color:rgba(0, 0, 0,0.1);">
                                        <th>No</th>
                                        <th>Designation</th>
                                        
                                        <th class="" >Opening_quantite.</th>
                                        <th class="">Issues_quantite.</th>
                                        <th class="">ToT. Openig</th>
                                        <!-- <th width="300">Prix achat</th> -->
                                        <!-- <th width="300">Tot. achat</th> -->
                                        <th class="">Qte. vente</th>
                                        <!-- <th width="300">ToT.vente</th> -->
                                        <th class="">Rest.Aut</th>
                                        <th class="">Rest.Man</th>
                                        <!-- <th width="300">Val.stock</th> -->

                                        <!-- <th width="300">Action</th> -->
                                        
                                    </tr>
                                </thead>

                                <tbody>
                              <?= form_open('', [
                                      'name'    => 'form_control_stock',
                                      'class'   => 'form-horizontal',
                                      'id'      => 'form_control_stock',
                                      'enctype' => 'multipart/form-data',
                                      'method'  => 'POST'
                                    ]); ?>

          <?php $N=0; foreach ($flow_interval as $itemsFlow): $N++;

                

            ?>
        <tr>
       <td> <?= $N;?> </td>
       <!-- <td> Name</td> -->
            <td width="400"><?= $itemsFlow['details']->ART;?>
              <input type="hidden" name="opening_start" id="opening_start" class="form-control" value="<?= $date_opening ?>">
             <input type="hidden" name="opening_close" id="opening_close" class="form-control" value="<?= $date_close ?>"> 
              <input type="hidden" name="ARTICLES[]" id="ARTICLES" class="form-control" value="<?= $itemsFlow['details']->ART;?>"> 
              <input type="hidden" name="CODEBAR[]" id="CODEBAR" class="form-control" value="<?= $itemsFlow['details']->CODE;?>">
            </td>

           <td class="">

           <?php if ($response >0) { ?>

             <input type="number" readonly name="OPENING[]" id="OPENING" class="form-control" value="<?= $itemsFlow['details']->PREV_OPENING;?>"> 
               
          <?php }else{ ?> 
             <input type="number" name="OPENING[]" id="OPENING" class="form-control" value="<?= $itemsFlow['details']->PREV_OPENING;?>"> 
          <?php } ?> 
             
           </td>
           <td class=""> 
            <input type="text" readonly class="form-control" name="ISSUES_TRANS[]" id="ISSUES_TRANS" value="<?= intval($itemsFlow['stockIssue']);?>" >
           </td>
           <td class=""> 
             <input type="text" class="form-control" name="TOT_OPEN_ISSUE[]" id="TOT_OPEN_ISSUE" value="0" width="20" readonly>
           </td>

           <td class="hidden ">
             <input type="hidden" class="form-control" name="PRIX_ACHAT[]" id="PRIX_ACHAT" value="<?= $itemsFlow['details']->P_A;?>" readonly>
           </td>
           
           <td class="hidden "> 
             <input type="text" class="form-control" name="ACHAT_TOT[]" id="ACHAT_TOT" value="0" readonly> 
           </td>
            <td class="">
              <input type="number" class="form-control" name="QTE_VENTE[]" id="QTE_VENTE" value="<?= number_format($itemsFlow['qteSale']);?>" readonly> 
            </td">
           <td class="hidden ">
              <input type="number" class="form-control" name="TOT_VENTE[]" id="TOT_VENTE" value="0" readonly> 
           </td">
           <td class="">
              <input type="number" class="form-control" name="RESTE_AUTO_VENTE[]" id="RESTE_AUTO_VENTE" value="0" readonly>
           </td>
            <td class="">
                <input type="number" class="form-control" name="RESTE_MAN_VENTE[]" id="RESTE_MAN_VENTE" value="0">
            </td">

            <td width="140" class="hidden ">
                <input type="number" class="form-control" name="VALUE_STOCK[]" id="VALUE_STOCK" value="0" readonly>
            </td">
          
        </tr>   
        
        <?php endforeach ?>
                                 
                                  
                                </tbody>

                                </table> 
                            </div>

                            


<!--             <div style="width: 100%; margin-bottom: 10px" >
 -->               <div class="row ">
                   <div class="col-md-12">
                       <div class="col-md-6">
                          <!--  <label for="">TITRE</label>
                           <input type="text" class="form-control" name="TITRE" id="TITRE" placeholder="Titre Control"> -->
                       </div>

                       <div class="col-md-6">
                           <label for="">DESCRIPTION</label>
                           <textarea placeholder="Description" name="DESCRIPTION" id="DESCRIPTION" rows="3" class="form-control"></textarea>
                       </div>
                   </div>
               </div>

            <div class="message"></div>

            <div class="">

              <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="soumission du control"> <i class="fa fa-floppy-o"></i> Soumettre le control</a>
              <span class="loading loading-hide">
                <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">
                <i><?= cclang('loading_saving_data'); ?></i>
              </span>
            </div>

        <?php form_close();?>

                                     <div class="row">
                  <div class="col-md-8">

                  </div>
                  
                  <div class="col-md-4">
                     <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
                     </div>
                  </div>
               </div>
                                 
                                  
                                         

                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    <!--/box -->
    </div>
    </div>
</section>


<script type="text/javascript">
$(".dateTimePicker_add").datetimepicker({
        maxDate: new Date(),
        maxDateTime:new Date().getTime(),
        format: "Y-m-d H:i:s",
        autoclose: true,
        todayBtn: true,
        startDate: "Y-m-d H:i:s",
        step: 1
    });

$(".dateTimePicker_end").datetimepicker({
        // maxDate: new Date(),
        // maxDateTime:new Date().getTime(),
        format: "Y-m-d H:i:s",
        autoclose: true,
        todayBtn: true,
        startDate: "Y-m-d H:i:s",
        step: 1
    });
</script>



<script type="text/javascript">
    
    $(document).on('keyup','#OPENING',function(){
        let TOT = 0
        let  TOT_OPN_ACH =0;
        let TOT_VENTE =0;
        let RESTE_AUTO_VENTE=0;

        let PRIX_ACHAT = $(this).closest('tr').find('#PRIX_ACHAT').val();
        let QTE_VENTE = $(this).closest('tr').find('#QTE_VENTE').val();
        let OPENING = $(this).closest('tr').find('#OPENING').val();
        let QT_ISSUE = $(this).closest('tr').find('#ISSUES_TRANS').val();
        let RESTE_MAN_VENTE = $(this).closest('tr').find('#RESTE_MAN_VENTE').val();

        TOT = parseInt(OPENING)+parseInt(QT_ISSUE);
        TOT_OPN_ACH= TOT* PRIX_ACHAT;
        TOT_VENTE = PRIX_ACHAT*QTE_VENTE;
        RESTE_AUTO_VENTE=TOT-QTE_VENTE;

        $(this).closest('tr').find('#ACHAT_TOT').val(TOT_OPN_ACH);
        $(this).closest('tr').find('#TOT_OPEN_ISSUE').val(TOT);
        $(this).closest('tr').find('#TOT_VENTE').val(TOT_VENTE);
        $(this).closest('tr').find('#RESTE_AUTO_VENTE').val(RESTE_AUTO_VENTE);


      });

    $(document).on('keyup','#RESTE_MAN_VENTE',function(){
        let VALUE_ST =0;

        let RESTE_MAN_VENTE = $(this).closest('tr').find('#RESTE_MAN_VENTE').val();
        let PRIX_ACHAT = $(this).closest('tr').find('#PRIX_ACHAT').val();

        VALUE_ST = PRIX_ACHAT * RESTE_MAN_VENTE;
        $(this).closest('tr').find('#VALUE_STOCK').val(VALUE_ST);



    })
</script>

<!-- /.content -->
<script type="text/javascript">
    var element = document.querySelector('select');

    element.addEventListener('mousedown', function() {
        this.size = 10;
    });
    element.addEventListener('change', function() {
        this.blur();
    });
    element.addEventListener('blur', function() {
        this.size = 0;
    });

    function printDiv(divName) {

        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        const entete = `<div style="margin-bottom: 3rem"><p><strong>CLUB 144 PLUS</strong></p>
                              <p>QUARTIER: KABONDO</p>
                              <p>AVENUE: RUKONYWE</p></div>`
        const header = $("#header").html();
        document.body.innerHTML = `${entete} ${header} </br> ${printContents}`;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>






<script type="text/javascript">
    


    $('.btn_save').click(function() {
      $('.message').fadeOut();


    var form_control_stock = $('#form_control_stock');
    var data_post = form_control_stock.serializeArray();
    var save_type = $(this).attr('data-stype');
    const dateOpening = $("#opening_start").val();
    const dateClosing = $("#opening_close").val();

    //alert(dateClosing)

    data_post.push({
      name: 'save_type',
      value: save_type
    });

    data_post.push([{
      name: 'date_opening',
      value: dateOpening
    }, {
      name: 'date_closing',
      value: dateClosing
    }])
      //console.log(data_post);

      $('.loading').show();
      let prefix = '<?php echo  $this->uri->segment(2); ?>';
      // alert(prefix);return false;

      $.ajax({
          url: BASE_URL + 'administrator/control_stock/add_save/' + prefix,
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if (res.success) {

            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }

            $('.message').printMessage({
              message: res.message
            });
            $('.message').fadeIn();
            resetForm();
            $('.chosen option').prop('selected', false).trigger('chosen:updated');

          } else {
            $('.message').printMessage({
              message: res.message,
              type: 'warning'
            });
          }

        })
        .fail(function() {
          $('.message').printMessage({
            message: 'Error save data',
            type: 'warning'
          });
        })
        .always(function() {
          $('.loading').hide();
          $('html, body').animate({
            scrollTop: $(document).height()
          }, 2000);
        });

      return false;
    }); /*end btn save*/





</script>

