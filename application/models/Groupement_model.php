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

  public function getGrpByLink($key){
    $sqlGrp = '
      SELECT id_ref
      FROM groupement
      WHERE lien_consultation = ?
    ';
    $query = $this->db->query($sqlGrp, array($key));
    $idRefs = $query->result_array();
    $this->load->model('reference_model');
    $idRefs = array_map(function ($item) {
      return $item['id_ref'];
    }, $idRefs);
    return $this->reference_model->getRefsById($idRefs);
  }

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
}