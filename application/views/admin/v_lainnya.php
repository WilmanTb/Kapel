<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Lainnya</title>
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
                    Data Lainnya
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Master Data</a></li>
                    <li class="active">Lainnya</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box">
                                <div class="box-header">
                                    <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Add Lainnya</a>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-striped" style="font-size:13px;">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Admin</th>
                                                <th>Jumlah Anggota</th>
                                                <th style="text-align:end;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data->result_array() as $i) :
                                                $id_lainnya = $i['id'];
                                                $nama_lainnya = $i['name'];
                                                $admin_lainnya = $i['nama_admin'];
                                                // $total_anggota = $i['total_mahasiswa'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $nama_lainnya; ?></td>
                                                    <td><?php echo $admin_lainnya; ?></td>
                                                    <td>0 ANGGOTA</td>
                                                    <!-- <td><?php echo $total_mahasiswa; ?></td> -->

                                                    <td style="text-align:right;">
                                                        <a class="btn" href="<?php echo base_url() . 'admin/detail_lainnya?id=' . $id_lainnya; ?>"><span class="fa fa-eye"></span></a>
                                                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $id_lainnya; ?>"><span class="fa fa-pencil"></span></a>
                                                        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $id_lainnya; ?>"><span class="fa fa-trash"></span></a>
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

    <!--Modal Add Lainnya-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Lainnya</h4>
                </div>
                <form class="form-horizontal" action="<?php echo base_url() . 'admin/lainnya/add_lainnya'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                            <div class="col-sm-7">
                                <input type="text" name="nama_lainnya" class="form-control" id="inputUserName" placeholder="Nama" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName" class="col-sm-4 control-label">Admin</label>
                            <div class="col-sm-7">
                                <select class="form-control" name="admin_lainnya" required>
                                    <option value="" selected>Pilih Admin</option>
                                    <?php
                                    $query = $this->db->query("SELECT U.pengguna_id AS id_admin, U.pengguna_nama AS nama_admin
                                    FROM tbl_pengguna U 
                                    LEFT JOIN tbl_lainnya L
                                    ON U.pengguna_id = L.admin
                                    WHERE U.pengguna_level = '3' AND L.admin IS NULL");
                                    $results = $query->result_array();

                                    if ($results) {
                                        foreach ($results as $result) {
                                    ?>
                                            <option value="<?php echo ($result['id_admin']) ?>"><?php echo ($result['nama_admin']) ?></option>
                                    <?php
                                        }
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


    <?php foreach ($data->result_array() as $i) :
        $id_lainnya = $i['id'];
        $nama_lainnya = $i['name'];
        $admin_lainnya = $i['admin'];
    ?>
        <!--Modal Edit Lainnya-->
        <div class="modal fade" id="ModalEdit<?php echo $id_lainnya; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/lainnya/edit_lainnya'?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <input type="hidden" name="id_lainnya" value="<?php echo $id_lainnya; ?>" />

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" name="nama_lainnya" class="form-control" value="<?php echo $nama_lainnya; ?>" id="inputUserName" placeholder="Nama" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputUserName" class="col-sm-4 control-label">Admin</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="admin_lainnya" required>
                                        <option value="">Pilih Admin</option>
                                        <?php
                                        $query_lainnya = $this->db->query("SELECT*FROM tbl_lainnya WHERE id = $id_lainnya");
                                        $result_lainnya = $query_lainnya->result_array();
                                        $query = $this->db->query("SELECT U.pengguna_id AS id_admin, U.pengguna_nama AS nama_admin
                                        FROM tbl_pengguna U 
                                        INNER JOIN tbl_lainnya F
                                        ON U.pengguna_id = F.admin
                                        WHERE U.pengguna_level = '3'");
                                        $results = $query->result_array();
                                        if ($results) {
                                            foreach ($results as $result) {
                                                $selected = ($result['id_admin'] == $result_lainnya[0]['admin']) ? 'selected' : '';
                                        ?>
                                                <option value="<?php echo ($result['id_admin']) ?>" <?php echo $selected ?>><?php echo ($result['nama_admin']) ?></option>
                                        <?php
                                            }
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

    <?php foreach ($data->result_array() as $i) :
        $id_lainnya = $i['id'];
        $nama_lainnya = $i['name'];
    ?>
        <!--Modal Hapus Lainnya-->
        <div class="modal fade" id="ModalHapus<?php echo $id_lainnya; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Data</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url() . 'admin/lainnya/delete_lainnya'?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id_lainnya" value="<?php echo $id_lainnya; ?>" />
                            <p>Apakah Anda yakin mau menghapus <b><?php echo $nama_lainnya; ?></b> ?</p>

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
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
    <?php if ($this->session->flashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Data Berhasil disimpan ke database.",
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
                text: "Data berhasil di update",
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
                text: "Data Berhasil dihapus.",
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