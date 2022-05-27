<div class="widget-user-header ">

  <!-- /.widget-user-image -->
   <h3 class="widget-user-username">Entretiens - Service Rapide - Vidange/Graissage <?= $info_voiture['MARQUE_VOITURE'].' - '.$info_voiture['PLAQUE_VOITURE'] ?>
  </h3>
</div>
<div class="table-responsive"> 
  <table class="table table-bordered table-striped dataTable">
   <thead>
      <tr>
         <th>&#8470; &nbsp;</th>
         <th>Date</th>
         <th>Kilométrage</th>
         <th>Graissage</th>
         <th>H. Boite</th>
         <th>H. Pont</th>
         <th>H. Frein</th>
         <th>F. Carburant</th>
         <th>F. Huile</th>
         <th>F. Air</th>
         <th>P. Vidange à Kms</th>
      </tr>
   </thead>
   <tbody id="tbody_power">
   <?php $i = 0;
   foreach($info_voiture_entretien as $entretien): 
    $i++;
    ?>
      <tr>
        <td><?= $i?></td>
        <td><?= _ent($entretien['DATE_ENTRETIEN']); ?></td>
        <td><?= _ent($entretien['KM_ENTRETIEN']); ?></td> 
        <td><?= _ent($entretien['GRAISSAGE_ENTRETIEN']); ?></td> 
        <td><?= _ent($entretien['HUILE_B_ENTRETIEN']); ?></td> 
        <td><?= _ent($entretien['HUILE_P_ENTRETIEN']) ?></td>
        <td><?= _ent($entretien['HUILE_F_ENTRETIEN']) ?></td>
        <td><?= _ent($entretien['FILTRE_C_ENTRETIEN']) ?></td>
        <td><?= _ent($entretien['FILTRE_H_ENTRETIEN']) ?></td>
        <td><?= _ent($entretien['FILTRE_A_ENTRETIEN']) ?></td>
        <td><?= _ent($entretien['PROCH_VID_KMS_ENTRETIEN']) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>