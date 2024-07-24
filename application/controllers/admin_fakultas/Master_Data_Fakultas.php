<?php

class Master_Data_Fakultas extends CI_Controller
{
    private $view_url = "admin_fakultas/master_data_fakultas";
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_master_data_fakultas');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');

        $x['mhs'] = $this->m_master_data_fakultas->get_all_mahasiswa($kode);
        $x['prodi'] = $this->m_master_data_fakultas->get_all_prodi($kode);
        $x['id_admin'] = $kode;


        $this->load->view('admin_fakultas/v_master_data', $x);
        // $this->load->view('admin/v_fakultas_lainnya', $x);
    }

    public function add_prodi()
    {
        $id_admin = $this->input->post('id_admin');
        $nama_prodi = $this->input->post('nama_prodi');

        $this->m_master_data_fakultas->add_prodi($id_admin, $nama_prodi);
        echo $this->session->set_flashdata('msg', 'success');
        redirect($this->view_url);
    }

    public function add_mahasiswa()
    {
        $id_admin = $this->input->post('id_admin');
        $nama_mhs = $this->input->post('nama_mhs');
        $prodi_mhs = $this->input->post('prodi_mhs');

        $this->m_master_data_fakultas->add_mahasiswa($id_admin, $nama_mhs, $prodi_mhs);
        echo $this->session->set_flashdata('msg', 'success');
        redirect($this->view_url);
    }

    public function edit_prodi()
    {
        $id_admin = $this->input->post('id_admin');
        $id_prodi = $this->input->post('id_prodi');
        $nama_prodi = $this->input->post('nama_prodi');

        $this->m_master_data_fakultas->edit_prodi($id_admin, $id_prodi, $nama_prodi);
        echo $this->session->set_flashdata('msg', 'edit');
        redirect($this->view_url);
    }

    public function edit_mahasiswa()
    {
        $id_mahasiswa = $this->input->post('id_mhs');
        $nama_mahasiswa = $this->input->post('nama_mahasiswa');
        $id_prodi = $this->input->post('prodi_mhs');

        $this->m_master_data_fakultas->edit_mahasiswa($id_mahasiswa, $nama_mahasiswa, $id_prodi);
        echo $this->session->set_flashdata('msg', 'edit');
        redirect($this->view_url);
    }

    public function delete_prodi()
    {
        $id_prodi = $this->input->post('id_prodi');

        $this->m_master_data_fakultas->delete_prodi($id_prodi);
        echo $this->session->set_flashdata('msg', 'success-hapus');
        redirect($this->view_url);
    }

    public function delete_mahasiswa()
    {
        $id_mhs = $this->input->post('id_mhs');

        $this->m_master_data_fakultas->delete_mahasiswa($id_mhs);
        echo $this->session->set_flashdata('msg', 'success-hapus');
        redirect($this->view_url);
    }
}
