<?php

class Petugas_Misa_Lainnya extends CI_Controller
{
    private $view_url = "admin_lainnya/petugas_misa_lainnya";
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_petugas_misa_lainnya');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');

        $x['data'] = $this->m_petugas_misa_lainnya->get_jadwal_misa($kode);
        $x['petugas'] = $this->m_petugas_misa_lainnya->get_petugas_misa($kode);
        $x['id_admin'] = $kode;
        $x['id_fakultas'] = $this->m_petugas_misa_lainnya->get_id_fakultas($kode);
        $x['mhs'] = $this->m_petugas_misa_lainnya->get_all_mahasiswa($kode);

        $this->load->view('admin_lainnya/v_petugas_misa', $x);
        // $this->load->view('admin/v_fakultas_lainnya', $x);
    }

    public function set_petugas() {
    
        $id_mhs = $this->input->post('id_mhs'); // Array of IDs
        $tugas = $this->input->post('tugas');   // Associative array of tasks
        $role = $this->input->post('id_ibadah');
        $persembahan = "";
        $misdinar = "";
    
        // Ensure both arrays are present
        if ($id_mhs && $tugas) {
            foreach ($id_mhs as $id) {
                if (isset($tugas[$id])) {

                    $selected_tugas = $tugas[$id]; // The selected task for this ID
                    if($selected_tugas === "persembahan")
                    {
                        $persembahan .= ($persembahan ? ',' : '') . $id;
                        continue;
                    }

                    if($selected_tugas === "misdinar")
                    {
                        $misdinar .= ($misdinar ? ',' : '') . $id;
                        continue;
                    }
                    
                    // Insert the data into the database
                    $this->m_petugas_misa_lainnya->insert_task($id, $selected_tugas, $role);
                }
            }

            if ($persembahan) {
                $this->m_petugas_misa_lainnya->update_persembahan($persembahan, $role);
            }

            if ($misdinar) {
                $this->m_petugas_misa_lainnya->update_misdinar($misdinar, $role);
            }
    
            // Redirect or provide feedback to the user
            $this->session->set_flashdata('msg', 'success');
            redirect('admin_lainnya/petugas_misa_lainnya');
        } 
    }

}