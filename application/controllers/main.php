<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->database();		
		$this->load->helper(array('url','language'));
		$this->load->library('ion_auth');
		$this->load->library(array('session','form_validation'));
	}

	function index(){
		if(!$this->ion_auth->logged_in()) redirect('auth/login', 'refresh');	
		$data['title']="CMS-Main Page";	
		$data['user'] = $this->session->userdata('email');
		$data['page'] = "index";
		$data['navbar']="navbar";
		$data['sidebar']="sidebar";
		$this->load->view('main',$data);		
	}
}