<?php
class Pengembalian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pengembalian');
	}

	public function form($id)
	{
		$data['pinjam'] = $this->M_pengembalian->getById($id);

		$this->load->view('pengembalian/form', $data);
	}
}
