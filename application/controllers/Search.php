<?php

class Search extends CI_Controller
{
	public function index()
	{ 
		$role = $this->session->userdata('userdata')['role'];
		$perm = $this->session->userdata('userdata')['permissions'];

		if ($this->session->userdata('is_logged_in') && in_array("search_staff", $perm)){
			$data['title'] = 'Welcome to Training';
			$data['role'] = $role;
			$data['permissions'] = $perm;
			$data['show_nav'] = true;
			$data['show_header'] = true;
			$data['body_class']= 'skin-blue sidebar-mini';
			$data['title'] = 'Admin Page';
			$data['main_content'] = 'vSearchStaff';
			$data['search_results'] = $this->session->flashdata('search_results');
			$this->load->view('include/template', $data);
		}else
			redirect('login');
	}


	public function do_search()
	{
		$role = $this->session->userdata('userdata')['role'];
		$perm = $this->session->userdata('userdata')['permissions'];

		if ($this->session->userdata('is_logged_in') && in_array("search_staff", $perm)){
			$this->load->model('m_user');
			$results = $this->m_user->getSearchResults();
			$this->session->set_flashdata('search_results', $results);

			redirect('search');
		}else
			redirect('login');
		

	}
}


?>