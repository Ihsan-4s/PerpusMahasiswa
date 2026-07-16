<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_denda');
    }

    public function bayar()
    {
        $pengembalian_id = $this->input->post('id');

        $hasil = $this->m_denda->bayar($pengembalian_id);

        if ($hasil) {
            redirect('peminjaman/detail');
        } else {
            echo "Pembayaran gagal";
        }
    }
}
