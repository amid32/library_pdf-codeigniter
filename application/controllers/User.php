<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	   public function __construct()
	   {
	   	parent::__construct();
          $this->load->library("form_validation");

	   	$this->load->helper('form');

	   }

	public  function  index()
	{
		$user = $this->session->userdata("user");
		if($user){
			redirect(base_url("personel"));
		}
		$this->load->helper("captcha");
		$vals = array(
			'word'          => '',
			'img_path'      => 'captcha/',
			'img_url'       => base_url("captcha"),
			'font_path'     => BASEPATH.'/fonts/texb.ttf',
			'img_width'     => '150',
			'img_height'    => 50,
			'expiration'    => 7200,
			'word_length'   => 5,
			'font_size'     => 20,
			'img_id'        => 'myImge',
			'pool'          => 'abcdefghijklmnopqrstuvwxyz',

			// White background and border, black text and red grid
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(45, 100, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		);

		$captcha = create_captcha($vals);
        $this->session->set_flashdata("code",$captcha["word"]);

		$viewData["captcha"] = $captcha['image'];
      $this->load->view("login_form",$viewData);
	}

	public function login()
	{
		$user = $this->session->userdata("user");             
		if($user){                                            
			redirect(base_url("personel"));                   
		}                                                     

        $email   = $this->input->post("email");
		$pasw    = $this->input->post("pasw");
		$captcha = $this->input->post("captcha");

		if (!$email || !$pasw || !$captcha){
			$alert = array(
				'title' => 'Xeta',
				'message' => 'Bas xana biraxmayin... ',
				'type' => 'danger'
			);

		}else{
			 if($captcha == $this->session->userdata("code"))
			 {
			   $this->load->model('User_model');
			   $where  = array(
			   	"email" => $email,
				"pasw"  => md5($pasw)
			   );
			   $row = $this->User_model->get($where);
			  if($row){
			  	$user = array(
			  		'user_name' => $row->user_name
				);
			  	$this->session->set_userdata("user",$user);
			  	 redirect(base_url("personel"));

			  }else{
			  	$alert = array(
			  		'title' => 'Xeta',
			  		'message' => 'Girmis oldugunuz kullanici adi veya fifre yanlisdir ;-(',
			  		'type' => 'danger'
			  	);
			  }

			 }else{

			 	$alert = array(
			 		'title' => 'Xeta',
			 		'message' => 'Dogrulama kodun yanlis girdiniz... ',
			 		'type' => 'danger'
			 	);
			 }	}
		$this->session->set_flashdata('alert',$alert);
		redirect(base_url("user"));
	}



	public  function  logout()
	{
		$this->session->unset_userdata("user");
			redirect(base_url("user"));

	}
}
