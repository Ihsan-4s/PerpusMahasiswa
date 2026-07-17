<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_order');
        $this->load->model('M_buku');
    }

    public function index()
    {
        $this->load->view('v_header');
        $this->load->view('v_order');
        $this->load->view('v_footer');
    }

    public function loaddata()
    {
        $data = $this->M_order->get_all();
        echo json_encode($data);
    }

    public function simpan_ajax()
    {
        $order_id = $this->M_order->insert(array(
            'supplier' => $this->input->post('supplier'),
            'tanggal_order' => $this->input->post('tanggal'),
            'status' => 'pending'
        ));
        echo json_encode(array('error' => false, 'message' => 'Order berhasil dibuat', 'order_id' => $order_id));
    }

    public function detail($order_id)
    {
        $data['order_id'] = $order_id;
        $this->load->view('v_header');
        $this->load->view('v_order_detail', $data);
        $this->load->view('v_footer');
    }

    public function get_order_info()
    {
        $order_id = $this->input->post('order_id');
        $order = $this->M_order->get_by_id($order_id);
        $buku = $this->M_buku->get_all();
        echo json_encode(array('order' => $order, 'buku' => $buku));
    }

    public function loaddata_detail()
    {
        $order_id = $this->input->post('order_id');
        $detail = $this->M_order->get_detail($order_id);

        foreach ($detail as $d) {
            $total_diterima = $this->M_order->get_total_diterima($d->id);
            $d->total_diterima = $total_diterima;
            $d->sisa = $d->quantity - $total_diterima;
        }

        echo json_encode($detail);
    }

    public function simpan_detail_ajax()
    {
        $this->M_order->insert_detail(array(
            'order_id' => $this->input->post('order_id'),
            'buku_id'  => $this->input->post('buku_id'),
            'quantity' => $this->input->post('quantity'),
        ));
        echo json_encode(array('error' => false, 'message' => 'Buku berhasil ditambahkan ke order'));
    }

    public function hapus_detail_ajax()
    {
        $id = $this->input->post('id');
        $this->M_order->delete_detail($id);
        echo json_encode(array('error' => false, 'message' => 'Item berhasil dihapus'));
    }
}
