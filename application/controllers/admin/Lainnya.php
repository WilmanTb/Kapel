<?php

class Lainnya extends CI_Controller
{
    private $view_url = "admin/lainnya";
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_lainnya');
    }

    public function index()
    {
        $x['data'] = $this->m_lainnya->get_all_lainnya();
        $this->load->view('admin/v_lainnya', $x);
    }

    public function add_lainnya()
    {
        $nama = $this->input->post('nama_lainnya');
        $admin = $this->input->post('admin_lainnya');
        $this->m_lainnya->add_lainnya($nama, $admin);
        echo $this->session->set_flashdata('msg','success');
        redirect($this->view_url);
    }

    public function edit_lainnya()
    {
        $nama = $this->input->post('nama_lainnya');
        $admin = $this->input->post('admin_lainnya');
        $id = $this->input->post('id_lainnya');
        $this->m_lainnya->edit_lainnya($id,$nama, $admin);
        echo $this->session->set_flashdata('msg','edit');
        redirect($this->view_url);
    }

    public function delete_lainnya()
    {
        $id = $this->input->post('id_lainnya');
        $this->m_lainnya->delete_lainnya($id);
        echo $this->session->set_flashdata('msg','success-hapus');
        redirect($this->view_url);
    }
}
