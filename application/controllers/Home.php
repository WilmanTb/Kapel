<?php
class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_renungan');
		$this->load->model('m_galeri');
		$this->load->model('m_pengumuman');
		$this->load->model('m_warta');
		$this->load->model('m_agenda');
		$this->load->model('m_files');
		$this->load->model('m_jadwalibadah');
		$this->load->model('m_jadwalpetugas');
		$this->load->model('m_jadwal_misa');
		$this->load->model('m_pengunjung');
		$this->m_pengunjung->count_visitor();
	}
	function index(){
			$x['renungan']=$this->m_renungan->get_berita_home();
			$x['video']=$this->m_renungan->get_berita_video();
			$x['warta']=$this->m_warta->get_warta_home();
			$x['pengumuman']=$this->m_pengumuman->get_pengumuman_home();
			$x['jadwalibadah']=$this->m_jadwal_misa->get_all_misa();
			$x['jadwalpetugas']=$this->m_jadwalpetugas->get_all_petugastanggal();
			$x['agenda']=$this->m_agenda->get_agenda_home();
			$x['tot_misa']=$this->db->get('tbl_misa')->num_rows();
			$x['tot_fakultas']=$this->db->get('tbl_fakultas')->num_rows();
			$x['tot_jemaat']=$this->db->get('tbl_mahasiswa')->num_rows();
			$x['tot_agenda']=$this->db->get('tbl_agenda')->num_rows();
			$this->load->view('depan/v_home',$x);
	}

}
