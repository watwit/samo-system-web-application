<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduleuser extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			if(isset($_SESSION['list_id'])){
				unset($_SESSION['list_id']);
				// print_r($_SESSION);
			}
			$this->load->model('scheduleuser_model');
	}

	public function show($activity_id)
	{
		$_SESSION['activity_id_user']=$activity_id;
		$data['query']=$this->scheduleuser_model->showdata();
		$data['head']=$this->scheduleuser_model->showdata1();
		$this->load->view('user/css_activity');
		$this->load->view('user/nevba');
		$this->load->view('user/js');
		$this->load->view('user/schedule_view',$data);
	}
			
}
?>
