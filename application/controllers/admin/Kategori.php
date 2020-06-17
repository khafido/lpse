<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->model('m_crud');
	}

	public function index()
	{
	    $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");
        $data['controller'] = $this;
        $data['parent'] = $this->m_crud->selectBy('lelangags_kategori', array('kategori_parentid'=>0,'kategori_status'=>status_enable));
        $this->load->view('admin/v_kategori', $data);
	}
	
	public function form($action, $id){
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js");  
            $kat = $this->m_crud->selectBy('lelangags_kategori', array('kategori_parentid'=>0, 'kategori_status'=>status_enable));
            $data["kat"] = $kat;
    	    if($action=='tambah'){
                $data['detail'] = null;
                // $data["kat"] = $kat;
    	    } else {
                $data["detail"] = $this->m_crud->selectBy('lelangags_kategori', array('kategori_id'=> $id, 'kategori_status'=>status_enable))[0];
            }
            // $data['katid'] = ($kat)?$kat->kategori_id:0;
            $this->load->view("admin/v_kategori_form", $data);
        }
	}
	
	public function getSub($id){
        // $sub = $this->m_kategori->getSubParentKategori();
        $sub = $this->m_crud->selectBy('lelangags_kategori', array('kategori_parentid' => $id, 'kategori_subparentid' =>0, 'kategori_status'=>status_enable));
        return $sub;
    }
    public function getProduk($id){
        // $produk = $this->m_kategori->getKategori($id);
        $produk = $this->m_crud->selectBy('lelangags_kategori',array('kategori_subparentid' => $id,'kategori_parentid!='=>0,'kategori_status'=>status_enable));
        return $produk;
    }
    
    public function tambah($id = null) {
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
    	   // if ($id === null) {
        //         redirect(site_url('/admin/spesifikasi')); 
        //     } else {
                $this->load->view("admin/includes/header");
                $this->load->view("admin/includes/js"); 
                
                $data['kategori_nama'] = $this->input->post('name');
                $data['kategori_parentid'] = $this->input->post('kat');
                $data['kategori_subparentid'] = $this->input->post('sub');
                $data['kategori_status'] = status_enable;
                
                $save = $this->m_crud->save('lelangags_kategori',$data);
                if ($save == true){
                     redirect(site_url('admin/kategori'));
                }
            // }
        }
    }
    public function ubah($id = null) {
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
    	   // if ($id === null) {
        //         redirect(site_url('/admin/spesifikasi')); 
        //     } else {
                $this->load->view("admin/includes/header");
                $this->load->view("admin/includes/js"); 
                
                $kid = $this->input->post('kid');
                $data['kategori_nama'] = $this->input->post('name');
                $data['kategori_parentid'] = $this->input->post('kat');
                $data['kategori_subparentid'] = $this->input->post('sub');
                $data['kategori_status'] = status_enable;
                
                $save = $this->m_crud->update('lelangags_kategori', array('kategori_id'=>$kid),$data);
                if ($save == true){
                     redirect(site_url('admin/kategori'));
                }
            // }
        }
    }
    
    public function hapus($id=null){
        if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
            $kid = $id;
            $data['kategori_status'] = status_disable;
            $save = $this->m_crud->update('lelangags_kategori', array('kategori_id'=>$kid),$data);
            if ($save == true){
                 redirect(site_url('admin/kategori'));
            }
        }
    }
}

