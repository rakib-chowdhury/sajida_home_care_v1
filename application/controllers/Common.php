<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
    }

    public function download_SF_app()
    {
        //echo site_url('uploads/app/HomeCare.apk');die();
        $this->load->helper('download');
        $file_name = "HomeCare.apk";
        $data = file_get_contents(site_url().'/uploads/app/'.$file_name);
        force_download($file_name, $data);
    }
}