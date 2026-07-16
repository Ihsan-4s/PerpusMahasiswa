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
}
