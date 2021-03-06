
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>
<script type="text/javascript">
//This page is a result of an autogenerated content made by running test.html with firefox.
function domo(){
 
   // Binding keys
   $('*').bind('keydown', 'Ctrl+e', function assets() {
      $('#btn_edit').trigger('click');
       return false;
   });

   $('*').bind('keydown', 'Ctrl+x', function assets() {
      $('#btn_back').trigger('click');
       return false;
   });
    
}


jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h3 style="margin-top: 1px">
      <?=$this->model_rm->getOne('pos_ibi_stores',array('STATUS_STORE'=>'opened', 'ID_STORE'=>$this->uri->segment(2)))['NAME_STORE']?> <i class="fa fa-chevron-right "></i>  <small>Approbation de la requisition      </small>
   </h3>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('requisition/'.$this->uri->segment(2).'/index'); ?>"> Requisition</a></li>
      <li class="active"><?= cclang('detail'); ?></li>
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
                    
                     
                     <!-- /.widget-user-image -->
                     
                       <button  onclick="window.print()" class="btn btn-info pull-right"><i class="fa fa-print"></i>  print</button>
                     <hr>
                  </div>
                  
                 
                 
                   
                    <div class="row">
                     
                      <div class="col-md-12"> 
                      
                        <div>
                          <div align="center">
                            <h4>Articles</h4>
                          </div>
                          <div class="table-responsive"> 
                           <table id="myTable" class="table table-bordered table-striped dataTable">
                            <tr>
                              <th>Code Bar</th>
                              <th>Nom</th>
                              
                              <th>Qt</th>
                              <th>Qt en stock</th>
                              <th>Approuvee par</th>
                              
                              <th>Statuts</th>
                              <th>Action</th>
                            </tr>
                            
                           </table>
                         </div>
                        </div>
                      </div>
                    </div>   
                                        
                    <br>
                    <br>

                    
                        
                <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('requisition_recu/'.$this->uri->segment(2).'/index/'); ?>"><i class="fa fa-arrow-left" ></i></a>
             
                    
                  
               </div>
            </div>
            <!--/box body -->
         </div>
         <!--/box -->

      </div>
   </div>

</div>

</section>
<!-- /.content -->

 <div class="modal fade col-sm-12" id="ExModal" tabindex="+2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document"> 
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
         <h5 class="modal-title" id="exampleModalLabel" align="center"><b>Vous avez recu le retour de <span style="color: red; font-size: 15px" id="qtretour"></span> quantite sur <span id="article_title"></span></b></h5>
         
      </div>
     
    
        <div class="modal-footer">
          
           <button type="button" class="btn btn-danger btn-sm"  ><i class="fa fa-ban"></i> rejetter</button>

          <button type="button" class="btn btn-success btn-sm" onclick="returnQ()"><i class="fa fa-save"></i> approuver</button>
       </div>
    </div>
