<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  public function accueil(){
    $data['title'] = 'Accueil';
    $this->load->view('home/index');
  }
}
