<?php
class M_pengembalian extends CI_Model
{
	public function getById($id)
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

	public function kembalikan($data)
	{
		$this->db->trans_begin();
		$this->db->insert('pengembalian', [
			'peminjaman_id' => $data['peminjaman_id'],
			'tanggal_kembali' => date('Y-m-d'),
			'kondisi_buku' => $data['kondisi_buku']
		]);

		$this->db->where('id', $data['peminjaman_id']);
		$this->db->update('peminjaman', [
			'status' => 'dikembalikan'
		]);


		if ($data['kondisi_buku'] == 'baik') {

			$this->db->set('stok', 'stok + 1', FALSE);
			$this->db->where('id', $data['buku_id']);
			$this->db->update('buku');

		}

		if ($data['kondisi_buku'] == 'rusak') {
			$this->db->insert('denda', [
				'pengembalian_id' => $this->db->insert_id(),
				'nominal' => 100000,
				'status_bayar' => false
			]);

		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		}

		$this->db->trans_commit();
		return true;
	}
}
