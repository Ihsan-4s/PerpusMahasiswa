<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_order extends CI_Model {

    protected $table = 'order_pembelian';
    protected $table_detail = 'detail_order';

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id(); 
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, array('status' => $status));
    }

    public function get_detail($order_id)
    {
        $this->db->select('detail_order.*, buku.judul');
        $this->db->from($this->table_detail);
        $this->db->join('buku', 'buku.id = detail_order.buku_id');
        $this->db->where('detail_order.order_id', $order_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_detail_by_id($detail_id)
    {
        $this->db->select('detail_order.*, buku.judul');
        $this->db->from($this->table_detail);
        $this->db->join('buku', 'buku.id = detail_order.buku_id');
        $this->db->where('detail_order.id', $detail_id);
        $query = $this->db->get();
        return $query->row();
    }

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
		$detail = $this->get_detail($order_id); 

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
