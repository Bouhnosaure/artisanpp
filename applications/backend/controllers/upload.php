<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upload
 *
 * @author Alex
 */
class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('layout/upload');
    }

    public function file() {

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root'] . 'applications/backend/uploads/';
            $targetFile = $targetPath . $_FILES['file']['name'];
            if ($this->isUTF8($tempFile)) {
                move_uploaded_file($tempFile, $targetFile);
            }
            // save data in database (if you like!)
        }
    }

    protected function isUTF8($filename) {
        $info = finfo_open(FILEINFO_MIME_ENCODING);
        $type = finfo_buffer($info, file_get_contents($filename));
        finfo_close($info);

        return ($type == 'utf-8' || $type == 'us-ascii') ? true : false;
    }

}
