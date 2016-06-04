<?php
class Consultant_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
                $this->load->library('session');
        }


        public function recupIdRef($lien)
        {
                $tabIdRef=[];
                $tab=array(
                        'lien_consultation'=>$lien);
                $tabIdRef = $this->db->get_where("groupement",$tab);
                return $tabIdRef->result();
        }



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

        public function recupSavoirEtre($savoirEtre){
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
        for ($i=0; $i <count($tab) ; $i++) { 
                $tabNumRef = explode(" ", $tab[$i]); 
                $this->db->where_in('id', $tabNumRef);
                $this->db->from('savoir_etre');
                $toto = $this->db->get();
                $tab[$i]=$toto->result();  
        }
       return $tab;       
        }
} 
