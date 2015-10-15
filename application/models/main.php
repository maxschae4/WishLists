<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Model {
	
	public function display_wishes()
	{
		$id = $this->session->userdata('userinfo')['user_id'];
		$query = "SELECT items.item_id, items.name, items.created_at, items.added_by_user_id, added_by.name as username FROM items LEFT JOIN wishes on items.item_id = wishes.item_id LEFT JOIN users AS added_by on items.added_by_user_id = added_by.user_id LEFT JOIN users on wishes.user_id = users.user_id WHERE wishes.user_id = '{$id}' OR added_by_user_id = '{$id}' GROUP BY items.item_id";
		return $this->db->query($query)->result_array();
	}

	public function other_wishes($mine)
	{
		$my_wishes = array();
		foreach ($mine as $index => $wish) 
		{
			$my_wishes[] = $wish['item_id'];
		}
		$my_wishes = implode(',', $my_wishes);
		$id = $this->session->userdata('userinfo')['user_id'];
		if($my_wishes == '')
		{
			$my_wishes = "''";
		}
		$query = "SELECT items.item_id, items.name, items.created_at, added_by.name as username, added_by.user_id, wishes.wish_id FROM items LEFT JOIN wishes on items.item_id = wishes.item_id LEFT JOIN users AS added_by on items.added_by_user_id = added_by.user_id LEFT JOIN users on wishes.user_id = users.user_id WHERE items.item_id NOT IN ({$my_wishes}) GROUP BY items.item_id";
		$results = $this->db->query($query)->result_array();
		return $results;
	}

	public function validate_item($post)
	{
		$this->form_validation->set_rules('item', 'Item', 'required|min_length[3]|trim');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function add_item($post)
	{
		$query = "INSERT INTO items (name, created_at, updated_at, added_by_user_id) VALUES ('{$this->input->post("item")}', NOW(), NOW(), '{$this->session->userdata("userinfo")["user_id"]}')";
		$this->db->query($query);
	}

	public function delete_item($id)
	{
		$query = "DELETE FROM items where items.item_id = {$id}";
		$this->db->query($query);
	}

	public function add_to_wishlist($id)
	{
		$userid = $this->session->userdata('userinfo')['user_id'];
		$query = "INSERT INTO wishes (user_id, item_id) VALUES({$userid}, {$id})";
		$this->db->query($query);
	}

	public function remove_from_wishlist($id)
	{
		$userid = $this->session->userdata('userinfo')['user_id'];
		$query = "SELECT wishes.wish_id FROM wishes where wishes.item_id = {$id} AND wishes.user_id = {$userid}";
		$wishid = $this->db->query($query)->row_array();
		var_dump($wishid);
		$wishid = implode($wishid);
		$query = "DELETE FROM wishes where wishes.wish_id = {$wishid}";
		$this->db->query($query);
	}

	public function get_item($id)
	{
		$query = "SELECT name from items where item_id = {$id}";
		return $this->db->query($query)->row_array();
	}

	public function get_wishers($id)
	{
		// get wishers
		$query = "SELECT users.name from users LEFT JOIN wishes on users.user_id = wishes.user_id left join items on wishes.item_id = items.item_id where wishes.item_id = {$id}";
		$results = $this->db->query($query)->result_array();
		// get adder
		$query = "SELECT users.name FROM users LEFT JOIN items on users.user_id = items.added_by_user_id WHERE items.item_id = {$id}";
		$last_result = $this->db->query($query)->row_array();
		$results[] = $last_result;
		return $results;
	}

}
?>