<link rel="stylesheet" href="<?= BASE_ASSET; ?>loading_style/loading.css"/>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Commentaires        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a  href="<?= site_url('administrator/proforma/index/'.$this->uri->segment(4).''); ?>">Proforma</a></li>
        <li class="active">comment</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body">
                    <div class="box box-widget widget-user-2">
                        <h4><?=$proforma['TITRE_PROFORMA']?> - PROFORMA No <?=$proforma['CODE_PROFORMA']?></h4>
                    </div>
                    <form>
                        <div class="box-content form-group">
                            <textarea cols="40" rows="3" id="comment_description" class="form-control comment_description" placeholder="Écrire un commentaire..." ></textarea>
                            <footer class="panel-footer clearfix">
                                <button class="btn btn-primary pull-right btn-sm postcomment" type="button"><i class="fa fa-paper-plane"></i> Poster un commentaire</button>
                            </footer>
                        </div>
                    </form>

                    <div class="table-app-loader">
                        <div class="table-loader"></div>
                    </div>
                          
                <div class="comment-container">
                    <?php foreach ($proforma_comments as $key => $proforma_comment) {
                        $date_value = $this->model_registers->formatDateAgo($proforma_comment['DATE_CREATION_PROFORMA_COMMENT']);
                       
                    ?>
                    <div class="box" style="position: static;">
                        <div class="media-left">
                            <span>
                                <img style="width: 50px; height: 50px; border-radius: 50%;" src="http://localhost:80/gts/inventory/uploads/user/default.png" class="user-image" alt="User Image">
                            </span>
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <a href="<?=site_url('administrator/user/view/'.$proforma_comment['id'].'')?>" class="dark strong"><?=$proforma_comment['full_name']?> </a><small><span class="text-off"><?=$date_value?></span></small>
                                <span class="pull-right dropdown comment-dropdown">
                                    <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-chevron-down clickable"></i>
                                    </div>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a data-href="<?= site_url('administrator/proforma/comments_delete/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$proforma_comment['ID_PROFORMA_COMMENT']);?>" class="deletecomment" title="Supprimer" ><i class="fa fa-times"></i> Supprimer</a> 
                                        </li>
                                    </ul>
                                </span>   
                            </div>
                            <p><?=$proforma_comment['DESCRIPTION_PROFORMA_COMMENT']?></p>
                            <div class="">
                                <div class="">
                                    <a href="#" class="comment_reply" comment_reply_id="<?=$proforma_comment['ID_PROFORMA_COMMENT']?>"><i class="fa fa-reply font-11"></i> Répondre</a>
                                </div>
                            </div>
                            <div class="box-content form-group" id="comment_reply_description<?=$proforma_comment['ID_PROFORMA_COMMENT']?>" hidden>
                                <textarea cols="40" rows="3" class="form-control comment_reply_description<?=$proforma_comment['ID_PROFORMA_COMMENT']?>" placeholder="Écrire une réponse..." ></textarea>
                                <footer class="panel-footer clearfix">
                                    <button class="btn btn-primary pull-right btn-sm postcomment_reply" postcomment_reply_id="<?=$proforma_comment['ID_PROFORMA_COMMENT']?>" type="button"><i class="fa fa-reply"></i> Poster une réponse</button>
                                </footer>
                            </div>
                            <?php 
                            $store = $this->uri->segment(4);
                            $_comments = $this->model_dashboard->getRequete('SELECT pc.*,user.id,user.full_name FROM pos_store_'.$store.'_ibi_proforma_comments pc JOIN aauth_users user ON user.id=pc.SENDER_PROFORMA_COMMENT WHERE pc.REF_PROFORMA_COMMENT="'.$proforma_comment['REF_PROFORMA_COMMENT'].'" AND ID_UNDER_PROFORMA_COMMENT='.$proforma_comment['ID_PROFORMA_COMMENT'].' ORDER BY pc.DATE_CREATION_PROFORMA_COMMENT DESC');
                             foreach ($_comments as $key => $_comment) {
                                $_date = $this->model_registers->formatDateAgo($_comment['DATE_CREATION_PROFORMA_COMMENT']);
                            ?>
                            <div id="reply-list">    
                                <div class="media-left">
                                    <span>
                                        <img style="width: 35px; height: 35px; border-radius: 35%;" src="http://localhost:80/gts/inventory/uploads/user/default.png" class="user-image" alt="User Image">
                                    </span>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <a href="<?=site_url('administrator/user/view/'.$_comment['id'].'')?>" class="dark strong"><?=$_comment['full_name']?> </a><small><span class="text-off"><?=$_date?></span></small>
                                        <span class="pull-right dropdown comment-dropdown">
                                            <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                                <i class="fa fa-chevron-down clickable"></i>
                                            </div>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a data-href="<?= site_url('administrator/proforma/comments_delete/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$_comment['ID_PROFORMA_COMMENT']);?>" class="deletecomment" title="Supprimer" ><i class="fa fa-times"></i> Supprimer</a> 
                                                </li>
                                            </ul>
                                        </span>   
                                    </div>
                                    <p><?=$_comment['DESCRIPTION_PROFORMA_COMMENT']?></p>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>
                </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page script -->
<script>
var loadingInt = null;

function startLoading() {
  if (! loadingInt)
    loadingInt = setInterval(function(){
        post_comment_notification(); 
      }, 3000);   
}

function pauseLoading() { 
  if (loadingInt)
  { 
    clearInterval( loadingInt );
    loadingInt = null;
    setTimeout( startLoading, 60000 );
  }
}

$(document).ready(function(){

    $('.table-app-loader').hide();
    startLoading();

    $('.postcomment').on('click', function () {
        const comment_description = $('.comment_description').val();
        const postcomment_reply_id = 0;
        if(comment_description == ''){
            alert('Ecrivez un commentaire');
            return;
        }
         $('.table-app-loader').show();
         $.ajax({
            method: "post",
            url: BASE_URL + '/administrator/proforma/comments_save/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>',
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
              comment_description:comment_description,postcomment_reply_id:postcomment_reply_id,
              },
            success: function (data) {
                if(data.response == false){
                  alert(data.result)
                  $('.comment_description').val('').end();
                }else{ 
                    post_comment_notification()
                    $('.comment_description').val('').end();
                }
            }
        });
    });

    $(document).on('click', '.deletecomment', function (){
       
        var url = $(this).attr('data-href');
        $('.table-app-loader').show();
         $.ajax({
            method: "post",
            url: url,
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
              },
            success: function (data) {
                if(data.response == false){
                  alert(data.result)
                  $('.comment_description').val('').end();
                }else{
                    post_comment_notification()
                    $('.comment_description').val('').end();
                }
            }
        });
    });

    $(document).on('click', '.comment_reply', function (e){
        e.preventDefault();
        const comment_reply_id = $(this).attr("comment_reply_id");
        $('#comment_reply_description'+comment_reply_id+'').show();
        pauseLoading()
    });
   
    $(document).on('click', '.postcomment_reply', function (){
        const postcomment_reply_id = $(this).attr("postcomment_reply_id");
        const comment_description = $('.comment_reply_description'+postcomment_reply_id+'').val();
        if(comment_description == ''){
            alert('Ecrivez un commentaire');
            return;
        }
         $('.table-app-loader').show();
         $.ajax({
            method: "post",
            url: BASE_URL + '/administrator/proforma/comments_save/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>',
            dataType: "JSON",
            data: {
              "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
              comment_description:comment_description,postcomment_reply_id:postcomment_reply_id,
              },
            success: function (data) {
                if(data.response == false){
                  alert(data.result)
                  $('.comment_reply_description').val('').end();
                }else{ 
                    post_comment_notification()
                    $('.comment_reply_description').val('').end();
                }
            }
        });
    });

}); /*end doc ready*/

