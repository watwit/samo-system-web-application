<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			if(isset($_SESSION['list_id'])){
				unset($_SESSION['list_id']);
				// print_r($_SESSION);
			}
			$this->load->model('Shop_User_model');
	}

	public function index()
	{
		$data['query']=$this->Shop_User_model->showdata();
		$data['sta']=$this->Shop_User_model->showstatus();
		$this->load->view('user/css');
		$this->load->view('user/nevba');
		$this->load->view('user/js');
        $this->load->view('user/Shop_view',$data);
	}

}
?>