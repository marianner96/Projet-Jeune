<?php

	class Connexion extends CI_Controller {

        public function __construct(){
          parent::__construct();
          $this->load->library("form_validation");
          $this->load->model('users_model');
          $this->load->library('session');
        }

		public function index() {

			$this->form_validation->set_rules('mail', 'e-mail', 'required');
			$this->form_validation->set_rules('mdp', 'mot de passe', 'required|callback_check_database');

			$this->load->view('templates/head', array('title' => 'Connexion'));
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('form/myform');
			} else {
				redirect('/jeune');
			}
			$this->load->view('templates/foot');
		}

		public function check_database($mdp) {
			$mail = $this->input->post('mail');
			$result = $this->users_model->login($mail, $mdp);
			if ($result) {
				$this->session->set_userdata('logged_in', $result);
				return TRUE;
			} else {
				$this->form_validation->set_message('check_database', "L'adresse mail ou le mot de passe ne correspond pas");
				return FALSE;
			}
		}

		public function inscription () {

			$this->form_validation->set_rules('nom', 'nom', 'required');
			$this->form_validation->set_rules('prenom', "prénom", 'required');
			$this->form_validation->set_rules('jour', 'jour de naissance', 'required|is_natural|greater_than[1]|less_than[31]');
			$this->form_validation->set_rules('mois', 'mois de naisssance', 'required');
			$this->form_validation->set_rules('annee', 'année de naisssance', 'required|exact_length[4]|is_natural');
			$this->form_validation->set_rules('mail', 'e-mail', 'required|valid_email|is_unique[jeune.mail]',
				array('is_unique' => "L'adresse mail est déjà utilisée"));
			$this->form_validation->set_rules('mdp', 'mot de passe', 'required');
			

			$this->load->view('templates/head');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('form/jeune');
			} else {
                $this->users_model->create_user();
				redirect('/jeune');
			}
			$this->load->view('templates/foot');
		}
	}
