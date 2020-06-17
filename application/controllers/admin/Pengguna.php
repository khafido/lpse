<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_crud','m_kategori','m_indonesia','m_user', 'm_auth','m_lelang','m_pekerjaan','m_tawaran'));
	}

	public function index()	{
        $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");
	    $data["users"] = $this->m_crud->selectBy('lelangags_user', array('user_status'=>status_enable));
        $this->load->view("admin/v_users", $data);
        //$this->load->view("admin/includes/footer");
	}
	
	public function form($action, $id){
	    
        $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");  
	    if($action=='add'){
            $akun = null;
            $prov = null;
            $data['users'] = null;
	    } else {
            $akun = $this->m_crud->selectBy('lelangags_user', array('user_id'=> $id))[0];
            $prov = $this->m_user->getprovid($akun->user_kotaid);
            $data["users"] = $akun;
            if (!$data["users"]) show_404();
        }
        $data['provid'] = ($prov)?$prov->provinsi_id:0;
        $data['kotaid'] = ($akun)?$akun->user_kotaid:0;
        $data['prov'] = $this->m_indonesia->selectProvinsi();
        $this->load->view("admin/v_user_form", $data);
	}
	
// 	public function add()
//     {
//         $this->load->view("admin/includes/header");
//         $this->load->view("admin/includes/js");  
//         $data['user_nama'] = $this->input->post('name');
//         $data['user_telpon'] = $this->input->post('telp');
//         $data['user_kotaid'] = $this->input->post('kota');
//         $data['user_alamat'] = $this->input->post('alamat');
        
//         // gambar
//         $new_name = time();
//         $filename= $_FILES["file"]["name"];
//         $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
//         $config['upload_path']          = './assets/images/foto';
// 		$config['allowed_types']        = 'jpg|png|jpeg';
// 		$config['max_size']             = 2048;
//         $config['file_name']            = time();
// 		$this->load->library('upload', $config);
        
//         if($this->upload->do_upload('file')){
//             $data['user_imgurl'] = $new_name.'.'.$file_ext;
//             $update = $this->m_auth->updateUserbyid($id,$data);
//         } else {
//             $update = $this->m_auth->updateUserbyid($id,$data);
//         }
        
//         if ($update == true){
//              redirect(site_url('admin/users'));
//         }
//     }

    public function ubah($id = null) {
        $id = $this->input->post('user_id');
        if ($id === null) {
            redirect(site_url('/admin/pengguna')); 
        } else {
            $this->load->view("admin/includes/header");
            $this->load->view("admin/includes/js"); 
            
            $id = $this->input->post('user_id');
            $data['user_uid'] = $id;
            $data['user_nama'] = $this->input->post('name');
            $data['user_telpon'] = $this->input->post('telp');
            $data['user_kotaid'] = $this->input->post('kota');
            $data['user_alamat'] = $this->input->post('alamat');
            
            // gambar
            $new_name = time();
            $filename= $_FILES["file"]["name"];
            $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
            $config['upload_path']          = './assets/images/foto';
    		$config['allowed_types']        = 'jpg|png|jpeg';
    		$config['max_size']             = 2048;
            $config['file_name']            = time();
    		$this->load->library('upload', $config);
            
            if($this->upload->do_upload('file')){
                $data['user_imgurl'] = $new_name.'.'.$file_ext;
                $update = $this->m_auth->updateUserbyid($id,$data);
            } else {
                $update = $this->m_auth->updateUserbyid($id,$data);
            }
            
            if ($update == true){
                 redirect(site_url('admin/pengguna'));
            }
            // $this->load->view("admin/includes/header");
            // $status= true;
            // $this->load->view("admin/includes/js");  
            // $akun = $this->m_crud->selectBy('lelangags_user', array('user_id'=> $id))[0];
            // $prov = $this->m_user->getprovid($akun->user_kotaid);
            // $data['provid'] = ($prov)?$prov->provinsi_id:0;
            // $data['kotaid'] = ($akun)?$akun->user_kotaid:0;
            // $data['prov'] = $this->m_indonesia->selectProvinsi();
            // $data["users"] = $akun;
            // if (!$data["users"]) show_404();
            // $this->load->view("admin/v_user_form", $data);
        }
    }
    
    public function update($id = null) {
        // if ($id === null) redirect(site_url('/admin/users')); 
                
        $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js"); 
        
        $id = $this->input->post('user_id');
        $data['user_uid'] = $id;
        $data['user_nama'] = $this->input->post('name');
        $data['user_telpon'] = $this->input->post('telp');
        $data['user_kotaid'] = $this->input->post('kota');
        $data['user_alamat'] = $this->input->post('alamat');
        
        // gambar
        $new_name = time();
        $filename= $_FILES["file"]["name"];
        $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
        $config['upload_path']          = './assets/images/foto';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 2048;
        $config['file_name']            = time();
		$this->load->library('upload', $config);
        
        if($this->upload->do_upload('file')){
            $data['user_imgurl'] = $new_name.'.'.$file_ext;
            $update = $this->m_auth->updateUserbyid($id,$data);
        } else {
            $update = $this->m_auth->updateUserbyid($id,$data);
        }
        
        if ($update == true){
             redirect(site_url('admin/users'));
        }
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        $data['user_status'] = 1; 
        // $this->m_auth->updateUserbyid($id,$data);
        if ($this->m_auth->updateUserbyid($id,$data)) {
            redirect(site_url('admin/users'));
        }
    }
    
        public function getKabProv($idKab){
        $kabprov = $this->m_indonesia->selectKabProv($idKab);
        return $kabprov[0];
    }
}
