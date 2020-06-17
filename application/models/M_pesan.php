<?php 
class M_pesan extends CI_Model
{
    function __construct(){
		parent::__construct();
    }
    
    public function getRoomID($user1,$user2)
    {
        $result=$this->db->query("SELECT * FROM `lelangags_room` WHERE (room_user1 = '$user1' AND room_user2 = '$user2') OR (room_user1 = '$user2' AND room_user2 = '$user1')")->result();
        if($result){
            return $result[0]->room_id;
        }else{
            $this->db->insert('lelangags_room',array('room_user1'=>$user1,'room_user2'=>$user2));
            return $this->db->insert_id();   
        }
    }
    
    public function getRoom($user_id){
        $this->db->where('room_user1',$user_id);
        $this->db->or_where('room_user2',$user_id);
        return $this->db->get("Cari_Room")->result();
    }
    
    public function getPesan($room_id){
        $this->db->where('pesan_roomid',$room_id);
        $this->db->order_by('pesan_cdate', 'ASC');
        return $this->db->get("lelangags_pesan")->result();
    }
    
    public function insertPesan($data)
    {
        if($this->db->insert('lelangags_pesan',$data)){
            return true;
        }
        return false;
    }
}
