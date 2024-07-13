<?php
class Jadwal_Lainnya extends CI_Controller
{
    private $view_url = 'admin/jadwal_lainnya';
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_jadwal_lainnya');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');
        $id_misa = $this->input->get('id');

        $x['data'] = $this->m_jadwal_lainnya->get_all_misa();

        $this->load->view('admin/v_jadwal_lainnya', $x);
    }

    public function add_misa()
    {
        $nama_ibadah = $this->input->post('nama_ibadah');
        $tanggal_ibadah = $this->input->post('tanggal_ibadah');
        $waktu_ibadah = $this->input->post('waktu_ibadah');
        $keterangan = $this->input->post('keterangan');
        
        $this->m_jadwal_lainnya->add_misa($nama_ibadah, $tanggal_ibadah, $waktu_ibadah, $keterangan);
        echo $this->session->set_flashdata('msg','success');
        redirect($this->view_url);
    }

    public function edit_misa()
    {
        $id_misa = $this->input->post('id_misa');
        $nama_ibadah = $this->input->post('nama_ibadah');
        $tanggal_ibadah = $this->input->post('tanggal_ibadah');
        $waktu_ibadah = $this->input->post('waktu_ibadah');
        $keterangan = $this->input->post('keterangan');
        
        $this->m_jadwal_lainnya->edit_misa($id_misa,$nama_ibadah, $tanggal_ibadah, $waktu_ibadah, $keterangan);
        echo $this->session->set_flashdata('msg','edit');
        redirect($this->view_url);
    }

    public function delete_misa()
    {
        $id_misa = $this->input->post('id_ibadah');
        $this->m_jadwal_lainnya->delete_misa($id_misa);
        echo $this->session->set_flashdata('msg','succes-hapus');
        redirect($this->view_url);
    }
}