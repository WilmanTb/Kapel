<?php
class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('m_pengunjung');
	}

	function index()
	{
		if ($this->session->userdata('akses') == '1') {
			$x['visitor'] = $this->m_pengunjung->statistik_pengujung();
			$this->load->view('admin/v_dashboard', $x);
		} elseif ($this->session->userdata('akses') == '2') {
			// $x['visitor'] = $this->m_dashboard_adm_fakultas->jadwal_bertugas();
			// $this->load->view('admin_fakultas/v_dashboard',$x);
			redirect('admin_fakultas/dashboard');
		} elseif ($this->session->userdata('akses') == '3') {
			redirect('admin_lainnya/dashboard');
		} else {
			$x['visitor'] = $this->m_pengunjung->statistik_pengujung();
			redirect('administrator');
		}
	}
}
