<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_logged')) {
			redirect('Auth');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->model("M_Contact", "contact");
	}

	private function response($res)
	{

		$pesan = ['code' => $res[0], 'pesan' => $res[1]];

		return $pesan;
	}

	public function index()
	{
		$data["title"] = "Contact";
		$data["landingpage"] = false;
		$data['content'] = 'content_contact';
		$data['contact_group'] = $this->contact->getAllData();

		$this->load->view('index', $data);
	}

	public function getAllData()
	{
		$data = $this->contact->getAllData();
		echo json_encode($data);
	}

	public function getDataById()
	{
		$id = $this->input->post('id');

		$data = $this->contact->getById($id);
		echo json_encode($data);
	}

	public function storeData()
	{
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');

		$result = $this->contact->storeDataContact($name, $phone, $email);
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

	public function action_update()
	{
		$id = $this->input->post('id');

		$data = array(
			"name" => $this->input->post('name'),
			"phone" => $this->input->post('phone'),
			"email" => $this->input->post('email'),
			'last_updated_date' => date("Y-m-d H:i:s"),
			'last_updated_by' => $this->session->userdata("user_logged")->id,
		);
		$result = $this->contact->updateData($data, $id);
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

	public function action_delete()
	{
		$post = $this->input->post();
		$id_list = $post['id'];

		$data = [
			'is_deleted' => "y"
		];

		$this->db->where('id', $id_list);
		$delete = $this->db->update('contact', $data);
		// return ($this->db->affected_rows() > 0);

		if ($delete) {
			$res = $this->response([1, 'Success Delete Your Data.']);
			echo json_encode($res);
			return;
		} else {
			$res = $this->response([0, 'Failed Delete Your Data.']);
			echo json_encode($res);
			return;
		}
	}

	public function importContact()
	{
		$this->load->library('Excel');

		if (isset($_FILES["inputFile"]["name"])) {

			$path = $_FILES["inputFile"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);

			foreach ($object->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				$insertArray = array();
				for ($row = 2; $row <= $highestRow; $row++) {
					$name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$phone = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

					$data = array(
						"name"  => $name,
						"phone"   => $phone,
						"email"    => $email,
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("user_logged")->id,
						"last_updated_date" => date("Y-m-d H:i:s"),
						"last_updated_by" => $this->session->userdata("user_logged")->id,
						"is_deleted" => 'n',
					);
					array_push($insertArray, $data);
				}
			}

			$insert = $this->db->insert_batch("contact", $insertArray);
			if ($insert) {
				$res = $this->response([0, 'Success import your data.']);
				echo json_encode($res);
				return;
			} else {
				$res = $this->response([1, 'Failed to import your data.']);
				echo json_encode($res);
				return;
			}
		}
	}
}
