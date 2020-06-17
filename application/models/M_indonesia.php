<?php 
class M_indonesia extends CI_Model{

    function __construct(){
		parent::__construct();
	}
	
	function getDB(){
	    return $db_indo = $this->load->database('db_indo',TRUE);
	}

    public function selectProvinsi()
    {
        $db_indo = $this->load->database('db_indo',TRUE);
        return $db_indo->get('provinsi')->result();
    }
    
    public function selectKabupaten($id)
    {
        $db_indo = $this->load->database('db_indo',TRUE);
        return $db_indo->get_where('kabupaten',array('provinsi_id' => $id))->result();
    }
    
    public function selectAllKabupaten()
    {
        $db_indo = $this->load->database('db_indo',TRUE);
        return $db_indo->get('kabupaten')->result();
    }
    
    public function selectsingleProvinsi($id)
    {
        $db_indo = $this->load->database('db_indo',TRUE);
        return $db_indo->get_where('provinsi',array('id'=>$id))->result();
    }
    
    public function selectsingleKabupaten($id)
    {
        $db_indo = $this->load->database('db_indo',TRUE);
        return $db_indo->get_where('kabupaten',array('id' => $id))->result();
    }
    
    public function selectKabProv($idKab){
        $db_indo = $this->load->database('db_indo',TRUE);
        return $this->getDB()->select('*')->get_where('Kab_Prov','id ='.$idKab)->result();
        $db_indo->select('*');
        $db_indo->get_where('Kab_Prov','id = 1107')->result();
    }
    
        public function selectKabProvMitra($idKab){
        // $db_indo = $this->load->database('db_indo',TRUE);
        $data = $this->getDB()->select('*')->get_where('Kab_Prov','id ='.$idKab)->result();
        $string = (object)array('kab'=>'','prov'=>' Lokasi belum di isi');
        if ($data){
            return $data[0];
        }else{
            return $string;
        }
        // $db_indo->select('*');
        // $db_indo->get_where('Kab_Prov','id = 1107')->result();
    }

}
