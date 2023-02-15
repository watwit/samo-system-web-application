<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (isset($_SESSION['shop_id'])) {
			unset($_SESSION['shop_id']);
			// print_r($_SESSION);
		}
		if (!isset($_SESSION['user_id'])) {
			redirect('login', 'refresh');
		}
		if (isset($_SESSION['namenewactivity_id'])) {
			$_SESSION['namenewactivity_id'] = null;
			$_SESSION['namenewactivity_name'] = null;
			$_SESSION['namenewactivity_date'] = null;
		}
		$this->load->model('Shop_model');
	}

	public function index()
	{
		$data['query'] = $this->Shop_model->showdata();
		$data['sta'] = $this->Shop_model->showStatus();
		$this->load->view('admin/css');
		$this->load->view('admin/js');
		$this->load->view('admin/Shop_view', $data);
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
						'name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('name'))),
						'price' => trim($this->input->post('price')),
						'detail' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('detail'))),
						'status' => $this->input->post('status'),
						'pic' => $filename
					);
					if ($this->Shop_model->insertShop($data)) {
						$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
					} else {
						$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
					}
				}
			}
		 else if ($_FILES['picture']['name'] == NULL) {
			$filename = "no-image.png";
			$data = array(
				'name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('name'))),
				'price' => trim($this->input->post('price')),
				'detail' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('detail'))),
				'status' => $this->input->post('status'),
				'pic' => $filename
			);
			if ($this->Shop_model->insertShop($data)) {
				$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
			} else {
				$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
			}
		}
	}
		redirect('Shop', 'refresh');
	}

	public function editStatus()
	{
		if (isset($_POST['submit'])) {
            $data = array(
                'shopstatus' => $this->input->post('shopstatus1'),
			);
			if ($this->Shop_model->editStatusShop($data)) {
				$this->session->set_flashdata('success', 'สถานะถูกแก้ไข !!!!');
			} else {
				$this->session->set_flashdata('error', 'สถานะไม่ถูกแก้ไข !!!!');
			}
		}
		redirect('Shop', 'refresh');
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
						'name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('name1'))),
						'price' => $this->input->post('price1'),
						'detail' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('detail1'))),
						'status' => $this->input->post('status1'),
						'pic' => $filename
					);
					if ($this->Shop_model->editShopImg($data)) {
						$this->session->set_flashdata('success', 'เพิ่มข้อมูลสำเร็จ !!!!');
					} else {
						$this->session->set_flashdata('error', 'เพิ่มข้อมูลไม่สำเร็จ !!!!');
					}
				}
			} else {
				$data = array(
					'name' => mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('name1'))),
					'price' => $this->input->post('price1'),
					'detail' =>mb_ereg_replace('[[:space:]]+',' ',trim($this->input->post('detail1'))),
					'status' => $this->input->post('status1'),
				);
				if ($this->Shop_model->editShopImg($data)) {
					$this->session->set_flashdata('success', 'เเก้ไขข้อมูลสำเร็จ !!!!');
				} else {
					$this->session->set_flashdata('error', 'เเก้ไขข้อมูลไม่สำเร็จ !!!!');
				}
			}
		}
		redirect('Shop','refresh');
	}
	public function delete()
	{
		if(isset($_POST['delete_id']) ){
			if($this->Shop_model->deleteShop()){
				$this->session->set_flashdata('success', 'ลบข้อมูลสำเร็จ !!!!');
			}
			else{
				$this->session->set_flashdata('error', 'ลบข้อมูลไม่สำเร็จ !!!!');
			}
		}
		else{
			$this->session->set_flashdata('check', 'คุณยังไม่ได้เลือกรายการที่ต้องการลบ !!!!');
		}
		redirect('shop','refresh');
	}	
}
?>