<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  public function __construct(){
    parent::__construct();

    $this->load->model('users_model');
    
    if(!$this->users_model->is_admin()){
      show_error('Vous n\'avez pas la permission de voir cette page.', 403, 'Accès reffusé');
    }
  }
  public function index(){
    $this->load->view('template/head');
    $this->load->view('template/admin');
    $this->load->view('template/foot');
  }
}
?>
