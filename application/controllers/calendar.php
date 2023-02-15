<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			if(isset($_SESSION['list_id'])){
				unset($_SESSION['list_id']);
				// print_r($_SESSION);
			}
			$this->load->model('calendar_model');
			$this->load->model('login_user_model');
	}

	public function index()
	{
		$data['query']=$this->calendar_model->showdata();
		$this->load->view('user/css');
		$this->load->view('user/nevba');
		$this->load->view('user/js');
		$this->load->view('user/calendar_view',$data);
	}
	public function checkLogin()
	{
		//$data['query'] = $this->login_user_model->checkLoginModel();
		if (isset($_POST['submit'])) {
			$data['query'] = $this->login_user_model->checkLoginModel();
			if (!empty($data['query'])) {
				$this->session->set_userdata('list_id', $data['query']->list_id);
				$this->session->set_userdata('student_id', $data['query']->student_id);
				$this->session->set_userdata('student_name', $data['query']->student_name);
				$this->session->set_userdata('major', $data['query']->major_code);
				redirect('Activity_user', 'refresh');

			} 
			else 
			{
				$this->session->set_flashdata('check', 'นิสิตดังกล่าวไม่อยู่ในฐานข้อมูล!!!! !!!!');
				redirect('calendar', 'refresh');
			}
		} 
		else 
		{
			redirect('calendar', 'refresh');
		}
    }

}
?>

