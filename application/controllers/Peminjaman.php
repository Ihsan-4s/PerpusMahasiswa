<?php
class Peminjaman extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_peminjaman');
		$this->load->helper('url');
	}
	public function index()
	{
		$data['peminjaman'] = $this->m_peminjaman->get_peminjaman();
		$this->load->view('peminjaman/index', $data);
	}

	public function sudah_diterima()
	{
		$data['peminjaman1'] = $this->m_peminjaman->get_peminjaman_detail();
		$this->load->view('peminjaman/sudah_diterima', $data);
	}

	public function create()
	{
		$data['mahasiswa'] = $this->m_peminjaman->get_mahasiswa();
		$data['buku'] = $this->m_peminjaman->get_Buku();
		$this->load->view('peminjaman/create', $data);
	}

	public function store()
	{
		$data_pinjam = [
			'mahasiswa_id' => $this->input->post('mahasiswa_id'),
			'buku_id' => $this->input->post('buku_id'),
			'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
			'status' => 'dipinjam'
		];
		$simpan = $this->m_peminjaman->simpan_pinjam($data_pinjam);


		if ($simpan) {
			redirect('peminjaman');
		} else {
			echo "<script>alert('Gagal nyimpen data bro!');</script>";
		}
	}
}
