<?php

class Fakultas extends CI_Controller
{
    private $view_url = "admin/fakultas";
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_fakultas');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');
        $type = $this->input->get('type');

        $x['data'] = $this->m_fakultas->get_all_fakultas($type);

        if ($type == "1") {
            $this->load->view('admin/v_fakultas', $x);
        } else {
            // $this->load->view('admin/v_fakultas_lainnya', $x);
        }
    }

    public function add_fakultas()
    {
        $is_fakultas = $this->input->get('type');
        $nama_fakultas = $this->input->post("nama_fakultas");
        $admin_fakultas = $this->input->post("admin_fakultas");

        $this->m_fakultas->add_fakultas($nama_fakultas, $admin_fakultas, $is_fakultas);
        echo $this->session->set_flashdata('msg','success');
        redirect($this->view_url."?type=$is_fakultas");
        
    }

    public function edit_fakultas()
    {
        $is_fakultas = $this->input->post('is_fakultas');
        $id_fakultas = $this->input->post('id_fakultas');
        $nama_fakultas = $this->input->post('nama_fakultas');
        $admin_fakultas = $this->input->post('admin_fakultas');

        $this->m_fakultas->edit_fakultas($id_fakultas, $nama_fakultas, $admin_fakultas);
        echo $this->session->set_flashdata('msg', 'edit');
        redirect($this->view_url."?type=$is_fakultas");
    }
}
