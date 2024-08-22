<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utility extends CI_Controller
{
    public function index()
    {
        // if ($this->session->userdata('logged_in') == TRUE) {
        //     redirect('home');
        // } else {
        $data = array(
            'content' => 'utility/utility'
        );
        $this->load->view('index', $data);
        // }
    }
}
