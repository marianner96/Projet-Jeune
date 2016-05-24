<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  public function __construct(){
    parent::__construct();

    $this->load->model('users_model');
    $this->load->model('savoiretre_model');
    
    if(false && !$this->users_model->is_admin()){
      show_error('Vous n\'avez pas la permission de voir cette page.', 403, 'Accès reffusé');
    }
  }
  public function index(){
    $data['title'] = 'Adminitratioin';
    $data['content'] = 'index';
    $this->load->view('templates/head', $data);
    $this->load->view('templates/admin', $data);
    $this->load->view('templates/foot');
  }
  public function savoir_etre(){
    if($this->uri->total_segments() == 2 ){
      $data['content'] = 'savoir_etre';
      $data['title'] = 'Savoir-être - Administration';
      $data['jeune_savoir_etre'] = $this->savoiretre_model->getJeune();
      $data['referent_savoir_etre'] = $this->savoiretre_model->getReferent();
      $this->load->view('templates/head', $data);
      $this->load->view('templates/admin', $data);
      $this->load->view('templates/foot');
    }else{
      $this->output->set_content_type('application/json');
      $this->checkAction();
    }
  }
  private function checkAction(){
    $param = $this->uri->uri_to_assoc();
    print_r($param);
    if(empty($param['action'])){
      $this->output->set_status_header('404');
      exit;
    }
    if($param['action'] == 'new' && !empty($param['nom']) && !empty($param['type'])){
      //Créaction d'un savoir être
    }else if ($param['action'] == 'toggle' && !empty($param['id'])){
      //Activation / Desactivation d'un savoir être
    }else if ($param['action'] == 'supprimer' && !empty($param['id'])){
      // Suppression d'un savoir être
    }else{ 
      $this->output->set_status_header('404');
      exit;
    }
  }
}
?>
