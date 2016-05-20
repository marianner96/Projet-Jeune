<?php
class Jeune_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->database();
        }

        public function savoiretre()
        {
                $this->db->select('nom');
                $query = $this->db->get('savoir_etre');
                return $query->result();
        }
}
?>