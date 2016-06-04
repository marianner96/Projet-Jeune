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
        public function recupIdRef($lien)
        {
                $tabIdRef=[];
                $tab=array(
                        'lien_consultation'=>$lien);
                $tabIdRef = $this->db->get_where("groupement",$tab);
                return $tabIdRef->result();
        }

//prend en paramètre ce que renvoie la fonction precedente
//retourne un tableau composé des références appartenant au groupement

        public function recupRef($tabIdRef)
        {
        $acc=[];
        for ($i=0; $i <count($tabIdRef) ; $i++) { 
           array_push($acc,$tabIdRef[$i]->id_ref);     
        }
        $this->db->where_in('id', $acc);
        $this->db->from('reference'); 
        $toto = $this->db->get();
        return $toto->result();
        }

//prend en paramètre ce que renvoie la fonction precedente
//retourne un tableau avec les elements de la table savoir_etre_user corrsepondant au référence du groupement
        public function recupIdSavoirEtre($tabIdRef){
         $acc=[];
        for ($i=0; $i <count($tabIdRef) ; $i++) { 
           array_push($acc,$tabIdRef[$i]->id_ref);     
        }
        $this->db->where_in('id_ref', $acc);
        $this->db->from('savoir_etre_user');
        $toto = $this->db->get();
        return $toto->result();       
        }

//prend en paramètre ce que renvoie la fonction precedente
//retourne un tableau avec pour chaque référence, les elements de la table savoir-être correspondant

        public function recupSavoirEtre($savoirEtre){
        //on commence par récuperer les id des savoir-être
        $acc="";
        $num=0;
        $tab=[];
        $numRef=$savoirEtre[0]->id_ref;
        for ($i=0; $i <count($savoirEtre); $i++) { 
               if (($savoirEtre[$i]->id_ref!=$numRef)){
                        $numRef=$savoirEtre[$i]->id_ref;
                        $tab[$num]=$acc;
                        $acc=$savoirEtre[$i]->id_savoir_etre;
                        $num=$num+1;
               }
               else{
                        $acc=$acc . " " . $savoirEtre[$i]->id_savoir_etre;
               }
               if ($i==count($savoirEtre)-1){
                $tab[$num]=$acc;
               }
        }
        //après avoir construit un tableau $tab contenant pour chaque référence, les id des savoir être correspondant, on récupere les information de ces savoir-être
        for ($i=0; $i <count($tab) ; $i++) { 
                $tabNumRef = explode(" ", $tab[$i]); 
                $this->db->where_in('id', $tabNumRef);
                $this->db->from('savoir_etre');
                $toto = $this->db->get();
                $tab[$i]=$toto->result();  
        }
       return $tab;       
        }

        public function informationJeune($ref){
                $idJeune = $ref[0]->id_user;
                $infoJeune = $this->db->get_where('jeune', array('id' => $idJeune));
                return $infoJeune->result();
        }
} 
