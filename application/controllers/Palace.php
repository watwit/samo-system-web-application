<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Palace extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			if(isset($_SESSION['namenewactivity_id'])){
				unset($_SESSION['namenewactivity_id']);
			   }
			if(isset($_SESSION['activity_id'])){
				unset($_SESSION['activity_id']);
			}
			if( !isset($_SESSION['user_id'] ) ){
				redirect('','refresh'); 
			}
			$this->load->model('palace_model');
	}

	public function index()
	{
		$data['groups'] = $this->palace_model->getAllGroups();
		$data['query']=$this->palace_model->showdata();
		$this->load->view('admin/css');
		$this->load->view('admin/js');
		$this->load->view('admin/palace_view',$data);
	}
	public function insert()
	{
			
		if(isset($_POST['submit'])){
			if($_FILES['picture']['name']!=NULL && $this->input->post('rank')=='24'){
				if($this->palace_model->checkinsertother() && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='นายก' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='รองนายก' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='เลขา' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='เหรัญญิก' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='สันทนาการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='บุคคล' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='สถานที่' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='จัดซื้อ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='ระเบียบ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='พยาบาล' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='สวัสดิการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='วิชาการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='สรุปโครงการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='ประชาสัมพันธ์'){
					$config['upload_path'] = './img/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '2000';
					$config['max_width'] = '3000';
					$config['max_height'] = './3000/';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('picture')) {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('check', $error);
					} 
					else {
						$data = $this->upload->data();
						$filename = $data['file_name'];
						$data = array(
							'student_id' => $this->input->post('student_id'),
							// 'sex' => $this->input->post('sex'),
							'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname'))),
							'major_id' => (int)$this->input->post('major'),
							'rank' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother'))),
							'picture' => $filename
						);
						if($this->palace_model->insertPalace($data)){
							$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
						}
						else{
							$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
						}
					}
				}
				else{
					$this->session->set_flashdata('check', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่ง !!!!');
				}
			}
			else if($_FILES['picture']['name']!=NULL && $this->input->post('rank')!='24'){
				//////////////////////////////////////////
				if ($this->input->post('rank')=='11') {
					if($this->palace_model->checkinsert11() &&  $this->palace_model->checkinsertname()){
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
							$this->session->set_flashdata('check', $error);
						}
						else {
							$data = $this->upload->data();
							$filename = $data['file_name'];
							$data = array(
								'student_id' => $this->input->post('student_id'),
								// 'sex' => $this->input->post('sex'),
								'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname'))),
								'major_id' => (int)$this->input->post('major'),
								'rank' => $this->input->post('rank'),
								'picture' => $filename
							);
							if($this->palace_model->insertPalace($data)){
								$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
							}
							else{
								$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
							}
						}
					}
					else{
						$this->session->set_flashdata('check', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่งซ้ำ !!!!');
					}
					/////////////////////////////////////////
				}
				else {
					if($this->palace_model->checkinsert()){
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
							$this->session->set_flashdata('check', $error);
						} 
						else {
							$data = $this->upload->data();
							$filename = $data['file_name'];
							$data = array(
								'student_id' => $this->input->post('student_id'),
								// 'sex' => $this->input->post('sex'),
								'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname'))),
								'major_id' => (int)$this->input->post('major'),
								'rank' => $this->input->post('rank'),
								'picture' => $filename
							);
							if($this->palace_model->insertPalace($data)){
								$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
							}
							else{
								$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
							}
						}
					}
					else{
						$this->session->set_flashdata('check', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่งซ้ำ !!!!');
					}
				}
			}
			else if ($_FILES['picture']['name']==NULL && $this->input->post('rank')=='24') {
				if($this->palace_model->checkinsertother() && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='นายก' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='รองนายก' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='เลขา' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='เหรัญญิก' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='สันทนาการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='บุคคล' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='สถานที่' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='จัดซื้อ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='ระเบียบ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='พยาบาล' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='สวัสดิการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='วิชาการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='สรุปโครงการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother')))!='ประชาสัมพันธ์'){
					$filename="no-image.png";
					$data = array(
						'student_id' => $this->input->post('student_id'),
						// 'sex' => $this->input->post('sex'),
						'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname'))),
						'major_id' => (int)$this->input->post('major'),
						'rank' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother'))),
						'picture' => $filename
					);
					if($this->palace_model->insertPalace($data)){
						$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
					}
					else{
						$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
					}
				}
				else{
					$this->session->set_flashdata('check', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่ง !!!!');
				}
			}
			else{
				/////////////////////////////
				if ($this->input->post('rank')=='11') {
					if($this->palace_model->checkinsert11() && $this->palace_model->checkinsertname()){
						$filename="no-image.png";
						$data = array(
							'student_id' => $this->input->post('student_id'),
							// 'sex' => $this->input->post('sex'),
							'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname'))),
							'major_id' => (int)$this->input->post('major'),
							'rank' => $this->input->post('rank'),
							'picture' => $filename
						);
						if($this->palace_model->insertPalace($data)){
							$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
						}
						else{
							$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
						}
					}
					else{
						$this->session->set_flashdata('check', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่งซ้ำ !!!!');
					}
				}
				////////////////////////////////////
				else {
					if($this->palace_model->checkinsert()){
						$filename="no-image.png";
						$data = array(
							'student_id' => $this->input->post('student_id'),
							// 'sex' => $this->input->post('sex'),
							'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname'))),
							'major_id' => (int)$this->input->post('major'),
							'rank' => $this->input->post('rank'),
							'picture' => $filename
						);
						if($this->palace_model->insertPalace($data)){
							$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
						}
						else{
							$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
						}
					}
					else{
						$this->session->set_flashdata('check', 'ไม่สามารถเพิ่มข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่งซ้ำ !!!!');
					}
				}
			}
		}
		redirect('palace','refresh');
	}
	public function edit()
	{

		if(isset($_POST['submit'])){
			if($_FILES['picture1']['name']!=NULL && $this->input->post('rank1')=='24'){
				if($this->palace_model->checkeditother() && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='นายก' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='รองนายก' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='เลขา' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='เหรัญญิก' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='สันทนาการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='บุคคล' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='สถานที่' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='จัดซื้อ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='ระเบียบ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='พยาบาล' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='สวัสดิการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='วิชาการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='สรุปโครงการ' && mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1')))!='ประชาสัมพันธ์'){
					$config['upload_path'] = './img/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '2000';
					$config['max_width'] = '3000';
					$config['max_height'] = './3000/';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('picture1')) {
						//echo $this->upload->display_errors();
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('check', $error);
					} 
					else {
						$data = $this->upload->data();
						$filename = $data['file_name'];
						$data = array(
							'student_id' => $this->input->post('student_id1'),
							// 'sex' => $this->input->post('sex1'),
							'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1'))),
							'major_id' => (int)$this->input->post('major1'),
							'rank' => trim($this->input->post('rankother1')),
							'picture' => $filename
						);
						if($this->palace_model->editPalace($data)){
							$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
						}
						else{
							$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
						}
					}
				}
				else{
					$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไขข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่ง !!!!');
				}
			}
			else if($_FILES['picture1']['name']!=NULL && $this->input->post('rank1')!='24'){
				////////////////////////////////////////
				if ($this->input->post('rank1')=='11') {
					if($this->palace_model->checkedit11() && $this->palace_model->checkedittname()){
						$config['upload_path'] = './img/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size'] = '2000';
						$config['max_width'] = '3000';
						$config['max_height'] = './3000/';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('picture1')) {
							//echo $this->upload->display_errors();
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('check', $error);
						}
						else {
							$data = $this->upload->data();
							$filename = $data['file_name'];
							$data = array(
								'student_id' => $this->input->post('student_id1'),
								// 'sex' => $this->input->post('sex1'),
								'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1'))),
								'major_id' => (int)$this->input->post('major1'),
								'rank' => $this->input->post('rank1'),
								'picture' => $filename
							);
							if($this->palace_model->editPalace($data)){
								$this->session->set_flashdata('success', 'เเก้ไขมูลสำเร็จ !!!!');
							}
							else{
								$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
							}
						}
					}
					else{
						$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไขข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่งซ้ำ !!!!');
					}
					//////////////////////////////////////////////////
				}
				else {
					if($this->palace_model->checkedit()){
						$config['upload_path'] = './img/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size'] = '2000';
						$config['max_width'] = '3000';
						$config['max_height'] = './3000/';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('picture1')) {
							//echo $this->upload->display_errors();
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('check', $error);
						} 
						else {
							$data = $this->upload->data();
							$filename = $data['file_name'];
							$data = array(
								'student_id' => $this->input->post('student_id1'),
								// 'sex' => $this->input->post('sex1'),
								'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1'))),
								'major_id' => (int)$this->input->post('major1'),
								'rank' => $this->input->post('rank1'),
								'picture' => $filename
							);
							if($this->palace_model->editPalace($data)){
								$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
							}
							else{
								$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
							}
						}
					}
					else{
						$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไขข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่งซ้ำ !!!!');
					}
				}
			}
			else if ($_FILES['picture1']['name']==NULL && $this->input->post('rank1')=='24') {
				if($this->palace_model->checkeditother() && $this->input->post('rankother1')!='นายก' && $this->input->post('rankother1')!='รองนายก' && $this->input->post('rankother1')!='เลขา' && $this->input->post('rankother1')!='เหรัญญิก' && $this->input->post('rankother1')!='สันทนาการ' && $this->input->post('rankother1')!='บุคคล' && $this->input->post('rankother1')!='สถานที่' && $this->input->post('rankother1')!='จัดซื้อ' && $this->input->post('rankother1')!='ระเบียบ' && $this->input->post('rankother1')!='พยาบาล' && $this->input->post('rankother1')!='สวัสดิการ' && $this->input->post('rankother1')!='วิชาการ' && $this->input->post('rankother1')!='สรุปโครงการ' && $this->input->post('rankother1')!='ประชาสัมพันธ์'){
					$data = array(
						'student_id' => $this->input->post('student_id1'),
						// 'sex' => $this->input->post('sex1'),
						'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1'))),
						'major_id' => (int)$this->input->post('major1'),
						'rank' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('rankother1'))),
					);
					if($this->palace_model->editPalace($data)){
						$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
					}
					else{
						$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
					}
				}
				else{
					$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไขข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่ง !!!!');
				}
			}
			else{
				if ($this->input->post('rank1')=='11') {
					/////////////////////////////////
					if($this->palace_model->checkedit11() && $this->palace_model->checkedittname()){
						$data = array(
							'student_id' => $this->input->post('student_id1'),
							// 'sex' => $this->input->post('sex1'),
							'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1'))),
							'major_id' => (int)$this->input->post('major1'),
							'rank' => $this->input->post('rank1'),
						);
						if($this->palace_model->editPalace($data)){
							$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
						}
						else{
							$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
						}
					}
					else{
						$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไขข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่งซ้ำ !!!!');
					}
					//////////////////////////////////
				}
				else {
					if($this->palace_model->checkedit()){
						$data = array(
							'student_id' => $this->input->post('student_id1'),
							// 'sex' => $this->input->post('sex1'),
							'name' => mb_ereg_replace('[[:space:]]+','',trim($this->input->post('fname1')))." ".mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('lname1'))),
							'major_id' => (int)$this->input->post('major1'),
							'rank' => $this->input->post('rank1'),
						);
						if($this->palace_model->editPalace($data)){
							$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
						}
						else{
							$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
						}
					}
					else{
						$this->session->set_flashdata('check', 'ไม่สามารถเเก้ไขข้อมูลได้เนื่องจาก รหัสนิสิตหรือชื่อซ้ำหรือตำแหน่งซ้ำ !!!!');
					}
				}
			}
		}
		redirect('palace','refresh');	
	}
	public function delete()
	{
		//print_r($_POST);
		if(isset($_POST['deletepalace_id'])){
				if($this->palace_model->deletePalace()){
					$this->session->set_flashdata('success', 'ลบข้อมูลสำเร็จ !!!!');
				}
				else{
					$this->session->set_flashdata('error', 'ลบข้อมูลไม่สำเร็จ !!!!');
				}
			}
			else{
				$this->session->set_flashdata('check', 'คุณยังไม่ได้เลือกรายการที่ต้องการลบ !!!!');
			}
		redirect('palace','refresh');
	}

			
}
?>