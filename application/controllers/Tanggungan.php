<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tanggungan extends CI_Controller
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

        $data['data'] = $this->model->getBy('tindakan', 'jkl', 'Laki-laki')->result();
        $this->load->view('tanggungan', $data);
    }

    public function putri()
    {
        $data['user'] = $this->Auth_model->current_user();

        $data['data'] = $this->model->getBy('tindakan', 'jkl', 'Perempuan')->result();
        $this->load->view('tanggungan', $data);
    }

    public function add()
    {
        $suer = $this->Auth_model->current_user();
        $data = [
            'id_tindakan' => $this->uuid->v4(),
            'nama' => $this->input->post('nama', true),
            'pj' => $this->input->post('pj', true),
            'jkl' => $this->input->post('jkl', true),
            'id_user' => $suer->id_user,
        ];

        $back = $this->input->post('jkl', true) == 'Laki-laki' ? 'putra' : 'putri';
        $this->model->simpan('tindakan', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Data Berhasil Tersimpan');
            redirect('tanggungan/' . $back);
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            redirect('tanggungan/' . $back);
        }
    }

    public function del($id)
    {
        $this->model->hapus('tindakan', 'id_tindakan', $id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Data Berhasil Tersimpan');
            redirect('tanggungan/putra');
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            redirect('tanggungan/putra');
        }
    }

    public function generate($id)
    {
        $data = $this->model->getBy('tindakan', 'id_tindakan', $id);
        $cek = $this->model->getBy('rekap', 'id_tindakan', $id)->row();
        $back = $data->row('jkl') == 'Laki-laki' ? 'putra' : 'putri';

        if ($cek) {
            $this->session->set_flashdata('error', 'Data Tanggungan Sudah Ada. Harap kosongi dahulu');
            redirect('tanggungan/' . $back);
        } else {
            $santri = $this->model->getBy2Select('tb_santri', 'jkl', $data->row('jkl'), 'aktif', 'Y', 'nis')->result();
            $data_abtch = array();
            foreach ($santri as $dtsan) {
                $data_abtch[] = [
                    'id_rekap' => $this->uuid->v4(),
                    'id_tindakan' => $id,
                    'nis' => $dtsan->nis,
                ];
            }
            $this->model->simpanBatch('rekap', $data_abtch);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('ok', 'Data Berhasil Tersimpan');
                redirect('tanggungan/' . $back);
            } else {
                $this->session->set_flashdata('error', 'Data Gagal');
                redirect('tanggungan/' . $back);
            }
        }
    }

    public function conv($id)
    {
        $data['user'] = $this->Auth_model->current_user();

        $data['data'] = $this->model->getBy('tindakan', 'id_tindakan', $id)->row();
        $data['conversi'] = $this->model->getBy('konversi', 'id_tindakan', $id)->result();
        $this->load->view('conv', $data);
    }

    public function addConv()
    {
        $data = [
            'id_konversi' => $this->uuid->v4(),
            'id_tindakan' => $this->input->post('id_tindakan', true),
            'nama' => $this->input->post('nama', true),
            'nominal' => rmRp($this->input->post('nominal', true)),
            'ket' => $this->input->post('ket', true),
        ];

        $back = $this->input->post('id_tindakan', true);
        $this->model->simpan('konversi', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Data Berhasil Tersimpan');
            redirect('tanggungan/conv/' . $back);
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Tersimpan');
            redirect('tanggungan/conv/' . $back);
        }
    }

    public function delConv($id)
    {
        $data = $this->model->getBy('konversi', 'id_konversi', $id)->row();
        $this->model->hapus('konversi', 'id_konversi', $id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('ok', 'Data Berhasil Terhapus');
            redirect('tanggungan/conv/' . $data->id_tindakan);
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Terhapus');
            redirect('tanggungan/conv/' . $data->id_tindakan);
        }
    }
}
