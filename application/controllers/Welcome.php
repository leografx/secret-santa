<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $result = [];
	private $data;

	function __constructor() {
		
	}

	public function index()
	{
		$this->load->model('Participant_model');
		$this->data = $this->Participant_model->getParticipants();
		$this->loadView();
		// $this->applySecretSanta($this->data);	
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

	private function loadView() {
		$this->load->view('welcome_message', ["data" => $this->data]);
	}

	private function checkSantaToSelf() {
		$result_ = [];
		foreach ($this->result as $r) {
			if($r['name'] == $r['secret']) {
				array_push($result_, true);
			} else {
				array_push($result_, false);
			}
		}

		if(array_sum($result_) == 0) {
			$this->loadView();
		} else {
			$this->result = array();
			$this->index();
		}
	}

	private function shuffleList ($myArray) {
		uksort($myArray, function ($a, $b) {return mt_rand(-10, 10);});
		return $myArray;
	}

	private function  applySecretSanta($list) {
		
		$s = $this->shuffleList($list);
		$secretArray = [];
		foreach ($s as $secret) {
			array_push($secretArray,$secret);
		}

		$result = array();
		foreach($list as $k => $l) {
			$l['secret'] = $secretArray[$k]['name'];
			array_push($result,$l);
		}
		$this->result = array();
		$this->result = $result;
	
		$this->checkSantaToSelf();
	}
}
