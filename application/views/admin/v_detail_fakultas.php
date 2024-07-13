<?php
$type = isset($_GET['type']) ? $_GET['type'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

$query = $this->db->query("SELECT F.nama_fakultas FROM tbl_fakultas F WHERE F.id = '$id'");
$nama_fakultas = $query->row();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Detail Fakultas <?php echo $nama_fakultas->nama_fakultas; ?></title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php
        $this->load->view('admin/v_header');
        ?>
        <?php
        $page = array(
            "page" => "master_data"
        );
        $this->load->view('admin/v_sidebar', $page);
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <b>Data Fakultas <?php echo $nama_fakultas->nama_fakultas; ?></b>
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Master Data</a></li>
                    <li>Fakultas</li>
                    <li class="active">Detail Fakultas <?php echo $nama_fakultas->nama_fakultas; ?></li>
                </ol>
                <h3>
                    Program Studi
                    <small></small>
                </h3>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12" style="width: 50%;">
                        <div class="box">

                            <div class="box">
                                <div class="box-header">
                                    <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#addProdi"><span class="fa fa-user-plus"></span> Add Program Studi</a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-striped" style="font-size:13px;">
                                        <thead>
                                            <tr>
                                                <th>Program Studi</th>
                                                <th style="text-align:center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($prodi->result_array() as $i) :
                                                $id_prodi = $i['id'];
                                                $nama_prodi = $i['nama'];
                                                //    $jlh_mahasiswa=$i['jlh_mahasiswa'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $nama_prodi; ?></td>

                                                    <td style="text-align:center;">
                                                        <a class="btn" data-toggle="modal" data-target="#editProdi<?php echo $id_prodi; ?>"><span class="fa fa-pencil"></span></a>
                                                        <a class="btn" data-toggle="modal" data-target="#deleteProdi<?php echo $id_prodi; ?>"><span class="fa fa-trash"></span></a>
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

            <section class="content-header">
                <h3>
                    Data Mahasiswa
                </h3>

            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box">
                                <div class="box-header">
                                    <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#addMhs"><span class="fa fa-user-plus"></span> Add Mahasiswa</a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example2" class="table table-striped" style="font-size:13px;">
                                        <thead>
                                            <tr>
                                                <th>Nama Mahasiswa</th>
                                                <th>Fakultas</th>
                                                <th>Program Studi</th>
                                                <th style="text-align:end;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data->result_array() as $i) :
                                                $id_mhs = $i['id'];
                                                $nama_mahasiswa = $i['nama'];
                                                $nama_fakultas = $i['nama_fakultas'];
                                                $nama_prodi = $i['nama_prodi'];
                                                //    $jlh_mahasiswa=$i['jlh_mahasiswa'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $nama_mahasiswa; ?></td>
                                                    <td><?php echo $nama_fakultas; ?></td>
                                                    <td><?php echo $nama_prodi; ?></td>

                                                    <td style="text-align:right;">
                                                        <a class="btn" data-toggle="modal" data-target="#editMhs<?php echo $id_mhs; ?>"><span class="fa fa-pencil"></span></a>
                                                        <a class="btn" data-toggle="modal" data-target="#deleteMhs<?php echo $id_mhs; ?>"><span class="fa fa-trash"></span></a>
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

    <!--Modal Add Prodi-->
    <div class="modal fade" id="addProdi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Program Studi</h4>
                </div>
                <form class="form-horizontal" action="<?php echo base_url() . 'admin/detail_fakultas/add_prodi' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <input type="hidden" name="id_fakultas" value="<?php echo $id ?>">
                        <input type="hidden" name="type" value="<?php echo $type ?>">

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Nama Program Studi</label>
                            <div class="col-sm-7">
                                <input type="text" name="nama_prodi" class="form-control" id="inputUserName" placeholder="Program Studi" required>
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

    <!--Modal Add Mahasiswa-->
    <div class="modal fade" id="addMhs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Mahasiswa</h4>
                </div>
                <form class="form-horizontal" action="<?php echo base_url() . 'admin/detail_fakultas/add_mahasiswa' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <input type="hidden" name="id_fakultas" value="<?php echo $id ?>">
                        <input type="hidden" name="type" value="<?php echo $type ?>">

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Nama Mahasiswa</label>
                            <div class="col-sm-7">
                                <input type="text" name="nama_mhs" class="form-control" id="inputUserName" placeholder="Nama" required>
                            </div>
                        </div>
                        <!-- Dropdown for selecting program of study -->
                        <div class="form-group">
                            <label for="prodi_mhs" class="col-sm-4 control-label">Program Studi</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="prodi_mhs" id="prodi_mhs" required>
                                    <option value="" selected>Pilih program studi</option>
                                    <?php
                                    $query = $this->db->query("SELECT*FROM tbl_prodi WHERE id_fakultas = $id");
                                    $results = $query->result_array();

                                    foreach ($results as $result) {
                                    ?>
                                        <option value="<?php echo $result["id"] ?>"><?php echo $result["nama"] ?></option>
                                    <?php
                                    }
                                    ?>
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

    <?php foreach ($prodi->result_array() as $i) :
        $id_prodi = $i["id"];
        $nama_prodi = $i["nama"];
    ?>
        <!--Modal Edit Prodi-->
        <div class="modal fade" id="editProdi<?php echo $id_prodi; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Prodi</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/detail_fakultas/edit_prodi' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <input type="hidden" name="id_fakultas" value="<?php echo $id ?>">
                            <input type="hidden" name="id_prodi" value="<?php echo $id_prodi ?>">
                            <input type="hidden" name="type" value="<?php echo $type ?>">

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>
                                <div class="col-sm-7">
                                    <?php
                                    $query = $this->db->query("SELECT*FROM tbl_prodi WHERE id = '$id_prodi'");
                                    $results = $query->result_array();
                                    foreach ($results as $result) {
                                        $pNama = $result["nama"] == $nama_prodi ? $result["nama"] : "";

                                    ?>
                                        <input type="text" name="nama_prodi" class="form-control" value="<?php echo $pNama; ?>" id="inputUserName" placeholder="Nama" required>
                                    <?php
                                    }
                                    ?>
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
        $id_mhs = $i['id'];
        $nama_mahasiswa = $i['nama'];
        $nama_prodi = $i['nama_prodi'];
        $id_prodi = $i["program_studi"];
    ?>
        <!--Modal Edit Mahasiswa-->
        <div class="modal fade" id="editMhs<?php echo $id_mhs; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Mahasiswa</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/detail_fakultas/edit_mahasiswa' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <input type="hidden" name="id_mhs" value="<?php echo $id_mhs ?>">
                            <input type="hidden" name="id_fakultas" value="<?php echo $id ?>">
                            <input type="hidden" name="type" value="<?php echo $type ?>">

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" name="nama_mahasiswa" class="form-control" value="<?php echo $nama_mahasiswa; ?>" id="inputUserName" placeholder="Nama" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Program Studi</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="prodi_mhs" id="prodi_mhs" required>
                                        <option value="">Pilih program studi</option>
                                        <?php
                                        $query = $this->db->query("SELECT*FROM tbl_prodi WHERE id_fakultas = $id");
                                        $results = $query->result_array();

                                        foreach ($results as $result) {
                                            $selected = ($result['id'] == $id_prodi) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo ($result['id']) ?>" <?php echo $selected ?>><?php echo ($result['nama']) ?></option>
                                        <?php
                                        }
                                        ?>
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

    <?php foreach ($prodi->result_array() as $i) :
        $id_prodi = $i["id"];
        $nama_prodi = $i["nama"];
    ?>
        <!--Modal Hapus Prodi-->
        <div class="modal fade" id="deleteProdi<?php echo $id_prodi; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Program Studi</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/detail_fakultas/delete_prodi' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id_prodi" value="<?php echo $id_prodi ?>">
                            <input type="hidden" name="id_fakultas" value="<?php echo $id ?>">
                            <input type="hidden" name="type" value="<?php echo $type ?>">

                            <?php
                            $query = $this->db->query("SELECT*FROM tbl_prodi WHERE id = '$id_prodi'");
                            $results = $query->result_array();
                            foreach ($results as $result) {
                                $pNama = $result["nama"] == $nama_prodi ? $result["nama"] : "";

                            ?>
                                <p>Apakah Anda yakin mau menghapus Program Studi : <b><?php echo $pNama; ?></b> ?</p>
                            <?php
                            }

                            ?>

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

    <?php foreach ($data->result_array() as $i) :
        $id_mhs = $i['id'];
        $nama_mahasiswa = $i['nama'];
        $nama_prodi = $i['nama_prodi'];
        $id_prodi = $i["program_studi"];
    ?>
        <!--Modal Hapus Mahasiswa-->
        <div class="modal fade" id="deleteMhs<?php echo $id_mhs; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Mahasiswa</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/detail_fakultas/delete_mahasiswa' ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id_mhs" value="<?php echo $id_mhs ?>">
                            <input type="hidden" name="id_fakultas" value="<?php echo $id ?>">
                            <input type="hidden" name="type" value="<?php echo $type ?>">

                            <p>Apakah Anda yakin mau menghapus Mahasiswa : <b><?php echo $nama_mahasiswa; ?></b> ?</p>

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
    <?php if ($this->session->flashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "<?php echo $this->session->flashdata('msg_text'); ?> berhasil disimpan ke database.",
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
                text: "<?php echo $this->session->flashdata('msg_text'); ?> berhasil di update",
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
                text: "<?php echo $this->session->flashdata('msg_text'); ?> berhasil dihapus.",
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