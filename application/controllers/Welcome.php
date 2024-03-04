<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->model('ModelData', 'model');

		if (!$this->Auth_model->current_user()) {
			redirect('login/logout');
		}
	}

	public function index()
	{
		$data['user'] = $this->Auth_model->current_user();

		$putra = $this->model->getBy2JoinSelect('rekap', 'tindakan', 'jkl', 'Laki-laki', 'nominal !=', '0', 'id_tindakan', 'id_tindakan', 'rekap.nis')->num_rows();
		$putraLunas = $this->model->getBy3JoinSelect('rekap', 'tindakan', 'jkl', 'Laki-laki', 'status', 'lunas', 'nominal !=', '0', 'id_tindakan', 'id_tindakan', 'rekap.nis')->num_rows();

		$data['putraLunas'] = $putraLunas > 0 ? round($putraLunas / $putra * 100, 1) : 0;
		$data['putraBelum'] = round(100 - $data['putraLunas'], 1);

		$putri = $this->model->getBy2JoinSelect('rekap', 'tindakan', 'jkl', 'Perempuan', 'nominal !=', '0', 'id_tindakan', 'id_tindakan', 'rekap.nis')->num_rows();
		$putriLunas = $this->model->getBy3JoinSelect('rekap', 'tindakan', 'jkl', 'Perempuan', 'status', 'lunas', 'nominal !=', '0', 'id_tindakan', 'id_tindakan', 'rekap.nis')->num_rows();

		$data['putriLunas'] = $putriLunas > 0 ? round($putriLunas / $putri * 100, 1) : 0;
		$data['putriBelum'] = round(100 - $data['putriLunas'], 1);

		$this->load->view('index', $data);
	}
}
