<?php

class Inscription extends CI_Controller {
		public function index () {
			$this->load->library("form_validation");

			$this->form_validation->set_rules('nom', 'nom', 'required');
			$this->form_validation->set_rules('prenom', "prénom", 'required');
			$this->form_validation->set_rules('naissance', 'date de naissance', 'required');
			$this->form_validation->set_rules('mail', 'e-mail', 'required|valid_email');

			$this->load->view('templates/head');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('form/jeune');
			} else {
				$this->load->view('form/success');
			}
			$this->load->view('templates/foot');
		}
	}