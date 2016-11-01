<?php
require_once(APPPATH.'third_party/class.phpmailer.php');

class M_user extends CI_Model
{
	private $details;

	function validate_user()
	{
		$useremail = $this->input->post('useremail');
		$password = $this->input->post('userpass');
		$data = array(
			'email' 		=> $useremail,
			'password'		=> md5($password),
			'status' 		=> 1
		);		

		$query = $this->db->get_where('users', $data);

		if($query->num_rows() == 1)
		{
			$this->details = $query->result()[0];
			$role = $this->getUserRole($this->details->id);

			$userdata = array(
				'id'			=> $this->details->id,
				'email'			=> $useremail,
				'role'			=> $role[0]['role_name'],
				'permissions' 	=> array()
			);

			foreach ($role as $key => $value) {

				$name = $value['role_name'];
				array_push($userdata['permissions'], $value['p_name']);
			}

			$this->details = $userdata;

			$this->set_session();

			return true;
		}


		return false;
	}	

	public function getUserRole($id)
	{
		//$this->db->select('u.email, r.name, p.display_name');    
		$this->db->select('r.name as role_name, p.name as p_name, p.display_name');    
		$this->db->from('users as u');
		$this->db->join('assigned_roles as asr', 'u.id = '.$id.' AND u.id = asr.user_id');
		$this->db->join('roles as r', 'r.id = asr.role_id');
		$this->db->join('permissions_role as pr', 'pr.role_id = asr.role_id');
		$this->db->join('permissions as p', 'p.id = pr.permission_id');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getUserGroup()
	{
		$this->db->select('u.id as userid, u.email as user_email, r.name as role, r.id as role_id');    
		$this->db->from('users as u');
		$this->db->join('assigned_roles as asr', 'u.id != 3 AND u.id = asr.user_id');
		$this->db->join('roles as r', 'r.id = asr.role_id');
		$query = $this->db->get();

		return $query->result_array();
	}


	public function getSearchResults()
	{
		$x = $this->input->post('x');
		$param = $this->input->post('search_param');

		
		switch ($param) {
			case 'all':
				$staff = $this->getStaffBy($x, 'name');
				break;

			case 'grade':
				$staff = $this->getStaffBy($x, 'grad');
				break;

			case 'division':
				$staff = $this->getStaffBy($x, 'dept');
				break;

			case 'gender':
				$staff = $this->getStaffBy($x, 'gender');
				break;

			case 'date':
				$staff = $this->getStaffBy($x, 'date_start');
				break;

			case 'daterange':
				$staff = $this->getStaffByRange($x, 'entry_date');
				break;

			default:
				$staff = array();
				break;
		}

		return $staff;
	}

	public function getStaff()
	{
		$row = $this->db->get('staff_info');
		$this->details = $row->result();

		return $this->details;
	}	

	public function getStafftoPrint()
	{		
		$this->db->select('name, position, gender, dept, course_name, grad, date_start, date_end');
		$row = $this->db->get('staff_info');
		$this->details = $row->result();

		return $this->details;
	}

	public function getStaffBy($key, $val)
	{
		$this->db->select('*');
   		$this->db->from('staff_info');
		$this->db->like($val, $key);
		$query = $this->db->get();
		$this->details = $query->result();

		return $this->details;
	}

	public function getStaffByRange($key, $val)
	{
		$pieces = explode(" ", $key);

		$this->db->select('*');
   		$this->db->from('staff_info');
   		$this->db->where($val.' >=', $pieces[0]);
		$this->db->where($val.' <=', $pieces[2]);
		$query = $this->db->get();
		$this->details = $query->result();

		return $this->details;
	}

	public function editStaff()
	{
		$this->db->where('id', $this->input->post('edit_stdid'));
		$this->db->update('staff_info', array(
				'name' 			=> $this->input->post('estaff_name'),
				'position' 		=> $this->input->post('estaff_pos'),
				'gender' 		=> $this->input->post('estaff_gender'),
				'dept' 			=> $this->input->post('estaff_dept'),
				'course_name' 	=> $this->input->post('estaff_course'),
				'grad' 			=> $this->input->post('estaff_grad'),
				'date_start' 	=> $this->input->post('estart_date'),
				'date_end' 		=> $this->input->post('eend_date')
			)
		);

		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function delStaff()
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->delete('staff_info');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	
	public function addStaff()
	{
		$data = array(
			'name' 			=> $this->input->post('staff_name'),
			'position' 		=> $this->input->post('staff_pos'),
			'gender' 		=> $this->input->post('staff_gender'),
			'dept' 			=> $this->input->post('staff_dept'),
			'course_name' 	=> $this->input->post('staff_course'),
			'grad' 			=> $this->input->post('staff_grad'),
			'date_start' 	=> $this->input->post('start_date'),
			'date_end' 		=> $this->input->post('end_date'),
			'entry_date'	=> date("Y-m-d")
		);
		
		$this->db->insert('staff_info', $data);
		
		if($this->db->affected_rows() != 1)
		{
			return false;
		}
		else
			return true;
		
	}

	public function getUser($id)
	{
		$this->db->select('id, email, status');
		$row = $this->db->get_where('users', array('id !=' => $id));
		$this->details = $row->result();

		return $this->details;
	}


	public function sendEmail()
	{
		$to = $this->input->post('staff_email');
		$from = 'info@jquery404.com';
		$email = new PHPMailer();
		$email->addReplyTo($from, 'Information');
		$email->From      = $from;		
		$email->FromName  = "E-Training";
		$email->Subject   = "E-Training";
		$email->Body      = 'Click us out .. ';
		$email->AddAddress( $to );
		$email->IsHTML(true);

		return $email->Send();
	}

	public function toggleUser()
	{
		$this->db->where('id', $this->input->post('id'));
    	$this->db->update('users', array(
		    'status' => ($this->input->post('status')=='true') ? 1 : 0
		));

		return ($this->db->affected_rows() != 1) ? false : true;

	}

	function set_session()
	{
		$this->session->sess_expiration = '1800';

		$this->session->set_userdata(array(		
			'is_logged_in' 	=> true,
			'userdata'		=> $this->details

		));
	}


}

?>
