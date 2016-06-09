<?php

/**
 * Class Jeune
 * Controlleur du module "jeune". Match les routes de type /jeune/*
 */
class Jeune extends J64_Controller{
  /**
   * Jeune constructor.
   */
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

  /**
   * Route : /jeune/index
   *
   * Page par défaut du module jeune.
   */
  public function index(){
    $this->data['content'] = 'accueil';

    $this->data['tableau'] = $this->Jeune_model->creadash();  //récupération des données du jeune (inscription/reference)

    $this->load->view('templates/head', $this->data);
    $this->load->view('templates/jeunes', $this->data);
    $this->load->view('templates/foot');
  }

  /**
   * Route /jeune/nouvelleDemande
   *
   * Affiche le form de création de reference et créer la référence.
   *
   */
  public function nouvelleDemande(){
    $this->load->helper(array('form', 'url'));
    
    $this->form_validation->set_rules('savoirEtre[]','SavoirEtre','required|callback_savoirEtre_check');
    $this->form_validation->set_rules('description', 'Description', 'required');
    $this->form_validation->set_rules('duree', 'Durée', 'required|is_natural|max_length[43]');
    $this->form_validation->set_rules('prenom', 'Prénom', 'required|max_length[100]');
    $this->form_validation->set_rules('duree_type', 'Type de durée', 'required|in_list[day,week,month,year]', array('in_list'=>'%s ne peut contenir que jour,semaine,mois ou année'));
    $this->form_validation->set_rules('nom', 'Nom', 'required|max_length[100]');
    $this->form_validation->set_rules('mail', 'Mail', 'valid_email|required|max_length[100]');

    $this->data['query'] = $this->savoiretre_model->getJeune();
    $this->data['favori'] = $this->savoiretre_model->getFavori();
    $this->data['content'] = 'formulaire';
    if ($this->form_validation->run() == FALSE){
      $this->load->view('templates/head', $this->data);
      $this->load->view('templates/jeunes', $this->data);
      $this->load->view('templates/foot');
    }
    else{
      $this->Jeune_model->creationReferences();
      $this->session->set_flashdata('validation', [$this->input->post('nom'), $this->input->post('prenom')]);
      redirect('/jeune/reference');
    }
  }

  /**
   * Route /jeune/profil/$action
   *
   * Affiche la vue du profil ou execute l'action demandée.
   * Affiche une erreur 404 si l'action ne fait pas partie des actions
   *  attendues.
   *
   * @param string $action : [""|"chmdp"|chmail"]
   */
  public function profil($action=""){
    if ($action == "")  {
      $this->data['content'] = 'profil';
      $tab = $this->session->userdata('logged_in'); //recupération des données de session
      $this->data['tab'] = $tab;

      $this->load->view('templates/head', $this->data);
      $this->load->view('templates/jeunes', $this->data);
      $this->load->view('templates/foot');

    } elseif ($action == "chmail") {
      $this->chmail();
    } elseif ($action == "chmdp") {
      $this->chmdp();
    } else {
      show_404();
    }
  }

  /**
   * Route /jeune/reference
   *
   * Affiche la vue reference.
   */
  public function reference(){
    $this->load->model('reference_model');
    $jeune = $this->session->userdata('logged_in');
    $this->data['validation']=$this->session->userdata('validation');
    $this->data['tab'] = $this->session->userdata('logged_in');

    $this->data['content'] = 'reference';
    $this->data['title'] = 'Mes engagements';
    $footerData['scripts'] = ['references', 'utils'];

    $this->data['references'] = $this->reference_model->getRefByUser($jeune['id']);
    $this->data['nb_references'] = $this->reference_model->countRefUser($jeune['id']);

    $this->load->view('templates/head', $this->data);
    $this->load->view('templates/jeunes', $this->data);
    $this->load->view('templates/foot', $footerData);
  }

