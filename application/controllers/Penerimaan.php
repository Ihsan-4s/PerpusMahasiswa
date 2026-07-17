<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_penerimaan');
        $this->load->model('M_order');
        $this->load->model('M_buku');
    }

    public function index()
    {
        $this->load->view('v_header');
        $this->load->view('v_penerimaan');
        $this->load->view('v_footer');
    }

    public function loaddata()
    {
        $data = $this->M_penerimaan->get_all();
        echo json_encode($data);
    }

    public function tambah($order_id)
    {
        $data['order_id'] = $order_id;
        $this->load->view('v_header');
        $this->load->view('v_penerimaan_tambah', $data);
        $this->load->view('v_footer');
    }

    public function get_form_info()
    {
        $order_id = $this->input->post('order_id');
        $order = $this->M_order->get_by_id($order_id);
        $detail = $this->M_order->get_detail($order_id);

        foreach ($detail as $d) {
            $total_diterima = $this->M_order->get_total_diterima($d->id);
            $d->sisa = $d->quantity - $total_diterima;
        }

        echo json_encode(array('order' => $order, 'detail' => $detail));
    }

    public function simpan_ajax()
    {
        $detail_order_id = $this->input->post('detail_order_id');
        $jumlah_diterima = $this->input->post('jumlah_diterima');

        $detail = $this->M_order->get_detail_by_id($detail_order_id);
        $total_diterima = $this->M_order->get_total_diterima($detail_order_id);

        if ($total_diterima >= $detail->quantity) {
            echo json_encode(array('error' => true, 'message' => 'Buku ini sudah diterima sepenuhnya!'));
            return;
        }

        $this->M_penerimaan->insert(array(
            'detail_order_id' => $detail_order_id,
            'tanggal_terima'  => $this->input->post('tanggal_terima'),
            'jumlah_diterima' => $jumlah_diterima,
        ));

        $this->M_buku->tambah_stok($detail->buku_id, $jumlah_diterima);
        $this->M_order->cek_status($detail->order_id);

        echo json_encode(array('error' => false, 'message' => 'Penerimaan berhasil disimpan'));
    }
}
