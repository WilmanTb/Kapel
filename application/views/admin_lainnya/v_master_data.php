<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Master Data</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'theme/images/UNIKA1.png' ?>">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php
            $this->load->view('admin_lainnya/v_header');
        ?>
        <?php
        $page = array(
            "page" => "master-data",
        );
        $this->load->view('admin_lainnya/v_sidebar', $page);
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <b>Master Data</b>
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Master Data</a></li>
                </ol>
                <h3>
                    Data Anggota
                    <small></small>
                </h3>
            </section>
            <section class="content" style="margin-bottom: -30px;">
                <div class="row">
                    <div class="col-xs-12" style="width: 50%;">
                        <div class="box">

                            <div class="box">
                                <div class="box-header">
                                    <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#addMhs"><span
                                            class="fa fa-user-plus"></span> Add Anggota</a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-striped" style="font-size:13px;">
                                        <thead>
                                            <tr>
                                                <th>Nama Anggota</th>
                                                <th style="text-align:center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($mhs->result_array() as $i) :
                                                $id = $i['id'];
                                                $nama_anggota = $i['nama'];

                                                //    $jlh_mahasiswa=$i['jlh_mahasiswa'];
                                            ?>
                                            <tr>
                                                <td><?php echo $nama_anggota; ?></td>

                                                <td style="text-align:right;">
                                                            <?php if (!array_key_exists('lainnya', $i) || !$i['lainnya']) { ?>
                                                                <a class="btn" data-toggle="modal" data-target="#editMhs<?php echo $id; ?>"><span class="fa fa-pencil"></span></a>
                                                            <?php } ?>
                                                            <a class="btn" data-toggle="modal" data-target="#deleteMhs<?php echo $id; ?>"><span class="fa fa-trash"></span></a>
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
$this->load->view('admin_lainnya/v_footer');
?>

    </div>
    <!-- ./wrapper -->

    <!--Modal Add Prodi-->
    <?php 
    $lainnya = explode("_",$data_lainnya);

    $id_lainnya = $lainnya[0];
    $nama_lainnya  =$lainnya[1];
    ?>
    <!--Modal Add Anggota-->
    <div class="modal fade" id="addMhs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Anggota</h4>
                </div>
                <form class="form-horizontal"
                    action="<?php echo base_url() . 'admin_lainnya/master_data_lainnya/add_anggota' ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" value="<?php echo $id_lainnya ?>" name="id_lainnya">
                        <input type="hidden" value="<?php echo $nama_lainnya ?>" name="nama_lainnya">

                        <?php
                        $query = $this->db->query("SELECT*FROM tbl_lainnya WHERE id = $id_lainnya");
                        $result = $query->row();
                        if (strpos(strtolower ($result->name), "asrama") !== false) {
                        ?>
                        <table id="example2" class="table table-striped" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th>Mahasiswa</th>
                                    <th>Fakultas</th>
                                    <th>Prodi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $mhs_q = $this->db->query("SELECT m.*, f.nama_fakultas as nama_fakultas, p.nama as nama_prodi
                    FROM tbl_mahasiswa m 
                    INNER JOIN tbl_fakultas f ON f.id = m.id_fakultas
                    INNER JOiN tbl_prodi p ON p.id = m.program_studi
                    WHERE m.lainnya IS NULL
                    ");
                                    $mhs_r = $mhs_q->result_array();

                                    foreach ($mhs_r as $mahasiswa) {
                                    ?>
                                <tr>
                                    <td><?php echo $mahasiswa["nama"] ?></td>
                                    <td><?php echo $mahasiswa["nama_fakultas"] ?></td>
                                    <td><?php echo $mahasiswa["nama_prodi"] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm"
                                            onclick="addMahasiswa(<?php echo $mahasiswa['id'] ?>); return false;">
                                            <span class="fa fa-plus"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="id_mhs" value="">
                        <?php
                        } else {
                        ?>
                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                            <div class="col-sm-7">
                                <input type="text" name="nama_anggota" class="form-control" id="inputUserName"
                                    placeholder="Nama Lengkap" required>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>

                    <?php if (strpos(strtolower ($result->name), "asrama") === false) { ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                    </div>
                    <?php } ?>
                </form>

            </div>
        </div>
    </div>

    <?php
    foreach ($mhs->result_array() as $i) :
        $id_anggota = $i['id'];
        $nama_anggota = $i['nama'];
    ?>
        <!--Modal Edit Prodi-->
        <div class="modal fade" id="editMhs<?php echo $id_anggota; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Anggota</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin_lainnya/master_data_lainnya/edit_anggota' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <input type="hidden" name="id_anggota" value="<?php echo $id_anggota ?>">

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" name="nama_anggota" class="form-control" value="<?php echo $nama_anggota; ?>" id="inputUserName" placeholder="Nama" required>
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

    <?php 
    
    foreach ($mhs->result_array() as $i) :
        $id_anggota = $i['id'];
        $nama_anggota = $i['nama'];
        $lainnya = explode("_",$data_lainnya);

    $id_lainnya = $lainnya[0];
    $nama_lainnya  =$lainnya[1];
    ?>
        <!--Modal Hapus Anggota-->
        <div class="modal fade" id="deleteMhs<?php echo $id_anggota; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Anggota</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin_lainnya/master_data_lainnya/delete_anggota' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id_anggota" value="<?php echo $id_anggota ?>">
                            <input type="hidden" name="id_lainnya" value="<?php echo $id_lainnya ?>">
                            <input type="hidden" name="nama_anggota" value="<?php echo $nama_anggota ?>">

                            <p>Apakah Anda yakin mau menghapus : <b><?php echo $nama_anggota; ?></b> ?</p>

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
    <!-- FastClick -->
    <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
    <!-- page script -->
    <script>
        function addMahasiswa(id) {
            var form = document.querySelector('form');
            form.querySelector('input[name="id_mhs"]').value = id;
            form.submit();
        }
    </script>
    <script>
    $(function() {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "pageLength": 0,
            "lengthMenu": [5, 10, 20, 100],
        })
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "pageLength": 0,
            "lengthMenu": [5, 10, 20, 100],
        });
    });
    </script>
    <?php if ($this->session->flashdata('msg') == 'success'): ?>
    <script type="text/javascript">
    $.toast({
        heading: 'Success',
        text: "Data berhasil disimpan ke database.",
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#7EC857'
    });
    </script>
    <?php elseif ($this->session->flashdata('msg') == 'edit'): ?>
    <script type="text/javascript">
    $.toast({
        heading: 'Info',
        text: "Data berhasil di update",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#00C9E6'
    });
    </script>
    <?php elseif ($this->session->flashdata('msg') == 'success-hapus'): ?>
    <script type="text/javascript">
    $.toast({
        heading: 'Success',
        text: "Data berhasil dihapus.",
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#7EC857'
    });
    </script>
    <?php else: ?>

    <?php endif;?>
</body>

</html>