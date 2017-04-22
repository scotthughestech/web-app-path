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
        // Create the data array
        $data = array();
        
        // Create the scripts array
        $scripts = array();
        
        // Add script to the scripts array
        $scripts[] = base_url('js/add.js');
        
        // Add scripts array to data array
        $data['scripts'] = $scripts;

        // Load the header
        $this->load->view('page/header', $data);
        
        // Load the page view
        $this->load->view('add', $data);
        
        // Load the footer
        $this->load->view('page/footer', $data);
    }
}