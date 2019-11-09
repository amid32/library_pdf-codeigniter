<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	public $user = 'user';

	public function get($where = array())
	{
		$row =  $this->db->where($where)->get($this->user)->row();
		return $row;
	}
	
}
