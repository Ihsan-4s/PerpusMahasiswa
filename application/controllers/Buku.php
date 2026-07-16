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
        $data['buku'] = $this->M_buku->get_all();
        $this->load->view('v_header');
        $this->load->view('v_buku', $data);
        $this->load->view('v_footer');
    }

    public function tambah()
    {
        $this->load->view('v_header');
        $this->load->view('v_buku_tambah');
        $this->load->view('v_footer');
    }

    public function simpan()
    {
        $judul = $this->input->post('judul');

        if ($this->M_buku->cek_judul($judul)) {
            $this->session->set_flashdata('error', 'Buku dengan judul tersebut sudah ada!');
            redirect('buku/tambah');
            return;
        }

        $data = array(
            'judul'      => $judul,
            'lokasi_rak' => $this->input->post('lokasi_rak'),
            'stok'       => 0
        );
        $this->M_buku->insert($data);
        redirect('buku');
    }

    public function edit($id)
    {
        $data['buku'] = $this->M_buku->get_by_id($id);
        $this->load->view('v_header');
        $this->load->view('v_buku_edit', $data);
        $this->load->view('v_footer');
    }

    public function update($id)
    {
        $data = array(
            'judul'      => $this->input->post('judul'),
            'lokasi_rak' => $this->input->post('lokasi_rak'),
        );
        $this->M_buku->update($id, $data);
        redirect('buku');
    }

    public function hapus($id)
    {
        $this->M_buku->delete($id);
        redirect('buku');
    }
}
