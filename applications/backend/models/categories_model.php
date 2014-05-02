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

    public function getartisancats() {
        $categories = $this->db->get_where('categories');
        $artisancats = $this->db->get_where('artisancats');
        return array($artisancats->result(), $categories->result());
    }

    public function alterartisancat($artid, $catid) {
        $this->db->where('artisancats_id', $artid);
        $this->db->update('artisancats', array('categories_id' => $catid));
    }

    //put your code here
}
