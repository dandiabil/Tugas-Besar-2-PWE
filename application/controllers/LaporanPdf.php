<?php 
defined('BASEPATH') OR exit("No direct script access allowed");

class LaporanPdf extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('pdf');
    }

    public function index(){
        $pdf = new FPDF('P', 'mm', 'A4');
        //buat halaman
        $pdf->AddPage();
        //setting font
        $pdf->SetFont('Arial', 'B', 16);
        //buat string
        $pdf->Cell(190, 7, 'Data Nilai Mahasiswa', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        //memberi jarak/space
        $pdf->Cell(10, 7, '', 0, 1, 'C');
        //meratakan
        $pdf->Cell(10, 7, '', 0, 0, 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 7, 'No', 1, 0, 'C');
        $pdf->Cell(25, 7, 'NIM', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Nama Mahasiswa', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Program Studi', 1, 0, 'C');
        $pdf->Cell(25, 7, 'Alamat', 1, 0, 'C');
        $pdf->Cell(20, 7, 'Nilai', 1, 1, 'C');
        
        $no = 1;
        $pdf->SetFont('Arial', '', 10);
        $mahasiswa = $this->db->get('tbl_mhs')->result();
        foreach($mahasiswa as $row){
            $pdf->Cell(10, 7, '', 0, 0, 'C');
            $pdf->Cell(10, 7, $no, 1, 0, 'C');
            $pdf->Cell(25, 7, $row->no_mhs, 1, 0, 'C');
            $pdf->Cell(50, 7, $row->nama_mhs, 1, 0, 'C');
            $pdf->Cell(40, 7, $row->prodi, 1, 0, 'C');
            $pdf->Cell(25, 7, $row->alamat, 1, 0, 'C');
            $pdf->Cell(20, 7, $row->nilai, 1, 1, 'C');
            $no++;
        }
        $pdf->Output();
    }
}

?>