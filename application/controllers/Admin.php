<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin
 * Controlleur du module "administrateur". Match les routes de type /admin/*
 */
class Admin extends J64_Controller {

  /**
   * Admin constructor.
   */
  public function __construct(){
    parent::__construct();

    $this->load->model('savoiretre_model');
    $this->load->model('admin_model');
    $this->load->library('form_validation');

    $this->data['title'] = 'Administration';

    if(!$this->data['is_admin']){
      show_error('Vous n\'avez pas la permission de voir cette page.', 403, 'Accès reffusé');
    }
  }
  
  /**
   * Route /admin | /admin/index
   *
   * Page d'index du controlleur admin, affiche des statistiques sur le site :
   * nombre d'utilisateurs/de références/de références validée
   *
   * @return void
   */
  public function index(){
    $this->data['content'] = 'index';
    $this->data['users_count'] = $this->admin_model->countUsers();
    $this->data['refs_count'] = $this->admin_model->countRefs();

    $this->load->view('templates/head', $this->data);
    $this->load->view('templates/admin', $this->data);
    $this->load->view('templates/foot');
  }

  /**
   * Route /admin/savoir-etre/[(action)/(parametres)]
   *
   * Affiche les savoir être activés et desactivés du jeune et du référents avec
   * possibilité de changer l'état et d'en ajouter
   *
   * @return void
   */
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

  /**
   * Route /admin/utilisateurs
   *
   * Affichage des membres du site : nom prénom des jeunes, email,
   * rang(administrateur ou non) et possibilité de les supprimer
   *
   * @param int $page
   * @return void
   */
  public function utilisateurs($page = 1){
    if(!is_numeric($page) || $page < 1){
      show_404();
    }
    $this->data['content'] = 'users';
    $this->data['title'] = 'Utilisateurs - ' . $this->data['title'] ;
    $this->data['page'] = $page;
    $this->data['users'] = $this->admin_model->getUsers($page);
    $this->data['nbUsers'] = $this->admin_model->countUsers();
    $this->data['scripts'] = ['utils', 'users'];

    $this->load->library('pagination');
    $config['base_url'] = site_url('/admin/utilisateurs/');
    $config['total_rows'] = $this->data['nbUsers'];
    $config['per_page'] = 10;
    $config['use_page_numbers'] = TRUE;
    $config['full_tag_open'] = '<div class="ui pagination menu">';
    $config['full_tag_close'] = '</div>';
    $config['attributes'] = array('class' => 'item');
    $config['cur_tag_open'] = '<a class="item active">';
    $config['cur_tag_close'] = '</a>';
    $this->pagination->initialize($config);

    $this->load->view('templates/head', $this->data);
    $this->load->view('templates/admin', $this->data);
    $this->load->view('templates/foot', $this->data);
  }

  /**
   *
   * Execute une action sur les savoir être. Actions : create / toggle / delete
   *
   * @return void
   * @todo Diviser cette fonction en plusieurs : une par route
   */
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
      $this->output->set_status_header('400')
        ->set_output(json_encode(array('errors' => ["Requête invalide"]))
        )
        ->_display();
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

  /**
   * Route /admin/toggle-admin
   *
   * Passe un utilisateur normal en administrateur et inversement
   *
   * @return void
   */
  public function toggle_admin(){
    $id = $this->input->post('id_user');
    $ok = $this->admin_model->toggleAdmin($id);
    $err = [];
    if(!$ok){
      $err[] = 'Cet utilisateur n\'existe pas.';
    }
    $this->output->set_content_type('application/json');
    $this->output->set_status_header(empty($err) ? 200 : 400);
    $this->output->set_output(json_encode(['errors' => $err]));
  }

  /**
   * Route /admin/delete-user
   *
   * Supprime un utilisateur
   *
   * @return void
   */
  public function delete_user(){
    $id = $this->input->post('id_user', 0);
    var_dump($id);
    $this->admin_model->deleteUser($id);
  }
}
