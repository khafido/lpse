<?php
class Register extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->library(array('form_validation','email'));
    $this->load->helper(array('url','form'));
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
      $data['title'] = "Registrasi";
      $this->load->view('includes/v_header', $data);
      $this->load->view('v_register');
      $this->load->view('includes/v_footer');
    }
  }

  public function daftar(){
      $this->form_validation->set_rules('email', 'Email','is_unique[lelangags_user.user_email]');
      $this->form_validation->set_rules('pass','Password','max_length[40]');
      $this->form_validation->set_rules('conf','Konfirmasi Password','matches[pass]');

      $this->form_validation->set_message('matches','Konfirmasi Password tidak sama!');
      $this->form_validation->set_message('is_unique','Email sudah terdaftar!');
      $this->form_validation->set_message('max_length','Maksimal %i karakter!');

      if($this->form_validation->run() == FALSE) {
        $data['title'] = "Registrasi";
        $this->load->view('includes/v_header', $data);
        $this->load->view('v_register');
        $this->load->view('includes/v_footer');
      } else {
          $data['user_nama'] = $this->input->post('name');
          $data['user_email'] = $this->input->post('email');
          $data['user_pass'] = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);

          $sukses = $this->m_auth->createUser($data);
          if($sukses == berhasil_register){
            $data_user = $this->m_auth->getUserByEmail($data['user_email']);
            $this->session->set_userdata('data_user', $data_user);
          }
        redirect(site_url('/register'));
      }
  }
}
?>