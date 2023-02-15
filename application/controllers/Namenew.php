<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Namenew extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			if(isset($_SESSION['activity_id'])){
				unset($_SESSION['activity_id']);
				// print_r($_SESSION);
			}
			if(!isset($_SESSION['namenewactivity_id'])){
				$_SESSION['namenewactivity_id']=null;
				$_SESSION['namenewactivity_name']=null;
				$_SESSION['namenewactivity_date']=null;
				$_SESSION['namenewstudent_id']=null;
				$_SESSION['namenewstudent_name']=null;
				
			}
			if( !isset($_SESSION['user_id'] ) ){
				redirect('login','refresh'); 
			}


			$this->load->model('namenew_model');
	}
    
	public function index()
	{ 	
		$data['groups'] = $this->namenew_model->getAllGroups();
		$data['query']=$this->namenew_model->showdata();
		$this->load->view('admin/css');
		$this->load->view('admin/js');
		$this->load->view('admin/namenew_view',$data);
	}
	public function show()
	{	
		if(isset($_POST['check'])){
			$array_id_name_date = explode(",",$_POST['check']);
			$_SESSION['namenewactivity_id'] = $array_id_name_date[0];
			$_SESSION['namenewactivity_name'] = $array_id_name_date[1];
			$_SESSION['namenewactivity_date'] = $array_id_name_date[2];
			$data['groups'] = $this->namenew_model->getAllGroups();
			$data['query']=$this->namenew_model->showdata();
			$this->load->view('admin/css');
			$this->load->view('admin/js');
			$this->load->view('admin/namenew_view',$data);
			
		}
		else{
			redirect('namenew','refresh');
		}
		
	}
	public function insert()
	{
		if (strlen($_POST['name_1'])==14) {
			$_SESSION['namenewstudent_id'] = substr($_POST['name_1'],3,10);
			if($this->namenew_model->checkinsertNamenew()){
				$data['list']=$this->namenew_model->checklistNamenew();
				$_SESSION['namenewlist_id'] = $data['list'][0]->list_id;
				if($this->namenew_model->checkinsertNamenew1()){
					$data = array(
						'activity_id' => $_SESSION['namenewactivity_id'],
						'list_id' => $_SESSION['namenewlist_id'],
						'check_activity' => "1",
					);
					
					if($this->namenew_model->insertNamenew($data)){
						$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
					}
					else{
						$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
					}
				}
				else{
					$_SESSION['namenewstudent_id'] = "นิสิตได้เข้าร่วมกิจกรรมนี้ไปแล้ว";
					$this->session->set_flashdata('check', 'นิสิตได้เข้าร่วมกิจกรรมนี้ไปแล้ว!!!!');
				}
			}
			else{
				$_SESSION['namenewstudent_id'] = "ไม่มีรหัสนิสิตนี้ในระบบ";
				$this->session->set_flashdata('check', 'ไม่มีรหัสนิสิตนี้ในระบบ !!!!');
			}
			redirect('Namenew','refresh');
		}
		else if (strlen($_POST['name_1'])==10) {
			$_SESSION['namenewstudent_id'] = $_POST['name_1'];
			// echo $_SESSION['namenewstudent_id'];
			if($this->namenew_model->checkinsertNamenew()){
				$data['list']=$this->namenew_model->checklistNamenew();
				$_SESSION['namenewlist_id'] = $data['list'][0]->list_id;
				// echo $_SESSION['namenewlist_id'];
				// print_r($_SESSION['namenewlist_id']);
				if($this->namenew_model->checkinsertNamenew1()){
					$data = array(
						'activity_id' => $_SESSION['namenewactivity_id'],
						'list_id' => $_SESSION['namenewlist_id'],
						'check_activity' => "1",
					);
					
					if($this->namenew_model->insertNamenew($data)){
						$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
					}
					else{
						$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
					}
				}
				else{
					$_SESSION['namenewstudent_id'] = "นิสิตได้เข้าร่วมกิจกรรมนี้ไปแล้ว";
					$this->session->set_flashdata('check', ' นิสิตได้เข้าร่วมกิจกรรมนี้ไปแล้ว !!!!');
				}
			}
			else{
				$_SESSION['namenewstudent_id'] = "ไม่มีรหัสนิสิตนี้ในระบบ";
				$this->session->set_flashdata('check', 'ไม่มีรหัสนิสิตนี้ในระบบ !!!!');
			}
			redirect('namenew','refresh');
		}
		else{
			$_SESSION['namenewstudent_id']="รหัสที่คุณกรอกไม่ถูกต้อง";
			$this->session->set_flashdata('check', 'รหัสที่คุณกรอกไม่ถูกต้อง !!!!');
			redirect('Namenew','refresh');
		}
		// print_r($_POST);
	}

	public function delete()
	{
		if(isset($_POST['delete_id']) ){
			if($this->namenew_model->deleteNamenew()){
				$this->session->set_flashdata('success', 'ลบข้อมูลสำเร็จ !!!!');
			}
			else{
				$this->session->set_flashdata('error', 'ลบข้อมูลไม่สำเร็จ !!!!');
			}
		}
		else{
			$this->session->set_flashdata('check', 'คุณยังไม่ได้เลือกรายการที่ต้องการลบ !!!!');
		}
		redirect('namenew','refresh');
	}	
	

			
}
?>