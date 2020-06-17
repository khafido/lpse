<?php 
class M_auth extends CI_Model
{

	function __construct(){
		parent::__construct();
		$this->load->library('email');
	}

	function createUser($data){
        if(!$this->isEmailExist($data['user_email'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d H:i:s');
			$data['user_lastlogin']=$date;
			$data['user_id'] = date('Y').date('m').date('d').date('H').date('i').date('s').random_string('alnum', 3);
			$data['user_cid'] = $data['user_id'];
			$data['user_status']=status_new_user;
			$verif_data=$this->createVerifCode($data['user_id'],0,$data['user_cid']);

			//db computing
			$this->db->trans_start();
			$this->db->insert('lelangags_user',$data);
			$this->db->insert('lelangags_verifikasi',$verif_data);

            if($this->db->trans_status()===true){
				if($this->sentCodetoMail($data['user_email'],$data['user_id'],$verif_data['verifikasi_code'])){
				    $this->db->trans_commit();
				    $this->db->trans_complete();
					return berhasil_register;
				}
				$this->db->trans_rollback();
				return gagal_kirim_email;
            }
            $this->db->trans_rollback();
            return gagal_tambah_data;
        }
        return email_sudah_dipakai;
	}

	function isEmailExist($email){
		if($this->db->get_where('lelangags_user',array('user_email'=>$email))->result()){
			return true;
		}
		return false;
	}

	function sentCodetoMail($emailto,$id,$code)
	{
		$config=array(
		    'useragent' => 'CodeIgniter',
			'protocol' => 'sendmail',
			'mailpath' => '/usr/sbin/sendmail',
			'smtp_host' => 'ssl://mail.lelang.agsgroup.co.id',
			'smtp_port' => 465,
			'smtp_timout' => 5,
			'smtp_user' => 'ayolelang_service@lelang.agsgroup.co.id',
			'smtp_pass' => '^H30Rw9amnZ4',
			'smtp_crypto' => 'ssl',
			'charset' => 'utf-8',
			'validate' => true,
			'priority' => 2,
			'mailtype' => 'html',
			'crlf' => "\r\n",
			'newline' => "\r\n",
			'wordwrap' => true,
			'bcc_batch_mode' => false,
			'bcc_batch_size' => 200
		);
		$this->email->initialize($config);
		$this->email->set_header('X-MC-ViewContentLink', true);
		$this->email->from('ayolelang_service@lelang.agsgroup.co.id','LelangAGS');
		$this->email->to($emailto);
		$this->email->subject('Konfirmasi Email');
		$this->email->message('<html>link verifikasi <a href="https://lelang.agsgroup.co.id/api/c_auth/auth_verif_mail/'.$id.'/'.$code.'">https://lelang.agsgroup.co.id/api/c_auth/auth_verif_mail/'.$id.'/'.$code.'</a><br>code verifikasi : '.$code.'</html>');
        //$this->email->message('code verifikasi : '.$code);
		if($this->email->send()){
			return true;
		}
		return false;
	}

	function createVerifCode($userid,$type,$cid)
	{
        $code=random_string('numeric',6);
		$data=array(
			'verifikasi_userid' => $userid,
			'verifikasi_tipe' => $type,
			'verifikasi_code' => $code,
			'verifikasi_cid' => $cid
		);
		return $data;
	}

	function verifikasi($data)
	{
		$caridata=$this->db->get_where('lelangags_verifikasi',$data)->result();
		//print_r($caridata);
		if(count($caridata)>0){
			$udata=array(
				'user_status' => status_enable,
				'user_uid' => $caridata[0]->verifikasi_userid
			);
			$updatedata=$this->updateUserbyid($caridata[0]->verifikasi_userid,$udata);
			if($updatedata){
				$hapusdata=$this->deleteVerifCode($caridata[0]->verifikasi_id);
				if($hapusdata){
					return berhasil_verifikasi;
				}
				return gagal_hapus_data;
			}
			return gagal_edit_data;
		}
		return kode_verifikasi_salah;
	}

	function deleteVerifCode($id)
	{
		$this->db->where('verifikasi_id',$id);
		if($this->db->delete('lelangags_verifikasi')){
            return true;
        }
        return false;
	}

	function userLogin($email,$password)
	{
		if($this->isEmailExist($email)){
			$user = $this->db->get_where('lelangags_user',array(
				'user_email' => $email,
            ))->row();
            $hashpassword = $user->user_pass;

			if(password_verify($password,$hashpassword)){
				date_default_timezone_set('Asia/Jakarta');
				$data['user_lastlogin']=date('Y-m-d H:i:s');
				$this->updateUserbyemail($email,$data);
				return berhasil_login;
			}else{
				return password_salah;
			}
		}

		return email_tidak_tersedia;
	}

	function getUserByEmail($email){
		$row = $this->db->get_where('lelangags_user',array('user_email'=>$email))->result();
		return array(
					"user_id" => $row[0]->user_id,
					"user_nama" => $row[0]->user_nama,
					"user_email" => $row[0]->user_email,
					"user_telpon" => $row[0]->user_telpon,
					"user_status" =>$row[0]->user_status == status_enable ? true : false,
					"user_imgurl" => $row[0]->user_imgurl,
					"user_kotaid" => $row[0]->user_kotaid,
					"user_cdate" => $row[0]->user_cdate,
					"user_alamat" => $row[0]->user_alamat
				);
	}

    function getUserByID($id){
		$row = $this->db->get_where('lelangags_user',array('user_id'=>$id))->result();
		return array(
			"user_id" => $row[0]->user_id,
			"user_nama" => $row[0]->user_nama,
			"user_email" => $row[0]->user_email,
			"user_telpon" => $row[0]->user_telpon,
			"user_status" =>$row[0]->user_status == status_enable ? true : false,
			"user_imgurl" => $row[0]->user_imgurl,
			"user_alamat" => $row[0]->user_alamat
		);
	}
	
	function updateUserbyid($id,$data){
		$this->db->where('user_id',$id);
		if($this->db->update('lelangags_user',$data)){
			return true;
		}
		return false; 
	}

	function updateUserbyemail($email,$data){
		$this->db->where('user_email',$email);
		if($this->db->update('lelangags_user',$data)){
			return true;
		}
		return false; 
	}

	function deleteUser($id){
		if($this->delete('lelangags_user')->where('user_id',$id)){
			return true;
		}
		return false; 
	}
}