<?php
class Pengembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('m_pengembalian');
    }

    // Menampilkan form pengembalian
    public function pengembalian_buku($id)
    {
        $data['pinjam'] = $this->m_pengembalian->getById($id);

        $this->load->view('peminjaman/pengembalian_buku', $data);
    }

    // Menyimpan pengembalian
    public function detail_pengembalian()
    {
        $data = [
            'peminjaman_id'   => $this->input->post('peminjaman_id'),
            'buku_id'         => $this->input->post('buku_id'),
            'kondisi_buku'    => $this->input->post('kondisi_buku')
        ];

        $hasil = $this->m_pengembalian->kembalikan($data);

        if ($hasil)
        {
            redirect('peminjaman/detail');
        }
        else
        {
            echo "Pengembalian gagal";
        }
    }
}
