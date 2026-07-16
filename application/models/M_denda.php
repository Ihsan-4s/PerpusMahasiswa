<?php
class M_denda extends CI_Model
{
	public function bayar($pengembalian_id)
{
    $this->db->where('pengembalian_id', $pengembalian_id);

    return $this->db->update('denda', [
        'status_bayar' => true
    ]);
}
}
