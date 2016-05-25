<?php
class Jeune extends CI_Controller{
    public function __construct(){
          parent::__construct();
          $this->load->library("form_validation");
          $this->load->library('session');
          $this->load->model('savoiretre_model');
        }

	public function index(){
        $data['content'] = 'accueil';
        $data['menu'] = 'jeune';
        $this->load->view('templates/head', $data);
        $this ->load->view('templates/jeunes', $data);
        $this->load->view('templates/foot');
	}
    public function formulaire(){
        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_rules('savoirEtre[]','SavoirEtre','required|max_length[2]');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('duree', 'Durée', 'required');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required');
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('mail', 'Mail', 'valid_email|required');

        $data['query'] = $this->savoiretre_model->getJeune();
        $data['content'] = 'fomulaire';
        $data['menu'] = 'jeune';
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/head', $data);
            $this->load->view('templates/jeunes', $data);
            $this->load->view('templates/foot');
        }
        else{                
            $this->load->view('PartieJeune/formsuccess');
        }
    }
    public function consultant(){
        $data['content'] = 'consultant';
        $data['menu'] = 'jeune';
        $this->load->view('templates/head', $data);
        $this->load->view('templates/jeunes', $data);
        $this->load->view('templates/foot');
    }
    public function profil(){
        $data['content'] = 'profil';
        $data['menu'] = 'jeune';
        $tab = $this->session->userdata('logged_in'); 
        $data['tab'] = $tab;

        $this->form_validation->set_rules('nom', 'nom', 'required');
        $this->form_validation->set_rules('prenom', "prénom", 'required');
        $this->form_validation->set_rules('date_naissance', 'date de naissance', 'required');
        $this->form_validation->set_rules('mail', 'e-mail', 'required|valid_email');
        $this->form_validation->set_rules('mdp', 'mot de passe', 'required');

        $this->load->view('templates/head', $data);
        $this->load->view('templates/jeunes', $data);
        $this->load->view('templates/foot');
    }

    public function reference(){
        $data['content'] = 'reference';
        $data['menu'] = 'jeune';
        $this->load->view('templates/head', $data);
        $this->load->view('templates/jeunes', $data);
        $this->load->view('templates/foot');
    }
}
