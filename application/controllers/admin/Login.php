<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_crud','m_kategori','m_indonesia','m_user', 'm_auth','m_lelang','m_pekerjaan','m_tawaran'));
	}
	
	public function index() {
	   // $session_data = $this->session->all_userdata();
    //     echo '<pre>';
    //     print_r($session_data);
	           //   $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");
        $this->load->view('admin/v_login');
    }
	
	public function check(){
    $user = $this->input->post('user');
    $passinput = $this->input->post('pass');
    $pass = md5($passinput);
    $passcheck = "0192023a7bbd73250516f069df18b500";
    if ($pass===$passcheck && $user==="admin") {
        // $data_admin = "admin";
        $this->session->set_userdata('data_admin', true);
        redirect(site_url('admin/dashboard'));
    } else {
        $this->session->set_flashdata('login_error', 'Username/Password salah');
        redirect(site_url('admin/login'));
    }
    // redirect(site_url('admin/login'));
  }
  
  public function out(){
      $this->session->unset_userdata('data_admin');
      redirect(site_url('admin/login'));
  }
}