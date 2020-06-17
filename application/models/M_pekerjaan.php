<?php 
class M_pekerjaan extends CI_Model
{

	function __construct(){
		parent::__construct();
    }

    // Hapus
    public function insertPekerjaanBatch($data)
    {
        if($this->db->insert_batch('lelangags_pekerjaan',$data)){
            return berhasil_buat_pekerjaan;
        }
        return gagal_buat_pekerjaan;
    }

    public function updatePekerjaan($id,$data)
    {
        $this->db->where('pekerjaan_id',$id);
        if($this->db->update('lelangags_pekerjaan',$data)){
            return berhasil_edit_pekerjaan;
        }
        return gagal_edit_pekerjaan;
    }
    
    public function updatebatchPekerjaan($data)
    {
        if($this->db->update_batch('lelangags_pekerjaan',$data,'pekerjaan_id')){
            return berhasil_edit_pekerjaan;
        }
        return gagal_edit_pekerjaan;
    }
    
    public function updatePekerjaanbyLelangid($id,$data)
    {
        $this->db->where('pekerjaan_lelangid',$id);
        if($this->db->update('lelangags_pekerjaan',$data)){
            return berhasil_edit_pekerjaan;
        }
        return gagal_edit_pekerjaan;
    }
    
    public function selectpekerjaan($id)
    {
        $this->db->select('pekerjaan_ukuran, pekerjaan_bahan,pekerjaan_jmlsisi, pekerjaan_laminasi, pekerjaan_catatan, pekerjaan_id, pekerjaan_lelangid,pekerjaan_jumlah,pekerjaan_kategoriid,pekerjaan_harga,pekerjaan_status');
        return $this->db->get_where('lelangags_pekerjaan',array('pekerjaan_lelangid'=>$id))->result();
    }
    
    public function selectAllpekerjaan()
    {
        $this->db->select('pekerjaan_ukuran, pekerjaan_bahan,pekerjaan_jmlsisi, pekerjaan_laminasi, pekerjaan_catatan, pekerjaan_id, pekerjaan_lelangid,pekerjaan_jumlah,pekerjaan_kategoriid,pekerjaan_harga,pekerjaan_status');
        return $this->db->get_where('lelangags_pekerjaan','pekerjaan_status !=1')->result();
    }

// Hapus
    // public function getDaftarProduk($id){
    //     $this->db->select('kategori_nama, pekerjaan_ukuran, pekerjaan_bahan, pekerjaan_catatan, pekerjaan_id, pekerjaan_lelangid,pekerjaan_jumlah,pekerjaan_kategoriid,pekerjaan_harga,pekerjaan_status, pekerjaan_jmlsisi, pekerjaan_laminasi, pekerjaan_cdate');
    //     $this->db->order_by('pekerjaan_cdate','ASC');
    //     return $this->db->get_where('Detail_Pekerjaan',array('pekerjaan_lelangid'=>$id))->result();
    // }

// Hapus    
    // public function getJumlahProduk($id){
    //     $this->db->select('kategori_nama, pekerjaan_ukuran, pekerjaan_bahan, pekerjaan_catatan, pekerjaan_id, pekerjaan_lelangid,pekerjaan_jumlah,pekerjaan_kategoriid,pekerjaan_harga,pekerjaan_status');
    //     return $this->db->get_where('Detail_Pekerjaan',array('pekerjaan_lelangid'=>$id))->num_rows();
    // }
}