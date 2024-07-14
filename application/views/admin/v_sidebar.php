<?php
$query = $this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$query2 = $this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
$jum_comment = $query2->num_rows();
$jum_pesan = $query->num_rows();
?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">Menu Utama</li>

      <li class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>" id="m_dashboard">
        <a href="<?php echo base_url() . 'admin/dashboard' ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

      <li class="treeview <?php echo $page == 'admin' ? 'active' : ''; ?>" id="m_admin">
        <a href="#">
          <i class="fa fa-group"></i>
          <span>Administrator</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url() . 'admin/pengguna?type=super_admin' ?>"><i class="fa fa-user-plus"></i> Super Admin</a></li>
          <li><a href="<?php echo base_url() . 'admin/pengguna?type=admin_fakultas' ?>"><i class="fa fa-user-plus"></i> Admin Fakultas</a></li>
        </ul>
      </li>

      <li class="treeview <?php echo $page == 'master_data' ? 'active' : ''; ?>" id="m_admin">
        <a href="#">
          <i class="fa fa-database"></i>
          <span>Master Data</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url() . 'admin/fakultas?type=1' ?>"><i class="fa fa-building-o"></i> Fakultas</a></li>
          <li><a href="<?php echo base_url() . 'admin/lainnya' ?>"><i class="fa fa-bars"></i> Lainnya</a></li>
        </ul>
      </li>

      <li class="treeview <?php echo $page == 'jadwal' ? 'active' : ''; ?>" id="m_jadwal">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Jadwal</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url() . 'admin/jadwal_misa' ?>"><i class="fa fa-plus"></i> Misa </a></li>
          <li><a href="<?php echo base_url() . 'admin/jadwal_lainnya' ?>"><i class="fa fa-list"></i> Lainnya</a></li>
        </ul>
      </li>

      <li class="<?php echo $page == 'petugas' ? 'active' : ''; ?>" id="m_petugas_misa">
        <a href="<?php echo base_url() . 'admin/petugas' ?>">
          <i i class="fa fa-user"></i> <span>Petugas</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

      <li class="<?php echo $page == 'pengumuman' ? 'active' : ''; ?>" id="m_pengumuman">
        <a href="<?php echo base_url() . 'admin/pengumuman' ?>">
          <i class="fa fa-volume-up"></i> <span>Pengumuman</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

      <li <?php echo $page == 'agenda' ? 'active' : ''; ?> id="m_agenda">
        <a href="<?php echo base_url() . 'admin/agenda' ?>">
          <i class="fa fa-calendar"></i> <span>Agenda</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

      <li <?php echo $page == 'gallery' ? 'active' : ''; ?> id="m_gallery">
        <a href="<?php echo base_url() . 'admin/agenda' ?>">
          <i class="fa fa-camera"></i> <span>Gallery</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

      <li class="treeview <?php echo $page == 'cetak' ? 'active' : ''; ?>" id="m_cetak">
        <a href="#">
          <i class="fa fa-print"></i>
          <span>Cetak</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url() . 'admin/jadwalibadah' ?>"><i class="fa fa-dollar"></i> Data Kolekte </a></li>
        </ul>
      </li>

      <li class=" <?php echo $page == 'inbox' ? 'active' : ''; ?>" id="m_inbox">
        <a href="<?php echo base_url() . 'admin/inbox' ?>">
          <i class="fa fa-envelope"></i> <span>Inbox</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green"><?php echo $jum_pesan; ?></small>
          </span>
        </a>
      </li>

      <li class="<?php echo $page == 'komentar' ? 'active' : ''; ?>" id="m_komentar">
        <a href="<?php echo base_url() . 'admin/komentar' ?>">
          <i class="fa fa-comments"></i> <span>Komentar</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green"><?php echo $jum_comment; ?></small>
          </span>
        </a>
      </li>

      <li>
        <a href="<?php echo base_url() . 'administrator' ?>">
          <i class="fa fa-sign-out"></i> <span>Sign Out</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>


<script>

</script>