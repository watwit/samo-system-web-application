<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listall extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			if(isset($_SESSION['activity_id'])){
				unset($_SESSION['activity_id']);
			}
			if( !isset($_SESSION['user_id'] ) ){
				redirect('login','refresh'); 
			}
			if(isset($_SESSION['namenewactivity_id'])){
				$_SESSION['namenewactivity_id']=null;
				$_SESSION['namenewactivity_name']=null;
				$_SESSION['namenewactivity_date']=null;
			}
			 $this->load->model('listall_model');
	}
	public function index()
	{
		$data['groups'] = $this->listall_model->getAllGroups();
		$data['query']=$this->listall_model->showdata();
		$this->load->view('admin/css');
		$this->load->view('admin/js');
		$this->load->view('admin/listall_view',$data);
	}
	public function insert()
	{
		if(isset($_POST['submit']))
		{
			$data = array(
				'student_id' =>  mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id'))),
				'student_name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('first_name')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('last_name'))),
				'major_id' => (int)$this->input->post('major'),
			);
			if ($this->listall_model->checkinsertListall()){
				if($this->listall_model->insertListall($data)){
					$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
				}
				else{
					$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
				}
			}
			else {
				$this->session->set_flashdata('check', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำ !!!!');
			}
		}
		redirect('listall','refresh');	
	}
	public function edit()
	{
		if(isset($_POST['submit']))
		{
			if($this->listall_model->checkeditListall()){
				$data = array(
					'student_id' =>  mb_ereg_replace('[[:space:]]+','',trim($this->input->post('student_id1'))),
					'student_name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('first_name1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('last_name1'))),
					'major_id' => (int)$this->input->post('major1'),
				);
				if($this->listall_model->editListall($data)){
					$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
				}
				else{
					$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
				}
			}
			else{
				$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไขข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำ !!!!');
			}
			
			
		}
		redirect('listall','refresh');	
	}
	public function delete()
	{
		if(isset($_POST['deletelist_id']) ){
			if($this->listall_model->deleteListall()){
				$this->session->set_flashdata('success', 'ลบข้อมูลสำเร็จ !!!!');
			}
			else{
				$this->session->set_flashdata('error', 'ลบข้อมูลไม่สำเร็จ !!!!');
			}
		}
		else{
			$this->session->set_flashdata('check', 'คุณยังไม่ได้เลือกรายการที่ต้องการลบ !!!!');
		}
		redirect('listall','refresh');
	}	
}
?>