<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
    
    public function __construct()
    {
        // Run the parent's constructor
        parent::__construct();
        
        // Check if the user is logged in
        $logged_in = $this->session->userdata('logged_in');
        
        // If not logged in, redirect to login form
        if ($logged_in == FALSE) {
            redirect('welcome/index');
        }
    }
    
    public function index()
    {
        echo 'App goes here';
    }
}