<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_logged')) {
			redirect('Auth');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->model("M_User", "user");
	}

	private function response($res)
	{

		$pesan = ['code' => $res[0], 'pesan' => $res[1]];

		return $pesan;
	}

	public function index()
	{
		$data["title"] = "User";
		$data["landingpage"] = false;
		$data['content'] = 'content_user';

		$this->load->view('index', $data);
	}

	public function getAllData()
	{
		$data = $this->user->getAllData();
		echo json_encode($data);
	}

	public function getDataById()
	{
		$id = $this->input->post('id');

		$data = $this->user->getById($id);
		echo json_encode($data);
	}

	public function storeData()
	{
		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$pass = $this->input->post('password');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$password = password_hash($pass, PASSWORD_DEFAULT);

		$result = $this->user->storeDataUser($name, $username, $password, $phone, $email);
		if ($result) {
			$res = $this->response([1, 'Success submit your data.']);
			echo json_encode($res);
			return;
		} else {
			$res = $this->response([0, 'Failed to save your data.']);
			echo json_encode($res);
			return;
		}
	}

	public function updateData()
	{
		$id = $this->input->post('id');
		$pass = $this->input->post('password');

		$data = array(
			"name" => $this->input->post('name'),
			"username" => $this->input->post('username'),
			"phone" => $this->input->post('phone'),
			"email" => $this->input->post('email'),
			"is_deleted" => $this->input->post('status'),
            'last_updated_date' => date("Y-m-d H:i:s"),
            'last_updated_by' => $this->session->userdata("user_logged")->id,
		);
		if ($pass != "") {
			$data["password"] = password_hash($pass, PASSWORD_DEFAULT);
		}
		$result = $this->user->updateDataUser($data, $id);
		if ($result) {
			$res = $this->response([1, 'Success update your data.']);
			echo json_encode($res);
			return;
		} else {
			$res = $this->response([0, 'Failed to update your data.']);
			echo json_encode($res);
			return;
		}
	}

	public function deleteDataUser()
	{
		$id = $this->input->post('id');

		$result = $this->user->deleteDataUser($id);
		if ($result) {
			$res = $this->response([1, 'Success delete your data.']);
			echo json_encode($res);
			return;
		} else {
			$res = $this->response([0, 'Failed to delete your data.']);
			echo json_encode($res);
			return;
		}
	}
}
