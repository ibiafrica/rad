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
        Transfert des produits     <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/transfert_items/index/'.$this->uri->segment(4).''); ?>">Liste</a></li>
        <li class="active"><?= cclang('new'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                    <?= form_open('', [
                            'name'    => 'form_ibi_transfert_items', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'insert_form', 
                            'enctype' => 'multipart/form-data', 
                            'method'  => 'POST'
                            ]); ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">Envoyer à</div>
                                    <select name="store_id"  type="text" class="form-control store_id">
                                        <option value=""></option>
                                            <?php 
                                                $store = $this->model_dashboard->getRequete('SELECT ID_STORE,NAME_STORE FROM pos_ibi_stores WHERE ID_STORE!='.$this->uri->segment(4).'');
                                                foreach ($store as $keyvalue) {
                                            ?>
                                            <option value="<?=$keyvalue['ID_STORE']?>"><?=$keyvalue['NAME_STORE']?></option>

                                            <?php } ?> 
                                    </select>

                                </div>
                                <p class="help-block">Sélectionnez l'endroit où vous souhaitez envoyer le transfert.</p>
                            </div>        
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">Famille</div>
                                    <select name="famille"  type="text" class="form-control famille">
                                    </select>
                                </div>
                            </div>        
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">Categorie</div>
                                    <select name="categorie"  type="text" class="form-control categorie">
                                    </select>
                                </div>
                            </div>        
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="box-header">
                                
                                  <input class="search-input form-control input-lg barcode-field" id="search_text" type="text" placeholder="Rechercher le nom du produit, le code barre">
                                   <div id="list" hidden>
                                    <ul id="myUL">
                                    <?php
                                    foreach ( $getProduit as $articles) { ?>
                                       <li><a class="articleOption" id="<?=$articles['ID_ARTICLE']?>" article="<?=$articles['CODEBAR_ARTICLE'] ?>" unit="<?=$articles['POIDS_ARTICLE'] ?>" design="<?=$articles['DESIGN_ARTICLE'] ?>" price="<?=$articles['PRIX_DE_VENTE_ARTICLE'] ?>"><?php echo $articles['DESIGN_ARTICLE'].' - '.$articles['CODEBAR_ARTICLE']; ?></a>
                                       </li>
                                    <?php } ?>
                                    </ul>
                                   </div>
                                </div>
                            </div>
                  
                            <div class="box">
                                <div class="box-header" style="text-align: center">Liste des articles</div>
                                <div class="box-body no-padding">
                                    <table class="table table-bordered table-striped" id="tableId">
                                        <thead>
                                            <tr>
                                                <td>Nom de l'article</td>
                                                <td>Prix de vente</td>
                                                <td width="150">Quantité</td>
                                                <td width="200">Total</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="length">
                                                <td colspan="5" class="text-center">Aucun article n'a été ajouté</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer">
                                    <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back'>
                                      <i class="ion ion-ios-list-outline" ></i>Enregistrer et retourner à la liste
                                    </a>
                                    <span class="loading loading-hide">
                                    <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
                                    <i><?= cclang('loading_saving_data'); ?></i>
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                    <div class="message"></div>
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
    $(document).ready(function(){

        $('.store_id').change(function(){
        var store_id = $(this).val();
        $.ajax({
                url: BASE_URL + '/administrator/transfert_items/select_famille/<?=$this->uri->segment(4);?>',
                type: 'POST',
                async:false,
                dataType: 'json',
                data: {store_id:store_id},
                success:function(data)
                {  
                $('.famille').html(data);               
                }
            });
       });
       $('.famille').change(function(){
        window.store_id = $('.store_id').val();
        var famille = $(this).val();
        $.ajax({
                url: BASE_URL + '/administrator/transfert_items/select_categorie/'+store_id,
                type: 'POST',
                async:false,
                dataType: 'json',
                data: {famille:famille},                                                         
                success:function(data)
                {  
                $('.categorie').html(data);               
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
              window.location.href = BASE_URL + 'administrator/transfert_items/index/<?=$this->uri->segment(4)?>';
            }
          });
    
        return false;
      }); /*end btn cancel*/
    
      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_ibi_transfert_items = $('#insert_form');
        var data_post = form_ibi_transfert_items.serializeArray();
        var save_type = $(this).attr('data-stype');

        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: BASE_URL + '/administrator/transfert_items/add_save/<?=$this->uri->segment(4)?>',
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
  function toDelete(data){
    $(data).closest('tr').remove();
    const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
    articleTable.splice(idex, 1);
  }
   function moins(data){
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial - 1;
    if(qty <= 0){
      $(data).closest('tr').remove();
      const idex = articleTable.indexOf($(data).closest('tr').attr("id"));
      articleTable.splice(idex, 1);
    } else {
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    }
  }
    function plus(data){
    // const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    const qty = initial + 1;
    // if(qty>quantRest){
    //   alert("La quantité restante du produit n'est pas suffisante.");
    // }else{
      $(data).closest('tr').find('td div input').val(qty);
      $(data).closest('tr').find('td.total').text(price * qty);
    // }
  } 
  function search(data){
    // const quantRest = $(data).closest('tr').find("td.quantRest").text();
    const initial = stringToNumber($(data).closest('tr').find('td div input').val());
    const price = stringToNumber($(data).closest('tr').find('td.price').text());
    // if(quantRest<initial){
    //   alert("La quantité restante du produit n'est pas suffisante.");
    //   $(data).closest('tr').find('td div input').val(quantRest);
    //   $(data).closest('tr').find('td.total').text(price * quantRest);
    // } 
    if(initial <= 0){
        $(data).closest('tr').find('td div input').val(1);
        $(data).closest('tr').find('td.total').text(price * 1);
    }else{
        $(data).closest('tr').find('td div input').val(initial);
        $(data).closest('tr').find('td.total').text(price * initial);
    }
    
}
    $(document).ready(function(){

    var articleOption = document.getElementsByClassName("articleOption");

    $("#search_text").on('keyup', function(){
      var input, filter, ul, li, a, i, txtValue;

      input = document.getElementById('search_text');
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
      const quantRest = $(this).attr("quantRest");
      const articleId = $(this).attr("id");
      const article = $(this).attr("article");
      const price = $(this).attr("price");
      const unit = $(this).attr("unit");
      const design = $(this).attr("design");
      const name = $(this).text();
      if(price < 0){
        alert("Ajuster le prix de vente du produit.");
      }else{
      if(articleTable.indexOf(name) > -1){
        alert("Cet produit existe deja dans le tableau");
      }else {
      $("#list").attr("hidden", 'true');
        let row = "<tr id="+articleId+">";
        row += '<td style="line-height: 35px;" class="article"><input type="hidden" name="article[]" value="'+article+'"><input type="hidden" name="design[]" value="'+design+'">'+name+'</td>';
        row += '<td style="line-height: 35px;" class="price"><input type="hidden" name="price[]" value="'+price+'"/>'+price+'</td>'
        row += '<td><div class="input-group inpuut-group-sm">';
        row += '<span class="input-group-btn">';
        row += '<button type="button" class="btn btn-default moins" onclick="moins(this)"><i class="fa fa-minus"></i></button>';
        row += '</span>';
        row += '<input type="text" name="search[]" class="form-control search" onkeyup="search(this)" value="1">';
        row += '<span class="input-group-btn">';
        row += '<button  type="button" class="btn btn-default plus" onclick="plus(this)">';
        row += '<i class="fa fa-plus"></i>';
        row += '</button>';
        row += '</span>';
        row += '</div>';
        row += '</td>';
        row += '<td style="line-height: 35px;" class="total">'+price+'</td>';
        row += '<td width="50">';
        row += '<a class="btn btn-sm btn-danger" onclick="toDelete(this)">';
        row += '<i class="fa fa-remove"></i>';
        row += '</a>';
        row += '</td>';
        row += "</tr>";
        // row +="<tr><td colspan='3' class='sumTotal'>Total</td><td>"+price+"</td></tr>";
        

        $("#tableId").append(row);
        $(".length").hide();
        $("#search_text").val("");
        articleTable.push(name);
      }   
    }

  });
});
</script>