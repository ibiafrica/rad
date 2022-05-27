<div class="modal-dialog" style="width: 98%;">
	<div class="modal-content">
		<div class="modal-body" style="padding-bottom: 0px;">
			<div class="bootbox-body">
				<h4 class="text-center">Options de la commande : <?=$commande['CODE_COMMAND'];?></h4>
				<div class="row" style="border-top:solid 1px #EEE;">
					<div class="col-lg-2 col-md-2 col-sm-2" style="padding:0px;margin:0px;"><div class="list-group">
						<a style="border-radius:0;border-left:0px; border-right:0px;" id="detail" href="#" class="list-group-item active"><i class="fa fa-eye"></i> Détails</a>
						<a style="border-radius:0;border-left:0px; border-right:0px;" id="payment" href="#" class="list-group-item default"><i class="fa fa-money"></i> Paiment</a>
						<?php if($type_commandes == 'complete'){
							?>
						<a style="border-radius:0;border-left:0px; border-right:0px;" id="remboursement" data-menu-namespace="refund" href="#" class="list-group-item"><i class="fa fa-frown-o"></i> Remboursement</a>
					<?php } ?>
					</div>
				</div>
				<div class="col-lg-10 col-md-10 col-sm-10 details-wrapper" style="border-left:solid 1px #EEE;">
					<div id="details">
						<div class="row">
							<div class="col-lg-8 col-md-8 col-xs-12" style="height:445px;overflow-y: scroll;"><h5>Liste des produits</h5>
								<table class="table table-bordered table-striped">
									<thead>
									<tr><td>Nom de l'article</td>
										<td>Prix Unitaire</td>
										<td>Quantité</td>
										<td>Sous-Total</td>
									</tr>
								</thead>
								<tbody>
									<?php 
									$sous_total=0;
									$remise=0;
									foreach ($getCommandes as $getCommande) {
										if($getCommande['DISCOUNT_TYPE_COMMAND_PROD'] == 'percentage'){
                                              
                                                    $remplremises = ($getCommande['DISCOUNT_PERCENT_COMMAND_PROD']);

                                                }else{
                                                    $remplremises = ($getCommande['DISCOUNT_AMOUNT_COMMAND_PROD']);
                                                }
                                                $remplremise = strrev(wordwrap(strrev($remplremises), 3, ' ', true));
                                       
										$sous_total += ($getCommande['PRIX_TOTAL_COMMAND_PROD']);
										$remise+=$remplremises;

										?>
									<tr>
										<td><?=$getCommande['NAME_COMMAND_PROD'];?></td>
										<td> <?=strrev(wordwrap(strrev($getCommande['PRIX_COMMAND_PROD']), 3, ' ', true));?> </td>
										<td><?=$getCommande['QUANTITE_COMMAND_PROD'];?></td>
										<td> <?=strrev(wordwrap(strrev($getCommande['PRIX_TOTAL_COMMAND_PROD']), 3, ' ', true));?> </td>
									</tr>
								<?php }

								$tva = strrev(wordwrap(strrev($commande['TVA_COMMAND']), 3, ' ', true));
								$pvtvac = $commande['TOTAL_COMMAND']+$commande['TVA_COMMAND'];
								$pvtvac = strrev(wordwrap(strrev($pvtvac), 3, ' ', true));

								?>
							        <tr><td colspan="3"><strong>Sous Total</strong> </td><td> 
							        <?=strrev(wordwrap(strrev($sous_total), 3, ' ', true));?> </td></tr><tr><td colspan="3"><strong>Remise (-)</strong></td><td> <?=strrev(wordwrap(strrev($remise), 3, ' ', true));?> </td></tr><tr><td colspan="3"><strong>TVA (+)</strong> </td><td> <?=$tva;?> </td></tr><tr><td colspan="3"><strong>Livraison</strong></td><td> 0.00 </td></tr><tr><td colspan="3"><strong>Total</strong></td><td> <?=$pvtvac;?> </td></tr><tr><td colspan="3"><strong>Payé</strong></td><td> <?=strrev(wordwrap(strrev($montant_paid), 3, ' ', true));?> </td></tr><tr><td colspan="3"><strong>Reste</strong></td><td> <?=strrev(wordwrap(strrev($reste), 3, ' ', true));?> </td></tr></tbody>
								</table>
							</div>
							<div class="col-lg-4 col-md-4 col-xs-12"><h5>Détails sur la commande</h5>
								<ul class="list-group">
									<li class="list-group-item"><strong>Auteur :</strong> <?=$commande['username'];?></li>
									<li class="list-group-item"><strong>Effectué le :</strong> <?=$commande['DATE_CREATION_COMMAND'];?></li><li class="list-group-item"><strong>Client :</strong> <?=$commande['NOM_CLIENT'];?></li><li class="list-group-item"><strong>Statut :</strong> <?=$type_commande;?></li></ul>
							</div>
						</div>
					</div>
					<?= form_open(base_url('administrator/registers/paid_save'), [
                            'name'    => 'form_registers', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_registers', 
                            'method'  => 'POST'
                            ]); ?>
					<div id="payments" style="display: none;">
						    <input type="hidden" name="commande_code" value="<?=$commande['CODE_COMMAND'];?>">
							<input type="hidden" name="store_prefix" id="store_prefix" value="store_<?=$this->uri->segment(4)?>">
                			<input type="hidden" name="store_uri" id="store_uri" value="<?=$this->uri->segment(4)?>">
                			<input type="hidden" name="id" id="id" value="<?=$this->uri->segment(5)?>">
                			<input type="hidden" name="somme_paid" value="<?=$montant_paid?>">
                			<input type="hidden" name="total" value="<?= $commande['TOTAL_COMMAND']+$commande['TVA_COMMAND'];?>"/>
							<input type="hidden" name="seller" value="<?= $commande['AUTHOR_COMMAND'];?>"/>
							<div class="col-lg-6">
								<h4 class="text-center">Effectuer un paiement</h4>
								<div class="input-group payment-selection">
									<span class="input-group-addon">Choisir un moyen de paiement</span>
									<?php 

									if($reste <= 0){
										$disabled = 'disabled="disabled"';
									}else{
										$disabled = '';
									}

									?>
									<select <?=$disabled?> class="form-control type_paiement" name="type_paiement">
										<option></option>
										<option label="Paiement en espèces" value="cash">Paiement en espèces</option>
										<option label="Chèque" value="cheque">Chèque</option>
										<option label="Transfert Bancaire" value="bank">Transfert Bancaire</option>
									</select>
								</div>
								<h4>
									<strong class="text-center">Reste à payer<span class="amount-to-pay"> :   <?=strrev(wordwrap(strrev($reste), 3, ' ', true));?> </span>
									</strong>
								</h4>
								<div class="payment-option-box">
										<div class="input-group montant_paid" style="display: none;"><span class="input-group-addon">Valeur du paiement</span><input type="text" name="montant_paid" class="form-control"></div><br>
										<div class="input-group number_cheque" style="display: none;"><span class="input-group-addon">Numéro du chèque</span><input type="text" name="number_cheque" class="form-control"></div>
										<div class="input-group nom_banque" style="display: none;"><span class="input-group-addon">Nom de la banque</span><input type="text" name="nom_banque" class="form-control"></div>
										<div class="input-group number_bordereau" style="display: none;"><span class="input-group-addon">Numéro du bordereau</span><input type="text" name="number_bordereau" class="form-control"></div>
								    <br>
								    <div class="message"></div>
								    <?php is_allowed('commandes_paiements_add', function(){ ?>
								    <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save" data-stype='back' style="display: none;">Payer</a>
								    <?php }) ?>
								    <span class="loading loading-hide">
		                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"> 
		                            <i><?= cclang('loading_saving_data'); ?></i>
		                            </span>
								    <br><br>

							    </div>
								<!-- <div class="notice-wrapper alert alert-info ng-binding" ng-show="showNotice">Cette commande peut recevoir un paiement. Veuillez choisir le moyen de paiement que vous souhaitez appliquer à cette commande</div> -->
							</div>
							<div class="col-lg-6 payment-history-col" style="height:445px;overflow-y: scroll;"><h4 class="text-center">Historique des paiements</h4>
								<table class="table table-bordered">
									<thead>
										<tr class="payment-history-thead">
											<td>Montant</td>
											<td>Caissier</td>
											<td>Mode de Paiement</td>
											<td>Date</td>
											<td></td>
										</tr>
									</thead>
								<tbody class="payment-history">
									<?php foreach ($getPaiement as $value) {
		                            $cassier = $this->model_registers->getOne('aauth_users',array('id'=>$value['AUTHOR_PAIEMENT']));
								     ?>
									    <tr>
											<td><?=strrev(wordwrap(strrev($value['MONTANT_PAIEMENT']), 3, ' ', true));?></td>
											<td><?=$cassier['username'];?></td>
											<td><?=$value['PAYMENT_TYPE_PAIEMENT'];?></td>
											<td><?=$value['DATE_CREATION_PAIEMENT'];?></td>
											<td>
												<?php is_allowed('commandes_paiements_view', function() use ($value){ ?>
												<a href="<?= site_url('administrator/paiements/paid_receipt/'.$this->uri->segment(4).'/' . $value['ID_PAIEMENT']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
												<?php }) ?>
												<?php is_allowed('commandes_paiements_update', function() use ($value){ ?>
												<a href="<?= site_url('administrator/paiements/edit/'.$this->uri->segment(4).'/' . $value['ID_PAIEMENT']); ?>" class="btn btn-default btn-sm"><i class="fa fa-edit "></i></a>
												<?php }) ?>
											</td>
										</tr>
									<?php }?>
								</tbody>
							</table>
							</div>
						    <my-spinner namespace="spinner" class="sk-rotating-plane"><div class="ibi-overlay" style="width: 100%; height: 100%; background: rgba(255, 255, 255, 0.9); z-index: 5000; position: absolute; top: 0px; left: 0px;"><i class="fa fa-refresh fa-spin ibi-refresh-icon" style="color: rgb(0, 0, 0); font-size: 50px; position: absolute; top: 50%; left: 50%; margin-top: -25px; margin-left: -25px; width: 44px; height: 50px;"></i></div>
						    </my-spinner>
									
					</div>
				<?= form_close(); ?>
                
				
				<?= form_open(base_url('administrator/registers/remboursement/'.$this->uri->segment(4).'/'.$this->uri->segment(5).''), [
                            'name'    => 'form_remboursement', 
                            'class'   => 'form-horizontal', 
                            'id'      => 'form_remboursement', 
                            'method'  => 'POST'
                            ]); ?>
					<div id="remboursements" style="display: none;">
							<input type="hidden" name="commande_code" value="<?=$commande['CODE_COMMAND'];?>">
                			<input type="hidden" name="montant_paid" id="montant_paid" value="<?=$montant_paid?>">
                			<input type="hidden" name="total_paid" id="total_paid" value="<?= $commande['TOTAL_COMMAND']+$commande['TVA_COMMAND'];?>"/>
						<div class="col-lg-8 col-md-8 refund-row" style="height:474px;overflow-y: scroll;"><h4 class="text-center">Remboursement</h4>
							<table class="table table-bordered refund-table">
								<thead>
									<tr>
										<td class="text-center">Nom du produit</td>
										<td class="text-center">Qte vendue</td>
										<td class="text-center"><i class="fa fa-arrow-right"></i>
										</td>
										<td class="text-center"><i class="fa fa-arrow-left"></i>
										</td>
										<td class="text-center">Qte en état</td>
									</tr>
								</thead>
								<tbody>
									<?php  
									$totaltva=$commande['TOTAL_COMMAND']+$commande['TVA_COMMAND'];
									foreach ($getCommandes as $getCommande) {
                                    $remisetype = $getCommande['DISCOUNT_TYPE_COMMAND_PROD'];
										if($remisetype == 'percentage'){
											$remise = $getCommande['DISCOUNT_PERCENT_COMMAND_PROD'];
										}else{
											$remise = $getCommande['DISCOUNT_AMOUNT_COMMAND_PROD'];
										}
										$stock_flow=$this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_articles_stock_flow',array('REF_COMMAND_CODE_SF'=>$getCommande['REF_COMMAND_CODE_PROD'],'REF_ARTICLE_BARCODE_SF'=>$getCommande['REF_PRODUCT_CODEBAR_COMMAND_PROD'],'TYPE_SF'=>'stock_return'));
										if($stock_flow == true){
											$quantReturn = $stock_flow['QUANTITE_SF'];
										}else{
											$quantReturn = '0';
										}
										
								        $article = $this->model_registers->getOne('pos_store_'.$this->uri->segment(4).'_ibi_articles', array('CODEBAR_ARTICLE'=>$getCommande['REF_PRODUCT_CODEBAR_COMMAND_PROD']));
										 $quantiteRest = $getCommande['QUANTITE_COMMAND_PROD'];
										 $quantRestSt = $article['QUANTITE_RESTANTE_ARTICLE'];
										 $price = $getCommande['PRIX_COMMAND_PROD'];
										 $prixtva = $getCommande['PRIX_COMMAND_PROD']*0.18;
										 $prixtva = round($prixtva);
										 $prixtotal = $getCommande['PRIX_COMMAND_PROD']+$prixtva;

										?>
									<tr>
										<td class="text-center"><input type="hidden" name="article[]" value="<?=$getCommande['REF_PRODUCT_CODEBAR_COMMAND_PROD'];?>"><?=$getCommande['NAME_COMMAND_PROD']?></td>
										<td class="text-center"><span class="quantReturn"><?=$quantReturn?></span>/<span class="quantiteRest"><?=$quantiteRest?></span></td>
										<td hidden>
											<input type="text" name="price[]" value="<?=$price?>">
											<input type="text" name="quantiteRest[]" value="<?=$quantiteRest?>">
											<input type="text" name="remisetype[]" value="<?=$remisetype?>">
											<input type="text" name="remise[]" value="<?=$remise?>">
										</td>
										<td class="prixtotal" hidden><input type="text" name="prixtotal[]" value="<?=$prixtotal?>"><?=$prixtotal?></td>
										<td class="text-center" onclick="arrowRight(this)"> <i class="fa fa-arrow-right"></i>
										</td>
										<td class="text-center" onclick="arrowLeft(this)"><i class="fa fa-arrow-left"></i>
										</td>
										<td class="text-center"><div><input type="hidden" name="search[]" value="0"></div><span class="quantRest">0</span>/<span class="quantRestSt"><?=$quantRestSt?></span></td>
									</tr>
								<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="col-lg-4 col-md-4 cart">
								<h4 class="text-center">Etat du remboursement</h4>
								<h4>Valeur:<span id="totaltva" class="current-order-value pull-right"> <?=$totaltva?> </span></h4>
								<h4>Remboursement:<span id="rembours" class="current-order-value pull-right">0</span>
								<input type="hidden" class="form-control rembours" name="rembours" value="">
								</h4>
								<div class="message"></div>
								<?php is_allowed('registers_remboursement', function(){ ?>
								<a class="btn btn-flat btn-primary btn_remboursement btn_action btn_save_back" id="btn_remboursement" data-stype="back">Confirmer le remboursement</a>
								<?php }) ?>
								<span class="loading loading-hide">
	                            <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg"><i><?= cclang('loading_saving_data'); ?></i>
	                            </span>
								<!-- <button class="pull-right btn btn-primary">Imprimer le reçu</button> -->
							</div>
					</div>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
        <div class="modal-footer">
		    <a href="<?= site_url('administrator/registers/index/' . $this->uri->segment(4)); ?>" type="button" class="btn btn-primary">Retour</a>
		</div>
								<!-- <div class="grandSpinnerWrapper">
									<grand-spinner><div ng-show="showGrandSpinner" class="ibi-overlay ng-hide" style="width: 100%; height: 100%; background: rgba(255, 255, 255, 0.9); z-index: 5000; position: absolute; top: 0px; left: 0px;"><i class="fa fa-refresh fa-spin ibi-refresh-icon" style="color: rgb(0, 0, 0); font-size: 50px; position: absolute; top: 50%; left: 50%; margin-top: -25px; margin-left: -25px; width: 44px; height: 50px;"></i></div>
									</grand-spinner>
								</div> -->
   </div>
</div>
<script type="text/javascript">
var executed = false;
var loaded = function () {
    if (!executed) {
        $(".sk-rotating-plane").fadeOut("slow");
        setTimeout(function () {
            $('body').addClass('loaded');
        }, 10);
        executed = true;
    }
};

	$(document).ready(function(){
		$('#detail').on('click',function(){
        $('#details').show();
        $('#payments').hide();
        $('#remboursements').hide();
        $('#payment').removeClass("active");
        $('#remboursement').removeClass("active");
        $(this).addClass("active");
      });
      $('#payment').on('click',function(){
      	$(window).on('load', loaded);
        setTimeout(loaded, 1000);
        $('#details').hide();
        $('#payments').show();
        $('#remboursements').hide();
        $('#detail').removeClass("active");
        $('#remboursement').removeClass("active");
        $(this).addClass("active");
      });
      $('#remboursement').on('click',function(){
      	$(window).on('load', loaded);
        setTimeout(loaded, 1000);
        $('#details').hide();
        $('#payments').hide();
        $('#remboursements').show();
        $('#detail').removeClass("active");
        $('#payment').removeClass("active");
        $(this).addClass("active");
      });

      $('.type_paiement').on('change',function(){
          
          if($('.type_paiement').val() == 'cash'){
          	$('.montant_paid').show();
      	  	$('.number_cheque').hide();
            $('.nom_banque').hide();
            $('.number_bordereau').hide();
            $('.btn_save_back').show();
      	  }else if($('.type_paiement').val() == 'cheque'){
      	  	$('.montant_paid').show();
      	  	$('.number_cheque').show();
            $('.nom_banque').show();
            $('.number_bordereau').hide();
            $('.btn_save_back').show();
      	  }else if($('.type_paiement').val() == 'bank'){
      	  	$('.montant_paid').show();
      	  	$('.number_cheque').hide();
            $('.nom_banque').hide();
            $('.number_bordereau').show();
            $('.btn_save_back').show();
      	  }else{
      	  	$('.montant_paid').hide();
      	  	$('.number_cheque').hide();
            $('.nom_banque').hide();
            $('.number_bordereau').hide();
            $('.btn_save_back').hide();
      	  }
        
      });


      $('.btn_save').click(function(){
        $('.message').fadeOut();
            
        var form_registers = $('#form_registers');
        var data_post = form_registers.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_registers.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#registers_image_galery').find('li').attr('qq-file-id');
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

      $('.btn_remboursement').click(function(){
        $('.message').fadeOut();
            
        var form_remboursement = $('#form_remboursement');
        var data_post = form_remboursement.serializeArray();
        var save_type = $(this).attr('data-stype');
        data_post.push({name: 'save_type', value: save_type});
    
        $('.loading').show();
    
        $.ajax({
          url: form_remboursement.attr('action'),
          type: 'POST',
          dataType: 'json',
          data: data_post,
        })
        .done(function(res) {
          if(res.success) {
            var id = $('#registers_image_galery').find('li').attr('qq-file-id');
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

	});
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
  function arrowRight(data){
   
  	const prixtotal = stringToNumber($(data).closest('tr').find("td.prixtotal").text());
    const totaltva = stringToNumber(document.getElementById("totaltva").innerHTML);
    const rembours = stringToNumber(document.getElementById("rembours").innerHTML);
    // const rembours = stringToNumber($('.rembours').val());
    const quantReturn = stringToNumber($(data).closest('tr').find("td span.quantReturn").text());
  	const quantiteRest = stringToNumber($(data).closest('tr').find("td span.quantiteRest").text());
  	const quantRest = stringToNumber($(data).closest('tr').find('td span.quantRest').text());
  	const quantRestSt = stringToNumber($(data).closest('tr').find('td span.quantRestSt').text());
    const initial = 1;
    const montant_paid = $('#montant_paid').val();
    const total_paid = $('#total_paid').val();
    var remboursTotal = rembours+prixtotal;
    const totaltvaFinal = totaltva-prixtotal;

    // if(montant_paid <= totaltva){
    // 	alert('Vous ne pouvez plus rembourser sans avoir avance');
    // }else{
	    if(quantReturn == 0){
	    	alert('Vous ne pouvez plus retirer de quantité');
	    }else{
	      document.getElementById('totaltva').innerHTML = totaltvaFinal;
	      $('.rembours').val(remboursTotal);
	      document.getElementById('rembours').innerHTML = remboursTotal;
	      $(data).closest('tr').find('td span.quantRest').text(quantRest+initial);
	      $(data).closest('tr').find('td span.quantRestSt').text(quantRestSt);
	      $(data).closest('tr').find('td span.quantReturn').text(quantReturn-initial);
	      $(data).closest('tr').find('td div input').val(quantRest+initial);
	      // $(data).closest('tr').find("td.prixtotal").text((quantRest+initial)*prixtotal);
	      $(data).closest('tr').find("td.prixtotal input").val((quantRest+initial)*prixtotal);
	    }
	  // }
   }

  function arrowLeft(data){

  	const prixtotal = stringToNumber($(data).closest('tr').find("td.prixtotal").text());
    const totaltva = stringToNumber(document.getElementById("totaltva").innerHTML);
    const rembours = stringToNumber(document.getElementById("rembours").innerHTML);
   
    const quantRest = stringToNumber($(data).closest('tr').find('td span.quantRest').text());
    const quantRestSt = stringToNumber($(data).closest('tr').find('td span.quantRestSt').text());
    const quantReturn = stringToNumber($(data).closest('tr').find('td span.quantReturn').text());
    const quantiteRest = stringToNumber($(data).closest('tr').find('td span.quantiteRest').text());
    const initial = 1;
    const remboursTotal = rembours-prixtotal;
    const totaltvaFinal = totaltva+prixtotal;
    
    if(quantRest == 0){
    	alert('Vous ne pouvez plus restaurer une quantité');
    }else{
    	document.getElementById('totaltva').innerHTML = totaltvaFinal;
    	$('.rembours').val(remboursTotal);
        document.getElementById('rembours').innerHTML = remboursTotal;
    	$(data).closest('tr').find('td span.quantReturn').text(quantReturn+initial);
    	$(data).closest('tr').find('td span.quantRest').text(quantRest-initial);
      	$(data).closest('tr').find('td span.quantRestSt').text(quantRestSt);
      	$(data).closest('tr').find('td div input').val(quantRest-initial);
        // $(data).closest('tr').find("td.prixtotal").text((quantRest-initial)*prixtotal);
        $(data).closest('tr').find("td.prixtotal input").val((quantRest-initial)*prixtotal);
    }

  }
  </script>