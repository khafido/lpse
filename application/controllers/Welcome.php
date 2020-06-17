<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session','pagination'));
		$this->load->helper(array('url','form'));
		$this->load->model('m_crud');
		$this->load->model('m_kategori');
		$this->load->model('m_indonesia');
		$this->load->model('m_lelang');
		$this->load->model('m_pekerjaan');
		$this->load->model('m_auth');
		$this->load->model('m_tawaran');
	}
	
// 	public function index()
// 	{
// 	    $data['title'] = "Ayo Lelang";
// 	   // $data['lelang'] = this->m_lelang;
	    
	    
// 		$this->load->view('includes/v_header', $data);
//       	$this->load->view('v_home');
//       	$this->load->view('includes/v_footer');
// 	}
	
	public function index(){
	    $data_u = $this->session->userdata('data_user');
        $data['controller'] = $this;
        $data['title'] = "Ayo Lelang";
        $data['parent'] = $this->m_crud->selectBy('lelangags_kategori', array('kategori_parentid'=>0,'kategori_status!='=>1));
        $data['pembayaran'] = unserialize(PEMBAYARAN);
        
        $this->load->view('includes/v_header', $data);
        
        $data['lelang'] = $this->m_lelang->selectByProduk(0, 9, 0, $data_u['user_id']);
        
        $this->load->view('v_home', $data);
        $this->load->view('includes/v_footer');
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
        return $produk;
    }
    
    public function getJumlahTawaran($id){
        $jumlah = $this->m_crud->getNumRows('Lihat_Tawaran', array('lelang_id'=>$id, 'tawaran_status'=>status_enable));
        return $jumlah;
    }	
}
