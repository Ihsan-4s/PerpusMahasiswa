<?php
class M_denda extends CI_Model
{
	// Update nominal berdasarkan id denda
	public function update_denda($denda_id, $nominal)
	{
		$this->db->where('id', $denda_id);
		return $this->db->update('denda', ['nominal' => $nominal]);
	}

	// Ambil data denda berdasarkan ID Peminjaman (buat form edit)
	public function get_by_id_peminjaman($peminjaman_id)
	{
		$this->db->select('denda.*');
		$this->db->from('denda');
		$this->db->join('pengembalian', 'pengembalian.id = denda.pengembalian_id');
		$this->db->where('pengembalian.peminjaman_id', $peminjaman_id);
		return $this->db->get()->row();
	}

	public function bayar($pengembalian_id)
	{
		$this->db->where('pengembalian_id', $pengembalian_id);

		return $this->db->update('denda', [
			'status_bayar' => true
		]);
	}
}
