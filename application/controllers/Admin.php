<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$uri = $_SERVER['REQUEST_URI'];
		$array = explode('/', $uri);
		$key = array_search("se", $array);
		$name = $array[$key + 1];
		if(isset($_SESSION['activity_id'])){
			unset($_SESSION['activity_id']);
			// print_r($_SESSION);
		}
		if( !isset($_SESSION['user_id'] ) ){
			redirect('login','refresh'); 
		}
		if(isset($_SESSION['namenewactivity_id'])){
			$_SESSION['namenewactivity_id']=null;
			$_SESSION['namenewactivity_name']=null;
			$_SESSION['namenewactivity_date']=null;
			
		}
		else if ($name == 'admin' && $_SESSION['permisstion'] == 'admin') {
			redirect('activity', 'refresh');;
		}
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['query'] = $this->admin_model->showdata();
		$this->load->view('admin/css');
		// $this->load->view('admin/nevba');
		$this->load->view('admin/js');
		$this->load->view('admin/admin_view', $data);
	}
	public function insert()
	{
		if (isset($_POST['submit'])) {
			if($this->admin_model->checkUserName()){
				if($this->admin_model->checkName()){
					$data = array(
						'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
						'username' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('username'))),
						'firstname' =>  mb_ereg_replace('[[:space:]]+','',trim($this->input->post('firstname'))),
						'lastname' =>  mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lastname'))),
						'permisstion' => $this->input->post('permission'),
					);
					if($this->admin_model->insertAdmin($data)){
						$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
					}
					else{
						$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
					}
				}
				else{
                    $this->session->set_flashdata('check', 'คุณเคยสมัครใช้งานไปเเล้ว !!!!');
				}

			}
			else{
				$this->session->set_flashdata('check', 'username  นี้ถูกใช้งานไปเเล้ว !!!!');
			}
			
		} 
		redirect('admin', 'refresh');

	}
	public function edit()
	{
		if (isset($_POST['submit'])) {
			if($this->admin_model->checkNameEdit()){
				if($this->input->post('user_id1')!='1'){
					$data = array(
						'firstname' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('firstname1'))),
						'lastname' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lastname1'))),
						'permisstion' => $this->input->post('permission1'),
					);
					if($this->admin_model->editAdmin($data)){
						$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
					}
					else{
						$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
					}
				}
				if($this->input->post('user_id1')=='1'){
					$data = array(
						'firstname' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('firstname1'))),
						'lastname' =>mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lastname1'))),
					);
					if($this->admin_model->editAdmin($data)){
						$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
					}
					else{
						$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
					}
				}		
			}
			else{
				$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไข ชื่อ เเละ นามสกุล ได้เนื่องจากมีในระบบเเล้ว!!!!');
			}
		}
		redirect('admin', 'refresh');
	}
	public function deleteAdmin()
	{
		if (isset($_POST['delete_id'])) {
			$result = $this->admin_model->deleteAdmin();
			if ($result && in_array($_SESSION['user_id'], $this->input->post('delete_id'))) {
				redirect('login/logout', 'refresh');
			}
			else
			{
				if($result)
				{
					$this->session->set_flashdata('success', 'ลบข้อมูลสำเร็จ !!!!');
					redirect('admin', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'ลบข้อมูลไม่สำเร็จ !!!!');
					redirect('admin', 'refresh');
				}
			}
		} else {
			$this->session->set_flashdata('check', 'คุณยังไม่ได้เลือกรายการที่ต้องการลบ !!!!');
			redirect('admin', 'refresh');
		}
	}
}
