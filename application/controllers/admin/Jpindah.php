<?php
class Jpindah extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_jemaat');
		$this->load->model('m_lingkungan');
		$this->load->model('m_kepalakeluarga');
		$this->load->model('m_berita');
		$this->load->library('upload');
	}


	function index(){
		$x['kepalakeluarga']=$this->m_kepalakeluarga->get_all_kk();
		$x['lingkungan']=$this->m_lingkungan->get_all_lingkungan();
		$x['jemaat']=$this->m_jemaat->get_all_jemaat();
		$x['data']=$this->m_berita->get_all_jpindah();
		$this->load->view('admin/v_jpindah',$x);
	}

// ----------------------------------------------- DATA KELAHIRAN ---------------------------------------------------//

	
	function simpan_jpindah(){
		$idkel=strip_tags($this->input->post('xidkeluarga'));
		$tanggal=strip_tags($this->input->post('xtanggal'));
		$jlhanak=strip_tags($this->input->post('xjlhanak'));
		$tujuan=strip_tags($this->input->post('xtujuan'));

		$this->m_berita->simpan_jpindah($idkel,$tanggal,$jlhanak,$tujuan);
		echo $this->session->set_flashdata('msg','success');
		redirect('admin/jpindah');

	}

	function simpan_skjpindah(){
		$idkel=strip_tags($this->input->post('xidkeluarga'));
		$tanggal=strip_tags($this->input->post('xtanggal'));
		$jlhanak=strip_tags($this->input->post('xjlhanak'));
		$tujuan=strip_tags($this->input->post('xtujuan'));

		$this->m_berita->simpan_jpindah($idkel,$tanggal,$jlhanak,$tujuan);
		echo $this->session->set_flashdata('msg','berhasil');
		redirect('admin/surat/jpindah');

	}


	function update_jpindah(){
		$kode=strip_tags($this->input->post('kode'));
		$idkel=strip_tags($this->input->post('xidkeluarga'));
		$tanggal=strip_tags($this->input->post('xtanggal'));
		$jlhanak=strip_tags($this->input->post('xjlhanak'));
		$tujuan=strip_tags($this->input->post('xtujuan'));


		$this->m_berita->update_jpindah($kode,$idkel,$tanggal,$jlhanak,$tujuan);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/jpindah');
	}

		function hapus_jpindah(){
		$kode=strip_tags($this->input->post('kode'));
		$this->m_berita->hapus_jpindah($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/jpindah');
	}

	// SURAT KELAHIRAN

	function simpan_suratkelahiran(){
		$username=strip_tags($this->input->post('xusername'));
		$namaayah=strip_tags($this->input->post('xnamaayah'));
		$namaibu=strip_tags($this->input->post('xnamaibu'));
		$tanggal=strip_tags($this->input->post('xtgllahir'));
		$jenkel=strip_tags($this->input->post('xjenkel'));
		$alamat=strip_tags($this->input->post('xalamat'));
		$lingkungan=strip_tags($this->input->post('xlingkungan'));
		$status=2;

		$this->m_berita->simpan_kelahiran($username,$namaayah,$namaibu,$tanggal,$jenkel,$alamat,$lingkungan,$status);
		echo $this->session->set_flashdata('msg','success');
		//header("location:v_suratlahir.php?pesan=sukses");
		redirect('surat/surat_kelahiran');

	}

	function cek_suratkelahiran(){
		$x['kepalakeluarga']=$this->m_kepalakeluarga->get_all_kk();
		$x['lingkungan']=$this->m_lingkungan->get_all_lingkungan();
		$x['jemaat']=$this->m_jemaat->get_all_jemaat();
		$x['data']=$this->m_berita->get_all_kelahiran();
		$this->load->view('admin/v_kelahiran',$x);
	}



// ---------------------------------------------- END DATA KELAHIRAN ---------------------------------------------------//



}