<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of artisan_model
 *
 * @author Alex
 */
class Artisans_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getartisans() {
        $this->db->where('artisans_geocode_statut', "OK");
        $artisans = $this->db->get_where('artisans');
        return $artisans->result();
    }

}