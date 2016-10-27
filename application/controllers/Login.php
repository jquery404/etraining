<?php
class Login extends CI_Controller
{
  	public function index()
  	{
  		if(!$this->session->userdata('is_logged_in'))
  		{
  			$data['title'] = 'Admin Login';
  			$data['main_content'] = 'vLogin';
        $data['body_class']= 'hold-transition login-page';
        $data['no_footer']= 'true';
        $data['invalid_login'] = $this->session->flashdata('invalid_login');
  			$this->load->view('include/template', $data);
  		}
  		else
        redirect('home');     
     
  	}

  	public function validlogin()
  	{
  		$this->form_validation->set_rules('useremail', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('userpass', 'Password', 'trim|required');


  		if($this->form_validation->run() == TRUE)
  		{
        $this->load->model('m_user');
        if($this->m_user->validate_user())
        {
          redirect('home');
        }
        else
        {
          $this->session->set_flashdata('invalid_login','ERROR: Invalid Email or Password. Please try Again.');
          redirect('login');
        }
  		}
  		else{
        $this->session->set_flashdata('invalid_login','ERROR:'.validation_errors());
        $this->index();
      }

  	}

  	public function validlogins()
  	{
  		$this->form_validation->set_rules('username', 'Username', 'trim|required');
  		$this->form_validation->set_rules('password', 'Password', 'trim|required');

  		if($this->form_validation->run() == TRUE)
  		{
  			$this->load->model('m_user');
  			if($this->m_user->validate_user())
  			{
  				redirect('admin');
  			}
  			else
  				redirect('login');
  		}
  		else
  			$this->index();

  	}

  	function logout()
  	{
  		$this->session->sess_destroy();
  		redirect('login');
  	}
}

?>
