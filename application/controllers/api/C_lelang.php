<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_lelang extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_lelang');
        $this->load->model('m_pekerjaan');
        $this->load->model('m_indonesia');
        $this->load->model('m_kategori');
        $this->load->model('m_tawaran');
        $this->load->model('m_crud');
    }
    
    public function lelang_buat(){
        $req_data=json_decode($this->input->raw_input_stream);
        $lelang_data=$req_data->lelang;
        $pekerjaan_data=$req_data->pekerjaan;
        $secret_key=$req_data->secret_key;
        if($secret_key==secret_key){
            $lelang_data->lelang_status=3;
            $lelang_data->lelang_cid=$lelang_data->lelang_userid;
            $insert_id=$this->m_crud->saveID("lelangags_lelang", $lelang_data);
            if(isset($insert_id)){
                $pekerjaan_req=array();
                foreach($pekerjaan_data as $pekerjaan){
                    $pekerjaan->pekerjaan_lelangid=$insert_id;
                    $pekerjaan->pekerjaan_status=3;
                    $pekerjaan->pekerjaan_cid=$lelang_data->lelang_userid;
                    $pekerjaan_req[]=$pekerjaan;
                }
                $result=$this->m_crud->saveBatch("lelangags_pekerjaan",$pekerjaan_req);
                if($result==berhasil_insert){
                    $this->response(null,false,$result);
                }else{
                    $this->response(null,true,$result);    
                }
            }else{
                $this->response(null,true,gagal_buat_lelang);    
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    //delete
    // public function lelang_edit(){
    //     $req_data=json_decode($this->input->raw_input_stream);
    //     $lelang_data=$req_data->lelang;
    //     $pekerjaan_data=$req_data->pekerjaan;
    //     $secret_key=$req_data->secret_key;
    //     if($secret_key==secret_key){
    //         $lelang_data->lelang_uid=$lelang_data->lelang_userid;
    //         $pekerjaan_edit=array();
    //         $pekerjaan_baru=array();
    //         foreach($pekerjaan_data as $pekerjaan){
    //             if ($pekerjaan->pekerjaan_status==0){
    //                 $pekerjaan->pekerjaan_cid=$lelang_data->lelang_userid;
    //                 $pekerjaan->pekerjaan_lelangid=$lelang_data->lelang_id;
    //                 $pekerjaan_baru[]=$pekerjaan;
    //             }else{
    //                 $pekerjaan->pekerjaan_uid=$lelang_data->lelang_userid;
    //                 $pekerjaan_edit[]=$pekerjaan;
    //             }
    //         }
    //         $this->m_pekerjaan->insertPekerjaanBatch($pekerjaan_baru);
    //         $result_l=$this->m_lelang->updatelelang($lelang_data->lelang_id,$lelang_data);
    //         $result_p=$this->m_pekerjaan->updatebatchPekerjaan($pekerjaan_edit);
    //         if($result_l==berhasil_edit_lelang||$result_p==berhasil_edit_lelang){
    //             $this->response(null,false,berhasil_edit_lelang);
    //         }else{
    //             $this->response(null,true,gagal_edit_lelang);    
    //         }
    //     }else{
    //         $this->response(null,true,secret_key_salah);
    //     }
    // }

    public function lelang_setExpired()
    {
        $secret_key=$this->input->post('secret_key');
        if($secret_key==secret_key){
            $lelang_data_=(array)$this->m_lelang->selectAlllelang();
            if(count($lelang_data_)>0){
                $lelang_data=array();
                $count=0;
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
                            $count++;
                            $this->m_crud->update('lelangags_lelang', array('lelang_id'=>$data->lelang_id), $lelang);
                            $this->m_crud->update('lelangags_pekerjaan', array('pekerjaan_lelangid'=>$data->lelang_id), $pekerjaan);
                        }
                    }
                }
                $this->response(null,false,"set ".$count." data expired"); 
            }else{
                $this->response(null,true,"Data tidak ditemukan");
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function lelang_delete()
    {
        $secret_key=$this->input->post('secret_key');
        $lelang_id=$this->input->post('lelang_id');
        $datalelang['lelang_status']=1;
        $datalelang['lelang_uid']=$this->input->post('user_id');
        $datapekerjaan['pekerjaan_uid']=$this->input->post('user_id');
        $datapekerjaan['pekerjaan_status']=1;
        if($secret_key==secret_key){
            $result=$this->m_crud->update('lelangags_lelang','lelang_id='.$lelang_id,$datalelang);
            $result2=$this->m_crud->update('lelangags_pekerjaan','pekerjaan_lelangid='.$lelang_id,$datapekerjaan);
            if($result==berhasil_update&&$result2==berhasil_update){
                $this->response(null,false,"Berhasil hapus lelang");
            }else{
                $this->response(null,true,"Gagal hapus lelang");
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    public function lelang_selesai()
    {
        $secret_key=$this->input->post('secret_key');
        $lelang_id=$this->input->post('lelang_id');
        $datalelang['lelang_status']=6;
        $datalelang['lelang_uid']=$this->input->post('user_id');
        $datapekerjaan['pekerjaan_uid']=$this->input->post('user_id');
        $datapekerjaan['pekerjaan_status']=6;
        if($secret_key==secret_key){
            $result=$this->m_crud->update('lelangags_lelang','lelang_id='.$lelang_id,$datalelang);
            $result2=$this->m_crud->update('lelangags_pekerjaan','pekerjaan_lelangid='.$lelang_id,$datapekerjaan);
            if($result==berhasil_update&&$result2==berhasil_update){
                $lelang_data=$this->m_crud->selectBy("lelangags_lelang", array('lelang_id'=>$lelang_id));
                $this->m_crud->save('lelangags_notifikasi',array(
                                'notifikasi_userid'=>$lelang_data[0]->lelang_mitraid,
                                'notifikasi_teks'=>'Client telah mengubah status garapan #'.$lelang_id.' menjadi selesai, selamat',
                                'notifikasi_status'=>3
                            ));
                $this->response(null,false,"lelang telah selesai");
            }else{
                $this->response(null,true,"Gagal update lelang");
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function lelang_hire()
    {
        $secret_key=$this->input->post('secret_key');
        $lelang_id=$this->input->post('lelang_id');
        $datalelang['lelang_status']=4;
        $datalelang['lelang_uid']=$this->input->post('user_id');
        $datalelang['lelang_mitraid']=$this->input->post('mitra_id');
        $datapekerjaan['pekerjaan_uid']=$this->input->post('user_id');
        if($secret_key==secret_key){
            $result=$this->m_crud->update('lelangags_lelang','lelang_id='.$lelang_id,$datalelang);
            $result2=$this->m_crud->update('lelangags_pekerjaan','pekerjaan_lelangid='.$lelang_id,$datapekerjaan);
            if($result==berhasil_update&&$result2==berhasil_update){
                $this->m_crud->save('lelangags_notifikasi',array(
                                'notifikasi_userid'=>$datalelang['lelang_mitraid'],
                                'notifikasi_teks'=>'Anda telah ditunjuk sebagai Mitra pada garapan #'.$lelang_id,
                                'notifikasi_status'=>3
                            ));
                $this->response(null,false,"Berhasil hire mitra");
            }else{
                $this->response(null,true,"Gagal hire mitra");
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