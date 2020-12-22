<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_logged')) {
			redirect('Auth');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->model("M_Group", "group");
	}

	private function response($res)
	{

		$pesan = ['code' => $res[0], 'pesan' => $res[1]];

		return $pesan;
	}

	public function getAllData()
	{
		$data = $this->group->getAllData();
		echo json_encode($data);
	}

	public function storeData()
	{
		$name = $this->input->post('name');
		$selectedContact = $this->input->post('selectedContact');

		$result = $this->group->storeDataGroup($name, $selectedContact);
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
		$name = $this->input->post('name');
		$selectedContact = $this->input->post('selectedContact');
		// echo json_encode($data);
		// return;
		$result = $this->group->updateDataGroup($id, $name, $selectedContact);
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

	public function deleteData()
	{
		$id = $this->input->post('id');

		$data = $this->group->deleteDataGroup($id);
		if ($data) {
			$res = $this->response([1, 'Success submit your data.']);
			echo json_encode($res);
			return;
		} else {
			$res = $this->response([0, 'Failed to save your data.']);
			echo json_encode($res);
			return;
		}
	}

	public function getDataByIdGroup()
	{
		$id = $this->input->post('id');

		$data = $this->group->getDataByIdGroup($id)->result();
		echo json_encode($data);
	}
}
