<?php
class M_peminjaman extends CI_Model
{
	public function get_mahasiswa()
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
	public function get_Buku()
	{
		$this->db->where('stok >', 0);

		return $this->db->get('buku')->result();
	}

	public function simpan_pinjam($data_pinjam)
	{
		$this->db->trans_start();
		$this->db->insert('peminjaman', $data_pinjam);
		$this->db->set('stok', 'stok-1', FALSE);
		$this->db->where('id', $data_pinjam['buku_id']);
		$this->db->update('buku');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}


	public function get_peminjaman()
	{
		$this->db->select('
        peminjaman.id,
        peminjaman.tanggal_pinjam,
        peminjaman.status,
        mahasiswa.nim,
        users.nama,
        buku.judul,
        buku.lokasi_rak,
        pengembalian.kondisi_buku,
		denda.nominal,
		denda.status_bayar,
		pengembalian.id AS pengembalian_id
    ');

		$this->db->from('peminjaman');
		$this->db->join('mahasiswa', 'mahasiswa.id = peminjaman.mahasiswa_id');
		$this->db->join('users', 'users.id = mahasiswa.user_id');
		$this->db->join('buku', 'buku.id = peminjaman.buku_id');
		$this->db->join('pengembalian', 'pengembalian.peminjaman_id = peminjaman.id', 'left');
		$this->db->join('denda', 'denda.pengembalian_id = pengembalian.id', 'left');
		$this->db->group_start();

		$this->db->where('peminjaman.status', 'dipinjam');

		$this->db->or_group_start();
		$this->db->where('peminjaman.status', 'dikembalikan');
		$this->db->where('denda.status_bayar', false);
		$this->db->group_end();

		$this->db->group_end();
		return $this->db->get()->result();
	}

	public function get_peminjaman_detail()
	{
		$this->db->select('
        peminjaman.id,
        peminjaman.tanggal_pinjam,
        peminjaman.status,
        mahasiswa.nim,
        users.nama,
        buku.judul,
        buku.lokasi_rak,
        pengembalian.kondisi_buku,
		denda.nominal,
		denda.status_bayar,
		pengembalian.id AS pengembalian_id
    ');

		$this->db->from('peminjaman');
		$this->db->join('mahasiswa', 'mahasiswa.id = peminjaman.mahasiswa_id');
		$this->db->join('users', 'users.id = mahasiswa.user_id');
		$this->db->join('buku', 'buku.id = peminjaman.buku_id');
		$this->db->join('pengembalian', 'pengembalian.peminjaman_id = peminjaman.id', 'left');
		$this->db->join('denda', 'denda.pengembalian_id = pengembalian.id', 'left');
		$this->db->where('peminjaman.status', 'dikembalikan');
		// $this->db->or_group_start();
		$this->db->where('pengembalian.kondisi_buku', 'baik');
		// $this->db->group_end();
		return $this->db->get()->result();
	}

}
