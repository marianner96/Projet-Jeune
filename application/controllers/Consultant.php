<?php
class Consultant extends J64_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->model('consultant_model');
  }
  public function consultant($lien = ''){
  	  $this->data['jeune'] = $this->savoiretre_model->affiche($lien);
      $this->load->view('templates/head', $this->data);
      $this->load->view('consultant/consultation', $this->data);
      $this->load->view('templates/foot');
  }

}