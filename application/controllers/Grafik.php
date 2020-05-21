<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('M_grafik');
    }

    public function index(){
        $data['graph'] = $this->M_grafik->get_data_stok();
        $this->load->view('layout/header');
        $this->load->view('v_grafik', $data);
        $this->load->view('layout/footer');
    }
}

?>
