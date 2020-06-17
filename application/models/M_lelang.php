<?php 
class M_lelang extends CI_Model
{

	function __construct(){
		parent::__construct();
    }

    // public function insertlelang($data)
    // {
    //     $this->db->insert('lelangags_lelang',$data);
    //     return $this->db->insert_id();
    // }
    
    public function selectLelang($id)
    {
        $this->db->select('lelang_deskripsi,lelang_tglmulai,lelang_tglselesai,lelang_judul,lelang_userid,lelang_pembayaran,lelang_alamat,lelang_id,lelang_kota,lelang_status,lelang_anggaran,lelang_fileurl,lelang_mitraid');
        return $this->db->get_where('lelangags_lelang',array('lelang_id'=>$id))->result();
    }
    
    public function selectlelangBy($perpage, $offset, $where)
    {
        $this->db->select('DISTINCT(lelang_id), lelang_deskripsi,lelang_tglmulai,lelang_tglselesai,lelang_judul,lelang_userid,lelang_pembayaran,lelang_alamat,lelang_id,lelang_kota,lelang_status,lelang_anggaran,lelang_fileurl, lelang_mitraid');
        $this->db->limit($perpage, $offset);
        $this->db->order_by('lelang_cdate', 'DESC');
        return $this->db->get_where('Lihat_Lelang', $where)->result();
        // return $this->db->get_where('lelangags_lelang', $where)->result();
    }
    
    public function hitungLelangBy($perpage, $offset, $id)
    {
        $this->db->select('lelang_deskripsi,lelang_tglmulai,lelang_tglselesai,lelang_judul,lelang_userid,lelang_pembayaran,lelang_alamat,lelang_id,lelang_kota,lelang_status,lelang_anggaran,lelang_fileurl');
        $this->db->limit($perpage, $offset);
        return $this->db->get_where('lelangags_lelang',array('lelang_id'=>$id))->num_rows();
    }
    
    public function selectAlllelang()
    {
        $this->db->select('lelang_deskripsi,lelang_tglmulai,lelang_tglselesai,lelang_judul,lelang_userid,lelang_mitraid,lelang_pembayaran,lelang_alamat,lelang_id,lelang_kota,lelang_status,lelang_anggaran,lelang_fileurl');
        return $this->db->get_where('lelangags_lelang','lelang_status != 1')->result();
    }

    public function selectByProduk($id, $per_page, $offset, $userid){
        $id = (int) $id;
        $this->db->select('DISTINCT(lelang_id), lelang_deskripsi,lelang_tglmulai,lelang_tglselesai,lelang_judul,lelang_userid,lelang_pembayaran,lelang_alamat,lelang_id,lelang_kota,lelang_status,lelang_anggaran,lelang_fileurl');
        $this->db->limit($per_page, $offset);
        $this->db->where_not_in('lelang_userid', $userid);
        $this->db->order_by('lelang_cdate', "DESC");
        if($id==0){
            return $this->db->get_where('Lihat_Lelang',"lelang_status = 3")->result();
        } else {
            return $this->db->get_where('Lihat_Lelang','pekerjaan_kategoriid='.$id.' and lelang_status = 3')->result();
        }
    }
    
    public function getTotalByProduk($id, $userid){
        $id = (int) $id;
        $this->db->select('DISTINCT(lelang_id), lelang_deskripsi,lelang_tglmulai,lelang_tglselesai,lelang_judul,lelang_userid,lelang_pembayaran,lelang_alamat,lelang_id,lelang_kota,lelang_status,lelang_anggaran,lelang_fileurl');
        $this->db->where_not_in('lelang_userid', $userid);        
        $this->db->order_by('lelang_cdate', "DESC");        
        if($id==0){
            return $this->db->get_where('Lihat_Lelang','lelang_status = 3')->num_rows();
        } else {
            return $this->db->get_where('Lihat_Lelang',"pekerjaan_kategoriid=$id")->num_rows();
        }
    }
    
    public function cariLelang($userid, $word){
        $this->db->select('DISTINCT(lelang_id), lelang_deskripsi,lelang_tglmulai,lelang_tglselesai,lelang_judul,lelang_userid,lelang_pembayaran,lelang_alamat,lelang_id,lelang_kota,lelang_status,lelang_anggaran,lelang_fileurl');
        // $this->db->limit($per_page, $offset);
        $this->db->like("lelang_judul", $word, "both");
        $this->db->where_not_in('lelang_userid', $userid);
        $this->db->order_by('lelang_cdate', "DESC");
            
        return $this->db->get_where('Lihat_Lelang',array("lelang_status"=>status_enable))->result();
    }
}