<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->model(array('m_crud','m_kategori','m_indonesia','m_user', 'm_auth','m_lelang','m_pekerjaan','m_tawaran'));
	}

	public function index()
	{
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
            $data['pemilihan'] = $this->m_crud->getNumRows('lelangags_lelang', array('lelang_status'=>status_enable));
            $data['pengerjaan'] = $this->m_crud->getNumRows('lelangags_lelang', array('lelang_status'=>status_pengerjaan));
            $data['selesai'] = $this->m_crud->getNumRows('lelangags_lelang', array('lelang_status'=>status_finish));
            $data['kedaluarsa'] = $this->m_crud->getNumRows('lelangags_lelang', array('lelang_status'=>status_disable));
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js");
            $this->load->view("admin/v_dashboard", $data);
    	}
	}
}
