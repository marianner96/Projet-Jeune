<?php
class Consultant extends J64_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->model('consultant_model');
    $this->load->helper('url');
  }
  public function index(){
      $lien=$this->uri->segment(2);
      $tabLienGroupement=$this->consultant_model->verifLien($lien);
      if (count($tabLienGroupement)==0){
        show_404($page = '', $log_error = TRUE);
      }
      else{
          $this->data['jeune'] = $lien;
          $this->data['tabIdRef'] = $this->consultant_model->recupIdRef($lien);
          $this->data['ref'] = $this->consultant_model->recupRef($this->data['tabIdRef']);
          $this->data['savoirEtre'] = $this->consultant_model->recupIdSavoirEtre($this->data['tabIdRef']);
          $this->data['savoirEtreNum'] = $this->consultant_model->recupSavoirEtre($this->data['savoirEtre']);
          $this->data['jeune'] = $this->consultant_model->informationJeune($this->data['ref']);
          $this->load->view('templates/head', $this->data);
          $this->load->view('consultant/consultation', $this->data);
          $this->load->view('templates/foot');
        }     
  }
  public function presentation(){
      $this->load->view('templates/head');
      $this->load->view('home/accueil');
      $this->load->view('templates/foot');
  }

}