  /**
   * Route /jeune/creer-groupement
   *
   * Créer un groupement.
   * En cas d'erreur, affiche les erreurs avec le status 400.
   * En cas de réussite répond avec le status 200.
   *
   */
  public function creer_groupement(){
    $err = array();
    $grp = $this->input->post('grp');
    if(!is_array($grp)){
      $err[] = 'Il semblerait que vous n\'ayez pas spécifé de références.';
    }else{
      foreach($grp as $ref){
        if(!$this->checkRefGrp($ref))
          $err[] = 'Vous n\'avez pas accès à la cette référence n°'. $ref . '. Raisons possibles : vous n\'avez pas les droits nécessaire, elle n\'existe pas, elle n\'est pas dans l\'état "validée".';
      }
    }
    $this->output->set_content_type('application/json');
    if(!empty($err)) {
      $this->output->set_status_header('400');
      $this->output->set_output(
        json_encode(['errors' => $err])
      );
      $this->output->_display();
      exit;
    }
    $this->load->model('reference_model');
    $this->load->model('jeune_model');
    $this->load->library('session');
    $lien = $this->reference_model->creerGrp(array_unique($grp));
    $user = $this->session->userdata('logged_in');
    $this->jeune_model->addGrpToDashboard($lien, $user['id']);
    $this->output->set_output(json_encode(['lien' => $lien]));
  }

  /**
   * Route /jeune/archive-reference
   *
   * Archive une référence.
   * En cas d'erreur, affiche les erreurs avec le status 400.
   * En cas de réussite répond avec le status 200.
   */
  public function archiver_reference(){
    $id = $this->input->post('id');
    if(!$this->checkIdRef($id)){
      $this->output->set_content_type('application/json');
      $this->output->set_status_header('400');
      $this->output->set_output(json_encode(['errors' => 'Vous n\'avez pas accès à la cette référence n°'. $id . '. Raisons possibles : vous n\'avez pas les droits nécessaire, elle n\'existe pas, elle n\'est pas dans l\'état "validée".']));
      $this->output->_display();
      exit;
    }
    $this->load->model('reference_model');
    $this->reference_model->archiver($id);
  }


  /**
   * Route /jeune/listes-engagements
   */
  public function listes_engagements(){
    $this->data['title'] = 'Mes listes d\'engagements';
    $this->data['content'] = 'listes';
    $this->data['scripts'] = ['utils', 'listes'];
    $this->load->model('groupement_model');
    $this->load->library('session');
    $userInfo = $this->session->userdata('logged_in');
    $this->data['grp'] = $this->groupement_model->getGrpsLinkByUser($userInfo['id']);
    $this->load->view('templates/head', $this->data);
    $this->load->view('templates/jeunes', $this->data);
    $this->load->view('templates/foot', $this->data);
  }

  public function get_liste($key = ''){
    $this->load->model('groupement_model');
    $res = $this->groupement_model->getGrpByLink($key);
    if(!$res){
      $this->output->set_status_header('404');
    }
    $this->load->view('partials/liste.php', ['grps' => $res]);
  }

  public function send_list($key = ''){ 
    $this->load->model('groupement_model');
    $res = $this->groupement_model->getGrpByLink($key);
    if(!$res){
      $this->output->set_status_header('404');
      $this->output->_display();
    }
    $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email');
    if ($this->form_validation->run() == FALSE){ 
      $this->output->set_status_header('400');
      $this->output->set_output(
        json_encode(array(
          'errors'=> array_filter(explode("\n", validation_errors(NULL,NULL))) //affichage des erreurs de validation
          ))
        );
    }else{
      $this->groupement_model->emailConsultant($key, $this->input->post('email'));
    }
  }

  /**
   * Véréfie si l'utilisateur a entrée un nombre correct de savoir être
   *
   * @param string $chaine Un savoir etre
   * @return bool|string Retourne le savoir etre s'il y a au plus quatre savoir
   *  être qui on été envoyé au serveur FALSE sinon
   */
  public function savoirEtre_check($chaine){
    if (count($this->input->post('savoirEtre'))>4) {
      $this->form_validation->set_message('savoirEtre_check', 'Veuillez choisir au maximum 4 options');
      return FALSE;
    }
    else {
      return $chaine;
    }
  }

  /**
   * Vérifie qu'une référence existe, appartient à l'utilisateur connecté et a
   *  l'etat "validée" (2)
   *
   * @param int $id_ref L'id de la référence
   * @return bool Renvoie TRUE si l'utilisateur peut accéder à la référence,
   *  FALSE sinon
   */
  private function checkRefGrp($id_ref){
    $this->load->database();
    $this->load->library('session');
    $sql = 'SELECT id_user FROM reference WHERE id = ? AND etat = 2';
    $user = $this->session->userdata('logged_in');
    $res = $this->db->query($sql, [$id_ref])->row_array();
    return !empty($res) && $res['id_user'] == $user['id'];
  }

