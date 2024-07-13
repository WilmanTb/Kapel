<?php

class Detail_Lainnya extends CI_Controller
{
    private $view_url = 'admin/detail_lainnya';
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_detail_lainnya');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');
        $id_lainnya = $this->input->get('id');

        $x['data'] = $this->m_detail_lainnya->get_detail_lainnya($id_lainnya);

        $this->load->view('admin/v_detail_lainnya', $x);
    }

    public function add_anggota()
    {
        $id_mahasiswa = $this->input->post('id_mhs');
        $id = $this->input->post('id_lainnya');
        if($id_mahasiswa)
        {
            $this->m_detail_lainnya->add_anggota_mhs($id,$id_mahasiswa);
        } else {
            $nama = $this->input->post('nama_anggota');
            $this->m_detail_lainnya->add_anggota($id, $nama, '');
        }
       
        echo $this->session->set_flashdata('msg', 'success');
        redirect($this->view_url."?id=".$id);
    }

    public function edit_anggota()
    {
        $id_lainnya = $this->input->post('id_lainnya');
        $id_anggota = $this->input->post('id_anggota');
        $nama = $this->input->post('nama_anggota');
        $this->m_detail_lainnya->edit_anggota($id_lainnya, $id_anggota, $nama);
        echo $this->session->set_flashdata('msg', 'edit');
        redirect($this->view_url."?id=".$id_lainnya);

    }

    public function delete_anggota()
    {
        $id_anggota = $this->input->post('id_anggota');
        $id_lainnya = $this->input->post('id_lainnya');
        $nama_anggota = $this->input->post('nama_anggota');
        echo $this->m_detail_lainnya->delete_anggota($id_lainnya, $id_anggota, $nama_anggota);
        redirect($this->view_url."?id=".$id_lainnya);
    }
}
