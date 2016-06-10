<?php

	class Connexion extends J64_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->library("form_validation");
			$this->load->model('users_model');
			$this->load->library('session');
                        $this->load->helper('url');
		}


		/**
		* connection du jeune
		*
		*En cas d'erreur : retourne un message d'erreur lorsque le mail ou le mot de passe ne correspond pas
		*En cas de réussite : va sur la page d'accueil du jeune 
		*/
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

		/**
		*vérifie si le mot de passe rentré correspond  celui dans la bdd
		*
		*@param string $mdp : Le mot de passe rentré 
		*@return bool Renvoie TRUE si le mot de passe correspond, FALSE sinon
		*/
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

		/**
		*inscrit le jeune dans la bdd
		*
		*En cas d'erreur : retourne un message d'erreur, les champs remplis avant l'erreur garderont leur valeur sauf le mot de passe
		*En cas de réussite : redirige vers la page d'accueil du site + met les données du jeune dans la variable de session
		*/
		public function inscription () {

			$this->form_validation->set_rules('nom', 'nom', 'required');
			$this->form_validation->set_rules('prenom', "prénom", 'required');
			$this->form_validation->set_rules('jour', 'jour de naissance', 'required|is_natural|greater_than_equal_to[1]|less_than_equal_to[31]');
			$this->form_validation->set_rules('mois', 'mois de naisssance', 'required|is_natural|greater_than_equal_to[1]|less_than_equal_to[12]');
			$this->form_validation->set_rules('annee', 'année de naisssance', 'required|exact_length[4]|is_natural');
			$this->form_validation->set_rules('mail', 'e-mail', 'required|valid_email|is_unique[jeune.mail]',
			array('is_unique' => "L'adresse mail est déjà utilisée"));
			$this->form_validation->set_rules('mdp', 'mot de passe', 'required|min_length[7]');
			$this->form_validation->set_rules('verifmdp', 'confirmation du mot de passe', 'required|matches[mdp]');
			

			$this->load->view('templates/head');

			if ($this->form_validation->run()==FALSE) {
				$this->load->view('form/jeune');
			} else {
				$donnes = $this->users_model->create_user();
				$this->session->set_userdata('logged_in', $donnes);
				redirect('/jeune');
			}
			$this->load->view('templates/foot');
		}

		public function deconnexion(){
			$this->session->sess_destroy();
			redirect('/accueil');
		}

		public function terminer_inscription(){
      $socialType = $this->session->userdata('terminer_inscription');
      if(empty($socialType))
        redirect('/connexion');

			$this->form_validation->set_rules('nom', 'nom', 'required');
			$this->form_validation->set_rules('prenom', "prénom", 'required');
			$this->form_validation->set_rules('jour', 'jour de naissance', 'required|is_natural|greater_than[1]|less_than[31]');
			$this->form_validation->set_rules('mois', 'mois de naisssance', 'required');
			$this->form_validation->set_rules('annee', 'année de naisssance', 'required|exact_length[4]|is_natural');
			$this->form_validation->set_rules('mail', 'e-mail', 'required|valid_email|is_unique[jeune.mail]',
				array('is_unique' => "L'adresse mail est déjà utilisée"));

			if ($this->form_validation->run()==FALSE) {
				$this->data['title'] = 'Terminer l\'inscription';
				$this->load->view('templates/head', $this->data);
				$this->load->view('form/terminer_inscription');
				$this->load->view('templates/foot');
			}else{
        switch ($socialType) {
          case 'twitter' :
            $userSession = $this->users_model->inscriptionTwitter();
						break;
        }
        if($userSession === false){
          show_error('Une erreur s\'est produite lors de l\'inscription.',500);
        }
        $this->session->set_userdata('logged_in', $userSession);
        redirect('/jeune');
			}
		}
	}
