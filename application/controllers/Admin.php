<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  public function __construct(){
    parent::__construct();

    $this->load->model('users_model');
    $this->load->model('savoiretre_model');
    $this->load->library('form_validation');

    if(false && !$this->users_model->is_admin()){
      show_error('Vous n\'avez pas la permission de voir cette page.', 403, 'Accès reffusé');
    }
  }
  public function index(){
    $data['title'] = 'Administratioin';
    $data['content'] = 'index';
    $this->load->view('templates/head', $data);
    $this->load->view('templates/admin', $data);
    $this->load->view('templates/foot');
  }
  public function savoir_etre(){
    if($this->uri->total_segments() == 2 ){

      $data['content'] = 'savoir_etre';
      $data['title'] = 'Savoir-être - Administration';
      $data['savoir_etre'] = array(
        'Jeune' => $this->savoiretre_model->getJeune(false),
        'Référent' => $this->savoiretre_model->getReferent(false)
      );

      $this->load->view('templates/head', $data);
      $this->load->view('templates/admin', $data);
      $this->load->view('templates/foot');
    }else{
      $this->output->set_content_type('application/json');
      $this->checkAction();
    }
  }
  private function checkAction(){
    
    $action = $this->uri->segment(3);
    $nbSegments = $this->uri->total_segments();
    if($action == 'create' && $nbSegments == 5) {
      $param['type'] = $this->uri->segment(4);
      $param['nom'] = $this->uri->segment(5);

      $this->form_validation->set_data($param);
      $this->form_validation->set_rules('nom', 'nom du savoir-être', 'urldecode|required|max_length[100]');
      $this->form_validation->set_rules('type', 'type du savoir-être', 'required|in_list[jeune,referent]',
        array(
          'in_list' => 'Le %s doit être soit jeune soit referent'
        )
      );
    }else if (($action == 'delete' || $action == 'toggle') && $nbSegments == 4){
      $param['id'] = $this->uri->segment(4);
      $this->form_validation->set_data($param);

      $this->form_validation->set_rules('id', 'id du savoir-être', 'required|is_natural_no_zero');
    }else{
      $this->output->set_status_header('404');
      exit;
    }
    if($this->form_validation->run() == FALSE){
      $this->output->set_status_header('400')
        ->set_output(
          json_encode(array(
            'errors' => array_filter(explode("\n",validation_errors(NULL,NULL)))
          ))
        )
        ->_display();
      exit;
    }
    $res = call_user_func(array($this->savoiretre_model, $action), $param);
    if($res){
      $this->output->set_status_header(empty($res['errors']) ? 200 : 400);
      $this->output->set_output(json_encode($res));
    }
  }
}
