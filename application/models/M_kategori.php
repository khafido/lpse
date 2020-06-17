<?php 
class M_kategori extends CI_Model
{

	function __construct(){
		parent::__construct();
	}
	
	public function selectKategori()
    {
        $this->db->select('kategori_id,kategori_nama,kategori_parentid,kategori_subparentid');
        return $this->db->get_where('lelangags_kategori',array('kategori_status!='=>1))->result();
    }
	
	// Hapus
// 	public function getParent(){
// 	    $this->db->select('kategori_id,kategori_nama,kategori_parentid,kategori_subparentid');
// 	    return $this->db->get_where('lelangags_kategori',array('kategori_parentid'=>0,'kategori_status!='=>1))->result();
// 	}
	
// 	public function getKategori($id)
// 	{
// 		$this->db->select('kategori_id,kategori_nama,kategori_parentid,kategori_subparentid');
// 		return $this->db->get_where('lelangags_kategori',array('kategori_subparentid' => $id,'kategori_parentid!='=>0,'kategori_status!='=>1))->result();
// 	}
	
	public function getSingleKategori($id)
	{
	    $this->db->select('kategori_id,kategori_nama,kategori_parentid,kategori_subparentid');
		return $this->db->get_where('lelangags_kategori', array('kategori_id' => $id,'kategori_status!='=>1))->result();
	}

    // Hapus
// 	public function getSubParentKategori($id)
// 	{
// 	    $this->db->select('kategori_id,kategori_nama,kategori_parentid,kategori_subparentid');
//         return $this->db->get_where('lelangags_kategori',array('kategori_parentid' => $id,'kategori_subparentid' =>0,'kategori_status!='=>1))->result();
// 	}
	
	public function selectSpecBarang(){
	    $this->db->select('specbarang_id,specbarang_kategoriid,specbarang_ukuran,specbarang_bahan,specbarang_jmlsisi,specbarang_laminasi,specbarang_hargasatuan,specbarang_satuan');
	    return $this->db->get_where('lelangags_specbarang',array('specbarang_status!='=>1))->result();
	}
	
	// Hapus
// 	public function selectSpecBarangBy($where){
// 	    $this->db->select('specbarang_id,specbarang_kategoriid,specbarang_ukuran,specbarang_bahan,specbarang_jmlsisi,specbarang_laminasi,specbarang_hargasatuan,specbarang_satuan');
// 	    $this->db->where_not_in('specbarang_status', "1");
// 	    return $this->db->get_where('lelangags_specbarang',$where)->result();
// 	}
	
	public function selectSpecHargaBy($where){
	   // $this->db->select('specbarang_hargasatuan,specbarang_satuan');
	    $this->db->select('*');
	    $this->db->where_not_in('specbarang_status', "1");
	   // $this->db->or_where(array('specbarang_ukuran'=>'custom', 'specbarang_ukuran'=>'custom'));
	    $this->db->where($where);
	    return $this->db->get('lelangags_specbarang')->result();
	}
}