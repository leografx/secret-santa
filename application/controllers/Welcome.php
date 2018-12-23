<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $result;
	private $data;

	function __constructor() {
		
	}

	public function index()
	{
		$this->load->model('Participant_model');
		$this->data = $this->Participant_model->getParticipants();
		$this->loadView();
		
	}

	public function postParticipant() {
		$data = $this->input->post();
		$this->load->model('Participant_model');
		if(!empty($data['name'])){	
			$this->Participant_model->insert($data);
		}
		redirect(base_url().'welcome/index');
	}

	public function delete($id) {
		$this->load->model('Participant_model');
		$this->Participant_model->delete($id);
		redirect(base_url().'welcome/index');
	}

	public function sendEmail() {
		$this->load->model('Participant_model');
		$data = $this->Participant_model->getParticipants();
		$this->applySecretSanta($data);	
		$this->mailSecretSanta();
		$this->session->set_flashdata('data', $this->result);
		redirect(base_url()."welcome/done");
		
	}

	private function mailSecretSanta() {
		$data = $this->result;
		
		$this->load->library('email');
		$config['mailtype'] = 'html';
		
		$this->email->initialize($config);
		
		foreach ($data as $key => $value) {
			$name = $value->name;
			$secret = $value->secret;
			$email = $value->email; 
			// $htmlPage = $this->secret($name, $secret);
			$to = $email;
			// $to = 'leografx@gmail.com';
			$this->email->from('art@grafx2print.com', 'Secret Santa');
			$this->email->to($to); 
	
			$mesg = $this->load->view('secret',["name" => $name, "secret" => $secret],true);
			$this->email->subject('Secret Santa');
			$this->email->message($mesg);	
	
			$this->email->send();
		}
	}

	public function secret($name, $secret) {
		$this->load->view('secret',["name" => $name, "secret" => $secret],true);
	}

	public function done() {
		$message = $this->session->flashdata('data');
		$this->load->view('done', [ "result" => $message]);
	}

	private function loadView() {
		$this->load->view('welcome_message', ["data" => $this->data]);
	}



	private function checkSantaToSelf($list) {
		$result_ = [];
		foreach ($this->result as $r) {
			if($r->name == $r->secret) {
				array_push($result_, true);
			} else {
				array_push($result_, false);
			}
		}

		if(array_sum($result_) == 0) {
			$this->loadView();
		} else {
			$this->result = NULL;
			$this->applySecretSanta($list);
		}
	}

	private function shuffleList ($list) {
		$myArray = (array) $list;
		uksort($myArray, function ($a, $b) {return mt_rand(-10, 10);});
		return $myArray;
	}

	private function  applySecretSanta($list) {
		$list = (array) $list;

		$s = $this->shuffleList($list);
		$secretArray = [];
		foreach ($s as $secret) {
			array_push($secretArray,$secret);
		}

		$result = array();
		foreach($list as $k => $l) {
			$l->secret = $secretArray[$k]->name;
			array_push($result,$l);
		}

		$this->result = NULL;
		$this->result = $result;
	
		$this->checkSantaToSelf($list);
	}
}
