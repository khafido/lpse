<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pesan extends CI_Controller {

	function __construct() {
        parent::__construct();
        //$this->load->model('m_pesan');
        $this->load->model('m_crud');
    }
    
    public function pesan_buat()
    {
        $secret_key=$this->input->post('secret_key');
        $data['pesan_userid']=$this->input->post('user_id');
        $data['pesan_cid']=$this->input->post('user_id');
        $data['pesan_isi']=$this->input->post('isi');
        $data['pesan_roomid']=$this->input->post('room_id');
        $data['pesan_status']=3;
        if($secret_key==secret_key){
            $result=$this->m_crud->save('lelangags_pesan', $data);
            if($result){
                $this->response(null,false,"Pesan berhasil dibuat");
            }
            $this->response(null,true,"Gagal kirim pesan");
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function pesan_getroom()
    {
        $secret_key=$this->input->post('secret_key');
        $user_id=$this->input->post('user_id');
        if($secret_key==secret_key){
            $result=$this->m_crud->selectBy('Cari_Room',"(room_user1='$user_id' OR room_user2='$user_id') AND room_toppesan is not null");
            if(count($result)>0){
                $this->response($result,false,"room ditemukan");
            }
            $this->response(null,true,"tidak ada room");
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function pesan_getSingleRoom()
    {
        $secret_key=$this->input->post('secret_key');
        $user_id1=$this->input->post('user_id1');
        $user_id2=$this->input->post('user_id2');
        if($secret_key==secret_key){
            $result=$this->m_crud->selectBy('Cari_Room',"room_user1 IN ('$user_id1','$user_id2') AND room_user2 IN ('$user_id1','$user_id2')");
            if(count($result)>0){
                $this->response($result[0],false,"room ditemukan");
            }else{
                $data['room_user1']=$this->input->post('user_id1');
                $data['room_user2']=$this->input->post('user_id2');
                $result=$this->m_crud->save('lelangags_room', $data);
                $result=$this->m_crud->selectBy('Cari_Room',"room_user1 IN ('$user_id1','$user_id2') AND room_user2 IN ('$user_id1','$user_id2')");
                $this->response($result[0],false,"room ditemukan");
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function pesan_getpesan()
    {
        $secret_key=$this->input->post('secret_key');
        $room_id=$this->input->post('room_id');
        if($secret_key==secret_key){
            $result=$this->m_crud->selectOrderBy('lelangags_pesan','pesan_roomid='.$room_id,'pesan_cdate','asc');
            if(count($result)){
                $this->response($result,false,"pesan ditemukan");
            }
            $this->response($room_id,true,"pesan tidak ditemukan");
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