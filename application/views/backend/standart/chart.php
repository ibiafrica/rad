<style type="text/css">
    .widget-user-header {
        padding-left: 20px !important;
    }
</style>

<link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">

<!-- -->

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-body ">
                    <figure class="highcharts-figure">
                        <div id="container"></div>

                </div>

                <!-- /.box -->

            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
</section>
<!-- /.content -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    $(document).ready(function() {

        $.getJSON('http://localhost/pos_zanzi/api/departement/Rappor_chiffre_affaire', function(data) {
            // $.each(data, function(key,value) {
            console.log(data.series)
            highchart(data.series)

            //  })
        });



        function highchart(params) {
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Chiffre d\'affaire'
                },
                subtitle: {
                    text: 'Pos'
                },
                xAxis: {
                    categories: [
                        'Jan',
                        'Fev',
                        'Mar',
                        'Avr',
                        'Mai',
                        'Juin',
                        'Jul',
                        'Aout',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Rainfall (mm)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} FBU</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },



                series: params
            });
        }

    });
</script>