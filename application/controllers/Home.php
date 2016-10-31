<?php
require_once(APPPATH.'third_party/fpdf.php');


class Home extends CI_Controller
{
	
	public function index()
	{ 
		$role = $this->session->userdata('userdata')['role'];

		if ($this->session->userdata('is_logged_in'))
		{
			$data['title'] = 'Welcome to Training';
			$data['role'] = $role;
			$data['permissions'] = $this->session->userdata('userdata')['permissions'];
			$data['show_nav'] = true;
			$data['show_header'] = true;
			$data['body_class']= 'skin-blue sidebar-mini';			
			$data['main_content'] = 'vLandingPage';
			$data['error'] = $this->session->flashdata('error');
			$data['dashboard'] = true;
			$this->load->view('include/template', $data);
		}else
			redirect('login');
	}

	public function add()
	{
		$role = $this->session->userdata('userdata')['role'];
		$perm = $this->session->userdata('userdata')['permissions'];

		if ($this->session->userdata('is_logged_in') && in_array("add_staff", $perm)){
			$this->load->model('m_user');

			$data['title'] = 'Welcome to Training';
			$data['role'] = $role;
			$data['show_nav'] = true;
			$data['show_header'] = true;	
			$data['permissions'] = $perm;	
			if(in_array("read_staff", $perm))
				$data['staff_list'] = $this->m_user->getStaff();
			$data['body_class']= 'skin-blue sidebar-mini';
			$data['title'] = 'Admin Page';
			$data['main_content'] = 'vAddStaff';
			$this->load->view('include/template', $data);
		}else
			redirect('login');

	}

