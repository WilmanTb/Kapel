<?php

class Master_Data_Lainnya extends CI_Controller
{
    private $view_url = "admin_lainnya/master_data_lainnya";
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != true) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_master_data_lainnya');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');

        $x['mhs'] = $this->m_master_data_lainnya->get_all_mahasiswa($kode);
        $x['id_admin'] = $kode;
        $x['data_lainnya'] = $this->m_master_data_lainnya->get_id_fakultas($kode);

        $this->load->view('admin_lainnya/v_master_data', $x);
        // $this->load->view('admin/v_fakultas_lainnya', $x);
    }

    public function add_anggota()
    {
        $id_mahasiswa = $this->input->post('id_mhs');
        $id = $this->input->post('id_lainnya');
        if($id_mahasiswa)
        {
            $this->m_master_data_lainnya->add_anggota_mhs($id,$id_mahasiswa);
        } else {
            $nama = $this->input->post('nama_anggota');
            $this->m_master_data_lainnya->add_anggota($id, $nama, '');
        }
       
        echo $this->session->set_flashdata('msg', 'success');
        redirect($this->view_url);
    }

    public function edit_anggota()
    {
        $id_anggota = $this->input->post('id_anggota');
        $nama_anggota = $this->input->post('nama_anggota');

        $this->m_master_data_lainnya->edit_anggota($id_anggota, $nama_anggota);
        echo $this->session->set_flashdata('msg', 'edit');
        redirect($this->view_url);
    }

    public function delete_anggota()
    {
        $id_anggota = $this->input->post('id_anggota');
        $id_lainnya = $this->input->post('id_lainnya');
        $nama_anggota = $this->input->post('nama_anggota');
        $this->m_master_data_lainnya->delete_anggota($id_lainnya, $id_anggota, $nama_anggota);
        echo $this->session->set_flashdata('msg', 'success-hapus');
        redirect($this->view_url);
    }

    
}