<?php
class Jeune_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    $this->load->helper('date');
  }

  /**
  *récupère les savoir être actifs
  *
  *@return ?
  */
  public function savoiretre()
  {
    $this->db->select('nom');
    $query = $this->db->get('savoir_etre');
    return $query->result();
  }

  /**
  *crée une référence
  */
  public function creationReferences()
  {
    $this->load->library('linkGenerator');
    $lien = $this->linkgenerator->create(40,"reference.lien_validation");
    $tab = $this->session->userdata('logged_in');
    $this->lang->load('date_lang');
    $duree = $this->input->post('duree');
    $type_duree = 'date_' . $this->input->post('duree_type');
    if($duree > 1)
      $type_duree .= 's';
    $duree .= ' ' .$this->lang->line($type_duree);
    $reference = array(
      'id_user' => $tab['id'] ,
      'description' => set_value('description'),
      'duree' => $duree ,
      'etat' => 1,
      'nom' => set_value('nom') ,
      'prenom' => set_value('prenom'),
      'mail' => set_value('mail'),
      'lien_validation'=> $lien);
    $this->db->insert('reference', $reference);

    $nombre =  count($this->input->post('savoirEtre'));
    $lastID=$this->db->insert_id();

    for($i=0;$i<$nombre;$i++){
      $savoir = array(
      'id_ref'=>$lastID,
      'id_savoir_etre'=>set_value('savoirEtre[]'));
      $this->db->insert('savoir_etre_user',$savoir);
    }

    $this->addRefToDashboard($lastID, $tab['id']); 
    $this->emailReferent($lien, set_value('nom'), set_value('prenom'), set_value('mail'));
  }

  /**
  *envoie un mail au référent
  *
  *@param string $lien : le lien pour confirmer la référence, string $nomRef : le nom du référent
  *string $prenomRef : le prénom du référent, string $mail : le mail du référent
  */
  public function emailReferent($lien, $nomRef, $prenomRef, $mail){
    $sql = 'SELECT nom, prenom FROM jeune WHERE id = ?';
    $user = $this->session->userdata('logged_in');
    $res = $this->db->query($sql, [$user['id']])->row();
    $nom = $res->nom;
    $prenom = $res->prenom;
    mail($mail, 'Jeune 6.4 - Demande de référence',"Bonjour $prenomRef $nomRef,\n
    $prenom $nom aimerait a fait une demande de référence sur le site de Jeune 6.4 et vous a renseigné en tant que référent. Pour que sa référence soit validée vous devez cliquer sur ce lien " . site_url("/referent/validation/$lien") . " . \n
    Cordialement,
    L'équipe de Jeune 6.4");
  }
  
  /**
  * ajoute une reference dans le dashboard
  *
  *@param string $id : l'id de la référence, string $user : l'id de l'utilisateur
  */
  public function addRefToDashboard($id, $user){
    $this->addEntryToDashboard(2, $user, $id);
  }

   /**
  * ajoute un groupement dans le dashboard
  *
  *@param string $lien : lien de consultation, string $user : l'id de l'utilisateur
  */
  public function addGrpToDashboard($lien, $user){
    $this->addEntryToDashboard(4, $user, $lien);
  }

   /**
  * ajoute une référence validée
  *
  *@param string $ref : info sur la référence
  */
  public function addRefvalidateToDashboard($ref){
    $idUser=$ref['id_user'];
    $idRef=$ref['id'];
    $this->addEntryToDashboard(3, $idUser, $idRef); 
  }

  /**
  *ajoute une inscription dans le dashboard
  *
  *@param string $id : l'id du jeune
  */
  public function addInscriptionToDashboard($id){
    $this->addEntryToDashboard(1, $id, NULL);
  }

  /**
  * ajoute un évènement dans le dashboard
  *
  *@param int $type : le type d'entrée, string $user : id du jeune, string ou NULL $opt : option possibles
  */
  private function addEntryToDashboard($type, $user, $opt){
    $dashboard = array(
      'id_user' => $user,
      'type' => $type,
      'options' => $opt
    );
    $this->db->insert('dashboard', $dashboard);
  }

  /**
  *crée le dashboard du jeune
  *
  *@return $tab : tableau avec tous les évènements du jeune
  */
  public function creadash() {
    $sql = 'SELECT `date`, `type`, `options` FROM dashboard WHERE `id_user` = ? ORDER BY date DESC';
    $id_user = $this->session->userdata('logged_in')['id'];
    $query = $this->db->query($sql, array($id_user));
    $tab = $query->result_array();
    return $tab;
  }
} 
?>
