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
        $this->load->model('m_dashboard_adm_fakultas');
    }

    function index()
    {
        $x['visitor'] = $this->m_dashboard_adm_fakultas->jadwal_bertugas();
        $x['fakultas'] = $this->m_dashboard_adm_fakultas->get_fakultas();
        $id_admin = $this->session->userdata('idadmin');
        $this->load->view('admin_fakultas/v_dashboard', $x);
    }
}
