<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('user_logged')) {
		// 	redirect('Dashboard');
		// }
		$this->load->model("M_Auth", "user");
	}

	public function index()
	{
		$data["title"] = "Login Admin";
		$data["landingpage"] = false;
		$data["dataF"] = "";
		$this->load->view('login', $data);
	}

	function action_login()
	{
		$data["dataF"] = "Username or Password Is Wrong";

		if ($this->user->doLogin()) {
			redirect(site_url('Dashboard'));
		} else {
			$this->load->view('login', $data);
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
