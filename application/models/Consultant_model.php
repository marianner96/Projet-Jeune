<?php
class Consultant_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
                $this->load->library('session');
        }

        public function verifLien($lien){
            $tabLienGroupement = $this->db->get_where('groupement', array('lien_consultation' => $lien));
            return $tabLienGroupement->result();
        }

//prend en paramètre la chaine de 40 caractère de l'url
//retourne un tableau composé des elements de la table groupement dont l'url correspondant à l'url en cour
        public function recupRefGroupement($lien)
        {
                $tabIdRef=[];
                $tab=array(
                        'lien_consultation'=>$lien);
                $tabIdRef = $this->db->get_where("groupement",$tab);
                return $tabIdRef->result();
        }

//prend en paramètre ce que renvoie la fonction precedente
//retourne un tableau composé des références appartenant au groupement

        public function recupRef($tabRefGroupement)
        {
        $acc=[];
        for ($i=0; $i <count($tabRefGroupement) ; $i++) { 
           array_push($acc,$tabRefGroupement[$i]->id_ref);     
        }
        $this->db->where_in('id', $acc);
        $this->db->from('reference'); 
        $toto = $this->db->get();
        return $toto->result();
        }


        public function recupIdRef($tabRefGroupement){
            $tabId=[];
            for ($i=0; $i <count($tabRefGroupement) ; $i++) { 
                $tabId[$i]=$tabRefGroupement[$i]->id_ref;
            }
            return $tabId;
        }
        
        public function informationJeune($ref){
                $idJeune = $ref[0]->id_user;
                $infoJeune = $this->db->get_where('jeune', array('id' => $idJeune));
                return $infoJeune->result();
        }
} 
