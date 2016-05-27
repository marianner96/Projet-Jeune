<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends J64_Controller {

  public function index(){
    $this->load->view('home/index');
  }
  
  public function accueil(){
    $this->data['title'] = 'Accueil';

    $this->load->view('templates/head', $this->data);
    $this->load->view('home/accueil');
    $this->load->view('templates/foot');
  }
  
  public function partenaires(){
    $this->data['title'] = 'Partenaires';

    $this->load->view('templates/head', $this->data);
    $this->load->view('home/partenaires');
    $this->load->view('templates/foot');
  }
}