function post_comment_notification(){
     
     $.ajax({
        method: "post",
        url: BASE_URL + '/administrator/proforma/comments_post/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>',
        dataType: "JSON",
        data: {
          "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
          },
        success: function (data) {
            let row = ``;
            for (var i = 0; i < data.length; i++) {
            data[i]
            row += 
            `<div class="box" style="position: static;">
                <div class="media-left">
                    <span>
                        <img style="width: 50px; height: 50px; border-radius: 50%;" src="http://localhost:80/gts/inventory/uploads/user/default.png" class="user-image" alt="User Image">
                    </span>
                </div>
                <div class="media-body">
                    <div class="media-heading">
                        <a href="<?=site_url('administrator/user/view/')?>${data[i].id}" class="dark strong">${data[i].full_name} </a><small><span class="text-off">${data[i].date_value}</span></small>
                        <span class="pull-right dropdown comment-dropdown">
                            <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-chevron-down clickable"></i>
                            </div>
                            <ul class="dropdown-menu" role="menu">
                                <li><a data-href="<?= site_url('administrator/proforma/comments_delete/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/');?>${data[i].ID_PROFORMA_COMMENT}" class="deletecomment" title="Supprimer" ><i class="fa fa-times"></i> Supprimer</a> 
                                </li>
                            </ul>
                        </span>   
                    </div>
                    <p>${data[i].DESCRIPTION_PROFORMA_COMMENT}</p>
                    <div class="">
                        <div class="">
                            <a href="#" class="comment_reply" comment_reply_id="${data[i].ID_PROFORMA_COMMENT}"><i class="fa fa-reply font-11"></i> Répondre</a>
                        </div>
                    </div>
                    <div class="box-content form-group" id="comment_reply_description${data[i].ID_PROFORMA_COMMENT}" hidden>
                        <textarea cols="40" rows="3" class="form-control comment_reply_description${data[i].ID_PROFORMA_COMMENT}" placeholder="Écrire une réponse..." ></textarea>
                        <footer class="panel-footer clearfix">
                            <button class="btn btn-primary pull-right btn-sm postcomment_reply" postcomment_reply_id="${data[i].ID_PROFORMA_COMMENT}" type="button"><i class="fa fa-reply"></i> Poster une réponse</button>
                        </footer>
                    </div>`
                    for (var ii = 0; ii < data[i].under_comment[0].length; ii++) {
                    data[ii]
                    row += 
                    `<div id="reply-list">
                        <div class="media-left">
                            <span>
                                <img style="width: 35px; height: 35px; border-radius: 35%;" src="http://localhost:80/gts/inventory/uploads/user/default.png" class="user-image" alt="User Image">
                            </span>
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <a href="<?=site_url('administrator/user/view/')?>${data[i].under_comment[0][ii]._id}" class="dark strong">${data[i].under_comment[0][ii]._full_name} </a><small><span class="text-off">${data[i].under_comment[0][ii]._date_value}</span></small>
                                <span class="pull-right dropdown comment-dropdown">
                                    <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-chevron-down clickable"></i>
                                    </div>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a data-href="<?= site_url('administrator/proforma/comments_delete/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/');?>${data[i].under_comment[0][ii]._ID_PROFORMA_COMMENT}" class="deletecomment" title="Supprimer" ><i class="fa fa-times"></i> Supprimer</a> 
                                        </li>
                                    </ul>
                                </span>   
                            </div>
                            <p>${data[i].under_comment[0][ii]._DESCRIPTION_PROFORMA_COMMENT}</p>
                            </div>
                        </div>`
                    } 

        row +=  `</div>
            </div>`
            }
            $(".comment-container").html('');
            $(".comment-container").append(row);
            $('.table-app-loader').hide();
        }
    });
    
}
</script>