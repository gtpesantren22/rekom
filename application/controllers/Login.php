<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // $this->load->model('DataModel');
        $this->load->model('Auth_model');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function masuk()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        }

        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);


        if ($this->Auth_model->login($username, $password)) {
            $this->session->set_flashdata('ok', 'Anda berhasil login');
            redirect('welcome');
        } else {
            $this->session->set_flashdata('error', 'Login gagal');
            redirect('login');
        }
    }

    public function daftar()
    {
        $this->load->view('daftar');
    }

    public function daftarAct()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $passOk = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'id_user' => $this->uuid->v4(),
            'nama' => ucwords($this->input->post('nama', true)),
            'username' => $username,
            'password' => $passOk,
            'aktif' => 'T',
            'level' => 'operator',
        ];

        $this->Auth_model->tambah('user', $data);
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('ok', 'Akun sudah dibuat. Silahkan menghubungi admin untuk aktifasi akun anda');
            redirect('login');
        }
    }

    public function logout()
    {
        // $this->load->model('Auth_model');
        $this->Auth_model->logout();
        $this->session->set_flashdata('ok', 'Logout berhasil');
        redirect('login');
    }
}
