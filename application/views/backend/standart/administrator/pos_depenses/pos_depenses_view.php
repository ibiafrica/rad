
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
   <h1>
      Pos Depenses      <small><?= cclang('detail', ['Pos Depenses']); ?> </small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""><a  href="<?= site_url('administrator/pos_depenses'); ?>">Pos Depenses</a></li>
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
                    
                     <div class="widget-user-image">
                        <img class="img-circle" src="<?= BASE_ASSET; ?>/img/view.png" alt="User Avatar">
                     </div>
                     <!-- /.widget-user-image -->
                     <h3 class="widget-user-username">Pos Depenses</h3>
                     <h5 class="widget-user-desc">Detail Pos Depenses</h5>
                     <hr>
                  </div>

                 
                  <div class="form-horizontal" name="form_pos_depenses" id="form_pos_depenses" >
                   
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Nom Depense </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_depenses->NOM_DEPENSE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Montant Depense </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_depenses->MONTANT_DEPENSE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Description Depense </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_depenses->DESCRIPTION_DEPENSE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Depense Creer Par </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_depenses->CREATE_BY_DEPENSE); ?>
                        </div>
                    </div>
                                         
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Date Creation </label>

                        <div class="col-sm-8">
                           <?= _ent($pos_depenses->DATE_CREATE_DEPENSE); ?>
                        </div>
                    </div>
                                        
                    <br>
                    <br>

                    <div class="view-nav">
                        <?php is_allowed('pos_depenses_update', function() use ($pos_depenses){?>
                        <a class="btn btn-flat btn-info btn_edit btn_action" id="btn_edit" data-stype='back' title="edit pos_depenses (Ctrl+e)" href="<?= site_url('depense/'.$this->uri->segment(2).'/edit/'.$pos_depenses->ID_DEPENSE); ?>"><i class="fa fa-edit" ></i> <?= cclang('update', ['Pos Depenses']); ?> </a>
                        <?php }) ?>
                        <a class="btn btn-flat btn-default btn_action" id="btn_back" title="back (Ctrl+x)" href="<?= site_url('depense/'.$this->uri->segment(2).'/index'); ?>"><i class="fa fa-undo" ></i> <?= cclang('go_list_button', ['Pos Depenses']); ?></a>
                     </div>
                    
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
