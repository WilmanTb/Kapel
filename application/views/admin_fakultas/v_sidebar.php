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
        <a href="<?php echo base_url() . 'admin_fakultas/dashboard' ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

      <li class="<?php echo $page == 'master-data' ? 'active' : ''; ?>" id="m_master_data">
        <a href="<?php echo base_url() . 'admin_fakultas/master_data_fakultas' ?>">
          <i class="fa fa-database"></i> <span>Master Data</span>
          <span class="pull-right-container">
            <small class="label pull-right"></small>
          </span>
        </a>
      </li>

      <li class="treeview <?php echo $page == 'petugas' ? 'active' : ''; ?>" id="m_petugas">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Petugas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url() . 'admin_fakultas/petugas_misa' ?>"><i class="fa fa-plus"></i> Misa </a></li>
          <!-- <li><a href="<?php echo base_url() . 'admin_fakultas/petugas_fakultas_lainnya' ?>"><i class="fa fa-list"></i> Lainnya</a></li> -->
        </ul>
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