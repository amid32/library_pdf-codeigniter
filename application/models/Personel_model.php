<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personel_model extends  CI_Model
{
	public $perso = 'person';


	public function get_all(){
		$result = $this->db->get($this->perso)->result();
		return $result;

	}

	public  function  get($where)
	{
		$row = $this->db->where($where)->get($this->perso)->row();
		return $row;

	}

	public  function  insert($data)
	{
     $insert =  $this->db->insert($this->perso, $data);
     return $insert;
	}

	public function  update($where, $data)
	{
		$update =  $this->db->where($where)->update($this->perso, $data);
		return $update;
	}

	public function delete($where)
	{
     $delete = $this->db->where($where)->delete($this->perso);
     return $delete;
	}

	public function  order_by($field, $order)
	{
		$order = $this->db->order_by($field, $order)->get($this->perso)->result();
		return $order;
	}
}
