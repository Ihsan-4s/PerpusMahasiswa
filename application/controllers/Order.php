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
        $data['order'] = $this->M_order->get_all();
        $this->load->view('v_header');
        $this->load->view('v_order', $data);
        $this->load->view('v_footer');
    }

    public function tambah()
    {
        $this->load->view('v_header');
        $this->load->view('v_order_tambah');
        $this->load->view('v_footer');
    }

    public function simpan()
    {
        $data = array(
            'supplier' => $this->input->post('supplier'),
            'tanggal_order'  => $this->input->post('tanggal'),
            'status'   => 'pending'
        );
        $order_id = $this->M_order->insert($data);
        redirect('order/detail/'.$order_id);
    }

    public function detail($order_id)
	{
		$data['order']  = $this->M_order->get_by_id($order_id);
		$data['detail'] = $this->M_order->get_detail($order_id);
		$data['buku']   = $this->M_buku->get_all();

		// hitung total diterima per detail
		foreach ($data['detail'] as $d) {
			$d->total_diterima = $this->M_order->get_total_diterima($d->id);
			$d->sisa = $d->quantity - $d->total_diterima;
		}

		$this->load->view('v_header');
		$this->load->view('v_order_detail', $data);
		$this->load->view('v_footer');
	}

    public function simpan_detail()
    {
        $data = array(
            'order_id' => $this->input->post('order_id'),
            'buku_id'  => $this->input->post('buku_id'),
            'quantity' => $this->input->post('quantity'),
        );
        $this->M_order->insert_detail($data);
        redirect('order/detail/'.$this->input->post('order_id'));
    }

    public function hapus_detail($detail_id, $order_id)
    {
        $this->M_order->delete_detail($detail_id);
        redirect('order/detail/'.$order_id);
    }
}
