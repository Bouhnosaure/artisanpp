<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of worker
 *
 * @author Alex
 */
class Worker_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function addtask($data) {
        $this->db->insert('jobs', $data);
    }

    public function gettasks() {
        $this->db->where('jobs_statut <', "100");
        $this->db->order_by("jobs_priority", "desc");
        $query = $this->db->get_where('jobs');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    //put your code here
}
