<?php
$role = "";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petugas Misa</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'theme/images/UNIKA1.png' ?>">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/daterangepicker/daterangepicker.css' ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/daterangepicker/daterangepicker.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/timepicker/bootstrap-timepicker.min.css' ?>">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datepicker/datepicker3.css' ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

</head>

<style>

</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php
        $this->load->view('admin_lainnya/v_header');
        ?>
        <?php
        $page = array(
            "page" => "petugas"
        );
        $this->load->view('admin_lainnya/v_sidebar', $page);
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Jadwal Bertugas
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Petugas</a></li>
                    <li class="active">Misa</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content" style="margin-bottom: -50px;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box">
                                <!-- <div class="box-header">
                                    <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Set Petugas</a>
                                </div> -->
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-striped" style="font-size:12px;">
                                        <thead>
                                            <tr>
                                                <th style="width:70px;">No</th>
                                                <th>Nama Ibadah</th>
                                                <th>Tanggal Ibadah</th>
                                                <th>Waktu</th>
                                                <th>Keterangan</th>
                                                <th style="text-align:right;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($data->result_array() as $i) :
                                                $no++;
                                                $id_ibadah = $i['id'];
                                                $nama_ibadah = $i['Ibadah'];
                                                $tanggal = $i['Tanggal_Ibadah'];
                                                $tanggal_ibadah = date('d F Y', strtotime($tanggal));
                                                $waktu_ibadah = $i['Waktu_Ibadah'];
                                                $keterangan = $i['Keterangan'];
                                                $role = $i['id_kegiatan'];


                                                $daftar_hari = array(
                                                    'Sunday' => 'Minggu',
                                                    'Monday' => 'Senin',
                                                    'Tuesday' => 'Selasa',
                                                    'Wednesday' => 'Rabu',
                                                    'Thursday' => 'Kamis',
                                                    'Friday' => 'Jumat',
                                                    'Saturday' => 'Sabtu'
                                                );

                                                $hari = date('l', strtotime($tanggal_ibadah));

                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $nama_ibadah; ?></td>
                                                <td><?php echo $tanggal != "" ? $daftar_hari[$hari] . ', ' . $tanggal_ibadah : ""; ?>
                                                </td>
                                                <td><?php echo $waktu_ibadah != "" ? 'Pukul ' . $waktu_ibadah . ' Wib' : "" ?>
                                                </td>
                                                <td><?php echo $keterangan; ?></td>
                                                <td style="text-align:right;">
                                                    <!-- <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $id_ibadah; ?>"><span class="fa fa-pencil"></span></a> -->
                                                    <!-- <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $id_ibadah; ?>"><span class="fa fa-trash"></span></a> -->
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
            </section>


            <!-- PETUGAS MISA -->
            <section class="content-header">
                <h1>
                    Petugas
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box">
                                <div class="box-header">
                                    <?php
                                    $query1 = $this->db->query("SELECT f.id as id_lainnya FROM tbl_lainnya f WHERE f.admin = '$id_admin'");
                                    $id_lainnya = $query1->row()->id_lainnya;


                                    $query2 = $this->db->query("SELECT L.name as nama_lainnya FROM tbl_lainnya L WHERE L.id = '$id_lainnya'");
                                    $nama_lainnya = $query2->row()->nama_lainnya;

                                    if(strpos(strtolower($nama_lainnya), "asrama") !== false)
                                    {
                                        $myModal = "#myModal";
                                    } else {
                                        $myModal = "#anggotaModal";
                                        echo "<script>console.log(".$myModal.")</script>";
                                    }
                                    ?>
                                    <a class="btn btn-success btn-flat" data-toggle="modal"
                                        data-target="<?php echo $myModal ?>"><span class="fa fa-plus"></span> Set
                                        Petugas</a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example2" class="table table-striped" style="font-size:12px;">
                                        <thead>
                                            <tr>
                                                <th style="width:70px;">No</th>
                                                <th>Nama Ibadah</th>
                                                <th>Bacaan</th>
                                                <th>Mazmur</th>
                                                <th>Doa Umat</th>
                                                <th>Persembahan</th>
                                                <th>Dirigen</th>
                                                <th>Organis</th>
                                                <th>Misdinar</th>
                                                <th style="text-align:right;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($petugas->result_array() as $i) :
                                                $no++;
                                                $id_ibadah = $i['id'];
                                                $nama_ibadah = $i['Ibadah'];
                                                $tanggal = $i['Tanggal_Ibadah'];
                                                $tanggal_ibadah = date('d F Y', strtotime($tanggal));
                                                $waktu_ibadah = $i['Waktu_Ibadah'];
                                                $keterangan = $i['Keterangan'];
                                                $bacaan = $i['Bacaan'];
                                                $mazmur = $i['Mazmur'];
                                                $doa_umat = $i['Doa'];
                                                $persembahan = $i['Persembahan'];
                                                $dirigen = $i['Dirigen'];
                                                $organis = $i['Organis'];
                                                $misdinar = $i['Misdinar'];

                                                $daftar_hari = array(
                                                    'Sunday' => 'Minggu',
                                                    'Monday' => 'Senin',
                                                    'Tuesday' => 'Selasa',
                                                    'Wednesday' => 'Rabu',
                                                    'Thursday' => 'Kamis',
                                                    'Friday' => 'Jumat',
                                                    'Saturday' => 'Sabtu'
                                                );

                                                $hari = date('l', strtotime($tanggal_ibadah));

                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $nama_ibadah; ?></td>
                                                <td><?php echo $bacaan; ?></td>
                                                <td><?php echo $mazmur; ?></td>
                                                <td><?php echo $doa_umat; ?></td>
                                                <td><?php echo $persembahan; ?></td>
                                                <td><?php echo $dirigen; ?></td>
                                                <td><?php echo $organis; ?></td>
                                                <td><?php echo $misdinar; ?></td>
                                                <td style="text-align:right;">
                                                    <a class="btn" data-toggle="modal"
                                                        data-target="#ModalEdit<?php echo $id_ibadah; ?>"><span
                                                            class="fa fa-pencil"></span></a>
                                                    <a class="btn" data-toggle="modal"
                                                        data-target="#ModalHapus<?php echo $id_ibadah; ?>"><span
                                                            class="fa fa-trash"></span></a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
        $this->load->view('admin_fakultas/v_footer');
        ?>

    </div>
    <!-- ./wrapper -->

    <!--Modal Add Pengguna-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Petugas Misa</h4>
                </div>
                <form class="form-horizontal" action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">


                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example3" class="table table-striped" style="font-size:12px;">
                                            <thead>
                                                <tr>
                                                    <th style="width:70px;">No</th>
                                                    <th>Nama</th>
                                                    <th>Program Studi</th>
                                                    <th>Aksi</th>
                                                    <!-- <th style="text-align:right;">Aksi</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                foreach ($mhs->result_array() as $i) :
                                                    $no++;
                                                    $id_mhs = $i['id'];
                                                    $nama_mhs = $i['nama'];
                                                    $prodi = $i['nama_prodi'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $nama_mhs ?></td>
                                                    <td><?php echo $prodi ?></td>
                                                    <td style="text-align:left;">
                                                        <input type="checkbox" name="selected_mhs"
                                                            value="<?php echo $i['id'] ?>"
                                                            data-name="<?php echo $nama_mhs ?>">
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="anggotaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Petugas Misa</h4>
                </div>
                <form class="form-horizontal" action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">


                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example4" class="table table-striped" style="font-size:12px;">
                                            <thead>
                                                <tr>
                                                    <th style="width:70px;">No</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                    <!-- <th style="text-align:right;">Aksi</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                foreach ($mhs->result_array() as $i) :
                                                    $no++;
                                                    $id_mhs = $i['id'];
                                                    $nama_mhs = $i['nama'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $nama_mhs ?></td>
                                                    <td style="text-align:left;">
                                                        <input type="checkbox" name="selected_mhs"
                                                            value="<?php echo $i['id'] ?>"
                                                            data-name="<?php echo $nama_mhs ?>">
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach ($petugas->result_array() as $i) :
        $role = $i["Role"];

    ?>
    <div class="modal fade" id="secondModal" tabindex="-1" role="dialog" aria-labelledby="secondModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="secondModalLabel">Selected Petugas Misa</h4>
                </div>
                <form class="form-horizontal"
                    action="<?php echo base_url() . 'admin_lainnya/petugas_misa_lainnya/set_petugas' ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id_ibadah" value="<?php echo $role ?>">
                        <table id="selectedItems" class="table table-striped" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamically filled rows will go here -->
                            </tbody>
                        </table>
                        <!-- Hidden inputs will be added dynamically -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach ?>


    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/datepicker/bootstrap-datepicker.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/timepicker/bootstrap-timepicker.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/daterangepicker/daterangepicker.js' ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
    <!-- page script -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get checked checkboxes
            let selectedItems = [];
            document.querySelectorAll('input[name="selected_mhs"]:checked').forEach(function(checkbox) {
                selectedItems.push({
                    id: checkbox.value,
                    name: checkbox.getAttribute('data-name')
                });
            });

            // Clear the table body in the second modal
            let tableBody = document.querySelector('#secondModal #selectedItems tbody');
            tableBody.innerHTML = '';

            // Clear hidden inputs
            let hiddenInputsContainer = document.querySelector('#secondModal form');
            hiddenInputsContainer.querySelectorAll('input[type="hidden"]').forEach(function(input) {
                input.remove();
            });

            // Populate the second modal with selected items
            selectedItems.forEach((item, index) => {
                let row = document.createElement('tr');
                row.innerHTML = `
                <td>${index + 1}</td>
                <td>${item.name}</td>
                <td>
                    <select class="form-control" name="tugas[${item.id}]">
                        <option value="">--Pilih Tugas--</option>
                        <option value="bacaan">Bacaan</option>
                        <option value="mazmur">Mazmur</option>
                        <option value="doa_umat">Doa Umat</option>
                        <option value="persembahan">Persembahan</option>
                        <option value="dirigen">Dirigen</option>
                        <option value="organis">Organis</option>
                        <option value="misdinar">Misdinar</option>
                    </select>
                </td>
            `;
                tableBody.appendChild(row);

                // Add hidden inputs for id_mhs
                let hiddenIdInput = document.createElement('input');
                hiddenIdInput.type = 'hidden';
                hiddenIdInput.name = `id_mhs[]`;
                hiddenIdInput.value = item.id;
                hiddenInputsContainer.appendChild(hiddenIdInput);
            });

            // Add a hidden input for id_ibadah
            let hiddenIbadahInput = document.createElement('input');
            hiddenIbadahInput.type = 'hidden';
            hiddenIbadahInput.name = 'id_ibadah'; // Adjust the name as needed
            hiddenIbadahInput.value =
                '<?php echo $role ?>'; // Assuming this PHP code is processed on the server-side
            hiddenInputsContainer.appendChild(hiddenIbadahInput);

            // Open the second modal
            $('#secondModal').modal('show');
        });
    });
    </script>

    <script>
    $(function() {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $("#example3").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $("#example4").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('#datepicker2').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('.datepicker3').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('.datepicker4').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $(".timepicker").timepicker({
            showInputs: true
        });

    });
    </script>
    <?php if ($this->session->flashdata('msg') == 'error') : ?>
    <script type="text/javascript">
    $.toast({
        heading: 'Error',
        text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
        showHideTransition: 'slide',
        icon: 'error',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#FF4859'
    });
    </script>

    <?php elseif ($this->session->flashdata('msg') == 'success') : ?>
    <script type="text/javascript">
    $.toast({
        heading: 'Success',
        text: "Jadwal Ibadah Berhasil disimpan ke database.",
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#7EC857'
    });
    </script>
    <?php elseif ($this->session->flashdata('msg') == 'edit') : ?>
    <script type="text/javascript">
    $.toast({
        heading: 'Info',
        text: "Jadwal Ibadah berhasil di update",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#00C9E6'
    });
    </script>
    <?php elseif ($this->session->flashdata('msg') == 'success-hapus') : ?>
    <script type="text/javascript">
    $.toast({
        heading: 'Success',
        text: "Jadwal Ibadah Berhasil dihapus.",
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#7EC857'
    });
    </script>
    <?php else : ?>

    <?php endif; ?>

</body>

</html>