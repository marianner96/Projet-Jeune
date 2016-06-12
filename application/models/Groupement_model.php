<?php

/**
 * Class Groupement_model
 */
class Groupement_model extends CI_Model
{
  /**
   * Groupement_model constructor.
   */
  public function __construct()
  {
    $this->load->database();
  }

  /**
   * Récupère un groupement de références par les références.
   *
   * @param $refsId array Tableau des ids des références
   * @return array Retourne les groupements contenant les références
   */
  public function getGrpByRefs($refsId)
  {
    $sqlGrp = '
      SELECT *
      FROM groupement
      WHERE id_ref IN (' . implode(',', $refsId) . ')
    ';
    $queryGrp = $this->db->query($sqlGrp);
    return $queryGrp->result_array();
  }

  /**
   * Récupère un groupement par son lien associé
   *
   * @param string $key Lien du groupement à récupérer
   * @param bool $checkUser Indique si le groupement doit appartenir à
   * l'utilisateur connecté
   * @return array Le groupement de référence, les clés du tableau sont les ids
   * des références
   */
  public function getGrpByLink($key, $checkUser = true){
    $sqlGrpCheckUser = '
      SELECT id_ref
      FROM groupement
      JOIN reference ON reference.id = groupement.id_ref
      WHERE lien_consultation = ? AND reference.id_user = ?
    ';
    $sqlGrp = '
      SELECT id_ref
      FROM groupement
      WHERE lien_consultation = ? 
    ';
    $user = $this->session->userdata('logged_in');
    if($checkUser)
      $query = $this->db->query($sqlGrpCheckUser, array($key, $user['id']));
    else
      $query = $this->db->query($sqlGrp, array($key));
    $idRefs = $query->result_array();
    $this->load->model('reference_model');
    $idRefs = array_map(function ($item) {
      return $item['id_ref'];
    }, $idRefs);
    return $this->reference_model->getRefsById($idRefs);
  }

  /**
   * Récupère tout les liens des groupement d'un utilisateur en particulier ansi
   * que le nombre de référence dans les groupement en question.
   *
   * @param int $id Id de l'utilisateur
   * @return array Un tableau de pair lien du groupement / nombre de références
   */
  public function getGrpsLinkByUser($id){
    $sql = '
      SELECT lien_consultation, COUNT(*) AS nb_ref 
      FROM groupement 
      WHERE id_ref IN (
        SELECT id 
        FROM reference 
        WHERE id_user = ?
      )
      GROUP BY lien_consultation
    ';
    $query = $this->db->query($sql, array($id));
    return $query->result_array();
  }

  /**
   * Envoie un groupement par mail au consultant.
   *
   * @param string $cle Clé du groupement à envoyer
   * @param string $mail Email du référent
   * @return void
   */
  public function emailConsultant($cle, $mail){
    $user = $this->session->userdata('logged_in');
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    mail($mail, 'Jeune 6.4 - Liste d\'engagements',"Madame, Monsieur,\n
    $prenom $nom a validé plusieurs savoir-être avec le projet Jeune 6.4 et souhaiterait vous les faire connaître. Le projet Jeune 6.4 est un projet visant à valoriser les savoir-être auprès des recruteurs, employeurs ou représentants d'organisme de formation. Vous pouvez les visualiser en cliquant sur ce lient : " . site_url("/consultant/$cle") . " . \n
Cordialement,
L'équipe de Jeune 6.4");
  }
}
