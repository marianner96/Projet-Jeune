<?php

/**
 * Class Consultant
 * Controlleur du module "consultant". Match les routes de type /consultant/*
 */
class Consultant extends J64_Controller{
  /**
   * Consultant constructor.
   */
  public function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->model('consultant_model');
    $this->load->model('savoiretre_model');
    $this->load->helper('url');
  }
  /**
   * Route /consultant/(clé)
   *
   * Affiche la page par défaut du consultant contenant l'ensemble des
   * références du jeune. Affiche une erreur 404 si la liste d'engagement
   * n'existe pas.
   *
   * @return void
   */
  public function index(){
      $lien=$this->uri->segment(2);
      $this->data['tabRefGroupement']=$this->consultant_model->verifLien($lien);
      if (count($this->data['tabRefGroupement'])==0){
        show_404($page = '', $log_error = TRUE);
      }
      else{
          $this->data['jeune'] = $lien;
          $this->data['ref'] = $this->consultant_model->recupRef($this->data['tabRefGroupement']);
          $this->data['idRef'] = $this->consultant_model->recupIdRef($this->data['tabRefGroupement']);
          $this->data['savoirEtre']=$this->savoiretre_model->getSavoirEtreByRefs($this->data['idRef']);
          $this->data['jeune'] = $this->consultant_model->informationJeune($this->data['ref']);
          $this->load->view('templates/head', $this->data); 
          $this->load->view('consultant/consultation', $this->data);
          $this->load->view('templates/foot');
        }     
  }
}