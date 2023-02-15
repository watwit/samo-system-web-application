<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Award extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
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
			$this->load->model('award_model');
	}

	public function index()
	{
		$data['query']=$this->award_model->showdata();
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		$this->load->view('admin/css');
		// $this->load->view('admin/nevba');
		$this->load->view('admin/js');
		$this->load->view('admin/award_view',$data);
	}

	public function insert()
	{
		if (isset($_POST['submit'])) {
			//print_r($_POST);
			if ($_FILES['picture']['name'] != NULL) {
				$config['upload_path'] = './img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2000';
				$config['max_width'] = '3000';
				$config['max_height'] = './3000/';
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('picture')) {
					//echo $this->upload->display_errors();
					$error = $this->upload->display_errors();
					?>
					<script language="javascript">
						var text = "<?= $error; ?>";
						alert(text);
					</script>
					<?php
				} else {
					$data = $this->upload->data();
					$filename = $data['file_name'];
					$data = array(
						   'award_name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('award_name'))),
						    'picture' => $filename,
						    'amont_of_time' => $this->input->post('amont_of_time')
					);
					
					if($this->award_model->checkinsertAward()){
						if ($this->award_model->insertAward($data)) {
							$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
						} else {
							$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
						}
					}
					else{
						$this->session->set_flashdata('check', 'มีของรางวัลนี้อยู่ในระบบเเล้ว !!!!');
					}
				}
			}
		 else if ($_FILES['picture']['name'] == NULL) {
			$filename = "no-image.png";
			$data = array(
				'award_name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('award_name'))),
           		 'amont_of_time' => $this->input->post('amont_of_time'),
           		 'picture' => $filename
			);
			
			if($this->award_model->checkinsertAward()){
				if ($this->award_model->insertAward($data)) {
					$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
				} else {
					$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
				}
			}
			else{
				$this->session->set_flashdata('check', 'มีของรางวัลนี้อยู่ในระบบเเล้ว !!!!');
			}
		}
	}
		redirect('award', 'refresh');
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			if ($_FILES['picture1']['name'] != NULL) {
				$config['upload_path'] = './img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2000';
				$config['max_width'] = '3000';
				$config['max_height'] = './3000/';
				$config['encrypt_name'] = TRUE;
		
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('picture1')) {
					$error = $this->upload->display_errors();
					?>
					<script language="javascript">
						var text = "<?= $error; ?>";
						alert(text);
					</script>
					<?php
				} else {
					$data = $this->upload->data();
					$filename = $data['file_name'];
					$data = array(
						'award_name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('award_name1'))),
						'picture' => $filename,
						'amont_of_time' => $this->input->post('amont_of_time1')
					);
					if($this->award_model->checkeditAward()){
						if ($this->award_model->editAwardImg($data)) {
							$this->session->set_flashdata('success', 'เเกเไขข้อมูลสำเร็จ !!!!');
						} else {
							$this->session->set_flashdata('error', 'เเกเไขข้อมูลไม่สำเร็จ !!!!');
						}
					}
					else{
						$this->session->set_flashdata('check', 'มีของรางวัลนี้อยู่ในระบบเเล้ว !!!!');
						}
					}
				}
			else {
				$data = array(
					'award_name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('award_name1'))),
            		'amont_of_time' => $this->input->post('amont_of_time1'),
				);
				if($this->award_model->checkeditAward()){
					
					if ($this->award_model->editAwardImg($data)) {
						$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
					} else {
						$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
					}
				}
				else{
						$this->session->set_flashdata('check', 'มีของรางวัลนี้อยู่ในระบบเเล้ว !!!!');
					}
				}
		}
		redirect('award','refresh');
	}
	public function delete()
	{
		if(isset($_POST['delete_id']) ){
			if($this->award_model->deleteAward()){
				$this->session->set_flashdata('success', 'ลบข้อมูลสำเร็จ !!!!');
			}
			else{
				$this->session->set_flashdata('error', 'ลบข้อมูลไม่สำเร็จ !!!!');
			}
		}
		else{
			$this->session->set_flashdata('check', 'คุณยังไม่ได้เลือกรายการที่ต้องการลบ !!!!');
		}
		redirect('award','refresh');
	}	
			
}
?>
