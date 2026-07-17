<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penerimaan extends CI_Model {

    protected $table = 'penerimaan_buku';

    public function get_all()
    {
        $this->db->select('penerimaan_buku.*, detail_order.buku_id, detail_order.order_id, buku.judul, order_pembelian.supplier');
        $this->db->from($this->table);
        $this->db->join('detail_order', 'detail_order.id = penerimaan_buku.detail_order_id');
        $this->db->join('buku', 'buku.id = detail_order.buku_id');
        $this->db->join('order_pembelian', 'order_pembelian.id = detail_order.order_id');
        $this->db->order_by('penerimaan_buku.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
}
