<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_order extends CI_Model {

    protected $table = 'order_pembelian';
    protected $table_detail = 'detail_order';

    // ambil semua order
    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    // ambil 1 order by id
    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row();
    }

    // tambah order baru
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id(); // buat langsung dipakai di detail
    }

    // update status order (pending/half/selesai)
    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, array('status' => $status));
    }

    // ambil detail order + join nama buku
    public function get_detail($order_id)
    {
        $this->db->select('detail_order.*, buku.judul');
        $this->db->from($this->table_detail);
        $this->db->join('buku', 'buku.id = detail_order.buku_id');
        $this->db->where('detail_order.order_id', $order_id);
        $query = $this->db->get();
        return $query->result();
    }

    // ambil 1 detail order by id (dipakai di Penerimaan nanti)
    public function get_detail_by_id($detail_id)
    {
        $this->db->select('detail_order.*, buku.judul');
        $this->db->from($this->table_detail);
        $this->db->join('buku', 'buku.id = detail_order.buku_id');
        $this->db->where('detail_order.id', $detail_id);
        $query = $this->db->get();
        return $query->row();
    }

    // tambah buku ke detail order
    public function insert_detail($data)
    {
        $this->db->insert($this->table_detail, $data);
    }

    public function delete_detail($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table_detail);
    }

	public function get_total_diterima($detail_order_id)
	{
		$this->db->select_sum('jumlah_diterima');
		$this->db->where('detail_order_id', $detail_order_id);
		$query = $this->db->get('penerimaan_buku');
		$row = $query->row();
		return $row->jumlah_diterima ? $row->jumlah_diterima : 0;
	}

	public function cek_status($order_id)
	{
		$detail = $this->get_detail($order_id); // sudah ada dari sebelumnya

		$ada_diterima = false;
		$semua_selesai = true;

		foreach ($detail as $d) {
			$total_diterima = $this->get_total_diterima($d->id);

			if ($total_diterima > 0) {
				$ada_diterima = true;
			}
			if ($total_diterima < $d->quantity) {
				$semua_selesai = false;
			}
		}

		if ($semua_selesai) {
			$status = 'selesai';
		} elseif ($ada_diterima) {
			$status = 'half';
		} else {
			$status = 'pending';
		}

		$this->update_status($order_id, $status);
	}
}
