<!-- Fine Uploader Gallery CSS file

    ====================================================================== -->

<link href="<?= BASE_ASSET; ?>/fine-upload/fine-uploader-gallery.min.css" rel="stylesheet">

<!-- Fine Uploader jQuery JS file

    ====================================================================== -->

<script src="<?= BASE_ASSET; ?>/fine-upload/jquery.fine-uploader.js"></script>

<?php $this->load->view('core_template/fine_upload'); ?>

<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<script type="text/javascript">
    function domo() {



        // Binding keys

        $('*').bind('keydown', 'Ctrl+s', function assets() {

            $('#btn_save').trigger('click');

            return false;

        });



        $('*').bind('keydown', 'Ctrl+x', function assets() {

            $('#btn_cancel').trigger('click');

            return false;

        });



        $('*').bind('keydown', 'Ctrl+d', function assets() {

            $('.btn_save_back').trigger('click');

            return false;

        });



    }



    jQuery(document).ready(domo);
</script>

<!-- Content Header (Page header) -->

<section class="content-header">

    <h1>

        Articles <small>Edit Articles</small>

    </h1>

    <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class=""><a href="<?= site_url('administrator/project_articles'); ?>">Articles</a></li>

        <li class="active">Edit</li>

    </ol>

</section>

<!-- Main content -->

