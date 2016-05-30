<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class LinkGenerator
 *
 * Génère les identifiants uniques utlisés dans la création des liens
 *
 * @author Gaël Berthaud-Müller
 */
class LinkGenerator
{
  private $CI;

  /**
   * LinkGenerator constructor.
   */
  public  function __construct(){
    $this->CI = &get_instance();
    $this->CI->load->database();
  }

  /**
   * Génère un id unique
   *
   * @param int    $nb    le nombre de caractère à générer
   * @param string $salt  sel utilisé pour la génération de la graine de la
   *  fonction srand
   * @param string $table nom de la table pour la vérification de l'existence
   * @param string $field nom du champ de la table $table pour la vérification
   *  de l'existence
   * @return string       l'id généré
   */
  private function generateId($nb, $salt = '', $table, $field){
    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $seed = base_convert(hash('sha512', $salt, true), 16, 10) * (double)microtime() * time();
    srand((int)$seed);
    $res = "";
    $i = $nb;
    for(;$i--;)
      $res .= $chars[rand() % 62];
    return $this->validateID($res, $table, $field) ? $res : $this->generateId($nb, $salt, $table, $field);
  }

  /**
   * Teste l'appertenance d'un id à une base de donnée
   *
   * @param string $id    l'id pour lequel on va tester l'existence dans la base
   *  de donnée
   * @param string $table table de la base de donnée contenant les identifants à
   *  vérifier
   * @param string $field champs de la base de donnée contenant les identifants à
   *  vérifier
   * @return bool retourne FALSE si $id existe déjà TRUE sinon
   */
  private function validateID($id, $table, $field){
    $sql = "SELECT COUNT($field) AS nb FROM $table WHERE $field = ?";
    $query = $this->CI->db->query($sql, array($id));
    $res = $query->row();
    return $res->nb == 0;
  }

  /**
   * Crée un id unique
   *
   * @param int    $nb    la longueur de l'id
   * @param string $salt  sel utilisé lors de la création de l'id
   * @param string $table paramètre de la base de donnée sous la forme
   *  table.champ
   * @return null|string  renvoie l'id généré ou NULL si une erreur est survenue
   */
  public function create($nb, $salt, $table = ''){
    $dbParam = explode('.', $table);

    if(!sizeof($dbParam))
      return NULL;

    return $this->generateId($nb, $salt, $dbParam[0], $dbParam[1]);
  }
}