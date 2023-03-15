<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		$this->load->view('import_export.php');
		$this->load->view('templates/footer.php');
	}

}