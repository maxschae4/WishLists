<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function login()
	{
		// $this->load->model('user');
		// validate user login details
		if( !$this->user->validate_login($this->input->post()) )
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/');
		}
		// lookup user
		$user = $this->user->get_user($this->input->post());
		if($user)
		{
			$this->session->set_userdata('userinfo', $user);
			redirect('/');
		}
		// if user does not exist, send back to signin with error message.
		else
		{
			$this->session->set_flashdata('errors', 'Login details not correct');
			redirect('/');
		}
	}

	public function display_user($id)
	{
		// $this->load->model('user');
		$user = $this->user->display_user($id);
		$this->load->view('user',$user);
	}

	public function register()
	{
		// $this->load->model('user');
		// validate registration data
		if (!$this->user->validate_registration($this->input->post()) )
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/');
		}
		// add user to DB
		else
		{
			
			if($this->user->register($this->input->post()))
			{
				$user = $this->user->get_user($this->input->post());
				$this->session->set_userdata('userinfo', $user);
			}
			
		}
		redirect('/');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

	public function date_valid($date)
	{
	    $year = (int) substr($date, 0, 4);
	    $month = (int) substr($date, 5, 2);
	    $day = (int) substr($date, 8, 2);
	    if (checkdate($month, $day, $year)) 
	    {
	    	return TRUE;
	    }
	    $this->form_validation->set_message('date_valid', 'The Date Hired field must be a valid date.');
	    return FALSE;
	}
}
?>