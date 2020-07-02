<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_grafik extends CI_Model{
    function get_data_mhs(){
        $this->db->from('tbl_mhs');
        $this->db->select('nama_mhs', 'nilai');
        $this->db->select_sum('nilai');
        $this->db->group_by('id_mhs');
        return $this->db->get()->result();

    } 
}
?>