<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session','pagination'));
		$this->load->helper(array('url','form'));
		$this->load->model('m_kategori');
		$this->load->model('m_indonesia');
		$this->load->model('m_lelang');
		$this->load->model('m_pekerjaan');
		$this->load->model('m_auth');
		$this->load->model('m_user');
		$this->load->model('m_tawaran');
	}

	public function index(){
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
                $data_u = $this->session->userdata('data_user');
                $data['title'] = "Mitra";
                $data['controller'] = $this;
                $this->load->view('includes/v_header', $data);
                // $data['mitra'] = $this->m_user->selectAllUser();
                
                $per_page = 5;
        		$from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $totalData = $this->m_user->getTotalByUser();
                $data['mitra'] = $this->m_user->selectUser($per_page, $from);
                
                // Paging
                $config['base_url'] = base_url().'Mitra/index';
        		$config['total_rows'] = $totalData;
        		$config['per_page'] = $per_page;
        		$config["uri_segment"] = 3; 
                $config["num_links"] = floor($totalData / $per_page);
         
                // Membuat Style pagination untuk BootStrap v4
                $config['first_link']       = 'First';
                $config['last_link']        = 'Last';
                $config['next_link']        = 'Next';
                $config['prev_link']        = 'Prev';
                $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
                $config['full_tag_close']   = '</ul></nav></div>';
                $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
                $config['num_tag_close']    = '</span></li>';
                $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
                $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
                $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
                $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['prev_tagl_close']  = '</span>Next</li>';
                $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
                $config['first_tagl_close'] = '</span></li>';
                $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
                $config['last_tagl_close']  = '</span></li>';
                    
        		$this->pagination->initialize($config);		
        		
                $data["links"] = $this->pagination->create_links();
                // $data["links"] = $this->pagination->create_links();
                
                $this->load->view('v_mitra',$data);
                $this->load->view('includes/v_footer');
            }
        }
	}
	
	public function profil(){
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
                $data_u = $this->session->userdata('data_user');
                $data['title'] = "Profil Mitra";
                $this->load->view('includes/v_header', $data);
                $this->load->view('v_detail_mitra');
                $this->load->view('includes/v_footer');
            }
        }
	}
	
	public function getKabProv($idKab){
        $kabprov = $this->m_indonesia->selectKabProvMitra($idKab);
        return $kabprov;
    }
	
	
	
}