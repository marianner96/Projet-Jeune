<?php
class Groupement_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

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
   * @param $id
   * @return mixed
   * @deprecated
   * @uses Groupement_model::getGrpByRefs
   */
  public function getGrpsByUser($id)
  {
    $sqlRef = "
      SELECT * 
      FROM reference 
      WHERE 
        id IN (
          SELECT id_ref 
          FROM groupement
        ) 
        AND id_user = ?
    ";
    $query = $this->db->query($sqlRef, array($id));
    $refs = array();
    $refsId = array();
    foreach ($query->result_array() as $reference) {
      $refs[$reference['id']] = $reference;
      $refsId[] = $reference['id'];
    }
    foreach ($this->getSavoirEtreByRefs($refsId) as $refId => $savoir_etre) {
      $refs[$refId]['savoir_etre'] = $savoir_etre;
    }
    foreach ($this->getGrpByRefs($refsId) as $grp) {
      $res[$grp['lien_consultation']][] = $refs[$grp['id_ref']];
    }
    return $res;
  }

  /**
   * @param string $key
   * @param bool $checkUser Indique si le groupement doit appartenir à
   * l'utilisateur connecté
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
   * Permet de récuperer pour chaque groupement du jeune, le lien de consultation et le nomrbe de référence dans le groupement
   *
   * @param $id prend en paramètre une string contenant l'id du jeune
   * @return array Retourne un tableau contenant pour chaque groupement crée par le jeune, le lien du groupement ainsi que le nombre de référence au sein du groupement
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
   * Permet d'envoyer un mail au consultant
   *
   * @param $cle prend en paramètre le lien d groupement
   * @param $mail prend en paramètre l'email du consultant'
   */

  public function emailConsultant($cle, $mail){
    $user = $this->session->userdata('logged_in');
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    mail($mail, 'Jeune 6.4 - Liste d\'engagements',"Madame, Monsieur,\n
    $prenom $nom a validé plusieurs savoir-être avec le projet Jeune 6.4 et souhaiterait vous les partager. Vous pouvez les visualiser en cliquant sur ce lient : " . site_url("/consultant/$cle") . " . \n
Cordialement,
L'équipe de Jeune 6.4");
  }
}
