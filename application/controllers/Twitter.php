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
    $url = $this->connection->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]);

    $this->session->set_userdata('twitter_oauth_token', $request_token['oauth_token']);
    $this->session->set_userdata('twitter_oauth_token_secret', $request_token['oauth_token_secret']);

    redirect($url);
  }

  public function callback(){
    if(!empty($this->input->get('denied'))){
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
      exit;
    }
    var_dump($access_token);
  }
}