<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Song extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			if(isset($_SESSION['list_id'])){
				unset($_SESSION['list_id']);
				// print_r($_SESSION);
			}
			//$this->load->model('PalaceUser_model');
	}

	public function index()
	{
		//$data['query']=$this->PalaceUser_model->showdata();
		$this->load->view('user/css');
		$this->load->view('user/nevba');
		$this->load->view('user/js');
		$this->load->view('user/song_view');
	}
			
}
?>