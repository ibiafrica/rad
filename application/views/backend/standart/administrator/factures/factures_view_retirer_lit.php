    <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
<style type="text/css">
#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: #000;
filter:alpha(opacity=70);
-moz-opacity:0.7;
-khtml-opacity: 0.7;
opacity: 0.7;
z-index: 100;
display: none;
}
.cnt223 a{
text-decoration: none;
}
.popup{
width: 100%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
}
.cnt223{
min-width: 600px;
width: 600px;
min-height: 150px;
margin: 100px auto;
background: #f3f3f3;
position: relative;
z-index: 103;
padding: 15px 35px;
border-radius: 5px;
box-shadow: 0 2px 5px #000;
}
.cnt223 p{
clear: both;
    color: #555555;
    /* text-align: justify; */
    font-size: 20px;
    font-family: sans-serif;
}
.cnt223 p a{
color: #d91900;
font-weight: bold;
}
.cnt223 .x{
float: right;
height: 35px;
left: 22px;
position: relative;
top: -25px;
width: 34px;
}
.cnt223 .x:hover{
cursor: pointer;
}
</style>
<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup').show();
$('.close').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});


 

$('.x').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});
});
</script>
<div class='popup'>
        <div class='cnt223'>
            <h1>Avis important.</h1>
                <p>
                <?php 
                        $get_patient_file_id = $this->model_departements->getOne_data("hospital_ibi_commandes","ID_HOSPITAL_IBI_COMMANDES=".$hospital_ibi_commandes->ID_HOSPITAL_IBI_COMMANDES);
                        if (!empty($get_patient_file_id)) {
                                    $patient_file_id = $get_patient_file_id->PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES;
                        }

                        $get_patient_file_info = $this->model_departements->getOne_data("patient_file","PATIENT_FILE_ID=".$patient_file_id);
                        if (!empty($get_patient_file_info)) {
                                    $patient_file_code = $get_patient_file_info->PATIENT_FILE_CODE;
                                    $patient_id = $get_patient_file_info->PATIENT_ID;
                        }

                        $get_patient_info = $this->model_departements->getOne_data("patients","ID_PATIENT=".$patient_id);
                        if (!empty($get_patient_info)) {
                                    $patient_name = $get_patient_info->NOM_PATIENT.' '.$get_patient_info->PRENOM_PATIENT ;
                        }
                ?>
                    Le patient <?php echo '<b>'.$patient_name.'</b> avec le fiche numero: '. $patient_file_code; ?> n'est pas sorti. Veuillez décharger ce patient et procéder au paiement.
                    <br/>
                    <br/>
                    <a class="btn btn-default" href='<?php echo site_url('administrator/bed_management/discharge'); ?>'>Fermer la fiche</a>

                    <a class="btn btn-default" style="float: right" href='<?php echo site_url('administrator/hospital_ibi_commandes/view/'.$hospital_ibi_commandes->ID_HOSPITAL_IBI_COMMANDES); ?>'> <i class="fa fa-undo"></i> Retour</a>
                </p>
        </div>
</div>