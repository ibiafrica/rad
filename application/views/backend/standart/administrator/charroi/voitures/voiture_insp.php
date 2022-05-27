<div class="widget-user-header ">
  <div class="row">
    <!-- /.widget-user-image -->
     <h3 class="widget-user-username">Inspection vehicule de tous les 3 mois <?= $info_voiture['MARQUE_VOITURE'].' - '.$info_voiture['PLAQUE_VOITURE'] ?>
    </h3>
    <div class="pull-right">
      <?php is_allowed('maintenance_add', function(){?>
      <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" title="" href="<?=  site_url('administrator/inspection_vehicule/add/'.$this->uri->segment(4).'/'.$this->uri->segment(5)); ?>"><i class="fa fa-plus" ></i></a>
      <?php }) ?>
    </div>
  </div>
</div>
<div class="table-responsive"> 
  <table class="table table-bordered table-striped dataTable">
   <thead>
      <tr>
         <th>&#8470; &nbsp;</th>
         <th>Date de création</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody id="tbody_power">
   <?php $i = 0;
   foreach($info_voiture_insp as $inspection): 
    $i++;
    ?>
      <tr>
        <td><?= $i?></td>
        <td><?= _ent($inspection['DATE_CREATION_INSP_VEH']); ?></td>
        <td>
          <?php is_allowed('charroi_view', function() use ($inspection){?>
            <a title="Modification de ce suivi" href="<?= site_url('administrator/inspection_vehicule/view/'.$this->uri->segment(4).'/'.$inspection['ID_INSP_VEH']); ?>" class="btn btn-default btn-xs"><i class="fa fa-eye "></i> </a>
          <?php }) ?>
          <?php is_allowed('charroi_update', function() use ($inspection){?>
            <a title="Modification de ce suivi" href="<?= site_url('administrator/inspection_vehicule/edit/'.$this->uri->segment(4).'/'.$inspection['ID_INSP_VEH']); ?>" class="btn btn-default btn-xs"><i class="fa fa-edit "></i> </a>
          <?php }) ?>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>