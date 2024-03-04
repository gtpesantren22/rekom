<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri extends CI_Controller
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

    public function putra()
    {
        $data['user'] = $this->Auth_model->current_user();

        $data['data'] = $this->model->getBy2('tb_santri', 'jkl', 'Laki-laki', 'aktif', 'Y')->result();
        $this->load->view('santri', $data);
    }

    public function putri()
    {
        $data['user'] = $this->Auth_model->current_user();

        $data['data'] = $this->model->getBy2('tb_santri', 'jkl', 'Perempuan', 'aktif', 'Y')->result();
        $this->load->view('santri', $data);
    }
}
