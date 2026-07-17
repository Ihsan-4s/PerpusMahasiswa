<?php
class Pengembalian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_pengembalian');
	}
	public function index($id)
	{
		$data['barang'] = $this->m_pengembalian->get_id($id);
		$this->load->view('pengembalian/return', $data);
	}

	public function update()
	{
		$data_kembalikan = [
			'peminjaman_id' => $this->input->post('peminjaman_id'),
			'buku_id' => $this->input->post('buku_id'),
			'tanggal_kembali' => $this->input->post('tanggal_kembali'),
			'kondisi_buku' => $this->input->post('kondisi_buku')
		];


		$simpan = $this->m_pengembalian->kembalikan($data_kembalikan);

		if ($simpan) {
			echo json_encode([
				'status' => true,
				'message' => 'berhasil'
			]);
		} else {
			echo json_encode([
				'status' => false,
				'message' => 'gagal'
			]);
		}
	}
}

