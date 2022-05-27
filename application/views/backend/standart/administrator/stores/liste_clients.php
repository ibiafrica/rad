<section class="content-header">
    <h1>
        Liste des clients
    </h1>
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


                        </div>
                    </div>

                    <form name="form_patients" id="form_patients" action="<?= base_url('administrator/pointdesventes/index'); ?>">
                        <!-- /.widget-user -->
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">

                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="q" id="filter" placeholder="Rechercher" value="<?= $this->input->get('q'); ?>">
                                </div>

                                <div class="col-md-2 padd-left-0 ">
                                    <button type="submit" class="btn btn-flat" name="sbtn" id="sbtn" value="Apply" title="<?= cclang('filter_search'); ?>">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive" style="padding: .5rem 5rem;">
                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr class="">

                                    <th>Référence</th>
                                    <th>Nom & Prenom</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_patients">
                                <?php foreach ($clients_all as $clients) : ?>
                                    <tr>
                                        <td><?= _ent($clients->CLIENT_FILE_CODE); ?></td>
                                        <td><?= $clients->NOM_CLIENT . " " . $clients->PRENOM; ?></td>

                                        <?php if ($is_shifts_open) : ?>
                                            <td width="200">
                                                <a href="<?= base_url('administrator/pointdesventes/ventes/' . $clients->ID_CLIENT) ?>">
                                                    <button class="btn btn-xs btn-info"><i class="btn fa fa-plus btn-xs"></i></button>
                                                </a>
                                            </td>
                                        <?php else : ?>
                                            <td width="200">
                                                <p class="badge badge-danger">pas de shift ouvert</p>
                                            </td>
                                        <?php endif; ?>

                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>

                    <?php if ($clients_counts > 30) : ?>
                        <div class="row">
                            <div class="col-md-4" style="float: right;">
                                <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
                                    <?= $pagination; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <hr>



            </div>
            <!--/box body -->
        </div>
        <!--/box -->
    </div>
    </div>
</section>