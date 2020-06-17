<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->library(array('form_validation','session'));
    $this->load->helper(array('url','form'));
    $this->load->model('m_crud');
    $this->load->model('m_auth');
  }

  public function index()
  {
    if (!$this->session->userdata('data_user')){
        redirect(site_url('/login'));
    } else {
        $data_u = $this->session->userdata('data_user');
        if(!$data_u['user_status']){
            $data['title'] = "Verifikasi";
            $this->load->view('includes/v_header', $data);
            $this->load->view('v_verifikasi');
            $this->load->view('includes/v_footer');
        } else {
            redirect(site_url('/'));
        }
    }
  }

  public function check(){
    $kode = $this->input->post('kode');
    $check = '';
    
    foreach ($kode as $val) {
      $check .= $val;
    }
    $data_u = $this->session->userdata('data_user');
    $data_user = array(
        'verifikasi_userid' => $data_u['user_id'],
        'verifikasi_code' => $check
    );
    
    if ($this->m_auth->verifikasi($data_user)==berhasil_verifikasi) {
        $data_u['user_status'] = TRUE;
        $this->session->set_userdata('data_user', $data_u);
        redirect(site_url('/verifikasi'));
    }
  }
}
