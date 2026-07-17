<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_buku');
    }

    public function index()
    {
        $this->load->view('v_header');
        $this->load->view('v_buku');
        $this->load->view('v_footer');
    }

    public function loaddata()
    {
        $data = $this->M_buku->get_all();
        echo json_encode($data);
    }

    public function simpan_ajax()
    {
        $judul = $this->input->post('judul');
        $lokasi_rak = $this->input->post('lokasi_rak');

        if ($this->M_buku->cek_judul($judul)) {
            echo json_encode(array('error' => true, 'message' => 'Judul buku sudah ada!'));
            return;
        }

        $this->M_buku->insert(array(
            'judul' => $judul,
            'lokasi_rak' => $lokasi_rak,
            'stok' => 0
        ));

        echo json_encode(array('error' => false, 'message' => 'Buku berhasil ditambahkan'));
    }

    public function get_buku()
    {
        $id = $this->input->post('id');
        $buku = $this->M_buku->get_by_id($id);
        echo json_encode($buku);
    }

    public function update_ajax()
    {
        $id = $this->input->post('id');
        $judul = $this->input->post('judul');
        $lokasi_rak = $this->input->post('lokasi_rak');

        if ($this->M_buku->cek_judul($judul, $id)) {
            echo json_encode(array('error' => true, 'message' => 'Judul buku sudah dipakai buku lain!'));
            return;
        }

        $this->M_buku->update($id, array(
            'judul' => $judul,
            'lokasi_rak' => $lokasi_rak
        ));

        echo json_encode(array('error' => false, 'message' => 'Buku berhasil diupdate'));
    }

    public function hapus_ajax()
    {
        $id = $this->input->post('id');
        $this->M_buku->delete($id);
        echo json_encode(array('error' => false, 'message' => 'Buku berhasil dihapus'));
    }
}
