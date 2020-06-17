<?php 
class M_tawaran extends CI_Model
{
    public function selectAllTawaran()
    {
        $this->db->select('tawaran_id,tawaran_lelangid,tawaran_userid,tawaran_anggaran,tawaran_cdate');
        return $this->db->get_where('lelangags_tawaran',array('tawaran_status'=>status_enable))->result();
    }
    
    public function selectAllHistoriTawaran()
    {
        $this->db->select('tawaran_historiid,tawaran_lelangid,tawaran_userid,tawaran_anggaran,tawaran_cdate');
        return $this->db->get_where('lelangags_historitawaran',array('tawaran_status'=>status_enable))->result();
    }
    
    public function insert($data){
        if($this->db->insert('lelangags_tawaran',$data)){
            return berhasil_buat_tawaran;
        }
        return gagal_buat_tawaran;
    }
    
    public function insertTawaran($data){
        if($this->db->insert('lelangags_tawaran',$data)){
            return $this->db->insert_id();
        }
        return gagal_buat_tawaran;
    }
    
    public function updateTWPekerjaan($data){
        if($this->db->update_batch('lelangags_twpekerjaan',$data,'twpekerjaan_id')){
            return true;
        }
        return false;
    }
    
    public function insertTWPekerjaanBatch($data){
        if($this->db->insert_batch('lelangags_twpekerjaan',$data)){
            return true;
        }
        return false;
    }
    
    public function selectAllTWPekerjaan(){
        $this->db->select('twpekerjaan_id,twpekerjaan_tawaranid,twpekerjaan_pekerjaanid,twpekerjaan_anggaran');
        return $this->db->get_where('lelangags_twpekerjaan',array('twpekerjaan_status'=>status_enable))->result();
    }
    
    // Hapus
    // public function selectTawPekBy($where){
    //     $this->db->select('twpekerjaan_id,twpekerjaan_tawaranid,twpekerjaan_pekerjaanid,twpekerjaan_anggaran, tawaran_anggaran, user_nama, user_imgurl');
    //     $this->db->order_by('tawaran_anggaran', 'ASC');
    //     $this->db->where(array('twpekerjaan_status'=>status_enable));
    //     return $this->db->get_where('Lihat_Tawaran_Produk', $where)->result();
    // }
    
    public function update($where,$data){
        $this->db->where($where);
        if($this->db->update('lelangags_tawaran',$data)){
            return berhasil_edit_tawaran;
        }
        return gagal_edit_tawaran;
    }
    
    public function updateTawaranPek($where,$data){
        $this->db->where($where);
        if($this->db->update('Lihat_Tawaran_Produk',$data)){
            return berhasil_edit_tawaran;
        }
        return gagal_edit_tawaran;
    }

    public function selectTawaranBy($where){
        $this->db->select('*');
        $this->db->where(array('tawaran_status'=>status_enable));
        // $this->db->order_by('tawaran_anggaran', 'ASC');
        return $this->db->get_where('Lihat_Tawaran', $where)->result();
    }
    
    public function getTopTawaran($id){
        $this->db->select('*');
        $this->db->limit(1);
        $this->db->order_by('tawaran_anggaran');
        return $this->db->get_where('Lihat_Tawaran',array('lelang_id'=>$id, 'tawaran_status'=>status_enable))->result();
    }
    
    // Hapus
    // public function getJumlahTawaran($id){
    //     $this->db->select('*');
    //     return $this->db->get_where('Lihat_Tawaran',array('lelang_id'=>$id, 'tawaran_status'=>status_enable))->num_rows();
    // }    
}