<section class="content">

    <div class="row">

        <div class="col-md-12">

            <div class="box box-warning">

                <div class="box-body ">

                    <!-- Widget: user widget style 1 -->

                    <div class="box box-widget widget-user-2">

                        <!-- Add the bg color to the header using any of the bg-* classes -->

                        <div class="widget-user-header ">

                            <div class="widget-user-image">

                                <img class="img-circle" src="<?= BASE_ASSET; ?>/img/add2.png" alt="User Avatar">

                            </div>

                            <!-- /.widget-user-image -->

                            <h3 class="widget-user-username">Articles</h3>

                            <h5 class="widget-user-desc">Edit Articles</h5>

                            <hr>

                        </div>

                        <?= form_open(base_url('administrator/project_articles/edit_save/' . $this->uri->segment(4)), [

                            'name'    => 'form_project_articles',

                            'class'   => 'form-horizontal',

                            'id'      => 'form_project_articles',

                            'method'  => 'POST'

                        ]); ?>

                        <?php $request = $this->db->query('SELECT * FROM project_articles WHERE project_articles_approvisionnement_status=1 AND project_article_id=' . $this->uri->segment(4));

                        $request2 = $this->db->query('SELECT * FROM project_produits WHERE project_produits_delete_status=0 AND project_article_id=' . $this->uri->segment(4));

                        $request3 = $this->db->query('SELECT * FROM project_devis_additionnel_produits WHERE project_devis_produits_delete_status=0 AND project_devis_article_id=' . $this->uri->segment(4));

                        if (($request->num_rows() > 0) || ($request2->num_rows() > 0) || ($request3->num_rows() > 0)) { ?>

                            <div class="form-group ">

                                <label for="project_article_name" class="col-sm-2 control-label">Nom Article

                                    <i class="required">*</i>

                                </label>

                                <div class="col-sm-8">

                                    <input type="text" class="form-control" name="project_article_name" id="project_article_name" placeholder="Nom Article" value="<?= set_value('project_article_name', $project_articles->project_article_name); ?>">

                                    <small class="info help-block">

                                    </small>

                                </div>

                            </div>



                            <div class="form-group ">

                                <label for="project_article_reference" class="col-sm-2 control-label">Reference



                                </label>

                                <div class="col-sm-8">

                                    <input type="text" readonly class="form-control" name="project_article_reference" id="project_article_reference" placeholder="Reference" value="<?= set_value('project_article_reference', $project_articles->project_article_reference); ?>">

                                    <small class="info help-block">

                                    </small>

                                </div>

                            </div>

                        <?php   } else { ?>

                            <div class="form-group ">

                                <label for="project_article_name" class="col-sm-2 control-label">Nom Article

                                    <i class="required">*</i>

                                </label>

                                <div class="col-sm-8">

                                    <input type="text" class="form-control" name="project_article_name" id="project_article_name" placeholder="Nom Article" value="<?= set_value('project_article_name', $project_articles->project_article_name); ?>">

                                    <small class="info help-block">

                                    </small>

                                </div>

                            </div>



                            <div class="form-group ">

                                <label for="project_article_reference" class="col-sm-2 control-label">Reference

                                    <i class="required">*</i>

                                </label>

                                <div class="col-sm-8">

                                    <input type="text" class="form-control" name="project_article_reference" id="project_article_reference" placeholder="Reference" value="<?= set_value('project_article_reference', $project_articles->project_article_reference); ?>">

                                    <small class="info help-block">

                                    </small>

                                </div>

                            </div>

                        <?php   } ?>





                        <!-- <div class="form-group ">

                            <label for="project_article_reference_parental" class="col-sm-2 control-label">Reference Parental 

                           

                            </label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" name="project_article_reference_parental" id="project_article_reference_parental" placeholder="Reference Parental" value="<?= set_value('project_article_reference_parental', $project_articles->project_article_reference_parental); ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                        </div> -->



                        <div class="form-group ">

                            <label for="project_articles_parent_category" class="col-sm-2 control-label">Categorie

                                <i class="required">*</i>

                            </label>

                            <div class="col-sm-8">

                                <select class="form-control chosen chosen-select-deselect" name="project_articles_parent_category" id="project_articles_parent_category" data-placeholder="Selectionner Categorie">

                                    <option value=""></option>

                                    <?php foreach (db_get_all_data('project_categories') as $row) : ?>

                                        <option <?= $row->project_categories_id ==  $project_articles->project_articles_parent_category ? 'selected' : ''; ?> value="<?= $row->project_categories_id ?>"><?= $row->project_categories_name; ?></option>

                                    <?php endforeach; ?>

                                </select>

                                <small class="info help-block">

                                </small>

                            </div>

                        </div>





                        <div class="form-group ">

                            <label for="project_article_category" class="col-sm-2 control-label">Sous Categorie

                                <i class="required">*</i>

                            </label>

                            <div class="col-sm-8">

                                <select class="form-control chosen chosen-select-deselect" name="project_article_category" id="project_article_category" data-placeholder="Selectionner Sous Categorie">

                                    <option value=""></option>

                                    <?php foreach (db_get_all_data('project_articles_categories') as $row) : ?>

                                        <option <?= $row->project_articles_categories_id ==  $project_articles->project_article_category ? 'selected' : ''; ?> value="<?= $row->project_articles_categories_id ?>"><?= $row->project_articles_categories_name; ?></option>

                                    <?php endforeach; ?>

                                </select>

                                <small class="info help-block">

                                </small>

                            </div>

                        </div>



                        <!-- <div class="form-group ">

                            <label for="project_article_fournisseur" class="col-sm-2 control-label">Project Article Fournisseur 

                            <i class="required">*</i>

                            </label>

                            <div class="col-sm-8">

                                <select  class="form-control chosen chosen-select-deselect" name="project_article_fournisseur" id="project_article_fournisseur" data-placeholder="Select Project Article Fournisseur" >

                                    <option value=""></option>

                                    <?php foreach (db_get_all_data('project_fournisseur') as $row) : ?>

                                    <option <?= $row->project_fournisseur_id ==  $project_articles->project_article_fournisseur ? 'selected' : ''; ?> value="<?= $row->project_fournisseur_id ?>"><?= $row->project_fournisseur_name; ?></option>

                                    <?php endforeach; ?>  

                                </select>

                                <small class="info help-block">

                                </small>

                            </div>

                        </div> -->



                        <?php if ($this->aauth->is_allowed('crud_add')) { ?>

                            <div class="form-group ">

                                <label for="project_articles_quantite_stock" class="col-sm-2 control-label">Quantite

                                </label>

                                <div class="col-sm-8">

                                    <input type="text" class="form-control" name="project_articles_quantite_stock" id="project_articles_quantite_stock" placeholder="Quantite" value="<?= set_value('project_articles_quantite_stock', $project_articles->project_articles_quantite_stock); ?>">

                                    <small class="info help-block">

                                    </small>

                                </div>

                            </div>

                        <?php } else { ?>

                            <input type="hidden" class="form-control" name="project_articles_quantite_stock" id="project_articles_quantite_stock" placeholder="Quantite" value="<?= set_value('project_articles_quantite_stock', $project_articles->project_articles_quantite_stock); ?>">

                        <?php }; ?>

                        <?php if ($this->aauth->is_allowed('modifier_les_prix')) { ?>


                            <div class="form-group ">

                                <label for="project_articles_prix_achat_pondere" class="col-sm-2 control-label">Prix de revient

                                </label>

                                <div class="col-sm-8">

                                    <input type="text" class="form-control" name="project_articles_prix_achat_pondere" id="project_articles_prix_achat_pondere" placeholder="Prix achat" value="<?= set_value('project_articles_prix_achat_pondere', $project_articles->project_articles_prix_achat_pondere); ?>">

                                    <small class="info help-block">

                                    </small>

                                </div>

                            </div>

                            <div class="form-group ">

                                <label for="project_articles_prix_vente_pondere" class="col-sm-2 control-label">Prix de vente

                                </label>

                                <div class="col-sm-8">

                                    <input type="text" class="form-control" name="project_articles_prix_vente_pondere" id="project_articles_prix_vente_pondere" placeholder="Prix de vente" value="<?= set_value('project_articles_prix_vente_pondere', $project_articles->project_articles_prix_vente_pondere); ?>">

                                    <small class="info help-block">

                                    </small>

                                </div>

                            </div>

                        <?php } else { ?>

                            <input type="text" class="form-control" name="project_articles_prix_achat_pondere" id="project_articles_prix_achat_pondere" placeholder="Prix achat" value="<?= set_value('project_articles_prix_achat_pondere', $project_articles->project_articles_prix_achat_pondere); ?>">

                            <input type="text" class="form-control" name="project_articles_prix_vente_pondere" id="project_articles_prix_vente_pondere" placeholder="Prix de vente" value="<?= set_value('project_articles_prix_vente_pondere', $project_articles->project_articles_prix_vente_pondere); ?>">

                        <?php }; ?>



                        <div class="form-group ">

                            <label for="project_articles_mesure" class="col-sm-2 control-label">Mesure

                            </label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" name="project_articles_mesure" id="project_articles_mesure" placeholder="Mesure" value="<?= set_value('project_articles_mesure', $project_articles->project_articles_mesure); ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                        </div>


                        <div class="form-group ">

                            <label for="project_article_emplacement" class="col-sm-2 control-label">Emplacement

                            </label>

                            <div class="col-sm-8">

                                <select class="form-control chosen chosen-select-deselect" name="project_article_emplacement" id="project_article_emplacement" data-placeholder="Selectionner Emplacement">

                                    <option value=""></option>

                                    <?php foreach (db_get_all_data('project_emplacement') as $row) : ?>

                                        <option <?= $row->project_emplacement_id ==  $project_articles->project_article_emplacement ? 'selected' : ''; ?> value="<?= $row->project_emplacement_id ?>"><?= $row->project_emplacement_name; ?></option>

                                    <?php endforeach; ?>

                                </select>

                                <small class="info help-block">

                                </small>

                            </div>

                        </div>





                        <div class="form-group ">

                            <label for="project_article_stock_low" class="col-sm-2 control-label">Stock minimum

                            </label>

                            <div class="col-sm-8">

                                <input type="number" class="form-control" name="project_article_stock_low" id="project_article_stock_low" placeholder="Stock minimum" value="<?= set_value('project_article_stock_low', $project_articles->project_article_stock_low); ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                        </div>



                        <div class="form-group ">

                            <label for="project_article_photo" class="col-sm-2 control-label">Article Photo

                            </label>

                            <div class="col-sm-8">

                                <div id="project_articles_project_article_photo_galery"></div>

                                <input class="data_file data_file_uuid" name="project_articles_project_article_photo_uuid" id="project_articles_project_article_photo_uuid" type="hidden" value="<?= set_value('project_articles_project_article_photo_uuid'); ?>">

                                <input class="data_file" name="project_articles_project_article_photo_name" id="project_articles_project_article_photo_name" type="hidden" value="<?= set_value('project_articles_project_article_photo_name', $project_articles->project_article_photo); ?>">

                                <small class="info help-block">

                                </small>

                            </div>

                        </div>


                        <div class="message"></div>

                        <div class="row-fluid col-md-7">

                            <!-- <button class="btn btn-flat btn-primary btn_save btn_action" id="btn_save" data-stype='stay' title="<?= cclang('save_button'); ?> (Ctrl+s)">

                            <i class="fa fa-save" ></i> <?= cclang('save_button'); ?>

                            </button> -->

                            <button class="btn btn-flat btn-info btn_save btn_action btn_save_back" id="btn_save" data-stype='back' title="<?= cclang('save_and_go_the_list_button'); ?> (Ctrl+d)">

                                <i class="ion ion-ios-list-outline"></i> <?= cclang('save_and_go_the_list_button'); ?>

                            </button>

                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="<?= cclang('cancel_button'); ?> (Ctrl+x)">

                                <i class="fa fa-undo"></i> <?= cclang('cancel_button'); ?>

                            </a>

                            <span class="loading loading-hide">

                                <img src="<?= BASE_ASSET; ?>/img/loading-spin-primary.svg">

                                <i><?= cclang('loading_saving_data'); ?></i>

                            </span>

                        </div>

                        <?= form_close(); ?>

                    </div>

                </div>

                <!--/box body -->

            </div>

            <!--/box -->

        </div>

    </div>

