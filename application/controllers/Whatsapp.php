<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsapp extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_logged')) {
			redirect('Auth');
		}
		$this->load->model("M_Draft", "draft");
	}

	private function response($res)
	{

		$pesan = ['code' => $res[0], 'pesan' => $res[1]];

		return $pesan;
	}

	public function blast() 
	{
		$data["title"] = "Blast Whatsapp";
		$data["landingpage"] = false;
		$data['content'] = 'content_blast_whatsapp';

		$this->load->view('index', $data);
	}

	public function draft()
	{
		$data["title"] = "Draft Whatsapp";
		$data["landingpage"] = false;
		$data['content'] = 'content_draft';

		$this->load->view('index', $data);
	}

	public function getAllData()
	{
		$id = $this->input->post("type");
		$data = $this->draft->getAllData($id);
		echo json_encode($data);
	}

	public function getDataById()
	{
		$id = $this->input->post('id');

		$data = $this->draft->getById($id);
		echo json_encode($data);
	}

	public function storeData()
	{
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$type = 2;

		$result = $this->draft->storeDataDraft($subject, $message, $type);
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
			"subject" => $this->input->post('subject'),
			"message" => $this->input->post('message'),
			"is_deleted" => $this->input->post('statusDraft'),
			'last_updated_date' => date("Y-m-d H:i:s"),
			'last_updated_by' => $this->session->userdata("user_logged")->id,
		);
		$result = $this->draft->updateData($data, $id);
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
		$delete = $this->db->update('message', $data);
		// return ($this->db->affected_rows() > 0);

		if ($delete) {
			$res = $this->response([1, 'Success Change Your Data Status.']);
			echo json_encode($res);
			return;
		} else {
			$res = $this->response([0, 'Failed Change Your Data Status.']);
			echo json_encode($res);
			return;
		}
	}

	public function sendMessage()
	{

		$smsin = $this->input->post("message");
		$phonein = $this->input->post("phone");

		$this->db->select('name');
		$this->db->where('phone', $phonein);
		$dataName = $this->db->get("contact")->result();

		$sms = str_replace("<name>", $dataName[0]->name, $smsin);
		// echo json_encode($sms);
		// return;

		$userkey = '70bb2e3541d2';
		$passkey = '1c0479f6b015e87d029691ed';
		$telepon = $phonein;
		$message = $sms;
		$url = 'https://console.zenziva.net/wareguler/api/sendWA/';
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
			'userkey' => $userkey,
			'passkey' => $passkey,
			'to' => $telepon,
			'message' => $message
		));
		$results = json_decode(curl_exec($curlHandle), true);

		if ($results) {
			$res = $this->response([1, 'Success To Send Your Whatsapp Message. Please Wait.']);
			echo json_encode($res);
			return;
		} else {
			$res = $this->response([0, 'Failed To Send Your Whatsapp Message.']);
			echo json_encode($res);
			return;
		}
		
		curl_close($curlHandle);
	}
}
