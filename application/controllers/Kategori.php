<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
		$this->load->helper(array('url','form'));
// 		$this->load->model('m_kategori');
		$this->load->model('m_indonesia');
		$this->load->model('m_lelang');
		$this->load->model('m_pekerjaan');
		$this->load->model('m_crud');
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
                $data['title'] = "Kategori";
                $this->load->view('includes/v_header', $data);
                $this->load->view('includes/v_footer');
            }
        }
	}
	
	public function getSub(){
        $id = $this->input->post('id');
        // $data = $this->m_kategori->getSubParentKategori($parentid);
        $data = $this->m_crud->selectBy('lelangags_kategori', array('kategori_parentid' => $id, 'kategori_subparentid' =>0, 'kategori_status!='=>1));
        echo json_encode($data);
    }

    public function getProduk(){
        $id = $this->input->post('id');
        // $data = $this->m_kategori->getKategori($subparentid);
        $data = $this->m_crud->selectBy('lelangags_kategori',array('kategori_subparentid' => $id,'kategori_parentid!='=>0,'kategori_status!='=>1));
        echo json_encode($data);
    }
}