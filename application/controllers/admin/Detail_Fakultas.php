<?php

class Detail_Fakultas extends CI_Controller
{
    private $view_url = "admin/detail_fakultas";
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_detail_fakultas');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');
        $type = $this->input->get('type');
        $id_fakultas = $this->input->get('id');

        $x['data'] = $this->m_detail_fakultas->get_detail_fakultas($id_fakultas);
        $x['prodi'] = $this->m_detail_fakultas->get_all_prodi($id_fakultas);

        if ($type == "1") {
            $this->load->view('admin/v_detail_fakultas', $x);
        } else {
            // $this->load->view('admin/v_fakultas_lainnya', $x);
        }
    }

    public function add_mahasiswa()
    {
        $id_fakultas = $this->input->post('id_fakultas');
        $type = $this->input->post('type');
        $nama_mhs = $this->input->post('nama_mhs');
        $prodi = $this->input->post('prodi_mhs');
        
        $this->m_detail_fakultas->add_mahasiswa($id_fakultas, $nama_mhs, $prodi);
        $this->session->set_flashdata('msg','success');
        $this->session->set_flashdata('msg_text','Mahasiswa');
        redirect($this->view_url."?type=".$type.'&id='.$id_fakultas);
    }

    public function add_prodi()
    {
        $id_fakultas = $this->input->post('id_fakultas');
        $type = $this->input->post('type');
        $nama_prodi = $this->input->post('nama_prodi');
        
        $this->m_detail_fakultas->add_prodi($id_fakultas, $nama_prodi);
        $this->session->set_flashdata('msg','success');
        $this->session->set_flashdata('msg_text','Program Studi');
        redirect($this->view_url."?type=".$type.'&id='.$id_fakultas);
    }

    public function edit_mahasiswa()
    {
        $id_mhs = $this->input->post('id_mhs');
        $id_fakultas = $this->input->post('id_fakultas');
        $type = $this->input->post('type');
        $nama_mhs = $this->input->post('nama_mahasiswa');
        $prodi = $this->input->post('prodi_mhs');
        
        $this->m_detail_fakultas->edit_mahasiswa($id_mhs, $nama_mhs, $prodi);
        $this->session->set_flashdata('msg','edit');
        $this->session->set_flashdata('msg_text','Mahasiswa');
        redirect($this->view_url."?type=".$type.'&id='.$id_fakultas);
    }

    public function edit_prodi()
    {
        $id_prodi = $this->input->post('id_prodi');
        $id_fakultas = $this->input->post('id_fakultas');
        $type = $this->input->post('type');
        $nama_prodi = $this->input->post('nama_prodi');
        
        $this->m_detail_fakultas->edit_prodi($id_prodi, $nama_prodi);
        $this->session->set_flashdata('msg','edit');
        $this->session->set_flashdata('msg_text','Program Studi');
        redirect($this->view_url."?type=".$type.'&id='.$id_fakultas);
    }

    public function delete_mahasiswa()
    {
        $id_mhs = $this->input->post('id_mhs');
        $id_fakultas = $this->input->post('id_fakultas');
        $type = $this->input->post('type');
        
        $this->m_detail_fakultas->delete_mahasiswa($id_mhs);
        $this->session->set_flashdata('msg','success-hapus');
        $this->session->set_flashdata('msg_text','Mahasiswa');
        redirect($this->view_url."?type=".$type.'&id='.$id_fakultas);
    }

    public function delete_prodi()
    {
        $id_prodi = $this->input->post('id_prodi');
        $id_fakultas = $this->input->post('id_fakultas');
        $type = $this->input->post('type');
        
        $this->m_detail_fakultas->delete_prodi($id_prodi);
        $this->session->set_flashdata('msg','success-hapus');
        $this->session->set_flashdata('msg_text','Program Studi');
        redirect($this->view_url."?type=".$type.'&id='.$id_fakultas);
    }
}