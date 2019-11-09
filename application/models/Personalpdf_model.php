<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Personalpdf_model extends CI_Model
{
//  function fetch()
//  {
//   $this->db->order_by('id', 'DESC');
//   return $this->db->get('person');
//  }
 function fetch_single_details($id)
 {
  $this->db->where('id', $id);
  $data = $this->db->get('person');
  $output = '<table width="100%" cellspacing="5" cellpadding="5">';
  foreach($data->result() as $row)
  {
   $output .= '
   <tr>
    <td width="25%"><img src="'.base_url().'uploads/'.$row->img_id.'" /></td>
    <td width="75%">
     <p>&nbsp;&nbsp;<b>Name : </b>'.$row->person_name.'</p>
     <p>&nbsp;&nbsp;<b>Email : </b>'.$row->email.'</p>
     <p>&nbsp;&nbsp;<b>Telephon : </b>'.$row->telephon.'</p>
     <p>&nbsp;&nbsp;<b>Departamen : </b>'.$row->departamen.'</p>
     <p>&nbsp;&nbsp;<b>Address : </b> '.$row->address.' </p>

    </td>
   </tr>
   ';
  }
  $output .= '
  <tr>
  <td><hr><br></td>
  </tr>
  <tr>
   <td colspan="2" align="center"><a href="'.base_url().'Personel" class="btn btn-primary">Back</a></td>
  </tr>
  ';
  $output .= '</table>';
  return $output;
 }
}






; ?>