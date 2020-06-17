<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_fetchdata extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_indonesia');
        $this->load->model('m_kategori');
        $this->load->model('m_token');
        $this->load->model('m_lelang');
        $this->load->model('m_pekerjaan');
        $this->load->model('m_user');
        $this->load->model('m_tawaran');
        $this->load->model('m_crud');
    }
	
    public function fetchdata()
    {
        $secret_key=$this->input->post('secret_key');
        $token_provinsi_input=$this->input->post('token_provinsi');
        $token_kabupaten_input=$this->input->post('token_kota');
        $token_kategori_input=$this->input->post('token_kategori');
        $token_lelang_input=$this->input->post('token_lelang');
        $token_pekerjaan_input=$this->input->post('token_pekerjaan');
        $token_user_input=$this->input->post('token_user');
        $token_tawaran_input=$this->input->post('token_tawaran');
        $token_specbarang_input=$this->input->post('token_specbarang');
        if($secret_key==secret_key){
            $this->lelang_setExpired();
            
            $token_provinsi_current=$this->m_token->getTokenDBINDO("provinsi");
            $token_kabupaten_current=$this->m_token->getTokenDBINDO("kabupaten");
            $token_kategori_current=$this->m_token->getTokenDBLelang("lelangags_kategori");
            $token_lelang_current=$this->m_token->getTokenDBLelang("lelangags_lelang");
            $token_pekerjaan_current=$this->m_token->getTokenDBLelang("lelangags_pekerjaan");
            $token_user_current=$this->m_token->getTokenDBLelang("lelangags_user");
            $token_tawaran_current=$this->m_token->getTokenDBLelang("lelangags_tawaran");
            $token_specbarang_current=$this->m_token->getTokenDBLelang("lelangags_specbarang");
            $message="";
            $res_data=array();
            if($token_pekerjaan_input!=$token_pekerjaan_current){
                $res_data['token_pekerjaan'] = $token_pekerjaan_current;
                $res_data['pekerjaans'] = $this->m_pekerjaan->selectAllpekerjaan();
                $message.="5";
            }
            if($token_lelang_input!=$token_lelang_current){
                $res_data['token_lelang'] = $token_lelang_current;
                $res_data['lelangs'] = $this->m_lelang->selectAlllelang();
                $message.="4";
            }
            if($token_kabupaten_input!=$token_kabupaten_current){
                $res_data['token_kota'] = $token_kabupaten_current;
                $res_data['kotas'] = $this->m_indonesia->selectAllKabupaten();
                $message.="3";
            }
            if($token_provinsi_input!=$token_provinsi_current){
                $res_data['token_provinsi'] = $token_provinsi_current;
                $res_data['provinsis'] = $this->m_indonesia->selectProvinsi();
                $message.="2";
            }
            if($token_kategori_current!=$token_kategori_input){
                $res_data['token_kategori'] = $token_kategori_current;
                $res_data['kategoris']=$this->m_kategori->selectKategori();
                $message.="1";
            }
            
            if($token_tawaran_current!=$token_tawaran_input){
                $res_data['token_tawaran'] = $token_tawaran_current;
                $res_data['tawarans']=$this->m_tawaran->selectAllTawaran();
                $res_data['historitawarans']=$this->m_tawaran->selectAllHistoriTawaran();
                $res_data['twpekerjaans']=$this->m_tawaran->selectAllTWPekerjaan();
                $message.="7";
            }
            
            if($token_user_current!=$token_user_input){
                $res_data['token_user'] = $token_user_current;
                $res_data['users']=$this->m_user->selectAllUser();
                $message.="6";
            }
            
            if($token_specbarang_current!=$token_specbarang_input){
                $res_data['token_specbarang'] = $token_specbarang_current;
                $res_data['specbarangs']=$this->m_kategori->selectSpecBarang();
                $message.="8";
            }
            
            if(count($res_data)>0){
                $this->response($res_data,false,$message);
            }else{
                $this->response(null,true,"data up to date");
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function lelang_setExpired()
    {
        $lelang_data_=(array)$this->m_lelang->selectAlllelang();
        if(count($lelang_data_)>0){
            $lelang_data=array();
            date_default_timezone_set("Asia/Jakarta");
            foreach($lelang_data_ as $data){
                $diff=strtotime($data->lelang_tglselesai)-strtotime("now");
                if($diff<=0){
                    $lelang=array(
                        'lelang_status'=>5,
                        'lelang_uid'=>'admin'
                        );
                    $pekerjaan=array(
                        'pekerjaan_status'=>5,
                        'pekerjaan_uid'=>'admin'
                        );
                    if($data->lelang_status!=5 && $data->lelang_status==3){
                        $this->m_crud->update('lelangags_lelang', array('lelang_id'=>$data->lelang_id), $lelang);
                        $this->m_crud->update('lelangags_pekerjaan', array('pekerjaan_lelangid'=>$data->lelang_id), $pekerjaan);
                    }
                }
            }
        }
    }
    
    public function response($data,$error,$message)
    {
        $response = array(
            'error' => $error,
            'message' => $message,
            'data'=> $data);

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
        exit;
    }
}