<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MX_Controller {
    public function __construct(){
        $this->load->model('usermodel');
    }

	function index(){
		$header['title'] = "Project Zarmina";
        $header['logged_in'] = false;
        if($this->usermodel->checkLogin() == true) {
            $header['username'] = $this->session->userdata('username');
            $header['access'] = $this->session->userdata('access');
            $header['user_id'] = $this->session->userdata('user_id');
            $header['logged_in'] = true;
        }
		$this->load->helper('url');
		$this->load->view('header',$header);
		$this->load->view('welcome_message');
		$this->load->view('footer');
	}
}
