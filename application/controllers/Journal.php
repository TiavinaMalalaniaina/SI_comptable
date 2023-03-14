<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		$this->load->view('consultation.php');
		$this->load->view('templates/footer.php');
	}

}