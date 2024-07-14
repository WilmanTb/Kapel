<?php
class Petugas extends CI_Controller
{
    private $view_url = 'admin/petugas';

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_petugas');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');
        $id = $this->input->get('id');

        $x['data'] = $this->m_petugas->get_all_data();

        $this->load->view('admin/v_petugas', $x);
    }
}