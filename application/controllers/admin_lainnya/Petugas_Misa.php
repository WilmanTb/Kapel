<?php

class Petugas_Misa extends CI_Controller
{
    private $view_url = "admin_fakultas/petugas_misa";
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_petugas_misa');
    }

    public function index()
    {
        $kode = $this->session->userdata('idadmin');

        $x['data'] = $this->m_petugas_misa->get_jadwal_misa($kode);
        $x['petugas'] = $this->m_petugas_misa->get_petugas_misa($kode);
        $x['id_admin'] = $kode;
        $x['id_fakultas'] = $this->m_petugas_misa->get_id_fakultas($kode);
        $x['mhs'] = $this->m_petugas_misa->get_all_mahasiswa($kode);

        $this->load->view('admin_fakultas/v_petugas_misa', $x);
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
                    $this->m_petugas_misa->insert_task($id, $selected_tugas, $role);
                }
            }

            if ($persembahan) {
                $this->m_petugas_misa->update_persembahan($persembahan, $role);
            }

            if ($misdinar) {
                $this->m_petugas_misa->update_misdinar($misdinar, $role);
            }
    
            // Redirect or provide feedback to the user
            $this->session->set_flashdata('success', 'Data successfully saved.');
            redirect('admin_fakultas/petugas_misa');
        } else {
            // Handle the case where data is missing or invalid
            $this->session->set_flashdata('error', 'Invalid data provided.');
            redirect('admin_fakultas/petugas_misa');
        }
    }

}