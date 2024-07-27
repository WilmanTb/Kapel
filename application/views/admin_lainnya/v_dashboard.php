<!--Counter Inbox-->
<?php
error_reporting(0);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KAPEL UNIKA - Dashboard Admin Fakultas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'theme/images/UNIKA1.png' ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
    <!-- Ionicons -->
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css' ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">
    <?php
/* Mengambil query report*/
foreach ($visitor as $result) {
    $bulan[] = $result->tgl; //ambil bulan
    $value[] = (float) $result->jumlah; //ambil nilai
}
/* end mengambil query*/

?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!--Header-->
        <?php
$this->load->view('admin_lainnya/v_header');
?>

        <?php
$page = array(
    "page" => "dashboard",
);
$this->load->view('admin_lainnya/v_sidebar', $page);
?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1 style="text-align:left; font-family:square721 bt;">
                    <?php foreach ($fakultas->result_array() as $i):
    $nama_fakultas = $i['name'];

endforeach?>
                    <br><b>DASHBOARD ADMIN <?php echo strtoupper($nama_fakultas) ?></b> <br>
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-md-4 col-sm-7 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-tasks"></i></span>
                            <?php
$nama_ibadah = "";
$tanggal = "";
$jadwal = $visitor->result_array();
if (!empty($jadwal[0]['Tanggal_Ibadah'])) {
            echo "<script>console.log(".json_encode($jadwal).")</script>";

    foreach ($visitor->result_array() as $i) {
        $nama_ibadah = $i['Ibadah'];
        $tanggal = $i['Tanggal_Ibadah'];
        // You can add additional logic here if needed
    }
} else {
    $nama_ibadah = "Belum ada jadwal";
}
?>
                            <div class="info-box-content">
                                <span class="info-box-text">Jadwal Bertugas : </span>
                                <span class="info-box-number"><?php echo $nama_ibadah; ?></span>
                                <span class="info-box-text"><?php echo $tanggal; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
        </div>

        <?php
$this->load->view('admin_lainnya/v_footer');
?>

    </div>

    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url() . 'assets/plugins/sparkline/jquery.sparkline.min.js' ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ?>"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url() . 'assets/plugins/chartjs/Chart.min.js' ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url() . 'assets/dist/js/pages/dashboard2.js' ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>

    <script>
    var lineChartData = {
        labels: <?php echo json_encode($bulan); ?>,
        datasets: [

            {
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(152,235,239,1)",
                data: <?php echo json_encode($value); ?>
            }

        ]

    }

    var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);

    var canvas = new Chart(myLine).Line(lineChartData, {
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.005)",
        scaleGridLineWidth: 0,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        bezierCurve: true,
        bezierCurveTension: 0.4,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 2,
        datasetStroke: true,
        tooltipCornerRadius: 2,
        datasetStrokeWidth: 2,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });
    </script>

</body>

</html>