<?php
class Pustakawan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_mahasiswa');
		$this->load->library('form_validation');

		if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'pustakawan') {
        redirect('auth');
    }
	}

	public function register_mahasiswa()
	{
		$this->load->view('pustakawan/v_register_mahasiswa');
		// if($this->input->post()){

		// 	if($this->form_validation->run() === FALSE){
		// 		$this->load->view('pustakawan/v_register_mahasiswa');
		// 		return;
		// 	}

		// 	$sukses = $this->M_mahasiswa->register_akun_mahasiswa(
		// 		$this->input->post('nama'),
		// 		$this->input->post('email'),
		// 		$this->input->post('password'),
		// 		$this->input->post('nim'),
		// 		$this->input->post('jurusan')
		// 	);

		// 	if($sukses){
		// 		$this->session->set_flashdata('success', 'Akun mahasiswa berhasil didaftarkan.');
		// 	}else{
		// 		$this->session->set_flashdata('error', 'Gagal mendaftarkan akun mahasiswa.');
		// 	}
		// 	redirect('pustakawan/register_mahasiswa');
		// }
		// $this->load->view('pustakawan/v_register_mahasiswa');
	}

	public function simpan_mahasiswa()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('nim', 'NIM', 'required');
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode(array('error' => 'true', 'message' => strip_tags(validation_errors()),
			));
			return;
		}
		$sukses = $this->M_mahasiswa->register_akun_mahasiswa(
			$this->input->post('nama'),
			$this->input->post('email'),
			$this->input->post('password'),
			$this->input->post('nim'),
			$this->input->post('jurusan')
		);
		echo json_encode(array(
			'error'   => !$sukses,
			'message' => $sukses ? 'Akun mahasiswa berhasil didaftarkan.' : 'Gagal daftar. Email/NIM mungkin sudah terpakai.',
		));
	}

	public function calon_anggota()
	{
		$data['mahasiswa'] = $this->M_mahasiswa->get_calon_anggota();
        $this->load->view('pustakawan/v_calon_anggota', $data);
	}


	public function aktivasi_anggota()
	{
		$mahasiswa_id = $this->input->post('mahasiswa_id');
		$sukses = $this->M_mahasiswa->register_anggota($mahasiswa_id);

		echo json_encode(array(
			'error'   => !$sukses,
			'message' => $sukses ? 'Anggota berhasil diaktivasi.' : 'Gagal aktivasi anggota.',
		));
	}

	public function dashboard(){
		$this->load->model('M_buku');
		$data['calon_anggota'] = $this->M_mahasiswa->count_calon_anggota();
        $data['anggota_aktif'] = $this->M_mahasiswa->count_anggota_aktif();
		$data['total_judul_buku'] = $this->M_buku->get_total_judul();
        $data['total_stok_buku'] = $this->M_buku->get_total_stok();
		$this->load->view('v_header');
		$this->load->view('pustakawan/v_dashboard', $data);
		$this->load->view('v_footer');
	}
}
?>
