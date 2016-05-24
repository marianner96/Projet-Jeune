<?php
class Jeune extends CI_Controller{
	public function index(){
        $data['content'] = 'accueil';
        $data['menu'] = 'jeune';
        $this->load->view('templates/head', $data);
        $this ->load->view('templates/jeunes', $data);
        $this->load->view('templates/foot');
	}
    public function formulaire(){
        $this->load->model('savoiretre_model');
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('savoirEtre[]','SavoirEtre','required|max_length[2]');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('duree', 'Durée', 'required');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required');
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('mail', 'Mail', 'valid_email');

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
