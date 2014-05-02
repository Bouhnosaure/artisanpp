<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function parse($file) {
    $ci = & get_instance();
    $ci->load->database();

    $fic = fopen($file->jobs_exec, "r");

    $Artisans = Array();

    while ($lines = fgetcsv($fic, 4096, ';')) {
        $data = array(
            'artisans_nom' => $lines[0],
            'artisans_adresse' => $lines[1],
            'artisans_cp' => $lines[2],
            'artisans_ville' => $lines[3],
            'artisans_tel' => $lines[4],
            'artisans_fax' => $lines[5],
            'artisans_mobile' => $lines[6],
            'artisans_mail' => $lines[7],
            'artisans_url' => $lines[8],
            'artisans_cat' => $lines[9],
            'artisans_siren' => $lines[10],
            'artisans_naf' => $lines[11],
            'artisans_creation' => $lines[12],
            'artisans_forme' => $lines[13],
            'artisans_capital' => $lines[14],
            'artisans_dirigeant' => $lines[15],
            'artisans_ets' => $lines[16],
            'artisans_ca' => $lines[17],
            'artisans_resultats' => $lines[18],
            'artisans_effectifs' => $lines[19]
        );

        array_push($Artisans, array('Artisan' => $data));
    }

    $total = sizeof($Artisans);
    $current = 1;
    foreach ($Artisans as $Artisan) {
        $statut = round($current * 100 / $total, 0);

        $ci->db->where('jobs_id', $file->jobs_id);
        $ci->db->update('jobs', array('jobs_statut' => $statut));

        $query = $ci->db->query(getArtisanID($Artisan));

        $idArt = "";

        if (sizeof($query->result()) > 0) {
            $idArt = $query->result()[0]->artisans_id;
        }

        if ($idArt != "") {
            $ci->db->where('artisans_id', $idArt);
            $ci->db->update('artisans', $Artisan['Artisan']);
        } else {
            $ci->db->insert('artisans', $Artisan['Artisan']);
        }

        $current++;
        //on dort une demi seconde
        usleep(10000);
    }
}

function getArtisanID($Artisan) {
    $sql = 'SELECT `artisans_id` '
            . 'FROM `artisans` '
            . 'WHERE `artisans_nom` = "' . $Artisan['Artisan']['artisans_nom']
            . '" AND `artisans_adresse` = "' . $Artisan['Artisan']['artisans_adresse']
            . '" AND `artisans_cp` = "' . $Artisan['Artisan']['artisans_cp']
            . '" AND `artisans_ville` = "' . $Artisan['Artisan']['artisans_ville']
            . '" AND `artisans_cat` = "' . $Artisan['Artisan']['artisans_cat'] . '";';
    return $sql;
}

function isValid($Artisan) {
    if (!empty($Artisan['Artisan']['nom_artisan']) and strlen($Artisan['Artisan']['adresse_artisan']) >= 4 and strlen($Artisan['Artisan']['cp_artisan']) >= 4 and strlen($Artisan['Artisan']['ville_artisan']) >= 4 and !empty($Artisan['Artisan']['cat_artisan'])) {
        return true;
    } else {
        return false;
    }
}

function mapcats($task) {

    $ci = & get_instance();
    $ci->load->database();
    
    $ci->db->where('jobs_id', $task->jobs_id);
    $ci->db->update('jobs', array('jobs_description' => "Remplissage de la table artisancat avec les catégories des artisans"));

    $ci->db->distinct();
    $ci->db->select('artisans_cat');
    $ci->db->order_by("artisans_cat", "desc");
    $query = $ci->db->get_where('artisans');


    $total = $query->num_rows();

    $current = 1;

    foreach ($query->result() as $cats) {

        $statut = round($current * 100 / $total, 0);

        $ci->db->where('jobs_id', $task->jobs_id);
        $ci->db->update('jobs', array('jobs_statut' => $statut));

        $entry = null;
        $data = null;

        $ci->db->where('artisancats_libelle', $cats->artisans_cat);
        $result = $ci->db->get_where('artisancats');

        if ($result->num_rows() > 0) {

            $update = array(
                'artisancats_id' => $result->result()[0]->artisancats_id,
                'artisancats_libelle' => $cats->artisans_cat
            );
            $ci->db->where('artisancats_id', $result->result()[0]->artisancats_id);
            $ci->db->update('artisancats', $update);
        } else {
            $create = array(
                'artisancats_libelle' => $cats->artisans_cat,
                "categories_id" => 1
            );
            $ci->db->insert('artisancats', $create);
        }
        $current++;
        sleep(2);
    }

    /*     * **PARTIE 2 ////////////// */
    $ci->db->where('jobs_id', $task->jobs_id);
    $ci->db->update('jobs', array('jobs_description' => "Mise a jour des relations entre la table artisans et artisancats"));

    $artisancats = $ci->db->get('artisancats');
    $total = $artisancats->num_rows();

    $current = 1;

    foreach ($artisancats->result() as $artisancat) {
        $statut = round($current * 100 / $total, 0);

        $ci->db->where('jobs_id', $task->jobs_id);
        $ci->db->update('jobs', array('jobs_statut' => $statut));


        $ci->db->where('artisans_cat', $artisancat->artisancats_libelle);
        $artisans = $ci->db->get_where('artisans');

        foreach ($artisans->result() as $artisan) {
            $update = array(
                'artisancats_id' => $artisancat->artisancats_id
            );
            $ci->db->where('artisans_id', $artisan->artisans_id);
            $ci->db->update('artisans', $update);
        }

        $current++;
        sleep(2);
    }
}
