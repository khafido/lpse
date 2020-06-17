<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori2 extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->model('m_crud');
	}

	public function index()
	{
	    $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");
// 		$data['active'] = 'category';
// 		$this->load->view('Admin/includes/v_header', $data);
		$this->load->view('admin/v_kategori2');
// 		$this->load->view('Admin/includes/v_footer');
	}
 
	function readData(){					
		$data = $this->m_crud->read('lelangags_kategori');
		echo json_encode($data);
	}

	function saveData(){
		$data = array(
			'name' 			=> $this->input->post('name'),
			'id_parent' 	=> $this->input->post('id_parent'),
			'id_sub_parent' => $this->input->post('id_sub')
		);

		$data = $this->m_crud->save('category', $data);
		echo json_encode($data);
	}

	function updateData(){
		$id 	= $this->input->post('id_category');
        $parent = $this->input->post('id_parent');
        $sub 	= $this->input->post('id_sub');

        if ($parent<>0 && $sub<>0){
            $data = array(
                'name' => $this->input->post('name'),
                'id_parent' => $this->input->post('id_parent'),
				'id_sub_parent' => $this->input->post('id_sub')
			);

        } else if($parent<>0 && $sub==0){
            $data = array(
                'name' => $this->input->post('name'),
                'id_parent' => $this->input->post('id_parent'));

            $this->db->where('id_category',$id);
            // $update = $this->db->update('category', $data);
        } else if($parent==0){
            $this->db->where('id_category',$id);
            $data = array('name' => $this->input->post('name'));
		}
		$send = $this->m_crud->update('category', 'id_category', $id, $data);

		echo json_encode($send);
	}

	function deleteData(){
		$id 	= $this->input->post('id_category');
        $parent = $this->input->post('id_parent');
        $sub 	= $this->input->post('id_sub');

        if($parent<>0 && $sub<>0){
            $this->db->where('id_category', $id);
        } else if($parent<>0 && $sub==0){
            $this->db->where('id_category',$id);
            $this->db->or_where('id_sub_parent',$id);
        } else if($parent==0){
            $this->db->where('id_category',$id);
            $this->db->or_where('id_parent',$id);
		}

		$send = $this->m_crud->delete('category', 'id_category', $id);
		echo json_encode($send);
	}

	function getSubCategory(){
		$id = $this->input->post('id');
		$data = $this->m_crud->getCategory('sub', $id);
		echo json_encode($data);
	}
}
