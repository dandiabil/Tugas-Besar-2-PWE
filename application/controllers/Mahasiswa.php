<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_mhs', 'mhs');
	}

	public function index(){
		$this->load->view('layout/header');
		$this->load->view('data_mhs');
		$this->load->view('layout/footer');
	}

	public function ajax_list(){
		$list = $this->mhs->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $mahasiswa) {
			$no++;
			$row = array();
			$row[] = $mahasiswa->no_mhs;
			$row[] = $mahasiswa->nama_mhs;
			$row[] = $mahasiswa->prodi;
			$row[] = $mahasiswa->tgl_lahir;
			$row[] = $mahasiswa->alamat;
			$row[] = $mahasiswa->nilai;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$mahasiswa->id_mhs."'".')"> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$mahasiswa->id_mhs."'".')"> Delete</a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->mhs->count_all(),
						"recordsFiltered" => $this->mhs->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_edit($id) {
		$data = $this->mhs->get_by_id($id);
		$data->tgl_lahir = ($data->tgl_lahir == '0000-00-00') ? '' : $data->tgl_lahir; 
		echo json_encode($data);
	}

	public function ajax_add() {
		$this->_validate();
		$data = array(
				'no_mhs' => $this->input->post('no_mhs'),
				'nama_mhs' => $this->input->post('nama_mhs'),
				'prodi' => $this->input->post('prodi'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'),
				'nilai' => $this->input->post('nilai'),
			);
		$insert = $this->mhs->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update() {
		$this->_validate();
		$data = array(
				'no_mhs' => $this->input->post('no_mhs'),
				'nama_mhs' => $this->input->post('nama_mhs'),
				'prodi' => $this->input->post('prodi'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'),
				'nilai' => $this->input->post('nilai'),
			);
		$this->mhs->update(array('id_mhs' => $this->input->post('id_mhs')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id) {
		$this->mhs->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('no_mhs') == '') {
			$data['inputerror'][] = 'no_mhs';
			$data['error_string'][] = 'Nomor mahasiswa harus di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_mhs') == '') {
			$data['inputerror'][] = 'nama_mhs';
			$data['error_string'][] = 'Nama mahasiswa harus di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('tgl_lahir') == '') {
			$data['inputerror'][] = 'tgl_lahir';
			$data['error_string'][] = 'Tanggal lahir harus di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('prodi') == '') {
			$data['inputerror'][] = 'prodi';
			$data['error_string'][] = 'Program Studi harus di pilih';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '') {
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat harus di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('nilai') == '') {
			$data['inputerror'][] = 'nilai';
			$data['error_string'][] = 'Nilai harus di isi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}