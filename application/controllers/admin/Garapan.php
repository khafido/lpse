<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Garapan extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->model(array('m_crud','m_kategori','m_indonesia','m_user', 'm_auth','m_lelang','m_pekerjaan','m_tawaran'));
		$this->load->helper(array('url','form'));
	}

	public function index()
	{
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
    	    $data['controller'] = $this;
            $data['parent'] = $this->m_kategori->selectKategori();
            $data['pembayaran'] = unserialize(PEMBAYARAN);
            $data['statuslelang'] = unserialize(STATUSLELANG);
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js");
    	    $data["lelangs"] = $this->m_crud->selectBy('lelangags_lelang', 'lelang_status in (1,2,3,4,5,6)');
            $this->load->view("admin/v_lelang", $data);
        }
	}
	
	public function Pemilihan()
	{
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
    	    $data['controller'] = $this;
            $data['parent'] = $this->m_kategori->selectKategori();
            $data['pembayaran'] = unserialize(PEMBAYARAN);
            // $data['statuslelang'] = unserialize(STATUSLELANG);
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js");
    	    $data["lelangs"] = $this->m_crud->selectBy('lelangags_lelang', array('lelang_status'=>status_enable));
            $this->load->view("admin/v_lelang", $data);
        }
	}
	
	public function pengerjaan()
	{
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
    	    $data['controller'] = $this;
            $data['parent'] = $this->m_kategori->selectKategori();
            $data['pembayaran'] = unserialize(PEMBAYARAN);
            // $data['statuslelang'] = unserialize(STATUSLELANG);
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js");
    	    $data["lelangs"] = $this->m_crud->selectBy('lelangags_lelang', array('lelang_status'=>status_pengerjaan));
            $this->load->view("admin/v_lelang", $data);
        }
	}
	
	public function selesai()
	{
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
    	    $data['controller'] = $this;
            $data['parent'] = $this->m_kategori->selectKategori();
            $data['pembayaran'] = unserialize(PEMBAYARAN);
            // $data['statuslelang'] = unserialize(STATUSLELANG);
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js");
    	    $data["lelangs"] = $this->m_crud->selectBy('lelangags_lelang', array('lelang_status'=>status_finish));
            $this->load->view("admin/v_lelang", $data);
        }
	}
	
	public function kedaluarsa()
	{
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
    	    $data['controller'] = $this;
            $data['parent'] = $this->m_kategori->selectKategori();
            $data['pembayaran'] = unserialize(PEMBAYARAN);
            // $data['statuslelang'] = unserialize(STATUSLELANG);
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js");
    	    $data["lelangs"] = $this->m_crud->selectBy('lelangags_lelang', array('lelang_status'=>status_disable));
            $this->load->view("admin/v_lelang", $data);
        }
	}
	
	public function hapus()
	{
	    if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
    	    $data['controller'] = $this;
            $data['parent'] = $this->m_kategori->selectKategori();
            $data['pembayaran'] = unserialize(PEMBAYARAN);
            // $data['statuslelang'] = unserialize(STATUSLELANG);
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js");
    	    $data["lelangs"] = $this->m_crud->selectBy('lelangags_lelang', array('lelang_status'=>status_delete));
            $this->load->view("admin/v_lelang", $data);
        }
	}
	
    public function restore($id=null)
    {
        if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
            // $data['controller'] = $this;
            $select = $this->m_crud->selectBy('lelangags_lelang', array('lelang_id'=>$id));
            $tgl= $select[0]->lelang_tglselesai;
            $date_now = date("Y-m-d H:i:s");
            if ($tgl >= $date_now) {
                $data['lelang_status'] = 3; 
            }else{
                $data['lelang_status'] = 5; 
            }
            
            if ($this->m_crud->update('lelangags_lelang', array('lelang_id'=>$id), $data)) {
                redirect(site_url('admin/garapan'));
            }
        }
    }

    public function delete($id=null)
    {
        if (!$this->session->userdata('data_admin')){
            redirect(site_url('admin/login'));
        } else {
            if (!isset($id)) show_404();
            $url = $this->uri->segment(3);
            $data['lelang_status'] = 1; 
            if ($this->m_crud->update('lelangags_lelang', array('lelang_id'=>$id), $data)) {
                redirect(site_url('admin/garapan'));
            }
        }
    }
    
    public function getSub($id){
        $sub = $this->m_kategori->getSubParentKategori($id);
        return $sub;
    }
    
    public function getProduk($id){
        $produk = $this->m_kategori->getKategori($id);
        return $produk;
    }
    
    public function getKabProv($idKab){
        $kabprov = $this->m_indonesia->selectKabProv($idKab);
        return $kabprov[0];
    }
    
    public function getUserDetail($id){
        $user = $this->m_auth->getUserByID($id);
        return $user;
    }
    
    public function getpemanang($id){
        $select = $this->m_crud->selectby('lelangags_lelang', array('lelang_id'=>$id));
        $pemenangid = $select[0]->lelang_mitraid; 
        $select2 = $this->m_crud->selectby('lelangags_user', array('user_id'=>$pemenangid));
        $pemenangnama = $select2[0]->user_nama; 
        return $pemenangnama;
    }  
    
    public function getDaftarProduk($id){
        // $dataP = $this->m_pekerjaan->getDaftarProduk($id);
        $dataP = $this->m_crud->selectOrderBy('Detail_Pekerjaan', array('pekerjaan_lelangid'=>$id), 'pekerjaan_cdate', 'ASC');
        $produk = array();
        foreach($dataP as $val){
            array_push($produk, array("idp"=>$val->pekerjaan_id, "idl"=>$val->pekerjaan_lelangid, "nama"=>$val->kategori_nama, "ukuran"=>$val->pekerjaan_ukuran, "bahan"=>$val->pekerjaan_bahan, "catatan"=>$val->pekerjaan_catatan, "jumlah"=>$val->pekerjaan_jumlah, "idk"=>$val->pekerjaan_kategoriid, "harga"=>$val->pekerjaan_harga, "sisi"=>$val->pekerjaan_jmlsisi, "laminasi"=>$val->pekerjaan_laminasi));
        }
        return $produk;
    }
    
    public function getJumlahProduk($id){
        // $jumlah = $this->m_pekerjaan->getJumlahProduk($id);
        $jumlah = $this->m_crud->getNumRows('Detail_Pekerjaan', array('pekerjaan_lelangid'=>$id));
        return $jumlah;
    }
	
    
    public function getDaftarTawaran($id){
        // $tawaran =  $this->m_tawaran->selectTawPekBy($where);
        // array_push($where, array('twpekerjaan_status'=>status_enable));
        $tawaran =  $this->m_crud->selectOrderBy('Lihat_Tawaran_Produk', $id, 'tawaran_anggaran ASC, twpekerjaan_pekerjaanid ASC');
        $produk = array();
        foreach($tawaran as $val){
            array_push($produk, array("pid"=>$val->twpekerjaan_pekerjaanid, "hargap"=>$val->twpekerjaan_anggaran, "total"=>$val->tawaran_anggaran, "unama"=>$val->user_nama, "foto"=>$val->user_imgurl, 'tawaran_status'=>status_enable));
        }
        return ($produk);
    }
    
    public function getJumlahTawaran($id){
        // $jumlah = $this->m_tawaran->getJumlahTawaran($id);
        $jumlah = $this->m_crud->getNumRows('Lihat_Tawaran', array('lelang_id'=>$id, 'tawaran_status'=>status_enable));
        return $jumlah;
    }
}