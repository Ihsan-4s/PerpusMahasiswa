<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_buku extends CI_Model {

    protected $table = 'buku';

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
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

	public function tambah_stok($id, $jumlah)
	{
		$this->db->set('stok', 'stok + '.(int) $jumlah, FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table);
	}

	public function cek_judul($judul, $exclude_id = null)
	{
		$this->db->where('judul', $judul);
		if ($exclude_id) {
			$this->db->where('id !=', $exclude_id);
		}
		$query = $this->db->get($this->table);
		return $query->num_rows() > 0;
	}

	public function get_total_judul()
	{
		return $this->db->count_all($this->table);
	}

	public function get_total_stok()
	{
		$this->db->select_sum('stok');
		$row = $this->db->get($this->table)->row();
		return $row->stok ? $row->stok : 0;
	}
}
