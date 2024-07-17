<?php
class Petugas_Lainnya extends CI_Controller
{
    private $view_url = 'admin/petugas_lainnya';

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_petugas_lainnya');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');
        $id = $this->input->get('id');

        $x['data'] = $this->m_petugas_lainnya->get_all_data();
        $x['jadwal'] = $this->m_petugas_lainnya->get_all_jadwal_misa();
        $x['fakultas'] = $this->m_petugas_lainnya->get_all_fakultas();
        $x['lainnya'] = $this->m_petugas_lainnya->get_all_lainnya();

        $this->load->view('admin/v_petugas_lainnya', $x);
    }

    public function set_petugas()
    {
        $petugas = "";
        $is_fakultas="";
        $is_misa = "1";
        $jadwal_misa = $this->input->post('jadwal_ibadah_misa');
        $fakultas = $this->input->post('petugas_fakultas');
        $lainnya = $this->input->post('petugas_lainnya');

        if ($fakultas != "") {
            $petugas = $fakultas;
            $is_fakultas = "1";
        }
        if ($lainnya != "") {
            $petugas = $lainnya;
            $is_fakultas = "0";
        }

        $this->m_petugas_lainnya->set_petugas($jadwal_misa, $petugas, $is_fakultas, $is_misa);
        echo $this->session->set_flashdata("msg","success");
        redirect($this->view_url);
    }

    public function edit_petugas()
    {
        $petugas = "";
        $is_fakultas="";
        $is_misa = "0";
        $id_jadwal_petugas = $this->input->post('id_jadwal_petugas');
        $fakultas = $this->input->post('petugas_fakultas1');
        $lainnya = $this->input->post('petugas_lainnya1');

        if ($fakultas != "") {
            $petugas = $fakultas;
            $is_fakultas = "1";
        }
        if ($lainnya != "") {
            $petugas = $lainnya;
            $is_fakultas = "0";
        }

        
        $this->m_petugas_lainnya->edit_petugas($id_jadwal_petugas, $petugas, $is_fakultas, $is_misa);
        echo $this->session->set_flashdata("msg","edit");
        redirect($this->view_url);
    }

    public function delete_petugas()
    {
        $id = $this->input->post('id_jadwal_petugas');
        $id_kegiatan = $this->input->post('id_kegiatan');

        $this->m_petugas_lainnya->delete_petugas($id, $id_kegiatan);
        echo $this->session->set_flashdata("msg","success-hapus");
        redirect($this->view_url);
    }
}
