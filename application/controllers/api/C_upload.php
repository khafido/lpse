<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_upload extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

    public function do_upload(){
        $secret_key=$this->input->post('secret_key');
		$config['upload_path'] = './assets/lelangfile/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = '5120';
		$config['file_name'] = time()."_".$_FILES['userfile']['name'];

		$this->load->library('upload', $config);
        if($secret_key==secret_key){
    		if (!$this->upload->do_upload('userfile')){
    		    $this->response(null,true,"gagal upload");
    		}else{
                $this->response(base_url()."assets/lelangfile/".$this->upload->data('file_name'),false,"sukses upload");
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