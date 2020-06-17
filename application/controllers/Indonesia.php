<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indonesia extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_indonesia');
    }

    public function getKota(){
        $provinsi_id=$this->input->post('provinsi_id');
        $res_data = $this->m_indonesia->selectKabupaten($provinsi_id);
        echo json_encode($res_data);
    }
}