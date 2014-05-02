<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of csv
 *
 * @author Alex
 */
class Csv extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

//simple explorateur de fichier csv
    public function index() {
        $this->load->view('layout/explorer');
    }

    public function geocode() {
        $this->load->view('layout/geocode');
    }

    public function geocodestats() {
        $this->load->model('geocode_model');
        echo json_encode($this->geocode_model->getstats());
    }

    public function categorieslink() {
        if (isset($_GET['artid']) && isset($_GET['catid'])) {
            $this->load->model('categories_model');
            $this->categories_model->alterartisancat($_GET['artid'],$_GET['catid']);
            echo"ok";
            die();
        }
        if (isset($_GET['cats'])) {
            if ($_GET['cats'] == "true") {
                $this->load->model('categories_model');
                echo json_encode($this->categories_model->getcats());
                die();
            }
        }
        if (isset($_GET['artisancats'])) {
            if ($_GET['artisancats'] == "true") {
                $this->load->model('categories_model');
                echo json_encode($this->categories_model->getartisancats());
                die();
            }
        }

        $this->load->view('layout/mapping');
    }

    /**
     * Fonction pour ajouter des fichiers a la queue.
     */
    public function sendtoqueue() {
        $this->load->model('worker_model');
        if (isset($_GET['mapping'])) {
            if ($_GET['mapping'] == "true") {
                $this->worker_model->addtask(
                        array(
                            'jobs_name' => "Mappging",
                            'jobs_description' => "Mise a jour de la table des relations entre les artisans et les catégories",
                            'jobs_type' => "mapping",
                            'jobs_exec' => "mapping",
                            'jobs_priority' => "2",
                            'jobs_statut' => "0"
                        )
                );
                echo "ok";
            }
        }
        if (isset($_GET['geocode'])) {
            if ($_GET['geocode'] == "true") {
                $this->worker_model->addtask(
                        array(
                            'jobs_name' => "Geocode",
                            'jobs_description' => "Conversion des adresse en coordonnées GPS",
                            'jobs_type' => "geocode",
                            'jobs_exec' => "geocode",
                            'jobs_priority' => "5",
                            'jobs_statut' => "0"
                        )
                );
                echo "ok";
            }
        }
        if (isset($_POST['json'])) {
            if ($_POST['json'] == "") {
                $message = "Veuillez selectionner des fichiers.";
            } else {
                $files = json_decode($_POST['json']);
                echo '<p><h4>traitement en cours ..</h4></p>';
                foreach ($files as $file) {
                    if ($file->type != "dir") {
                        echo $file->file . '<br>';

                        //Call Model.
                        $this->worker_model->addtask(
                                array(
                                    'jobs_name' => $file->file,
                                    'jobs_description' => "parsage",
                                    'jobs_type' => "parse",
                                    'jobs_exec' => $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . 'applications/backend/uploads/' . $file->file,
                                    'jobs_priority' => "1",
                                    'jobs_statut' => "0"
                                )
                        );
                    }
                }
            }
        }
    }

    /**
     * On récupère ici avec AJAX la liste des fichiers
     * d'un répertoire donné.
     */
    public function getfilesjson() {
        $dir = 'uploads/';

        if (!empty($_GET['dir'])) {
            $dir = $_GET['dir'];
            if ($dir[0] == '/') {
                $dir = '.' . $dir . '/';
            }
        }
        $dir = str_replace('..', '', $dir);
        $root = dirname(__FILE__) . '/../';

        $return = $dirs = $fi = array();

        if (file_exists($root . $dir)) {
            $files = scandir($root . $dir);

            natcasesort($files);
            if (count($files) > 2) { /* The 2 accounts for . and .. */
// All dirs
                foreach ($files as $file) {
                    if (file_exists($root . $dir . $file) && $file != '.' && $file != '..' && is_dir($root . $dir . $file)) {
                        $dirs[] = array('type' => 'dir', 'dir' => $dir, 'file' => $file);
                    } elseif (file_exists($root . $dir . $file) && $file != '.' && $file != '..' && !is_dir($root . $dir . $file)) {
                        $fi[] = array('type' => 'file', 'dir' => $dir, 'file' => $file, 'ext' => strtolower($this->getExt($file)));
                    }
                }
                $return = array_merge($dirs, $fi);
            }
        }
        $data['json'] = $return;

        if (!$data['json']) {
            show_404();
        }

        $this->load->view('layout/json_view', $data);
    }

    /**
     * Fonction pour réupérer le contenu d'un fichier pour tester
     * Cette fonction vérifie aussi qu'un fichier est bien en UTF8
     */
    public function openfilejson() {

        $dir = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . 'applications/backend/uploads/';
        $return = null;
        if (!empty($_GET['file']) && !empty($_GET['ext'])) {
            if ($_GET['ext'] == "csv") {
                if ($this->isUTF8($dir . $_GET['file'])) {
                    if (file_get_contents($dir . $_GET['file'])) {
                        $file = file_get_contents($dir . $_GET['file'], NULL, NULL, NULL, 4000);
                        $return = array('data' => $file);
                    }
                }
            }
        }
        $data['json'] = $return;

        if (!$data['json']) {
            $data['json'] = array('data' => "CSV Seulement ...");
        }
        $this->load->view('layout/json_view', $data);
    }

    /**
     * Recupération de l'extention d'un fichier
     * @param type $file
     * @return type
     */
    protected function getExt($file) {
        $dot = strrpos($file, '.') + 1;
        return substr($file, $dot);
    }

    /**
     * Fonction pour vérifier si un fichier est en utf8 avec son mimetype
     * @param type $filename
     * @return type
     */
    protected function isUTF8($filename) {
        $info = finfo_open(FILEINFO_MIME_ENCODING);
        $type = finfo_buffer($info, file_get_contents($filename));
        finfo_close($info);

        return ($type == 'utf-8' || $type == 'us-ascii') ? true : false;
    }

    /**
     * Fonction pour récupérer la liste des fichiers d'un répertoire
     * @param type $dir
     * @param type $recursive
     * @return string|boolean
     */
    protected function process_file($dir, $recursive = FALSE) {
        if (is_dir($dir)) {
            for ($list = array(), $handle = opendir($dir); (FALSE !== ($file = readdir($handle)));
            ) {
                if (($file != '.' && $file != '..') && (file_exists($path = $dir . '/' . $file))) {
                    if (is_dir($path) && ($recursive)) {
                        $list = array_merge($list, process_dir($path, TRUE));
                    } else {
                        $entry = array('filename' => $file, 'dirpath' => $dir);
                        $type = explode('.', $file);
                        $entry['filetype'] = end($type);
                        $entry['modtime'] = filemtime($path);
                        do
                            if (!is_dir($path)) {
                                $entry['size'] = filesize($path);
                                if (strstr(pathinfo($path, PATHINFO_BASENAME), 'log')) {
                                    if (!$entry['handle'] = fopen($path, r))
                                        $entry['handle'] = "FAIL";
                                }
                                break;
                            } else {
                                break;
                            } while (FALSE);
                        $list[] = $entry;
                    }
                }
            }
            closedir($handle);
            return $list;
        } else
            return FALSE;
    }

//put your code here
}