</div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

 
  $(document).on('click', '#mybtn', function(){
   $('#myModal').modal('show');

  });



  $(document).on('click', '.plus', function(){

      let val=$(this).parent().find('input').val();
      let qt=$(this).closest('tr').find('#qtarticle').text();
      
      if (parseInt(val)>=parseInt(qt)) {sweetAlert('Desol??! dans cette boutique il y a seulement ('+qt+') quantit?? pour ce produit')
       return;}
      let qrest=parseInt(val)+1;
      $(this).parent().find('input').val(qrest);
      
     
    })

   $(document).on('input', '#qt', function(){

      let val=$(this).val();
      let qt=$(this).closest('tr').find('#qtarticle').text();
      if (isNaN(val) || val=="") {$(this).val(1); val=1}
      if (parseInt(val)>=parseInt(qt)) {
        
        sweetAlert('Desol??! dans cette boutique il y a seulement ('+qt+') quantit?? pour ce produit')
         $(this).val(val.slice(0, -1) )
       return;}

    })

    $(document).on('click', '.minus', function(){
      let val=$(this).parent().find('input').val();
      let qrest=parseInt(val)-1;
      if (qrest<1) {qrest=1}
      $(this).parent().find('input').val(qrest);
  })
      

    $(document).on('click', '.action', function(){
      let action=$(this).attr('title');
      let qtarticle=$(this).closest('tr').find('#qtarticle').text();
      let qt=$(this).closest('tr').find('#qt').val();
      let unit_prix=$(this).closest('tr').find('#unit_prix').val();
      let boutiqreq=$(this).closest('tr').find('#boutiqreq').val();
      let nom=$(this).closest('tr').find('#nom').text();
      let id=$(this).attr('id');

       if (action=='approuver') { 
        if (parseFloat(qtarticle)<parseFloat(qt)) {
          sweetAlert('Desol??!  vous n\'avez pas la quantit?? suffisante pour approuver ce produit'); 
        }
       }
    
      getProduct(id,action, qt, unit_prix, boutiqreq,nom);
    })

    


   getProduct();



    function getProduct(code, action, qt,unit_prix, boutiqreq,nom){
      
      $.ajax({
      url:BASE_URL + 'administrator/requisition_recu/getProduct',
      type:'post',
      dataType:'json',
      data:{id: "<?=$this->uri->segment(4)?>",
          store: "<?=$this->uri->segment(2)?>",
          code:code,
          action:action,
          qt:qt,
          unit_prix:unit_prix,
          boutiqreq:boutiqreq,
          nom:nom,
       "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"},
      async:true,
    })
    .done(function(data){
      if (data.msg) {

        if (data.msg=='error') {
          swal({
            title: "warning!",
            text: 'vous n\'avez pas la quantit?? suffisante en stock pour ce produit',
            icon: "warning",
          });
        }else if (data.msg=='error_stat') {
          swal({
            title: "error!",
            text: 'cette requisition a ??t?? annul??e',
            icon: "error",
          });
        }else{
          swal({
            title: "success!",
            text: data.msg,
            icon: "success",
          });
        }
        
    }
      
      
      var container = document.querySelector("#myTable");
      var matches = container.querySelectorAll("tbody > tr");
       matches.forEach((element, index)=>{
       if (index>=1) {
        element.remove()
       }
     })
      data.req.forEach((object, index)=>{
       Qte=object.QT_ARTICLE_REQ;

      if (object.STATUS_PROD_REQ==0) { 
        classname='#aaa85b'; info='En attente';
        disabled='';
        read='';
        hidden='';
        hiddenRetourbtn='none';
      }
      else{
        if (object.QT_RETOUR_ARTICLE_REQ>0 && object.APROUVED_RETOUR_ARTICLE_BY==0) {
          let mystore= "<?=$this->uri->segment(2)?>"
          if(object.APROUVED_BY_STORE==mystore){
            hiddenRetourbtn='';
          }else{
          hiddenRetourbtn='none';
          }
          
          Qte=object.QT_ARTICLE_REQ;
        }else{
         Qte=object.QT_ARTICLE_REQ-object.QT_RETOUR_ARTICLE_REQ;
          hiddenRetourbtn='none';
        }
        
        hidden='none';
        disabled='disabled';
        read='readonly';
        if (object.STATUS_PROD_REQ==1) { classname='#4b9871'; info='Aprouve'} 
        if (object.STATUS_PROD_REQ==2) { classname='#d30069'; info='Rejete'} 
      } 
      object.full_name? object.full_name=object.full_name : object.full_name='(Aucun)';
         
      var html=` <tr>
                <input type="hidden" name="unit_prix" id="unit_prix" value="${object.PRIX_DE_VENTE_ARTICLE}">

                <input type="hidden" name="boutiq_req" id="boutiq_req" value="${object.FROM_STORE}">

              <td>${object.CODEBAR_ARTICLE_REQ}</td>
              <td id="nom">${object.DESIGN_ARTICLE}</td>
              
              <td style="width: 125px;">
                <div style="display: flex; justify-content: space-between;">
                  <button ${disabled} class="btn btn-xs btn-success minus">
                  <i class="fa fa-minus-circle"></i>
                </button>
                 
                <input ${read} style="width: 60px" type="text" class="form-control input-xs" name="qt" id="qt" value="${Qte}" >

                 <button disabled class="btn btn-xs btn-success plus">
                  <i class="fa fa-plus-circle"></i>
                </button>
                </div>
                
              </td>
              <td id="qtarticle">
                ${object.QUANTITY_ARTICLE}
              </td>
              <td>${object.full_name}</td>
              
              <td>
                 <i style="background-color:${classname}; font-size:9px; border-radius:3px; padding:4px; color:white">${info}</i>
                 
              </td>
              <td><button  style="display:${hidden}" id="${object.CODEBAR_ARTICLE_REQ}" title="approuver" type="button" class="btn btn-xs btn-success action"><i class="fa fa-check-circle"></i></button>

              <button  style="display:${hidden}" id="${object.CODEBAR_ARTICLE_REQ}" title="rejetter" type="button" class="btn btn-xs btn-danger action"><i class="fa fa-times-circle"></i></button>

              <button  style="display:${hiddenRetourbtn}" 
              id="${object.ID_ARTICLE_REQ}"
              title="approuver le retour"
              type="button" 
              class="btn btn-xs btn-warning retour"
              retourqt="${object.QT_RETOUR_ARTICLE_REQ}"><i class="fa fa-envelope"></i>
              </button>

             
            </td>
       </tr>`;
         $('#myTable tbody tr:first').after(html);
      })
      
    })
    .always(function() {
         

        })
    .fail(function() {
           sweetAlert('Une erreur est survenue!')
        });

    }

    var idreq="";
    $(document).on('click', '.retour', function(){
      $('#ExModal').modal('show');
      idreq=$(this).attr('id');
      $('#qtretour').text('('+$(this).attr('retourqt')+')');
      let nom=$(this).closest('tr').find('#nom').text();
      $('#article_title').text(nom)
    });

    function returnQ(){
    var idR="<?=$this->uri->segment(4)?>";
    let store="<?=$this->uri->segment(2)?>";

    $.ajax({
      url:BASE_URL + 'administrator/requisition_recu/returnQ',
      method:'POST',
      dataType:'JSON',
      data:{idreq:idreq,idR:idR,store:store, "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"},
      success:function(data){
         $('#ExModal').modal('hide');
         swal({
            title: "success!",
            text: data.msg,
            icon: "success",
          });

         getProduct();
      }
    })
  }

</script>







<style type="text/css">
 @media all {
.page-break { display: none; }
.trdata{ display: none; }
.header_title{display: none; text-align: center;}
}

@media print {
.page-break { display: block; page-break-before: always; }
 #form_trans{display: none;}
.trdata{display: block;}
.header_title{display: block; text-align: center;}
.main-footer{display: none;}

table tbody tr td{
  border: 1px solid #000 !important;
}



    .view-nav,.main-footer,#btn_print,.title,.btn, #myform, .widget-user-header{
      display: none !important;
    }
a {
      display: none !important;
    }
    .print{
      text-align: center !important; 
      background-color: #0002 !important;
    }

 
table td{
border:1px solid #000 !important;
    }
td{
border:1px solid #000 !important;
    }

 table tr th{
 border:1px solid black !important;
  
}
th{
  background-color: green !important;
}
 
img{
  margin-top: 15% !important;
 
}



  

 
   
.celldiv{
  background-color: #999 !important;
  }

}
</style>
</style>