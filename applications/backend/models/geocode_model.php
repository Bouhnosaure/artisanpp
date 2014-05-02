<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of geocode_model
 *
 * @author Alex
 */
class geocode_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getstats() {

        $this->db->where('artisans_geocode_statut', "OK");
        $this->db->from('artisans');
        $OK = $this->db->count_all_results();

        $this->db->where('artisans_geocode_statut', "ZERO_RESULTS");
        $this->db->from('artisans');
        $ZERO_RESULTS = $this->db->count_all_results();

        $this->db->where('artisans_geocode_statut', "OVER_QUERY_LIMIT");
        $this->db->from('artisans');
        $OVER_QUERY_LIMIT = $this->db->count_all_results();

        $this->db->where('artisans_geocode_statut', "REQUEST_DENIED");
        $this->db->from('artisans');
        $REQUEST_DENIED = $this->db->count_all_results();

        $this->db->where('artisans_geocode_statut', "INVALID_REQUEST");
        $this->db->from('artisans');
        $INVALID_REQUEST = $this->db->count_all_results();

        $this->db->where('artisans_geocode_statut', "UNKNOWN_ERROR");
        $this->db->from('artisans');
        $UNKNOWN_ERROR = $this->db->count_all_results();

        $this->db->where('artisans_geocode_statut', "ERROR");
        $this->db->from('artisans');
        $ERROR = $this->db->count_all_results();

        $this->db->where('artisans_lat', NULL);
        $this->db->where('artisans_lng', NULL);
        $this->db->from('artisans');
        $EMPTY = $this->db->count_all_results();

        $Stats = array(
            array('label' => 'OK', 'data' => $OK),
            array('label' => 'ZERO_RESULTS', 'data' => $ZERO_RESULTS),
            array('label' => 'OVER_QUERY_LIMIT', 'data' => $OVER_QUERY_LIMIT),
            array('label' => 'REQUEST_DENIED', 'data' => $REQUEST_DENIED),
            array('label' => 'INVALID_REQUEST', 'data' => $INVALID_REQUEST),
            array('label' => 'UNKNOWN_ERROR', 'data' => $UNKNOWN_ERROR),
            array('label' => 'ERROR', 'data' => $ERROR),
            array('label' => 'EMPTY', 'data' => $EMPTY)
        );
        
        return $Stats;
    }

    //put your code here
}
