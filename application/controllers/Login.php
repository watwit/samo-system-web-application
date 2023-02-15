<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->load->view('admin/css');
		$this->load->view('admin/login_view');
		$this->load->view('admin/js');
	}
	public function checkLogin()
	{
		if (isset($_POST['submit'])) {
			$data['query'] = $this->login_model->checkLoginModel();
			//print_r($data['query']);
			//echo $data['query']->password;
			if (!empty($data['query']) && password_verify($this->input->post('password'), $data['query']->password)) {
				$this->session->set_userdata('user_id', $data['query']->user_id);
				$this->session->set_userdata('firstname', $data['query']->firstname);
				$this->session->set_userdata('lastname', $data['query']->lastname);
				$this->session->set_userdata('permisstion', $data['query']->permisstion);
				redirect('activity', 'refresh');
			} else {
				$this->session->set_flashdata('msg_login', 'username หรือ password ไม่ถูกต้อง!!!!');
				redirect('login', 'refresh');
			}
		} else {
			redirect('login', 'refresh');
		}
	}
	// public function forgetpassword()
	// {
	// 	$this->load->view('admin/css');
	// 	$this->load->view('admin/forgetpassword_view');
	// 	$this->load->view('admin/js');
	// }
	public function logout(){
		unset(
				$_SESSION['user_id'],
				$_SESSION['firstname'],
				$_SESSION['lastname'],
				$_SESSION['permisstion'],
				$_SESSION['activity_id'],
				$_SESSION['namenewactivity_id'],
				$_SESSION['namenewactivity_name'],
				$_SESSION['namenewactivity_date']

		);
		redirect('login', 'refresh');
	}

}
?>
