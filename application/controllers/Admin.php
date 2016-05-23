<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  public function __construct(){
    parent::__construct();

    $this->load->model('users_model');
    $this->load->model('admin_model');
    
    if(false && !$this->users_model->is_admin()){
      show_error('Vous n\'avez pas la permission de voir cette page.', 403, 'Accès reffusé');
    }
  }
  public function index(){
    $data['title'] = 'Adminitration';
    $data['content'] = 'index';
    $this->load->view('templates/head', $data);
    $this->load->view('templates/admin', $data);
    $this->load->view('templates/foot');
  }
  public function savoir_etre($action = ''){
    $data['content'] = 'savoir_etre';
    $data['title'] = 'Savoir-être - Administration';
    $data['jeune_savoir_etre'] = $this->admin_model->getJeuneSavoirEtre();
    $data['referent_savoir_etre'] = $this->admin_model->getReferentSavoirEtre();
    $this->load->view('templates/head', $data);
    $this->load->view('templates/admin', $data);
    $this->load->view('templates/foot');
  }
}
?>
