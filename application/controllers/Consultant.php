<?php
class Consultant extends J64_Controller{
  public function __construct(){
    parent::__construct();
  
  }
  public function consultant(){
      $this->load->view('templates/head', $this->data);
      $this->load->view('consultant/consultation', $this->data);
      $this->load->view('templates/foot');
  }
}