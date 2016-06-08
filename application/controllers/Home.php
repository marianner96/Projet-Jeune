<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends J64_Controller {

  public function index(){
    if($_SERVER['REQUEST_METHOD'] == 'BREW'){
      $this->output->set_status_header('418', 'I\'m a teapot');
      $this->output->set_output('
                          _
                     ____( )_____
     ___            |            |     ____
     \  \         _---__________---_  / __ \
      \  \       /                  \/ /  \ \
_______|  |_____/                    \/____\ \_________________________________
       |  |    /                      \     | |
        \  \__|                        |    | |      _____________
         \    |                        |    | |      |           |/\
          \   |                        |   / /       |___________|  \
           \__\                        /__/ /        \-----------/  /
               \                      /____/          |---------|__/
                \____________________/               / \ _____ / \
Vicky Wilks      |__________________|                \___________/
');
    }else {
      $this->load->view('home/index');
    }
  }
  
  public function accueil(){
    $this->data['title'] = 'Accueil';

    $this->load->view('templates/head', $this->data);
    $this->load->view('home/accueil');
    $this->load->view('templates/foot');
  }
  
  public function partenaires(){
    $this->data['title'] = 'Partenaires';

    $this->load->view('templates/head', $this->data);
    $this->load->view('home/partenaires');
    $this->load->view('templates/foot');
  }
}
