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
        $data['penerimaan'] = $this->M_penerimaan->get_all();
        $this->load->view('v_header');
        $this->load->view('v_penerimaan', $data);
        $this->load->view('v_footer');
    }

	public function tambah($order_id)
	{
		$data['order']  = $this->M_order->get_by_id($order_id);
		$data['detail'] = $this->M_order->get_detail($order_id);

		foreach ($data['detail'] as $d) {
			$total_diterima = $this->M_order->get_total_diterima($d->id);
			$d->sisa = $d->quantity - $total_diterima;
		}

		$this->load->view('v_header');
		$this->load->view('v_penerimaan_tambah', $data);
		$this->load->view('v_footer');
	}

    public function simpan()
    {
        $detail_order_id = $this->input->post('detail_order_id');
        $jumlah_diterima = $this->input->post('jumlah_diterima');

        $detail = $this->M_order->get_detail_by_id($detail_order_id);

        $data = array(
            'detail_order_id' => $detail_order_id,
            'tanggal_terima'  => $this->input->post('tanggal_terima'),
            'jumlah_diterima' => $jumlah_diterima,
        );
        $this->M_penerimaan->insert($data);

        $this->M_buku->tambah_stok($detail->buku_id, $jumlah_diterima);
        $this->M_order->cek_status($detail->order_id);

        redirect('order/detail/'.$detail->order_id);
    }
}
