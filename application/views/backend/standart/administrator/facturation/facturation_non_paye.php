<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Liste des factures non payées<small></small>
   </h1>
   <h5 class="widget-user-desc"><i class="label bg-yellow"><?= $facture_not_paids_count ?>  <?= cclang('items'); ?></i></h5>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Acceuil</a></li>
      <li class="active">Facture</li>
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

                    <form name="form_facturation" id="form_facturation" action="<?= base_url('administrator/facturation/non_paye/'.$this->uri->segment(4).''); ?>">
                      <div class="widget-user-header ">
                        <div class="row pull-center">
                            <div class="col-md-12">
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Numéro de la facture</span>
                                    <input type="text" class="form-control" name="numero_facture">
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">Code de la commande</span>
                                    <input type="text" class="form-control" name="ref_code">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn-group btn-group-md">
                                    <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply"><i class="fa fa-refresh"></i>Charger
                                    </button>
                                    <button type="button" print-item=".content-wrapper" name="name" class="btn btn-default" onclick="printTable()">
                                        <i class="fa fa-print"></i>Imprimer
                                    </button>
                                    <button type="button" name="name" class="btn btn-default" onclick="tableToExcel('headerTable', 'W3C Example Table')">
                                        <i class="fa fa-file"></i>Exporter XLS
                                    </button>
                                </div>
                              </div>
                          </div>
                         </div>
                      </div>
                    </form>
                        
                        <div class="table-responsive"> 
                          <table class="table table-bordered table-striped" id="headerTable">
                             <thead>
                                <tr class="">
                                   <th>Numéro de la facture</th>
                                   <th>Code de la commande</th>
                                   <th>Titre</th>
                                   <th>Client</th>
                                   <th>Total HTVA</th>
                                   <th>Date</th>
                                   <th>Par</th>
                                   <th>Paiement</th>
                                   <th>Action</th>
                                </tr>
                             </thead>
                             <tbody id="tbody_facturation">
                     <?php foreach($facture_not_paids as $facturation): 
                      $auth_user = $this->model_registers->getOne('aauth_users',array('id'=>$facturation->AUTHOR_FACTURE));
                      $ref_client=$this->model_registers->getOne('pos_ibi_clients',array('ID_CLIENT'=>$facturation->REF_CLIENT_FACTURE));
                      if($facturation->TYPE_FACTURE == 'is_proforma'){

                        // $commandes = $this->model_registers->getOneJoin('pos_store_'.$this->uri->segment(4).'_ibi_commandes','pos_store_'.$this->uri->segment(4).'_ibi_proforma','auth.REF_CODE_COMMAND_PROFORMA = comd.CODE_COMMAND','pos_ibi_facture','client.REF_CODE_COMMAND_FACTURE = auth.CODE_PROFORMA',array('ID_FACTURE'=>$facturation->ID_FACTURE));
                        $commandes = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_proforma',array('CODE_PROFORMA'=>$facturation->REF_CODE_COMMAND_FACTURE));
                        $paiementregister = $commandes['TOTAL_PROFORMA']+$commandes['TVA_PROFORMA'];
                        $type_commande = $commandes['PAYMENT_TYPE_PROFORMA'];
                        $totalhtva = $commandes['TOTAL_PROFORMA'];
                        $titre = $commandes['TITRE_PROFORMA'];

                      }else{
                        $commandes = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_commandes',array('CODE_COMMAND'=>$facturation->REF_CODE_COMMAND_FACTURE));
                        $paiementregister = $commandes['TOTAL_COMMAND']+$commandes['TVA_COMMAND'];
                        $type_commande = $commandes['PAYMENT_TYPE_COMMAND'];
                        $totalhtva = $commandes['TOTAL_COMMAND'];
                        $titre = $commandes['TITRE_COMMAND'];
                      }
                      
                      
                      
                          $type_command_paid = '<span class="label label-warning">Non payé</span>';
                          $style = 'style="background-color: #fceec7 !important;"';

                      if($facturation->STATUT_FACTURE == 1){
                        $style = 'style="background-color: #fc1303 !important;"';
                      }
                      ?>
                        <tr <?php echo $style;?>>
                           
                           <td><?= _ent($facturation->NUMERO_FACTURE); ?></td> 
                           <td><?= _ent($facturation->REF_CODE_COMMAND_FACTURE); ?></td> 
                           <td><?= $titre?></td>
                           <td><?= _ent($ref_client['NOM_CLIENT']); ?></td> 
                           <td><?=$totalhtva?></td>
                           <td width="150"><?= _ent($facturation->DATE_CREATION_FACTURE); ?></td> 
                           <td><?= $auth_user['username']; ?></td> 
                           <td><?= $type_command_paid; ?></td> 
                           <td width="150">
                             <?php is_allowed('facturation_delete', function() use ($facturation){?>
                              <a href="javascript:void(0);" data-href="<?= site_url('administrator/facturation/delete/'.$this->uri->segment(4).'/' . $facturation->ID_FACTURE); ?>" class="btn btn-danger btn-xs remove-data"><i class="fa fa-close"></i></a>
                               <?php }) ?>
                              <?php is_allowed('facturation_print', function() use ($facturation){?>
                              <a href="<?= site_url('administrator/facturation/prints/'.$this->uri->segment(4).'/' . $facturation->ID_FACTURE); ?>" class="btn btn-info btn-xs"><i class="fa fa-print"></i></a>
                              <?php }) ?>
                              <?php is_allowed('facturation_paiement', function() use ($facturation){?>
                              <a href="<?= site_url('administrator/facturation/paiement/'.$this->uri->segment(4).'/' . $facturation->ID_FACTURE); ?>" class="label-default"><span class="btn btn-primary btn-xs">Options</span></a>
                              <?php }) ?>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if ($facture_not_paids_count == 0) :?>
                         <tr>
                           <td colspan="100">
                           Les données sur la liste de facture ne sont pas disponibles
                           </td>
                         </tr>
                      <?php endif; ?>
                     </tbody>
                          </table>
                          </div>
         
                    </div>
                </div>
                <!--/box body -->
            </div>
            <!--/box -->
        </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript">

var tableToExcel = (function() {
          var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
          return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
          }
        })()

function printTable()
{
   var divToPrint=document.getElementById("headerTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
<!-- Page script -->
<script>
  $(document).ready(function(){
   
    $('.remove-data').click(function(){

      var url = $(this).attr('data-href');

      swal({
          title: "Es-tu sûr?",
          text: "D'annuler cette facture et il ne peut pas être restaurées!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Oui",
          cancelButtonText: "Non, l'annuler!",
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


    $('#apply').click(function(){

      var bulk = $('#bulk');
      var serialize_bulk = $('#form_facturation').serialize();

      if (bulk.val() == 'delete') {
         swal({
            title: "Es-tu sûr?",
            text: "D'annuler cette facture et il ne peut pas être restaurées!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui",
            cancelButtonText: "Non, l'annuler!",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
               document.location.href = BASE_URL + '/administrator/facturation/delete/<?=$this->uri->segment(4);?>?' + serialize_bulk;      
            }
          });

        return false;

      } else if(bulk.val() == '')  {
          swal({
            title: "Upss",
            text: "<?= cclang('please_choose_bulk_action_first'); ?>",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Okay!",
            closeOnConfirm: true,
            closeOnCancel: true
          });

        return false;
      }

      return false;

    });/*end appliy click*/


    //check all
    var checkAll = $('#check_all');
    var checkboxes = $('input.check');

    checkAll.on('ifChecked ifUnchecked', function(event) {   
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

  }); /*end doc ready*/
</script>
</script>

