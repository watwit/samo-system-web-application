<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListSmo extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			if(isset($_SESSION['list_id'])){
				unset($_SESSION['list_id']);
				// print_r($_SESSION);
			}
			$this->load->model('ListSmo_model');
	}
	public function index()
	{
		$data['query']=$this->ListSmo_model->showdata();
		$this->load->view('user/css');
		$this->load->view('user/nevba');
		$this->load->view('user/js');
		$this->load->view('user/ListSmo_view',$data);
	}
			
}
?>