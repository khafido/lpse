<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lelang extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session','pagination'));
		$this->load->helper(array('url','form'));
// 		$this->load->model('m_kategori');
		$this->load->model('m_indonesia');
		$this->load->model('m_lelang');
		$this->load->model('m_pekerjaan');
		$this->load->model('m_auth');
		$this->load->model('m_tawaran');
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
                redirect(site_url('/lelang/pasang'));;
            }
        }
	}
	
	public function pasang()
	{
	    if (!$this->session->userdata('data_user')){
            redirect(site_url('/login'));
        } else {
            $data['controller'] = $this;
            // $data['parent'] = $this->m_kategori->getParent();
            $data['parent'] = $this->m_crud->selectBy('lelangags_kategori', array('kategori_parentid'=>0,'kategori_status'=>status_enable));
	        $data['prov'] = $this->m_indonesia->selectProvinsi();
	    
            $data_u = $this->session->userdata('data_user');
            if(!$data_u['user_status']){
                $data['title'] = "Verifikasi";
                $this->load->view('includes/v_header', $data);
                $this->load->view('v_verifikasi');
                $this->load->view('includes/v_footer');
            } else {
                $data['title'] = "Pasang Garapan";
                $data['pembayaran'] = unserialize(PEMBAYARAN);
                $this->load->view('includes/v_header', $data);
                $this->load->view('v_tambah_lelang', $data);
                $this->load->view('includes/v_footer');
            }
        }
	}
	
	function batal($lid){
	    $data['lelang_status'] = status_delete;
	    $pilih = $this->m_crud->update('lelangags_lelang', array('lelang_id'=>$lid), $data);
        if($pilih==berhasil_update){
            redirect(site_url('/profil/lelang'));
        } else {
            echo 'error';
        }    
	}
	
	function selesai($lid){
	    $data['lelang_status'] = status_finish;
	    $pilih = $this->m_crud->update('lelangags_lelang', array('lelang_id'=>$lid), $data);
        if($pilih==berhasil_update){
            redirect(site_url('/profil/lelang'));
        } else {
            echo 'error';
        }    
	}
	
	public function proses(){
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
                $data['title'] = "Proses Lelang";
                $data_u = $this->session->userdata('data_user');
                
                // Lelang
                $datal['lelang_deskripsi'] = $this->input->post('deskripsi');
                $jam = $this->input->post('jamselesai');
                $tgl = $this->input->post('tglselesai');
                $datal['lelang_tglselesai'] = date('Y-m-d H:i', strtotime("$tgl $jam"));
                $datal['lelang_judul'] = str_replace("'","",$this->input->post('judul'));
                $datal['lelang_userid'] = $data_u['user_id'];
                $datal['lelang_status'] = 3;
                $datal["lelang_anggaran"] = preg_replace('/\D/', '', $this->input->post('total'));
                $datal['lelang_pembayaran'] = $this->input->post('pembayaran');
                $datal['lelang_kota'] = $this->input->post('kota');
                $datal['lelang_alamat'] = $this->input->post('alamat');
                $datal['lelang_deskripsi'] = str_replace("'","",$this->input->post('deskripsi'));
                $datal['lelang_fileurl'] = $this->input->post('filelelang');
                $datal['lelang_cid'] = $data_u['user_id'];
                
                // FILE
                $new_name = time();
                $config['file_name'] = $new_name;
                $filename= $_FILES["file"]["name"];
                // $filename = null;
                $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
                $config['upload_path']          = './assets/lelangfile';
        		$config['allowed_types']        = 'jpg|png|jpeg|pdf|doc|docs';
        		$config['max_size']             = 2048;
        // 		$config['max_width']            = 1000;
        // 		$config['max_height']           = 1000;
        // 		$config['min_width']            = 100;
        // 		$config['min_height']           = 100;
                $file = $new_name.'.'.$file_ext;
        		$this->load->library('upload', $config);
                $this->upload->do_upload('file');
                // $this->upload->data();
                $datal['lelang_fileurl'] = $file;
                // $lelangid = $this->m_lelang->insertlelang($datal);
                
                $lelangid = $this->m_crud->saveID('lelangags_lelang', $datal);
                
                // Pekerjaan
                $data_p = json_decode($this->input->post('pekerjaan'));
                $datap = array();
                
                foreach($data_p as $val){
                    array_push($datap, array("pekerjaan_lelangid"=>$lelangid,"pekerjaan_kategoriid"=>$val->produkid ,"pekerjaan_jumlah"=>$val->jumlah ,"pekerjaan_ukuran"=>str_replace("'","",$val->ukuran), "pekerjaan_bahan"=>str_replace("'","",$val->bahan), "pekerjaan_harga"=>$val->harga, "pekerjaan_catatan"=>str_replace("'","",$val->catatan), "pekerjaan_jmlsisi"=>$val->sisi, "pekerjaan_laminasi"=>$val->laminasi, "pekerjaan_cid"=>$data_u['user_id'] ));
                }
                
                // Transaksi
                // $pekerjaan = $this->m_pekerjaan->insertPekerjaanBatch($datap);
                
                $pekerjaan = $this->m_crud->saveBatch('lelangags_pekerjaan', $datap);
                if($pekerjaan == berhasil_insert){
                    redirect(site_url('/profil/lelang'));
                }
                
                // var_dump($this->input->post('tglselesaii'));
            }
        }
	}
    
    
    // Tampilkan Lelang
    public function tampil($id=null){
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
                $data['judul'] = "<label style='font-size:25px'>Semua Garapan</label>";
                if($id===null ){
                    redirect(site_url('/lelang/tampil/all'));
                } else {
                    $id = (int) $id;
                    $data['controller'] = $this;
                    $data['title'] = "Lihat Lelang";
                    // $data['parent'] = $this->m_kategori->getParent();
                    $data['parent'] = $this->m_crud->selectBy('lelangags_kategori', array('kategori_parentid'=>0,'kategori_status'=>3));
                    $data['pembayaran'] = unserialize(PEMBAYARAN);
                    if($id>0){
                    $namak = $this->m_crud->selectBy('lelangags_kategori', array('kategori_id'=>$id));
                    $data['judul'] = "<label style='font-size:25px'>".$namak[0]->kategori_nama."</label>";
                    }
                    
                    $this->load->view('includes/v_header', $data);
                    
                    $per_page = 8;
            		$from = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                    $totalData = $this->m_lelang->getTotalByProduk($id, $data_u['user_id']);
                    $data['lelang'] = $this->m_lelang->selectByProduk($id, $per_page, $from, array('lelang_userid !='=>$data_u['user_id']));
                    
                    // Paging
                    $config['base_url'] = base_url().'lelang/tampil/'.$id;
            		$config['total_rows'] = $totalData;
            		$config['per_page'] = $per_page;
            		$config["uri_segment"] = 4; 
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
                    
                    $this->load->view('v_lihat_lelang', $data);
                    $this->load->view('includes/v_footer');
                }
            }
        }
    }
    
    // Pilih Mitra
    public function pilih($lid, $mid){
        $datal['lelang_mitraid'] = $mid;
        $datal['lelang_status'] = status_pengerjaan;
        
        // $pilih = $this->m_lelang->updatelelang($lid, $datal);
        
        $pilih = $this->m_crud->update('lelangags_lelang', array('lelang_id'=>$lid), $datal);
        if($pilih==berhasil_update){
            redirect(site_url('/profil/lelang'));
        } else {
            echo 'error';
        }
    }
    	
    public function getSub($id){
        // $sub = $this->m_kategori->getSubParentKategori();
        $sub = $this->m_crud->selectBy('lelangags_kategori', array('kategori_parentid' => $id, 'kategori_subparentid' =>0, 'kategori_status!='=>1));
        return $sub;
    }
    public function getProduk($id){
        // $produk = $this->m_kategori->getKategori($id);
        $produk = $this->m_crud->selectBy('lelangags_kategori',array('kategori_subparentid' => $id,'kategori_parentid!='=>0,'kategori_status!='=>1));
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
    
    // public function cekTawaranPek($where){
    //     $tawaran =  $this->m_tawaran->selectTawPekBy($where);
    //     $produk = array();
    //     foreach($tawaran as $val){
    //         array_push($produk, array("pid"=>$val->twpekerjaan_pekerjaanid, "hargap"=>$val->twpekerjaan_anggaran));
    //     }
    //     return $produk;
    // }
    
    // public function cekTawaran($where){
    //     $tawaran =  $this->m_tawaran->selectTawaranBy($where);
    //     $result = ($tawaran)?$tawaran[0]:null;
    //     return $result;
    // }
    
    public function selectSpec(){
        $id = $this->input->post('pid');
        
        // $spec = $this->m_kategori->selectSpecBarangBy(array('specbarang_kategoriid'=>$id));
        $spec = $this->m_crud->selectBy('lelangags_specbarang', array('specbarang_kategoriid'=>$id, 'specbarang_status'=>3));
        
        $ukuran = array();
        $bahan = array();
        $sisi = array();
        $laminasi = array();
        $satuan = ($spec)?$spec[0]->specbarang_satuan:null;
        
        $baru = array();
        $checkU = false;
        $checkB = false;
        $checkUC = false;
        $checkBC = false;
        
        foreach($spec as $val){
            if(strtolower($val->specbarang_ukuran) != "custom" && strtolower($val->specbarang_ukuran) != "n/a" ){
                in_array($val->specbarang_ukuran, $ukuran, TRUE)==0?array_push($ukuran, $val->specbarang_ukuran):'';
            } else if(strtolower($val->specbarang_ukuran) == "n/a" ){
                $checkU = true;
            } else if(strtolower($val->specbarang_ukuran) == "custom" ){
                $checkUC = true;
            }
            
            if(strtolower($val->specbarang_bahan) != "custom" && strtolower($val->specbarang_bahan) != "n/a"){
                in_array($val->specbarang_bahan, $bahan, TRUE)==0?array_push($bahan, $val->specbarang_bahan):'';
            } else if(strtolower($val->specbarang_bahan) == "n/a" ){
                $checkB = true;
            } else if(strtolower($val->specbarang_bahan) == "custom" ){
                $checkBC = true;
            }
            
            if(strtolower($val->specbarang_jmlsisi) != "n/a"){
                in_array($val->specbarang_jmlsisi, $sisi, TRUE)==0?array_push($sisi, $val->specbarang_jmlsisi):'';
            }
            if(strtolower($val->specbarang_laminasi) != "n/a"){
                in_array($val->specbarang_laminasi, $laminasi, TRUE)==0?array_push($laminasi, $val->specbarang_laminasi):'';
            }
        }
        sort($ukuran); sort($bahan); sort($sisi); sort($laminasi);
        array_push($baru, (object)array("ukuran"=>$ukuran, "bahan"=>$bahan, "sisi"=>$sisi, "laminasi"=>$laminasi, "satuan"=>$satuan, "checkU"=>$checkU, "checkB"=>$checkB, "checkUC"=>$checkUC, "checkBC"=>$checkBC));
        
        echo json_encode($baru);
    }  
    
    public function hargaProduk(){
        $id = $this->input->post('pid');
        $ukuran = $this->input->post('ukuran');
        $bahan = $this->input->post('bahan');
        $sisi = $this->input->post('sisi');
        $laminasi = $this->input->post('laminasi');
        
        // $spec = $this->m_kategori->selectSpecBarangBy(array('specbarang_kategoriid'=>$id, 'specbarang_ukuran'=>$ukuran, 'specbarang_bahan'=>$bahan, 'specbarang_jmlsisi'=>$sisi, 'specbarang_laminasi'=>$laminasi));
        $spec = $this->m_crud->selectBy('lelangags_specbarang', array('specbarang_kategoriid'=>$id, 'specbarang_ukuran'=>$ukuran, 'specbarang_bahan'=>$bahan, 'specbarang_jmlsisi'=>$sisi, 'specbarang_laminasi'=>$laminasi, 'specbarang_status'=>3));
        $baru = array();
        foreach($spec as $val){
            array_push($baru, array("harga"=>$val->specbarang_hargasatuan, "satuan"=>$val->specbarang_satuan));
        }
        echo json_encode($baru);
    }    
    
    
}