<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends MY_Controller {
    public function index()
    {
        // Create the data array
        $data = array();
        
        // Get modules
        $modules = $this->_getModules();
        
        // Add modules to data array
        $data['modules'] = $modules;
        
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
    
    public function test()
    {
        // Load the database
        $this->load->database();
        
        // Set up your categories
        $categories = array(
            'Business',
            'Home',
            'Personal',
            'Food',
            'Entertainment',
            'Other'
        );
        
        // Insert them into the database
        foreach ($categories as $category) {
            $this->db->insert('categories', array('name' => $category));
        }
        
        // Done
        echo 'Done';
    }
}