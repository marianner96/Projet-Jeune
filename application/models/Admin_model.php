<?php
  class Admin_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }

    public function countUsers(){
      return $this->db->count_all_results('jeune');
    }
  }
