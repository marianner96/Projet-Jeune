<?php
class Consultant extends J64_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->model('consultant_model');
  
  }
  public function consultant(){
  	  $this->data['monUrl'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
      $this->load->view('templates/head', $this->data);
      $this->load->view('consultant/consultation', $this->data);
      $this->load->view('templates/foot');
  }
}