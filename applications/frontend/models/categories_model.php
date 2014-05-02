<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categories_model
 *
 * @author Alex
 */
class categories_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getcats() {
        $categories = $this->db->get_where('categories');
        return $categories->result();
    }

}
