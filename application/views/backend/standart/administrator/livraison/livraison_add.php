
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
        Livraison        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/livraison/index/'.$this->uri->segment(4).''); ?>">Livraison</a></li>
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
                        <div class="widget-user-header ">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Livraison</h3>
                            <h5 class="widget-user-desc">Nouvelle livraison</h5>
                            <hr>
                        </div>
                        <?= form_open('', [
                            'name'    => 'form_livraison', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_livraison', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>                         
                                    

                <div class="row-fluid">
                    <div class="col-md-12">
                            <div class="form-group">
                              <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher la réquisition">
                                <div id="list" hidden>
                                  <ul id="myUL">
                                        <?php
                                          foreach ( $getRequisition as $requisition) { 
                                            ?>
                                            <li><a class="articleOption" id="<?=$requisition['NUMERO_REQUISITION'];?>" ><?php echo $requisition['NUMERO_REQUISITION'];?></a></li>

                                        <?php }
                                        ?>
                                      </ul>
                                </div>
                            </div>
                      </div> 
                    </div>
                    <div class="col-md-12">
      <caption><span id="error"></span></caption>
            <div class="box">
                <div class="box-header" style="text-align: center">Liste des articles</div>
                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td width="30"></td>
                                <td width="200">Codebarre</td>
                                <td>Article</td>
                                <td width="150">Quantité</td>
                                <td width="50"></td>
                            </tr>
                        </thead>
                        <tbody id="tableId">
                        </tbody>
                      </table>
                    </div>
            </div>
        </div>
                                                 
                                               
                                                 
                                               
                                                 
                                                
                                                 
                         
                         
                        
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
  function avoid_multi_click_btn(btn_id, period) {
    $('.' + btn_id).attr('disabled', true);
    var my_interval = setInterval(function() {
    $('.' + btn_id).attr('disabled', false);
      clearInterval(my_interval);
    }, period);
  }
    $(document).ready(function(){
                   
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
              window.location.href = BASE_URL + 'administrator/livraison/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){

        $('.message').fadeOut();

        swal({
          title: "Etes-vous sur de vouloir",
          text: "Effectuer une livraison du client ?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Oui, livrer",
          cancelButtonText: "<?= cclang('no_cancel_plx'); ?>",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {          
            
        var form_livraison = $('#form_livraison');
        var data_post = form_livraison.serializeArray();
        // var save_type = $(this).attr('data-stype');
        var save_type = "back";

        data_post.push({name: 'save_type', value: save_type});

        avoid_multi_click_btn('btn_save', 25000);
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/livraison/add_save/<?=$this->uri->segment(4);?>',
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
      }); /*end btn save*/
      
       
 
       
    
    
    }); /*end doc ready*/
</script>
<script type="text/javascript">
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
  function CheckUncheckOne(data){
    
    const refproduit = $(data).closest('tr').attr("refproduit");
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const quantRest = stringToNumber($(data).closest('tr').find("td.quantRest").text());
    const quantRestArticle = stringToNumber($(data).closest('tr').find("td.quantRestArticle").text());

    if(initial < 1){
      alert("La quantité restante du produit sur cette requisition est épuiser.")
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
    if(quantRest > quantRestArticle){
      alert("La quantité restante du produit dans le stock n'est pas suffisante. Veuillez ajuster la quantité en stock.")
      return document.getElementById("checkbox"+refproduit+"").checked = false;
    }
  }

  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
  function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
    }
  }

  function plus(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const qty = initial + 1;
    if(qty>quantRest){
      alert("La quantité restante du produit sur cette requisition n'est pas suffisante.");
    }else{
      $(data).closest('tr').find('td div input').val(qty);
    }
  }
  function search(data){
    const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
 
    if(quantRest<initial){
      alert("La quantité restante du produit sur cette requisition n'est pas suffisante.");
      $(data).closest('tr').find('td div input').val(quantRest);
    }else{
      $(data).closest('tr').find('td div input').val(initial);
    }
    }

    $(document).ready(function(){

    var combobox = document.getElementById("combobox");
    var articleOption = document.getElementsByClassName("articleOption");
    
    $("#myInput").on('keyup', function(){
      var input, filter, ul, li, a, i, txtValue;

      input = document.getElementById('myInput');
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL");
      li = ul.getElementsByTagName('li'); 

      if(input.value === ""){
        $("#list").attr("hidden", 'true');
      } else {
        $("#list").removeAttr("hidden");
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByTagName("a")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";
          }
        }
      }
    });

    $(".articleOption").on("click", function(){

            const requisition = $(this).attr("id");
            
            $.ajax({
                url: BASE_URL + '/administrator/livraison/add_/<?=$this->uri->segment(4);?>',
                type: 'POST',
                data:{requisition:requisition},
                dataType:'json',
                success:function(data){
                $('#tableId').html(data.tableau);
                $("#myInput").val("");
                $("#list").attr("hidden", 'true');
                }
            });
           
        });

});
</script>
<style type="text/css">
  #myUL {
    /* Remove default list styling */
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  #myUL li a {
    border: 1px solid #ddd; /* Add a border to all links */
    margin-top: -1px; /* Prevent double borders */
    background-color: #f6f6f6; /* Grey background color */
    padding: 12px; /* Add some padding */
    text-decoration: none; /* Remove default text underline */
    font-size: 18px; /* Increase the font-size */
    color: black; /* Add a black text color */
    display: block; /* Make it into a block element to fill the whole list */
  }
  
  #myUL li a:hover:not(.header) {
    background-color: #eee; /* Add a hover effect to all links, except for headers */
  }
</style>