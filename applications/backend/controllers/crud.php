<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author Alex
 */
class Crud extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
    }

    public function artisans() {
        $this->grocery_crud->set_table('artisans');
        $data = $this->grocery_crud->render();
        $data->name = "Artisans";
        $this->load->view('layout/crud', $data);
    }

    public function categories() {
        $this->grocery_crud->set_table('categories');
        $data = $this->grocery_crud->render();
        $data->name = "Categories";
        $this->load->view('layout/crud', $data);
    }

    public function geocoderrors() {
        $this->grocery_crud->set_table('artisans');

        $this->grocery_crud->where('artisans_geocode_statut != ', 'OK');
        $this->grocery_crud->order_by('artisans_geocode_statut');

        $this->grocery_crud->columns('artisans_nom', 'artisans_adresse', 'artisans_cp', 'artisans_ville', 'artisans_geocode_statut');

        $data = $this->grocery_crud->render();
        $data->name = "Erreurs Geocodage";
        $this->load->view('layout/crud', $data);
    }

    public function artisancats() {
        $this->grocery_crud->set_table('artisancats');
        $data = $this->grocery_crud->render();
        $data->name = "Table Mappage des categories";
        $this->load->view('layout/crud', $data);
    }

    public function jobs() {
        $this->grocery_crud->set_table('jobs');
        $this->grocery_crud->columns('artiancats_id', 'artiancats_libelle', 'categories_id');
         $this->grocery_crud->order_by('artiancats_id');
        $data = $this->grocery_crud->render();
        $data->name = "Jobs";
        $this->load->view('layout/crud', $data);
    }

}
