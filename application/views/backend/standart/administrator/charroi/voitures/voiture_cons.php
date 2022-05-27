<div class="widget-user-header ">

  <!-- /.widget-user-image -->
   <h3 class="widget-user-username">Consommation du carburant <?= $info_voiture['MARQUE_VOITURE'].' - '.$info_voiture['PLAQUE_VOITURE'] ?>
  </h3>
</div>
<div class="table-responsive"> 
  <table class="table table-bordered table-striped dataTable">
   <thead>
      <tr>
         <th>&#8470; &nbsp;</th>
         <th>Date</th>
         <th>Chauffeur</th>
         <th>Kilométrage</th>
         <th>Litres</th>
         <th>D / E</th>
         <th>Consommation</th>
         <th>Observations</th>
      </tr>
   </thead>
   <tbody id="tbody_power">
   <?php $i = 0;
   foreach($info_voiture_cons as $consommation): 
    $i++;
    ?>
      <tr>
        <td><?= $i?></td>
        <td><?= _ent($consommation['DATE_CONS_CAR']); ?></td>
        <td><?= _ent($consommation['CHAUFFEUR_CONS_CAR']); ?></td> 
        <td><?= _ent($consommation['KM_CONS_CAR']); ?></td> 
        <td><?= _ent($consommation['LITRES_CONS_CAR']); ?></td> 
        <td><?= _ent($consommation['DE_CONS_CAR']) ?></td>
        <td><?= _ent($consommation['CONSOMMATION_CONS_CAR']) ?></td>
        <td><?= _ent($consommation['OBSERVATIONS_CONS_CAR']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>