<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->library(array('form_validation','session'));
    $this->load->helper(array('url','form'));
    $this->load->model('m_crud');
    $this->load->model('m_auth');
  }

  public function index()
  {
    $data_u = $this->session->userdata('data_user');
    if ($data_u){
        if(!$data_u['user_status']){
            redirect(site_url('/verifikasi'));
        } else {
            redirect(site_url('/'));
        }
    } else {
        $data['title'] = "Login";
        $this->load->view('includes/v_header', $data);
        $this->load->view('v_login');
        $this->load->view('includes/v_footer');
    }
  }

  public function check(){
    $email = $this->input->post('email');
    $pass = $this->input->post('pass');
    // $pass = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
    
    if ($this->m_auth->userLogin($email, $pass)==berhasil_login) {
        if (!$this->session->userdata('data_user')){
            $data_user = $this->m_auth->getUserByEmail($email);
            $this->session->set_userdata('data_user', $data_user);        
        }
    } else {
        $this->session->set_flashdata('error', $this->m_auth->userLogin($email, $pass)); 
    }
    redirect(site_url('/login'));
  }
  
  public function out(){
      $this->session->unset_userdata('data_user');
      redirect(site_url('/login'));
  }
}
