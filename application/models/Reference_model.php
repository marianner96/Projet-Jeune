<?php

/**
 * Class Reference_model
 */
class Reference_model extends CI_Model{
  /**
   * Reference_model constructor.
   */
  public function __construct(){
    $this->load->database();
  }

  /**
   * Récupère les informations d'une référence à partir de la clé
   *
   * @param string $cle : la clé de la référence
   * @return array : Retourne un tableau associatif des information d'une référence
   */
  public function getRef($cle){
    $this->db->select();
    $this->db->where('lien_validation', $cle); // selectionne tout parmis ceux qui ont $cle dans le champ lien_validation
    $query = $this->db->get('reference');

    return $query->row_array(); // row array retourne un tableau associatif
  }

  /**
   * Récupère les savoir être associés à une référence
   *
   * @param string $cle : La clé associée à une référence
   * @return array Renvoie les noms des savoirs être associés à la demande dans un tableau
   * @todo nom de la fonction ne va pas avec ce qu'elle fait.
   */
  public function getSavoirByRef($cle){
    // recup id des savoirs etres
    $sqlRef= '
      SELECT nom
      FROM savoir_etre_user
      JOIN savoir_etre ON savoir_etre.id = savoir_etre_user.id_savoir_etre
      WHERE id_ref IN (SELECT id FROM reference WHERE lien_validation = ?) AND savoir_etre_user.type = 1';
    $query = $this->db->query($sqlRef, array($cle));
    foreach ($query->result_array() as $nom){
      $res[]=$nom['nom'];
     }
    return $res;
  }

  /**
   * Récupère les informations associées au jeune
   *
   * Récupère nom|prenom|mail|date de naissance du jeune qui a crée la demande
   *
   * @param string $cle : La clé associée à la référence
   * @return array Renvoie un tableau associatif contenant les informations du jeune
   */
  public function getInfoJeuneByRef($cle){
    //recupere id du jeune
    $this->db->select('id_user');
    $this->db->where('lien_validation', $cle); // selectionne tout parmis ceux qui ont $ref dans le champ lien_validation
    $query = $this->db->get('reference');
    $idJeune = $query->row_array();

    //recupere info jeune
    $this->db->select();
    $this->db->where('id', $idJeune['id_user']); // selectionne tout parmis ceux qui ont $ref dans le champ lien_validation
    $query = $this->db->get('jeune');
    $jeune = $query->row_array();
    return $jeune;
  }

  /**
   * @param int $id : id associé au jeune
   * @return array
   * @todo rajouter savoir etre referent
   */
  public function getRefByUser($id){
    $sqlRef = '
      SELECT id, description, duree, commentaire, etat, nom, prenom, DATE_FORMAT(date_naissance, \'%d/%m/%Y\') AS naissance, mail
      FROM reference
      WHERE id_user = ?
     ';
    $queryRef = $this->db->query($sqlRef, array($id));
    $refsId = [];
    $res = array();
    foreach ($queryRef->result_array() as $ref){
      $res[$ref['id']] = $ref;
      $res[$ref['id']]['savoir_etre'] = [];
      $refsId[] = $ref['id'];
    }
    $this->load->model('savoiretre_model');
    foreach ($this->savoiretre_model->getSavoirEtreByRefs($refsId) as $id_ref => $se){
      $res[$id_ref]['savoir_etre'] = $se['jeune'];
    }
    return $res;
  }

  public function getRefsById($idRefs){
    if(empty($idRefs))
        return NULL;
    $sql = '
      SELECT id, description, duree, commentaire, etat, nom, prenom, DATE_FORMAT(date_naissance, \'%d/%m/%Y\') AS naissance, mail
      FROM reference
      WHERE id IN ('.implode(',',$idRefs).')
    ';
    $query = $this->db->query($sql);
    $res = [];
    $refIds = [];
    foreach ($query->result_array() as $reference) {
      $res[$reference['id']] = $reference;
      $refIds[] = $reference['id'];
    }
    $this->load->model('savoiretre_model');
    foreach ($this->savoiretre_model->getSavoirEtreByRefs($refIds) as $id_ref => $savoir_etre){
      $res[$id_ref]['savoir_etre'] = $savoir_etre;
    }
    return $res;
  }

  /**
   * @param int $id : id associé au jeune
   * @return array
   */
  public function countRefUser($id){
    $sql = '
      SELECT etat, COUNT(*) AS nb
      FROM reference
      WHERE id_user = ?
      GROUP BY etat
    ';
    $query = $this->db->query($sql, array($id));
    $res = array(1 => 0, 2 => 0, 3 => 0);
    foreach ($query->result_array() as $row){
      $res[$row['etat']] = $row['nb'];
    }
    return $res;
  }

  /**
   * @param $grp
   * @return mixed
   */
  public function creerGrp($grp){
    $this->load->library('LinkGenerator');
    $lien = $this->linkgenerator->create(40, 'groupement.lien_consultation');
    $sql = "INSERT INTO groupement (lien_consultation, id_ref) VALUES ('$lien', ?)";
    foreach ($grp as $id_ref) {
      $this->db->query($sql, ['id' => $id_ref]);
    }
    return $lien;
  }

  /**
   * @param $id
   */
  public function archiver($id){
    $sql = 'UPDATE reference SET etat=3 WHERE id = ?';
    $this->db->query($sql, [$id]);
  }

  /**
   * Ajoute à la base de donnée les informations remplies par le référent
   * 
   * Récupère l'id de la référence, puis met à jour les informations date-de-naissance|commentaire et change la valeur etat=2
   *
   * @param array $infoRef : tableau associatif des informations de la référence
   */
  public function addInfoReferent($infoRef){ // Ajoute la date de naissance du référent dans la table reference
    $naissance=$this->input->post('anneeNaissance')."-".$this->input->post('moisNaissance')."-".$this->input->post('jourNaissance');
    $commentaire=$this->input->post('commentary');
    $referent = array(
      'date_naissance' => $naissance ,
      'commentaire' => $commentaire ,
      'etat' => 2
      );
    $this->db->where('id', $infoRef['id']);
    $this->db->update('reference', $referent);
  }

  /**
   * Ajoute à la base de donnée les savoir être entrés par le référent
   *
   * Ajoute le lien dans savoir-etre-user vers les savoirs être correspondant à ceux entrés par le référent
   *
   * @param array $infoRef : tableau associatif des informations de la référence
   */
  public function addSavoirRef($infoRef){ // Ajoute les savoirs être référents
    $listSavoir=$this->input->post('savoirEtre');
    foreach ($listSavoir as $id) { // Pour chaque savoir être on cree un lien
      $entree=array(
        'id_ref' => $infoRef['id'] ,
        'id_savoir_etre' => $id ,
        'type' => "2"
        );
      $this->db->insert('savoir_etre_user', $entree);
    }
  }

  /**
   *
   * @param $ref
   */
  public function checkRef($ref){
    $this->db->select('etat');
    $this->db->where('lien_validation', $ref); // selectionne tout parmis ceux qui ont $ref dans le champ lien_validation
    $query = $this->db->get('reference');
    $etat = $query->row_array();

    return $etat['etat'];
  }


}

