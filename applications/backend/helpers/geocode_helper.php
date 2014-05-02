<?php

function geocode($task) {
    $OK = 0;
    $ZERO_RESULTS = 0;
    $OVER_QUERY_LIMIT = 0;
    $REQUEST_DENIED = 0;
    $INVALID_REQUEST = 0;
    $UNKNOWN_ERROR = 0;
    $ERROR = 0;

    $ci = & get_instance();
    $ci->load->database();

    $ci->db->where('artisans_lat', NULL);
    $ci->db->where('artisans_lng', NULL);
    $query = $ci->db->get_where('artisans');

    $total = $query->num_rows();
    $current = 1;

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $Artisan) {

            $artisans_lat = NULL;
            $artisans_lng = NULL;
            $artisans_geocode_statut = NULL;

            $statut = round($current * 100 / $total, 0);

            $ci->db->where('jobs_id', $task->jobs_id);
            $ci->db->update('jobs', array('jobs_statut' => $statut));

            $location = $Artisan->artisans_adresse . ' ' . $Artisan->artisans_cp . ' ' . $Artisan->artisans_ville;

            $response = geocodeJson($location);
            
            if ($response->status == 'OK') {

                if (count($response->results) > 0) {
                    $artisans_lat = floatval($response->results[0]->geometry->location->lat);
                    $artisans_lng = floatval($response->results[0]->geometry->location->lng);
                    $artisans_geocode_statut = 'OK';
                }
            } elseif ($response->status == 'ZERO_RESULTS') {
                $artisans_geocode_statut = 'ZERO_RESULTS';
            } elseif ($response->status == 'OVER_QUERY_LIMIT') {
                $artisans_geocode_statut = 'OVER_QUERY_LIMIT';
            } elseif ($response->status == 'REQUEST_DENIED') {
                $artisans_geocode_statut = 'REQUEST_DENIED';
            } elseif ($response->status == 'INVALID_REQUEST') {
                $artisans_geocode_statut = 'INVALID_REQUEST';
            } elseif ($response->status == 'UNKNOWN_ERROR') {
                $artisans_geocode_statut = 'UNKNOWN_ERROR';
            } else {
                $artisans_geocode_statut = "ERROR";
            }

            $data = array(
                'artisans_lat' => $artisans_lat,
                'artisans_lng' => $artisans_lng,
                'artisans_geocode_statut' => $artisans_geocode_statut
            );

            $ci->db->where('artisans_id', $Artisan->artisans_id);
            $ci->db->update('artisans', $data);

            $current++;

            usleep(10000);
        }
    }
    //var_dump(callgoogle("Bordeaux"));
}

function geocodeJson($address) {
    $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false';
    $http = file_get_contents($url);
    $response = json_decode($http);
    return $response;
}
