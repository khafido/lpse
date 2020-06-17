<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kategori extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_kategori');
    }
    
    public function kategori_getDataKategori()
    {
        $secret_key=$this->input->post('secret_key');
        $subparentid=$this->input->post('id');
        if($secret_key==secret_key){
            $data=$this->m_kategori->getKategori($subparentid);
            if(count($data)>0){
                $this->response($data,false,data_ditemukan);
            }else{
                $this->response(null,true,data_tidak_ditemukan);
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }

    public function kategori_getDataSubParentKategori()
    {
        $secret_key=$this->input->post('secret_key');
        $parentid=$this->input->post('id');
        if($secret_key==secret_key){
            $data=$this->m_kategori->getSubParentKategori($parentid);
            if(count($data)>0){
                $this->response($data,false,data_ditemukan);
            }else{
                $this->response(null,true,data_tidak_ditemukan);
            }
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