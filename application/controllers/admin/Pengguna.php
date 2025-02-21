<?php

class Pengguna extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('administrator');
			redirect($url);
		};
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}


	public function index()
	{
		$kode = $this->session->userdata('idadmin');
		$type = $this->input->get('type');
		$code = '';

		if ($type == "super_admin") {
			$code = '1';
		} else {
			$code = '2';
		}

		$x['user'] = $this->m_pengguna->get_pengguna_login($kode);
		$x['data'] = $this->m_pengguna->get_all_pengguna($code);

		if ($type == "super_admin") {
			$this->load->view('admin/v_pengguna', $x);
		} else {
			$this->load->view('admin/v_admin_fakultas', $x);
		}
	}



	function simpan_pengguna()
	{
		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE;

		$type = $this->input->get("type");
		
		$this->upload->initialize($config);
		$gambar = '';
		if (!empty($_FILES['filefoto']['name'])) {

			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = './assets/images/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$gambar = $gbr['file_name'];
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/pengguna?type='.$type);
			}
		}
		$nama = $this->input->post('xnama');
		$username = $this->input->post('xusername');
		$password = $this->input->post('xpassword');
		$konfirm_password = $this->input->post('xpassword2');
		$email = $this->input->post('xemail');
		$level = $this->input->post('xlevel');
		if ($password <> $konfirm_password) {
			echo $this->session->set_flashdata('msg', 'error');
			redirect('admin/pengguna');
		} else {
			$this->m_pengguna->simpan_pengguna($nama, $username, $password, $email, $level, $gambar);
			echo $this->session->set_flashdata('msg', 'success');
			redirect('admin/pengguna?type='.$type);
		}
	}

	function update_pengguna()
	{

		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$type = $this->input->get("type");

		$this->upload->initialize($config);
		$gambar = "";
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = './assets/images/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
			}
		}
		$kode = $this->input->post('kode');
		$nama = $this->input->post('xnama');
		$username = $this->input->post('xusername');
		$email = $this->input->post('xemail');
		$level = $this->input->post('xlevel');
		if ($gambar == "") {
			$this->m_pengguna->update_pengguna_tanpa_gambar($kode, $nama, $username, $email, $level);
			echo $this->session->set_flashdata('msg', 'info');
			redirect('admin/pengguna?type='.$type);
		} else {
			$this->m_pengguna->update_pengguna($kode, $nama, $username, $email, $level, $gambar);
			echo $this->session->set_flashdata('msg', 'info');
			redirect('admin/pengguna?type='.$type);
		}
	}

	function hapus_pengguna()
	{
		$type = $this->input->get("type");
		$kode = $this->input->post('kode');
		$data = $this->m_pengguna->get_pengguna_login($kode);
		$q = $data->row_array();
		$p = $q['pengguna_photo'];
		$path = base_url() . 'assets/images/' . $p;
		delete_files($path);
		$this->m_pengguna->hapus_pengguna($kode);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('admin/pengguna?type='.$type);
	}

	// function reset_password()
	// {

	// 	$id = $this->uri->segment(4);
	// 	$get = $this->m_pengguna->getusername($id);
	// 	if ($get->num_rows() > 0) {
	// 		$a = $get->row_array();
	// 		$b = $a['pengguna_username'];
	// 	}
	// 	$pass = rand(123456, 999999);
	// 	$this->m_pengguna->resetpass($id, $pass);
	// 	echo $this->session->set_flashdata('msg', 'show-modal');
	// 	echo $this->session->set_flashdata('uname', $b);
	// 	echo $this->session->set_flashdata('upass', $pass);
	// 	redirect('admin/pengguna');
	// }
}
