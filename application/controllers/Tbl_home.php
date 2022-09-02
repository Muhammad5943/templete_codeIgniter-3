<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tbl_home extends CI_Controller {

	public function __construct()
	{
		// ini_set('display_errors', 'off'); // for disabled error
		parent::__construct();
	}

	public function index()
	{
		$data['_view'] = "tbl_home/index";
		$this->load->view("layout/main_admin", $data);
	}
}