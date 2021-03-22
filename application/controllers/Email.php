<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_logged')) {
			redirect('Auth');
		}
		$this->load->model("M_Draft", "draft");
		$this->load->model("M_Group", "group");
		$this->load->helper('form');
	}

	private function response($res)
	{

		$pesan = ['code' => $res[0], 'pesan' => $res[1]];

		return $pesan;
	}

	public function blast($id)
	{
		$data["title"] = "Blast Email";
		$data["landingpage"] = false;
		$data['content'] = 'content_blast';

		$this->load->view('index', $data);
	}

	public function draft()
	{
		$data["title"] = "Draft Email";
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
		$type = 1;
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

	public function send_email()
	{
		$emailto = $this->input->post("email");
		$password = $this->input->post("password");
		$subject = $this->input->post("subject");
		$message = $this->input->post("message");
		$emailfrom = $this->session->userdata("user_logged")->email;
		$user = $this->session->userdata("user_logged")->name;

		$this->db->select('name');
		$this->db->where('email', $emailto);
		$dataName = $this->db->get("contact")->result();
		if (isset($dataName->name)) {
			$messageOut = str_replace("<name>", $dataName->name, $message);
		} else {
			$messageOut = $message;
		}
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = '465';
		$config['useragent'] = 'Renotech';
		$config['smtp_user'] = $emailfrom; //email gmail
		$config['smtp_pass'] = $password; //isi passowrd email
		$config['mailtype'] = 'html';
		$config['charset'] = "iso-8859-1";
		$config['wordwrap'] = TRUE;
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";

		// $this->email->initialize($config);
		$this->load->library('email', $config);

		$this->email->from($emailfrom, $user);
		$this->email->to($emailto);
		$this->email->subject($subject);
		$this->email->message($messageOut);
		if ($this->email->send()) {
			$res = $this->response([1, 'Email ' . $emailto . ' Berhasil Dikirim']);
			echo json_encode($res);
			return;
		} else {
			$res = $this->response([0, 'Email ' . $emailto]);
			// $res = $this->email->print_debugger();
			echo json_encode($res);
			return;
		}
	}
}
