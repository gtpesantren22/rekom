<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Listdata extends CI_Controller
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
		$data['data'] = $this->db->query("SELECT * FROM rekap JOIN tindakan ON rekap.id_tindakan=tindakan.id_tindakan GROUP BY rekap.id_tindakan")->result();

		$this->load->view('list', $data);
	}
	public function detail($id)
	{
		$data['user'] = $this->Auth_model->current_user();
		$data['id_tindakan'] = $id;
		$data['data'] = $this->db->query("SELECT id_rekap, tb_santri.nis, tb_santri.nama AS names, tindakan.nama AS tindakan, SUM(konversi.nominal * rekap.jumlah) AS nominal, rekap.status FROM rekap JOIN tb_santri ON tb_santri.nis=rekap.nis JOIN tindakan ON rekap.id_tindakan=tindakan.id_tindakan LEFT JOIN konversi ON konversi.id_konversi=rekap.id_konversi WHERE rekap.id_tindakan = '$id' GROUP BY nis ")->result();

		$this->load->view('detail', $data);
	}

	public function del($id)
	{
		$this->model->hapus('rekap', 'id_tindakan', $id);
		$this->model->hapusSantri('rekap', 'id_tindakan', $id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data Berhasil Terhapus');
			redirect('listdata');
		} else {
			$this->session->set_flashdata('error', 'Data Gagal Dihapus');
			redirect('listdata');
		}
	}
	public function edit($id)
	{
		$data['user'] = $this->Auth_model->current_user();
		$data['rekap'] = $this->model->getBy('rekap', 'id_rekap', $id)->row();
		$nis = $data['rekap']->nis;
		$data['tindakan'] = $this->model->getBy('tindakan', 'id_tindakan', $data['rekap']->id_tindakan)->row();
		$data['konversi'] = $this->model->getBy('konversi', 'id_tindakan', $data['rekap']->id_tindakan)->result();
		$data['santri'] = $this->model->getBy('tb_santri', 'nis', $data['rekap']->nis)->row();
		$idtindakan = $data['rekap']->id_tindakan;
		$data['dataRekap'] = $this->db->query("SELECT konversi.nama AS nama, konversi.nominal, jumlah, id_rekap, status FROM rekap JOIN konversi ON rekap.id_konversi=konversi.id_konversi WHERE nis = $nis AND rekap.id_tindakan = '$idtindakan' ")->result();
		$data['santriRekap'] = $this->db->query("SELECT id_rekap, tb_santri.nama FROM tb_santri JOIN rekap ON tb_santri.nis=rekap.nis WHERE rekap.id_tindakan = '$idtindakan' GROUP BY rekap.nis ")->result();

		$this->load->view('edit', $data);
	}

	public function editSave()
	{
		$id = $this->input->post('id', true);
		$data = [
			'nominal' => rmRp($this->input->post('nominal', true)),
			'ket' => $this->input->post('ket', true),
			'status' => $this->input->post('status', true),
		];

		$this->model->edit('rekap', 'id_rekap', $id, $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data Berhasil Terupdate');
			redirect('listdata/edit/' . $id);
		} else {
			$this->session->set_flashdata('error', 'Data Gagal Diupdate');
			redirect('listdata/edit/' . $id);
		}
	}

	public function add()
	{
		$id = $this->uuid->v4();
		$data = [
			'id_rekap' => $id,
			'id_tindakan' => $this->input->post('id_tindakan2', true),
			'nis' => $this->input->post('nis2', true),
			'nominal' => rmRp($this->input->post('nominal2', true)),
			'ket' => $this->input->post('ket2', true),
			'status' => $this->input->post('status2', true),
		];

		$this->model->simpan('rekap', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data Berhasil Tersimpan');
			redirect('listdata/edit/' . $id);
		} else {
			$this->session->set_flashdata('error', 'Data Gagal Disimpan');
			redirect('listdata/edit/' . $id);
		}
	}

	public function delRekap($id)
	{
		$data = $this->model->getBy('rekap', 'id_rekap', $id)->row();
		$data2 = $this->model->getBy2('rekap', 'nis', $data->nis, 'id_konversi', NULL)->row();

		$this->model->hapus('rekap', 'id_rekap', $id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data Berhasil Terhapus');
			redirect('listdata/edit/' . $data2->id_rekap);
		} else {
			$this->session->set_flashdata('error', 'Data Gagal Dihapus');
			redirect('listdata/edit/' . $data2->id_rekap);
		}
	}
	public function lunas($id)
	{
		$data = $this->model->getBy('rekap', 'id_rekap', $id)->row();
		$data2 = $this->model->getBy2('rekap', 'nis', $data->nis, 'id_konversi', NULL)->row();

		$this->model->edit('rekap', 'id_rekap', $id, ['status' => 'lunas']);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data Berhasil Terupdate');
			redirect('listdata/edit/' . $data2->id_rekap);
		} else {
			$this->session->set_flashdata('error', 'Data Gagal Diupdate');
			redirect('listdata/edit/' . $data2->id_rekap);
		}
	}

	public function sinkron()
	{
		$idtindakan = $this->input->post('id_tindakan', true);

		$cek = $this->model->getBySantri('rekap', 'id_tindakan', $idtindakan)->row();
		if ($cek) {
			if ($this->model->hapusSantri('rekap', 'id_tindakan', $idtindakan)) {

				$data = $this->db->query("SELECT id_rekap, rekap.id_tindakan, nis, SUM(konversi.nominal*rekap.jumlah) AS nominal, status FROM rekap LEFT JOIN konversi ON rekap.id_konversi=konversi.id_konversi WHERE rekap.id_tindakan = '$idtindakan' GROUP BY nis")->result();
				$tindakan = $this->model->getBy('tindakan', 'id_tindakan', $idtindakan)->row();
				$data_abtch = array();
				foreach ($data as $dtsan) {
					$data_abtch[] = [
						'id_rekap' => $dtsan->id_rekap,
						'id_tindakan' => $idtindakan,
						'tindakan' => $tindakan->nama,
						'nis' => $dtsan->nis,
						'nominal' => $dtsan->nominal,
						'ket' => $tindakan->pj,
						'status' => $dtsan->status,
					];
				}
				$sql = $this->model->simpanBatchSantri('rekap', $data_abtch);
				if ($sql) {
					echo json_encode(array('status' => 'success', 'pesan' => 'Sinkronisasi data berhasil'));
				} else {
					echo json_encode(array('status' => 'error', 'pesan' => 'Sinkronisasi data gagal'));
				}
			} else {
				echo json_encode(array('status' => 'error', 'pesan' => 'Hapus data lama gagal'));
			}
		} else {
			$data = $this->db->query("SELECT id_rekap, rekap.id_tindakan, nis, SUM(konversi.nominal*rekap.jumlah) AS nominal, status FROM rekap LEFT JOIN konversi ON rekap.id_konversi=konversi.id_konversi WHERE rekap.id_tindakan = '$idtindakan' GROUP BY nis")->result();
			$tindakan = $this->model->getBy('tindakan', 'id_tindakan', $idtindakan)->row();
			$data_abtch = array();
			foreach ($data as $dtsan) {
				$data_abtch[] = [
					'id_rekap' => $dtsan->id_rekap,
					'id_tindakan' => $idtindakan,
					'tindakan' => $tindakan->nama,
					'nis' => $dtsan->nis,
					'nominal' => $dtsan->nominal,
					'ket' => $tindakan->pj,
					'status' => $dtsan->status,
				];
			}
			$sql = $this->model->simpanBatchSantri('rekap', $data_abtch);
			if ($sql) {
				echo json_encode(array('status' => 'success', 'pesan' => 'Sinkronisasi data berhasil'));
			} else {
				echo json_encode(array('status' => 'error', 'pesan' => 'Sinkronisasi data gagal'));
			}
		}
	}

	public function addKonv()
	{
		$id = $this->uuid->v4();
		$data = [
			'id_rekap' => $id,
			'id_tindakan' => $this->input->post('id_tindakan2', true),
			'id_konversi' => $this->input->post('id_konversi', true),
			'nis' => $this->input->post('nis2', true),
			'jumlah' => $this->input->post('jumlah', true),
			'status' => 'belum',
		];

		$this->model->simpan('rekap', $data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('ok', 'Data Berhasil Tersimpan');
			redirect('listdata/edit/' . $id);
		} else {
			$this->session->set_flashdata('error', 'Data Gagal Disimpan');
			redirect('listdata/edit/' . $id);
		}
	}
}
