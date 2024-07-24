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
        $this->load->model('m_dashboard_adm_lainnya');
    }

    function index()
    {
        $x['visitor'] = $this->m_dashboard_adm_lainnya->jadwal_bertugas();
        $x['fakultas'] = $this->m_dashboard_adm_lainnya->get_fakultas();
        $id_admin = $this->session->userdata('idadmin');
        $this->load->view('admin_lainnya/v_dashboard', $x);
    }
}
