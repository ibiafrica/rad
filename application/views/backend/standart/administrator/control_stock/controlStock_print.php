

<script>
  $(document).on('click', '#btnprint', function() {
    // let data=$('#mytable').html();
    // $('.trdata').html(data);
    window.print();
  })
</script>
<style>

@media print {
  #printPageButton,.main-footer,.btn_action,.imp{
    display: none;

  }

  th,td{
    border: 1px solid #000 !important;
    
   
}
}


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
        Control stock <small> 
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
                       

                           <div class="row">
                            <div class="col-md-12">
                             <div class="col-md-10">
                                 <h4>FICHE DE CONTROLE STOCK<p><?= settings_address()['NOM_PARAMS']; ?></p></h4>
                             </div>
                             <div class="col-md-2 imp">
                                 <button id="btnprint" title="" type="button" class="btn btn-primary"><i class="fa fa-print"> Imprimer</i></button>
                             </div>
                            
                        </div>
                            <div class="col-md-12 table-responsive"> 
                             <table class="table table-responsive table-bordered table-condensed" id="headerTable"> 
                                <thead>
                                    <tr style="border:1px solid #aaa!important;">
                                    <td style="border:1px solid #aaa!important;" colspan="2">Stock :  <b><?php echo $stock = $this->db->query('SELECT * FROM pos_ibi_stores WHERE STATUS_STORE="opened" AND ID_STORE='.$stores)->row()->NAME_STORE; ?></b></td>
                                        <td style="border:1px solid #aaa!important;" width="300">H. ouverture :</td>
                                        <td style="border:1px solid #aaa!important;" width="300">Transferts</td>
                                        <td style="border:1px solid #aaa!important;" width="300">H. fermeture :</td>
                                    </tr>
                                    <tr style="background-color:rgba(0, 0, 0,0.1);">
                                        <th style="border:1px solid #aaa!important;">No</th>
                                        <th style="border:1px solid #aaa!important;">Designation</th>
                                        <th style="border:1px solid #aaa!important;" class="">Quantité</th>
                                        <th style="border:1px solid #aaa!important;" class="">Quantité</th>
                                        <th style="border:1px solid #aaa!important;" class="">Quantité</th>
                                        
                                        
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

          <?php $N=0; foreach ($print_controllers as $items): $N++;

                

            ?>
        <tr>
       <td style="border:1px solid #aaa!important;"> <?= $N;?> </td>
       <!-- <td> Name</td> -->
            <td style="border:1px solid #aaa!important;" width="400"><?= $items->DESIGN_ARTICLE;?>
              
            </td>

            <td style="border:1px solid #aaa!important;" class=""></td>

            <td style="border:1px solid #aaa!important;" class=""></td>

            <td style="border:1px solid #aaa!important;" class=""></td>
          
        </tr>   
        
        <?php endforeach ?>
                                 
                                  
                                </tbody>

                                </table> 
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

      data_post.push({
        name: 'save_type',
        value: save_type
      });
      console.log(data_post);

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

