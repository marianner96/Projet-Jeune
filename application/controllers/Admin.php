<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends J64_Controller {
  public function __construct(){
    parent::__construct();

    $this->load->model('savoiretre_model');
    $this->load->model('admin_model');
    $this->load->library('form_validation');

    $this->data['title'] = 'Administration';

    if(false && !$this->data['is_admin']){
      show_error('Vous n\'avez pas la permission de voir cette page.', 403, 'Accès reffusé');
    }
  }
  public function index(){
    $this->data['content'] = 'index';
    $this->data['users_count'] = $this->admin_model->countUsers();
    $this->data['refs_count'] = $this->admin_model->countRefs();

    $this->load->view('templates/head', $this->data);
    $this->load->view('templates/admin', $this->data);
    $this->load->view('templates/foot');
  }
  public function savoir_etre(){
    if($this->uri->total_segments() == 2 ){

      $this->data['content'] = 'savoir_etre';
      $this->data['title'] = 'Savoir-être - ' . $this->data['title'] ;

      $this->data['savoir_etre'] = array(
        'Jeune' => $this->savoiretre_model->getJeune(false),
        'Référent' => $this->savoiretre_model->getReferent(false)
      );
      $this->data['scripts'] = array('utils', 'savoir_etre');

      $this->load->view('templates/head', $this->data);
      $this->load->view('templates/admin', $this->data);
      $this->load->view('templates/foot', $this->data);
    }else{
      $this->output->set_content_type('application/json');
      $this->performAction();
    }
  }
  private function performAction(){
    
    $action = $this->uri->segment(3);
    $nbSegments = $this->uri->total_segments();
    if($action == 'create' && $nbSegments == 5) {
      $param['type'] = $this->uri->segment(4);
      $param['nom'] = $this->uri->segment(5);

      $this->form_validation->set_data($param);
      $this->form_validation->set_rules('nom', 'nom du savoir-être', 'urldecode|required|max_length[100]');
      $this->form_validation->set_rules('type', 'type du savoir-être', 'required|in_list[1,2]',
        array(
          'in_list' => 'Le %s doit être soit 1 (jeune) soit 2 (referent).'
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
