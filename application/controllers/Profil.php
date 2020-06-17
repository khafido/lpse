<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session','pagination'));
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_crud','m_kategori','m_indonesia','m_user', 'm_auth','m_lelang','m_pekerjaan','m_tawaran'));
	}

	public function index(){
	    if (!$this->session->userdata('data_user')){
            redirect(site_url('/login'));
        } else {
            $data_u = $this->session->userdata('data_user');
            if($data_u['user_status']==status_enable){
                // $pname = $data_u['user_nama'];
                $id = $data_u['user_id'];
    		    $data['title'] = "Dashboard";
    		    $data['pname'] = $data_u['user_nama'];
    		    $data['pcdate'] = $data_u['user_cdate'];
    		    $data['pages'] = "dashboard";
                $data['view'] = 'v_dashboard';
                $data['pemilihan'] = $this->m_crud->getNumRows('lelangags_lelang', array('lelang_userid'=>$id,'lelang_status'=>status_enable));
                $data['pengerjaan'] = $this->m_crud->getNumRows('lelangags_lelang', array('lelang_userid'=>$id,'lelang_status'=>status_pengerjaan));
                $data['selesai'] = $this->m_crud->getNumRows('lelangags_lelang', array('lelang_userid'=>$id,'lelang_status'=>status_finish));
                // $data['pemilihan'] = $this->m_crud->getNumRows('lelangags_lelang', array('lelang_userid'=>$id,'lelang_status'=>status_enable));
                $akun = $this->m_user->selectUserby($id);
                $data['gambar'] = $akun->user_imgurl;
    			$this->load->view('includes/v_header', $data);
    			$this->load->view('profil/v_menup', $data);
    			$this->load->view('includes/v_footer');
            } else {
                redirect(site_url('/'));
            }
        }
	}

    public function akun(){
        // var_dump($this->session->userdata('data_user'));
        // var_dump($this->session->unset_userdata(['data_user']['user_nama']));
        // var_dump($this->session->set_userdata(['data_user']['user_nama'],"nananan"));
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
                if($data_u['user_status']==status_enable){
                    $id = $data_u['user_id'];
                    $id_kota = $data_u['user_kotaid'];
                    $akun = $this->m_user->selectUserby($id);
                    $data['gambar'] = $akun->user_imgurl;
                    $data['pname'] = $akun->user_nama;
                    $data['pcdate'] = $data_u['user_cdate'];
                    $prov = $this->m_user->getprovid($akun->user_kotaid);
                    $data['provid'] = ($prov)?$prov->provinsi_id:0;
                    $data['kotaid'] = ($akun)?$akun->user_kotaid:null;
                    $data['prov'] = $this->m_indonesia->selectProvinsi();
                    $data['title'] = "Akun";
                    $data['pages'] = "akun";
                    $data['view'] = 'v_akun';
                    $data['datacontent'] = $akun;
                    $this->session->unset_userdata('nama');
                    $this->session->set_userdata('nama', $akun->user_nama);
                    $this->load->view('includes/v_header', $data);
        	        $this->load->view('profil/v_menup',$data);
                    $this->load->view('includes/v_footer');
                } else {
                    redirect(site_url('/'));
                }
            }
        }
    }
    
    public function akunupdate(){
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
                if(!$data_u['user_status']){
                    $data['title'] = "Verifikasi";
                    $this->load->view('includes/v_header', $data);
                    $this->load->view('v_verifikasi');
                    $this->load->view('includes/v_footer');
                } else {
                    // $data_u = $this->session->userdata('data_user');
                    $id = $data_u['user_id'];
                    $nama = $this->input->post('name');
                    $data['user_uid'] = $data_u['user_id'];
                    $data['user_nama'] = $nama;
                    $data['user_telpon'] = $this->input->post('telp');
                    $data['user_kotaid'] = $this->input->post('kota');
                    $data['user_alamat'] = $this->input->post('alamat');
                    // $arry = array("user_nama" => $nama);
                    $this->session->unset_userdata($data_u['user_nama']);
                    $this->session->set_userdata($data_u['user_nama'], $nama);
                    
                    // gambar
                    $new_name = time();
                    $filename= $_FILES["file"]["name"];
                    $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
                    $config['upload_path']          = './assets/images/foto';
            		$config['allowed_types']        = 'jpg|png|jpeg';
            		$config['max_size']             = 2048;
                    $config['file_name']            = time();
            // 		$config['max_width']            = 1000;
            // 		$config['max_height']           = 1000;
            // 		$config['min_width']            = 100;
            // 		$config['min_height']           = 100;
            		$this->load->library('upload', $config);
                    if($this->upload->do_upload('file')){
                        $data['user_imgurl'] = $new_name.'.'.$file_ext;
                        // $update = $this->m_auth->updateUserbyid($id,$data);
                    } 
                    // else {
                        
                    // }
                    $update = $this->m_auth->updateUserbyid($id,$data);
                    // $this->upload->data();
                    
                    if ($update == true){
                        redirect(site_url('profil/akun'));
                    }
                }
                
            }
        }
	}

    public function lelang(){
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
                $data['pname'] = $data_u['user_nama'];
                $data['pcdate'] = $data_u['user_cdate'];
                $data['parent'] = $this->m_crud->selectBy('lelangags_kategori', array('kategori_parentid'=>0,'kategori_status'=>status_enable));
        	    $data['prov'] = $this->m_indonesia->selectProvinsi();
        	    
                if($data_u['user_status']==status_enable){
                    $data['controller'] = $this;
                    $data['title'] = "Lelang";
                    $data['pages'] = "lelang_saya";
                    $data['view'] = 'v_lelangku';
                    $id = $data_u['user_id'];
                    $akun = $this->m_user->selectUserby($id);
                    $data['gambar'] = $akun->user_imgurl;
                    $data['pembayaran'] = unserialize(PEMBAYARAN);
                    $this->load->view('includes/v_header', $data);
                    
                    $per_page = 10000;
            		$from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                    $totalData = $this->m_lelang->hitungLelangBy($per_page, $from, $data_u['user_id']);
                    $data['lelang'] = $this->m_lelang->selectLelangBy($per_page, $from, array('lelang_userid'=>$data_u['user_id'], 'lelang_status'=>status_enable));
                    $data['pengerjaan'] = $this->m_lelang->selectLelangBy($per_page, $from, array('lelang_userid'=>$data_u['user_id'], 'lelang_status'=>status_pengerjaan));
                    $data['penyerahan'] = $this->m_lelang->selectLelangBy($per_page, $from, array('lelang_userid'=>$data_u['user_id'], 'lelang_status'=>status_finish));
                    
                    // Paging
                    $config['base_url'] = base_url().'lelang/tampil/';
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
                    
        	        $this->load->view('profil/v_menup',$data);
                    $this->load->view('includes/v_footer');
                } else {
                    redirect(site_url('/'));
                }
            }
        }        
    }

    public function tawaran(){
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
                $data['controller'] = $this;
                $data['pembayaran'] = unserialize(PEMBAYARAN);
                $data_u = $this->session->userdata('data_user');
                $data['pname'] = $data_u['user_nama'];
                $data['pcdate'] = $data_u['user_cdate'];
                $per_page = 10000;
            	$from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data['lelang'] = $this->m_tawaran->selectTawaranBy(array('user_id'=>$data_u['user_id'], 'lelang_status'=>status_enable));
                $data['pengerjaan'] = $this->m_tawaran->selectTawaranBy(array('user_id'=>$data_u['user_id'], 'lelang_status'=>status_pengerjaan));
                $data['penyerahan'] = $this->m_tawaran->selectTawaranBy(array('user_id'=>$data_u['user_id'], 'lelang_status'=>status_finish));
                // $data['parent'] = $this->m_kategori->getParent();
        	   // $data['prov'] = $this->m_indonesia->selectProvinsi();
        	    
                if($data_u['user_status']==status_enable){
                    $data['title'] = "Tawaran";
                    $data['pages'] = "tawaran_saya";
                    $data['view'] = 'v_tawaranku';
                    $id = $data_u['user_id'];
                    $akun = $this->m_user->selectUserby($id);
                    $data['gambar'] = $akun->user_imgurl;
                    $this->load->view('includes/v_header', $data);
        	        $this->load->view('profil/v_menup',$data);
                    $this->load->view('includes/v_footer');
                } else {
                    redirect(site_url('/'));
                }
            }
        }        
    }
    
    
    
    public function password(){
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
                if($data_u['user_status']==status_enable){
                $data['pcdate'] = $data_u['user_cdate'];
                $data['pname'] = $data_u['user_nama'];
                
                $this->form_validation->set_rules('oldpass', 'old password', 'callback_passwordcheck');
                $this->form_validation->set_rules('pass','Password','max_length[40]');
                $this->form_validation->set_rules('conf','Konfirmasi Password','matches[pass]');
                
                $this->form_validation->set_message('matches','Konfirmasi Password tidak sama!');
                $this->form_validation->set_message('max_length','Maksimal %i karakter!');
                $this->form_validation->set_message('passwordcheck', 'Password lama salah');
                
                if($this->form_validation->run() == FALSE) {
                    // redirect(site_url('profil/password'));
                    $data['pcdate'] = $data_u['user_cdate'];
                    $data['pname'] = $data_u['user_nama'];
                    $data['title'] = "Ganti Password";
                    $data['pages'] = "password";
                    $data['view'] = 'v_password';
                    $id = $data_u['user_id'];
                    $akun = $this->m_user->selectUserby($id);
                    $data['gambar'] = $akun->user_imgurl;
                    $this->load->view('includes/v_header', $data);
        	        $this->load->view('profil/v_menup',$data);
                    $this->load->view('includes/v_footer');
                } else {
                    $user = $this->session->userdata('data_user');
                    $id = $user['user_id'];
                    $new_pass['user_pass'] = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);
                    $new_pass['user_uid'] = $id;
                    $this->m_auth->updateUserbyid($id, $new_pass);
                } 
                }
            }
        }
        
    }
    
     public function passwordcheck($oldpass) {
        $id = $this->session->userdata('data_user');
        
        $user = $this->m_user->selectUserby($id['user_id']);
        $hashpassword = $user->user_pass;
        
	    if(password_verify($oldpass,$hashpassword)){
		    return true;
		}else{
			return false;
		}
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
            array_push($produk, array("lid"=> $val->lelang_id, "uid" =>$val->user_id, "pid"=>$val->twpekerjaan_pekerjaanid, "hargap"=>$val->twpekerjaan_anggaran, "total"=>$val->tawaran_anggaran, "unama"=>$val->user_nama, "foto"=>$val->user_imgurl, 'tawaran_status'=>status_enable));
        }
        return $produk;
    }
    
    public function getJumlahTawaran($id){
        $jumlah = $this->m_crud->getNumRows('Lihat_Tawaran', array('lelang_id'=>$id, 'tawaran_status'=>status_enable));
        return $jumlah;
    }
    
    public function cekTawaran($where){
        $tawaran =  $this->m_tawaran->selectTawaranBy($where);
        $result = ($tawaran)?$tawaran[0]:null;
        return $result;
    }    
    
    public function getUserDetail($id){
        $user = $this->m_auth->getUserByID($id);
        return $user;
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
    
    public function specBarang(){
        $$this->m_kaegori->selectSpecBarang();
        $spec = array();
        foreach($dataP as $val){
            array_push($produk, array("idp"=>$val->pekerjaan_id, "idl"=>$val->pekerjaan_lelangid, "nama"=>$val->kategori_nama, "ukuran"=>$val->pekerjaan_ukuran, "bahan"=>$val->pekerjaan_bahan, "catatan"=>$val->pekerjaan_catatan, "jumlah"=>$val->pekerjaan_jumlah, "idk"=>$val->pekerjaan_kategoriid, "harga"=>$val->pekerjaan_harga));
        }
        return $spec;
    }
}
