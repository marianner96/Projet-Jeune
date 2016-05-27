<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class J64_Controller extends CI_Controller
{
  protected $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('users_model');
    $this->load->helper('url');

    $this->data['is_logged'] = $this->users_model->is_logged();
    $this->data['is_admin'] = $this->users_model->is_admin();
    $this->data['menu'] = $this->uri->segment(1);

  }
}