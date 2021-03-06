<?php

/**
 * Class Users_model
 */
class Users_model extends CI_Model {
  /**
   * Users_model constructor.
   */
  public function __construct(){
    $this->load->database();
    $this->load->library('PasswordHash', array(8, FALSE));
    $this->load->library('session');
    $this->load->helper('date');
  }

  /**
   * Vérifie que le mail et le mdp correspondent bien à un utilisateur. Si c'est
   * le cas, renvoie les information du jeune sinon renvoie false
   *
   * @param string $mail le mail rentrée
   * @param string $password le mdp rentré
   * @return array|bool False si les informations rentrées ne correspondent à
   * aucun utilisateur sinon renvoie le tableau contenant les informations du
   * jeune
   */
  public function login($mail, $password) {
    $this->db->select('id, mail, rang, mdp, nom, prenom, date_naissance');
    $this->db->from('jeune');
    $this->db->where('mail', $mail);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() != 1 ) {
      return false;
    }
    $qr = $query->row();
    if ($this->passwordhash->CheckPassword($password, $qr->mdp)) {
      return array (
        'id'=> $qr->id,
        'mail'=>$qr->mail,
        'rang'=>$qr->rang,
        'prenom'=>$qr->prenom,
        'nom'=>$qr->nom,
        'date_naissance'=>$qr->date_naissance
      );
    } else {
      return false;
    }
  }

  /**
   * Ajoute le jeune dans la bdd et ajoute cet évènement dans son dashboard
   *
   * @return array Le tableau des informations du jeune
   */
  public function create_user(){
    $nom = $this->input->post('nom');
    $prenom = $this->input->post('prenom');
    $mail = $this->input->post('mail');
    $date = $this->input->post('annee') . '-' .$this->input->post('mois') . '-' .$this->input->post('jour');

    $data = array(
      'nom' => $nom,
      'prenom' => $prenom,
      'mail' => $mail,
      'date_naissance' => $date,
      'mdp' => $this->passwordhash->HashPassword($this->input->post('mdp'))
    );
    $this->db->insert('jeune', $data);
    $id_user = $this->db->insert_id();
    $ajout = array(
      'id_user' => $id_user,
      'type' => 1
      );
    $this->db->insert('dashboard', $ajout);
    return array(
      'id' => $id_user,
      'mail' => $mail,
      'rang' => 0,
      'prenom' => $prenom,
      'nom' => $nom,
      'date_naissance' => $date
      );
  }

  /**
   * Récupère les informations du jeune après un loggin via twitter
   *
   * @param int $id ID du jeune
   * @return array Un tableau contenant les informations du jeune
   */
  public function twitterLogin($id){
      $sql = 'SELECT mail, rang, mdp, nom, prenom, date_naissance FROM jeune WHERE id = ?';
      $res = $this->db->query($sql, [$id])->row();
      return [
        'id' => $id,
        'mail' => $res->mail,
        'rang' => $res->rang,
        'prenom' => $res->prenom,
        'nom' => $res->nom,
        'date_naissance' => $res->date_naissance
      ];
    }

  /**
   * Vérifie si l'utilisateur en cours est connecté
   *
   * @return bool TRUE si l'utilisateur est connécté FALSE sinon
   */
  public function is_logged(){
      return $this->session->has_userdata('logged_in');
    }

  /**
   * Vérifie si l'utilisateur en cours est administrateur
   *
   * @return bool TRUE si l'utilisateur en cours est admin FALSE sinon
   */
  public function is_admin(){
    if(!$this->session->has_userdata('logged_in'))
      return false;
    return $this->session->logged_in['rang'] >= 100;
  }

  /**
   * Change le mail dans la bdd
   *
   * @return array Le nombre de lignes qui ont été changées
   */
  public function change_mail(){
    $id_user = $this->session->userdata('logged_in')['id'];
    $nv = $this->input->post('mail');
    $this->db->set('mail', $nv);
    $this->db->where('id', $id_user);
    $this->db->update('jeune');
    return array('affectedRows' => $this->db->affected_rows());
  }

  /**
   * Change le mot de passe dans la bdd
   *
   * @return array le nombre de lignes qui ont été changées
   */
  public function change_mdp() {
    $id_user = $this->session->userdata('logged_in')['id'];
    $nv = $this->passwordhash->HashPassword($this->input->post('nvmdp'));
    $this->db->set('mdp', $nv);
    $this->db->where('id', $id_user);
    $this->db->update('jeune');
    return array('affectedRows' => $this->db->affected_rows());
  }

  /**
   * Inscrit un utilisateur après après un enregistrement via twitter
   *
   * @return array|bool False si une erreur survient à l'ajout du jeune dans la
   * table "jeune", renvoie le tableau contenant les informations du
   * jeune sinon
   */
  public function inscriptionTwitter(){
    $sqlTwitter = '
      INSERT INTO twitter(id,oauth_token,oauth_token_secret,id_user)
      VALUE (?,?,?,?)
    ';
    $sqlJeune = '
      INSERT INTO jeune (nom, prenom, mail, date_naissance) 
      VALUE (?,?,?,?) 
    ';
    $dateNaissance = $this->input->post('annee') . '-' .$this->input->post('mois') . '-' .$this->input->post('jour');
    $this->db->query($sqlJeune, [
      $this->input->post('nom'),
      $this->input->post('prenom'),
      $this->input->post('mail'),
      $dateNaissance
    ]);
    if(!$this->db->affected_rows()){
      return false;
    }
    $userId = $this->db->insert_id();
    $this->db->query($sqlTwitter, [
      $this->session->userdata('twitter_user_id'),
      $this->session->userdata('twitter_oauth_token'),
      $this->session->userdata('twitter_oauth_token_secret'),
      $userId
    ]);
    $this->load->model('jeune_model');
    $this->jeune_model->addInscriptionToDashboard($userId);
    return array (
      'id'=> $userId,
      'mail'=>$this->input->post('mail'),
      'rang'=>0,
      'prenom'=>$this->input->post('prenom'),
      'nom'=>$this->input->post('nom'),
      'date_naissance'=>$dateNaissance
    );
  }

  /**
   * Récupèrte l'ID du jeune à partir de son ID twitter
   *
   * @param int $id ID twitter d'un jeune
   * @return null|int renvoie NULL si l'utilisateur n'est pas enregistré ou
   * l'ID jeune de l'utilisateur si c'est le cas
   */
  public function getTwitterUserId($id){
      $sql = 'SELECT id_user FROM twitter WHERE id = ?';
      $res = $this->db->query($sql, [$id])->row();
      return empty($res) ? NULL : $res->id_user;
    }
  }
?>
