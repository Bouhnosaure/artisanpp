<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * execution cmd:Path/ php index.php worker executejob
 * if($this->input->is_cli_request()){
 */

/**
 * Description of worker
 *
 * @author Alex
 */
class worker extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function executejob() {
        $this->load->model('worker_model');
        $tasks = $this->worker_model->gettasks();
        foreach ($tasks as $task) {
            switch ($task->jobs_type) {
                case "parse":
                    $this->load->helper('csv_helper');
                    parse($task);
                    break;
                case "geocode":
                    $this->load->helper('geocode_helper');
                    geocode($task);
                    break;
                case "mapping":
                    $this->load->helper('csv_helper');
                    mapcats($task);
                    break;
                case "mail":
                    //var_dump($task);
                    break;
            }
        }
    }

    public function getqueue() {
        $this->load->model('worker_model');
        $tasks = $this->worker_model->gettasks();
        echo json_encode($tasks);
    }

    //put your code here
}
