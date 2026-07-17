<?php
class Denda extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_denda');
		$this->load->helper('url');
	}

	public function index($peminjaman_id)
	{
		$data['denda'] = $this->m_denda->get_by_id_peminjaman($peminjaman_id);

		if (!$data['denda']) {
			echo "<script>alert('Data denda tidak ditemukan!');</script>";
			return;
		}

		$this->load->view('denda/update', $data);
	}

	public function proses_update()
	{
		$denda_id = $this->input->post('denda_id');
		$nominal = $this->input->post('nominal');

		$update = $this->m_denda->update_denda($denda_id, $nominal);

		if ($update) {
			redirect('peminjaman');
		} else {
			echo "<script>alert('Gagal update!');</script>";
		}
	}

	public function bayar()
	{
		$pengembalian_id = $this->input->post('id');

		$hasil = $this->m_denda->bayar($pengembalian_id);

		if ($hasil) {
			redirect('peminjaman');
		} else {
			echo "Pembayaran gagal";
		}
	}

}
