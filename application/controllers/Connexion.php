<?php

	class Connexion extends CI_Controller {
		public function index() {
			$this->load->library("form_validation");

			$this->form_validation->set_rules('user', 'utilisateur', 'required');
			$this->form_validation->set_rules('pass', 'mot de passe', 'required');

			$this->load->view('templates/head');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('form/myform');
			} else {
				$this->load->view('form/success');
			}
			$this->load->view('templates/foot');
		}
	}

	class Inscription extends CI_Controller {
		public function index () {
			$this->load->library("form_validation");

			$this->form_validation->set_rules('nom', 'nom', 'required');
			$this->form_validation->set_rules('prenom', "prénom", 'required');
			

			$this->load->view('templates/head');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('form/jeune');
			} else {
				$this->load->view('form/success');
			}
			$this->load->view('templates/foot');
		}
	}