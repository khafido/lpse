<?php 
class M_user extends CI_Model
{
    public function selectAllUser()
    {
        $this->db->select('user_id,user_nama,user_email,user_telpon,user_status,user_alamat,user_kotaid,user_imgurl,user_skill,user_tentang');
        return $this->db->get_where('lelangags_user',array('user_status'=>3))->result();
    }
    
    public function selectUserby($id){
        $this->db->select('*');
        $user = $this->db->get_where('lelangags_user',array('user_id'=>$id))->result();
        return $user[0];
    }
    
    public function selectUserImageby($id){
        $this->db->select('user_imgurl');
        return $this->db->get_where('lelangags_user',array('user_id'=>$id))->result();
    }
    
    public function selectUser($per_page, $offset){
        $this->db->select('user_id,user_nama,user_telpon,user_status,user_alamat,user_kotaid,user_imgurl');
        $this->db->limit($per_page, $offset);
        $this->db->order_by('user_cdate', "DESC");
        return $this->db->get_where('lelangags_user',array('user_status'=>3))->result();
    }
    
    public function getTotalByUser(){
        $this->db->select('user_nama,user_telpon,user_status,user_alamat,user_kotaid,user_imgurl');
        $this->db->order_by('user_cdate', "DESC");        
        return $this->db->get_where('lelangags_user',array('user_status'=>3))->num_rows();
    }
    
    
    public function updateuser($id,$data)
    {
        $this->db->where('user_id',$id);
        if($this->db->update('lelangags_user',$data)){
            return berhasil_edit_user;
        }
        return gagal_edit_user;
    }
    
    public function getprovid($id_kota)
    {
        $db_indo = $this->load->database('db_indo',TRUE);
        $db_indo->select('*');
        $prov = $db_indo->get_where('Kab_Prov',array('id'=>$id_kota))->result();
        return ($prov)?$prov[0]:null;
    }
}