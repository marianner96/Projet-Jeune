<?php
class Jeune extends CI_Controller{
    public function __construct(){
          parent::__construct();
          $this->load->library("form_validation");
          $this->load->library('session');
        }

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
    public function profil($action=""){
        if ($action == "")  {
            $data['content'] = 'profil';
            $data['menu'] = 'jeune';
            $tab = $this->session->userdata('logged_in'); 
            $data['tab'] = $tab;


            $this->load->view('templates/head', $data);
            $this->load->view('templates/jeunes', $data);
            $this->load->view('templates/foot');
        } elseif ($action == "chmail") {
            $this->chmail();
        }
    }

    public function reference(){
        $data['content'] = 'reference';
        $data['menu'] = 'jeune';
        $this->load->view('templates/head', $data);
        $this->load->view('templates/jeunes', $data);
        $this->load->view('templates/foot');
    }

    private function chmail(){
        $this->form_validation->set_rules('mail', 'e_mail', 'required|valid_email|callback_changement_mail_possible');
        $this->output->set_content_type('application/json');
        if ($this->form_validation->run()==false) {
            $this->output->set_status_header('400');
            $this->output->set_output(
                json_encode(array(
                    'errors'=> array_filter(explode("\n", validation_errors(NULL,NULL))) 
                    ))
                );
        } 
    }

    public function changement_mail_possible(){
        $ma = $this->input->post('mail');
        $tab = $this->session->userdata('logged_in'); 
        $mail = $tab['mail'];
        if ($ma == $mail) {
            $this->form_validation->set_message('changement_mail_possible', "L'adresse mail n'as pas été changée");
            return FALSE;
        }
        $this->load->model('users_model');
        $val = $this->users_model->change_mail();
        $this->output->set_output(json_encode($val));
        return TRUE;
    }
}
