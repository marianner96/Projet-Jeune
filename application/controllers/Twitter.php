<?php
/**
 * Created by PhpStorm.
 * User: zorg
 * Date: 07/06/16
 * Time: 18:58
 */


require_once (APPPATH. 'third_party/twitteroauth/autoload.php');

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter extends CI_Controller{

  private $connection;

  public function __construct(){
    parent::__construct();
    $this->config->load('twitter');
    $this->load->library('session');
    $this->load->helper('url');
    $this->connection = new TwitterOAuth($this->config->item('twitter_consumer_key'), $this->config->item('twitter_consumer_secret'));
  }

  public function auth(){
    $request_token = $this->connection->oauth('/oauth/request_token', ['oauth_callback' => site_url('/twitter/callback')]);
    $url = $this->connection->url('oauth/authenticate', ['oauth_token' => $request_token['oauth_token']]);

    $this->session->set_userdata('twitter_oauth_token', $request_token['oauth_token']);
    $this->session->set_userdata('twitter_oauth_token_secret', $request_token['oauth_token_secret']);

    redirect($url);
  }

  public function callback(){
    $denied = $this->input->get('denied');
    if(!empty($denied)){
      redirect('/connexion');
    }
    $oauth_token = $this->session->userdata('twitter_oauth_token');
    $oauth_token_secret = $this->session->userdata('twitter_oauth_token_secret');
    $oauth_token_get = $this->input->get('oauth_token');
    $oauth_verifier = $this->input->get('oauth_verifier');

    if($oauth_token != $oauth_token_get){
      show_error('Problème lors de l \'authentification.', 401, 'Voilà qui est fâcheux');
    }
    $this->connection->setOauthToken($oauth_token, $oauth_token_secret);
    try {
      $access_token = $this->connection->oauth('oauth/access_token', ['oauth_verifier' => $oauth_verifier]);
    }catch (Exception $e){
      show_error($e->getMessage(), $this->connection->getLastHttpCode(), 'Voilà qui est fâcheux');
    }
    $this->load->model('users_model');
    $id = $this->users_model->getTwitterUserId($access_token['user_id']);
    if($id == NULL) {
      $this->session->set_userdata('terminer_inscription', 'twitter');
      $this->session->set_userdata('twitter_oauth_token', $access_token['oauth_token']);
      $this->session->set_userdata('twitter_oauth_token_secret', $access_token['oauth_token_secret']);
      $this->session->set_userdata('twitter_user_id', $access_token['user_id']);
      redirect('/connexion/terminer-inscription');
    }else {
      $user_info = $this->users_model->twitterLogin($id);
      $this->session->set_userdata('logged_in', $user_info);
      redirect('/jeune');
    }
  }
}