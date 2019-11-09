<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personel extends  CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('Personel_model');
		$this->load->model('Personalpdf_model');
		$this->load->library('pdf');
		$user = $this->session->userdata("user");
		if(!$user){
			redirect(base_url($user));
		}
	}

	//======================//Verilenler bazasinnan verileri getirir//=========================//
	public  function  index(){
    $list = $this->Personel_model->get_all();
    $viewData["list"] = $list;
  	$this->load->view("personel_list",$viewData);
  }


  public  function insert_form()
  {
  	$this->load->view('insert_form');
  }

  //====================//verilenler bazasina qeydetmek//================================//
  public  function insert()
  {
      $person_name   = $this->input->post('person_name');
	  $email         = $this->input->post('email');
	  $telephon      = $this->input->post('telephon');
	  $address       = $this->input->post('address');
	  $departamen    = $this->input->post('departamen');
	  $img_id        = $_FILES["img_id"]["name"];

	  if($person_name && $email && $telephon && $address && $departamen && $img_id ){
	  	$config["upload_path"] = "uploads/";
	  	$config["allowed_types"] = "gif|jpg|jpeg|png";
	  	$this->load->library("upload", $config);
	  	if ($this->upload->do_upload("img_id")) {
			$img_id = $this->upload->data("file_name");
			$data = array(
				"person_name" => $person_name,
				"email " => $email,
				"telephon" => $telephon,
				"address" => $address,
				"departamen" => $departamen,
				"img_id" => $img_id
			);
			$insert = $this->Personel_model->insert($data);


			if ($insert) {
				$alert = array(
					'title' => 'Emeliyyat Ugurludur',
					'message' => 'Ugurlu Elave olundu... ',
					'type' => 'success'
				);

			}else {

				$alert = array(
					'title' => 'Emeliyyat Ugursuzdur',
					'message' => 'Ugursuz Elave olunmadi... ',
					'type' => 'danger'
				);
			}
			}else{
	  		//resim yuklenirken bir problem olusdu

			$alert = array(
				'title' => 'Emeliyyat Ugursuzdur',
				'message' => 'Foto yuklenerken bir problem oludu... ',
				'type' => 'danger'
			);
		}

	  }else{
	  	//Lutfen resim secin
		  $alert = array(
			  'title' => 'Emeliyyat Ugursuzdur',
			  'message' => 'Bos xanaburaxmayin!!... ',
			  'type' => 'danger'
		  );

	  }
	  $this->session->set_flashdata('alert',$alert);
	  redirect(base_url("personel"));
  }


  //========================//Verilenler bazasinnan verileri getirir yenilemekucun//===============//
  public  function update_form($id)
  {
	 $where= array("id" => $id);
	  $row = $this->Personel_model->get($where);
	  $viewData["row"] = $row;
     $this->load->view("update_form", $viewData);
  }


  //========================//Verilenler bazasinnan verileri getirir yenilemekucun//===============//


  //==========================//verilenler bazasini yenilenmesi//====================================//

  public  function update($id)
  {
	    $img       = $_FILES["img_id"]["name"];

  	if ($img){
  		$config["upload_path"] = "uploads/";
		$config["allowed_types"] = "gif|jpg|jpeg|png";

		$this->load->library("upload",$config);
		$upload = $this->upload->do_upload("img_id");
		if($upload){

			$data = array(
				"person_name"  => $this->input->post('person_name'),
				"email "       => $this->input->post('email'),
				"telephon"     => $this->input->post('telephon'),
				"address"      => $this->input->post('address'),
				"departamen"   => $this->input->post('departamen'),
				"img_id"       => $this->upload->data('file_name')
			);
			//=====image silime=====//
			$url= './uploads/'.$this->input->post("current_image");
			if (file_exists($url)) {unlink($url);}
			//=====image silime=====//
			
			//===================//istenilen olcu//========================//
			$image_data = $this->upload->data();
			$this->load->library('image_lib');
			$configer = array(
				'image_library'   => 'gd2',
				'source_image'    => $image_data['full_path'],
				'maintain_ratio'  => TRUE,
				'width'           => 280,
				'height'          => 250, );
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
			//===================//istenilen olcu//========================//

		}else{

			//Upload emeliyyatinda bir xeta bashverdi
			echo "";
			$alert = array(
				'title' => 'Emeliyyat Ugursuzdur',
				'message' => 'Upload emeliyyatinda bir xeta bashverdi... ',
				'type' => 'danger'
			);
		}
	}else{
        //yeni bir foto yuklemediyse silme
		$data = array(
			"person_name"  => $this->input->post('person_name'),
			"email "       => $this->input->post('email'),
			"telephon"     => $this->input->post('telephon'),
			"address"      => $this->input->post('address'),
			"departamen"   => $this->input->post('departamen'),
		);
	}
	  $where = array("id" => $id);

	  $update = $this->Personel_model->update($where,$data);
	  if ($update) {
		  $alert = array(
			  'title' => 'Emeliyyat Ugurludur',
			  'message' => 'Upload emeliyyatiugurludur... ',
			  'type' => 'success'
		  );

	  }else {
		  $alert = array(
			  'title' => 'Emeliyyat Ugursuz',
			  'message' => 'Upload emeliyyatiugurludur Yenilenme Ugursuz... ',
			  'type' => 'success'
		  );
	  }
	  $this->session->set_flashdata('alert',$alert);
	  redirect(base_url("personel"));
  }

//==========================//verilenler bazasini yenilenmesi//====================================//


//========================================//pdf file//=============================================//

public function details()
{
	if($this->uri->segment(3))
	{
		$id = $this->uri->segment(3);
		$data['vt_details'] = $this->Personalpdf_model->fetch_single_details($id);
		$this->load->view("personel_list",$data);
	}
}
public function pdfdetails()
{
	if($this->uri->segment(3))
	{
		$id = $this->uri->segment(3);
		$html_content = '<h3 align="center">Convert HTML to PDF in CondeIgniter using Dompdf</h3>';
		$html_content .= $this->Personalpdf_model->fetch_single_details($id);
		$this->pdf->loadHtml($html_content);
		$this->pdf->render();
		$this->pdf->stream("".$id.".pdf",array("Attachment"=>0));
	}
	
}

//========================================//pdf file//=============================================//





//==============================//verilenler bazasindan melimat silmek//=============================//
  public  function  delete($id)
  {
  	  $where = array('id' => $id);
	  $delete = $this->Personel_model->delete($where);
	  if($delete){
		  $alert = array(
			  'title' => 'Emeliyyat Ugurlu',
			  'message' => 'Databazadaki bu melumat silindi... ',
			  'type' => 'success'
		  );
	  }else{
		  $alert = array(
			  'title' => 'Emeliyyat Ugursuz',
			  'message' => 'Databazadaki bu melumat silinmedi.. ',
			  'type' => 'danger'
		  );
	  }
	  $this->session->set_flashdata('alert',$alert);

	  redirect(base_url());
  }

  public  function order_by($field = "id", $order = "ASC")
  {
	  $list = $this->Personel_model->order_by($field, $order);
	  $viewData["list"] = $list;
	  $this->load->view("personel_list",$viewData);
  }
}
