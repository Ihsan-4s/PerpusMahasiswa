<?php
class Peminjaman extends CI_Controller
{
	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		parent::__construct();
		$this->load->model('m_peminjaman');
	}

	public function index()
	{
		$data['mahasiswa'] = $this->m_peminjaman->getMahasiswa();
		$data['buku'] = $this->m_peminjaman->getBuku();

		$this->load->view('peminjaman/index', $data);
	}

	public function detail_peminjaman()
	{
		$data = [
			'mahasiswa_id' => $this->input->post('mahasiswa_id'),
			'buku_id' => $this->input->post('buku_id'),
			'tanggal_pinjam' => date('Y-m-d'),
			'status' => 'dipinjaam'
		];

		$hasil = $this->m_peminjaman->simpan($data);

		if ($hasil) {
			echo "<script>
            alert('Peminjaman berhasil!');
          </script>";
			$data['daftar'] = $this->m_peminjaman->getAll();
			redirect('peminjaman/detail');
		} else {
			echo "<script>
            alert('Peminjaman gagal!');
          </script>";
		}
	}

	public function detail()
	{
		$data['daftar'] = $this->m_peminjaman->getAll();

		$this->load->view('peminjaman/detail_peminjaman', $data);
	}
}
