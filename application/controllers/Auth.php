<?php
Class Auth extends CI_controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('M_auth');
	}

	public function index(){
		if($this->session->userdata('logged_in')){
			$this->redirect_by_role($this->session->userdata('role'));
			return;
		}
		$this->load->view('auth/v_login');
	}

	public function proses_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->M_auth->get_user_by_email($email);
		if ($user && password_verify($password, $user->password)) {
			$this->session->set_userdata(array(
				'logged_in' => TRUE,
				'user_id' => $user->id,
				'nama' => $user->nama,
				'email' => $user->email,
				'role' => $user->role,
			));

			echo json_encode(array(
				'error' => false,
				'message' => 'Login berhasil.',
				'redirect' => $user->role === 'pustakawan' ? base_url('pustakawan/dashboard') : base_url('mahasiswa/dashboard'),
			));
			return;
		}

		echo json_encode(array(
			'error' => true,
			'message' => 'Email atau password salah.',
		));
	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    private function redirect_by_role($role)
    {
        if ($role === 'pustakawan') {
            redirect('pustakawan/dashboard');
        } else {
            redirect('mahasiswa/dashboard');
        }
    }
}
