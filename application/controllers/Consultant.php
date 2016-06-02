<?php
class Consultant extends J64_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->model('consultant_model');
    $this->load->helper('url');
  }
  public function consultant(){
      $lien=$this->uri->segment(3);
  	  $this->data['jeune'] = $lien;
      $this->load->view('templates/head', $this->data);
      $this->load->view('consultant/consultation', $this->data);
      $this->load->view('templates/foot');
  }
  public function presentation(){
      $this->load->view('templates/head');
      $this->load->view('home/accueil');
      $this->load->view('templates/foot');
  }

}