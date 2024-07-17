<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petugas Lainnya</title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php
        $this->load->view('admin/v_header');
        ?>
        <?php
        $page = array(
            "page" => "petugas"
        );
        $this->load->view('admin/v_sidebar', $page);
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Petugas Lainnya
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Petugas</a></li>
                    <li class="active"> Lainnya</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box">
                                <div class="box-header">
                                    <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Set Petugas</a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-striped" style="font-size:12px;">
                                        <thead>
                                            <tr>
                                                <th style="width:70px;">No</th>
                                                <th>Nama Ibadah</th>
                                                <th>Petugas</th>
                                                <th>Tanggal</th>
                                                <th style="text-align:right;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($data->result_array() as $i) :
                                                $no++;
                                                $id = $i['id'];
                                                $nama_ibadah = $i['nama_ibadah'];
                                                $petugas = $i['nama_fakultas'];
                                                $tanggal = $i['tanggal_ibadah'];
                                                $tanggal_ibadah = date('d F Y', strtotime($tanggal));

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
                                                    <td><?php echo $petugas; ?></td>
                                                    <td><?php echo $daftar_hari[$hari] . ', ' . $tanggal_ibadah; ?></td>
                                                    <td style="text-align:right;">
                                                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $id; ?>"><span class="fa fa-pencil"></span></a>
                                                        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $id; ?>"><span class="fa fa-trash"></span></a>
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
        $this->load->view('admin/v_footer');
        ?>

    </div>
    <!-- ./wrapper -->

    <!--Modal Add Pengguna-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">Set Petugas</h4>
                </div>
                <form class="form-horizontal" action="<?php echo base_url() . 'admin/petugas_lainnya/set_petugas' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Pilih Ibadah (Lainnya) </label>
                            <div class="col-sm-7">
                                <select class="form-control" name="jadwal_ibadah_misa" required>
                                    <option value="">Pilih Ibadah</option>
                                    <?php foreach ($jadwal as $item) : ?>
                                        <?php
                                        if ($item["is_set"] != '1') {
                                        ?>
                                            <option value="<?php echo htmlspecialchars($item['id']); ?>"><?php echo htmlspecialchars($item['nama_ibadah']); ?></option>

                                        <?php
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Pilih Petugas (Fakultas)</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="petugas_fakultas" required>
                                    <option value="">Pilih Fakultas</option>
                                    <?php foreach ($fakultas->result_array() as $item) : ?>
                                        <option value="<?php echo htmlspecialchars($item['id']); ?>"><?php echo htmlspecialchars($item['nama_fakultas']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Pilih Petugas (Lainnya)</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="petugas_lainnya" required>
                                    <option value="">Pilih Lainnya</option>
                                    <?php foreach ($lainnya->result_array() as $item) : ?>
                                        <option value="<?php echo htmlspecialchars($item['id']); ?>"><?php echo htmlspecialchars($item['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php foreach ($data->result_array() as $i) :
        $id = $i['id'];
        $nama_ibadah = $i['nama_ibadah'];
        $petugas = $i['nama_fakultas'];
        $id_petugas = $i["id_petugas"];
        $is_fakultas = $i["is_fakultas"];
        $id_kegiatan = $i["id_kegiatan"];
    ?>
        <!--Modal Edit Pengguna-->
        <div class="modal fade" id="ModalEdit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Ibadah</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/petugas_lainnya/edit_petugas' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id_jadwal_petugas" value="<?php echo $id; ?>" />
                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Pilih Ibadah (Lainnya) </label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="jadwal_ibadah_misa" required disabled>
                                        <option value="">Pilih Ibadah</option>
                                        <?php foreach ($jadwal as $item) : ?>
                                            <?php
                                            $selected = "";
                                            if ($item["is_set"] == "1") {
                                                if($item['id'] == $id_kegiatan)
                                                {
                                                    $selected = "selected";
                                                }
                                                
                                            }
                                            ?>
                                            <option value="<?php echo htmlspecialchars($item['id']); ?>" <?php echo $selected ?>><?php echo htmlspecialchars($item['nama_ibadah']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Pilih Petugas (Fakultas)</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="petugas_fakultas1" required>
                                        <option value="">Pilih Fakultas</option>
                                        <?php foreach ($fakultas->result_array() as $item) : ?>
                                            <?php
                                            $selected ="";
                                            if ($is_fakultas == "1") {
                                                $selected = ($item['id'] == $id_petugas) ? 'selected' : '';
                                            }
                                            ?>
                                            <option value="<?php echo htmlspecialchars($item['id']); ?>" <?php echo $selected ?>><?php echo htmlspecialchars($item['nama_fakultas']); ?></option>
                                            
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Pilih Petugas (Lainnya)</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="petugas_lainnya1" required>
                                        <option value="">Pilih Lainnya</option>
                                        <?php foreach ($lainnya->result_array() as $item) : ?>
                                            <?php
                                            $selected = "";
                                            if ($is_fakultas == 0) {
                                                $selected = ($item['id'] == $id_petugas) ? 'selected' : '';
                                            }
                                            ?>
                                            <option value="<?php echo htmlspecialchars($item['id']); ?>" <?php echo $selected ?>><?php echo htmlspecialchars($item['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($data->result_array() as $i) :
        $id = $i['id'];
        $nama_ibadah = $i['nama_ibadah'];
        $petugas = $i['nama_fakultas'];
        $id_petugas = $i["id_petugas"];
        $is_fakultas = $i["is_fakultas"];
        $id_kegiatan = $i["id_kegiatan"];

    ?>
        <!--Modal Hapus Pengguna-->
        <div class="modal fade" id="ModalHapus<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Petugas Ibadah</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/petugas_lainnya/delete_petugas' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id_jadwal_petugas" value="<?php echo $id; ?>" />
                            <input type="hidden" name="id_petugas" value="<?php echo $id_petugas; ?>" />
                            <input type="hidden" name="id_kegiatan" value="<?php echo $id_kegiatan; ?>" />
                            <p>Apakah Anda yakin mau menghapus Jadwal Petugas : <b><?php echo $nama_ibadah; ?></b> ?</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>




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
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
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
                text: "Petugas Berhasil di set",
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
                text: "Petugas berhasil di update",
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
                text: "Petugas Berhasil dihapus.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php else : ?>

    <?php endif; ?>

    <script>
        $(document).ready(function() {
            $('select[name="petugas_fakultas"]').change(function() {
                if ($(this).val() !== "") {
                    $('select[name="petugas_lainnya"]').prop('disabled', true);
                } else {
                    $('select[name="petugas_lainnya"]').prop('disabled', false);
                }
            });

            $('select[name="petugas_lainnya"]').change(function() {
                if ($(this).val() !== "") {
                    $('select[name="petugas_fakultas"]').prop('disabled', true);
                } else {
                    $('select[name="petugas_fakultas"]').prop('disabled', false);
                }
            });

            $('select[name="petugas_fakultas1"]').change(function() {
                if ($(this).val() !== "") {
                    $('select[name="petugas_lainnya1"]').prop('disabled', true);
                    $('select[name="petugas_lainnya1"]').prop('value', "");
                } else {
                    $('select[name="petugas_lainnya1"]').prop('disabled', false);
                }
            });

            $('select[name="petugas_lainnya1"]').change(function() {
                if ($(this).val() !== "") {
                    $('select[name="petugas_fakultas1"]').prop('disabled', true);
                    $('select[name="petugas_fakultas1"]').prop('value', "");
                } else {
                    $('select[name="petugas_fakultas1"]').prop('disabled', false);
                }
            });
        });
    </script>
</body>

</html>