<style type="text/css">
   .container_ibi {

      position: relative;
      height: 1em;
   }

   select {
      position: absolute;
   }

   select {
      position: absolute;
   }
</style>

<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
   //This page is a result of an autogenerated content made by running test.html with firefox.
   function domo() {


     // $('.modal-footer').hide();
      // Binding keys
      $('*').bind('keydown', 'Ctrl+a', function assets() {
         window.location.href = BASE_URL + '/administrator/pos_depenses/add';
         return false;
      });

      $('*').bind('keydown', 'Ctrl+f', function assets() {
         $('#sbtn').trigger('click');
         return false;
      });

      $('*').bind('keydown', 'Ctrl+x', function assets() {
         $('#reset').trigger('click');
         return false;
      });

      $('*').bind('keydown', 'Ctrl+b', function assets() {

         $('#reset').trigger('click');
         return false;
      });
   }

   jQuery(document).ready(domo);
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Status Tva </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Status</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">

      <div class="col-md-12">
         <div class="box box-warning">
            <div class="box-body ">
            <div class="col-md-4"></div>
           <div class="col-md-4">

            <div class="input-group">
                <span class="input-group-addon"> <b> Status TVA</b> <i class="fa fa-exchange"></i> </span>
                 <select class="form-control chosen chosen-select-deselect" onchange="status(this)" id="status">
                 <option></option>
                  <option <?= '1' == $stat['status'] ? 'selected' : '' ?> value="1">Activation</option>
                  <option <?= '0' == $stat['status'] ? 'selected' : '' ?> value="0">Desactivation</option>

              </select>
            </div>


         
           </div>                 




            </div>


         




</div>


</div>
</div>

<!-- Page script -->


<script>

     function status(that){
       let statut = $(that).val();
       $.ajax({
        url:'<?php echo base_url('administrator/status_tva/changer_status')?>',
        method:"POST",
        data:{statut:statut},
        dataType:"JSON",
        success:function(data){
           toastr['success'](data.status);
        }
       })
     }

</script>

<script type="text/javascript">
   function impression(divName) {
      window.print();
   }
</script>

<style type="text/css">
   @media print {
      .cacher {
         display: none;
      }

      .view {
         display: inline-block !important;
      }
   }
</style>