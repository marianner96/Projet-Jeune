<?php
class Jeune extends J64_Controller{
  public function __construct(){
    parent::__construct();
    if(!$this->data['is_logged']){
      redirect('/connexion');
    }
    $this->load->library("form_validation");
    $this->load->library('session');
    $this->load->library('PasswordHash', array(8, FALSE));

    $this->load->model('savoiretre_model');
    $this->load->model('Jeune_model');
  }

	public function index(){
    $this->data['content'] = 'accueil';
    $this->data['menu'] = 'jeune';

    $this->load->view('templates/head', $this->data);
    $this->load->view('templates/jeunes', $this->data);
    $this->load->view('templates/foot');
	}

  public function formulaire(){
    $this->load->helper(array('form', 'url'));
    $this->form_validation->set_rules('savoirEtre[]','SavoirEtre','required|callback_savoirEtre_check');
    $this->form_validation->set_rules('description', 'Description', 'required');
    $this->form_validation->set_rules('duree', 'Durée', 'required');
    $this->form_validation->set_rules('prenom', 'Prénom', 'required');
    $this->form_validation->set_rules('nom', 'Nom', 'required');
    $this->form_validation->set_rules('mail', 'Mail', 'valid_email|required');

    $this->data['query'] = $this->savoiretre_model->getJeune();
    $this->data['content'] = 'formulaire';
    if ($this->form_validation->run() == FALSE){
      $this->load->view('templates/head', $this->data);
      $this->load->view('templates/jeunes', $this->data);
      $this->load->view('templates/foot');
    }
    else{
<<<<<<< HEAD
      $this->data['content']='reference';
      $this->data['tab'] = $this->session->userdata('logged_in');
=======
>>>>>>> 5c107706764333cf62129107f1ce12cde1e743e8
      $this->Jeune_model->creationReferences();
      $this->session->set_flashdata('validation', [$this->input->post('nom'), $this->input->post('prenom')]);
      redirect('/jeune/reference');
    }
  }

  public function savoirEtre_check($chaine){
    if (count($this->input->post('savoirEtre'))>4) {
      $this->form_validation->set_message('savoirEtre_check', 'Veuillez choisir au maximum 4 options');
      return FALSE;
    }
    else {
      return $chaine;
    }
  }

  public function profil($action=""){
    if ($action == "")  {
      $this->data['content'] = 'profil';
      $tab = $this->session->userdata('logged_in');
      $this->data['tab'] = $tab;


      $this->load->view('templates/head', $this->data);
      $this->load->view('templates/jeunes', $this->data);
      $this->load->view('templates/foot');
    } elseif ($action == "chmail") {
      $this->chmail();
    } else {
      $this->chmdp();
    }
  }

  public function reference(){
    $this->load->model('reference_model');
<<<<<<< HEAD
    $jeune = $this->session->userdata('logged_in');
=======
    $this->data['validation']=$this->session->userdata('validation');
    $this->data['tab'] = $this->session->userdata('logged_in');
>>>>>>> 5c107706764333cf62129107f1ce12cde1e743e8

    $this->data['content'] = 'reference';
    $this->data['menu'] = 'jeune';
    
    $this->data['references'] = $this->reference_model->getRefByUser($jeune['id']);
    $this->data['nb_references'] = $this->reference_model->countRefUser($jeune['id']);

    $this->load->view('templates/head', $this->data);
    $this->load->view('templates/jeunes', $this->data);
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

  private function chmdp(){
    $this->form_validation->set_rules('mdp', 'mot de passe', 'required|trim|callback_change_mdp_possible');
    $this->form_validation->set_rules('nvmdp', 'nouveau mot de passe', 'required|trim');
    $this->form_validation->set_rules('comdp', 'confirmation du nouveau mot de passe', 'required|trim|matches[nvmdp]');
    $this->output->set_content_type('application/json');
    if ($this->form_validation->run() == false) {
      $this->output->set_status_header('400');
      $this->output->set_output(
        json_encode(array(
          'errors'=>array_filter(explode("\n", validation_errors(NULL, NULL)))
          ))
        );
    } else {
      $this->load->model('users_model');
      $val = $this->users_model->change_mdp();
      $this->output->set_output(json_encode($val));
    }
  }

  public function change_mdp_possible() {
    $mdp = $this->input->post('mdp');
    $id = $this->session->userdata('logged_in')['id'];
    $this->db->select('mdp');
    $this->db->where('id', $id);
    $query = $this->db->get('jeune');
    $qr = $query->row();
    $this->form_validation->set_message('change_mdp_possible', "Le mot de passe n'as pas été changée");
    return ($this->passwordhash->CheckPassword($mdp, $qr->mdp));
  }
}