</section>

<!-- /.content -->

<!-- Page script -->

<script>
    $(document).ready(function() {





        $('#btn_cancel').click(function() {

            swal({

                    title: "Are you sure?",

                    text: "the data that you have created will be in the exhaust!",

                    type: "warning",

                    showCancelButton: true,

                    confirmButtonColor: "#DD6B55",

                    confirmButtonText: "Yes!",

                    cancelButtonText: "No!",

                    closeOnConfirm: true,

                    closeOnCancel: true

                },

                function(isConfirm) {

                    if (isConfirm) {

                        window.location.href = BASE_URL + 'administrator/project_articles';

                    }

                });



            return false;

        }); /*end btn cancel*/



        $('.btn_save').click(function() {

            avoid_multi_click_btn('btn_save', 10000);

            $('.message').fadeOut();



            var form_project_articles = $('#form_project_articles');

            var data_post = form_project_articles.serializeArray();

            var save_type = $(this).attr('data-stype');

            data_post.push({
                name: 'save_type',
                value: save_type
            });



            $('.loading').show();



            $.ajax({

                    url: form_project_articles.attr('action'),

                    type: 'POST',

                    dataType: 'json',

                    data: data_post,

                })

                .done(function(res) {

                    if (res.success) {

                        var id = $('#project_articles_image_galery').find('li').attr('qq-file-id');

                        if (save_type == 'back') {

                            window.location.href = res.redirect;

                            return;

                        }



                        $('.message').printMessage({
                            message: res.message
                        });

                        $('.message').fadeIn();

                        $('.data_file_uuid').val('');



                    } else {

                        $('.message').printMessage({
                            message: res.message,
                            type: 'warning'
                        });

                    }



                })

                .fail(function() {

                    $('.message').printMessage({
                        message: 'Error save data',
                        type: 'warning'
                    });

                })

                .always(function() {

                    $('.loading').hide();

                    $('html, body').animate({
                        scrollTop: $(document).height()
                    }, 2000);

                });



            return false;

        }); /*end btn save*/



        var params = {};

        params[csrf] = token;



        $('#project_articles_project_article_photo_galery').fineUploader({

            template: 'qq-template-gallery',

            request: {

                endpoint: BASE_URL + '/administrator/project_articles/upload_project_article_photo_file',

                params: params

            },

            deleteFile: {

                enabled: true, // defaults to false

                endpoint: BASE_URL + '/administrator/project_articles/delete_project_article_photo_file'

            },

            thumbnails: {

                placeholders: {

                    waitingPath: BASE_URL + '/asset/fine-upload/placeholders/waiting-generic.png',

                    notAvailablePath: BASE_URL + '/asset/fine-upload/placeholders/not_available-generic.png'

                }

            },

            session: {

                endpoint: BASE_URL + 'administrator/project_articles/get_project_article_photo_file/<?= $project_articles->project_article_id; ?>',

                refreshOnRequest: true

            },

            multiple: false,

            validation: {

                allowedExtensions: ["*"],

                sizeLimit: 0,

            },

            showMessage: function(msg) {

                toastr['error'](msg);

            },

            callbacks: {

                onComplete: function(id, name, xhr) {

                    if (xhr.success) {

                        var uuid = $('#project_articles_project_article_photo_galery').fineUploader('getUuid', id);

                        $('#project_articles_project_article_photo_uuid').val(uuid);

                        $('#project_articles_project_article_photo_name').val(xhr.uploadName);

                    } else {

                        toastr['error'](xhr.error);

                    }

                },

                onSubmit: function(id, name) {

                    var uuid = $('#project_articles_project_article_photo_uuid').val();

                    $.get(BASE_URL + '/administrator/project_articles/delete_project_article_photo_file/' + uuid);

                },

                onDeleteComplete: function(id, xhr, isError) {

                    if (isError == false) {

                        $('#project_articles_project_article_photo_uuid').val('');

                        $('#project_articles_project_article_photo_name').val('');

                    }

                }

            }

        }); /*end project_article_photo galey*/



    }); /*end doc ready*/

    function avoid_multi_click_btn(btn_id, period) {
        $('#' + btn_id).attr('disabled', true);

        var my_interval = setInterval(function() {

            $('#' + btn_id).attr('disabled', false);

            clearInterval(my_interval);

        }, period);
    }
</script>