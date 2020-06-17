<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_indonesia extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_indonesia');
    }

    public function getProvinsi()
    {
        $secret_key=$this->input->post('secret_key');
        if($secret_key==secret_key){
            $res_data = $this->m_indonesia->selectProvinsi();
            if(count($res_data)>0){
                $this->response($res_data,false,"Item ditemukan");
            }else{
                $this->response(null,true,"item tidak ditemukan");
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function getAllProvKota()
    {
        $secret_key=$this->input->post('secret_key');
        if($secret_key==secret_key){
            $res_data['provinsis'] = $this->m_indonesia->selectProvinsi();
            $res_data['kotas'] = $this->m_indonesia->selectAllKabupaten();
            if(count($res_data)>0){
                $this->response($res_data,false,"Item ditemukan");
            }else{
                $this->response(null,true,"item tidak ditemukan");
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }

    public function getKabupaten()
    {
        $secret_key=$this->input->post('secret_key');
        $provinsi_id=$this->input->post('provinsi_id');
        if($secret_key==secret_key){
            $res_data = $this->m_indonesia->selectKabupaten($provinsi_id);
            if(count($res_data)>0){
                $this->response($res_data,false,"Item ditemukan");
            }else{
                $this->response(null,true,"item tidak ditemukan");
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function getKabupatenProvinsi()
    {
        $secret_key=$this->input->post('secret_key');
        $kabupaten_id=$this->input->post('kabupaten_id');
        if($secret_key==secret_key){
            $kab = $this->m_indonesia->selectsingleKabupaten($kabupaten_id);
            if(count($kab)>0){
                $prov = $this->m_indonesia->selectsingleProvinsi($kab[0]->provinsi_id);
                if(count($prov)>0){
                    $res_data=array(
                        'kota' => $kab[0]->nama,
                        'provinsi' => $prov[0]->nama
                    );
                    $this->response($res_data,false,"Item ditemukan");
                }
                $this->response(null,true,"item tidak ditemukan");
            }
            $this->response(null,true,"item tidak ditemukan");
        }else{
            $this->response(null,true,secret_key_salah);
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