	public function addStaff()
	{
		$role = $this->session->userdata('userdata')['role'];
		$perm = $this->session->userdata('userdata')['permissions'];

		if ($this->session->userdata('is_logged_in') && in_array("add_staff", $perm))
		{			
			$this->form_validation->set_rules('staff_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('staff_pos', 'Position', 'trim|required');
			$this->form_validation->set_rules('staff_gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('staff_dept', 'Dept', 'trim|required');
			$this->form_validation->set_rules('staff_course', 'Course', 'trim|required');
			$this->form_validation->set_rules('staff_grad', 'Grad', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End date', 'trim|required');

			if($this->form_validation->run() == FALSE)
			{							
				$data = array(				
					'status' => 0,
					'err_msg' => validation_errors('<p class="error">')
				);
				
				$this->session->set_flashdata('status', 'Staff Added!');
			}
			else
			{
				$this->load->model('m_user');
				$query = $this->m_user->addStaff();
				if($query)
					$this->session->set_flashdata('status', 'Staff Added!');
				else 
					$this->session->set_flashdata('status', 'Error occured');

				redirect('home/add');
			}
		}else
			redirect('login');
	}

	public function edit()
	{
		if ($this->session->userdata('is_logged_in')){
			$this->form_validation->set_rules('estaff_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('estaff_pos', 'Position', 'trim|required');
			$this->form_validation->set_rules('estaff_gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('estaff_dept', 'Dept', 'trim|required');
			$this->form_validation->set_rules('estaff_course', 'Course', 'trim|required');
			$this->form_validation->set_rules('estaff_grad', 'Grad', 'trim|required');
			$this->form_validation->set_rules('estart_date', 'Start date', 'trim|required');
			$this->form_validation->set_rules('eend_date', 'End date', 'trim|required');

			if($this->form_validation->run() == FALSE)
			{

				$data = array(				
					'status' => 0,
					'err_msg' => validation_errors()
				);
			
				echo json_encode($data);
			}
			else
			{
				$this->load->model('m_user');
				$query = $this->m_user->editStaff();
				if($query)
				{
					$data = array(				
						'status' => 1,
						'msg' => 'Successfully changed'
					);
					echo json_encode($data);
				}
				else
				{
					$data = array(				
						'status' => 0,
						'err_msg' => 'Error occured' 
					);
					echo json_encode($data);
				}
			}
		}else
			redirect('login');	
	}

	public function del()
	{
		if ($this->session->userdata('is_logged_in')){
			$this->form_validation->set_rules('id', 'id', 'trim|required');

			if($this->form_validation->run() == FALSE)
			{

				$data = array(				
					'status' => 0,
					'err_msg' => validation_errors('<p class="error">')
				);
			
				echo json_encode($data);
			}
			else
			{
				$this->load->model('m_user');
				$query = $this->m_user->delStaff();
				if($query)
				{
					$data = array(				
						'status' => 1,
						'msg' => 'Successfully deleted'
					);
					echo json_encode($data);
				}
				else
				{
					$data = array(				
						'status' => 0,
						'err_msg' => 'Error occured' 
					);
					echo json_encode($data);
				}
			}
		}else
			redirect('login');
	}

	public function printing()
	{
		$role = $this->session->userdata('userdata')['role'];
		$perm = $this->session->userdata('userdata')['permissions'];

		if ($this->session->userdata('is_logged_in') && in_array("print_staff", $perm)){
			$this->load->model('m_user');
			$staff_list = $this->m_user->getStafftoPrint();
			$header = array('Name', 'Position', 'Gender', 'Dept.', 'Course', 'Grad', 'Start Date', 'End Date');
			
			$pdf = new FPDF();
            $pdf->SetFont('Arial','B',10);
            $pdf->AddPage();
		    $pdf->Cell(80);
		    $pdf->Cell(30,10,'Staff List',1,0,'C');
		    $pdf->Ln(15);

			foreach($header as $col)
	        	$pdf->Cell(24,7,$col,1);
		    $pdf->Ln();
			$pdf->SetFont('Arial','',10);
		    foreach($staff_list as $row)
		    {
	    	
				foreach($row as $key=>$col)
				{
					if($key!='id')
						$pdf->Cell(24,6,$col,1);
				}
		        $pdf->Ln();
		    			        
		    }

		    $pdf->Output();
		    

		}else
			redirect('login');
		
	}

	public function invite_user()
	{
		$role = $this->session->userdata('userdata')['role'];
		$perm = $this->session->userdata('userdata')['permissions'];

		if ($this->session->userdata('is_logged_in') && in_array("invite_user", $perm)){
			$data['title'] = 'Welcome to Training';
			$data['role'] = $role;
			$data['error'] = $this->session->flashdata('error');
			$data['status'] = $this->session->flashdata('status');
			$data['show_nav'] = true;
			$data['show_header'] = true;	
			$data['permissions'] = $perm;
			$data['body_class']= 'skin-blue sidebar-mini';
			$data['title'] = 'Admin Page';
			$data['main_content'] = 'vInviteStaff';
			$this->load->view('include/template', $data);
		}else
			redirect('login');

	}

	public function send_invite()
	{
		$role = $this->session->userdata('userdata')['role'];
		$perm = $this->session->userdata('userdata')['permissions'];

		if ($this->session->userdata('is_logged_in') && in_array("invite_user", $perm)){

			$this->form_validation->set_rules('staff_email', 'Email', 'trim|required|valid_email');

			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_flashdata('error', validation_errors('<p class="error">'));
				redirect('home/invite_user');
			}
			else
			{
				$this->load->model('m_user');
				$query = $this->m_user->sendEmail();


				if($query)
					$this->session->set_flashdata('status', 'Staff invited!');
				else 
					$this->session->set_flashdata('status', 'Error occured');

				redirect('home/invite_user');

			}

		}
		
	}

	public function user_toggle()
	{
		$role = $this->session->userdata('userdata')['role'];
		$perm = $this->session->userdata('userdata')['permissions'];

		
		if ($this->session->userdata('is_logged_in') && in_array("toggle_user", $perm)){
			$this->load->model('m_user');

			$data['title'] = 'Welcome to Training';
			$data['role'] = $role;
			$data['error'] = $this->session->flashdata('error');
			$data['user_list'] = $this->m_user->getUser($this->session->userdata('userdata')['id']);
			$data['show_nav'] = true;
			$data['show_header'] = true;	
			$data['permissions'] = $perm;
			$data['body_class']= 'skin-blue sidebar-mini';
			$data['title'] = 'Admin Page';
			$data['main_content'] = 'vToggleUser';
			$this->load->view('include/template', $data);
		}else
			redirect('login');

	}

	public function toggleUser()
	{
		$role = $this->session->userdata('userdata')['role'];
		$perm = $this->session->userdata('userdata')['permissions'];

		
		if ($this->session->userdata('is_logged_in') && in_array("toggle_user", $perm)){
			$this->load->model('m_user');

			$query = $this->m_user->toggleUser();
			if($query)
			{
				$data = array(				
					'status' => 1,
					'msg' => 'Successfully changed'
				);
				echo json_encode($data);
			}
			else
			{
				$data = array(				
					'status' => 0,
					'err_msg' => 'Error occured' 
				);
				echo json_encode($data);
			}
		}
	}

	

}

?>