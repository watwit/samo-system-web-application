<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkaward extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			if( !isset($_SESSION['user_id'] ) ){
				redirect('login','refresh'); 
			}
			$this->load->model('checkaward_model');
    }

    
	public function show($award_id)
	{
        $_SESSION['award_id']=$award_id;
        $data['groups'] = $this->checkaward_model->getAllGroups();
        $data['query']=$this->checkaward_model->showdata();
        $data['show_name']=$this->checkaward_model->showdata_name();
		$this->load->view('admin/css');
		// $this->load->view('admin/nevba');
		$this->load->view('admin/js');
		$this->load->view('admin/checkaward_view',$data);
    }
    

    public function multicheck()
	{   

		// if(isset($_POST['saveja']))
		// {
		// 	$user_id=1;//Pass the userid here
		// 	$checkbox = $_POST['check']; 
		// 	for($i=0;$i<count($checkbox);$i++){
		// 		$category_id = $checkbox[$i];
		// 		$this->checkaward_model->multisave($_SESSION['award_id'],$category_id);//Call the modal
		// 	}
		// 		redirect('checkaward/show/'.$_SESSION['award_id'],'refresh');	
		//  }
		 if(isset($_POST['saveja'])){
			$checkbox = $_POST['check']; 
			for($i=0;$i<count($checkbox);$i++){
				$category_id = $checkbox[$i];
				$data = array(
					'award_id' => $_SESSION['award_id'],
					'activity_id' => $category_id,
				);
				$this->checkaward_model->multisave($data);//Call the modal
				
			}
			if($this->checkaward_model->checkmultisave($data)){
				$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
			}
			else{
				$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
				}
		 }
		redirect('checkaward/show/'.$_SESSION['award_id'],'refresh');	
		
    }
    public function delete()
	{
		if(isset($_POST['delete_id']) ){
			if($this->checkaward_model->deleteCheckaward()){
				$this->session->set_flashdata('success', 'ลบข้อมูลสำเร็จ !!!!');
			}
			else{
				$this->session->set_flashdata('error', 'ลบข้อมูลไม่สำเร็จ !!!!');
			}
		}
		else{
			$this->session->set_flashdata('check', 'คุณยังไม่ได้เลือกรายการที่ต้องการลบ !!!!');
		}
		redirect('checkaward/show/'.$_SESSION['award_id'],'refresh');
	}	
}
?>
	