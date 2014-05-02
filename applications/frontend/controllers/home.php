<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Crée par Alexandre Mangin et Loïc Moncany
 */

/**
 * $data['test'] variable
 * $data['header']['name'] variable can be handled by another view
 */
class Home extends CI_Controller {

    //configuration de la carte
    protected $map_config = array();

    public function __construct() {

        parent::__construct();
        //paramétrage de la carte
        $this->map_config['zoom'] = 'auto';
        $config['center'] = 'auto';
        $this->map_config['map_height'] = '100%';
        $this->map_config['map_data_role'] = 'data-role="main"';
        $this->map_config['map_data_theme'] = 'data-theme="a" ';
        $this->map_config['map_data_class'] = 'class="ui-content"';
        $this->map_config['cluster'] = TRUE;

        $this->googlemaps->initialize($this->map_config);
    }

    public function index() {
        $this->load->model('artisans_model');
        $artisans = $this->artisans_model->getartisans();
        foreach ($artisans as $artisan) {
            $marker = array();
            $marker['infowindow_content'] = $artisan->artisans_nom;
            $marker['position'] = $artisan->artisans_lat.','.$artisan->artisans_lng;
            $this->googlemaps->add_marker($marker);
        }
        $data['artisans']['artisans'] = $artisans;
        $data['map'] = $this->googlemaps->create_map();
        $this->load->view('layout/map', $data);
    }

    public function categorie($id = null) {

        $data['map'] = $this->googlemaps->create_map();
        $this->load->view('layout/map', $data);
    }

    public function artisan($id = null) {

        $this->load->view('layout/artisan');
    }

    public function getcategories() {
        $this->load->model('categories_model');
        $data['json'] = $this->categories_model->getcats();
        $this->load->view('layout/json_view', $data);
    }

}
