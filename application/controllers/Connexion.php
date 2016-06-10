<?php

/**
 * Class Connexion
 * Controlleur de la partie de connexion et d'inscription au site.
 * Match les routes de type /connexion/*
 */
class Connexion extends J64_Controller {

	/**
	 * Connexion constructor.
	 */
	public function __construct(){
			parent::__construct();
			$this->load->library("form_validation");
			$this->load->model('users_model');
			$this->load->library('session');
                        $this->load->helper('url');
		}


		/**
		 * Route /connexion/index | /connexion
		 *
		 * Connection du jeune
		 * Affiche un message d'erreur lorsque le mail ou le mot de passe ne
		 * correspondent pas. Redirige l'utlisateur vers la page d'accueil du jeune
		 * en cas de succès.
		 *
		 * @return void
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
		 * Vérifie si le mot de passe rentré correspond  celui dans la bdd
		 *
		 * Si les mots de passe ne correspondent pas, une message d'erreur est
		 * défini pour la validation du formulaire.
		 *
		 * @param string $mdp : Le mot de passe rentré
		 * @return bool Renvoie TRUE si le mot de passe correspond, FALSE sinon
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
		 * Route /connexion/inscription
		 *
		 * Inscrit le jeune dans la bdd. Si le formulaire est mal rempli, affiche un
		 * message d'erreur, les champs remplis avant l'erreur garderont leur valeur
		 * sauf le mot de passe. Redirige vers la page de la partie jeune et met les
		 * données du jeune dans la variable de session.
		 *
		 * @return void
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

	/**
	 * Route /connexion/deconnexion
	 *
	 * Supprime les variables de session ce qui aura pour effet de déconnecter
	 * le jeune connecté. Redirige ensuite l'utilisateur vers la page d'accueil
	 * du site.
	 *
	 * @return void
	 */
	public function deconnexion(){
			$this->session->sess_destroy();
			redirect('/accueil');
		}

	/**
	 * Route /connexion/terminer-inscription
	 *
	 * L'utilisateur est redirigé vers cette page après une inscription via
	 * un réseau social pour renseigner les informations qui n'ont pu pas être
	 * récupérer. Si l'utilisateur tente d'accéder à cette page dans un autre
	 * contexte, il sera rediriger vers la page de connexion.
	 *
	 * @return void
	 */
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
