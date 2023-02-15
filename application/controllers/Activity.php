<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Activity extends CI_Controller {
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
		$this->load->model('activity_model');
	}
	public function index()
	{
		$data['query']=$this->activity_model->showdata();
		$this->load->view('admin/css');
		$this->load->view('admin/js');
		$this->load->view('admin/activity_view',$data);
	}
	public function insert()
	{
		if(isset($_POST['submit'])){
			if($this->activity_model->checkinsertActivity()){
				$data = array(
					'date' => $this->input->post('date'),
					'activity_name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('activity_name'))),
					'amont_of_time' => $this->input->post('time'),
				);
				if($this->activity_model->insertActivity($data)){
					$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
				}
				else{
					$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
				}
			}
			else{
				$this->session->set_flashdata('check', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก วันที่ซ้ำกับกิจกรรมอื่น !!!!');
			}
		}
		redirect('activity','refresh');	
	}
	public function edit()
	{
		if(isset($_POST['submit'])){
			if(!empty($this->input->post('date1'))&&!empty($this->input->post('activity_name1')))
			{
				if($this->activity_model->checkeditActivity()){
					$data = array(
						'date' => $this->input->post('date1'),
						'activity_name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('activity_name1'))),
						'amont_of_time' => $this->input->post('time1'),
					);
					if($this->activity_model->editActivity($data)){
						$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
					}
					else{
						$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
					}
				}
				else{
					$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไขข้อมูลได้เนื่องจาก วันที่ซ้ำกับกิจกรรมอื่น !!!!');
				}
			}
			else if (empty($this->input->post('date1'))&&empty($this->input->post('activity_name1'))){
				$data = array(
					'amont_of_time' => $this->input->post('time1')
				);
				if($this->activity_model->editActivity($data)){
					$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
				}
				else{
					$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
				}
			}
		}
		redirect('activity','refresh');
	}
	public function deleteActivity()
	{
		if(isset($_POST['delete_id']) ){
			if($this->activity_model->deleteActivity()){
				$this->session->set_flashdata('success', 'ลบข้อมูลสำเร็จ !!!!');
			}
			else{
				$this->session->set_flashdata('error', 'ลบข้อมูลไม่สำเร็จ !!!!');
			}
		}
		else{
			$this->session->set_flashdata('check', 'คุณยังไม่ได้เลือกรายการที่ต้องการลบ !!!!');
		}
		redirect('activity','refresh');
	}	
}
