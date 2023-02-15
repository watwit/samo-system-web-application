<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_user extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			$this->load->model('activity_user_model');
	}
	public function index()
	{
		if(isset($_SESSION['list_id'])){
			$data['query']=$this->activity_user_model->showdataTable();
			$data['card1']=$this->activity_user_model->showdataCard1();
			$data['card2']=$this->activity_user_model->showdataCard2();
			////no activity
			$data['card3']=$this->activity_user_model->showdataCard3();
			
			$data['dd']=$this->activity_user_model->showdata2();
			$this->load->view('user/css_activity');
			$this->load->view('user/nevba');
			$this->load->view('user/js');
			$this->load->view('user/activity_view',$data);
		}
		else{
			redirect('calendar','refresh');
		}
	}
	public function showTableModal()
	{
		if(isset($_POST['award_id']) and !empty($this->input->post('award_id'))){
			$data['query']=$this->activity_user_model->showTableModalModel();
			$data['query1']=$this->activity_user_model->showTableAward_timeModel();
			$data['query2']=$this->activity_user_model->showTableAward_time_inModel();
			$data['query3']=$this->activity_user_model->showTableAward_time_allModel();
			$output = '';
			$output .='<div class="text-center m-1">';
			$output .='<p class="col-md-6 col-12 " style="font-size: 20px;display: inline;">ต้องเข้าร่วมกิจกรรมด้านล่างอย่างน้อย <span class="badge badge-primary">'.number_format( $data['query1'][0]->amont_of_time , 2 ).' %</span></p>';
			if(count($data['query2'])>0 && count($data['query3'])>0 ){
				$result = (((int) $data['query2'][0]->time_in)) / ((int) $data['query3'][0]->time_all_activity) * 100;
				$output .='<p class="col-md-6 col-12 " style="font-size: 20px;display: inline;">นิสิตเข้าร่วมกิจกรรมไปเเล้ว <span class="badge badge-primary">'.number_format( $result , 2 ).' %</span></p>';
			}
			else{
				$output .='<p class="col-md-6 col-12 " style="font-size: 20px;display: inline;">นิสิตเข้าร่วมกิจกรรมไปเเล้ว <span class="badge badge-primary">0.00 %</span></p>';
			}
			
			$output .='</div>';
			$output .= '<table id="datatable" class="table table-striped table-bordered text-center">
			
			<tr>
				<th bgcolor="#A4EADA" scope="col">ลำดับ</th>
				<th bgcolor="#A4EADA" scope="col">กำหนดการ</th>
				<th bgcolor="#A4EADA" scope="col">ชื่อกิจกรรม</th>
				<th bgcolor="#A4EADA" scope="col">จำนวนชั่วโมงที่ได้รับ</th>
				<th bgcolor="#A4EADA" scope="col">สถานะ</th>
			</tr>';
			$i = 1;
			foreach ($data['query'] as $row){
				$activity_id = $row->activity_id;
				$date = $row->date;
				$activity_name = $row->activity_name;
				$time = $row->amont_of_time;
				$checkactivity =  $row->checkactivity;
                $output .= '<tr>
				<td>'.$i++.'</td>
				<td>'.$date.'</td>
				<td>'.$activity_name.'</td>
				<td>'.$time.'</td>
				<td>'.$checkactivity.'</td>
			    </tr>';
				
			}
			$output .= '</table>';

			echo $output;
			exit;
		}
		else{
			redirect('calendar', 'refresh');
		}
	}			
}
?>
