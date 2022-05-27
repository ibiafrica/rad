
<link rel="stylesheet" href="<?= BASE_ASSET; ?>jquery-switch-button/jquery.switchButton.css">
<script src="<?= BASE_ASSET; ?>/js/jquery.hotkeys.js"></script>

<style type="text/css">
    .widget-user-header {
        padding-left: 20px !important;
    }
</style>



<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <figure class="highcharts-figure">
                        <div id="container">

                             <input type="checkbox" name="status" class="switch-button" <?= $this->model_rm->getOne('autorisation')['STATUS']==0 ?'checked' :''; ?>>
                        </div>

                </div>

                <!-- /.box -->

            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
</section>
<!-- /.content -->



<script>
    $(document).ready(function() {

        $('.switch-button').switchButton({
        labels_placement: 'right',
        on_label: 'Autorisé',
        off_label: 'Non Autorisé'
    });

        $(document).on('change', 'input.switch-button', function() {
        var status = 'inactive';
        var id = 1
        var data = [];

        if ($(this).prop('checked')) {
            status = 'active';
        }

        data.push({
            name: csrf,
            value: token
        });
        data.push({
            name: 'status',
            value: status
        });
        data.push({
            name: 'id',
            value: id
        });

        $.ajax({
                url: BASE_URL + '/administrator/Autorisation/set_status',
                type: 'POST',
                dataType: 'JSON',
                data: data,
            })
            .done(function(data) {
                if (data.success) {
                    toastr['success'](data.message);
                    setTimeout(()=>{
                      window.location.reload()
                    }, 2000)
                } else {
                    toastr['warning'](data.message);
                }

            })
            .fail(function() {
                toastr['error']('Error update status');
            });
    });

    });
</script>