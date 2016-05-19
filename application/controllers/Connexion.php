<?php

	class Connexion extends CI_Controller {
		public function index() {
			$this->load->library("form_validation");

			$this->form_validation->set_rules('email', 'e-mail', 'required');
			$this->form_validation->set_rules('pass', 'mot de passe', 'required');

			$this->load->view('templates/head', array('title' => 'Connexion'));
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('form/myform');
			} else {
				$this->load->view('form/success');
			}
			$this->load->view('templates/foot');
		}

		public function inscription () {
			$this->load->library("form_validation");

			$this->form_validation->set_rules('nom', 'nom', 'required');
			$this->form_validation->set_rules('prenom', "prénom", 'required');
			$this->form_validation->set_rules('jour', 'jour de naissance', 'required|is_natural|greater_than[1]|less_than[31]');
			$this->form_validation->set_rules('mois', 'mois de naisssance', 'required');
			$this->form_validation->set_rules('annee', 'année de naisssance', 'required|exact_length[4]|is_natural');
			$this->form_validation->set_rules('mail', 'e-mail', 'required|valid_email');
			$this->form_validation->set_rules('mdp', 'mot de passe', 'required');
			

			$this->load->view('templates/head');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('form/jeune');
			} else {
				$this->load->view('form/success');
			}
			$this->load->view('templates/foot');
		}
	}
