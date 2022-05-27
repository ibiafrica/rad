
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
        Depense        <small>Editer Depense</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/depense/index/'.$this->uri->segment(4).''); ?>">Depense</a></li>
        <li class="active">Edit</li>
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
                            <h3 class="widget-user-username">Depense</h3>
                            <h5 class="widget-user-desc">Edit Depense</h5>
                            <hr>
                        </div>
                        <?= form_open(base_url('administrator/depense/edit_save/'.$this->uri->segment(4).'/'.$this->uri->segment(5)), [
                            'name'    => 'form_depense', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_depense', 
                            'method'  => 'POST'
                            ]); ?>
                            <?php
                                foreach($depenses as $depense) {
                                    $demandeur = $depense->ACQUIT_DEPENSE;
                                    $description = $depense->DESCRIPTION_DEPENSE;
                                    $fourniture = $depense->FOURNITURE_DEPENSE;
                                }
                            ?>
                                                 <div class="form-group ">
                            <label for="ACQUIT_DEPENSE" class="col-sm-2 control-label">Par Acquit 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ACQUIT_DEPENSE" id="ACQUIT_DEPENSE" placeholder="Demandeur" value="<?= set_value('ACQUIT_DEPENSE', $demandeur); ?>">
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                <div class="form-group ">
                            <label for="DESCRIPTION_DEPENSE" class="col-sm-2 control-label">Raison 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <textarea id="DESCRIPTION_DEPENSE" name="DESCRIPTION_DEPENSE" rows="10" cols="80"> <?= set_value('DESCRIPTION_DEPENSE', $description); ?></textarea>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>
                                                 
                                                <div class="form-group ">
                            <label for="FOURNITURE_DEPENSE" class="col-sm-2 control-label">Fourniture 
                            <i class="required">*</i>
                            </label>
                            <!--<div class="col-sm-8">
                                <select  class="form-control chosen chosen-select" name="FOURNITURE_DEPENSE" id="FOURNITURE_DEPENSE" data-placeholder="selectionner fourniture" >
                                    <?php 
                                    $data = $this->model_registers->getList('pos_ibi_fourniture');
                                    foreach ($data as $row): 
                                      if($fourniture == $row['ID_FOURNITURE']){
                                        ?>
                                    <option value="<?= $row['ID_FOURNITURE']; ?>" selected><?= $row['NOM_FOURNITURE']; ?></option>

                                    <?php }else{ ?>
                                      <option value="<?= $row['ID_FOURNITURE']; ?>"><?= $row['NOM_FOURNITURE']; ?></option>
                                    <?php }
                                     endforeach; ?>  
                                    </select>
                                <small class="info help-block">
                                </small>
                            </div>
                        </div>-->
                                                 
                        <!-- <div class="form-group ">
                            <label for="MONTANT_DEPENSE" class="col-sm-2 control-label">Montant 
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="MONTANT_DEPENSE" id="MONTANT_DEPENSE" placeholder="Montant depense" value="<?= set_value('MONTANT_DEPENSE', $depense->MONTANT_DEPENSE); ?>">
                                <small class="info help-block"></small>
                            </div>
                        </div> -->
                        <!-- <div class="form-group ">
                            <label for="COMPTE_DEPENSE" class="col-sm-2 control-label">Compte depense
                            <i class="required">*</i>
                            </label>
                            <div class="col-sm-8">
                              <select  class="form-control chosen chosen-select" name="COMPTE_DEPENSE" id="COMPTE_DEPENSE" data-placeholder="selectionner compte" >
                                    <?php 
                                    $data = $this->model_registers->getList('acct_compte_comptable');
                                    foreach ($data as $row): 
                                      if($depense->COMPTE_DEPENSE == $row['CODE']){
                                        ?>
                                    <option value="<?= $row['CODE']; ?>" selected><?= $row['CODE'].' '.$row['NAME']; ?></option>

                                    <?php }else{ ?>
                                      <option value="<?= $row['CODE']; ?>"><?= $row['CODE'].' '.$row['NAME']; ?></option>
                                    <?php }
                                     endforeach; ?>  
                                    </select>
                                <small class="info help-block"></small>
                            </div>
                        </div> -->
                        <div class="compte_body">
                            <div class="box-header">
                                <label for="COMPTE_DEPENSE" class="col-sm-2 control-label">Compte depense 
                                <i class="required">*</i>
                                </label>
                                <div class="inputList">
                              <div style="display: block; position: relative;" class="col-md-8">
                                <input type="text" id="myInput" class="search-input form-control input-lg" placeholder="Rechercher par numéro de compte">
                                <div class="icon-container" hidden>
                                  <i class="loader"></i>
                                </div>
                              </div>
                              <div id="list" class="col-md-8 ml-6" hidden>
                                <ul id="myUL">
                                    <?php
                                      foreach ( $getComptes as $compte) {
                                        ?>
                                      <li><a class="articleOption" code="<?=$compte['CODE'] ?>" name="<?=$compte['NAME'] ?>"><?php echo $compte['CODE'].' - '.$compte['NAME']; ?></a></li>
                                    <?php }
                                    ?>
                                </ul>
                              </div>
                              </div>
                            </div>
                            <div class="box-body container">
                              <div class="col-md-10">
                                <table class="table table-bordered tableId" id="tableId">
                                    <thead>
                                      <tr>
                                        <td width="120">Compte</td>
                                        <td>Nom du compte</td>
                                        <td>Fourniture</td>
                                        <td width="120">Montant</td>
                                        <td width="40"></td>
                                      </tr>
                                    </thead>
                                    <tbody id="tbody_compte">
                                        <?php $sum_total = 0;
                                            foreach($depenses as $depense) {
                                            $sum_total += $depense->MONTANT_DEPENSE; ?>
                                                <tr class="<?= $depense->ID_DEPENSE ?>">
                                                    <td><input type="hidden" class="form-control" name="COMPTE_DEPENSE[]" value="<?= $depense->COMPTE_DEPENSE ?>"><?= $depense->COMPTE_DEPENSE ?></td>
                                                    <td><?= $nom = $this->db->get_where('acct_compte_comptable', array('CODE' => $depense->COMPTE_DEPENSE))->row()->NAME ?></td>
                                                    <td>
                                                        <select  class="form-control chosen chosen-select" name="FOURNITURE_DEPENSE[]" id="FOURNITURE_DEPENSE" data-placeholder="selectionner fourniture" >
                                                            <?php 
                                                            $data = $this->model_registers->getList('pos_ibi_fourniture');
                                                            foreach ($data as $row): 
                                                              if($fourniture == $row['ID_FOURNITURE']){
                                                                ?>
                                                            <option value="<?= $row['ID_FOURNITURE']; ?>" selected><?= $row['NOM_FOURNITURE']; ?></option>

                                                            <?php }else{ ?>
                                                              <option value="<?= $row['ID_FOURNITURE']; ?>"><?= $row['NOM_FOURNITURE']; ?></option>
                                                            <?php }
                                                             endforeach; ?>  
                                                            </select>
                                                    </td>
                                                    <td><input type="number" class="form-control" onkeyup="search(this)" name="MONTANT_DEPENSE[]" value="<?= $depense->MONTANT_DEPENSE ?>"></td>
                                                    <td><a class="btn btn-xs btn-danger" onclick="toDeleteModal(this)"><i class="fa fa-remove"></i></a></td>
                                                </tr>
                                           <?php }
                                         ?>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                        <td colspan="3">Total</td>
                                        <td class="sumTotal"><?= $sum_total ?></td>
                                      </tr>
                                    </tfoot>
                                </table>
                              </div>
                            </div>
                        </div>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-body">
                                  Etes-vous sur de vouloir supprimer cette depense?
                                  <input type="hidden" class="depense_id">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-danger delete">Supprimer</button>
                                </div>
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
<script src="<?= BASE_ASSET; ?>ckeditor/ckeditor.js"></script>
<!-- Page script -->
<script>
    $(document).ready(function(){
      
      CKEDITOR.replace('DESCRIPTION_DEPENSE'); 
      var DESCRIPTION_DEPENSE = CKEDITOR.instances.DESCRIPTION_DEPENSE;
                   
      $('#btn_cancel').click(function(){
        swal({
            title: "Are you sure?",
            text: "the data that you have created will be in the exhaust!",
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
              window.location.href = BASE_URL + 'administrator/depense/index/<?=$this->uri->segment(4);?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
        $('#DESCRIPTION_DEPENSE').val(DESCRIPTION_DEPENSE.getData());
                    
        var form_depense = $('#form_depense');
        var data_post = form_depense.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_depense.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#depense_image_galery').find('li').attr('qq-file-id');
            if (save_type == 'back') {
              window.location.href = res.redirect;
              return;
            }
    
            $('.message').printMessage({message : res.message});
            $('.message').fadeIn();
            $('.data_file_uuid').val('');
    
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
      
       
       $('.delete').on('click', function () {

          const depense_id = $('.depense_id').val();
   
          $.ajax({
                    url: '<?=base_url()?>/administrator/depense/delete_depense/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>',
                    method: "POST",
                    data: {depense_id:depense_id},
                    dataType: "JSON",
                    success: function (data) {
                    if (data.message == 'success') {
                      window.location.href = data.redirect;
                      }else{
                        alert("#ERROR");
                      }
                    }
                });
        });
           
    
    }); /*end doc ready*/
    var compteTable = [];
  
  function toDeleteModal(data){
    const idart = ($(data).closest('tr').attr('class'));
    $(".depense_id").val(idart);
    $('#myModal').modal('show');
  }

  function toDelete(data) {

    $(data).closest('tr').remove();
    const idex = compteTable.indexOf($(data).closest('tr').attr("id"));
    compteTable.splice(idex, 1);
    
    let table = $('#tableId tbody tr');
    let sumTotal = 0;
    for(var i=0; i<table.length; i++){
      let pr = ($(table[i]).children()[3].firstChild.value);
      nbr = parseFloat(pr);
      sumTotal = parseFloat(sumTotal);
      sumTotal += nbr;
    }
    $(".sumTotal").text(sumTotal);
  }
  let table = $('#tableId tbody tr');
  function search(data) {

    let table = $('#tableId tbody tr');
    let sumTotal = 0;
    let montant = parseFloat($(data).parent()[0].firstElementChild.value);

    for(var i=0; i<table.length; i++){
      let pr = ($(table[i]).children()[3].firstChild.value);
      nbr = parseFloat(pr);
      sumTotal = parseFloat(sumTotal);
      sumTotal += nbr;
    }
    if (montant == '') {
      $(data).closest('tr').find('td.montant input').val(0);
      if(isNaN(sumTotal)) {
        sumTotal = 0;
        sumTotal += nbr;
        // sumTotal += nbr;
      }
      $(".sumTotal").text(sumTotal);
    } else if (isNaN(montant)) {
      $(data).closest('tr').find('td.montant input').val(parseFloat(0));
      if(isNaN(sumTotal)) {
        sumTotal += nbr;
        sumTotal = 0;
        // sumTotal += nbr;
      }
      $(".sumTotal").text(sumTotal);
    } else {
      $(data).closest('tr').find('td.montant input').text(montant);
      if(isNaN(sumTotal)) {
        sumTotal += nbr;
        sumTotal = 0;
        // sumTotal += nbr;
      }
      $(".sumTotal").text(sumTotal);
    }

  }

  $(document).ready(function() {

    $("#myInput").on('keyup', function() {
      var input, filter, ul, li, a, i, txtValue;

      input = document.getElementById('myInput');
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL");
      li = ul.getElementsByTagName('li');

      if (input.value === "") {
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
    var lists = [];
    var id_lists = [];
    lists.push(<?= json_encode($depenses) ?>)
    // console.log(lists)
    for(var i in lists) {
      for(var j in lists[i]) {
        id_lists.push(lists[i][j].COMPTE_DEPENSE);
      }
    }
   
    $(".articleOption").on("click", function() {
      const code = $(this).attr("code"); 
      const name = $(this).text();

      let table = $('#tableId tbody tr');
      let sumTotal = 1;

      for(var i=0; i<table.length; i++){
        let pr = ($(table[i]).children()[2].firstChild.value);
        nbr = parseFloat(pr);
        sumTotal = parseFloat(sumTotal);
        sumTotal += nbr;
        if(isNaN(sumTotal)) {
          sumTotal += nbr;
          sumTotal = 0;
          // sumTotal += nbr;
        }
        names = ($(table[i]).children()[1].firstChild.textContent);
        compteTable.push(names);
      }
      // console.log(id_lists);
      var name_view = name.substring(name.lastIndexOf( "-" )+1 )
      
      if (compteTable.indexOf(name_view) > -1) {
        alert("Ce compte existe deja dans le tableau");
      } 
      else if(id_lists.indexOf(code) > -1) {
        alert("Ce compte existe deja dans le tableau");
      }
       else {
        const quantRest = $(this).attr("quantRest");
        $("#list").attr("hidden", 'true');
        let row = `<tr id="${code}">`;
        row += `<td>
                  <input type="hidden" name="COMPTE_DEPENSE[]" value="${code}">${code}
                </td>
                <td>${name_view}</td>
                <td class="fourniture">
                    <select  class="form-control chosen chosen-select" name="FOURNITURE_DEPENSE[]" id="FOURNITURE_DEPENSE" data-placeholder="Selectionner le fourniture" >
                        <option value=""></option>
                        <?php 
                          $data = $this->model_registers->getList('pos_ibi_fourniture');

                        foreach ($data as $row): ?>
                        <option value="<?= $row['ID_FOURNITURE']; ?>"><?= $row['NOM_FOURNITURE']; ?></option>
                        <?php endforeach; ?>  
                    </select>
                    </td>
                <td class="montant"><input onkeyup="search(this)" type="text" id="MONTANT_DEPENSE" class="form-control" name="MONTANT_DEPENSE[]" value="0" >
                </td>
                <td><button class="btn btn-danger btn-xs" onclick="toDelete(this)"><i class="fa fa-remove"></i></button>
                </td>`;
        row += `</tr>`;

        $("#tbody_compte").prepend(row);
        $(".sumTotal").text(sumTotal);
        $("#myInput").val("");
        $("#MONTANT_DEPENSE").focus();
        compteTable.push(name_view);
      }
    });
    

    /*document ready*/
});
</script>
<style type="text/css">
.icon-container {
  position: absolute;
  right: 5px;
  top: calc(40% - 5px);
}
.icon-container1 {
  position: absolute;
  right: 5px;
  top: calc(40% - 5px);
}
.loader {
  position: relative;
  height: 20px;
  width: 20px;
  display: inline-block;
  animation: around 5.4s infinite;
}

@keyframes around {
  0% {
    transform: rotate(0deg)
  }
  100% {
    transform: rotate(360deg)
  }
}

.loader::after, .loader::before {
  content: "";
  background: white;
  position: absolute;
  display: inline-block;
  width: 100%;
  height: 100%;
  border-width: 2px;
  border-color: #333 #333 transparent transparent;
  border-style: solid;
  border-radius: 20px;
  box-sizing: border-box;
  top: 0;
  left: 0;
  animation: around 0.7s ease-in-out infinite;
}

.loader::after {
  animation: around 0.7s ease-in-out 0.1s infinite;
  background: transparent;
}
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
  #select_type{
    width: 100%;
    height: 100%;
  }
  /*.compte_body{
    display: flex;
    justify-content: center;
    align-conten: block;
  }*/
  .inputList, .compte-body{
    display: flex;
    flex-direction: column;
  }
  /*.box-header #list {
    margin-left: 15px;
  }*/
</style>