<div class="widget-user-header ">

  <!-- /.widget-user-image -->
   <h3 class="widget-user-username">Suivi du véhicule <?= $info_voiture['MARQUE_VOITURE'].' - '.$info_voiture['PLAQUE_VOITURE'] ?>
  </h3>
</div>
<div class="table-responsive"> 
  <table class="table table-bordered table-striped dataTable">
   <thead>
      <tr>
         <th>&#8470; &nbsp;</th>
         <th>Date</th>
         <th>Chauffeur</th>
         <th>&#8470; &nbsp; de passagers</th>
         <th>H. départ</th>
         <th>Kms départ</th>
         <th>Motif</th>
         <th>H. retour</th>
         <th>Kms retour</th>
         <th>Kms parcourus</th>
         <th>Observations</th>
      </tr>
   </thead>
   <tbody id="tbody_power">
   <?php $i = 0;
   foreach($info_voiture_suivi as $suivi_vehicule): 
    $i++;
    ?>
      <tr>
        <td><?= $i?></td>
        <td><?= _ent($suivi_vehicule['DATE_SUIVI']); ?></td>
        <td><?= _ent($suivi_vehicule['CHAUFFEUR_SUIVI']); ?></td> 
        <td><?= _ent($suivi_vehicule['NBRE_PASSAGERS_SUIVI']); ?></td> 
        <td><?= _ent($suivi_vehicule['START_TIME_SUIVI']); ?></td> 
        <td><?= _ent($suivi_vehicule['KMS_DEPART_SUIVI']) ?></td>
        <td><?= _ent($suivi_vehicule['MOTIF_SUIVI']) ?></td>
        <td><?= _ent($suivi_vehicule['END_TIME_SUIVI']) ?></td>
        <td><?= _ent($suivi_vehicule['KMS_RETOUR_SUIVI']) ?></td>
        <td><?= _ent($suivi_vehicule['KMS_DEPART_SUIVI']) - _ent($suivi_vehicule['KMS_RETOUR_SUIVI']) ?></td>
        <td><?= _ent($suivi_vehicule['OBSERVATION_SUIVI']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>