<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data["people"] = [
			[
				"name" => "Leo",
				"email" => "leografx@gmail.com",
				"limit" => "25.00"
			],
		[
				"name" => "Ana",
				"email" => "anagarcia_1964@yahoo.com",
				"limit" => "15.00"
		],
			[
				"name" => "Jerry",
				"email" => "ihouse@gmail.com",
				"limit" => "35.00"
	],
			[
				"name" => "Gregory",
				"email" => "greg@gmail.com",
				"limit" => "40.00"
			]
		]
		;
		$d = ["a","b","c"];
		print_r($this->shuffleList($data['people']));
		// print_r($d);
		$this->load->view('welcome_message', $data);
	}

	private function shuffleList ($myArray) {
		uksort($myArray, function ($a, $b) {return mt_rand(-10, 10);});
		return $myArray;
	}
}
