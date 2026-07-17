<?php
class Mahasiswa extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('M_mahasiswa');

        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'mahasiswa') {
            redirect('auth');
        }
    }

	public function dashboard()
    {
        $user_id = $this->session->userdata('user_id');
        $mhs = $this->M_mahasiswa->get_mahasiswa_by_id($user_id);

        if (!$mhs) {
            show_404();
            return;
        }

        $data['mahasiswa']  = $mhs;
        $data['peminjaman'] = $this->M_mahasiswa->get_peminjaman_mahasiswa($mhs->id);
		$data['denda'] = $this->M_mahasiswa->get_denda_mahasiswa($mhs->id); 

        $this->load->view('mahasiswa/v_dashboard', $data);
    }
}
?>

