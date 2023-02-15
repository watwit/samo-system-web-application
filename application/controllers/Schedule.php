<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			if( !isset($_SESSION['user_id'] ) ){
				redirect('login','refresh'); 
			}
			if(isset($_SESSION['namenewactivity_id'])){
				$_SESSION['namenewactivity_id']=null;
				$_SESSION['namenewactivity_name']=null;
				$_SESSION['namenewactivity_date']=null;
				
			}
			$this->load->model('schedule_model');
	}

	public function show($activity_id)
	{
		$_SESSION['activity_id']=$activity_id;
		$data['query']=$this->schedule_model->showdata();
		$data['name_activity']=$this->schedule_model->showdata_name();
		$this->load->view('admin/css');
		$this->load->view('admin/js');
		$this->load->view('admin/schedule_view',$data);
	}
	public function insert()
	{
		if(isset($_POST['submit']) && isset($_SESSION['activity_id'])){
			if($this->schedule_model->checkInsertSchedule()){
				$note="-";
				if(!empty($this->input->post('note'))){
					$note=$this->input->post('note');
				}
				$data = array(
					'activity_id' => $_SESSION['activity_id'],
					'time' => $this->input->post('time'),
					'schedule_name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('schedule_name'))),
					'note' => mb_ereg_replace('[[:space:]]+',' ',trim($note)) ,
				);
				if($this->schedule_model->insertSchedule($data)){
					$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
					redirect('schedule/show/'.$_SESSION['activity_id'],'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
					redirect('schedule/show/'.$_SESSION['activity_id'],'refresh');
				}
			}
			else{
				$this->session->set_flashdata('check', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก เวลาซ้ำกับกิจกรรมอื่น!!!!');
				redirect('schedule/show/'.$_SESSION['activity_id'],'refresh');
			}
		}
		else{
			redirect('activity','refresh');	
		}
	}
	public function deleteSchedule()
	{
		if(isset($_SESSION['activity_id'])){
			if(isset($_POST['delete_id'])){
				if($this->schedule_model->deleteSchedule()){
					$this->session->set_flashdata('success', 'ลบข้อมูลสำเร็จ !!!!');
					redirect('schedule/show/'.$_SESSION['activity_id'],'refresh');	
				}
				else{
					$this->session->set_flashdata('error', 'ลบข้อมูลไม่สำเร็จ !!!!');
					redirect('schedule/show/'.$_SESSION['activity_id'],'refresh');	
				}	
			}
			else{
				$this->session->set_flashdata('check', 'คุณยังไม่ได้เลือกรายการที่ต้องการลบ !!!!');
				redirect('schedule/show/'.$_SESSION['activity_id'],'refresh');
			}
			
		}
		else{
			redirect('activity','refresh');
		}
	}
	public function edit()
	{
		if(isset($_POST['submit']) && isset($_SESSION['activity_id'])){
			if($this->schedule_model->checkEditSchedule()){
				$note="-";
				if(!empty($this->input->post('note'))){
					$note=$this->input->post('note');
				}
				$data = array(
					'time' => $this->input->post('time'),
					'schedule_name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('schedule_name'))),
					'note' => mb_ereg_replace('[[:space:]]+',' ',trim($note)) ,
				);
				if($this->schedule_model->editSchedule($data)){
					$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
					redirect('schedule/show/'.$_SESSION['activity_id'],'refresh');
				}
				else{
					$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
					redirect('schedule/show/'.$_SESSION['activity_id'],'refresh');
				}
				
			}
			else{
				$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไขข้อมูลได้เนื่องจาก เวลาซ้ำกับกิจกรรมอื่น!!!!');
			    redirect('schedule/show/'.$_SESSION['activity_id'],'refresh');
			}
			
		}
		else{
			redirect('activity','refresh');	
		}
	}
			
}
?>
