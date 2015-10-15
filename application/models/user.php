<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
	public function validate_login($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|md5');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function validate_registration($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules("username", 'Username', "trim|required|min_length[3]");
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|trim|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', 'Confirm Password', 'required|trim');
		$this->form_validation->set_rules('hire_date','Hire Date','callback_date_valid');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function register($userinfo)
	{
		$query = "INSERT INTO users (name, username, email, password, created_at, updated_at, hire_date) VALUES (?,?,?,?,NOW(),NOW(),?)";
		$values = array(
					$userinfo['name'],$userinfo['username'],$userinfo['email'],$userinfo['password'],$userinfo['hire_date']
					);
		return $this->db->query($query,$values);
	}

	public function get_user($userinfo)
	{
		$query = "SELECT username, user_id  FROM users WHERE username = ? AND password = ?";
		$values = array(
					$userinfo['username'],
					$userinfo['password']
					);
		$result = $this->db->query($query,$values)->row_array();
		return $result;
	}
}
?>