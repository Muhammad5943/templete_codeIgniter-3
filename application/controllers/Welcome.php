<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		// ini_set('display_errors', 'off'); // for disabled error
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
}
