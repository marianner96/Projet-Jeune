<?php

	class Connexion extends CI_Controller {
		public function index() {
			$this->load->helper(array('form', 'url'));
			$this->load->library("form_validation");
			$this->load->view('templates/head');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('form/myform');
			} else {
				$this->load->view('form/success');
			}
			$this->load->view('templates/foot');
		}
	}