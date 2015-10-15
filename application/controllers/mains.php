<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mains extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		// if user exists but is not admin, send to user dashboard
		if(null !== $this->session->userdata('userinfo'))
		{
			redirect('dashboard');
		}	
		// if user is not logged in:
		else
		{	
			$this->load->view('index');
		}
	}

	public function show_dashboard()
	{
		$wishes = $this->main->display_wishes();
		$otherwishes = $this->main->other_wishes($wishes);
		$data = array('my_wishes' => $wishes, 'other_wishes' => $otherwishes);
		$this->load->view('dashboard', $data);
	}

	public function new_item()
	{
		$this->load->view('new_item');
	}

	public function create_item()
	{
		if($this->main->validate_item($this->input->post()))
		{
			$this->main->add_item($this->input->post());
			redirect('/');
		}
		else
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/items/new');
		}
	}

	public function delete_item($id)
	{
		$this->main->delete_item($id);
		redirect('/');
	}

	public function add_to_wishlist($id)
	{
		$this->main->add_to_wishlist($id);
		redirect('/');
	}

	public function remove($id)
	{
		$this->main->remove_from_wishlist($id);
		redirect('/');
	}

	public function view_item($id)
	{
		$item = $this->main->get_item($id);
		$wishers = $this->main->get_wishers($id);
		$this->load->view('view_item', array('item' => $item, 'wishers' => $wishers));
	}
}
