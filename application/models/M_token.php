<?php 
class M_token extends CI_Model
{
    public function getTokenDBINDO($s)
    {
        $db_indo = $this->load->database('db_indo',TRUE);
        $db_indo->order_by('token_id','DESC');
        $token_data=$db_indo->get_where('indonesia_token',array('token_tablename'=>'provinsi'))->first_row();
        return $token_data->token_code;
    }
    
    public function getTokenDBLelang($s)
    {
        $this->db->order_by('token_id','DESC');
        $token_data=$this->db->get_where('lelangags_token',array('token_tablename'=>$s))->first_row();
        return $token_data->token_code;
    }
    
}