  /**
   * Vérifie qu'une référence existe et appartient à l'utilisateur connecté
   *
   * @param int $id_ref L'id de la référence
   * @return bool Renvoie TRUE si l'utilisateur peut accéder à la référence,
   *  FALSE sinon
   */
  private function checkIdRef($id_ref){
    $this->load->database();
    $this->load->library('session');
    $user = $this->session->userdata('logged_in');
    $sql = 'SELECT COUNT(*) AS nb FROM reference WHERE id = ? AND id_user = ?';
    $res = $this->db->query($sql, [$id_ref, $user['id']])->row_array();
    return $res['nb'] == 1;
  }

  /**
   * Change l'email de l'utilisateur connecté.
   *
   * En cas d'erreur, affiche les erreurs avec le status 400.
   * En cas de réussite répond avec le status 200 et affiche le nombre de lignes
   *  affectées dans la base de données.
   * 
   * @uses Jeune::changement_mail_possible
   */
  private function chmail(){
    $this->form_validation->set_rules('mail', 'e_mail', 'required|valid_email|callback_changement_mail_possible'); 
    $this->output->set_content_type('application/json');
    if ($this->form_validation->run()==false) {
      $this->output->set_status_header('400');
      $this->output->set_output(
        json_encode(array(
          'errors'=> array_filter(explode("\n", validation_errors(NULL,NULL))) //affichage des erreurs de validation
          ))
        );
    }

  }

  /**
   * Change l'email de l'utilisateur connectée.
   *
   * Cette fonction est appelée après que s'être assuré qu'un email valide
   * a été fourni par l'utilisateur. Si l'utilisateur veut changer un email par
   * le même, on définie une erreur pour qu'elle lui soit affichée. Si toutes
   * les conditions sont réunies l'email sera changée et affiche le nombre de
   * lignes affectées dans la base de données.
   *
   * @return bool TRUE si l'email à été changé FALSE sinon
   */
  public function changement_mail_possible(){
    $ma = $this->input->post('mail'); //recuperation de l'email envoyé
    $tab = $this->session->userdata('logged_in'); //donnéesde session
    $mail = $tab['mail']; // mail du jeune
    if ($ma == $mail) {
      $this->form_validation->set_message('changement_mail_possible', "L'adresse mail n'as pas été changée"); //si le mail n'as pas été changé
      return FALSE;
    }
    $this->load->model('users_model'); 
    $val = $this->users_model->change_mail(); //modèle qui change le mail dans la bdd
    $this->output->set_output(json_encode($val));
    $mail = $ma;
    return TRUE;
  }

  /**
   * Change le mot de passe de l'utilisateur connecté.
   *
   * En cas d'erreur, affiche les erreurs avec le status 400.
   * En cas de réussite répond avec le status 200 et affiche le nombre de lignes
   *  affectées dans la base de données.
   * @todo Longueur minimum du mot de passe
   */
  private function chmdp(){
    $this->form_validation->set_rules('mdp', 'mot de passe', 'trim|callback_change_mdp_possible');
    $this->form_validation->set_rules('nvmdp', 'nouveau mot de passe', 'required|trim');
    $this->form_validation->set_rules('comdp', 'confirmation du nouveau mot de passe', 'required|trim|matches[nvmdp]'); //verification si la verification du mdp est la meme que le nouveau mdp
    $this->output->set_content_type('application/json');
    if ($this->form_validation->run() == false) {
      $this->output->set_status_header('400');
      $this->output->set_output(
        json_encode(array(
          'errors'=>array_filter(explode("\n", validation_errors(NULL, NULL))) //affichage des erreurs de validation
          ))
        );
    } else {
      $this->load->model('users_model');
      $val = $this->users_model->change_mdp(); //modèle qui change le mot de passe
      $this->output->set_output(json_encode($val));
    }
  }

  /**
   *
   * Vérifie si le mot de passe entrée est correct. Si ce n'est pas le cas, on
   * définie une erreur pour qu'elle lui soit affichée.
   *
   * @return bool TRUE si l'utilisateur a saisi son mot de passe FALSE sinon
   */
  public function change_mdp_possible() {
    $mdp = $this->input->post('mdp');
    $id = $this->session->userdata('logged_in')['id']; //recuperation de l'id du jeune
    $this->db->select('mdp'); // recherche  du mot de passe haché dans la bdd
    $this->db->where('id', $id); 
    $query = $this->db->get('jeune');
    $qr = $query->row();
    $this->form_validation->set_message('change_mdp_possible', "Mot de passe inconrect."); //le message d'erreur
    if ($qr->mdp==NULL) {
      return true;
    }
    return ($this->passwordhash->CheckPassword($mdp, $qr->mdp)); //regarde si les mdp sont les mêmes 
  }
}
