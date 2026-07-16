<?php
class M_mahasiswa extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}

	public function register_akun_mahasiswa($nama, $email, $password, $nim, $jurusan)
	{
		$this->db->trans_begin();
		$this->db->insert('users', [
			'nama' => $nama,
			'email' => $email,
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'role' => 'mahasiswa',
		]);
		$user_id = $this->db->insert_id();

		$this->db->insert('mahasiswa', [
			'user_id' => $user_id,
			'nim' => $nim,
			'jurusan' => $jurusan,
			'status_anggota' => FALSE,
		]);
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function register_anggota($mahasiswa_id)
	{
		return $this->db->where('id', $mahasiswa_id)->update('mahasiswa', ['status_anggota' => TRUE]);
	}

	public function get_calon_anggota()
	{
		return $this->db->select('mahasiswa.id, users.nama, users.email, mahasiswa.nim, mahasiswa.jurusan')->from('mahasiswa')->join('users', 'users.id = mahasiswa.user_id')->where('mahasiswa.status_anggota', FALSE)->get()->result();
	}

	public function get_anggota_aktif()
    {
        return $this->db->select('mahasiswa.id, users.nama, mahasiswa.nim, mahasiswa.jurusan')->from('mahasiswa')->join('users', 'users.id = mahasiswa.user_id')->where('mahasiswa.status_anggota', TRUE)->get()->result();
    }

}
?>
