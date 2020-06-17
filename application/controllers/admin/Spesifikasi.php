<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Spesifikasi extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_crud','m_kategori','m_indonesia','m_user', 'm_auth','m_lelang','m_pekerjaan','m_tawaran'));
	}

	public function index()	{
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js");
    	    $data["spesifikasi"] = $this->m_crud->selectBy('Detail_Kategori', array('specbarang_status'=>3));
            $this->load->view("admin/v_spesifikasi", $data);
            //$this->load->view("admin/includes/footer");
        }
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
                $data['spesifikasi'] = null;
                $data['prod'] = null;
                // $data["kat"] = $kat;
    	    } else {
                $data["spesifikasi"] = $this->m_crud->selectBy('Detail_Kategori', array('specbarang_id'=> $id))[0];
                $data['prod'] = $this->m_crud->selectBy('lelangags_kategori', array('kategori_id'=>$data['spesifikasi']->specbarang_kategoriid, 'kategori_status'=>status_enable))[0];
                if (!$data["spesifikasi"]) show_404();
            }
            // $data['katid'] = ($kat)?$kat->kategori_id:0;
            $this->load->view("admin/v_spesifikasi_form", $data);
        }
	}
	
	public function tambah($id = null) {
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
    	    if ($id === null) {
                redirect(site_url('/admin/spesifikasi')); 
            } else {
                $this->load->view("admin/includes/header");
                $this->load->view("admin/includes/js"); 
                
                $data['specbarang_kategoriid'] = $this->input->post('produk');
                $data['specbarang_ukuran'] = $this->input->post('ukuran');
                $data['specbarang_bahan'] = $this->input->post('bahan');
                $data['specbarang_jmlsisi'] = $this->input->post('sisi');
                $data['specbarang_laminasi'] = $this->input->post('laminasi');
                $data['specbarang_hargasatuan'] = $this->input->post('harga');
                $data['specbarang_satuan'] = $this->input->post('satuan');
                $data['specbarang_status'] = $this->input->post('specbarang_status');
                
                $update = $this->m_crud->save('lelangags_specbarang',$data);
                if ($update == true){
                     redirect(site_url('admin/spesifikasi'));
                }
            }
        }
    }
    
    public function ubah($id = null) {
        if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
            $id = $this->input->post('specbarang_id');
            if ($id === null) {
                redirect(site_url('/admin/spesifikasi')); 
            } else {
                $this->load->view("admin/includes/header");
                $this->load->view("admin/includes/js"); 
                
                $id = $this->input->post('specbarang_id');
                $data['specbarang_kategoriid'] = $this->input->post('produk');
                $data['specbarang_ukuran'] = $this->input->post('ukuran');
                $data['specbarang_bahan'] = $this->input->post('bahan');
                $data['specbarang_jmlsisi'] = $this->input->post('sisi');
                $data['specbarang_laminasi'] = $this->input->post('laminasi');
                $data['specbarang_hargasatuan'] = $this->input->post('harga');
                $data['specbarang_satuan'] = $this->input->post('satuan');
            
                $update = $this->m_crud->update('lelangags_specbarang',array('specbarang_id'=> $id),$data);
                
                if ($update == true){
                     redirect(site_url('admin/spesifikasi'));
                }
            }
        }
    }
    
    public function delete($id=null)
    {
        if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
            if (!isset($id)) show_404();
            $data['specbarang_status'] = 1; 
            if ($this->m_crud->update('lelangags_specbarang', array('specbarang_id'=>$id), $data)) {
                redirect(site_url('admin/spesifikasi'));
            }
        }
    }
}