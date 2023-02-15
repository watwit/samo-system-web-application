<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Upload extends CI_Controller {
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
			$this->load->model('listall_model');
	}

	public function index()
	{
		$inputFileName = $_FILES["fileup"]["tmp_name"];//ชื่อไฟล์ Excel ที่ต้องการอ่านข้อมูล
		$inputFileType = $_FILES["fileup"]["type"];//เช็คtype
		if ($inputFileType=='application/vnd.ms-excel' || $inputFileType=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
			$spreadsheet = IOFactory::load($inputFileName);
			$sheetData = $spreadsheet->getActiveSheet()->toArray(true, true, true,true);
			$i=1;
			$arrexcel=array();
			$arrexcel1=array();
			if ($sheetData[1]['B']=='รหัสนิสิต' &&$sheetData[1]['C']=='ชื่อ-สกุล' &&$sheetData[1]['D']=='สาขา' ) {
				foreach($sheetData as $row)
				{
					if ($i!=1) {
						$student_id     =	trim($row['B']);
						$student_name	=	mb_ereg_replace('[[:space:]]+',' ',trim($row["C"]));
						$major_code	    =	strtoupper($row["D"]);
						if ($student_id!=1 && $student_name!=1 && $major_code!=1) {
							if ($this->listall_model->checkinsertExcel($student_id,$student_name)) {
								$major_id=$this->listall_model->cvtmajor($major_code);
								if (!empty($major_id)) {
									if($this->listall_model->insertExcel($student_id,$student_name,$major_id[0]->major_id)){
										$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
									}
									else{
										$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
									}
								}
								else {
									$this->session->set_flashdata('check', 'สาขาต้องเป็น T12,T13,T14,T05,T17,T18,T19 เท่านั้น!!!!');
								}
							}
							else {
								$arrexcel[]=$i;
							}
						}
						else {
							$arrexcel1[]=$i;
						}
					}
					$i++;
				}
				if (!empty($arrexcel)) {
					$sumid=implode(" , ",$arrexcel);
					$this->session->set_flashdata('check1', "ไม่สามารถเพิ่มข้อมูลแถวที่ '".$sumid."' ได้เนื่องจากซ้ำ!!!!");
				}
				if (!empty($arrexcel1)) {
					$sumid1=implode(" , ",$arrexcel1);
					$this->session->set_flashdata('check2', "ไม่สามารถเพิ่มข้อมูลแถวที่ '".$sumid1."' ได้เนื่องจากข้อมูลไม่ครบ!!!!");
				}
			}
			else {
				$this->session->set_flashdata('check', 'แบบฟอร์มเอ็กซ์เซลล์ไม่ถูกต้อง!!!!');	
			}
		}
		else {
			$this->session->set_flashdata('check', 'นามสกุลไฟล์ไม่ถูกต้อง!!!!');
		}
		redirect('listall','refresh');
		

	}

			
}
?>




