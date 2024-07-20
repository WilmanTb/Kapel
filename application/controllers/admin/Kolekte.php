<?php
class Kolekte extends CI_Controller
{
    private $view_url = 'admin/kolekte';
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        };

        $this->load->model('m_kolekte');
        $this->load->database();
        $this->load->library('upload');
        $this->load->library('pdflibrary');
    }

    public function index()
    {
        $x['data'] = $this->m_kolekte->get_all_data();
        $x['jadwal'] = $this->m_kolekte->get_all_jadwal();

        $this->load->view('admin/v_kolekte', $x);
    }

    public function add_kolekte()
    {
        $id_kegiatan = $this->input->post('id_kegiatan');
        $jlh_kolekte = $this->input->post('jlh_kolekte');
        $nama_ibadah = $this->input->post('nama_ibadah');

        $this->m_kolekte->add_kolekte($id_kegiatan, $jlh_kolekte, $nama_ibadah);
        echo $this->session->set_flashdata('msg', 'success');
        redirect($this->view_url);
    }

    public function edit_kolekte()
    {
        $id_kegiatan = $this->input->post('id_kegiatan');
        $jlh_kolekte = $this->input->post('jlh_kolekte');

        $this->m_kolekte->edit_kolekte($id_kegiatan, $jlh_kolekte);
        echo $this->session->set_flashdata('msg', 'edit');
        redirect($this->view_url);
    }

    public function delete_kolekte()
    {
        $id = $this->input->post('id_kehadiran');

        $this->m_kolekte->delete_kolekte($id);
        echo $this->session->set_flashdata('msg', 'succes-hapus');
        redirect($this->view_url);
    }

    function cetak_data_kolekte()
    {
        $pdf = new FPDF('L', 'mm', 'legal');

        // Membuat halaman baru
        $pdf->AddPage();
        $pdf->image("theme/images/UNIKA1.png", 60, 3, 29, 25);
        $pdf->image("theme/images/UNIKA1.png", 240, 3, 29, 25);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(310, 7, 'KAPEL', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(310, 7, 'UNIVERSITAS KATOLIK SANTO THOMAS', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(310, 7, 'JL. Setia Budi No. 426, Tanjung Sari, Medan Selayang, Tj. Sari, Medan, Kota Medan, Sumatera Utara', 0, 1, 'C');
        $pdf->Ln(3);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(310, 0, '', 'T');
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(310, 5, 'DATA KOLEKTE IBADAH', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);

        // Setting up column widths
        $widths = array(20, 120, 100, 60); // Adjusted widths to fill the page

        $pdf->Cell(10, 6, '', 0, 0);
        $pdf->Cell($widths[0], 6, 'No.', 1, 0, 'C');
        $pdf->Cell($widths[1], 6, 'Nama Ibadah', 1, 0, 'C');
        $pdf->Cell($widths[2], 6, 'Tanggal Ibadah', 1, 0, 'C');
        $pdf->Cell($widths[3], 6, 'Jumlah Kolekte', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 8);
        $data = $this->m_kolekte->get_all_data();
        $no = 1;
        foreach ($data->result_array() as $data) {
            $pdf->Cell(10, 6, '', 0, 0);
            $pdf->Cell($widths[0], 6, $no, 1, 0, 'C');
            $pdf->Cell($widths[1], 6, $data['nama_ibadah'], 1, 0, 'C');
            $pdf->Cell($widths[2], 6, $this->format_tanggal($data['tanggal_ibadah']), 1, 0, 'C');
            $pdf->Cell($widths[3], 6, number_format($data['jlh_kolekte'], 2, '.', ','), 1, 1, 'C');
            $no++;
        }

        // Fetch and display the total
        // Fetch and display the total
        $total_kolekte = $this->m_kolekte->sum_kolekte();
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(10, 10, '', 0, 0); // Align with the table
        $pdf->Cell(240, 6, 'Total :', 1, 0, 'R');
        $pdf->Cell(60, 6, number_format($total_kolekte, 2, '.', ','), 1, 1, 'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(275, 5, '', 0, 0, 'L');
        $pdf->Cell(90, 5, 'Medan, ' . $this->tgl_indo(date('Y-m-d')), 0, 1, 'L');


        $pdf->Output();
    }



    public function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    public function format_tanggal($tanggal)
    {
        $daftar_hari = array(
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        );
        $tanggal_ibadah = date('d F Y', strtotime($tanggal));

        $hari = date('l', strtotime($tanggal_ibadah));
        return $daftar_hari[$hari] . ', ' . $tanggal_ibadah;
    }
}
