<?php

class Hadir extends CI_Controller
{
    private $view_url = 'admin/hadir';
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_hadir');
    }

    public function index()
    {
        $x['data'] = $this->m_hadir->get_all_data();
        $x['jadwal'] = $this->m_hadir->get_all_jadwal();

        $this->load->view('admin/v_hadir', $x);
    }

    public function set_kehadiran()
    {
        $id_kegiatan = $this->input->post('id_kehadiran');
        $jlh_laki = $this->input->post('jlh_laki');
        $jlh_perempuan = $this->input->post('jlh_perempuan');
        $nama_ibadah = $this->input->post('nama_ibadah');

        $this->m_hadir->set_kehadiran($id_kegiatan, $jlh_laki, $jlh_perempuan, $nama_ibadah);
        echo $this->session->set_flashdata('msg','succes');
        redirect($this->view_url);
    }

    public function edit_kehadiran()
    {
        $id_kegiatan = $this->input->post('id_kegiatan');
        $jlh_pria = $this->input->post('jlh_pria');
        $jlh_wanita = $this->input->post('jlh_wanita');

        $this->m_hadir->edit_kehadiran($id_kegiatan, $jlh_pria, $jlh_wanita);
        echo $this->session->set_flashdata('msg', 'edit');
        redirect($this->view_url);
    }

    public function delete_kehadiran()
    {
        $id = $this->input->post('id_kehadiran');

        $this->m_hadir->delete_kehadiran($id);
        echo $this->session->set_flashdata('msg', 'success-hapus');
        redirect($this->view_url);
    }

}