<?php
class M_peminjaman extends CI_Model
{
	public function getMahasiswa()
	{
		$this->db->select('
        mahasiswa.id,
        mahasiswa.nim,
        users.nama
    ');

		$this->db->from('mahasiswa');
		$this->db->join('users', 'users.id = mahasiswa.user_id');
		$this->db->where('status_anggota', true);

		return $this->db->get()->result();
	}

	public function getBuku()
	{
		$this->db->where('stok >', 0);

		return $this->db->get('buku')->result();
	}

	public function simpan($data)
	{
		$this->db->trans_begin();

		$this->db->insert('peminjaman', $data);

		$this->db->set('stok', 'stok - 1', FALSE);
		$this->db->where('id', $data['buku_id']);
		$this->db->update('buku');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();

			return true;

		}
	}

	public function getAll()
	{
		$this->db->select('
        peminjaman.id,
        users.nama,
        mahasiswa.nim,
		mahasiswa.jurusan,
        buku.judul,
        buku.lokasi_rak,
        peminjaman.tanggal_pinjam,
        peminjaman.status
    ');

		$this->db->from('peminjaman');
		$this->db->join('mahasiswa', 'mahasiswa.id = peminjaman.mahasiswa_id');
		$this->db->join('users', 'users.id = mahasiswa.user_id');
		$this->db->join('buku', 'buku.id = peminjaman.buku_id');

		return $this->db->get()->result();
	}
}
