<?php
class m_pengembalian extends CI_Model
{
	public function get_id($id)
	{
		$this->db->select('
        peminjaman.id,
        users.nama,
        mahasiswa.nim,
        buku.judul,
        buku.id AS buku_id,
        peminjaman.tanggal_pinjam,
        peminjaman.status
    ');

		$this->db->from('peminjaman');
		$this->db->join('mahasiswa', 'mahasiswa.id = peminjaman.mahasiswa_id');
		$this->db->join('users', 'users.id = mahasiswa.user_id');
		$this->db->join('buku', 'buku.id = peminjaman.buku_id');

		$this->db->where('peminjaman.id', $id);

		return $this->db->get()->row();
	}

	public function kembalikan($data_kembalikan)
	{
		$this->db->trans_start();

		$data_insert = [
			'peminjaman_id' => $data_kembalikan['peminjaman_id'],
			'tanggal_kembali' => $data_kembalikan['tanggal_kembali'],
			'kondisi_buku' => $data_kembalikan['kondisi_buku']
		];
		$this->db->insert('pengembalian', $data_insert);
		$this->db->where('id', $data_kembalikan['peminjaman_id']);
		$this->db->update('peminjaman', ['status' => 'dikembalikan']);

		if ($data_kembalikan['kondisi_buku'] == 'baik') {
			$this->db->set('stok', 'stok+1', FALSE);
			$this->db->where('id', $data_kembalikan['buku_id']);
			$this->db->update('buku');
		}
		if ($data_kembalikan['kondisi_buku'] == 'rusak') {
			$this->db->insert('denda', [
				'pengembalian_id' => $this->db->insert_id(),
				'nominal' => 0,
				'status_bayar' => false
			]);
		}

		$this->db->trans_complete();
		return $this->db->trans_status();
	}

}
